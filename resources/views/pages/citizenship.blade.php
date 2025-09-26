@extends('layouts.main')

@section('title', ($page->meta_title ?? $page->title) . ' - Citizenship | Bansal Immigration')
@section('description', $page->meta_description ?? $page->excerpt)

@push('styles')
    <meta property="og:title" content="{{ $page->meta_title ?? $page->title }}">
    <meta property="og:description" content="{{ $page->meta_description ?? $page->excerpt }}">
    @if($page->image)
    <meta property="og:image" content="{{ asset('storage/' . $page->image) }}">
    @endif
@endpush

@section('content')
<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12">
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
            <li><a href="/" class="hover:text-blue-600">Home</a></li>
            <li>/</li>
            <li><a href="/citizenship" class="hover:text-blue-600">Citizenship</a></li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Citizenship</h3>

                <div class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-2">Citizenship Pathways</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('citizenship.by-conferral') }}" class="text-blue-600 hover:text-blue-800">Citizenship by Conferral</a></li>
                        <li><a href="{{ route('citizenship.by-descent') }}" class="text-blue-600 hover:text-blue-800">Citizenship by Descent</a></li>
                        <li><a href="{{ route('citizenship.by-birth') }}" class="text-blue-600 hover:text-blue-800">Citizenship by Birth</a></li>
                        <li><a href="{{ route('citizenship.dual') }}" class="text-blue-600 hover:text-blue-800">Dual Citizenship</a></li>
                        <li><a href="{{ route('citizenship.test') }}" class="text-blue-600 hover:text-blue-800">Citizenship Test</a></li>
                        <li><a href="{{ route('citizenship.evidence') }}" class="text-blue-600 hover:text-blue-800">Evidence of Citizenship</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-medium text-gray-800 mb-2">Tools & Resources</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('appointment') }}" class="text-blue-600 hover:text-blue-800">Book Consultation</a></li>
                        <li><a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-800">Contact Us</a></li>
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

            <!-- Key Features -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">📄 Eligibility Guidance</h3>
                    <p class="text-blue-800">Clear assessment of your eligibility and pathway to Australian citizenship.</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-green-900 mb-3">📝 Application Preparation</h3>
                    <p class="text-green-800">End-to-end support for document preparation and submission.</p>
                </div>
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-purple-900 mb-3">🧭 Interview & Test Help</h3>
                    <p class="text-purple-800">Guidance for interview and citizenship test where applicable.</p>
                </div>
                <div class="bg-orange-50 border border-orange-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-orange-900 mb-3">🤝 Ongoing Support</h3>
                    <p class="text-orange-800">We support you at each step until decision and ceremony.</p>
                </div>
            </div>

            <!-- Contact Form Section -->
            <div class="mt-8 bg-white rounded-lg shadow-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Need Help With Citizenship?</h3>
                <p class="text-gray-600 mb-6">Our team can assess your eligibility and prepare a strong application. Share your details and we’ll be in touch.</p>
                @include('components.unified-contact-form', [
                    'form_source' => 'citizenship-page',
                    'form_variant' => 'full',
                    'show_phone' => true,
                    'show_subject' => true
                ])
            </div>

            <!-- Additional CTA -->
            <div class="mt-8 bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-lg p-6 text-white">
                <h3 class="text-xl font-semibold mb-2">Prefer to Talk Directly?</h3>
                <p class="mb-4">Book a free consultation or call us for immediate assistance.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('appointment') }}" class="bg-white text-yellow-600 px-6 py-2 rounded font-medium hover:bg-gray-100 inline-block text-center">Book Free Consultation</a>
                    <a href="{{ route('contact') }}" class="border border-white text-white px-6 py-2 rounded hover:bg-white hover:text-yellow-600 inline-block text-center">View Contact Info</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
