@extends('layouts.main')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-gray-900 mb-4">Celebrity Visas</h1>
    <p class="text-gray-700 mb-8">Showcase of celebrity visas granted through Bansal Immigration. This is placeholder content. Replace with real stories and gallery images.</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @for($i = 1; $i <= 6; $i++)
            <div class="bg-white rounded-xl shadow p-4">
                <div class="aspect-[4/3] bg-gray-200 rounded-lg mb-3 flex items-center justify-center text-gray-500">Photo {{ $i }}</div>
                <h3 class="font-semibold text-gray-900">Celebrity Case {{ $i }}</h3>
                <p class="text-sm text-gray-600">Short description about the visa grant. Replace with real content.</p>
            </div>
        @endfor
    </div>
</div>
@endsection


