@extends('layouts.frontend')
@section('seoinfo')
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDesc }}">
    <!-- Add other OG/Twitter metas from your file -->
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDesc }}">
    <meta property="og:image" content="{{ asset('img/bansal-immigration-icon.jpg') }}">
    <!-- Google verification, Twitter, etc. -->
@endsection
@section('content')
    <!-- Hide Trustpilot if needed -->
    <style>#trustpilot-gtm-floating-wrapper { display: none; }</style>

    <!-- Contact Popup -->
    <div id="popup-loging" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg max-w-md w-full mx-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Contact Us</h2>
                <span class="close text-xl cursor-pointer hover:text-gray-600" onclick="closePopup()">&times;</span>
            </div>
            @include('components.unified-contact-form', [
                'form_source' => 'homepage-popup',
                'form_variant' => 'compact',
                'show_phone' => true,
                'show_subject' => false
            ])
        </div>
    </div>

    @if($sliderstat == 1)
    <section class="hero-area relative h-screen flex items-center justify-center text-white">
        <div class="hero-slides absolute inset-0">
            @foreach($sliderLists as $list)
            <div class="single-hero-slide absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('img/slider/' . $list->image) }}');">
                <div class="container mx-auto h-full flex items-center justify-center">
                    <div class="text-center">
                        <h1 class="text-4xl font-medium mb-4">Bansal Immigration Consultants</h1>
                        <h2 class="text-3xl mb-2">{{ $list->title }}</h2>
                        <h4 class="text-xl">{{ $list->subtitle }}</h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- About Area (hidden in original; stub) -->
    <section class="py-16 bg-gray-200 hidden">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <img src="{{ asset('img/Frontend/about.jpg') }}" alt="About Us" class="rounded-lg w-full">
                </div>
                <div class="md:w-1/2 md:pl-8">
                    <h3 class="text-3xl font-bold mb-4">About Bansal Immigration</h3>
                    <p>Your about content here...</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Teaser -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl text-center mb-8">Recent Blogs</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($blogLists as $list)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($list->image)
                    <a href="{{ route('blog.detail', $list->slug) }}"><img src="{{ asset('img/blog/' . $list->image) }}" alt="{{ $list->image_alt }}" class="w-full h-48 object-cover"></a>
                    @endif
                    <div class="p-4">
                        <h4 class="text-xl font-bold mb-2">{{ $list->title }}</h4>
                        <p class="mb-4">{{ $list->short_description }}</p>
                        <a href="{{ route('blog.detail', $list->slug) }}" class="cryptos-btn inline-block">Read More</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('blogs') }}" class="cryptos-btn">View All</a>
            </div>
        </div>
    </section>

    <!-- Team Section (from your file; hardcoded for now) -->
    <section class="meet_us py-8">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold mb-4 text-white">Our Team</h1>
                <p class="text-xl text-white">"Expert Guidance, Personalised Care – Meet the Team Behind Your Migration Success."</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Arun Bansal -->
                <div class="text-center">
                    <img src="{{ asset('img/profile_imgs/Arun Sir.png') }}" alt="Arun Bansal" class="w-80 h-96 object-cover rounded mx-auto mb-2 -mt-32">
                    <h3 class="text-yellow-300 text-2xl font-bold mb-2">Arun Bansal</h3>
                    <p class="text-yellow-300 text-sm mb-4">Director (MARN: 2418466)</p>
                    <p class="text-white text-sm leading-relaxed">Director of Bansal Immigration Consultants, offers 10+ years of legal and migration experience...</p>
                </div>
                <!-- Repeat for Vipul Goyal and Maleesha Thawalampola (copy from your file) -->
                <div class="text-center">
                    <img src="{{ asset('img/profile_imgs/Vipul Sir.png') }}" alt="Vipul Goyal" class="w-80 h-96 object-cover rounded mx-auto mb-2 -mt-32">
                    <h3 class="text-yellow-300 text-2xl font-bold mb-2">Vipul Goyal</h3>
                    <p class="text-yellow-300 text-sm mb-4">MARA: 2418571</p>
                    <p class="text-white text-sm leading-relaxed">Migration Agent at Bansal Immigration Consultants...</p>
                </div>
                <div class="text-center">
                    <img src="{{ asset('img/profile_imgs/Maleesha Maam.png') }}" alt="Maleesha Thawalampola" class="w-80 h-96 object-cover rounded mx-auto mb-2 -mt-32">
                    <h3 class="text-yellow-300 text-2xl font-bold mb-2">Maleesha Thawalampola</h3>
                    <p class="text-yellow-300 text-sm mb-4">MARA: 2518893</p>
                    <p class="text-white text-sm leading-relaxed">Migration Agent at Bansal Immigration Consultants...</p>
                </div>
            </div>
            <div class="text-center mt-8">
                <a href="{{ $meetLink }}" class="cryptos-btn inline-block mx-auto" style="margin-left: 480px;">Contact Us</a>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        // Popup logic from your file
        function closePopup() { document.getElementById('popup-loging').classList.add('hidden'); }
        // Add sessionStorage check, setTimeout to show after 2s if not closed
        if (!sessionStorage.getItem('popupClosed')) {
            setTimeout(() => { document.getElementById('popup-loging').classList.remove('hidden'); }, 2000);
        }
        document.querySelector('.close').addEventListener('click', closePopup);
        // Form submission handler (AJAX if needed)
    </script>
@endsection
