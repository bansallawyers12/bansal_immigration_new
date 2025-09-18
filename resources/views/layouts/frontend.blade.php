<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('seoinfo')  <!-- Dynamic SEO from child views -->
    <title>@yield('title', 'Bansal Immigration - Your Future, Our Priority')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])  <!-- Vite for Tailwind/Alpine -->
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
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="/" class="text-2xl font-bold text-blue-600">Bansal Immigration</a>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-6">
                    <a href="/" class="hover:text-blue-600">Home</a>
                    
                    <!-- Study in Australia Dropdown -->
                    <div class="relative group">
                        <a href="/study-australia" class="hover:text-blue-600 flex items-center">
                            Study in Australia <span class="ml-1">▾</span>
                        </a>
                        <div class="absolute left-0 mt-2 w-64 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-10">
                            <div class="py-2">
                                <a href="{{ route('study-australia.admission') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Admission in Australia</a>
                                <a href="{{ route('study-australia.student-dependent') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Student Dependent Visa</a>
                                <a href="{{ route('study-australia.student-extension') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Student Visa Extension</a>
                                <a href="{{ route('study-australia.calculator') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Financial Calculator</a>
                            </div>
                        </div>
                    </div>

                    <!-- Migration Dropdown -->
                    <div class="relative group">
                        <a href="/migration" class="hover:text-blue-600 flex items-center">
                            Migration <span class="ml-1">▾</span>
                        </a>
                        <div class="absolute left-0 mt-2 w-64 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-10">
                            <div class="py-2">
                                <a href="{{ route('migration.skilled-independent') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Skilled Independent (189)</a>
                                <a href="{{ route('migration.skilled-nominated') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Skilled Nominated (190)</a>
                                <a href="{{ route('migration.temporary-graduate') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Graduate Visa (485)</a>
                                <a href="{{ route('migration.pr-calculator') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">PR Points Calculator</a>
                            </div>
                        </div>
                    </div>

                    <!-- Family Visa Dropdown -->
                    <div class="relative group">
                        <a href="/family-visa" class="hover:text-blue-600 flex items-center">
                            Family Visa <span class="ml-1">▾</span>
                        </a>
                        <div class="absolute left-0 mt-2 w-64 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-10">
                            <div class="py-2">
                                <a href="{{ route('family-visa.partner-provisional-309') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Partner Visa (309/100)</a>
                                <a href="{{ route('family-visa.partner-provisional-820') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Partner Visa (820/801)</a>
                                <a href="{{ route('family-visa.contributory-parent-143') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Parent Visa (143)</a>
                                <a href="{{ route('family-visa.child-visa-101') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Child Visa (101)</a>
                            </div>
                        </div>
                    </div>

                    <!-- Visitor Visa -->
                    <a href="/visitor-visa" class="hover:text-blue-600">Visitor Visa</a>

                    <!-- Business Visa -->
                    <a href="/business-visas" class="hover:text-blue-600">Business Visa</a>

                    <!-- More Dropdown -->
                    <div class="relative group">
                        <span class="hover:text-blue-600 cursor-pointer flex items-center">
                            More <span class="ml-1">▾</span>
                        </span>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-10">
                            <div class="py-2">
                                <a href="/appeals" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Appeals</a>
                                <a href="/citizenship" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Citizenship</a>
                                <a href="/employee-sponsored-visas" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Employer Sponsored</a>
                                <a href="{{ route('testimonials') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Testimonials</a>
                                <a href="/blogs" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Blogs</a>
                            </div>
                        </div>
                    </div>

                    <a href="/book-an-appointment" class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-500 transition-colors">Book Appointment</a>
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
                    <a href="/" class="block py-2 text-gray-700 hover:text-blue-600">Home</a>
                    <a href="/study-australia" class="block py-2 text-gray-700 hover:text-blue-600">Study in Australia</a>
                    <a href="/migration" class="block py-2 text-gray-700 hover:text-blue-600">Migration</a>
                    <a href="/family-visa" class="block py-2 text-gray-700 hover:text-blue-600">Family Visa</a>
                    <a href="/visitor-visa" class="block py-2 text-gray-700 hover:text-blue-600">Visitor Visa</a>
                    <a href="/business-visas" class="block py-2 text-gray-700 hover:text-blue-600">Business Visa</a>
                    <a href="/appeals" class="block py-2 text-gray-700 hover:text-blue-600">Appeals</a>
                    <a href="/citizenship" class="block py-2 text-gray-700 hover:text-blue-600">Citizenship</a>
                    <a href="/blogs" class="block py-2 text-gray-700 hover:text-blue-600">Blogs</a>
                    <a href="/book-an-appointment" class="block py-2 bg-yellow-400 text-black text-center rounded mt-4">Book Appointment</a>
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
