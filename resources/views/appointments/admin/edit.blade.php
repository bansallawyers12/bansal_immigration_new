@extends('layouts.admin')

@section('title', 'Edit Appointment')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Appointment</h1>
            <p class="text-gray-600 mt-1">Update appointment #{{ $appointment->id }} details</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.appointments.show', $appointment) }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-eye mr-2"></i>View Appointment
            </a>
            <a href="{{ route('admin.appointments.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Back to Appointments
            </a>
        </div>
    </div>

    <!-- Edit Appointment Form -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.appointments.update', $appointment) }}" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Client Information Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Client Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name *</label>
                            <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $appointment->full_name) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('full_name') border-red-300 @enderror" 
                                   required>
                            @error('full_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $appointment->email) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-300 @enderror" 
                                   required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone *</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $appointment->phone) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('phone') border-red-300 @enderror" 
                                   required>
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="preferred_language" class="block text-sm font-medium text-gray-700">Preferred Language *</label>
                            <input type="text" name="preferred_language" id="preferred_language" value="{{ old('preferred_language', $appointment->preferred_language) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('preferred_language') border-red-300 @enderror" 
                                   required>
                            @error('preferred_language')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Appointment Details Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Appointment Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="enquiry_type" class="block text-sm font-medium text-gray-700">Enquiry Type *</label>
                            <select name="enquiry_type" id="enquiry_type" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('enquiry_type') border-red-300 @enderror" 
                                    required>
                                <option value="">Select enquiry type</option>
                                @foreach($enquiryTypes as $key => $label)
                                    <option value="{{ $key }}" {{ old('enquiry_type', $appointment->enquiry_type) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('enquiry_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                            <select name="status" id="status" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-300 @enderror" 
                                    required>
                                <option value="pending" {{ old('status', $appointment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('status', $appointment->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="in_progress" {{ old('status', $appointment->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ old('status', $appointment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status', $appointment->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="no_show" {{ old('status', $appointment->status) == 'no_show' ? 'selected' : '' }}>No Show</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="appointment_date" class="block text-sm font-medium text-gray-700">Appointment Date *</label>
                            <input type="date" name="appointment_date" id="appointment_date" value="{{ old('appointment_date', $appointment->appointment_date->format('Y-m-d')) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('appointment_date') border-red-300 @enderror" 
                                   required>
                            @error('appointment_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="appointment_time" class="block text-sm font-medium text-gray-700">Appointment Time *</label>
                            <input type="time" name="appointment_time" id="appointment_time" value="{{ old('appointment_time', $appointment->appointment_time->format('H:i')) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('appointment_time') border-red-300 @enderror" 
                                   required>
                            @error('appointment_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="duration_minutes" class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                            <select name="duration_minutes" id="duration_minutes" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('duration_minutes') border-red-300 @enderror">
                                <option value="15" {{ old('duration_minutes', $appointment->duration_minutes) == '15' ? 'selected' : '' }}>15 minutes</option>
                                <option value="30" {{ old('duration_minutes', $appointment->duration_minutes) == '30' ? 'selected' : '' }}>30 minutes</option>
                                <option value="45" {{ old('duration_minutes', $appointment->duration_minutes) == '45' ? 'selected' : '' }}>45 minutes</option>
                                <option value="60" {{ old('duration_minutes', $appointment->duration_minutes) == '60' ? 'selected' : '' }}>60 minutes</option>
                                <option value="90" {{ old('duration_minutes', $appointment->duration_minutes) == '90' ? 'selected' : '' }}>90 minutes</option>
                                <option value="120" {{ old('duration_minutes', $appointment->duration_minutes) == '120' ? 'selected' : '' }}>120 minutes</option>
                            </select>
                            @error('duration_minutes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Location *</label>
                            <select name="location" id="location" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('location') border-red-300 @enderror" 
                                    required>
                                <option value="office" {{ old('location', $appointment->location) == 'office' ? 'selected' : '' }}>Office</option>
                                <option value="online" {{ old('location', $appointment->location) == 'online' ? 'selected' : '' }}>Online</option>
                            </select>
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="meeting_type" class="block text-sm font-medium text-gray-700">Meeting Type *</label>
                            <select name="meeting_type" id="meeting_type" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('meeting_type') border-red-300 @enderror" 
                                    required>
                                <option value="in_person" {{ old('meeting_type', $appointment->meeting_type) == 'in_person' ? 'selected' : '' }}>In Person</option>
                                <option value="video_call" {{ old('meeting_type', $appointment->meeting_type) == 'video_call' ? 'selected' : '' }}>Video Call</option>
                                <option value="phone_call" {{ old('meeting_type', $appointment->meeting_type) == 'phone_call' ? 'selected' : '' }}>Phone Call</option>
                            </select>
                            @error('meeting_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="assigned_admin_id" class="block text-sm font-medium text-gray-700">Assign to Admin</label>
                            <select name="assigned_admin_id" id="assigned_admin_id" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('assigned_admin_id') border-red-300 @enderror">
                                <option value="">Select admin (optional)</option>
                                @foreach($adminUsers as $admin)
                                    <option value="{{ $admin->id }}" {{ old('assigned_admin_id', $appointment->assigned_to) == $admin->id ? 'selected' : '' }}>
                                        {{ $admin->name }} ({{ $admin->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('assigned_admin_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Service Information Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Service Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="service_type" class="block text-sm font-medium text-gray-700">Service Type</label>
                            <input type="text" name="service_type" id="service_type" value="{{ old('service_type', $appointment->service_type) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('service_type') border-red-300 @enderror" 
                                   placeholder="e.g., Visa Consultation">
                            @error('service_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="specific_service" class="block text-sm font-medium text-gray-700">Specific Service</label>
                            <input type="text" name="specific_service" id="specific_service" value="{{ old('specific_service', $appointment->specific_service) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('specific_service') border-red-300 @enderror" 
                                   placeholder="e.g., Student Visa Application">
                            @error('specific_service')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Notes Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Notes & Comments</h3>
                    <div class="space-y-6">
                        <div>
                            <label for="enquiry_details" class="block text-sm font-medium text-gray-700">Enquiry Details *</label>
                            <textarea name="enquiry_details" id="enquiry_details" rows="4" 
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('enquiry_details') border-red-300 @enderror" 
                                      placeholder="Describe the client's enquiry and requirements..." required>{{ old('enquiry_details', $appointment->enquiry_details) }}</textarea>
                            @error('enquiry_details')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="admin_notes" class="block text-sm font-medium text-gray-700">Admin Notes</label>
                            <textarea name="admin_notes" id="admin_notes" rows="3" 
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('admin_notes') border-red-300 @enderror" 
                                      placeholder="Internal notes for this appointment...">{{ old('admin_notes', $appointment->admin_notes) }}</textarea>
                            @error('admin_notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.appointments.show', $appointment) }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                        <i class="fas fa-save mr-2"></i>Update Appointment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Set minimum date to today
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('appointment_date').setAttribute('min', today);
});
</script>
@endsection