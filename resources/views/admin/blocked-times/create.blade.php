@extends('layouts.admin')

@section('title', 'Create Blocked Time')

@section('content')
<div class="p-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Create Blocked Time</h1>
            <a href="{{ route('admin.blocked-times.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Back to List
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
                <div class="flex">
                    <div class="text-red-400">⚠️</div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">There were some problems with your input.</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white shadow rounded-lg">
            <form method="POST" action="{{ route('admin.blocked-times.store') }}" class="p-6 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required>
                    </div>


                    <!-- Blocked Date -->
                    <div>
                        <label for="blocked_date" class="block text-sm font-medium text-gray-700 mb-2">Date *</label>
                        <input type="date" name="blocked_date" id="blocked_date" value="{{ old('blocked_date', today()->format('Y-m-d')) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required>
                    </div>

                    <!-- Block Type -->
                    <div>
                        <label for="block_type" class="block text-sm font-medium text-gray-700 mb-2">Block Type *</label>
                        <select name="block_type" id="block_type" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                required>
                            @foreach($blockTypes as $key => $label)
                                <option value="{{ $key }}" {{ old('block_type') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- All Day Toggle -->
                    <div class="md:col-span-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_all_day" id="is_all_day" value="1" 
                                   {{ old('is_all_day') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <span class="ml-2 text-sm text-gray-700">All Day Block</span>
                        </label>
                    </div>

                    <!-- Time Fields -->
                    <div id="time-fields" class="grid grid-cols-2 gap-4 md:col-span-2">
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">Start Time</label>
                            <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">End Time</label>
                            <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <!-- Recurrence Type -->
                    <div>
                        <label for="recurrence_type" class="block text-sm font-medium text-gray-700 mb-2">Recurrence</label>
                        <select name="recurrence_type" id="recurrence_type" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @foreach($recurrenceTypes as $key => $label)
                                <option value="{{ $key }}" {{ old('recurrence_type', 'none') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Recurrence End Date -->
                    <div id="recurrence-end-field">
                        <label for="recurrence_end_date" class="block text-sm font-medium text-gray-700 mb-2">Recurrence End Date</label>
                        <input type="date" name="recurrence_end_date" id="recurrence_end_date" value="{{ old('recurrence_end_date') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Blocked Locations -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Block Specific Locations (leave empty to block all locations)</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="flex items-center">
                                <input type="checkbox" name="blocked_locations[]" value="melbourne" 
                                       {{ in_array('melbourne', old('blocked_locations', [])) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                                <span class="ml-2 text-sm text-gray-700">Melbourne Office</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="blocked_locations[]" value="adelaide" 
                                       {{ in_array('adelaide', old('blocked_locations', [])) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                                <span class="ml-2 text-sm text-gray-700">Adelaide Office</span>
                            </label>
                        </div>
                    </div>

                    <!-- Blocked Enquiry Types -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Block Specific Calendar Types (leave empty to block all)</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @foreach($enquiryTypes as $key => $label)
                                <label class="flex items-center">
                                    <input type="checkbox" name="blocked_enquiry_types[]" value="{{ $key }}" 
                                           {{ in_array($key, old('blocked_enquiry_types', [])) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                                    <span class="ml-2 text-sm text-gray-700">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Active Status -->
                    <div class="md:col-span-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" 
                                   {{ old('is_active', true) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-6 border-t">
                    <a href="{{ route('admin.blocked-times.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                        Create Blocked Time
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const allDayCheckbox = document.getElementById('is_all_day');
    const timeFields = document.getElementById('time-fields');
    const recurrenceType = document.getElementById('recurrence_type');
    const recurrenceEndField = document.getElementById('recurrence-end-field');

    // Toggle time fields based on all-day checkbox
    function toggleTimeFields() {
        if (allDayCheckbox.checked) {
            timeFields.style.display = 'none';
        } else {
            timeFields.style.display = 'grid';
        }
    }

    // Toggle recurrence end date based on recurrence type
    function toggleRecurrenceEnd() {
        if (recurrenceType.value === 'none') {
            recurrenceEndField.style.display = 'none';
        } else {
            recurrenceEndField.style.display = 'block';
        }
    }

    allDayCheckbox.addEventListener('change', toggleTimeFields);
    recurrenceType.addEventListener('change', toggleRecurrenceEnd);

    // Initial state
    toggleTimeFields();
    toggleRecurrenceEnd();
});
</script>
@endsection
