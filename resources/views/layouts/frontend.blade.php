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
                        <a href="{{ route('migration.pr-calculator') }}" class="hover:text-yellow-300">PR Calculator</a>
                        <a href="{{ route('postcode-checker') }}" class="hover:text-yellow-300">Postcode Checker</a>
                        <a href="{{ route('study-australia.calculator') }}" class="hover:text-yellow-300">Student Visa Calculator</a>
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
                        <a href="{{ route('migration.pr-calculator') }}" class="hover:text-yellow-300 bg-blue-800 px-2 py-1 rounded">PR Calculator</a>
                        <a href="{{ route('postcode-checker') }}" class="hover:text-yellow-300 bg-blue-800 px-2 py-1 rounded">Postcode Checker</a>
                        <a href="{{ route('study-australia.calculator') }}" class="hover:text-yellow-300 bg-blue-800 px-2 py-1 rounded">Student Calculator</a>
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
                    <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
                    <a href="{{ route('about') }}" class="hover:text-blue-600">About</a>
                    
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
                        <div class="absolute left-0 mt-3 w-[600px] bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-20 transform group-hover:translate-y-0 translate-y-2">
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-8 h-8 bg-cyan-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-plane text-cyan-600 text-sm"></i>
                                    </div>
                                    <h6 class="font-bold text-gray-900 text-base">Visitor Visas & Other Countries</h6>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-6">
                                    <!-- Australian Visitor Visas -->
                                    <div>
                                        <h6 class="font-semibold text-gray-800 mb-3 text-sm">🇦🇺 Australian Visas</h6>
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
                                    
                                    <!-- Other Countries -->
                                    <div>
                                        <h6 class="font-semibold text-gray-800 mb-3 text-sm">🌍 Other Countries</h6>
                                        <div class="space-y-2">
                                            <a href="{{ route('other-countries.canada') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 rounded-lg transition-colors duration-200 group/item">
                                                <span class="group-hover/item:font-medium">🇨🇦 Canada</span>
                                            </a>
                                            <a href="{{ route('other-countries.new-zealand') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors duration-200 group/item">
                                                <span class="group-hover/item:font-medium">🇳🇿 New Zealand</span>
                                            </a>
                                            <a href="{{ route('other-countries.usa') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors duration-200 group/item">
                                                <span class="group-hover/item:font-medium">🇺🇸 United States</span>
                                            </a>
                                        </div>
                                        
                                        <!-- Quick Links -->
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <h6 class="font-semibold text-gray-800 mb-2 text-sm">Quick Links</h6>
                                            <div class="space-y-1">
                                                <a href="{{ route('visitor-visa.index') }}" class="block px-3 py-1 text-xs text-cyan-600 hover:text-cyan-800 font-medium">
                                                    View All Services →
                                                </a>
                                            </div>
                                        </div>
                                    </div>
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
                        <a href="{{ route('home') }}" class="flex items-center py-3 px-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200">
                            <i class="fas fa-home w-5 h-5 mr-3 text-blue-500"></i>
                            <span class="font-medium">Home</span>
                        </a>
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
                                <a href="{{ route('study-australia.calculator') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-calculator w-4 h-4 mr-2 text-blue-400"></i>Student Visa Calculator
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Migration Section -->
                    <div class="border-b border-gray-100">
                        <button onclick="toggleMobileSection('migration-section')" class="w-full flex items-center justify-between py-3 px-4 text-left text-gray-700 hover:bg-green-50 transition-colors duration-200">
                            <div class="flex items-center">
                                <i class="fas fa-passport w-5 h-5 mr-3 text-green-500"></i>
                                <span class="font-semibold">Migration</span>
                            </div>
                            <i id="migration-section-icon" class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
                        </button>
                        <div id="migration-section" class="hidden bg-gray-50">
                            <div class="px-4 py-2 space-y-1">
                                <a href="{{ route('migration.skilled-independent') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-star w-4 h-4 mr-2 text-green-400"></i>Skilled Independent (189)
                                </a>
                                <a href="{{ route('migration.skilled-nominated') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-map-marker-alt w-4 h-4 mr-2 text-green-400"></i>Skilled Nominated (190)
                                </a>
                                <a href="{{ route('migration.temporary-graduate') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-graduation-cap w-4 h-4 mr-2 text-green-400"></i>Graduate Visa (485)
                                </a>
                                <a href="{{ route('migration.pr-calculator') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-calculator w-4 h-4 mr-2 text-green-400"></i>PR Calculator
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Family Visa Section -->
                    <div class="border-b border-gray-100">
                        <button onclick="toggleMobileSection('family-section')" class="w-full flex items-center justify-between py-3 px-4 text-left text-gray-700 hover:bg-pink-50 transition-colors duration-200">
                            <div class="flex items-center">
                                <i class="fas fa-heart w-5 h-5 mr-3 text-pink-500"></i>
                                <span class="font-semibold">Family Visa</span>
                            </div>
                            <i id="family-section-icon" class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
                        </button>
                        <div id="family-section" class="hidden bg-gray-50">
                            <div class="px-4 py-2 space-y-1">
                                <a href="{{ route('family-visa.partner-provisional-309') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-heart w-4 h-4 mr-2 text-pink-400"></i>Partner Visa (309/100)
                                </a>
                                <a href="{{ route('family-visa.partner-provisional-820') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-heart w-4 h-4 mr-2 text-pink-400"></i>Partner Visa (820/801)
                                </a>
                                <a href="{{ route('family-visa.contributory-parent-143') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-users w-4 h-4 mr-2 text-pink-400"></i>Parent Visa (143)
                                </a>
                                <a href="{{ route('family-visa.child-visa-101') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-child w-4 h-4 mr-2 text-pink-400"></i>Child Visa (101)
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Visitor Visa Section -->
                    <div class="border-b border-gray-100">
                        <button onclick="toggleMobileSection('visitor-section')" class="w-full flex items-center justify-between py-3 px-4 text-left text-gray-700 hover:bg-cyan-50 transition-colors duration-200">
                            <div class="flex items-center">
                                <i class="fas fa-plane w-5 h-5 mr-3 text-cyan-500"></i>
                                <span class="font-semibold">Visitor Visa</span>
                            </div>
                            <i id="visitor-section-icon" class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
                        </button>
                        <div id="visitor-section" class="hidden bg-gray-50">
                            <div class="px-4 py-2 space-y-1">
                                <a href="{{ route('visitor-visa.600') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-cyan-600 hover:bg-cyan-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-plane w-4 h-4 mr-2 text-cyan-400"></i>Visitor Visa (600)
                                </a>
                                <a href="{{ route('visitor-visa.work-holiday-462') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-cyan-600 hover:bg-cyan-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-briefcase w-4 h-4 mr-2 text-cyan-400"></i>Work & Holiday (462)
                                </a>
                                <a href="{{ route('visitor-visa.work-holiday-417') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-cyan-600 hover:bg-cyan-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-briefcase w-4 h-4 mr-2 text-cyan-400"></i>Work & Holiday (417)
                                </a>
                                <a href="{{ route('visitor-visa.sponsored-family') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-cyan-600 hover:bg-cyan-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-users w-4 h-4 mr-2 text-cyan-400"></i>Sponsored Family
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Business Visa Section -->
                    <div class="border-b border-gray-100">
                        <button onclick="toggleMobileSection('business-section')" class="w-full flex items-center justify-between py-3 px-4 text-left text-gray-700 hover:bg-indigo-50 transition-colors duration-200">
                            <div class="flex items-center">
                                <i class="fas fa-briefcase w-5 h-5 mr-3 text-indigo-500"></i>
                                <span class="font-semibold">Business Visa</span>
                            </div>
                            <i id="business-section-icon" class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
                        </button>
                        <div id="business-section" class="hidden bg-gray-50">
                            <div class="px-4 py-2 space-y-1">
                                <a href="{{ route('business-visa.business-permanent-888') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-building w-4 h-4 mr-2 text-indigo-400"></i>Business Innovation (888)
                                </a>
                                <a href="{{ route('business-visa.business-provisional-188') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-building w-4 h-4 mr-2 text-indigo-400"></i>Business Innovation (188)
                                </a>
                                <a href="{{ route('business-visa.business-talent-132') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-star w-4 h-4 mr-2 text-indigo-400"></i>Business Talent (132)
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Employee Sponsored Section -->
                    <div class="border-b border-gray-100">
                        <button onclick="toggleMobileSection('employee-section')" class="w-full flex items-center justify-between py-3 px-4 text-left text-gray-700 hover:bg-purple-50 transition-colors duration-200">
                            <div class="flex items-center">
                                <i class="fas fa-user-tie w-5 h-5 mr-3 text-purple-500"></i>
                                <span class="font-semibold">Employee Sponsored</span>
                            </div>
                            <i id="employee-section-icon" class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
                        </button>
                        <div id="employee-section" class="hidden bg-gray-50">
                            <div class="px-4 py-2 space-y-1">
                                <a href="{{ route('employee-sponsored.tss-482') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-id-card w-4 h-4 mr-2 text-purple-400"></i>TSS Visa (482)
                                </a>
                                <a href="{{ route('employee-sponsored.ens-186-trt') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-check-circle w-4 h-4 mr-2 text-purple-400"></i>ENS 186 TRT
                                </a>
                                <a href="{{ route('employee-sponsored.gti') }}" class="block py-2 px-6 text-sm text-gray-600 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-rocket w-4 h-4 mr-2 text-purple-400"></i>GTI Program
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
