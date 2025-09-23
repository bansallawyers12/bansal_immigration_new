<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bansal Immigration - Expert Australian Migration Services</title>
    <meta name="description" content="Professional Australian immigration consultants helping you achieve permanent residency, study abroad, and family reunification in Australia. MARA registered migration agents.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
                        url('/img/Frontend/bg-2.jpg');
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
</head>
<body class="font-sg bg-white">
    <!-- Header Section -->
    <header class="bg-white header-shadow">
        <!-- Main Navigation Bar -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center group logo-hover">
                        <img src="/img/logo/logo.jpg" alt="Bansal Immigration" class="h-12 sm:h-14 lg:h-16 w-auto object-contain group-hover:scale-105 transition-transform duration-300">
                    </a>
                </div>

                <!-- Main Menu Items - Services -->
                <nav class="hidden lg:flex items-center space-x-8">
                    <a href="/study-australia" class="nav-link text-sg-dark-gray hover:text-sg-light-blue font-medium transition-colors duration-200">Study in Australia</a>
                    <a href="/migration" class="nav-link text-sg-dark-gray hover:text-sg-light-blue font-medium transition-colors duration-200">Skilled Migration</a>
                    <a href="/family-visa" class="nav-link text-sg-dark-gray hover:text-sg-light-blue font-medium transition-colors duration-200">Partner Visas</a>
                    <a href="/visitor-visa" class="nav-link text-sg-dark-gray hover:text-sg-light-blue font-medium transition-colors duration-200">Visitor Visas</a>
                    <a href="/business-visas" class="nav-link text-sg-dark-gray hover:text-sg-light-blue font-medium transition-colors duration-200">Business Visas</a>
                    <a href="/employer-sponsored" class="nav-link text-sg-dark-gray hover:text-sg-light-blue font-medium transition-colors duration-200">Employer Sponsored</a>
                    <a href="/citizenship" class="nav-link text-sg-dark-gray hover:text-sg-light-blue font-medium transition-colors duration-200">Citizenship</a>
                    <a href="/appeals" class="nav-link text-sg-dark-gray hover:text-sg-light-blue font-medium transition-colors duration-200">Appeals</a>
                </nav>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-3">
                    <button class="text-sg-dark-gray hover:text-sg-light-blue p-2 rounded-lg hover:bg-gray-100 transition-all duration-200">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                    <a href="/appointment" class="btn-primary px-6 py-2 rounded-lg text-sm font-semibold whitespace-nowrap">
                        Book Consultation
                    </a>
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-button" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                        <i class="fas fa-bars text-xl text-sg-dark-gray"></i>
        </button>
    </div>
            </div>
        </div>

        <!-- Sub-Navigation/General Pages Bar -->
        <div class="bg-sg-light-gray border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-wrap items-center justify-center py-4 space-x-8 text-sm">
                    <!-- General Pages -->
                    <a href="/about" class="sg-dark-gray hover:text-sg-light-blue flex items-center px-3 py-2 rounded-lg hover:bg-white transition-all duration-200 font-medium">
                        <i class="fas fa-info-circle mr-2 text-sg-light-blue"></i>About
                    </a>
                    <a href="/blogs" class="sg-dark-gray hover:text-sg-light-blue flex items-center px-3 py-2 rounded-lg hover:bg-white transition-all duration-200 font-medium">
                        <i class="fas fa-blog mr-2 text-sg-light-blue"></i>Blog
                    </a>
                    <a href="/success-stories" class="sg-dark-gray hover:text-sg-light-blue flex items-center px-3 py-2 rounded-lg hover:bg-white transition-all duration-200 font-medium">
                        <i class="fas fa-trophy mr-2 text-sg-light-blue"></i>Success Stories
                    </a>
                    <a href="/contact" class="sg-dark-gray hover:text-sg-light-blue flex items-center px-3 py-2 rounded-lg hover:bg-white transition-all duration-200 font-medium">
                        <i class="fas fa-envelope mr-2 text-sg-light-blue"></i>Contact
                    </a>
                    
                    <!-- Separator -->
                    <div class="h-6 w-px bg-gray-300"></div>
                    
                    <!-- Tools & Calculators -->
                    <a href="/migration.pr-calculator" class="sg-dark-gray hover:text-sg-light-blue flex items-center px-3 py-2 rounded-lg hover:bg-white transition-all duration-200 font-medium">
                        <i class="fas fa-calculator mr-2 text-sg-light-blue"></i>PR Calculator
                    </a>
                    <a href="/postcode-checker" class="sg-dark-gray hover:text-sg-light-blue flex items-center px-3 py-2 rounded-lg hover:bg-white transition-all duration-200 font-medium">
                        <i class="fas fa-map-marker-alt mr-2 text-sg-light-blue"></i>Postcode Checker
                    </a>
                    <a href="/study-australia.calculator" class="sg-dark-gray hover:text-sg-light-blue flex items-center px-3 py-2 rounded-lg hover:bg-white transition-all duration-200 font-medium">
                        <i class="fas fa-graduation-cap mr-2 text-sg-light-blue"></i>Student Calculator
                    </a>
                </div>
            </div>
        </div>


        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden hidden bg-white border-t border-gray-200">
            <div class="px-4 py-6">
                <!-- Service Pages Section -->
                <div class="mb-6">
                    <h3 class="text-sm font-semibold text-sg-navy mb-3 uppercase tracking-wide">Our Services</h3>
                    <div class="space-y-2">
                        <a href="/study-australia" class="block py-2 text-sg-dark-gray hover:text-sg-light-blue font-medium">Study in Australia</a>
                        <a href="/migration" class="block py-2 text-sg-dark-gray hover:text-sg-light-blue font-medium">Skilled Migration</a>
                        <a href="/family-visa" class="block py-2 text-sg-dark-gray hover:text-sg-light-blue font-medium">Partner Visas</a>
                        <a href="/visitor-visa" class="block py-2 text-sg-dark-gray hover:text-sg-light-blue font-medium">Visitor Visas</a>
                        <a href="/business-visas" class="block py-2 text-sg-dark-gray hover:text-sg-light-blue font-medium">Business Visas</a>
                        <a href="/employer-sponsored" class="block py-2 text-sg-dark-gray hover:text-sg-light-blue font-medium">Employer Sponsored</a>
                        <a href="/citizenship" class="block py-2 text-sg-dark-gray hover:text-sg-light-blue font-medium">Citizenship</a>
                        <a href="/appeals" class="block py-2 text-sg-dark-gray hover:text-sg-light-blue font-medium">Appeals</a>
                    </div>
                </div>
                
                <!-- General Pages Section -->
                <div class="mb-6">
                    <h3 class="text-sm font-semibold text-sg-navy mb-3 uppercase tracking-wide">Company</h3>
                    <div class="space-y-2">
                        <a href="/about" class="block py-2 text-sg-dark-gray hover:text-sg-light-blue font-medium">About</a>
                        <a href="/blogs" class="block py-2 text-sg-dark-gray hover:text-sg-light-blue font-medium">Blog</a>
                        <a href="/success-stories" class="block py-2 text-sg-dark-gray hover:text-sg-light-blue font-medium">Success Stories</a>
                        <a href="/contact" class="block py-2 text-sg-dark-gray hover:text-sg-light-blue font-medium">Contact</a>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div class="pt-4 border-t border-gray-200">
                    <a href="tel:+61396021330" class="block py-2 text-sg-light-blue font-medium">
                        <i class="fas fa-phone mr-2"></i>Call +61 3 9602 1330
                    </a>
                </div>
                    </div>
                    </div>
    </header>

    <!-- Floating Call Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="tel:+61396021330" class="bg-sg-light-blue hover:bg-sg-navy text-white p-4 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110">
            <i class="fas fa-phone text-xl"></i>
        </a>
                    </div>

    <!-- Floating Call Me Back Button -->
    <div class="fixed right-0 top-1/2 transform -translate-y-1/2 z-50">
        <a href="/contact" class="bg-sg-navy hover:bg-sg-light-blue text-white px-2 py-6 sm:px-4 sm:py-8 rounded-l-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
            <span class="font-semibold text-xs sm:text-sm writing-mode-vertical-rl text-orientation-mixed" style="writing-mode: vertical-rl; text-orientation: mixed;">Request Call Back</span>
        </a>
                    </div>

    <!-- Hero Section -->
    <section class="hero-bg min-h-screen flex items-center relative">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0"></div>
        
        <!-- Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-2xl">
                <!-- Hero Overlay Box -->
                <div class="hero-overlay p-8 rounded-lg shadow-2xl">
                    <h1 class="text-5xl md:text-6xl font-bold sg-navy mb-6 leading-tight">
                        Your Australian Dream Starts Here
                    </h1>
                    <p class="text-xl sg-dark-gray mb-8 leading-relaxed">
                        Professional Australian immigration consultants helping you achieve permanent residency, study abroad, and family reunification in Australia. MARA registered migration agents.
                    </p>
                    <a href="/appointment" class="btn-primary px-8 py-4 rounded-lg text-lg font-semibold inline-block">
                        Book Free Consultation
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- How we can help you Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold sg-navy mb-4">How we can help you</h2>
            </div>
            
            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Study in Australia -->
                <div class="service-card bg-white p-6 rounded-lg text-center">
                    <div class="service-icon mx-auto mb-4">
                        <i class="fas fa-graduation-cap text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold sg-dark-gray mb-2">Study in Australia</h3>
                    <a href="/study-australia" class="sg-light-blue text-sm font-medium hover:underline">Find out more</a>
                </div>

                <!-- Skilled Migration -->
                <div class="service-card bg-white p-6 rounded-lg text-center">
                    <div class="service-icon mx-auto mb-4">
                        <i class="fas fa-briefcase text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold sg-dark-gray mb-2">Skilled Migration</h3>
                    <a href="/migration" class="sg-light-blue text-sm font-medium hover:underline">Find out more</a>
                </div>

                <!-- Family Visas -->
                <div class="service-card bg-white p-6 rounded-lg text-center">
                    <div class="service-icon mx-auto mb-4">
                        <i class="fas fa-heart text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold sg-dark-gray mb-2">Family Visas</h3>
                    <a href="/family-visa" class="sg-light-blue text-sm font-medium hover:underline">Find out more</a>
                </div>

                <!-- Visitor Visas -->
                <div class="service-card bg-white p-6 rounded-lg text-center">
                    <div class="service-icon mx-auto mb-4">
                        <i class="fas fa-plane text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold sg-dark-gray mb-2">Visitor Visas</h3>
                    <a href="/visitor-visa" class="sg-light-blue text-sm font-medium hover:underline">Find out more</a>
                </div>

                <!-- Business Visas -->
                <div class="service-card bg-white p-6 rounded-lg text-center">
                    <div class="service-icon mx-auto mb-4">
                        <i class="fas fa-chart-line text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold sg-dark-gray mb-2">Business Visas</h3>
                    <a href="/business-visas" class="sg-light-blue text-sm font-medium hover:underline">Find out more</a>
                </div>

                <!-- Employer Sponsored -->
                <div class="service-card bg-white p-6 rounded-lg text-center">
                    <div class="service-icon mx-auto mb-4">
                        <i class="fas fa-user-tie text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold sg-dark-gray mb-2">Employer Sponsored</h3>
                    <a href="/employer-sponsored" class="sg-light-blue text-sm font-medium hover:underline">Find out more</a>
                </div>

                <!-- Appeals & Reviews -->
                <div class="service-card bg-white p-6 rounded-lg text-center">
                    <div class="service-icon mx-auto mb-4">
                        <i class="fas fa-gavel text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold sg-dark-gray mb-2">Appeals & Reviews</h3>
                    <a href="/appeals" class="sg-light-blue text-sm font-medium hover:underline">Find out more</a>
                </div>

                <!-- Citizenship -->
                <div class="service-card bg-white p-6 rounded-lg text-center">
                    <div class="service-icon mx-auto mb-4">
                        <i class="fas fa-flag text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold sg-dark-gray mb-2">Citizenship</h3>
                    <a href="/citizenship" class="sg-light-blue text-sm font-medium hover:underline">Find out more</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Immigration Services Section (Customized for Bansal Immigration) -->
    <section class="py-20 bg-sg-light-gray">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold sg-navy mb-4">Our Immigration Services</h2>
                <p class="text-xl sg-medium-gray max-w-3xl mx-auto">Professional migration services tailored to your needs</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Study Visa -->
                <div class="service-card bg-white p-8 rounded-lg">
                    <div class="service-icon mx-auto mb-6">
                        <i class="fas fa-graduation-cap text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold sg-navy mb-4">Study in Australia</h3>
                    <p class="sg-medium-gray mb-6">Pursue your education dreams in Australia's world-class universities with our expert guidance.</p>
                    <a href="/study-australia" class="sg-light-blue font-semibold hover:underline">Learn More <i class="fas fa-arrow-right ml-2"></i></a>
                </div>

                <!-- Skilled Migration -->
                <div class="service-card bg-white p-8 rounded-lg">
                    <div class="service-icon mx-auto mb-6">
                        <i class="fas fa-briefcase text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold sg-navy mb-4">Skilled Migration</h3>
                    <p class="sg-medium-gray mb-6">Fast-track your permanent residency through Australia's skilled migration programs.</p>
                    <a href="/migration" class="sg-light-blue font-semibold hover:underline">Learn More <i class="fas fa-arrow-right ml-2"></i></a>
                </div>

                <!-- Family Visa -->
                <div class="service-card bg-white p-8 rounded-lg">
                    <div class="service-icon mx-auto mb-6">
                        <i class="fas fa-heart text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold sg-navy mb-4">Family Reunification</h3>
                    <p class="sg-medium-gray mb-6">Bring your loved ones together with our comprehensive family visa services.</p>
                    <a href="/family-visa" class="sg-light-blue font-semibold hover:underline">Learn More <i class="fas fa-arrow-right ml-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold sg-navy mb-4">Why Choose Bansal Immigration?</h2>
                <p class="text-xl sg-medium-gray max-w-3xl mx-auto">We're not just consultants; we're your partners in achieving your migration dreams</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="w-20 h-20 bg-sg-sky-blue rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-certificate text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold sg-navy mb-4">MARA Registered</h3>
                    <p class="sg-medium-gray">All our migration agents are registered with the Migration Agents Registration Authority (MARA).</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-20 h-20 bg-sg-sky-blue rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-chart-line text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold sg-navy mb-4">Proven Track Record</h3>
                    <p class="sg-medium-gray">With over 10 years of experience and 5000+ successful cases, we have the expertise you need.</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-20 h-20 bg-sg-sky-blue rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-users text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold sg-navy mb-4">Personalized Service</h3>
                    <p class="sg-medium-gray">Every case is unique. We provide personalized attention and customized solutions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="py-20 bg-sg-light-gray">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold sg-navy mb-4">Latest from Our Blog</h2>
                <p class="text-xl sg-medium-gray max-w-3xl mx-auto">Stay updated with the latest immigration news, tips, and insights from our experts</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @if(isset($blogLists) && $blogLists->count() > 0)
                    @foreach($blogLists as $blog)
                        <article class="service-card bg-white p-6 rounded-lg">
                            @if($blog->image)
                                <div class="mb-4">
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->image_alt ?? $blog->title }}" class="w-full h-48 object-cover rounded-lg">
                                </div>
                            @endif
                            <div class="mb-4">
                                <span class="text-sm text-sg-light-blue font-medium">{{ $blog->created_at->format('M d, Y') }}</span>
                            </div>
                            <h3 class="text-xl font-bold sg-navy mb-3 line-clamp-2">{{ $blog->title }}</h3>
                            <p class="sg-medium-gray mb-4 line-clamp-3">{{ $blog->short_description }}</p>
                            <a href="/blogs/{{ $blog->slug }}" class="sg-light-blue font-semibold hover:underline">
                                Read More <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </article>
                    @endforeach
                @else
                    <!-- Fallback content when no blogs are available -->
                    <div class="col-span-full text-center py-12">
                        <i class="fas fa-blog text-6xl text-sg-light-blue mb-4"></i>
                        <h3 class="text-2xl font-bold sg-navy mb-2">Blog Coming Soon</h3>
                        <p class="sg-medium-gray">We're preparing valuable content for you. Check back soon!</p>
                    </div>
                @endif
            </div>
            
            <div class="text-center">
                <a href="/blogs" class="btn-primary px-8 py-4 rounded-lg text-lg font-semibold inline-block">
                    <i class="fas fa-blog mr-2"></i>View All Blogs
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold sg-navy mb-4">What Our Clients Say</h2>
                <p class="text-xl sg-medium-gray max-w-3xl mx-auto">Real stories from real people who achieved their Australian dreams with our help</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @if(isset($testimonials) && count($testimonials) > 0)
                    @foreach($testimonials as $testimonial)
                        <div class="service-card bg-white p-8 rounded-lg text-center">
                            <div class="flex justify-center mb-4">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star text-yellow-400 text-lg"></i>
                                @endfor
                            </div>
                            <blockquote class="sg-medium-gray mb-6 italic text-lg leading-relaxed">
                                "{{ $testimonial['text'] }}"
                            </blockquote>
                            <div class="border-t border-gray-200 pt-4">
                                <h4 class="font-bold sg-navy text-lg">{{ $testimonial['name'] }}</h4>
                                <p class="text-sg-light-blue font-medium">{{ $testimonial['visa_type'] }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback content when no testimonials are available -->
                    <div class="col-span-full text-center py-12">
                        <i class="fas fa-quote-left text-6xl text-sg-light-blue mb-4"></i>
                        <h3 class="text-2xl font-bold sg-navy mb-2">Client Testimonials</h3>
                        <p class="sg-medium-gray">Hear from our satisfied clients about their success stories.</p>
                    </div>
                @endif
            </div>
            
            <div class="text-center">
                <a href="/success-stories" class="btn-secondary px-8 py-4 rounded-lg text-lg font-semibold inline-block">
                    <i class="fas fa-trophy mr-2"></i>View Success Stories
                </a>
            </div>
        </div>
    </section>

    <!-- Our Team Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold sg-navy mb-4">Meet Our Expert Team</h2>
                <p class="text-xl sg-medium-gray max-w-3xl mx-auto">Professional migration agents with years of experience helping you achieve your Australian dreams</p>
            </div>
            
            <!-- Team Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <!-- Arun Bansal - Director -->
                <div class="service-card bg-white p-8 rounded-lg text-center">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-sg-light-blue shadow-lg mb-6">
                        <img src="/img/team/arun-bansal.jpg" alt="Arun Bansal" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-2xl font-bold sg-navy mb-2">Arun Bansal</h3>
                    <p class="text-sg-light-blue font-semibold mb-4">Director (MARN: 2418466)</p>
                    <p class="sg-medium-gray text-sm leading-relaxed">
                        Director of Bansal Immigration Consultants with 10+ years of legal and migration experience, offering expert guidance backed by LLM and Migration Law qualifications.
                    </p>
                    </div>
                
                <!-- Vipul Goyal -->
                <div class="service-card bg-white p-8 rounded-lg text-center">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-sg-light-blue shadow-lg mb-6">
                        <img src="/img/team/vipul-goyal.jpg" alt="Vipul Goyal" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-2xl font-bold sg-navy mb-2">Vipul Goyal</h3>
                    <p class="text-sg-light-blue font-semibold mb-4">Migration Agent (MARA: 2418571)</p>
                    <p class="sg-medium-gray text-sm leading-relaxed">
                        Provides expert guidance across skilled, student, and family visas with deep legal knowledge and a client-focused approach.
                    </p>
                </div>
                
                <!-- Mandeep Singh -->
                <div class="service-card bg-white p-8 rounded-lg text-center">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-sg-light-blue shadow-lg mb-6">
                        <img src="/img/team/mandeep-singh.jpg" alt="Mandeep Singh" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-2xl font-bold sg-navy mb-2">Mandeep Singh</h3>
                    <p class="text-sg-light-blue font-semibold mb-4">Migration Agent (MARA: 2518789)</p>
                    <p class="sg-medium-gray text-sm leading-relaxed">
                        Offers expert support in student, partner, and skilled visas, guiding clients with clarity, precision, and personalised migration solutions.
                    </p>
                                </div>
                
                <!-- Iqbal Singh Sran -->
                <div class="service-card bg-white p-8 rounded-lg text-center">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-sg-light-blue shadow-lg mb-6">
                        <img src="/img/team/iqbal-singh-sran.jpg" alt="Iqbal Singh Sran" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-2xl font-bold sg-navy mb-2">Iqbal Singh Sran</h3>
                    <p class="text-sg-light-blue font-semibold mb-4">Migration Agent (MARA: 2418677)</p>
                    <p class="sg-medium-gray text-sm leading-relaxed">
                        Specialises in student, partner, and skilled visas, delivering trusted advice and personalised solutions to make every migration journey smooth and successful.
                    </p>
                                </div>
                
                <!-- Yadwinder Pal Singh -->
                <div class="service-card bg-white p-8 rounded-lg text-center">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-sg-light-blue shadow-lg mb-6">
                        <img src="/img/team/yadwinder-pal-singh.jpg" alt="Yadwinder Pal Singh" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-2xl font-bold sg-navy mb-2">Yadwinder Pal Singh</h3>
                    <p class="text-sg-light-blue font-semibold mb-4">Migration Agent (MARA: 2519042)</p>
                    <p class="sg-medium-gray text-sm leading-relaxed">
                        Specialises in Employer Sponsored, Skilled, Partner, Student, and Temporary Residence visas with an empathetic and personalised approach.
                    </p>
                                </div>
                            </div>
            
            <!-- CTA -->
            <div class="text-center">
                <a href="/contact" class="btn-primary px-8 py-4 rounded-lg text-lg font-semibold inline-block">
                    <i class="fas fa-envelope mr-2"></i>Contact Our Team
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-sg-light-gray">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Side - Text Content -->
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold mb-6 text-sg-navy">We're here to help</h2>
                    <p class="text-xl text-sg-dark-gray leading-relaxed">Start your migration journey today. Or, if you have a question, get in touch with our team.</p>
            </div>
                
                <!-- Right Side - Three Action Buttons -->
                <div class="space-y-4">
                    <!-- Book an Appointment -->
                    <a href="/appointment" class="block w-full bg-sg-navy text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-sg-light-blue transition-colors text-center shadow-lg">
                        <i class="fas fa-calendar-alt mr-2"></i>Book an Appointment
                    </a>
                    
                    <!-- Make an Enquiry -->
                    <a href="/contact" class="block w-full bg-sg-light-blue text-sg-navy px-8 py-4 rounded-lg font-bold text-lg hover:bg-sg-sky-blue hover:text-white transition-colors text-center shadow-lg">
                        <i class="fas fa-envelope mr-2"></i>Make an Enquiry
                    </a>
                    
                    <!-- Call Us -->
                    <a href="tel:+61396021330" class="block w-full bg-white border-2 border-gray-300 text-sg-navy px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-50 transition-colors text-center shadow-lg">
                        <i class="fas fa-phone mr-2"></i>Call us on +61 3 9602 1330
                            </a>
                        </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info & Call Button -->
                <div>
                    <div class="mb-6">
                        <img src="/img/logo/logo.jpg" alt="Bansal Immigration" class="h-12 sm:h-14 lg:h-16 w-auto object-contain mb-4">
                        <div class="text-sm text-sg-light-blue font-medium">MARA Registered Migration Agents</div>
                    </div>
                    
                    <!-- Call Button -->
                    <a href="tel:+61396021330" class="inline-flex items-center px-6 py-3 border-2 border-sg-light-blue text-sg-navy rounded-lg font-semibold hover:bg-sg-light-blue hover:text-white transition-colors duration-300 mb-4">
                        <i class="fas fa-phone mr-2 text-sg-light-blue"></i>Call +61 3 9602 1330
                    </a>
                    
                    <p class="text-sg-navy text-sm mb-4">To see our consultation terms and conditions</p>
                    </div>
                
                <!-- Services -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 text-sg-navy">Our Services</h3>
                    <ul class="space-y-2 text-sm text-sg-navy">
                        <li><a href="/study-australia" class="hover:text-sg-light-blue transition-colors">Study in Australia</a></li>
                        <li><a href="/migration" class="hover:text-sg-light-blue transition-colors">Skilled Migration</a></li>
                        <li><a href="/family-visa" class="hover:text-sg-light-blue transition-colors">Partner Visas</a></li>
                        <li><a href="/visitor-visa" class="hover:text-sg-light-blue transition-colors">Visitor Visas</a></li>
                        <li><a href="/business-visas" class="hover:text-sg-light-blue transition-colors">Business Visas</a></li>
                        <li><a href="/employer-sponsored" class="hover:text-sg-light-blue transition-colors">Employer Sponsored</a></li>
                        <li><a href="/citizenship" class="hover:text-sg-light-blue transition-colors">Citizenship</a></li>
                        <li><a href="/appeals" class="hover:text-sg-light-blue transition-colors">Appeals & Reviews</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 text-sg-navy">Company</h3>
                    <ul class="space-y-2 text-sm text-sg-navy">
                        <li><a href="/about" class="hover:text-sg-light-blue transition-colors">About Us</a></li>
                        <li><a href="/team" class="hover:text-sg-light-blue transition-colors">Our Team</a></li>
                        <li><a href="/blogs" class="hover:text-sg-light-blue transition-colors">Blog</a></li>
                        <li><a href="/success-stories" class="hover:text-sg-light-blue transition-colors">Success Stories</a></li>
                        <li><a href="/contact" class="hover:text-sg-light-blue transition-colors">Contact</a></li>
                        <li><a href="/mission-vision" class="hover:text-sg-light-blue transition-colors">Mission & Vision</a></li>
                        <li><a href="/why-choose" class="hover:text-sg-light-blue transition-colors">Why Choose Us</a></li>
                    </ul>
                </div>

                <!-- Contact & Branches -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 text-sg-navy">Contact & Branches</h3>
                    
                    <!-- Melbourne Office -->
                    <div class="mb-4">
                        <h4 class="text-sm font-semibold text-sg-navy mb-2">MELBOURNE</h4>
                        <div class="space-y-1 text-sm text-sg-navy">
                            <p class="flex items-start"><i class="fas fa-map-marker-alt mr-2 text-sg-light-blue mt-1"></i>Level 8/278 Collins St<br>Melbourne VIC 3000, Australia</p>
                            <p class="flex items-center"><i class="fas fa-phone mr-2 text-sg-light-blue"></i>+61 3 9602 1330</p>
                            <p class="flex items-center"><i class="fas fa-envelope mr-2 text-sg-light-blue"></i><a href="mailto:melbourne@bansalimmigration.com.au" class="hover:text-sg-light-blue transition-colors">melbourne@bansalimmigration.com.au</a></p>
                    </div>
                </div>

                    <!-- Adelaide Office -->
                    <div class="mb-4">
                        <h4 class="text-sm font-semibold text-sg-navy mb-2">ADELAIDE</h4>
                        <div class="space-y-1 text-sm text-sg-navy">
                            <p class="flex items-start"><i class="fas fa-map-marker-alt mr-2 text-sg-light-blue mt-1"></i>Unit 5 5/55 Gawler Pl<br>Adelaide SA 5000, Australia</p>
                            <p class="flex items-center"><i class="fas fa-phone mr-2 text-sg-light-blue"></i>0400434884</p>
                            <p class="flex items-center"><i class="fas fa-envelope mr-2 text-sg-light-blue"></i><a href="mailto:adelaide@bansalimmigration.com.au" class="hover:text-sg-light-blue transition-colors">adelaide@bansalimmigration.com.au</a></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bottom Footer -->
            <div class="border-t border-gray-300 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-sm text-sg-navy mb-4 md:mb-0">
                        <p>&copy; 2024 Bansal Immigration. All rights reserved. | MARA Registered Migration Agents</p>
                    </div>
                    <div class="flex space-x-6 text-sm text-sg-navy">
                        <a href="/privacy-policy" class="hover:text-sg-light-blue transition-colors">Privacy Policy</a>
                        <a href="/terms-of-service" class="hover:text-sg-light-blue transition-colors">Terms of Service</a>
                        <a href="/disclaimer" class="hover:text-sg-light-blue transition-colors">Disclaimer</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
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
        });
    </script>
</body>
</html>