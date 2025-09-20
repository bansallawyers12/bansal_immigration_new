@extends('layouts.main')

@section('title', $blogdetailists->meta_title ?: $blogdetailists->title . ' | Bansal Immigration Blog')
@section('description', $blogdetailists->meta_description ?: $blogdetailists->short_description)

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
                        <a href="{{ route('blogs') }}" class="text-gray-700 hover:text-blue-600">Blog</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-gray-500 truncate">{{ $blogdetailists->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>

<!-- Article Header -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">{{ $blogdetailists->title }}</h1>
                <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-6 text-gray-600">
                    @if($blogdetailists->author)
                    <div class="flex items-center">
                        <i class="fas fa-user mr-2"></i>
                        <span>By {{ $blogdetailists->author }}</span>
                    </div>
                    @endif
                    <div class="flex items-center">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>{{ $blogdetailists->published_at ? $blogdetailists->published_at->format('M d, Y') : $blogdetailists->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        <span>{{ ceil(str_word_count(strip_tags($blogdetailists->description)) / 200) }} min read</span>
                    </div>
                </div>
            </div>
            
            @if($blogdetailists->image)
            <div class="mb-8">
                <img src="{{ asset('img/blog/' . $blogdetailists->image) }}" alt="{{ $blogdetailists->image_alt }}" class="w-full h-64 md:h-80 object-cover rounded-xl shadow-lg">
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Article Content -->
<section class="pb-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="prose prose-lg max-w-none">
                        {!! nl2br(e($blogdetailists->description)) !!}
                    </div>
                    
                    <!-- Share Buttons -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Share this article</h3>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                               target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                <i class="fab fa-facebook-f mr-2"></i>Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blogdetailists->title) }}" 
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
                    <!-- Article Info Card -->
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Article Details</h3>
                        <div class="space-y-4">
                            @if($blogdetailists->author)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Author</label>
                                <p class="text-sm text-gray-600">{{ $blogdetailists->author }}</p>
                            </div>
                            @endif
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Published</label>
                                <p class="text-sm text-gray-600">{{ $blogdetailists->published_at ? $blogdetailists->published_at->format('F d, Y') : $blogdetailists->created_at->format('F d, Y') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Reading Time</label>
                                <p class="text-sm text-gray-600">{{ ceil(str_word_count(strip_tags($blogdetailists->description)) / 200) }} minutes</p>
                            </div>
                            @if($blogdetailists->featured)
                            <div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-star mr-1"></i>Featured Article
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- CTA Card -->
                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl shadow-lg p-6 text-white">
                        <h3 class="text-lg font-semibold mb-4">Need Immigration Help?</h3>
                        <p class="text-blue-100 mb-6">Our experts are here to guide you through your immigration journey.</p>
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

<!-- Related Articles -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">More Articles</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $relatedBlogs = \App\Models\Blog::where('status', true)
                        ->where('id', '!=', $blogdetailists->id)
                        ->latest()
                        ->take(3)
                        ->get();
                @endphp
                
                @foreach($relatedBlogs as $relatedBlog)
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    @if($relatedBlog->image)
                    <img src="{{ asset('img/blog/' . $relatedBlog->image) }}" alt="{{ $relatedBlog->image_alt }}" class="w-full h-48 object-cover">
                    @else
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                        <i class="fas fa-blog text-white text-4xl"></i>
                    </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm text-gray-500">
                                {{ $relatedBlog->published_at ? $relatedBlog->published_at->format('M d, Y') : $relatedBlog->created_at->format('M d, Y') }}
                            </span>
                            @if($relatedBlog->author)
                            <span class="text-sm text-gray-500">By {{ $relatedBlog->author }}</span>
                            @endif
                        </div>
                        
                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">
                            {{ $relatedBlog->title }}
                        </h3>
                        
                        <p class="text-gray-600 mb-4 line-clamp-2">
                            {{ $relatedBlog->short_description }}
                        </p>
                        
                        <a href="{{ route('blog.detail', $relatedBlog->slug) }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                            Read More
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('blogs') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium">
                    View All Articles
                </a>
            </div>
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
