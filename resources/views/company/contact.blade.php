@extends('layouts.app')

@section('title', 'Contact Us - Indsoft24 | Get Free Consultation for Digital Solutions')

@section('meta')
<meta name="description" content="Contact Indsoft24 for website development, app development, digital marketing, social media marketing, and creative services. Also enjoy free blog posting to share your content and earn money.">
<meta name="keywords" content="contact Indsoft24, website development services, app development, digital marketing, free blog posting, contact digital agency">
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
    
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }
    
    .contact-benefits-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 50px 30px;
        margin: 40px 0;
        color: white;
        animation: fadeInUp 1s ease-out;
    }
    
    .benefit-item {
        text-align: center;
        padding: 20px;
        animation: fadeInUp 0.8s ease-out;
        animation-fill-mode: both;
    }
    
    .benefit-item:nth-child(1) { animation-delay: 0.1s; }
    .benefit-item:nth-child(2) { animation-delay: 0.2s; }
    .benefit-item:nth-child(3) { animation-delay: 0.3s; }
    .benefit-item:nth-child(4) { animation-delay: 0.4s; }
    
    .benefit-icon {
        font-size: 3rem;
        margin-bottom: 15px;
        animation: pulse 2s ease-in-out infinite;
    }
    
    .contact-info-card {
        animation: fadeInUp 0.8s ease-out;
        animation-fill-mode: both;
    }
    
    .contact-info-card:nth-child(1) { animation-delay: 0.1s; }
    .contact-info-card:nth-child(2) { animation-delay: 0.2s; }
    .contact-info-card:nth-child(3) { animation-delay: 0.3s; }
</style>
@endpush

