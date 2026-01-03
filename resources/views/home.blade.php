@extends('layouts.app')
@section('title', 'Indsoft24.com - Web Development, Mobile Apps & Custom Software in India')
@section('content')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <section id="home" class="hero">
        <div class="hero-background-image"></div>
        <div class="hero-container">
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
                <div class="lead-form-container">
                    <div class="lead-form-card">
                        <div class="lead-form-header">
                            <h3><i class="fas fa-rocket"></i> Get Started Today</h3>
                            <p>Fill out the form and we'll get back to you within 24 hours</p>
                        </div>
                        <form id="leadForm" method="POST" action="{{ route('leads.store') }}" class="lead-form">
                            @csrf
                            <input type="text" name="website" style="display: none;" tabindex="-1" autocomplete="off">
                            <input type="hidden" name="source" value="homepage">
                            
                            <div class="form-group">
                                <label for="lead_name"><i class="fas fa-user"></i> Full Name</label>
                                <input type="text" id="lead_name" name="name" class="form-control" 
                                       placeholder="Enter your name" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="lead_email"><i class="fas fa-envelope"></i> Email Address</label>
                                <input type="email" id="lead_email" name="email" class="form-control" 
                                       placeholder="Enter your email" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="lead_phone"><i class="fas fa-phone"></i> Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" id="lead_phone" name="phone" class="form-control" 
                                       placeholder="Enter your phone number" required pattern="[0-9\+\-\s\(\)]+">
                            </div>
                            
                            <div class="form-group">
                                <label for="lead_company"><i class="fas fa-building"></i> Company Name</label>
                                <input type="text" id="lead_company" name="company" class="form-control" 
                                       placeholder="Enter your company (optional)">
                            </div>
                            
                            <div class="form-group">
                                <label for="lead_message"><i class="fas fa-comment"></i> Message</label>
                                <textarea id="lead_message" name="message" class="form-control" rows="1" 
                                          placeholder="Tell us about your project (optional)"></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-submit w-100">
                                <span>Submit Request</span>
                                <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                            
                            <div class="form-message mt-3" id="leadFormMessage"></div>
                        </form>
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
            <!-- First Row -->
            <div class="service-card-flip compact">
                <div class="service-card-inner-flip">
                    <!-- Front Side -->
                    <div class="service-card-front">
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
                        </div>
                        
                    </div>
                    <!-- Back Side -->
                    <div class="service-card-back">
                        <div class="service-back-header">
                            <div class="service-icon-small">
                                <i class="fas fa-globe"></i>
                            </div>
                            <h3>Web Development</h3>
                        </div>
                        <div class="service-back-content">
                            <ul class="service-features-flip">
                                <li><i class="fas fa-check-circle"></i> Custom Website Development</li>
                                <li><i class="fas fa-check-circle"></i> Mobile Responsive Design</li>
                                <li><i class="fas fa-check-circle"></i> E-commerce Solutions</li>
                                <li><i class="fas fa-check-circle"></i> SEO & Performance Optimization</li>
                                <li><i class="fas fa-check-circle"></i> CMS Development</li>
                            </ul>
                        </div>
                        <div class="service-back-footer">
                            <a href="{{ route('services.web') }}" class="service-link" aria-label="Learn more about Web Development">
                                <span>Learn More</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="service-card-flip compact">
                <div class="service-card-inner-flip">
                    <!-- Front Side -->
                    <div class="service-card-front">
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
                        </div>
                        
                    </div>
                    <!-- Back Side -->
                    <div class="service-card-back">
                        <div class="service-back-header">
                            <div class="service-icon-small">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <h3>Mobile Applications</h3>
                        </div>
                        <div class="service-back-content">
                            <ul class="service-features-flip">
                                <li><i class="fas fa-check-circle"></i> Native iOS & Android Apps</li>
                                <li><i class="fas fa-check-circle"></i> Cross-Platform Development</li>
                                <li><i class="fas fa-check-circle"></i> App UI/UX Design</li>
                                <li><i class="fas fa-check-circle"></i> App Store Optimization</li>
                                <li><i class="fas fa-check-circle"></i> Backend Integration</li>
                            </ul>
                        </div>
                        <div class="service-back-footer">
                            <a href="{{ route('services.app') }}" class="service-link" aria-label="Learn more about Mobile Applications">
                                <span>Learn More</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="service-card-flip compact">
                <div class="service-card-inner-flip">
                    <!-- Front Side -->
                    <div class="service-card-front">
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
                        </div>
                        
                    </div>
                    <!-- Back Side -->
                    <div class="service-card-back">
                        <div class="service-back-header">
                            <div class="service-icon-small">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <h3>Custom Software</h3>
                        </div>
                        <div class="service-back-content">
                            <ul class="service-features-flip">
                                <li><i class="fas fa-check-circle"></i> Enterprise Software Solutions</li>
                                <li><i class="fas fa-check-circle"></i> SaaS Product Development</li>
                                <li><i class="fas fa-check-circle"></i> API Development & Integration</li>
                                <li><i class="fas fa-check-circle"></i> Business Automation</li>
                                <li><i class="fas fa-check-circle"></i> Legacy System Updates</li>
                            </ul>
                        </div>
                        <div class="service-back-footer">
                            <a href="{{ route('services.software') }}" class="service-link" aria-label="Learn more about Custom Software">
                                <span>Learn More</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Row -->
            <div class="service-card-flip compact">
                <div class="service-card-inner-flip">
                    <!-- Front Side -->
                    <div class="service-card-front">
                        <div class="service-icon">
                            <i class="fas fa-search"></i>
                            <div class="icon-bg"></div>
                        </div>
                        <div class="service-content">
                            <h3>SEO Optimization</h3>
                            <p>
                                Increase your organic traffic, improve Google rankings, and generate more leads with our
                                data-driven SEO strategies.
                            </p>
                        </div>
                        
                    </div>
                    <!-- Back Side -->
                    <div class="service-card-back">
                        <div class="service-back-header">
                            <div class="service-icon-small">
                                <i class="fas fa-search"></i>
                            </div>
                            <h3>SEO Optimization</h3>
                        </div>
                        <div class="service-back-content">
                            <ul class="service-features-flip">
                                <li><i class="fas fa-check-circle"></i> On-Page SEO Optimization</li>
                                <li><i class="fas fa-check-circle"></i> Off-Page SEO & Link Building</li>
                                <li><i class="fas fa-check-circle"></i> Technical SEO Audit</li>
                                <li><i class="fas fa-check-circle"></i> Content Strategy & Optimization</li>
                                <li><i class="fas fa-check-circle"></i> Monthly Performance Reporting</li>
                            </ul>
                        </div>
                        <div class="service-back-footer">
                            <a href="{{ route('services.seo') }}" class="service-link" aria-label="Learn more about SEO Optimization">
                                <span>Learn More</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="service-card-flip compact">
                <div class="service-card-inner-flip">
                    <!-- Front Side -->
                    <div class="service-card-front">
                        <div class="service-icon">
                            <i class="fas fa-bullhorn"></i>
                            <div class="icon-bg"></div>
                        </div>
                        <div class="service-content">
                            <h3>Digital Marketing</h3>
                            <p>
                                Drive growth, increase brand visibility, and generate qualified leads with comprehensive
                                digital marketing strategies.
                            </p>
                        </div>
                        
                    </div>
                    <!-- Back Side -->
                    <div class="service-card-back">
                        <div class="service-back-header">
                            <div class="service-icon-small">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <h3>Digital Marketing</h3>
                        </div>
                        <div class="service-back-content">
                            <ul class="service-features-flip">
                                <li><i class="fas fa-check-circle"></i> PPC & Google Ads Management</li>
                                <li><i class="fas fa-check-circle"></i> Social Media Advertising</li>
                                <li><i class="fas fa-check-circle"></i> Email Marketing Campaigns</li>
                                <li><i class="fas fa-check-circle"></i> Content Marketing Strategy</li>
                                <li><i class="fas fa-check-circle"></i> Analytics & ROI Tracking</li>
                            </ul>
                        </div>
                        <div class="service-back-footer">
                            <a href="{{ route('services.digital-marketing') }}" class="service-link" aria-label="Learn more about Digital Marketing">
                                <span>Learn More</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="service-card-flip compact">
                <div class="service-card-inner-flip">
                    <!-- Front Side -->
                    <div class="service-card-front">
                        <div class="service-icon">
                            <i class="fas fa-share-alt"></i>
                            <div class="icon-bg"></div>
                        </div>
                        <div class="service-content">
                            <h3>Social Media Marketing</h3>
                            <p>
                                Build your brand, engage your audience, and drive sales with strategic social media
                                marketing across all major platforms.
                            </p>
                        </div>
                        
                    </div>
                    <!-- Back Side -->
                    <div class="service-card-back">
                        <div class="service-back-header">
                            <div class="service-icon-small">
                                <i class="fas fa-share-alt"></i>
                            </div>
                            <h3>Social Media Marketing</h3>
                        </div>
                        <div class="service-back-content">
                            <ul class="service-features-flip">
                                <li><i class="fas fa-check-circle"></i> Social Media Strategy & Planning</li>
                                <li><i class="fas fa-check-circle"></i> Content Creation & Scheduling</li>
                                <li><i class="fas fa-check-circle"></i> Community Management</li>
                                <li><i class="fas fa-check-circle"></i> Influencer Partnerships</li>
                                <li><i class="fas fa-check-circle"></i> Performance Analytics</li>
                            </ul>
                        </div>
                        <div class="service-back-footer">
                            <a href="{{ route('services.social-media-marketing') }}" class="service-link" aria-label="Learn more about Social Media Marketing">
                                <span>Learn More</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
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
<section id="projects" class="featured-projects">
    <div class="container">
        <div class="section-header text-center text-white mb-5">
            <div class="section-badge" style="background: rgba(255, 255, 255, 0.2); color: rgb(10, 129, 109);">
                <i class="fas fa-star"></i>
                <span>Featured Projects</span>
            </div>
            <h2 class="section-title"><span class="text-warning">Our Portfolio</span></h2>
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
                                             class="project-img"
                                             loading="lazy"
                                             width="400"
                                             height="300">
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


