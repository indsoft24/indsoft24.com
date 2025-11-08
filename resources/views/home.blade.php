@extends('layouts.app')
@section('title', 'Indsoft24.com - Web Development, Mobile Apps & Custom Software in India')
@section('content')
    <section id="home" class="hero">
        <div class="hero-background">
            <div class="hero-particles"></div>
            <div class="hero-gradient-overlay"></div>
        </div>
        <div class="hero-container" style="padding-top: 80px;">
            <div class="hero-content">
                <div class="hero-badge">
                    <i class="fas fa-star"></i>
                    <span>Trusted by 50+ Companies</span>
                </div>
                <h1 class="hero-title">
                    <span class="hero-title-line">Innovative Software</span>
                    <span class="hero-title-line gradient-text">Solutions</span>
                    <span class="hero-title-line">Tailored for Your Business</span>
                </h1>
                <p class="hero-description">
                    Transform your business with cutting-edge technology solutions. Our expert team delivers
                    <strong>custom websites</strong>, <strong>mobile applications</strong>, and
                    <strong>enterprise software</strong> that drive growth and innovation.
                </p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">100+</span>
                        <span class="stat-text">Projects Delivered</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">5+</span>
                        <span class="stat-text">Years Experience</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">24/7</span>
                        <span class="stat-text">Support</span>
                    </div>
                </div>
                <div class="hero-buttons">
                    <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:ponter" class="btn btn-primary">
                        <span>Start Your Project</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="#projects" class="btn btn-secondary">
                        <i class="fas fa-project-diagram"></i>
                        <span>View Our Projects</span>
                    </a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="floating-cards">
                    <div class="floating-card floating-card-1">
                        <div class="floating-card-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="floating-card-content">
                            <p class="fw-bold">Web Development</p>
                            <p>Modern, responsive websites</p>
                        </div>
                    </div>
                    <div class="floating-card floating-card-2">
                        <div class="floating-card-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="floating-card-content">
                            <p class="fw-bold">Mobile Apps</p>
                            <p>iOS & Android solutions</p>
                        </div>
                    </div>
                    <div class="floating-card floating-card-3">
                        <div class="floating-card-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="floating-card-content">
                            <p class="fw-bold">Custom Software</p>
                            <p>Tailored business solutions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section id="services" class="services">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <i class="fas fa-rocket"></i>
                <span>Our Services</span>
            </div>
            <h2 class="section-title">Comprehensive Digital Solutions</h2>
            <p class="section-subtitle">
                Empowering businesses with cutting-edge technology solutions that drive growth
                and innovation in the digital landscape
            </p>
        </div>

        <div class="services-grid">
            <div class="service-card">
                <div class="service-card-inner">
                    <div class="service-icon">
                        <i class="fas fa-globe"></i>
                        <div class="icon-bg"></div>
                    </div>
                    <div class="service-content">
                        <h3>Web Development</h3>
                        <p>
                            Transform your online presence with modern, responsive websites and web
                            applications built using the latest technologies.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check"></i> Responsive Design</li>
                            <li><i class="fas fa-check"></i> E-commerce Solutions</li>
                            <li><i class="fas fa-check"></i> CMS Development</li>
                            <li><i class="fas fa-check"></i> API Integration</li>
                        </ul>
                    </div>
                    <div class="service-footer">
                        <a href="{{ route('services.web') }}" 
                           class="service-link" 
                           aria-label="Learn more about Web Development">
                            <span>Learn More</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="service-card">
                <div class="service-card-inner">
                    <div class="service-icon">
                        <i class="fas fa-mobile-alt"></i>
                        <div class="icon-bg"></div>
                    </div>
                    <div class="service-content">
                        <h3>Mobile Applications</h3>
                        <p>
                            Reach your audience anywhere with native and cross-platform mobile apps
                            that deliver exceptional user experiences.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check"></i> iOS Development</li>
                            <li><i class="fas fa-check"></i> Android Development</li>
                            <li><i class="fas fa-check"></i> Cross-platform Apps</li>
                            <li><i class="fas fa-check"></i> App Store Optimization</li>
                        </ul>
                    </div>
                    <div class="service-footer">
                        <a href="#contact" class="service-link" aria-label="Learn more about Mobile Applications">
                            <span>Learn More</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="service-card">
                <div class="service-card-inner">
                    <div class="service-icon">
                        <i class="fas fa-cogs"></i>
                        <div class="icon-bg"></div>
                    </div>
                    <div class="service-content">
                        <h3>Custom Software</h3>
                        <p>
                            Streamline your operations with tailored software solutions designed to
                            solve specific business challenges.
                        </p>
                        <ul class="service-features">
                            <li><i class="fas fa-check"></i> Business Automation</li>
                            <li><i class="fas fa-check"></i> Data Management</li>
                            <li><i class="fas fa-check"></i> Integration Solutions</li>
                            <li><i class="fas fa-check"></i> Legacy System Updates</li>
                        </ul>
                    </div>
                    <div class="service-footer">
                        <a href="#contact" class="service-link" aria-label="Learn more about Custom Software">
                            <span>Learn More</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="services-cta">
            <div class="cta-content">
                <p class="fw-bold">Ready to Transform Your Business?</p>
                <p>Let's discuss how our solutions can help you achieve your goals</p>
                <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:ponter" class="btn btn-primary">
                    <span>Get Free Consultation</span>
                    <i class="fas fa-calendar-alt"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects Section -->
