@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Contact Details</h1>
        <a href="{{ route('admin.contacts') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
            Back to Contacts
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Contact Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">{{ $contact->name }}</h2>
                    <p class="text-gray-600">{{ $contact->contact_email }}</p>
                    @if($contact->contact_phone)
                        <p class="text-gray-600">{{ $contact->contact_phone }}</p>
                    @endif
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($contact->status === 'unread') bg-red-100 text-red-800
                        @elseif($contact->status === 'read') bg-yellow-100 text-yellow-800
                        @elseif($contact->status === 'resolved') bg-green-100 text-green-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($contact->status) }}
                    </span>
                    <p class="text-sm text-gray-500 mt-1">{{ $contact->created_at->format('M j, Y \a\t g:i A') }}</p>
                </div>
            </div>
        </div>

        <!-- Contact Details -->
        <div class="px-6 py-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Subject</h3>
                        <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">{{ $contact->subject }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Message</h3>
                        <div class="text-gray-700 bg-gray-50 p-4 rounded-lg whitespace-pre-wrap">{{ $contact->message }}</div>
                    </div>

                    <!-- Quick Reply -->
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h4 class="font-medium text-blue-900 mb-2">Quick Reply</h4>
                        <p class="text-sm text-blue-700 mb-3">Click to compose a reply email:</p>
                        <a href="mailto:{{ $contact->contact_email }}?subject=Re: {{ $contact->subject }}&body=Hi {{ $contact->name }},%0D%0A%0D%0AThank you for contacting Bansal Immigration Consultants.%0D%0A%0D%0A" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Reply via Email
                        </a>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Status Management -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-3">Update Status</h4>
                        <form method="POST" action="{{ route('admin.contacts.update-status', $contact) }}">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="w-full mb-3 px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                <option value="unread" {{ $contact->status === 'unread' ? 'selected' : '' }}>Unread</option>
                                <option value="read" {{ $contact->status === 'read' ? 'selected' : '' }}>Read</option>
                                <option value="resolved" {{ $contact->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="archived" {{ $contact->status === 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                            <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                                Update Status
                            </button>
                        </form>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-3">Contact Information</h4>
                        <div class="space-y-2 text-sm">
                            <div>
                                <span class="font-medium text-gray-600">ID:</span>
                                <span class="text-gray-900">#{{ $contact->id }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-600">Submitted:</span>
                                <span class="text-gray-900">{{ $contact->created_at->format('M j, Y \a\t g:i A') }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-600">IP Address:</span>
                                <span class="text-gray-900">{{ $contact->ip_address ?? 'N/A' }}</span>
                            </div>
                            @if($contact->form_source)
                            <div>
                                <span class="font-medium text-gray-600">Form Source:</span>
                                <span class="text-gray-900">{{ $contact->form_source }}</span>
                            </div>
                            @endif
                            @if($contact->form_variant)
                            <div>
                                <span class="font-medium text-gray-600">Form Variant:</span>
                                <span class="text-gray-900">{{ $contact->form_variant }}</span>
                            </div>
                            @endif
                            @if($contact->forwarded_to)
                            <div>
                                <span class="font-medium text-gray-600">Forwarded To:</span>
                                <span class="text-gray-900">{{ $contact->forwarded_to }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-600">Forwarded At:</span>
                                <span class="text-gray-900">{{ $contact->forwarded_at->format('M j, Y \a\t g:i A') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
