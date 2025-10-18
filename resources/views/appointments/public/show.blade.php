@extends('layouts.standalone')

@section('title', 'Appointment Details')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Appointment Details</h1>
            
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-500">Booking Reference</label>
                    <p class="text-lg font-semibold">#{{ str_pad($appointment->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Full Name</label>
                        <p class="font-medium text-gray-900">{{ $appointment->full_name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Email</label>
                        <p class="font-medium text-gray-900">{{ $appointment->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Phone</label>
                        <p class="font-medium text-gray-900">{{ $appointment->phone }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Status</label>
                        <p class="font-medium capitalize">
                            <span class="px-2 py-1 rounded text-sm {{ $appointment->status == 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $appointment->status }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Consultation Type</label>
                        <p class="font-medium text-gray-900">{{ $appointment->enquiry_type_display }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Location</label>
                        <p class="font-medium text-gray-900">{{ ucfirst($appointment->location) }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Date</label>
                        <p class="font-medium text-gray-900">{{ $appointment->appointment_date->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Time</label>
                        <p class="font-medium text-gray-900">{{ $appointment->appointment_time }}</p>
                    </div>
                </div>

                @if($appointment->enquiry_details)
                <div class="pt-4 border-t">
                    <label class="text-sm font-medium text-gray-500">Enquiry Details</label>
                    <p class="font-medium text-gray-900 mt-1">{{ $appointment->enquiry_details }}</p>
                </div>
                @endif
            </div>
            
            <div class="mt-8 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                    <i class="fas fa-home mr-2"></i>
                    Return to Home
                </a>
                
                @if($appointment->canBeCancelled())
                <button onclick="cancelAppointment()" class="inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                    <i class="fas fa-times mr-2"></i>
                    Cancel Appointment
                </button>
                @endif
            </div>
        </div>
    </div>
</div>

@if($appointment->canBeCancelled())
<script>
function cancelAppointment() {
    if (confirm('Are you sure you want to cancel this appointment?')) {
        const reason = prompt('Please provide a reason for cancellation:');
        if (reason) {
            // Implement cancellation logic here
            alert('Cancellation functionality would be implemented here.');
        }
    }
}
</script>
@endif
@endsection

