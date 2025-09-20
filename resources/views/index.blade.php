@extends('layouts.main')

@section('title', 'Bansal Immigration - Expert Australian Migration Services')
@section('description', 'Professional Australian immigration consultants helping you achieve permanent residency, study abroad, and family reunification in Australia. MARA registered migration agents.')

@section('content')
<!-- Hero Section -->
<section class="hero-bg min-h-screen flex items-center relative">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0"></div>
    
    <!-- Hero Content -->
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="max-w-md">
            <!-- Hero Overlay Box -->
            <div class="hero-overlay p-4 rounded-lg shadow-2xl">
                <h1 class="text-2xl md:text-3xl font-bold sg-navy mb-3 leading-tight">
                    Your Australian Dream Starts Here
                </h1>
                <p class="text-base sg-dark-gray mb-4 leading-relaxed">
                    Professional Australian immigration consultants helping you achieve permanent residency, study abroad, and family reunification in Australia. MARA registered migration agents.
                </p>
                <a href="/appointment" class="btn-primary px-5 py-2 rounded-lg text-sm font-semibold inline-block">
                    Book Free Consultation
                </a>
            </div>
        </div>
    </div>
</section>

<!-- How we can help you Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold sg-navy mb-4">How we can help you</h2>
        </div>
        
        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Study in Australia -->
            <div class="service-card bg-white p-6 rounded-lg text-center">
                <div class="service-icon mx-auto mb-4">
                    <i class="fas fa-graduation-cap text-4xl"></i>
                </div>
                <h3 class="text-lg font-semibold sg-dark-gray mb-2">Study in Australia</h3>
                <a href="/study-australia" class="sg-light-blue text-sm font-medium hover:underline">Find out more</a>
            </div>

            <!-- Skilled Migration -->
            <div class="service-card bg-white p-6 rounded-lg text-center">
                <div class="service-icon mx-auto mb-4">
                    <i class="fas fa-briefcase text-4xl"></i>
                </div>
                <h3 class="text-lg font-semibold sg-dark-gray mb-2">Skilled Migration</h3>
                <a href="/migration" class="sg-light-blue text-sm font-medium hover:underline">Find out more</a>
            </div>

            <!-- Family Visas -->
            <div class="service-card bg-white p-6 rounded-lg text-center">
                <div class="service-icon mx-auto mb-4">
                    <i class="fas fa-heart text-4xl"></i>
                </div>
                <h3 class="text-lg font-semibold sg-dark-gray mb-2">Family Visas</h3>
                <a href="/family-visa" class="sg-light-blue text-sm font-medium hover:underline">Find out more</a>
            </div>

            <!-- Visitor Visas -->
            <div class="service-card bg-white p-6 rounded-lg text-center">
                <div class="service-icon mx-auto mb-4">
                    <i class="fas fa-plane text-4xl"></i>
                </div>
                <h3 class="text-lg font-semibold sg-dark-gray mb-2">Visitor Visas</h3>
                <a href="/visitor-visa" class="sg-light-blue text-sm font-medium hover:underline">Find out more</a>
            </div>

            <!-- Business Visas -->
            <div class="service-card bg-white p-6 rounded-lg text-center">
                <div class="service-icon mx-auto mb-4">
                    <i class="fas fa-chart-line text-4xl"></i>
                </div>
                <h3 class="text-lg font-semibold sg-dark-gray mb-2">Business Visas</h3>
                <a href="/business-visas" class="sg-light-blue text-sm font-medium hover:underline">Find out more</a>
            </div>

            <!-- Employee Sponsored -->
            <div class="service-card bg-white p-6 rounded-lg text-center">
                <div class="service-icon mx-auto mb-4">
                    <i class="fas fa-user-tie text-4xl"></i>
                </div>
                <h3 class="text-lg font-semibold sg-dark-gray mb-2">Employee Sponsored</h3>
                <a href="/employee-sponsored" class="sg-light-blue text-sm font-medium hover:underline">Find out more</a>
            </div>

            <!-- Appeals & Reviews -->
            <div class="service-card bg-white p-6 rounded-lg text-center">
                <div class="service-icon mx-auto mb-4">
                    <i class="fas fa-gavel text-4xl"></i>
                </div>
                <h3 class="text-lg font-semibold sg-dark-gray mb-2">Appeals & Reviews</h3>
                <a href="/appeals" class="sg-light-blue text-sm font-medium hover:underline">Find out more</a>
            </div>

            <!-- Citizenship -->
            <div class="service-card bg-white p-6 rounded-lg text-center">
                <div class="service-icon mx-auto mb-4">
                    <i class="fas fa-flag text-4xl"></i>
                </div>
                <h3 class="text-lg font-semibold sg-dark-gray mb-2">Citizenship</h3>
                <a href="/citizenship" class="sg-light-blue text-sm font-medium hover:underline">Find out more</a>
            </div>
        </div>
    </div>
