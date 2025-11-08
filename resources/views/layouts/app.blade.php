<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Indsoft24.com - Innovative Software Solutions')</title>
    <link rel="canonical" href="{{ $canonicalUrl ?? url()->current() }}" />
    <meta name="description" content="{{ Str::limit($metaDescription ?? 'Empowering businesses with cutting-edge technology and innovative software solutions. Discover insights on web development, mobile apps, and more.', 150, '') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/Indsoft24.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @if(request()->is('blog*'))
        <link rel="stylesheet" href="{{ asset('css/blog-styles.css') }}">
    @endif
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VZ3GFH5YLS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VZ3GFH5YLS');
</script>
<body class="@if(request()->is('blog*')) blog-page @endif">
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <!-- Logo - Left Side -->
            <div class="nav-logo">
                <a href="{{ route('home') }}" class="logo-link">
                    <img src="{{ asset('images/Indsoft24.png') }}" alt="Indsoft24.com Logo" class="logo-img">
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
                        <li><a class="dropdown-item" href="{{ route('services.web') }}">Web Development</a></li>
                        <li><a class="dropdown-item" href="{{ route('services.app') }}">App Development</a></li>
                        <li><a class="dropdown-item" href="{{ route('services.software') }}">Software Development</a></li>
                        <li><a class="dropdown-item" href="{{ route('services.seo') }}">SEO Optimization</a></li>
                    </ul>
                </div>
                
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}">Blog</a>
                <a href="{{ route('e-commerce') }}" class="nav-link {{ request()->routeIs('e-commerce') ? 'active' : '' }}">e commerce</a>
            </div>
            
            <!-- Auth Buttons - Right Side -->
            <div class="nav-auth" id="nav-auth">
                @auth
                    <a href="{{ route('user.blog.index') }}" class="auth-link auth-blog">
                        <i class="fas fa-blog"></i>
                        <span>My Blog</span>
                    </a>
                    <span class="auth-link auth-user">
                        <i class="fas fa-user"></i>
                        <span>{{ Auth::user()->name }}</span>
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="auth-link auth-logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('auth.google') }}" class="auth-link auth-login">
                        <i class="fab fa-google"></i>
                        <span>Login with Google</span>
                    </a>
                @endauth
            </div>
            
            <!-- Mobile Toggle - Right Side -->
            <div class="nav-toggle" id="nav-toggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- contact popup -->
    <!-- Get In Touch Modal -->
<div class="modal fade" id="getInTouchModal" tabindex="-1" role="dialog" aria-labelledby="getInTouchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content shadow-lg rounded-3">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="getInTouchModalLabel">Get in Touch</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="contactForm" method="POST" action="{{ route('contact.store') }}">
        @csrf
        <div class="modal-body">
          <!-- Honeypot field (hidden from users) -->
          <input type="text" name="website" style="display:none">

          <div class="form-group mb-3">
            <label for="name">Your Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
          </div>

          <div class="form-group mb-3">
            <label for="email">Your Email</label>
            <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
          </div>

          <div class="form-group mb-3">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" name="subject" placeholder="Enter subject" required>
          </div>

          <div class="form-group mb-3">
            <label for="message">Message</label>
            <textarea class="form-control" name="message" rows="4" placeholder="Write your message..." required></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary w-100">Send Message</button>
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
                        <img src="{{ asset('images/Indsoft24.png') }}" alt="Indsoft24.com Logo" class="footer-logo-img">
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
                                <li><a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-6">
                        <div class="footer-section">
                            <h4>Services</h4>
                            <ul class="footer-links">
                                <li><a href="{{ route('services.web') }}">Web Development</a></li>
                                <li><a href="#">Mobile Apps</a></li>
                                <li><a href="#">Custom Software</a></li>
                                <li><a href="#">UI/UX Design</a></li>
                                <li><a href="#">Consulting</a></li>
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
                <div class="newsletter-signup">
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


   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };
</script>

    <!-- SweetAlert Flash Messages -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configure a reusable Toast
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',   // You can change to 'bottom-end' if you prefer
            showConfirmButton: false,
            timer: 4000,           // Auto close after 4 seconds
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        @if(session('success'))
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
    });
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.getElementById("contactForm");
    const submitBtn = contactForm.querySelector("button[type='submit']");

    contactForm.addEventListener("submit", function (e) {
        e.preventDefault();

        // Disable button and change text
        submitBtn.disabled = true;
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = "Sending...";

        let formData = new FormData(contactForm);

        fetch(contactForm.action, {
            method: "POST",
            body: formData,
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(response => response.json())
        .then(data => {
            let modal = bootstrap.Modal.getInstance(document.getElementById('getInTouchModal'));
            if (modal) modal.hide();
            contactForm.reset();

            if (data.success) {
                toastr.success(data.message || "Message sent successfully!");
            } else {
                toastr.error(data.message || "Something went wrong!");
            }
        })
        .catch(err => {
            let modal = bootstrap.Modal.getInstance(document.getElementById('getInTouchModal'));
            if (modal) modal.hide();

            toastr.error("An error occurred. Please try again.");
        })
        .finally(() => {
            // Re-enable button and restore text
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });
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
