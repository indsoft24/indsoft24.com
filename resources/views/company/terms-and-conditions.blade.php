@extends('layouts.app')

@section('title', 'Terms and Conditions - Indsoft24.com | Service Terms & Free Blog Platform')

@section('meta')
<meta name="description" content="Read Indsoft24's terms and conditions. Use our free blog posting platform and digital services including website development, app development, and digital marketing.">
<meta name="keywords" content="terms and conditions, service terms, free blog platform terms, Indsoft24 terms">
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
        margin-top: 70px;
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
            <h1 class="display-4 fw-bold">Terms and Conditions</h1>
            <p class="lead" style="opacity: 0.95;">Please read these terms carefully before using our service.</p>
            <p style="opacity: 0.9;"><small>Last Updated: {{ date('F d, Y') }}</small></p>
        </div>
    </section>

    <section class="policy-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="card p-4 p-md-5">
                        <h2 class="mt-4">1. Agreement to Terms</h2>
                        <p>By accessing or using our website, https://www.indsoft24.com (the "Service"), you agree to be bound by these Terms and Conditions ("Terms"). If you disagree with any part of the terms, then you may not access the Service.</p>

                        <h2 class="mt-2">2. Intellectual Property</h2>
                        <p>The Service and its original content (excluding content provided by users), features, and functionality are and will remain the exclusive property of Indsoft24.com and its licensors. The content is protected by copyright, trademark, and other laws of both India and foreign countries. Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of Indsoft24.com.</p>

                        <h2 class="mt-2">3. User Accounts</h2>
                        <p>When you create an account with us (e.g., via Google Login), you must provide us with information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our Service.</p>
                        <p>You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password. You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.</p>

                        <h2 class="mt-2">4. User-Generated Content</h2>
                        <p>Our Service allows you to post, link, store, share and otherwise make available certain information, text, graphics, or other material ("Content"), such as comments on blog posts. You are responsible for the Content that you post to the Service, including its legality, reliability, and appropriateness.</p>
                        <p>By posting Content to the Service, you grant us the right and license to use, modify, publicly perform, publicly display, reproduce, and distribute such Content on and through the Service. You retain any and all of your rights to any Content you submit, post or display on or through the Service and you are responsible for protecting those rights.</p>
                        <p>You represent and warrant that: (i) the Content is yours (you own it) or you have the right to use it and grant us the rights and license as provided in these Terms, and (ii) the posting of your Content on or through the Service does not violate the privacy rights, publicity rights, copyrights, contract rights or any other rights of any person.</p>
                        <p>We reserve the right to block or remove comments or other user-generated content that we determine to be: unlawful, offensive, threatening, libelous, defamatory, obscene or otherwise objectionable or violates any party’s intellectual property or these Terms.</p>

                        <h2 class="mt-2">5. Prohibited Uses</h2>
                        <p>You agree not to use the Service:</p>
                        <ul>
                            <li>In any way that violates any applicable national or international law or regulation.</li>
                            <li>For the purpose of exploiting, harming, or attempting to exploit or harm minors in any way.</li>
                            <li>To transmit, or procure the sending of, any advertising or promotional material, including any "junk mail", "chain letter," "spam," or any other similar solicitation.</li>
                            <li>To impersonate or attempt to impersonate Indsoft24.com, an employee, another user, or any other person or entity.</li>
                            <li>To engage in any other conduct that restricts or inhibits anyone's use or enjoyment of the Service, or which, as determined by us, may harm Indsoft24.com or users of the Service or expose them to liability.</li>
                        </ul>

                        <h2 class="mt-2">6. Termination</h2>
                        <p>We may terminate or suspend your account and bar access to the Service immediately, without prior notice or liability, under our sole discretion, for any reason whatsoever and without limitation, including but not limited to a breach of the Terms.</p>

                        <h2 class="mt-2">7. Limitation of Liability</h2>
                        <p>In no event shall Indsoft24.com, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from your access to or use of or inability to access or use the Service.</p>

                        <h2 class="mt-2">8. Governing Law</h2>
                        <p>These Terms shall be governed and construed in accordance with the laws of India, without regard to its conflict of law provisions. Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights.</p>

                        <h2 class="mt-2">9. Changes</h2>
                        <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. We will provide notice of any changes by posting the new Terms on this page. By continuing to access or use our Service after any revisions become effective, you agree to be bound by the revised terms.</p>

                        <h2 class="mt-2">10. Contact Us</h2>
                        <p>If you have any questions about these Terms, please contact us through the contact form on our homepage.</p>
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
                    <h2 class="display-5 fw-bold text-primary mb-3">Use Our Services with Confidence</h2>
                    <p class="lead text-muted">Comprehensive digital solutions and a free blog platform</p>
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