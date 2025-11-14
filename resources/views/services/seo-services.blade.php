@extends('layouts.app')

@section('title', 'SEO Services & Pricing in India (2025) | IndSoft24')
@section('meta_description', 'Affordable SEO services and pricing in India. We offer on-page, off-page, and technical SEO to boost your Google rankings, traffic, and leads.')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <section class="achievement-badge text-white py-5" style="margin-top:72px">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">SEO Services & Pricing in India</h1>
            <p class="lead mb-4">
                Increase your organic traffic, improve Google rankings, and generate more leads with our data-driven SEO strategies.
            </p>
            <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer"
                class="btn btn-warning btn-lg">Get a Free SEO Audit</a>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Our Core SEO Services</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-file-earmark-text-fill display-4 text-primary mb-3"></i>
                        <h5 class="fw-bold">On-Page SEO</h5>
                        <p class="text-muted">Optimizing your website's content and structure with keyword research, meta tags, and high-quality content to rank higher.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-link-45deg display-4 text-success mb-3"></i>
                        <h5 class="fw-bold">Off-Page SEO</h5>
                        <p class="text-muted">Building your website's authority and credibility through high-quality backlinks, content marketing, and strategic outreach.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100 text-center p-3">
                        <i class="bi bi-gear-fill display-4 text-warning mb-3"></i>
                        <h5 class="fw-bold">Technical SEO</h5>
                        <p class="text-muted">Ensuring your website is technically sound for search engines, focusing on site speed, mobile-friendliness, and crawlability.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pricing-section bg-light py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">SEO Pricing in India (2025)</h2>
            <p class="text-center text-muted mb-5">
                Monthly packages designed for sustainable growth and measurable results.
            </p>

            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="pricing-card text-center h-100">
                        <div class="icon-box"><i class="bi bi-rocket-takeoff"></i></div>
                        <h5 class="fw-bold mt-3">Startup SEO</h5>
                        <p class="text-muted">For small & local businesses</p>
                        <div class="price-tag"><span class="currency">₹</span>15,000 – 30,000<small>/mo</small></div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ Up to 20 Keywords</li>
                            <li>✔ On-Page Optimization</li>
                            <li>✔ Local SEO Setup</li>
                            <li>✔ Monthly Reporting</li>
                        </ul>
                        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-outline-primary mt-3">Get Started</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="pricing-card text-center h-100 featured">
                        <div class="icon-box"><i class="bi bi-graph-up-arrow"></i></div>
                        <h5 class="fw-bold mt-3">Business SEO</h5>
                        <p class="text-muted">For growing companies</p>
                        <div class="price-tag highlight"><span class="currency">₹</span>30,000 – 75,000<small>/mo</small></div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ Up to 50 Keywords</li>
                            <li>✔ Content Strategy</li>
                            <li>✔ Advanced Link Building</li>
                            <li>✔ Technical SEO Audit</li>
                        </ul>
                        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-primary mt-3">Most Popular</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="pricing-card text-center h-100">
                        <div class="icon-box"><i class="bi bi-trophy"></i></div>
                        <h5 class="fw-bold mt-3">Enterprise SEO</h5>
                        <p class="text-muted">For competitive industries</p>
                        <div class="price-tag"><span class="currency">₹</span>75,000+<small>/mo</small></div>
                        <ul class="list-unstyled mt-3">
                            <li>✔ 100+ Keywords</li>
                            <li>✔ Content Marketing Campaigns</li>
                            <li>✔ National/International SEO</li>
                            <li>✔ In-depth Analytics</li>
                        </ul>
                        <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer" class="btn btn-outline-danger mt-3">Get a Custom Quote</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">💡 What Our SEO Packages Include</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
                        <i class="bi bi-search text-primary display-5 mb-3"></i>
                        <h5 class="fw-bold">Comprehensive SEO Audit</h5>
                        <p class="small text-muted">A deep dive into your website's technical health, content, and backlink profile to identify opportunities.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
                        <i class="bi bi-key text-success display-5 mb-3"></i>
                        <h5 class="fw-bold">Keyword Research & Strategy</h5>
                        <p class="small text-muted">Identifying high-value keywords your customers are searching for to target in content and campaigns.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
                        <i class="bi bi-pencil-fill text-danger display-5 mb-3"></i>
                        <h5 class="fw-bold">Content Optimization</h5>
                        <p class="small text-muted">Enhancing your existing content and creating new, SEO-friendly articles to attract and engage your audience.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
                        <i class="bi bi-bar-chart-line-fill text-warning display-5 mb-3"></i>
                        <h5 class="fw-bold">Monthly Performance Reporting</h5>
                        <p class="small text-muted">Transparent, easy-to-understand reports showing your progress on keyword rankings, traffic, and conversions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Tools We Use</h2>
            <div class="row g-4 justify-content-center text-center">
                @php
                    $tools = ['Google Analytics', 'Google Search Console', 'Ahrefs', 'SEMrush', 'Moz', 'Screaming Frog'];
                @endphp
                @foreach ($tools as $tool)
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="p-3 border rounded shadow-sm h-100 d-flex align-items-center justify-content-center">
                            <p class="fw-semibold mb-0 fs-5">{{ $tool }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-5 text-center bg-light">
        <div class="container">
            <h2 class="fw-bold mb-3">Ready to Dominate Search Rankings?</h2>
            <p class="text-muted mb-4">Let's build a strategy to get your business in front of the right customers at the right time.</p>
            <a data-bs-toggle="modal" data-bs-target="#getInTouchModal" style="cursor:pointer"
                class="btn btn-primary btn-lg">Request a Free Consultation</a>
        </div>
    </section>

    @push('styles')
        <style>
            /* Remove border radius from hero section */
            .achievement-badge {
                border-radius: 0 !important;
            }

            .pricing-card { background: #fff; border-radius: 0; padding: 30px 20px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08); position: relative; overflow: hidden; transition: all 0.3s ease; }
            .pricing-card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15); }
            .pricing-card.featured { border: 2px solid #0d6efd; transform: scale(1.05); z-index: 2; }
            .icon-box { width: 70px; height: 70px; margin: 0 auto; border-radius: 0; background: #e9f2ff; display: flex; align-items: center; justify-content: center; font-size: 32px; color: #0d6efd; transition: all 0.3s ease; }
            .pricing-card:hover .icon-box { background: #0d6efd; color: #fff; }
            .price-tag { font-size: 1.5rem; font-weight: 700; margin: 15px 0; color: #333; position: relative; display: inline-block; padding: 5px 15px; border-radius: 0; background: #f8f9fa; }
            .price-tag.highlight { background: #0d6efd; color: #fff; }
            .price-tag .currency { font-size: 1rem; }
            .pricing-card ul li { margin: 8px 0; font-size: 0.95rem; }
            .hover-shadow { transition: all 0.3s ease-in-out; }
            .hover-shadow:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); }
            .card { border-radius: 0 !important; }
            .btn { border-radius: 0 !important; }
        </style>
    @endpush
@endsection