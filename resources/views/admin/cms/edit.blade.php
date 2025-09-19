@extends('layouts.admin')

@section('title', 'Edit Page')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Page</h1>
            <p class="text-gray-600">Update page information and content</p>
        </div>
        <a href="{{ route('admin.cms.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium">
            <i class="fas fa-arrow-left mr-2"></i>Back to Pages
        </a>
    </div>

    <!-- Edit Page Form -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.cms.update', $page) }}" class="space-y-6" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div class="md:col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Page Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title', $page->title) }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                                   placeholder="Enter the main title of your page">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div class="md:col-span-2">
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                                URL Slug <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $page->slug) }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('slug') border-red-500 @enderror"
                                   placeholder="URL-friendly version of title (e.g., 'about-us', 'contact')">
                            @error('slug')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Leave empty to auto-generate from title. Use lowercase letters, numbers, and hyphens only.</p>
                        </div>

                        <!-- Route Name -->
                        <div class="md:col-span-2">
                            <label for="route_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Route Name
                            </label>
                            <input type="text" name="route_name" id="route_name" value="{{ old('route_name', $page->route_name) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('route_name') border-red-500 @enderror"
                                   placeholder="Laravel route name (auto-generated)">
                            @error('route_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Leave empty to auto-generate from category and slug</p>
                        </div>

                        <!-- Short Description -->
                        <div class="md:col-span-2">
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                                Short Description
                            </label>
                            <textarea name="excerpt" id="excerpt" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('excerpt') border-red-500 @enderror"
                                      placeholder="Brief description of the page (used for previews and SEO)">{{ old('excerpt', $page->excerpt) }}</textarea>
                            @error('excerpt')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Optional: A brief summary of the page content (150-160 characters recommended)</p>
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                Page Category
                            </label>
                            <select name="category" id="category" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category') border-red-500 @enderror">
                                <option value="">Choose a category for this page</option>
                                @foreach($categories as $key => $name)
                                    <option value="{{ $key }}" {{ old('category', $page->category) === $key ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subcategory -->
                        <div>
                            <label for="subcategory" class="block text-sm font-medium text-gray-700 mb-2">
                                Page Subcategory
                            </label>
                            <input type="text" name="subcategory" id="subcategory" value="{{ old('subcategory', $page->subcategory) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('subcategory') border-red-500 @enderror"
                                   placeholder="Enter a specific subcategory (optional)">
                            @error('subcategory')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Parent Page -->
                        <div>
                            <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Parent Page (Hierarchy)
                            </label>
                            <select name="parent_id" id="parent_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('parent_id') border-red-500 @enderror">
                                <option value="">No Parent (Top Level Page)</option>
                                @foreach($parentPages as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id', $page->parent_id) == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Template -->
                        <div>
                            <label for="template" class="block text-sm font-medium text-gray-700 mb-2">
                                Page Template
                            </label>
                            <select name="template" id="template"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('template') border-red-500 @enderror">
                                <option value="default" {{ old('template', $page->template) === 'default' ? 'selected' : '' }}>Default</option>
                                <option value="full-width" {{ old('template', $page->template) === 'full-width' ? 'selected' : '' }}>Full Width</option>
                                <option value="sidebar" {{ old('template', $page->template) === 'sidebar' ? 'selected' : '' }}>With Sidebar</option>
                                <option value="landing" {{ old('template', $page->template) === 'landing' ? 'selected' : '' }}>Landing Page</option>
                            </select>
                            @error('template')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Page Content</h3>
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                            Main Content <span class="text-red-500">*</span>
                        </label>
                        <textarea name="content" id="content" rows="10" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('content') border-red-500 @enderror"
                                  placeholder="Write your page content here using the rich text editor below...">{{ old('content', $page->content) }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

            <!-- Media -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Page Media</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- New Image -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $page->image ? 'Replace Image' : 'Featured Image' }}
                        </label>
                        <input type="file" name="image" id="image" accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image') border-red-500 @enderror"
                               onchange="previewImage(this)">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div id="image-preview" class="mt-2 hidden">
                            <img id="preview-img" class="h-32 w-32 object-cover rounded-lg border">
                        </div>
                    </div>

                    <!-- Current Image -->
                    @if($page->image)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                        <div class="relative">
                            <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->image_alt ?? $page->title }}" class="h-32 w-32 object-cover rounded-lg border">
                            <div class="absolute top-2 right-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Current
                                </span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Image Alt Text -->
                    <div class="md:col-span-2">
                        <label for="image_alt" class="block text-sm font-medium text-gray-700 mb-2">Image Alt Text (Accessibility)</label>
                        <input type="text" name="image_alt" id="image_alt" value="{{ old('image_alt', $page->image_alt) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image_alt') border-red-500 @enderror"
                               placeholder="Describe the image for screen readers and accessibility">
                        @error('image_alt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Additional Media Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <!-- Current PDF/Video -->
                    @if($page->pdf_doc)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Document</label>
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            @php
                                $extension = pathinfo($page->pdf_doc, PATHINFO_EXTENSION);
                                $isVideo = in_array(strtolower($extension), ['mp4', 'avi', 'mov', 'wmv']);
                            @endphp
                            
                            @if($isVideo)
                                <div class="flex-shrink-0">
                                    <i class="fas fa-video text-blue-500 text-xl"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $page->pdf_doc }}</p>
                                    <p class="text-xs text-gray-500">Video File</p>
                                </div>
                            @else
                                <div class="flex-shrink-0">
                                    <i class="fas fa-file-pdf text-red-500 text-xl"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $page->pdf_doc }}</p>
                                    <p class="text-xs text-gray-500">PDF Document</p>
                                </div>
                            @endif
                            <div class="flex-shrink-0">
                                <a href="{{ asset('storage/' . $page->pdf_doc) }}" target="_blank" 
                                   class="text-blue-600 hover:text-blue-800 text-sm">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- PDF/Video Upload -->
                    <div>
                        <label for="pdf_doc" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $page->pdf_doc ? 'Replace Document' : 'PDF/Video Document' }}
                        </label>
                        <input type="file" name="pdf_doc" id="pdf_doc" accept=".pdf,.mp4,.avi,.mov,.wmv"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('pdf_doc') border-red-500 @enderror">
                        @error('pdf_doc')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Supported formats: PDF, MP4, AVI, MOV, WMV (Max: 10MB)</p>
                    </div>

                    <!-- YouTube URL -->
                    <div>
                        <label for="youtube_url" class="block text-sm font-medium text-gray-700 mb-2">YouTube Video URL</label>
                        <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', $page->youtube_url) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('youtube_url') border-red-500 @enderror"
                               placeholder="https://www.youtube.com/watch?v=...">
                        @error('youtube_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Optional: Embed a YouTube video in your page</p>
                    </div>
                </div>
            </div>

                <!-- SEO Settings -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">SEO Settings</h3>
                    <div class="space-y-4">
                        <!-- Meta Title -->
                        <div>
                            <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                                SEO Title
                            </label>
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $page->meta_title) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('meta_title') border-red-500 @enderror"
                                   placeholder="Custom SEO title (leave blank to use page title)">
                            @error('meta_title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Recommended: 50-60 characters for optimal SEO</p>
                        </div>

                        <!-- Meta Description -->
                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                                SEO Description
                            </label>
                            <textarea name="meta_description" id="meta_description" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('meta_description') border-red-500 @enderror"
                                      placeholder="Brief description for search engines...">{{ old('meta_description', $page->meta_description) }}</textarea>
                            @error('meta_description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Recommended: 150-160 characters for optimal SEO</p>
                        </div>

                        <!-- Meta Keywords -->
                        <div>
                            <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">
                                SEO Keywords
                            </label>
                            <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('meta_keywords') border-red-500 @enderror"
                                   placeholder="Keywords separated by commas (e.g., immigration, visa, canada)">
                            @error('meta_keywords')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Enter relevant keywords to help with search engine optimization</p>
                        </div>
                    </div>
                </div>

                <!-- Settings -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Page Settings</h3>
                    <div class="flex flex-wrap items-center gap-6">
                        <!-- Status -->
                        <div class="flex items-center">
                            <input type="checkbox" name="status" id="status" value="1" {{ old('status', $page->status) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="status" class="ml-2 block text-sm text-gray-900">Published</label>
                        </div>

                        <!-- Featured -->
                        <div class="flex items-center">
                            <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $page->featured) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="featured" class="ml-2 block text-sm text-gray-900">Featured Page</label>
                        </div>

                        <!-- Order -->
                        <div class="flex items-center">
                            <label for="order" class="block text-sm font-medium text-gray-700 mr-2">
                                Display Order:
                            </label>
                            <input type="number" name="order" id="order" value="{{ old('order', $page->order) }}" min="0"
                                   class="w-20 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('order') border-red-500 @enderror">
                            @error('order')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.cms.index') }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg font-medium">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                        <i class="fas fa-save mr-2"></i>Update Page
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- CKEditor Custom Styles -->
<style>
.ck-editor__editable {
    min-height: 300px;
    border-radius: 0.5rem;
    border: 1px solid #d1d5db;
}

.ck-editor__editable:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.ck.ck-editor {
    border-radius: 0.5rem;
}

.ck.ck-toolbar {
    border-radius: 0.5rem 0.5rem 0 0;
    border: 1px solid #d1d5db;
    border-bottom: none;
}

.ck.ck-editor__main > .ck-editor__editable {
    border-radius: 0 0 0.5rem 0.5rem;
    border-top: none;
}
</style>
@endpush

@push('scripts')
<!-- CKEditor CDN - Stable Version -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function generateSlug() {
    const title = document.getElementById('title').value;
    if (title) {
        const slug = title
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
            .replace(/\s+/g, '-') // Replace spaces with hyphens
            .replace(/-+/g, '-') // Replace multiple hyphens with single hyphen
            .trim();
        
        document.getElementById('slug').value = slug;
    }
}

// Auto-generate slug from title (only if slug is empty)
document.getElementById('title').addEventListener('input', function() {
    const title = this.value;
    const slugField = document.getElementById('slug');
    
    // Only auto-generate if slug field is empty or matches the previous title
    if (!slugField.value || slugField.dataset.autoGenerated === 'true') {
        const slug = title
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
            .replace(/\s+/g, '-') // Replace spaces with hyphens
            .replace(/-+/g, '-') // Replace multiple hyphens with single hyphen
            .trim();
        
        slugField.value = slug;
        slugField.dataset.autoGenerated = 'true';
    }
});

// Mark slug as manually edited when user types in it
document.getElementById('slug').addEventListener('input', function() {
    this.dataset.autoGenerated = 'false';
});

// Initialize CKEditor
document.addEventListener('DOMContentLoaded', function() {
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'blockQuote', 'insertTable', '|',
                    'link', 'imageUpload', '|',
                    'undo', 'redo'
                ]
            },
            language: 'en',
            image: {
                toolbar: [
                    'imageTextAlternative', '|',
                    'imageStyle:alignLeft',
                    'imageStyle:alignCenter',
                    'imageStyle:alignRight'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            }
        })
        .then(editor => {
            console.log('CKEditor initialized successfully for CMS');
        })
        .catch(error => {
            console.error('Error initializing CKEditor:', error);
        });
});
</script>
@endpush
