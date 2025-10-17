@php
    $formSource = $form_source ?? 'default';
    $formVariant = $form_variant ?? 'standard';
    $showPhone = $show_phone ?? true;
    $showSubject = $show_subject ?? true;
    $recaptchaSiteKey = $recaptcha_site_key ?? config('services.recaptcha.site_key');
    $formTitle = $form_title ?? 'Request Call Back';
    $formSubtitle = $form_subtitle ?? null;
@endphp

<div class="unified-contact-form-container">
    @if($formTitle)
    <div class="mb-4">
        <h3 class="text-xl font-semibold text-gray-900">{{ $formTitle }}</h3>
        @if($formSubtitle)
            <p class="text-sm text-gray-600 mt-1">{{ $formSubtitle }}</p>
        @endif
    </div>
    @endif
    <!-- Success/Error Messages -->
    <div id="contact-messages" class="mb-4 hidden">
        <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded hidden">
            <span class="message-text"></span>
        </div>
        <div id="error-message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded hidden">
            <span class="message-text"></span>
        </div>
    </div>

    <!-- Contact Form -->
    <form id="unified-contact-form" action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Hidden Fields for Analytics -->
        <input type="hidden" name="form_source" value="{{ $formSource }}">
        <input type="hidden" name="form_variant" value="{{ $formVariant }}">
        
        <!-- Honeypot Field (hidden from users) -->
        <input type="text" name="website" style="display: none;" tabindex="-1" autocomplete="off">

        <!-- Name Field -->
        <div class="form-group">
            <label for="contact-name" class="block text-sm font-medium text-gray-700 mb-2">
                Full Name <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   id="contact-name" 
                   name="name" 
                   required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                   placeholder="Enter your full name">
            <div class="field-error text-red-500 text-sm mt-1 hidden"></div>
        </div>

        <!-- Email Field -->
        <div class="form-group">
            <label for="contact-email" class="block text-sm font-medium text-gray-700 mb-2">
                Email Address <span class="text-red-500">*</span>
            </label>
            <input type="email" 
                   id="contact-email" 
                   name="email" 
                   required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                   placeholder="Enter your email address">
            <div class="field-error text-red-500 text-sm mt-1 hidden"></div>
        </div>

        <!-- Phone Field (Optional) -->
        @if($showPhone)
        <div class="form-group">
            <label for="contact-phone" class="block text-sm font-medium text-gray-700 mb-2">
                Phone Number
            </label>
            <input type="tel" 
                   id="contact-phone" 
                   name="phone" 
                   pattern="[\+]?[0-9\s\-\(\)]{8,20}"
                   title="Please enter a valid phone number (8-20 digits, may include +, spaces, hyphens, and parentheses)"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                   placeholder="Enter your phone number (e.g., 0412 345 678 or +61 412 345 678)">
            <div class="field-error text-red-500 text-sm mt-1 hidden"></div>
        </div>
        @endif

        <!-- Subject Field (Optional) -->
        @if($showSubject)
        <div class="form-group">
            <label for="contact-subject" class="block text-sm font-medium text-gray-700 mb-2">
                Subject <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   id="contact-subject" 
                   name="subject" 
                   required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                   placeholder="What can we help you with?">
            <div class="field-error text-red-500 text-sm mt-1 hidden"></div>
        </div>
        @endif

        <!-- Message Field -->
        <div class="form-group">
            <label for="contact-message" class="block text-sm font-medium text-gray-700 mb-2">
                Message <span class="text-red-500">*</span>
            </label>
            <textarea id="contact-message" 
                      name="message" 
                      required 
                      rows="5" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-vertical"
                      placeholder="Please describe your inquiry in detail..."></textarea>
            <div class="field-error text-red-500 text-sm mt-1 hidden"></div>
        </div>

        <!-- reCAPTCHA -->
        @if($recaptchaSiteKey)
        <div class="form-group">
            <div class="g-recaptcha" data-sitekey="{{ $recaptchaSiteKey }}"></div>
            <div class="field-error text-red-500 text-sm mt-1 hidden"></div>
        </div>
        @endif

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" 
                    id="contact-submit-btn"
                    class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium disabled:opacity-50 disabled:cursor-not-allowed">
                <span class="btn-text">Send Message</span>
                <span class="btn-loading hidden">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Sending...
                </span>
            </button>
        </div>
    </form>
