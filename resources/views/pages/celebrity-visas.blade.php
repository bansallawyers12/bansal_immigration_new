@extends('layouts.main')

@section('title', 'Celebrity Visas - Success Stories & Testimonials | Bansal Immigration')
@section('description', 'Discover success stories of Punjabi, Haryanvi, Bollywood singers, actors, and religious figures who achieved their Australian dreams through Bansal Immigration.')

@push('styles')
<style>
    /* Celebrity Visa Specific Styles - Sky & Clouds Background */
    .sky-gradient {
        background: linear-gradient(180deg, 
            #e0e7ff 0%, 
            #c7d2fe 15%, 
            #a5b4fc 30%, 
            #c084fc 45%, 
            #fbbf24 60%, 
            #fb923c 75%, 
            #f97316 90%, 
            #ea580c 100%);
        position: relative;
        min-height: 100vh;
    }
    
    .floating-cloud-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        overflow: hidden;
        pointer-events: none;
    }
    
    .cloud {
        position: absolute;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50px;
        opacity: 0.9;
        animation: cloudFloat 30s infinite linear;
    }
    
    .cloud::before,
    .cloud::after {
        content: '';
        position: absolute;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50px;
    }
    
    .cloud::before {
        width: 50px;
        height: 50px;
        top: -25px;
        left: 10px;
    }
    
    .cloud::after {
        width: 60px;
        height: 40px;
        top: -15px;
        right: 10px;
    }
    
    .cloud-large {
        width: 100px;
        height: 40px;
        top: 20%;
        left: -120px;
        animation-delay: 0s;
        animation-duration: 40s;
    }
    
    .cloud-medium {
        width: 80px;
        height: 30px;
        top: 60%;
        left: -100px;
        animation-delay: 10s;
        animation-duration: 35s;
    }
    
    .cloud-small {
        width: 60px;
        height: 25px;
        top: 40%;
        left: -80px;
        animation-delay: 20s;
        animation-duration: 30s;
    }
    
    .cloud-extra-large {
        width: 120px;
        height: 50px;
        top: 70%;
        left: -140px;
        animation-delay: 15s;
        animation-duration: 45s;
    }
    
    @keyframes cloudFloat {
        0% {
            transform: translateX(0) translateY(0px);
        }
        25% {
            transform: translateX(25vw) translateY(-10px);
        }
        50% {
            transform: translateX(50vw) translateY(5px);
        }
        75% {
            transform: translateX(75vw) translateY(-5px);
        }
        100% {
            transform: translateX(calc(100vw + 140px)) translateY(0px);
        }
    }
    
    .floating-content {
        position: relative;
        z-index: 10;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 2rem;
        margin: 1rem 0;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }
    
    .floating-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 16px;
        padding: 1.5rem;
        margin: 1rem 0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    .floating-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        background: rgba(255, 255, 255, 0.2);
    }
    
    .gold-gradient {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #d97706 100%);
    }
    
    .testimonial-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
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
    
    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .text-glow {
        text-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
    }
    
    .hero-title {
        background: linear-gradient(135deg, #1e293b 0%, #475569 50%, #64748b 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
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
    
    .section-divider {
        background: linear-gradient(90deg, transparent 0%, #3b82f6 50%, transparent 100%);
        height: 2px;
        margin: 4rem 0;
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
<!-- Hero Section with Sky & Clouds Background -->
<div class="relative min-h-screen flex items-center justify-center overflow-hidden sky-gradient">
    <!-- Floating Clouds Background -->
    <div class="floating-cloud-bg">
        <div class="cloud cloud-large"></div>
        <div class="cloud cloud-medium"></div>
        <div class="cloud cloud-small"></div>
        <div class="cloud cloud-extra-large"></div>
        
        <!-- Additional clouds for more dynamic effect -->
        <div class="cloud cloud-large" style="top: 30%; animation-delay: 25s; animation-duration: 50s;"></div>
        <div class="cloud cloud-medium" style="top: 50%; animation-delay: 5s; animation-duration: 38s;"></div>
        <div class="cloud cloud-small" style="top: 80%; animation-delay: 30s; animation-duration: 42s;"></div>
    </div>
    
    <!-- Hero Content Floating in Clouds -->
    <div class="floating-content text-center px-4 max-w-6xl mx-auto">
        <div class="floating-element">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white drop-shadow-lg">
                Celebrity Visas
            </h1>
        </div>
        
        <div class="floating-element mb-8">
            <p class="text-xl md:text-2xl mb-8 text-white/90 max-w-4xl mx-auto leading-relaxed drop-shadow-md">
                Where Dreams Meet Reality - Success Stories of Punjabi, Haryanvi, Bollywood Stars, and Religious Leaders Who Made Australia Their Home
            </p>
        </div>
        
        <div class="floating-element">
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <div class="category-badge bg-white/20 backdrop-blur-sm border border-white/30 text-white">Bollywood Singers</div>
                <div class="category-badge bg-white/20 backdrop-blur-sm border border-white/30 text-white">Punjabi Artists</div>
                <div class="category-badge bg-white/20 backdrop-blur-sm border border-white/30 text-white">Haryanvi Performers</div>
                <div class="category-badge bg-white/20 backdrop-blur-sm border border-white/30 text-white">Religious Leaders</div>
                <div class="category-badge bg-white/20 backdrop-blur-sm border border-white/30 text-white">Film Actors</div>
                <div class="category-badge bg-white/20 backdrop-blur-sm border border-white/30 text-white">TV Personalities</div>
            </div>
        </div>
        
        <div class="floating-element">
            <a href="#success-stories" class="inline-flex items-center px-8 py-4 bg-white/20 backdrop-blur-sm border border-white/30 text-white font-bold rounded-full hover:bg-white/30 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <span class="mr-2">✨</span>
                Explore Success Stories
                <span class="ml-2">→</span>
            </a>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white opacity-80 animate-bounce">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</div>

<!-- Success Statistics -->
<section class="py-20 sky-gradient relative">
    <div class="floating-cloud-bg">
        <div class="cloud cloud-medium" style="top: 10%; animation-delay: 35s; animation-duration: 55s;"></div>
        <div class="cloud cloud-small" style="top: 30%; animation-delay: 45s; animation-duration: 40s;"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="floating-content text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4 drop-shadow-lg">
                Trusted by <span class="text-yellow-300">Celebrities</span>
            </h2>
            <p class="text-xl text-white/90 max-w-3xl mx-auto drop-shadow-md">
                From Bollywood stars to religious leaders, we've helped celebrities achieve their Australian dreams with complete confidentiality and expert guidance
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="floating-card text-center">
                <div class="stats-counter text-white">50+</div>
                <div class="text-lg font-semibold text-white mt-2">Celebrity Clients</div>
                <div class="text-sm text-white/80">Successfully migrated</div>
            </div>
            <div class="floating-card text-center">
                <div class="stats-counter text-white">100%</div>
                <div class="text-lg font-semibold text-white mt-2">Success Rate</div>
                <div class="text-sm text-white/80">Visa approval rate</div>
            </div>
            <div class="floating-card text-center">
                <div class="stats-counter text-white">15+</div>
                <div class="text-lg font-semibold text-white mt-2">Years Experience</div>
                <div class="text-sm text-white/80">Celebrity visa expertise</div>
            </div>
            <div class="floating-card text-center">
                <div class="stats-counter text-white">100%</div>
                <div class="text-lg font-semibold text-white mt-2">Confidentiality</div>
                <div class="text-sm text-white/80">Privacy guaranteed</div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Success Stories -->
<section id="success-stories" class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Featured <span class="text-blue-600">Success Stories</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Real stories from real people who achieved their Australian dreams
            </p>
        </div>
        
        <!-- Bollywood & Entertainment -->
        <div class="category-section">
            <div class="text-center mb-12">
                <div class="inline-block px-6 py-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-white font-bold text-lg rounded-full mb-4">
                    🎬 Bollywood & Entertainment
                </div>
                <h3 class="text-3xl font-bold text-gray-900">Lights, Camera, Australia!</h3>
                <p class="text-gray-600 mt-2">Success stories of Bollywood stars and entertainment industry professionals</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Celebrity Card Template -->
                <div class="floating-card rounded-2xl p-6">
                    <div class="aspect-square bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl mb-4 flex items-center justify-center text-white font-bold text-xl celebrity-image">
                        🎤 Singer
                    </div>
                    <div class="category-badge bg-gradient-to-r from-yellow-400 to-orange-500 mb-3">Bollywood Singer</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Anonymous Bollywood Singer</h4>
                    <p class="text-gray-600 text-sm mb-4">
                        Successfully obtained Australian permanent residency through Global Talent Visa. Now performing at major events across Australia.
                    </p>
                    <div class="testimonial-quote text-sm">
                        "Bansal Immigration made my Australian dream come true. Their expertise in celebrity visas is unmatched."
                    </div>
                </div>
                
                <div class="floating-card rounded-2xl p-6">
                    <div class="aspect-square bg-gradient-to-br from-purple-400 to-pink-500 rounded-xl mb-4 flex items-center justify-center text-white font-bold text-xl celebrity-image">
                        🎭 Actor
                    </div>
                    <div class="category-badge bg-gradient-to-r from-purple-400 to-pink-500 mb-3">Film Actor</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Anonymous Film Actor</h4>
                    <p class="text-gray-600 text-sm mb-4">
                        Achieved Australian citizenship after successful migration. Now working in Australian film industry.
                    </p>
                    <div class="testimonial-quote text-sm">
                        "The team understood the unique needs of entertainment professionals. Highly recommended!"
                    </div>
                </div>
                
                <div class="floating-card rounded-2xl p-6">
                    <div class="aspect-square bg-gradient-to-br from-blue-400 to-cyan-500 rounded-xl mb-4 flex items-center justify-center text-white font-bold text-xl celebrity-image">
                        📺 TV Host
                    </div>
                    <div class="category-badge bg-gradient-to-r from-blue-400 to-cyan-500 mb-3">TV Personality</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Anonymous TV Host</h4>
                    <p class="text-gray-600 text-sm mb-4">
                        Successfully migrated with family. Now hosting shows for Australian multicultural communities.
                    </p>
                    <div class="testimonial-quote text-sm">
                        "Professional service from start to finish. They made the complex process seem easy."
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Punjabi Artists -->
        <div class="category-section">
            <div class="text-center mb-12">
                <div class="inline-block px-6 py-3 bg-gradient-to-r from-green-400 to-emerald-500 text-white font-bold text-lg rounded-full mb-4">
                    🎵 Punjabi Artists
                </div>
                <h3 class="text-3xl font-bold text-gray-900">Punjabi Pride in Australia</h3>
                <p class="text-gray-600 mt-2">Success stories of Punjabi singers, musicians, and cultural ambassadors</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="floating-card rounded-2xl p-6">
                    <div class="aspect-square bg-gradient-to-br from-orange-400 to-red-500 rounded-xl mb-4 flex items-center justify-center text-white font-bold text-xl celebrity-image">
                        🎤 Punjabi Singer
                    </div>
                    <div class="category-badge bg-gradient-to-r from-orange-400 to-red-500 mb-3">Punjabi Singer</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Anonymous Punjabi Singer</h4>
                    <p class="text-gray-600 text-sm mb-4">
                        Successfully obtained Australian permanent residency. Now performing at Punjabi festivals across Australia.
                    </p>
                    <div class="testimonial-quote text-sm">
                        "Bansal Immigration helped me bring Punjabi culture to Australia. Forever grateful!"
                    </div>
                </div>
                
                <div class="floating-card rounded-2xl p-6">
                    <div class="aspect-square bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl mb-4 flex items-center justify-center text-white font-bold text-xl celebrity-image">
                        🎸 Musician
                    </div>
                    <div class="category-badge bg-gradient-to-r from-yellow-400 to-orange-500 mb-3">Punjabi Musician</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Anonymous Punjabi Musician</h4>
                    <p class="text-gray-600 text-sm mb-4">
                        Achieved Australian citizenship through Global Talent Visa. Contributing to Australian music scene.
                    </p>
                    <div class="testimonial-quote text-sm">
                        "Their understanding of cultural visas is exceptional. Highly professional team."
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Haryanvi Performers -->
        <div class="category-section">
            <div class="text-center mb-12">
                <div class="inline-block px-6 py-3 bg-gradient-to-r from-indigo-400 to-purple-500 text-white font-bold text-lg rounded-full mb-4">
                    🎪 Haryanvi Performers
                </div>
                <h3 class="text-3xl font-bold text-gray-900">Haryanvi Heritage in Australia</h3>
                <p class="text-gray-600 mt-2">Success stories of Haryanvi singers, dancers, and cultural performers</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="floating-card rounded-2xl p-6">
                    <div class="aspect-square bg-gradient-to-br from-teal-400 to-blue-500 rounded-xl mb-4 flex items-center justify-center text-white font-bold text-xl celebrity-image">
                        💃 Dancer
                    </div>
                    <div class="category-badge bg-gradient-to-r from-teal-400 to-blue-500 mb-3">Haryanvi Dancer</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Anonymous Haryanvi Dancer</h4>
                    <p class="text-gray-600 text-sm mb-4">
                        Successfully migrated to Australia. Now teaching Haryanvi dance forms and performing at cultural events.
                    </p>
                    <div class="testimonial-quote text-sm">
                        "Bansal Immigration preserved our cultural heritage in Australia. Amazing service!"
                    </div>
                </div>
                
                <div class="floating-card rounded-2xl p-6">
                    <div class="aspect-square bg-gradient-to-br from-pink-400 to-rose-500 rounded-xl mb-4 flex items-center justify-center text-white font-bold text-xl celebrity-image">
                        🎵 Folk Singer
                    </div>
                    <div class="category-badge bg-gradient-to-r from-pink-400 to-rose-500 mb-3">Haryanvi Folk Singer</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Anonymous Haryanvi Folk Singer</h4>
                    <p class="text-gray-600 text-sm mb-4">
                        Achieved Australian permanent residency. Now sharing Haryanvi folk music with Australian audiences.
                    </p>
                    <div class="testimonial-quote text-sm">
                        "They made my cultural visa application seamless. Highly recommend their services."
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Religious Leaders -->
        <div class="category-section">
            <div class="text-center mb-12">
                <div class="inline-block px-6 py-3 bg-gradient-to-r from-amber-400 to-yellow-500 text-white font-bold text-lg rounded-full mb-4">
                    🕉️ Religious Leaders
                </div>
                <h3 class="text-3xl font-bold text-gray-900">Spiritual Leaders in Australia</h3>
                <p class="text-gray-600 mt-2">Success stories of religious leaders, spiritual teachers, and community guides</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="floating-card rounded-2xl p-6">
                    <div class="aspect-square bg-gradient-to-br from-emerald-400 to-teal-500 rounded-xl mb-4 flex items-center justify-center text-white font-bold text-xl celebrity-image">
                        🕉️ Spiritual Teacher
                    </div>
                    <div class="category-badge bg-gradient-to-r from-emerald-400 to-teal-500 mb-3">Spiritual Leader</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Anonymous Spiritual Teacher</h4>
                    <p class="text-gray-600 text-sm mb-4">
                        Successfully obtained Australian permanent residency. Now serving the spiritual community in Australia.
                    </p>
                    <div class="testimonial-quote text-sm">
                        "Bansal Immigration helped me establish my spiritual mission in Australia. Exceptional service."
                    </div>
                </div>
                
                <div class="floating-card rounded-2xl p-6">
                    <div class="aspect-square bg-gradient-to-br from-violet-400 to-purple-500 rounded-xl mb-4 flex items-center justify-center text-white font-bold text-xl celebrity-image">
                        ⛪ Religious Leader
                    </div>
                    <div class="category-badge bg-gradient-to-r from-violet-400 to-purple-500 mb-3">Religious Leader</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Anonymous Religious Leader</h4>
                    <p class="text-gray-600 text-sm mb-4">
                        Achieved Australian citizenship. Now leading religious community and cultural activities.
                    </p>
                    <div class="testimonial-quote text-sm">
                        "Their expertise in religious visas is outstanding. Made my Australian journey smooth."
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us for Celebrity Visas -->
<section class="py-20 sky-gradient relative">
    <div class="floating-cloud-bg">
        <div class="cloud cloud-large" style="top: 15%; animation-delay: 50s; animation-duration: 60s;"></div>
        <div class="cloud cloud-medium" style="top: 70%; animation-delay: 55s; animation-duration: 45s;"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="floating-content text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4 drop-shadow-lg">
                Why Choose <span class="text-yellow-300">Bansal Immigration</span>
            </h2>
            <p class="text-xl text-white/90 max-w-3xl mx-auto drop-shadow-md">
                Specialized expertise in celebrity and cultural visas with personalized service
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="floating-card text-center p-6">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">🎯</span>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Specialized Expertise</h3>
                <p class="text-white/90">Deep understanding of celebrity and cultural visa requirements</p>
            </div>
            
            <div class="floating-card text-center p-6">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">🔒</span>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Confidentiality</h3>
                <p class="text-white/90">Complete privacy and discretion for high-profile clients</p>
            </div>
            
            <div class="floating-card text-center p-6">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">⚡</span>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Fast Processing</h3>
                <p class="text-white/90">Priority handling for celebrity visa applications</p>
            </div>
            
            <div class="floating-card text-center p-6">
                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">🤝</span>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">24/7 Support</h3>
                <p class="text-white/90">Dedicated support team available round the clock</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 celebrity-gradient">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
            Ready to Start Your Australian Journey?
        </h2>
        <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
            Join the ranks of successful celebrities who trusted Bansal Immigration for their Australian dreams
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="tel:+61396021330" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-bold rounded-full hover:bg-blue-50 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                Call Now: +61 3 9602 1330
            </a>
            
            <a href="/bookappointment" class="inline-flex items-center px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-blue-600 transition-all duration-300">
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
                Get Your Free Celebrity Visa Assessment
            </h2>
            <p class="text-lg text-gray-600">
                Confidential consultation for high-profile individuals
            </p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-xl p-8">
            @include('components.unified-contact-form', [
                'form_source' => 'celebrity-visas-page',
                'form_variant' => 'celebrity',
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
    
    const statsSection = document.querySelector('.stats-counter').closest('section');
    if (statsSection) {
        statsObserver.observe(statsSection);
    }
</script>
@endpush

@endsection
