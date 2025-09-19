@extends('layouts.frontend')
@section('seoinfo')
    <title>About Us - Bansal Immigration Consultants | Expert Migration Agents</title>
    <meta name="description" content="Learn about Bansal Immigration Consultants - MARA registered migration agents with 10+ years experience helping 5000+ clients achieve their Australian dreams.">
    <meta property="og:title" content="About Bansal Immigration Consultants - Expert Migration Agents">
    <meta property="og:description" content="MARA registered migration agents with 10+ years experience helping clients achieve permanent residency, study abroad, and family reunification in Australia.">
    <meta property="og:image" content="{{ asset('img/bansal-immigration-icon.jpg') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/about') }}">
@endsection
@section('content')
    <!-- Hero Section -->
    <section class="py-20 bg-gradient-to-r from-blue-900 to-blue-800 text-white">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">About Bansal Immigration</h1>
                <p class="text-xl md:text-2xl text-gray-200 mb-8">Your Future, Our Priority</p>
                <p class="text-lg text-gray-300 max-w-3xl mx-auto">MARA registered migration agents with over 10 years of experience, helping thousands of families achieve their Australian dreams through expert guidance and personalized service.</p>
            </div>
        </div>
    </section>

    <!-- Company Overview -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">Who We Are</h2>
                        <p class="text-lg text-gray-600 mb-6">Bansal Immigration Consultants is a premier immigration consultancy firm based in Melbourne, Australia. With over a decade of experience, we specialize in providing comprehensive immigration services tailored to meet the unique needs of our clients.</p>
                        <p class="text-lg text-gray-600 mb-6">Our commitment is encapsulated in our tagline: "Your Future, Our Priority." We are dedicated to transforming your immigration aspirations into reality through expert guidance, personalized attention, and unwavering support throughout your journey.</p>
                        <div class="flex flex-wrap gap-4">
                            <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-semibold">MARA Registered</div>
                            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold">10+ Years Experience</div>
                            <div class="bg-purple-100 text-purple-800 px-4 py-2 rounded-full text-sm font-semibold">5000+ Success Stories</div>
                            <div class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-semibold">95% Success Rate</div>
                        </div>
                    </div>
                    <div class="relative">
                        <img src="{{ asset('img/team/team-photo.jpg') }}" alt="Bansal Immigration Team" class="rounded-2xl shadow-2xl w-full">
                        <div class="absolute -bottom-6 -right-6 bg-yellow-400 text-black px-6 py-3 rounded-lg font-bold text-lg">
                            Trusted by 5000+ Families
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Values -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Mission & Values</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">We are committed to providing ethical, knowledgeable, and professional immigration services</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-heart text-2xl text-blue-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Ethics</h3>
                        <p class="text-gray-600">We prioritize ethical practices in all client dealings, adhering to traditional business paradigms and maintaining the highest standards of integrity.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-graduation-cap text-2xl text-green-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Knowledge</h3>
                        <p class="text-gray-600">Our extensive industry experience equips us with comprehensive knowledge of visa requirements across various schemes and countries.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-handshake text-2xl text-purple-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Integrity</h3>
                        <p class="text-gray-600">We deliver on our promises, striving to provide all necessary services as conveyed during the profile assessment.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
                        <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-users text-2xl text-orange-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Professionalism</h3>
                        <p class="text-gray-600">Our team comprises highly effective professionals dedicated to establishing respect and trust with our clients.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
                        <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-bullseye text-2xl text-teal-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Accuracy</h3>
                        <p class="text-gray-600">We ensure accurate information delivery in a simple yet effective manner, tailored to individual needs and circumstances.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-shield-alt text-2xl text-red-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Trust</h3>
                        <p class="text-gray-600">Backed by MARA certification, we guarantee a No Visa, No Fee policy, providing added assurance to our clients.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="py-20 bg-gradient-to-r from-blue-900 to-blue-800 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold mb-4">Meet Our Expert Team</h2>
                    <p class="text-xl text-gray-300 max-w-3xl mx-auto">MARA registered migration agents with extensive experience and proven track records</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Arun Bansal -->
                    <div class="text-center group">
                        <div class="relative mb-6">
                            <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-yellow-400 group-hover:border-yellow-300 transition-colors">
                                <img src="{{ asset('img/profile_imgs/Arun Sir.png') }}" alt="Arun Bansal" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-yellow-400 text-black px-3 py-1 rounded-full text-xs font-bold">
                                Director
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Arun Bansal</h3>
                        <p class="text-yellow-400 text-sm mb-3 font-medium">MARN: 2418466</p>
                        <p class="text-gray-300 text-sm leading-relaxed">Director with 10+ years of legal and migration experience. Specializes in complex visa cases and appeals.</p>
                    </div>

                    <!-- Vipul Goyal -->
                    <div class="text-center group">
                        <div class="relative mb-6">
                            <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-yellow-400 group-hover:border-yellow-300 transition-colors">
                                <img src="{{ asset('img/profile_imgs/Vipul Sir.png') }}" alt="Vipul Goyal" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-yellow-400 text-black px-3 py-1 rounded-full text-xs font-bold">
                                Migration Agent
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Vipul Goyal</h3>
                        <p class="text-yellow-400 text-sm mb-3 font-medium">MARN: 2418571</p>
                        <p class="text-gray-300 text-sm leading-relaxed">Experienced Migration Agent specializing in skilled migration and family visa applications.</p>
                    </div>

                    <!-- Mamta Puri -->
                    <div class="text-center group">
                        <div class="relative mb-6">
                            <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-yellow-400 group-hover:border-yellow-300 transition-colors">
                                <img src="{{ asset('img/profile_imgs/Maleesha Maam.png') }}" alt="Mamta Puri" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-yellow-400 text-black px-3 py-1 rounded-full text-xs font-bold">
                                Migration Agent
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Mamta Puri</h3>
                        <p class="text-yellow-400 text-sm mb-3 font-medium">MARN: 1569359</p>
                        <p class="text-gray-300 text-sm leading-relaxed">Dedicated Migration Agent with expertise in student visas and partner visa applications.</p>
                    </div>

                    <!-- Iqbal -->
                    <div class="text-center group">
                        <div class="relative mb-6">
                            <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-yellow-400 group-hover:border-yellow-300 transition-colors">
                                <img src="{{ asset('img/profile_imgs/Iqbal Sir.png') }}" alt="Iqbal" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-yellow-400 text-black px-3 py-1 rounded-full text-xs font-bold">
                                Migration Agent
                            </div>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Iqbal</h3>
                        <p class="text-yellow-400 text-sm mb-3 font-medium">MARN: [To be provided]</p>
                        <p class="text-gray-300 text-sm leading-relaxed">Experienced Migration Agent committed to providing personalized service and expert guidance.</p>
                    </div>
                </div>
                
                <div class="text-center mt-12">
                    <a href="{{ route('contact') }}" class="inline-flex items-center bg-yellow-400 text-black px-8 py-4 rounded-lg font-bold text-lg hover:bg-yellow-300 transition-colors transform hover:scale-105">
                        Contact Our Team <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Success in Numbers</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Trusted by thousands of families worldwide for their migration journey</p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-5xl md:text-6xl font-bold text-blue-600 mb-2">5000+</div>
                        <div class="text-lg text-gray-600">Successful Cases</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl md:text-6xl font-bold text-green-600 mb-2">95%</div>
                        <div class="text-lg text-gray-600">Success Rate</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl md:text-6xl font-bold text-purple-600 mb-2">10+</div>
                        <div class="text-lg text-gray-600">Years Experience</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl md:text-6xl font-bold text-orange-600 mb-2">50+</div>
                        <div class="text-lg text-gray-600">Countries Served</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section class="py-20 bg-gradient-to-r from-yellow-400 to-orange-500 text-black">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">Ready to Start Your Migration Journey?</h2>
                <p class="text-xl md:text-2xl mb-8 text-gray-800">Don't let your dreams wait. Get expert guidance from MARA registered migration agents today.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                    <a href="{{ route('appointment') }}" class="group bg-black text-white hover:bg-gray-800 px-8 py-4 rounded-lg font-bold text-lg transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-calendar-alt mr-2"></i>Book Free Consultation
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="tel:+61396021330" class="group border-2 border-black text-black hover:bg-black hover:text-white px-8 py-4 rounded-lg font-bold text-lg transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-phone mr-2"></i>Call Now: +61 3 9602 1330
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                <div class="flex flex-wrap justify-center items-center gap-8 text-sm text-gray-700">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        <span>Free Initial Consultation</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        <span>MARA Registered Agents</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        <span>No Win, No Fee Policy</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
