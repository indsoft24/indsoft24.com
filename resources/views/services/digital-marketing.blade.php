@extends('layouts.app')

@section('title', 'Digital Marketing Services & Pricing in India (2025) | IndSoft24')
@section('meta_description', 'Comprehensive digital marketing services in India including SEO, PPC, content marketing, email marketing, and social media. Transparent pricing and proven strategies to grow your online presence.')
@section('meta_keywords', 'digital marketing services, online marketing, digital marketing agency India, SEO services, PPC advertising, content marketing, email marketing, social media marketing, digital marketing pricing')

@section('content')
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

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
            <h1 class="display-4 fw-bold mb-3">Digital Marketing Services & Pricing in India</h1>
            <p class="lead mb-4">
                Drive growth, increase brand visibility, and generate qualified leads with our comprehensive digital marketing strategies. Transparent pricing, measurable results.
            </p>
            <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer"
                class="btn btn-warning btn-lg">Get Free Marketing Consultation</a>
        </div>
    </section>

    <!-- Services Overview -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Our Digital Marketing Services</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-search display-4 text-primary mb-3"></i>
                        <h5 class="fw-bold">Search Engine Optimization (SEO)</h5>
                        <p class="text-muted">Improve your Google rankings, increase organic traffic, and boost online visibility with data-driven SEO strategies.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-megaphone display-4 text-success mb-3"></i>
                        <h5 class="fw-bold">Pay-Per-Click (PPC) Advertising</h5>
                        <p class="text-muted">Maximize ROI with targeted Google Ads and social media advertising campaigns that drive qualified leads.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-file-text display-4 text-warning mb-3"></i>
                        <h5 class="fw-bold">Content Marketing</h5>
                        <p class="text-muted">Engage your audience with high-quality content that builds trust, drives traffic, and converts visitors into customers.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-envelope display-4 text-info mb-3"></i>
                        <h5 class="fw-bold">Email Marketing</h5>
                        <p class="text-muted">Nurture leads and retain customers with personalized email campaigns that drive engagement and sales.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-graph-up display-4 text-danger mb-3"></i>
                        <h5 class="fw-bold">Analytics & Reporting</h5>
                        <p class="text-muted">Track performance, measure ROI, and make data-driven decisions with comprehensive analytics and monthly reports.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-bullseye display-4 text-secondary mb-3"></i>
                        <h5 class="fw-bold">Conversion Rate Optimization</h5>
                        <p class="text-muted">Optimize your website and landing pages to convert more visitors into customers and maximize your marketing ROI.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section bg-light py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Digital Marketing Pricing in India (2025)</h2>
            <p class="text-center text-muted mb-5">
                Choose a package that fits your business needs. All packages include strategy, execution, and monthly reporting.
            </p>

            <div class="row g-4 justify-content-center">
                <!-- Starter Package -->
                <div class="col-md-4">
                    <div class="pricing-card text-center h-100">
                        <div class="icon-box">
                            <i class="bi bi-rocket"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Starter Package</h5>
                        <p class="text-muted">For small businesses & startups</p>
                        <div class="price-tag">
                            <span class="currency">₹</span>15,000 – 30,000/month
                        </div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ Basic SEO Optimization</li>
                            <li>✔ Social Media Management (2 platforms)</li>
                            <li>✔ 4 Blog Posts/Month</li>
                            <li>✔ Monthly Analytics Report</li>
                            <li>✔ Email Marketing Setup</li>
                        </ul>
                        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-outline-primary mt-3">Get Started</a>
                    </div>
                </div>

                <!-- Growth Package -->
                <div class="col-md-4">
                    <div class="pricing-card text-center h-100 featured">
                        <div class="icon-box">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Growth Package</h5>
                        <p class="text-muted">For growing businesses</p>
                        <div class="price-tag highlight">
                            <span class="currency">₹</span>30,000 – 75,000/month
                        </div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ Comprehensive SEO Strategy</li>
                            <li>✔ PPC Campaign Management</li>
                            <li>✔ Social Media Management (4 platforms)</li>
                            <li>✔ 8 Blog Posts/Month</li>
                            <li>✔ Content Marketing Strategy</li>
                            <li>✔ Weekly Analytics Reports</li>
                            <li>✔ Email Marketing Automation</li>
                        </ul>
                        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-primary mt-3">Most Popular</a>
                    </div>
                </div>

                <!-- Enterprise Package -->
                <div class="col-md-4">
                    <div class="pricing-card text-center h-100">
                        <div class="icon-box">
                            <i class="bi bi-building"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Enterprise Package</h5>
                        <p class="text-muted">For large businesses</p>
                        <div class="price-tag">
                            <span class="currency">₹</span>75,000 – 2,00,000+/month
                        </div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ Advanced SEO & Technical SEO</li>
                            <li>✔ Multi-Channel PPC Campaigns</li>
                            <li>✔ Full Social Media Management</li>
                            <li>✔ 15+ Blog Posts/Month</li>
                            <li>✔ Video Content Creation</li>
                            <li>✔ Advanced Analytics & Reporting</li>
                            <li>✔ Dedicated Account Manager</li>
                            <li>✔ 24/7 Support</li>
                        </ul>
                        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-outline-danger mt-3">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Details Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Comprehensive Digital Marketing Solutions</h2>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <h4 class="fw-bold mb-3"><i class="bi bi-search text-primary me-2"></i>Search Engine Optimization (SEO)</h4>
                        <p class="text-muted mb-3">
                            Improve your website's visibility on search engines and drive organic traffic with our comprehensive SEO services.
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>On-page SEO optimization</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Off-page SEO & link building</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Technical SEO audit & fixes</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Keyword research & strategy</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Local SEO optimization</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Monthly performance reports</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <h4 class="fw-bold mb-3"><i class="bi bi-megaphone text-success me-2"></i>Pay-Per-Click (PPC) Advertising</h4>
                        <p class="text-muted mb-3">
                            Drive immediate traffic and leads with targeted advertising campaigns on Google, Facebook, and other platforms.
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Google Ads campaign setup</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Facebook & Instagram Ads</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Keyword research & bidding</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Ad copywriting & optimization</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Landing page optimization</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>ROI tracking & optimization</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <h4 class="fw-bold mb-3"><i class="bi bi-file-text text-warning me-2"></i>Content Marketing</h4>
                        <p class="text-muted mb-3">
                            Create valuable, engaging content that attracts, educates, and converts your target audience.
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Blog writing & optimization</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Content strategy development</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>SEO-optimized content creation</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Infographic design</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Video content planning</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Content calendar management</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <h4 class="fw-bold mb-3"><i class="bi bi-envelope text-info me-2"></i>Email Marketing</h4>
                        <p class="text-muted mb-3">
                            Build relationships and drive sales with personalized email campaigns that engage and convert.
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Email campaign design</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Automated email sequences</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>List segmentation & management</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>A/B testing & optimization</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Performance analytics</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Newsletter creation</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Why Choose IndSoft24 for Digital Marketing?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-graph-up-arrow display-4 text-primary mb-3"></i>
                        <h5 class="fw-bold">Proven Results</h5>
                        <p class="text-muted">Data-driven strategies that deliver measurable results. Track your ROI with detailed analytics and reporting.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-people display-4 text-success mb-3"></i>
                        <h5 class="fw-bold">Expert Team</h5>
                        <p class="text-muted">Certified digital marketing professionals with years of experience in SEO, PPC, content marketing, and analytics.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-clock-history display-4 text-warning mb-3"></i>
                        <h5 class="fw-bold">Transparent Reporting</h5>
                        <p class="text-muted">Monthly reports with clear metrics, insights, and recommendations. Know exactly what you're paying for.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 text-center bg-light">
        <div class="container">
            <h2 class="fw-bold mb-3">Ready to Grow Your Online Presence?</h2>
            <p class="text-muted mb-4">Let's discuss how our digital marketing services can help you achieve your business goals.</p>
            <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer"
                class="btn btn-primary btn-lg">Request a Free Marketing Consultation</a>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        /* Include all styles from web-development page */
        @import url('{{ asset("css/styles.css") }}');
        
        /* Pricing Card Styles */
        .pricing-card {
            background: #fff;
            border-radius: 0;
            padding: 30px 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .pricing-card.featured {
            border: 2px solid #0d6efd;
            transform: scale(1.05);
            z-index: 2;
        }

        .icon-box {
            width: 70px;
            height: 70px;
            margin: 0 auto;
            border-radius: 0;
            background: #e9f2ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #0d6efd;
            transition: all 0.3s ease;
        }

        .pricing-card:hover .icon-box {
            background: #0d6efd;
            color: #fff;
        }

        .price-tag {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 15px 0;
            color: #333;
            position: relative;
            display: inline-block;
            padding: 5px 15px;
            border-radius: 0;
            background: #f8f9fa;
        }

        .price-tag.highlight {
            background: #0d6efd;
            color: #fff;
        }

        .price-tag .currency {
            font-size: 1rem;
            vertical-align: super;
        }
    </style>
@endpush

