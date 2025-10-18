{{-- 
    Celebrity Visa Template for Bansal Immigration
    This template provides a reusable structure for celebrity visa showcase pages
    Usage: @extends('templates.celebrity-visa-template')
--}}

@extends('layouts.main')

@section('title', ($page_title ?? 'Celebrity Visa Success Stories') . ' - Bansal Immigration')
@section('description', $page_description ?? 'Success stories of celebrities who achieved their Australian dreams through Bansal Immigration.')

@push('styles')
<style>
    /* Celebrity Visa Template Styles */
    .celebrity-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
    }
    
    .gold-gradient {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #d97706 100%);
    }
    
    .celebrity-card {
        background: linear-gradient(145deg, #ffffff 0%, #f1f5f9 100%);
        border: 1px solid rgba(59, 130, 246, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .celebrity-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        border-color: rgba(59, 130, 246, 0.3);
    }
    
    .floating-element {
        animation: float 6s ease-in-out infinite;
    }
    
    .floating-element:nth-child(2n) {
        animation-delay: -2s;
    }
    
    .floating-element:nth-child(3n) {
        animation-delay: -4s;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-10px) rotate(1deg); }
        66% { transform: translateY(5px) rotate(-1deg); }
    }
    
    .text-glow {
        text-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
    }
    
    .category-badge {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-block;
        margin: 0.25rem;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }
    
    .stats-counter {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .celebrity-image {
        transition: all 0.4s ease;
        filter: brightness(1.1) contrast(1.1);
    }
    
    .celebrity-card:hover .celebrity-image {
        transform: scale(1.1);
        filter: brightness(1.2) contrast(1.2);
    }
    
    .testimonial-quote {
        position: relative;
        font-style: italic;
        font-size: 1.125rem;
        line-height: 1.8;
    }
    
    .testimonial-quote::before {
        content: '"';
        font-size: 4rem;
        color: #3b82f6;
        position: absolute;
        top: -1rem;
        left: -1rem;
        opacity: 0.3;
    }
    
    .testimonial-quote::after {
        content: '"';
        font-size: 4rem;
        color: #3b82f6;
        position: absolute;
        bottom: -2rem;
        right: -1rem;
        opacity: 0.3;
    }
    
    .hero-particles {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    
    .particle {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: particleFloat 8s infinite linear;
    }
    
    @keyframes particleFloat {
        0% {
            transform: translateY(100vh) translateX(0);
            opacity: 0;
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            transform: translateY(-100px) translateX(100px);
            opacity: 0;
        }
    }
    
    .category-section {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 2rem;
        padding: 3rem;
        margin: 2rem 0;
        border: 1px solid rgba(59, 130, 246, 0.1);
    }
    
    .cta-button {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        padding: 1rem 2rem;
        border-radius: 3rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
    }
    
    .cta-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
        color: white;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .stats-counter {
            font-size: 2rem;
        }
        
        .category-section {
            padding: 2rem 1rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section with Parallax Background -->
<div class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 celebrity-gradient">
        <div class="hero-particles">
            <div class="particle" style="left: 10%; animation-delay: 0s; width: 4px; height: 4px;"></div>
            <div class="particle" style="left: 20%; animation-delay: 1s; width: 6px; height: 6px;"></div>
            <div class="particle" style="left: 30%; animation-delay: 2s; width: 3px; height: 3px;"></div>
            <div class="particle" style="left: 40%; animation-delay: 3s; width: 5px; height: 5px;"></div>
            <div class="particle" style="left: 50%; animation-delay: 4s; width: 4px; height: 4px;"></div>
            <div class="particle" style="left: 60%; animation-delay: 5s; width: 7px; height: 7px;"></div>
            <div class="particle" style="left: 70%; animation-delay: 6s; width: 3px; height: 3px;"></div>
            <div class="particle" style="left: 80%; animation-delay: 7s; width: 5px; height: 5px;"></div>
            <div class="particle" style="left: 90%; animation-delay: 8s; width: 4px; height: 4px;"></div>
        </div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-10 text-center text-white px-4 max-w-6xl mx-auto">
        <div class="floating-element">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 text-glow">
                {{ $hero_title ?? 'Celebrity Visas' }}
            </h1>
        </div>
        
        <div class="floating-element mb-8">
            <p class="text-xl md:text-2xl mb-8 opacity-90 max-w-4xl mx-auto leading-relaxed">
                {{ $hero_subtitle ?? 'Where Dreams Meet Reality - Success Stories of Celebrities Who Made Australia Their Home' }}
            </p>
        </div>
        
        <div class="floating-element">
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                @if(isset($category_badges))
                    @foreach($category_badges as $badge)
                        <div class="category-badge">{{ $badge }}</div>
                    @endforeach
                @else
                    <div class="category-badge">Bollywood Stars</div>
                    <div class="category-badge">Punjabi Artists</div>
                    <div class="category-badge">Religious Leaders</div>
                    <div class="category-badge">Cultural Ambassadors</div>
                @endif
            </div>
        </div>
        
        <div class="floating-element">
            <a href="#success-stories" class="cta-button text-lg px-8 py-4">
                <span class="mr-2">✨</span>
                {{ $cta_text ?? 'Explore Success Stories' }}
                <span class="ml-2">→</span>
            </a>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white opacity-70 animate-bounce">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</div>

<!-- Success Statistics -->
@if(isset($stats) && count($stats) > 0)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Celebrating <span class="text-blue-600">Success</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ $stats_description ?? 'Join the ranks of successful celebrities who trusted Bansal Immigration for their Australian journey' }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-{{ count($stats) }} gap-8">
            @foreach($stats as $stat)
                <div class="text-center">
                    <div class="stats-counter">{{ $stat['number'] }}</div>
                    <div class="text-lg font-semibold text-gray-700 mt-2">{{ $stat['label'] }}</div>
                    <div class="text-sm text-gray-500">{{ $stat['description'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Featured Success Stories -->
<section id="success-stories" class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Featured <span class="text-blue-600">Success Stories</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ $stories_description ?? 'Real stories from real people who achieved their Australian dreams' }}
            </p>
        </div>
        
        @if(isset($celebrity_categories))
            @foreach($celebrity_categories as $category)
                <div class="category-section">
                    <div class="text-center mb-12">
                        <div class="inline-block px-6 py-3 {{ $category['badge_color'] }} text-white font-bold text-lg rounded-full mb-4">
                            {{ $category['icon'] }} {{ $category['title'] }}
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $category['subtitle'] }}</h3>
                        <p class="text-gray-600 mt-2">{{ $category['description'] }}</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($category['celebrities'] as $celebrity)
                            <div class="celebrity-card rounded-2xl p-6">
                                <div class="aspect-square {{ $celebrity['image_bg'] }} rounded-xl mb-4 flex items-center justify-center text-white font-bold text-xl celebrity-image">
                                    {{ $celebrity['image_icon'] }}
                                </div>
                                <div class="category-badge {{ $celebrity['badge_color'] }} mb-3">{{ $celebrity['category'] }}</div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $celebrity['name'] }}</h4>
                                <p class="text-gray-600 text-sm mb-4">{{ $celebrity['description'] }}</p>
                                <div class="testimonial-quote text-sm">{{ $celebrity['testimonial'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
        
        @yield('celebrity_content')
    </div>
</section>

<!-- Why Choose Us Section -->
@if(isset($features) && count($features) > 0)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Why Choose <span class="text-blue-600">Bansal Immigration</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ $features_description ?? 'Specialized expertise in celebrity and cultural visas with personalized service' }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($features as $feature)
                <div class="text-center p-6">
                    <div class="w-16 h-16 {{ $feature['icon_bg'] }} rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">{{ $feature['icon'] }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $feature['title'] }}</h3>
                    <p class="text-gray-600">{{ $feature['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
<section class="py-20 celebrity-gradient">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
            {{ $cta_title ?? 'Ready to Start Your Australian Journey?' }}
        </h2>
        <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
            {{ $cta_subtitle ?? 'Join the ranks of successful celebrities who trusted Bansal Immigration for their Australian dreams' }}
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="tel:+61396021330" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-bold rounded-full hover:bg-blue-50 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                Call Now: +61 3 9602 1330
            </a>
            
            <a href="/book-an-appointment" class="inline-flex items-center px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-blue-600 transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Book Consultation
            </a>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ $form_title ?? 'Get Your Free Celebrity Visa Assessment' }}
            </h2>
            <p class="text-lg text-gray-600">
                {{ $form_subtitle ?? 'Confidential consultation for high-profile individuals' }}
            </p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-xl p-8">
            @include('components.unified-contact-form', [
                'form_source' => $form_source ?? 'celebrity-visas-template',
                'form_variant' => $form_variant ?? 'celebrity',
                'show_phone' => true,
                'show_subject' => false
            ])
        </div>
    </div>
</section>

@push('scripts')
<script>
    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Add intersection observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe all celebrity cards
    document.querySelectorAll('.celebrity-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s ease';
        observer.observe(card);
    });
    
    // Add counter animation for stats
    function animateCounter(element, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16);
        
        function updateCounter() {
            start += increment;
            if (start < target) {
                element.textContent = Math.floor(start) + '+';
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target + '+';
            }
        }
        
        updateCounter();
    }
    
    // Trigger counter animation when stats section comes into view
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('.stats-counter');
                counters.forEach((counter, index) => {
                    const targets = [50, 100, 15, 24];
                    setTimeout(() => {
                        animateCounter(counter, targets[index]);
                    }, index * 200);
                });
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    const statsSection = document.querySelector('.stats-counter');
    if (statsSection) {
        statsObserver.observe(statsSection.closest('section'));
    }
</script>
@endpush

@endsection
