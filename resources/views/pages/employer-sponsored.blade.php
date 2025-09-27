@extends('layouts.main')

@section('title', '{{ $page->meta_title ?? $page->title }}')
@section('description', $page->meta_description ?? $page->excerpt)

@push('styles')
    <meta property="og:title" content="{{ $page->meta_title ?? $page->title }}">
    <meta property="og:description" content="{{ $page->meta_description ?? $page->excerpt }}">
    @if($page->image)
    <meta property="og:image" content="{{ asset('storage/' . $page->image) }}">
    @endif
    @php $noindexClosed = in_array(($page->slug ?? ''), [
        'distinguished-talent-124',
    ]); @endphp
    @if($noindexClosed)
    <meta name="robots" content="noindex,follow">
    @endif

    <style>
        /* Modern Employer Sponsored Page Styles */
        .employer-hero {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.95), rgba(59, 130, 246, 0.9)), 
                        url('/img/employer-sponosred-hero.jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .visa-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid #f0f4f8;
            overflow: hidden;
        }
        
        .visa-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .visa-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            margin-bottom: 20px;
        }
        
        .visa-icon.temporary {
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
        }
        
        .visa-icon.permanent {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        }
        
        .visa-icon.special {
            background: linear-gradient(135deg, #7c3aed, #a855f7);
        }
        
        .stats-card {
            background: linear-gradient(135deg, #f8fafc, #ffffff);
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }
        
        .process-step {
            position: relative;
            padding-left: 40px;
        }
        
        .process-step::before {
            content: '';
            position: absolute;
            left: 0;
            top: 8px;
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .process-step::after {
            content: attr(data-step);
            position: absolute;
            left: 6px;
            top: 12px;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }
        
        .benefit-item {
            display: flex;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .benefit-item:last-child {
            border-bottom: none;
        }
        
        .benefit-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
            color: #3b82f6;
        }
        
        .cta-section {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            border-radius: 24px;
            position: relative;
            overflow: hidden;
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .floating-element {
            /* Animation removed */
        }
        
        .floating-element:nth-child(2) {
            /* Animation removed */
        }
        
        .floating-element:nth-child(3) {
            /* Animation removed */
        }
        
        @media (max-width: 768px) {
            .employer-hero {
                background-attachment: scroll;
            }
            
            .visa-card {
                margin-bottom: 24px;
            }
        }
    </style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="employer-hero text-white py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="floating-element inline-block mb-6">
                <div class="bg-white bg-opacity-30 backdrop-blur-sm rounded-2xl px-6 py-3">
                    <i class="fas fa-briefcase text-2xl mr-3 text-white"></i>
                    <span class="font-semibold text-white">Employer Sponsored Visas</span>
                </div>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                {{ $page->title ?? 'Employer Sponsored Visas' }}
            </h1>
            
            @if($page->excerpt)
            <p class="text-xl md:text-2xl text-blue-100 max-w-4xl mx-auto mb-8 leading-relaxed">
                {{ $page->excerpt }}
            </p>
            @endif
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#visa-options" class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-gray-800 transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-search mr-2"></i>Explore Visa Options
                </a>
                <a href="#contact-form" class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-gray-800 transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-phone mr-2"></i>Get Free Consultation
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-16 bg-sg-light-gray">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="stats-card">
                <div class="text-3xl font-bold text-sg-navy mb-2">10,000+</div>
                <div class="text-sg-medium-gray font-medium">Clients</div>
            </div>
            <div class="stats-card">
                <div class="text-3xl font-bold text-sg-navy mb-2">95%</div>
                <div class="text-sg-medium-gray font-medium">Success Rate</div>
            </div>
            <div class="stats-card">
                <div class="text-3xl font-bold text-sg-navy mb-2">10+</div>
                <div class="text-sg-medium-gray font-medium">Years Experience</div>
            </div>
            <div class="stats-card">
                <div class="text-3xl font-bold text-sg-navy mb-2">100%</div>
                <div class="text-sg-medium-gray font-medium">Licensed Agents</div>
            </div>
        </div>
    </div>
</section>

<!-- Visa Categories Section -->
<section id="visa-options" class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-sg-navy mb-4">Employer Sponsored Visa Categories</h2>
            <p class="text-xl text-sg-medium-gray max-w-3xl mx-auto">
                Choose from our comprehensive range of employer sponsored visa options designed to meet your specific needs and career goals.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Temporary Visas -->
            <div class="visa-card p-8">
                <div class="visa-icon temporary">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="text-2xl font-bold text-sg-navy mb-4">Temporary Work Visas</h3>
                <p class="text-sg-medium-gray mb-6 leading-relaxed">
                    Short to medium-term work opportunities in Australia with potential pathways to permanent residency.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center text-sg-dark-gray">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <a href="{{ route('employer-sponsored.sid-482') }}" class="hover:text-sg-light-blue transition-colors">Skill in Demand Visa (482)</a>
                    </li>
                    <li class="flex items-center text-sg-dark-gray">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <a href="{{ route('employer-sponsored.temporary-activity-408') }}" class="hover:text-sg-light-blue transition-colors">Temporary Activity (408)</a>
                    </li>
                    <li class="flex items-center text-sg-dark-gray">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <a href="{{ route('employer-sponsored.training-visa-407') }}" class="hover:text-sg-light-blue transition-colors">Training Visa (407)</a>
                    </li>
                    <li class="flex items-center text-sg-dark-gray">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <a href="{{ route('employer-sponsored.short-stay-400') }}" class="hover:text-sg-light-blue transition-colors">Short Stay (400)</a>
                    </li>
                </ul>
                <a href="{{ route('employer-sponsored.sid-482') }}" class="inline-block bg-blue-50 text-sg-light-blue px-6 py-3 rounded-lg font-semibold hover:bg-sg-light-blue hover:text-white transition-all duration-300">
                    Learn More <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Permanent Visas -->
            <div class="visa-card p-8">
                <div class="visa-icon permanent">
                    <i class="fas fa-home"></i>
                </div>
                <h3 class="text-2xl font-bold text-sg-navy mb-4">Permanent Residency</h3>
                <p class="text-sg-medium-gray mb-6 leading-relaxed">
                    Direct pathways to Australian permanent residency through employer sponsorship and regional opportunities.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center text-sg-dark-gray">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <a href="{{ route('employer-sponsored.ens-186-trt') }}" class="hover:text-sg-light-blue transition-colors">ENS 186 TRT</a>
                    </li>
                    <li class="flex items-center text-sg-dark-gray">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <a href="{{ route('employer-sponsored.ens-186-direct') }}" class="hover:text-sg-light-blue transition-colors">ENS 186 Direct</a>
                    </li>
                    <li class="flex items-center text-sg-dark-gray">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <a href="{{ route('employer-sponsored.skilled-regional-494') }}" class="hover:text-sg-light-blue transition-colors">Regional 494</a>
                    </li>
                    <li class="flex items-center text-sg-dark-gray">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <a href="{{ route('employer-sponsored.dama') }}" class="hover:text-sg-light-blue transition-colors">DAMA Program</a>
                    </li>
                </ul>
                <a href="{{ route('employer-sponsored.ens-186-trt') }}" class="inline-block bg-blue-50 text-sg-light-blue px-6 py-3 rounded-lg font-semibold hover:bg-sg-light-blue hover:text-white transition-all duration-300">
                    Learn More <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Special Programs -->
            <div class="visa-card p-8">
                <div class="visa-icon special">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="text-2xl font-bold text-sg-navy mb-4">Special Programs</h3>
                <p class="text-sg-medium-gray mb-6 leading-relaxed">
                    Exclusive programs for highly skilled professionals and distinguished talent in specialized fields.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center text-sg-dark-gray">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <a href="{{ route('employer-sponsored.gti') }}" class="hover:text-sg-light-blue transition-colors">GTI Program</a>
                    </li>
                    <li class="flex items-center text-sg-dark-gray">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <a href="{{ route('employer-sponsored.gtes') }}" class="hover:text-sg-light-blue transition-colors">GTES Program</a>
                    </li>
                    <li class="flex items-center text-sg-dark-gray">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <a href="{{ route('employer-sponsored.national-innovation-visa') }}" class="hover:text-sg-light-blue transition-colors">National Innovation Visa (858)</a>
                    </li>
                </ul>
                <a href="{{ route('employer-sponsored.gti') }}" class="inline-block bg-blue-50 text-sg-light-blue px-6 py-3 rounded-lg font-semibold hover:bg-sg-light-blue hover:text-white transition-all duration-300">
                    Learn More <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-20 bg-sg-light-gray">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-sg-navy mb-6">Why Choose Employer Sponsored Visas?</h2>
                <p class="text-xl text-sg-medium-gray mb-8 leading-relaxed">
                    Employer sponsored visas offer numerous advantages for skilled professionals seeking to work and live in Australia.
                </p>
                
                <div class="space-y-4">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sg-navy mb-1">Faster Processing</h4>
                            <p class="text-sg-medium-gray text-sm">Priority processing for employer sponsored applications</p>
                        </div>
                    </div>
                    
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sg-navy mb-1">Job Security</h4>
                            <p class="text-sg-medium-gray text-sm">Guaranteed employment with sponsoring employer</p>
                        </div>
                    </div>
                    
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-route"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sg-navy mb-1">Pathway to PR</h4>
                            <p class="text-sg-medium-gray text-sm">Clear pathways to permanent residency</p>
                        </div>
                    </div>
                    
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sg-navy mb-1">Family Inclusion</h4>
                            <p class="text-sg-medium-gray text-sm">Include family members in your application</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="relative">
                <div class="bg-white rounded-2xl p-8 shadow-xl">
                    <h3 class="text-2xl font-bold text-sg-navy mb-6">Application Process</h3>
                    <div class="space-y-6">
                        <div class="process-step" data-step="1">
                            <h4 class="font-semibold text-sg-navy mb-2">Find Employer Sponsor</h4>
                            <p class="text-sg-medium-gray text-sm">Secure employment with an approved Australian employer</p>
                        </div>
                        
                        <div class="process-step" data-step="2">
                            <h4 class="font-semibold text-sg-navy mb-2">Skills Assessment</h4>
                            <p class="text-sg-medium-gray text-sm">Complete relevant skills assessment for your occupation</p>
                        </div>
                        
                        <div class="process-step" data-step="3">
                            <h4 class="font-semibold text-sg-navy mb-2">Nomination & Application</h4>
                            <p class="text-sg-medium-gray text-sm">Employer lodges nomination, you submit visa application</p>
                        </div>
                        
                        <div class="process-step" data-step="4">
                            <h4 class="font-semibold text-sg-navy mb-2">Visa Grant</h4>
                            <p class="text-sg-medium-gray text-sm">Receive your visa and begin your Australian journey</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Page Content Section -->
@if($page->content)
<section class="py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-lg max-w-none">
            {!! $page->content !!}
        </div>
    </div>
</section>
@endif

<!-- Related Pages Section -->
@if($relatedPages->count() > 0)
<section class="py-20 bg-sg-light-gray">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-sg-navy mb-4">Related Visa Services</h2>
            <p class="text-xl text-sg-medium-gray max-w-3xl mx-auto">
                Explore our comprehensive range of employer sponsored visa services tailored to your specific needs.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedPages as $relatedPage)
            <div class="visa-card p-6">
                @if($relatedPage->image)
                <img src="{{ asset('storage/' . $relatedPage->image) }}" alt="{{ $relatedPage->image_alt ?? $relatedPage->title }}" class="w-full h-48 object-cover rounded-lg mb-6">
                @endif
                <h3 class="text-xl font-bold text-sg-navy mb-3">{{ $relatedPage->title }}</h3>
                @if($relatedPage->excerpt)
                <p class="text-sg-medium-gray mb-6 line-clamp-3">{{ $relatedPage->excerpt }}</p>
                @endif
                <a href="{{ url($relatedPage->category . '/' . $relatedPage->slug) }}" class="inline-flex items-center text-sg-light-blue hover:text-sg-navy font-semibold transition-colors">
                    Learn More <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section id="contact-form" class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="cta-section p-12 text-white text-center relative">
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Start Your Australian Journey?</h2>
                <p class="text-xl text-blue-100 mb-8 max-w-3xl mx-auto">
                    Let our experienced migration agents guide you through the employer sponsored visa process. 
                    Get personalized advice and maximize your chances of success.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-8">
                    <a href="tel:+61396021330" class="bg-white text-sg-navy px-8 py-4 rounded-xl font-semibold hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-phone mr-2"></i>Call +61 3 9602 1330
                    </a>
                    <a href="{{ route('appointment') }}" class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-sg-navy transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-calendar mr-2"></i>Book Consultation
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Contact Form -->
        <div class="mt-16 bg-white rounded-2xl shadow-xl p-8 md:p-12">
            <div class="text-center mb-8">
                <h3 class="text-2xl md:text-3xl font-bold text-sg-navy mb-4">Get Free Visa Assessment</h3>
                <p class="text-sg-medium-gray text-lg">
                    Complete our quick assessment form and receive personalized advice on your employer sponsored visa options.
                </p>
            </div>
            
            @include('components.unified-contact-form', [
                'form_source' => 'employer-sponsored-page',
                'form_variant' => 'modern',
                'show_phone' => true,
                'show_subject' => false
            ])
        </div>
    </div>
</section>

@php
$closedSlugs = [
    'distinguished-talent-124', // 124
    'business-talent-permanent-visa-subclass-132', // 132
    'business-innovation-and-investment-provisional-visa-subclass-188', // 188
];
@endphp
@if(in_array($page->slug, $closedSlugs))
<div class="fixed bottom-4 right-4 z-50">
    <div class="bg-yellow-50 border border-yellow-200 text-yellow-900 rounded-lg p-4 max-w-sm shadow-lg">
        <div class="flex items-start">
            <i class="fas fa-exclamation-triangle text-yellow-600 mr-3 mt-1"></i>
            <div>
                <strong>Note:</strong> This visa subclass is currently closed to new applications. Information is provided for reference only.
            </div>
        </div>
    </div>
</div>
@endif
@endsection
