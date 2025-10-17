/**
 * Appointment Form Error Handler System
 * Handles inline error display and validation for the appointment booking form
 */

// Server field name to client field ID mapping
const FIELD_MAPPING = {
    'location': 'location',
    'meeting_type': 'meeting-type',
    'preferred_language': 'preferred-language',
    'service_type': 'service-type',
    'specific_service': 'service',
    'full_name': 'full-name',
    'email': 'email',
    'phone': 'phone',
    'enquiry_details': 'enquiry-details',
    'appointment_date': 'appointment-date',
    'appointment_time': 'appointment-time',
    'enquiry_type': 'service-type' // Map to service type since it's derived from it
};

// Field containers for radio button groups
const RADIO_GROUPS = {
    'location': 'location-options',
    'meeting-type': 'meeting-options',
    'preferred-language': 'language-options',
    'service-type': 'service-selection-options',
    'service': 'service-options'
};

// Field Error Handler System
const FieldErrorHandler = {
    /**
     * Show error for a specific field
     */
    showError: (fieldId, message) => {
        const errorDiv = document.getElementById(fieldId + '-error');
        if (!errorDiv) {
            console.warn(`Error container not found for field: ${fieldId}`);
            return;
        }
        
        // Add error class to field or container
        if (RADIO_GROUPS[fieldId]) {
            // For radio button groups, add error class to container
            const container = document.querySelector('.' + RADIO_GROUPS[fieldId]);
            if (container) container.classList.add('error');
        } else {
            // For regular inputs, add error class to field
            const field = document.getElementById(fieldId);
            if (field) field.classList.add('error');
        }
        
        // Show error message
        const errorText = errorDiv.querySelector('.error-text');
        if (errorText) errorText.textContent = message;
        errorDiv.classList.add('show');
        
        // Scroll to error (optional, for better UX)
        errorDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    },
    
    /**
     * Clear error for a specific field
     */
    clearError: (fieldId) => {
        const errorDiv = document.getElementById(fieldId + '-error');
        if (!errorDiv) return;
        
        // Remove error class from field or container
        if (RADIO_GROUPS[fieldId]) {
            const container = document.querySelector('.' + RADIO_GROUPS[fieldId]);
            if (container) container.classList.remove('error');
        } else {
            const field = document.getElementById(fieldId);
            if (field) field.classList.remove('error');
        }
        
        // Hide error message
        errorDiv.classList.remove('show');
    },
    
    /**
     * Clear all errors
     */
    clearAllErrors: () => {
        // Clear all error messages
        document.querySelectorAll('.field-error').forEach(error => {
            error.classList.remove('show');
        });
        
        // Remove error classes from fields
        document.querySelectorAll('.form-input, .form-textarea, .form-select').forEach(field => {
            field.classList.remove('error');
        });
        
        // Remove error classes from radio groups
        Object.values(RADIO_GROUPS).forEach(groupClass => {
            const container = document.querySelector('.' + groupClass);
            if (container) container.classList.remove('error');
        });
    },
    
    /**
     * Handle server validation errors
     */
    handleServerErrors: (errors) => {
        FieldErrorHandler.clearAllErrors();
        
        if (typeof errors === 'object') {
            Object.keys(errors).forEach(serverFieldName => {
                const clientFieldId = FIELD_MAPPING[serverFieldName] || serverFieldName;
                const errorMessage = Array.isArray(errors[serverFieldName]) 
                    ? errors[serverFieldName][0] 
                    : errors[serverFieldName];
                FieldErrorHandler.showError(clientFieldId, errorMessage);
            });
        }
    }
};

