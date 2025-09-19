@extends('layouts.admin')

@section('title', 'View Promo Code')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Promo Code Details</h1>
            <p class="text-gray-600 mt-1">View and manage promo code: {{ $promoCode->code }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.promo-codes.edit', $promoCode) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-edit mr-2"></i>Edit Promo Code
            </a>
            <a href="{{ route('admin.promo-codes.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Back to Promo Codes
            </a>
        </div>
    </div>

    <!-- Promo Code Information -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900">{{ $promoCode->code }}</h2>
                <div class="flex items-center space-x-2">
                    @php
                        $isExpired = $promoCode->valid_until && $promoCode->valid_until < now();
                        $isExhausted = $promoCode->usage_limit && $promoCode->used_count >= $promoCode->usage_limit;
                    @endphp
                    @if($isExpired)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <i class="fas fa-clock mr-1"></i>Expired
                        </span>
                    @elseif($isExhausted)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                            <i class="fas fa-ban mr-1"></i>Exhausted
                        </span>
                    @elseif($promoCode->is_active)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-1"></i>Active
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            <i class="fas fa-pause mr-1"></i>Inactive
                        </span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Basic Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Basic Information</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Code</label>
                            <p class="text-sm text-gray-900 font-mono">{{ $promoCode->code }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Description</label>
                            <p class="text-sm text-gray-900">{{ $promoCode->description ?: 'No description' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Type</label>
                            <p class="text-sm">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $promoCode->type === 'percentage' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($promoCode->type) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Discount Details -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Discount Details</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Discount Value</label>
                            <p class="text-sm text-gray-900">
                                @if($promoCode->type === 'percentage')
                                    {{ $promoCode->value }}%
                                @else
                                    ${{ number_format($promoCode->value, 2) }}
                                @endif
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Minimum Order</label>
                            <p class="text-sm text-gray-900">${{ number_format($promoCode->minimum_amount, 2) }}</p>
                        </div>
                        @if($promoCode->maximum_discount)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Maximum Discount</label>
                            <p class="text-sm text-gray-900">${{ number_format($promoCode->maximum_discount, 2) }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Usage Statistics -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Usage Statistics</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Times Used</label>
                            <p class="text-sm text-gray-900">{{ $promoCode->used_count }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Usage Limit</label>
                            <p class="text-sm text-gray-900">
                                {{ $promoCode->usage_limit ? $promoCode->usage_limit : 'Unlimited' }}
                            </p>
                        </div>
                        @if($promoCode->usage_limit)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Remaining Uses</label>
                            <p class="text-sm text-gray-900">{{ max(0, $promoCode->usage_limit - $promoCode->used_count) }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Validity Period -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Validity Period</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Valid From</label>
                    <p class="text-sm text-gray-900">
                        {{ $promoCode->valid_from ? $promoCode->valid_from->format('M d, Y g:i A') : 'Immediately' }}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Valid Until</label>
                    <p class="text-sm text-gray-900">
                        {{ $promoCode->valid_until ? $promoCode->valid_until->format('M d, Y g:i A') : 'No expiry' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Applicable Services -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Applicable Services</h3>
            @if($promoCode->applicable_enquiry_types)
                <div class="flex flex-wrap gap-2">
                    @foreach($promoCode->applicable_enquiry_types as $enquiryType)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $enquiryTypes[$enquiryType] ?? ucfirst($enquiryType) }}
                        </span>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500">Applies to all services</p>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.promo-codes.edit', $promoCode) }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-edit mr-2"></i>Edit Promo Code
                </a>
                
                <form method="POST" action="{{ route('admin.promo-codes.toggle-active', $promoCode) }}" class="inline">
                    @csrf
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 {{ $promoCode->is_active ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-lg">
                        <i class="fas fa-{{ $promoCode->is_active ? 'pause' : 'play' }} mr-2"></i>
                        {{ $promoCode->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                </form>
                
                <form method="POST" action="{{ route('admin.promo-codes.destroy', $promoCode) }}" 
                      class="inline" 
                      onsubmit="return confirm('Are you sure you want to delete this promo code? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        <i class="fas fa-trash mr-2"></i>Delete Promo Code
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
