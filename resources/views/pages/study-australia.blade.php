@extends('layouts.main')

@section('title', ($page->meta_title ?? $page->title) . ' - Study in Australia | Bansal Immigration')
@section('description', $page->meta_description ?? $page->excerpt)

@push('styles')
<meta name="keywords" content="{{ $page->meta_keywords ?? 'study australia, student visa, education australia' }}">
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
            <li><a href="/study-australia" class="hover:text-blue-600">Study in Australia</a></li>
            @if($page->slug !== 'study-australia')
            <li>/</li>
            <li class="text-gray-900">{{ $page->title }}</li>
            @endif
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Study in Australia</h3>
                
                <!-- Education Services -->
                <div class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-2">Education Services</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('study-australia.admission') }}" class="text-blue-600 hover:text-blue-800">Admission in Australia</a></li>
                        <li><a href="{{ route('study-australia.new-coe') }}" class="text-blue-600 hover:text-blue-800">New COE</a></li>
                        <li><a href="{{ route('study-australia.course-change') }}" class="text-blue-600 hover:text-blue-800">Course Change</a></li>
                        <li><a href="{{ route('study-australia.rpl') }}" class="text-blue-600 hover:text-blue-800">RPL Assessment</a></li>
                        <li><a href="{{ route('study-australia.professional-year') }}" class="text-blue-600 hover:text-blue-800">Professional Year</a></li>
                        <li><a href="{{ route('study-australia.defer-studies') }}" class="text-blue-600 hover:text-blue-800">Defer Studies</a></li>
                        <li><a href="{{ route('study-australia.affiliations') }}" class="text-blue-600 hover:text-blue-800">Our Affiliations</a></li>
                    </ul>
                </div>

                <!-- Student Visas -->
                <div class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-2">Student Visas</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('study-australia.student-dependent') }}" class="text-blue-600 hover:text-blue-800">Student Dependent Visa (500)</a></li>
                        <li><a href="{{ route('study-australia.student-extension') }}" class="text-blue-600 hover:text-blue-800">Student Visa Extension</a></li>
                        <li><a href="{{ route('study-australia.student-guardian') }}" class="text-blue-600 hover:text-blue-800">Student Guardian Visa (590)</a></li>
                        <li><a href="{{ route('study-australia.student-journey') }}" class="text-blue-600 hover:text-blue-800">Student Visa Journey</a></li>
                        <li><a href="{{ route('study-australia.student-info') }}" class="text-blue-600 hover:text-blue-800">Student Visa Information</a></li>
                        <!-- Training Visa (407) moved under Employer Sponsored -->
                    </ul>
                </div>

                <!-- Tools & Resources -->
                <div>
                    <h4 class="font-medium text-gray-800 mb-2">Tools & Resources</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('study-australia.calculator') }}" class="text-blue-600 hover:text-blue-800">Financial Calculator</a></li>
                        <li><a href="{{ route('study-australia.tourist-to-student') }}" class="text-blue-600 hover:text-blue-800">Tourist to Student</a></li>
                        <li><a href="{{ route('study-australia.afp-ipc') }}" class="text-blue-600 hover:text-blue-800">AFP/IPC Form</a></li>
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

            <!-- Key Features for Study in Australia -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">🎓 World-Class Education</h3>
                    <p class="text-blue-800">Access to top-ranked universities and vocational institutions with globally recognized qualifications.</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-green-900 mb-3">💼 Work Opportunities</h3>
                    <p class="text-green-800">Part-time work rights during studies and post-study work visa opportunities.</p>
                </div>
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-purple-900 mb-3">🌏 Pathway to PR</h3>
                    <p class="text-purple-800">Study in Australia can provide pathways to permanent residency and citizenship.</p>
                </div>
                <div class="bg-orange-50 border border-orange-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-orange-900 mb-3">🏠 Quality of Life</h3>
                    <p class="text-orange-800">Experience high quality of life in one of the world's most liveable countries.</p>
                </div>
            </div>

            <!-- Contact Form Section -->
            <div class="mt-8 bg-white rounded-lg shadow-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Ready to Start Your Australian Education Journey?</h3>
                <p class="text-gray-600 mb-6">Our education consultants will guide you through every step of the process. Send us your details and we'll get back to you with personalized guidance.</p>
                @include('components.unified-contact-form', [
                    'form_source' => 'study-australia-page',
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
