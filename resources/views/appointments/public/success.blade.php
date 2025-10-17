@extends('layouts.guest')

@section('title', 'Appointment Confirmed - Success!')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob"></div>
        <div class="absolute top-1/3 right-1/4 w-64 h-64 bg-green-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-1/4 left-1/3 w-64 h-64 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Confetti Container -->
    <div id="confetti-container" class="fixed inset-0 pointer-events-none z-50"></div>

    <div class="relative z-10 sm:mx-auto sm:w-full sm:max-w-2xl">
        <!-- Success Icon with Animation -->
        <div class="text-center mb-8">
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-gradient-to-r from-green-400 to-green-600 mb-6 shadow-2xl animate-scale-in">
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                    <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                </svg>
            </div>
            <h2 class="text-4xl font-bold text-gray-900 mb-3 animate-fade-in-up" style="animation-delay: 0.2s;">
                🎉 Appointment Confirmed!
            </h2>
            <p class="text-xl text-gray-600 animate-fade-in-up" style="animation-delay: 0.3s;">
                Your appointment has been successfully booked
            </p>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white/80 backdrop-blur-sm py-8 px-6 shadow-2xl rounded-2xl sm:px-10 animate-slide-up border border-white/20" style="animation-delay: 0.4s;">
            <div class="space-y-6">
                <!-- Booking Reference -->
                <div class="text-center pb-6 border-b border-gray-200">
                    <p class="text-sm text-gray-500 mb-1">Booking Reference</p>
                    <p class="text-2xl font-bold text-blue-600 tracking-wider">#{{ str_pad($appointment->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>

                <!-- Appointment Details with Icons -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl p-6 animate-fade-in" style="animation-delay: 0.5s;">
                    <h3 class="text-lg font-semibold text-gray-900 mb-5 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Appointment Details
                    </h3>
                    <div class="grid gap-4">
                        <div class="flex items-start group">
                            <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center mr-3 group-hover:bg-blue-200 transition-colors">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 mb-0.5">Full Name</p>
                                <p class="font-semibold text-gray-900">{{ $appointment->full_name }}</p>
                            </div>
                        </div>

                        <div class="flex items-start group">
                            <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center mr-3 group-hover:bg-green-200 transition-colors">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 mb-0.5">Email</p>
                                <p class="font-semibold text-gray-900">{{ $appointment->email }}</p>
                            </div>
                        </div>

                        <div class="flex items-start group">
                            <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center mr-3 group-hover:bg-purple-200 transition-colors">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 mb-0.5">Phone</p>
                                <p class="font-semibold text-gray-900">{{ $appointment->phone }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-start group">
                                <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center mr-3 group-hover:bg-red-200 transition-colors">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 mb-0.5">Date</p>
                                    <p class="font-semibold text-gray-900">{{ $appointment->appointment_date->format('M j, Y') }}</p>
                                </div>
                            </div>

                            <div class="flex items-start group">
                                <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-yellow-100 flex items-center justify-center mr-3 group-hover:bg-yellow-200 transition-colors">
                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 mb-0.5">Time</p>
                                    <p class="font-semibold text-gray-900">{{ $appointment->appointment_time }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-start group">
                                <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center mr-3 group-hover:bg-indigo-200 transition-colors">
                                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 mb-0.5">Type</p>
                                    <p class="font-semibold text-gray-900">{{ $appointment->enquiry_type_display }}</p>
                                </div>
                            </div>

                            <div class="flex items-start group">
                                <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-pink-100 flex items-center justify-center mr-3 group-hover:bg-pink-200 transition-colors">
                                    <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 mb-0.5">Location</p>
                                    <p class="font-semibold text-gray-900">{{ ucfirst($appointment->location) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- What's Next Section -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 rounded-lg p-5 animate-fade-in" style="animation-delay: 0.6s;">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-blue-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-semibold text-blue-900 mb-2">📧 What's Next?</h4>
                            <ul class="text-sm text-blue-800 space-y-1">
                                <li class="flex items-start">
                                    <span class="text-blue-500 mr-2">✓</span>
                                    <span>You will receive a confirmation email within 5 minutes</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-blue-500 mr-2">✓</span>
                                    <span>We'll send you a reminder 24 hours before your appointment</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-blue-500 mr-2">✓</span>
                                    <span>Please arrive 10 minutes early with required documents</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3 pt-2 animate-fade-in" style="animation-delay: 0.7s;">
                    <a href="{{ route('appointments.show', $appointment) }}" 
                       class="w-full flex items-center justify-center py-3 px-6 border border-transparent rounded-xl shadow-lg text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-200 hover:scale-105 hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View Full Appointment Details
                    </a>
                    
                    <a href="{{ route('home') }}" 
                       class="w-full flex items-center justify-center py-3 px-6 border-2 border-gray-300 rounded-xl shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-200 hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Return to Home
                    </a>
                </div>

                <!-- Contact Information -->
                <div class="text-center pt-4 border-t border-gray-200 animate-fade-in" style="animation-delay: 0.8s;">
                    <p class="text-sm text-gray-600 mb-2">Need to make changes or have questions?</p>
                    <div class="flex items-center justify-center space-x-4">
                        <a href="mailto:info@bansalimmigration.com" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            info@bansalimmigration.com
                        </a>
                        <span class="text-gray-300">|</span>
                        <a href="tel:+61-xxx-xxx" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Call Us
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Download/Print Button -->
        <div class="mt-6 text-center animate-fade-in" style="animation-delay: 0.9s;">
            <button onclick="window.print()" class="inline-flex items-center px-6 py-2 text-sm font-medium text-gray-700 bg-white/80 backdrop-blur-sm rounded-lg shadow hover:bg-white transition-all duration-200 hover:shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Print Confirmation
            </button>
        </div>
    </div>
</div>

<style>
/* Checkmark Animation */
.checkmark {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    display: block;
    stroke-width: 3;
    stroke: #fff;
    stroke-miterlimit: 10;
    box-shadow: inset 0px 0px 0px #10b981;
    animation: fill 0.4s ease-in-out 0.4s forwards, scale 0.3s ease-in-out 0.9s both;
}

.checkmark-circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke-width: 3;
    stroke-miterlimit: 10;
    stroke: #fff;
    fill: none;
    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.checkmark-check {
    transform-origin: 50% 50%;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    stroke: #fff;
    stroke-width: 3;
    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

@keyframes stroke {
    100% {
        stroke-dashoffset: 0;
    }
}

@keyframes scale {
    0%, 100% {
        transform: none;
    }
    50% {
        transform: scale3d(1.1, 1.1, 1);
    }
}

@keyframes fill {
    100% {
        box-shadow: inset 0px 0px 0px 30px #10b981;
    }
}

/* Fade In Animations */
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slide-up {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes scale-in {
    from {
        opacity: 0;
        transform: scale(0);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Blob Animation for Background */
@keyframes blob {
    0%, 100% {
        transform: translate(0, 0) scale(1);
    }
    25% {
        transform: translate(20px, -50px) scale(1.1);
    }
    50% {
        transform: translate(-20px, 20px) scale(0.9);
    }
    75% {
        transform: translate(50px, 50px) scale(1.05);
    }
}

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out both;
}

.animate-slide-up {
    animation: slide-up 0.6s ease-out both;
}

.animate-scale-in {
    animation: scale-in 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out both;
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

/* Confetti Styles */
.confetti {
    position: fixed;
    width: 10px;
    height: 10px;
    background-color: #f0f;
    animation: confetti-fall 3s linear forwards;
}

@keyframes confetti-fall {
    to {
        transform: translateY(100vh) rotate(360deg);
        opacity: 0;
    }
}

/* Print Styles */
@media print {
    .no-print {
        display: none !important;
    }
    
    body {
        background: white !important;
    }
    
    .bg-gradient-to-br {
        background: white !important;
    }
}
</style>

<script>
// Confetti Effect
function createConfetti() {
    const container = document.getElementById('confetti-container');
    const colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff', '#ffa500', '#ff1493'];
    
    for (let i = 0; i < 100; i++) {
        setTimeout(() => {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.left = Math.random() * 100 + '%';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
            confetti.style.animationDelay = Math.random() * 0.5 + 's';
            container.appendChild(confetti);
            
            setTimeout(() => confetti.remove(), 5000);
        }, i * 30);
    }
}

// Trigger confetti on page load
window.addEventListener('load', () => {
    setTimeout(createConfetti, 500);
});

// Add celebratory sound effect (optional - uncomment if you want sound)
// const audio = new Audio('/sounds/success.mp3');
// audio.play().catch(() => {}); // Catch in case autoplay is blocked
</script>
@endsection
