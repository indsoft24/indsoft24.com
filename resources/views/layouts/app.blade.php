<!DOCTYPE html>
<html lang="en" data-auth-state="{{ Auth::check() ? 'authenticated' : 'guest' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Indsoft24.com - Innovative Software Solutions')</title>
    <link rel="canonical" href="{{ $canonicalUrl ?? url()->current() }}" />
    <meta name="description" content="{{ Str::limit($metaDescription ?? 'Empowering businesses with cutting-edge technology and innovative software solutions. Discover insights on web development, mobile apps, and more.', 150, '') }}">
    
    @auth
    <!-- Prevent caching for authenticated users -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    @endauth
    
    <!-- Resource Hints for Performance -->
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Preload Critical Resources -->
    <link rel="preload" href="{{ asset('css/styles.css') }}" as="style">
    <link rel="preload" href="{{ asset('images/Indsoft24.png') }}" as="image">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/Indsoft24.png') }}">
    
    <!-- Critical CSS - Bootstrap must load synchronously for navbar dropdown -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    
    <!-- Conditional Stylesheets -->
    @if(request()->is('blog*'))
        <link rel="preload" href="{{ asset('css/blog-styles.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{ asset('css/blog-styles.css') }}"></noscript>
    @endif
    
    <!-- Non-Critical CSS - Load asynchronously -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"></noscript>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"></noscript>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"></noscript>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"></noscript>

    <!-- Optimized Font Loading -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"></noscript>
    <style>
        /* Font fallback to prevent FOIT */
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; }
        /* Apply Inter when loaded */
        @font-face {
            font-family: 'Inter';
            font-display: swap;
        }
        
        /* Critical CSS for Navbar Dropdown - Prevents FOUC */
        .nav-item.dropdown {
            position: relative;
        }
        .nav-item .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            min-width: 200px;
            padding: 0.5rem 0;
            margin: 0.125rem 0 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 0.375rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .nav-item .dropdown-menu.show {
            display: block;
        }
        .nav-item .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.5rem 1rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: inherit;
            text-decoration: none;
            white-space: nowrap;
            background-color: transparent;
            border: 0;
            transition: all 0.15s ease;
        }
        .nav-item .dropdown-item:hover,
        .nav-item .dropdown-item:focus {
            color: #1e2125;
            background-color: #e9ecef;
        }
        .nav-item .dropdown-divider {
            height: 0;
            margin: 0.5rem 0;
            overflow: hidden;
            border-top: 1px solid rgba(0, 0, 0, 0.15);
        }
        .nav-link.dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
            transition: transform 0.15s ease;
        }
        .nav-link.dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }
    </style>
    @stack('styles')
    <style>
        /* Get In Touch Modal z-index and compact styling */
        #getInTouchModal {
            z-index: 99999 !important;
        }
        #getInTouchModal .modal-backdrop {
            z-index: 99998 !important;
        }
        #getInTouchModal.modal.show {
            z-index: 99999 !important;
        }
        #getInTouchModal .modal-header {
            padding: 0.75rem 1rem;
        }
        #getInTouchModal .modal-header .modal-title {
            font-size: 1rem;
        }
        #getInTouchModal .modal-body {
            font-size: 0.9rem;
        }
    </style>
    
    <!-- Async CSS Loading Script -->
    <script>
        // Handle async CSS loading for non-critical stylesheets
        (function() {
            var links = document.querySelectorAll('link[media="print"][onload]');
            links.forEach(function(link) {
                link.onload = function() {
                    this.media = 'all';
                };
            });
        })();
    </script>
</head>
<!-- Google Analytics - Deferred for Performance -->
<script>
  // Defer Google Analytics loading
  window.addEventListener('load', function() {
    var script = document.createElement('script');
    script.async = true;
    script.src = 'https://www.googletagmanager.com/gtag/js?id=G-VZ3GFH5YLS';
    document.head.appendChild(script);
    
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-VZ3GFH5YLS');
  });
