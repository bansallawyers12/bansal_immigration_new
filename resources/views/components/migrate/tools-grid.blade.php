@props(['tools' => []])

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($tools as $tool)
        <a href="{{ $tool['href'] }}" class="block bg-white rounded-xl border border-gray-200 p-6 hover:border-blue-300 hover:shadow-md transition">
            <div class="flex items-center mb-3">
                <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center mr-3">
                    <i class="{{ $tool['icon'] ?? 'fas fa-toolbox' }} text-blue-600"></i>
                </div>
                <h4 class="text-lg font-semibold text-gray-900">{{ $tool['title'] }}</h4>
            </div>
            <p class="text-sm text-gray-600">{{ $tool['desc'] }}</p>
        </a>
    @endforeach
</div>

