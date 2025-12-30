@extends('layouts.app')

@section('title', $metaTitle)

@section('meta')
<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="website development {{ $state->name }}, app development {{ $state->name }}, digital marketing {{ $state->name }}, SEO services {{ $state->name }}, social media marketing {{ $state->name }}, web developers {{ $state->name }}, e-commerce development {{ $state->name }}, businesses in {{ $state->name }}, local businesses {{ $state->name }}">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Digital Growth & IT Services in {{ $state->name }}",
  "description": "Professional website development, mobile app development, and digital marketing services in {{ $state->name }}",
  "address": {
    "@type": "PostalAddress",
    "addressRegion": "{{ $state->name }}",
    "addressCountry": "IN"
  },
  "areaServed": {
    "@type": "State",
    "name": "{{ $state->name }}"
  },
  "service": [
    {
      "@type": "Service",
      "serviceType": "Website Development",
      "areaServed": "{{ $state->name }}"
    },
    {
      "@type": "Service",
      "serviceType": "Mobile App Development",
      "areaServed": "{{ $state->name }}"
    },
    {
      "@type": "Service",
      "serviceType": "Digital Marketing",
      "areaServed": "{{ $state->name }}"
    }
  ]
}
</script>
@endsection

@section('content')
<div class="container" style="margin-top: 80px;">
    <div class="row">
        <div class="col-md-8">
            @push('styles')
            <style>
                .state-pages-header {
                    background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
                    color: white;
                    padding: 3rem 2rem;
                    border-radius: 15px;
                    margin-bottom: 2rem;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
                }
                .state-pages-header h1 {
                    font-size: 2.5rem;
                    font-weight: 700;
                    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
                }
                .state-pages-header .lead {
                    font-size: 1.25rem;
                    opacity: 0.95;
                }
                @media (max-width: 768px) {
                    .state-pages-header {
                        padding: 2rem 1.5rem;
                    }
                    .state-pages-header h1 {
                        font-size: 1.75rem;
                    }
                }
            </style>
            @endpush
            <div class="state-pages-header">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb bg-white bg-opacity-25 rounded px-3 py-2 d-inline-block">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cms.states') }}" class="text-white text-decoration-none">States</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ $state->name }}</li>
                    </ol>
                </nav>
                
                <h1 class="display-4 fw-bold text-primary mb-3">Digital Growth & IT Services in {{ $state->name }} – Website, App & Digital Marketing Solutions</h1>
                <p class="lead fs-4 text-muted mb-4">
                    Grow Your Business Digitally in {{ $state->name }}
                </p>
                
                <!-- E-commerce Banner -->
                <div class="alert border-0 shadow-sm mb-0" style="background: rgba(255,255,255,0.95); color: #2c3e50;">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="mb-2 fw-bold"><i class="fas fa-store me-2 text-primary"></i>Start Your Online Store in {{ $state->name }}</h5>
                            <p class="mb-0">Join successful businesses in {{ $state->name }} with our comprehensive e-commerce solutions. Perfect for all industries!</p>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <a href="{{ route('e-commerce') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-rocket me-2"></i>Launch Store
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO-Optimized Content Section -->
            <article class="seo-content-section mb-5">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <p class="lead mb-4">
                            {{ $state->name }} is one of India's most promising states for business growth, startups, MSMEs, and local enterprises. With increasing internet penetration, smartphone usage, and digital adoption across cities and towns like {{ $majorCitiesString }}, businesses in {{ $state->name }} are rapidly shifting online.
                        </p>
                        <p class="mb-4">
                            Whether you are a small business owner, startup founder, shop owner, service provider, manufacturer, or professional, having a strong digital presence is no longer optional — it's essential.
                        </p>
                        <div class="alert alert-info border-0 mb-4" style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);">
                            <p class="mb-0 fw-semibold">
                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                Aaj ke digital zamane mein, agar aapka business online nahi hai, toh aap apne customers ka ek bada hissa miss kar rahe ho.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- About State Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-info-circle me-2"></i>About {{ $state->name }} – Business & Digital Opportunity
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-4">
                                {{ $state->name }} is known for its rich culture, skilled workforce, and growing economy. The state offers immense opportunities across industries like:
                            </p>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Retail & Wholesale</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Real Estate & Infrastructure</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Education & Coaching Institutes</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Healthcare & Clinics</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Manufacturing & MSMEs</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Startups & IT Services</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Tourism & Hospitality</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Local Services & Professionals</li>
                                    </ul>
                                </div>
                            </div>
                            <p class="mb-0">
                                With cities such as <strong>{{ $majorCitiesString }}</strong>, businesses are now actively searching for:
                            </p>
                            <ul class="list-inline mt-3">
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">Website developers in {{ $state->name }}</span></li>
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">App developers near me</span></li>
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">Digital marketing agency in {{ $state->name }}</span></li>
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">Social media marketing services</span></li>
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">Meta & Google Ads experts</span></li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Website Development Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-globe me-2"></i>Professional Website Development Services in {{ $state->name }}
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-4">
                                A professional website is your online office, showroom, and sales executive — all in one.
                            </p>
                            <h3 class="h5 fw-bold mb-3">We Offer:</h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Business Website Development</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Corporate & Portfolio Websites</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>E-commerce Website Development</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Custom CMS Websites (Dynamic & Scalable)</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>SEO-Friendly Website Design</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Fast, Secure & Mobile-Responsive Websites</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-light border-start border-primary border-4 mt-4 mb-0">
                                <p class="mb-0">
                                    <i class="fas fa-lightbulb text-primary me-2"></i>
                                    <strong>Chahe aap {{ $capitalCity }} mein ho ya kisi chhote shehar mein, hum aapke business ke liye website banate hain jo customers convert kare.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Mobile App Development Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-mobile-alt me-2"></i>Mobile App Development – Android & iOS in {{ $state->name }}
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-4">
                                Mobile apps help businesses connect directly with customers.
                            </p>
                            <h3 class="h5 fw-bold mb-3">Our App Development Services:</h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Android App Development</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>iOS App Development</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Hybrid Apps (React Native / Flutter)</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Business & Startup Apps</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>E-commerce & Booking Apps</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Custom App Solutions</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-light border-start border-success border-4 mt-4 mb-0">
                                <p class="mb-0">
                                    <i class="fas fa-mobile-alt text-success me-2"></i>
                                    <strong>App ho ya website, hum sirf design nahi — business growth ke liye solution dete hain.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Digital Marketing Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-chart-line me-2"></i>Digital Marketing Services in {{ $state->name }} (Local + National Reach)
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-4">
                                If you want leads, sales, brand visibility, digital marketing is the key.
                            </p>
                            <h3 class="h5 fw-bold mb-3">Our Digital Marketing Solutions:</h3>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Search Engine Optimization (SEO)</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Local SEO for {{ $state->name }} cities</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Google Ads (Search, Display, YouTube)</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Meta Ads (Facebook & Instagram)</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Social Media Marketing & Management</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Content Marketing & Blogging</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Online Reputation Management (ORM)</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-light border-start border-info border-4 mb-0">
                                <p class="mb-0">
                                    <i class="fas fa-bullseye text-info me-2"></i>
                                    <strong>Hum sirf traffic nahi laate, hum right audience ko target karte hain jo aapka customer ban sake.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Social Media Marketing Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fab fa-facebook me-2"></i>Social Media Marketing & Creative Branding
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-4">
                                Social media is where your customers spend most of their time.
                            </p>
                            <h3 class="h5 fw-bold mb-3">We Help You With:</h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Instagram & Facebook Page Management</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Creative Post & Reel Design</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Local Language Content (Hindi / Regional)</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Festival & Campaign Creatives</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Brand Identity & Visual Design</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Lead Generation Campaigns</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-light border-start border-warning border-4 mt-4 mb-0">
                                <p class="mb-0">
                                    <i class="fas fa-comments text-warning me-2"></i>
                                    <strong>Local language mein baat karna customers ko zyada connect karta hai — isi liye hum Hinglish aur regional tone use karte hain.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Meta Ads Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fab fa-facebook-square me-2"></i>Meta Ads & Performance Marketing in {{ $state->name }}
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-4">
                                Want fast results? Paid ads are the best solution.
                            </p>
                            <h3 class="h5 fw-bold mb-3">Our Paid Marketing Services:</h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Facebook & Instagram Ads</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Lead Generation Ads</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>WhatsApp Integrated Campaigns</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>E-commerce Sales Ads</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Location-Based Targeting in {{ $state->name }}</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>ROI-Focused Campaign Optimization</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-light border-start border-danger border-4 mt-4 mb-0">
                                <p class="mb-0">
                                    <i class="fas fa-chart-line text-danger me-2"></i>
                                    <strong>Hum ads sirf chalate nahi, daily monitor aur optimize karte hain taaki aapka paisa waste na ho.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Why Choose Us Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-star me-2"></i>Why Businesses in {{ $state->name }} Choose Us
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Local Market Understanding</strong></li>
                                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Business-First Approach</strong></li>
                                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Affordable & Transparent Pricing</strong></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Dedicated Support Team</strong></li>
                                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Experience Across Multiple Industries</strong></li>
                                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Scalable Solutions for Future Growth</strong></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-success border-0 mt-4 mb-0" style="background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
                                <p class="mb-0">
                                    <i class="fas fa-handshake text-success me-2"></i>
                                    <strong>Hum aapko sirf client nahi, long-term digital partner maante hain.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Who Should Contact Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-user-check me-2"></i>Who Should Contact Us?
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-3">You should contact us if you are:</p>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-arrow-right text-primary me-2"></i>Planning to create a new website</li>
                                        <li class="mb-2"><i class="fas fa-arrow-right text-primary me-2"></i>Redesigning your existing website</li>
                                        <li class="mb-2"><i class="fas fa-arrow-right text-primary me-2"></i>Launching a new startup or brand</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-arrow-right text-primary me-2"></i>Looking for app development</li>
                                        <li class="mb-2"><i class="fas fa-arrow-right text-primary me-2"></i>Want more leads & sales online</li>
                                        <li class="mb-2"><i class="fas fa-arrow-right text-primary me-2"></i>Searching for a reliable digital marketing agency in {{ $state->name }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Cities Served Section -->
                @if($majorCities->count() > 0)
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-map-marker-alt me-2"></i>Serving All Major Cities of {{ $state->name }}
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-3">We provide services across:</p>
                            <div class="row g-2">
                                @foreach($majorCitiesList as $cityName)
                                <div class="col-md-4 col-sm-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-pin text-primary me-2"></i>
                                        <span>{{ $cityName }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <p class="mt-3 mb-0">
                                <i class="fas fa-info-circle text-info me-2"></i>
                                Even if you are in a small town or rural area, our digital solutions work seamlessly across India.
                            </p>
                        </div>
                    </div>
                </section>
                @endif

                <!-- CTA Section -->
                <section class="mb-5">
                    <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="card-body p-5 text-white text-center">
                            <h2 class="h3 fw-bold mb-4 text-white">Get Started with Digital Growth in {{ $state->name }}</h2>
                            <div class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-phone fa-2x mb-2"></i>
                                        <span>Talk to our experts</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-globe fa-2x mb-2"></i>
                                        <span>Build your online presence</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-users fa-2x mb-2"></i>
                                        <span>Reach more customers</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-rocket fa-2x mb-2"></i>
                                        <span>Grow your business digitally</span>
                                    </div>
                                </div>
                            </div>
                            <p class="lead mb-4">
                                📞 Talk to our experts today and get a free consultation for your business.
                            </p>
                            <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5">
                                <i class="fas fa-paper-plane me-2"></i>Get Free Consultation
                            </a>
                        </div>
                    </div>
                </section>
            </article>

            <!-- Navigation Links Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3"><i class="fas fa-sitemap me-2"></i>Explore {{ $state->name }}</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <a href="{{ route('cms.state.cities', $state) }}" class="btn btn-outline-primary w-100">
                                        <i class="fas fa-city me-2"></i>Browse Cities in {{ $state->name }}
                                        <span class="badge bg-primary ms-2">{{ $state->cities()->count() }}</span>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('cms.states') }}" class="btn btn-outline-secondary w-100">
                                        <i class="fas fa-map-marked-alt me-2"></i>All States
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($pages->count() > 0)
                <div class="row">
                    @foreach($pages as $page)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm border-0" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                @if($page->featured_image)
                                <img src="{{ asset($page->featured_image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $page->title }} in {{ $state->name }}"
                                     style="height: 250px; object-fit: cover;">
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0 fw-bold">
                                            <a href="{{ route('cms.page', $page) }}" class="text-decoration-none text-dark">
                                                {{ $page->title }}
                                            </a>
                                        </h5>
                                        @if($page->is_featured)
                                            <span class="badge bg-warning text-dark">Featured</span>
                                        @endif
                                    </div>
                                    
                                    <p class="card-text text-muted mb-3 flex-grow-1" style="font-size: 0.95rem; line-height: 1.6;">
                                        {{ $page->excerpt ?: Str::limit(strip_tags($page->content), 150) }}
                                    </p>
                                    
                                    <div class="row text-center mb-3 g-2">
                                        <div class="col-6">
                                            <div class="border-end pe-2">
                                                <h6 class="text-primary mb-1 fw-bold">{{ number_format($page->views_count) }}</h6>
                                                <small class="text-muted">Views</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-success mb-1 fw-bold">{{ ucfirst($page->page_type) }}</h6>
                                            <small class="text-muted">Type</small>
                                        </div>
                                    </div>
                                    
                                    <div class="card-text mb-3">
                                        <small class="text-muted">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            @if($page->area)
                                                {{ $page->area->name }}, 
                                            @endif
                                            @if($page->city)
                                                {{ $page->city->city_name }}
                                            @endif
                                        </small>
                                    </div>
                                    
                                    <div class="d-grid">
                                        <a href="{{ route('cms.page', $page) }}" class="btn btn-primary">
                                            <i class="fas fa-eye me-2"></i>View Details
                                        </a>
                                    </div>
                                </div>
                                <div class="card-footer bg-light border-0">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $page->published_at->format('F d, Y') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center">
                    {{ $pages->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-map-marked-alt fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No pages found for {{ $state->name }}</h5>
                    <p class="text-muted">Check back later for new content.</p>
                </div>
            @endif
        </div>
        
        <!-- Lead Form Sidebar -->
        <div class="col-md-4">
            @include('components.lead-form')
        </div>
    </div>
</div>

@include('components.blog-section')
@include('components.blog-cta-section')
@endsection
