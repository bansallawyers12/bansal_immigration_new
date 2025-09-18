@extends('layouts.admin')

@section('title', 'Blocked Time Details')

@section('content')
<div class="p-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Blocked Time Details</h1>
            <div class="flex space-x-3">
                <a href="{{ route('admin.blocked-times.edit', $blockedTime) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Edit
                </a>
                <a href="{{ route('admin.blocked-times.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Back to List
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-md p-4 mb-6">
                <div class="flex">
                    <div class="text-green-400">✅</div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white shadow rounded-lg">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <p class="text-lg font-semibold text-gray-900">{{ $blockedTime->title }}</p>
                    </div>


                    <!-- Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <p class="text-gray-900">{{ $blockedTime->blocked_date->format('F j, Y') }}</p>
                    </div>

                    <!-- Block Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Block Type</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($blockedTime->block_type === 'unavailable') bg-red-100 text-red-800
                            @elseif($blockedTime->block_type === 'busy') bg-yellow-100 text-yellow-800
                            @elseif($blockedTime->block_type === 'holiday') bg-green-100 text-green-800
                            @elseif($blockedTime->block_type === 'maintenance') bg-gray-100 text-gray-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $blockedTime->block_type_display }}
                        </span>
                    </div>

                    <!-- Time -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                        @if($blockedTime->is_all_day)
                            <p class="text-gray-900">All Day</p>
                        @else
                            <p class="text-gray-900">
                                {{ $blockedTime->start_time ? \Carbon\Carbon::parse($blockedTime->start_time)->format('g:i A') : 'N/A' }} - 
                                {{ $blockedTime->end_time ? \Carbon\Carbon::parse($blockedTime->end_time)->format('g:i A') : 'N/A' }}
                            </p>
                        @endif
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $blockedTime->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $blockedTime->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    <!-- Recurrence -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Recurrence</label>
                        <p class="text-gray-900">
                            {{ ucfirst(str_replace('_', ' ', $blockedTime->recurrence_type)) }}
                            @if($blockedTime->recurrence_type !== 'none' && $blockedTime->recurrence_end_date)
                                <span class="text-sm text-gray-600">
                                    (until {{ $blockedTime->recurrence_end_date->format('M j, Y') }})
                                </span>
                            @endif
                        </p>
                    </div>

                    <!-- Blocked Calendar Types -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Blocked Calendar Types</label>
                        @if(empty($blockedTime->blocked_enquiry_types))
                            <p class="text-gray-900">All Types</p>
                        @else
                            <div class="flex flex-wrap gap-1">
                                @php
                                    $enquiryLabels = [
                                        'tr' => 'TR (TRand JRP)',
                                        'tourist' => 'Tourist Visa',
                                        'education' => 'Education',
                                        'pr_complex' => 'PR/Complex'
                                    ];
                                @endphp
                                @foreach($blockedTime->blocked_enquiry_types as $type)
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $enquiryLabels[$type] ?? ucfirst($type) }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Created By -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Created By</label>
                        <p class="text-gray-900">{{ $blockedTime->creator->name ?? 'Unknown' }}</p>
                    </div>

                    <!-- Created At -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Created At</label>
                        <p class="text-gray-900">{{ $blockedTime->created_at->format('M j, Y g:i A') }}</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 mt-6 border-t">
                    <form method="POST" action="{{ route('admin.blocked-times.destroy', $blockedTime) }}" 
                          onsubmit="return confirm('Are you sure you want to delete this blocked time?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                            Delete
                        </button>
                    </form>
                    
                    <button onclick="toggleActive({{ $blockedTime->id }})" 
                            class="bg-{{ $blockedTime->is_active ? 'orange' : 'green' }}-600 hover:bg-{{ $blockedTime->is_active ? 'orange' : 'green' }}-700 text-white px-4 py-2 rounded">
                        {{ $blockedTime->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleActive(id) {
    fetch(`/admin/blocked-times/${id}/toggle-active`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the status.');
    });
}
</script>
@endsection
