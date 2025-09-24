@extends('layouts.main')

@section('title', 'Service Page Design Test - Bansal Immigration')
@section('description', 'Preview of the refreshed internal service page layout matching our site theme.')

@push('styles')
    <style>
        .section-title {
            letter-spacing: 0.01em;
        }
        .sticky-sidebar {
            top: 1rem;
        }
    </style>
@endpush

@section('content')
<div class="bg-sg-navy text-white">
    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
            <div>
                <p class="uppercase text-sg-sky-blue text-xs tracking-widest">Bansal Immigration</p>
                <h1 class="text-3xl md:text-4xl font-extrabold section-title">Temporary Graduate Visa Subclass 485</h1>
                <p class="mt-3 text-white/90 max-w-3xl">A modern, readable layout for internal service pages, aligned with our global theme.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('appointment') }}" class="btn-primary px-5 py-3 rounded font-semibold">Book Free Consultation</a>
                <a href="{{ route('contact') }}" class="btn-secondary px-5 py-3 rounded font-semibold">Ask a Question</a>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <nav class="mb-6 text-sm text-gray-600" aria-label="Breadcrumb">
        <ol class="flex items-center gap-2">
            <li><a href="/" class="hover:text-sg-light-blue">Home</a></li>
            <li>/</li>
            <li><a href="/migration" class="hover:text-sg-light-blue">Migration</a></li>
            <li>/</li>
            <li class="text-gray-900">Temporary Graduate Visa 485</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <aside class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky sticky-sidebar">
                <h3 class="text-base font-semibold text-gray-900 mb-4">Related Services</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('migration.post-study-work') }}" class="text-sg-light-blue hover:text-sg-navy">Post Study Work (485)</a></li>
                    <li><a href="{{ route('migration.skilled-graduate') }}" class="text-sg-light-blue hover:text-sg-navy">Skilled Graduate (476)</a></li>
                    <li><a href="{{ route('migration.skilled-independent') }}" class="text-sg-light-blue hover:text-sg-navy">Skilled Independent (189)</a></li>
                    <li><a href="{{ route('migration.skilled-nominated') }}" class="text-sg-light-blue hover:text-sg-navy">Skilled Nominated (190)</a></li>
                </ul>

                <hr class="my-6">
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Helpful Tools</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('migration.pr-calculator') }}" class="hover:text-sg-light-blue">PR Points Calculator</a></li>
                    <li><a href="{{ route('migration.regional-points') }}" class="hover:text-sg-light-blue">Regional Points Guide</a></li>
                    <li><a href="{{ route('migration.english-points') }}" class="hover:text-sg-light-blue">English Score Points</a></li>
                </ul>
            </div>
        </aside>

        <main class="lg:col-span-3">
            <div class="bg-white rounded-xl shadow-md p-6 md:p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Overview</h2>
                <p class="text-gray-700 leading-7">This layout improves readability with better spacing, clear hierarchy, and consistent brand styling. Below is sample content to demonstrate headings, lists, callouts and CTAs.</p>

                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div class="bg-sg-light-gray rounded-lg p-5">
                        <h3 class="font-semibold text-gray-900 mb-2">Eligibility Highlights</h3>
                        <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1">
                            <li>Age under 50 years</li>
                            <li>Recent Australian qualification</li>
                            <li>English proficiency evidence</li>
                            <li>Health and character checks</li>
                        </ul>
                    </div>
                    <div class="bg-sg-light-gray rounded-lg p-5">
                        <h3 class="font-semibold text-gray-900 mb-2">What You Get</h3>
                        <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1">
                            <li>Stay up to 18–24 months</li>
                            <li>Work and study rights</li>
                            <li>Add eligible family members</li>
                            <li>Travel in and out of Australia</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Graduate Work Stream</h3>
                    <p class="text-gray-700 leading-7">Designed for recent graduates in occupations in demand. We tailor guidance based on your study, skills assessment and state opportunities.</p>
                </div>

                <div class="mt-8 bg-blue-50 border border-sg-light-blue rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-sg-navy mb-2">Points and Next Steps</h3>
                    <p class="text-gray-700 mb-4">Thinking about permanent residency later? Start with a quick points check and we will map a pathway.</p>
                    <a href="{{ route('migration.pr-calculator') }}" class="btn-primary inline-block px-5 py-2 rounded">Check Your Points</a>
                </div>
            </div>

            <div class="mt-8 bg-white rounded-xl shadow-md p-6 md:p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Talk to an Agent</h3>
                <p class="text-gray-600 mb-6">Send your details and we will reach out with personalised advice.</p>
                @include('components.unified-contact-form', [
                    'form_source' => 'service-test',
                    'form_variant' => 'compact',
                    'show_phone' => true,
                    'show_subject' => false
                ])
            </div>
        </main>
    </div>
</div>
@endsection


