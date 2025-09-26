@extends('layouts.main')

@section('title', ($page->meta_title ?? $page->title) . ' - Bansal Immigration')
@section('description', $page->meta_description ?? $page->excerpt)

@push('styles')
    <meta name="keywords" content="{{ $page->meta_keywords ?? '' }}">
    <meta property="og:title" content="{{ $page->meta_title ?? $page->title }}">
    <meta property="og:description" content="{{ $page->meta_description ?? $page->excerpt }}">
    @if($page->image)
    <meta property="og:image" content="{{ asset('storage/' . $page->image) }}">
    @endif
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="/" class="hover:text-blue-600">Home</a></li>
            <li>/</li>
            <li><a href="/{{ $page->category }}" class="hover:text-blue-600 capitalize">{{ str_replace('-', ' ', $page->category) }}</a></li>
            <li>/</li>
            <li class="text-gray-900">{{ $page->title }}</li>
        </ol>
    </nav>

    <!-- Hero -->
@php
    $heroBgUrl = $page->image ? asset('storage/' . $page->image) : null;
@endphp

<div class="relative rounded-xl overflow-hidden mb-8 h-64 md:h-72 lg:h-80">
    @if($heroBgUrl)
        <div class="absolute inset-0" style="background-image:url('{{ $heroBgUrl }}');background-size:cover;background-position:center;"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-blue-600/70"></div>
        <div class="relative h-full text-white p-6 flex items-center">
    @else
        <div class="relative h-full bg-gradient-to-r from-blue-700 to-blue-500 text-white p-6 flex items-center">
    @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $page->title }}</h1>
                @if($page->excerpt)
                <p class="text-blue-50 text-lg">{{ $page->excerpt }}</p>
                @endif
                <div class="mt-4 flex gap-3">
                    <a href="#overview" class="bg-white text-blue-700 px-4 py-2 rounded-lg font-semibold">Overview</a>
                    @if(!empty($page->visa_steps))
                    <a href="#how-to-apply" class="bg-white/10 hover:bg-white/20 px-4 py-2 rounded-lg">How to apply</a>
                    @endif
                </div>
            </div>
            <div>
                @php
                    $highlights = is_array($page->visa_highlights) ? $page->visa_highlights : [];
                    $getHighlight = function(string $label) use ($highlights) {
                        foreach ($highlights as $h) {
                            if (!empty($h['label']) && strcasecmp(trim($h['label']), $label) === 0) {
                                return $h['value'] ?? null;
                            }
                        }
                        return null;
                    };
                    $duration = $getHighlight('Duration');
                    $pathway = $getHighlight('Pathway') ?? $getHighlight('Innovation Focus') ?? $getHighlight('Stream');
                    $processingTimes = is_array($page->visa_processing_times ?? null) ? $page->visa_processing_times : [];
                    $processing = $processingTimes['standard'] ?? ($processingTimes['priority'] ?? ($processingTimes['complex'] ?? null));
                    $primaryCost = null;
                    if (is_array($page->visa_costs ?? null)) {
                        foreach ($page->visa_costs as $row) {
                            if (!empty($row['label']) && stripos($row['label'], 'primary') !== false) {
                                $primaryCost = $row['amount'] ?? null;
                                break;
                            }
                        }
                        if (!$primaryCost && !empty($page->visa_costs[0]['amount'])) {
                            $primaryCost = $page->visa_costs[0]['amount'];
                        }
                    }
                @endphp
                <div class="grid grid-cols-2 gap-3">
                    <dl class="rounded-lg p-3 backdrop-blur-md bg-white/15 ring-1 ring-white/25">
                        <dt class="text-xs text-white/80">Duration</dt>
                        <dd class="text-xl font-semibold text-white truncate" title="{{ $duration ?? '—' }}">{{ $duration ?? '—' }}</dd>
                    </dl>
                    <dl class="rounded-lg p-3 backdrop-blur-md bg-white/15 ring-1 ring-white/25">
                        <dt class="text-xs text-white/80">Cost</dt>
                        <dd class="text-xl font-semibold text-white truncate" title="{{ $primaryCost ?? '—' }}">{{ $primaryCost ?? '—' }}</dd>
                    </dl>
                    <dl class="rounded-lg p-3 backdrop-blur-md bg-white/15 ring-1 ring-white/25">
                        <dt class="text-xs text-white/80">Processing Time</dt>
                        <dd class="text-xl font-semibold text-white truncate" title="{{ $processing ?? '—' }}">{{ $processing ?? '—' }}</dd>
                    </dl>
                    <dl class="rounded-lg p-3 backdrop-blur-md bg-white/15 ring-1 ring-white/25">
                        <dt class="text-xs text-white/80">Pathway</dt>
                        <dd class="text-xl font-semibold text-white truncate" title="{{ $pathway ?? '—' }}">{{ $pathway ?? '—' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- On this page -->
    @php
        $showEligibility = !empty($page->visa_eligibility);
        $showBenefits = !empty($page->visa_benefits);
        $showSteps = !empty($page->visa_steps);
        $showFaqs = !empty($page->visa_faqs);
        $showProcessing = !empty($page->visa_processing_times);
        $showCosts = !empty($page->visa_costs);
    @endphp
    <div class="bg-white rounded-lg shadow p-4 mb-8">
        <h2 class="text-lg font-semibold mb-2">What's on this page</h2>
        <ul class="flex flex-wrap gap-3 text-sm">
            <li><a href="#overview" class="text-blue-700 hover:underline">Overview</a></li>
            @if($showEligibility)<li><a href="#eligibility" class="text-blue-700 hover:underline">Eligibility</a></li>@endif
            @if($showBenefits)<li><a href="#benefits" class="text-blue-700 hover:underline">Benefits</a></li>@endif
            @if($showSteps)<li><a href="#how-to-apply" class="text-blue-700 hover:underline">How to apply</a></li>@endif
            @if($showProcessing)<li><a href="#processing-times" class="text-blue-700 hover:underline">Processing times</a></li>@endif
            @if($showCosts)<li><a href="#costs" class="text-blue-700 hover:underline">Costs</a></li>@endif
            @if($showFaqs)<li><a href="#faqs" class="text-blue-700 hover:underline">FAQs</a></li>@endif
        </ul>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-10">
            <!-- Overview -->
            <section id="overview" class="bg-white rounded-xl shadow-md p-6 md:p-8">
                <h2 class="text-2xl font-bold mb-4">Overview</h2>
                <div class="prose max-w-none">
                    {!! \Illuminate\Support\Str::of($page->content) !!}
                </div>
            </section>

            <!-- Eligibility -->
            @if($showEligibility)
            <section id="eligibility" class="bg-white rounded-xl shadow-md p-6 md:p-8">
                <h2 class="text-2xl font-bold mb-4">Eligibility</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($page->visa_eligibility as $item)
                        @continue(empty($item))
                        <div class="rounded border p-3">{{ $item }}</div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- Benefits -->
            @if($showBenefits)
            <section id="benefits" class="bg-white rounded-xl shadow-md p-6 md:p-8">
                <h2 class="text-2xl font-bold mb-4">Benefits</h2>
                <ul class="list-disc pl-6 space-y-2">
                    @foreach($page->visa_benefits as $item)
                        @continue(empty($item))
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </section>
            @endif

            <!-- How to apply -->
            @if($showSteps)
            <section id="how-to-apply" class="bg-white rounded-xl shadow-md p-6 md:p-8">
                <h2 class="text-2xl font-bold mb-4">How to apply</h2>
                <ol class="list-decimal pl-6 space-y-2">
                    @foreach($page->visa_steps as $item)
                        @continue(empty($item))
                        <li>{{ $item }}</li>
                    @endforeach
                </ol>
            </section>
            @endif

            @if($showProcessing)
            <section id="processing-times" class="bg-white rounded-xl shadow-md p-6 md:p-8">
                <h2 class="text-2xl font-bold mb-4">Processing times</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @php($pt = $page->visa_processing_times)
                    @if(!empty($pt['standard']))
                        <div class="rounded border p-4">
                            <div class="text-sm text-gray-500">Standard</div>
                            <div class="text-lg font-semibold">{{ $pt['standard'] }}</div>
                        </div>
                    @endif
                    @if(!empty($pt['priority']))
                        <div class="rounded border p-4">
                            <div class="text-sm text-gray-500">Priority</div>
                            <div class="text-lg font-semibold">{{ $pt['priority'] }}</div>
                        </div>
                    @endif
                    @if(!empty($pt['complex']))
                        <div class="rounded border p-4">
                            <div class="text-sm text-gray-500">Complex cases</div>
                            <div class="text-lg font-semibold">{{ $pt['complex'] }}</div>
                        </div>
                    @endif
                </div>
            </section>
            @endif

            @if($showCosts)
            <section id="costs" class="bg-white rounded-xl shadow-md p-6 md:p-8">
                <h2 class="text-2xl font-bold mb-4">Costs</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left border">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 border">Item</th>
                                <th class="px-4 py-2 border">Amount</th>
                                <th class="px-4 py-2 border">Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($page->visa_costs as $row)
                                @continue(empty($row['label']) && empty($row['amount']))
                                <tr>
                                    <td class="px-4 py-2 border">{{ $row['label'] ?? '' }}</td>
                                    <td class="px-4 py-2 border">{{ $row['amount'] ?? '' }}</td>
                                    <td class="px-4 py-2 border">{{ $row['notes'] ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            @endif

            <!-- FAQs -->
            @if($showFaqs)
            <section id="faqs" class="bg-white rounded-xl shadow-md p-6 md:p-8">
                <h2 class="text-2xl font-bold mb-4">FAQs</h2>
                <div class="space-y-3">
                    @foreach($page->visa_faqs as $faq)
                        @continue(empty($faq['question']) || empty($faq['answer']))
                        <details class="bg-white rounded border p-4">
                            <summary class="font-medium cursor-pointer">{{ $faq['question'] }}</summary>
                            <div class="prose max-w-none mt-2">{!! \Illuminate\Support\Str::markdown($faq['answer']) !!}</div>
                        </details>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- Contact CTA -->
            <div class="mt-4 bg-white rounded-lg shadow p-6">
                @include('components.unified-contact-form', [
                    'form_source' => 'visa-structured-' . $page->slug,
                    'form_variant' => 'compact',
                    'show_phone' => true,
                    'show_subject' => false
                ])
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Quick Contact</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <span class="text-blue-600 mr-2">📞</span>
                        <a href="tel:+61396021330" class="text-gray-700 hover:text-blue-600">+61 3 9602 1330</a>
                    </div>
                    <div class="flex items-center">
                        <span class="text-blue-600 mr-2">✉️</span>
                        <a href="mailto:info@bansalimmigration.com.au" class="text-gray-700 hover:text-blue-600">info@bansalimmigration.com.au</a>
                    </div>
                    <div class="flex items-start">
                        <span class="text-blue-600 mr-2">📍</span>
                        <span class="text-gray-700">Level 8/278 Collins St<br>Melbourne VIC 3000</span>
                    </div>
                </div>
            </div>

            @if(isset($relatedPages) && $relatedPages->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Related Services</h3>
                <ul class="space-y-2">
                    @foreach($relatedPages as $relatedPage)
                    <li>
                        <a href="/{{ $relatedPage->category }}/{{ $relatedPage->slug }}" class="text-blue-600 hover:text-blue-800 block py-1">
                            {{ $relatedPage->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection


