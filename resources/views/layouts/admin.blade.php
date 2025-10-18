<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

    <!-- Minimal Icons - Local fallback -->
    <style>
        .fas, .far { font-family: sans-serif; }
        .fa-home::before { content: '🏠'; }
        .fa-envelope::before { content: '✉️'; }
        .fa-question-circle::before { content: '❓'; }
        .fa-calendar-check::before { content: '📅'; }
        .fa-calendar-times::before { content: '🚫'; }
        .fa-users::before { content: '👥'; }
        .fa-file-alt::before { content: '📄'; }
        .fa-cog::before { content: '⚙️'; }
        .fa-external-link-alt::before { content: '🔗'; }
        .fa-sign-out-alt::before { content: '🚪'; }
        .fa-user::before { content: '👤'; }
        .fa-eye::before { content: '👁'; }
        .fa-arrow-right::before { content: '→'; }
        .fa-arrow-left::before { content: '←'; }
        .fa-search::before { content: '🔍'; }
        .fa-globe::before { content: '🌐'; }
        .fa-phone::before { content: '📞'; }
        .fa-share-alt::before { content: '📤'; }
        .fa-shield-alt::before { content: '🛡️'; }
        .fa-building::before { content: '🏢'; }
        .fa-save::before { content: '💾'; }
        .fa-info-circle::before { content: 'ℹ️'; }
        .fa-check-circle::before { content: '✅'; }
        .fa-tags::before { content: '🏷️'; }
        .fa-star::before { content: '⭐'; }
        .fa-blog::before { content: '📝'; }
        .fa-archive::before { content: '📦'; }
        .fa-box-open::before { content: '📤'; }
        .fa-bolt::before { content: '⚡'; }
        .fa-clock::before { content: '🕐'; }
        .fa-exclamation-circle::before { content: '⚠️'; }
        .fa-dollar-sign::before { content: '💰'; }
        .fa-edit::before { content: '✏️'; }
        .fa-plus::before { content: '➕'; }
        .fa-trash::before { content: '🗑️'; }
        .fa-save::before { content: '💾'; }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
    
    <!-- Minimal Fast Admin Styles -->
    <style>
        .admin-sidebar {
            background: #f8fafc;
            border-right: 1px solid #e2e8f0;
        }
        
        .sidebar-brand {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            background: #ffffff;
        }
        
        .sidebar-brand a {
            color: #1f2937;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .sidebar-menu {
            padding: 0.5rem 0;
        }
        
        .menu-item {
            margin: 0;
        }
        
        .menu-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #4b5563;
            text-decoration: none;
            border-left: 3px solid transparent;
        }
        
        .menu-link:hover {
            background: #e5e7eb;
            color: #1f2937;
            border-left-color: #3b82f6;
        }
        
        .menu-link.active {
            background: #dbeafe;
            color: #1e40af;
            border-left-color: #3b82f6;
        }
        
        .menu-icon {
            width: 1rem;
            margin-right: 0.75rem;
            text-align: center;
        }
        
        .admin-header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .admin-content {
            background: #f8fafc;
            min-height: calc(100vh - 4rem);
        }
        
        .navigation-container {
            background: #f8fafc;
            min-height: 100vh;
            padding: 2rem;
        }
        
        .nav-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            margin-bottom: 1rem;
        }
        
        .nav-card:hover {
            border-color: #3b82f6;
        }
        
        .nav-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: white;
        }
        
        .nav-icon.contacts { background: #ef4444; }
        .nav-icon.users { background: #10b981; }
        .nav-icon.content { background: #8b5cf6; }
        .nav-icon.settings { background: #f59e0b; }
        .nav-icon.appointments { background: #3b82f6; }
        .nav-icon.blocked-times { background: #ef4444; }
        
        .nav-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }
        
        .nav-description {
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }
        
        .primary-action {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
        }
        
        .primary-action:hover {
            background: #2563eb;
        }
        
        .primary-action i {
            margin-left: 0.5rem;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="admin-sidebar w-64 flex-shrink-0">
            <div class="sidebar-brand">
                <a href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('img/logo/logo.png') }}" alt="Logo" class="h-16 w-auto mr-3">
                    <span class="text-lg font-semibold">Admin Panel</span>
                </a>
            </div>
            
            <nav class="sidebar-menu">
                <div class="menu-item">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('admin.contacts') }}" class="menu-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-envelope"></i>
                        <span>Contacts</span>
                    </a>
                </div>
                
                <div class="menu-item">
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('admin.appointments.index') }}" class="menu-link {{ request()->routeIs('admin.appointments*') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-calendar-check"></i>
                        <span>Appointments</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('admin.blocked-times.index') }}" class="menu-link {{ request()->routeIs('admin.blocked-times*') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-calendar-times"></i>
                        <span>Blocked Times</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('admin.calendar-settings.index') }}" class="menu-link {{ request()->routeIs('admin.calendar-settings*') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-clock"></i>
                        <span>Calendar Settings</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('admin.promo-codes.index') }}" class="menu-link {{ request()->routeIs('admin.promo-codes*') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-tags"></i>
                        <span>Promo Codes</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('admin.users') }}" class="menu-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-users"></i>
                        <span>User Management</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('admin.cms.index') }}" class="menu-link {{ request()->routeIs('admin.cms*') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-file-alt"></i>
                        <span>CMS Pages</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('admin.visa-management.index') }}" class="menu-link {{ request()->routeIs('admin.visa-management*') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-clock"></i>
                        <span>Visa Management</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('admin.blog.index') }}" class="menu-link {{ request()->routeIs('admin.blog*') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-blog"></i>
                        <span>Blog</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('admin.success-stories.index') }}" class="menu-link {{ request()->routeIs('admin.success-stories*') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-star"></i>
                        <span>Success Stories</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('admin.settings') }}" class="menu-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </div>
                
                <div class="menu-item" style="margin-top: 2rem;">
                    <a href="{{ route('home') }}" class="menu-link" target="_blank">
                        <i class="menu-icon fas fa-external-link-alt"></i>
                        <span>Visit Website</span>
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="admin-header">
                <div class="flex items-center justify-between px-6 py-4">
                    <div>
                        <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Admin Panel')</h1>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">Welcome, {{ Auth::user()->name }}</span>
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="admin-content flex-1 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
    
    <!-- Remove loading screen when page loads -->
    <script>
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });
    </script>
</body>
</html>