</script>
<body class="@if(request()->is('blog*')) blog-page @endif">
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="top-bar-container">
            <div class="top-bar-left">
                <span class="top-bar-welcome">
                    <i class="fas fa-hand-wave"></i>
                    Welcome to Indsoft24
                </span>
            </div>
            <div class="top-bar-center">
                <a href="tel:+917520744870" class="top-bar-link">
                    <i class="fas fa-phone"></i>
                    <span class="top-bar-text desktop-text">+91 75207 44870</span>
                    <span class="top-bar-text mobile-text">+91 75207</span>
                </a>
                <a href="mailto:indsoft24@gmail.com" class="top-bar-link">
                    <i class="fas fa-envelope"></i>
                    <span class="top-bar-text desktop-text">indsoft24@gmail.com</span>
                    <span class="top-bar-text mobile-text">Email</span>
                </a>
            </div>
            <div class="top-bar-right">
                <a href="#" class="top-bar-consultation" data-bs-toggle="modal" data-bs-target="#getInTouchModal">
                    <i class="fas fa-comments"></i>
                    <span class="desktop-text">Get Free Consultation</span>
                    <span class="mobile-text">Consultation</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <!-- Logo - Left Side -->
            <div class="nav-logo">
                <a href="{{ route('home') }}" class="logo-link">
                    <img src="{{ asset('images/Indsoft24.png') }}" alt="Indsoft24.com Logo" class="logo-img" width="150" height="50" loading="eager">
                </a>
            </div>
            
            <!-- Desktop Menu - Center -->
            <div class="nav-menu" id="nav-menu">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>

                <!-- Services Dropdown -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->is('services*') ? 'active' : '' }}" 
                       id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                        <li><a class="dropdown-item" href="{{ route('services.index') }}"><i class="fas fa-th me-2"></i>All Services</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('services.web') }}"><i class="fas fa-globe me-2"></i>Web Development</a></li>
                        <li><a class="dropdown-item" href="{{ route('services.app') }}"><i class="fas fa-mobile-alt me-2"></i>App Development</a></li>
                        <li><a class="dropdown-item" href="{{ route('services.software') }}"><i class="fas fa-cogs me-2"></i>Software Development</a></li>
                        <li><a class="dropdown-item" href="{{ route('services.seo') }}"><i class="fas fa-search me-2"></i>SEO Optimization</a></li>
                        <li><a class="dropdown-item" href="{{ route('services.digital-marketing') }}"><i class="fas fa-bullhorn me-2"></i>Digital Marketing</a></li>
                        <li><a class="dropdown-item" href="{{ route('services.social-media-marketing') }}"><i class="fas fa-share-alt me-2"></i>Social Media Marketing</a></li>
                    </ul>
                </div>
                
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}">Blog</a>

                   <!-- Tools Mega Menu -->
                <div class="nav-item dropdown mega-dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->is('tools*') ? 'active' : '' }}" 
                       id="toolsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tools
                    </a>
                    <div class="dropdown-menu mega-menu p-4" aria-labelledby="toolsDropdown">
                        <div class="container-fluid">
                            <div class="row g-4">
                                <div class="col-lg-4 col-md-4">
                                    <div class="mega-menu-column">
                                        <h6 class="mega-menu-title">
                                            <i class="fas fa-image text-primary me-2"></i>Image Tools
                                        </h6>
                                        <ul class="list-unstyled mega-menu-list">
                                            <li><a class="dropdown-item" href="{{ route('tools.image-converter') }}">
                                                <i class="fas fa-exchange-alt me-2"></i>Jpg to Png
                                            </a></li>
                                            <li><a class="dropdown-item" href="{{ route('tools.image-converter') }}">
                                                <i class="fas fa-exchange-alt me-2"></i>Jpg to Webp
                                            </a></li>
                                            <li><a class="dropdown-item" href="{{ route('tools.image-converter') }}">
                                                <i class="fas fa-exchange-alt me-2"></i>Image Converter
                                            </a></li>
                                            <li><a class="dropdown-item" href="{{ route('tools.image-compress') }}">
                                                <i class="fas fa-compress-arrows-alt me-2"></i>Image Compressor
                                            </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="mega-menu-column">
                                        <h6 class="mega-menu-title">
                                            <i class="fas fa-file-pdf text-danger me-2"></i>PDF Tools
                                        </h6>
                                        <ul class="list-unstyled mega-menu-list">
                                            <li><a class="dropdown-item" href="{{ route('tools.jpg-to-pdf') }}">
                                                <i class="fas fa-file-image me-2"></i>JPG to PDF
                                            </a></li>
                                            <li><a class="dropdown-item" href="{{ route('tools.pdf-to-image') }}">
                                                <i class="fas fa-file-pdf me-2"></i>PDF to Image
                                            </a></li>
                                            <li><a class="dropdown-item" href="{{ route('tools.pdf-compress') }}">
                                                <i class="fas fa-file-contract me-2"></i>PDF Compress
                                            </a></li>
                                            <li><a class="dropdown-item" href="{{ route('tools.pdf-unlock') }}">
                                                <i class="fas fa-unlock me-2"></i>PDF Unlock
                                            </a></li>
                                            <li><a class="dropdown-item" href="{{ route('tools.pdf-lock') }}">
                                                <i class="fas fa-lock me-2"></i>PDF Lock
                                            </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="mega-menu-column">
                                        <h6 class="mega-menu-title">
                                            <i class="fas fa-file-word text-primary me-2"></i>Doc Tools
                                        </h6>
                                        <ul class="list-unstyled mega-menu-list">
                                            <li><a class="dropdown-item" href="{{ route('tools.doc-to-pdf') }}">
                                                <i class="fas fa-file-word me-2"></i>Word to PDF
                                            </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                <a href="{{ route('e-commerce') }}" class="nav-link {{ request()->routeIs('e-commerce') ? 'active' : '' }}">e commerce</a>
            </div>
            
            <!-- Auth Buttons - Right Side (Desktop Only) -->
            <div class="nav-auth desktop-only" id="nav-auth">
                @auth
                    <a href="{{ route('user.blog.index') }}" class="auth-link auth-blog">
                        <i class="fas fa-blog"></i>
                        <span>My Blog</span>
                    </a>
                    <span class="auth-link auth-user">
                        <i class="fas fa-user"></i>
                        <span>{{ Auth::user()->name }}</span>
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline logout-form" data-current-url="{{ url()->current() }}">
                        @csrf
                        <button type="submit" class="auth-link auth-logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('auth.google') }}" class="auth-link auth-login" data-current-url="{{ url()->current() }}">
                        <i class="fab fa-google"></i>
                        <span>Login with Google</span>
                    </a>
                @endguest
            </div>
            
            <!-- Mobile Toggle - Right Side (Mobile/Tablet Only) -->
            <div class="nav-toggle mobile-only" id="nav-toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Mobile/Tablet Sidebar Menu -->
    <div class="mobile-sidebar" id="mobile-sidebar">
        <div class="sidebar-overlay" id="sidebar-overlay"></div>
        <div class="sidebar-content">
            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <h2 class="sidebar-title">Menu</h2>
                <button class="sidebar-close" id="sidebar-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Sidebar Navigation -->
            <div class="sidebar-nav">
                <a href="{{ route('home') }}" class="sidebar-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>

                <!-- Tools Dropdown -->
                <div class="sidebar-item sidebar-dropdown">
                    <div class="sidebar-dropdown-toggle">
                        <i class="fas fa-tools"></i>
                        <span>Tools</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </div>
                    <div class="sidebar-dropdown-menu">
                        <!-- Image Tools -->
                        <div class="sidebar-group-label ms-3 mt-2 mb-1 text-muted small fw-bold">IMAGE TOOLS</div>
                        <a href="{{ route('tools.image-converter') }}" class="sidebar-dropdown-item">
                            <i class="fas fa-exchange-alt"></i>
                            <span>Image Converter</span>
                        </a>
                        <a href="{{ route('tools.image-compress') }}" class="sidebar-dropdown-item">
                            <i class="fas fa-compress-arrows-alt"></i>
                            <span>Image Compressor</span>
                        </a>

                        <!-- PDF Tools -->
                        <div class="sidebar-group-label ms-3 mt-2 mb-1 text-muted small fw-bold">PDF TOOLS</div>
                        <a href="{{ route('tools.jpg-to-pdf') }}" class="sidebar-dropdown-item">
                            <i class="fas fa-file-image"></i>
                            <span>JPG to PDF</span>
                        </a>
                        <a href="{{ route('tools.pdf-to-image') }}" class="sidebar-dropdown-item">
                            <i class="fas fa-file-pdf"></i>
                            <span>PDF to Image</span>
                        </a>
                        <a href="{{ route('tools.pdf-compress') }}" class="sidebar-dropdown-item">
                            <i class="fas fa-file-contract"></i>
                            <span>PDF Compress</span>
                        </a>
                         <a href="{{ route('tools.pdf-unlock') }}" class="sidebar-dropdown-item">
                            <i class="fas fa-unlock"></i>
                            <span>PDF Unlock</span>
                        </a>
                        <a href="{{ route('tools.pdf-lock') }}" class="sidebar-dropdown-item">
                            <i class="fas fa-lock"></i>
                            <span>PDF Lock</span>
                        </a>

                        <!-- Doc Tools -->
                        <div class="sidebar-group-label ms-3 mt-2 mb-1 text-muted small fw-bold">DOC TOOLS</div>
                        <a href="{{ route('tools.doc-to-pdf') }}" class="sidebar-dropdown-item">
                            <i class="fas fa-file-word"></i>
                            <span>Word to PDF</span>
                        </a>
                    </div>
                </div>

                <!-- Services Dropdown -->
                <div class="sidebar-item sidebar-dropdown">
                    <div class="sidebar-dropdown-toggle">
                        <i class="fas fa-briefcase"></i>
                        <span>Service</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </div>
                    <div class="sidebar-dropdown-menu">
                        <a href="{{ route('services.index') }}" class="sidebar-dropdown-item">
                            <i class="fas fa-th"></i>
                            <span>All Services</span>
                        </a>
                        <a href="{{ route('services.web') }}" class="sidebar-dropdown-item">
                            <i class="fas fa-globe"></i>
                            <span>Web Development</span>
                        </a>
                        <a href="{{ route('services.app') }}" class="sidebar-dropdown-item">
                            <i class="fas fa-mobile-alt"></i>
                            <span>App Development</span>
                        </a>
                        <a href="{{ route('services.software') }}" class="sidebar-dropdown-item">
                            <i class="fas fa-cogs"></i>
                            <span>Software Development</span>
                        </a>
                        <a href="{{ route('services.seo') }}" class="sidebar-dropdown-item">
                            <i class="fas fa-search"></i>
                            <span>SEO Optimization</span>
                        </a>
                        <a href="{{ route('services.digital-marketing') }}" class="sidebar-dropdown-item">
                            <i class="fas fa-bullhorn"></i>
                            <span>Digital Marketing</span>
                        </a>
                        <a href="{{ route('services.social-media-marketing') }}" class="sidebar-dropdown-item">
                            <i class="fas fa-share-alt"></i>
                            <span>Social Media Marketing</span>
                        </a>
                    </div>
                </div>

                <a href="{{ route('about') }}" class="sidebar-item {{ request()->routeIs('about') ? 'active' : '' }}">
                    <i class="fas fa-info-circle"></i>
                    <span>About Us</span>
                </a>

                <a href="{{ route('contact') }}" class="sidebar-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i>
                    <span>Contact Us</span>
                </a>

                <!-- Auth Section -->
                <div class="sidebar-divider"></div>
                @auth
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="sidebar-user-details">
                            <span class="sidebar-user-name">{{ Auth::user()->name }}</span>
                            <span class="sidebar-user-email">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="sidebar-logout-form logout-form" data-current-url="{{ url()->current() }}">
                        @csrf
                        <button type="submit" class="sidebar-btn sidebar-btn-logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('auth.google') }}" class="sidebar-btn sidebar-btn-login" data-current-url="{{ url()->current() }}">
                        <i class="fab fa-google"></i>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('auth.google') }}" class="sidebar-btn sidebar-btn-register" data-current-url="{{ url()->current() }}">
                        <span>Register</span>
                    </a>
                @endguest
            </div>
        </div>
    </div>

    <!-- Bottom Navigation Bar (Mobile/Tablet Only) -->
    <nav class="bottom-nav mobile-only">
        <a href="{{ route('home') }}" class="bottom-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="{{ route('services.index') }}" class="bottom-nav-item {{ request()->is('services*') ? 'active' : '' }}">
            <i class="fas fa-briefcase"></i>
            <span>Services</span>
        </a>
        @auth
            <a href="{{ route('projects.index') }}" class="bottom-nav-item {{ request()->routeIs('projects*') ? 'active' : '' }}">
                <i class="fas fa-project-diagram"></i>
                <span>Projects</span>
            </a>
            <a href="{{ route('user.blog.index') }}" class="bottom-nav-item {{ request()->routeIs('user.blog*') ? 'active' : '' }}">
                <i class="fas fa-blog"></i>
                <span>My Blog</span>
            </a>
        @endauth
        @guest
            <a href="{{ route('projects.index') }}" class="bottom-nav-item {{ request()->routeIs('projects*') ? 'active' : '' }}">
                <i class="fas fa-project-diagram"></i>
                <span>Projects</span>
            </a>
        @endguest
        <a href="{{ route('blog.index') }}" class="bottom-nav-item {{ request()->routeIs('blog*') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i>
            <span>Blog</span>
        </a>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- contact popup -->
    <!-- Get In Touch Modal -->
