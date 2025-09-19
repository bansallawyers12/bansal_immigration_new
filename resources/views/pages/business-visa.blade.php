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

    <!-- Related Pages -->
    @if($relatedPages->count() > 0)
    <div class="mt-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Related Business Visa Services</h2>
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
                    @php
                        $slug = $relatedPage->slug ?? '';
                        $title = $relatedPage->title ?? '';
                        $haystack = strtolower($slug . ' ' . $title);
                        $routeName = null;

                        if (strpos($haystack, 'checklist') !== false) {
                            $routeName = 'business-visa.visa-checklists';
                        } elseif (strpos($haystack, '888') !== false || strpos($haystack, 'subclass 888') !== false || strpos($haystack, 'permanent') !== false && strpos($haystack, 'investment') !== false) {
                            $routeName = 'business-visa.business-permanent-888';
                        } elseif (strpos($haystack, '188') !== false || strpos($haystack, 'subclass 188') !== false || strpos($haystack, 'provisional') !== false) {
                            $routeName = 'business-visa.business-provisional-188';
                        } elseif (strpos($haystack, '132') !== false || strpos($haystack, 'subclass 132') !== false || strpos($haystack, 'talent') !== false) {
                            $routeName = 'business-visa.business-talent-132';
                        }

                        $href = $routeName ? route($routeName) : route('business-visa.index');
                    @endphp
                    <a href="{{ $href }}" class="text-blue-600 hover:text-blue-800 font-medium">Learn More →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Call to Action -->
    <div class="mt-16 bg-purple-50 rounded-lg p-8 text-center">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Ready to Start Your Business in Australia?</h3>
        <p class="text-gray-600 mb-6">Our business visa specialists can help you choose the right pathway for your investment.</p>
        <a href="{{ route('contact') }}" class="bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition-colors inline-block font-medium">Consult Our Experts</a>
    </div>
</div>
@endsection
