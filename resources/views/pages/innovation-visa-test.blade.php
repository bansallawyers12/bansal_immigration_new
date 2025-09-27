@extends('layouts.main')

@section('title', (($page->meta_title ?? $page->title ?? 'National Innovation Visa') . ' - Bansal Immigration'))
@section('description', $page->meta_description ?? 'A unique, content-first layout concept for National Innovation Visa pages.')

@push('styles')
    <style>
        .hero-split {
            background: linear-gradient(90deg, var(--sg-navy) 0%, var(--sg-navy) 55%, #0f172a 55%, #0f172a 100%);
        }
        .check-badge {
            background: rgba(99, 102, 241, 0.1);
            color: #4f46e5;
        }
        .shadow-soft {
            box-shadow: 0 8px 30px rgba(0,0,0,.08);
        }
        .innovation-highlight {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
@endpush

@section('content')
<!-- Hero Split -->
<section class="hero-split text-white">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <p class="uppercase text-sg-sky-blue text-xs tracking-widest">Innovation Visa • Design Test</p>
                <h1 class="text-3xl md:text-4xl font-extrabold leading-tight">{{ $page->title ?? 'National Innovation Visa' }}</h1>
                <p class="mt-3 text-white/90">{{ $page->excerpt ?? 'For exceptional talent in innovation and entrepreneurship.' }}</p>
                <div class="mt-5 flex flex-wrap gap-3">
                    <a href="{{ route('appointment') }}" class="btn-primary px-5 py-3 rounded font-semibold">Free Assessment</a>
                    <a href="{{ route('contact') }}" class="btn-secondary px-5 py-3 rounded font-semibold">Talk to Agent</a>
                </div>
            </div>
            <div class="bg-white/5 rounded-xl p-5">
                @if(!empty($page) && !empty($page->image))
                    <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->image_alt ?? ($page->title ?? 'Hero image') }}" class="w-full h-56 md:h-64 object-cover rounded-lg">
                @else
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div class="bg-white/10 rounded p-3">
                            <div class="text-xs opacity-80">Duration</div>
                            <div class="text-lg font-semibold">Permanent</div>
                        </div>
                        <div class="bg-white/10 rounded p-3">
                            <div class="text-xs opacity-80">Innovation Focus</div>
                            <div class="text-lg font-semibold">High Impact</div>
                        </div>
                        <div class="bg-white/10 rounded p-3">
                            <div class="text-xs opacity-80">Investment</div>
                            <div class="text-lg font-semibold">Varies</div>
                        </div>
                        <div class="bg-white/10 rounded p-3">
                            <div class="text-xs opacity-80">Processing</div>
                            <div class="text-lg font-semibold">Priority</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumbs -->
<div class="container mx-auto px-4 mt-4">
    <nav class="text-sm text-gray-200/90">
        <ol class="flex items-center gap-2">
            <li><a href="/" class="hover:text-white">Home</a></li>
            <li>/</li>
            <li><a href="/migrate-to-australia" class="hover:text-white">Migration</a></li>
            <li>/</li>
            <li class="text-white">{{ $page->title ?? 'National Innovation Visa' }}</li>
        </ol>
    </nav>
    <div class="h-4"></div>
</div>

