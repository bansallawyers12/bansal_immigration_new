@extends('layouts.admin')

@section('title', 'Edit Promo Code')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Promo Code</h1>
            <p class="text-gray-600 mt-1">Update promo code: {{ $promoCode->code }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.promo-codes.show', $promoCode) }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-eye mr-2"></i>View Promo Code
            </a>
            <a href="{{ route('admin.promo-codes.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Back to Promo Codes
            </a>
        </div>
    </div>

    <!-- Edit Promo Code Form -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.promo-codes.update', $promoCode) }}" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Basic Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700">Promo Code *</label>
                            <div class="mt-1 flex space-x-2">
                                <input type="text" name="code" id="code" value="{{ old('code', $promoCode->code) }}" 
                                       class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('code') border-red-300 @enderror" 
                                       required placeholder="e.g., SAVE20">
                                <button type="button" id="generate_code" 
                                        class="px-3 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                                    <i class="fas fa-dice mr-1"></i>Generate
                                </button>
                            </div>
                            @error('code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <input type="text" name="description" id="description" value="{{ old('description', $promoCode->description) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-300 @enderror" 
                                   placeholder="e.g., 20% off all consultations">
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Discount Configuration -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Discount Configuration</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Discount Type *</label>
                            <select name="type" id="type" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('type') border-red-300 @enderror" 
                                    required onchange="updateValueLabel()">
                                <option value="">Select discount type</option>
                                <option value="percentage" {{ old('type', $promoCode->type) == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                <option value="fixed" {{ old('type', $promoCode->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="value" id="value_label" class="block text-sm font-medium text-gray-700">Discount Value *</label>
                            <div class="mt-1 relative">
                                <input type="number" name="value" id="value" value="{{ old('value', $promoCode->value) }}" 
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('value') border-red-300 @enderror" 
                                       required min="0" step="0.01" placeholder="0">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span id="value_suffix" class="text-gray-500 sm:text-sm">%</span>
                                </div>
                            </div>
                            @error('value')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="minimum_amount" class="block text-sm font-medium text-gray-700">Minimum Order Amount *</label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" name="minimum_amount" id="minimum_amount" value="{{ old('minimum_amount', $promoCode->minimum_amount) }}" 
                                       class="pl-7 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('minimum_amount') border-red-300 @enderror" 
                                       required min="0" step="0.01">
                            </div>
                            @error('minimum_amount')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="maximum_discount" class="block text-sm font-medium text-gray-700">Maximum Discount</label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" name="maximum_discount" id="maximum_discount" value="{{ old('maximum_discount', $promoCode->maximum_discount) }}" 
                                       class="pl-7 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('maximum_discount') border-red-300 @enderror" 
                                       min="0" step="0.01" placeholder="No limit">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Leave empty for no limit (percentage codes only)</p>
                            @error('maximum_discount')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Usage Limits -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Usage Limits</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="usage_limit" class="block text-sm font-medium text-gray-700">Usage Limit</label>
                            <input type="number" name="usage_limit" id="usage_limit" value="{{ old('usage_limit', $promoCode->usage_limit) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('usage_limit') border-red-300 @enderror" 
                                   min="1" placeholder="Unlimited">
                            <p class="mt-1 text-sm text-gray-500">Leave empty for unlimited usage</p>
                            @error('usage_limit')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="is_active" class="block text-sm font-medium text-gray-700">Status</label>
                            <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="is_active" value="1" 
                                           {{ old('is_active', $promoCode->is_active) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700">Active (can be used immediately)</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label for="is_one_time_use" class="block text-sm font-medium text-gray-700">Usage Type</label>
                            <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="is_one_time_use" value="1" 
                                           {{ old('is_one_time_use', $promoCode->is_one_time_use) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700">One-time use only (each user can use once)</span>
                                </label>
                                <p class="mt-1 text-xs text-gray-500">If unchecked, users can use this code multiple times (up to usage limit)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Validity Period -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Validity Period</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="valid_from" class="block text-sm font-medium text-gray-700">Valid From</label>
                            <input type="datetime-local" name="valid_from" id="valid_from" 
                                   value="{{ old('valid_from', $promoCode->valid_from ? $promoCode->valid_from->format('Y-m-d\TH:i') : '') }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('valid_from') border-red-300 @enderror">
                            <p class="mt-1 text-sm text-gray-500">Leave empty to start immediately</p>
                            @error('valid_from')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="valid_until" class="block text-sm font-medium text-gray-700">Valid Until</label>
                            <input type="datetime-local" name="valid_until" id="valid_until" 
                                   value="{{ old('valid_until', $promoCode->valid_until ? $promoCode->valid_until->format('Y-m-d\TH:i') : '') }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('valid_until') border-red-300 @enderror">
                            <p class="mt-1 text-sm text-gray-500">Leave empty for no expiry</p>
                            @error('valid_until')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Applicable Services -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Applicable Services</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select which services this code applies to</label>
                        <div class="space-y-2">
                            @foreach($enquiryTypes as $key => $label)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="applicable_enquiry_types[]" value="{{ $key }}" 
                                       {{ in_array($key, old('applicable_enquiry_types', $promoCode->applicable_enquiry_types ?? [])) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Leave all unchecked to apply to all services</p>
                    </div>
                </div>

                <!-- Test Calculator -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Test Calculator</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="test_amount" class="block text-sm font-medium text-gray-700">Test Amount</label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" id="test_amount" 
                                       class="pl-7 w-full border-gray-300 rounded-md shadow-sm" 
                                       min="0" step="0.01" placeholder="100.00">
                            </div>
                        </div>
                        <div>
                            <label for="test_enquiry_type" class="block text-sm font-medium text-gray-700">Service Type</label>
                            <select id="test_enquiry_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @foreach($enquiryTypes as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="button" id="test_calculation" 
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                                <i class="fas fa-calculator mr-2"></i>Test
                            </button>
                        </div>
                    </div>
                    <div id="test_result" class="mt-4 hidden">
                        <div class="bg-white rounded-lg p-4 border">
                            <h4 class="font-medium text-gray-900 mb-2">Calculation Result:</h4>
                            <div id="test_result_content"></div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.promo-codes.show', $promoCode) }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-medium">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                        <i class="fas fa-save mr-2"></i>Update Promo Code
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const valueLabel = document.getElementById('value_label');
    const valueSuffix = document.getElementById('value_suffix');
    const valueInput = document.getElementById('value');
    const generateCodeBtn = document.getElementById('generate_code');
    const codeInput = document.getElementById('code');
    const testBtn = document.getElementById('test_calculation');
    const testResult = document.getElementById('test_result');
    const testResultContent = document.getElementById('test_result_content');

    // Update value label based on type
    function updateValueLabel() {
        const type = typeSelect.value;
        if (type === 'percentage') {
            valueLabel.textContent = 'Discount Percentage (%)';
            valueSuffix.textContent = '%';
            valueInput.max = 100;
            valueInput.placeholder = '10';
        } else if (type === 'fixed') {
            valueLabel.textContent = 'Discount Amount ($)';
            valueSuffix.textContent = '$';
            valueInput.removeAttribute('max');
            valueInput.placeholder = '25.00';
        }
    }

    // Generate random code
    generateCodeBtn.addEventListener('click', function() {
        fetch('{{ route("admin.promo-codes.generate-code") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                length: 8,
                prefix: ''
            })
        })
        .then(response => response.json())
        .then(data => {
            codeInput.value = data.code;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    // Test calculation
    testBtn.addEventListener('click', function() {
        const type = typeSelect.value;
        const value = valueInput.value;
        const minimumAmount = document.getElementById('minimum_amount').value;
        const maximumDiscount = document.getElementById('maximum_discount').value;
        const testAmount = document.getElementById('test_amount').value;
        const testEnquiryType = document.getElementById('test_enquiry_type').value;

        if (!type || !value || !testAmount) {
            alert('Please fill in the required fields to test calculation.');
            return;
        }

        fetch('{{ route("admin.promo-codes.test-calculation") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                type: type,
                value: value,
                minimum_amount: minimumAmount,
                maximum_discount: maximumDiscount,
                test_amount: testAmount,
                enquiry_type: testEnquiryType
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                testResultContent.innerHTML = '<p class="text-red-600">' + data.error + '</p>';
            } else {
                testResultContent.innerHTML = `
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>Original Amount:</span>
                            <span class="font-medium">$${data.original_amount}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Discount Amount:</span>
                            <span class="font-medium text-green-600">$${data.discount_amount}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Final Amount:</span>
                            <span class="font-medium text-blue-600">$${data.final_amount}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Discount Percentage:</span>
                            <span class="font-medium">${data.discount_percentage}%</span>
                        </div>
                    </div>
                `;
            }
            testResult.classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            testResultContent.innerHTML = '<p class="text-red-600">Error testing calculation.</p>';
            testResult.classList.remove('hidden');
        });
    });

    // Initialize
    updateValueLabel();
});
</script>
@endsection
