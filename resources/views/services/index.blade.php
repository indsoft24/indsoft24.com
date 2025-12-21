@extends('layouts.app')

@section('title', 'Professional IT Services in India | Web Development, Mobile Apps, Software & SEO | IndSoft24')
@section('meta_description', 'Comprehensive IT services in India: Custom web development, mobile app development, enterprise software solutions, and SEO services. Expert team delivering cutting-edge technology solutions for businesses.')
@section('meta_keywords', 'web development services, mobile app development, custom software development, SEO services, IT services India, website development, app development, software solutions, digital services')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Hero Section -->
<section class="achievement-badge text-white py-5" style="margin-top:72px; position: relative; overflow: hidden;">
    <!-- Background Animations -->
    <div class="hero-background">
        <div class="hero-particles"></div>
        <div class="hero-gradient-overlay"></div>
        <!-- Floating geometric shapes -->
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
            <div class="shape shape-5"></div>
            <div class="shape shape-6"></div>
        </div>
        <!-- Animated grid pattern -->
        <div class="animated-grid"></div>
    </div>
    <div class="container text-center" style="position: relative; z-index: 3;">
        <h1 class="display-4 fw-bold mb-3">Our Professional IT Services</h1>
        <p class="lead mb-4">
            Comprehensive technology solutions to transform your business. From web development to mobile apps, 
            custom software to SEO optimization — we deliver excellence.
        </p>
        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer"
            class="btn btn-warning btn-lg">Get Free Consultation</a>
    </div>
</section>

<!-- Services Grid Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Explore Our Services</h2>
            <p class="text-muted lead">Choose the service that fits your business needs</p>
        </div>

        <div class="row g-4">
            <!-- Web Development Service -->
            <div class="col-md-6 col-lg-3">
                <div class="service-card-modern h-100">
                    <div class="service-icon-wrapper">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3 class="service-title">Web Development</h3>
                    <p class="service-description">
                        Transform your online presence with modern, responsive websites and web applications built using 
                        the latest technologies. From simple business websites to complex e-commerce platforms.
                    </p>
                    <ul class="service-features-list">
                        <li><i class="fas fa-check-circle"></i> Custom Website Development</li>
                        <li><i class="fas fa-check-circle"></i> Mobile Responsive Design</li>
                        <li><i class="fas fa-check-circle"></i> E-commerce Solutions</li>
                        <li><i class="fas fa-check-circle"></i> SEO & Performance Optimization</li>
                        <li><i class="fas fa-check-circle"></i> CMS Development</li>
                    </ul>
                    <div class="service-footer-modern">
                        <a href="{{ route('services.web') }}" class="service-link-modern">
                            <span>Learn More</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile App Development Service -->
            <div class="col-md-6 col-lg-3">
                <div class="service-card-modern h-100">
                    <div class="service-icon-wrapper">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="service-title">Mobile App Development</h3>
                    <p class="service-description">
                        Reach your audience anywhere with native and cross-platform mobile apps that deliver exceptional 
                        user experiences. From idea to launch, we build high-performance iOS and Android applications.
                    </p>
                    <ul class="service-features-list">
                        <li><i class="fas fa-check-circle"></i> Native iOS & Android Apps</li>
                        <li><i class="fas fa-check-circle"></i> Cross-Platform Development</li>
                        <li><i class="fas fa-check-circle"></i> App UI/UX Design</li>
                        <li><i class="fas fa-check-circle"></i> App Store Optimization</li>
                        <li><i class="fas fa-check-circle"></i> Backend Integration</li>
                    </ul>
                    <div class="service-footer-modern">
                        <a href="{{ route('services.app') }}" class="service-link-modern">
                            <span>Learn More</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Software Development Service -->
            <div class="col-md-6 col-lg-3">
                <div class="service-card-modern h-100">
                    <div class="service-icon-wrapper">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="service-title">Custom Software Development</h3>
                    <p class="service-description">
                        Streamline your operations with tailor-made software solutions designed to solve specific business 
                        challenges. We build scalable, secure, and custom software that grows with your business.
                    </p>
                    <ul class="service-features-list">
                        <li><i class="fas fa-check-circle"></i> Enterprise Software Solutions</li>
                        <li><i class="fas fa-check-circle"></i> SaaS Product Development</li>
                        <li><i class="fas fa-check-circle"></i> API Development & Integration</li>
                        <li><i class="fas fa-check-circle"></i> Business Automation</li>
                        <li><i class="fas fa-check-circle"></i> Legacy System Updates</li>
                    </ul>
                    <div class="service-footer-modern">
                        <a href="{{ route('services.software') }}" class="service-link-modern">
                            <span>Learn More</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- SEO Services -->
            <div class="col-md-6 col-lg-3">
                <div class="service-card-modern h-100">
                    <div class="service-icon-wrapper">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="service-title">SEO Services</h3>
                    <p class="service-description">
                        Increase your organic traffic, improve Google rankings, and generate more leads with our 
                        data-driven SEO strategies. Comprehensive on-page, off-page, and technical SEO optimization.
                    </p>
                    <ul class="service-features-list">
                        <li><i class="fas fa-check-circle"></i> On-Page SEO Optimization</li>
                        <li><i class="fas fa-check-circle"></i> Off-Page SEO & Link Building</li>
                        <li><i class="fas fa-check-circle"></i> Technical SEO Audit</li>
                        <li><i class="fas fa-check-circle"></i> Content Strategy & Optimization</li>
                        <li><i class="fas fa-check-circle"></i> Monthly Performance Reporting</li>
                    </ul>
                    <div class="service-footer-modern">
                        <a href="{{ route('services.seo') }}" class="service-link-modern">
                            <span>Learn More</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Why Choose IndSoft24?</h2>
            <p class="text-muted">We deliver excellence through expertise, innovation, and dedication</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="feature-icon-large mb-3">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <h4 class="fw-bold">Expert Team</h4>
                    <p class="text-muted">Certified professionals with years of industry experience delivering cutting-edge solutions.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="feature-icon-large mb-3">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </div>
                    <h4 class="fw-bold">Scalable Solutions</h4>
                    <p class="text-muted">Future-proof technology that grows with your business and adapts to changing needs.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="feature-icon-large mb-3">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4 class="fw-bold">24/7 Support</h4>
                    <p class="text-muted">Round-the-clock assistance whenever you need it, ensuring your business never stops.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 text-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container">
        <h2 class="fw-bold mb-3 text-white">Ready to Transform Your Business?</h2>
        <p class="lead mb-4 text-white-50">Let's discuss how our services can help you achieve your goals</p>
        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer"
            class="btn btn-light btn-lg">Get Free Consultation</a>
    </div>
