<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bansal Immigration - Expert Australian Migration Services')</title>
    <meta name="description" content="@yield('description', 'Professional Australian immigration consultants helping you achieve permanent residency, study abroad, and family reunification in Australia. MARA registered migration agents.')">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="/img/logo/favicon.png">
    <style>
        /* Slater & Gordon inspired color scheme */
        :root {
            --sg-navy: #1e3a8a;
            --sg-light-blue: #3b82f6;
            --sg-sky-blue: #60a5fa;
            --sg-light-gray: #f8fafc;
            --sg-dark-gray: #374151;
            --sg-medium-gray: #6b7280;
        }

        .sg-navy { color: var(--sg-navy); }
        .sg-light-blue { color: var(--sg-light-blue); }
        .sg-sky-blue { color: var(--sg-sky-blue); }
        .bg-sg-navy { background-color: var(--sg-navy); }
        .bg-sg-light-blue { background-color: var(--sg-light-blue); }
        .bg-sg-sky-blue { background-color: var(--sg-sky-blue); }
        .bg-sg-light-gray { background-color: var(--sg-light-gray); }
        .border-sg-light-blue { border-color: var(--sg-light-blue); }

        /* Custom fonts */
        .font-sg {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        /* Hero section with background image */
        .hero-bg {
            background: linear-gradient(rgba(30, 58, 138, 0.7), rgba(30, 58, 138, 0.7)), 
                        url('/img/homepage.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* Logo styling */
        .logo-text {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .logo-plus {
            color: var(--sg-sky-blue);
            font-weight: 300;
        }

        .logo-subtitle {
                font-size: 0.875rem;
            color: var(--sg-sky-blue);
            font-weight: 400;
        }

        /* Navigation styling */
        .nav-link {
            color: var(--sg-dark-gray);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--sg-light-blue);
        }

        /* Hero overlay box */
        .hero-overlay {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        /* Service cards */
        .service-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Icon styling */
        .service-icon {
            width: 48px;
            height: 48px;
            color: var(--sg-light-blue);
        }

        /* Button styling */
        .btn-primary {
            background-color: var(--sg-light-blue);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--sg-navy);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: white;
            color: var(--sg-light-blue);
            border: 2px solid var(--sg-light-blue);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: var(--sg-light-blue);
            color: white;
        }

        /* Header improvements */
        .header-shadow {
            box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.06), 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Logo hover effect */
        .logo-hover:hover .logo-text {
            color: var(--sg-light-blue);
            transition: color 0.3s ease;
        }

        /* Mobile menu animation */
        .mobile-menu-enter {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-bg {
                background-attachment: scroll;
            }
            
            .hero-overlay {
                margin: 1rem;
                padding: 2rem;
            }

            .sub-nav {
                display: none;
            }

            /* Mobile blog and testimonial adjustments */
            .service-card {
                padding: 1.5rem;
            }

            .service-card h3 {
                font-size: 1.25rem;
            }

            .service-card p {
                font-size: 0.875rem;
            }

            /* Mobile header adjustments */
            .header-logo {
                height: 1.5rem !important;
            }
        }

        @media (max-width: 1024px) {
            .header-logo {
                height: 2rem !important;
            }
        }

        @media (max-width: 1024px) {
            .main-nav {
                display: none;
            }
        }

        /* Line clamp utility */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    @stack('styles')
</head>
<body class="font-sg bg-white">
    <!-- Header -->
    <x-header />

    <!-- Floating Call Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <!-- Desktop: Modal Button -->
        <button id="open-call-back-modal" class="hidden md:block bg-sg-light-blue hover:bg-sg-navy text-white p-4 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110">
            <i class="fas fa-phone text-xl"></i>
        </button>
        
        <!-- Mobile: Direct Call Link -->
        <a href="tel:+61396021330" class="md:hidden bg-sg-light-blue hover:bg-sg-navy text-white p-4 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110">
            <i class="fas fa-phone text-xl"></i>
        </a>
    </div>

    <!-- Floating Call Me Back Button -->
    <div class="fixed right-0 top-1/2 transform -translate-y-1/2 z-50">
        <a href="/contact" class="bg-sg-navy hover:bg-sg-light-blue text-white px-2 py-6 sm:px-4 sm:py-8 rounded-l-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
            <span class="font-semibold text-xs sm:text-sm writing-mode-vertical-rl text-orientation-mixed" style="writing-mode: vertical-rl; text-orientation: mixed;">Request Call Back</span>
        </a>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Call Back Modal -->
    <x-call-back-modal />

    <!-- JavaScript -->
    <script>
        // Simple JavaScript for interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to service cards
            document.querySelectorAll('.service-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });

                // Close mobile menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                        mobileMenu.classList.add('hidden');
                    }
                });
            }

            // Call Back Modal functionality
            const openModalBtn = document.getElementById('open-call-back-modal');
            const modal = document.getElementById('call-back-modal');
            const closeModalBtn = document.getElementById('close-modal');
            const callBackForm = document.getElementById('call-back-form');
            const submitBtn = document.getElementById('modal-submit-btn');
            const messagesContainer = document.getElementById('modal-messages');
            const successMessage = document.getElementById('modal-success');
            const errorMessage = document.getElementById('modal-error');

            // Open modal
            if (openModalBtn && modal) {
                openModalBtn.addEventListener('click', function() {
                    modal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                });
            }

            // Close modal
            function closeModal() {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                // Reset form
                if (callBackForm) {
                    callBackForm.reset();
                }
                // Hide messages
                if (messagesContainer) {
                    messagesContainer.classList.add('hidden');
                }
            }

            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', closeModal);
            }

            // Close modal when clicking outside
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeModal();
                    }
                });
            }

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });

            // Form submission
            if (callBackForm) {
                callBackForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Show loading state
                    submitBtn.disabled = true;
                    submitBtn.querySelector('.btn-text').classList.add('hidden');
                    submitBtn.querySelector('.btn-loading').classList.remove('hidden');
                    
                    // Hide previous messages
                    messagesContainer.classList.add('hidden');
                    successMessage.classList.add('hidden');
                    errorMessage.classList.add('hidden');
                    
                    // Get form data
                    const formData = new FormData(callBackForm);
                    
                    // Submit form
                    fetch(callBackForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success message
                            successMessage.querySelector('.message-text').textContent = data.message || 'Thank you! We will call you back soon.';
                            successMessage.classList.remove('hidden');
                            messagesContainer.classList.remove('hidden');
                            
                            // Close modal after 3 seconds
                            setTimeout(() => {
                                closeModal();
                            }, 3000);
                        } else {
                            // Show error message
                            errorMessage.querySelector('.message-text').textContent = data.message || 'Something went wrong. Please try again.';
                            errorMessage.classList.remove('hidden');
                            messagesContainer.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        errorMessage.querySelector('.message-text').textContent = 'Something went wrong. Please try again.';
                        errorMessage.classList.remove('hidden');
                        messagesContainer.classList.remove('hidden');
                    })
                    .finally(() => {
                        // Reset button state
                        submitBtn.disabled = false;
                        submitBtn.querySelector('.btn-text').classList.remove('hidden');
                        submitBtn.querySelector('.btn-loading').classList.add('hidden');
                    });
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
