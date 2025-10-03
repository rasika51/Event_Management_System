<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="referrer" content="no-referrer-when-downgrade">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' 'unsafe-eval' data: blob: https:;">

    <title>{{ config('app.name', 'Event Management System') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #667eea;
            --primary-dark: #764ba2;
            --secondary-color: #1e3a8a;
            --accent-color: #1e40af;
            --success-color: #10b981;
            --success-dark: #059669;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --light-color: #f9fafb;
            --sidebar-bg: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --gradient-primary: linear-gradient(45deg, #667eea, #764ba2);
            --gradient-success: linear-gradient(45deg, #10b981, #059669);
            --gradient-dark: linear-gradient(45deg, #1e3a8a, #1e40af);
        }

        .hero-section {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
            border: none;
            box-shadow: var(--card-shadow);
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .navbar-brand {
            font-weight: bold;
        }
        
        .sidebar {
            min-height: 100vh;
            background: var(--gradient-primary);
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            z-index: 1000;
            overflow-y: auto;
            box-shadow: 4px 0 20px rgba(102, 126, 234, 0.4);
        }
        
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.6rem 1.5rem;
            border-radius: 0.5rem;
            margin: 0.1rem 1rem;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
            border: 1px solid transparent;
        }
        
        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .sidebar .nav-link i {
            width: 24px;
            text-align: center;
            font-size: 1.1rem;
        }
        
        .sidebar-brand {
            padding: 1.5rem 1.5rem;
            color: #fff;
            font-weight: bold;
            font-size: 1.1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .top-navbar {
            margin-left: 280px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            padding: 1rem 2rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 999;
        }
        
        .content-wrapper {
            padding: 2rem;
        }
        
        .stats-card {
            background: var(--gradient-primary);
            border: none;
            border-radius: 1rem;
            padding: 1rem;
            box-shadow: 0 8px 32px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            color: white;
        }
        
        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            pointer-events: none;
        }
        
        .stats-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(30, 58, 138, 0.5);
        }
        
        .stats-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .stats-label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.05em;
        }
        
        .stats-icon {
            width: 40px;
            height: 40px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: white;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .icon-primary { background: rgba(255, 255, 255, 0.2); }
        .icon-success { background: rgba(255, 255, 255, 0.2); }
        .icon-warning { background: rgba(255, 255, 255, 0.2); }
        .icon-info { background: rgba(255, 255, 255, 0.2); }
        
        .action-btn {
            border: none;
            border-radius: 0.75rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary-gradient {
            background: var(--gradient-primary);
            color: white;
        }
        
        .btn-primary-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(102, 126, 234, 0.5);
            color: white;
        }
        
        .btn-outline-gradient {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }
        
        .btn-outline-gradient:hover {
            background: var(--gradient-primary);
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-view-all {
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 0.75rem;
            padding: 0.5rem 1rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn-view-all:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
            color: white;
        }
        
        .welcome-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .recent-events-card {
            background: white;
            border: none;
            border-radius: 1rem;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-bottom: 1px solid #e2e8f0;
            padding: 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
        }
        
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -280px;
            }
            .main-content {
                margin-left: 0;
            }
            .top-navbar {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        @auth
            <!-- Sidebar Navigation -->
            <div class="sidebar">
                <div class="sidebar-brand">
                    <i class="bi bi-calendar-event me-2"></i>Event Management
                </div>
                
                <nav class="nav flex-column">
                    @if(auth()->user()->isAdmin())
                        <!-- Admin Navigation -->
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                           href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard
                        </a>
                        <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" 
                           href="{{ route('admin.users') }}">
                            <i class="bi bi-people me-2"></i>User Management
                        </a>
                        <a class="nav-link {{ request()->routeIs('admin.events*') ? 'active' : '' }}" 
                           href="{{ route('admin.events') }}">
                            <i class="bi bi-calendar-check me-2"></i>All Events
                        </a>
                        <a class="nav-link {{ request()->routeIs('events.create') ? 'active' : '' }}" 
                           href="{{ route('events.create') }}">
                            <i class="bi bi-calendar-plus me-2"></i>Create Event
                        </a>
                        <a class="nav-link {{ request()->routeIs('events.index') ? 'active' : '' }}" 
                           href="{{ route('events.index') }}">
                            <i class="bi bi-calendar-event me-2"></i>My Events
                        </a>
                    @else
                        <!-- User Navigation -->
                        <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" 
                           href="{{ route('user.dashboard') }}">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard
                        </a>
                        <a class="nav-link {{ request()->routeIs('events.index') ? 'active' : '' }}" 
                           href="{{ route('events.index') }}">
                            <i class="bi bi-calendar-event me-2"></i>My Events
                        </a>
                        <a class="nav-link {{ request()->routeIs('events.create') ? 'active' : '' }}" 
                           href="{{ route('events.create') }}">
                            <i class="bi bi-plus-circle me-2"></i>Create Event
                        </a>
                    @endif
                    
                    <!-- User Profile Section -->
                    <div class="mt-auto" style="border-top: 1px solid rgba(255, 255, 255, 0.1); margin-top: auto;">
                        <div class="nav-link text-light" style="cursor: default;">
                            <i class="bi bi-person-circle me-2"></i>{{ auth()->user()->name }}
                            <div class="d-block text-light fw-bold mt-1" style="font-size: 0.9rem;">{{ ucfirst(auth()->user()->role) }}</div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="px-3 pb-3">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm w-100">
                                <i class="bi bi-box-arrow-right me-1"></i>Logout
                            </button>
                        </form>
                    </div>
                </nav>
            </div>

            <!-- Top Header -->
            <div class="top-navbar d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0 text-dark fw-bold">
                        <i class="bi bi-speedometer2 me-2 text-primary"></i>My Dashboard
                    </h4>
                </div>
                <div>
                    <span class="text-muted">Welcome back, <strong class="text-dark">{{ auth()->user()->name }}</strong></span>
                </div>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>
        @else
            <!-- For non-authenticated users (hero page) -->
            <main>
                @yield('content')
            </main>
        @endauth
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
