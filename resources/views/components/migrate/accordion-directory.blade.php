@props(['sections' => []])

<div x-data="{ open: null }" class="divide-y divide-gray-200 border border-gray-200 rounded-xl bg-white">
    @foreach($sections as $index => $section)
        <div>
            <button @click="open === {{ $index }} ? open = null : open = {{ $index }}" :aria-expanded="open === {{ $index }}" class="w-full flex items-center justify-between px-5 py-4 text-left">
                <div class="flex items-center">
                    <div class="w-9 h-9 rounded-lg bg-{{ $section['color'] ?? 'blue' }}-50 flex items-center justify-center mr-3">
                        <i class="{{ $section['icon'] ?? 'fas fa-folder' }} text-{{ $section['color'] ?? 'blue' }}-600 text-sm"></i>
                    </div>
                    <span class="font-semibold text-gray-900">{{ $section['title'] }}</span>
                </div>
                <i class="fas" :class="open === {{ $index }} ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
            </button>
            <div x-show="open === {{ $index }}" class="px-5 pb-5" x-transition>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach(($section['links'] ?? []) as $label => $href)
                        <a href="{{ $href }}" class="block px-3 py-2 rounded-lg text-sm bg-gray-50 hover:bg-{{ $section['color'] ?? 'blue' }}-50 text-gray-700 hover:text-{{ $section['color'] ?? 'blue' }}-700 transition">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
                @if(isset($section['view_all']))
                    <div class="mt-3">
                        <a href="{{ $section['view_all']['href'] }}" class="text-{{ $section['color'] ?? 'blue' }}-700 font-medium hover:underline">{{ $section['view_all']['label'] ?? 'View all' }}</a>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>

