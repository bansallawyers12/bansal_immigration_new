@extends('layouts.admin')

@section('title', 'Contact Management')

@section('content')
<div class="navigation-container">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Contact Management</h1>
            <p class="text-gray-600">Manage customer inquiries and contact form submissions</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition-colors flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Dashboard
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

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="nav-card">
            <div class="flex items-center">
                <div class="nav-icon" style="background: #ef4444; width: 50px; height: 50px;">
                    <i class="fas fa-envelope" style="font-size: 1.25rem;"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $contacts->where('status', 'unread')->count() }}</h3>
                    <p class="text-gray-600">Unread</p>
                </div>
            </div>
        </div>
        
        <div class="nav-card">
            <div class="flex items-center">
                <div class="nav-icon" style="background: #f59e0b; width: 50px; height: 50px;">
                    <i class="fas fa-eye" style="font-size: 1.25rem;"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $contacts->where('status', 'read')->count() }}</h3>
                    <p class="text-gray-600">Read</p>
                </div>
            </div>
        </div>
        
        <div class="nav-card">
            <div class="flex items-center">
                <div class="nav-icon" style="background: #10b981; width: 50px; height: 50px;">
                    <i class="fas fa-check-circle" style="font-size: 1.25rem;"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $contacts->where('status', 'resolved')->count() }}</h3>
                    <p class="text-gray-600">Resolved</p>
                </div>
            </div>
        </div>
        
        <div class="nav-card">
            <div class="flex items-center">
                <div class="nav-icon" style="background: #6b7280; width: 50px; height: 50px;">
                    <i class="fas fa-archive" style="font-size: 1.25rem;"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $contacts->where('status', 'archived')->count() }}</h3>
                    <p class="text-gray-600">Archived</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="nav-card mb-6">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-64">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <input type="text" 
                       id="search" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search by name, email, or subject..."
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select id="status" 
                        name="status"
                        class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    <option value="">All Statuses</option>
                    <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
                    <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                    <option value="resolved" {{ request('status') === 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>
            <div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                    <i class="fas fa-search mr-2"></i>
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Bulk Actions -->
    <div class="nav-card mb-6" id="bulk-actions" style="display: none;">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <span id="selected-count" class="text-sm font-medium text-gray-700 mr-4">0 contacts selected</span>
                <div class="flex gap-2">
                    <select id="bulk-status" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                        <option value="">Update Status</option>
                        <option value="unread">Mark as Unread</option>
                        <option value="read">Mark as Read</option>
                        <option value="resolved">Mark as Resolved</option>
                        <option value="archived">Archive</option>
                    </select>
                    <button id="apply-bulk-status" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm">
                        Apply
                    </button>
                </div>
            </div>
            <div class="flex gap-2">
                <button id="bulk-forward-btn" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors text-sm flex items-center">
                    <i class="fas fa-share mr-2"></i>
                    Forward
                </button>
                <button id="bulk-archive-btn" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors text-sm flex items-center">
                    <i class="fas fa-archive mr-2"></i>
                    Archive
                </button>
            </div>
        </div>
    </div>

    <!-- Contacts Table -->
    <div class="nav-card">
        @if($contacts->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left">
                                <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Subject
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($contacts as $contact)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="contact-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                                       value="{{ $contact->id }}" data-contact-id="{{ $contact->id }}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <span class="text-blue-600 font-medium text-sm">
                                                {{ strtoupper(substr($contact->name, 0, 2)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $contact->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $contact->contact_email }}</div>
                                        @if($contact->contact_phone)
                                            <div class="text-sm text-gray-500">{{ $contact->contact_phone }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ Str::limit($contact->subject, 50) }}</div>
                                @if($contact->form_source)
                                    <div class="text-xs text-gray-500 mt-1">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $contact->form_source }}
                                        </span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $contact->status_color }}">
                                    {{ ucfirst($contact->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $contact->formatted_date }}<br>
                                <span class="text-xs">{{ $contact->formatted_time }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.contacts.show', $contact) }}" 
                                       class="text-blue-600 hover:text-blue-900 transition-colors" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <button onclick="forwardContact({{ $contact->id }}, '{{ $contact->contact_email }}')" 
                                            class="text-green-600 hover:text-green-900 transition-colors" title="Forward">
                                        <i class="fas fa-share"></i>
                                    </button>
                                    
                                    @if($contact->status === 'archived')
                                        <form method="POST" action="{{ route('admin.contacts.unarchive', $contact) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-blue-600 hover:text-blue-900 transition-colors" title="Unarchive">
                                                <i class="fas fa-box-open"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.contacts.archive', $contact) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-gray-600 hover:text-gray-900 transition-colors" title="Archive">
                                                <i class="fas fa-archive"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $contacts->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="nav-icon" style="background: #6b7280; width: 80px; height: 80px; margin: 0 auto 2rem;">
                    <i class="fas fa-envelope" style="font-size: 2rem;"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No contacts found</h3>
                <p class="text-gray-500">No contacts match your current filters.</p>
            </div>
        @endif
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
// Bulk selection functionality
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select-all');
    const contactCheckboxes = document.querySelectorAll('.contact-checkbox');
    const bulkActionsDiv = document.getElementById('bulk-actions');
    const selectedCountSpan = document.getElementById('selected-count');
    
    // Select all functionality
    selectAllCheckbox.addEventListener('change', function() {
        contactCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateBulkActions();
    });
    
    // Individual checkbox functionality
    contactCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSelectAllState();
            updateBulkActions();
        });
    });
    
    function updateSelectAllState() {
        const checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
        selectAllCheckbox.checked = checkedBoxes.length === contactCheckboxes.length;
        selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < contactCheckboxes.length;
    }
    
    function updateBulkActions() {
        const checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
        const selectedCount = checkedBoxes.length;
        
        if (selectedCount > 0) {
            bulkActionsDiv.style.display = 'block';
            selectedCountSpan.textContent = `${selectedCount} contact${selectedCount > 1 ? 's' : ''} selected`;
        } else {
            bulkActionsDiv.style.display = 'none';
        }
    }
    
    // Bulk status update
    document.getElementById('apply-bulk-status').addEventListener('click', function() {
        const status = document.getElementById('bulk-status').value;
        if (!status) return;
        
        const checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
        const contactIds = Array.from(checkedBoxes).map(cb => cb.value);
        
        if (contactIds.length === 0) return;
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.contacts.bulk-status") }}';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        contactIds.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'contact_ids[]';
            input.value = id;
            form.appendChild(input);
        });
        
        const statusInput = document.createElement('input');
        statusInput.type = 'hidden';
        statusInput.name = 'status';
        statusInput.value = status;
        
        form.appendChild(csrfToken);
        form.appendChild(statusInput);
        document.body.appendChild(form);
        form.submit();
    });
    
    // Bulk forward
    document.getElementById('bulk-forward-btn').addEventListener('click', function() {
        const checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
        if (checkedBoxes.length === 0) return;
        
        const email = prompt('Enter recipient email:', 'info@bansalimmigration.com.au');
        if (!email) return;
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.contacts.bulk-forward") }}';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        checkedBoxes.forEach(cb => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'contact_ids[]';
            input.value = cb.value;
            form.appendChild(input);
        });
        
        const emailInput = document.createElement('input');
        emailInput.type = 'hidden';
        emailInput.name = 'recipient_email';
        emailInput.value = email;
        
        form.appendChild(csrfToken);
        form.appendChild(emailInput);
        document.body.appendChild(form);
        form.submit();
    });
    
    // Bulk archive
    document.getElementById('bulk-archive-btn').addEventListener('click', function() {
        const checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
        if (checkedBoxes.length === 0) return;
        
        if (!confirm('Are you sure you want to archive the selected contacts?')) return;
        
        const contactIds = Array.from(checkedBoxes).map(cb => cb.value);
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.contacts.bulk-archive") }}';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        contactIds.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'contact_ids[]';
            input.value = id;
            form.appendChild(input);
        });
        
        form.appendChild(csrfToken);
        document.body.appendChild(form);
        form.submit();
    });
});

// Forward modal functionality
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