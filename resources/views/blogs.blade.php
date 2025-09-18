@extends('layouts.frontend')
@section('title', 'Blogs')
@section('content')
    <section class="py-16 bg-gray-200">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl text-center mb-8">Our Blogs</h1>
            @if(count($bloglists) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($bloglists as $blog)
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h3 class="text-xl font-bold mb-2">{{ $blog->title }}</h3>
                            <p>{{ $blog->short_description }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center">No blogs available at the moment.</p>
            @endif
        </div>
    </section>
@endsection