<!-- Content + Sticky Summary -->
<section class="container mx-auto px-4 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main -->
        <article class="lg:col-span-2 space-y-10">
            <!-- Section index -->
            <div class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">What's on this page</h2>
                <div class="grid sm:grid-cols-2 gap-3 text-sm">
                    <a href="#overview" class="text-sg-light-blue hover:text-sg-navy">Welcome to Your Future Down Under</a>
                    <a href="#eligibility" class="text-sg-light-blue hover:text-sg-navy">Do You Have What It Takes?</a>
                    <a href="#innovation-criteria" class="text-sg-light-blue hover:text-sg-navy">The Innovation Gold Standard</a>
                    <a href="#benefits" class="text-sg-light-blue hover:text-sg-navy">Why Choose This Path?</a>
                    <a href="#how-apply" class="text-sg-light-blue hover:text-sg-navy">Your Roadmap to Success</a>
                    <a href="#faq" class="text-sg-light-blue hover:text-sg-navy">Got Questions? We've Got Answers</a>
                </div>
            </div>

            <div id="overview" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Welcome to Your Future Down Under</h2>
                @if(!empty($page) && !empty($page->content))
                    <div class="prose max-w-none">
                        {!! $page->content !!}
                    </div>
                @else
                    <p class="text-gray-700 leading-7">The National Innovation Visa is designed for exceptional individuals who can contribute to Australia's innovation ecosystem. This visa recognizes and attracts world-class talent in technology, research, and entrepreneurship.</p>
                @endif
            </div>

            <div id="eligibility" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Do You Have What It Takes?</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-start gap-2"><span class="check-badge px-2 py-0.5 rounded">✔</span><span>Exceptional innovation track record</span></li>
                        <li class="flex items-start gap-2"><span class="check-badge px-2 py-0.5 rounded">✔</span><span>Significant contribution to field</span></li>
                        <li class="flex items-start gap-2"><span class="check-badge px-2 py-0.5 rounded">✔</span><span>English proficiency</span></li>
                    </ul>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-start gap-2"><span class="check-badge px-2 py-0.5 rounded">✔</span><span>Health and character requirements</span></li>
                        <li class="flex items-start gap-2"><span class="check-badge px-2 py-0.5 rounded">✔</span><span>Innovation proposal or business plan</span></li>
                        <li class="flex items-start gap-2"><span class="check-badge px-2 py-0.5 rounded">✔</span><span>Supporting documentation</span></li>
                    </ul>
                </div>
            </div>

            <div id="innovation-criteria" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">The Innovation Gold Standard</h2>
                <p class="text-gray-700">Demonstrate exceptional ability in technology, research, or entrepreneurship with proven track record of innovation and impact.</p>
            </div>

            <div id="benefits" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Why Choose This Path?</h2>
                <p class="text-gray-700">Permanent residency, work and study rights, access to Australia's innovation ecosystem, and pathway to citizenship.</p>
            </div>

            <div id="how-apply" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Your Roadmap to Success</h2>
                <ol class="list-decimal pl-5 space-y-2 text-gray-700">
                    <li>Prepare innovation portfolio and documentation</li>
                    <li>Submit Expression of Interest (EOI)</li>
                    <li>Receive invitation to apply</li>
                    <li>Submit full application with supporting documents</li>
                    <li>Attend interview if required</li>
                    <li>Await decision</li>
                </ol>
            </div>

            <div id="faq" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Got Questions? We've Got Answers</h2>
                <details class="border rounded-lg p-4 mb-3">
                    <summary class="font-semibold cursor-pointer">What makes an innovation exceptional?</summary>
                    <p class="mt-2 text-gray-700">Exceptional innovation typically involves breakthrough technology, significant research contributions, or transformative business solutions with measurable impact.</p>
                </details>
                <details class="border rounded-lg p-4 mb-3">
                    <summary class="font-semibold cursor-pointer">Can I include family members?</summary>
                    <p class="mt-2 text-gray-700">Yes, eligible family members can be included in your application and will receive the same visa benefits.</p>
                </details>
                <details class="border rounded-lg p-4">
                    <summary class="font-semibold cursor-pointer">How long does processing take?</summary>
                    <p class="mt-2 text-gray-700">Processing times vary but are generally prioritized due to the high-value nature of this visa category.</p>
                </details>
            </div>
        </article>

        <!-- Sticky summary card -->
        <aside class="lg:col-span-1">
            <div class="sticky top-6">
                <div class="bg-white rounded-xl shadow-soft p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Quick Summary</h3>
                    <ul class="mt-3 space-y-2 text-sm text-gray-700">
                        <li><strong>Type:</strong> Permanent visa</li>
                        <li><strong>Focus:</strong> Innovation & entrepreneurship</li>
                        <li><strong>Duration:</strong> Permanent residency</li>
                        <li><strong>Family:</strong> Can be included</li>
                    </ul>
                    <div class="mt-5 flex flex-col gap-3">
                        <a href="{{ route('migrate-to-australia.pr-calculator') }}" class="btn-secondary text-center px-4 py-2 rounded">Check PR Points</a>
                        <a href="{{ route('appointment') }}" class="btn-primary text-center px-4 py-2 rounded">Free Consultation</a>
                    </div>
                </div>
                <div class="mt-6 bg-sg-light-gray rounded-xl p-5">
                    <h4 class="font-semibold text-gray-900 mb-2">Related</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a class="text-sg-light-blue hover:text-sg-navy" href="{{ route('migrate-to-australia.temporary-graduate') }}">Temporary Graduate (485)</a></li>
                        <li><a class="text-sg-light-blue hover:text-sg-navy" href="{{ route('migrate-to-australia.skilled-independent') }}">Skilled Independent (189)</a></li>
                        <li><a class="text-sg-light-blue hover:text-sg-navy" href="{{ route('migrate-to-australia.skilled-nominated') }}">Skilled Nominated (190)</a></li>
                    </ul>
                </div>
            </div>
        </aside>
    </div>
</section>
@endsection
