@extends('layouts.frontend')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Migrate to Australia</h1>
                <p class="text-xl md:text-2xl mb-8">Complete Guide to All Australian Visa Options</p>
                <p class="text-lg mb-8">Discover the perfect pathway to Australia. From skilled migration to family visas, we have comprehensive information about every visa option available.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('appointment') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200">
                        Book Free Consultation
                    </a>
                    <a href="{{ route('migrate-to-australia.pr-calculator') }}" class="bg-blue-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-400 transition-colors duration-200">
                        Calculate Your Points
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Visa Categories Grid -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Choose Your Migration Pathway</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Skilled Migration -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-user-graduate text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Skilled Migration</h3>
                    </div>
                    <p class="text-gray-700 mb-6">Professional migration pathways for skilled workers to live and work in Australia permanently.</p>
                    <ul class="space-y-3 mb-6">
                        <li><a href="{{ route('migrate-to-australia.skilled-independent') }}" class="text-blue-600 hover:text-blue-800 font-medium">Skilled Independent (189)</a></li>
                        <li><a href="{{ route('migrate-to-australia.skilled-nominated') }}" class="text-blue-600 hover:text-blue-800 font-medium">Skilled Nominated (190)</a></li>
                        <li><a href="{{ route('migrate-to-australia.temporary-graduate') }}" class="text-blue-600 hover:text-blue-800 font-medium">Temporary Graduate (485)</a></li>
                        <li><a href="{{ route('migrate-to-australia.skilled-regional') }}" class="text-blue-600 hover:text-blue-800 font-medium">Skilled Regional (887)</a></li>
                        <li><a href="{{ route('migrate-to-australia.pr-skilled-regional') }}" class="text-blue-600 hover:text-blue-800 font-medium">PR Skilled Regional (191)</a></li>
                        <li><a href="{{ route('migrate-to-australia.skilled-work-regional') }}" class="text-blue-600 hover:text-blue-800 font-medium">Skilled Work Regional (491)</a></li>
                    </ul>
                    <a href="{{ route('migrate-to-australia.skilled-independent') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors duration-200">
                        Learn More
                    </a>
                </div>

                <!-- Family Visas -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-pink-100 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-heart text-pink-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Family Visas</h3>
                    </div>
                    <p class="text-gray-700 mb-6">Reunite with your family in Australia through various family visa options.</p>
                    <ul class="space-y-3 mb-6">
                        <li><a href="{{ route('family-visa.partner-provisional-309') }}" class="text-pink-600 hover:text-pink-800 font-medium">Partner Provisional (309)</a></li>
                        <li><a href="{{ route('family-visa.partner-permanent-100') }}" class="text-pink-600 hover:text-pink-800 font-medium">Partner Permanent (100)</a></li>
                        <li><a href="{{ route('family-visa.partner-provisional-820') }}" class="text-pink-600 hover:text-pink-800 font-medium">Partner Provisional (820)</a></li>
                        <li><a href="{{ route('family-visa.partner-permanent-801') }}" class="text-pink-600 hover:text-pink-800 font-medium">Partner Permanent (801)</a></li>
                        <li><a href="{{ route('family-visa.contributory-parent-143') }}" class="text-pink-600 hover:text-pink-800 font-medium">Contributory Parent (143)</a></li>
                        <li><a href="{{ route('family-visa.parent-visa-103') }}" class="text-pink-600 hover:text-pink-800 font-medium">Parent Visa (103)</a></li>
                    </ul>
                    <a href="{{ route('family-visa.partner-provisional-309') }}" class="inline-block bg-pink-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-pink-700 transition-colors duration-200">
                        Learn More
                    </a>
                </div>

                <!-- Visitor & Work Visas -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-cyan-100 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-plane text-cyan-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Visitor & Work Visas</h3>
                    </div>
                    <p class="text-gray-700 mb-6">Temporary visas for visiting, working, or studying in Australia.</p>
                    <ul class="space-y-3 mb-6">
                        <li><a href="{{ route('visitor-visa.600') }}" class="text-cyan-600 hover:text-cyan-800 font-medium">Visitor Visa (600)</a></li>
                        <li><a href="{{ route('visitor-visa.work-holiday-462') }}" class="text-cyan-600 hover:text-cyan-800 font-medium">Work & Holiday (462)</a></li>
                        <li><a href="{{ route('visitor-visa.work-holiday-417') }}" class="text-cyan-600 hover:text-cyan-800 font-medium">Work & Holiday (417)</a></li>
                        <li><a href="{{ route('visitor-visa.sponsored-family') }}" class="text-cyan-600 hover:text-cyan-800 font-medium">Sponsored Family</a></li>
                        <li><a href="{{ route('visitor-visa.offshore-extension') }}" class="text-cyan-600 hover:text-cyan-800 font-medium">Offshore Tourist Extension</a></li>
                        <li><a href="{{ route('visitor-visa.travel-exemption') }}" class="text-cyan-600 hover:text-cyan-800 font-medium">Travel Exemption</a></li>
                    </ul>
                    <a href="{{ route('visitor-visa.600') }}" class="inline-block bg-cyan-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-cyan-700 transition-colors duration-200">
                        Learn More
                    </a>
                </div>

                <!-- Business & Investment -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-indigo-100 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-briefcase text-indigo-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Business & Investment</h3>
                    </div>
                    <p class="text-gray-700 mb-6">Business and investment visa options for entrepreneurs and investors.</p>
                    <ul class="space-y-3 mb-6">
                        <li><a href="{{ route('business-visa.business-permanent-888') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Business Innovation (888)</a></li>
                        <li><a href="{{ route('business-visa.business-provisional-188') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Business Innovation (188)</a></li>
                        <li><a href="{{ route('business-visa.business-talent-132') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Business Talent (132)</a></li>
                    </ul>
                    <a href="{{ route('business-visa.business-permanent-888') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition-colors duration-200">
                        Learn More
                    </a>
                </div>

                <!-- Employer Sponsored -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-user-tie text-purple-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Employer Sponsored</h3>
                    </div>
                    <p class="text-gray-700 mb-6">Work visa options sponsored by Australian employers.</p>
                    <ul class="space-y-3 mb-6">
                        <li><a href="{{ route('employer-sponsored.tss-482') }}" class="text-purple-600 hover:text-purple-800 font-medium">TSS Visa (482)</a></li>
                        <li><a href="{{ route('employer-sponsored.ens-186-trt') }}" class="text-purple-600 hover:text-purple-800 font-medium">ENS 186 TRT</a></li>
                        <li><a href="{{ route('employer-sponsored.ens-186-direct') }}" class="text-purple-600 hover:text-purple-800 font-medium">ENS 186 Direct</a></li>
                        <li><a href="{{ route('employer-sponsored.gti') }}" class="text-purple-600 hover:text-purple-800 font-medium">GTI Program</a></li>
                        <li><a href="{{ route('employer-sponsored.gtes') }}" class="text-purple-600 hover:text-purple-800 font-medium">GTES Program</a></li>
                    </ul>
                    <a href="{{ route('employer-sponsored.tss-482') }}" class="inline-block bg-purple-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-purple-700 transition-colors duration-200">
                        Learn More
                    </a>
                </div>

                <!-- Tools & Resources -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-tools text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Tools & Resources</h3>
                    </div>
                    <p class="text-gray-700 mb-6">Helpful tools and resources to assist with your migration journey.</p>
                    <ul class="space-y-3 mb-6">
                        <li><a href="{{ route('migrate-to-australia.pr-calculator') }}" class="text-green-600 hover:text-green-800 font-medium">PR Points Calculator</a></li>
                        <li><a href="{{ route('migrate-to-australia.regional-points') }}" class="text-green-600 hover:text-green-800 font-medium">Regional Points Guide</a></li>
                        <li><a href="{{ route('migrate-to-australia.english-points') }}" class="text-green-600 hover:text-green-800 font-medium">English Score Points</a></li>
                        <li><a href="{{ route('migrate-to-australia.acs-assessment') }}" class="text-green-600 hover:text-green-800 font-medium">ACS Assessment</a></li>
                        <li><a href="{{ route('migrate-to-australia.vetassess-assessment') }}" class="text-green-600 hover:text-green-800 font-medium">VETASSESS</a></li>
                        <li><a href="{{ route('migrate-to-australia.job-ready-program') }}" class="text-green-600 hover:text-green-800 font-medium">Job Ready Program</a></li>
                    </ul>
                    <a href="{{ route('migrate-to-australia.pr-calculator') }}" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition-colors duration-200">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-6">Ready to Start Your Migration Journey?</h2>
                <p class="text-xl mb-8">Our experienced migration agents are here to help you find the best pathway to Australia based on your unique circumstances.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('appointment') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200 text-lg">
                        <i class="fas fa-calendar-check mr-2"></i>Book Free Consultation
                    </a>
                    <a href="{{ route('contact') }}" class="bg-blue-500 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-400 transition-colors duration-200 text-lg">
                        <i class="fas fa-envelope mr-2"></i>Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Why Choose Bansal Immigration?</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-1"></i>
                            <div>
                                <h4 class="font-semibold text-gray-900">Expert Guidance</h4>
                                <p class="text-gray-700">Our experienced migration agents have helped thousands of clients successfully migrate to Australia.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-1"></i>
                            <div>
                                <h4 class="font-semibold text-gray-900">Personalized Service</h4>
                                <p class="text-gray-700">We provide tailored advice based on your specific circumstances and goals.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-1"></i>
                            <div>
                                <h4 class="font-semibold text-gray-900">High Success Rate</h4>
                                <p class="text-gray-700">Our track record speaks for itself with a high success rate for visa applications.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 text-xl mr-3 mt-1"></i>
                            <div>
                                <h4 class="font-semibold text-gray-900">Ongoing Support</h4>
                                <p class="text-gray-700">We provide continuous support throughout your migration journey and beyond.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Migration Process</h3>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold mr-4 mt-1">1</div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Initial Assessment</h4>
                                <p class="text-gray-700">We assess your eligibility and recommend the best visa pathway for your situation.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold mr-4 mt-1">2</div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Documentation</h4>
                                <p class="text-gray-700">We help you gather and prepare all required documents for your visa application.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold mr-4 mt-1">3</div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Application Submission</h4>
                                <p class="text-gray-700">We submit your visa application and handle all correspondence with the Department of Home Affairs.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold mr-4 mt-1">4</div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Visa Grant</h4>
                                <p class="text-gray-700">We celebrate your visa grant and provide guidance for your new life in Australia.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
