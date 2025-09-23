<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Indsoft24.com</title>
    <link rel="icon" type="image/png" href="{{ asset('images/Indsoft24.png') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom Admin CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/Indsoft24.png') }}" alt="Logo" class="sidebar-logo">
                <h4>Admin Panel</h4>
            </div>
            
            <ul class="sidebar-menu">
                <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="menu-item {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.posts.index') }}">
                        <i class="fas fa-newspaper"></i>
                        <span>Posts</span>
                    </a>
                </li>
                
                <li class="menu-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-folder"></i>
                        <span>Categories</span>
                    </a>
                </li>
                
                <li class="menu-item {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.tags.index') }}">
                        <i class="fas fa-tags"></i>
                        <span>Tags</span>
                    </a>
                </li>
                
                <li class="menu-item {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.comments.index') }}">
                        <i class="fas fa-comments"></i>
                        <span>Comments</span>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.subscribers.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.subscribers.index') }}">
                        <i class="fas fa-users"></i>
                        <span>Subscribers</span>
                    </a>
                </li>

                
                <li class="menu-item">
                    <a href="{{ route('home') }}" target="_blank">
                        <i class="fas fa-external-link-alt"></i>
                        <span>View Website</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navigation -->
            <nav class="top-navbar">
                <div class="navbar-content">
                    <button class="sidebar-toggle" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="navbar-right">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i>
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="page-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i>
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom Admin JS -->
    <script src="{{ asset('js/admin.js') }}"></script>
    
    <!-- SweetAlert Flash Messages -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle Laravel flash messages with SweetAlert
            @if(session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#28a745'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#dc3545'
                });
            @endif

            @if(session('warning'))
                Swal.fire({
                    title: 'Warning!',
                    text: '{{ session('warning') }}',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#ffc107'
                });
            @endif

            @if(session('info'))
                Swal.fire({
                    title: 'Information',
                    text: '{{ session('info') }}',
                    icon: 'info',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#17a2b8'
                });
            @endif
        });
    </script>
    
    @stack('scripts')
</body>
</html>
