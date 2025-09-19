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
        .hero-area { background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/img/Frontend/bg-2.jpg'); }
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
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center space-x-4">
                        <span><i class="fas fa-phone"></i> +61 396021330</span>
                        <span><i class="fas fa-envelope"></i> info@bansalimmigration.com</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('migration.pr-calculator') }}" class="hover:text-yellow-300">PR Calculator</a>
                        <a href="{{ route('postcode-checker') }}" class="hover:text-yellow-300">Postcode Checker</a>
                        <a href="{{ route('study-australia.calculator') }}" class="hover:text-yellow-300">Student Visa Calculator</a>
                        <a href="{{ route('appointment') }}" class="bg-yellow-400 text-black px-3 py-1 rounded text-xs">Book Appointment</a>
                    </div>
                </div>
            </div>
        </div>

        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">Bansal Immigration</a>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
                    <a href="{{ route('about') }}" class="hover:text-blue-600">About</a>
                    <a href="{{ route('services') }}" class="hover:text-blue-600">Services</a>
                    
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
                                        <a href="{{ route('study-australia.training-visa') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Training Visa (407)</span>
                                        </a>
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
                                        <a href="{{ route('study-australia.calculator') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition-colors duration-200 group/item">
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

                    <!-- Migration Dropdown -->
                    <div class="relative group">
                        <a href="{{ route('migration.index') }}" class="hover:text-blue-600 flex items-center">
                            Migration <span class="ml-1">▾</span>
                        </a>
                        <div class="absolute left-0 mt-3 w-[600px] bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-20 transform group-hover:translate-y-0 translate-y-2">
                            <div class="grid grid-cols-3 gap-0">
                                <div class="p-6 border-r border-gray-100">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-user-graduate text-blue-600 text-sm"></i>
                                        </div>
                                        <h6 class="font-bold text-gray-900 text-base">Graduate & Permanent</h6>
                                    </div>
                                    <div class="space-y-2">
                                        <a href="{{ route('migration.temporary-graduate') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Temporary Graduate (485)</span>
                                        </a>
                                        <a href="{{ route('migration.post-study-work') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Post Study Work (485)</span>
                                        </a>
                                        <a href="{{ route('migration.skilled-graduate') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Skilled Graduate (476)</span>
                                        </a>
                                        <a href="{{ route('migration.skilled-independent') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Skilled Independent (189)</span>
                                        </a>
                                        <a href="{{ route('migration.skilled-nominated') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Skilled Nominated (190)</span>
                                        </a>
                                        <a href="{{ route('migration.skilled-regional') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Skilled Regional (887)</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-6 border-r border-gray-100">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-map-marker-alt text-green-600 text-sm"></i>
                                        </div>
                                        <h6 class="font-bold text-gray-900 text-base">Regional & Assessment</h6>
                                    </div>
                                    <div class="space-y-2">
                                        <a href="{{ route('migration.pr-skilled-regional') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">PR Skilled Regional (191)</span>
                                        </a>
                                        <a href="{{ route('migration.skilled-work-regional') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Skilled Work Regional (491)</span>
                                        </a>
                                        <a href="{{ route('migration.acs-assessment') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">ACS Assessment</span>
                                        </a>
                                        <a href="{{ route('migration.vetassess-assessment') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">VETASSESS</span>
                                        </a>
                                        <a href="{{ route('migration.job-ready-program') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Job Ready Program</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-calculator text-purple-600 text-sm"></i>
                                        </div>
                                        <h6 class="font-bold text-gray-900 text-base">Tools & More</h6>
                                    </div>
                                    <div class="space-y-2">
                                        <a href="{{ route('migration.ea-assessment') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">EA Assessment</span>
                                        </a>
                                        <a href="{{ route('migration.accountant-assessment') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Accountant Assessment</span>
                                        </a>
                                        <a href="{{ route('migration.nursing-assessment') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Nursing Assessment</span>
                                        </a>
                                        <a href="{{ route('migration.pr-calculator') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">PR Points Calculator</span>
                                        </a>
                                        <a href="{{ route('migration.regional-points') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Regional Points</span>
                                        </a>
                                        <a href="{{ route('migration.english-points') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">English Points</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Family Visa Dropdown -->
                    <div class="relative group">
                        <a href="{{ route('family-visa.index') }}" class="hover:text-blue-600 flex items-center">
                            Family Visa <span class="ml-1">▾</span>
                        </a>
                        <div class="absolute left-0 mt-3 w-[600px] bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-20 transform group-hover:translate-y-0 translate-y-2">
                            <div class="grid grid-cols-3 gap-0">
                                <div class="p-6 border-r border-gray-100">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-pink-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-heart text-pink-600 text-sm"></i>
                                        </div>
                                        <h6 class="font-bold text-gray-900 text-base">Partner & Parent</h6>
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
                                <div class="p-6 border-r border-gray-100">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-users text-orange-600 text-sm"></i>
                                        </div>
                                        <h6 class="font-bold text-gray-900 text-base">More Parent Visas</h6>
                                    </div>
                                    <div class="space-y-2">
                                        <a href="{{ route('family-visa.contributory-aged-parent-884') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Contributory Aged Parent (884)</span>
                                        </a>
                                        <a href="{{ route('family-visa.contributory-aged-parent-864') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Contributory Aged Parent (864)</span>
                                        </a>
                                        <a href="{{ route('family-visa.contributory-parent-173') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Contributory Parent (173)</span>
                                        </a>
                                        <a href="{{ route('family-visa.aged-parent-804') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Aged Parent (804)</span>
                                        </a>
                                        <a href="{{ route('family-visa.sponsored-parent-870') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Sponsored Parent (870)</span>
                                        </a>
                                        <a href="{{ route('family-visa.child-visa-101') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Child Visa (101)</span>
                                        </a>
                                        <a href="{{ route('family-visa.child-visa-802') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Child Visa (802)</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-teal-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-child text-teal-600 text-sm"></i>
                                        </div>
                                        <h6 class="font-bold text-gray-900 text-base">Child & Other</h6>
                                    </div>
                                    <div class="space-y-2">
                                        <a href="{{ route('family-visa.adoption-visa') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Adoption Visa</span>
                                        </a>
                                        <a href="{{ route('family-visa.remaining-relative-115') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Remaining Relative (115)</span>
                                        </a>
                                        <a href="{{ route('family-visa.remaining-relative-835') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Remaining Relative (835)</span>
                                        </a>
                                        <a href="{{ route('family-visa.orphan-relative-117') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Orphan Relative (117)</span>
                                        </a>
                                        <a href="{{ route('family-visa.orphan-relative-837') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Orphan Relative (837)</span>
                                        </a>
                                        <a href="{{ route('family-visa.dependent-child') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Dependent Child</span>
                                        </a>
                                        <a href="{{ route('family-visa.carer-offshore-116') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Carer Visa (116)</span>
                                        </a>
                                        <a href="{{ route('family-visa.carer-onshore-836') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Carer Visa (836)</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Visitor Visa Dropdown -->
                    <div class="relative group">
                        <a href="{{ route('visitor-visa.index') }}" class="hover:text-blue-600 flex items-center">
                            Visitor Visa <span class="ml-1">▾</span>
                        </a>
                        <div class="absolute left-0 mt-3 w-80 bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-20 transform group-hover:translate-y-0 translate-y-2">
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-8 h-8 bg-cyan-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-plane text-cyan-600 text-sm"></i>
                                    </div>
                                    <h6 class="font-bold text-gray-900 text-base">Visitor Visas</h6>
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
                                    <a href="{{ route('visitor-visa.offshore-extension') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-cyan-700 rounded-lg transition-colors duration-200 group/item">
                                        <span class="group-hover/item:font-medium">Offshore Tourist Extension</span>
                                    </a>
                                    <a href="{{ route('visitor-visa.travel-exemption') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-cyan-50 hover:text-cyan-700 rounded-lg transition-colors duration-200 group/item">
                                        <span class="group-hover/item:font-medium">Travel Exemption</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Business Visa Dropdown -->
                    <div class="relative group">
                        <a href="{{ route('business-visa.index') }}" class="hover:text-blue-600 flex items-center">
                            Business Visa <span class="ml-1">▾</span>
                        </a>
                        <div class="absolute left-0 mt-3 w-80 bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-20 transform group-hover:translate-y-0 translate-y-2">
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-briefcase text-indigo-600 text-sm"></i>
                                    </div>
                                    <h6 class="font-bold text-gray-900 text-base">Business Visas</h6>
                                </div>
                                <div class="space-y-2">
                                    <a href="{{ route('business-visa.business-permanent-888') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors duration-200 group/item">
                                        <span class="group-hover/item:font-medium">Business Innovation (888)</span>
                                    </a>
                                    <a href="{{ route('business-visa.business-provisional-188') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors duration-200 group/item">
                                        <span class="group-hover/item:font-medium">Business Innovation (188)</span>
                                    </a>
                                    <a href="{{ route('business-visa.business-talent-132') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors duration-200 group/item">
                                        <span class="group-hover/item:font-medium">Business Talent (132)</span>
                                    </a>
                                    <a href="{{ route('business-visa.visa-checklists') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors duration-200 group/item">
                                        <span class="group-hover/item:font-medium">Visa Checklists</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Employee Sponsored Dropdown -->
                    <div class="relative group">
                        <a href="{{ route('employee-sponsored.index') }}" class="hover:text-blue-600 flex items-center">
                            Employee Sponsored <span class="ml-1">▾</span>
                        </a>
                        <div class="absolute left-0 mt-3 w-[600px] bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-20 transform group-hover:translate-y-0 translate-y-2">
                            <div class="grid grid-cols-3 gap-0">
                                <div class="p-6 border-r border-gray-100">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-clock text-blue-600 text-sm"></i>
                                        </div>
                                        <h6 class="font-bold text-gray-900 text-base">Temporary Visas</h6>
                                    </div>
                                    <div class="space-y-2">
                                        <a href="{{ route('employee-sponsored.tss-482') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">TSS Visa (482)</span>
                                        </a>
                                        <a href="{{ route('employee-sponsored.dama') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">DAMA</span>
                                        </a>
                                        <a href="{{ route('employee-sponsored.skilled-regional-494') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Skilled Regional (494)</span>
                                        </a>
                                        <a href="{{ route('employee-sponsored.temporary-activity-408') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Temporary Activity (408)</span>
                                        </a>
                                        <a href="{{ route('employee-sponsored.short-stay-400') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Short Stay (400)</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-6 border-r border-gray-100">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-check-circle text-green-600 text-sm"></i>
                                        </div>
                                        <h6 class="font-bold text-gray-900 text-base">Permanent Visas</h6>
                                    </div>
                                    <div class="space-y-2">
                                        <a href="{{ route('employee-sponsored.ens-186-trt') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">ENS 186 TRT</span>
                                        </a>
                                        <a href="{{ route('employee-sponsored.ens-186-direct') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">ENS 186 Direct</span>
                                        </a>
                                        <a href="{{ route('employee-sponsored.distinguished-talent-124') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Distinguished Talent (124)</span>
                                        </a>
                                        <a href="{{ route('employee-sponsored.distinguished-talent-858') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">Distinguished Talent (858)</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-star text-purple-600 text-sm"></i>
                                        </div>
                                        <h6 class="font-bold text-gray-900 text-base">Global Talent</h6>
                                    </div>
                                    <div class="space-y-2">
                                        <a href="{{ route('employee-sponsored.gti') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">GTI Program</span>
                                        </a>
                                        <a href="{{ route('employee-sponsored.gtes') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition-colors duration-200 group/item">
                                            <span class="group-hover/item:font-medium">GTES Program</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- More Dropdown -->
                    <div class="relative group">
                        <span class="hover:text-blue-600 cursor-pointer flex items-center">
                            More <span class="ml-1">▾</span>
                        </span>
                        <div class="absolute right-0 mt-3 w-80 bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-20 transform group-hover:translate-y-0 translate-y-2">
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-ellipsis-h text-gray-600 text-sm"></i>
                                    </div>
                                    <h6 class="font-bold text-gray-900 text-base">More Services</h6>
                                </div>
                                <div class="space-y-2">
                                    <a href="{{ route('appeals.index') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-700 rounded-lg transition-colors duration-200 group/item">
                                        <span class="group-hover/item:font-medium">Appeals</span>
                                    </a>
                                    <a href="{{ route('citizenship.index') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-700 rounded-lg transition-colors duration-200 group/item">
                                        <span class="group-hover/item:font-medium">Citizenship</span>
                                    </a>
                                    <a href="{{ route('other-countries.canada') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-700 rounded-lg transition-colors duration-200 group/item">
                                        <span class="group-hover/item:font-medium">Other Countries</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('blogs') }}" class="hover:text-blue-600">Blog</a>
                    <a href="{{ route('success-stories') }}" class="hover:text-blue-600">Success Stories</a>
                    <a href="{{ route('contact') }}" class="hover:text-blue-600">Contact</a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="lg:hidden hidden mt-4 pb-4">
                <div class="space-y-2">
                    <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-blue-600">Home</a>
                    <a href="{{ route('about') }}" class="block py-2 text-gray-700 hover:text-blue-600">About</a>
                    <a href="{{ route('services') }}" class="block py-2 text-gray-700 hover:text-blue-600">Services</a>
                    
                    <!-- Study in Australia Mobile -->
                    <div class="border-l-2 border-blue-200 pl-4 ml-2">
                        <div class="font-semibold text-gray-800 mb-2">Study in Australia</div>
                        <a href="{{ route('study-australia.admission') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Admission in Australia</a>
                        <a href="{{ route('study-australia.student-dependent') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Student Dependent Visa (500)</a>
                        <a href="{{ route('study-australia.student-extension') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Student Visa Extension</a>
                        <a href="{{ route('study-australia.student-guardian') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Student Guardian Visa (590)</a>
                        <a href="{{ route('study-australia.student-journey') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Student Visa Journey</a>
                        <a href="{{ route('study-australia.student-subsequent') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Student Subsequent Visa</a>
                        <a href="{{ route('study-australia.student-info') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Student Visa Information</a>
                        <a href="{{ route('study-australia.training-visa') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Training Visa (407)</a>
                        <a href="{{ route('study-australia.calculator') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Student Visa Financial Calculator</a>
                    </div>
                    
                    <!-- Migration Mobile -->
                    <div class="border-l-2 border-blue-200 pl-4 ml-2">
                        <div class="font-semibold text-gray-800 mb-2">Migration</div>
                        <a href="{{ route('migration.skilled-independent') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Skilled Independent (189)</a>
                        <a href="{{ route('migration.skilled-nominated') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Skilled Nominated (190)</a>
                        <a href="{{ route('migration.temporary-graduate') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Graduate Visa (485)</a>
                        <a href="{{ route('migration.pr-calculator') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">PR Calculator</a>
                    </div>
                    
                    <!-- Family Visa Mobile -->
                    <div class="border-l-2 border-blue-200 pl-4 ml-2">
                        <div class="font-semibold text-gray-800 mb-2">Family Visa</div>
                        <a href="{{ route('family-visa.partner-provisional-309') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Partner Visa (309/100)</a>
                        <a href="{{ route('family-visa.partner-provisional-820') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Partner Visa (820/801)</a>
                        <a href="{{ route('family-visa.contributory-parent-143') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Parent Visa (143)</a>
                        <a href="{{ route('family-visa.child-visa-101') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Child Visa (101)</a>
                    </div>
                    
                    <!-- Visitor Visa Mobile -->
                    <div class="border-l-2 border-blue-200 pl-4 ml-2">
                        <div class="font-semibold text-gray-800 mb-2">Visitor Visa</div>
                        <a href="{{ route('visitor-visa.600') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Visitor Visa (600)</a>
                        <a href="{{ route('visitor-visa.work-holiday-462') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Work & Holiday (462)</a>
                        <a href="{{ route('visitor-visa.work-holiday-417') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Work & Holiday (417)</a>
                        <a href="{{ route('visitor-visa.sponsored-family') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Sponsored Family</a>
                    </div>
                    
                    <!-- Business Visa Mobile -->
                    <div class="border-l-2 border-blue-200 pl-4 ml-2">
                        <div class="font-semibold text-gray-800 mb-2">Business Visa</div>
                        <a href="{{ route('business-visa.business-permanent-888') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Business Innovation (888)</a>
                        <a href="{{ route('business-visa.business-provisional-188') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Business Innovation (188)</a>
                        <a href="{{ route('business-visa.business-talent-132') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Business Talent (132)</a>
                        <a href="{{ route('business-visa.visa-checklists') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Visa Checklists</a>
                    </div>
                    
                    <!-- Employee Sponsored Mobile -->
                    <div class="border-l-2 border-blue-200 pl-4 ml-2">
                        <div class="font-semibold text-gray-800 mb-2">Employee Sponsored</div>
                        <a href="{{ route('employee-sponsored.tss-482') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">TSS Visa (482)</a>
                        <a href="{{ route('employee-sponsored.ens-186-trt') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">ENS 186 TRT</a>
                        <a href="{{ route('employee-sponsored.gti') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">GTI Program</a>
                        <a href="{{ route('employee-sponsored.distinguished-talent-124') }}" class="block py-1 text-sm text-gray-600 hover:text-blue-600">Distinguished Talent (124)</a>
                    </div>
                    
                    <a href="{{ route('appeals.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">Appeals</a>
                    <a href="{{ route('citizenship.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">Citizenship</a>
                    <a href="{{ route('other-countries.canada') }}" class="block py-2 text-gray-700 hover:text-blue-600">Other Countries</a>
                    <a href="{{ route('blogs') }}" class="block py-2 text-gray-700 hover:text-blue-600">Blog</a>
                    <a href="{{ route('success-stories') }}" class="block py-2 text-gray-700 hover:text-blue-600">Success Stories</a>
                    <a href="{{ route('contact') }}" class="block py-2 text-gray-700 hover:text-blue-600">Contact</a>
                    <a href="{{ route('appointment') }}" class="block py-2 bg-yellow-400 text-black text-center rounded mt-4">Book Appointment</a>
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

        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    </script>
    @stack('scripts')
    @yield('scripts')
</body>
</html>
