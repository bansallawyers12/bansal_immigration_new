@extends('layouts.admin')

@section('title', 'View Page')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">View Page</h1>
            <p class="text-gray-600">Page details and information</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.cms.edit', $page) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-edit mr-2"></i>Edit Page
            </a>
            <a href="{{ route('admin.cms.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Back to Pages
            </a>
        </div>
    </div>

    <!-- Page Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <p class="text-gray-900">{{ $page->title }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                            <p class="text-gray-900 font-mono">{{ $page->slug }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <p class="text-gray-900">{{ $page->category ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subcategory</label>
                            <p class="text-gray-900">{{ $page->subcategory ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Parent Page</label>
                            <p class="text-gray-900">{{ $page->parent->title ?? 'Root Page' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Template</label>
                            <p class="text-gray-900">{{ $page->template ?? 'default' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Content</h3>
                    
                    @if($page->excerpt)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <p class="text-gray-900">{{ $page->excerpt }}</p>
                        </div>
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 max-h-96 overflow-y-auto">
                            <div class="prose max-w-none">
                                {!! $page->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Information -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">SEO Settings</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                            <p class="text-gray-900">{{ $page->meta_title ?? 'Not set (will use page title)' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                            <p class="text-gray-900">{{ $page->meta_description ?? 'Not set' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label>
                            <p class="text-gray-900">{{ $page->meta_keywords ?? 'Not set' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status & Settings -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Status & Settings</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Status</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $page->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $page->status ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Featured</span>
                            @if($page->featured)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-star mr-1"></i>Featured
                                </span>
                            @else
                                <span class="text-sm text-gray-500">No</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Display Order</span>
                            <span class="text-sm text-gray-900">{{ $page->order }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Image -->
            @if($page->image)
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Featured Image</h3>
                    <div class="space-y-3">
                        <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->image_alt ?? $page->title }}" class="w-full h-48 object-cover rounded-lg">
                        @if($page->image_alt)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Alt Text</label>
                                <p class="text-sm text-gray-900">{{ $page->image_alt }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Child Pages -->
            @if($page->children->count() > 0)
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Child Pages ({{ $page->children->count() }})</h3>
                    <ul class="space-y-2">
                        @foreach($page->children as $child)
                        <li>
                            <a href="{{ route('admin.cms.show', $child) }}" class="text-blue-600 hover:text-blue-800 block py-1">
                                {{ $child->title }}
                                <span class="text-xs text-gray-500 ml-2">({{ $child->status ? 'Active' : 'Inactive' }})</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <!-- Page Information -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Page Information</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Created:</span>
                            <span class="text-gray-900">{{ $page->created_at->format('M d, Y g:i A') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Last Updated:</span>
                            <span class="text-gray-900">{{ $page->updated_at->format('M d, Y g:i A') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">ID:</span>
                            <span class="text-gray-900 font-mono">{{ $page->id }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-2">
                        <a href="{{ route('admin.cms.edit', $page) }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium text-center block">
                            <i class="fas fa-edit mr-2"></i>Edit Page
                        </a>
                        <form method="POST" action="{{ route('admin.cms.update-status', $page) }}" class="w-full">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="{{ $page->status ? 0 : 1 }}">
                            <button type="submit" class="w-full {{ $page->status ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white px-4 py-2 rounded-lg font-medium">
                                <i class="fas fa-toggle-{{ $page->status ? 'off' : 'on' }} mr-2"></i>
                                {{ $page->status ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.cms.destroy', $page) }}" class="w-full" onsubmit="return confirm('Are you sure you want to delete this page? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium">
                                <i class="fas fa-trash mr-2"></i>Delete Page
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
