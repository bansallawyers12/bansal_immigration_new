@extends('layouts.admin')

@section('title', 'Create New Page')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Create New Page</h1>
            <p class="text-gray-600">Add a new page to your website</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.cms.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Back to Pages
            </a>
        </div>
    </div>

    <!-- Create Page Form -->
    <div class="bg-white rounded-lg shadow">
        <form method="POST" action="{{ route('admin.cms.store') }}" class="space-y-6" enctype="multipart/form-data">
            @csrf

            <!-- Basic Information -->
            <div class="border-b border-gray-200 pb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                    <div class="flex items-center space-x-2">
                        <button type="button" onclick="generateSlug()" class="text-sm text-blue-600 hover:text-blue-800">
                            <i class="fas fa-magic mr-1"></i>Auto-generate Slug
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Page Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                               placeholder="Enter page title">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="md:col-span-2">
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                            Slug <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('slug') border-red-500 @enderror"
                               placeholder="URL-friendly version of title (auto-generated)">
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Leave empty to auto-generate from title</p>
                    </div>

                    <!-- Route Name -->
                    <div class="md:col-span-2">
                        <label for="route_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Route Name
                        </label>
                        <input type="text" name="route_name" id="route_name" value="{{ old('route_name') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('route_name') border-red-500 @enderror"
                               placeholder="Laravel route name (auto-generated)">
                        @error('route_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Leave empty to auto-generate from category and slug</p>
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Category
                        </label>
                        <select name="category" id="category" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category') border-red-500 @enderror">
                            <option value="">Select Category</option>
                            @foreach($categories as $key => $name)
                                <option value="{{ $key }}" {{ old('category') === $key ? 'selected' : '' }}>
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
                            Subcategory
                        </label>
                        <input type="text" name="subcategory" id="subcategory" value="{{ old('subcategory') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('subcategory') border-red-500 @enderror"
                               placeholder="e.g., Visa Services, Company Info">
                        @error('subcategory')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Parent Page -->
                    <div>
                        <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Parent Page
                        </label>
                        <select name="parent_id" id="parent_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('parent_id') border-red-500 @enderror">
                            <option value="">No Parent (Root Page)</option>
                            @foreach($parentPages as $parent)
                                <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
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
                            Template
                        </label>
                        <select name="template" id="template"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('template') border-red-500 @enderror">
                            <option value="default" {{ old('template', 'default') === 'default' ? 'selected' : '' }}>Default (Modern)</option>
                            <option value="full-width" {{ old('template') === 'full-width' ? 'selected' : '' }}>Full Width</option>
                            <option value="sidebar" {{ old('template') === 'sidebar' ? 'selected' : '' }}>With Sidebar</option>
                            <option value="landing" {{ old('template') === 'landing' ? 'selected' : '' }}>Landing Page</option>
                        </select>
                        @error('template')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Content</h3>
                <div class="space-y-4">
                    <!-- Excerpt -->
                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                            Excerpt
                        </label>
                        <textarea name="excerpt" id="excerpt" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('excerpt') border-red-500 @enderror"
                                  placeholder="Brief description of the page...">{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                            Content <span class="text-red-500">*</span>
                        </label>
                        <textarea name="content" id="content" rows="10" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('content') border-red-500 @enderror"
                                  placeholder="Enter page content...">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Visa Structured Fields -->
            <div class="border-b border-gray-200 pb-6" id="visa-structured-section" style="display: none;">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-medium text-gray-900">Visa Structured Content</h3>
                    <p class="text-xs text-gray-500">Shown only when Template = Visa (Structured)</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Highlights JSON</label>
                        <textarea name="visa_highlights" rows="3" placeholder='[{"label":"Duration","value":"4 years"}]'
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('visa_highlights') border-red-500 @enderror">{{ old('visa_highlights') }}</textarea>
                        @error('visa_highlights')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">[{label, value}] up to 6 items. Keep values ≤14 chars.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Eligibility (JSON array)</label>
                        <textarea name="visa_eligibility" rows="3" placeholder='["Item 1","Item 2"]'
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('visa_eligibility') border-red-500 @enderror">{{ old('visa_eligibility') }}</textarea>
                        @error('visa_eligibility')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Benefits (JSON array)</label>
                        <textarea name="visa_benefits" rows="3" placeholder='["Item 1","Item 2"]'
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('visa_benefits') border-red-500 @enderror">{{ old('visa_benefits') }}</textarea>
                        @error('visa_benefits')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Steps (JSON array)</label>
                        <textarea name="visa_steps" rows="3" placeholder='["Step 1","Step 2"]'
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('visa_steps') border-red-500 @enderror">{{ old('visa_steps') }}</textarea>
                        @error('visa_steps')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">FAQs JSON</label>
                        <textarea name="visa_faqs" rows="4" placeholder='[{"question":"Q?","answer":"A."}]'
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('visa_faqs') border-red-500 @enderror">{{ old('visa_faqs') }}</textarea>
                        @error('visa_faqs')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Store Markdown in answers for best safety/formatting.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Processing Times (JSON object)</label>
                        <textarea name="visa_processing_times" rows="3" placeholder='{"standard":"6–12 months","priority":"3–6 months","complex":"Up to 18 months"}'
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('visa_processing_times') border-red-500 @enderror">{{ old('visa_processing_times') }}</textarea>
                        @error('visa_processing_times')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Costs (JSON array)</label>
                        <textarea name="visa_costs" rows="3" placeholder='[{"label":"Primary Applicant","amount":"AUD $4,640"}]'
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('visa_costs') border-red-500 @enderror">{{ old('visa_costs') }}</textarea>
                        @error('visa_costs')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">[{label, amount, notes?}]</p>
                    </div>
                </div>
            </div>

            <!-- Media -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Media</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Featured Image -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            Featured Image
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

                    <!-- Image Alt Text -->
                    <div>
                        <label for="image_alt" class="block text-sm font-medium text-gray-700 mb-2">
                            Image Alt Text
                        </label>
                        <input type="text" name="image_alt" id="image_alt" value="{{ old('image_alt') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image_alt') border-red-500 @enderror"
                               placeholder="Describe the image for accessibility">
                        @error('image_alt')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Additional Media Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <!-- PDF/Video Upload -->
                    <div>
                        <label for="pdf_doc" class="block text-sm font-medium text-gray-700 mb-2">PDF/Video Document</label>
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
                        <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url') }}"
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
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('meta_title') border-red-500 @enderror"
                               placeholder="SEO title for search engines">
                        @error('meta_title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Meta Description -->
                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('meta_description') border-red-500 @enderror"
                                  placeholder="Brief description for search engines">{{ old('meta_description') }}</textarea>
                        @error('meta_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Meta Keywords -->
                    <div>
                        <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('meta_keywords') border-red-500 @enderror"
                               placeholder="Keywords separated by commas">
                        @error('meta_keywords')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Settings -->
            <div class="pb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Settings</h3>
                <div class="flex items-center space-x-6">
                    <!-- Status -->
                    <div class="flex items-center">
                        <input type="checkbox" name="status" id="status" value="1" {{ old('status', true) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="status" class="ml-2 block text-sm text-gray-900">Active</label>
                    </div>

                    <!-- Featured -->
                    <div class="flex items-center">
                        <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="featured" class="ml-2 block text-sm text-gray-900">Featured Page</label>
                    </div>
                </div>

                <!-- Display Order -->
                <div class="mt-4">
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                        Display Order
                    </label>
                    <input type="number" name="order" id="order" value="{{ old('order', 0) }}" min="0"
                           class="w-32 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('order') border-red-500 @enderror">
                    @error('order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.cms.index') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg font-medium">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                    <i class="fas fa-save mr-2"></i>Create Page
                </button>
            </div>
        </form>
    </div>
</div>

<!-- CKEditor CDN - Stable Version -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

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

// Auto-generate slug from title
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
    generateRouteName();
});

// Auto-generate route name when category or slug changes
function generateRouteName() {
    const category = document.getElementById('category').value;
    const slug = document.getElementById('slug').value;
    const routeNameField = document.getElementById('route_name');
    
    if (category && slug && (!routeNameField.value || routeNameField.dataset.autoGenerated === 'true')) {
        // Simple route name generation - can be enhanced with more complex logic
        const routeName = category + '.' + slug.replace(/-/g, '.');
        routeNameField.value = routeName;
        routeNameField.dataset.autoGenerated = 'true';
    }
}

// Add event listeners for category and slug changes
document.getElementById('category').addEventListener('change', generateRouteName);
document.getElementById('slug').addEventListener('input', generateRouteName);

// Mark route name as manually edited when user types in it
document.getElementById('route_name').addEventListener('input', function() {
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
            console.log('CKEditor initialized successfully');
        })
        .catch(error => {
            console.error('Error initializing CKEditor:', error);
        });

    const templateSelect = document.getElementById('template');
    const visaSection = document.getElementById('visa-structured-section');
    const defaultVisaHighlights = [
        { label: 'Duration', value: '4 years' },
        { label: 'Cost', value: 'AUD $4,640' },
        { label: 'Processing', value: 'Standard' },
        { label: 'Pathway', value: 'PR' }
    ];
    function toggleVisaSection() {
        visaSection.style.display = templateSelect.value === 'visa-structured' ? '' : 'none';
        if (templateSelect.value === 'visa-structured') {
            const hl = document.querySelector('textarea[name="visa_highlights"]');
            if (hl && !hl.value.trim()) {
                hl.value = JSON.stringify(defaultVisaHighlights, null, 2);
            }
        }
    }
    templateSelect.addEventListener('change', toggleVisaSection);
    toggleVisaSection();
});
</script>
@endsection
