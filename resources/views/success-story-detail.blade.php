@extends('layouts.main')

@section('title', $story->meta_title ?: $story->title . ' - Success Story | Bansal Immigration')
@section('description', $story->meta_description ?: $story->excerpt)

@section('content')
<!-- Breadcrumb -->
<section class="bg-gray-100 py-4">
    <div class="container mx-auto px-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">
                        <i class="fas fa-home mr-1"></i>Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <a href="{{ route('success-stories') }}" class="text-gray-700 hover:text-blue-600">Success Stories</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-gray-500 truncate">{{ $story->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <div class="flex justify-center mb-6">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-white bg-opacity-20">
                    <i class="fas fa-star mr-2"></i>{{ $story->visa_type }}
                </span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold mb-6">{{ $story->title }}</h1>
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-6 text-lg">
                <div class="flex items-center">
                    <i class="fas fa-user mr-2"></i>
                    <span>{{ $story->client_name }}</span>
                </div>
                @if($story->client_country)
                <div class="flex items-center">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span>{{ $story->client_country }}</span>
                </div>
                @endif
                @if($story->success_date)
                <div class="flex items-center">
                    <i class="fas fa-calendar mr-2"></i>
                    <span>{{ $story->success_date->format('M Y') }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Story Content -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    @if($story->image)
                    <div class="mb-8">
                        <img src="{{ asset('storage/' . $story->image) }}" alt="{{ $story->image_alt }}" class="w-full h-64 md:h-80 object-cover rounded-xl shadow-lg">
                    </div>
                    @endif
                    
                    <div class="prose prose-lg max-w-none">
                        {!! $story->content !!}
                    </div>

                    <!-- Media Section -->
                    @if($story->hasVideo() || $story->youtube_url)
                    <div class="mt-8 p-6 bg-gray-50 rounded-xl">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Media</h3>
                        <div class="space-y-4">
                            @if($story->youtube_url)
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-2">YouTube Video</h4>
                                <a href="{{ $story->youtube_url }}" target="_blank" class="inline-flex items-center text-red-600 hover:text-red-800 font-medium">
                                    <i class="fab fa-youtube mr-2 text-xl"></i>
                                    Watch on YouTube
                                </a>
                            </div>
                            @endif
                            @if($story->pdf_doc)
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Document</h4>
                                <a href="{{ $story->pdf_url }}" target="_blank" class="inline-flex items-center text-red-600 hover:text-red-800 font-medium">
                                    <i class="fas fa-file-pdf mr-2 text-xl"></i>
                                    View {{ $story->video_type === 'pdf' ? 'PDF' : 'Video' }}
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    <!-- Share Buttons -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Share this success story</h3>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                <i class="fab fa-facebook-f mr-2"></i>Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($story->title) }}" 
                               target="_blank" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-lg">
                                <i class="fab fa-twitter mr-2"></i>Twitter
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                               target="_blank" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg">
                                <i class="fab fa-linkedin-in mr-2"></i>LinkedIn
                            </a>
                            <button onclick="copyToClipboard('{{ request()->url() }}')" 
                                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                <i class="fas fa-link mr-2"></i>Copy Link
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Story Info Card -->
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Story Details</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Client Name</label>
                                <p class="text-sm text-gray-600">{{ $story->client_name }}</p>
                            </div>
                            @if($story->client_country)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Country</label>
                                <p class="text-sm text-gray-600">{{ $story->client_country }}</p>
                            </div>
                            @endif
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Visa Type</label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $story->visa_type }}
                                </span>
                            </div>
                            @if($story->category_name && $story->category_name !== 'Uncategorized')
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Category</label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $story->category_name }}
                                </span>
                            </div>
                            @endif
                            @if($story->success_date)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Success Date</label>
                                <p class="text-sm text-gray-600">{{ $story->success_date->format('F d, Y') }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- CTA Card -->
                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl shadow-lg p-6 text-white">
                        <h3 class="text-lg font-semibold mb-4">Ready to Start Your Journey?</h3>
                        <p class="text-blue-100 mb-6">Let us help you write your own success story.</p>
                        <div class="space-y-3">
                            <a href="{{ route('appointment') }}" class="block w-full bg-white text-blue-600 hover:bg-gray-100 text-center px-4 py-3 rounded-lg font-medium">
                                Book Free Consultation
                            </a>
                            <a href="{{ route('contact') }}" class="block w-full border-2 border-white text-white hover:bg-white hover:text-blue-600 text-center px-4 py-3 rounded-lg font-medium">
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Stories -->
@if($relatedStories->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">More Success Stories</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($relatedStories as $relatedStory)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    @if($relatedStory->image)
                    <img src="{{ asset('storage/' . $relatedStory->image) }}" alt="{{ $relatedStory->image_alt }}" class="w-full h-48 object-cover">
                    @else
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                        <i class="fas fa-star text-white text-4xl"></i>
                    </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $relatedStory->visa_type }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $relatedStory->success_date ? $relatedStory->success_date->format('M Y') : $relatedStory->created_at->format('M Y') }}
                            </span>
                        </div>
                        
                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">
                            {{ $relatedStory->title }}
                        </h3>
                        
                        <p class="text-gray-600 mb-4 line-clamp-2">
                            {{ $relatedStory->excerpt }}
                        </p>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $relatedStory->client_name }}</p>
                                    @if($relatedStory->client_country)
                                    <p class="text-xs text-gray-500">{{ $relatedStory->client_country }}</p>
                                    @endif
                                </div>
                            </div>
                            
                            <a href="{{ route('success-story.detail', $relatedStory->slug) }}" 
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                Read More
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('success-stories') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium">
                    View All Success Stories
                </a>
            </div>
        </div>
    </div>
</section>
@endif
@endsection

@push('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.prose {
    color: #374151;
    line-height: 1.75;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #111827;
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.prose p {
    margin-bottom: 1.5rem;
}

.prose ul, .prose ol {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}

.prose li {
    margin-bottom: 0.5rem;
}
</style>
@endpush

@push('scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const button = event.target;
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check mr-2"></i>Copied!';
        button.classList.add('bg-green-600', 'hover:bg-green-700');
        button.classList.remove('bg-gray-600', 'hover:bg-gray-700');
        
        setTimeout(function() {
            button.innerHTML = originalText;
            button.classList.remove('bg-green-600', 'hover:bg-green-700');
            button.classList.add('bg-gray-600', 'hover:bg-gray-700');
        }, 2000);
    });
}
</script>
@endpush
