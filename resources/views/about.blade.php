@extends('layouts.main')

@section('title', 'About Us - Bansal Immigration Consultants | Expert Migration Agents')
@section('description', 'Learn about Bansal Immigration Consultants - MARA registered migration agents with 10+ years experience helping 10,000+ clients achieve their Australian dreams.')

@push('styles')
<meta property="og:title" content="About Bansal Immigration Consultants - Expert Migration Agents">
<meta property="og:description" content="MARA registered migration agents with 10+ years experience helping clients achieve permanent residency, study abroad, and family reunification in Australia.">
<meta property="og:image" content="{{ asset('img/logo/logo.jpg') }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url('/about') }}">
@endpush
@section('content')
    <!-- Hero Section -->
    <section class="py-20 bg-gradient-to-r from-blue-900 to-blue-800 text-white">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">About Bansal Immigration</h1>
                <p class="text-xl md:text-2xl text-gray-200 mb-8">Your Future, Our Priority</p>
                <p class="text-lg text-gray-300 max-w-3xl mx-auto">MARA registered migration agents with over 10+ years of experience, helping thousands of families achieve their Australian dreams through expert guidance and personalized service.</p>
            </div>
        </div>
    </section>

    <!-- Company Overview -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">Who We Are</h2>
                        <p class="text-lg text-gray-600 mb-6">Bansal Immigration Consultants is a premier immigration consultancy firm based in Melbourne, Australia. With over 10+ years of experience, we specialize in providing comprehensive immigration services tailored to meet the unique needs of our clients.</p>
                        <p class="text-lg text-gray-600 mb-6">Our commitment is encapsulated in our tagline: "Your Future, Our Priority." We are dedicated to transforming your immigration aspirations into reality through expert guidance, personalized attention, and unwavering support throughout your journey.</p>
                        <div class="flex flex-wrap gap-4">
                            <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-semibold">MARA Registered</div>
                            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold">10+ Years Experience</div>
                            <div class="bg-purple-100 text-purple-800 px-4 py-2 rounded-full text-sm font-semibold">10,000+ Success Stories</div>
                            <div class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-semibold">95% Success Rate</div>
                        </div>
                    </div>
                    <div class="relative">
                        <img src="{{ asset('img/team/team-photo.jpg') }}" alt="Bansal Immigration Team" class="rounded-2xl shadow-2xl w-full">
                        <div class="absolute -bottom-6 -right-6 bg-yellow-400 text-black px-6 py-3 rounded-lg font-bold text-lg">
                            Trusted by 10,000+ Families
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Values -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Mission & Values</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">We are committed to providing ethical, knowledgeable, and professional immigration services</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-heart text-2xl text-blue-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Ethics</h3>
                        <p class="text-gray-600">We prioritize ethical practices in all client dealings, adhering to traditional business paradigms and maintaining the highest standards of integrity.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-graduation-cap text-2xl text-green-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Knowledge</h3>
                        <p class="text-gray-600">Our extensive industry experience equips us with comprehensive knowledge of visa requirements across various schemes and countries.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-handshake text-2xl text-purple-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Integrity</h3>
                        <p class="text-gray-600">We deliver on our promises, striving to provide all necessary services as conveyed during the profile assessment.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
                        <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-users text-2xl text-orange-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Professionalism</h3>
                        <p class="text-gray-600">Our team comprises highly effective professionals dedicated to establishing respect and trust with our clients.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
                        <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-bullseye text-2xl text-teal-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Accuracy</h3>
                        <p class="text-gray-600">We ensure accurate information delivery in a simple yet effective manner, tailored to individual needs and circumstances.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-shield-alt text-2xl text-red-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Trust</h3>
                        <p class="text-gray-600">Backed by MARA certification, we operate with transparent, service-based fees and do not offer a success-fee model.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold sg-navy mb-4">Meet Our Expert Team</h2>
                <p class="text-xl sg-medium-gray max-w-3xl mx-auto">Professional migration agents with years of experience helping you achieve your Australian dreams</p>
            </div>
            
            <!-- Team Grid -->
            <div class="mb-12">
        <div class="flex justify-center mb-8">
            <div class="service-card bg-white p-8 rounded-lg text-center max-w-sm w-full">
                <div class="w-64 h-72 mx-auto overflow-hidden mb-6">
                    <img src="/img/team/ArunsirWeb.png" alt="Arun Bansal" class="w-full h-full object-cover">
                </div>
                <h3 class="text-2xl font-bold sg-navy mb-2">Arun Bansal</h3>
                <p class="text-sg-light-blue font-semibold mb-4">Director (MARN: 2418466)</p>
                <p class="sg-medium-gray text-sm leading-relaxed">
                    Director of Bansal Immigration Consultants with 10+ years of legal and migration experience, offering expert guidance backed by LLM and Migration Law qualifications.
                </p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <div class="flex flex-nowrap space-x-8 pb-4 justify-center md:justify-start">
                
                <div class="service-card bg-white p-8 rounded-lg text-center flex-shrink-0 w-64">
                    <div class="w-64 h-72 mx-auto overflow-hidden mb-6">
                        <img src="/img/team/vipul-goyal.png" alt="Vipul Goyal" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-bold sg-navy mb-2">Vipul Goyal</h3>
                    <p class="text-sg-light-blue font-semibold mb-4 text-sm">Migration Agent (MARA: 2418571)</p>
                    <p class="sg-medium-gray text-xs leading-relaxed hidden lg:block">
                        Provides expert guidance across skilled, student, and family visas with deep legal knowledge and a client-focused approach.
                    </p>
                </div>
                
                <div class="service-card bg-white p-8 rounded-lg text-center flex-shrink-0 w-64">
                    <div class="w-64 h-72 mx-auto overflow-hidden mb-6">
                        <img src="/img/team/mandeep-singh.png" alt="Mandeep Singh" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-bold sg-navy mb-2">Mandeep Singh</h3>
                    <p class="text-sg-light-blue font-semibold mb-4 text-sm">Migration Agent (MARA: 2518789)</p>
                    <p class="sg-medium-gray text-xs leading-relaxed hidden lg:block">
                        Offers expert support in student, partner, and skilled visas, guiding clients with clarity, precision, and personalised migration solutions.
                    </p>
                </div>
                
                <div class="service-card bg-white p-8 rounded-lg text-center flex-shrink-0 w-64">
                    <div class="w-64 h-72 mx-auto overflow-hidden mb-6">
                        <img src="/img/team/iqbal-singh-sran.png" alt="Iqbal Singh Sran" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-bold sg-navy mb-2">Iqbal Singh Sran</h3>
                    <p class="text-sg-light-blue font-semibold mb-4 text-sm">Migration Agent (MARA: 2418677)</p>
                    <p class="sg-medium-gray text-xs leading-relaxed hidden lg:block">
                        Specialises in student, partner, and skilled visas, delivering trusted advice and personalised solutions to make every migration journey smooth and successful.
                    </p>
                </div>
                
                <div class="service-card bg-white p-8 rounded-lg text-center flex-shrink-0 w-64">
                    <div class="w-64 h-72 mx-auto overflow-hidden mb-6">
                        <img src="/img/team/yadwinder-pal-singh.png" alt="Yadwinder Pal Singh" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-bold sg-navy mb-2">Yadwinder Pal Singh</h3>
                    <p class="text-sg-light-blue font-semibold mb-4 text-sm">Migration Agent (MARA: 2519042)</p>
                    <p class="sg-medium-gray text-xs leading-relaxed hidden lg:block">
                        Specialises in Employer Sponsored, Skilled, Partner, Student, and Temporary Residence visas with an empathetic and personalised approach.
                    </p>
                </div>
                
                <div class="service-card bg-white p-8 rounded-lg text-center flex-shrink-0 w-64">
                    <div class="w-64 h-72 mx-auto overflow-hidden mb-6">
                        <img src="/img/team/mamta-puri.png" alt="Mamta Puri" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-bold sg-navy mb-2">Mamta Puri</h3>
                    <p class="text-sg-light-blue font-semibold mb-4 text-sm">Migration Agent (MARA: )</p>
                    <p class="sg-medium-gray text-xs leading-relaxed hidden lg:block">
                        <!-- Details to be added later -->
                    </p>
                </div>

            </div>
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

    <!-- Statistics -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Success in Numbers</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Trusted by thousands of families worldwide for their migration journey</p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-5xl md:text-6xl font-bold text-blue-600 mb-2">10,000+</div>
                        <div class="text-lg text-gray-600">Clients</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl md:text-6xl font-bold text-green-600 mb-2">95%</div>
                        <div class="text-lg text-gray-600">Success Rate</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl md:text-6xl font-bold text-purple-600 mb-2">10+</div>
                        <div class="text-lg text-gray-600">Years Experience</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl md:text-6xl font-bold text-orange-600 mb-2">100%</div>
                        <div class="text-lg text-gray-600">Licensed Agents</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Get in Touch with Our Team</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Have questions about your immigration journey? Our expert team is here to help you every step of the way.</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Send us a Message</h3>
                        @include('components.unified-contact-form', [
                            'form_source' => 'about-page',
                            'form_variant' => 'full',
                            'show_phone' => true,
                            'show_subject' => true
                        ])
                    </div>
                    <div class="space-y-8">
                        <div class="bg-white rounded-2xl shadow-lg p-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Contact Information</h3>
                            <div class="space-y-6">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-map-marker-alt text-blue-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-1">Office Address</h4>
                                        <p class="text-gray-600">Level 8/278 Collins St<br>Melbourne VIC 3000, Australia</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-phone text-green-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-1">Phone</h4>
                                        <p class="text-gray-600">+61 3 9602 1330</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-envelope text-purple-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-1">Email</h4>
                                        <p class="text-gray-600">info@bansalimmigration.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-8 text-white">
                            <h3 class="text-2xl font-bold mb-4">Ready to Start Your Migration Journey?</h3>
                            <p class="text-blue-100 mb-6">Don't let your dreams wait. Get expert guidance from MARA registered migration agents today.</p>
                            <div class="space-y-4">
                                <a href="{{ route('appointment') }}" class="block w-full bg-yellow-400 text-black hover:bg-yellow-300 px-6 py-3 rounded-lg font-bold text-center transition-colors">
                                    <i class="fas fa-calendar-alt mr-2"></i>Book Free Consultation
                                </a>
                                <a href="tel:+61396021330" class="block w-full border-2 border-white text-white hover:bg-white hover:text-blue-600 px-6 py-3 rounded-lg font-bold text-center transition-colors">
                                    <i class="fas fa-phone mr-2"></i>Call Now: +61 3 9602 1330
                                </a>
                            </div>
                            <div class="flex flex-wrap justify-center items-center gap-6 text-sm text-blue-100 mt-6">
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    <span>Free Initial Consultation</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    <span>MARA Registered Agents</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    <span>Transparent, Service-Based Fees</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
