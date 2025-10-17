@extends('layouts.main')

@section('title', ($page?->meta_title ?? $page?->title ?? 'Visa Information') . ' - Bansal Immigration')
@section('description', $page?->meta_description ?? $page?->excerpt ?? '')

@push('styles')
    <meta name="keywords" content="{{ $page?->meta_keywords ?? '' }}">
    <meta property="og:title" content="{{ $page?->meta_title ?? $page?->title ?? 'Visa Information' }}">
    <meta property="og:description" content="{{ $page?->meta_description ?? $page?->excerpt ?? '' }}">
    @if($page?->image)
    <meta property="og:image" content="{{ asset('storage/' . $page->image) }}">
    @endif
    
    <style>
        /* Modern animations and effects */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); }
            50% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .animate-pulse-glow {
            animation: pulse-glow 2s infinite;
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Custom gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Glass morphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        /* Hover effects */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }
        
        /* Active navigation item styles */
        .nav-item.active {
            background-color: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }
        
        .nav-item.active .w-2 {
            transform: scale(1.5);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
        }
        
        .nav-item.active .absolute {
            opacity: 1;
        }
        
        /* Smooth scroll offset for fixed header */
        html {
            scroll-padding-top: 100px;
        }
        
        /* Modern test design styles */
        .check-badge {
            background: rgba(99, 102, 241, 0.1);
            color: #4f46e5;
        }
        
        .shadow-soft {
            box-shadow: 0 8px 30px rgba(0,0,0,.08);
        }
        
        /* Ensure navigation panel doesn't get cut off */
        #sticky-nav .group:hover .absolute {
            max-height: calc(100vh - 2rem);
            overflow-y: auto;
        }
        
        /* Responsive positioning for smaller screens */
        @media (max-height: 800px) {
            #sticky-nav {
                top: 1/4 !important;
            }
        }
        
        @media (max-height: 600px) {
            #sticky-nav {
                top: 1/5 !important;
            }
        }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navItems = document.querySelectorAll('.nav-item');
            const sections = document.querySelectorAll('section[id]');
            const stickyNav = document.getElementById('sticky-nav');
            
            // Function to adjust navigation position based on viewport height
            function adjustNavPosition() {
                const viewportHeight = window.innerHeight;
                const navHeight = 200; // Approximate height of expanded nav
                const availableSpace = viewportHeight - navHeight;
                
                if (availableSpace < 100) {
                    // If not enough space, position higher
                    stickyNav.style.top = '10%';
                } else if (viewportHeight < 800) {
                    // For smaller screens, position at 25% from top
                    stickyNav.style.top = '25%';
                } else {
                    // Default position at 33% from top
                    stickyNav.style.top = '33%';
                }
            }
            
            // Adjust position on load and resize
            adjustNavPosition();
            window.addEventListener('resize', adjustNavPosition);
            
            // Function to update active navigation item
            function updateActiveNav() {
                let current = '';
                const scrollPosition = window.scrollY + 150; // Offset for better detection
                
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;
                    const sectionId = section.getAttribute('id');
                    
                    if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                        current = sectionId;
                    }
                });
                
                // Update navigation items
                navItems.forEach(item => {
                    item.classList.remove('active');
                    if (item.getAttribute('data-section') === current) {
                        item.classList.add('active');
                    }
                });
            }
            
            // Smooth scroll for navigation links
            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetSection = document.getElementById(targetId);
                    
                    if (targetSection) {
                        const offsetTop = targetSection.offsetTop - 100; // Account for any fixed header
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Update active nav on scroll
            window.addEventListener('scroll', updateActiveNav);
            
            // Initial call to set active item
            updateActiveNav();
            
            // Add intersection observer for better performance
            const observerOptions = {
                root: null,
                rootMargin: '-20% 0px -70% 0px',
                threshold: 0
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const sectionId = entry.target.getAttribute('id');
                        navItems.forEach(item => {
                            item.classList.remove('active');
                            if (item.getAttribute('data-section') === sectionId) {
                                item.classList.add('active');
                            }
                        });
                    }
                });
            }, observerOptions);
            
            sections.forEach(section => {
                observer.observe(section);
            });
        });
    </script>
