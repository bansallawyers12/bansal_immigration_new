/**
 * Appointment Form Step Validation
 * Handles step-by-step validation and navigation for the appointment booking form
 */

// Step validation system
class AppointmentFormSteps {
    constructor() {
        this.currentStep = 1;
        this.init();
    }

    init() {
        // Override the existing nextStep function
        window.nextStep = (step) => this.nextStep(step);
        window.prevStep = (step) => this.prevStep(step);
        
        // Set up auto-progression listeners
        this.setupAutoProgression();
    }

    // Navigate to next step with validation
    nextStep(step) {
        if (this.validateCurrentStep()) {
            this.hideAllSections();
            this.showSection(step);
            this.updateStepIndicator(step);
            this.currentStep = step;
            
            if (step === 5) {
                this.populateConfirmation();
            }
        }
    }

    // Navigate to previous step
    prevStep(step) {
        this.hideAllSections();
        this.showSection(step);
        this.updateStepIndicator(step);
        this.currentStep = step;
    }

    // Validate current step before proceeding
    validateCurrentStep() {
        if (window.FieldErrorHandler) {
            window.FieldErrorHandler.clearAllErrors();
        }
        
        const stepValidations = {
            1: () => this.validateStep1(),
            2: () => this.validateStep2(),
            3: () => this.validateStep3(),
            4: () => this.validateStep4()
        };
        
        if (stepValidations[this.currentStep]) {
            const isValid = stepValidations[this.currentStep]();
            if (!isValid) {
                // Scroll to first error
                const firstError = document.querySelector('.field-error.show');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            }
            return isValid;
        }
        
        return true;
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
        const fullName = document.getElementById('full-name');
        if (fullName && window.FieldValidator) {
            const nameError = window.FieldValidator.validateFullName(fullName.value);
            if (nameError) {
                if (window.FieldErrorHandler) {
                    window.FieldErrorHandler.showError('full-name', nameError);
                }
                isValid = false;
            }
        }
        
        // Validate email
        const email = document.getElementById('email');
        if (email && window.FieldValidator) {
            const emailError = window.FieldValidator.validateEmail(email.value);
            if (emailError) {
                if (window.FieldErrorHandler) {
                    window.FieldErrorHandler.showError('email', emailError);
                }
                isValid = false;
            }
        }
        
        // Validate phone
        const phone = document.getElementById('phone');
        if (phone && window.FieldValidator) {
            const phoneError = window.FieldValidator.validatePhone(phone.value);
            if (phoneError) {
                if (window.FieldErrorHandler) {
                    window.FieldErrorHandler.showError('phone', phoneError);
                }
                isValid = false;
            }
        }
        
        // Validate enquiry details
        const enquiryDetails = document.getElementById('enquiry-details');
        if (enquiryDetails && window.FieldValidator) {
            const enquiryError = window.FieldValidator.validateEnquiryDetails(enquiryDetails.value);
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

    // Hide all form sections
    hideAllSections() {
        document.querySelectorAll('.form-section').forEach(section => {
            section.classList.add('section-hidden');
        });
    }

    // Show specific section
    showSection(step) {
        const sections = {
            1: 'location-section',
            2: 'service-selection-section',
            3: 'service-section',
            4: 'details-section',
            5: 'confirmation-section'
        };
        
        const sectionId = sections[step];
        if (sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.classList.remove('section-hidden');
            }
        }
    }

    // Update step indicator
    updateStepIndicator(step) {
        // Remove active class from all steps
        document.querySelectorAll('.step').forEach(stepEl => {
            stepEl.classList.remove('active');
        });
        
        // Add active class to current step
        const currentStepEl = document.getElementById(`step-${step}`);
        if (currentStepEl) {
            currentStepEl.classList.add('active');
        }
    }

    // Populate confirmation section
    populateConfirmation() {
        // Populate confirmation details
        const nameEl = document.getElementById('confirm-name');
        const emailEl = document.getElementById('confirm-email');
        const phoneEl = document.getElementById('confirm-phone');
        const locationEl = document.getElementById('confirm-location');
        const meetingEl = document.getElementById('confirm-meeting-type');
        const serviceEl = document.getElementById('confirm-service');
        const datetimeEl = document.getElementById('confirm-datetime');
        const detailsEl = document.getElementById('confirm-details');
        
        if (nameEl) nameEl.textContent = document.getElementById('full-name').value;
        if (emailEl) emailEl.textContent = document.getElementById('email').value;
        if (phoneEl) phoneEl.textContent = document.getElementById('phone').value;
        if (locationEl) locationEl.textContent = this.getSelectedLocationText();
        if (meetingEl) meetingEl.textContent = this.getSelectedMeetingTypeText();
        if (serviceEl) serviceEl.textContent = this.getSelectedServiceText();
        if (datetimeEl) datetimeEl.textContent = this.getSelectedDateTimeText();
        if (detailsEl) detailsEl.textContent = document.getElementById('enquiry-details').value;
        
        // Show appropriate submit button based on service type
        const selectedService = document.querySelector('input[name="service"]:checked');
        const isPaid = selectedService && selectedService.value === 'paid-consultation';
        
        const submitFree = document.getElementById('submit-free');
        const submitPaid = document.getElementById('submit-paid');
        
        if (submitFree) submitFree.style.display = isPaid ? 'none' : 'inline-block';
        if (submitPaid) submitPaid.style.display = isPaid ? 'inline-block' : 'none';
    }

    // Get selected location text
    getSelectedLocationText() {
        const selected = document.querySelector('input[name="location"]:checked');
        if (selected) {
            return selected.value === 'adelaide' ? 'Adelaide Office' : 'Melbourne Office';
        }
        return '';
    }

    // Get selected meeting type text
    getSelectedMeetingTypeText() {
        const selected = document.querySelector('input[name="meeting_type"]:checked');
        if (selected) {
            const types = {
                'phone': 'Phone Call',
                'in-person': 'In Person',
                'video-call': 'Video Call'
            };
            return types[selected.value] || selected.value;
        }
        return '';
    }

    // Get selected service text
    getSelectedServiceText() {
        const selected = document.querySelector('input[name="service"]:checked');
        if (selected) {
            const services = {
                'consultation': 'Free Consultation',
                'paid-consultation': 'Comprehensive Migration Advice',
                'overseas-enquiry': 'Overseas Applicant Enquiry'
            };
            return services[selected.value] || selected.value;
        }
        return '';
    }

    // Get selected date and time text
    getSelectedDateTimeText() {
        return `${window.selectedDate ? window.selectedDate.toLocaleDateString('en-AU') : ''} at ${window.selectedTime || ''}`;
    }

    // Set up auto-progression listeners
    setupAutoProgression() {
        // Add click handlers to location options
        document.querySelectorAll('.location-option').forEach(option => {
            option.addEventListener('click', () => this.checkStep1Completion());
        });

        // Add click handlers to meeting type options
        document.querySelectorAll('.meeting-option').forEach(option => {
            option.addEventListener('click', () => this.checkStep1Completion());
        });

        // Add click handlers to language options
        document.querySelectorAll('.language-option').forEach(option => {
            option.addEventListener('click', () => this.checkStep1Completion());
        });

        // Add click handlers to service options
        document.querySelectorAll('.service-option').forEach(option => {
            option.addEventListener('click', () => this.checkStep2Completion());
        });
    }

    // Check if step 1 is complete and auto-progress
    checkStep1Completion() {
        setTimeout(() => {
            const isLocationSelected = document.querySelector('input[name="location"]:checked') !== null;
            const isMeetingTypeSelected = document.querySelector('input[name="meeting_type"]:checked') !== null;
            const isLanguageSelected = document.querySelector('input[name="preferred_language"]:checked') !== null;
            
            if (isLocationSelected && isMeetingTypeSelected && isLanguageSelected) {
                this.nextStep(2);
            }
        }, 300);
    }

    // Check if step 2 is complete and auto-progress
    checkStep2Completion() {
        setTimeout(() => {
            const isServiceTypeSelected = document.querySelector('input[name="service_type"]:checked') !== null;
            
            if (isServiceTypeSelected) {
                this.nextStep(3);
            }
        }, 300);
    }
}

// Initialize step validation when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new AppointmentFormSteps();
});