</div>

@if($recaptchaSiteKey)
<!-- reCAPTCHA Script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif

<!-- Contact Form JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('unified-contact-form');
    const submitBtn = document.getElementById('contact-submit-btn');
    const messagesContainer = document.getElementById('contact-messages');
    const successMessage = document.getElementById('success-message');
    const errorMessage = document.getElementById('error-message');

    // CSRF Token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Clear previous messages and errors
        clearMessages();
        clearFieldErrors();
        
        // Disable submit button and show loading state
        setLoadingState(true);

        // Prepare form data
        const formData = new FormData(form);

        // Make AJAX request
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccessMessage(data.message);
                form.reset();
                
                // Reset reCAPTCHA if present
                if (typeof grecaptcha !== 'undefined') {
                    grecaptcha.reset();
                }
            } else {
                if (data.errors) {
                    showFieldErrors(data.errors);
                }
                showErrorMessage(data.message || 'An error occurred. Please try again.');
            }
        })
        .catch(error => {
            console.error('Form submission error:', error);
            showErrorMessage('Sorry, there was an error sending your message. Please try again.');
        })
        .finally(() => {
            setLoadingState(false);
        });
    });

    function setLoadingState(loading) {
        const btnText = submitBtn.querySelector('.btn-text');
        const btnLoading = submitBtn.querySelector('.btn-loading');
        
        if (loading) {
            submitBtn.disabled = true;
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
        } else {
            submitBtn.disabled = false;
            btnText.classList.remove('hidden');
            btnLoading.classList.add('hidden');
        }
    }

    function showSuccessMessage(message) {
        messagesContainer.classList.remove('hidden');
        successMessage.classList.remove('hidden');
        successMessage.querySelector('.message-text').textContent = message;
        errorMessage.classList.add('hidden');
        
        // Scroll to message
        messagesContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function showErrorMessage(message) {
        messagesContainer.classList.remove('hidden');
        errorMessage.classList.remove('hidden');
        errorMessage.querySelector('.message-text').textContent = message;
        successMessage.classList.add('hidden');
        
        // Scroll to message
        messagesContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function showFieldErrors(errors) {
        Object.keys(errors).forEach(fieldName => {
            const field = form.querySelector(`[name="${fieldName}"]`);
            if (field) {
                const formGroup = field.closest('.form-group');
                const errorDiv = formGroup?.querySelector('.field-error');
                
                if (errorDiv) {
                    errorDiv.textContent = errors[fieldName][0];
                    errorDiv.classList.remove('hidden');
                    field.classList.add('border-red-500');
                }
            }
        });
    }

    function clearMessages() {
        messagesContainer.classList.add('hidden');
        successMessage.classList.add('hidden');
        errorMessage.classList.add('hidden');
    }

    function clearFieldErrors() {
        const errorDivs = form.querySelectorAll('.field-error');
        errorDivs.forEach(div => {
            div.classList.add('hidden');
            div.textContent = '';
        });

        const fields = form.querySelectorAll('input, textarea');
        fields.forEach(field => {
            field.classList.remove('border-red-500');
        });
    }

    // Clear field errors when user starts typing
    const fields = form.querySelectorAll('input, textarea');
    fields.forEach(field => {
        field.addEventListener('input', function() {
            const formGroup = this.closest('.form-group');
            const errorDiv = formGroup?.querySelector('.field-error');
            if (errorDiv && !errorDiv.classList.contains('hidden')) {
                errorDiv.classList.add('hidden');
                this.classList.remove('border-red-500');
            }
        });
    });
});
</script>
