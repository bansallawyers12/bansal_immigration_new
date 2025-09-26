<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-14">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $title ?? 'Migrate to Australia' }}</h1>
            @isset($subtitle)
            <p class="text-lg md:text-xl opacity-90 mb-6">{{ $subtitle }}</p>
            @endisset
            @isset($description)
            <p class="text-base md:text-lg mb-8 opacity-90">{{ $description }}</p>
            @endisset
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ $primary_href ?? route('appointment') }}" class="bg-white text-blue-700 px-7 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200">
                    {{ $primary_label ?? 'Book Free Consultation' }}
                </a>
                <a href="{{ $secondary_href ?? route('migrate-to-australia.pr-calculator') }}" class="bg-blue-500 text-white px-7 py-3 rounded-lg font-semibold hover:bg-blue-400 transition-colors duration-200">
                    {{ $secondary_label ?? 'Calculate Your Points' }}
                </a>
            </div>
        </div>
    </div>
</div>

