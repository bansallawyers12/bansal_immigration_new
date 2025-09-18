<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom Admin Styles -->
    <style>
        .admin-sidebar {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .menu-item {
            margin: 0.25rem 1rem;
        }
        
        .menu-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .menu-link:hover, .menu-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(4px);
        }
        
        .menu-icon {
            width: 1.25rem;
            margin-right: 0.75rem;
        }
        
        .admin-header {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-bottom: 1px solid #e5e7eb;
        }
        
        .admin-content {
            background: #f8fafc;
            min-height: calc(100vh - 4rem);
        }
        
        .navigation-container {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            padding: 3rem 2rem;
        }
        
        .nav-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }
        
        .nav-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }
        
        .nav-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        
        .nav-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: white;
        }
        
        .nav-icon.contacts { background: linear-gradient(135deg, #ef4444, #dc2626); }
        .nav-icon.users { background: linear-gradient(135deg, #10b981, #059669); }
        .nav-icon.content { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
        .nav-icon.settings { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .nav-icon.enquiries { background: linear-gradient(135deg, #06b6d4, #0891b2); }
        
        .nav-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }
        
        .nav-description {
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }
        
        .primary-action {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .primary-action:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
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
                <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-8 w-auto mr-3">
                    <span class="text-white font-semibold text-lg">Admin Panel</span>
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
                    <a href="{{ route('admin.enquiries') }}" class="menu-link {{ request()->routeIs('admin.enquiries*') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-question-circle"></i>
                        <span>Enquiries</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('admin.users') }}" class="menu-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-users"></i>
                        <span>User Management</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('admin.content') }}" class="menu-link {{ request()->routeIs('admin.content*') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-file-alt"></i>
                        <span>Content</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('admin.settings') }}" class="menu-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </div>
                
                <div class="menu-item mt-8">
                    <a href="{{ route('home') }}" class="menu-link">
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
</body>
</html>
