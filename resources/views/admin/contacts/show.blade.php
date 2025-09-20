@extends('layouts.admin')

@section('title', 'Contact Details')

@section('content')
<div class="navigation-container">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Contact Details</h1>
            <p class="text-gray-600">View and manage contact inquiry details</p>
        </div>
        <a href="{{ route('admin.contacts') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition-colors flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Contacts
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Contact Header -->
            <div class="nav-card">
                <div class="flex items-start justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-16 w-16">
                            <div class="h-16 w-16 rounded-full bg-blue-100 flex items-center justify-center">
                                <span class="text-blue-600 font-bold text-xl">
                                    {{ strtoupper(substr($contact->name, 0, 2)) }}
                                </span>
                            </div>
                        </div>
                        <div class="ml-6">
                            <h2 class="text-2xl font-bold text-gray-900">{{ $contact->name }}</h2>
                            <p class="text-gray-600 text-lg">{{ $contact->contact_email }}</p>
                            @if($contact->contact_phone)
                                <p class="text-gray-600">{{ $contact->contact_phone }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $contact->status_color }}">
                            {{ ucfirst($contact->status) }}
                        </span>
                        <p class="text-sm text-gray-500 mt-2">{{ $contact->created_at->format('M j, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- Subject -->
            <div class="nav-card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-tag mr-2 text-blue-600"></i>
                    Subject
                </h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-800 text-lg">{{ $contact->subject }}</p>
                </div>
            </div>

            <!-- Message -->
            <div class="nav-card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-comment mr-2 text-blue-600"></i>
                    Message
                </h3>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="text-gray-800 whitespace-pre-wrap leading-relaxed">{{ $contact->message }}</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="nav-card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-bolt mr-2 text-blue-600"></i>
                    Quick Actions
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="mailto:{{ $contact->contact_email }}?subject=Re: {{ $contact->subject }}&body=Hi {{ $contact->name }},%0D%0A%0D%0AThank you for contacting Bansal Immigration Consultants.%0D%0A%0D%0A" 
                       class="flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-envelope mr-2"></i>
                        Reply via Email
                    </a>
                    
                    <button onclick="forwardContact({{ $contact->id }}, '{{ $contact->contact_email }}')" 
                            class="flex items-center justify-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-share mr-2"></i>
                        Forward to Team
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Management -->
            <div class="nav-card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-cog mr-2 text-blue-600"></i>
                    Status Management
                </h3>
                <form method="POST" action="{{ route('admin.contacts.update-status', $contact) }}">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="w-full mb-4 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="unread" {{ $contact->status === 'unread' ? 'selected' : '' }}>Unread</option>
                        <option value="read" {{ $contact->status === 'read' ? 'selected' : '' }}>Read</option>
                        <option value="resolved" {{ $contact->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="archived" {{ $contact->status === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                    <button type="submit" class="w-full bg-green-600 text-white px-4 py-3 rounded-lg hover:bg-green-700 transition-colors font-medium">
                        <i class="fas fa-save mr-2"></i>
                        Update Status
                    </button>
                </form>
            </div>

            <!-- Archive/Unarchive -->
            <div class="nav-card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-archive mr-2 text-blue-600"></i>
                    Archive Management
                </h3>
                @if($contact->status === 'archived')
                    <form method="POST" action="{{ route('admin.contacts.unarchive', $contact) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                            <i class="fas fa-box-open mr-2"></i>
                            Unarchive Contact
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('admin.contacts.archive', $contact) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full bg-gray-600 text-white px-4 py-3 rounded-lg hover:bg-gray-700 transition-colors font-medium">
                            <i class="fas fa-archive mr-2"></i>
                            Archive Contact
                        </button>
                    </form>
                @endif
            </div>

            <!-- Contact Information -->
            <div class="nav-card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                    Contact Information
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="font-medium text-gray-600">Contact ID:</span>
                        <span class="text-gray-900 font-mono">#{{ $contact->id }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="font-medium text-gray-600">Submitted:</span>
                        <span class="text-gray-900">{{ $contact->created_at->format('M j, Y') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="font-medium text-gray-600">Time:</span>
                        <span class="text-gray-900">{{ $contact->created_at->format('g:i A') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="font-medium text-gray-600">IP Address:</span>
                        <span class="text-gray-900 font-mono text-sm">{{ $contact->ip_address ?? 'N/A' }}</span>
                    </div>
                    
                    @if($contact->form_source)
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="font-medium text-gray-600">Form Source:</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $contact->form_source }}
                        </span>
                    </div>
                    @endif
                    
                    @if($contact->form_variant)
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="font-medium text-gray-600">Form Variant:</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ $contact->form_variant }}
                        </span>
                    </div>
                    @endif
                    
                    @if($contact->forwarded_to)
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="font-medium text-gray-600">Forwarded To:</span>
                        <span class="text-gray-900">{{ $contact->forwarded_to }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center py-2">
                        <span class="font-medium text-gray-600">Forwarded At:</span>
                        <span class="text-gray-900">{{ $contact->forwarded_at->format('M j, Y g:i A') }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Contact Timeline -->
            <div class="nav-card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-clock mr-2 text-blue-600"></i>
                    Timeline
                </h3>
                <div class="space-y-3">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-envelope text-blue-600 text-sm"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Contact submitted</p>
                            <p class="text-xs text-gray-500">{{ $contact->created_at->format('M j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                    
                    @if($contact->status !== 'unread')
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-8 w-8 bg-yellow-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-eye text-yellow-600 text-sm"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Marked as {{ $contact->status }}</p>
                            <p class="text-xs text-gray-500">{{ $contact->updated_at->format('M j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                    @endif
                    
                    @if($contact->forwarded_to)
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-8 w-8 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-share text-green-600 text-sm"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Forwarded to {{ $contact->forwarded_to }}</p>
                            <p class="text-xs text-gray-500">{{ $contact->forwarded_at->format('M j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Forward Contact Modal -->
<div id="forward-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Forward Contact</h3>
                <button onclick="closeForwardModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="forward-form" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="recipient_email" class="block text-sm font-medium text-gray-700 mb-2">
                        Recipient Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           id="recipient_email" 
                           name="recipient_email" 
                           value="info@bansalimmigration.com.au"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>
                
                <div class="mb-4">
                    <label for="forward_message" class="block text-sm font-medium text-gray-700 mb-2">
                        Additional Message (Optional)
                    </label>
                    <textarea id="forward_message" 
                              name="message" 
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Add any additional notes..."></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeForwardModal()" 
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                        Forward
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function forwardContact(contactId, contactEmail) {
    const modal = document.getElementById('forward-modal');
    const form = document.getElementById('forward-form');
    
    form.action = `/admin/contacts/${contactId}/forward`;
    document.getElementById('recipient_email').value = 'info@bansalimmigration.com.au';
    document.getElementById('forward_message').value = '';
    
    modal.classList.remove('hidden');
}

function closeForwardModal() {
    document.getElementById('forward-modal').classList.add('hidden');
}
</script>
@endpush
@endsection