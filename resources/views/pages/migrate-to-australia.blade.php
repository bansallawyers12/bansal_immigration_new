@extends('layouts.main')

@section('title', ($page->meta_title ?? ($page->title ?? 'Migrate to Australia')) . ' | Bansal Immigration')
@section('description', $page->meta_description ?? ($page->excerpt ?? 'Discover the perfect pathway to Australia across skilled, family, employer, and visitor visas.'))

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Standard Category Header (matches other pages) -->
    <div class="relative overflow-hidden">
        <img src="{{ asset('img/Ausse-flags-hero.jpeg') }}" alt="Australian flags" class="absolute inset-0 w-full h-full object-cover" />
        <div class="relative bg-gradient-to-r from-blue-900/70 to-blue-700/60 text-white py-20 md:py-24">
        <div class="container mx-auto px-4">
                <h1 class="text-4xl font-bold mb-4">{{ $page->title ?? 'Migrate to Australia' }}</h1>
                @if(!empty($page->excerpt))
                <p class="text-xl opacity-90">{{ $page->excerpt }}</p>
                @endif
            </div>
        </div>
        <div class="h-1"></div>
    </div>

    <!-- Visa Categories Grid -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Choose Your Migration Pathway</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Skilled Migration -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
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
                    <a href="{{ route('migrate-to-australia.skilled-hub') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors duration-200 mt-auto">
                        Learn More
                    </a>
                </div>

                <!-- Partner Visas -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-pink-100 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-heart text-pink-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Partner Visas</h3>
                    </div>
                    <p class="text-gray-700 mb-6">Partner visa options for spouses and de facto partners of Australian citizens and permanent residents.</p>
                    <ul class="space-y-3 mb-6">
                        <li><a href="{{ route('family-visa.partner-provisional-309') }}" class="text-pink-600 hover:text-pink-800 font-medium">Partner Provisional (309)</a></li>
                        <li><a href="{{ route('family-visa.partner-permanent-100') }}" class="text-pink-600 hover:text-pink-800 font-medium">Partner Permanent (100)</a></li>
                        <li><a href="{{ route('family-visa.partner-provisional-820') }}" class="text-pink-600 hover:text-pink-800 font-medium">Partner Provisional (820)</a></li>
                        <li><a href="{{ route('family-visa.partner-permanent-801') }}" class="text-pink-600 hover:text-pink-800 font-medium">Partner Permanent (801)</a></li>
                        <li><a href="{{ route('family-visa.nz-461') }}" class="text-pink-600 hover:text-pink-800 font-medium">New Zealand Citizen Family (461)</a></li>
                        <li><a href="{{ route('family-visa.prospective-marriage') }}" class="text-pink-600 hover:text-pink-800 font-medium">Prospective Marriage (300)</a></li>
                    </ul>
                    <a href="{{ route('family-visa.index') }}" class="inline-block bg-pink-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-pink-700 transition-colors duration-200 mt-auto">
                        Learn More
                    </a>
                </div>

                <!-- Parent Visas -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-emerald-100 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-users text-emerald-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Parent Visas</h3>
                    </div>
                    <p class="text-gray-700 mb-6">Parent visa options to reunite parents with their children in Australia.</p>
                    <ul class="space-y-3 mb-6">
                        <li><a href="{{ route('family-visa.contributory-parent-143') }}" class="text-emerald-600 hover:text-emerald-800 font-medium">Contributory Parent (143)</a></li>
                        <li><a href="{{ route('family-visa.parent-visa-103') }}" class="text-emerald-600 hover:text-emerald-800 font-medium">Parent Visa (103)</a></li>
                        <li><a href="{{ route('family-visa.contributory-aged-parent-884') }}" class="text-emerald-600 hover:text-emerald-800 font-medium">Contributory Aged Parent (884)</a></li>
                        <li><a href="{{ route('family-visa.contributory-aged-parent-864') }}" class="text-emerald-600 hover:text-emerald-800 font-medium">Contributory Aged Parent (864)</a></li>
                        <li><a href="{{ route('family-visa.contributory-parent-173') }}" class="text-emerald-600 hover:text-emerald-800 font-medium">Contributory Parent (173)</a></li>
                        <li><a href="{{ route('family-visa.aged-parent-804') }}" class="text-emerald-600 hover:text-emerald-800 font-medium">Aged Parent (804)</a></li>
                        <li><a href="{{ route('family-visa.sponsored-parent-870') }}" class="text-emerald-600 hover:text-emerald-800 font-medium">Sponsored Parent (870)</a></li>
                    </ul>
                    <a href="{{ route('parent-visas.index') }}" class="inline-block bg-emerald-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-emerald-700 transition-colors duration-200 mt-auto">
                        Learn More
                    </a>
                </div>

                <!-- Visitor & Work Visas -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
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
                        <li><a href="{{ route('visitor-visa.onshore-extension') }}" class="text-cyan-600 hover:text-cyan-800 font-medium">Onshore Visitor Visa Extension</a></li>
                        
                    </ul>
                    <a href="{{ route('visitor-visa.index') }}" class="inline-block bg-cyan-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-cyan-700 transition-colors duration-200 mt-auto">
                        Learn More
                    </a>
                </div>

                <!-- Business & Investment -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-indigo-100 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-briefcase text-indigo-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Business & Investment</h3>
                    </div>
                    <p class="text-gray-700 mb-6">Business and investment visa options for entrepreneurs and investors. Currently closed to new applicants.</p>
                    <ul class="space-y-3 mb-6">
                        <li><a href="{{ route('business-visa.business-permanent-888') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Business Innovation (888)</a></li>
                        <li><a href="{{ route('business-visa.business-provisional-188') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Business Innovation (188)</a></li>
                        <li><a href="{{ route('business-visa.business-talent-132') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Business Talent (132)</a></li>
                    </ul>
                    <a href="{{ route('business-visa.index') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition-colors duration-200 mt-auto">
                        Learn More
                    </a>
                </div>

                <!-- Employer Sponsored -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
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
                        <li><a href="{{ route('employer-sponsored.skilled-regional-494') }}" class="text-purple-600 hover:text-purple-800 font-medium">Skilled Employer Sponsored Regional (494)</a></li>
                        <li><a href="{{ route('employer-sponsored.training-visa-407') }}" class="text-purple-600 hover:text-purple-800 font-medium">Training Visa (407)</a></li>
                    </ul>
                    <a href="{{ route('employer-sponsored.index') }}" class="inline-block bg-purple-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-purple-700 transition-colors duration-200 mt-auto">
                        Learn More
                    </a>
                </div>

                <!-- Removed Tools & Resources card per request -->
            </div>
        </div>
                        </div>

    <!-- Directory and Tools -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-6xl mx-auto space-y-10">
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Browse All Categories</h3>
                <x-migrate.accordion-directory :sections="[
                    // Skilled Migration
                    [
                        'title' => 'Skilled Migration', 'icon' => 'fas fa-user-graduate', 'color' => 'blue',
                        'links' => [
                            'Temporary Graduate (485)' => route('migrate-to-australia.temporary-graduate'),
                            'Post Study Work (485)' => route('migrate-to-australia.post-study-work'),
                            'Skilled Independent (189)' => route('migrate-to-australia.skilled-independent'),
                            'Skilled Nominated (190)' => route('migrate-to-australia.skilled-nominated'),
                            'Skilled Regional (887)' => route('migrate-to-australia.skilled-regional'),
                            'PR Skilled Regional (191)' => route('migrate-to-australia.pr-skilled-regional'),
                            'Skilled Work Regional (491)' => route('migrate-to-australia.skilled-work-regional'),
                        ],
                    ],

                    // Partner Visas
                    [
                        'title' => 'Partner Visas', 'icon' => 'fas fa-heart', 'color' => 'pink',
                        'links' => [
                            'Partner Provisional (309)' => route('family-visa.partner-provisional-309'),
                            'Partner Permanent (100)' => route('family-visa.partner-permanent-100'),
                            'Partner Provisional (820)' => route('family-visa.partner-provisional-820'),
                            'Partner Permanent (801)' => route('family-visa.partner-permanent-801'),
                            'Prospective Marriage (300)' => route('family-visa.prospective-marriage'),
                        ],
                    ],

                    // Parent Visas
                    [
                        'title' => 'Parent Visas', 'icon' => 'fas fa-users', 'color' => 'emerald',
                        'links' => [
                            'Contributory Parent (143)' => route('family-visa.contributory-parent-143'),
                            'Parent Visa (103)' => route('family-visa.parent-visa-103'),
                            'Contributory Aged Parent (884)' => route('family-visa.contributory-aged-parent-884'),
                            'Contributory Aged Parent (864)' => route('family-visa.contributory-aged-parent-864'),
                            'Contributory Parent (173)' => route('family-visa.contributory-parent-173'),
                            'Aged Parent (804)' => route('family-visa.aged-parent-804'),
                            'Sponsored Parent (870)' => route('family-visa.sponsored-parent-870'),
                        ],
                    ],

                    // Child Visas
                    [
                        'title' => 'Child Visas', 'icon' => 'fas fa-child', 'color' => 'purple',
                        'links' => [
                            'Child Visa (101)' => route('family-visa.child-visa-101'),
                            'Child Visa (802)' => route('family-visa.child-visa-802'),
                            'Adoption Visa (102)' => route('family-visa.adoption-visa'),
                            'Dependent Child Visa (445)' => route('family-visa.dependent-child'),
                        ],
                    ],

                    // Other Family Visas
                    [
                        'title' => 'Other Family Visas', 'icon' => 'fas fa-house-chimney-user', 'color' => 'rose',
                        'links' => [
                            'Remaining Relative (115)' => route('family-visa.remaining-relative-115'),
                            'Remaining Relative (835)' => route('family-visa.remaining-relative-835'),
                            'Orphan Relative (117)' => route('family-visa.orphan-relative-117'),
                            'Orphan Relative (837)' => route('family-visa.orphan-relative-837'),
                            'Carer Visa (116)' => route('family-visa.carer-offshore-116'),
                            'Carer Visa (836)' => route('family-visa.carer-onshore-836'),
                        ],
                    ],

                    // Visitor & Work
                    [
                        'title' => 'Visitor & Work Visas', 'icon' => 'fas fa-plane', 'color' => 'cyan',
                        'links' => [
                            'Visitor Visa (600)' => route('visitor-visa.600'),
                            'Work & Holiday (462)' => route('visitor-visa.work-holiday-462'),
                            'Work & Holiday (417)' => route('visitor-visa.work-holiday-417'),
                            'Sponsored Family' => route('visitor-visa.sponsored-family'),
                            'Onshore Visitor Visa Extension' => route('visitor-visa.onshore-extension'),
                            'eVisitor (651)' => route('visitor-visa.index'),
                        ],
                    ],

                    // Transit & Special Purpose (links to index sections)
                    [
                        'title' => 'Transit & Special Purpose', 'icon' => 'fas fa-bus', 'color' => 'amber',
                        'links' => [
                            'Transit Visa (771)' => route('transit-special-purpose.index'),
                            'Special Category Visa (444)' => route('transit-special-purpose.index'),
                            'Special Purpose Visa' => route('transit-special-purpose.index'),
                            'Special Purpose Travel Authority (945)' => route('transit-special-purpose.index'),
                        ],
                    ],

                    // Business & Investment
                    [
                        'title' => 'Business & Investment', 'icon' => 'fas fa-briefcase', 'color' => 'indigo',
                        'links' => [
                            'Business Innovation (888)' => route('business-visa.business-permanent-888'),
                            'Business Innovation Provisional (188)' => route('business-visa.business-provisional-188'),
                        ],
                    ],

                    // Employer Sponsored
                    [
                        'title' => 'Employer Sponsored', 'icon' => 'fas fa-user-tie', 'color' => 'teal',
                        'links' => [
                            'TSS Visa (482)' => route('employer-sponsored.tss-482'),
                            'Skilled Employer Sponsored Regional (494)' => route('employer-sponsored.skilled-regional-494'),
                            'Training Visa (407)' => route('employer-sponsored.training-visa-407'),
                            'Temporary Activity (408)' => route('employer-sponsored.temporary-activity-408'),
                            'Short Stay (400)' => route('employer-sponsored.short-stay-400'),
                            'ENS 186 TRT' => route('employer-sponsored.ens-186-trt'),
                            'ENS 186 Direct' => route('employer-sponsored.ens-186-direct'),
                        ],
                    ],

                    // Global Talent
                    [
                        'title' => 'Global Talent Program', 'icon' => 'fas fa-rocket', 'color' => 'fuchsia',
                        'links' => [
                            'GTI Program' => route('employer-sponsored.gti'),
                            'GTES Program' => route('employer-sponsored.gtes'),
                        ],
                    ],

                    // Medical & Humanitarian
                    [
                        'title' => 'Medical & Humanitarian', 'icon' => 'fas fa-notes-medical', 'color' => 'red',
                        'links' => [
                            'Medical Treatment (602)' => route('medical-humanitarian.index'),
                            'Pacific Engagement (192)' => route('medical-humanitarian.index'),
                            'Former Resident (151)' => route('medical-humanitarian.index'),
                        ],
                    ],

                    // Maritime & Crew
                    [
                        'title' => 'Maritime & Crew', 'icon' => 'fas fa-ship', 'color' => 'sky',
                        'links' => [
                            'Crew Travel Authority (942)' => route('maritime-crew.index'),
                            'Maritime Crew (988)' => route('maritime-crew.index'),
                        ],
                    ],

                    // Bridging & Return Visas
                    [
                        'title' => 'Bridging & Return Visas', 'icon' => 'fas fa-link', 'color' => 'slate',
                        'links' => [
                            'Bridging Visa A (010)' => route('bridging-return-visas.index'),
                            'Bridging Visa B (020)' => route('bridging-return-visas.index'),
                            'Bridging Visa C (030)' => route('bridging-return-visas.index'),
                            'Bridging Visa E (050/051)' => route('bridging-return-visas.index'),
                            'Resident Return (155/157)' => route('bridging-return-visas.index'),
                        ],
                    ],

                    // Tools
                    [
                        'title' => 'Migration Tools', 'icon' => 'fas fa-calculator', 'color' => 'green',
                        'links' => [
                            'PR Points Calculator' => route('migrate-to-australia.pr-calculator'),
                            'Regional Points' => route('migrate-to-australia.regional-points'),
                            'English Points' => route('migrate-to-australia.english-points'),
                        ],
                    ],
                ]" />
                    </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Tools & Calculators</h3>
                <x-migrate.tools-grid :tools="[
                    ['title' => 'PR Points Calculator', 'href' => route('migrate-to-australia.pr-calculator'), 'desc' => 'Estimate your points in 2 minutes', 'icon' => 'fas fa-calculator'],
                    ['title' => 'Postcode Checker', 'href' => route('postcode-checker'), 'desc' => 'Confirm regional classification for your area', 'icon' => 'fas fa-map-marker-alt'],
                    ['title' => 'Student Calculator', 'href' => route('study-australia.calculator'), 'desc' => 'Check funds requirement for student visa', 'icon' => 'fas fa-user-graduate'],
                ]" />
                </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Frequently Asked Questions</h3>
                <x-migrate.faq :faqs="[
                    ['q' => 'Which visa pathway is best for me?', 'a' => 'Use our PR Points Calculator and book a free consultation to get a tailored recommendation.'],
                    ['q' => 'How long does the process take?', 'a' => 'Processing times vary by visa type and your circumstances. We will advise estimated timelines after an assessment.'],
                    ['q' => 'Do you assist with skills assessment?', 'a' => 'Yes, we guide you through ACS, VETASSESS, and other assessing authorities.'],
                ]" />
            </div>
        </div>
    </div>

    <x-migrate.sticky-help />

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