// Client-side validation rules
const FieldValidator = {
    validateFullName: (value) => {
        if (!value || value.trim() === '') {
            return 'Full name is required';
        }
        if (value.trim().length < 2) {
            return 'Full name must be at least 2 characters';
        }
        if (!/^[a-zA-Z\s'-]+$/.test(value)) {
            return 'Full name can only contain letters, spaces, hyphens, and apostrophes';
        }
        return null;
    },
    
    validateEmail: (value) => {
        if (!value || value.trim() === '') {
            return 'Email address is required';
        }
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            return 'Please enter a valid email address';
        }
        return null;
    },
    
    validatePhone: (value) => {
        if (!value || value.trim() === '') {
            return 'Phone number is required';
        }
        
        // Extract only digits (remove formatting characters)
        const digitsOnly = value.replace(/[^\d]/g, '');
        
        // Check if there are at least 8 digits (minimum for most phone numbers)
        if (digitsOnly.length < 8) {
            return 'Phone number must contain at least 8 digits';
        }
        
        // Check if there are too many digits (max 15 for international numbers)
        if (digitsOnly.length > 15) {
            return 'Phone number cannot exceed 15 digits';
        }
        
        // Validate format: optional +, then digits with optional formatting
        if (!/^[\+]?[\d\s\-\(\)]+$/.test(value)) {
            return 'Phone number can only contain digits, spaces, hyphens, parentheses, and an optional + prefix';
        }
        
        return null;
    },
    
    validateEnquiryDetails: (value) => {
        if (!value || value.trim() === '') {
            return 'Please provide details about your enquiry';
        }
        if (value.trim().length < 10) {
            return 'Please provide at least 10 characters describing your enquiry';
        }
        if (value.length > 1000) {
            return 'Enquiry details must not exceed 1000 characters';
        }
        return null;
    },
    
    validateRequired: (value, fieldName) => {
        if (!value || (typeof value === 'string' && value.trim() === '')) {
            return `${fieldName} is required`;
        }
        return null;
    }
};

// Real-time field validation setup
function setupFieldValidation() {
    // Full name validation
    const fullNameField = document.getElementById('full-name');
    if (fullNameField) {
        fullNameField.addEventListener('blur', function() {
            const error = FieldValidator.validateFullName(this.value);
            if (error) {
                FieldErrorHandler.showError('full-name', error);
            } else {
                FieldErrorHandler.clearError('full-name');
                this.classList.add('success');
            }
        });
        
        fullNameField.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                FieldErrorHandler.clearError('full-name');
            }
        });
    }
    
    // Email validation
    const emailField = document.getElementById('email');
    if (emailField) {
        emailField.addEventListener('blur', function() {
            const error = FieldValidator.validateEmail(this.value);
            if (error) {
                FieldErrorHandler.showError('email', error);
            } else {
                FieldErrorHandler.clearError('email');
                this.classList.add('success');
            }
        });
        
        emailField.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                FieldErrorHandler.clearError('email');
            }
        });
    }
    
    // Phone validation
    const phoneField = document.getElementById('phone');
    if (phoneField) {
        phoneField.addEventListener('blur', function() {
            const error = FieldValidator.validatePhone(this.value);
            if (error) {
                FieldErrorHandler.showError('phone', error);
            } else {
                FieldErrorHandler.clearError('phone');
                this.classList.add('success');
            }
        });
        
        phoneField.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                FieldErrorHandler.clearError('phone');
            }
        });
    }
    
    // Enquiry details validation
    const enquiryField = document.getElementById('enquiry-details');
    if (enquiryField) {
        enquiryField.addEventListener('blur', function() {
            const error = FieldValidator.validateEnquiryDetails(this.value);
            if (error) {
                FieldErrorHandler.showError('enquiry-details', error);
            } else {
                FieldErrorHandler.clearError('enquiry-details');
                this.classList.add('success');
            }
        });
        
        enquiryField.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                FieldErrorHandler.clearError('enquiry-details');
            }
        });
    }
    
    // Clear error on radio button selection
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const fieldName = this.name.replace(/_/g, '-');
            FieldErrorHandler.clearError(fieldName);
        });
    });
}

// Initialize field validation when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    setupFieldValidation();
});

// Export for use in other scripts
window.FieldErrorHandler = FieldErrorHandler;
window.FieldValidator = FieldValidator;
