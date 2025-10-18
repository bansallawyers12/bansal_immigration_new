@extends('layouts.admin')

@section('title', 'Calendar Timing Settings')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Calendar Timing Settings</h1>
        <p class="text-gray-600 mt-1">Configure timing settings for all 5 calendars (1 Adelaide + 4 Melbourne)</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- ADELAIDE CALENDAR -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="bg-red-600 text-white px-6 py-4 rounded-t-lg">
            <h2 class="text-xl font-semibold flex items-center">
                <i class="fas fa-calendar mr-2"></i>
                Adelaide Office (Unified Calendar)
            </h2>
            <p class="text-red-100 text-sm mt-1">Single calendar for all enquiry types</p>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($adelaideSettings as $setting)
                    @include('admin.calendar-settings.partials.setting-card', ['setting' => $setting])
                @endforeach
            </div>
        </div>
    </div>

    <!-- MELBOURNE CALENDARS -->
    <div class="bg-white rounded-lg shadow">
        <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg">
            <h2 class="text-xl font-semibold flex items-center">
                <i class="fas fa-calendar mr-2"></i>
                Melbourne Office (4 Separate Calendars)
            </h2>
            <p class="text-blue-100 text-sm mt-1">Different calendars based on enquiry types</p>
        </div>

        <div class="p-6">
            @foreach($melbourneSettings as $enquiryType => $settings)
                <div class="mb-8 last:mb-0">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">
                        {{ $enquiryTypes[$enquiryType] ?? ucfirst($enquiryType) }}
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($settings as $setting)
                            @include('admin.calendar-settings.partials.setting-card', ['setting' => $setting])
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Info Box -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-600 text-xl"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">How it works</h3>
                <div class="mt-2 text-sm text-blue-700">
                    <ul class="list-disc list-inside space-y-1">
                        <li>Each calendar has separate settings for <strong>Free</strong> and <strong>Paid</strong> appointments</li>
                        <li>You can set different time ranges and slot durations for each type</li>
                        <li>These settings are automatically used when customers book appointments</li>
                        <li>Deactivating a setting will disable that appointment type for that calendar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