@if($featuredProjects->count() > 0)
<section id="projects" class="featured-projects py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="section-header text-center text-white mb-5">
            <div class="section-badge" style="background: rgba(255, 255, 255, 0.2); color: white;">
                <i class="fas fa-star"></i>
                <span>Featured Projects</span>
            </div>
            <h2 class="section-title text-white">Our <span class="text-warning">Portfolio</span></h2>
            <p class="section-subtitle text-white-50">
                Explore our showcase of innovative projects that demonstrate our expertise and creativity
            </p>
        </div>

        <!-- Swiper -->
        <div class="swiper featured-projects-swiper mb-4">
            <div class="swiper-wrapper">
                @foreach($featuredProjects as $project)
                    <div class="swiper-slide">
                        <div class="project-swiper-card">
                            <a href="{{ route('projects.show', $project) }}" class="project-card-link">
                                <div class="project-card-image">
                                    @if($project->featured_image)
                                        <img src="{{ asset($project->featured_image) }}" 
                                             alt="{{ $project->name }}" 
                                             class="project-img">
                                    @else
                                        <div class="project-image-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                    <div class="project-card-overlay">
                                        <span class="btn btn-light">
                                            <i class="fas fa-eye me-2"></i>View Project
                                        </span>
                                    </div>
                                    <div class="project-featured-badge">
                                        <i class="fas fa-star"></i> Featured
                                    </div>
                                </div>
                                <div class="project-card-content">
                                    <h4 class="project-card-title">{{ $project->name }}</h4>
                                    <p class="project-card-description">
                                        {{ Str::limit($project->description ?? 'No description available', 120) }}
                                    </p>
                                    @if($project->techStacks->count() > 0)
                                        <div class="project-card-tech">
                                            @foreach($project->techStacks->take(4) as $tech)
                                                <span class="tech-tag" style="background-color: {{ $tech->color ?? '#6c757d' }}">
                                                    {{ $tech->name }}
                                                </span>
                                            @endforeach
                                            @if($project->techStacks->count() > 4)
                                                <span class="tech-tag bg-secondary">+{{ $project->techStacks->count() - 4 }}</span>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="project-card-footer">
                                        @if($project->live_url)
                                            <a href="{{ $project->live_url }}" 
                                               target="_blank" 
                                               class="btn btn-sm btn-primary"
                                               onclick="event.stopPropagation();">
                                                <i class="fas fa-external-link-alt"></i> Live
                                            </a>
                                        @endif
                                        @if($project->github_url)
                                            <a href="{{ $project->github_url }}" 
                                               target="_blank" 
                                               class="btn btn-sm btn-dark"
                                               onclick="event.stopPropagation();">
                                                <i class="fab fa-github"></i> Code
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>

        <!-- View All Projects Button -->
        <div class="text-center mt-4">
            <a href="{{ route('projects.index') }}" class="btn btn-light btn-lg">
                <span>View All Projects</span>
                <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif


    <section id="about" class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <div class="section-badge">
                        <i class="fas fa-users"></i>
                        <span>About Us</span>
                    </div>
                    <h2 class="section-title">Why Choose <span class="gradient-text">Indsoft24</span>?</h2>
                    <p class="about-description">
                        We are passionate technology innovators dedicated to transforming businesses through
                        cutting-edge software solutions. Our expert team combines creativity with technical
                        excellence to deliver products that not only meet your requirements but exceed your expectations.
                    </p>
                    <div class="about-features">
                        <div class="feature">
                            <div class="feature-icon">
                                <i class="fas fa-users-cog"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Expert Team</h4>
                                <p>Certified professionals with years of industry experience</p>
                            </div>
                        </div>
                        <div class="feature">
                            <div class="feature-icon">
                                <i class="fas fa-expand-arrows-alt"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Scalable Solutions</h4>
                                <p>Future-proof technology that grows with your business</p>
                            </div>
                        </div>
                        <div class="feature">
                            <div class="feature-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="feature-content">
                                <h4>24/7 Support</h4>
                                <p>Round-the-clock assistance whenever you need it</p>
                            </div>
                        </div>
                        <div class="feature">
                            <div class="feature-icon">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Modern Technologies</h4>
                                <p>Latest tools and frameworks for optimal performance</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-visual">
                    <div class="stats-container">
                        <div class="stats-grid">
                            <div class="stat">
                                <div class="stat-icon">
                                    <i class="fas fa-project-diagram"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-number" data-count="100">100</div>
                                    <div class="stat-label">Projects Completed</div>
                                </div>
                            </div>
                            <div class="stat">
                                <div class="stat-icon">
                                    <i class="fas fa-smile"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-number" data-count="50">50</div>
                                    <div class="stat-label">Happy Clients</div>
                                </div>
                            </div>
                            <div class="stat">
                                <div class="stat-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-number" data-count="5">5</div>
                                    <div class="stat-label">Years Experience</div>
                                </div>
                            </div>
                            <div class="stat">
                                <div class="stat-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-number">24/7</div>
                                    <div class="stat-label">Support Available</div>
                                </div>
                            </div>
                        </div>
                        <div class="achievement-badge">
                            <i class="fas fa-trophy"></i>
                            <span>Trusted Partner</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@push('styles')