<div class="modal fade" id="getInTouchModal" tabindex="-1" role="dialog" aria-labelledby="getInTouchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content shadow-lg rounded-3">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="getInTouchModalLabel">Get in Touch</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="contactForm" method="POST" action="{{ route('contact.store') }}">
        @csrf
        <div class="modal-body" style="padding: 1rem;">
          <!-- Honeypot field (hidden from users) -->
          <input type="text" name="website" style="display:none">

          <div class="form-group mb-3">
            <label for="name" class="small fw-semibold">Your Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm" name="name" id="contact_name" placeholder="Enter your name" required pattern="[a-zA-Z\s]+" maxlength="255" title="Name can only contain letters and spaces">
            <div class="invalid-feedback" style="display: none;">Name can only contain letters and spaces.</div>
          </div>

          <div class="form-group mb-3">
            <label for="email" class="small fw-semibold">Your Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control form-control-sm" name="email" id="contact_email" placeholder="Enter your email" required maxlength="255">
            <div class="invalid-feedback" style="display: none;">Please enter a valid email address.</div>
          </div>

          <div class="form-group mb-3">
            <label for="phone" class="small fw-semibold">Phone Number <span class="text-danger">*</span></label>
            <input type="tel" class="form-control form-control-sm" name="phone" id="contact_phone" placeholder="Enter your phone number" required pattern="[0-9\+\-\s\(\)]+" maxlength="20" title="Phone number contains invalid characters">
            <div class="invalid-feedback" style="display: none;">Phone number contains invalid characters.</div>
          </div>

          <div class="form-group mb-3">
            <label for="subject" class="small fw-semibold">Subject <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm" name="subject" id="contact_subject" placeholder="Enter subject" required maxlength="255" pattern="[a-zA-Z0-9\s\-\.\,\!\?]+" title="Subject contains invalid characters">
            <div class="invalid-feedback" style="display: none;">Subject contains invalid characters.</div>
          </div>

          <div class="form-group mb-3">
            <label for="message" class="small fw-semibold">Message <span class="text-danger">*</span></label>
            <textarea class="form-control form-control-sm" name="message" id="contact_message" rows="3" placeholder="Write your message..." required minlength="10" maxlength="1000"></textarea>
            <div class="invalid-feedback" style="display: none;">Message must be at least 10 characters long.</div>
            <small class="form-text text-muted">Minimum 10 characters required</small>
          </div>
        </div>

        <div class="modal-footer" style="padding: 0.75rem 1rem;">
          <button type="submit" class="btn btn-primary btn-sm w-100">Send Message</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end popup -->

    <!-- Footer -->
    <footer class="footer">
    <div class="container">
        <div class="row py-5 gy-4">

            <div class="col-lg-4 col-md-12">
                <div class="footer-section footer-brand">
                    <div class="footer-logo">
                        <img src="{{ asset('images/Indsoft24.png') }}" alt="Indsoft24.com Logo" class="footer-logo-img" width="150" height="50" loading="lazy">
                    </div>
                    <p class="footer-description">
                        Empowering businesses with cutting-edge technology solutions.
                    </p>
                    <div class="footer-section footer-social">
                        <h4>Follow Us</h4>
                        <div class="social-links">
                            <a href="https://www.linkedin.com/in/indian-software-services/" class="social-link" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            <a href="https://www.facebook.com/profile.php?id=61580300354385" class="social-link" title="Facebook"><i class="fab fa-facebook"></i></a>
                            <a href="https://github.com/indsoft24" class="social-link" title="GitHub"><i class="fab fa-github"></i></a>
                            <a href="#" class="social-link" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link" title="Twitter"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-12">
                <div class="row">
                    <div class="col-md-4 col-6">
                        <div class="footer-section">
                            <h4>Quick Links</h4>
                            <ul class="footer-links">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('home') }}#services">Services</a></li>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                                <li><a href="{{ route('contact') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-6">
                        <div class="footer-section">
                            <h4>Services</h4>
                            <ul class="footer-links">
                                <li><a href="{{ route('services.web') }}">Web Development</a></li>
                                <li><a href="{{ route('services.app') }}">Mobile Apps</a></li>
                                <li><a href="{{ route('services.software') }}">Custom Software</a></li>
                                <li><a href="{{ route('services.seo') }}">SEO Optimization</a></li>
                                <li><a href="{{ route('services.digital-marketing') }}">Digital Marketing</a></li>
                                <li><a href="{{ route('services.social-media-marketing') }}">Social Media Marketing</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 mt-4 mt-md-0">
                        <div class="footer-section">
                            <h4>Company</h4>
                            <ul class="footer-links">
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('team') }}">Our Team</a></li>
                                <li><a href="{{ route('career.index') }}">Careers</a></li>
                                <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                                <li><a href="{{ route('terms.conditions') }}">Terms of Service</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-12">
                <div class="footer-section">
                    <h4>Business Directory</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('cms.states') }}"><i class="fas fa-map-marked-alt me-1"></i>Browse by State</a></li>
                    </ul>
                </div>
                <div class="newsletter-signup mt-4">
                    <h5>Newsletter</h5>
                    <p>Subscribe to get latest updates</p>
                    <form class="newsletter-form" method="POST" action="{{ route('newsletter.subscribe') }}">
                        @csrf
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <button type="submit" id="al" aria-label="Name"><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p class="mb-0">&copy; {{ date('Y') }} Indsoft24.com. All rights reserved.</p>
                <div class="footer-bottom-links">
                    <a href="{{ route('privacy.policy') }}">Privacy Policy</a>
                    <a href="{{ route('terms.conditions') }}">Terms of Service</a>
                    <a href="{{ route('cookie.policy') }}">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>


   <!-- Scripts - Deferred for Performance -->
   <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
