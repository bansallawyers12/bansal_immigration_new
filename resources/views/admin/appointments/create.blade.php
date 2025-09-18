@extends('layouts.admin')

@section('title', 'Create New Appointment')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Create New Appointment</h1>
            <p class="text-gray-600 mt-1">Schedule a new appointment for a client</p>
        </div>
        <a href="{{ route('admin.appointments.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium">
            <i class="fas fa-arrow-left mr-2"></i>Back to Appointments
        </a>
    </div>

    <!-- Create Appointment Form -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.appointments.store') }}" class="space-y-6">
                @csrf

                <!-- Client Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Client Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Client Name -->
                        <div>
                            <label for="client_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Client Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="client_name" id="client_name" value="{{ old('client_name') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('client_name') border-red-500 @enderror"
                                   placeholder="Enter client name">
                            @error('client_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Client Email -->
                        <div>
                            <label for="client_email" class="block text-sm font-medium text-gray-700 mb-2">
                                Client Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="client_email" id="client_email" value="{{ old('client_email') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('client_email') border-red-500 @enderror"
                                   placeholder="Enter client email">
                            @error('client_email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Client Phone -->
                        <div>
                            <label for="client_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Client Phone
                            </label>
                            <input type="text" name="client_phone" id="client_phone" value="{{ old('client_phone') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('client_phone') border-red-500 @enderror"
                                   placeholder="Enter client phone">
                            @error('client_phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Company Name -->
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Company Name
                            </label>
                            <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('company_name') border-red-500 @enderror"
                                   placeholder="Enter company name (optional)">
                            @error('company_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Appointment Details -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Appointment Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Enquiry Type -->
                        <div>
                            <label for="enquiry_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Enquiry Type <span class="text-red-500">*</span>
                            </label>
                            <select name="enquiry_type" id="enquiry_type" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('enquiry_type') border-red-500 @enderror">
                                <option value="">Select Enquiry Type</option>
                                <option value="visitor_visa" {{ old('enquiry_type') === 'visitor_visa' ? 'selected' : '' }}>Visitor Visa</option>
                                <option value="student_visa" {{ old('enquiry_type') === 'student_visa' ? 'selected' : '' }}>Student Visa</option>
                                <option value="skilled_migration" {{ old('enquiry_type') === 'skilled_migration' ? 'selected' : '' }}>Skilled Migration</option>
                                <option value="business_visa" {{ old('enquiry_type') === 'business_visa' ? 'selected' : '' }}>Business Visa</option>
                            </select>
                            @error('enquiry_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Appointment Date -->
                        <div>
                            <label for="appointment_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Appointment Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="appointment_date" id="appointment_date" value="{{ old('appointment_date') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('appointment_date') border-red-500 @enderror"
                                   min="{{ date('Y-m-d') }}">
                            @error('appointment_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Appointment Time -->
                        <div>
                            <label for="appointment_time" class="block text-sm font-medium text-gray-700 mb-2">
                                Appointment Time <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="appointment_time" id="appointment_time" value="{{ old('appointment_time') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('appointment_time') border-red-500 @enderror">
                            @error('appointment_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Duration -->
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">
                                Duration (minutes) <span class="text-red-500">*</span>
                            </label>
                            <select name="duration" id="duration" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('duration') border-red-500 @enderror">
                                <option value="">Select Duration</option>
                                <option value="30" {{ old('duration') === '30' ? 'selected' : '' }}>30 minutes</option>
                                <option value="60" {{ old('duration') === '60' ? 'selected' : '' }}>1 hour</option>
                                <option value="90" {{ old('duration') === '90' ? 'selected' : '' }}>1.5 hours</option>
                                <option value="120" {{ old('duration') === '120' ? 'selected' : '' }}>2 hours</option>
                            </select>
                            @error('duration')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Information</h3>
                    <div class="space-y-4">
                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                Notes
                            </label>
                            <textarea name="notes" id="notes" rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('notes') border-red-500 @enderror"
                                      placeholder="Enter any additional notes or requirements...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror">
                                <option value="pending" {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.appointments.index') }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg font-medium">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                        <i class="fas fa-save mr-2"></i>Create Appointment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
