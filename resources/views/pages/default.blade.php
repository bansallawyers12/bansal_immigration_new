@extends('layouts.frontend')

@section('seoinfo')
    <title>{{ $page->meta_title ?? $page->title }} - Bansal Immigration</title>
    <meta name="description" content="{{ $page->meta_description ?? $page->excerpt }}">
    <meta name="keywords" content="{{ $page->meta_keywords ?? '' }}">
    <meta property="og:title" content="{{ $page->meta_title ?? $page->title }}">
    <meta property="og:description" content="{{ $page->meta_description ?? $page->excerpt }}">
    @if($page->image)
    <meta property="og:image" content="{{ asset('storage/' . $page->image) }}">
    @endif
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="/" class="hover:text-blue-600">Home</a></li>
            <li>/</li>
            <li><a href="/{{ $page->category }}" class="hover:text-blue-600 capitalize">{{ str_replace('-', ' ', $page->category) }}</a></li>
            @if($page->subcategory)
            <li>/</li>
            <li><a href="/{{ $page->category }}/{{ $page->subcategory }}" class="hover:text-blue-600 capitalize">{{ str_replace('-', ' ', $page->subcategory) }}</a></li>
            @endif
            <li>/</li>
            <li class="text-gray-900">{{ $page->title }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            @if($page->image)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->image_alt ?? $page->title }}" class="w-full h-64 object-cover rounded-lg">
            </div>
            @endif

            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $page->title }}</h1>

            @if($page->excerpt)
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                <p class="text-lg text-blue-900">{{ $page->excerpt }}</p>
            </div>
            @endif

            <div class="prose max-w-none">
                {!! $page->content !!}
            </div>

            <!-- Contact CTA -->
            <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Need Expert Assistance?</h3>
                <p class="text-gray-700 mb-4">Our experienced migration agents are here to help you navigate your visa application process.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('appointment') }}" class="cryptos-btn inline-block text-center">Book Consultation</a>
                    <a href="{{ route('contact') }}" class="bg-white border border-yellow-400 text-yellow-800 px-6 py-2 rounded hover:bg-yellow-50 inline-block text-center">Contact Us</a>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Quick Contact -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Quick Contact</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <span class="text-blue-600 mr-2">📞</span>
                        <a href="tel:+61396021330" class="text-gray-700 hover:text-blue-600">+61 3 9602 1330</a>
                    </div>
                    <div class="flex items-center">
                        <span class="text-blue-600 mr-2">✉️</span>
                        <a href="mailto:info@bansalimmigration.com.au" class="text-gray-700 hover:text-blue-600">info@bansalimmigration.com.au</a>
                    </div>
                    <div class="flex items-start">
                        <span class="text-blue-600 mr-2">📍</span>
                        <span class="text-gray-700">Level 8/278 Collins St<br>Melbourne VIC 3000</span>
                    </div>
                </div>
            </div>

            <!-- Related Pages -->
            @if($relatedPages->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Related Services</h3>
                <ul class="space-y-2">
                    @foreach($relatedPages as $relatedPage)
                    <li>
                        <a href="/{{ $relatedPage->category }}/{{ $relatedPage->slug }}" class="text-blue-600 hover:text-blue-800 block py-1">
                            {{ $relatedPage->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Calculator Links -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Helpful Tools</h3>
                <div class="space-y-2">
                    <a href="{{ route('migration.pr-calculator') }}" class="block text-blue-600 hover:text-blue-800 py-1">PR Points Calculator</a>
                    <a href="{{ route('postcode-checker') }}" class="block text-blue-600 hover:text-blue-800 py-1">Postcode Checker</a>
                    <a href="{{ route('study-australia.calculator') }}" class="block text-blue-600 hover:text-blue-800 py-1">Student Visa Calculator</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
