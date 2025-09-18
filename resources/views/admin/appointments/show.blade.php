@extends('layouts.admin')

@section('title', 'View Appointment')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Appointment Details</h1>
            <p class="text-gray-600 mt-1">View appointment information and manage status</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.appointments.edit', $id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-edit mr-2"></i>Edit Appointment
            </a>
            <a href="{{ route('admin.appointments.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Back to Appointments
            </a>
        </div>
    </div>

    <!-- Appointment Information Card -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900">Appointment #{{ $id }}</h2>
                <div class="flex items-center space-x-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock mr-1"></i>Pending
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Client Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Client Information</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Name</label>
                            <p class="text-sm text-gray-900">John Doe</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="text-sm text-gray-900">john.doe@example.com</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Phone</label>
                            <p class="text-sm text-gray-900">+1 (555) 123-4567</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Company</label>
                            <p class="text-sm text-gray-900">ABC Corporation</p>
                        </div>
                    </div>
                </div>

                <!-- Appointment Details -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Appointment Details</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Enquiry Type</label>
                            <p class="text-sm text-gray-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Student Visa
                                </span>
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Date & Time</label>
                            <p class="text-sm text-gray-900">
                                <i class="fas fa-calendar mr-2 text-gray-400"></i>
                                {{ date('F d, Y') }} at {{ date('g:i A') }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Duration</label>
                            <p class="text-sm text-gray-900">
                                <i class="fas fa-clock mr-2 text-gray-400"></i>
                                1 hour
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Created</label>
                            <p class="text-sm text-gray-900">{{ date('M d, Y g:i A') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Status & Actions -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Status & Actions</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Current Status</label>
                            <p class="text-sm">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i>Pending Confirmation
                                </span>
                            </p>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-500">Quick Actions</label>
                            <div class="flex flex-col space-y-2">
                                <form method="POST" action="{{ route('admin.appointments.confirm', $id) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm font-medium">
                                        <i class="fas fa-check mr-2"></i>Confirm Appointment
                                    </button>
                                </form>
                                <button onclick="cancelAppointment()" class="w-full bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm font-medium">
                                    <i class="fas fa-times mr-2"></i>Cancel Appointment
                                </button>
                                <a href="{{ route('admin.appointments.edit', $id) }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium text-center">
                                    <i class="fas fa-edit mr-2"></i>Edit Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notes Section -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Notes & Comments</h3>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-700">
                    Client is interested in pursuing a master's degree in Computer Science. They have completed their bachelor's degree and have 2 years of work experience. Looking for guidance on university selection and visa requirements.
                </p>
            </div>
        </div>
    </div>

    <!-- Appointment History -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Appointment History</h3>
            <div class="flow-root">
                <ul class="-mb-8">
                    <li>
                        <div class="relative pb-8">
                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                        <i class="fas fa-plus text-white text-xs"></i>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Appointment created by <strong>Admin User</strong></p>
                                    </div>
                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                        {{ date('M d, Y g:i A') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="relative pb-8">
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-yellow-500 flex items-center justify-center ring-8 ring-white">
                                        <i class="fas fa-clock text-white text-xs"></i>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Status changed to <strong>Pending</strong></p>
                                    </div>
                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                        {{ date('M d, Y g:i A') }}
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
function cancelAppointment() {
    if (confirm('Are you sure you want to cancel this appointment? This action cannot be undone.')) {
        // Add your cancel appointment logic here
        alert('Appointment cancellation functionality would be implemented here.');
    }
}
</script>
@endsection
