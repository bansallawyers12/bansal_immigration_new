@extends('layouts.frontend')
@section('seoinfo')
    <title>{{ $seoTitle ?? 'Bansal Immigration - Expert Australian Migration Services' }}</title>
    <meta name="description" content="{{ $seoDesc ?? 'Professional Australian immigration consultants helping you achieve permanent residency, study abroad, and family reunification in Australia. MARA registered migration agents.' }}">
    <meta property="og:title" content="{{ $seoTitle ?? 'Bansal Immigration - Expert Migration Services' }}">
    <meta property="og:description" content="{{ $seoDesc ?? 'Professional Australian immigration consultants helping you achieve permanent residency, study abroad, and family reunification in Australia.' }}">
    <meta property="og:image" content="{{ asset('img/bansal-immigration-icon.jpg') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle ?? 'Bansal Immigration - Expert Migration Services' }}">
    <meta name="twitter:description" content="{{ $seoDesc ?? 'Professional immigration consultants helping you achieve your dreams.' }}">
    <meta name="twitter:image" content="{{ asset('img/bansal-immigration-icon.jpg') }}">
    
    @if(isset($structuredData))
    <!-- Structured Data for SEO -->
    <script type="application/ld+json">
    {!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    @endif
    
    <!-- Critical CSS for above-the-fold content -->
    <style>
        /* Critical CSS for hero section */
        .hero-section { min-height: 100vh; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/img/Frontend/bg-2.jpg'); background-size: cover; background-position: center; }
        .lazy { opacity: 0; transition: opacity 0.3s; }
        .loaded { opacity: 1; }
        .animate-in { animation: fadeInUp 0.6s ease-out; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .reduce-motion * { animation-duration: 0.01ms !important; animation-iteration-count: 1 !important; transition-duration: 0.01ms !important; }
    </style>
@endsection
@section('content')
    <!-- Hide Trustpilot if needed -->
    <style>#trustpilot-gtm-floating-wrapper { display: none; }</style>

    <!-- Contact Popup -->
    <div id="popup-loging" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg max-w-md w-full mx-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Contact Us</h2>
                <span class="close text-xl cursor-pointer hover:text-gray-600" onclick="closePopup()">&times;</span>
            </div>
            @include('components.unified-contact-form', [
                'form_source' => 'homepage-popup',
                'form_variant' => 'compact',
                'show_phone' => true,
                'show_subject' => false
            ])
        </div>
    </div>

    <!-- Modern Minimal Hero Section -->
    <section class="hero-section relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat parallax"></div>
        
        <!-- Subtle Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-16 h-16 bg-blue-500 rounded-full opacity-10 animate-pulse"></div>
            <div class="absolute top-40 right-20 w-12 h-12 bg-yellow-400 rounded-full opacity-15 animate-bounce"></div>
        </div>

        <div class="relative z-10 container mx-auto px-4 text-center text-white">
            <div class="max-w-4xl mx-auto">
                <!-- Trust Badge -->
                <div class="inline-flex items-center bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-6 py-2 mb-12 lazy-section">
                    <span class="text-sm font-medium">✓ MARA Registered Migration Agents</span>
                </div>
                
                <!-- Main Headline -->
                <h1 class="text-6xl md:text-8xl font-bold mb-8 leading-tight lazy-section">
                    Your <span class="text-yellow-400">Australian</span><br>
                    <span class="text-4xl md:text-6xl font-light">Dream Starts Here</span>
                </h1>
                
                <!-- Subheadline -->
                <p class="text-xl md:text-2xl mb-12 text-gray-200 max-w-2xl mx-auto font-light lazy-section">
                    {{ $seoDesc ?? 'Expert immigration consultants helping you achieve permanent residency, study abroad, and family reunification in Australia.' }}
                </p>
                
                <!-- Single Primary CTA -->
                <div class="mb-16 lazy-section">
                    <a href="{{ route('appointment') }}" class="inline-flex items-center bg-yellow-400 text-black hover:bg-yellow-300 px-12 py-5 rounded-lg font-bold text-xl transition-all duration-300 transform hover:scale-105 shadow-2xl">
                        <i class="fas fa-calendar-alt mr-3"></i>Book Free Consultation
                        <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                
                <!-- Dynamic Trust Indicators -->
                <div class="flex flex-wrap justify-center items-center gap-12 text-sm text-gray-300 lazy-section">
                    @if(isset($statistics))
                    <div class="flex items-center">
                        <i class="fas fa-star text-yellow-400 mr-2"></i>
                        <span class="font-medium">4.9/5 Rating</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-users text-yellow-400 mr-2"></i>
                        <span class="font-medium">{{ $statistics['successful_cases'] ?? '5000' }}+ Success Stories</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-award text-yellow-400 mr-2"></i>
                        <span class="font-medium">MARA Certified</span>
                    </div>
                    @else
                    <div class="flex items-center">
                        <i class="fas fa-star text-yellow-400 mr-2"></i>
                        <span class="font-medium">4.9/5 Rating</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-users text-yellow-400 mr-2"></i>
                        <span class="font-medium">5000+ Success Stories</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-award text-yellow-400 mr-2"></i>
                        <span class="font-medium">MARA Certified</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <i class="fas fa-chevron-down text-white text-2xl opacity-70"></i>
        </div>
    </section>

    <!-- Statistics Counter Section -->
    <section class="py-20 bg-gradient-to-r from-blue-900 to-blue-800 text-white lazy-section">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Our Success in Numbers</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">Trusted by thousands of families worldwide for their migration journey</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-5xl md:text-6xl font-bold text-yellow-400 mb-2 counter" data-target="{{ $statistics['successful_cases'] ?? 5000 }}">0</div>
                    <div class="text-lg text-gray-300">Successful Cases</div>
                </div>
                <div class="text-center">
                    <div class="text-5xl md:text-6xl font-bold text-yellow-400 mb-2 counter" data-target="{{ $statistics['success_rate'] ?? 95 }}">0</div>
                    <div class="text-lg text-gray-300">Success Rate %</div>
                </div>
                <div class="text-center">
                    <div class="text-5xl md:text-6xl font-bold text-yellow-400 mb-2 counter" data-target="{{ $statistics['years_experience'] ?? 10 }}">0</div>
                    <div class="text-lg text-gray-300">Years Experience</div>
                </div>
            <div class="text-center">
                    <div class="text-5xl md:text-6xl font-bold text-yellow-400 mb-2 counter" data-target="{{ $statistics['countries_served'] ?? 50 }}">0</div>
                    <div class="text-lg text-gray-300">Countries Served</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Showcase Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our Expert Services</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Comprehensive immigration solutions tailored to your unique needs and goals</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Study Visa -->
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 p-8 group">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-colors">
                        <i class="fas fa-graduation-cap text-2xl text-blue-600 group-hover:text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Study in Australia</h3>
                    <p class="text-gray-600 mb-6">Pursue your education dreams in Australia's world-class universities with our expert guidance.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Student Visa Applications
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            University Admissions
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Dependent Visa Support
                        </li>
                    </ul>
                    <a href="/study-australia" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Skilled Migration -->
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 p-8 group">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-green-600 transition-colors">
                        <i class="fas fa-briefcase text-2xl text-green-600 group-hover:text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Skilled Migration</h3>
                    <p class="text-gray-600 mb-6">Fast-track your permanent residency through Australia's skilled migration programs.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            PR Visa Applications
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Skills Assessment
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Points Calculator
                        </li>
                    </ul>
                    <a href="/migration" class="inline-flex items-center text-green-600 font-semibold hover:text-green-800">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Family Visa -->
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 p-8 group">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-purple-600 transition-colors">
                        <i class="fas fa-heart text-2xl text-purple-600 group-hover:text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Family Reunification</h3>
                    <p class="text-gray-600 mb-6">Bring your loved ones together with our comprehensive family visa services and support.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Partner Visas
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Parent Visas
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Child Visas
                        </li>
                    </ul>
                    <a href="/family-visa" class="inline-flex items-center text-purple-600 font-semibold hover:text-purple-800">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Business Visa -->
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 p-8 group">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-orange-600 transition-colors">
                        <i class="fas fa-chart-line text-2xl text-orange-600 group-hover:text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Business Investment</h3>
                    <p class="text-gray-600 mb-6">Invest and establish your business in Australia with our comprehensive business visa services.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Business Visas
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Investment Programs
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Entrepreneur Visas
                        </li>
                    </ul>
                    <a href="/business-visas" class="inline-flex items-center text-orange-600 font-semibold hover:text-orange-800">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Visitor Visa -->
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 p-8 group">
                    <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-teal-600 transition-colors">
                        <i class="fas fa-plane text-2xl text-teal-600 group-hover:text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Visitor Visas</h3>
                    <p class="text-gray-600 mb-6">Explore, visit family, or conduct business with our streamlined visitor visa applications.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Tourist Visas
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Business Visits
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Family Visits
                        </li>
                    </ul>
                    <a href="/visitor-visa" class="inline-flex items-center text-teal-600 font-semibold hover:text-teal-800">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Appeals & Reviews -->
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 p-8 group">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-red-600 transition-colors">
                        <i class="fas fa-gavel text-2xl text-red-600 group-hover:text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Appeals & Reviews</h3>
                    <p class="text-gray-600 mb-6">Expert legal representation for visa refusals, cancellations, and administrative appeals.</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Visa Refusal Appeals
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Administrative Reviews
                        </li>
                        <li class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Legal Representation
                        </li>
                    </ul>
                    <a href="/appeals" class="inline-flex items-center text-red-600 font-semibold hover:text-red-800">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Why Choose Bansal Immigration?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">We're not just consultants; we're your partners in achieving your migration dreams</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-certificate text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">MARA Registered</h3>
                    <p class="text-gray-600">All our migration agents are registered with the Migration Agents Registration Authority (MARA), ensuring professional and ethical service.</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-chart-line text-3xl text-green-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Proven Track Record</h3>
                    <p class="text-gray-600">With over 10 years of experience and 5000+ successful cases, we have the expertise to handle any immigration challenge.</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-users text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Personalized Service</h3>
                    <p class="text-gray-600">Every case is unique. We provide personalized attention and customized solutions for each client's specific needs.</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-clock text-3xl text-orange-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">24/7 Support</h3>
                    <p class="text-gray-600">Our dedicated team is available around the clock to answer your questions and provide updates on your case.</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-20 h-20 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shield-alt text-3xl text-teal-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Transparent Process</h3>
                    <p class="text-gray-600">Complete transparency in our processes, fees, and timelines. No hidden costs or surprises.</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-handshake text-3xl text-red-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Lifetime Support</h3>
                    <p class="text-gray-600">Our relationship doesn't end with visa approval. We provide ongoing support for your settlement journey.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Timeline Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our Simple 4-Step Process</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">From consultation to visa approval, we guide you through every step</p>
            </div>
            <div class="max-w-4xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="text-center relative">
                        <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">1</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Free Consultation</h3>
                        <p class="text-gray-600 text-sm">Initial assessment of your eligibility and migration options</p>
                        <div class="hidden md:block absolute top-8 left-full w-full h-0.5 bg-gray-300 transform translate-x-4"></div>
                    </div>
                    <div class="text-center relative">
                        <div class="w-16 h-16 bg-green-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">2</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Strategy Development</h3>
                        <p class="text-gray-600 text-sm">Customized migration strategy tailored to your profile</p>
                        <div class="hidden md:block absolute top-8 left-full w-full h-0.5 bg-gray-300 transform translate-x-4"></div>
                    </div>
                    <div class="text-center relative">
                        <div class="w-16 h-16 bg-purple-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">3</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Application Submission</h3>
                        <p class="text-gray-600 text-sm">Complete documentation and visa application submission</p>
                        <div class="hidden md:block absolute top-8 left-full w-full h-0.5 bg-gray-300 transform translate-x-4"></div>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-yellow-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">4</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Visa Approval</h3>
                        <p class="text-gray-600 text-sm">Celebrate your new life in your chosen destination</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gradient-to-r from-blue-900 to-blue-800 text-white lazy-section">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">What Our Clients Say</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">Real stories from real people who achieved their migration dreams with us</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 testimonials-container">
                @if(isset($testimonials) && count($testimonials) > 0)
                    @foreach($testimonials as $testimonial)
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-8">
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('img/' . $testimonial['avatar']) }}" alt="{{ $testimonial['name'] }}" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold">{{ $testimonial['name'] }}</h4>
                                <div class="flex text-yellow-400">
                                    @for($i = 0; $i < $testimonial['rating']; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-200 italic">"{{ $testimonial['text'] }}"</p>
                    </div>
                    @endforeach
                @else
                    <!-- Fallback testimonials -->
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-8">
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('img/avatars/1.jpg') }}" alt="Client" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold">Sarah Johnson</h4>
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-200 italic">"Bansal Immigration made my dream of studying in Australia a reality. Their expertise and support throughout the process was exceptional."</p>
                    </div>
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-8">
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('img/avatars/2.jpg') }}" alt="Client" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold">Michael Chen</h4>
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-200 italic">"Professional, reliable, and knowledgeable. They helped me get my PR visa in record time. Highly recommended!"</p>
                    </div>
                    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-2xl p-8">
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('img/avatars/3.jpg') }}" alt="Client" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold">Priya Sharma</h4>
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-200 italic">"The team's attention to detail and personalized approach made all the difference. Thank you for making our family reunion possible."</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Blog Teaser Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Latest Immigration News & Insights</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Stay updated with the latest immigration policies, tips, and success stories</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @if(isset($blogLists) && count($blogLists) > 0)
                    @foreach($blogLists->take(3) as $list)
                    <article class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden group">
                        @if($list->image)
                        <div class="relative overflow-hidden">
                            <a href="{{ route('blog.detail', $list->slug) }}">
                                <img src="{{ asset('img/blog/' . $list->image) }}" alt="{{ $list->image_alt }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            </a>
                            <div class="absolute top-4 left-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Immigration News
                            </div>
                        </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span>{{ $list->created_at ? $list->created_at->format('M d, Y') : 'Recent' }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                                <a href="{{ route('blog.detail', $list->slug) }}">{{ $list->title }}</a>
                            </h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $list->short_description }}</p>
                            <a href="{{ route('blog.detail', $list->slug) }}" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 group">
                                Read More <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
                @else
                    <!-- Dummy blog posts for demonstration -->
                    <article class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden group">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('img/blog/blog1.jpg') }}" alt="Blog Post" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute top-4 left-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Immigration News
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span>Dec 15, 2024</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                                <a href="#">New Australian Immigration Changes 2025</a>
                            </h3>
                            <p class="text-gray-600 mb-4">Discover the latest updates to Australian immigration policies and how they might affect your visa application.</p>
                            <a href="#" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 group">
                                Read More <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </article>
                    <article class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden group">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('img/blog/blog2.jpg') }}" alt="Blog Post" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute top-4 left-4 bg-green-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Success Story
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span>Dec 10, 2024</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                                <a href="#">How to Prepare for Your PR Interview</a>
                            </h3>
                            <p class="text-gray-600 mb-4">Essential tips and strategies to help you ace your permanent residency interview and secure your visa.</p>
                            <a href="#" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 group">
                                Read More <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </article>
                    <article class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden group">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('img/blog/blog3.jpg') }}" alt="Blog Post" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute top-4 left-4 bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Study Guide
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span>Dec 5, 2024</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                                <a href="#">Top Universities in Australia for International Students</a>
                            </h3>
                            <p class="text-gray-600 mb-4">A comprehensive guide to Australia's best universities and what makes them attractive to international students.</p>
                            <a href="#" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 group">
                                Read More <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </article>
                @endif
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('blogs') }}" class="inline-flex items-center bg-blue-600 text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-blue-700 transition-colors transform hover:scale-105">
                    View All Articles <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-20 bg-gradient-to-r from-blue-900 to-blue-800 text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Meet Our Expert Team</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">"Expert Guidance, Personalised Care – Meet the Team Behind Your Migration Success"</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Arun Bansal -->
                <div class="text-center group">
                    <div class="relative mb-8">
                        <div class="w-48 h-48 mx-auto rounded-full overflow-hidden border-4 border-yellow-400 group-hover:border-yellow-300 transition-colors">
                            <img src="{{ asset('img/profile_imgs/Arun Sir.png') }}" alt="Arun Bansal" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 bg-yellow-400 text-black px-4 py-2 rounded-full text-sm font-bold">
                            Director
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Arun Bansal</h3>
                    <p class="text-yellow-400 text-sm mb-4 font-medium">MARN: 2418466</p>
                    <p class="text-gray-300 text-sm leading-relaxed">Director of Bansal Immigration Consultants with 10+ years of legal and migration experience. Specializes in complex visa cases and appeals.</p>
                    <div class="mt-4 flex justify-center space-x-4">
                        <a href="#" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                            <i class="fas fa-envelope text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Vipul Goyal -->
                <div class="text-center group">
                    <div class="relative mb-8">
                        <div class="w-48 h-48 mx-auto rounded-full overflow-hidden border-4 border-yellow-400 group-hover:border-yellow-300 transition-colors">
                            <img src="{{ asset('img/profile_imgs/Vipul Sir.png') }}" alt="Vipul Goyal" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 bg-yellow-400 text-black px-4 py-2 rounded-full text-sm font-bold">
                            Migration Agent
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Vipul Goyal</h3>
                    <p class="text-yellow-400 text-sm mb-4 font-medium">MARN: 2418571</p>
                    <p class="text-gray-300 text-sm leading-relaxed">Experienced Migration Agent specializing in skilled migration and family visa applications. Known for his attention to detail and client care.</p>
                    <div class="mt-4 flex justify-center space-x-4">
                        <a href="#" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                            <i class="fas fa-envelope text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Mamta Puri -->
                <div class="text-center group">
                    <div class="relative mb-8">
                        <div class="w-48 h-48 mx-auto rounded-full overflow-hidden border-4 border-yellow-400 group-hover:border-yellow-300 transition-colors">
                            <img src="{{ asset('img/profile_imgs/Maleesha Maam.png') }}" alt="Mamta Puri" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 bg-yellow-400 text-black px-4 py-2 rounded-full text-sm font-bold">
                            Migration Agent
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Mamta Puri</h3>
                    <p class="text-yellow-400 text-sm mb-4 font-medium">MARN: 1569359</p>
                    <p class="text-gray-300 text-sm leading-relaxed">Dedicated Migration Agent with expertise in student visas and partner visa applications. Committed to providing personalized service to every client.</p>
                    <div class="mt-4 flex justify-center space-x-4">
                        <a href="#" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                            <i class="fas fa-envelope text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Iqbal -->
                <div class="text-center group">
                    <div class="relative mb-8">
                        <div class="w-48 h-48 mx-auto rounded-full overflow-hidden border-4 border-yellow-400 group-hover:border-yellow-300 transition-colors">
                            <img src="{{ asset('img/profile_imgs/user_img_default_gy0h1YJFfN.png') }}" alt="Iqbal" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 bg-yellow-400 text-black px-4 py-2 rounded-full text-sm font-bold">
                            Migration Agent
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Iqbal</h3>
                    <p class="text-yellow-400 text-sm mb-4 font-medium">MARN: [To be provided]</p>
                    <p class="text-gray-300 text-sm leading-relaxed">Experienced Migration Agent committed to providing personalized service and expert guidance for all immigration needs.</p>
                    <div class="mt-4 flex justify-center space-x-4">
                        <a href="#" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                            <i class="fas fa-envelope text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('contact') }}" class="inline-flex items-center bg-yellow-400 text-black px-8 py-4 rounded-lg font-bold text-lg hover:bg-yellow-300 transition-colors transform hover:scale-105">
                    Contact Our Team <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="py-20 bg-gradient-to-r from-yellow-400 to-orange-500 text-black">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-4xl md:text-6xl font-bold mb-6">Ready to Start Your Migration Journey?</h2>
                <p class="text-xl md:text-2xl mb-8 text-gray-800">Don't let your dreams wait. Get expert guidance from MARA registered migration agents today.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                    <a href="{{ route('appointment') }}" class="group bg-black text-white hover:bg-gray-800 px-8 py-4 rounded-lg font-bold text-lg transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-calendar-alt mr-2"></i>Book Free Consultation
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="tel:+61396021330" class="group border-2 border-black text-black hover:bg-black hover:text-white px-8 py-4 rounded-lg font-bold text-lg transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-phone mr-2"></i>Call Now: +61 3 9602 1330
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                <div class="flex flex-wrap justify-center items-center gap-8 text-sm text-gray-700">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        <span>Free Initial Consultation</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        <span>MARA Registered Agents</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        <span>No Win, No Fee Policy</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <!-- Include modern home page enhancements -->
    <script src="{{ asset('js/home-enhancements.js') }}"></script>
    
    <script>
        // Popup logic
        function closePopup() { 
            document.getElementById('popup-loging').classList.add('hidden');
            sessionStorage.setItem('popupClosed', 'true');
        }
        
        // Show popup after 2s if not closed before
        if (!sessionStorage.getItem('popupClosed')) {
            setTimeout(() => { 
                document.getElementById('popup-loging').classList.remove('hidden'); 
            }, 2000);
        }
        
        document.querySelector('.close').addEventListener('click', closePopup);

        // Enhanced Counter Animation with better performance
        function animateCounters() {
            const counters = document.querySelectorAll('.counter');
            
            counters.forEach(counter => {
                if (counter.classList.contains('animated')) return;
                
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000; // 2 seconds
                const start = performance.now();
                
                const updateCounter = (currentTime) => {
                    const elapsed = currentTime - start;
                    const progress = Math.min(elapsed / duration, 1);
                    
                    // Easing function for smooth animation
                    const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                    const current = Math.floor(target * easeOutQuart);
                    
                    counter.textContent = current.toLocaleString();
                    
                    if (progress < 1) {
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target.toLocaleString();
                        counter.classList.add('animated');
                    }
                };
                
                requestAnimationFrame(updateCounter);
            });
        }

        // Intersection Observer for counter animation
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px 0px -100px 0px'
        };

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    counterObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe the statistics section
        const statsSection = document.querySelector('.counter')?.closest('section');
        if (statsSection) {
            counterObserver.observe(statsSection);
        }

        // Enhanced scroll effects
        let ticking = false;
        function updateScrollEffects() {
            const header = document.querySelector('header');
            const scrolled = window.pageYOffset;
            
            if (header) {
                if (scrolled > 100) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }
            
            ticking = false;
        }

        function requestScrollUpdate() {
            if (!ticking) {
                requestAnimationFrame(updateScrollEffects);
                ticking = true;
            }
        }

        window.addEventListener('scroll', requestScrollUpdate, { passive: true });

        // Performance monitoring
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
            
            // Log performance metrics
            if ('performance' in window) {
                const loadTime = performance.now();
                console.log(`Page loaded in ${loadTime.toFixed(2)}ms`);
                
                // Report Core Web Vitals if available
                if ('web-vitals' in window) {
                    // This would integrate with web-vitals library
                    console.log('Performance monitoring enabled');
                }
            }
        });

        // Service Worker registration for PWA features
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/service-worker.js')
                    .then(registration => {
                        console.log('SW registered: ', registration);
                    })
                    .catch(registrationError => {
                        console.log('SW registration failed: ', registrationError);
                    });
            });
        }

        // Add modern CSS classes for enhanced styling
        document.documentElement.classList.add('modern-home');
        
        // Initialize tooltips and interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to service cards
            document.querySelectorAll('.service-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });
    </script>
@endsection
