<!-- Call Back Modal -->
<div id="call-back-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-6 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-sg-navy">Request Call Back</h3>
            <button id="close-modal" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Modal Body -->
        <div class="p-6">
            <!-- Call Back Message -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <i class="fas fa-phone text-sg-light-blue text-lg mr-3 mt-1"></i>
                    <div>
                        <h4 class="font-semibold text-sg-navy mb-2">We'll Call You Back!</h4>
                        <p class="text-sm text-sg-dark-gray">
                            Leave your phone number and message below, and our immigration experts will call you back at your convenience.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <form id="call-back-form" action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Hidden Fields -->
                <input type="hidden" name="form_source" value="call_back_modal">
                <input type="hidden" name="form_variant" value="call_back">
                <input type="hidden" name="website" style="display: none;" tabindex="-1" autocomplete="off">
                
                <!-- Name Field -->
                <div>
                    <label for="modal-name" class="block text-sm font-medium text-gray-700 mb-1">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="modal-name" 
                           name="name" 
                           required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sg-light-blue focus:border-sg-light-blue transition-colors"
                           placeholder="Enter your full name">
                </div>
                
                <!-- Phone Field -->
                <div>
                    <label for="modal-phone" class="block text-sm font-medium text-gray-700 mb-1">
                        Phone Number <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" 
                           id="modal-phone" 
                           name="phone" 
                           required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sg-light-blue focus:border-sg-light-blue transition-colors"
                           placeholder="Enter your phone number">
                </div>
                
                <!-- Message Field -->
                <div>
                    <label for="modal-message" class="block text-sm font-medium text-gray-700 mb-1">
                        Message <span class="text-red-500">*</span>
                    </label>
                    <textarea id="modal-message" 
                              name="message" 
                              required 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sg-light-blue focus:border-sg-light-blue transition-colors resize-none"
                              placeholder="Tell us how we can help you..."></textarea>
                </div>
                
                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" 
                            id="modal-submit-btn"
                            class="w-full bg-sg-light-blue hover:bg-sg-navy text-white py-3 px-4 rounded-lg font-semibold transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="btn-text">Request Call Back</span>
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
    </div>
</div>

<!-- Success/Error Messages -->
<div id="modal-messages" class="fixed top-4 right-4 z-50 hidden">
    <div id="modal-success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg hidden">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span class="message-text"></span>
        </div>
    </div>
    <div id="modal-error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-lg hidden">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span class="message-text"></span>
        </div>
    </div>
</div>
