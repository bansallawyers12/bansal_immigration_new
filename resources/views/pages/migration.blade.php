@extends('layouts.main')

@section('title', ($page->meta_title ?? $page->title) . ' - Australian Migration Services | Bansal Immigration')
@section('description', $page->meta_description ?? $page->excerpt)

@push('styles')
    <meta name="keywords" content="{{ $page->meta_keywords ?? 'australian migration, permanent residency, skilled visa, PR australia' }}">
    <meta property="og:title" content="{{ $page->meta_title ?? $page->title }}">
    <meta property="og:description" content="{{ $page->meta_description ?? $page->excerpt }}">
    @if($page->image)
    <meta property="og:image" content="{{ asset('storage/' . $page->image) }}">
    @endif
    @if(($page->slug ?? '') === 'skilled-recognised-graduate-visa-476')
    <meta name="robots" content="noindex,follow">
    @endif


@section('content')
<div class="bg-gradient-to-r from-green-600 to-green-800 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">{{ $page->title }}</h1>
        @if($page->excerpt)
        <p class="text-xl opacity-90">{{ $page->excerpt }}</p>
        @endif
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    @if($page->slug === 'skilled-recognised-graduate-visa-476')
    <div class="mb-6 bg-yellow-50 border border-yellow-200 text-yellow-900 rounded-lg p-4">
        <strong>Note:</strong> This visa subclass is currently closed to new applications. Information is provided for reference only.
    </div>
    @endif
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="/" class="hover:text-blue-600">Home</a></li>
            <li>/</li>
            <li><a href="/migration" class="hover:text-blue-600">Migration</a></li>
            @if($page->slug !== 'migration')
            <li>/</li>
            <li class="text-gray-900">{{ $page->title }}</li>
            @endif
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Migration Services</h3>
                
                <!-- Graduate Visas -->
                <div class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-2">Graduate Visas</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('migration.temporary-graduate') }}" class="text-blue-600 hover:text-blue-800">Temporary Graduate (485)</a></li>
                        <li><a href="{{ route('migration.post-study-work') }}" class="text-blue-600 hover:text-blue-800">Post Study Work (485)</a></li>
                        <li><a href="{{ route('migration.skilled-graduate') }}" class="text-blue-600 hover:text-blue-800">Skilled Graduate (476)</a></li>
                    </ul>
                </div>

                <!-- Permanent Visas -->
                <div class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-2">Permanent Visas</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('migration.skilled-independent') }}" class="text-blue-600 hover:text-blue-800">Skilled Independent (189)</a></li>
                        <li><a href="{{ route('migration.skilled-nominated') }}" class="text-blue-600 hover:text-blue-800">Skilled Nominated (190)</a></li>
                        <li><a href="{{ route('migration.skilled-regional') }}" class="text-blue-600 hover:text-blue-800">Skilled Regional (887)</a></li>
                        <li><a href="{{ route('migration.pr-skilled-regional') }}" class="text-blue-600 hover:text-blue-800">PR Skilled Regional (191)</a></li>
                        <li><a href="{{ route('migration.skilled-work-regional') }}" class="text-blue-600 hover:text-blue-800">Skilled Work Regional (491)</a></li>
                    </ul>
                </div>

                <!-- Skill Assessment -->
                <div class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-2">Skill Assessment</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('migration.acs-assessment') }}" class="text-blue-600 hover:text-blue-800">ACS Assessment</a></li>
                        <li><a href="{{ route('migration.vetassess-assessment') }}" class="text-blue-600 hover:text-blue-800">VETASSESS Assessment</a></li>
                        <li><a href="{{ route('migration.ea-assessment') }}" class="text-blue-600 hover:text-blue-800">Engineers Australia</a></li>
                        <li><a href="{{ route('migration.accountant-assessment') }}" class="text-blue-600 hover:text-blue-800">Accountant Assessment</a></li>
                        <li><a href="{{ route('migration.nursing-assessment') }}" class="text-blue-600 hover:text-blue-800">Nursing Assessment</a></li>
                        <li><a href="{{ route('migration.job-ready-program') }}" class="text-blue-600 hover:text-blue-800">Job Ready Program</a></li>
                    </ul>
                </div>

                <!-- Tools -->
                <div>
                    <h4 class="font-medium text-gray-800 mb-2">Tools & Resources</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('migration.pr-calculator') }}" class="text-blue-600 hover:text-blue-800">PR Points Calculator</a></li>
                        <li><a href="{{ route('migration.regional-points') }}" class="text-blue-600 hover:text-blue-800">Regional Points Guide</a></li>
                        <li><a href="{{ route('migration.english-points') }}" class="text-blue-600 hover:text-blue-800">English Score Points</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            @if($page->image)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->image_alt ?? $page->title }}" class="w-full h-64 object-cover rounded-lg">
            </div>
            @endif

            <div class="prose max-w-none">
                {!! $page->content !!}
            </div>

            <!-- Migration Pathways -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
                    <div class="text-3xl mb-3">🎓</div>
                    <h3 class="text-lg font-semibold text-blue-900 mb-2">Graduate Pathway</h3>
                    <p class="text-blue-800 text-sm">For recent graduates from Australian institutions</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 text-center">
                    <div class="text-3xl mb-3">🏆</div>
                    <h3 class="text-lg font-semibold text-green-900 mb-2">Skilled Pathway</h3>
                    <p class="text-green-800 text-sm">For skilled workers with in-demand occupations</p>
                </div>
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-6 text-center">
                    <div class="text-3xl mb-3">🌏</div>
                    <h3 class="text-lg font-semibold text-purple-900 mb-2">Regional Pathway</h3>
                    <p class="text-purple-800 text-sm">For those willing to live and work in regional Australia</p>
                </div>
            </div>

            <!-- Points Test Information -->
            <div class="mt-8 bg-gradient-to-r from-blue-500 to-green-500 rounded-lg p-6 text-white">
                <h3 class="text-xl font-semibold mb-4">Australian Points Test System</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-semibold mb-2">Key Factors:</h4>
                        <ul class="space-y-1 text-sm">
                            <li>• Age (25-32 years = maximum points)</li>
                            <li>• English proficiency (IELTS/PTE/TOEFL)</li>
                            <li>• Skilled employment experience</li>
                            <li>• Educational qualifications</li>
                            <li>• Australian study requirement</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">Bonus Points:</h4>
                        <ul class="space-y-1 text-sm">
                            <li>• Partner skills and qualifications</li>
                            <li>• Regional study</li>
                            <li>• Community language</li>
                            <li>• Professional year program</li>
                            <li>• Specialist education qualification</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('migration.pr-calculator') }}" class="bg-white text-blue-600 px-6 py-2 rounded font-medium hover:bg-gray-100">Calculate Your Points</a>
                </div>
            </div>

            <!-- Contact Form Section -->
            <div class="mt-8 bg-white rounded-lg shadow-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Ready to Migrate to Australia?</h3>
                <p class="text-gray-600 mb-6">Our registered migration agents will assess your eligibility and guide you through the best pathway for your situation. Send us your details for a personalized assessment.</p>
                @include('components.unified-contact-form', [
                    'form_source' => 'migration-page',
                    'form_variant' => 'full',
                    'show_phone' => true,
                    'show_subject' => true
                ])
            </div>

            <!-- Additional CTA -->
            <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Prefer a Direct Assessment?</h3>
                <p class="text-gray-700 mb-4">Book a free consultation with our registered migration agents for immediate eligibility assessment.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('appointment') }}" class="cryptos-btn inline-block text-center">Free Assessment</a>
                    <a href="{{ route('contact') }}" class="bg-white border border-yellow-400 text-yellow-800 px-6 py-2 rounded hover:bg-yellow-50 inline-block text-center">Contact Migration Agent</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@endpush

