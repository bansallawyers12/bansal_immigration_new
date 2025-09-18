<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\BlockedTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments
     */
    public function index(Request $request)
    {
        $query = Appointment::with('assignedAdmin')
                           ->orderBy('appointment_datetime', 'desc');

        // Filter by enquiry type (calendar type)
        if ($request->filled('enquiry_type')) {
            $query->byEnquiryType($request->enquiry_type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->dateRange($request->start_date, $request->end_date);
        }

        $appointments = $query->paginate(20);
        
        $enquiryTypes = [
            'tr' => 'TR (TRand JRP)',
            'tourist' => 'Tourist Visa',
            'education' => 'Education',
            'pr_complex' => 'PR/Complex'
        ];

        return view('admin.appointments.index', compact('appointments', 'enquiryTypes'));
    }

    /**
     * Store a newly created appointment (from frontend form)
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'location' => 'required|in:office,online',
            'meeting_type' => 'required|in:in_person,video_call,phone_call',
            'preferred_language' => 'required|string|max:50',
            'enquiry_type' => 'required|in:tr,tourist,education,pr_complex',
            'service_type' => 'nullable|string|max:100',
            'specific_service' => 'nullable|string|max:255',
            'enquiry_details' => 'required|string',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'duration_minutes' => 'nullable|integer|min:15|max:180'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if time slot is available
        $isAvailable = $this->checkTimeSlotAvailability(
            $request->appointment_date,
            $request->appointment_time,
            $request->enquiry_type,
            $request->duration_minutes ?? 30
        );

        if (!$isAvailable) {
            return response()->json([
                'success' => false,
                'message' => 'The selected time slot is not available. Please choose a different time.'
            ], 422);
        }

        try {
            $appointment = Appointment::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'location' => $request->location,
                'meeting_type' => $request->meeting_type,
                'preferred_language' => $request->preferred_language,
                'enquiry_type' => $request->enquiry_type,
                'service_type' => $request->service_type,
                'specific_service' => $request->specific_service,
                'enquiry_details' => $request->enquiry_details,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'duration_minutes' => $request->duration_minutes ?? 30,
                'status' => 'pending',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'form_data' => $request->all()
            ]);

            // Generate confirmation token
            $appointment->generateConfirmationToken();

            return response()->json([
                'success' => true,
                'message' => 'Appointment booked successfully! You will receive a confirmation email shortly.',
                'appointment_id' => $appointment->id,
                'confirmation_token' => $appointment->confirmation_token
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to book appointment. Please try again.'
            ], 500);
        }
    }

    /**
     * Get available time slots for a specific date and enquiry type
     */
    public function getAvailableTimeSlots(Request $request)
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

        // Define different working hours for different enquiry types
        $workingHours = $this->getWorkingHoursForEnquiryType($enquiryType);
        
        $availableSlots = [];
        $currentTime = Carbon::parse($date . ' ' . $workingHours['start']);
        $endTime = Carbon::parse($date . ' ' . $workingHours['end']);

        while ($currentTime->addMinutes($workingHours['interval'])->lte($endTime)) {
            $timeSlot = $currentTime->format('H:i');
            
            if ($this->checkTimeSlotAvailability($date, $timeSlot, $enquiryType, $duration)) {
                $availableSlots[] = [
                    'time' => $timeSlot,
                    'display' => $currentTime->format('g:i A')
                ];
            }
        }

        return response()->json([
            'success' => true,
            'available_slots' => $availableSlots,
            'working_hours' => $workingHours
        ]);
    }

    /**
     * Check if a time slot is available
     */
    private function checkTimeSlotAvailability($date, $time, $enquiryType, $duration = 30, $excludeAppointmentId = null)
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
                                             ->when($excludeAppointmentId, function($query) use ($excludeAppointmentId) {
                                                 return $query->where('id', '!=', $excludeAppointmentId);
                                             })
                                             ->get()
                                             ->filter(function($appointment) use ($appointmentDateTime, $endDateTime) {
                                                 $existingStart = $appointment->appointment_datetime;
                                                 $existingEnd = $existingStart->copy()->addMinutes($appointment->duration_minutes);
                                                 
                                                 return $appointmentDateTime->lt($existingEnd) && $endDateTime->gt($existingStart);
                                             });

        return $conflictingAppointments->isEmpty();
    }

    /**
     * Get working hours configuration for different enquiry types (4 different calendars)
     */
    private function getWorkingHoursForEnquiryType($enquiryType)
    {
        return match($enquiryType) {
            'tr' => [
                'start' => '09:00',
                'end' => '17:00',
                'interval' => 30,
                'lunch_break' => ['start' => '12:00', 'end' => '13:00']
            ],
            'tourist' => [
                'start' => '10:00',
                'end' => '16:00', 
                'interval' => 45,
                'lunch_break' => ['start' => '12:30', 'end' => '13:30']
            ],
            'education' => [
                'start' => '09:30',
                'end' => '17:30',
                'interval' => 60,
                'lunch_break' => ['start' => '12:00', 'end' => '14:00']
            ],
            'pr_complex' => [
                'start' => '11:00',
                'end' => '15:00',
                'interval' => 30,
                'lunch_break' => null
            ],
            default => [
                'start' => '09:00',
                'end' => '17:00',
                'interval' => 30,
                'lunch_break' => ['start' => '12:00', 'end' => '13:00']
            ]
        };
    }

    // Placeholder methods for admin interface
    public function create() { return view('admin.appointments.create'); }
    public function show(string $id) { return view('admin.appointments.show', compact('id')); }
    public function edit(string $id) { return view('admin.appointments.edit', compact('id')); }
    public function update(Request $request, string $id) { return redirect()->back(); }
    public function destroy(string $id) { return redirect()->back(); }
}
