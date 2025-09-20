@extends('layouts.main')

@section('title', 'Client Testimonials - Success Stories | Bansal Immigration')
@section('description', 'Read success stories and testimonials from our satisfied clients who achieved their Australian immigration goals with Bansal Immigration Consultants.')

@push('styles')
    <meta name="keywords" content="testimonials, client reviews, success stories, bansal immigration reviews">


@section('content')
<div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Client Testimonials</h1>
        <p class="text-xl opacity-90">Success Stories from Our Satisfied Clients</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <!-- Featured Testimonial -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-12 text-center">
        <div class="text-yellow-400 text-4xl mb-4">⭐⭐⭐⭐⭐</div>
        <blockquote class="text-xl text-gray-700 italic mb-6">
            "Bansal Immigration made our dream of living in Australia come true. Their professional guidance and support throughout the visa process was exceptional. We couldn't have done it without them!"
        </blockquote>
        <div class="flex items-center justify-center">
            <img src="{{ asset('img/testimonials/client1.jpg') }}" alt="Rajesh & Priya" class="w-16 h-16 rounded-full mr-4" onerror="this.src='/img/default-avatar.png'">
            <div>
                <div class="font-semibold text-gray-900">Rajesh & Priya Sharma</div>
                <div class="text-gray-600">Partner Visa (Subclass 820/801)</div>
            </div>
        </div>
    </div>

    <!-- Testimonials Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Testimonial 1 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-yellow-400 mb-3">⭐⭐⭐⭐⭐</div>
            <blockquote class="text-gray-700 mb-4">
                "The team at Bansal Immigration provided excellent guidance for my student visa application. They were always available to answer my questions and made the process smooth and stress-free."
            </blockquote>
            <div class="border-t pt-4">
                <div class="font-semibold text-gray-900">Amit Kumar</div>
                <div class="text-sm text-gray-600">Student Visa (Subclass 500)</div>
                <div class="text-sm text-blue-600">Melbourne University</div>
            </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-yellow-400 mb-3">⭐⭐⭐⭐⭐</div>
            <blockquote class="text-gray-700 mb-4">
                "I got my PR through the skilled independent visa with Bansal Immigration's help. Their knowledge of the points system and documentation requirements was outstanding."
            </blockquote>
            <div class="border-t pt-4">
                <div class="font-semibold text-gray-900">Sarah Chen</div>
                <div class="text-sm text-gray-600">Skilled Independent (189)</div>
                <div class="text-sm text-blue-600">Software Engineer</div>
            </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-yellow-400 mb-3">⭐⭐⭐⭐⭐</div>
            <blockquote class="text-gray-700 mb-4">
                "Professional, reliable, and knowledgeable. Bansal Immigration helped us navigate the complex parent visa process. Highly recommended!"
            </blockquote>
            <div class="border-t pt-4">
                <div class="font-semibold text-gray-900">David & Maria Rodriguez</div>
                <div class="text-sm text-gray-600">Contributory Parent (143)</div>
                <div class="text-sm text-blue-600">Brisbane</div>
            </div>
        </div>

        <!-- Testimonial 4 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-yellow-400 mb-3">⭐⭐⭐⭐⭐</div>
            <blockquote class="text-gray-700 mb-4">
                "The employer sponsored visa process seemed overwhelming, but Bansal Immigration made it manageable. Their expertise saved us time and stress."
            </blockquote>
            <div class="border-t pt-4">
                <div class="font-semibold text-gray-900">James Wilson</div>
                <div class="text-sm text-gray-600">TSS Visa (482)</div>
                <div class="text-sm text-blue-600">Marketing Manager</div>
            </div>
        </div>

        <!-- Testimonial 5 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-yellow-400 mb-3">⭐⭐⭐⭐⭐</div>
            <blockquote class="text-gray-700 mb-4">
                "Excellent service for my visitor visa application. Quick processing and clear communication throughout. Will definitely use their services again."
            </blockquote>
            <div class="border-t pt-4">
                <div class="font-semibold text-gray-900">Lisa Thompson</div>
                <div class="text-sm text-gray-600">Visitor Visa (600)</div>
                <div class="text-sm text-blue-600">Tourism</div>
            </div>
        </div>

        <!-- Testimonial 6 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-yellow-400 mb-3">⭐⭐⭐⭐⭐</div>
            <blockquote class="text-gray-700 mb-4">
                "From initial consultation to visa grant, the service was exceptional. Their attention to detail and professional approach made all the difference."
            </blockquote>
            <div class="border-t pt-4">
                <div class="font-semibold text-gray-900">Michael & Anna Singh</div>
                <div class="text-sm text-gray-600">Regional Skilled (491)</div>
                <div class="text-sm text-blue-600">Adelaide</div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="mt-16 bg-gradient-to-r from-green-500 to-blue-500 rounded-lg p-8 text-white">
        <h2 class="text-2xl font-bold text-center mb-8">Our Success Statistics</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold mb-2">98%</div>
                <div class="text-sm opacity-90">Success Rate</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">5000+</div>
                <div class="text-sm opacity-90">Visas Processed</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">15+</div>
                <div class="text-sm opacity-90">Years Experience</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">4.9/5</div>
                <div class="text-sm opacity-90">Client Rating</div>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="mt-12 bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4 text-center">Ready to Start Your Journey?</h2>
        <p class="text-gray-600 mb-8 text-center">Join thousands of satisfied clients who achieved their Australian immigration goals with our expert guidance. Send us your details to get started.</p>
        @include('components.unified-contact-form', [
            'form_source' => 'testimonials-page',
            'form_variant' => 'full',
            'show_phone' => true,
            'show_subject' => true
        ])
    </div>

    <!-- Additional Call to Action -->
    <div class="mt-8 text-center">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Prefer Direct Contact?</h2>
        <p class="text-gray-600 mb-8">Speak with our expert team directly.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('appointment') }}" class="cryptos-btn inline-block">Book Free Consultation</a>
            <a href="{{ route('contact') }}" class="bg-white border border-yellow-400 text-yellow-800 px-6 py-2 rounded hover:bg-yellow-50 inline-block">Contact Us Today</a>
        </div>
    </div>
