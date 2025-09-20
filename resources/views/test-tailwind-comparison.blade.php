<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind CSS Comparison Test - CDN vs Vite</title>
    <meta name="description" content="Testing CDN Tailwind vs Vite Tailwind implementation">
    
    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        /* Custom styles that match the main layout */
        :root {
            --sg-navy: #1e3a8a;
            --sg-light-blue: #3b82f6;
            --sg-sky-blue: #60a5fa;
            --sg-light-gray: #f8fafc;
            --sg-dark-gray: #374151;
            --sg-medium-gray: #6b7280;
        }

        .sg-navy { color: var(--sg-navy); }
        .sg-light-blue { color: var(--sg-light-blue); }
        .sg-sky-blue { color: var(--sg-sky-blue); }
        .bg-sg-navy { background-color: var(--sg-navy); }
        .bg-sg-light-blue { background-color: var(--sg-light-blue); }
        .bg-sg-sky-blue { background-color: var(--sg-sky-blue); }
        .bg-sg-light-gray { background-color: var(--sg-light-gray); }
        .border-sg-light-blue { border-color: var(--sg-light-blue); }

        .font-sg {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .hero-bg {
            background: linear-gradient(rgba(30, 58, 138, 0.7), rgba(30, 58, 138, 0.7)), 
                        url('/img/Frontend/bg-2.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .service-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .btn-primary {
            background-color: var(--sg-light-blue);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--sg-navy);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: white;
            color: var(--sg-light-blue);
            border: 2px solid var(--sg-light-blue);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: var(--sg-light-blue);
            color: white;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Test specific styles */
        .comparison-section {
            border: 2px dashed #e5e7eb;
            margin: 2rem 0;
            padding: 1.5rem;
            border-radius: 0.5rem;
        }

        .test-badge {
            position: absolute;
            top: -10px;
            left: 20px;
            background: #10b981;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .performance-metrics {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 1rem;
            margin: 1rem 0;
        }

        .metric-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .metric-item:last-child {
            border-bottom: none;
        }

        .metric-value {
            font-weight: 600;
        }

        .good { color: #10b981; }
        .warning { color: #f59e0b; }
        .bad { color: #ef4444; }
    </style>
</head>
<body class="font-sg bg-white">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold sg-navy">Tailwind CSS Comparison Test</h1>
                </div>
                <nav class="hidden md:flex space-x-8">
                    <a href="/" class="text-gray-600 hover:text-sg-light-blue">← Back to Home</a>
                    <a href="/test-vite" class="text-sg-light-blue hover:text-sg-navy">Vite Version</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Current Implementation Info -->
        <div class="comparison-section relative">
            <div class="test-badge">CDN TAILWIND</div>
            
            <h2 class="text-3xl font-bold text-sg-navy mb-4">Current Implementation (CDN Tailwind)</h2>
            <p class="text-gray-600 mb-6">This is how the current <code>layouts/main.blade.php</code> works using CDN Tailwind CSS.</p>
            
            <!-- Performance Metrics -->
            <div class="performance-metrics">
                <h3 class="font-semibold text-lg mb-3">Performance Characteristics</h3>
                <div class="metric-item">
                    <span>Bundle Size:</span>
                    <span class="metric-value bad">~3MB+ (Full Tailwind)</span>
                </div>
                <div class="metric-item">
                    <span>Load Time:</span>
                    <span class="metric-value warning">Depends on CDN</span>
                </div>
                <div class="metric-item">
                    <span>Tree Shaking:</span>
                    <span class="metric-value bad">None</span>
                </div>
                <div class="metric-item">
                    <span>Customization:</span>
                    <span class="metric-value warning">Limited</span>
                </div>
                <div class="metric-item">
                    <span>Build Process:</span>
                    <span class="metric-value good">None Required</span>
                </div>
            </div>
        </div>

        <!-- Hero Section Test -->
        <section class="hero-bg min-h-96 flex items-center justify-center text-white rounded-lg mb-8">
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-4">Hero Section Test</h1>
                <p class="text-xl mb-8">Testing hero section with background image and gradient overlay</p>
                <div class="space-x-4">
                    <button class="btn-primary px-8 py-3 rounded-lg font-semibold">
                        <i class="fas fa-phone mr-2"></i>Call Now
                    </button>
                    <button class="btn-secondary px-8 py-3 rounded-lg font-semibold">
                        <i class="fas fa-envelope mr-2"></i>Contact Us
                    </button>
                </div>
            </div>
        </section>

        <!-- Grid Layout Test -->
        <section class="mb-8">
            <h2 class="text-3xl font-bold text-sg-navy mb-6">Grid Layout Test</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="service-card bg-white p-6 rounded-lg">
                    <div class="w-12 h-12 bg-sg-light-blue rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-sg-navy mb-3">Student Visas</h3>
                    <p class="text-gray-600 line-clamp-3">Study in Australia with our expert guidance for student visa applications and course selection.</p>
                    <a href="#" class="inline-flex items-center text-sg-light-blue font-semibold mt-4">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <div class="service-card bg-white p-6 rounded-lg">
                    <div class="w-12 h-12 bg-sg-light-blue rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-briefcase text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-sg-navy mb-3">Work Visas</h3>
                    <p class="text-gray-600 line-clamp-3">Explore work opportunities in Australia with our comprehensive work visa services.</p>
                    <a href="#" class="inline-flex items-center text-sg-light-blue font-semibold mt-4">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <div class="service-card bg-white p-6 rounded-lg">
                    <div class="w-12 h-12 bg-sg-light-blue rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-sg-navy mb-3">Family Visas</h3>
                    <p class="text-gray-600 line-clamp-3">Reunite with your family in Australia through our family visa services.</p>
                    <a href="#" class="inline-flex items-center text-sg-light-blue font-semibold mt-4">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Typography Test -->
        <section class="mb-8">
            <h2 class="text-3xl font-bold text-sg-navy mb-6">Typography Test</h2>
            <div class="space-y-4">
                <h1 class="text-4xl font-bold text-sg-navy">Heading 1 - 4xl Bold</h1>
                <h2 class="text-3xl font-semibold text-sg-navy">Heading 2 - 3xl Semibold</h2>
                <h3 class="text-2xl font-medium text-sg-navy">Heading 3 - 2xl Medium</h3>
                <h4 class="text-xl font-medium text-sg-navy">Heading 4 - xl Medium</h4>
                <p class="text-lg text-gray-600">Large paragraph text with good readability for body content.</p>
                <p class="text-base text-gray-600">Regular paragraph text for standard content and descriptions.</p>
                <p class="text-sm text-gray-500">Small text for captions, metadata, and secondary information.</p>
            </div>
        </section>

        <!-- Form Elements Test -->
        <section class="mb-8">
            <h2 class="text-3xl font-bold text-sg-navy mb-6">Form Elements Test</h2>
            <div class="max-w-md space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sg-light-blue focus:border-sg-light-blue" placeholder="Enter your name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sg-light-blue focus:border-sg-light-blue" placeholder="Enter your email">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <textarea rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sg-light-blue focus:border-sg-light-blue" placeholder="Enter your message"></textarea>
                </div>
                <button class="btn-primary px-6 py-2 rounded-lg font-semibold w-full">
                    <i class="fas fa-paper-plane mr-2"></i>Send Message
                </button>
            </div>
        </section>

        <!-- Responsive Design Test -->
        <section class="mb-8">
            <h2 class="text-3xl font-bold text-sg-navy mb-6">Responsive Design Test</h2>
            <div class="bg-sg-light-gray p-4 rounded-lg">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white p-4 rounded text-center">
                        <div class="text-2xl font-bold text-sg-navy">1</div>
                        <div class="text-sm text-gray-600">Mobile First</div>
                    </div>
                    <div class="bg-white p-4 rounded text-center">
                        <div class="text-2xl font-bold text-sg-navy">2</div>
                        <div class="text-sm text-gray-600">Tablet</div>
                    </div>
                    <div class="bg-white p-4 rounded text-center">
                        <div class="text-2xl font-bold text-sg-navy">3</div>
                        <div class="text-sm text-gray-600">Desktop</div>
                    </div>
                    <div class="bg-white p-4 rounded text-center">
                        <div class="text-2xl font-bold text-sg-navy">4</div>
                        <div class="text-sm text-gray-600">Large Desktop</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- JavaScript Test -->
        <section class="mb-8">
            <h2 class="text-3xl font-bold text-sg-navy mb-6">JavaScript Interaction Test</h2>
            <div class="space-y-4">
                <button id="test-button" class="btn-primary px-6 py-3 rounded-lg font-semibold">
                    Click to Test JavaScript
                </button>
                <div id="test-result" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    JavaScript is working correctly!
                </div>
            </div>
        </section>

        <!-- Performance Comparison -->
        <section class="mb-8">
            <h2 class="text-3xl font-bold text-sg-navy mb-6">Performance Comparison</h2>
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-yellow-800 mb-3">
                    <i class="fas fa-exclamation-triangle mr-2"></i>CDN Tailwind Issues
                </h3>
                <ul class="space-y-2 text-yellow-700">
                    <li class="flex items-start">
                        <i class="fas fa-times-circle mr-2 mt-1 text-red-500"></i>
                        <span><strong>Large Bundle Size:</strong> Includes entire Tailwind framework (~3MB+)</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-times-circle mr-2 mt-1 text-red-500"></i>
                        <span><strong>No Tree Shaking:</strong> Unused CSS classes are not removed</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-times-circle mr-2 mt-1 text-red-500"></i>
                        <span><strong>External Dependency:</strong> Relies on CDN availability</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-times-circle mr-2 mt-1 text-red-500"></i>
                        <span><strong>Limited Customization:</strong> Harder to customize theme</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-times-circle mr-2 mt-1 text-red-500"></i>
                        <span><strong>Inconsistent with Vite:</strong> Different from admin pages</span>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Next Steps -->
        <section class="bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-blue-800 mb-3">
                <i class="fas fa-lightbulb mr-2"></i>Next Steps
            </h3>
            <p class="text-blue-700 mb-4">
                To see the Vite implementation, visit: <a href="/test-vite" class="font-semibold underline">/test-vite</a>
            </p>
            <p class="text-blue-700">
                The Vite version will show optimized Tailwind CSS with proper tree-shaking and smaller bundle sizes.
            </p>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-sg-navy text-white py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-sg-sky-blue">Tailwind CSS Comparison Test - CDN Implementation</p>
                <p class="text-sm text-gray-400 mt-2">This page uses CDN Tailwind CSS as currently implemented in layouts/main.blade.php</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Test JavaScript functionality
        document.addEventListener('DOMContentLoaded', function() {
            const testButton = document.getElementById('test-button');
            const testResult = document.getElementById('test-result');
            
            if (testButton && testResult) {
                testButton.addEventListener('click', function() {
                    testResult.classList.remove('hidden');
                    setTimeout(() => {
                        testResult.classList.add('hidden');
                    }, 3000);
                });
            }

            // Add hover effects to service cards
            document.querySelectorAll('.service-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Performance monitoring
            window.addEventListener('load', function() {
                const loadTime = performance.now();
                console.log(`CDN Tailwind page loaded in ${loadTime.toFixed(2)}ms`);
                
                // Log CSS size information
                console.log('CDN Tailwind CSS loaded - includes entire framework');
                console.log('Bundle size: ~3MB+ (estimated)');
            });
        });
    </script>
</body>
</html>
