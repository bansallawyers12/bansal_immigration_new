@extends('layouts.main')

@section('title', '{{ $page->meta_title ?? $page->title }}')
@section('description', $page->meta_description ?? $page->excerpt)

@push('styles')
    <meta property="og:title" content="{{ $page->meta_title ?? $page->title }}">
    <meta property="og:description" content="{{ $page->meta_description ?? $page->excerpt }}">
    @if($page->image)
    <meta property="og:image" content="{{ asset('storage/' . $page->image) }}">
    @endif


@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $page->title }}</h1>
        @if($page->excerpt)
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">{{ $page->excerpt }}</p>
        @endif
    </div>

    <!-- Page Image -->
    @if($page->image)
    <div class="mb-8">
        <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->image_alt ?? $page->title }}" class="w-full h-64 object-cover rounded-lg shadow-lg">
    </div>
    @endif

    <!-- Page Content -->
    <div class="prose prose-lg max-w-none">
        {!! $page->content !!}
    </div>

    <!-- Related Pages -->
    @if($relatedPages->count() > 0)
    <div class="mt-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Related Appeal Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedPages as $relatedPage)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                @if($relatedPage->image)
                <img src="{{ asset('storage/' . $relatedPage->image) }}" alt="{{ $relatedPage->image_alt ?? $relatedPage->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ $relatedPage->title }}</h3>
                    @if($relatedPage->excerpt)
                    <p class="text-gray-600 mb-4">{{ $relatedPage->excerpt }}</p>
                    @endif
                    <a href="{{ route($relatedPage->route_name) }}" class="text-blue-600 hover:text-blue-800 font-medium">Learn More →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Contact Form Section -->
    <div class="mt-16 bg-white rounded-lg shadow-lg p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-4">Need Help with Your Visa Appeal?</h3>
        <p class="text-gray-600 mb-6">Time is critical in visa appeals. Contact our experienced team immediately for urgent assistance. Send us your details for immediate appeal support.</p>
        @include('components.unified-contact-form', [
            'form_source' => 'appeals-page',
            'form_variant' => 'full',
            'show_phone' => true,
            'show_subject' => true
        ])
    </div>

    <!-- Urgent Call to Action -->
    <div class="mt-8 bg-red-50 rounded-lg p-8 text-center">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Urgent Appeal Assistance?</h3>
        <p class="text-gray-600 mb-6">For urgent appeal matters, contact our experienced team immediately.</p>
        <a href="{{ route('contact') }}" class="bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 transition-colors inline-block font-medium">Get Urgent Help</a>
    </div>
</div>
@endsection

@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $page->title }}</h1>
        @if($page->excerpt)
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">{{ $page->excerpt }}</p>
        @endif
    </div>

    <!-- Page Image -->
    @if($page->image)
    <div class="mb-8">
        <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->image_alt ?? $page->title }}" class="w-full h-64 object-cover rounded-lg shadow-lg">
    </div>
    @endif

    <!-- Page Content -->
    <div class="prose prose-lg max-w-none">
        {!! $page->content !!}
    </div>

    <!-- Related Pages -->
    @if($relatedPages->count() > 0)
    <div class="mt-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Related Appeal Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedPages as $relatedPage)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                @if($relatedPage->image)
                <img src="{{ asset('storage/' . $relatedPage->image) }}" alt="{{ $relatedPage->image_alt ?? $relatedPage->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ $relatedPage->title }}</h3>
                    @if($relatedPage->excerpt)
                    <p class="text-gray-600 mb-4">{{ $relatedPage->excerpt }}</p>
                    @endif
                    <a href="{{ route($relatedPage->route_name) }}" class="text-blue-600 hover:text-blue-800 font-medium">Learn More →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Contact Form Section -->
    <div class="mt-16 bg-white rounded-lg shadow-lg p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-4">Need Help with Your Visa Appeal?</h3>
        <p class="text-gray-600 mb-6">Time is critical in visa appeals. Contact our experienced team immediately for urgent assistance. Send us your details for immediate appeal support.</p>
        @include('components.unified-contact-form', [
            'form_source' => 'appeals-page',
            'form_variant' => 'full',
            'show_phone' => true,
            'show_subject' => true
        ])
    </div>

    <!-- Urgent Call to Action -->
    <div class="mt-8 bg-red-50 rounded-lg p-8 text-center">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Urgent Appeal Assistance?</h3>
        <p class="text-gray-600 mb-6">For urgent appeal matters, contact our experienced team immediately.</p>
        <a href="{{ route('contact') }}" class="bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 transition-colors inline-block font-medium">Get Urgent Help</a>
    </div>
</div>
@endsection
