<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('seoinfo')  <!-- Dynamic SEO from child views -->
    <title>@yield('title', 'Bansal Immigration - Your Future, Our Priority')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])  <!-- Vite for Tailwind/Alpine -->
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Add Bootstrap if preferred: <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <style>
        /* Inline styles from your files (e.g., hero bg, team colors) */
        .hero-area { background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/img/homepage.jpg'); }
        .meet_us { background-color: #1a365d; color: white; }
        .cryptos-btn { background: #ddcc14; color: #000; padding: 10px 20px; border-radius: 5px; text-decoration: none; }
        /* Add more from your truncated styles as needed */
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header/Navigation -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <!-- Top Header Bar -->
        <div class="bg-blue-900 text-white py-2">
            <div class="container mx-auto px-4">
                <!-- Desktop Layout -->
                <div class="hidden lg:flex justify-between items-center text-sm">
                    <div class="flex items-center space-x-4">
                        <span><i class="fas fa-phone"></i> +61 396021330</span>
                        <span><i class="fas fa-envelope"></i> info@bansalimmigration.com</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('migrate-to-australia.pr-calculator') }}" class="hover:text-yellow-300">PR Calculator</a>
                        <a href="{{ route('postcode-checker') }}" class="hover:text-yellow-300">Postcode Checker</a>
                        <a href="/study-australia/student-visa-financial-calculator" class="hover:text-yellow-300">Student Visa Calculator</a>
                        <a href="{{ route('appointment') }}" class="bg-yellow-400 text-black px-3 py-1 rounded text-xs">Book Appointment</a>
                    </div>
                </div>
                
                <!-- Mobile Layout -->
                <div class="lg:hidden">
                    <!-- Contact Info Row -->
                    <div class="flex flex-col space-y-1 text-xs mb-2">
                        <div class="flex items-center">
                            <i class="fas fa-phone mr-2"></i>
                            <span>+61 396021330</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-envelope mr-2"></i>
                            <span>info@bansalimmigration.com</span>
                        </div>
                    </div>
                    
                    <!-- Utility Links Row -->
                    <div class="flex flex-wrap gap-2 text-xs">
                        <a href="{{ route('migrate-to-australia.pr-calculator') }}" class="hover:text-yellow-300 bg-blue-800 px-2 py-1 rounded">PR Calculator</a>
                        <a href="{{ route('postcode-checker') }}" class="hover:text-yellow-300 bg-blue-800 px-2 py-1 rounded">Postcode Checker</a>
                        <a href="/study-australia/student-visa-financial-calculator" class="hover:text-yellow-300 bg-blue-800 px-2 py-1 rounded">Student Calculator</a>
                        <a href="{{ route('appointment') }}" class="bg-yellow-400 text-black px-2 py-1 rounded font-semibold">Book Appointment</a>
                    </div>
                </div>
            </div>
        </div>

        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">Bansal Immigration</a>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-6">
                    
                    <!-- Study in Australia Dropdown -->
                    <div class="relative group">
                        <a href="{{ route('study-australia.index') }}" class="hover:text-blue-600 flex items-center">
                            Study in Australia <span class="ml-1">▾</span>
                        </a>
                        <div class="absolute left-0 mt-3 w-[600px] bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-20 transform group-hover:translate-y-0 translate-y-2">
                            <div class="grid grid-cols-3 gap-0">
                                <div class="p-6 border-r border-gray-100">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-graduation-cap text-blue-600 text-sm"></i>
                                        </div>
                                        <h6 class="font-bold text-gray-900 text-base">Education</h6>
                                    </div>
                                    <div class="space-y-2">
                                        <a href="{{ route('study-australia.admission') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Admission in Australia</span>
                                        </a>
                                        <a href="{{ route('study-australia.new-coe') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">New COE</span>
                                        </a>
                                        <a href="{{ route('study-australia.course-change') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Course Change in Australia</span>
                                        </a>
                                        <a href="{{ route('study-australia.rpl') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">What is RPL Australia?</span>
                                        </a>
                                        <a href="{{ route('study-australia.professional-year') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Professional Year Program</span>
                                        </a>
                                        <a href="{{ route('study-australia.defer-studies') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Request to Defer Your Studies</span>
                                        </a>
                                        <a href="{{ route('study-australia.affiliations') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Our Affiliations</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-6 border-r border-gray-100">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-passport text-green-600 text-sm"></i>
                                        </div>
                                        <h6 class="font-bold text-gray-900 text-base">Student Visas</h6>
                                    </div>
                                    <div class="space-y-2">
                                        <a href="{{ route('study-australia.student-dependent') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Student Dependent Visa (500)</span>
                                        </a>
                                        <a href="{{ route('study-australia.student-extension') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Student Visa Extension</span>
                                        </a>
                                        <a href="{{ route('study-australia.student-guardian') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Student Guardian Visa (590)</span>
                                        </a>
                                        <a href="{{ route('study-australia.student-journey') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Student Visa Journey</span>
                                        </a>
                                        <a href="{{ route('study-australia.student-subsequent') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Student Subsequent Visa</span>
                                        </a>
                                        <a href="{{ route('study-australia.student-info') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Student Visa Information</span>
                                        </a>
                                        <!-- Training Visa 407 moved to Employer Sponsored -->
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-tools text-purple-600 text-sm"></i>
                                        </div>
                                        <h6 class="font-bold text-gray-900 text-base">Tools & Resources</h6>
                                    </div>
                                    <div class="space-y-2">
                                        <a href="/study-australia/student-visa-financial-calculator" class="block px-3 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Student Visa Financial Calculator</span>
                                        </a>
                                        <a href="{{ route('study-australia.tourist-to-student') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Tourist to Student Visa</span>
                                        </a>
                                        <a href="{{ route('study-australia.master-to-diploma') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Master to Diploma Student Visa</span>
                                        </a>
                                        <a href="{{ route('study-australia.dependent-to-student') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Student Dependent to Student Visa</span>
                                        </a>
                                        <a href="{{ route('study-australia.afp-ipc') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Apply AFP / IPC Form</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Migrate to Australia Dropdown -->
                    <div class="relative group">
                        <a href="{{ route('migrate-to-australia.index') }}" class="hover:text-blue-600 flex items-center">
                            Migrate to Australia <span class="ml-1">▾</span>
                        </a>
                        <div class="absolute left-0 mt-3 w-[900px] bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-20 transform group-hover:translate-y-0 translate-y-2">
                            <div class="grid grid-cols-4 gap-0">
                                <!-- Skilled Migration -->
                                <div class="p-6 border-r border-gray-100">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-user-graduate text-blue-600 text-sm"></i>
                                        </div>
                                        <h6 class="font-bold text-gray-900 text-base">Skilled Migration</h6>
                                    </div>
                                    <div class="space-y-2">
                                        <a href="{{ route('migrate-to-australia.temporary-graduate') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Temporary Graduate (485)</span>
                                        </a>
                                        <a href="{{ route('migrate-to-australia.post-study-work') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Post Study Work (485)</span>
                                        </a>
                                        <a href="{{ route('migrate-to-australia.skilled-independent') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Skilled Independent (189)</span>
                                        </a>
                                        <a href="{{ route('migrate-to-australia.skilled-nominated') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Skilled Nominated (190)</span>
                                        </a>
                                        <a href="{{ route('migrate-to-australia.skilled-regional') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Skilled Regional (887)</span>
                                        </a>
                                        <a href="{{ route('migrate-to-australia.pr-skilled-regional') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">PR Skilled Regional (191)</span>
                                        </a>
                                        <a href="{{ route('migrate-to-australia.skilled-work-regional') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Skilled Work Regional (491)</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Family Visas -->
                                <div class="p-6 border-r border-gray-100">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-pink-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-heart text-pink-600 text-sm"></i>
                                        </div>
                                        <h6 class="font-bold text-gray-900 text-base">Family Visas</h6>
                                    </div>
                                    <div class="space-y-2">
                                        <a href="{{ route('family-visa.partner-provisional-309') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Partner Provisional (309)</span>
                                        </a>
                                        <a href="{{ route('family-visa.partner-permanent-100') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Partner Permanent (100)</span>
                                        </a>
                                        <a href="{{ route('family-visa.partner-provisional-820') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Partner Provisional (820)</span>
                                        </a>
                                        <a href="{{ route('family-visa.partner-permanent-801') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Partner Permanent (801)</span>
                                        </a>
                                        <a href="{{ route('family-visa.prospective-marriage') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Prospective Marriage (300)</span>
                                        </a>
                                        <a href="{{ route('family-visa.contributory-parent-143') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Contributory Parent (143)</span>
                                        </a>
                                        <a href="{{ route('family-visa.parent-visa-103') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Parent Visa (103)</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Visitor & Work Visas -->
                                <div class="p-6 border-r border-gray-100">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-cyan-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-plane text-cyan-600 text-sm"></i>
                                        </div>
                                        <h6 class="font-bold text-gray-900 text-base">Visitor & Work Visas</h6>
                                    </div>
                                    <div class="space-y-2">
                                        <a href="{{ route('visitor-visa.600') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-cyan-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Visitor Visa (600)</span>
                                        </a>
                                        <a href="{{ route('visitor-visa.work-holiday-462') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-cyan-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Work & Holiday (462)</span>
                                        </a>
                                        <a href="{{ route('visitor-visa.work-holiday-417') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-cyan-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Work & Holiday (417)</span>
                                        </a>
                                        <a href="{{ route('visitor-visa.sponsored-family') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-cyan-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Sponsored Family</span>
                                        </a>
                                        <a href="{{ route('visitor-visa.onshore-extension') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-cyan-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Onshore Visitor Visa Extension</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Business & Employer Sponsored -->
                                <div class="p-6">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-briefcase text-indigo-600 text-sm"></i>
                                        </div>
                                        <h6 class="font-bold text-gray-900 text-base">Business & Employer</h6>
                                    </div>
                                    <div class="space-y-2">
                                        <a href="{{ route('business-visa.business-permanent-888') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Business Innovation (888)</span>
                                        </a>
                                        <a href="{{ route('employer-sponsored.sid-482') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Skill in Demand Visa (482)</span>
                                        </a>
                                        <a href="{{ route('employer-sponsored.ens-186-trt') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">ENS 186 TRT</span>
                                        </a>
                                        <a href="{{ route('employer-sponsored.ens-186-direct') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">ENS 186 Direct</span>
                                        </a>
                                        <a href="{{ route('employer-sponsored.gti') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">GTI Program</span>
                                        </a>
                                        <a href="{{ route('employer-sponsored.gtes') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">GTES Program</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Celebrity Visas -->
                    <a href="{{ route('celebrity-visas.index') }}" class="hover:text-blue-600">Celebrity Visas</a>
                    
                    <!-- Skill Assessment -->
                    <a href="{{ route('skill-assessment.index') }}" class="hover:text-blue-600">Skill Assessment</a>
                    
                    <!-- Appeals -->
                    <a href="{{ route('appeals.index') }}" class="hover:text-blue-600">Appeals</a>
                    
                    <!-- Citizenship -->
                    <a href="{{ route('citizenship.index') }}" class="hover:text-blue-600">Citizenship</a>

                    <a href="{{ route('blogs') }}" class="hover:text-blue-600">Blog</a>
                    <a href="{{ route('success-stories') }}" class="hover:text-blue-600">Success Stories</a>
                    <a href="{{ route('contact') }}" class="hover:text-blue-600">Contact</a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg id="menu-icon" class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="close-icon" class="w-6 h-6 text-gray-700 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="lg:hidden hidden mt-4 pb-4 transform transition-all duration-300 ease-in-out opacity-0 -translate-y-4">
                <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
                    <!-- Main Navigation Items -->
                    <div class="px-4 py-2 border-b border-gray-100">
                        <a href="{{ route('about') }}" class="flex items-center py-3 px-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200">
                            <i class="fas fa-info-circle w-5 h-5 mr-3 text-blue-500"></i>
                            <span class="font-medium">About</span>
                        </a>
                    </div>

                    <!-- Study in Australia Section -->
                    <div class="border-b border-gray-100">
                        <button onclick="toggleMobileSection('study-section')" class="w-full flex items-center justify-between py-3 px-4 text-left text-gray-700 hover:bg-blue-50 transition-colors duration-200">
                            <div class="flex items-center">
                                <i class="fas fa-graduation-cap w-5 h-5 mr-3 text-blue-500"></i>
                                <span class="font-semibold">Study in Australia</span>
                            </div>
                            <i id="study-section-icon" class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
                        </button>
                        <div id="study-section" class="hidden bg-gray-50">
                            <div class="px-4 py-2 space-y-1">
                                <a href="{{ route('study-australia.admission') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-university w-4 h-4 mr-2 text-blue-400"></i>Admission in Australia
                                </a>
                                <a href="{{ route('study-australia.student-dependent') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-user-friends w-4 h-4 mr-2 text-blue-400"></i>Student Dependent Visa (500)
                                </a>
                                <a href="{{ route('study-australia.student-extension') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-clock w-4 h-4 mr-2 text-blue-400"></i>Student Visa Extension
                                </a>
                                <a href="{{ route('study-australia.student-guardian') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-shield-alt w-4 h-4 mr-2 text-blue-400"></i>Student Guardian Visa (590)
                                </a>
                                <a href="/study-australia/student-visa-financial-calculator" class="block py-2 px-6 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-calculator w-4 h-4 mr-2 text-blue-400"></i>Student Visa Calculator
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Migrate to Australia Section -->
                    <div class="border-b border-gray-100">
                        <button onclick="toggleMobileSection('migrate-section')" class="w-full flex items-center justify-between py-3 px-4 text-left text-gray-700 hover:bg-green-50 transition-colors duration-200">
                            <div class="flex items-center">
                                <i class="fas fa-plane w-5 h-5 mr-3 text-green-500"></i>
                                <span class="font-semibold">Migrate to Australia</span>
                            </div>
                            <i id="migrate-section-icon" class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
                        </button>
                        <div id="migrate-section" class="hidden bg-gray-50">
                            <div class="px-4 py-2 space-y-1">
                                <!-- Skilled Migration -->
                                <div class="mb-4">
                                    <h6 class="font-semibold text-gray-800 mb-2 text-sm px-2">Skilled Migration</h6>
                                    <a href="{{ route('migrate-to-australia.skilled-independent') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors duration-200">
                                        <i class="fas fa-star w-4 h-4 mr-2 text-green-400"></i>Skilled Independent (189)
                                    </a>
                                    <a href="{{ route('migrate-to-australia.skilled-nominated') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors duration-200">
                                        <i class="fas fa-map-marker-alt w-4 h-4 mr-2 text-green-400"></i>Skilled Nominated (190)
                                    </a>
                                    <a href="{{ route('migrate-to-australia.temporary-graduate') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors duration-200">
                                        <i class="fas fa-graduation-cap w-4 h-4 mr-2 text-green-400"></i>Graduate Visa (485)
                                    </a>
                                </div>

                                <!-- Family Visas -->
                                <div class="mb-4">
                                    <h6 class="font-semibold text-gray-800 mb-2 text-sm px-2">Family Visas</h6>
                                    <a href="{{ route('family-visa.partner-provisional-309') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition-colors duration-200">
                                        <i class="fas fa-heart w-4 h-4 mr-2 text-pink-400"></i>Partner Visa (309/100)
                                    </a>
                                    <a href="{{ route('family-visa.partner-provisional-820') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition-colors duration-200">
                                        <i class="fas fa-heart w-4 h-4 mr-2 text-pink-400"></i>Partner Visa (820/801)
                                    </a>
                                    <a href="{{ route('family-visa.contributory-parent-143') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition-colors duration-200">
                                        <i class="fas fa-users w-4 h-4 mr-2 text-pink-400"></i>Parent Visa (143)
                                    </a>
                                </div>

                                <!-- Visitor & Work Visas -->
                                <div class="mb-4">
                                    <h6 class="font-semibold text-gray-800 mb-2 text-sm px-2">Visitor & Work Visas</h6>
                                    <a href="{{ route('visitor-visa.600') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-cyan-600 hover:bg-cyan-50 rounded-lg transition-colors duration-200">
                                        <i class="fas fa-plane w-4 h-4 mr-2 text-cyan-400"></i>Visitor Visa (600)
                                    </a>
                                    <a href="{{ route('visitor-visa.work-holiday-462') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-cyan-600 hover:bg-cyan-50 rounded-lg transition-colors duration-200">
                                        <i class="fas fa-briefcase w-4 h-4 mr-2 text-cyan-400"></i>Work & Holiday (462)
                                    </a>
                                    <a href="{{ route('visitor-visa.work-holiday-417') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-cyan-600 hover:bg-cyan-50 rounded-lg transition-colors duration-200">
                                        <i class="fas fa-briefcase w-4 h-4 mr-2 text-cyan-400"></i>Work & Holiday (417)
                                    </a>
                                </div>

                                <!-- Business & Employer Sponsored -->
                                <div class="mb-4">
                                    <h6 class="font-semibold text-gray-800 mb-2 text-sm px-2">Business & Employer</h6>
                                    <a href="{{ route('business-visa.business-permanent-888') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200">
                                        <i class="fas fa-building w-4 h-4 mr-2 text-indigo-400"></i>Business Innovation (888)
                                    </a>
                                    <a href="{{ route('employer-sponsored.sid-482') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200">
                                        <i class="fas fa-id-card w-4 h-4 mr-2 text-indigo-400"></i>Skill in Demand Visa (482)
                                    </a>
                                    <a href="{{ route('employer-sponsored.gti') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200">
                                        <i class="fas fa-rocket w-4 h-4 mr-2 text-indigo-400"></i>GTI Program
                                    </a>
                                </div>

                                <!-- Tools -->
                                <div class="mb-4">
                                    <h6 class="font-semibold text-gray-800 mb-2 text-sm px-2">Tools</h6>
                                    <a href="{{ route('migrate-to-australia.pr-calculator') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors duration-200">
                                        <i class="fas fa-calculator w-4 h-4 mr-2 text-green-400"></i>PR Calculator
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Celebrity Visas Section -->
                    <div class="border-b border-gray-100">
                        <button onclick="toggleMobileSection('celebrity-section')" class="w-full flex items-center justify-between py-3 px-4 text-left text-gray-700 hover:bg-yellow-50 transition-colors duration-200">
                            <div class="flex items-center">
                                <i class="fas fa-star w-5 h-5 mr-3 text-yellow-500"></i>
                                <span class="font-semibold">Celebrity Visas</span>
                            </div>
                            <i id="celebrity-section-icon" class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
                        </button>
                        <div id="celebrity-section" class="hidden bg-gray-50">
                            <div class="px-4 py-2 space-y-1">
                                <a href="{{ route('celebrity-visas.index') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-yellow-600 hover:bg-yellow-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-star w-4 h-4 mr-2 text-yellow-400"></i>Celebrity Visas
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Skill Assessment Section -->
                    <div class="border-b border-gray-100">
                        <button onclick="toggleMobileSection('skill-section')" class="w-full flex items-center justify-between py-3 px-4 text-left text-gray-700 hover:bg-green-50 transition-colors duration-200">
                            <div class="flex items-center">
                                <i class="fas fa-tools w-5 h-5 mr-3 text-green-500"></i>
                                <span class="font-semibold">Skill Assessment</span>
                            </div>
                            <i id="skill-section-icon" class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
                        </button>
                        <div id="skill-section" class="hidden bg-gray-50">
                            <div class="px-4 py-2 space-y-1">
                                <a href="{{ route('skill-assessment.index') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-tools w-4 h-4 mr-2 text-green-400"></i>Skill Assessment
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Other Services -->
                    <div class="px-4 py-2 space-y-1">
                        <a href="{{ route('appeals.index') }}" class="flex items-center py-3 px-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 rounded-lg transition-colors duration-200">
                            <i class="fas fa-gavel w-5 h-5 mr-3 text-gray-500"></i>
                            <span class="font-medium">Appeals</span>
                        </a>
                        <a href="{{ route('citizenship.index') }}" class="flex items-center py-3 px-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 rounded-lg transition-colors duration-200">
                            <i class="fas fa-flag w-5 h-5 mr-3 text-gray-500"></i>
                            <span class="font-medium">Citizenship</span>
                        </a>
                        <a href="{{ route('other-countries.canada') }}" class="flex items-center py-3 px-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 rounded-lg transition-colors duration-200">
                            <i class="fas fa-globe w-5 h-5 mr-3 text-gray-500"></i>
                            <span class="font-medium">Other Countries</span>
                        </a>
                        <a href="{{ route('blogs') }}" class="flex items-center py-3 px-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 rounded-lg transition-colors duration-200">
                            <i class="fas fa-blog w-5 h-5 mr-3 text-gray-500"></i>
                            <span class="font-medium">Blog</span>
                        </a>
                        <a href="{{ route('success-stories') }}" class="flex items-center py-3 px-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 rounded-lg transition-colors duration-200">
                            <i class="fas fa-trophy w-5 h-5 mr-3 text-gray-500"></i>
                            <span class="font-medium">Success Stories</span>
                        </a>
                        <a href="{{ route('contact') }}" class="flex items-center py-3 px-3 text-gray-700 hover:bg-gray-50 hover:text-gray-900 rounded-lg transition-colors duration-200">
                            <i class="fas fa-envelope w-5 h-5 mr-3 text-gray-500"></i>
                            <span class="font-medium">Contact</span>
                        </a>
                    </div>

                    <!-- Book Appointment CTA -->
                    <div class="px-4 py-3 bg-gradient-to-r from-yellow-400 to-yellow-500">
                        <a href="{{ route('appointment') }}" class="flex items-center justify-center py-3 px-4 bg-white text-black font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                            <i class="fas fa-calendar-check w-5 h-5 mr-2"></i>
                            Book Appointment
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Footer (stubbed; add your details) -->
    <footer class="bg-blue-900 text-white py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2025 Bansal Immigration Consultants. All rights reserved.</p>
            <p>Level 8/278 Collins St, Melbourne VIC 3000, Australia | +61 396021330</p>
        </div>
    </footer>

    <!-- Global Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script>
        // Remove loading screen when page loads
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });

        // Mobile menu toggle with smooth animation
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            const isHidden = mobileMenu.classList.contains('hidden');
            
            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                // Trigger reflow to ensure the element is visible before animation
                mobileMenu.offsetHeight;
                mobileMenu.classList.remove('opacity-0', 'transform', '-translate-y-4');
                mobileMenu.classList.add('opacity-100', 'transform', 'translate-y-0');
                // Switch icons
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('opacity-0', 'transform', '-translate-y-4');
                mobileMenu.classList.remove('opacity-100', 'transform', 'translate-y-0');
                // Switch icons
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                // Hide after animation completes
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            
            if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('opacity-0', 'transform', '-translate-y-4');
                    mobileMenu.classList.remove('opacity-100', 'transform', 'translate-y-0');
                    // Switch icons
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                    }, 300);
                }
            }
        });

        // Function to toggle mobile menu sections
        function toggleMobileSection(sectionId) {
            const section = document.getElementById(sectionId);
            const icon = document.getElementById(sectionId + '-icon');
            const isHidden = section.classList.contains('hidden');
            
            if (isHidden) {
                section.classList.remove('hidden');
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
                // Smooth slide down animation
                section.style.maxHeight = '0px';
                section.style.overflow = 'hidden';
                section.style.transition = 'max-height 0.3s ease-in-out';
                setTimeout(() => {
                    section.style.maxHeight = section.scrollHeight + 'px';
                }, 10);
            } else {
                section.style.maxHeight = '0px';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                setTimeout(() => {
                    section.classList.add('hidden');
                    section.style.maxHeight = '';
                    section.style.overflow = '';
                    section.style.transition = '';
                }, 300);
            }
        }
    </script>
    @stack('scripts')
    @yield('scripts')
</body>
</html>
