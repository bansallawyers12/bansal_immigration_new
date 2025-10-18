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
            'location' => 'required|in:melbourne,adelaide',
            'duration' => 'nullable|integer|min:15|max:180',
            'is_paid' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $date = $request->date;
        $enquiryType = $request->enquiry_type;
        $location = $request->location;
        $duration = $request->duration ?? 30;
        $isPaid = $request->boolean('is_paid', false);

        $availableSlots = $this->getAvailableSlotsForDate($date, $enquiryType, $duration, $location, $isPaid);
        $workingHours = $this->getWorkingHoursForLocation($location, $enquiryType, $isPaid);

        return response()->json([
            'success' => true,
            'date' => $date,
            'enquiry_type' => $enquiryType,
            'location' => $location,
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
                    'end' => $appointment->appointment_datetime->copy()->addMinutes($appointment->duration_minutes)->toISOString(),
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
    private function getAvailableSlotsForDate($date, $enquiryType, $duration = 30, $location = 'melbourne', $isPaid = false)
    {
        $workingHours = $this->getWorkingHoursForLocation($location, $enquiryType, $isPaid);
        $availableSlots = [];
        
        $currentTime = Carbon::parse($date . ' ' . $workingHours['start']);
        $endTime = Carbon::parse($date . ' ' . $workingHours['end']);

        while ($currentTime->copy()->addMinutes($duration)->lte($endTime)) {
            $timeSlot = $currentTime->format('H:i');
            
            if ($this->checkTimeSlotAvailability($date, $timeSlot, $enquiryType, $duration, $location)) {
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
    private function checkTimeSlotAvailability($date, $time, $enquiryType, $duration = 30, $location = 'melbourne')
    {
        // Check blocked times
        if (!BlockedTime::isTimeSlotAvailable($date, $time, $enquiryType, $duration, $location)) {
            return false;
        }

        // Check existing appointments
        $appointmentDateTime = Carbon::parse($date . ' ' . $time);
        $endDateTime = $appointmentDateTime->copy()->addMinutes($duration);

        $conflictingAppointments = Appointment::where('appointment_date', $date)
                                             ->where('location', $location)
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
     * Get working hours based on location and enquiry type
     * Now reads from database calendar_settings table
     */
    private function getWorkingHoursForLocation($location, $enquiryType, $isPaid = false)
    {
        // Get setting from database
        $setting = \App\Models\CalendarSetting::getSettingFor($location, $enquiryType, $isPaid);
        
        // Define colors for different calendars
        $colors = [
            'adelaide' => '#dc3545',
            'tr' => '#007bff',
            'tourist' => '#28a745',
            'education' => '#ffc107',
            'pr_complex' => '#6f42c1'
        ];
        
        // Fallback to hardcoded values if no setting found
        if (!$setting) {
            if ($location === 'adelaide') {
                return [
                    'start' => '09:00',
                    'end' => '17:00',
                    'interval' => 30,
                    'name' => 'Adelaide Office',
                    'color' => '#dc3545'
                ];
            } else {
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
        
        // Return formatted setting from database
        return [
            'start' => \Carbon\Carbon::parse($setting->start_time)->format('H:i'),
            'end' => \Carbon\Carbon::parse($setting->end_time)->format('H:i'),
            'interval' => $setting->slot_duration_minutes,
            'name' => $setting->calendar_name,
            'color' => $colors[$setting->enquiry_type ?? 'adelaide'] ?? '#6c757d'
        ];
    }
}
