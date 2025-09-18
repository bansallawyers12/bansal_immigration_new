/**
 * Modern Home Page Enhancements for Bansal Immigration
 * Includes lazy loading, animations, API integration, and performance monitoring
 */

class HomePageEnhancements {
    constructor() {
        this.apiBase = '/api/home';
        this.isLoading = false;
        this.observers = new Map();
        
        this.init();
    }

    init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setupEnhancements());
        } else {
            this.setupEnhancements();
        }
    }

    setupEnhancements() {
        this.setupLazyLoading();
        this.setupCounterAnimations();
        this.setupSmoothScrolling();
        this.setupParallaxEffects();
        this.setupDynamicContent();
        this.setupSearch();
        this.setupNewsletter();
        this.setupPerformanceMonitoring();
        this.setupAccessibility();
    }

    /**
     * Lazy loading for images and sections
     */
    setupLazyLoading() {
        // Lazy load images
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px 0px',
            threshold: 0.1
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });

        // Lazy load sections
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    sectionObserver.unobserve(entry.target);
                }
            });
        }, {
            rootMargin: '100px 0px',
            threshold: 0.1
        });

        document.querySelectorAll('.lazy-section').forEach(section => {
            sectionObserver.observe(section);
        });

        this.observers.set('image', imageObserver);
        this.observers.set('section', sectionObserver);
    }

    /**
     * Animated counters for statistics
     */
    setupCounterAnimations() {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                    this.animateCounter(entry.target);
                    entry.target.classList.add('animated');
                    counterObserver.unobserve(entry.target);
                }
            });
        }, {
            rootMargin: '50px 0px',
            threshold: 0.5
        });

        document.querySelectorAll('.counter').forEach(counter => {
            counterObserver.observe(counter);
        });
    }

    animateCounter(element) {
        const target = parseInt(element.dataset.target);
        const duration = 2000; // 2 seconds
        const start = performance.now();
        
        const updateCounter = (currentTime) => {
            const elapsed = currentTime - start;
            const progress = Math.min(elapsed / duration, 1);
            
            // Easing function for smooth animation
            const easeOutQuart = 1 - Math.pow(1 - progress, 4);
            const current = Math.floor(target * easeOutQuart);
            
            element.textContent = current.toLocaleString();
            
            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target.toLocaleString();
            }
        };
        
        requestAnimationFrame(updateCounter);
    }

    /**
     * Smooth scrolling navigation
     */
    setupSmoothScrolling() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(anchor.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll effect to navigation
        let lastScrollTop = 0;
        const header = document.querySelector('header');
        
        window.addEventListener('scroll', () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            
            // Hide/show header on scroll
            if (scrollTop > lastScrollTop && scrollTop > 200) {
                header.classList.add('header-hidden');
            } else {
                header.classList.remove('header-hidden');
            }
            
            lastScrollTop = scrollTop;
        });
    }

    /**
     * Parallax scrolling effects
     */
    setupParallaxEffects() {
        const parallaxElements = document.querySelectorAll('.parallax');
        
        if (parallaxElements.length === 0) return;
        
        const parallaxObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    window.addEventListener('scroll', () => this.updateParallax(entry.target));
                } else {
                    window.removeEventListener('scroll', () => this.updateParallax(entry.target));
                }
            });
        });

        parallaxElements.forEach(element => {
            parallaxObserver.observe(element);
        });
    }

    updateParallax(element) {
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.5;
        element.style.transform = `translateY(${rate}px)`;
    }

    /**
     * Dynamic content loading via API
     */
    setupDynamicContent() {
        // Load testimonials dynamically
        this.loadTestimonials();
        
        // Load latest blogs
        this.loadLatestBlogs();
        
        // Load success stories
        this.loadSuccessStories();
    }

    async loadTestimonials() {
        try {
            const response = await fetch(`${this.apiBase}/testimonials`);
            const data = await response.json();
            
            if (data.success) {
                this.updateTestimonialsSection(data.data);
            }
        } catch (error) {
            console.error('Error loading testimonials:', error);
        }
    }

    async loadLatestBlogs() {
        try {
            const response = await fetch(`${this.apiBase}/latest-blogs?limit=3`);
            const data = await response.json();
            
            if (data.success) {
                this.updateBlogsSection(data.data);
            }
        } catch (error) {
            console.error('Error loading blogs:', error);
        }
    }

    async loadSuccessStories() {
        try {
            const response = await fetch(`${this.apiBase}/success-stories?limit=3`);
            const data = await response.json();
            
            if (data.success) {
                this.updateSuccessStoriesSection(data.data);
            }
        } catch (error) {
            console.error('Error loading success stories:', error);
        }
    }

    updateTestimonialsSection(testimonials) {
        const container = document.querySelector('.testimonials-container');
        if (!container) return;

        container.innerHTML = testimonials.map(testimonial => `
            <div class="testimonial-card">
                <div class="flex items-center mb-4">
                    <img src="${testimonial.avatar}" alt="${testimonial.name}" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h4 class="font-bold">${testimonial.name}</h4>
                        <div class="flex text-yellow-400">
                            ${'★'.repeat(testimonial.rating)}
                        </div>
                    </div>
                </div>
                <p class="text-gray-200 italic">"${testimonial.text}"</p>
            </div>
        `).join('');
    }

    updateBlogsSection(blogs) {
        const container = document.querySelector('.blogs-container');
        if (!container) return;

        container.innerHTML = blogs.map(blog => `
            <article class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden group">
                <div class="relative overflow-hidden">
                    <a href="${blog.url}">
                        <img src="${blog.image}" alt="${blog.image_alt}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    </a>
                    <div class="absolute top-4 left-4 bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                        Immigration News
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span>${blog.date}</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                        <a href="${blog.url}">${blog.title}</a>
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">${blog.description}</p>
                    <a href="${blog.url}" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 group">
                        Read More <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </article>
        `).join('');
    }

    updateSuccessStoriesSection(stories) {
        // Implementation for success stories section
        console.log('Success stories loaded:', stories);
    }

    /**
     * Real-time search functionality
     */
    setupSearch() {
        const searchInput = document.querySelector('#search-input');
        const searchResults = document.querySelector('#search-results');
        
        if (!searchInput || !searchResults) return;

        let searchTimeout;
        
        searchInput.addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            const query = e.target.value.trim();
            
            if (query.length < 2) {
                searchResults.classList.add('hidden');
                return;
            }
            
            searchTimeout = setTimeout(() => {
                this.performSearch(query);
            }, 300); // Debounce search
        });
    }

    async performSearch(query) {
        try {
            const response = await fetch(`${this.apiBase}/search?q=${encodeURIComponent(query)}`);
            const data = await response.json();
            
            if (data.success) {
                this.displaySearchResults(data.data);
            }
        } catch (error) {
            console.error('Search error:', error);
        }
    }

    displaySearchResults(results) {
        const searchResults = document.querySelector('#search-results');
        if (!searchResults) return;

        if (results.length === 0) {
            searchResults.innerHTML = '<p class="p-4 text-gray-500">No results found</p>';
        } else {
            searchResults.innerHTML = results.map(result => `
                <div class="p-4 hover:bg-gray-50 border-b">
                    <h4 class="font-semibold text-blue-600">${result.title}</h4>
                    <p class="text-sm text-gray-600">${result.description}</p>
                    <span class="text-xs text-gray-400 capitalize">${result.type}</span>
                </div>
            `).join('');
        }
        
        searchResults.classList.remove('hidden');
    }

    /**
     * Newsletter subscription
     */
    setupNewsletter() {
        const newsletterForm = document.querySelector('#newsletter-form');
        if (!newsletterForm) return;

        newsletterForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(newsletterForm);
            const email = formData.get('email');
            
            try {
                const response = await fetch(`${this.apiBase}/newsletter`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ email })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    this.showNotification('Thank you for subscribing!', 'success');
                    newsletterForm.reset();
                } else {
                    this.showNotification('Subscription failed. Please try again.', 'error');
                }
            } catch (error) {
                console.error('Newsletter subscription error:', error);
                this.showNotification('Subscription failed. Please try again.', 'error');
            }
        });
    }

    /**
     * Performance monitoring
     */
    setupPerformanceMonitoring() {
        // Monitor Core Web Vitals
        if ('web-vital' in window) {
            // This would integrate with web-vitals library
            console.log('Performance monitoring enabled');
        }

        // Monitor page load time
        window.addEventListener('load', () => {
            const loadTime = performance.now();
            console.log(`Page loaded in ${loadTime.toFixed(2)}ms`);
        });
    }

    /**
     * Accessibility enhancements
     */
    setupAccessibility() {
        // Add skip links
        const skipLink = document.createElement('a');
        skipLink.href = '#main-content';
        skipLink.textContent = 'Skip to main content';
        skipLink.className = 'skip-link sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 bg-blue-600 text-white p-2 z-50';
        document.body.insertBefore(skipLink, document.body.firstChild);

        // Add ARIA labels to interactive elements
        document.querySelectorAll('button, a').forEach(element => {
            if (!element.getAttribute('aria-label') && !element.textContent.trim()) {
                element.setAttribute('aria-label', 'Interactive element');
            }
        });

        // Support reduced motion preference
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            document.documentElement.classList.add('reduce-motion');
        }
    }

    /**
     * Show notification
     */
    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
            type === 'success' ? 'bg-green-500 text-white' : 
            type === 'error' ? 'bg-red-500 text-white' : 
            'bg-blue-500 text-white'
        }`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    /**
     * Cleanup observers
     */
    destroy() {
        this.observers.forEach(observer => observer.disconnect());
        this.observers.clear();
    }
}

// Initialize when DOM is ready
const homePageEnhancements = new HomePageEnhancements();

// Export for potential use in other modules
window.HomePageEnhancements = HomePageEnhancements;
