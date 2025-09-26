@extends('layouts.main')

@section('title', 'Skilled Migration | Bansal Immigration')
@section('description', 'Overview of Australian skilled migration visas including 189, 190, 491, 191, 887 and Temporary Graduate 485 options.')

@section('content')
<div class="relative overflow-hidden">
    <img src="{{ asset('img/Ausse-flags-hero.jpeg') }}" alt="Australian flags" class="absolute inset-0 w-full h-full object-cover" />
    <div class="relative bg-gradient-to-r from-blue-900/70 to-blue-700/60 text-white py-20 md:py-24">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">Skilled Migration</h1>
            <p class="text-xl opacity-90">Permanent and provisional skilled migration pathways.</p>
        </div>
    </div>
    <div class="h-1"></div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="/" class="hover:text-blue-600">Home</a></li>
            <li>/</li>
            <li><a href="{{ route('migrate-to-australia.index') }}" class="hover:text-blue-600">Migrate to Australia</a></li>
            <li>/</li>
            <li class="text-gray-900">Skilled Migration</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Skilled Migration</h3>
                <ul class="space-y-1 text-sm">
                    <li><a href="{{ route('migrate-to-australia.skilled-independent') }}" class="text-blue-600 hover:text-blue-800">Skilled Independent (189)</a></li>
                    <li><a href="{{ route('migrate-to-australia.skilled-nominated') }}" class="text-blue-600 hover:text-blue-800">Skilled Nominated (190)</a></li>
                    <li><a href="{{ route('migrate-to-australia.skilled-work-regional') }}" class="text-blue-600 hover:text-blue-800">Skilled Work Regional (491)</a></li>
                    <li><a href="{{ route('migrate-to-australia.pr-skilled-regional') }}" class="text-blue-600 hover:text-blue-800">PR Skilled Regional (191)</a></li>
                    <li><a href="{{ route('migrate-to-australia.skilled-regional') }}" class="text-blue-600 hover:text-blue-800">Skilled Regional (887)</a></li>
                    <li><a href="{{ route('migrate-to-australia.temporary-graduate') }}" class="text-blue-600 hover:text-blue-800">Temporary Graduate (485)</a></li>
                    <li><a href="{{ route('migrate-to-australia.post-study-work') }}" class="text-blue-600 hover:text-blue-800">Post Study Work (485)</a></li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">🎯 Invitation Pathways</h3>
                    <p class="text-blue-800">Points-tested visas with state nomination and regional pathways.</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-green-900 mb-3">🧭 State & Regional</h3>
                    <p class="text-green-800">Guidance on EOI, state nomination and regional requirements.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <a href="{{ route('migrate-to-australia.skilled-independent') }}" class="block p-6 bg-white rounded-lg border hover:shadow">Skilled Independent (189)</a>
                <a href="{{ route('migrate-to-australia.skilled-nominated') }}" class="block p-6 bg-white rounded-lg border hover:shadow">Skilled Nominated (190)</a>
                <a href="{{ route('migrate-to-australia.skilled-work-regional') }}" class="block p-6 bg-white rounded-lg border hover:shadow">Skilled Work Regional (491)</a>
                <a href="{{ route('migrate-to-australia.pr-skilled-regional') }}" class="block p-6 bg-white rounded-lg border hover:shadow">PR Skilled Regional (191)</a>
                <a href="{{ route('migrate-to-australia.skilled-regional') }}" class="block p-6 bg-white rounded-lg border hover:shadow">Skilled Regional (887)</a>
                <a href="{{ route('migrate-to-australia.temporary-graduate') }}" class="block p-6 bg-white rounded-lg border hover:shadow">Temporary Graduate (485)</a>
                <a href="{{ route('migrate-to-australia.post-study-work') }}" class="block p-6 bg-white rounded-lg border hover:shadow">Post Study Work (485)</a>
            </div>

            <div class="mt-8 bg-white rounded-lg shadow-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Need Help With Skilled Migration?</h3>
                <p class="text-gray-600 mb-6">Our consultants will assess your eligibility and recommend the best visa pathway. Share your details and we’ll get back with personalised guidance.</p>
                @include('components.unified-contact-form', [
                    'form_source' => 'skilled-migration-page',
                    'form_variant' => 'full',
                    'show_phone' => true,
                    'show_subject' => true
                ])
            </div>
        </div>
    </div>
</div>
@endsection

