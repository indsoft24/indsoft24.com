@extends('layouts.app')

@section('title', $metaTitle)

@section('meta')
<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="{{ $area->name }}, {{ $cityName }}, {{ $stateName }}, business directory, local businesses, e-commerce stores, {{ $area->name }} businesses">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
@push('styles')
<style>
    .cms-page {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        line-height: 1.8;
        color: #2c3e50;
    }
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 3rem 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .page-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
    .page-header .lead {
        font-size: 1.25rem;
        font-weight: 400;
        opacity: 0.95;
    }
    .content-section {
        background: white;
        padding: 2.5rem;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }
    .content-section h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        border-bottom: 3px solid #667eea;
        padding-bottom: 0.5rem;
    }
    .content-section p {
        font-size: 1.1rem;
        line-height: 1.9;
        color: #4a5568;
        margin-bottom: 1.5rem;
    }
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }
    .card-img-top {
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .card:hover .card-img-top {
        transform: scale(1.05);
    }
    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 1.75rem;
        }
        .page-header {
            padding: 2rem 1.5rem;
        }
        .content-section {
            padding: 1.5rem;
        }
    }
</style>
@endpush
<meta name="keywords" content="website developer in {{ $area->name }}, digital marketing company in {{ $area->name }} {{ $cityName }}, app development company in {{ $area->name }}, SEO services in {{ $area->name }}, social media marketing in {{ $area->name }}, website design services in {{ $area->name }}, IT company in {{ $area->name }}, {{ $area->name }} {{ $cityName }} {{ $stateName }}">
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
  "name": "Website Development & Digital Marketing Services in {{ $area->name }}",
  "description": "Professional website development, mobile app development, and digital marketing services in {{ $area->name }}, {{ $cityName }}, {{ $stateName }}",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "{{ $area->name }}",
    "addressRegion": "{{ $cityName }}, {{ $stateName }}",
    "addressCountry": "IN"
  },
  "areaServed": {
    "@type": "City",
    "name": "{{ $cityName }}"
  }
}
</script>
@endsection