@section('content')
<div class="bg-gradient-to-r from-green-600 to-green-800 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">{{ $page->title }}</h1>
        @if($page->excerpt)
        <p class="text-xl opacity-90">{{ $page->excerpt }}</p>
        @endif
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="/" class="hover:text-blue-600">Home</a></li>
            <li>/</li>
            <li><a href="/migration" class="hover:text-blue-600">Migration</a></li>
            @if($page->slug !== 'migration')
            <li>/</li>
            <li class="text-gray-900">{{ $page->title }}</li>
            @endif
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Migration Services</h3>
                
                <!-- Graduate Visas -->
                <div class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-2">Graduate Visas</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('migration.temporary-graduate') }}" class="text-blue-600 hover:text-blue-800">Temporary Graduate (485)</a></li>
                        <li><a href="{{ route('migration.post-study-work') }}" class="text-blue-600 hover:text-blue-800">Post Study Work (485)</a></li>
                        <li><a href="{{ route('migration.skilled-graduate') }}" class="text-blue-600 hover:text-blue-800">Skilled Graduate (476)</a></li>
                    </ul>
                </div>

                <!-- Permanent Visas -->
                <div class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-2">Permanent Visas</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('migration.skilled-independent') }}" class="text-blue-600 hover:text-blue-800">Skilled Independent (189)</a></li>
                        <li><a href="{{ route('migration.skilled-nominated') }}" class="text-blue-600 hover:text-blue-800">Skilled Nominated (190)</a></li>
                        <li><a href="{{ route('migration.skilled-regional') }}" class="text-blue-600 hover:text-blue-800">Skilled Regional (887)</a></li>
                        <li><a href="{{ route('migration.pr-skilled-regional') }}" class="text-blue-600 hover:text-blue-800">PR Skilled Regional (191)</a></li>
                        <li><a href="{{ route('migration.skilled-work-regional') }}" class="text-blue-600 hover:text-blue-800">Skilled Work Regional (491)</a></li>
                    </ul>
                </div>

                <!-- Skill Assessment -->
                <div class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-2">Skill Assessment</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('migration.acs-assessment') }}" class="text-blue-600 hover:text-blue-800">ACS Assessment</a></li>
                        <li><a href="{{ route('migration.vetassess-assessment') }}" class="text-blue-600 hover:text-blue-800">VETASSESS Assessment</a></li>
                        <li><a href="{{ route('migration.ea-assessment') }}" class="text-blue-600 hover:text-blue-800">Engineers Australia</a></li>
                        <li><a href="{{ route('migration.accountant-assessment') }}" class="text-blue-600 hover:text-blue-800">Accountant Assessment</a></li>
                        <li><a href="{{ route('migration.nursing-assessment') }}" class="text-blue-600 hover:text-blue-800">Nursing Assessment</a></li>
                        <li><a href="{{ route('migration.job-ready-program') }}" class="text-blue-600 hover:text-blue-800">Job Ready Program</a></li>
                    </ul>
                </div>

                <!-- Tools -->
                <div>
                    <h4 class="font-medium text-gray-800 mb-2">Tools & Resources</h4>
                    <ul class="space-y-1 text-sm">
                        <li><a href="{{ route('migration.pr-calculator') }}" class="text-blue-600 hover:text-blue-800">PR Points Calculator</a></li>
                        <li><a href="{{ route('migration.regional-points') }}" class="text-blue-600 hover:text-blue-800">Regional Points Guide</a></li>
                        <li><a href="{{ route('migration.english-points') }}" class="text-blue-600 hover:text-blue-800">English Score Points</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            @if($page->image)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->image_alt ?? $page->title }}" class="w-full h-64 object-cover rounded-lg">
            </div>
            @endif

            <div class="prose max-w-none">
                {!! $page->content !!}
            </div>

            <!-- Migration Pathways -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
                    <div class="text-3xl mb-3">🎓</div>
                    <h3 class="text-lg font-semibold text-blue-900 mb-2">Graduate Pathway</h3>
                    <p class="text-blue-800 text-sm">For recent graduates from Australian institutions</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 text-center">
                    <div class="text-3xl mb-3">🏆</div>
                    <h3 class="text-lg font-semibold text-green-900 mb-2">Skilled Pathway</h3>
                    <p class="text-green-800 text-sm">For skilled workers with in-demand occupations</p>
                </div>
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-6 text-center">
                    <div class="text-3xl mb-3">🌏</div>
                    <h3 class="text-lg font-semibold text-purple-900 mb-2">Regional Pathway</h3>
                    <p class="text-purple-800 text-sm">For those willing to live and work in regional Australia</p>
                </div>
            </div>

            <!-- Points Test Information -->
            <div class="mt-8 bg-gradient-to-r from-blue-500 to-green-500 rounded-lg p-6 text-white">
                <h3 class="text-xl font-semibold mb-4">Australian Points Test System</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-semibold mb-2">Key Factors:</h4>
                        <ul class="space-y-1 text-sm">
                            <li>• Age (25-32 years = maximum points)</li>
                            <li>• English proficiency (IELTS/PTE/TOEFL)</li>
                            <li>• Skilled employment experience</li>
                            <li>• Educational qualifications</li>
                            <li>• Australian study requirement</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">Bonus Points:</h4>
                        <ul class="space-y-1 text-sm">
                            <li>• Partner skills and qualifications</li>
                            <li>• Regional study</li>
                            <li>• Community language</li>
                            <li>• Professional year program</li>
                            <li>• Specialist education qualification</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('migration.pr-calculator') }}" class="bg-white text-blue-600 px-6 py-2 rounded font-medium hover:bg-gray-100">Calculate Your Points</a>
                </div>
            </div>

            <!-- Contact Form Section -->
            <div class="mt-8 bg-white rounded-lg shadow-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Ready to Migrate to Australia?</h3>
                <p class="text-gray-600 mb-6">Our registered migration agents will assess your eligibility and guide you through the best pathway for your situation. Send us your details for a personalized assessment.</p>
                @include('components.unified-contact-form', [
                    'form_source' => 'migration-page',
                    'form_variant' => 'full',
                    'show_phone' => true,
                    'show_subject' => true
                ])
            </div>

            <!-- Additional CTA -->
            <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Prefer a Direct Assessment?</h3>
                <p class="text-gray-700 mb-4">Book a free consultation with our registered migration agents for immediate eligibility assessment.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('appointment') }}" class="cryptos-btn inline-block text-center">Free Assessment</a>
                    <a href="{{ route('contact') }}" class="bg-white border border-yellow-400 text-yellow-800 px-6 py-2 rounded hover:bg-yellow-50 inline-block text-center">Contact Migration Agent</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
