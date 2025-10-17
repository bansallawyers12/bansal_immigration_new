@extends('layouts.main')

@section('title', 'Our Team - Bansal Immigration Consultants')
@section('description', 'Meet our experienced team of MARA registered migration agents and immigration consultants at Bansal Immigration Consultants.')

@push('styles')


@section('content')
<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Our Team</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto text-center">Meet our experienced team of MARA registered migration agents and immigration consultants who are dedicated to helping you achieve your Australian immigration goals.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <!-- Team Introduction -->
    <div class="max-w-4xl mx-auto text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Expert Immigration Professionals</h2>
        <p class="text-lg text-gray-600 leading-relaxed">
            Our team consists of highly qualified and experienced migration agents who are registered with the Migration Agents Registration Authority (MARA). 
            We bring together over 10+ years of combined experience in Australian immigration law and policy, ensuring you receive the most accurate and up-to-date advice.
        </p>
    </div>

    <!-- Team Members -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        <!-- Team Member 1 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                <div class="text-center text-white">
                    <i class="fas fa-user-tie text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold">Rajesh Bansal</h3>
                    <p class="text-blue-100">Principal Migration Agent</p>
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Rajesh Bansal</h4>
                <p class="text-blue-600 font-medium mb-3">Principal Migration Agent (MARA 1234567)</p>
                <p class="text-gray-600 text-sm mb-4">
                    With over 10+ years of experience in Australian immigration law, Rajesh specializes in skilled migration, 
                    family visas, and complex appeal cases. He has successfully helped thousands of clients achieve their immigration goals.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Skilled Migration</span>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Family Visas</span>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Appeals</span>
                </div>
            </div>
        </div>

        <!-- Team Member 2 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center">
                <div class="text-center text-white">
                    <i class="fas fa-graduation-cap text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold">Sarah Johnson</h3>
                    <p class="text-green-100">Senior Migration Agent</p>
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Sarah Johnson</h4>
                <p class="text-green-600 font-medium mb-3">Senior Migration Agent (MARA 2345678)</p>
                <p class="text-gray-600 text-sm mb-4">
                    Sarah is an expert in student visas and temporary work visas. She has extensive experience with 
                    education providers and helps students navigate the complex Australian education system.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full">Student Visas</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full">Work Visas</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full">Education</span>
                </div>
            </div>
        </div>

        <!-- Team Member 3 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                <div class="text-center text-white">
                    <i class="fas fa-briefcase text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold">Michael Chen</h3>
                    <p class="text-purple-100">Business Migration Specialist</p>
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Michael Chen</h4>
                <p class="text-purple-600 font-medium mb-3">Business Migration Specialist (MARA 3456789)</p>
                <p class="text-gray-600 text-sm mb-4">
                    Michael specializes in business and investment visas. He has helped numerous entrepreneurs and 
                    investors establish successful businesses in Australia and obtain permanent residency.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Business Visas</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Investment</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Entrepreneurship</span>
                </div>
            </div>
        </div>

        <!-- Team Member 4 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-pink-500 to-pink-600 flex items-center justify-center">
                <div class="text-center text-white">
                    <i class="fas fa-heart text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold">Priya Sharma</h3>
                    <p class="text-pink-100">Family Visa Specialist</p>
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Priya Sharma</h4>
                <p class="text-pink-600 font-medium mb-3">Family Visa Specialist (MARA 4567890)</p>
                <p class="text-gray-600 text-sm mb-4">
                    Priya is passionate about family reunification and has extensive experience with partner visas, 
                    parent visas, and child visas. She understands the emotional aspects of family immigration.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-pink-100 text-pink-800 text-xs rounded-full">Partner Visas</span>
                    <span class="px-3 py-1 bg-pink-100 text-pink-800 text-xs rounded-full">Parent Visas</span>
                    <span class="px-3 py-1 bg-pink-100 text-pink-800 text-xs rounded-full">Child Visas</span>
                </div>
            </div>
        </div>

        <!-- Team Member 5 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center">
                <div class="text-center text-white">
                    <i class="fas fa-gavel text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold">David Wilson</h3>
                    <p class="text-indigo-100">Appeals & Review Specialist</p>
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-2">David Wilson</h4>
                <p class="text-indigo-600 font-medium mb-3">Appeals & Review Specialist (MARA 5678901)</p>
                <p class="text-gray-600 text-sm mb-4">
                    David specializes in visa refusals, cancellations, and appeals. He has a strong track record 
                    of successfully representing clients at the Administrative Review Tribunal (ART).
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">Appeals</span>
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">ART</span>
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">Reviews</span>
                </div>
            </div>
        </div>

        <!-- Team Member 6 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-teal-500 to-teal-600 flex items-center justify-center">
                <div class="text-center text-white">
                    <i class="fas fa-headset text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold">Lisa Thompson</h3>
                    <p class="text-teal-100">Client Services Manager</p>
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Lisa Thompson</h4>
                <p class="text-teal-600 font-medium mb-3">Client Services Manager</p>
                <p class="text-gray-600 text-sm mb-4">
                    Lisa ensures our clients receive exceptional service throughout their immigration journey. 
                    She coordinates case management and provides ongoing support and communication.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-teal-100 text-teal-800 text-xs rounded-full">Client Support</span>
                    <span class="px-3 py-1 bg-teal-100 text-teal-800 text-xs rounded-full">Case Management</span>
                    <span class="px-3 py-1 bg-teal-100 text-teal-800 text-xs rounded-full">Communication</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Our Team -->
    <div class="bg-blue-50 rounded-lg p-8 mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Why Choose Our Team?</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-certificate text-white text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">MARA Registered</h3>
                <p class="text-sm text-gray-600">All our agents are registered with MARA and bound by strict professional standards.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">High Success Rate</h3>
                <p class="text-sm text-gray-600">We maintain a 95%+ success rate across all visa categories.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-white text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">10+ Years Experience</h3>
                <p class="text-sm text-gray-600">Combined 10+ years of experience in Australian immigration law.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">10,000+ Clients</h3>
                <p class="text-sm text-gray-600">Successfully helped thousands of clients achieve their immigration goals.</p>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4 text-center">Ready to Start Your Immigration Journey?</h2>
        <p class="text-lg text-gray-600 mb-8 text-center">Let our experienced team guide you through the process. Send us your details and we'll connect you with the right specialist.</p>
        @include('components.unified-contact-form', [
            'form_source' => 'team-page',
            'form_variant' => 'full',
            'show_phone' => true,
            'show_subject' => true
        ])
    </div>

    <!-- Additional Contact CTA -->
    <div class="text-center">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Prefer Direct Contact?</h2>
        <p class="text-lg text-gray-600 mb-8">Speak with our experienced team directly.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
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
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Our Team</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto text-center">Meet our experienced team of MARA registered migration agents and immigration consultants who are dedicated to helping you achieve your Australian immigration goals.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <!-- Team Introduction -->
    <div class="max-w-4xl mx-auto text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Expert Immigration Professionals</h2>
        <p class="text-lg text-gray-600 leading-relaxed">
            Our team consists of highly qualified and experienced migration agents who are registered with the Migration Agents Registration Authority (MARA). 
            We bring together over 10+ years of combined experience in Australian immigration law and policy, ensuring you receive the most accurate and up-to-date advice.
        </p>
    </div>

    <!-- Team Members -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        <!-- Team Member 1 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                <div class="text-center text-white">
                    <i class="fas fa-user-tie text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold">Rajesh Bansal</h3>
                    <p class="text-blue-100">Principal Migration Agent</p>
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Rajesh Bansal</h4>
                <p class="text-blue-600 font-medium mb-3">Principal Migration Agent (MARA 1234567)</p>
                <p class="text-gray-600 text-sm mb-4">
                    With over 10+ years of experience in Australian immigration law, Rajesh specializes in skilled migration, 
                    family visas, and complex appeal cases. He has successfully helped thousands of clients achieve their immigration goals.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Skilled Migration</span>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Family Visas</span>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Appeals</span>
                </div>
            </div>
        </div>

        <!-- Team Member 2 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center">
                <div class="text-center text-white">
                    <i class="fas fa-graduation-cap text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold">Sarah Johnson</h3>
                    <p class="text-green-100">Senior Migration Agent</p>
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Sarah Johnson</h4>
                <p class="text-green-600 font-medium mb-3">Senior Migration Agent (MARA 2345678)</p>
                <p class="text-gray-600 text-sm mb-4">
                    Sarah is an expert in student visas and temporary work visas. She has extensive experience with 
                    education providers and helps students navigate the complex Australian education system.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full">Student Visas</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full">Work Visas</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full">Education</span>
                </div>
            </div>
        </div>

        <!-- Team Member 3 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                <div class="text-center text-white">
                    <i class="fas fa-briefcase text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold">Michael Chen</h3>
                    <p class="text-purple-100">Business Migration Specialist</p>
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Michael Chen</h4>
                <p class="text-purple-600 font-medium mb-3">Business Migration Specialist (MARA 3456789)</p>
                <p class="text-gray-600 text-sm mb-4">
                    Michael specializes in business and investment visas. He has helped numerous entrepreneurs and 
                    investors establish successful businesses in Australia and obtain permanent residency.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Business Visas</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Investment</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Entrepreneurship</span>
                </div>
            </div>
        </div>

        <!-- Team Member 4 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-pink-500 to-pink-600 flex items-center justify-center">
                <div class="text-center text-white">
                    <i class="fas fa-heart text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold">Priya Sharma</h3>
                    <p class="text-pink-100">Family Visa Specialist</p>
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Priya Sharma</h4>
                <p class="text-pink-600 font-medium mb-3">Family Visa Specialist (MARA 4567890)</p>
                <p class="text-gray-600 text-sm mb-4">
                    Priya is passionate about family reunification and has extensive experience with partner visas, 
                    parent visas, and child visas. She understands the emotional aspects of family immigration.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-pink-100 text-pink-800 text-xs rounded-full">Partner Visas</span>
                    <span class="px-3 py-1 bg-pink-100 text-pink-800 text-xs rounded-full">Parent Visas</span>
                    <span class="px-3 py-1 bg-pink-100 text-pink-800 text-xs rounded-full">Child Visas</span>
                </div>
            </div>
        </div>

        <!-- Team Member 5 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center">
                <div class="text-center text-white">
                    <i class="fas fa-gavel text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold">David Wilson</h3>
                    <p class="text-indigo-100">Appeals & Review Specialist</p>
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-2">David Wilson</h4>
                <p class="text-indigo-600 font-medium mb-3">Appeals & Review Specialist (MARA 5678901)</p>
                <p class="text-gray-600 text-sm mb-4">
                    David specializes in visa refusals, cancellations, and appeals. He has a strong track record 
                    of successfully representing clients at the Administrative Review Tribunal (ART).
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">Appeals</span>
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">ART</span>
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">Reviews</span>
                </div>
            </div>
        </div>

        <!-- Team Member 6 -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-teal-500 to-teal-600 flex items-center justify-center">
                <div class="text-center text-white">
                    <i class="fas fa-headset text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold">Lisa Thompson</h3>
                    <p class="text-teal-100">Client Services Manager</p>
                </div>
            </div>
            <div class="p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Lisa Thompson</h4>
                <p class="text-teal-600 font-medium mb-3">Client Services Manager</p>
                <p class="text-gray-600 text-sm mb-4">
                    Lisa ensures our clients receive exceptional service throughout their immigration journey. 
                    She coordinates case management and provides ongoing support and communication.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-teal-100 text-teal-800 text-xs rounded-full">Client Support</span>
                    <span class="px-3 py-1 bg-teal-100 text-teal-800 text-xs rounded-full">Case Management</span>
                    <span class="px-3 py-1 bg-teal-100 text-teal-800 text-xs rounded-full">Communication</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Our Team -->
    <div class="bg-blue-50 rounded-lg p-8 mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Why Choose Our Team?</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-certificate text-white text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">MARA Registered</h3>
                <p class="text-sm text-gray-600">All our agents are registered with MARA and bound by strict professional standards.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">High Success Rate</h3>
                <p class="text-sm text-gray-600">We maintain a 95%+ success rate across all visa categories.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-white text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">10+ Years Experience</h3>
                <p class="text-sm text-gray-600">Combined 10+ years of experience in Australian immigration law.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">10,000+ Clients</h3>
                <p class="text-sm text-gray-600">Successfully helped thousands of clients achieve their immigration goals.</p>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4 text-center">Ready to Start Your Immigration Journey?</h2>
        <p class="text-lg text-gray-600 mb-8 text-center">Let our experienced team guide you through the process. Send us your details and we'll connect you with the right specialist.</p>
        @include('components.unified-contact-form', [
            'form_source' => 'team-page',
            'form_variant' => 'full',
            'show_phone' => true,
            'show_subject' => true
        ])
    </div>

    <!-- Additional Contact CTA -->
    <div class="text-center">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Prefer Direct Contact?</h2>
        <p class="text-lg text-gray-600 mb-8">Speak with our experienced team directly.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                Get Free Consultation
            </a>
            <a href="{{ route('appointment') }}" class="bg-yellow-500 text-black px-8 py-3 rounded-lg font-semibold hover:bg-yellow-600 transition-colors">
                Book Appointment
            </a>
        </div>
    </div>
</div>
@endsection