@push('scripts')
<script>
// Lead Form Submission
document.addEventListener('DOMContentLoaded', function() {
    const leadForm = document.getElementById('leadForm');
    const formMessage = document.getElementById('leadFormMessage');
    
    if (leadForm) {
        leadForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = leadForm.querySelector('.btn-submit');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span>Submitting...</span><i class="fas fa-spinner fa-spin ms-2"></i>';
            
            const formData = new FormData(leadForm);
            
            fetch(leadForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    formMessage.className = 'form-message success';
                    formMessage.textContent = data.message || 'Thank you! We will contact you soon.';
                    leadForm.reset();
                    
                    // Show success toast
                    if (typeof toastr !== 'undefined') {
                        toastr.success(data.message || 'Thank you! We will contact you soon.');
                    }
                } else {
                    formMessage.className = 'form-message error';
                    formMessage.textContent = data.message || 'Something went wrong. Please try again.';
                    
                    if (typeof toastr !== 'undefined') {
                        toastr.error(data.message || 'Something went wrong. Please try again.');
                    }
                }
            })
            .catch(error => {
                formMessage.className = 'form-message error';
                formMessage.textContent = 'An error occurred. Please try again.';
                
                if (typeof toastr !== 'undefined') {
                    toastr.error('An error occurred. Please try again.');
                }
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }
    
    // Contact Form Submission
    const contactForm = document.getElementById('contactForm');
    const contactFormMessage = document.getElementById('contactFormMessage');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = contactForm.querySelector('.btn-submit');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span>Sending...</span><i class="fas fa-spinner fa-spin ms-2"></i>';
            
            // Clear previous messages
            contactFormMessage.textContent = '';
            contactFormMessage.className = 'form-message';
            
            const formData = new FormData(contactForm);
            
            fetch(contactForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    contactFormMessage.className = 'form-message success';
                    contactFormMessage.textContent = data.message || 'Thank you for your message! We will get back to you soon.';
                    contactForm.reset();
                    
                    // Scroll to message
                    contactFormMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    
                    // Show success toast
                    if (typeof toastr !== 'undefined') {
                        toastr.success(data.message || 'Thank you for your message! We will get back to you soon.');
                    }
                } else {
                    contactFormMessage.className = 'form-message error';
                    let errorMessage = data.message || 'Something went wrong. Please try again.';
                    
                    // Display validation errors if available
                    if (data.errors) {
                        const errorList = Object.values(data.errors).flat().join(', ');
                        errorMessage = errorMessage + (errorList ? ' ' + errorList : '');
                    }
                    
                    contactFormMessage.textContent = errorMessage;
                    
                    // Scroll to message
                    contactFormMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    
                    if (typeof toastr !== 'undefined') {
                        toastr.error(errorMessage);
                    }
                }
            })
            .catch(error => {
                contactFormMessage.className = 'form-message error';
                contactFormMessage.textContent = 'An error occurred. Please try again later.';
                
                // Scroll to message
                contactFormMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                
                if (typeof toastr !== 'undefined') {
                    toastr.error('An error occurred. Please try again later.');
                }
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }
    
    // Swiper initialization
    const featuredProjectsSwiper = new Swiper('.featured-projects-swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
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
    
    // Service card flip for touch devices
    const serviceCards = document.querySelectorAll('.service-card-flip');
    serviceCards.forEach(card => {
        // Only add tap handler for touch devices
        if ('ontouchstart' in window || navigator.maxTouchPoints > 0) {
            card.addEventListener('click', function(e) {
                // Don't flip if clicking on a link
                if (e.target.closest('a')) {
                    return;
                }
                this.classList.toggle('flipped');
            });
        }
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
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Phone Number <i class="fas fa-phone"></i> <span class="text-danger">*</span></label>
                                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number"
                                    value="{{ old('phone') }}" required pattern="[0-9\+\-\s\(\)]+">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject <i class="fas fa-tag"></i></label>
                                <input type="text" id="subject" name="subject" placeholder="What's this about?"
                                    value="{{ old('subject') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Message <i class="fas fa-comment"></i></label>
                            <textarea id="message" name="message" placeholder="Tell us about your project..." rows="5" required>{{ old('message') }}</textarea>
                        </div>
                        <div class="form-message mt-3" id="contactFormMessage"></div>
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
