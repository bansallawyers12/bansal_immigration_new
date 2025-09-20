@extends('layouts.main')

@section('title', ($page->meta_title ?? $page->title) . ' - Visitor Visa & Other Countries | Bansal Immigration')
@section('description', $page->meta_description ?? $page->excerpt)

@push('styles')
<meta name="keywords" content="{{ $page->meta_keywords ?? 'visitor visa, tourist visa, work holiday visa, canada visa, new zealand visa, usa visa' }}">
<meta property="og:title" content="{{ $page->meta_title ?? $page->title }}">
<meta property="og:description" content="{{ $page->meta_description ?? $page->excerpt }}">
@if($page->image)
<meta property="og:image" content="{{ asset('storage/' . $page->image) }}">
@endif
@endpush

@section('content')
<div class="bg-gradient-to-r from-green-600 to-green-800 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">{{ $page->title }}</h1>
        @if($page->excerpt)
        <p class="text-xl opacity-90">{{ $page->excerpt }}</p>
        @endif
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="/" class="hover:text-green-600">Home</a></li>
            <li>/</li>
            <li><a href="/visitor-visa" class="hover:text-green-600">Visitor Visa & Other Countries</a></li>
            @if($page->slug !== 'visitor-visa')
            <li>/</li>
            <li class="text-gray-900">{{ $page->title }}</li>
            @endif
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Visitor Visa & Travel</h3>
                
                <!-- Australian Visitor Visas -->
                <div class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-2">Australian Visitor Visas</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('visitor-visa.600') }}" class="text-green-600 hover:text-green-800">Visitor Visa (600)</a></li>
                        <li><a href="{{ route('visitor-visa.work-holiday-462') }}" class="text-green-600 hover:text-green-800">Work & Holiday Visa (462)</a></li>
                        <li><a href="{{ route('visitor-visa.work-holiday-417') }}" class="text-green-600 hover:text-green-800">Work & Holiday Visa (417)</a></li>
                        <li><a href="{{ route('visitor-visa.sponsored-family') }}" class="text-green-600 hover:text-green-800">Sponsored Family Stream</a></li>
                        <li><a href="{{ route('visitor-visa.offshore-extension') }}" class="text-green-600 hover:text-green-800">Offshore Tourist Extension</a></li>
                        <li><a href="{{ route('visitor-visa.travel-exemption') }}" class="text-green-600 hover:text-green-800">Travel Exemption</a></li>
                    </ul>
                </div>

                <!-- Other Countries -->
                <div class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-2">Other Countries</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('other-countries.canada') }}" class="text-green-600 hover:text-green-800">🇨🇦 Canada</a></li>
                        <li><a href="{{ route('other-countries.new-zealand') }}" class="text-green-600 hover:text-green-800">🇳🇿 New Zealand</a></li>
                        <li><a href="{{ route('other-countries.usa') }}" class="text-green-600 hover:text-green-800">🇺🇸 United States</a></li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-medium text-gray-800 mb-2">Quick Links</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('contact') }}" class="text-green-600 hover:text-green-800">Free Consultation</a></li>
                        <li><a href="{{ route('appointment') }}" class="text-green-600 hover:text-green-800">Book Appointment</a></li>
                        <li><a href="{{ route('success-stories') }}" class="text-green-600 hover:text-green-800">Success Stories</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            @if($page->image)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->image_alt ?? $page->title }}" class="w-full h-64 object-cover rounded-lg">
            </div>
            @endif

            <div class="prose max-w-none">
                {!! $page->content !!}
            </div>

            <!-- Key Features for Visitor Visa & Travel -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-green-900 mb-3">✈️ Easy Travel</h3>
                    <p class="text-green-800">Simplified visa application process for tourism, business, and family visits to Australia and other countries.</p>
                </div>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">💼 Work & Travel</h3>
                    <p class="text-blue-800">Work and Holiday visas allow you to work while exploring Australia's beautiful landscapes.</p>
                </div>
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-purple-900 mb-3">🌍 Global Reach</h3>
                    <p class="text-purple-800">Expert guidance for visa applications to Canada, New Zealand, and the United States.</p>
                </div>
                <div class="bg-orange-50 border border-orange-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-orange-900 mb-3">👨‍👩‍👧‍👦 Family Visits</h3>
                    <p class="text-orange-800">Sponsored family stream visas for visiting relatives in Australia.</p>
                </div>
            </div>

            <!-- Visitor Visa Services Grid -->
            <div class="mt-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Our Visitor Visa Services</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Australian Visas -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">🇦🇺 Australian Visas</h3>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li>• Visitor Visa (600)</li>
                            <li>• Work & Holiday Visas</li>
                            <li>• Sponsored Family Stream</li>
                            <li>• Tourist Visa Extensions</li>
                        </ul>
                        <a href="{{ route('visitor-visa.600') }}" class="inline-block mt-4 text-green-600 hover:text-green-800 font-medium">Learn More →</a>
                    </div>

                    <!-- Canada -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">🇨🇦 Canada</h3>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li>• Tourist Visa Applications</li>
                            <li>• Study Permits</li>
                            <li>• Work Permits</li>
                            <li>• Express Entry</li>
                        </ul>
                        <a href="{{ route('other-countries.canada') }}" class="inline-block mt-4 text-red-600 hover:text-red-800 font-medium">Learn More →</a>
                    </div>

                    <!-- New Zealand -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">🇳🇿 New Zealand</h3>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li>• Tourist Visa Applications</li>
                            <li>• Working Holiday Visas</li>
                            <li>• Student Visas</li>
                            <li>• Skilled Migration</li>
                        </ul>
                        <a href="{{ route('other-countries.new-zealand') }}" class="inline-block mt-4 text-blue-600 hover:text-blue-800 font-medium">Learn More →</a>
                    </div>

                    <!-- United States -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-indigo-500">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">🇺🇸 United States</h3>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li>• B-2 Tourist Visa</li>
                            <li>• B-1 Business Visa</li>
                            <li>• F-1 Student Visa</li>
                            <li>• H-1B Work Visa</li>
                        </ul>
                        <a href="{{ route('other-countries.usa') }}" class="inline-block mt-4 text-indigo-600 hover:text-indigo-800 font-medium">Learn More →</a>
                    </div>

                    <!-- Work & Holiday -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">💼 Work & Holiday</h3>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li>• Work & Holiday Visa 417</li>
                            <li>• Work & Holiday Visa 462</li>
                            <li>• Working Holiday Visas</li>
                            <li>• Travel & Work Programs</li>
                        </ul>
                        <a href="{{ route('visitor-visa.work-holiday-417') }}" class="inline-block mt-4 text-yellow-600 hover:text-yellow-800 font-medium">Learn More →</a>
                    </div>

                    <!-- Special Services -->
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">⭐ Special Services</h3>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li>• Travel Exemptions</li>
                            <li>• Visa Extensions</li>
                            <li>• Family Sponsorship</li>
                            <li>• Emergency Applications</li>
                        </ul>
                        <a href="{{ route('visitor-visa.travel-exemption') }}" class="inline-block mt-4 text-purple-600 hover:text-purple-800 font-medium">Learn More →</a>
                    </div>
                </div>
            </div>

            <!-- Contact Form Section -->
            <div class="mt-12 bg-white rounded-lg shadow-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Ready to Start Your Travel Journey?</h3>
                <p class="text-gray-600 mb-6">Our visa specialists will guide you through every step of the application process. Send us your details and we'll get back to you with personalized guidance.</p>
                @include('components.unified-contact-form', [
                    'form_source' => 'visitor-visa-page',
                    'form_variant' => 'full',
                    'show_phone' => true,
                    'show_subject' => true
                ])
            </div>

            <!-- Additional CTA -->
            <div class="mt-8 bg-gradient-to-r from-green-400 to-green-500 rounded-lg p-6 text-white">
                <h3 class="text-xl font-semibold mb-2">Prefer to Talk Directly?</h3>
                <p class="mb-4">Book a free consultation or call us for immediate assistance with your visa application.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('appointment') }}" class="bg-white text-green-600 px-6 py-2 rounded font-medium hover:bg-gray-100 inline-block text-center">Book Free Consultation</a>
                    <a href="{{ route('contact') }}" class="border border-white text-white px-6 py-2 rounded hover:bg-white hover:text-green-600 inline-block text-center">View Contact Info</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
