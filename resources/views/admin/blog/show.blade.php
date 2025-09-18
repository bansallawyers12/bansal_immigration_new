@extends('layouts.admin')

@section('title', 'View Blog Post')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Blog Post Details</h1>
            <p class="text-gray-600">View and manage blog post information</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.blog.edit', $blog) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-edit mr-2"></i>Edit Post
            </a>
            <a href="{{ route('admin.blog.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Back to Blog Posts
            </a>
        </div>
    </div>

    <!-- Blog Post Details -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        @if($blog->image)
                            <img src="{{ asset('img/blog/' . $blog->image) }}" alt="{{ $blog->image_alt }}" class="h-16 w-16 rounded-lg object-cover">
                        @else
                            <div class="h-16 w-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-image text-gray-400 text-xl"></i>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">{{ $blog->title }}</h2>
                        <p class="text-sm text-gray-600">By {{ $blog->author ?? 'Admin' }} • {{ $blog->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    @if($blog->status)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>Published
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock mr-1"></i>Draft
                        </span>
                    @endif
                    
                    @if($blog->featured)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-star mr-1"></i>Featured
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-6 py-6">
            <!-- Short Description -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Short Description</h3>
                <p class="text-gray-700">{{ $blog->short_description }}</p>
            </div>

            <!-- Full Content -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Content</h3>
                <div class="prose max-w-none">
                    {!! nl2br(e($blog->description)) !!}
                </div>
            </div>

            <!-- SEO Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">SEO Information</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Meta Title</label>
                            <p class="text-sm text-gray-600">{{ $blog->meta_title ?: 'Not set' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Meta Description</label>
                            <p class="text-sm text-gray-600">{{ $blog->meta_description ?: 'Not set' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Meta Keywords</label>
                            <p class="text-sm text-gray-600">{{ $blog->meta_keywords ?: 'Not set' }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Post Information</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Slug</label>
                            <p class="text-sm text-gray-600 font-mono">{{ $blog->slug }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Published Date</label>
                            <p class="text-sm text-gray-600">{{ $blog->published_at ? $blog->published_at->format('M d, Y \a\t g:i A') : 'Not published' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                            <p class="text-sm text-gray-600">{{ $blog->updated_at->format('M d, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Information -->
            @if($blog->image)
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Featured Image</h3>
                    <div class="flex items-start space-x-4">
                        <img src="{{ asset('img/blog/' . $blog->image) }}" alt="{{ $blog->image_alt }}" class="h-32 w-32 rounded-lg object-cover border">
                        <div>
                            <p class="text-sm text-gray-600"><strong>Alt Text:</strong> {{ $blog->image_alt ?: 'Not set' }}</p>
                            <p class="text-sm text-gray-600"><strong>File:</strong> {{ $blog->image }}</p>
                        </div>
                    </div>
            </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            <div class="flex justify-between items-center">
                <div class="flex space-x-3">
                    <a href="{{ route('blog.detail', $blog->slug) }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium">
                        <i class="fas fa-external-link-alt mr-2"></i>View on Website
                    </a>
                    
                    @if($blog->status)
                        <form method="POST" action="{{ route('admin.blog.update-status', $blog) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="0">
                            <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-medium">
                                <i class="fas fa-eye-slash mr-2"></i>Unpublish
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.blog.update-status', $blog) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium">
                                <i class="fas fa-eye mr-2"></i>Publish
                            </button>
                        </form>
                    @endif

                    <form method="POST" action="{{ route('admin.blog.toggle-featured', $blog) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-medium">
                            <i class="fas fa-star mr-2"></i>{{ $blog->featured ? 'Remove from Featured' : 'Mark as Featured' }}
                        </button>
                    </form>
                </div>

                <form method="POST" action="{{ route('admin.blog.destroy', $blog) }}" class="inline" 
                      onsubmit="return confirm('Are you sure you want to delete this blog post? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium">
                        <i class="fas fa-trash mr-2"></i>Delete Post
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
