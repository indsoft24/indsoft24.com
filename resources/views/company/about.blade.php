@extends('layouts.app')

@section('title', 'About Us - Indsoft24 | Digital Solutions & Free Blog Platform')

@section('meta')
<meta name="description" content="Indsoft24 offers comprehensive digital solutions including website development, mobile app development, software development, digital marketing, social media marketing, and creative services. Plus, enjoy free blog posting to share your thoughts and earn money.">
<meta name="keywords" content="Indsoft24, website development, app development, digital marketing, social media marketing, free blog posting, software development, creative services, digital solutions">
@endsection

@push('styles')
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
    }
    
    @keyframes gradientShift {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }
    
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #ff6b9d 75%, #c44569 100%);
        background-size: 300% 300%;
        animation: gradientShift 10s ease infinite;
        color: white;
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        animation: pulse 4s ease-in-out infinite;
    }
    
    .hero-content {
        position: relative;
        z-index: 1;
        animation: fadeInUp 1s ease-out;
    }
    
    .service-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 100%;
        animation: fadeInUp 0.8s ease-out;
        animation-fill-mode: both;
    }
    
    .service-card:nth-child(1) { animation-delay: 0.1s; }
    .service-card:nth-child(2) { animation-delay: 0.2s; }
    .service-card:nth-child(3) { animation-delay: 0.3s; }
    .service-card:nth-child(4) { animation-delay: 0.4s; }
    .service-card:nth-child(5) { animation-delay: 0.5s; }
    .service-card:nth-child(6) { animation-delay: 0.6s; }
    
    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }
    
    .service-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2rem;
        color: white;
        animation: float 3s ease-in-out infinite;
    }
    
    .service-card:hover .service-icon {
        animation: pulse 1s ease-in-out infinite;
    }
    
    .benefit-card {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 20px;
        border-left: 5px solid #667eea;
        transition: all 0.3s ease;
        animation: slideInLeft 0.8s ease-out;
        animation-fill-mode: both;
    }
    
    .benefit-card:nth-child(odd) {
        animation: slideInRight 0.8s ease-out;
    }
    
    .benefit-card:hover {
        transform: translateX(10px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.2);
    }
    
    .feature-badge {
        display: inline-block;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        margin: 5px;
        animation: pulse 2s ease-in-out infinite;
    }
    
    .stats-counter {
        font-size: 3rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="display-3 fw-bold mb-4" style="text-shadow: 0 2px 20px rgba(0,0,0,0.3);">
                About Indsoft24
            </h1>
            <p class="lead fs-4 mb-4" style="opacity: 0.95;">
                Empowering Businesses & Creators with Complete Digital Solutions
            </p>
            <p class="fs-5 mb-0" style="opacity: 0.9;">
                From cutting-edge technology services to a free platform for sharing your voice
            </p>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <!-- Who We Are Section -->
            <section class="mb-5" style="animation: fadeInUp 1s ease-out;">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold text-primary mb-3">Who We Are</h2>
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <p class="lead text-muted">
                                At <strong>Indsoft24</strong>, we are more than just a technology company — we are your digital growth partners. 
                                We combine technical expertise with creative innovation to deliver comprehensive digital solutions that help 
                                businesses thrive in the modern digital landscape.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Our Services Section -->
            <section class="mb-5">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold text-primary mb-3">Our Complete Digital Solutions</h2>
                    <p class="lead text-muted">We offer end-to-end digital services to transform your business</p>
                </div>
                
                <div class="row g-4 mb-5">
                    <div class="col-md-6 col-lg-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-globe"></i>
                            </div>
                            <h4 class="fw-bold text-center mb-3">Website Development</h4>
                            <p class="text-muted text-center mb-0">
                                Professional, responsive, and SEO-optimized websites that convert visitors into customers. 
                                From simple business sites to complex e-commerce platforms.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <h4 class="fw-bold text-center mb-3">Mobile App Development</h4>
                            <p class="text-muted text-center mb-0">
                                Native and hybrid mobile applications for Android & iOS. 
                                Build apps that engage users and drive business growth.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <h4 class="fw-bold text-center mb-3">Software Development</h4>
                            <p class="text-muted text-center mb-0">
                                Custom software solutions tailored to your business needs. 
                                Scalable, secure, and built for the future.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h4 class="fw-bold text-center mb-3">Digital Marketing</h4>
                            <p class="text-muted text-center mb-0">
                                SEO, Google Ads, content marketing, and more. 
                                Drive traffic, generate leads, and increase sales with data-driven strategies.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fab fa-facebook"></i>
                            </div>
                            <h4 class="fw-bold text-center mb-3">Social Media Marketing</h4>
                            <p class="text-muted text-center mb-0">
                                Facebook, Instagram, LinkedIn marketing with creative content. 
                                Build your brand and connect with your audience.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-palette"></i>
                            </div>
                            <h4 class="fw-bold text-center mb-3">Creative Services</h4>
                            <p class="text-muted text-center mb-0">
                                Graphic design, branding, video production, and creative campaigns. 
                                Make your brand stand out with stunning visuals.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Free Blog Platform Section -->
            <section class="mb-5">
                <div class="card border-0 shadow-lg mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px; overflow: hidden;">
                    <div class="card-body p-5 text-white">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h2 class="display-6 fw-bold mb-4">
                                    <i class="fas fa-blog me-3"></i>Free Blog Posting Platform
                                </h2>
                                <p class="lead mb-4" style="opacity: 0.95;">
                                    Share your thoughts, stories, expertise, and creativity with thousands of readers — <strong>completely free!</strong>
                                </p>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-check-circle fa-2x me-3"></i>
                                            <div>
                                                <h5 class="mb-1">100% Free to Post</h5>
                                                <p class="mb-0 small" style="opacity: 0.9;">No hidden charges, no subscription fees</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-dollar-sign fa-2x me-3"></i>
                                            <div>
                                                <h5 class="mb-1">Earn Money</h5>
                                                <p class="mb-0 small" style="opacity: 0.9;">Monetize your content and grow your income</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-users fa-2x me-3"></i>
                                            <div>
                                                <h5 class="mb-1">Large Audience</h5>
                                                <p class="mb-0 small" style="opacity: 0.9;">Reach thousands of readers instantly</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fab fa-google fa-2x me-3"></i>
                                            <div>
                                                <h5 class="mb-1">One-Click Login</h5>
                                                <p class="mb-0 small" style="opacity: 0.9;">Login with Google and start writing</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    @auth
                                        <a href="{{ route('user.blog.create') }}" class="btn btn-light btn-lg me-3">
                                            <i class="fas fa-plus-circle me-2"></i>Start Writing Now
                                        </a>
                                    @else
                                        <a href="{{ route('auth.google') }}" class="btn btn-light btn-lg me-3">
                                            <i class="fab fa-google me-2"></i>Login with Google
                                        </a>
                                    @endauth
                                    <a href="{{ route('blog.index') }}" class="btn btn-outline-light btn-lg">
                                        <i class="fas fa-eye me-2"></i>View Blogs
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center">
                                <div class="mt-4 mt-lg-0">
                                    <i class="fas fa-blog" style="font-size: 8rem; opacity: 0.3;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Why Choose Us Section -->
            <section class="mb-5">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold text-primary mb-3">Why Choose Indsoft24?</h2>
                    <p class="lead text-muted">What makes us your ideal digital partner</p>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="benefit-card">
                            <div class="d-flex align-items-start">
                                <div class="me-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-2">Experienced Team</h5>
                                    <p class="text-muted mb-0">
                                        Our developers and experts bring years of experience and passion for technology, 
                                        delivering solutions that exceed expectations.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="benefit-card">
                            <div class="d-flex align-items-start">
                                <div class="me-3">
                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-rocket"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-2">Scalable Solutions</h5>
                                    <p class="text-muted mb-0">
                                        We build with the future in mind — ensuring your solutions grow with your business 
                                        and adapt to changing needs.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="benefit-card">
                            <div class="d-flex align-items-start">
                                <div class="me-3">
                                    <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-lightbulb"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-2">Innovation First</h5>
                                    <p class="text-muted mb-0">
                                        We blend creativity and technology to craft solutions that truly stand out 
                                        and give you a competitive edge.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="benefit-card">
                            <div class="d-flex align-items-start">
                                <div class="me-3">
                                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-2">Community Driven</h5>
                                    <p class="text-muted mb-0">
                                        Our platform empowers users to share, connect, and grow together. 
                                        Join thousands of creators sharing their voice.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Key Benefits Section -->
            <section class="mb-5">
                <div class="card border-0 shadow-lg p-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 20px;">
                    <div class="text-center mb-4">
                        <h2 class="display-5 fw-bold text-primary mb-3">Key Benefits of Indsoft24</h2>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-4 text-center">
                            <div class="stats-counter mb-2">100%</div>
                            <h5 class="fw-bold">Free Blog Posting</h5>
                            <p class="text-muted">Post unlimited blogs without any cost</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="stats-counter mb-2">∞</div>
                            <h5 class="fw-bold">Earning Potential</h5>
                            <p class="text-muted">Monetize your content and earn money</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="stats-counter mb-2">360°</div>
                            <h5 class="fw-bold">Complete Solutions</h5>
                            <p class="text-muted">All digital services under one roof</p>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <p class="lead mb-3">We Offer:</p>
                        <div>
                            <span class="feature-badge">Website Development</span>
                            <span class="feature-badge">App Development</span>
                            <span class="feature-badge">Software Development</span>
                            <span class="feature-badge">Digital Marketing</span>
                            <span class="feature-badge">Social Media Marketing</span>
                            <span class="feature-badge">Creative Services</span>
                            <span class="feature-badge">SEO Services</span>
                            <span class="feature-badge">Free Blog Platform</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Our Vision Section -->
            <section class="mb-5">
                <div class="card border-0 shadow-lg p-5" style="border-radius: 20px;">
                    <div class="text-center mb-4">
                        <h2 class="display-5 fw-bold text-primary mb-3">Our Vision</h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <p class="lead text-muted text-center">
                                To be the trusted partner for businesses and individuals across the globe, combining 
                                <strong>technology and human creativity</strong> to build a digital future that is accessible, impactful, 
                                and full of opportunities.
                            </p>
                            <p class="text-muted text-center">
                                We envision a world where every business has access to world-class digital solutions, 
                                and every creator has a platform to share their voice — all in one place.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="mb-5">
                <div class="card border-0 shadow-lg text-center p-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px;">
                    <h2 class="display-6 fw-bold text-white mb-4">Let's Build Something Amazing Together</h2>
                    <p class="lead text-white mb-4" style="opacity: 0.95;">
                        Whether it's solving a challenge, creating a product, or sharing a story — Indsoft24 is here for you.
                    </p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('contact') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-paper-plane me-2"></i>Get in Touch
                        </a>
                        @auth
                            <a href="{{ route('user.blog.create') }}" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-blog me-2"></i>Start Blogging
                            </a>
                        @else
                            <a href="{{ route('auth.google') }}" class="btn btn-outline-light btn-lg">
                                <i class="fab fa-google me-2"></i>Start Free
                            </a>
                        @endauth
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
