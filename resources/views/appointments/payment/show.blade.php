@extends('layouts.app')

@section('title', 'Payment - ' . $appointment->enquiry_type_display . ' Consultation')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Complete Your Payment</h1>
            <p class="mt-2 text-gray-600">Secure payment for your immigration consultation</p>
        </div>

        <!-- Appointment Summary -->
        <div class="bg-white rounded-lg shadow-md mb-6">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Appointment Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Client Name</p>
                        <p class="font-medium text-gray-900">{{ $appointment->full_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium text-gray-900">{{ $appointment->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Consultation Type</p>
                        <p class="font-medium text-gray-900">{{ $appointment->enquiry_type_display }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Date & Time</p>
                        <p class="font-medium text-gray-900">
                            {{ $appointment->appointment_datetime->format('M d, Y g:i A') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Form -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Payment Information</h2>
                
                <!-- Pricing Display -->
                <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-medium text-gray-900">{{ $appointment->enquiry_type_display }} Consultation</span>
                        <span class="text-2xl font-bold text-blue-600">${{ number_format($baseAmount, 2) }}</span>
                    </div>
                </div>

                <!-- Promo Code Section -->
                <div class="mb-6">
                    <label for="promo_code" class="block text-sm font-medium text-gray-700 mb-2">
                        Promo Code (Optional)
                    </label>
                    <div class="flex space-x-2">
                        <input type="text" 
                               id="promo_code" 
                               name="promo_code"
                               class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Enter promo code">
                        <button type="button" 
                                id="validate_promo"
                                class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Apply
                        </button>
                    </div>
                    <div id="promo_message" class="mt-2 text-sm hidden"></div>
                </div>

                <!-- Final Amount Display -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <div class="flex justify-between items-center text-lg font-semibold">
                        <span>Total Amount</span>
                        <span id="final_amount" class="text-green-600">${{ number_format($baseAmount, 2) }}</span>
                    </div>
                    <div id="discount_display" class="text-sm text-gray-600 mt-1 hidden">
                        <span id="discount_text"></span>
                    </div>
                </div>

                <!-- Payment Button -->
                <div class="text-center">
                    <button id="pay_button" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-200">
                        <i class="fas fa-credit-card mr-2"></i>
                        Pay ${{ number_format($baseAmount, 2) }}
                    </button>
                    <p class="mt-2 text-xs text-gray-500">
                        <i class="fas fa-lock mr-1"></i>
                        Secure payment powered by Stripe
                    </p>
                </div>

                <!-- Cancel Link -->
                <div class="text-center mt-4">
                    <a href="{{ route('appointment') }}" 
                       class="text-gray-500 hover:text-gray-700 text-sm">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Back to booking
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const promoCodeInput = document.getElementById('promo_code');
    const validatePromoBtn = document.getElementById('validate_promo');
    const promoMessage = document.getElementById('promo_message');
    const finalAmountSpan = document.getElementById('final_amount');
    const discountDisplay = document.getElementById('discount_display');
    const discountText = document.getElementById('discount_text');
    const payButton = document.getElementById('pay_button');
    
    let currentPromoCode = '';
    let currentFinalAmount = {{ $baseAmount }};
    let currentDiscountAmount = 0;

    validatePromoBtn.addEventListener('click', function() {
        const promoCode = promoCodeInput.value.trim();
        
        if (!promoCode) {
            showPromoMessage('Please enter a promo code.', 'error');
            return;
        }

        // Show loading state
        validatePromoBtn.disabled = true;
        validatePromoBtn.textContent = 'Validating...';

        fetch('{{ route("payments.validate-promo") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                promo_code: promoCode,
                enquiry_type: '{{ $appointment->enquiry_type }}',
                amount: {{ $baseAmount }}
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                currentPromoCode = promoCode;
                currentFinalAmount = data.final_amount;
                currentDiscountAmount = data.discount_amount;
                
                updateAmountDisplay();
                showPromoMessage(data.message, 'success');
                
                if (data.is_free) {
                    payButton.innerHTML = '<i class="fas fa-gift mr-2"></i>Complete Free Booking';
                    payButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                    payButton.classList.add('bg-green-600', 'hover:bg-green-700');
                }
            } else {
                showPromoMessage(data.message, 'error');
                resetPromoCode();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showPromoMessage('Error validating promo code. Please try again.', 'error');
        })
        .finally(() => {
            validatePromoBtn.disabled = false;
            validatePromoBtn.textContent = 'Apply';
        });
    });

    payButton.addEventListener('click', function() {
        // Show loading state
        payButton.disabled = true;
        payButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';

        fetch('{{ route("payments.process", $appointment) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                promo_code: currentPromoCode
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                } else if (data.redirect) {
                    window.location.href = data.redirect;
                }
            } else {
                showPromoMessage(data.message, 'error');
                payButton.disabled = false;
                payButton.innerHTML = '<i class="fas fa-credit-card mr-2"></i>Pay $' + currentFinalAmount.toFixed(2);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showPromoMessage('Payment processing error. Please try again.', 'error');
            payButton.disabled = false;
            payButton.innerHTML = '<i class="fas fa-credit-card mr-2"></i>Pay $' + currentFinalAmount.toFixed(2);
        });
    });

    function showPromoMessage(message, type) {
        promoMessage.textContent = message;
        promoMessage.className = 'mt-2 text-sm ' + (type === 'success' ? 'text-green-600' : 'text-red-600');
        promoMessage.classList.remove('hidden');
    }

    function updateAmountDisplay() {
        finalAmountSpan.textContent = '$' + currentFinalAmount.toFixed(2);
        
        if (currentDiscountAmount > 0) {
            discountText.textContent = `You saved $${currentDiscountAmount.toFixed(2)} with promo code!`;
            discountDisplay.classList.remove('hidden');
        } else {
            discountDisplay.classList.add('hidden');
        }
    }

    function resetPromoCode() {
        currentPromoCode = '';
        currentFinalAmount = {{ $baseAmount }};
        currentDiscountAmount = 0;
        updateAmountDisplay();
        payButton.innerHTML = '<i class="fas fa-credit-card mr-2"></i>Pay $' + currentFinalAmount.toFixed(2);
        payButton.classList.remove('bg-green-600', 'hover:bg-green-700');
        payButton.classList.add('bg-blue-600', 'hover:bg-blue-700');
    }
});
</script>
@endsection