</section>

<!-- Immigration Services Section (Customized for Bansal Immigration) -->
<section class="py-20 bg-sg-light-gray">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold sg-navy mb-4">Our Immigration Services</h2>
            <p class="text-xl sg-medium-gray max-w-3xl mx-auto">Professional migration services tailored to your needs</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Study Visa -->
            <div class="service-card bg-white p-8 rounded-lg">
                <div class="service-icon mx-auto mb-6">
                    <i class="fas fa-graduation-cap text-4xl"></i>
                </div>
                <h3 class="text-2xl font-bold sg-navy mb-4">Study in Australia</h3>
                <p class="sg-medium-gray mb-6">Pursue your education dreams in Australia's world-class universities with our expert guidance.</p>
                <a href="/study-australia" class="sg-light-blue font-semibold hover:underline">Learn More <i class="fas fa-arrow-right ml-2"></i></a>
            </div>

            <!-- Skilled Migration -->
            <div class="service-card bg-white p-8 rounded-lg">
                <div class="service-icon mx-auto mb-6">
                    <i class="fas fa-briefcase text-4xl"></i>
                </div>
                <h3 class="text-2xl font-bold sg-navy mb-4">Skilled Migration</h3>
                <p class="sg-medium-gray mb-6">Fast-track your permanent residency through Australia's skilled migration programs.</p>
                <a href="/migration" class="sg-light-blue font-semibold hover:underline">Learn More <i class="fas fa-arrow-right ml-2"></i></a>
            </div>

            <!-- Family Visa -->
            <div class="service-card bg-white p-8 rounded-lg">
                <div class="service-icon mx-auto mb-6">
                    <i class="fas fa-heart text-4xl"></i>
                </div>
                <h3 class="text-2xl font-bold sg-navy mb-4">Family Reunification</h3>
                <p class="sg-medium-gray mb-6">Bring your loved ones together with our comprehensive family visa services.</p>
                <a href="/family-visa" class="sg-light-blue font-semibold hover:underline">Learn More <i class="fas fa-arrow-right ml-2"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold sg-navy mb-4">Why Choose Bansal Immigration?</h2>
            <p class="text-xl sg-medium-gray max-w-3xl mx-auto">We're not just consultants; we're your partners in achieving your migration dreams</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="w-20 h-20 bg-sg-sky-blue rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-certificate text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold sg-navy mb-4">MARA Registered</h3>
                <p class="sg-medium-gray">All our migration agents are registered with the Migration Agents Registration Authority (MARA).</p>
            </div>
            
            <div class="text-center p-6">
                <div class="w-20 h-20 bg-sg-sky-blue rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-chart-line text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold sg-navy mb-4">Proven Track Record</h3>
                <p class="sg-medium-gray">With over 10 years of experience and 5000+ successful cases, we have the expertise you need.</p>
            </div>
            
            <div class="text-center p-6">
                <div class="w-20 h-20 bg-sg-sky-blue rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-users text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold sg-navy mb-4">Personalized Service</h3>
                <p class="sg-medium-gray">Every case is unique. We provide personalized attention and customized solutions.</p>
            </div>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="py-20 bg-sg-light-gray">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold sg-navy mb-4">Latest from Our Blog</h2>
            <p class="text-xl sg-medium-gray max-w-3xl mx-auto">Stay updated with the latest immigration news, tips, and insights from our experts</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @if(isset($blogLists) && $blogLists->count() > 0)
                @foreach($blogLists as $blog)
                    <article class="service-card bg-white p-6 rounded-lg">
                        @if($blog->image)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->image_alt ?? $blog->title }}" class="w-full h-48 object-cover rounded-lg">
                            </div>
                        @endif
                        <div class="mb-4">
                            <span class="text-sm text-sg-light-blue font-medium">{{ $blog->created_at->format('M d, Y') }}</span>
                        </div>
                        <h3 class="text-xl font-bold sg-navy mb-3 line-clamp-2">{{ $blog->title }}</h3>
                        <p class="sg-medium-gray mb-4 line-clamp-3">{{ $blog->short_description }}</p>
                        <a href="/blogs/{{ $blog->slug }}" class="sg-light-blue font-semibold hover:underline">
                            Read More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </article>
                @endforeach
            @else
                <!-- Fallback content when no blogs are available -->
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-blog text-6xl text-sg-light-blue mb-4"></i>
                    <h3 class="text-2xl font-bold sg-navy mb-2">Blog Coming Soon</h3>
                    <p class="sg-medium-gray">We're preparing valuable content for you. Check back soon!</p>
                </div>
            @endif
        </div>
        
        <div class="text-center">
            <a href="/blogs" class="btn-primary px-8 py-4 rounded-lg text-lg font-semibold inline-block">
                <i class="fas fa-blog mr-2"></i>View All Blogs
            </a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold sg-navy mb-4">What Our Clients Say</h2>
            <p class="text-xl sg-medium-gray max-w-3xl mx-auto">Real stories from real people who achieved their Australian dreams with our help</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @if(isset($testimonials) && count($testimonials) > 0)
                @foreach($testimonials as $testimonial)
                    <div class="service-card bg-white p-8 rounded-lg text-center">
                        <div class="flex justify-center mb-4">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star text-yellow-400 text-lg"></i>
                            @endfor
                        </div>
                        <blockquote class="sg-medium-gray mb-6 italic text-lg leading-relaxed">
                            "{{ $testimonial['text'] }}"
                        </blockquote>
                        <div class="border-t border-gray-200 pt-4">
                            <h4 class="font-bold sg-navy text-lg">{{ $testimonial['name'] }}</h4>
                            <p class="text-sg-light-blue font-medium">{{ $testimonial['visa_type'] }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback content when no testimonials are available -->
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-quote-left text-6xl text-sg-light-blue mb-4"></i>
                    <h3 class="text-2xl font-bold sg-navy mb-2">Client Testimonials</h3>
                    <p class="sg-medium-gray">Hear from our satisfied clients about their success stories.</p>
                </div>
            @endif
        </div>
        
        <div class="text-center">
            <a href="/success-stories" class="btn-secondary px-8 py-4 rounded-lg text-lg font-semibold inline-block">
                <i class="fas fa-trophy mr-2"></i>View Success Stories
            </a>
        </div>
    </div>
</section>

<!-- Our Team Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold sg-navy mb-4">Meet Our Expert Team</h2>
            <p class="text-xl sg-medium-gray max-w-3xl mx-auto">Professional migration agents with years of experience helping you achieve your Australian dreams</p>
        </div>
        
        <!-- Team Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <!-- Arun Bansal - Director -->
            <div class="service-card bg-white p-8 rounded-lg text-center">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-sg-light-blue shadow-lg mb-6">
                    <img src="/img/team/arun-bansal.jpg" alt="Arun Bansal" class="w-full h-full object-cover">
                </div>
                <h3 class="text-2xl font-bold sg-navy mb-2">Arun Bansal</h3>
                <p class="text-sg-light-blue font-semibold mb-4">Director (MARN: 2418466)</p>
                <p class="sg-medium-gray text-sm leading-relaxed">
                    Director of Bansal Immigration Consultants with 10+ years of legal and migration experience, offering expert guidance backed by LLM and Migration Law qualifications.
                </p>
            </div>
            
            <!-- Vipul Goyal -->
            <div class="service-card bg-white p-8 rounded-lg text-center">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-sg-light-blue shadow-lg mb-6">
                    <img src="/img/team/vipul-goyal.jpg" alt="Vipul Goyal" class="w-full h-full object-cover">
                </div>
                <h3 class="text-2xl font-bold sg-navy mb-2">Vipul Goyal</h3>
                <p class="text-sg-light-blue font-semibold mb-4">Migration Agent (MARA: 2418571)</p>
                <p class="sg-medium-gray text-sm leading-relaxed">
                    Provides expert guidance across skilled, student, and family visas with deep legal knowledge and a client-focused approach.
                </p>
            </div>
            
            <!-- Mandeep Singh -->
            <div class="service-card bg-white p-8 rounded-lg text-center">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-sg-light-blue shadow-lg mb-6">
                    <img src="/img/team/mandeep-singh.jpg" alt="Mandeep Singh" class="w-full h-full object-cover">
                </div>
                <h3 class="text-2xl font-bold sg-navy mb-2">Mandeep Singh</h3>
                <p class="text-sg-light-blue font-semibold mb-4">Migration Agent (MARA: 2518789)</p>
                <p class="sg-medium-gray text-sm leading-relaxed">
                    Offers expert support in student, partner, and skilled visas, guiding clients with clarity, precision, and personalised migration solutions.
                </p>
            </div>
            
            <!-- Iqbal Singh Sran -->
            <div class="service-card bg-white p-8 rounded-lg text-center">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-sg-light-blue shadow-lg mb-6">
                    <img src="/img/team/iqbal-singh-sran.jpg" alt="Iqbal Singh Sran" class="w-full h-full object-cover">
                </div>
                <h3 class="text-2xl font-bold sg-navy mb-2">Iqbal Singh Sran</h3>
                <p class="text-sg-light-blue font-semibold mb-4">Migration Agent (MARA: 2418677)</p>
                <p class="sg-medium-gray text-sm leading-relaxed">
                    Specialises in student, partner, and skilled visas, delivering trusted advice and personalised solutions to make every migration journey smooth and successful.
                </p>
            </div>
            
            <!-- Yadwinder Pal Singh -->
            <div class="service-card bg-white p-8 rounded-lg text-center">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-sg-light-blue shadow-lg mb-6">
                    <img src="/img/team/yadwinder-pal-singh.jpg" alt="Yadwinder Pal Singh" class="w-full h-full object-cover">
                </div>
                <h3 class="text-2xl font-bold sg-navy mb-2">Yadwinder Pal Singh</h3>
                <p class="text-sg-light-blue font-semibold mb-4">Migration Agent (MARA: 2519042)</p>
                <p class="sg-medium-gray text-sm leading-relaxed">
                    Specialises in Employer Sponsored, Skilled, Partner, Student, and Temporary Residence visas with an empathetic and personalised approach.
                </p>
            </div>
        </div>
        
        <!-- CTA -->
        <div class="text-center">
            <a href="/contact" class="btn-primary px-8 py-4 rounded-lg text-lg font-semibold inline-block">
                <i class="fas fa-envelope mr-2"></i>Contact Our Team
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-sg-light-gray">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Side - Text Content -->
            <div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-sg-navy">We're here to help</h2>
                <p class="text-xl text-sg-dark-gray leading-relaxed">Start your migration journey today. Or, if you have a question, get in touch with our team.</p>
            </div>
                
            <!-- Right Side - Three Action Buttons -->
            <div class="space-y-4">
                <!-- Book an Appointment -->
                <a href="/appointment" class="block w-full bg-sg-navy text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-sg-light-blue transition-colors text-center shadow-lg">
                    <i class="fas fa-calendar-alt mr-2"></i>Book an Appointment
                </a>
                
                <!-- Make an Enquiry -->
                <a href="/contact" class="block w-full bg-sg-light-blue text-sg-navy px-8 py-4 rounded-lg font-bold text-lg hover:bg-sg-sky-blue hover:text-white transition-colors text-center shadow-lg">
                    <i class="fas fa-envelope mr-2"></i>Make an Enquiry
                </a>
                
                <!-- Call Us -->
                <a href="tel:+61396021330" class="block w-full bg-white border-2 border-gray-300 text-sg-navy px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-50 transition-colors text-center shadow-lg">
                    <i class="fas fa-phone mr-2"></i>Call us on +61 3 9602 1330
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
