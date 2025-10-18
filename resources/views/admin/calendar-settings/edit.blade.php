@extends('layouts.admin')

@section('title', 'Edit Calendar Setting')

@section('content')
<div class="p-6">
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.calendar-settings.index') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-2"></i>Back to Calendar Settings
            </a>
        </div>

        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b">
                <h1 class="text-2xl font-bold text-gray-900">Edit Calendar Setting</h1>
                <p class="text-gray-600 mt-1">
                    {{ $calendarSetting->calendar_name }} - {{ $calendarSetting->appointment_type_display }}
                </p>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 m-6 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.calendar-settings.update', $calendarSetting) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <!-- Time Range -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Start Time <span class="text-red-500">*</span>
                        </label>
                        <input type="time" 
                               name="start_time" 
                               value="{{ old('start_time', Carbon\Carbon::parse($calendarSetting->start_time)->format('H:i')) }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            End Time <span class="text-red-500">*</span>
                        </label>
                        <input type="time" 
                               name="end_time" 
                               value="{{ old('end_time', Carbon\Carbon::parse($calendarSetting->end_time)->format('H:i')) }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>
                </div>

                <!-- Slot Duration -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Slot Duration (minutes) <span class="text-red-500">*</span>
                    </label>
                    <select name="slot_duration_minutes" 
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="">Select Duration</option>
                        @foreach([5, 10, 15, 20, 30, 45, 60, 90, 120] as $duration)
                            <option value="{{ $duration }}" 
                                    {{ old('slot_duration_minutes', $calendarSetting->slot_duration_minutes) == $duration ? 'selected' : '' }}>
                                {{ $duration }} minutes
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Time interval between each appointment slot</p>
                </div>

                <!-- Lunch Break (Optional) -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Lunch Break (Optional)
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <input type="time" 
                                   name="lunch_break_start" 
                                   value="{{ old('lunch_break_start', $calendarSetting->lunch_break_start ? Carbon\Carbon::parse($calendarSetting->lunch_break_start)->format('H:i') : '') }}"
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                   placeholder="Start">
                        </div>
                        <div>
                            <input type="time" 
                                   name="lunch_break_end" 
                                   value="{{ old('lunch_break_end', $calendarSetting->lunch_break_end ? Carbon\Carbon::parse($calendarSetting->lunch_break_end)->format('H:i') : '') }}"
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                   placeholder="End">
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">No appointments will be available during lunch break</p>
                </div>

                <!-- Days of Week -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Available Days
                    </label>
                    <div class="flex flex-wrap gap-2">
                        @php
                            $days = [
                                1 => 'Monday',
                                2 => 'Tuesday',
                                3 => 'Wednesday',
                                4 => 'Thursday',
                                5 => 'Friday',
                                6 => 'Saturday',
                                7 => 'Sunday'
                            ];
                            $selectedDays = old('days_of_week', $calendarSetting->days_of_week ?? []);
                        @endphp
                        
                        @foreach($days as $num => $name)
                            <label class="inline-flex items-center px-4 py-2 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="checkbox" 
                                       name="days_of_week[]" 
                                       value="{{ $num }}"
                                       {{ in_array($num, $selectedDays) ? 'checked' : '' }}
                                       class="mr-2">
                                <span>{{ $name }}</span>
                            </label>
                        @endforeach
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Leave all unchecked for all days</p>
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" 
                               name="is_active" 
                               value="1"
                               {{ old('is_active', $calendarSetting->is_active) ? 'checked' : '' }}
                               class="mr-2 h-5 w-5 text-blue-600">
                        <span class="text-sm font-medium text-gray-700">Active (Enable this calendar setting)</span>
                    </label>
                </div>

                <!-- Notes -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Notes (Optional)
                    </label>
                    <textarea name="notes" 
                              rows="3"
                              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                              placeholder="Admin notes about this calendar setting">{{ old('notes', $calendarSetting->notes) }}</textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3 pt-6 border-t">
                    <a href="{{ route('admin.calendar-settings.index') }}" 
                       class="px-6 py-2 border rounded-lg hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-save mr-2"></i>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

