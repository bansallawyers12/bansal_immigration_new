@extends('layouts.admin')

@section('title', 'System Settings')

@section('content')
<div class="navigation-container">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">System Settings</h1>
            <p class="text-gray-600">Configure your website settings and preferences</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition-colors flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <h4 class="font-semibold mb-2">Please fix the following errors:</h4>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-8">
            @csrf
            
            <!-- SEO Settings -->
        <div class="nav-card">
            <div class="flex items-center mb-6">
                <div class="nav-icon" style="background: #10b981; width: 50px; height: 50px;">
                    <i class="fas fa-search" style="font-size: 1.25rem;"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-900">SEO & Meta Settings</h3>
                    <p class="text-gray-600">Configure search engine optimization and social media sharing</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="lg:col-span-2">
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                        Site Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="meta_title" 
                               name="meta_title" 
                           value="{{ $allSettings['meta_title'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Your site title (appears in browser tabs and search results)"
                               required>
                    <p class="text-sm text-gray-500 mt-1">The main title that appears in search engine results and browser tabs</p>
                        @error('meta_title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                <div class="lg:col-span-2">
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                        Meta Description <span class="text-red-500">*</span>
                        </label>
                        <textarea id="meta_description" 
                                  name="meta_description" 
                                  rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                              placeholder="Brief description for search engines"
                              required>{{ $allSettings['meta_description'] ?? '' }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Brief description that appears in search engine results</p>
                        @error('meta_description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                <div>
                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">
                        Meta Keywords
                    </label>
                    <input type="text" 
                           id="meta_keywords" 
                           name="meta_keywords" 
                           value="{{ $allSettings['meta_keywords'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="immigration, visa, Australia, consultant">
                    <p class="text-sm text-gray-500 mt-1">Keywords relevant to your business for SEO purposes</p>
                </div>

                <div>
                    <label for="og_title" class="block text-sm font-medium text-gray-700 mb-2">
                        Social Media Title
                    </label>
                    <input type="text" 
                           id="og_title" 
                           name="og_title" 
                           value="{{ $allSettings['og_title'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Title for Facebook, Twitter sharing">
                    <p class="text-sm text-gray-500 mt-1">Title for social media sharing</p>
                </div>

                <div>
                    <label for="og_description" class="block text-sm font-medium text-gray-700 mb-2">
                        Social Media Description
                    </label>
                    <textarea id="og_description" 
                              name="og_description" 
                              rows="2"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                              placeholder="Description for social media sharing">{{ $allSettings['og_description'] ?? '' }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Description for social media sharing</p>
                </div>

                <div>
                    <label for="og_image" class="block text-sm font-medium text-gray-700 mb-2">
                        Social Media Image URL
                    </label>
                    <input type="url" 
                           id="og_image" 
                           name="og_image" 
                           value="{{ $allSettings['og_image'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="https://example.com/image.jpg">
                    <p class="text-sm text-gray-500 mt-1">Image URL for social media sharing</p>
                </div>
            </div>
        </div>

        <!-- Website Information -->
        <div class="nav-card">
            <div class="flex items-center mb-6">
                <div class="nav-icon" style="background: #3b82f6; width: 50px; height: 50px;">
                    <i class="fas fa-globe" style="font-size: 1.25rem;"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-900">Website Information</h3>
                    <p class="text-gray-600">Basic website and business information</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Site Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="site_name" 
                           name="site_name" 
                           value="{{ $allSettings['site_name'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Your Business Name"
                           required>
                    <p class="text-sm text-gray-500 mt-1">Official name of your business</p>
                </div>

                <div>
                    <label for="site_tagline" class="block text-sm font-medium text-gray-700 mb-2">
                        Site Tagline
                    </label>
                    <input type="text" 
                           id="site_tagline" 
                           name="site_tagline" 
                           value="{{ $allSettings['site_tagline'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Your Future, Our Priority">
                    <p class="text-sm text-gray-500 mt-1">Short tagline or motto for your business</p>
                </div>

                <div class="lg:col-span-2">
                    <label for="business_description" class="block text-sm font-medium text-gray-700 mb-2">
                        Business Description
                    </label>
                    <textarea id="business_description" 
                              name="business_description" 
                              rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                              placeholder="Brief description of your business services">{{ $allSettings['business_description'] ?? '' }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Brief description of your business services</p>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="nav-card">
            <div class="flex items-center mb-6">
                <div class="nav-icon" style="background: #ef4444; width: 50px; height: 50px;">
                    <i class="fas fa-phone" style="font-size: 1.25rem;"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-900">Contact Information</h3>
                    <p class="text-gray-600">Business contact details and office information</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">
                        Primary Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           id="contact_email" 
                           name="contact_email" 
                           value="{{ $allSettings['contact_email'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="info@bansalimmigration.com"
                           required>
                    <p class="text-sm text-gray-500 mt-1">Primary contact email address</p>
                </div>

                <div>
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">
                        Phone Number
                    </label>
                    <input type="text" 
                           id="contact_phone" 
                           name="contact_phone" 
                           value="{{ $allSettings['contact_phone'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="+61 123 456 789">
                    <p class="text-sm text-gray-500 mt-1">Primary contact phone number</p>
                </div>

                <div class="lg:col-span-2">
                    <label for="contact_address" class="block text-sm font-medium text-gray-700 mb-2">
                        Office Address
                    </label>
                    <textarea id="contact_address" 
                              name="contact_address" 
                              rows="2"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                              placeholder="123 Main Street, Sydney NSW 2000, Australia">{{ $allSettings['contact_address'] ?? '' }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Physical office address</p>
                </div>

                <div>
                    <label for="office_hours" class="block text-sm font-medium text-gray-700 mb-2">
                        Office Hours
                    </label>
                    <input type="text" 
                           id="office_hours" 
                           name="office_hours" 
                           value="{{ $allSettings['office_hours'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Monday - Friday: 9:00 AM - 6:00 PM">
                    <p class="text-sm text-gray-500 mt-1">Business operating hours</p>
                </div>

                <div>
                    <label for="abn_number" class="block text-sm font-medium text-gray-700 mb-2">
                        ABN Number
                    </label>
                    <input type="text" 
                           id="abn_number" 
                           name="abn_number" 
                           value="{{ $allSettings['abn_number'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="12 345 678 901">
                    <p class="text-sm text-gray-500 mt-1">Australian Business Number</p>
                </div>
            </div>
        </div>

        <!-- Social Media -->
        <div class="nav-card">
            <div class="flex items-center mb-6">
                <div class="nav-icon" style="background: #8b5cf6; width: 50px; height: 50px;">
                    <i class="fas fa-share-alt" style="font-size: 1.25rem;"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-900">Social Media Links</h3>
                    <p class="text-gray-600">Connect your social media profiles</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="facebook_url" class="block text-sm font-medium text-gray-700 mb-2">
                        Facebook URL
                    </label>
                    <input type="url" 
                           id="facebook_url" 
                           name="facebook_url" 
                           value="{{ $allSettings['facebook_url'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="https://facebook.com/yourpage">
                    <p class="text-sm text-gray-500 mt-1">Facebook page URL</p>
                </div>

                <div>
                    <label for="twitter_url" class="block text-sm font-medium text-gray-700 mb-2">
                        Twitter URL
                    </label>
                    <input type="url" 
                           id="twitter_url" 
                           name="twitter_url" 
                           value="{{ $allSettings['twitter_url'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="https://twitter.com/yourprofile">
                    <p class="text-sm text-gray-500 mt-1">Twitter profile URL</p>
                </div>

                <div>
                    <label for="instagram_url" class="block text-sm font-medium text-gray-700 mb-2">
                        Instagram URL
                    </label>
                    <input type="url" 
                           id="instagram_url" 
                           name="instagram_url" 
                           value="{{ $allSettings['instagram_url'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="https://instagram.com/yourprofile">
                    <p class="text-sm text-gray-500 mt-1">Instagram profile URL</p>
                </div>

                <div>
                    <label for="linkedin_url" class="block text-sm font-medium text-gray-700 mb-2">
                        LinkedIn URL
                    </label>
                    <input type="url" 
                           id="linkedin_url" 
                           name="linkedin_url" 
                           value="{{ $allSettings['linkedin_url'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="https://linkedin.com/company/yourcompany">
                    <p class="text-sm text-gray-500 mt-1">LinkedIn company page URL</p>
                </div>

                <div>
                    <label for="youtube_url" class="block text-sm font-medium text-gray-700 mb-2">
                        YouTube URL
                    </label>
                    <input type="url" 
                           id="youtube_url" 
                           name="youtube_url" 
                           value="{{ $allSettings['youtube_url'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="https://youtube.com/c/yourchannel">
                    <p class="text-sm text-gray-500 mt-1">YouTube channel URL</p>
                </div>
                </div>
            </div>

            <!-- Homepage Settings -->
        <div class="nav-card">
            <div class="flex items-center mb-6">
                <div class="nav-icon" style="background: #f59e0b; width: 50px; height: 50px;">
                    <i class="fas fa-home" style="font-size: 1.25rem;"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-900">Homepage Settings</h3>
                    <p class="text-gray-600">Configure homepage content and layout</p>
                </div>
            </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="hero_title" class="block text-sm font-medium text-gray-700 mb-2">
                        Hero Title
                    </label>
                    <input type="text" 
                           id="hero_title" 
                           name="hero_title" 
                           value="{{ $allSettings['hero_title'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Your Future, Our Priority">
                    <p class="text-sm text-gray-500 mt-1">Main headline on homepage</p>
                </div>

                <div>
                    <label for="hero_subtitle" class="block text-sm font-medium text-gray-700 mb-2">
                        Hero Subtitle
                    </label>
                    <input type="text" 
                           id="hero_subtitle" 
                           name="hero_subtitle" 
                           value="{{ $allSettings['hero_subtitle'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Professional Immigration Services for Australia">
                    <p class="text-sm text-gray-500 mt-1">Subtitle on homepage</p>
                </div>

                    <div>
                        <label for="sliderstatus" class="block text-sm font-medium text-gray-700 mb-2">
                        Homepage Slider <span class="text-red-500">*</span>
                        </label>
                        <select id="sliderstatus" 
                                name="sliderstatus"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="1" {{ ($allSettings['sliderstatus'] ?? '1') == '1' ? 'selected' : '' }}>Enable Slider</option>
                        <option value="0" {{ ($allSettings['sliderstatus'] ?? '1') == '0' ? 'selected' : '' }}>Disable Slider</option>
                        </select>
                    <p class="text-sm text-gray-500 mt-1">Enable or disable homepage slider</p>
                    </div>

                    <div>
                        <label for="meet_link" class="block text-sm font-medium text-gray-700 mb-2">
                        Main CTA Link <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="meet_link" 
                               name="meet_link" 
                           value="{{ $allSettings['meet_link'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                               placeholder="/contact"
                               required>
                    <p class="text-sm text-gray-500 mt-1">URL for the main call-to-action button</p>
                </div>
            </div>
        </div>

        <!-- Email Settings -->
        <div class="nav-card">
            <div class="flex items-center mb-6">
                <div class="nav-icon" style="background: #06b6d4; width: 50px; height: 50px;">
                    <i class="fas fa-envelope" style="font-size: 1.25rem;"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-900">Email Settings</h3>
                    <p class="text-gray-600">Configure email addresses for different purposes</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="contact_form_email" class="block text-sm font-medium text-gray-700 mb-2">
                        Contact Form Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           id="contact_form_email" 
                           name="contact_form_email" 
                           value="{{ $allSettings['contact_form_email'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="info@bansalimmigration.com"
                           required>
                    <p class="text-sm text-gray-500 mt-1">Email address for contact form submissions</p>
                </div>

                <div>
                    <label for="appointment_email" class="block text-sm font-medium text-gray-700 mb-2">
                        Appointment Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           id="appointment_email" 
                           name="appointment_email" 
                           value="{{ $allSettings['appointment_email'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="appointments@bansalimmigration.com"
                           required>
                    <p class="text-sm text-gray-500 mt-1">Email address for appointment bookings</p>
                </div>

                <div>
                    <label for="support_email" class="block text-sm font-medium text-gray-700 mb-2">
                        Support Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           id="support_email" 
                           name="support_email" 
                           value="{{ $allSettings['support_email'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="support@bansalimmigration.com"
                           required>
                    <p class="text-sm text-gray-500 mt-1">Email address for customer support</p>
                </div>
            </div>
        </div>

        <!-- Security & Features -->
        <div class="nav-card">
            <div class="flex items-center mb-6">
                <div class="nav-icon" style="background: #dc2626; width: 50px; height: 50px;">
                    <i class="fas fa-shield-alt" style="font-size: 1.25rem;"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-900">Security & Features</h3>
                    <p class="text-gray-600">Configure security settings and advanced features</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="recaptcha_enabled" class="block text-sm font-medium text-gray-700 mb-2">
                        reCAPTCHA Protection <span class="text-red-500">*</span>
                    </label>
                    <select id="recaptcha_enabled" 
                            name="recaptcha_enabled"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="1" {{ ($allSettings['recaptcha_enabled'] ?? '1') == '1' ? 'selected' : '' }}>Enabled</option>
                        <option value="0" {{ ($allSettings['recaptcha_enabled'] ?? '1') == '0' ? 'selected' : '' }}>Disabled</option>
                    </select>
                    <p class="text-sm text-gray-500 mt-1">Enable Google reCAPTCHA for forms</p>
                </div>

                <div>
                    <label for="maintenance_mode" class="block text-sm font-medium text-gray-700 mb-2">
                        Maintenance Mode <span class="text-red-500">*</span>
                    </label>
                    <select id="maintenance_mode" 
                            name="maintenance_mode"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="0" {{ ($allSettings['maintenance_mode'] ?? '0') == '0' ? 'selected' : '' }}>Disabled</option>
                        <option value="1" {{ ($allSettings['maintenance_mode'] ?? '0') == '1' ? 'selected' : '' }}>Enabled</option>
                    </select>
                    <p class="text-sm text-gray-500 mt-1">Enable maintenance mode to temporarily disable site</p>
                </div>

                <div class="lg:col-span-2">
                    <label for="analytics_code" class="block text-sm font-medium text-gray-700 mb-2">
                        Google Analytics Code
                    </label>
                    <textarea id="analytics_code" 
                              name="analytics_code" 
                              rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors font-mono text-sm"
                              placeholder="GA_MEASUREMENT_ID or tracking code">{{ $allSettings['analytics_code'] ?? '' }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Google Analytics tracking code</p>
                </div>

                <div class="lg:col-span-2">
                    <label for="google_tag_manager" class="block text-sm font-medium text-gray-700 mb-2">
                        Google Tag Manager Code
                    </label>
                    <textarea id="google_tag_manager" 
                              name="google_tag_manager" 
                              rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors font-mono text-sm"
                              placeholder="GTM-XXXXXXX">{{ $allSettings['google_tag_manager'] ?? '' }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Google Tag Manager code</p>
                </div>
            </div>
        </div>

        <!-- Business Information -->
        <div class="nav-card">
            <div class="flex items-center mb-6">
                <div class="nav-icon" style="background: #059669; width: 50px; height: 50px;">
                    <i class="fas fa-building" style="font-size: 1.25rem;"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-900">Business Information</h3>
                    <p class="text-gray-600">Official business registration and certification details</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="business_registration" class="block text-sm font-medium text-gray-700 mb-2">
                        Business Registration Number
                    </label>
                    <input type="text" 
                           id="business_registration" 
                           name="business_registration" 
                           value="{{ $allSettings['business_registration'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Registration number">
                    <p class="text-sm text-gray-500 mt-1">Business registration number</p>
                </div>

                <div>
                    <label for="mara_number" class="block text-sm font-medium text-gray-700 mb-2">
                        MARA Registration Number
                    </label>
                    <input type="text" 
                           id="mara_number" 
                           name="mara_number" 
                           value="{{ $allSettings['mara_number'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="MARA number">
                    <p class="text-sm text-gray-500 mt-1">MARA registration number</p>
                </div>
            </div>
        </div>

        <!-- Footer Settings -->
        <div class="nav-card">
            <div class="flex items-center mb-6">
                <div class="nav-icon" style="background: #6b7280; width: 50px; height: 50px;">
                    <i class="fas fa-file-alt" style="font-size: 1.25rem;"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-900">Footer Settings</h3>
                    <p class="text-gray-600">Configure footer content and copyright information</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="footer_copyright" class="block text-sm font-medium text-gray-700 mb-2">
                        Footer Copyright
                    </label>
                    <input type="text" 
                           id="footer_copyright" 
                           name="footer_copyright" 
                           value="{{ $allSettings['footer_copyright'] ?? '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="© 2024 Your Company. All rights reserved.">
                    <p class="text-sm text-gray-500 mt-1">Copyright text for website footer</p>
                </div>

                <div>
                    <label for="footer_description" class="block text-sm font-medium text-gray-700 mb-2">
                        Footer Description
                    </label>
                    <textarea id="footer_description" 
                              name="footer_description" 
                              rows="2"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                              placeholder="Brief description for footer">{{ $allSettings['footer_description'] ?? '' }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Description text for website footer</p>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
        <div class="flex justify-center pt-8">
                <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg font-semibold text-lg transition-colors flex items-center shadow-lg">
                <i class="fas fa-save mr-3"></i>
                Save All Settings
                </button>
            </div>
        </form>

    <!-- Additional Information -->
    <div class="mt-12 bg-blue-50 rounded-lg p-6">
        <h4 class="text-lg font-semibold text-blue-900 mb-4 flex items-center">
            <i class="fas fa-info-circle mr-2"></i>
            Additional Configuration Notes
        </h4>
        <div class="text-sm text-blue-800 space-y-3">
            <div class="flex items-start">
                <i class="fas fa-envelope mr-2 mt-1"></i>
                <div>
                    <strong>Email Configuration:</strong> Configure SMTP settings in your .env file for contact form emails to work properly.
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-shield-alt mr-2 mt-1"></i>
                <div>
                    <strong>reCAPTCHA Setup:</strong> Add RECAPTCHA_SECRET and RECAPTCHA_SITE_KEY to your .env file to enable spam protection.
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-chart-bar mr-2 mt-1"></i>
                <div>
                    <strong>Analytics:</strong> Google Analytics and Tag Manager codes will be automatically included in your website's head section.
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-tools mr-2 mt-1"></i>
                <div>
                    <strong>Maintenance Mode:</strong> When enabled, visitors will see a maintenance page instead of your website.
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .nav-card {
        transition: all 0.3s ease;
    }
    
    .nav-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    input:focus, textarea:focus, select:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .nav-icon {
        transition: all 0.3s ease;
    }
    
    .nav-icon:hover {
        transform: scale(1.1);
    }
</style>
@endpush
@endsection