@props(['title', 'color' => 'blue', 'icon' => null, 'links' => [], 'cta' => null])

<div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300 border border-gray-100">
    <div class="flex items-center mb-6">
        <div class="w-16 h-16 rounded-xl flex items-center justify-center mr-4"
             style="background: linear-gradient(135deg, var(--tw-color-start), var(--tw-color-end));"
             x-data
             x-init="$el.style.setProperty('--tw-color-start', getComputedStyle(document.documentElement).getPropertyValue('--tw-{{ $color }}-50') || '#f0f9ff'); $el.style.setProperty('--tw-color-end', getComputedStyle(document.documentElement).getPropertyValue('--tw-{{ $color }}-100') || '#e0f2fe')">
            @if($icon)
                <i class="{{ $icon }} text-{{ $color }}-700 text-2xl"></i>
            @endif
        </div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $title }}</h3>
    </div>
    @isset($slot)
        <p class="text-gray-700 mb-6">{{ $slot }}</p>
    @endisset
    @if(!empty($links))
        <ul class="space-y-3 mb-6">
            @foreach($links as $label => $href)
                <li>
                    <a href="{{ $href }}" class="text-{{ $color }}-600 hover:text-{{ $color }}-800 font-medium">{{ $label }}</a>
                </li>
            @endforeach
        </ul>
    @endif
    @if($cta)
        <a href="{{ $cta['href'] }}" class="inline-block bg-{{ $color }}-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-{{ $color }}-700 transition-colors duration-200">
            {{ $cta['label'] }}
        </a>
    @endif
</div>

