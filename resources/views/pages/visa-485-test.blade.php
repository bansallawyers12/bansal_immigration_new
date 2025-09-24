@extends('layouts.main')

@section('title', (($page->meta_title ?? $page->title ?? '485 Visa Detail Design Test') . ' - Bansal Immigration'))
@section('description', $page->meta_description ?? 'A unique, content-first layout concept for 485 visa detail pages.')

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
    </style>
@endpush

@section('content')
<!-- Hero Split -->
<section class="hero-split text-white">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <p class="uppercase text-sg-sky-blue text-xs tracking-widest">Visa 485 • Design Concept</p>
                <h1 class="text-3xl md:text-4xl font-extrabold leading-tight">{{ $page->title ?? 'Post Study Work Visa Subclass 485' }}</h1>
                <p class="mt-3 text-white/90">{{ $page->excerpt ?? 'Streamlined layout with quick facts sidebar, section index, and clear CTAs.' }}</p>
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
                            <div class="text-xs opacity-80">Stay</div>
                            <div class="text-lg font-semibold">2 – 4 years</div>
                        </div>
                        <div class="bg-white/10 rounded p-3">
                            <div class="text-xs opacity-80">Work Rights</div>
                            <div class="text-lg font-semibold">Full-time</div>
                        </div>
                        <div class="bg-white/10 rounded p-3">
                            <div class="text-xs opacity-80">Family</div>
                            <div class="text-lg font-semibold">Can be included</div>
                        </div>
                        <div class="bg-white/10 rounded p-3">
                            <div class="text-xs opacity-80">Processing</div>
                            <div class="text-lg font-semibold">Varies</div>
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
            <li><a href="/migration" class="hover:text-white">Migration</a></li>
            <li>/</li>
            <li class="text-white">{{ $page->title ?? 'Post Study Work Visa Subclass 485' }}</li>
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
                <h2 class="text-xl font-bold text-gray-900 mb-4">What’s on this page</h2>
                <div class="grid sm:grid-cols-2 gap-3 text-sm">
                    <a href="#overview" class="text-sg-light-blue hover:text-sg-navy">Overview</a>
                    <a href="#eligibility" class="text-sg-light-blue hover:text-sg-navy">Eligibility</a>
                    <a href="#stay-work" class="text-sg-light-blue hover:text-sg-navy">Stay & Work</a>
                    <a href="#cost" class="text-sg-light-blue hover:text-sg-navy">Cost</a>
                    <a href="#how-apply" class="text-sg-light-blue hover:text-sg-navy">How to apply</a>
                    <a href="#faq" class="text-sg-light-blue hover:text-sg-navy">FAQs</a>
                </div>
            </div>

            <div id="overview" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Overview</h2>
                @if(!empty($page) && !empty($page->content))
                    <div class="prose max-w-none">
                        {!! $page->content !!}
                    </div>
                @else
                    <p class="text-gray-700 leading-7">Visa 485 allows recent graduates of Australian institutions to live, study and work in Australia temporarily. This concept emphasizes scannability and quick access to important details.</p>
                @endif
            </div>

            <div id="eligibility" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Eligibility</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-start gap-2"><span class="check-badge px-2 py-0.5 rounded">✔</span><span>Under 50 years of age</span></li>
                        <li class="flex items-start gap-2"><span class="check-badge px-2 py-0.5 rounded">✔</span><span>Recent Australian qualification</span></li>
                        <li class="flex items-start gap-2"><span class="check-badge px-2 py-0.5 rounded">✔</span><span>English proficiency</span></li>
                    </ul>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-start gap-2"><span class="check-badge px-2 py-0.5 rounded">✔</span><span>Health and character requirements</span></li>
                        <li class="flex items-start gap-2"><span class="check-badge px-2 py-0.5 rounded">✔</span><span>Sign Australian values statement</span></li>
                        <li class="flex items-start gap-2"><span class="check-badge px-2 py-0.5 rounded">✔</span><span>No outstanding debts to the Government</span></li>
                    </ul>
                </div>
            </div>

            <div id="stay-work" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Stay and Work</h2>
                <p class="text-gray-700">Stay length typically ranges from 2 to 4 years depending on your qualification; full work rights apply.</p>
            </div>

            <div id="cost" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Cost</h2>
                <p class="text-gray-700">Government charges vary and may include additional fees for family members and health checks.</p>
            </div>

            <div id="how-apply" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">How to apply</h2>
                <ol class="list-decimal pl-5 space-y-2 text-gray-700">
                    <li>Confirm stream and eligibility</li>
                    <li>Gather documents and health checks</li>
                    <li>Submit online application</li>
                    <li>Await decision; provide further info if asked</li>
                </ol>
            </div>

            <div id="faq" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">FAQs</h2>
                <details class="border rounded-lg p-4 mb-3">
                    <summary class="font-semibold cursor-pointer">Can I include my family?</summary>
                    <p class="mt-2 text-gray-700">Yes, eligible family members can be added to your application.</p>
                </details>
                <details class="border rounded-lg p-4">
                    <summary class="font-semibold cursor-pointer">Can I travel on this visa?</summary>
                    <p class="mt-2 text-gray-700">You can travel in and out of Australia while the visa is valid.</p>
                </details>
            </div>
        </article>

        <!-- Sticky summary card -->
        <aside class="lg:col-span-1">
            <div class="sticky top-6">
                <div class="bg-white rounded-xl shadow-soft p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Quick Summary</h3>
                    <ul class="mt-3 space-y-2 text-sm text-gray-700">
                        <li><strong>Streams:</strong> Post-Study Work, Graduate Work</li>
                        <li><strong>Stay:</strong> 2 – 4 years</li>
                        <li><strong>Work rights:</strong> Full-time</li>
                        <li><strong>Include family:</strong> Yes</li>
                    </ul>
                    <div class="mt-5 flex flex-col gap-3">
                        <a href="{{ route('migration.pr-calculator') }}" class="btn-secondary text-center px-4 py-2 rounded">Check PR Points</a>
                        <a href="{{ route('appointment') }}" class="btn-primary text-center px-4 py-2 rounded">Free Consultation</a>
                    </div>
                </div>
                <div class="mt-6 bg-sg-light-gray rounded-xl p-5">
                    <h4 class="font-semibold text-gray-900 mb-2">Related</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a class="text-sg-light-blue hover:text-sg-navy" href="{{ route('migration.temporary-graduate') }}">Temporary Graduate (485)</a></li>
                        <li><a class="text-sg-light-blue hover:text-sg-navy" href="{{ route('migration.skilled-independent') }}">Skilled Independent (189)</a></li>
                        <li><a class="text-sg-light-blue hover:text-sg-navy" href="{{ route('migration.skilled-nominated') }}">Skilled Nominated (190)</a></li>
                    </ul>
                </div>
            </div>
        </aside>
    </div>
</section>
@endsection


