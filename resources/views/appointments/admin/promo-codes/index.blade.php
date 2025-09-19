@extends('layouts.admin')

@section('title', 'Promo Codes Management')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Promo Codes Management</h1>
            <p class="text-gray-600 mt-1">Create and manage discount codes for appointments</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.promo-codes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-plus mr-2"></i>Create Promo Code
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow mb-6 p-4">
        <form method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-64">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Search by code..." 
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <select name="status" class="border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
            </div>
            <div>
                <select name="type" class="border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Types</option>
                    <option value="percentage" {{ request('type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                    <option value="fixed" {{ request('type') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                </select>
            </div>
            <div>
                <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
            </div>
            @if(request()->hasAny(['search', 'status', 'type']))
            <div>
                <a href="{{ route('admin.promo-codes.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                    <i class="fas fa-times mr-2"></i>Clear
                </a>
            </div>
            @endif
        </form>
    </div>

    <!-- Promo Codes Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            @if($promoCodes->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Code</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Type</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Value</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Usage</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Valid Until</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($promoCodes as $promoCode)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $promoCode->code }}</div>
                                        @if($promoCode->description)
                                        <div class="text-sm text-gray-500">{{ Str::limit($promoCode->description, 50) }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $promoCode->type === 'percentage' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($promoCode->type) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="text-sm">
                                        @if($promoCode->type === 'percentage')
                                            {{ $promoCode->value }}%
                                        @else
                                            ${{ number_format($promoCode->value, 2) }}
                                        @endif
                                        @if($promoCode->maximum_discount)
                                        <div class="text-xs text-gray-500">Max: ${{ number_format($promoCode->maximum_discount, 2) }}</div>
                                        @endif
                                        @if($promoCode->is_one_time_use)
                                        <div class="text-xs text-orange-600 font-medium">One-time use</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="text-sm">
                                        <div class="font-medium">{{ $promoCode->used_count }}</div>
                                        @if($promoCode->usage_limit)
                                        <div class="text-gray-500">of {{ $promoCode->usage_limit }}</div>
                                        @else
                                        <div class="text-gray-500">unlimited</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    @php
                                        $isExpired = $promoCode->valid_until && $promoCode->valid_until < now();
                                        $isExhausted = $promoCode->usage_limit && $promoCode->used_count >= $promoCode->usage_limit;
                                    @endphp
                                    @if($isExpired)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-clock mr-1"></i>Expired
                                        </span>
                                    @elseif($isExhausted)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            <i class="fas fa-ban mr-1"></i>Exhausted
                                        </span>
                                    @elseif($promoCode->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check mr-1"></i>Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <i class="fas fa-pause mr-1"></i>Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <div class="text-sm">
                                        @if($promoCode->valid_until)
                                            {{ $promoCode->valid_until->format('M d, Y') }}
                                        @else
                                            <span class="text-gray-500">No expiry</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.promo-codes.show', $promoCode) }}" 
                                           class="text-blue-600 hover:text-blue-800" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.promo-codes.edit', $promoCode) }}" 
                                           class="text-green-600 hover:text-green-800" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.promo-codes.toggle-active', $promoCode) }}" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="text-{{ $promoCode->is_active ? 'yellow' : 'green' }}-600 hover:text-{{ $promoCode->is_active ? 'yellow' : 'green' }}-800"
                                                    title="{{ $promoCode->is_active ? 'Deactivate' : 'Activate' }}">
                                                <i class="fas fa-{{ $promoCode->is_active ? 'pause' : 'play' }}"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.promo-codes.destroy', $promoCode) }}" 
                                              class="inline" 
                                              onsubmit="return confirm('Are you sure you want to delete this promo code?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $promoCodes->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-tags text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No promo codes found</h3>
                    <p class="text-gray-500 mb-4">Get started by creating your first promo code.</p>
                    <a href="{{ route('admin.promo-codes.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>
                        Create Promo Code
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
