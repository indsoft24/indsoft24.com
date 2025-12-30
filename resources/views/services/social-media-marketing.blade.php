@extends('layouts.app')

@section('title', 'Social Media Marketing Services & Pricing in India (2025) | IndSoft24')
@section('meta_description', 'Professional social media marketing services in India including Facebook, Instagram, LinkedIn, Twitter marketing. Content creation, community management, and paid advertising campaigns.')
@section('meta_keywords', 'social media marketing, SMM services, Facebook marketing, Instagram marketing, LinkedIn marketing, Twitter marketing, social media management, content creation, social media advertising, SMM agency India')

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
            <h1 class="display-4 fw-bold mb-3">Social Media Marketing Services & Pricing in India</h1>
            <p class="lead mb-4">
                Build your brand, engage your audience, and drive sales with our comprehensive social media marketing strategies. Transparent pricing, proven results.
            </p>
            <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer"
                class="btn btn-warning btn-lg">Get Free Social Media Audit</a>
        </div>
    </section>

    <!-- Services Overview -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Our Social Media Marketing Services</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-facebook display-4 text-primary mb-3"></i>
                        <h5 class="fw-bold">Facebook Marketing</h5>
                        <p class="text-muted">Build brand awareness, engage followers, and drive conversions with strategic Facebook marketing campaigns.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-instagram display-4 text-danger mb-3"></i>
                        <h5 class="fw-bold">Instagram Marketing</h5>
                        <p class="text-muted">Leverage visual storytelling to grow your Instagram presence, increase followers, and boost engagement rates.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-linkedin display-4 text-info mb-3"></i>
                        <h5 class="fw-bold">LinkedIn Marketing</h5>
                        <p class="text-muted">Establish thought leadership and generate B2B leads with professional LinkedIn marketing strategies.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-twitter display-4 text-info mb-3"></i>
                        <h5 class="fw-bold">Twitter Marketing</h5>
                        <p class="text-muted">Engage in real-time conversations, build brand voice, and drive traffic with strategic Twitter campaigns.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-camera-video display-4 text-danger mb-3"></i>
                        <h5 class="fw-bold">Content Creation</h5>
                        <p class="text-muted">Create engaging visuals, videos, and graphics that resonate with your audience and drive engagement.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-people display-4 text-success mb-3"></i>
                        <h5 class="fw-bold">Community Management</h5>
                        <p class="text-muted">Build and nurture your online community with responsive engagement, customer support, and relationship building.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section bg-light py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Social Media Marketing Pricing in India (2025)</h2>
            <p class="text-center text-muted mb-5">
                Choose a package that fits your social media goals. All packages include content creation, posting, and engagement management.
            </p>

            <div class="row g-4 justify-content-center">
                <!-- Basic Package -->
                <div class="col-md-4">
                    <div class="pricing-card text-center h-100">
                        <div class="icon-box">
                            <i class="bi bi-star"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Basic Package</h5>
                        <p class="text-muted">For small businesses</p>
                        <div class="price-tag">
                            <span class="currency">₹</span>12,000 – 25,000/month
                        </div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ 2 Social Media Platforms</li>
                            <li>✔ 15 Posts/Month</li>
                            <li>✔ Basic Content Creation</li>
                            <li>✔ Community Management</li>
                            <li>✔ Monthly Analytics Report</li>
                        </ul>
                        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-outline-primary mt-3">Get Started</a>
                    </div>
                </div>

                <!-- Professional Package -->
                <div class="col-md-4">
                    <div class="pricing-card text-center h-100 featured">
                        <div class="icon-box">
                            <i class="bi bi-award"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Professional Package</h5>
                        <p class="text-muted">For growing brands</p>
                        <div class="price-tag highlight">
                            <span class="currency">₹</span>25,000 – 60,000/month
                        </div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ 4 Social Media Platforms</li>
                            <li>✔ 30 Posts/Month</li>
                            <li>✔ Professional Content Creation</li>
                            <li>✔ Video Content (2-3/month)</li>
                            <li>✔ Advanced Community Management</li>
                            <li>✔ Social Media Advertising Setup</li>
                            <li>✔ Weekly Analytics Reports</li>
                        </ul>
                        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-primary mt-3">Most Popular</a>
                    </div>
                </div>

                <!-- Enterprise Package -->
                <div class="col-md-4">
                    <div class="pricing-card text-center h-100">
                        <div class="icon-box">
                            <i class="bi bi-trophy"></i>
                        </div>
                        <h5 class="fw-bold mt-3">Enterprise Package</h5>
                        <p class="text-muted">For large brands</p>
                        <div class="price-tag">
                            <span class="currency">₹</span>60,000 – 1,50,000+/month
                        </div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ All Major Platforms</li>
                            <li>✔ 60+ Posts/Month</li>
                            <li>✔ Premium Content Creation</li>
                            <li>✔ Video Content (10+/month)</li>
                            <li>✔ 24/7 Community Management</li>
                            <li>✔ Multi-Channel Advertising</li>
                            <li>✔ Influencer Partnerships</li>
                            <li>✔ Daily Analytics Reports</li>
                            <li>✔ Dedicated Account Manager</li>
                        </ul>
                        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-outline-danger mt-3">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Platform Details Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Social Media Platforms We Manage</h2>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-facebook display-4 text-primary me-3"></i>
                            <h4 class="fw-bold mb-0">Facebook Marketing</h4>
                        </div>
                        <p class="text-muted mb-3">
                            Maximize your Facebook presence with strategic content, targeted advertising, and community engagement.
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Facebook Page Management</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Facebook Ads Campaigns</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Content Strategy & Creation</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Community Engagement</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Facebook Analytics & Insights</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-instagram display-4 text-danger me-3"></i>
                            <h4 class="fw-bold mb-0">Instagram Marketing</h4>
                        </div>
                        <p class="text-muted mb-3">
                            Grow your Instagram following and engagement with visually stunning content and strategic hashtag campaigns.
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Instagram Feed Management</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Instagram Stories & Reels</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>IGTV Content Creation</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Instagram Shopping Setup</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Hashtag Research & Strategy</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-linkedin display-4 text-info me-3"></i>
                            <h4 class="fw-bold mb-0">LinkedIn Marketing</h4>
                        </div>
                        <p class="text-muted mb-3">
                            Establish your brand as a thought leader and generate quality B2B leads on LinkedIn.
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>LinkedIn Company Page Management</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>LinkedIn Ads Campaigns</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Professional Content Creation</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>LinkedIn Articles & Posts</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Lead Generation Campaigns</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-twitter display-4 text-info me-3"></i>
                            <h4 class="fw-bold mb-0">Twitter Marketing</h4>
                        </div>
                        <p class="text-muted mb-3">
                            Build brand awareness and engage with your audience in real-time conversations on Twitter.
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Twitter Profile Management</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Twitter Ads Campaigns</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Trending Topic Engagement</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Twitter Analytics & Reporting</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Hashtag Campaign Management</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Creation Services -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Content Creation & Management Services</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-image display-4 text-primary mb-3"></i>
                        <h5 class="fw-bold">Visual Content Creation</h5>
                        <p class="text-muted">Eye-catching graphics, infographics, and visual designs that capture attention and drive engagement.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-camera-video display-4 text-danger mb-3"></i>
                        <h5 class="fw-bold">Video Content</h5>
                        <p class="text-muted">Engaging video content including Reels, Stories, IGTV, and YouTube videos that tell your brand story.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-pencil-square display-4 text-success mb-3"></i>
                        <h5 class="fw-bold">Copywriting</h5>
                        <p class="text-muted">Compelling captions, posts, and ad copy that resonate with your audience and drive action.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Why Choose IndSoft24 for Social Media Marketing?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-graph-up-arrow display-4 text-primary mb-3"></i>
                        <h5 class="fw-bold">Proven Growth Strategies</h5>
                        <p class="text-muted">Data-driven social media strategies that deliver measurable results in followers, engagement, and conversions.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-people display-4 text-success mb-3"></i>
                        <h5 class="fw-bold">Expert Content Creators</h5>
                        <p class="text-muted">Talented designers, videographers, and copywriters who create content that resonates with your audience.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-clock-history display-4 text-warning mb-3"></i>
                        <h5 class="fw-bold">Consistent Posting</h5>
                        <p class="text-muted">Regular, consistent posting schedules that keep your audience engaged and your brand top-of-mind.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 text-center bg-light">
        <div class="container">
            <h2 class="fw-bold mb-3">Ready to Grow Your Social Media Presence?</h2>
            <p class="text-muted mb-4">Let's discuss how our social media marketing services can help you build a strong online community and drive business growth.</p>
            <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer"
                class="btn btn-primary btn-lg">Request a Free Social Media Consultation</a>
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

