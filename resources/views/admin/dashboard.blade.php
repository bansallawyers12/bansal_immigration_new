@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="navigation-container">
    <div class="dashboard-header text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Admin Portal</h1>
        <p class="text-gray-600">Quick access to all administrative functions</p>
    </div>

    <!-- Navigation Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
        <!-- Contacts Management Card -->
        <div class="nav-card">
            <div class="nav-icon contacts">
                <i class="fas fa-envelope"></i>
            </div>
            <h3 class="nav-title">Contact Management</h3>
            <p class="nav-description">Manage customer inquiries and contact form submissions</p>
            
            <div class="flex justify-between items-center mb-4">
                <div class="text-sm text-gray-500">
                    <span class="font-semibold text-red-600">{{ $stats['unread_contacts'] }}</span> unread
                </div>
                <div class="text-sm text-gray-500">
                    <span class="font-semibold text-blue-600">{{ $stats['total_contacts'] }}</span> total
                </div>
            </div>
            
            <a href="{{ route('admin.contacts') }}" class="primary-action">
                Manage Contacts
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <!-- User Management Card -->
        <div class="nav-card">
            <div class="nav-icon users">
                <i class="fas fa-users"></i>
            </div>
            <h3 class="nav-title">User Management</h3>
            <p class="nav-description">Manage admin users and their permissions</p>
            
            <div class="flex justify-between items-center mb-4">
                <div class="text-sm text-gray-500">
                    <span class="font-semibold text-green-600">{{ \App\Models\User::active()->count() }}</span> active
                </div>
                <div class="text-sm text-gray-500">
                    <span class="font-semibold text-blue-600">{{ \App\Models\User::count() }}</span> total
                </div>
            </div>
            
            <a href="{{ route('admin.users') }}" class="primary-action">
                Manage Users
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <!-- Enquiries Card -->
        <div class="nav-card">
            <div class="nav-icon enquiries">
                <i class="fas fa-question-circle"></i>
            </div>
            <h3 class="nav-title">Enquiries</h3>
            <p class="nav-description">Track and manage customer enquiries and requests</p>
            
            <div class="flex justify-between items-center mb-4">
                <div class="text-sm text-gray-500">
                    <span class="font-semibold text-blue-600">{{ $stats['recent_enquiries'] }}</span> recent
                </div>
                <div class="text-sm text-gray-500">
                    <span class="font-semibold text-gray-600">{{ \App\Models\Enquiry::count() }}</span> total
                </div>
            </div>
            
            <a href="{{ route('admin.enquiries') }}" class="primary-action">
                View Enquiries
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <!-- Content Management Card -->
        <div class="nav-card">
            <div class="nav-icon content">
                <i class="fas fa-file-alt"></i>
            </div>
            <h3 class="nav-title">Content Management</h3>
            <p class="nav-description">Manage blogs, services, and website content</p>
            
            <div class="flex justify-between items-center mb-4">
                <div class="text-sm text-gray-500">
                    <span class="font-semibold text-purple-600">{{ $stats['total_blogs'] }}</span> blogs
                </div>
                <div class="text-sm text-gray-500">
                    <span class="font-semibold text-yellow-600">{{ $stats['total_services'] }}</span> services
                </div>
            </div>
            
            <a href="{{ route('admin.content') }}" class="primary-action">
                Manage Content
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <!-- Settings Card -->
        <div class="nav-card">
            <div class="nav-icon settings">
                <i class="fas fa-cog"></i>
            </div>
            <h3 class="nav-title">System Settings</h3>
            <p class="nav-description">Configure website settings and preferences</p>
            
            <div class="flex justify-between items-center mb-4">
                <div class="text-sm text-gray-500">
                    <span class="font-semibold text-orange-600">{{ $stats['active_sliders'] }}</span> active sliders
                </div>
                <div class="text-sm text-gray-500">
                    Last updated today
                </div>
            </div>
            
            <a href="{{ route('admin.settings') }}" class="primary-action">
                System Settings
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <!-- Website Link Card -->
        <div class="nav-card">
            <div class="nav-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);">
                <i class="fas fa-external-link-alt"></i>
            </div>
            <h3 class="nav-title">Visit Website</h3>
            <p class="nav-description">View the public website and see live changes</p>
            
            <div class="flex justify-between items-center mb-4">
                <div class="text-sm text-gray-500">
                    Public view
                </div>
                <div class="text-sm text-gray-500">
                    Opens in new tab
                </div>
            </div>
            
            <a href="{{ route('home') }}" target="_blank" class="primary-action">
                Visit Website
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>

    <!-- Recent Activity Section -->
    @if($recent_contacts->count() > 0)
    <div class="max-w-4xl mx-auto mt-12">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Contacts</h3>
                    <a href="{{ route('admin.contacts') }}" class="text-sm text-blue-600 hover:text-blue-800">View All →</a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($recent_contacts as $contact)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $contact->name }}</p>
                                <p class="text-sm text-gray-600">{{ $contact->contact_email }}</p>
                                <p class="text-xs text-gray-500">{{ $contact->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($contact->status === 'unread') bg-red-100 text-red-800
                                @elseif($contact->status === 'read') bg-yellow-100 text-yellow-800
                                @elseif($contact->status === 'resolved') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($contact->status) }}
                            </span>
                            <a href="{{ route('admin.contacts.show', $contact) }}" 
                               class="text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-blue-50">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
