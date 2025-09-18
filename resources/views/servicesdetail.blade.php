@extends('layouts.frontend')
@section('title', $servicesdetailists->title ?? 'Service Details')
@section('content')
    <section class="py-16 bg-gray-200">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl text-center mb-8">{{ $servicesdetailists->title ?? 'Service Details' }}</h1>
            <p>{{ $servicesdetailists->description ?? 'Service details content here...' }}</p>
        </div>
    </section>
@endsection