</section>

@push('styles')
<style>
    /* Animation Keyframes */
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
            transform: scale(1.1);
        }
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-15px);
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
    
    @keyframes backgroundPulse {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.8;
            transform: scale(1.1);
        }
    }
    
    @keyframes particlesFloat {
        0% {
            transform: translate(0, 0) rotate(0deg);
        }
        33% {
            transform: translate(30px, -30px) rotate(120deg);
        }
        66% {
            transform: translate(-20px, 20px) rotate(240deg);
        }
        100% {
            transform: translate(0, 0) rotate(360deg);
        }
    }
    
    @keyframes particlesOpacity {
        0%, 100% {
            opacity: 0.4;
        }
        50% {
            opacity: 0.6;
        }
    }
    
    @keyframes radialPulse {
        0%, 100% {
            opacity: 0.6;
            transform: scale(1);
        }
        50% {
            opacity: 1;
            transform: scale(1.2);
        }
    }
    
    @keyframes floatShape {
        0%, 100% {
            transform: translate(0, 0) rotate(0deg) scale(1);
            opacity: 0.8;
        }
        16% {
            transform: translate(60px, -70px) rotate(60deg) scale(1.25);
            opacity: 1;
        }
        33% {
            transform: translate(-50px, 60px) rotate(120deg) scale(0.85);
            opacity: 0.9;
        }
        50% {
            transform: translate(70px, 50px) rotate(180deg) scale(1.2);
            opacity: 1;
        }
        66% {
            transform: translate(-40px, -60px) rotate(240deg) scale(0.9);
            opacity: 0.85;
        }
        83% {
            transform: translate(50px, 40px) rotate(300deg) scale(1.15);
            opacity: 0.95;
        }
    }
    
    @keyframes gridMove {
        0% {
            background-position: 0 0;
        }
        100% {
            background-position: 50px 50px;
        }
    }
    
    @keyframes overlayShift {
        0%, 100% {
            opacity: 1;
            transform: translate(0, 0);
        }
        50% {
            opacity: 0.8;
            transform: translate(20px, -20px);
        }
    }
    
    /* Hero Section Animation */
    .achievement-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #ff6b9d 75%, #c44569 100%);
        background-size: 300% 300%;
        animation: gradientShift 10s ease infinite;
        position: relative;
        overflow: hidden;
    }
    
    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
        background: 
            radial-gradient(circle at 20% 30%, rgba(46, 204, 113, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(52, 152, 219, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 50% 50%, rgba(240, 147, 251, 0.1) 0%, transparent 60%);
        animation: backgroundPulse 8s ease-in-out infinite;
    }
    
    .hero-particles {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 2;
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.12) 2px, transparent 2px),
            radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.1) 1.5px, transparent 1.5px),
            radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.08) 1px, transparent 1px),
            radial-gradient(circle at 10% 60%, rgba(46, 204, 113, 0.15) 1px, transparent 1px),
            radial-gradient(circle at 90% 40%, rgba(52, 152, 219, 0.15) 1px, transparent 1px);
        background-size: 120px 120px, 180px 180px, 250px 250px, 150px 150px, 200px 200px;
        background-position: 0 0, 60px 60px, 120px 120px, 30px 30px, 90px 90px;
        opacity: 0.5;
        animation: particlesFloat 25s linear infinite, particlesOpacity 6s ease-in-out infinite;
        will-change: transform, opacity;
        transform: translateZ(0);
    }
    
    .hero-particles::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 15% 25%, rgba(46, 204, 113, 0.2) 0%, transparent 40%),
            radial-gradient(circle at 85% 75%, rgba(52, 152, 219, 0.2) 0%, transparent 40%),
            radial-gradient(circle at 50% 50%, rgba(240, 147, 251, 0.15) 0%, transparent 50%);
        animation: radialPulse 6s ease-in-out infinite;
    }
    
    .hero-gradient-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 2;
        background: 
            radial-gradient(circle at 30% 20%, rgba(255,255,255,0.15) 0%, transparent 50%),
            radial-gradient(circle at 70% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
            linear-gradient(135deg, transparent 0%, rgba(255,255,255,0.05) 50%, transparent 100%);
        animation: overlayShift 12s ease-in-out infinite;
    }
    
    .floating-shapes {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 2;
        overflow: hidden;
        pointer-events: none;
    }
    
    .shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        animation: floatShape 20s ease-in-out infinite;
    }
    
    .shape-1 {
        width: 150px;
        height: 150px;
        top: 10%;
        left: 5%;
        animation-delay: 0s;
        background: radial-gradient(circle, rgba(76, 175, 80, 0.4) 0%, rgba(76, 175, 80, 0.2) 50%, transparent 70%);
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        box-shadow: 0 0 40px rgba(76, 175, 80, 0.5);
        border: 3px solid rgba(76, 175, 80, 0.3);
    }
    
    .shape-2 {
        width: 120px;
        height: 120px;
        top: 60%;
        right: 10%;
        animation-delay: 2s;
        background: radial-gradient(circle, rgba(33, 150, 243, 0.4) 0%, rgba(33, 150, 243, 0.2) 50%, transparent 70%);
        border-radius: 50%;
        transform: rotate(45deg);
        box-shadow: 0 0 35px rgba(33, 150, 243, 0.5);
        border: 3px solid rgba(33, 150, 243, 0.3);
    }
    
    .shape-3 {
        width: 180px;
        height: 180px;
        bottom: 15%;
        left: 15%;
        animation-delay: 4s;
        background: radial-gradient(circle, rgba(156, 39, 176, 0.4) 0%, rgba(156, 39, 176, 0.2) 50%, transparent 70%);
        border-radius: 20% 80% 80% 20% / 20% 20% 80% 80%;
        box-shadow: 0 0 45px rgba(156, 39, 176, 0.5);
        border: 3px solid rgba(156, 39, 176, 0.3);
    }
    
    .shape-4 {
        width: 100px;
        height: 100px;
        top: 30%;
        right: 20%;
        animation-delay: 1s;
        background: radial-gradient(circle, rgba(46, 204, 113, 0.1) 0%, transparent 70%);
        clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
    }
    
    .shape-5 {
        width: 90px;
        height: 90px;
        bottom: 30%;
        right: 5%;
        animation-delay: 3s;
        background: radial-gradient(circle, rgba(52, 152, 219, 0.12) 0%, transparent 70%);
        border-radius: 20%;
        transform: rotate(30deg);
    }
    
    .shape-6 {
        width: 110px;
        height: 110px;
        top: 50%;
        left: 2%;
        animation-delay: 5s;
        background: radial-gradient(circle, rgba(240, 147, 251, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        clip-path: polygon(25% 0%, 100% 0%, 75% 100%, 0% 100%);
    }
    
    .animated-grid {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
        background-image: 
            linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: gridMove 20s linear infinite;
        opacity: 0.4;
    }
    
    .achievement-badge .container {
        position: relative;
        z-index: 3;
        animation: fadeInUp 1s ease-out;
    }
    
    /* Service Card Modern Styles */
    .service-card-modern {
        background: #fff;
        border-radius: 0;
        padding: 35px 25px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        border: 1px solid #f0f0f0;
        width: 100%;
        animation: fadeInUp 0.8s ease-out;
        animation-fill-mode: both;
    }
    
    .service-card-modern:nth-child(1) { animation-delay: 0.1s; }
    .service-card-modern:nth-child(2) { animation-delay: 0.2s; }
    .service-card-modern:nth-child(3) { animation-delay: 0.3s; }
    .service-card-modern:nth-child(4) { animation-delay: 0.4s; }

    .service-card-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #3498db, #2ecc71);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .service-card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .service-card-modern:hover::before {
        transform: scaleX(1);
    }

    .service-icon-wrapper {
        width: 80px;
        height: 80px;
        margin: 0 auto 25px;
        border-radius: 0;
        background: linear-gradient(135deg, #3498db, #2ecc71);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(52, 152, 219, 0.3);
        animation: float 3s ease-in-out infinite;
    }

    .service-card-modern:hover .service-icon-wrapper {
        animation: pulse 1s ease-in-out infinite;
        box-shadow: 0 12px 30px rgba(52, 152, 219, 0.4);
    }

    .service-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 15px;
        text-align: center;
    }

    .service-description {
        color: #6c757d;
        line-height: 1.7;
        margin-bottom: 20px;
        font-size: 0.95rem;
        text-align: center;
    }

    .service-features-list {
        list-style: none;
        padding: 0;
        margin: 0 0 25px 0;
    }

    .service-features-list li {
        padding: 8px 0;
        color: #555;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .service-features-list li i {
        color: #2ecc71;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .service-footer-modern {
        margin-top: auto;
        padding-top: 20px;
        border-top: 1px solid #f0f0f0;
    }

    .service-link-modern {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #3498db;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
        justify-content: center;
        padding: 12px 20px;
        border-radius: 0;
        background: #f8f9fa;
    }

    .service-link-modern:hover {
        color: #2ecc71;
        background: linear-gradient(135deg, #3498db, #2ecc71);
        color: white;
        transform: translateX(5px);
    }

    .service-link-modern i {
        transition: transform 0.3s ease;
    }

    .service-link-modern:hover i {
        transform: translateX(5px);
    }

    /* Feature Icon Large */
    .feature-icon-large {
        width: 70px;
        height: 70px;
        margin: 0 auto;
        border-radius: 0;
        background: linear-gradient(135deg, #3498db, #2ecc71);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        box-shadow: 0 8px 20px rgba(52, 152, 219, 0.3);
        animation: float 3s ease-in-out infinite;
        transition: all 0.3s ease;
    }
    
    .feature-icon-large:hover {
        animation: pulse 1s ease-in-out infinite;
        transform: scale(1.1);
    }
    
    /* Why Choose Us Section Animation */
    .bg-light .row > div {
        animation: fadeInUp 0.8s ease-out;
        animation-fill-mode: both;
    }
    
    .bg-light .row > div:nth-child(1) { animation-delay: 0.1s; }
    .bg-light .row > div:nth-child(2) { animation-delay: 0.2s; }
    .bg-light .row > div:nth-child(3) { animation-delay: 0.3s; }
    
    /* CTA Section Animation */
    section[style*="gradient"] {
        animation: fadeInUp 1s ease-out;
    }

    /* Remove border radius from hero section */
    .achievement-badge {
        border-radius: 0 !important;
    }

    /* Make sections full width */
    section {
        width: 100%;
    }

    /* Full width container for services page */
    .py-5 .container {
        max-width: 100%;
        padding-left: 15px;
        padding-right: 15px;
    }

    /* Service cards full width on mobile */
    @media (max-width: 768px) {
        .service-card-modern {
            margin-left: -15px;
            margin-right: -15px;
            width: calc(100% + 30px);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .service-card-modern {
            padding: 25px 20px;
        }

        .service-icon-wrapper {
            width: 70px;
            height: 70px;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .service-title {
            font-size: 1.3rem;
        }

        .service-description {
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@endsection

