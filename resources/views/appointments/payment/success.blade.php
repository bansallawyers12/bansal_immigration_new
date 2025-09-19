@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Message -->
        <div class="text-center mb-8">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                <i class="fas fa-check text-2xl text-green-600"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Payment Successful!</h1>
            <p class="mt-2 text-gray-600">Your appointment has been confirmed</p>
        </div>

        <!-- Appointment Confirmation -->
        <div class="bg-white rounded-lg shadow-md mb-6">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Appointment Confirmed</h2>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Appointment ID</span>
                        <span class="font-medium text-gray-900">#{{ $appointment->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Client Name</span>
                        <span class="font-medium text-gray-900">{{ $appointment->full_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Consultation Type</span>
                        <span class="font-medium text-gray-900">{{ $appointment->enquiry_type_display }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Date & Time</span>
                        <span class="font-medium text-gray-900">
                            {{ $appointment->appointment_datetime->format('M d, Y g:i A') }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Duration</span>
                        <span class="font-medium text-gray-900">{{ $appointment->duration_minutes }} minutes</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Location</span>
                        <span class="font-medium text-gray-900">{{ ucfirst($appointment->location) }}</span>
                    </div>
                    @if($appointment->payment)
                    <div class="flex justify-between">
                        <span class="text-gray-500">Amount Paid</span>
                        <span class="font-medium text-gray-900">${{ number_format($appointment->payment->final_amount, 2) }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="bg-blue-50 rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold text-blue-900 mb-2">What's Next?</h3>
            <ul class="space-y-2 text-blue-800">
                <li class="flex items-start">
                    <i class="fas fa-envelope mr-2 mt-1"></i>
                    <span>You will receive a confirmation email with all the details</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-calendar mr-2 mt-1"></i>
                    <span>We'll send you a reminder 24 hours before your appointment</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-phone mr-2 mt-1"></i>
                    <span>If you need to reschedule, please contact us at least 24 hours in advance</span>
                </li>
            </ul>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Need Help?</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Phone</p>
                    <p class="font-medium text-gray-900">+1 (555) 123-4567</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium text-gray-900">info@bansalimmigration.com</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="text-center mt-8">
            <a href="{{ route('appointments.book') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 mr-4">
                <i class="fas fa-calendar-plus mr-2"></i>
                Book Another Appointment
            </a>
            <a href="{{ route('home') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700">
                <i class="fas fa-home mr-2"></i>
                Back to Home
            </a>
        </div>
    </div>
</div>
@endsection