@endpush

@section('content')
@if(!$page)
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center px-4">
        <div class="text-center max-w-md mx-auto">
            <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Page Not Found</h1>
            <p class="text-gray-600 mb-8">The requested page could not be found.</p>
            <a href="/" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Return Home
            </a>
        </div>
    </div>
@else
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="container mx-auto px-4 py-8 max-w-7xl animate-fade-in-up">
    <!-- Modern Breadcrumb -->
    <nav class="mb-8" aria-label="Breadcrumb">
        <ol class="flex items-center flex-wrap gap-2 text-sm">
            <li>
                <a href="/" class="flex items-center text-gray-500 hover:text-blue-600 transition-colors duration-200 whitespace-nowrap">
                    <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="hidden sm:inline">Home</span>
                    <span class="sm:hidden">H</span>
                </a>
            </li>
            <li class="flex-shrink-0">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </li>
            <li>
                <a href="/{{ $page->category }}" class="text-gray-500 hover:text-blue-600 transition-colors duration-200 capitalize font-medium truncate max-w-32 sm:max-w-none">
                    {{ str_replace('-', ' ', $page->category) }}
                </a>
            </li>
            <li class="flex-shrink-0">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </li>
            <li class="text-gray-900 font-semibold truncate max-w-48 sm:max-w-none">{{ $page->title }}</li>
        </ol>
    </nav>

    <!-- Modern Hero Section -->
@php
    $heroBgUrl = $page->image ? asset('storage/' . $page->image) : null;
@endphp

