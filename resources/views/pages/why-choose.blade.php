@extends('layouts.main')

@section('title', 'Why Choose Us - Bansal Immigration Consultants')
@section('description', 'Discover why Bansal Immigration Consultants is the trusted choice for Australian immigration services. MARA registered agents with proven success.')

@push('styles')


@section('content')
<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Why Choose Us?</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto text-center">We are committed to providing exceptional immigration services with a personal touch that sets us apart from the competition.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <!-- Main Features -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
        <!-- MARA Registration -->
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-certificate text-white text-2xl"></i>
                </div>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">MARA Registered Agents</h3>
                <p class="text-gray-600 leading-relaxed">
                    All our migration agents are registered with the Migration Agents Registration Authority (MARA), 
                    ensuring you receive professional, ethical, and legally compliant immigration advice. We are bound 
                    by strict professional standards and ongoing education requirements.
                </p>
            </div>
        </div>

        <!-- High Success Rate -->
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">95%+ Success Rate</h3>
                <p class="text-gray-600 leading-relaxed">
                    Our track record speaks for itself. We maintain a 95%+ success rate across all visa categories, 
                    with thousands of successful applications. Our expertise and attention to detail ensure the best 
                    possible outcomes for our clients.
                </p>
            </div>
        </div>

        <!-- 10+ Years Experience -->
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-white text-2xl"></i>
                </div>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">10+ Years Experience</h3>
                <p class="text-gray-600 leading-relaxed">
                    With over 10+ years of combined experience in Australian immigration law, we have witnessed and 
                    adapted to numerous policy changes. Our deep understanding of the system helps us navigate 
                    complex cases with confidence.
                </p>
            </div>
        </div>

        <!-- Personalized Service -->
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-16 h-16 bg-pink-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-friends text-white text-2xl"></i>
                </div>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Personalized Service</h3>
                <p class="text-gray-600 leading-relaxed">
                    Every client receives personalized attention and a dedicated case manager. We understand that 
                    immigration is a life-changing decision, and we provide the support and guidance you need 
                    throughout your journey.
                </p>
            </div>
        </div>
    </div>

    <!-- Detailed Benefits -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">What Sets Us Apart</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Comprehensive Services -->
            <div class="text-center">
                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-globe text-blue-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Comprehensive Services</h3>
                <p class="text-gray-600">
                    From student visas to permanent residency, we handle all types of Australian immigration applications. 
                    Our expertise covers every visa category and pathway.
                </p>
            </div>

            <!-- Up-to-Date Knowledge -->
            <div class="text-center">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-book text-green-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Up-to-Date Knowledge</h3>
                <p class="text-gray-600">
                    Immigration laws change frequently. We stay current with all policy updates and legislative changes 
                    to ensure your application is prepared correctly.
                </p>
            </div>

            <!-- Transparent Pricing -->
            <div class="text-center">
                <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-dollar-sign text-yellow-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Transparent Pricing</h3>
                <p class="text-gray-600">
                    No hidden fees or surprise costs. We provide clear, upfront pricing for all our services, 
                    so you know exactly what you're paying for.
                </p>
            </div>

            <!-- Fast Processing -->
            <div class="text-center">
                <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-rocket text-purple-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Fast Processing</h3>
                <p class="text-gray-600">
                    We work efficiently to prepare and lodge your application as quickly as possible, 
                    minimizing delays and maximizing your chances of success.
                </p>
            </div>

            <!-- Ongoing Support -->
            <div class="text-center">
                <div class="w-20 h-20 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headset text-pink-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Ongoing Support</h3>
                <p class="text-gray-600">
                    Our relationship doesn't end when your visa is granted. We provide ongoing support and 
                    advice for your future immigration needs.
                </p>
            </div>

            <!-- Multilingual Support -->
            <div class="text-center">
                <div class="w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-language text-indigo-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Multilingual Support</h3>
                <p class="text-gray-600">
                    We provide services in multiple languages to ensure clear communication and understanding 
                    throughout your immigration journey.
                </p>
            </div>
        </div>
    </div>

    <!-- Client Testimonials -->
    <div class="bg-gray-50 rounded-lg p-8 mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">What Our Clients Say</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">"Bansal Immigration made my dream of studying in Australia a reality. Their expertise and support throughout the process was exceptional."</p>
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                        SJ
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Sarah Johnson</p>
                        <p class="text-sm text-gray-500">Student Visa Client</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">"Professional, reliable, and knowledgeable. They helped me get my PR visa in record time. Highly recommended!"</p>
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                        MC
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Michael Chen</p>
                        <p class="text-sm text-gray-500">PR Visa Client</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">"The team's attention to detail and personalized approach made all the difference. Thank you for making our family reunion possible."</p>
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                        PS
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Priya Sharma</p>
                        <p class="text-sm text-gray-500">Family Visa Client</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-16">
        <div class="text-center">
            <div class="text-4xl font-bold text-blue-600 mb-2">10,000+</div>
            <div class="text-gray-600">Clients</div>
        </div>
        <div class="text-center">
            <div class="text-4xl font-bold text-green-600 mb-2">95%</div>
            <div class="text-gray-600">Success Rate</div>
        </div>
        <div class="text-center">
            <div class="text-4xl font-bold text-purple-600 mb-2">10+</div>
            <div class="text-gray-600">Years Experience</div>
        </div>
        <div class="text-center">
            <div class="text-4xl font-bold text-yellow-600 mb-2">100%</div>
            <div class="text-gray-600">Licensed Agents</div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-4 text-center">Ready to Start Your Immigration Journey?</h2>
        <p class="text-xl text-gray-600 mb-8 text-center">Let our experienced team guide you to success. Send us your details and we'll get back to you with personalized guidance.</p>
        @include('components.unified-contact-form', [
            'form_source' => 'why-choose-page',
            'form_variant' => 'full',
            'show_phone' => true,
            'show_subject' => true
        ])
    </div>

    <!-- Additional Call to Action -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg p-8 text-center text-white">
        <h2 class="text-2xl font-bold mb-4">Prefer Direct Contact?</h2>
        <p class="text-lg mb-8">Speak with our experienced team directly.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                Get Free Consultation
            </a>
            <a href="{{ route('appointment') }}" class="bg-yellow-500 text-black px-8 py-3 rounded-lg font-semibold hover:bg-yellow-600 transition-colors">
                Book Appointment
            </a>
        </div>
    </div>
