@extends('layouts.main')

@section('title', ($page->meta_title ?? $page->title) . ' - Skill Assessment | Bansal Immigration')
@section('description', $page->meta_description ?? $page->excerpt)

@push('styles')
<meta name="keywords" content="{{ $page->meta_keywords ?? 'skill assessment, acs, vetassess, engineers australia, anmac, tra' }}">
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
            <li><a href="/skill-assessment" class="hover:text-blue-600">Skill Assessment</a></li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Skill Assessment</h3>

                <!-- Professional Assessments -->
                <div class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-2">Professional Assessments</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('skill-assessment.acs-assessment') }}" class="text-blue-600 hover:text-blue-800">ACS (ICT)</a></li>
                        <li><a href="{{ route('skill-assessment.vetassess-assessment') }}" class="text-blue-600 hover:text-blue-800">VETASSESS (General)</a></li>
                        <li><a href="{{ route('skill-assessment.ea-assessment') }}" class="text-blue-600 hover:text-blue-800">Engineers Australia</a></li>
                        <li><a href="{{ route('skill-assessment.accountant-assessment') }}" class="text-blue-600 hover:text-blue-800">Accountant Assessment</a></li>
                        <li><a href="{{ route('skill-assessment.nursing-assessment') }}" class="text-blue-600 hover:text-blue-800">Nursing Assessment</a></li>
                    </ul>
                </div>

                <!-- Trade Assessments -->
                <div class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-2">Trade Assessments</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('skill-assessment.trades-recognition-australia') }}" class="text-blue-600 hover:text-blue-800">Trades Recognition Australia</a></li>
                        <li><a href="{{ route('skill-assessment.skills-assessment-for-trades') }}" class="text-blue-600 hover:text-blue-800">Skills Assessment for Trades</a></li>
                        <li><a href="{{ route('skill-assessment.job-ready-program') }}" class="text-blue-600 hover:text-blue-800">Job Ready Program</a></li>
                    </ul>
                </div>

                <!-- Tools & Resources -->
                <div>
                    <h4 class="font-medium text-gray-800 mb-2">Assessment Tools</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('skill-assessment.guide') }}" class="text-blue-600 hover:text-blue-800">Skills Assessment Guide</a></li>
                        <li><a href="{{ route('skill-assessment.requirements') }}" class="text-blue-600 hover:text-blue-800">Assessment Requirements</a></li>
                        <li><a href="{{ route('skill-assessment.timeline') }}" class="text-blue-600 hover:text-blue-800">Assessment Timeline</a></li>
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

            <!-- Key Features -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">✅ Right Authority</h3>
                    <p class="text-blue-800">We help you choose the correct assessing authority for your occupation and pathway.</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-green-900 mb-3">🗂 Document Readiness</h3>
                    <p class="text-green-800">Clear document checklists and review to minimise delays and rework.</p>
                </div>
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-purple-900 mb-3">🎯 PR Strategy</h3>
                    <p class="text-purple-800">Align your assessment outcome with the right PR or work visa strategy.</p>
                </div>
                <div class="bg-orange-50 border border-orange-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-orange-900 mb-3">📈 Faster Turnaround</h3>
                    <p class="text-orange-800">Well-prepared applications typically lead to quicker outcomes.</p>
                </div>
            </div>

            <!-- Contact Form Section -->
            <div class="mt-8 bg-white rounded-lg shadow-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Need Help With Your Skill Assessment?</h3>
                <p class="text-gray-600 mb-6">Our consultants will guide you through the right authority, documentation and submission. Send us your details and we'll get back to you with personalised guidance.</p>
                @include('components.unified-contact-form', [
                    'form_source' => 'skill-assessment-page',
                    'form_variant' => 'full',
                    'show_phone' => true,
                    'show_subject' => true
                ])
            </div>

            <!-- Additional CTA -->
            <div class="mt-8 bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-lg p-6 text-white">
                <h3 class="text-xl font-semibold mb-2">Prefer to Talk Directly?</h3>
                <p class="mb-4">Book a free consultation or call us for immediate assistance.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('appointment') }}" class="bg-white text-yellow-600 px-6 py-2 rounded font-medium hover:bg-gray-100 inline-block text-center">Book Free Consultation</a>
                    <a href="{{ route('contact') }}" class="border border-white text-white px-6 py-2 rounded hover:bg-white hover:text-yellow-600 inline-block text-center">View Contact Info</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


