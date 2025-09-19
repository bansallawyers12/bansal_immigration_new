@extends('layouts.frontend')

@section('seoinfo')
    <title>{{ $page->meta_title ?? $page->title }} - Family Visa Services | Bansal Immigration</title>
    <meta name="description" content="{{ $page->meta_description ?? $page->excerpt }}">
    <meta name="keywords" content="{{ $page->meta_keywords ?? 'family visa australia, partner visa, parent visa, child visa' }}">
    <meta property="og:title" content="{{ $page->meta_title ?? $page->title }}">
    <meta property="og:description" content="{{ $page->meta_description ?? $page->excerpt }}">
    @if($page->image)
    <meta property="og:image" content="{{ asset('storage/' . $page->image) }}">
    @endif
@endsection

@section('content')
<div class="bg-gradient-to-r from-pink-600 to-red-600 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">{{ $page->title }}</h1>
        @if($page->excerpt)
        <p class="text-xl opacity-90">{{ $page->excerpt }}</p>
        @endif
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="/" class="hover:text-blue-600">Home</a></li>
            <li>/</li>
            <li><a href="/family-visa" class="hover:text-blue-600">Family Visa</a></li>
            @if($page->slug !== 'family-visa')
            <li>/</li>
            <li class="text-gray-900">{{ $page->title }}</li>
            @endif
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Family Visas</h3>
                
                <!-- Partner Visas -->
                <div class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-2">Partner Visas</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('family-visa.partner-provisional-309') }}" class="text-blue-600 hover:text-blue-800">Partner Provisional (309)</a></li>
                        <li><a href="{{ route('family-visa.partner-permanent-100') }}" class="text-blue-600 hover:text-blue-800">Partner Permanent (100)</a></li>
                        <li><a href="{{ route('family-visa.partner-provisional-820') }}" class="text-blue-600 hover:text-blue-800">Partner Provisional (820)</a></li>
                        <li><a href="{{ route('family-visa.partner-permanent-801') }}" class="text-blue-600 hover:text-blue-800">Partner Permanent (801)</a></li>
                        <li><a href="{{ route('family-visa.prospective-marriage') }}" class="text-blue-600 hover:text-blue-800">Prospective Marriage (300)</a></li>
                    </ul>
                </div>

                <!-- Parent Visas -->
                <div class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-2">Parent Visas</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('family-visa.contributory-aged-parent-884') }}" class="text-blue-600 hover:text-blue-800">Contributory Aged (884)</a></li>
                        <li><a href="{{ route('family-visa.contributory-aged-parent-864') }}" class="text-blue-600 hover:text-blue-800">Contributory Aged (864)</a></li>
                        <li><a href="{{ route('family-visa.contributory-parent-173') }}" class="text-blue-600 hover:text-blue-800">Contributory Parent (173)</a></li>
                        <li><a href="{{ route('family-visa.contributory-parent-143') }}" class="text-blue-600 hover:text-blue-800">Contributory Parent (143)</a></li>
                        <li><a href="{{ route('family-visa.parent-visa-103') }}" class="text-blue-600 hover:text-blue-800">Parent Visa (103)</a></li>
                        <li><a href="{{ route('family-visa.sponsored-parent-870') }}" class="text-blue-600 hover:text-blue-800">Sponsored Parent (870)</a></li>
                    </ul>
                </div>

                <!-- Child & Other Visas -->
                <div>
                    <h4 class="font-medium text-gray-800 mb-2">Child & Other Visas</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('family-visa.child-visa-101') }}" class="text-blue-600 hover:text-blue-800">Child Visa (101)</a></li>
                        <li><a href="{{ route('family-visa.child-visa-802') }}" class="text-blue-600 hover:text-blue-800">Child Visa (802)</a></li>
                        <li><a href="{{ route('family-visa.remaining-relative-115') }}" class="text-blue-600 hover:text-blue-800">Remaining Relative (115)</a></li>
                        <li><a href="{{ route('family-visa.carer-offshore-116') }}" class="text-blue-600 hover:text-blue-800">Carer Visa (116)</a></li>
                        <li><a href="{{ route('family-visa.contributory-costs') }}" class="text-blue-600 hover:text-blue-800">Contributory Costs</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            @if($page->image)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->image_alt ?? $page->title }}" class="w-full h-64 object-cover rounded-lg">
            </div>
            @endif

            <div class="prose max-w-none">
                {!! $page->content !!}
            </div>

            <!-- Family Visa Categories -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <div class="bg-pink-50 border border-pink-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-pink-900 mb-3">💑 Partner Visas</h3>
                    <p class="text-pink-800 mb-3">For married couples, de facto partners, and prospective marriage partners.</p>
                    <ul class="text-sm text-pink-700 space-y-1">
                        <li>• Offshore: Subclass 309/100</li>
                        <li>• Onshore: Subclass 820/801</li>
                        <li>• Prospective Marriage: Subclass 300</li>
                    </ul>
                </div>
                
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">👨‍👩‍👧‍👦 Parent Visas</h3>
                    <p class="text-blue-800 mb-3">For parents of Australian citizens and permanent residents.</p>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• Contributory Parent Visas</li>
                        <li>• Non-contributory Parent Visas</li>
                        <li>• Sponsored Parent (Temporary)</li>
                    </ul>
                </div>
                
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-green-900 mb-3">👶 Child Visas</h3>
                    <p class="text-green-800 mb-3">For dependent children of Australian citizens and permanent residents.</p>
                    <ul class="text-sm text-green-700 space-y-1">
                        <li>• Child Visa (101/802)</li>
                        <li>• Adoption Visa</li>
                        <li>• Dependent Child Visa</li>
                    </ul>
                </div>
                
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-purple-900 mb-3">👥 Other Relative Visas</h3>
                    <p class="text-purple-800 mb-3">For other eligible family members in specific circumstances.</p>
                    <ul class="text-sm text-purple-700 space-y-1">
                        <li>• Remaining Relative Visa</li>
                        <li>• Carer Visa</li>
                        <li>• Aged Dependent Relative</li>
                    </ul>
                </div>
            </div>

            <!-- Processing Times Notice -->
            <div class="mt-8 bg-amber-50 border border-amber-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-amber-900 mb-2">⏰ Important Processing Information</h3>
                <p class="text-amber-800 mb-3">Family visa processing times vary significantly depending on the visa type and individual circumstances:</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <strong>Partner Visas:</strong> 12-29 months
                    </div>
                    <div>
                        <strong>Parent Visas:</strong> 12 months - 30+ years
                    </div>
                    <div>
                        <strong>Child Visas:</strong> 14-17 months
                    </div>
                    <div>
                        <strong>Other Relative Visas:</strong> Varies widely
                    </div>
                </div>
            </div>

            <!-- Contact CTA -->
            <div class="mt-8 bg-gradient-to-r from-pink-500 to-red-500 rounded-lg p-6 text-white">
                <h3 class="text-xl font-semibold mb-2">Reunite with Your Loved Ones</h3>
                <p class="mb-4">Our family visa specialists understand the importance of keeping families together. Let us help you navigate the complex family visa process.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('appointment') }}" class="bg-white text-pink-600 px-6 py-2 rounded font-medium hover:bg-gray-100 inline-block text-center">Book Family Consultation</a>
                    <a href="{{ route('contact') }}" class="border border-white text-white px-6 py-2 rounded hover:bg-white hover:text-pink-600 inline-block text-center">Get Visa Information</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