</div>
@endsection

@endpush

@section('content')
<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Why Choose Us?</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto text-center">We are committed to providing exceptional immigration services with a personal touch that sets us apart from the competition.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <!-- Main Features -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
        <!-- MARA Registration -->
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-certificate text-white text-2xl"></i>
                </div>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">MARA Registered Agents</h3>
                <p class="text-gray-600 leading-relaxed">
                    All our migration agents are registered with the Migration Agents Registration Authority (MARA), 
                    ensuring you receive professional, ethical, and legally compliant immigration advice. We are bound 
                    by strict professional standards and ongoing education requirements.
                </p>
            </div>
        </div>

        <!-- High Success Rate -->
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">95%+ Success Rate</h3>
                <p class="text-gray-600 leading-relaxed">
                    Our track record speaks for itself. We maintain a 95%+ success rate across all visa categories, 
                    with thousands of successful applications. Our expertise and attention to detail ensure the best 
                    possible outcomes for our clients.
                </p>
            </div>
        </div>

        <!-- 10+ Years Experience -->
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-white text-2xl"></i>
                </div>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">10+ Years Experience</h3>
                <p class="text-gray-600 leading-relaxed">
                    With over 10+ years of combined experience in Australian immigration law, we have witnessed and 
                    adapted to numerous policy changes. Our deep understanding of the system helps us navigate 
                    complex cases with confidence.
                </p>
            </div>
        </div>

        <!-- Personalized Service -->
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-16 h-16 bg-pink-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-friends text-white text-2xl"></i>
                </div>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Personalized Service</h3>
                <p class="text-gray-600 leading-relaxed">
                    Every client receives personalized attention and a dedicated case manager. We understand that 
                    immigration is a life-changing decision, and we provide the support and guidance you need 
                    throughout your journey.
                </p>
            </div>
        </div>
    </div>

    <!-- Detailed Benefits -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">What Sets Us Apart</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Comprehensive Services -->
            <div class="text-center">
                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-globe text-blue-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Comprehensive Services</h3>
                <p class="text-gray-600">
                    From student visas to permanent residency, we handle all types of Australian immigration applications. 
                    Our expertise covers every visa category and pathway.
                </p>
            </div>

            <!-- Up-to-Date Knowledge -->
            <div class="text-center">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-book text-green-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Up-to-Date Knowledge</h3>
                <p class="text-gray-600">
                    Immigration laws change frequently. We stay current with all policy updates and legislative changes 
                    to ensure your application is prepared correctly.
                </p>
            </div>

            <!-- Transparent Pricing -->
            <div class="text-center">
                <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-dollar-sign text-yellow-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Transparent Pricing</h3>
                <p class="text-gray-600">
                    No hidden fees or surprise costs. We provide clear, upfront pricing for all our services, 
                    so you know exactly what you're paying for.
                </p>
            </div>

            <!-- Fast Processing -->
            <div class="text-center">
                <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-rocket text-purple-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Fast Processing</h3>
                <p class="text-gray-600">
                    We work efficiently to prepare and lodge your application as quickly as possible, 
                    minimizing delays and maximizing your chances of success.
                </p>
            </div>

            <!-- Ongoing Support -->
            <div class="text-center">
                <div class="w-20 h-20 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headset text-pink-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Ongoing Support</h3>
                <p class="text-gray-600">
                    Our relationship doesn't end when your visa is granted. We provide ongoing support and 
                    advice for your future immigration needs.
                </p>
            </div>

            <!-- Multilingual Support -->
            <div class="text-center">
                <div class="w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-language text-indigo-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Multilingual Support</h3>
                <p class="text-gray-600">
                    We provide services in multiple languages to ensure clear communication and understanding 
                    throughout your immigration journey.
                </p>
            </div>
        </div>
    </div>

    <!-- Client Testimonials -->
    <div class="bg-gray-50 rounded-lg p-8 mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">What Our Clients Say</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">"Bansal Immigration made my dream of studying in Australia a reality. Their expertise and support throughout the process was exceptional."</p>
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                        SJ
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Sarah Johnson</p>
                        <p class="text-sm text-gray-500">Student Visa Client</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">"Professional, reliable, and knowledgeable. They helped me get my PR visa in record time. Highly recommended!"</p>
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                        MC
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Michael Chen</p>
                        <p class="text-sm text-gray-500">PR Visa Client</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">"The team's attention to detail and personalized approach made all the difference. Thank you for making our family reunion possible."</p>
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                        PS
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Priya Sharma</p>
                        <p class="text-sm text-gray-500">Family Visa Client</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-16">
        <div class="text-center">
            <div class="text-4xl font-bold text-blue-600 mb-2">10,000+</div>
            <div class="text-gray-600">Clients</div>
        </div>
        <div class="text-center">
            <div class="text-4xl font-bold text-green-600 mb-2">95%</div>
            <div class="text-gray-600">Success Rate</div>
        </div>
        <div class="text-center">
            <div class="text-4xl font-bold text-purple-600 mb-2">10+</div>
            <div class="text-gray-600">Years Experience</div>
        </div>
        <div class="text-center">
            <div class="text-4xl font-bold text-yellow-600 mb-2">100%</div>
            <div class="text-gray-600">Licensed Agents</div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-4 text-center">Ready to Start Your Immigration Journey?</h2>
        <p class="text-xl text-gray-600 mb-8 text-center">Let our experienced team guide you to success. Send us your details and we'll get back to you with personalized guidance.</p>
        @include('components.unified-contact-form', [
            'form_source' => 'why-choose-page',
            'form_variant' => 'full',
            'show_phone' => true,
            'show_subject' => true
        ])
    </div>

    <!-- Additional Call to Action -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg p-8 text-center text-white">
        <h2 class="text-2xl font-bold mb-4">Prefer Direct Contact?</h2>
        <p class="text-lg mb-8">Speak with our experienced team directly.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                Get Free Consultation
            </a>
            <a href="{{ route('appointment') }}" class="bg-yellow-500 text-black px-8 py-3 rounded-lg font-semibold hover:bg-yellow-600 transition-colors">
                Book Appointment
            </a>
        </div>
    </div>
</div>
@endsection
