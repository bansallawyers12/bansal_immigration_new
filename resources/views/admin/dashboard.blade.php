@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="navigation-container">
    <div class="dashboard-header text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Admin Portal</h1>
        <p class="text-gray-600">Quick access to all administrative functions</p>
    </div>

    <!-- Navigation Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-w-6xl mx-auto">
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
                    <span class="font-semibold text-blue-600">{{ \App\Models\User::count() }}</span> total users
                </div>
            </div>
            
            <a href="{{ route('admin.users') }}" class="primary-action">
                Manage Users
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>


        <!-- Appointments Management Card -->
        <div class="nav-card">
            <div class="nav-icon appointments">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h3 class="nav-title">Appointments</h3>
            <p class="nav-description">Manage appointments across 4 different calendar types</p>
            
            <div class="flex justify-between items-center mb-4">
                <div class="text-sm text-gray-500">
                    <span class="font-semibold text-blue-600">{{ $stats['today_appointments'] }}</span> today
                </div>
                <div class="text-sm text-gray-500">
                    <span class="font-semibold text-green-600">{{ $stats['upcoming_appointments'] }}</span> upcoming
                </div>
            </div>
            
            <a href="{{ route('admin.appointments.index') }}" class="primary-action">
                Manage Appointments
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <!-- Blocked Times Management Card -->
        <div class="nav-card">
            <div class="nav-icon blocked-times">
                <i class="fas fa-calendar-times"></i>
            </div>
            <h3 class="nav-title">Blocked Times</h3>
            <p class="nav-description">Block specific times and manage calendar availability</p>
            
            <div class="flex justify-between items-center mb-4">
                <div class="text-sm text-gray-500">
                    <span class="font-semibold text-red-600">{{ $stats['active_blocked_times'] }}</span> active
                </div>
                <div class="text-sm text-gray-500">
                    <span class="font-semibold text-gray-600">{{ $stats['total_blocked_times'] }}</span> total
                </div>
            </div>
            
            <a href="{{ route('admin.blocked-times.index') }}" class="primary-action">
                Manage Blocked Times
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
                    <span class="font-semibold text-orange-600">0</span> active sliders (removed)
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

    <!-- Quick Stats Summary -->
    <div class="max-w-4xl mx-auto mt-8">
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Quick Overview</h3>
                <div class="text-sm text-gray-500">
                    {{ $stats['unread_contacts'] }} unread contacts • {{ $stats['today_appointments'] }} appointments today
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
