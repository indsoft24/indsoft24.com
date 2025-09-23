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
                    <a href="#services" class="btn btn-secondary">
                        <i class="fas fa-play"></i>
                        <span>Watch Our Work</span>
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
