@extends('layouts.app')

@section('title', 'Appointment Confirmed')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6">
                <i class="fas fa-check text-green-600 text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Appointment Confirmed!</h2>
            <p class="text-gray-600">Your appointment has been successfully booked.</p>
        </div>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <div class="space-y-6">
                <!-- Appointment Details -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Appointment Details</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Name:</span>
                            <span class="font-medium">{{ $appointment->full_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email:</span>
                            <span class="font-medium">{{ $appointment->email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Phone:</span>
                            <span class="font-medium">{{ $appointment->phone }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date:</span>
                            <span class="font-medium">{{ $appointment->appointment_date->format('M j, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Time:</span>
                            <span class="font-medium">{{ $appointment->appointment_time }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Type:</span>
                            <span class="font-medium">{{ ucfirst(str_replace('_', ' ', $appointment->enquiry_type)) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Location:</span>
                            <span class="font-medium">{{ ucfirst($appointment->location) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Confirmation Message -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex">
                        <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-3"></i>
                        <div>
                            <h4 class="text-sm font-medium text-blue-800">What's Next?</h4>
                            <p class="text-sm text-blue-700 mt-1">
                                You will receive a confirmation email shortly with all the details. 
                                Please keep this information for your records.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    <a href="{{ route('appointments.show', $appointment) }}" 
                       class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        View Appointment Details
                    </a>
                    
                    <a href="{{ route('home') }}" 
                       class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Return to Home
                    </a>
                </div>

                <!-- Contact Information -->
                <div class="text-center text-sm text-gray-500">
                    <p>Need to make changes? Contact us at:</p>
                    <p class="font-medium">info@bansalimmigration.com</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
