/**
 * Appointment Form Submission Handler
 * Handles AJAX form submission and validation for the appointment booking form
 */

// Form submission handler
class AppointmentFormSubmission {
    constructor() {
        this.form = document.getElementById('appointment-form');
        this.submitFreeBtn = document.getElementById('submit-free');
        this.submitPaidBtn = document.getElementById('submit-paid');
        this.init();
    }

    init() {
        if (this.submitFreeBtn) {
            this.submitFreeBtn.addEventListener('click', (e) => this.handleFreeSubmission(e));
        }
        
        if (this.submitPaidBtn) {
            this.submitPaidBtn.addEventListener('click', (e) => this.handlePaidSubmission(e));
        }
    }

    // Handle free appointment submission
    handleFreeSubmission(e) {
        e.preventDefault();
        
        // Clear previous errors
        if (window.FieldErrorHandler) {
            window.FieldErrorHandler.clearAllErrors();
        }
        
        // Validate form before submission
        if (!this.validateForm()) {
            return;
        }
        
        // Disable button and show loading
        this.setLoadingState(this.submitFreeBtn, 'Submitting...');
        
        // Populate hidden fields
        this.populateFormFields();
        
        // Submit via AJAX
        this.submitForm();
    }

    // Handle paid appointment submission
    handlePaidSubmission(e) {
        e.preventDefault();
        
        // Clear previous errors
        if (window.FieldErrorHandler) {
            window.FieldErrorHandler.clearAllErrors();
        }
        
        // Validate form before submission
        if (!this.validateForm()) {
            return;
        }
        
        // Disable button and show loading
        this.setLoadingState(this.submitPaidBtn, 'Processing...');
        
        // Populate hidden fields
        this.populateFormFields();
        
        // For now, submit as free (payment integration would go here)
        alert('Payment integration would be implemented here. For now, this will submit as a paid appointment.');
        this.submitForm();
    }

    // Validate the entire form
    validateForm() {
        let isValid = true;
        
        // Validate step 1 fields
        if (!this.validateStep1()) isValid = false;
        
        // Validate step 2 fields
        if (!this.validateStep2()) isValid = false;
        
        // Validate step 3 fields
        if (!this.validateStep3()) isValid = false;
        
        // Validate step 4 fields
        if (!this.validateStep4()) isValid = false;
        
        return isValid;
    }

    // Validate Step 1: Location Selection
    validateStep1() {
        let isValid = true;
        
        const locationSelected = document.querySelector('input[name="location"]:checked');
        const meetingTypeSelected = document.querySelector('input[name="meeting_type"]:checked');
        const languageSelected = document.querySelector('input[name="preferred_language"]:checked');
        
        if (!locationSelected) {
            if (window.FieldErrorHandler) {
                window.FieldErrorHandler.showError('location', 'Please select an office location');
            }
            isValid = false;
        }
        
        if (!meetingTypeSelected) {
            if (window.FieldErrorHandler) {
                window.FieldErrorHandler.showError('meeting-type', 'Please select a meeting type');
            }
            isValid = false;
        }
        
        if (!languageSelected) {
            if (window.FieldErrorHandler) {
                window.FieldErrorHandler.showError('preferred-language', 'Please select your preferred language');
            }
            isValid = false;
        }
        
        return isValid;
    }

    // Validate Step 2: Service Selection
    validateStep2() {
        const serviceTypeSelected = document.querySelector('input[name="service_type"]:checked');
        if (!serviceTypeSelected) {
            if (window.FieldErrorHandler) {
                window.FieldErrorHandler.showError('service-type', 'Please select a service type');
            }
            return false;
        }
        return true;
    }

    // Validate Step 3: Specific Service
    validateStep3() {
        const serviceSelected = document.querySelector('input[name="service"]:checked');
        if (!serviceSelected) {
            if (window.FieldErrorHandler) {
                window.FieldErrorHandler.showError('service', 'Please select a consultation type');
            }
            return false;
        }
        return true;
    }

