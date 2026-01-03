@extends('layouts.app')

@section('title', 'Cookie Policy - Indsoft24.com | Cookie Usage & Free Blog Platform')

@section('meta')
<meta name="description" content="Learn how Indsoft24 uses cookies to enhance your experience on our free blog posting platform and digital services including website development, app development, and digital marketing.">
<meta name="keywords" content="cookie policy, cookies, Indsoft24 cookies, free blog platform cookies">
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
    
    .policy-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 60px 0;
        animation: fadeInUp 1s ease-out;
    }
    
    .policy-benefits {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 20px;
        padding: 40px;
        margin: 40px 0;
        animation: fadeInUp 1s ease-out;
    }
</style>
@endpush

@section('content')
<div class="policy-page">
    <section class="policy-header">
        <div class="container">
            <h1 class="display-4 fw-bold">Cookie Policy</h1>
            <p class="lead" style="opacity: 0.95;">How we use cookies to improve your experience.</p>
            <p style="opacity: 0.9;"><small>Last Updated: {{ date('F d, Y') }}</small></p>
        </div>
    </section>

    <section class="policy-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card p-4 p-md-5">
                        <h2 class="mt-4">1. What Are Cookies?</h2>
                        <p>Cookies are small text files that are stored on your device (computer, tablet, mobile phone) when you visit a website. They are widely used to make websites work more efficiently, as well as to provide reporting information and remember your preferences.</p>

                        <h2 class="mt-2">2. How We Use Cookies</h2>
                        <p>We use cookies for several reasons, detailed below:</p>
                        <ul>
                            <li><strong>Essential Cookies:</strong> These are strictly necessary to provide you with services available through our website and to use some of its features, such as authentication and security. Your Laravel session and CSRF token are managed by these cookies.</li>
                            <li><strong>Performance and Analytics Cookies:</strong> These cookies collect information about how you use our website, like which pages you visited and which links you clicked on. This information is aggregated and anonymized and is used to help us improve how our website works. We use Google Analytics for this purpose.</li>
                            <li><strong>Functionality Cookies:</strong> These cookies allow our website to remember choices you make, such as your username or language preference. The purpose of these cookies is to provide you with a more personal experience and to avoid you having to re-enter your preferences every time you visit.</li>
                        </ul>

                        <h2 class="mt-2">3. Third-Party Cookies</h2>
                        <p>In addition to our own cookies, we may also use various third-parties cookies to report usage statistics of the Service. As of the date of this policy, we use:</p>
                        <ul>
                            <li><strong>Google Analytics:</strong> We use Google Analytics to collect and analyze traffic on our site. Google Analytics does not identify individual users. You can learn about Google's practices by going to <a href="https://www.google.com/policies/privacy/partners/" target="_blank" rel="noopener noreferrer">www.google.com/policies/privacy/partners/</a>, and opt-out of them by downloading the Google Analytics opt-out browser add-on.</li>
                        </ul>

                        <h2 class="mt-2">4. Your Choices Regarding Cookies</h2>
                        <p>You have the right to decide whether to accept or reject cookies. You can exercise your cookie preferences by setting or amending your web browser controls to accept or refuse cookies. If you choose to reject cookies, you may still use our website though your access to some functionality and areas may be restricted.</p>
                        <p>To find out more about how to manage and delete cookies, visit <a href="https://www.aboutcookies.org" target="_blank" rel="noopener noreferrer">aboutcookies.org</a>.</p>

                        <h2 class="mt-2">5. Changes to This Cookie Policy</h2>
                        <p>We may update this Cookie Policy from time to time. We encourage you to review this page periodically for any changes. Changes are effective when they are posted on this page.</p>

                        <h2 class="mt-2">6. Contact Us</h2>
                        <p>If you have any questions about our use of cookies, please contact us through the contact form on our homepage.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Benefits Section -->
    <section class="py-5">
        <div class="container">
            <div class="policy-benefits">
                <div class="text-center mb-4">
                    <h2 class="display-5 fw-bold text-primary mb-3">Experience Our Services</h2>
                    <p class="lead text-muted">Cookies help us provide you with the best experience on our platform</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3 text-center">
                        <i class="fas fa-globe fa-3x text-primary mb-3"></i>
                        <h5 class="fw-bold">Website Development</h5>
                    </div>
                    <div class="col-md-6 col-lg-3 text-center">
                        <i class="fas fa-mobile-alt fa-3x text-success mb-3"></i>
                        <h5 class="fw-bold">App Development</h5>
                    </div>
                    <div class="col-md-6 col-lg-3 text-center">
                        <i class="fas fa-chart-line fa-3x text-info mb-3"></i>
                        <h5 class="fw-bold">Digital Marketing</h5>
                    </div>
                    <div class="col-md-6 col-lg-3 text-center">
                        <i class="fas fa-blog fa-3x text-warning mb-3"></i>
                        <h5 class="fw-bold">Free Blog Platform</h5>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <p class="mb-3">Plus: Software Development, Social Media Marketing, Creative Services, and more!</p>
                    @auth
                        <a href="{{ route('user.blog.create') }}" class="btn btn-primary btn-lg me-2">
                            <i class="fas fa-blog me-2"></i>Start Blogging Free
                        </a>
                    @else
                        <a href="{{ route('auth.google') }}" class="btn btn-primary btn-lg me-2">
                            <i class="fab fa-google me-2"></i>Login & Start Blogging
                        </a>
                    @endauth
                    <a href="{{ route('about') }}" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-info-circle me-2"></i>Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection