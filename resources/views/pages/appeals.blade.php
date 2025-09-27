@extends('layouts.main')

@section('title', ($page->meta_title ?? $page->title) . ' - Appeals | Bansal Immigration')
@section('description', $page->meta_description ?? $page->excerpt)

@push('styles')
    <meta property="og:title" content="{{ $page->meta_title ?? $page->title }}">
    <meta property="og:description" content="{{ $page->meta_description ?? $page->excerpt }}">
    @if($page->image)
    <meta property="og:image" content="{{ asset('storage/' . $page->image) }}">
    @endif
@endpush

@section('content')
<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12">
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
            <li><a href="/appeals" class="hover:text-blue-600">Appeals</a></li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Appeals</h3>
                <ul class="space-y-1 text-sm mb-4">
                    <li><a href="{{ route('appeals.art-appeals') }}" class="text-blue-600 hover:text-blue-800">ART Appeals</a></li>
                    <li><a href="{{ route('appeals.federal-court-appeals') }}" class="text-blue-600 hover:text-blue-800">Federal Court Appeals</a></li>
                    <li><a href="{{ route('appeals.ministerial-intervention') }}" class="text-blue-600 hover:text-blue-800">Ministerial Intervention</a></li>
                </ul>
                <h4 class="font-medium text-gray-800 mb-2">Review Process</h4>
                <ul class="space-y-1 text-sm">
                    <li><a href="{{ route('appeals.notice-cancellation') }}" class="text-blue-600 hover:text-blue-800">NOICC (Notice of Intention to Consider Cancellation)</a></li>
                    <li><a href="{{ route('appeals.work-rights') }}" class="text-blue-600 hover:text-blue-800">Applying for Work Rights</a></li>
                    <li><a href="{{ route('appeals.study-rights') }}" class="text-blue-600 hover:text-blue-800">Applying for Study Rights</a></li>
                    <li><a href="{{ route('appeals.waiver-request') }}" class="text-blue-600 hover:text-blue-800">Waiver Request</a></li>
                </ul>
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

            <!-- How We Help -->
            <h2 class="text-2xl font-bold text-gray-900 mt-10 mb-4">How We Help With Appeals</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-yellow-50/60 border border-yellow-200 rounded-xl p-6 shadow-sm hover:shadow transition">
                    <div class="flex items-center mb-3">
                        <div class="w-9 h-9 flex items-center justify-center rounded-lg bg-yellow-100 text-yellow-700 mr-3">⏱</div>
                        <h3 class="text-base font-semibold text-yellow-900">Strict Timeframes</h3>
                    </div>
                    <p class="text-sm text-yellow-900/90">Appeals have short lodgement deadlines. We prioritise urgent lodgements to protect your review rights.</p>
                </div>
                <div class="bg-green-50/60 border border-green-200 rounded-xl p-6 shadow-sm hover:shadow transition">
                    <div class="flex items-center mb-3">
                        <div class="w-9 h-9 flex items-center justify-center rounded-lg bg-green-100 text-green-700 mr-3">📄</div>
                        <h3 class="text-base font-semibold text-green-900">Evidence Strategy</h3>
                    </div>
                    <p class="text-sm text-green-900/90">We craft a targeted evidence plan aligned to tribunal expectations and decision‑maker concerns.</p>
                </div>
                <div class="bg-blue-50/60 border border-blue-200 rounded-xl p-6 shadow-sm hover:shadow transition">
                    <div class="flex items-center mb-3">
                        <div class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-100 text-blue-700 mr-3">🎯</div>
                        <h3 class="text-base font-semibold text-blue-900">Case Preparation</h3>
                    </div>
                    <p class="text-sm text-blue-900/90">From submissions to hearing preparation and representation, we manage your case end‑to‑end.</p>
                </div>
                <div class="bg-purple-50/60 border border-purple-200 rounded-xl p-6 shadow-sm hover:shadow transition">
                    <div class="flex items-center mb-3">
                        <div class="w-9 h-9 flex items-center justify-center rounded-lg bg-purple-100 text-purple-700 mr-3">🧭</div>
                        <h3 class="text-base font-semibold text-purple-900">Outcome Pathways</h3>
                    </div>
                    <p class="text-sm text-purple-900/90">We advise on negotiated outcomes, remittals and alternative pathways where appropriate.</p>
                </div>
                <div class="bg-red-50/60 border border-red-200 rounded-xl p-6 shadow-sm hover:shadow transition">
                    <div class="flex items-center mb-3">
                        <div class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-100 text-red-700 mr-3">🆘</div>
                        <h3 class="text-base font-semibold text-red-900">Urgent Assistance</h3>
                    </div>
                    <p class="text-sm text-red-900/90">For cancellations, detention or s116/s501 matters, we mobilise rapid support.</p>
                </div>
            </div>

    {{-- removed duplicate content block below to avoid repetition --}}

    <!-- Related Pages -->
    @if($relatedPages->count() > 0)
    <div class="mt-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Related Appeal Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedPages as $relatedPage)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                @if($relatedPage->image)
                <img src="{{ asset('storage/' . $relatedPage->image) }}" alt="{{ $relatedPage->image_alt ?? $relatedPage->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ $relatedPage->title }}</h3>
                    @if($relatedPage->excerpt)
                    <p class="text-gray-600 mb-4">{{ $relatedPage->excerpt }}</p>
                    @endif
                    <a href="{{ route($relatedPage->route_name) }}" class="text-blue-600 hover:text-blue-800 font-medium">Learn More →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Contact Form Section -->
    <div class="mt-16 bg-white rounded-lg shadow-lg p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-4">Need Help with Your Visa Appeal?</h3>
        <p class="text-gray-600 mb-6">Time is critical in visa appeals. Contact our experienced team for urgent assistance. Send us your details for priority appeal support.</p>
        @include('components.unified-contact-form', [
            'form_source' => 'appeals-page',
            'form_variant' => 'full',
            'show_phone' => true,
            'show_subject' => true
        ])
    </div>

    <!-- Urgent Call to Action -->
    <div class="mt-8 bg-red-50 rounded-lg p-8 text-center">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Urgent Appeal Assistance?</h3>
        <p class="text-gray-600 mb-6">For urgent appeal matters, contact our experienced team for priority assistance.</p>
        <a href="{{ route('contact') }}" class="bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 transition-colors inline-block font-medium">Get Urgent Help</a>
    </div>
 </div>
@endsection
