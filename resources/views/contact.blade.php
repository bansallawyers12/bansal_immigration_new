@extends('layouts.main')

@section('title', 'Contact Us - Bansal Immigration Consultants')
@section('description', 'Get in touch with our MARA registered migration agents. Contact us for expert immigration advice and consultation services.')
@section('content')
    <!-- Hero -->
    <section class="hero-bg relative py-24 md:py-32">
        <div class="absolute inset-0"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                <div>
                    <div class="hero-overlay p-6 md:p-8 rounded-lg shadow-2xl max-w-xl">
                        <h1 class="text-3xl md:text-5xl font-bold sg-navy leading-tight mb-4">Speak with a MARA Registered Migration Agent</h1>
                        <p class="text-base md:text-lg sg-dark-gray leading-relaxed mb-6">Personalised guidance for skilled, study, partner, and employer sponsored visas. Start your journey today.</p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="/appointment" class="btn-primary px-6 py-3 rounded-lg font-semibold inline-flex items-center justify-center">
                                <i class="fas fa-calendar-alt mr-2"></i> Book Free Consultation
                            </a>
                            <a href="#contact-form" class="btn-secondary px-6 py-3 rounded-lg font-semibold inline-flex items-center justify-center">
                                <i class="fas fa-envelope mr-2"></i> Make an Enquiry
                            </a>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="service-card bg-white p-6 md:p-8 rounded-lg shadow-xl">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-sg-sky-blue flex items-center justify-center text-white">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <div>
                                <p class="text-sm text-sg-light-blue font-semibold">Trusted by thousands</p>
                                <p class="text-xs sg-medium-gray">MARA Registered • 5000+ cases</p>
                            </div>
                        </div>
                        <ul class="space-y-3 sg-medium-gray">
                            <li class="flex items-start gap-3"><i class="fas fa-check text-sg-light-blue mt-1"></i><span>Tailored strategies for your visa goals</span></li>
                            <li class="flex items-start gap-3"><i class="fas fa-check text-sg-light-blue mt-1"></i><span>Transparent fees and clear timelines</span></li>
                            <li class="flex items-start gap-3"><i class="fas fa-check text-sg-light-blue mt-1"></i><span>End-to-end support and documentation</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content with Sticky Form -->
    <section class="py-16 bg-sg-light-gray">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                <!-- Left: Content blocks -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="service-card bg-white p-6 md:p-8 rounded-lg">
                        <h2 class="text-2xl md:text-3xl font-bold sg-navy mb-4">How can we help?</h2>
                        <p class="sg-medium-gray mb-6">Whether you're applying for skilled migration, studying in Australia, reuniting with family, or seeking employer sponsorship, our team provides expert, personalised advice.</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-5 rounded-lg bg-sg-light-gray">
                                <div class="flex items-center gap-3 mb-2"><i class="fas fa-briefcase text-sg-light-blue"></i><h3 class="font-semibold sg-navy">Skilled Migration</h3></div>
                                <p class="text-sm sg-medium-gray">Points assessment, occupation lists, EOI, and PR pathways.</p>
                            </div>
                            <div class="p-5 rounded-lg bg-sg-light-gray">
                                <div class="flex items-center gap-3 mb-2"><i class="fas fa-graduation-cap text-sg-light-blue"></i><h3 class="font-semibold sg-navy">Study in Australia</h3></div>
                                <p class="text-sm sg-medium-gray">Course selection, GTE, COE, and student visa processing.</p>
                            </div>
                            <div class="p-5 rounded-lg bg-sg-light-gray">
                                <div class="flex items-center gap-3 mb-2"><i class="fas fa-heart text-sg-light-blue"></i><h3 class="font-semibold sg-navy">Partner & Family</h3></div>
                                <p class="text-sm sg-medium-gray">Partner, parent, and child visas with caring support.</p>
                            </div>
                            <div class="p-5 rounded-lg bg-sg-light-gray">
                                <div class="flex items-center gap-3 mb-2"><i class="fas fa-user-tie text-sg-light-blue"></i><h3 class="font-semibold sg-navy">Employer Sponsored</h3></div>
                                <p class="text-sm sg-medium-gray">Sponsorship, nomination, and visa application guidance.</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="service-card bg-white p-6 rounded-lg text-center">
                            <div class="w-16 h-16 mx-auto rounded-full bg-sg-sky-blue flex items-center justify-center text-white mb-3">
                                <i class="fas fa-check"></i>
                            </div>
                            <h4 class="font-bold sg-navy mb-2">MARA Registered</h4>
                            <p class="text-sm sg-medium-gray">Work with qualified, regulated migration professionals.</p>
                        </div>
                        <div class="service-card bg-white p-6 rounded-lg text-center">
                            <div class="w-16 h-16 mx-auto rounded-full bg-sg-sky-blue flex items-center justify-center text-white mb-3">
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="font-bold sg-navy mb-2">Proven Results</h4>
                            <p class="text-sm sg-medium-gray">Thousands of successful cases across visa categories.</p>
                        </div>
                        <div class="service-card bg-white p-6 rounded-lg text-center">
                            <div class="w-16 h-16 mx-auto rounded-full bg-sg-sky-blue flex items-center justify-center text-white mb-3">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <h4 class="font-bold sg-navy mb-2">Personalised Care</h4>
                            <p class="text-sm sg-medium-gray">Clear advice, responsive communication, and support.</p>
                        </div>
                    </div>

                    <!-- FAQs -->
                    <div class="service-card bg-white p-6 md:p-8 rounded-lg">
                        <h2 class="text-2xl font-bold sg-navy mb-4">Frequently Asked Questions</h2>
                        <div class="divide-y divide-gray-200">
                            <details class="py-4 group">
                                <summary class="cursor-pointer font-semibold sg-navy flex items-center justify-between">How soon can I get an appointment?<i class="fas fa-plus text-sg-light-blue group-open:rotate-45 transition-transform"></i></summary>
                                <p class="pt-2 sg-medium-gray">Most appointments are available within 1-3 business days. Urgent cases can be prioritised.</p>
                            </details>
                            <details class="py-4 group">
                                <summary class="cursor-pointer font-semibold sg-navy flex items-center justify-between">Do you provide PR pathway assessments?<i class="fas fa-plus text-sg-light-blue group-open:rotate-45 transition-transform"></i></summary>
                                <p class="pt-2 sg-medium-gray">Yes, we conduct comprehensive assessments including eligibility, points, and document checklists.</p>
                            </details>
                            <details class="py-4 group">
                                <summary class="cursor-pointer font-semibold sg-navy flex items-center justify-between">Can you help with refusals or appeals?<i class="fas fa-plus text-sg-light-blue group-open:rotate-45 transition-transform"></i></summary>
                                <p class="pt-2 sg-medium-gray">We can review refusals and represent you for AAT appeals with a strong case strategy.</p>
                            </details>
                        </div>
                    </div>

                    <!-- Map / Location -->
                    <div class="service-card bg-white p-0 rounded-lg overflow-hidden">
                        <div class="p-6 md:p-8">
                            <h2 class="text-2xl font-bold sg-navy mb-2">Visit Our Office</h2>
                            <p class="sg-medium-gray">Level 8/278 Collins St, Melbourne VIC 3000, Australia</p>
                        </div>
                        <div class="w-full h-80 md:h-96">
                            <iframe title="Bansal Immigration Collins St" src="https://www.google.com/maps?q=Level%208/278%20Collins%20St,%20Melbourne%20VIC%203000&output=embed" class="w-full h-full border-0"></iframe>
                        </div>
                    </div>

                    <!-- Final CTA -->
                    <div class="text-center">
                        <a href="/appointment" class="btn-primary px-8 py-4 rounded-lg text-lg font-semibold inline-block">
                            <i class="fas fa-calendar-alt mr-2"></i> Book a Consultation Now
                        </a>
                    </div>
                </div>

                <!-- Right: Sticky Contact Form -->
                <aside id="contact-form" class="lg:sticky lg:top-24">
                    <div class="service-card bg-white p-6 md:p-8 rounded-lg shadow-xl">
                        <h3 class="text-xl font-bold mb-4 sg-navy">Make an Enquiry</h3>
                    @include('components.unified-contact-form', [
                        'form_source' => 'contact-page',
                        'form_variant' => 'full',
                        'show_phone' => true,
                        'show_subject' => true
                    ])
                        <div class="mt-4 flex items-center gap-3 text-xs sg-medium-gray">
                            <i class="fas fa-lock text-sg-light-blue"></i>
                            <span>Your information is private and secure</span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4 auto-rows-fr">
                        <a href="tel:+61396021330" class="block bg-white border border-gray-200 rounded-lg p-4 sm:p-5 text-center shadow-sm hover:shadow h-full">
                            <div class="font-bold sg-navy mb-1 text-base sm:text-lg"><i class="fas fa-phone mr-2"></i>Call Us</div>
                            <div class="text-sm sm:text-base sg-medium-gray whitespace-normal break-words">+61 3 9602 1330</div>
                        </a>
                        <a href="mailto:info@bansalimmigration.com" class="block bg-white border border-gray-200 rounded-lg p-4 sm:p-5 text-center shadow-sm hover:shadow h-full">
                            <div class="font-bold sg-navy mb-1 text-base sm:text-lg"><i class="fas fa-envelope mr-2"></i>Email</div>
                            <div class="text-sm sm:text-base sg-medium-gray whitespace-normal break-words">info@bansalimmigration.com</div>
                        </a>
                </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
