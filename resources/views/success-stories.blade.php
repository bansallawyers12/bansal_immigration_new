@extends('layouts.main')

@section('title', 'Success Stories - Bansal Immigration')
@section('description', 'Read inspiring success stories from our clients who achieved their immigration dreams with Bansal Immigration.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Success Stories</h1>
            <p class="text-xl md:text-2xl mb-8">Real stories from real people who achieved their immigration dreams</p>
            <div class="flex justify-center">
                <div class="bg-white bg-opacity-20 rounded-full px-6 py-2">
                    <span class="text-sm font-medium">{{ $successStories->total() }} Success Stories</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <form method="GET" class="flex flex-wrap gap-4 justify-center">
                <div class="flex-1 min-w-64">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search success stories..." 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <select name="visa_type" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">All Visa Types</option>
                        <option value="Visitor Visa" {{ request('visa_type') === 'Visitor Visa' ? 'selected' : '' }}>Visitor Visa</option>
                        <option value="Student Visa" {{ request('visa_type') === 'Student Visa' ? 'selected' : '' }}>Student Visa</option>
                        <option value="Skilled Migration" {{ request('visa_type') === 'Skilled Migration' ? 'selected' : '' }}>Skilled Migration</option>
                        <option value="Business Visa" {{ request('visa_type') === 'Business Visa' ? 'selected' : '' }}>Business Visa</option>
                        <option value="Family Visa" {{ request('visa_type') === 'Family Visa' ? 'selected' : '' }}>Family Visa</option>
                        <option value="Work Visa" {{ request('visa_type') === 'Work Visa' ? 'selected' : '' }}>Work Visa</option>
                        <option value="Permanent Residency" {{ request('visa_type') === 'Permanent Residency' ? 'selected' : '' }}>Permanent Residency</option>
                        <option value="Citizenship" {{ request('visa_type') === 'Citizenship' ? 'selected' : '' }}>Citizenship</option>
                    </select>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                @if(request()->hasAny(['search', 'visa_type']))
                <a href="{{ route('success-stories') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-3 rounded-lg font-medium">
                    Clear Filters
                </a>
                @endif
            </form>
        </div>
    </div>
</section>

<!-- Success Stories Grid -->
<section class="py-16">
    <div class="container mx-auto px-4">
        @if($successStories->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($successStories as $story)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    @if($story->image)
                    <div class="relative">
                        <img src="{{ asset('storage/' . $story->image) }}" alt="{{ $story->image_alt }}" class="w-full h-48 object-cover">
                        @if($story->featured)
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-star mr-1"></i>Featured
                            </span>
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                        <i class="fas fa-star text-white text-4xl"></i>
                    </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex flex-wrap gap-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $story->visa_type }}
                                </span>
                                @if($story->category_name && $story->category_name !== 'Uncategorized')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $story->category_name }}
                                </span>
                                @endif
                            </div>
                            <span class="text-sm text-gray-500">
                                {{ $story->success_date ? $story->success_date->format('M Y') : $story->created_at->format('M Y') }}
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                            {{ $story->title }}
                        </h3>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $story->excerpt }}
                        </p>

                        <!-- Media Indicators -->
                        @if($story->hasVideo() || $story->youtube_url)
                        <div class="flex items-center space-x-4 mb-4">
                            @if($story->youtube_url)
                            <div class="flex items-center text-red-600">
                                <i class="fab fa-youtube mr-1"></i>
                                <span class="text-xs font-medium">YouTube Video</span>
                            </div>
                            @endif
                            @if($story->pdf_doc)
                            <div class="flex items-center text-red-500">
                                <i class="fas fa-file-pdf mr-1"></i>
                                <span class="text-xs font-medium">PDF Document</span>
                            </div>
                            @endif
                        </div>
                        @endif
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $story->client_name }}</p>
                                    @if($story->client_country)
                                    <p class="text-xs text-gray-500">{{ $story->client_country }}</p>
                                    @endif
                                </div>
                            </div>
                            
                            <a href="{{ route('success-story.detail', $story->slug) }}" 
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                Read More
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($successStories->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $successStories->appends(request()->query())->links() }}
            </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-search text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Success Stories Found</h3>
                    <p class="text-gray-600 mb-6">
                        @if(request()->hasAny(['search', 'visa_type']))
                            Try adjusting your search criteria or filters.
                        @else
                            We're working on adding more success stories. Check back soon!
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'visa_type']))
                    <a href="{{ route('success-stories') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">
                        View All Stories
                    </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Contact Form Section -->
<section class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Ready to Write Your Success Story?</h2>
                <p class="text-xl text-gray-600">Let us help you achieve your immigration dreams. Contact our expert team for personalized guidance.</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-8">
                @include('components.unified-contact-form', [
                    'form_source' => 'success-stories-page',
                    'form_variant' => 'full',
                    'show_phone' => true,
                    'show_subject' => true
                ])
            </div>
        </div>
    </div>
</section>

<!-- Additional CTA Section -->
<section class="bg-blue-600 py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Start Your Journey Today</h2>
        <p class="text-xl text-blue-100 mb-8">Join thousands of successful clients who achieved their Australian dreams</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('appointment') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-medium">
                Book Free Consultation
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-3 rounded-lg font-medium">
                View Contact Info
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush
