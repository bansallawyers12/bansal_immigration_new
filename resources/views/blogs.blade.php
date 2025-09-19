@extends('layouts.frontend')

@section('title', 'Blog - Bansal Immigration')
@section('description', 'Stay updated with the latest immigration news, tips, and insights from our expert team at Bansal Immigration.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Our Blog</h1>
            <p class="text-xl md:text-2xl mb-8">Latest immigration news, tips, and insights</p>
            <div class="flex justify-center">
                <div class="bg-white bg-opacity-20 rounded-full px-6 py-2">
                    <span class="text-sm font-medium">{{ isset($blogTotal) ? $blogTotal : count($bloglists) }} Articles</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search and Filter Section -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <form method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search blog posts..." 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div class="flex gap-2">
                    <select name="featured" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">All Posts</option>
                        <option value="1" {{ request('featured') === '1' ? 'selected' : '' }}>Featured Only</option>
                    </select>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">
                        <i class="fas fa-search mr-2"></i>Search
                    </button>
                    @if(request()->hasAny(['search', 'featured']))
                    <a href="{{ route('blogs') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium">
                        Clear
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Blog Posts Grid -->
<section class="py-16">
    <div class="container mx-auto px-4">
        @if(count($bloglists) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($bloglists as $blog)
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    @if($blog->image)
                    <div class="relative">
                        <img src="{{ asset('img/blog/' . $blog->image) }}" alt="{{ $blog->image_alt ?: $blog->title }}" class="w-full h-48 object-cover" loading="lazy">
                        @if($blog->featured)
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-star mr-1"></i>Featured
                            </span>
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                        <i class="fas fa-blog text-white text-4xl"></i>
                    </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm text-gray-500">
                                {{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}
                            </span>
                            @if($blog->author)
                            <span class="text-sm text-gray-500">By {{ $blog->author }}</span>
                            @endif
                        </div>
                        
                        <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                            {{ $blog->title }}
                        </h2>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $blog->short_description }}
                        </p>
                        
                        <a href="{{ route('blog.detail', $blog->slug) }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                            Read More
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $bloglists->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-blog text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Blog Posts Found</h3>
                    <p class="text-gray-600 mb-6">
                        @if(request()->hasAny(['search', 'featured']))
                            No blog posts match your search criteria. Try adjusting your filters.
                        @else
                            We're working on creating valuable content for you. Check back soon!
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'featured']))
                    <a href="{{ route('blogs') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium">
                        View All Posts
                    </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Admin Quick Actions (Only for authenticated users) -->
@auth
<section class="py-8 bg-gray-100">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Admin Quick Actions</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('admin.blog.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                        <i class="fas fa-cog mr-2"></i>Manage Blog Posts
                    </a>
                    <a href="{{ route('admin.blog.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium">
                        <i class="fas fa-plus mr-2"></i>Create New Post
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium">
                        <i class="fas fa-tachometer-alt mr-2"></i>Admin Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endauth

<!-- CTA Section -->
<section class="bg-blue-600 py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Need Immigration Help?</h2>
        <p class="text-xl text-blue-100 mb-8">Our experts are here to guide you through your immigration journey</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('appointment') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-medium">
                Book Free Consultation
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-3 rounded-lg font-medium">
                Contact Us
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

@push('scripts')
<script>
// Add any JavaScript functionality here if needed
document.addEventListener('DOMContentLoaded', function() {
    // Search form enhancement
    const searchForm = document.querySelector('form[method="GET"]');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            const searchInput = this.querySelector('input[name="search"]');
            if (searchInput && searchInput.value.trim() === '') {
                searchInput.remove();
            }
        });
    }
});
</script>
@endpush
