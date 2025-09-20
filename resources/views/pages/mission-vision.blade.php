@extends('layouts.main')

@section('title', 'Mission & Vision - Bansal Immigration Consultants')
@section('description', 'Learn about Bansal Immigration Consultants' mission and vision to help people achieve their Australian immigration dreams.')

@push('styles')


@section('content')
<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Mission & Vision</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto text-center">Our commitment to excellence and our vision for the future of immigration services.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <!-- Mission Statement -->
    <div class="max-w-4xl mx-auto mb-16">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bullseye text-white text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Mission</h2>
            </div>
            <div class="prose max-w-none text-center">
                <p class="text-xl text-gray-700 leading-relaxed mb-6">
                    To provide exceptional immigration services that help individuals and families achieve their dreams of living, 
                    working, and studying in Australia. We are committed to delivering personalized, professional, and ethical 
                    immigration solutions that make a positive difference in our clients' lives.
                </p>
                <p class="text-lg text-gray-600">
                    We believe that everyone deserves the opportunity to pursue their aspirations, and we are dedicated to 
                    making the immigration process as smooth and successful as possible for each and every client.
                </p>
            </div>
        </div>
    </div>

    <!-- Vision Statement -->
    <div class="max-w-4xl mx-auto mb-16">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-8 text-white">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-eye text-white text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold mb-4">Our Vision</h2>
            </div>
            <div class="prose max-w-none text-center">
                <p class="text-xl leading-relaxed mb-6">
                    To be Australia's most trusted and respected immigration consultancy, known for our unwavering commitment 
                    to client success, ethical practices, and innovative solutions. We envision a future where immigration 
                    barriers are minimized through expert guidance and compassionate service.
                </p>
                <p class="text-lg opacity-90">
                    We strive to set the standard for excellence in immigration services while building lasting relationships 
                    with our clients and contributing positively to Australia's multicultural society.
                </p>
            </div>
        </div>
    </div>

    <!-- Core Values -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Our Core Values</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Integrity -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-handshake text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Integrity</h3>
                <p class="text-gray-600">
                    We conduct all our business with the highest ethical standards, ensuring transparency, 
                    honesty, and accountability in every interaction with our clients.
                </p>
            </div>

            <!-- Excellence -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-star text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Excellence</h3>
                <p class="text-gray-600">
                    We strive for excellence in everything we do, continuously improving our services and 
                    maintaining the highest professional standards in immigration consulting.
                </p>
            </div>

            <!-- Compassion -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-pink-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-heart text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Compassion</h3>
                <p class="text-gray-600">
                    We understand that immigration is a life-changing journey, and we approach each case 
                    with empathy, understanding, and genuine care for our clients' wellbeing.
                </p>
            </div>

            <!-- Innovation -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-lightbulb text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Innovation</h3>
                <p class="text-gray-600">
                    We embrace new technologies and methodologies to provide more efficient, 
                    effective, and accessible immigration services to our clients.
                </p>
            </div>

            <!-- Respect -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Respect</h3>
                <p class="text-gray-600">
                    We treat every client with dignity and respect, valuing their unique circumstances, 
                    cultural backgrounds, and individual immigration goals.
                </p>
            </div>

            <!-- Commitment -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-flag text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Commitment</h3>
                <p class="text-gray-600">
                    We are fully committed to our clients' success, providing ongoing support and 
                    dedication throughout their entire immigration journey.
                </p>
            </div>
        </div>
    </div>

    <!-- Our Approach -->
    <div class="bg-gray-50 rounded-lg p-8 mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Our Approach</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Client-Centered Service</h3>
                <p class="text-gray-600 mb-4">
                    Every client is unique, and we tailor our approach to meet their specific needs and circumstances. 
                    We take the time to understand your goals, challenges, and aspirations to provide the most 
                    effective immigration solutions.
                </p>
                <ul class="text-gray-600 space-y-2">
                    <li>• Personalized consultation and assessment</li>
                    <li>• Customized application strategies</li>
                    <li>• Regular communication and updates</li>
                    <li>• Ongoing support and guidance</li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Professional Excellence</h3>
                <p class="text-gray-600 mb-4">
                    We maintain the highest standards of professional practice, ensuring that every application 
                    is prepared with meticulous attention to detail and in full compliance with current 
                    immigration laws and regulations.
                </p>
                <ul class="text-gray-600 space-y-2">
                    <li>• MARA registered migration agents</li>
                    <li>• Continuous professional development</li>
                    <li>• Up-to-date knowledge of immigration law</li>
                    <li>• Ethical and transparent practices</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Impact Statement -->
    <div class="max-w-4xl mx-auto mb-16">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Our Impact</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold text-blue-600 mb-2">5000+</div>
                    <div class="text-gray-600 mb-2">Lives Changed</div>
                    <p class="text-sm text-gray-500">Successful immigration journeys that have transformed lives and created new opportunities.</p>
                </div>
                <div>
                    <div class="text-4xl font-bold text-green-600 mb-2">50+</div>
                    <div class="text-gray-600 mb-2">Countries Served</div>
                    <p class="text-sm text-gray-500">We've helped clients from around the world achieve their Australian dreams.</p>
                </div>
                <div>
                    <div class="text-4xl font-bold text-purple-600 mb-2">15+</div>
                    <div class="text-gray-600 mb-2">Years of Service</div>
                    <p class="text-sm text-gray-500">Consistent dedication to excellence and client success over the years.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-4 text-center">Join Our Success Story</h2>
        <p class="text-lg text-gray-600 mb-8 text-center">Let us help you achieve your Australian immigration goals with our proven expertise and commitment to excellence. Send us your details to start your journey.</p>
        
        @include('components.unified-contact-form', [
            'form_source' => 'mission-vision-page',
            'form_variant' => 'full',
            'show_phone' => true,
            'show_subject' => true
        ])
    </div>
</div>
@endsection

@endpush

@section('content')
<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Mission & Vision</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto text-center">Our commitment to excellence and our vision for the future of immigration services.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <!-- Mission Statement -->
    <div class="max-w-4xl mx-auto mb-16">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bullseye text-white text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Mission</h2>
            </div>
            <div class="prose max-w-none text-center">
                <p class="text-xl text-gray-700 leading-relaxed mb-6">
                    To provide exceptional immigration services that help individuals and families achieve their dreams of living, 
                    working, and studying in Australia. We are committed to delivering personalized, professional, and ethical 
                    immigration solutions that make a positive difference in our clients' lives.
                </p>
                <p class="text-lg text-gray-600">
                    We believe that everyone deserves the opportunity to pursue their aspirations, and we are dedicated to 
                    making the immigration process as smooth and successful as possible for each and every client.
                </p>
            </div>
        </div>
    </div>

    <!-- Vision Statement -->
    <div class="max-w-4xl mx-auto mb-16">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-8 text-white">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-eye text-white text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold mb-4">Our Vision</h2>
            </div>
            <div class="prose max-w-none text-center">
                <p class="text-xl leading-relaxed mb-6">
                    To be Australia's most trusted and respected immigration consultancy, known for our unwavering commitment 
                    to client success, ethical practices, and innovative solutions. We envision a future where immigration 
                    barriers are minimized through expert guidance and compassionate service.
                </p>
                <p class="text-lg opacity-90">
                    We strive to set the standard for excellence in immigration services while building lasting relationships 
                    with our clients and contributing positively to Australia's multicultural society.
                </p>
            </div>
        </div>
    </div>

    <!-- Core Values -->
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Our Core Values</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Integrity -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-handshake text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Integrity</h3>
                <p class="text-gray-600">
                    We conduct all our business with the highest ethical standards, ensuring transparency, 
                    honesty, and accountability in every interaction with our clients.
                </p>
            </div>

            <!-- Excellence -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-star text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Excellence</h3>
                <p class="text-gray-600">
                    We strive for excellence in everything we do, continuously improving our services and 
                    maintaining the highest professional standards in immigration consulting.
                </p>
            </div>

            <!-- Compassion -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-pink-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-heart text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Compassion</h3>
                <p class="text-gray-600">
                    We understand that immigration is a life-changing journey, and we approach each case 
                    with empathy, understanding, and genuine care for our clients' wellbeing.
                </p>
            </div>

            <!-- Innovation -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-lightbulb text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Innovation</h3>
                <p class="text-gray-600">
                    We embrace new technologies and methodologies to provide more efficient, 
                    effective, and accessible immigration services to our clients.
                </p>
            </div>

            <!-- Respect -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Respect</h3>
                <p class="text-gray-600">
                    We treat every client with dignity and respect, valuing their unique circumstances, 
                    cultural backgrounds, and individual immigration goals.
                </p>
            </div>

            <!-- Commitment -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="w-16 h-16 bg-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-flag text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Commitment</h3>
                <p class="text-gray-600">
                    We are fully committed to our clients' success, providing ongoing support and 
                    dedication throughout their entire immigration journey.
                </p>
            </div>
        </div>
    </div>

    <!-- Our Approach -->
    <div class="bg-gray-50 rounded-lg p-8 mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Our Approach</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Client-Centered Service</h3>
                <p class="text-gray-600 mb-4">
                    Every client is unique, and we tailor our approach to meet their specific needs and circumstances. 
                    We take the time to understand your goals, challenges, and aspirations to provide the most 
                    effective immigration solutions.
                </p>
                <ul class="text-gray-600 space-y-2">
                    <li>• Personalized consultation and assessment</li>
                    <li>• Customized application strategies</li>
                    <li>• Regular communication and updates</li>
                    <li>• Ongoing support and guidance</li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Professional Excellence</h3>
                <p class="text-gray-600 mb-4">
                    We maintain the highest standards of professional practice, ensuring that every application 
                    is prepared with meticulous attention to detail and in full compliance with current 
                    immigration laws and regulations.
                </p>
                <ul class="text-gray-600 space-y-2">
                    <li>• MARA registered migration agents</li>
                    <li>• Continuous professional development</li>
                    <li>• Up-to-date knowledge of immigration law</li>
                    <li>• Ethical and transparent practices</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Impact Statement -->
    <div class="max-w-4xl mx-auto mb-16">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Our Impact</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold text-blue-600 mb-2">5000+</div>
                    <div class="text-gray-600 mb-2">Lives Changed</div>
                    <p class="text-sm text-gray-500">Successful immigration journeys that have transformed lives and created new opportunities.</p>
                </div>
                <div>
                    <div class="text-4xl font-bold text-green-600 mb-2">50+</div>
                    <div class="text-gray-600 mb-2">Countries Served</div>
                    <p class="text-sm text-gray-500">We've helped clients from around the world achieve their Australian dreams.</p>
                </div>
                <div>
                    <div class="text-4xl font-bold text-purple-600 mb-2">15+</div>
                    <div class="text-gray-600 mb-2">Years of Service</div>
                    <p class="text-sm text-gray-500">Consistent dedication to excellence and client success over the years.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-4 text-center">Join Our Success Story</h2>
        <p class="text-lg text-gray-600 mb-8 text-center">Let us help you achieve your Australian immigration goals with our proven expertise and commitment to excellence. Send us your details to start your journey.</p>
        
        @include('components.unified-contact-form', [
            'form_source' => 'mission-vision-page',
            'form_variant' => 'full',
            'show_phone' => true,
            'show_subject' => true
        ])
    </div>
</div>
@endsection
