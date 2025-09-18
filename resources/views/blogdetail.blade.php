@extends('layouts.frontend')
@section('title', $blogdetailists->title ?? 'Blog Details')
@section('content')
    <section class="py-16 bg-gray-200">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl text-center mb-8">{{ $blogdetailists->title ?? 'Blog Details' }}</h1>
            <div class="bg-white rounded-lg shadow-md p-6">
                <p>{{ $blogdetailists->description ?? 'Blog content here...' }}</p>
            </div>
        </div>
    </section>
@endsection