@section('content')
<div class="container cms-page" style="margin-top: 80px;">
    <div class="row">
        <div class="col-lg-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('cms.states') }}" class="text-decoration-none">States</a></li>
                    @if($area->state)
                        <li class="breadcrumb-item"><a href="{{ route('cms.state.pages', $area->state) }}" class="text-decoration-none">{{ $stateName }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cms.state.cities', $area->state) }}" class="text-decoration-none">Cities</a></li>
                    @endif
                    @if($area->city_id && is_object($area->city) && $area->city->id)
                        <li class="breadcrumb-item"><a href="{{ route('cms.city.pages', $area->city_id) }}" class="text-decoration-none">{{ $cityName }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cms.city.areas', $area->city_id) }}" class="text-decoration-none">Areas</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{ $area->name }}</li>
                </ol>
            </nav>

            <div class="page-header mb-4">
                <h1 class="display-5 fw-bold text-primary mb-3">Website Development & Digital Marketing Services in {{ $area->name }}, {{ $cityName }}</h1>
                <p class="lead fs-5 text-muted mb-4">Grow Your Business Online in {{ $area->name }}, {{ $cityName }}</p>
            </div>

            <!-- SEO-Optimized Content Section -->
            <article class="seo-content-section mb-5">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <p class="lead mb-4">
                            {{ $area->name }} is rapidly growing as a business and commercial hub in {{ $cityName }}, {{ $stateName }}. From local shops and service providers to startups and established companies, businesses in {{ $area->name }} are actively investing in websites, mobile apps, and digital marketing to reach more customers.
                        </p>
                        <div class="alert alert-info border-0 mb-4" style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);">
                            <p class="mb-0 fw-semibold">
                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                Agar aap {{ $area->name }} mein business kar rahe ho aur customers Google ya social media par aapko nahi mil rahe, toh aap digital growth miss kar rahe ho.
                            </p>
                        </div>
                        <p class="mb-0">
                            We help businesses in {{ $area->name }}, {{ $cityName }} build a strong online presence that generates leads, sales, and brand trust.
                        </p>
                    </div>
                </div>

                <!-- About Area Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-info-circle me-2"></i>About {{ $area->name }} – Digital & Business Opportunity
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-4">
                                {{ $area->name }} is known for its strategic location, expanding infrastructure, and increasing internet usage. People in {{ $area->name }}, {{ $cityName }} commonly search online for:
                            </p>
                            <ul class="list-inline mb-4">
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">Website developer in {{ $area->name }}</span></li>
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">App development company near me</span></li>
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">Digital marketing agency in {{ $area->name }}</span></li>
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">SEO services in {{ $area->name }}</span></li>
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">Social media marketing company in {{ $area->name }}</span></li>
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">Facebook & Instagram ads expert in {{ $cityName }}</span></li>
                            </ul>
                            <p class="mb-0">
                                This makes {{ $area->name }} a high-potential market for digital transformation.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Website Development Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-globe me-2"></i>Professional Website Development Company in {{ $area->name }}
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-4">
                                Your website is your first impression. We create websites that are fast, secure, mobile-friendly, and SEO-optimized.
                            </p>
                            <h3 class="h5 fw-bold mb-3">Website Development Services in {{ $area->name }}:</h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Business & Company Websites</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Static & Dynamic CMS Websites</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>E-commerce Website Development</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Custom Website Development</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Landing Pages for Lead Generation</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Website Redesign & Optimization</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-light border-start border-primary border-4 mt-4 mb-0">
                                <p class="mb-0">
                                    <i class="fas fa-laptop-code text-primary me-2"></i>
                                    <strong>Chahe aap {{ $area->name }} ya {{ $nearbyAreaName }} mein ho, hum aapke business ke liye professional website banate hain jo Google par rank kare.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Mobile App Development Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-mobile-alt me-2"></i>Mobile App Development Services in {{ $area->name }} (Android & iOS)
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-4">
                                Mobile apps help businesses connect directly with customers and increase repeat sales.
                            </p>
                            <h3 class="h5 fw-bold mb-3">App Development Services:</h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Android App Development in {{ $area->name }}</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>iOS App Development</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Hybrid App Development (React Native / Flutter)</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Business Apps</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Startup & Custom App Solutions</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-light border-start border-success border-4 mt-4 mb-0">
                                <p class="mb-0">
                                    <i class="fas fa-mobile-alt text-success me-2"></i>
                                    <strong>Aapka idea ho ya already running business — hum usko app ke form mein reality banate hain.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Digital Marketing Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-chart-line me-2"></i>Digital Marketing Services in {{ $area->name }} – Get More Leads & Sales
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-4">
                                We offer result-oriented digital marketing services for businesses in {{ $area->name }}, {{ $cityName }}.
                            </p>
                            <h3 class="h5 fw-bold mb-3">Our Digital Marketing Solutions:</h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Search Engine Optimization (SEO) in {{ $area->name }}</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Local SEO for {{ $area->name }} & Nearby Locations</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Google Ads Services in {{ $cityName }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Facebook & Instagram Ads Management</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Social Media Marketing Services</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Content & Blog Marketing</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-light border-start border-info border-4 mt-4 mb-0">
                                <p class="mb-0">
                                    <i class="fas fa-bullseye text-info me-2"></i>
                                    <strong>Hum sirf traffic nahi, local customers laate hain jo aapke business mein interest rakhte hain.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Social Media Marketing Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fab fa-facebook me-2"></i>Social Media Marketing & Creative Services in {{ $area->name }}, {{ $cityName }}
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-4">
                                Social media plays a major role in brand building and customer engagement.
                            </p>
                            <h3 class="h5 fw-bold mb-3">Social Media Services:</h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Instagram Marketing in {{ $cityName }}</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Facebook Page Management</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Creative Post & Reel Design</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Festival & Local Campaign Creatives</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Hinglish & Local Language Content</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-light border-start border-warning border-4 mt-4 mb-0">
                                <p class="mb-0">
                                    <i class="fas fa-comments text-warning me-2"></i>
                                    <strong>Local language mein communication customers ko zyada connect karta hai — isi liye hum Hinglish ka smart use karte hain.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Meta Ads Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fab fa-facebook-square me-2"></i>Meta Ads & Performance Marketing in {{ $area->name }}
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-4">
                                If you want quick results, Meta Ads are the best option.
                            </p>
                            <h3 class="h5 fw-bold mb-3">Meta Ads Services:</h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Facebook Lead Generation Ads</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Instagram Ads for Local Businesses</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>WhatsApp Integrated Ads</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Location-Based Ads in {{ $cityName }} & {{ $area->name }}</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Campaign Tracking & Optimization</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-light border-start border-danger border-4 mt-4 mb-0">
                                <p class="mb-0">
                                    <i class="fas fa-chart-line text-danger me-2"></i>
                                    <strong>Har rupaye ka hisaab — maximum ROI ke saath.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Why Choose Us Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-star me-2"></i>Why Choose Us for Digital Services in {{ $area->name }}?
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Experienced Website & App Developers</strong></li>
                                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Local Market Knowledge of {{ $area->name }}</strong></li>
                                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Affordable Pricing for Small Businesses</strong></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Transparent Work Process</strong></li>
                                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Dedicated Support & Maintenance</strong></li>
                                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Long-Term Digital Growth Strategy</strong></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-success border-0 mt-4 mb-0" style="background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
                                <p class="mb-0">
                                    <i class="fas fa-handshake text-success me-2"></i>
                                    <strong>Hum sirf service provider nahi, aapke digital growth partner hain.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Industries We Serve Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-industry me-2"></i>Industries We Serve in {{ $area->name }}
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Local Shops & Retailers</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Real Estate & Builders</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Doctors & Clinics</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Coaching & Education Institutes</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Restaurants & Cafes</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Startups & IT Companies</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Manufacturers & MSMEs</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Nearby Areas Section -->
                @if($nearbyAreas && $nearbyAreas->count() > 0)
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-map-marker-alt me-2"></i>Nearby Areas We Also Serve
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-3">We also provide services in nearby areas:</p>
                            <div class="row g-2">
                                @foreach($nearbyAreas as $nearbyArea)
                                <div class="col-md-4 col-sm-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-pin text-primary me-2"></i>
                                        <span>{{ $nearbyArea->name }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <p class="mt-3 mb-0">
                                <i class="fas fa-info-circle text-info me-2"></i>
                                Even if your business is located in a nearby area, we support remote & on-site projects.
                            </p>
                        </div>
                    </div>
                </section>
                @endif

                <!-- CTA Section -->
                <section class="mb-5">
                    <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="card-body p-5 text-white text-center">
                            <h2 class="h3 fw-bold mb-4 text-white">Looking for a Website Developer or Digital Marketing Agency in {{ $area->name }}?</h2>
                            <p class="lead mb-4">
                                If you are searching for:
                            </p>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <ul class="list-unstyled text-start">
                                        <li class="mb-2"><i class="fas fa-check-circle me-2"></i>Website developer near {{ $area->name }}</li>
                                        <li class="mb-2"><i class="fas fa-check-circle me-2"></i>App developer in {{ $cityName }}</li>
                                        <li class="mb-2"><i class="fas fa-check-circle me-2"></i>SEO company in {{ $area->name }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled text-start">
                                        <li class="mb-2"><i class="fas fa-check-circle me-2"></i>Digital marketing agency near me</li>
                                        <li class="mb-2"><i class="fas fa-check-circle me-2"></i>Social media marketing services in {{ $cityName }}</li>
                                    </ul>
                                </div>
                            </div>
                            <p class="lead mb-4">
                                📞 Get in touch with us today for a free consultation.
                            </p>
                            <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5">
                                <i class="fas fa-paper-plane me-2"></i>Get Free Consultation
                            </a>
                        </div>
                    </div>
                </section>
            </article>

            <!-- Navigation Links Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4 fw-bold"><i class="fas fa-sitemap me-2 text-primary"></i>Explore {{ $area->name }}</h5>
                    <div class="row g-3">
                        @if($area->city_id)
                            <div class="col-md-4">
                                <a href="{{ route('cms.city.pages', $area->city_id) }}" class="btn btn-outline-primary w-100 py-3">
                                    <i class="fas fa-city me-2"></i>City Businesses
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('cms.city.areas', $area->city_id) }}" class="btn btn-outline-secondary w-100 py-3">
                                    <i class="fas fa-map-pin me-2"></i>All Areas in {{ $cityName }}
                                </a>
                            </div>
                        @endif
                        @if($area->state)
                            <div class="col-md-4">
                                <a href="{{ route('cms.state.pages', $area->state) }}" class="btn btn-outline-info w-100 py-3">
                                    <i class="fas fa-building me-2"></i>State Businesses
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Business Opportunities Section -->
            <div class="content-section">
                <h2>Business Opportunities in {{ $area->name }}</h2>
                <p>
                    {{ $area->name }} presents numerous opportunities for entrepreneurs and established businesses alike. 
                    The area's strategic location within {{ $cityName }} makes it an ideal destination for various business 
                    ventures. Whether you're considering opening a physical store, launching an e-commerce platform, or 
                    expanding your existing business, {{ $area->name }} offers the infrastructure and market potential 
                    to support your growth.
                </p>
                <p>
                    The local economy in {{ $area->name }} is supported by a diverse customer base, including residents, 
                    professionals, and visitors. This diversity creates opportunities for businesses across multiple sectors, 
                    from retail and hospitality to professional services and technology solutions. Many successful businesses 
                    in this area have leveraged both traditional and digital channels to maximize their reach and revenue.
                </p>
            </div>

            <div class="content-section">
                <h2>Popular Searches in {{ $area->name }}, {{ $cityName }}</h2>
                <p class="mb-4">
                    Residents and businesses in {{ $area->name }} often search for specialized technology and marketing partners. 
                    Optimizing your content with the queries below helps you surface for high-intent buyers in {{ $cityName }}, {{ $stateName }}.
                </p>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-search text-primary me-2"></i>Best web development company in {{ $cityName }}</li>
                            <li class="mb-2"><i class="fas fa-search text-primary me-2"></i>Custom software development company {{ $stateName }}</li>
                            <li class="mb-2"><i class="fas fa-search text-primary me-2"></i>Mobile app development agency {{ $cityName }}</li>
                            <li class="mb-2"><i class="fas fa-search text-primary me-2"></i>Affordable website design services {{ $stateName }}</li>
                            <li class="mb-2"><i class="fas fa-search text-primary me-2"></i>Professional SEO services in {{ $cityName }}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-search text-primary me-2"></i>Hire dedicated developers {{ $stateName }}</li>
                            <li class="mb-2"><i class="fas fa-search text-primary me-2"></i>E-commerce website development company {{ $cityName }}</li>
                            <li class="mb-2"><i class="fas fa-search text-primary me-2"></i>Website designers in {{ $area->name }}</li>
                            <li class="mb-2"><i class="fas fa-search text-primary me-2"></i>Software company near {{ $area->name }}</li>
                            <li class="mb-2"><i class="fas fa-search text-primary me-2"></i>Custom CRM development services {{ $stateName }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            @if($pages->count() > 0)
                <div class="content-section">
                    <h2>Featured Businesses in {{ $area->name }}</h2>
                    <p class="mb-4">
                        Discover {{ $pages->total() }} businesses operating in {{ $area->name }}, {{ $cityName }}. 
                        These establishments represent the diverse commercial landscape of the area, offering products and 
                        services that cater to various needs and preferences.
                    </p>
                </div>
                <div class="row">
                    @foreach($pages as $page)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if($page->featured_image)
                                <img src="{{ asset($page->featured_image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $page->title }} in {{ $area->name }}"
                                     style="height: 250px; object-fit: cover;">
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title fw-bold mb-0">
                                            <a href="{{ route('cms.page', $page->slug) }}" class="text-decoration-none text-dark">
                                                {{ $page->title }}
                                            </a>
                                        </h5>
                                        @if($page->is_featured)
                                            <span class="badge bg-warning text-dark">Featured</span>
                                        @endif
                                    </div>
                                    <p class="card-text text-muted flex-grow-1">
                                        {{ $page->excerpt ?: Str::limit(strip_tags($page->content), 120) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <small class="text-muted">
                                            <i class="fas fa-map-marker-alt me-1"></i>{{ $page->location }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-eye me-1"></i>{{ $page->views_count }}
                                        </small>
                                    </div>
                                    <a href="{{ route('cms.page', $page->slug) }}" class="btn btn-primary w-100">
                                        <i class="fas fa-arrow-right me-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $pages->links() }}
                </div>
            @else
                <div class="content-section text-center py-5">
                    <i class="fas fa-map-pin fa-4x text-muted mb-4"></i>
                    <h3 class="fw-bold text-muted mb-3">No Businesses Found Yet</h3>
                    <p class="text-muted mb-4">
                        There are currently no businesses listed in {{ $area->name }}, {{ $cityName }}. 
                        Check back soon as we're constantly updating our directory with new listings.
                    </p>
                    @if($area->city_id)
                        <a href="{{ route('cms.city.pages', $area->city_id) }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>Browse City Businesses
                        </a>
                    @endif
                </div>
            @endif
        </div>
        
        <!-- Lead Form Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px;">
                @include('components.lead-form')
            </div>
        </div>
    </div>
</div>

@include('components.blog-section')
@include('components.blog-cta-section')
@endsection
