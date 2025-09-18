@extends('layouts.admin')

@section('title', 'Appointments Management')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Appointments Management</h1>
            <p class="text-gray-600 mt-1">Manage appointments across 4 different calendar types</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.appointments.calendar-view') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-calendar mr-2"></i>
                Daily View
            </a>
            <a href="{{ route('admin.appointments.weekly-calendar') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-calendar-week mr-2"></i>
                Weekly View
            </a>
            <a href="{{ route('admin.appointments.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i>
                New Appointment
            </a>
        </div>
    </div>

    <!-- Calendar Type Filter -->
    <div class="bg-white rounded-lg shadow mb-6 p-4">
        <div class="flex flex-wrap gap-2">
            <span class="text-sm font-medium text-gray-700 mr-4">Filter by Calendar Type:</span>
            <a href="{{ route('admin.appointments.index') }}" 
               class="px-3 py-1 rounded-full text-xs font-medium {{ !request('enquiry_type') ? 'bg-gray-800 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                All Types
            </a>
            <a href="{{ route('admin.appointments.index', ['enquiry_type' => 'tr']) }}" 
               class="px-3 py-1 rounded-full text-xs font-medium {{ request('enquiry_type') == 'tr' ? 'bg-blue-600 text-white' : 'bg-blue-100 text-blue-700 hover:bg-blue-200' }}">
                TR (TRand JRP)
            </a>
            <a href="{{ route('admin.appointments.index', ['enquiry_type' => 'tourist']) }}" 
               class="px-3 py-1 rounded-full text-xs font-medium {{ request('enquiry_type') == 'tourist' ? 'bg-green-600 text-white' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                Tourist Visa
            </a>
            <a href="{{ route('admin.appointments.index', ['enquiry_type' => 'education']) }}" 
               class="px-3 py-1 rounded-full text-xs font-medium {{ request('enquiry_type') == 'education' ? 'bg-yellow-600 text-white' : 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' }}">
                Education
            </a>
            <a href="{{ route('admin.appointments.index', ['enquiry_type' => 'pr_complex']) }}" 
               class="px-3 py-1 rounded-full text-xs font-medium {{ request('enquiry_type') == 'pr_complex' ? 'bg-purple-600 text-white' : 'bg-purple-100 text-purple-700 hover:bg-purple-200' }}">
                PR/Complex
            </a>
        </div>
    </div>

    <!-- Appointments Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            @if($appointments->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Client</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Date & Time</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Type</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $appointment->full_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $appointment->email }}</div>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-900">{{ $appointment->appointment_date->format('M d, Y') }}</div>
                                        <div class="text-gray-500">{{ $appointment->appointment_time->format('g:i A') }}</div>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                          style="background-color: {{ $appointment->calendar_color }}20; color: {{ $appointment->calendar_color }}">
                                        {{ $appointment->enquiry_type_display }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                               bg-{{ $appointment->status_display['color'] }}-100 text-{{ $appointment->status_display['color'] }}-800">
                                        {{ $appointment->status_display['name'] }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.appointments.show', $appointment) }}" 
                                           class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.appointments.edit', $appointment) }}" 
                                           class="text-green-600 hover:text-green-800">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $appointments->links() }}
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-calendar-check text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No appointments found</h3>
                    <p class="text-gray-500 mb-4">Get started by creating your first appointment.</p>
                    <a href="{{ route('admin.appointments.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>
                        Create Appointment
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
