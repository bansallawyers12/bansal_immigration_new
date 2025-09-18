@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Site Settings</h1>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
            Back to Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Website Configuration</h3>
            <p class="text-sm text-gray-600">Manage global website settings and content.</p>
        </div>

        <form method="POST" action="{{ route('admin.settings.update') }}" class="p-6">
            @csrf
            
            <!-- SEO Settings -->
            <div class="mb-8">
                <h4 class="text-lg font-medium text-gray-900 mb-4">SEO Settings</h4>
                
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                            Site Title
                        </label>
                        <input type="text" 
                               id="meta_title" 
                               name="meta_title" 
                               value="{{ $settings['meta_title'] ?? 'Bansal Immigration Consultants - Your Future, Our Priority' }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                               required>
                        @error('meta_title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                            Site Description
                        </label>
                        <textarea id="meta_description" 
                                  name="meta_description" 
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                  required>{{ $settings['meta_description'] ?? 'Expert Australian immigration consultants providing visa services, migration advice, and pathway guidance for students, skilled workers, and families.' }}</textarea>
                        @error('meta_description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Homepage Settings -->
            <div class="mb-8">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Homepage Settings</h4>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="sliderstatus" class="block text-sm font-medium text-gray-700 mb-2">
                            Show Homepage Slider
                        </label>
                        <select id="sliderstatus" 
                                name="sliderstatus"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option value="1" {{ ($settings['sliderstatus'] ?? '1') == '1' ? 'selected' : '' }}>Yes, Show Slider</option>
                            <option value="0" {{ ($settings['sliderstatus'] ?? '1') == '0' ? 'selected' : '' }}>No, Hide Slider</option>
                        </select>
                        @error('sliderstatus')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="meet_link" class="block text-sm font-medium text-gray-700 mb-2">
                            "Contact Us" Button Link
                        </label>
                        <input type="text" 
                               id="meet_link" 
                               name="meet_link" 
                               value="{{ $settings['meet_link'] ?? '/contact' }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                               placeholder="/contact"
                               required>
                        @error('meet_link')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end pt-6 border-t border-gray-200">
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Save Settings
                </button>
            </div>
        </form>
    </div>

    <!-- Additional Settings Info -->
    <div class="mt-8 bg-blue-50 rounded-lg p-6">
        <h4 class="text-lg font-medium text-blue-900 mb-3">Additional Configuration</h4>
        <div class="text-sm text-blue-800 space-y-2">
            <p><strong>Email Configuration:</strong> Configure SMTP settings in your .env file for contact form emails.</p>
            <p><strong>reCAPTCHA:</strong> Add RECAPTCHA_SECRET and RECAPTCHA_SITE_KEY to your .env file to enable spam protection.</p>
            <p><strong>Content Management:</strong> Blog posts, services, and other content can be managed through database tools or by extending this admin panel.</p>
        </div>
    </div>
</div>
@endsection