    // Validate Step 4: Personal Details & Date/Time
    validateStep4() {
        let isValid = true;
        
        // Validate full name
        const fullName = document.getElementById('full-name').value;
        if (window.FieldValidator) {
            const nameError = window.FieldValidator.validateFullName(fullName);
            if (nameError) {
                if (window.FieldErrorHandler) {
                    window.FieldErrorHandler.showError('full-name', nameError);
                }
                isValid = false;
            }
        }
        
        // Validate email
        const email = document.getElementById('email').value;
        if (window.FieldValidator) {
            const emailError = window.FieldValidator.validateEmail(email);
            if (emailError) {
                if (window.FieldErrorHandler) {
                    window.FieldErrorHandler.showError('email', emailError);
                }
                isValid = false;
            }
        }
        
        // Validate phone
        const phone = document.getElementById('phone').value;
        if (window.FieldValidator) {
            const phoneError = window.FieldValidator.validatePhone(phone);
            if (phoneError) {
                if (window.FieldErrorHandler) {
                    window.FieldErrorHandler.showError('phone', phoneError);
                }
                isValid = false;
            }
        }
        
        // Validate enquiry details
        const enquiryDetails = document.getElementById('enquiry-details').value;
        if (window.FieldValidator) {
            const enquiryError = window.FieldValidator.validateEnquiryDetails(enquiryDetails);
            if (enquiryError) {
                if (window.FieldErrorHandler) {
                    window.FieldErrorHandler.showError('enquiry-details', enquiryError);
                }
                isValid = false;
            }
        }
        
        // Validate date
        if (!window.selectedDate) {
            if (window.FieldErrorHandler) {
                window.FieldErrorHandler.showError('appointment-date', 'Please select an appointment date');
            }
            isValid = false;
        }
        
        // Validate time
        if (!window.selectedTime) {
            if (window.FieldErrorHandler) {
                window.FieldErrorHandler.showError('appointment-time', 'Please select an appointment time');
            }
            isValid = false;
        }
        
        return isValid;
    }

    // Populate hidden form fields
    populateFormFields() {
        // Get selected values and populate hidden fields
        const selectedLocation = document.querySelector('input[name="location"]:checked');
        const selectedMeetingType = document.querySelector('input[name="meeting_type"]:checked');
        const selectedLanguage = document.querySelector('input[name="preferred_language"]:checked');
        const selectedServiceType = document.querySelector('input[name="service_type"]:checked');
        const selectedService = document.querySelector('input[name="service"]:checked');
        
        if (selectedLocation) {
            document.getElementById('location-input').value = selectedLocation.value;
        }
        if (selectedMeetingType) {
            document.getElementById('meeting-type-input').value = selectedMeetingType.value;
        }
        if (selectedLanguage) {
            document.getElementById('preferred-language-input').value = selectedLanguage.value;
        }
        if (selectedServiceType) {
            document.getElementById('service-type-input').value = selectedServiceType.value;
        }
        if (selectedService) {
            document.getElementById('service-input').value = selectedService.value;
        }
        
        // Map service type to enquiry type
        let enquiryType = 'tr'; // default
        if (selectedServiceType) {
            const serviceTypeMapping = {
                'permanent-residency': 'pr_complex',
                'temporary-residency': 'tr',
                'jrp-skill-assessment': 'tr',
                'tourist-visa': 'tourist',
                'education-visa': 'education',
                'complex-matters': 'pr_complex',
                'visa-cancellation': 'pr_complex',
                'international-migration': 'pr_complex'
            };
            enquiryType = serviceTypeMapping[selectedServiceType.value] || 'tr';
        }
        document.getElementById('enquiry-type-input').value = enquiryType;
    }

    // Submit form via AJAX
    async submitForm() {
        try {
            // Collect form data
            const formData = new FormData(this.form);
            const jsonData = Object.fromEntries(formData.entries());
            
            // Map date/time fields
            jsonData.appointment_date = document.getElementById('selected-date-input').value;
            jsonData.appointment_time = document.getElementById('selected-time-input').value;
            
            // Submit via AJAX
            const response = await fetch(this.form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(jsonData)
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Success - show quick success message and redirect
                if (data.redirect) {
                    // Show success message
                    this.showSuccessMessage(data.message || 'Appointment booked successfully!');
                    
                    // Redirect after a short delay
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    // Fallback if no redirect provided
                    alert(data.message);
                }
            } else {
                // Handle errors
                if (data.errors && window.FieldErrorHandler) {
                    window.FieldErrorHandler.handleServerErrors(data.errors);
                } else if (data.message) {
                    alert(data.message);
                }
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        } finally {
            // Re-enable button
            this.resetLoadingState();
        }
    }

    // Set loading state for button
    setLoadingState(button, text) {
        button.disabled = true;
        button.textContent = text;
    }

    // Reset loading state
    resetLoadingState() {
        if (this.submitFreeBtn) {
            this.submitFreeBtn.disabled = false;
            this.submitFreeBtn.textContent = 'Submit Appointment';
        }
        if (this.submitPaidBtn) {
            this.submitPaidBtn.disabled = false;
            this.submitPaidBtn.textContent = 'Pay & Submit ($150)';
        }
    }

    // Show success message
    showSuccessMessage(message) {
        // Create success notification
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-2xl z-50 flex items-center space-x-3 animate-slide-in';
        notification.innerHTML = `
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="font-medium">${message}</span>
        `;
        document.body.appendChild(notification);
        
        // Remove after animation
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
}

// Initialize form submission when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new AppointmentFormSubmission();
});