<style>
.featured-projects {
    position: relative;
    overflow: hidden;
    padding: 80px 0;
}

.featured-projects::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
}

.featured-projects .container {
    position: relative;
    z-index: 1;
}

.featured-projects-swiper {
    padding: 20px 0 60px 0;
}

.project-swiper-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.project-swiper-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}

.project-card-link {
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.project-card-image {
    position: relative;
    width: 100%;
    height: 280px;
    overflow: hidden;
}

.project-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.project-swiper-card:hover .project-img {
    transform: scale(1.15);
}

.project-image-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
}

.project-card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.75);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.project-swiper-card:hover .project-card-overlay {
    opacity: 1;
}

.project-featured-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #ffc107;
    color: #000;
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 0.85rem;
    font-weight: 600;
    z-index: 2;
}

.project-card-content {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.project-card-title {
    font-size: 1.35rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: #2c3e50;
}

.project-card-description {
    color: #6c757d;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 1rem;
    flex-grow: 1;
}

.project-card-tech {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.tech-tag {
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 500;
    color: white;
}

.project-card-footer {
    display: flex;
    gap: 0.75rem;
    margin-top: auto;
}

/* Swiper Customization */
.featured-projects-swiper .swiper-button-next,
.featured-projects-swiper .swiper-button-prev {
    color: white;
    background: rgba(255, 255, 255, 0.2);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    backdrop-filter: blur(10px);
}

.featured-projects-swiper .swiper-button-next:after,
.featured-projects-swiper .swiper-button-prev:after {
    font-size: 20px;
    font-weight: bold;
}

.featured-projects-swiper .swiper-button-next:hover,
.featured-projects-swiper .swiper-button-prev:hover {
    background: rgba(255, 255, 255, 0.3);
}

.featured-projects-swiper .swiper-pagination-bullet {
    background: white;
    opacity: 0.5;
    width: 12px;
    height: 12px;
}

.featured-projects-swiper .swiper-pagination-bullet-active {
    opacity: 1;
    background: #ffc107;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const featuredProjectsSwiper = new Swiper('.featured-projects-swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
    });
});
</script>
@endpush

    <section id="contact" class="contact">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-envelope"></i>
                    <span>Contact Us</span>
                </div>
                <h2 class="section-title">Let's Build Something <span class="gradient-text">Amazing</span> Together</h2>
                <p class="section-subtitle">Ready to transform your ideas into reality? Get in touch with our expert team
                    and let's discuss your project</p>
            </div>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-intro">
                        <h4>Get In Touch</h4>
                        <p>We're here to help you succeed. Reach out to us through any of the channels below, and we'll get
                            back to you within 24 hours.</p>
                    </div>
                    <div class="contact-methods">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Email Us</h4>
                                <p>indsoft24@gmail.com</p>
                                <span>We'll respond within 24 hours</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Call Us</h4>
                                <p>+917520744870</p>
                                <span>Mon-Fri 9AM-6PM IST</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Visit Us</h4>
                                <p>Noida, Uttar Pradesh, India</p>
                                <span>Schedule a meeting</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-form-container">
                    <div class="form-header">
                        <h4>Send us a Message</h4>
                        <p>Fill out the form below and we'll get back to you as soon as possible</p>
                    </div>
                    <form class="contact-form" method="POST" action="{{ route('contact.store') }}" id="contactForm">
                        @csrf
                        <input type="text" name="website" style="display: none;" tabindex="-1" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Full Name <i class="fas fa-user"></i></label>
                                <input type="text" id="name" name="name" placeholder="Enter your full name"
                                    value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address <i class="fas fa-envelope"></i></label>
                                <input type="email" id="email" name="email" placeholder="Enter your email"
                                    value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject <i class="fas fa-tag"></i></label>
                            <input type="text" id="subject" name="subject" placeholder="What's this about?"
                                value="{{ old('subject') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message <i class="fas fa-comment"></i></label>
                            <textarea id="message" name="message" placeholder="Tell us about your project..." rows="5" required>{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-submit">
                            <span>Send Message</span>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="floating-contact">
        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:ponter" class="floating-contact-btn" title="Quick Contact">
            <i class="fas fa-comments"></i>
        </a>
        <div class="floating-contact-tooltip">
            <span>Need Help? Contact Us!</span>
        </div>
    </div>
@endsection
