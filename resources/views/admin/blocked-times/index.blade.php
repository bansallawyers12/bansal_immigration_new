@extends('layouts.admin')

@section('title', 'Blocked Times Management')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Blocked Times Management</h1>
            <p class="text-gray-600 mt-1">Block specific times and manage calendar availability</p>
        </div>
        <a href="{{ route('admin.blocked-times.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Block Time
        </a>
    </div>

    <!-- Filter Options -->
    <div class="bg-white rounded-lg shadow mb-6 p-4">
        <div class="flex flex-wrap gap-2">
            <span class="text-sm font-medium text-gray-700 mr-4">Filter by Status:</span>
            <a href="{{ route('admin.blocked-times.index') }}" 
               class="px-3 py-1 rounded-full text-xs font-medium {{ !request('is_active') ? 'bg-gray-800 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                All
            </a>
            <a href="{{ route('admin.blocked-times.index', ['is_active' => '1']) }}" 
               class="px-3 py-1 rounded-full text-xs font-medium {{ request('is_active') == '1' ? 'bg-green-600 text-white' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                Active
            </a>
            <a href="{{ route('admin.blocked-times.index', ['is_active' => '0']) }}" 
               class="px-3 py-1 rounded-full text-xs font-medium {{ request('is_active') == '0' ? 'bg-gray-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Inactive
            </a>
        </div>
    </div>

    <!-- Blocked Times Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            @if($blockedTimes->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Title</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Date & Time</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Type</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Affects</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blockedTimes as $blockedTime)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $blockedTime->title }}</div>
                                        @if($blockedTime->description)
                                            <div class="text-sm text-gray-500">{{ Str::limit($blockedTime->description, 50) }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-900">{{ $blockedTime->blocked_date->format('M d, Y') }}</div>
                                        @if($blockedTime->is_all_day)
                                            <div class="text-gray-500">All Day</div>
                                        @else
                                            <div class="text-gray-500">{{ $blockedTime->start_time }} - {{ $blockedTime->end_time }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                          style="background-color: {{ $blockedTime->block_type_color }}20; color: {{ $blockedTime->block_type_color }}">
                                        {{ $blockedTime->block_type_display }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    @if(empty($blockedTime->blocked_enquiry_types))
                                        <span class="text-xs text-gray-500">All Types</span>
                                    @else
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($blockedTime->blocked_enquiry_types as $type)
                                                <span class="inline-block px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded">
                                                    {{ $enquiryTypes[$type] ?? $type }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    @if($blockedTime->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.blocked-times.show', $blockedTime) }}" 
                                           class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.blocked-times.edit', $blockedTime) }}" 
                                           class="text-green-600 hover:text-green-800">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="toggleActive({{ $blockedTime->id }})" 
                                                class="text-yellow-600 hover:text-yellow-800">
                                            <i class="fas fa-toggle-{{ $blockedTime->is_active ? 'on' : 'off' }}"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $blockedTimes->links() }}
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-calendar-times text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No blocked times found</h3>
                    <p class="text-gray-500 mb-4">Create blocked times to prevent appointments during specific periods.</p>
                    <a href="{{ route('admin.blocked-times.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        <i class="fas fa-plus mr-2"></i>
                        Block Time
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function toggleActive(id) {
    if (confirm('Are you sure you want to toggle the active status?')) {
        fetch(`/admin/blocked-times/${id}/toggle-active`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to update status');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred');
        });
    }
}
</script>
@endsection