<script src="{{ asset('js/script.js') }}" defer></script>

<script>
    // Wait for toastr to be loaded before configuring
    (function configureToastr(retries) {
        retries = retries || 0;
        const maxRetries = 100; // Maximum 5 seconds (100 * 50ms)
        
        if (typeof toastr !== 'undefined') {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000"
            };
        } else if (retries < maxRetries) {
            // If toastr is not loaded yet, wait a bit and try again
            setTimeout(function() {
                configureToastr(retries + 1);
            }, 50);
        }
    })();
</script>

    <!-- Early Cache Prevention Script - Runs immediately -->
<script>
    // Prevent browser from caching pages with authentication
    // This runs before DOM is ready to catch early cache issues
    (function preventAuthCache() {
        @auth
        // If user is authenticated, add timestamp to prevent cache
        if (window.performance && window.performance.navigation) {
            // If this is a back/forward navigation, force reload
            if (window.performance.navigation.type === 2) {
                window.location.reload(true);
            }
        }
        @endauth
        
        // Store auth state in sessionStorage for verification
        @auth
        sessionStorage.setItem('server-auth-state', 'authenticated');
        @endauth
        @guest
        sessionStorage.setItem('server-auth-state', 'guest');
        @endguest
    })();
</script>

    <!-- SweetAlert Flash Messages -->
