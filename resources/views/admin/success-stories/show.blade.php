@extends('layouts.admin')

@section('title', 'View Success Story')

@section('content')
<div class="p-4 md:p-6 ml-0 md:ml-4">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Success Story Details</h1>
            <p class="text-gray-600">View and manage success story information</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.success-stories.edit', $successStory) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-edit mr-2"></i>Edit Story
            </a>
            <a href="{{ route('admin.success-stories.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Back to Success Stories
            </a>
        </div>
    </div>

    <!-- Success Story Details -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        @if($successStory->image)
                            <img src="{{ asset('storage/' . $successStory->image) }}" alt="{{ $successStory->image_alt }}" class="h-16 w-16 rounded-lg object-cover">
                        @else
                            <div class="h-16 w-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-star text-gray-400 text-xl"></i>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">{{ $successStory->title }}</h2>
                        <p class="text-sm text-gray-600">{{ $successStory->client_name }} • {{ $successStory->visa_type }} • {{ $successStory->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    @if($successStory->status)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>Active
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <i class="fas fa-times-circle mr-1"></i>Inactive
                        </span>
                    @endif
                    
                    @if($successStory->featured)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-star mr-1"></i>Featured
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-6 py-6">
            <!-- Client Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Client Information</h3>
                    <div class="space-y-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Client Name</label>
                            <p class="text-sm text-gray-600">{{ $successStory->client_name }}</p>
                        </div>
                        @if($successStory->client_country)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Country</label>
                            <p class="text-sm text-gray-600">{{ $successStory->client_country }}</p>
                        </div>
                        @endif
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Visa Type</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $successStory->visa_type }}
                            </span>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Story Information</h3>
                    <div class="space-y-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Success Date</label>
                            <p class="text-sm text-gray-600">{{ $successStory->success_date ? $successStory->success_date->format('M d, Y') : 'Not set' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Display Order</label>
                            <p class="text-sm text-gray-600">{{ $successStory->order }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Slug</label>
                            <p class="text-sm text-gray-600 font-mono">{{ $successStory->slug }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Excerpt -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Short Excerpt</h3>
                <p class="text-gray-700">{{ $successStory->excerpt }}</p>
            </div>

            <!-- Full Story -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Full Story</h3>
                <div class="prose max-w-none">
                    {!! nl2br(e($successStory->content)) !!}
                </div>
            </div>

            <!-- SEO Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">SEO Information</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Meta Title</label>
                            <p class="text-sm text-gray-600">{{ $successStory->meta_title ?: 'Not set' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Meta Description</label>
                            <p class="text-sm text-gray-600">{{ $successStory->meta_description ?: 'Not set' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Meta Keywords</label>
                            <p class="text-sm text-gray-600">{{ $successStory->meta_keywords ?: 'Not set' }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Timestamps</h3>
                    <div class="space-y-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Created</label>
                            <p class="text-sm text-gray-600">{{ $successStory->created_at->format('M d, Y \a\t g:i A') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                            <p class="text-sm text-gray-600">{{ $successStory->updated_at->format('M d, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Information -->
            @if($successStory->image)
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Featured Image</h3>
                <div class="flex items-start space-x-4">
                    <img src="{{ asset('storage/' . $successStory->image) }}" alt="{{ $successStory->image_alt }}" class="h-32 w-32 rounded-lg object-cover border">
                    <div>
                        <p class="text-sm text-gray-600"><strong>Alt Text:</strong> {{ $successStory->image_alt ?: 'Not set' }}</p>
                        <p class="text-sm text-gray-600"><strong>File:</strong> {{ $successStory->image }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            <div class="flex justify-between items-center">
                <div class="flex space-x-3">
                    <a href="{{ route('success-story.detail', $successStory->slug) }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium">
                        <i class="fas fa-external-link-alt mr-2"></i>View on Website
                    </a>
                    
                    @if($successStory->status)
                        <form method="POST" action="{{ route('admin.success-stories.update-status', $successStory) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="0">
                            <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-medium">
                                <i class="fas fa-eye-slash mr-2"></i>Deactivate
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.success-stories.update-status', $successStory) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium">
                                <i class="fas fa-eye mr-2"></i>Activate
                            </button>
                        </form>
                    @endif

                    <form method="POST" action="{{ route('admin.success-stories.toggle-featured', $successStory) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-medium">
                            <i class="fas fa-star mr-2"></i>{{ $successStory->featured ? 'Remove from Featured' : 'Mark as Featured' }}
                        </button>
                    </form>
                </div>

                <form method="POST" action="{{ route('admin.success-stories.destroy', $successStory) }}" class="inline" 
                      onsubmit="return confirm('Are you sure you want to delete this success story? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium">
                        <i class="fas fa-trash mr-2"></i>Delete Story
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