@section('content')
<div class="contact-page" style="margin-top: 106px; padding: 40px 0;">
    <div class="container">
        <!-- Page Header -->
        <div class="text-center mb-5" style="animation: fadeInUp 1s ease-out;">
            <h1 class="display-4 fw-bold mb-3">Get in Touch</h1>
            <p class="lead text-muted">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            <p class="text-muted">Get free consultation for all our digital solutions including website development, app development, digital marketing, and more!</p>
        </div>

        <div class="row g-4">
            <!-- Contact Information Cards -->
            <div class="col-lg-4 col-md-6">
                <div class="contact-info-card h-100">
                    <div class="contact-icon-wrapper">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h4 class="contact-info-title">Email Us</h4>
                    <p class="contact-info-text">Send us an email anytime</p>
                    <a href="mailto:indsoft24@gmail.com" class="contact-info-link">indsoft24@gmail.com</a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="contact-info-card h-100">
                    <div class="contact-icon-wrapper">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h4 class="contact-info-title">Call Us</h4>
                    <p class="contact-info-text">Mon-Fri 9AM-6PM IST</p>
                    <a href="tel:+917520744870" class="contact-info-link">+91 75207 44870</a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="contact-info-card h-100">
                    <div class="contact-icon-wrapper">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4 class="contact-info-title">Visit Us</h4>
                    <p class="contact-info-text">Our office location</p>
                    <p class="contact-info-link">Noida, Uttar Pradesh, India</p>
                </div>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="contact-benefits-section">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Why Contact Indsoft24?</h2>
                <p class="lead mb-0" style="opacity: 0.95;">We offer comprehensive digital solutions and a free platform for creators</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Website Development</h5>
                        <p class="mb-0 small" style="opacity: 0.9;">Professional, responsive websites that convert</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h5 class="fw-bold mb-2">App Development</h5>
                        <p class="mb-0 small" style="opacity: 0.9;">Android & iOS apps for your business</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Digital Marketing</h5>
                        <p class="mb-0 small" style="opacity: 0.9;">SEO, Google Ads, Social Media Marketing</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-blog"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Free Blog Platform</h5>
                        <p class="mb-0 small" style="opacity: 0.9;">Post blogs for free and earn money</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <p class="mb-3">We also offer: Software Development, Creative Services, Social Media Marketing, and more!</p>
                <div>
                    @auth
                        <a href="{{ route('user.blog.create') }}" class="btn btn-light btn-lg me-2">
                            <i class="fas fa-blog me-2"></i>Start Blogging Free
                        </a>
                    @else
                        <a href="{{ route('auth.google') }}" class="btn btn-light btn-lg me-2">
                            <i class="fab fa-google me-2"></i>Login & Start Blogging
                        </a>
                    @endauth
                    <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-info-circle me-2"></i>Learn More
                    </a>
                </div>
            </div>
        </div>

        <!-- Contact Form and Map Section -->
        <div class="row g-4 mt-2">
            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="contact-form-wrapper">
                    <h2 class="section-title mb-4">Send us a Message</h2>
                    <form id="contactPageForm" method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <!-- Honeypot field for bot detection -->
                        <input type="text" name="website" style="display: none;" tabindex="-1" autocomplete="off">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           required 
                                           placeholder="Enter your full name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required 
                                           placeholder="Enter your email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-label">
                                        <i class="fas fa-phone me-1"></i>Phone Number <span class="text-danger">*</span>
                                    </label>
                                    <input type="tel" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone') }}" 
                                           required
                                           pattern="[0-9\+\-\s\(\)]+"
                                           placeholder="Enter your phone number">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('subject') is-invalid @enderror" 
                                           id="subject" 
                                           name="subject" 
                                           value="{{ old('subject') }}" 
                                           required 
                                           placeholder="What is this regarding?">
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" 
                                              id="message" 
                                              name="message" 
                                              rows="6" 
                                              required 
                                              placeholder="Tell us more about your inquiry...">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-message mb-3" id="contactPageFormMessage" style="display: none;"></div>
                                <button type="submit" class="btn btn-primary btn-lg w-100" id="submitBtn">
                                    <span class="btn-text">Send Message</span>
                                    <span class="btn-loader" style="display: none;">
                                        <i class="fas fa-spinner fa-spin"></i> Sending...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Map Section -->
            <div class="col-lg-5">
                <div class="contact-map-wrapper">
                    <h2 class="section-title mb-4">Find Us</h2>
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3503.016680625!2d77.32726431455847!3d28.5351969824303!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce5a43173357b%3A0x37ffce13c4a29615!2sNoida%2C%20Uttar%20Pradesh%2C%20India!5e0!3m2!1sen!2sus!4v1234567890123!5m2!1sen!2sus" 
                            width="100%" 
                            height="400" 
                            style="border:0; border-radius: 12px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    
                    <!-- Additional Contact Info -->
                    <div class="contact-details mt-4">
                        <div class="contact-detail-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <strong>Business Hours</strong>
                                <p class="mb-0">Monday - Friday: 9:00 AM - 6:00 PM IST<br>Saturday: 10:00 AM - 4:00 PM IST</p>
                            </div>
                        </div>
                        <div class="contact-detail-item mt-3">
                            <i class="fas fa-headset"></i>
                            <div>
                                <strong>Support</strong>
                                <p class="mb-0">We'll respond within 24 hours</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="contact-social-section text-center">
                    <h3 class="mb-4">Connect With Us</h3>
                    <div class="social-links-large">
                        <a href="https://www.linkedin.com/in/indian-software-services/" class="social-link-large" target="_blank" rel="noopener noreferrer" title="LinkedIn">
                            <i class="fab fa-linkedin"></i>
                            <span>LinkedIn</span>
                        </a>
                        <a href="https://www.facebook.com/profile.php?id=61580300354385" class="social-link-large" target="_blank" rel="noopener noreferrer" title="Facebook">
                            <i class="fab fa-facebook"></i>
                            <span>Facebook</span>
                        </a>
                        <a href="https://github.com/indsoft24" class="social-link-large" target="_blank" rel="noopener noreferrer" title="GitHub">
                            <i class="fab fa-github"></i>
                            <span>GitHub</span>
                        </a>
                        <a href="#" class="social-link-large" target="_blank" rel="noopener noreferrer" title="Twitter">
                            <i class="fab fa-twitter"></i>
                            <span>Twitter</span>
                        </a>
                        <a href="#" class="social-link-large" target="_blank" rel="noopener noreferrer" title="Instagram">
                            <i class="fab fa-instagram"></i>
                            <span>Instagram</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.contact-page {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: calc(100vh - 80px);
}

.contact-info-card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.contact-info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.contact-icon-wrapper {
    width: 70px;
    height: 70px;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, #3498db, #2980b9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 28px;
}

.contact-info-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #2c3e50;
}

.contact-info-text {
    color: #6c757d;
    margin-bottom: 10px;
    font-size: 0.95rem;
}

.contact-info-link {
    color: #3498db;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.contact-info-link:hover {
    color: #2980b9;
    text-decoration: underline;
}

.contact-form-wrapper {
    background: white;
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border: 1px solid #e9ecef;
}

.contact-map-wrapper {
    background: white;
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border: 1px solid #e9ecef;
    height: 100%;
}

.section-title {
    font-size: 1.75rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 500;
    color: #2c3e50;
    margin-bottom: 8px;
    display: block;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    outline: none;
}

.form-message {
    padding: 0.75rem 1rem;
    border-radius: 8px;
    font-size: 0.95rem;
    text-align: center;
    display: none;
}

.form-message.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    display: block;
}

.form-message.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    display: block;
}