<script>
    // Wait for SweetAlert2 to load before using it
    (function initSweetAlert() {
        function init() {
            if (typeof Swal === 'undefined') {
                setTimeout(init, 50);
                return;
            }

            // Configure a reusable Toast
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            // Handle login success - show message and reload to update UI
            @if(request()->has('logged_in'))
                @if(session('success'))
                    Toast.fire({
                        icon: 'success',
                        title: '{{ session('success') }}'
                    });
                @endif
                
                // Reload page after delay to ensure session cookie is set and UI updates
                // Use a longer delay to ensure session is fully established
                setTimeout(function() {
                    try {
                        const url = new URL(window.location);
                        url.searchParams.delete('logged_in');
                        // Force a hard reload to ensure fresh content and session
                        window.location.href = url.toString();
                    } catch (e) {
                        // Fallback if URL parsing fails - hard reload
                        window.location.reload(true);
                    }
                }, 1500);
            @endif
            
            // Handle logout success - show message and reload to update UI
            @if(session('success') && str_contains(session('success'), 'logged out'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}'
                });
                
                // Reload page after delay to update UI
                setTimeout(function() {
                    window.location.reload(true);
                }, 1500);
            @endif

            // Authentication state verification - runs on every page load
            // This prevents cached pages from showing incorrect auth state
            (function verifyAuthState() {
                // Get server-side auth state from HTML data attribute
                const htmlElement = document.documentElement;
                const serverAuthState = htmlElement.getAttribute('data-auth-state');
                
                if (!serverAuthState) return; // Skip if attribute not found
                
                // Check what's actually displayed on the page
                const isLoggedInDisplayed = document.querySelector('.auth-link.auth-logout, .sidebar-btn-logout, .sidebar-user-info') !== null;
                const isLoggedOutDisplayed = document.querySelector('.auth-link.auth-login, .sidebar-btn-login') !== null;
                
                // Determine if there's a mismatch
                const shouldBeLoggedIn = serverAuthState === 'authenticated';
                const shouldBeLoggedOut = serverAuthState === 'guest';
                
                const stateMismatch = (shouldBeLoggedIn && isLoggedOutDisplayed) || (shouldBeLoggedOut && isLoggedInDisplayed);
                
                // If mismatch detected and not in the middle of a login/logout flow, force reload
                if (stateMismatch && 
                    !window.location.search.includes('logged_in') && 
                    !window.location.search.includes('logout') &&
                    !sessionStorage.getItem('auth-reload-skip')) {
                    // Set flag to prevent infinite reload loop
                    sessionStorage.setItem('auth-reload-skip', 'true');
                    setTimeout(() => sessionStorage.removeItem('auth-reload-skip'), 2000);
                    
                    // Force a hard reload with cache bypass
                    window.location.reload(true);
                    return;
                }
            })();
            
            // Show other success messages
            @if(session('success') && !request()->has('logged_in'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}'
                });
            @endif

            @if(session('error'))
                Toast.fire({
                    icon: 'error',
                    title: '{{ session('error') }}'
                });
            @endif

            @if(session('warning'))
                Toast.fire({
                    icon: 'warning',
                    title: '{{ session('warning') }}'
                });
            @endif

            @if(session('info'))
                Toast.fire({
                    icon: 'info',
                    title: '{{ session('info') }}'
                });
            @endif
        }

        // Start initialization when DOM is ready or immediately if already loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    })();
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Capture current page URL for login redirects
    const loginLinks = document.querySelectorAll('a[href*="auth/google"]');
    loginLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            // Get current URL - prefer data attribute, fallback to window.location
            let currentUrl = this.getAttribute('data-current-url');
            
            // If no data attribute or it's empty, use window.location
            if (!currentUrl || currentUrl === '') {
                currentUrl = window.location.href;
            }
            
            // Ensure we have the full URL including query string and hash
            if (!currentUrl.startsWith('http')) {
                currentUrl = window.location.origin + currentUrl;
            }
            
            // Append current URL as redirect parameter
            const separator = this.href.includes('?') ? '&' : '?';
            this.href = this.href + separator + 'redirect=' + encodeURIComponent(currentUrl);
            
            // Log for debugging (remove in production)
            console.log('Login redirect URL:', currentUrl);
        });
    });
    
    // Capture current page URL for logout redirects
    const logoutForms = document.querySelectorAll('form.logout-form');
    logoutForms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            const currentUrl = this.getAttribute('data-current-url') || window.location.href;
            // Add hidden input with current URL for redirect
            if (!this.querySelector('input[name="redirect"]')) {
                const redirectInput = document.createElement('input');
                redirectInput.type = 'hidden';
                redirectInput.name = 'redirect';
                redirectInput.value = currentUrl;
                this.appendChild(redirectInput);
            }
        });
    });

    // Only target the modal contact form, not the contact page form
    const modal = document.getElementById('getInTouchModal');
    if (modal) {
        const contactForm = modal.querySelector("form[id='contactForm']");
        if (contactForm) {
            const submitBtn = contactForm.querySelector("button[type='submit']");

            // Clear validation errors when modal is shown
            modal.addEventListener('show.bs.modal', function() {
                contactForm.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });
                contactForm.querySelectorAll('.invalid-feedback').forEach(el => {
                    el.style.display = 'none';
                });
            });

            // Client-side validation
            function validateField(field) {
                const value = field.value.trim();
                let isValid = true;
                let errorMessage = '';

                // Remove previous validation classes
                field.classList.remove('is-invalid', 'is-valid');
                const feedback = field.parentElement.querySelector('.invalid-feedback');
                if (feedback) feedback.style.display = 'none';

                // Check if required field is empty
                if (field.hasAttribute('required') && !value) {
                    isValid = false;
                    errorMessage = 'This field is required.';
                } else if (value) {
                    // Validate based on field type
                    if (field.type === 'email' && !field.validity.valid) {
                        isValid = false;
                        errorMessage = 'Please enter a valid email address.';
                    } else if (field.name === 'name' && !/^[a-zA-Z\s]+$/.test(value)) {
                        isValid = false;
                        errorMessage = 'Name can only contain letters and spaces.';
                    } else if (field.name === 'phone' && !/^[0-9\+\-\s\(\)]+$/.test(value)) {
                        isValid = false;
                        errorMessage = 'Phone number contains invalid characters.';
                    } else if (field.name === 'subject' && !/^[a-zA-Z0-9\s\-\.\,\!\?]+$/.test(value)) {
                        isValid = false;
                        errorMessage = 'Subject contains invalid characters.';
                    } else if (field.name === 'message' && value.length < 10) {
                        isValid = false;
                        errorMessage = 'Message must be at least 10 characters long.';
                    } else {
                        field.classList.add('is-valid');
                    }
                }

                // Show validation feedback
                if (!isValid) {
                    field.classList.add('is-invalid');
                    if (feedback) {
                        feedback.textContent = errorMessage;
                        feedback.style.display = 'block';
                    }
                }

                return isValid;
            }

            // Add real-time validation on blur
            contactForm.querySelectorAll('input, textarea').forEach(field => {
                field.addEventListener('blur', function() {
                    validateField(this);
                });

                field.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid')) {
                        validateField(this);
                    }
                });
            });

            contactForm.addEventListener("submit", function (e) {
                e.preventDefault();

                // Validate all fields
                let isValid = true;
                contactForm.querySelectorAll('input[required], textarea[required]').forEach(field => {
                    if (!validateField(field)) {
                        isValid = false;
                    }
                });

                if (!isValid) {
                    toastr.error("Please correct the errors in the form.");
                    return;
                }

                // Disable button and change text
                submitBtn.disabled = true;
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = "Sending...";

                let formData = new FormData(contactForm);

                fetch(contactForm.action, {
                    method: "POST",
                    body: formData,
                    headers: { 
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw { status: response.status, data: data };
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    let modalInstance = bootstrap.Modal.getInstance(document.getElementById('getInTouchModal'));
                    if (modalInstance) modalInstance.hide();
                    contactForm.reset();
                    contactForm.querySelectorAll('.is-valid').forEach(el => {
                        el.classList.remove('is-valid');
                    });

                    if (data.success) {
                        toastr.success(data.message || "Message sent successfully!");
                    } else {
                        toastr.error(data.message || "Something went wrong!");
                    }
                })
                .catch(err => {
                    // Handle validation errors
                    if (err.data && err.data.errors) {
                        Object.keys(err.data.errors).forEach(fieldName => {
                            const field = contactForm.querySelector(`[name="${fieldName}"]`);
                            if (field) {
                                field.classList.add('is-invalid');
                                const feedback = field.parentElement.querySelector('.invalid-feedback');
                                if (feedback) {
                                    feedback.textContent = err.data.errors[fieldName][0];
                                    feedback.style.display = 'block';
                                }
                            }
                        });
                        toastr.error("Please correct the errors in the form.");
                    } else {
                        let modalInstance = bootstrap.Modal.getInstance(document.getElementById('getInTouchModal'));
                        if (modalInstance) modalInstance.hide();
                        toastr.error(err.data?.message || "An error occurred. Please try again.");
                    }
                })
                .finally(() => {
                    // Re-enable button and restore text
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                });
            });
        }
    }

    // Top Bar Scroll Behavior - Show/Hide on scroll
    const topBar = document.querySelector('.top-bar');
    const navbar = document.querySelector('.navbar');
    let lastScrollTop = 0;
    let scrollThreshold = 10; // Minimum scroll distance to trigger hide/show

    if (topBar && navbar) {
        // Function to update navbar position based on top bar visibility
        const updateNavbarPosition = (isTopBarVisible) => {
            if (isTopBarVisible) {
                navbar.classList.remove('top-zero');
                navbar.classList.add('top-bar-visible');
            } else {
                navbar.classList.remove('top-bar-visible');
                navbar.classList.add('top-zero');
            }
        };

        // Initialize navbar position on page load
        updateNavbarPosition(true);

        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // At the top of the page, always show the top bar
            if (scrollTop <= scrollThreshold) {
                topBar.classList.remove('hidden');
                updateNavbarPosition(true);
                lastScrollTop = scrollTop;
                return;
            }

            // Scrolling down - hide top bar
            if (scrollTop > lastScrollTop && scrollTop > scrollThreshold) {
                topBar.classList.add('hidden');
                updateNavbarPosition(false);
            } 
            // Scrolling up - show top bar
            else if (scrollTop < lastScrollTop) {
                topBar.classList.remove('hidden');
                updateNavbarPosition(true);
            }

            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        }, { passive: true });

        // Handle window resize to adjust navbar position
        window.addEventListener('resize', function() {
            if (!topBar.classList.contains('hidden')) {
                updateNavbarPosition(true);
            } else {
                updateNavbarPosition(false);
            }
        }, { passive: true });
    }
});

</script>


    
    @stack('scripts')

    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055">
        <div id="success-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <i class="fas fa-check-circle me-2"></i>
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{-- The message will be set by JavaScript --}}
            </div>
        </div>
    </div>
</body>
</html>