</div>
@endsection

@endpush

@section('content')
<div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Client Testimonials</h1>
        <p class="text-xl opacity-90">Success Stories from Our Satisfied Clients</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <!-- Featured Testimonial -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-12 text-center">
        <div class="text-yellow-400 text-4xl mb-4">⭐⭐⭐⭐⭐</div>
        <blockquote class="text-xl text-gray-700 italic mb-6">
            "Bansal Immigration made our dream of living in Australia come true. Their professional guidance and support throughout the visa process was exceptional. We couldn't have done it without them!"
        </blockquote>
        <div class="flex items-center justify-center">
            <img src="{{ asset('img/testimonials/client1.jpg') }}" alt="Rajesh & Priya" class="w-16 h-16 rounded-full mr-4" onerror="this.src='/img/default-avatar.png'">
            <div>
                <div class="font-semibold text-gray-900">Rajesh & Priya Sharma</div>
                <div class="text-gray-600">Partner Visa (Subclass 820/801)</div>
            </div>
        </div>
    </div>

    <!-- Testimonials Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Testimonial 1 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-yellow-400 mb-3">⭐⭐⭐⭐⭐</div>
            <blockquote class="text-gray-700 mb-4">
                "The team at Bansal Immigration provided excellent guidance for my student visa application. They were always available to answer my questions and made the process smooth and stress-free."
            </blockquote>
            <div class="border-t pt-4">
                <div class="font-semibold text-gray-900">Amit Kumar</div>
                <div class="text-sm text-gray-600">Student Visa (Subclass 500)</div>
                <div class="text-sm text-blue-600">Melbourne University</div>
            </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-yellow-400 mb-3">⭐⭐⭐⭐⭐</div>
            <blockquote class="text-gray-700 mb-4">
                "I got my PR through the skilled independent visa with Bansal Immigration's help. Their knowledge of the points system and documentation requirements was outstanding."
            </blockquote>
            <div class="border-t pt-4">
                <div class="font-semibold text-gray-900">Sarah Chen</div>
                <div class="text-sm text-gray-600">Skilled Independent (189)</div>
                <div class="text-sm text-blue-600">Software Engineer</div>
            </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-yellow-400 mb-3">⭐⭐⭐⭐⭐</div>
            <blockquote class="text-gray-700 mb-4">
                "Professional, reliable, and knowledgeable. Bansal Immigration helped us navigate the complex parent visa process. Highly recommended!"
            </blockquote>
            <div class="border-t pt-4">
                <div class="font-semibold text-gray-900">David & Maria Rodriguez</div>
                <div class="text-sm text-gray-600">Contributory Parent (143)</div>
                <div class="text-sm text-blue-600">Brisbane</div>
            </div>
        </div>

        <!-- Testimonial 4 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-yellow-400 mb-3">⭐⭐⭐⭐⭐</div>
            <blockquote class="text-gray-700 mb-4">
                "The employer sponsored visa process seemed overwhelming, but Bansal Immigration made it manageable. Their expertise saved us time and stress."
            </blockquote>
            <div class="border-t pt-4">
                <div class="font-semibold text-gray-900">James Wilson</div>
                <div class="text-sm text-gray-600">TSS Visa (482)</div>
                <div class="text-sm text-blue-600">Marketing Manager</div>
            </div>
        </div>

        <!-- Testimonial 5 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-yellow-400 mb-3">⭐⭐⭐⭐⭐</div>
            <blockquote class="text-gray-700 mb-4">
                "Excellent service for my visitor visa application. Quick processing and clear communication throughout. Will definitely use their services again."
            </blockquote>
            <div class="border-t pt-4">
                <div class="font-semibold text-gray-900">Lisa Thompson</div>
                <div class="text-sm text-gray-600">Visitor Visa (600)</div>
                <div class="text-sm text-blue-600">Tourism</div>
            </div>
        </div>

        <!-- Testimonial 6 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-yellow-400 mb-3">⭐⭐⭐⭐⭐</div>
            <blockquote class="text-gray-700 mb-4">
                "From initial consultation to visa grant, the service was exceptional. Their attention to detail and professional approach made all the difference."
            </blockquote>
            <div class="border-t pt-4">
                <div class="font-semibold text-gray-900">Michael & Anna Singh</div>
                <div class="text-sm text-gray-600">Regional Skilled (491)</div>
                <div class="text-sm text-blue-600">Adelaide</div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="mt-16 bg-gradient-to-r from-green-500 to-blue-500 rounded-lg p-8 text-white">
        <h2 class="text-2xl font-bold text-center mb-8">Our Success Statistics</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold mb-2">98%</div>
                <div class="text-sm opacity-90">Success Rate</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">5000+</div>
                <div class="text-sm opacity-90">Visas Processed</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">15+</div>
                <div class="text-sm opacity-90">Years Experience</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">4.9/5</div>
                <div class="text-sm opacity-90">Client Rating</div>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="mt-12 bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4 text-center">Ready to Start Your Journey?</h2>
        <p class="text-gray-600 mb-8 text-center">Join thousands of satisfied clients who achieved their Australian immigration goals with our expert guidance. Send us your details to get started.</p>
        @include('components.unified-contact-form', [
            'form_source' => 'testimonials-page',
            'form_variant' => 'full',
            'show_phone' => true,
            'show_subject' => true
        ])
    </div>

    <!-- Additional Call to Action -->
    <div class="mt-8 text-center">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Prefer Direct Contact?</h2>
        <p class="text-gray-600 mb-8">Speak with our expert team directly.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('appointment') }}" class="cryptos-btn inline-block">Book Free Consultation</a>
            <a href="{{ route('contact') }}" class="bg-white border border-yellow-400 text-yellow-800 px-6 py-2 rounded hover:bg-yellow-50 inline-block">Contact Us Today</a>
        </div>
    </div>
</div>
@endsection
