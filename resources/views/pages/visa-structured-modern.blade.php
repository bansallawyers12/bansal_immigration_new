@extends('layouts.main')

@section('title', ($page->meta_title ?? $page->title) . ' - Bansal Immigration')
@section('description', $page->meta_description ?? $page->excerpt)

@section('content')
<div class="w-full">
    <!-- Full-bleed hero with overlayed chips -->
    @php
        $heroBgUrl = $page->image ? asset('storage/' . $page->image) : asset('img/homepage.jpg');
        $chips = [];
        // Build four chips using new field structure
        $duration = $page->visa_duration['initial'] ?? null;
        $processing = $page->visa_processing_times['standard'] ?? ($page->visa_processing_times['priority'] ?? null);
        $cost = isset($page->visa_costs[0]['amount']) ? $page->visa_costs[0]['amount'] : null;
        $pathway = isset($page->visa_pathways[0]['title']) ? $page->visa_pathways[0]['title'] : null;
        $chips = [
            ['label' => 'Duration', 'value' => $duration ?? '—'],
            ['label' => 'Cost', 'value' => $cost ?? '—'],
            ['label' => 'Processing', 'value' => $processing ?? '—'],
            ['label' => 'Pathway', 'value' => $pathway ?? '—'],
        ];
    @endphp

    <section class="relative">
        <div class="absolute inset-0" style="background-image:url('{{ $heroBgUrl }}');background-size:cover;background-position:center;"></div>
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 1px, transparent 1px), radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 60px 60px;"></div>
        <div class="relative max-w-7xl mx-auto px-4 py-16 lg:py-24 text-white">
            <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight mb-4">{{ $page->title }}</h1>
            <p class="text-white/90 text-lg max-w-3xl">{{ $page->excerpt }}</p>
            <div class="mt-6 flex flex-wrap gap-3">
                @foreach($chips as $chip)
                <div class="backdrop-blur bg-white/15 ring-1 ring-white/25 rounded-full px-4 py-2">
                    <span class="text-white/80 text-xs mr-2">{{ $chip['label'] }}</span>
                    <span class="font-semibold">{{ $chip['value'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Sticky toc on wide screens -->
    @php
        $showEligibility = !empty($page->visa_eligibility);
        $showBenefits = !empty($page->visa_benefits);
        $showSteps = !empty($page->visa_steps);
        $showDuration = !empty($page->visa_duration);
        $showPathways = !empty($page->visa_pathways);
        $showProcessing = !empty($page->visa_processing_times);
        $showCosts = !empty($page->visa_costs);
        $showFaqs = !empty($page->visa_faqs);
    @endphp

    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-12 gap-8 mt-10">
        <aside class="lg:col-span-3 hidden lg:block">
            <div class="sticky top-24 bg-white rounded-xl shadow p-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">On this page</h3>
                <ul class="space-y-2 text-sm">
                    <li><a class="text-blue-700 hover:underline" href="#overview">Welcome to Your Future Down Under</a></li>
                    @if($showEligibility)<li><a class="text-blue-700 hover:underline" href="#eligibility">Do You Have What It Takes?</a></li>@endif
                    @if($showBenefits)<li><a class="text-blue-700 hover:underline" href="#benefits">Why Choose This Path?</a></li>@endif
                    @if($showSteps)<li><a class="text-blue-700 hover:underline" href="#apply">Your Roadmap to Success</a></li>@endif
                    @if($showDuration)<li><a class="text-blue-700 hover:underline" href="#duration">Visa Duration</a></li>@endif
                    @if($showPathways)<li><a class="text-blue-700 hover:underline" href="#pathways">Visa Pathways</a></li>@endif
                    @if($showProcessing)<li><a class="text-blue-700 hover:underline" href="#times">How Long Will It Take?</a></li>@endif
                    @if($showCosts)<li><a class="text-blue-700 hover:underline" href="#fees">What's the Investment?</a></li>@endif
                    @if($showFaqs)<li><a class="text-blue-700 hover:underline" href="#faqs">Got Questions? We've Got Answers</a></li>@endif
                </ul>
            </div>
        </aside>

        <main class="lg:col-span-9 space-y-8">
            <section id="overview" class="bg-white rounded-xl shadow p-6">
                <div class="prose max-w-none">
                    {!! \Illuminate\Support\Str::of($page->content) !!}
                </div>
            </section>

            @if($showEligibility)
            <section id="eligibility" class="bg-white rounded-xl shadow p-6">
                <h2 class="text-2xl font-bold mb-4">Do You Have What It Takes?</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach($page->visa_eligibility as $item)
                        @continue(empty($item))
                        <div class="flex items-start gap-2">
                            <span class="text-green-600">✔</span>
                            <span>{{ $item }}</span>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            @if($showBenefits)
            <section id="benefits" class="bg-white rounded-xl shadow p-6">
                <h2 class="text-2xl font-bold mb-4">Why Choose This Path?</h2>
                <ul class="list-disc pl-6 space-y-2">
                    @foreach($page->visa_benefits as $item)
                        @continue(empty($item))
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </section>
            @endif

            @if($showSteps)
            <section id="apply" class="bg-white rounded-xl shadow p-6">
                <h2 class="text-2xl font-bold mb-4">Your Roadmap to Success</h2>
                <ol class="list-decimal pl-6 space-y-2">
                    @foreach($page->visa_steps as $item)
                        @continue(empty($item))
                        <li>{{ $item }}</li>
                    @endforeach
                </ol>
            </section>
            @endif

            @if($showDuration)
            <section id="duration" class="bg-white rounded-xl shadow p-6">
                <h2 class="text-2xl font-bold mb-4">Visa Duration</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if(!empty($page->visa_duration['initial']))
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Initial Duration</h3>
                            <p class="text-gray-600">{{ $page->visa_duration['initial'] }}</p>
                        </div>
                    </div>
                    @endif
                    
                    @if(!empty($page->visa_duration['extension']))
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Extension Duration</h3>
                            <p class="text-gray-600">{{ $page->visa_duration['extension'] }}</p>
                        </div>
                    </div>
                    @endif
                    
                    @if(!empty($page->visa_duration['permanent']))
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Permanent Residency</h3>
                            <p class="text-gray-600">{{ $page->visa_duration['permanent'] }}</p>
                        </div>
                    </div>
                    @endif
                    
                    @if(!empty($page->visa_duration['notes']))
                    <div class="flex items-start space-x-3 md:col-span-2">
                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Additional Notes</h3>
                            <p class="text-gray-600">{{ $page->visa_duration['notes'] }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </section>
            @endif

            @if($showPathways)
            <section id="pathways" class="bg-white rounded-xl shadow p-6">
                <h2 class="text-2xl font-bold mb-4">Visa Pathways</h2>
                <div class="space-y-6">
                    @foreach($page->visa_pathways as $pathway)
                        @continue(empty($pathway['title']))
                        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $pathway['title'] }}</h3>
                                    @if(!empty($pathway['description']))
                                        <p class="text-gray-600 mb-3">{{ $pathway['description'] }}</p>
                                    @endif
                                    
                                    @if(!empty($pathway['requirements']))
                                        <div class="mb-3">
                                            <h4 class="font-medium text-gray-900 mb-2">Requirements:</h4>
                                            <div class="prose max-w-none text-gray-600 text-sm">
                                                {!! nl2br(e($pathway['requirements'])) !!}
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if(!empty($pathway['steps']) && is_array($pathway['steps']))
                                        <div>
                                            <h4 class="font-medium text-gray-900 mb-2">Steps:</h4>
                                            <ol class="list-decimal list-inside space-y-1 text-sm text-gray-600">
                                                @foreach($pathway['steps'] as $step)
                                                    @if(!empty(trim($step)))
                                                        <li>{{ $step }}</li>
                                                    @endif
                                                @endforeach
                                            </ol>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            @if($showProcessing)
            <section id="times" class="bg-white rounded-xl shadow p-6">
                <h2 class="text-2xl font-bold mb-4">How Long Will It Take?</h2>
                @php($pt = $page->visa_processing_times)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @if(!empty($pt['standard']))
                    <div class="rounded border p-4"><div class="text-sm text-gray-500">Standard</div><div class="text-lg font-semibold">{{ $pt['standard'] }}</div></div>
                    @endif
                    @if(!empty($pt['priority']))
                    <div class="rounded border p-4"><div class="text-sm text-gray-500">Priority</div><div class="text-lg font-semibold">{{ $pt['priority'] }}</div></div>
                    @endif
                    @if(!empty($pt['complex']))
                    <div class="rounded border p-4"><div class="text-sm text-gray-500">Complex</div><div class="text-lg font-semibold">{{ $pt['complex'] }}</div></div>
                    @endif
                </div>
            </section>
            @endif

            @if($showCosts)
            <section id="fees" class="bg-white rounded-xl shadow p-6">
                <h2 class="text-2xl font-bold mb-4">What's the Investment?</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left border">
                        <thead class="bg-gray-50"><tr><th class="px-4 py-2 border">Item</th><th class="px-4 py-2 border">Amount</th><th class="px-4 py-2 border">Notes</th></tr></thead>
                        <tbody>
                            @foreach($page->visa_costs as $row)
                                @continue(empty($row['label']) && empty($row['amount']))
                                <tr><td class="px-4 py-2 border">{{ $row['label'] ?? '' }}</td><td class="px-4 py-2 border">{{ $row['amount'] ?? '' }}</td><td class="px-4 py-2 border">{{ $row['notes'] ?? '' }}</td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            @endif

            @if($showFaqs)
            <section id="faqs" class="">
                <h2 class="text-2xl font-bold mb-4">Got Questions? We've Got Answers</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($page->visa_faqs as $faq)
                        @continue(empty($faq['question']) || empty($faq['answer']))
                        <div class="bg-white rounded-2xl shadow p-6 h-full flex flex-col">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ $faq['question'] }}</h3>
                            <div class="prose max-w-none text-gray-700">{!! \Illuminate\Support\Str::markdown($faq['answer']) !!}</div>
                            <div class="mt-auto"></div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif
        </main>
    </div>

    <!-- Insights cards -->
    @php($insights = \App\Models\Blog::orderBy('created_at', 'desc')->take(3)->get())
    @if($insights->count())
    <section class="mt-14 bg-gray-50 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="flex items-end justify-between mb-6">
            <h2 class="text-2xl font-bold">Latest insights</h2>
            <a href="/blogs" class="text-blue-700 text-sm hover:underline">View all</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($insights as $post)
            <a href="/blogs/{{ $post->slug }}" class="group bg-white rounded-xl shadow p-6 block">
                <div class="text-xs uppercase tracking-widest text-gray-500 mb-2">Insight</div>
                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-700">{{ $post->title }}</h3>
                @if($post->excerpt)
                <p class="text-gray-600 mt-2 line-clamp-3">{{ $post->excerpt }}</p>
                @endif
                <span class="inline-flex items-center text-blue-700 mt-3 text-sm">Read more <span class="ml-1">→</span></span>
            </a>
            @endforeach
            </div>
        </div>
    </section>
    @endif

</div>
@endsection


