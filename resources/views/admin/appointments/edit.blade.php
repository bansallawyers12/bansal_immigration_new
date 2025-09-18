@extends('layouts.admin')

@section('title', 'Edit Appointment')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Appointment</h1>
            <p class="text-gray-600 mt-1">Update appointment information and details</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.appointments.show', $id) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-eye mr-2"></i>View Details
            </a>
            <a href="{{ route('admin.appointments.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Back to Appointments
            </a>
        </div>
    </div>

    <!-- Edit Appointment Form -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.appointments.update', $id) }}" class="space-y-6">
                @csrf
                @method('PATCH')

                <!-- Client Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Client Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Client Name -->
                        <div>
                            <label for="client_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Client Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="client_name" id="client_name" value="{{ old('client_name', 'John Doe') }}" required
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
                            <input type="email" name="client_email" id="client_email" value="{{ old('client_email', 'john.doe@example.com') }}" required
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
                            <input type="text" name="client_phone" id="client_phone" value="{{ old('client_phone', '+1 (555) 123-4567') }}"
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
                            <input type="text" name="company_name" id="company_name" value="{{ old('company_name', 'ABC Corporation') }}"
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
                                <option value="visitor_visa" {{ old('enquiry_type', 'student_visa') === 'visitor_visa' ? 'selected' : '' }}>Visitor Visa</option>
                                <option value="student_visa" {{ old('enquiry_type', 'student_visa') === 'student_visa' ? 'selected' : '' }}>Student Visa</option>
                                <option value="skilled_migration" {{ old('enquiry_type', 'student_visa') === 'skilled_migration' ? 'selected' : '' }}>Skilled Migration</option>
                                <option value="business_visa" {{ old('enquiry_type', 'student_visa') === 'business_visa' ? 'selected' : '' }}>Business Visa</option>
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
                            <input type="date" name="appointment_date" id="appointment_date" value="{{ old('appointment_date', date('Y-m-d', strtotime('+1 day'))) }}" required
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
                            <input type="time" name="appointment_time" id="appointment_time" value="{{ old('appointment_time', '10:00') }}" required
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
                                <option value="30" {{ old('duration', '60') === '30' ? 'selected' : '' }}>30 minutes</option>
                                <option value="60" {{ old('duration', '60') === '60' ? 'selected' : '' }}>1 hour</option>
                                <option value="90" {{ old('duration', '60') === '90' ? 'selected' : '' }}>1.5 hours</option>
                                <option value="120" {{ old('duration', '60') === '120' ? 'selected' : '' }}>2 hours</option>
                            </select>
                            @error('duration')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Status & Additional Information -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Status & Additional Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror">
                                <option value="pending" {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('status', 'pending') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ old('status', 'pending') === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status', 'pending') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="no_show" {{ old('status', 'pending') === 'no_show' ? 'selected' : '' }}>No Show</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Priority -->
                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">
                                Priority
                            </label>
                            <select name="priority" id="priority"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('priority') border-red-500 @enderror">
                                <option value="normal" {{ old('priority', 'normal') === 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="high" {{ old('priority', 'normal') === 'high' ? 'selected' : '' }}>High</option>
                                <option value="urgent" {{ old('priority', 'normal') === 'urgent' ? 'selected' : '' }}>Urgent</option>
                            </select>
                            @error('priority')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mt-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Notes
                        </label>
                        <textarea name="notes" id="notes" rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('notes') border-red-500 @enderror"
                                  placeholder="Enter any additional notes or requirements...">{{ old('notes', 'Client is interested in pursuing a master\'s degree in Computer Science. They have completed their bachelor\'s degree and have 2 years of work experience. Looking for guidance on university selection and visa requirements.') }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <div class="flex items-center space-x-2">
                        <button type="button" onclick="deleteAppointment()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium">
                            <i class="fas fa-trash mr-2"></i>Delete Appointment
                        </button>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.appointments.show', $id) }}" 
                           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg font-medium">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                            <i class="fas fa-save mr-2"></i>Update Appointment
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Appointment History -->
    <div class="bg-white rounded-lg shadow mt-6">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Changes</h3>
            <div class="flow-root">
                <ul class="-mb-8">
                    <li>
                        <div class="relative pb-8">
                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                        <i class="fas fa-edit text-white text-xs"></i>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Last updated by <strong>Admin User</strong></p>
                                        <p class="text-xs text-gray-400">Changed status from Pending to Confirmed</p>
                                    </div>
                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                        2 hours ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="relative pb-8">
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                        <i class="fas fa-plus text-white text-xs"></i>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Appointment created by <strong>System</strong></p>
                                    </div>
                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                        1 day ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function deleteAppointment() {
    if (confirm('Are you sure you want to delete this appointment? This action cannot be undone.')) {
        // Create a form and submit it
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.appointments.destroy", $id) }}';
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        // Add method override
        const methodOverride = document.createElement('input');
        methodOverride.type = 'hidden';
        methodOverride.name = '_method';
        methodOverride.value = 'DELETE';
        form.appendChild(methodOverride);
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