.btn-primary {
    background: linear-gradient(135deg, #3498db, #2980b9);
    border: none;
    border-radius: 8px;
    padding: 14px 28px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #2980b9, #1f6391);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
}

.map-container {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.contact-details {
    padding-top: 20px;
}

.contact-detail-item {
    display: flex;
    gap: 15px;
    align-items: flex-start;
}

.contact-detail-item i {
    color: #3498db;
    font-size: 1.5rem;
    margin-top: 5px;
}

.contact-detail-item strong {
    color: #2c3e50;
    display: block;
    margin-bottom: 5px;
}

.contact-detail-item p {
    color: #6c757d;
    font-size: 0.95rem;
}

.contact-social-section {
    background: white;
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border: 1px solid #e9ecef;
}

.social-links-large {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.social-link-large {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
    text-decoration: none;
    color: #2c3e50;
    transition: all 0.3s ease;
    min-width: 100px;
}

.social-link-large i {
    font-size: 2rem;
    color: #3498db;
}

.social-link-large:hover {
    background: linear-gradient(135deg, #3498db, #2980b9);
    color: white;
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(52, 152, 219, 0.3);
}

.social-link-large:hover i {
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .contact-page {
        padding: 20px 0;
        margin-top: 102px;
    }

    .contact-form-wrapper,
    .contact-map-wrapper {
        padding: 25px;
    }

    .contact-info-card {
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 1.5rem;
    }

    .social-links-large {
        gap: 15px;
    }

    .social-link-large {
        min-width: 80px;
        padding: 15px;
    }

    .social-link-large i {
        font-size: 1.5rem;
    }
}

@media (max-width: 576px) {
    .contact-form-wrapper,
    .contact-map-wrapper {
        padding: 20px;
    }

    .contact-icon-wrapper {
        width: 60px;
        height: 60px;
        font-size: 24px;
    }

    .social-link-large {
        min-width: 70px;
        padding: 12px;
        font-size: 0.85rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactPageForm');
    if (!form) return;
    
    const submitBtn = document.getElementById('submitBtn');
    if (!submitBtn) return;
    
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoader = submitBtn.querySelector('.btn-loader');
    let isSubmitting = false; // Prevent double submission

    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        
        // Prevent double submission
        if (isSubmitting) {
            return false;
        }
        
        isSubmitting = true;
        const formData = new FormData(form);
        
        // Hide previous messages
        const messageDiv = document.getElementById('contactPageFormMessage');
        if (messageDiv) {
            messageDiv.style.display = 'none';
            messageDiv.textContent = '';
        }
        
        // Show loading state
        if (btnText) btnText.style.display = 'none';
        if (btnLoader) btnLoader.style.display = 'inline-block';
        submitBtn.disabled = true;

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        })
        .then(response => response.json())
        .then(data => {
            const messageDiv = document.getElementById('contactPageFormMessage');
            
            if (data.success) {
                // Show success message in form
                if (messageDiv) {
                    messageDiv.className = 'form-message success';
                    messageDiv.textContent = data.message || 'Thank you for your message! We will get back to you soon.';
                    messageDiv.style.display = 'block';
                    messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
                
                // Show success message using toastr (consistent with site)
                if (typeof toastr !== 'undefined') {
                    toastr.success(data.message || 'Thank you for your message! We will get back to you soon.');
                } else if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: data.alert?.title || 'Message Sent!',
                        text: data.alert?.text || data.message,
                        icon: 'success',
                        confirmButtonText: data.alert?.confirmButtonText || 'OK'
                    });
                } else {
                    alert(data.message || 'Thank you for your message! We will get back to you soon.');
                }
                // Reset form
                form.reset();
            } else {
                // Show error message in form
                if (messageDiv) {
                    messageDiv.className = 'form-message error';
                    let errorMessage = data.message || 'There was an error sending your message. Please try again.';
                    
                    // Display validation errors if available
                    if (data.errors) {
                        const errorList = Object.values(data.errors).flat().join(', ');
                        errorMessage = errorMessage + (errorList ? ' ' + errorList : '');
                    }
                    
                    messageDiv.textContent = errorMessage;
                    messageDiv.style.display = 'block';
                    messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
                
                // Show error message using toastr
                if (typeof toastr !== 'undefined') {
                    toastr.error(data.message || 'There was an error sending your message. Please try again.');
                } else if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: data.alert?.title || 'Error',
                        text: data.alert?.text || data.message,
                        icon: data.alert?.icon || 'error',
                        confirmButtonText: data.alert?.confirmButtonText || 'OK'
                    });
                } else {
                    alert(data.message || 'There was an error sending your message. Please try again.');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const messageDiv = document.getElementById('contactPageFormMessage');
            
            // Show error message in form
            if (messageDiv) {
                messageDiv.className = 'form-message error';
                messageDiv.textContent = 'An error occurred. Please try again later.';
                messageDiv.style.display = 'block';
                messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
            
            if (typeof toastr !== 'undefined') {
                toastr.error('There was an error sending your message. Please try again.');
            } else if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Error',
                    text: 'There was an error sending your message. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            } else {
                alert('There was an error sending your message. Please try again.');
            }
        })
        .finally(() => {
            // Reset button state
            if (btnText) btnText.style.display = 'inline-block';
            if (btnLoader) btnLoader.style.display = 'none';
            submitBtn.disabled = false;
            isSubmitting = false; // Reset submission flag
        });
    });
});
</script>
@endsection

