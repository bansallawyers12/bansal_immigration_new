@extends('layouts.frontend')

@section('seoinfo')
    <title>{{ $page->meta_title ?? $page->title }}</title>
    <meta name="description" content="{{ $page->meta_description ?? $page->excerpt }}">
    <meta property="og:title" content="{{ $page->meta_title ?? $page->title }}">
    <meta property="og:description" content="{{ $page->meta_description ?? $page->excerpt }}">
    @if($page->image)
    <meta property="og:image" content="{{ asset('storage/' . $page->image) }}">
    @endif
@endsection

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

    <!-- Country Options -->
    <div class="mt-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Immigration Services for Other Countries</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="p-6 text-center">
                    <div class="text-4xl mb-4">🇨🇦</div>
                    <h3 class="text-xl font-semibold mb-2">Canada Immigration</h3>
                    <p class="text-gray-600 mb-4">Explore immigration opportunities in Canada including Express Entry, Provincial Nominee Programs, and more.</p>
                    <a href="{{ route('other-countries.canada') }}" class="text-blue-600 hover:text-blue-800 font-medium">Learn More →</a>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="p-6 text-center">
                    <div class="text-4xl mb-4">🇳🇿</div>
                    <h3 class="text-xl font-semibold mb-2">New Zealand Immigration</h3>
                    <p class="text-gray-600 mb-4">Discover pathways to New Zealand through skilled migration, investment, and family categories.</p>
                    <a href="{{ route('other-countries.new-zealand') }}" class="text-blue-600 hover:text-blue-800 font-medium">Learn More →</a>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="p-6 text-center">
                    <div class="text-4xl mb-4">🇺🇸</div>
                    <h3 class="text-xl font-semibold mb-2">USA Immigration</h3>
                    <p class="text-gray-600 mb-4">Navigate US immigration options including work visas, green cards, and citizenship pathways.</p>
                    <a href="{{ route('other-countries.usa') }}" class="text-blue-600 hover:text-blue-800 font-medium">Learn More →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Pages -->
    @if($relatedPages->count() > 0)
    <div class="mt-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Related Services</h2>
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
                    <a href="{{ route('other-countries.' . $relatedPage->slug) }}" class="text-blue-600 hover:text-blue-800 font-medium">Learn More →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Call to Action -->
    <div class="mt-16 bg-green-50 rounded-lg p-8 text-center">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Exploring Immigration to Other Countries?</h3>
        <p class="text-gray-600 mb-6">Our international immigration experts can help you find the best pathway for your global migration goals.</p>
        <a href="{{ route('contact') }}" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition-colors inline-block font-medium">Get Global Advice</a>
    </div>
</div>
@endsection
