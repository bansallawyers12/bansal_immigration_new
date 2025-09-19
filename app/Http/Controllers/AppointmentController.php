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

        return view('appointments.admin.index', compact('appointments', 'enquiryTypes'));
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
            $isPaid = $request->input('is_paid', false);
            $pricing = Appointment::getPricing();
            $baseAmount = $pricing[$request->enquiry_type] ?? 0;
            
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
                'status' => $isPaid ? 'pending_payment' : 'pending',
                'is_paid' => $isPaid,
                'amount' => $baseAmount,
                'final_amount' => $baseAmount,
                'assigned_to' => $request->assigned_admin_id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'form_data' => $request->all()
            ]);

            // Generate confirmation token
            $appointment->generateConfirmationToken();

            $response = [
                'success' => true,
                'message' => $isPaid 
                    ? 'Appointment created! Please complete payment to confirm your booking.'
                    : 'Appointment booked successfully! You will receive a confirmation email shortly.',
                'appointment_id' => $appointment->id,
                'confirmation_token' => $appointment->confirmation_token
            ];

            if ($isPaid) {
                $response['payment_required'] = true;
                $response['payment_url'] = route('payments.show', $appointment);
                $response['amount'] = $baseAmount;
            }

            return response()->json($response);

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

    /**
     * Confirm an appointment
     */
    public function confirm(Appointment $appointment)
    {
        // Check authorization
        if (!auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // Validate appointment can be confirmed
        if ($appointment->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending appointments can be confirmed.');
        }

        // Use existing model method
        $appointment->confirm();

        // Log the action
        \Log::info('Appointment confirmed', [
            'appointment_id' => $appointment->id,
            'admin_user' => auth()->id(),
            'confirmed_at' => now()
        ]);

        return redirect()->back()->with('success', 'Appointment confirmed successfully.');
    }

    /**
     * Cancel an appointment
     */
    public function cancel(Request $request, Appointment $appointment)
    {
        // Check authorization
        if (!auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // Validate appointment can be cancelled
        if (!$appointment->canBeCancelled()) {
            return redirect()->back()->with('error', 'This appointment cannot be cancelled.');
        }

        // Get cancellation reason from request
        $reason = $request->input('cancellation_reason', 'Cancelled by admin');

        // Use existing model method
        $appointment->cancel($reason);

        // Log the action
        \Log::info('Appointment cancelled', [
            'appointment_id' => $appointment->id,
            'admin_user' => auth()->id(),
            'cancellation_reason' => $reason,
            'cancelled_at' => now()
        ]);

        return redirect()->back()->with('success', 'Appointment cancelled successfully.');
    }

    /**
     * Show appointments calendar
     */
    public function calendar(Request $request)
    {
        // Check authorization
        if (!auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // Get filter parameters
        $enquiryType = $request->get('enquiry_type');
        $startDate = $request->get('start_date', now()->startOfMonth());
        $endDate = $request->get('end_date', now()->endOfMonth());

        // Build query for appointments
        $query = Appointment::with('assignedAdmin')
                           ->dateRange($startDate, $endDate)
                           ->active();

        // Apply enquiry type filter if provided
        if ($enquiryType) {
            $query->byEnquiryType($enquiryType);
        }

        $appointments = $query->orderBy('appointment_datetime')->get();

        // Get enquiry types for filter dropdown
        $enquiryTypes = [
            'tr' => 'TR (TRand JRP)',
            'tourist' => 'Tourist Visa', 
            'education' => 'Education',
            'pr_complex' => 'PR/Complex'
        ];

        return view('appointments.admin.calendar', compact('appointments', 'enquiryTypes', 'enquiryType', 'startDate', 'endDate'));
    }

    /**
     * Show the form for creating a new appointment
     */
    public function create()
    {
        // Check authorization
        if (!auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $enquiryTypes = [
            'tr' => 'TR (TRand JRP)',
            'tourist' => 'Tourist Visa',
            'education' => 'Education',
            'pr_complex' => 'PR/Complex'
        ];

        // Get admin users for assignment
        $adminUsers = \App\Models\User::admins()->get();

        return view('appointments.admin.create', compact('enquiryTypes', 'adminUsers'));
    }

    /**
     * Display the specified appointment
     */
    public function show(Appointment $appointment)
    {
        // Check authorization
        if (!auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        return view('appointments.admin.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified appointment
     */
    public function edit(Appointment $appointment)
    {
        // Check authorization
        if (!auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $enquiryTypes = [
            'tr' => 'TR (TRand JRP)',
            'tourist' => 'Tourist Visa',
            'education' => 'Education',
            'pr_complex' => 'PR/Complex'
        ];

        // Get admin users for assignment
        $adminUsers = \App\Models\User::admins()->get();

        return view('appointments.admin.edit', compact('appointment', 'enquiryTypes', 'adminUsers'));
    }

    /**
     * Update the specified appointment
     */
    public function update(Request $request, Appointment $appointment)
    {
        // Check authorization
        if (!auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

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
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'duration_minutes' => 'nullable|integer|min:15|max:180',
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled,no_show',
            'admin_notes' => 'nullable|string',
            'assigned_admin_id' => 'nullable|exists:users,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if time slot is available (excluding current appointment)
        if ($request->appointment_date !== $appointment->appointment_date || 
            $request->appointment_time !== $appointment->appointment_time) {
            
            $isAvailable = $this->checkTimeSlotAvailability(
                $request->appointment_date,
                $request->appointment_time,
                $request->enquiry_type,
                $request->duration_minutes ?? 30,
                $appointment->id
            );

            if (!$isAvailable) {
                return redirect()->back()
                    ->with('error', 'The selected time slot is not available. Please choose a different time.')
                    ->withInput();
            }
        }

        try {
            // Update appointment
            $appointment->update([
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
                'status' => $request->status,
                'admin_notes' => $request->admin_notes,
                'assigned_admin_id' => $request->assigned_admin_id,
                'updated_at' => now()
            ]);

            // Log the action
            \Log::info('Appointment updated', [
                'appointment_id' => $appointment->id,
                'admin_user' => auth()->id(),
                'updated_fields' => $request->only([
                    'full_name', 'email', 'phone', 'location', 'meeting_type',
                    'preferred_language', 'enquiry_type', 'service_type',
                    'specific_service', 'enquiry_details', 'appointment_date',
                    'appointment_time', 'duration_minutes', 'status', 'admin_notes'
                ]),
                'updated_at' => now()
            ]);

            return redirect()->route('admin.appointments.show', $appointment)
                ->with('success', 'Appointment updated successfully.');

        } catch (\Exception $e) {
            \Log::error('Failed to update appointment', [
                'appointment_id' => $appointment->id,
                'error' => $e->getMessage(),
                'admin_user' => auth()->id()
            ]);

            return redirect()->back()
                ->with('error', 'Failed to update appointment. Please try again.')
                ->withInput();
        }
    }

    /**
     * Remove the specified appointment
     */
    public function destroy(Appointment $appointment)
    {
        // Check authorization
        if (!auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // Only allow deletion of pending or cancelled appointments
        if (!in_array($appointment->status, ['pending', 'cancelled'])) {
            return redirect()->back()->with('error', 'Only pending or cancelled appointments can be deleted.');
        }

        try {
            // Log the action before deletion
            \Log::info('Appointment deleted', [
                'appointment_id' => $appointment->id,
                'admin_user' => auth()->id(),
                'deleted_at' => now()
            ]);

            $appointment->delete();

            return redirect()->route('admin.appointments.index')
                ->with('success', 'Appointment deleted successfully.');

        } catch (\Exception $e) {
            \Log::error('Failed to delete appointment', [
                'appointment_id' => $appointment->id,
                'error' => $e->getMessage(),
                'admin_user' => auth()->id()
            ]);

            return redirect()->back()->with('error', 'Failed to delete appointment. Please try again.');
        }
    }
}
