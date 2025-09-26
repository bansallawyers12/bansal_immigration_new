@extends('layouts.main')

@section('title', 'Parent Visas | Bansal Immigration')
@section('description', 'Overview of Australian parent visa options to reunite families in Australia.')

@section('content')
<div class="bg-gradient-to-r from-emerald-600 to-emerald-800 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">Parent Visas</h1>
        <p class="text-xl opacity-90">Explore permanent and temporary options for parents to join their children in Australia.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="/" class="hover:text-emerald-600">Home</a></li>
            <li>/</li>
            <li><a href="{{ route('migrate-to-australia.index') }}" class="hover:text-emerald-600">Migrate to Australia</a></li>
            <li>/</li>
            <li class="text-gray-900">Parent Visas</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Parent Visa Options</h3>
                <ul class="space-y-1 text-sm">
                    <li><a href="{{ route('family-visa.contributory-parent-143') }}" class="text-emerald-600 hover:text-emerald-800">Contributory Parent (143)</a></li>
                    <li><a href="{{ route('family-visa.parent-visa-103') }}" class="text-emerald-600 hover:text-emerald-800">Parent Visa (103)</a></li>
                    <li><a href="{{ route('family-visa.contributory-aged-parent-884') }}" class="text-emerald-600 hover:text-emerald-800">Contributory Aged Parent (884)</a></li>
                    <li><a href="{{ route('family-visa.contributory-aged-parent-864') }}" class="text-emerald-600 hover:text-emerald-800">Contributory Aged Parent (864)</a></li>
                    <li><a href="{{ route('family-visa.contributory-parent-173') }}" class="text-emerald-600 hover:text-emerald-800">Contributory Parent (173)</a></li>
                    <li><a href="{{ route('family-visa.aged-parent-804') }}" class="text-emerald-600 hover:text-emerald-800">Aged Parent (804)</a></li>
                    <li><a href="{{ route('family-visa.sponsored-parent-870') }}" class="text-emerald-600 hover:text-emerald-800">Sponsored Parent (870)</a></li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="{{ route('family-visa.contributory-parent-143') }}" class="block p-6 bg-white rounded-lg border hover:shadow">Contributory Parent (143)</a>
                <a href="{{ route('family-visa.parent-visa-103') }}" class="block p-6 bg-white rounded-lg border hover:shadow">Parent Visa (103)</a>
                <a href="{{ route('family-visa.contributory-aged-parent-884') }}" class="block p-6 bg-white rounded-lg border hover:shadow">Contributory Aged Parent (884)</a>
                <a href="{{ route('family-visa.contributory-aged-parent-864') }}" class="block p-6 bg-white rounded-lg border hover:shadow">Contributory Aged Parent (864)</a>
                <a href="{{ route('family-visa.contributory-parent-173') }}" class="block p-6 bg-white rounded-lg border hover:shadow">Contributory Parent (173)</a>
                <a href="{{ route('family-visa.aged-parent-804') }}" class="block p-6 bg-white rounded-lg border hover:shadow">Aged Parent (804)</a>
                <a href="{{ route('family-visa.sponsored-parent-870') }}" class="block p-6 bg-white rounded-lg border hover:shadow">Sponsored Parent (870)</a>
            </div>

            <div class="mt-8 bg-white rounded-lg shadow-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Need Help Choosing a Parent Visa?</h3>
                <p class="text-gray-600 mb-6">We’ll assess your eligibility and help you select the right parent visa pathway. Share your details and we’ll get back with personalised guidance.</p>
                @include('components.unified-contact-form', [
                    'form_source' => 'parent-visas-page',
                    'form_variant' => 'full',
                    'show_phone' => true,
                    'show_subject' => true
                ])
            </div>
        </div>
    </div>
</div>
@endsection

