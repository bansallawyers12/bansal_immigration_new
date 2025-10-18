<div class="border rounded-lg p-4 {{ $setting->is_active ? 'bg-white' : 'bg-gray-50' }}">
    <div class="flex justify-between items-start mb-3">
        <div>
            <h4 class="font-semibold text-gray-900">
                {{ $setting->appointment_type_display }}
            </h4>
            <span class="text-xs {{ $setting->is_active ? 'text-green-600' : 'text-red-600' }}">
                {{ $setting->is_active ? '● Active' : '● Inactive' }}
            </span>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.calendar-settings.edit', $setting) }}" 
               class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('admin.calendar-settings.toggle', $setting) }}" 
                  method="POST" 
                  class="inline"
                  onsubmit="return confirm('Are you sure you want to {{ $setting->is_active ? 'deactivate' : 'activate' }} this setting?')">
                @csrf
                <button type="submit" 
                        class="{{ $setting->is_active ? 'text-red-600 hover:text-red-800' : 'text-green-600 hover:text-green-800' }}">
                    <i class="fas fa-power-off"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="space-y-2 text-sm">
        <div class="flex justify-between">
            <span class="text-gray-600">Time Range:</span>
            <span class="font-medium">{{ $setting->formatted_start_time }} - {{ $setting->formatted_end_time }}</span>
        </div>
        
        <div class="flex justify-between">
            <span class="text-gray-600">Slot Duration:</span>
            <span class="font-medium">{{ $setting->slot_duration_minutes }} minutes</span>
        </div>
        
        <div class="flex justify-between">
            <span class="text-gray-600">Days:</span>
            <span class="font-medium">{{ $setting->days_of_week_display }}</span>
        </div>
        
        @if($setting->lunch_break_start && $setting->lunch_break_end)
        <div class="flex justify-between">
            <span class="text-gray-600">Lunch Break:</span>
            <span class="font-medium">
                {{ Carbon\Carbon::parse($setting->lunch_break_start)->format('g:i A') }} - 
                {{ Carbon\Carbon::parse($setting->lunch_break_end)->format('g:i A') }}
            </span>
        </div>
        @endif

        @if($setting->notes)
        <div class="pt-2 border-t">
            <span class="text-gray-600 text-xs italic">{{ $setting->notes }}</span>
        </div>
        @endif
    </div>
</div>

