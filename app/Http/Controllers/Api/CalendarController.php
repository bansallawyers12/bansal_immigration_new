<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\BlockedTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CalendarController extends Controller
{
    /**
     * Get available time slots for a specific date and enquiry type
     */
    public function getAvailableSlots(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date|after_or_equal:today',
            'enquiry_type' => 'required|in:tr,tourist,education,pr_complex',
            'duration' => 'nullable|integer|min:15|max:180'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $date = $request->date;
        $enquiryType = $request->enquiry_type;
        $duration = $request->duration ?? 30;

        $availableSlots = $this->getAvailableSlotsForDate($date, $enquiryType, $duration);
        $workingHours = $this->getWorkingHoursForEnquiryType($enquiryType);

        return response()->json([
            'success' => true,
            'date' => $date,
            'enquiry_type' => $enquiryType,
            'available_slots' => $availableSlots,
            'total_slots' => count($availableSlots),
            'working_hours' => $workingHours
        ]);
    }

    /**
     * Get calendar events for display (appointments + blocked times)
     */
    public function getCalendarEvents(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'enquiry_type' => 'nullable|in:tr,tourist,education,pr_complex',
            'view' => 'nullable|in:appointments,blocked_times,all'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $startDate = $request->start;
        $endDate = $request->end;
        $enquiryType = $request->enquiry_type;
        $view = $request->view ?? 'all';

        $events = collect();

        // Get appointments if requested
        if (in_array($view, ['appointments', 'all'])) {
            $appointmentQuery = Appointment::dateRange($startDate, $endDate)->active();
            
            if ($enquiryType) {
                $appointmentQuery->byEnquiryType($enquiryType);
            }

            $appointments = $appointmentQuery->get();
            
            $appointmentEvents = $appointments->map(function ($appointment) {
                return [
                    'id' => 'appointment_' . $appointment->id,
                    'title' => $appointment->full_name . ' - ' . $appointment->enquiry_type_display,
                    'start' => $appointment->appointment_datetime->toISOString(),
                    'end' => $appointment->appointment_datetime->addMinutes($appointment->duration_minutes)->toISOString(),
                    'backgroundColor' => $appointment->calendar_color,
                    'type' => 'appointment'
                ];
            });

            $events = $events->merge($appointmentEvents);
        }

        return response()->json([
            'success' => true,
            'events' => $events->values(),
            'total_events' => $events->count()
        ]);
    }

    /**
     * Get available slots for a specific date (private helper)
     */
    private function getAvailableSlotsForDate($date, $enquiryType, $duration = 30)
    {
        $workingHours = $this->getWorkingHoursForEnquiryType($enquiryType);
        $availableSlots = [];
        
        $currentTime = Carbon::parse($date . ' ' . $workingHours['start']);
        $endTime = Carbon::parse($date . ' ' . $workingHours['end']);

        while ($currentTime->copy()->addMinutes($duration)->lte($endTime)) {
            $timeSlot = $currentTime->format('H:i');
            
            if ($this->checkTimeSlotAvailability($date, $timeSlot, $enquiryType, $duration)) {
                $availableSlots[] = [
                    'time' => $timeSlot,
                    'display' => $currentTime->format('g:i A')
                ];
            }

            $currentTime->addMinutes($workingHours['interval']);
        }

        return $availableSlots;
    }

    /**
     * Check if a time slot is available (private helper)
     */
    private function checkTimeSlotAvailability($date, $time, $enquiryType, $duration = 30)
    {
        // Check blocked times
        if (!BlockedTime::isTimeSlotAvailable($date, $time, $enquiryType, $duration)) {
            return false;
        }

        // Check existing appointments
        $appointmentDateTime = Carbon::parse($date . ' ' . $time);
        $endDateTime = $appointmentDateTime->copy()->addMinutes($duration);

        $conflictingAppointments = Appointment::where('appointment_date', $date)
                                             ->active()
                                             ->get()
                                             ->filter(function($appointment) use ($appointmentDateTime, $endDateTime) {
                                                 $existingStart = $appointment->appointment_datetime;
                                                 $existingEnd = $existingStart->copy()->addMinutes($appointment->duration_minutes);
                                                 
                                                 return $appointmentDateTime->lt($existingEnd) && $endDateTime->gt($existingStart);
                                             });

        return $conflictingAppointments->isEmpty();
    }

    /**
     * Get working hours for different enquiry types (4 different calendars)
     */
    private function getWorkingHoursForEnquiryType($enquiryType)
    {
        return match($enquiryType) {
            'tr' => [
                'start' => '09:00',
                'end' => '17:00',
                'interval' => 30,
                'name' => 'TR (TRand JRP)',
                'color' => '#007bff'
            ],
            'tourist' => [
                'start' => '10:00',
                'end' => '16:00', 
                'interval' => 45,
                'name' => 'Tourist Visa',
                'color' => '#28a745'
            ],
            'education' => [
                'start' => '09:30',
                'end' => '17:30',
                'interval' => 60,
                'name' => 'Education',
                'color' => '#ffc107'
            ],
            'pr_complex' => [
                'start' => '11:00',
                'end' => '15:00',
                'interval' => 30,
                'name' => 'PR/Complex',
                'color' => '#6f42c1'
            ],
            default => [
                'start' => '09:00',
                'end' => '17:00',
                'interval' => 30,
                'name' => 'General',
                'color' => '#6c757d'
            ]
        };
    }
}
