@extends('layouts.frontend')
@section('title', 'Contact Us')
@section('content')
    <section class="py-16 bg-gray-200">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl text-center mb-8">Contact Us</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4">Get in Touch</h3>
                    @include('components.unified-contact-form', [
                        'form_source' => 'contact-page',
                        'form_variant' => 'full',
                        'show_phone' => true,
                        'show_subject' => true
                    ])
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4">Contact Information</h3>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-semibold">Address:</h4>
                            <p>Level 8/278 Collins St, Melbourne VIC 3000, Australia</p>
                        </div>
                        <div>
                            <h4 class="font-semibold">Phone:</h4>
                            <p>+61 396021330</p>
                        </div>
                        <div>
                            <h4 class="font-semibold">Email:</h4>
                            <p>info@bansalimmigration.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
