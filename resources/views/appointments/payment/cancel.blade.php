@extends('layouts.app')

@section('title', 'Payment Cancelled')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Cancelled Message -->
        <div class="text-center mb-8">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                <i class="fas fa-times text-2xl text-red-600"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">Payment Cancelled</h1>
            <p class="mt-2 text-gray-600">Your payment was not completed</p>
        </div>

        <!-- Information Card -->
        <div class="bg-white rounded-lg shadow-md mb-6">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">What happened?</h2>
                <div class="space-y-3 text-gray-600">
                    <p>Your payment process was cancelled and no charges were made to your account.</p>
                    <p>Your appointment booking has been cancelled. If you'd like to book an appointment, you can start the process again.</p>
                </div>
            </div>
        </div>

        <!-- Appointment Details (if any) -->
        @if($appointment)
        <div class="bg-white rounded-lg shadow-md mb-6">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Cancelled Appointment Details</h2>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Appointment ID</span>
                        <span class="font-medium text-gray-900">#{{ $appointment->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Consultation Type</span>
                        <span class="font-medium text-gray-900">{{ $appointment->enquiry_type_display }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Scheduled Date</span>
                        <span class="font-medium text-gray-900">
                            {{ $appointment->appointment_datetime->format('M d, Y g:i A') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Help Section -->
        <div class="bg-yellow-50 rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold text-yellow-900 mb-2">Need Help?</h3>
            <p class="text-yellow-800 mb-4">If you experienced any issues during payment, please contact our support team.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-yellow-700">Phone Support</p>
                    <p class="font-medium text-yellow-900">+1 (555) 123-4567</p>
                </div>
                <div>
                    <p class="text-sm text-yellow-700">Email Support</p>
                    <p class="font-medium text-yellow-900">support@bansalimmigration.com</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="text-center">
            <a href="{{ route('appointment') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 mr-4">
                <i class="fas fa-calendar-plus mr-2"></i>
                Try Booking Again
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