<div class="relative rounded-2xl overflow-hidden mb-12 min-h-96 md:min-h-[28rem] lg:min-h-[32rem] shadow-2xl group">
    @if($heroBgUrl)
        <div class="absolute inset-0 transition-transform duration-700 group-hover:scale-105" style="background-image:url('{{ $heroBgUrl }}');background-size:cover;background-position:center;"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/55 via-blue-800/50 to-blue-700/55"></div>
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-500"></div>
    @endif
    
    <!-- Removed dotted pattern for cleaner image visibility -->
    
    <div class="relative text-white p-6 md:p-8 lg:p-12 py-12 md:py-16 lg:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center w-full max-w-6xl mx-auto">
            <div class="space-y-6">
                <div class="space-y-4">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
                        {{ $page->title }}
                    </h1>
                @if($page->excerpt)
                    <p class="text-blue-100 text-lg sm:text-xl leading-relaxed max-w-2xl">{{ $page->excerpt }}</p>
                @endif
                </div>
                
                <div class="flex flex-col sm:flex-row flex-wrap gap-3 md:gap-4">
                    <a href="#overview" class="group/btn inline-flex items-center justify-center px-6 py-3 bg-white text-blue-700 font-semibold rounded-xl hover:bg-blue-50 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2 group-hover/btn:animate-pulse flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Overview
                    </a>
                    @if(!empty($page->visa_steps))
                    <a href="#how-to-apply" class="inline-flex items-center justify-center px-6 py-3 bg-white/10 backdrop-blur-sm border border-white/20 text-white font-semibold rounded-xl hover:bg-white/20 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        How to Apply
                    </a>
                    @endif
                </div>
            </div>
            <div>
                @php
                    // Use new field structure for hero cards
                    $duration = $page->visa_duration['initial'] ?? null;
                    $pathway = isset($page->visa_pathways[0]['title']) ? $page->visa_pathways[0]['title'] : null;
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
                    <div class="group/card bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:scale-105">
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 bg-white/20 rounded-md flex items-center justify-center mr-2">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <dt class="text-xs font-medium text-white/90">Duration</dt>
                        </div>
                        <dd class="text-lg font-bold text-white truncate" title="{{ $duration ?? '—' }}">{{ $duration ?? '—' }}</dd>
                    </div>
                    
                    <div class="group/card bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:scale-105">
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 bg-white/20 rounded-md flex items-center justify-center mr-2">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <dt class="text-xs font-medium text-white/90">Cost</dt>
                        </div>
                        <dd class="text-lg font-bold text-white truncate" title="{{ $primaryCost ?? '—' }}">{{ $primaryCost ?? '—' }}</dd>
                    </div>
                    
                    <div class="group/card bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:scale-105">
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 bg-white/20 rounded-md flex items-center justify-center mr-2">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <dt class="text-xs font-medium text-white/90">Processing Time</dt>
                        </div>
                        <dd class="text-lg font-bold text-white truncate" title="{{ $processing ?? '—' }}">{{ $processing ?? '—' }}</dd>
                    </div>
                    
                    <div class="group/card bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:scale-105">
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 bg-white/20 rounded-md flex items-center justify-center mr-2">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <dt class="text-xs font-medium text-white/90">Pathway</dt>
                        </div>
                        <dd class="text-lg font-bold text-white truncate" title="{{ $pathway ?? '—' }}">{{ $pathway ?? '—' }}</dd>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Sticky Left Navigation -->
    @php
        $showEligibility = !empty($page->visa_eligibility);
        $showBenefits = !empty($page->visa_benefits);
        $showSteps = !empty($page->visa_steps);
        $showDuration = !empty($page->visa_duration);
        $showPathways = !empty($page->visa_pathways);
        $showFaqs = !empty($page->visa_faqs);
        $showProcessing = !empty($page->visa_processing_times);
        $showCosts = !empty($page->visa_costs);
    @endphp
    
    <!-- Sticky Navigation Sidebar -->
    <div id="sticky-nav" class="fixed left-0 top-1/3 transform -translate-y-1/2 z-50 transition-all duration-300 ease-in-out">
        <div class="group relative">
            <!-- Compact Trigger Button -->
            <div class="w-12 h-12 bg-white/90 backdrop-blur-md border border-gray-200/50 rounded-r-xl shadow-lg flex items-center justify-center cursor-pointer hover:bg-white hover:shadow-xl transition-all duration-300">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                </svg>
            </div>
            
            <!-- Expanded Navigation Panel -->
            <div class="absolute left-0 top-0 w-0 overflow-hidden bg-white/95 backdrop-blur-md border border-gray-200/50 rounded-r-xl shadow-xl group-hover:w-64 transition-all duration-300 ease-in-out">
                <div class="p-6 min-w-64">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Contents</h3>
                    </div>
                    
                    <nav class="space-y-2" id="nav-links">
                        <a href="#overview" data-section="overview" class="nav-item group flex items-center py-3 px-4 rounded-lg text-sm font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50/80 transition-all duration-200 relative">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-3 group-hover:scale-125 transition-transform duration-200"></div>
                            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">Overview</span>
                            <div class="absolute left-0 top-0 w-1 h-full bg-blue-500 rounded-r-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        </a>
                        
                        @if($showEligibility)
                        <a href="#eligibility" data-section="eligibility" class="nav-item group flex items-center py-3 px-4 rounded-lg text-sm font-medium text-gray-700 hover:text-green-600 hover:bg-green-50/80 transition-all duration-200 relative">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-3 group-hover:scale-125 transition-transform duration-200"></div>
                            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">Eligibility</span>
                            <div class="absolute left-0 top-0 w-1 h-full bg-green-500 rounded-r-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        </a>
                        @endif
                        
                        @if($showBenefits)
                        <a href="#benefits" data-section="benefits" class="nav-item group flex items-center py-3 px-4 rounded-lg text-sm font-medium text-gray-700 hover:text-purple-600 hover:bg-purple-50/80 transition-all duration-200 relative">
                            <div class="w-2 h-2 bg-purple-500 rounded-full mr-3 group-hover:scale-125 transition-transform duration-200"></div>
                            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">Benefits</span>
                            <div class="absolute left-0 top-0 w-1 h-full bg-purple-500 rounded-r-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        </a>
                        @endif
                        
                        @if($showSteps)
                        <a href="#how-to-apply" data-section="how-to-apply" class="nav-item group flex items-center py-3 px-4 rounded-lg text-sm font-medium text-gray-700 hover:text-orange-600 hover:bg-orange-50/80 transition-all duration-200 relative">
                            <div class="w-2 h-2 bg-orange-500 rounded-full mr-3 group-hover:scale-125 transition-transform duration-200"></div>
                            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">How to Apply</span>
                            <div class="absolute left-0 top-0 w-1 h-full bg-orange-500 rounded-r-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        </a>
                        @endif
                        
                        @if($showDuration)
                        <a href="#duration" data-section="duration" class="nav-item group flex items-center py-3 px-4 rounded-lg text-sm font-medium text-gray-700 hover:text-cyan-600 hover:bg-cyan-50/80 transition-all duration-200 relative">
                            <div class="w-2 h-2 bg-cyan-500 rounded-full mr-3 group-hover:scale-125 transition-transform duration-200"></div>
                            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">Duration</span>
                            <div class="absolute left-0 top-0 w-1 h-full bg-cyan-500 rounded-r-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        </a>
                        @endif
                        
                        @if($showPathways)
                        <a href="#pathways" data-section="pathways" class="nav-item group flex items-center py-3 px-4 rounded-lg text-sm font-medium text-gray-700 hover:text-teal-600 hover:bg-teal-50/80 transition-all duration-200 relative">
                            <div class="w-2 h-2 bg-teal-500 rounded-full mr-3 group-hover:scale-125 transition-transform duration-200"></div>
                            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">Pathways</span>
                            <div class="absolute left-0 top-0 w-1 h-full bg-teal-500 rounded-r-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        </a>
                        @endif
                        
                        @if($showProcessing)
                        <a href="#processing-times" data-section="processing-times" class="nav-item group flex items-center py-3 px-4 rounded-lg text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50/80 transition-all duration-200 relative">
                            <div class="w-2 h-2 bg-indigo-500 rounded-full mr-3 group-hover:scale-125 transition-transform duration-200"></div>
                            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">Processing Times</span>
                            <div class="absolute left-0 top-0 w-1 h-full bg-indigo-500 rounded-r-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        </a>
                        @endif
                        
                        @if($showCosts)
                        <a href="#costs" data-section="costs" class="nav-item group flex items-center py-3 px-4 rounded-lg text-sm font-medium text-gray-700 hover:text-emerald-600 hover:bg-emerald-50/80 transition-all duration-200 relative">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full mr-3 group-hover:scale-125 transition-transform duration-200"></div>
                            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">Costs</span>
                            <div class="absolute left-0 top-0 w-1 h-full bg-emerald-500 rounded-r-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        </a>
                        @endif
                        
                        @if($showFaqs)
                        <a href="#faqs" data-section="faqs" class="nav-item group flex items-center py-3 px-4 rounded-lg text-sm font-medium text-gray-700 hover:text-pink-600 hover:bg-pink-50/80 transition-all duration-200 relative">
                            <div class="w-2 h-2 bg-pink-500 rounded-full mr-3 group-hover:scale-125 transition-transform duration-200"></div>
                            <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">FAQs</span>
                            <div class="absolute left-0 top-0 w-1 h-full bg-pink-500 rounded-r-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        </a>
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2 space-y-12">
            <!-- Modern Overview Section -->
            <section id="overview" class="group bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-8 py-6 border-b border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">Overview</h2>
                    </div>
                </div>
                <div class="p-8">
                    <div class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-p:text-gray-700 prose-a:text-blue-600 prose-a:no-underline hover:prose-a:underline prose-strong:text-gray-900">
                    {!! \Illuminate\Support\Str::of($page->content) !!}
                    </div>
                </div>
            </section>

            <!-- Modern Eligibility Section -->
            @if($showEligibility)
            <section id="eligibility" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Do You Have What It Takes?</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <ul class="space-y-2 text-sm text-gray-700">
                        @foreach(array_slice($page->visa_eligibility, 0, ceil(count($page->visa_eligibility) / 2)) as $item)
                            @continue(empty($item))
                            <li class="flex items-start gap-2">
                                <span class="check-badge px-2 py-0.5 rounded">✔</span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <ul class="space-y-2 text-sm text-gray-700">
                        @foreach(array_slice($page->visa_eligibility, ceil(count($page->visa_eligibility) / 2)) as $item)
                        @continue(empty($item))
                            <li class="flex items-start gap-2">
                                <span class="check-badge px-2 py-0.5 rounded">✔</span>
                                <span>{{ $item }}</span>
                            </li>
                    @endforeach
                    </ul>
                </div>
            </section>
            @endif

            <!-- Modern Benefits Section -->
            @if($showBenefits)
            <section id="benefits" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Why Choose This Path?</h2>
                <ul class="list-disc pl-5 space-y-2 text-gray-700">
                    @foreach($page->visa_benefits as $item)
                        @continue(empty($item))
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </section>
            @endif

            <!-- Modern How to Apply Section -->
            @if($showSteps)
            <section id="how-to-apply" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">Your Roadmap to Success</h2>
                <ol class="list-decimal pl-5 space-y-2 text-gray-700">
                    @foreach($page->visa_steps as $item)
                        @continue(empty($item))
                        <li>{{ $item }}</li>
                    @endforeach
                </ol>
            </section>
            @endif

            <!-- Modern Duration Section -->
            @if($showDuration)
            <section id="duration" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Visa Duration</h2>
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

            <!-- Modern Pathways Section -->
            @if($showPathways)
            <section id="pathways" class="bg-white rounded-xl shadow-soft p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Visa Pathways</h2>
                <div class="space-y-6">
                    @foreach($page->visa_pathways as $pathway)
                        @continue(empty($pathway['title']))
                        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-teal-600 rounded-lg flex items-center justify-center flex-shrink-0">
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

            <!-- Modern FAQs Section with Mobile Accordion -->
            @if($showFaqs)
            <section id="faqs" class="">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Got Questions? We've Got Answers</h2>
                
                <!-- Mobile: Accordion Layout -->
                <div class="md:hidden space-y-4">
                    @foreach($page->visa_faqs as $faq)
                        @continue(empty($faq['question']) || empty($faq['answer']))
                        <details class="bg-white rounded-2xl shadow-soft group">
                            <summary class="p-6 cursor-pointer flex items-center justify-between hover:bg-gray-50 transition-colors duration-200 rounded-2xl">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ $faq['question'] }}</h3>
                                <i class="fas fa-plus text-blue-600 group-open:rotate-45 transition-transform duration-200 flex-shrink-0"></i>
                            </summary>
                            <div class="px-6 pb-6 pt-0">
                                <div class="prose max-w-none text-gray-700">{!! \Illuminate\Support\Str::markdown($faq['answer']) !!}</div>
                            </div>
                        </details>
                    @endforeach
                </div>

                <!-- Desktop: Card Grid Layout -->
                <div class="hidden md:grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($page->visa_faqs as $faq)
                        @continue(empty($faq['question']) || empty($faq['answer']))
                        <div class="bg-white rounded-2xl shadow-soft p-6 h-full flex flex-col hover:shadow-lg transition-shadow duration-300">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ $faq['question'] }}</h3>
                            <div class="prose max-w-none text-gray-700 flex-grow">{!! \Illuminate\Support\Str::markdown($faq['answer']) !!}</div>
                            <div class="mt-auto"></div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- Contact CTA -->
            <div id="contact-form" class="mt-4 bg-white rounded-lg shadow p-6">
                @include('components.unified-contact-form', [
                    'form_source' => 'visa-structured-' . $page->slug,
                    'form_variant' => 'compact',
                    'show_phone' => true,
                    'show_subject' => false
                ])
            </div>
        </div>

        <!-- Modern Sidebar -->
        <div class="lg:col-span-1 space-y-8">
            <!-- Quick Contact Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden group hover:shadow-xl transition-all duration-300 hover-lift">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Get Expert Help</h3>
                    </div>
                </div>
                <div class="p-6 space-y-6">
                    <div class="space-y-4">
                        <a href="tel:+61396021330" class="group/contact flex items-center p-4 rounded-xl bg-gradient-to-r from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 transition-all duration-300 border border-green-200 hover:border-green-300">
                            <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center mr-4 group-hover/contact:scale-110 transition-transform duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-600">Call Us</div>
                                <div class="text-lg font-bold text-gray-900 group-hover/contact:text-green-700">+61 3 9602 1330</div>
                            </div>
                        </a>
                        
                        <a href="mailto:info@bansalimmigration.com.au" class="group/contact flex items-center p-4 rounded-xl bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 transition-all duration-300 border border-blue-200 hover:border-blue-300">
                            <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mr-4 group-hover/contact:scale-110 transition-transform duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-600">Email Us</div>
                                <div class="text-sm font-bold text-gray-900 group-hover/contact:text-blue-700 break-all">info@bansalimmigration.com.au</div>
                            </div>
                        </a>
                        
                <div class="space-y-3">
                            <div class="flex items-start p-4 rounded-xl bg-gradient-to-r from-purple-50 to-purple-100 border border-purple-200">
                                <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-600 mb-1">Melbourne Office</div>
                                    <div class="text-sm font-bold text-gray-900">Level 8/278 Collins St<br>Melbourne VIC 3000</div>
                                </div>
                            </div>
                            
                            <div class="flex items-start p-4 rounded-xl bg-gradient-to-r from-indigo-50 to-indigo-100 border border-indigo-200">
                                <div class="w-12 h-12 bg-indigo-500 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-600 mb-1">Adelaide Office</div>
                                    <div class="text-sm font-bold text-gray-900">Unit 5, 55 Gawler Pl<br>Adelaide SA 5000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-200">
                        <a href="#contact-form" class="w-full inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Get Free Consultation
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover-lift">
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Why Choose Us</h3>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">10+ Years Experience</div>
                            <div class="text-sm text-gray-600">Licensed migration agents</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">95% Success Rate</div>
                            <div class="text-sm text-gray-600">Visa approval rate</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">10,000+ Clients</div>
                            <div class="text-sm text-gray-600">Successfully migrated</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Services -->
            @if(isset($relatedPages) && $relatedPages->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover-lift">
                <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 px-6 py-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Related Services</h3>
                    </div>
                </div>
                <div class="p-6 space-y-3">
                    @foreach($relatedPages as $relatedPage)
                    <a href="/{{ $relatedPage->category }}/{{ $relatedPage->slug }}" class="group block p-4 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100 hover:from-indigo-50 hover:to-indigo-100 transition-all duration-300 border border-gray-200 hover:border-indigo-200">
                        <div class="flex items-start">
                            <div class="w-2 h-2 bg-indigo-500 rounded-full mt-2 mr-3 flex-shrink-0 group-hover:scale-125 transition-transform duration-200"></div>
                            <div>
                                <div class="font-semibold text-gray-900 group-hover:text-indigo-700 transition-colors duration-200">{{ $relatedPage->title }}</div>
                                <div class="text-sm text-gray-600 capitalize">{{ str_replace('-', ' ', $relatedPage->category) }}</div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endif
@endsection


