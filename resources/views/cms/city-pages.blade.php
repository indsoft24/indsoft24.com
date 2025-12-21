@extends('layouts.app')

@section('title', $metaTitle)

@section('meta')
<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="website developer in {{ $city->city_name }}, digital marketing company in {{ $city->city_name }}, app development company in {{ $city->city_name }}, SEO services in {{ $city->city_name }}, social media marketing in {{ $city->city_name }}, website design services in {{ $primaryArea }}, IT company in {{ $city->city_name }}, {{ $city->city_name }} {{ $city->state->name }}">
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
  "name": "Website Development & Digital Marketing Services in {{ $city->city_name }}",
  "description": "Professional website development, mobile app development, and digital marketing services in {{ $city->city_name }}, {{ $city->state->name }}",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "{{ $city->city_name }}",
    "addressRegion": "{{ $city->state->name }}",
    "addressCountry": "IN"
  },
  "areaServed": {
    "@type": "City",
    "name": "{{ $city->city_name }}"
  }
}
</script>
@endsection

@section('content')
<div class="container" style="margin-top: 80px;">
    <div class="row">
        <div class="col-md-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('cms.states') }}" class="text-decoration-none">States</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cms.state.pages', $city->state) }}" class="text-decoration-none">{{ $city->state->name }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cms.state.cities', $city->state) }}" class="text-decoration-none">Cities</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $city->city_name }}</li>
                </ol>
            </nav>

            @push('styles')
            <style>
                .city-pages-header {
                    background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
                    color: white;
                    padding: 3rem 2rem;
                    border-radius: 15px;
                    margin-bottom: 2rem;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
                }
                .city-pages-header h1 {
                    font-size: 2.5rem;
                    font-weight: 700;
                    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
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
                @media (max-width: 768px) {
                    .city-pages-header {
                        padding: 2rem 1.5rem;
                    }
                    .city-pages-header h1 {
                        font-size: 1.75rem;
                    }
                    .content-section {
                        padding: 1.5rem;
                    }
                }
            </style>
            @endpush
            <div class="city-pages-header">
                <h1>{{ $city->city_name }}, {{ $city->state->name }}</h1>
                <p class="lead mb-0">Discover Local Businesses and E-commerce Opportunities in {{ $city->city_name }}</p>
            </div>

            <!-- Content Section -->
            <div class="content-section">
                <h2>About {{ $city->city_name }}</h2>
                <p style="font-size: 1.1rem; line-height: 1.9; color: #4a5568;">
                    Welcome to {{ $city->city_name }}, a vibrant city located in {{ $city->state->name }}. 
                    This dynamic urban center is home to a diverse range of businesses, from traditional establishments 
                    to modern e-commerce platforms. {{ $city->city_name }} offers excellent opportunities for both 
                    entrepreneurs and established businesses looking to expand their reach.
                </p>
                <p style="font-size: 1.1rem; line-height: 1.9; color: #4a5568;">
                    The business ecosystem in {{ $city->city_name }} is characterized by innovation, growth, and 
                    a strong commitment to customer service. Local businesses here benefit from strategic location 
                    advantages, excellent connectivity, and a supportive community that values quality products and services.
                </p>
            </div>

            <div class="content-section">
                <h2>SEO Keywords That Convert in {{ $city->city_name }}</h2>
                <p class="text-muted mb-4">
                    Include the keyword ideas below on your landing pages, meta descriptions, and FAQs to capture decision makers inside {{ $city->city_name }} and the wider {{ $city->state->name }} region.
                </p>
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>Best web development company in {{ $city->city_name }}</li>
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>Mobile app development agency {{ $city->city_name }}</li>
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>Professional SEO services in {{ $city->city_name }}</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>Responsive web design services {{ $city->city_name }}</li>
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>Custom software development company {{ $city->state->name }}</li>
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>E-commerce website development company {{ $city->city_name }}</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>Education website development {{ $city->state->name }}</li>
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>School/College management software {{ $city->city_name }}</li>
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>Hire dedicated developers {{ $city->state->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- SEO-Optimized Content Section -->
            <article class="seo-content-section mb-5">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <p class="lead mb-4">
                            {{ $city->city_name }} is rapidly growing as a business and commercial hub in {{ $city->state->name }}. From local shops and service providers to startups and established companies, businesses in areas like {{ $topAreasString }} are actively investing in websites, mobile apps, and digital marketing to reach more customers.
                        </p>
                        <div class="alert alert-info border-0 mb-4" style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);">
                            <p class="mb-0 fw-semibold">
                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                Agar aap {{ $city->city_name }} mein business kar rahe ho aur customers Google ya social media par aapko nahi mil rahe, toh aap digital growth miss kar rahe ho.
                            </p>
                        </div>
                        <p class="mb-0">
                            We help businesses in {{ $city->city_name }} build a strong online presence that generates leads, sales, and brand trust.
                        </p>
                    </div>
                </div>

                <!-- About City Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-info-circle me-2"></i>About {{ $city->city_name }} – Digital & Business Opportunity
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-4">
                                {{ $city->city_name }} is known for its strategic location, expanding infrastructure, and increasing internet usage. People in {{ $city->city_name }} commonly search online for:
                            </p>
                            <ul class="list-inline mb-4">
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">Website developer in {{ $city->city_name }}</span></li>
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">App development company near me</span></li>
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">Digital marketing agency in {{ $city->city_name }}</span></li>
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">SEO services in {{ $city->city_name }}</span></li>
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">Social media marketing company in {{ $primaryArea }}</span></li>
                                <li class="list-inline-item mb-2"><span class="badge bg-primary">Facebook & Instagram ads expert in {{ $city->city_name }}</span></li>
                            </ul>
                            <p class="mb-0">
                                This makes {{ $city->city_name }} a high-potential market for digital transformation.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Website Development Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-globe me-2"></i>Professional Website Development Company in {{ $city->city_name }}
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-4">
                                Your website is your first impression. We create websites that are fast, secure, mobile-friendly, and SEO-optimized.
                            </p>
                            <h3 class="h5 fw-bold mb-3">Website Development Services in {{ $city->city_name }}:</h3>
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
                                    <strong>Chahe aap {{ $primaryArea }} ya {{ $nearbyArea }} mein ho, hum aapke business ke liye professional website banate hain jo Google par rank kare.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Mobile App Development Section -->
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-mobile-alt me-2"></i>Mobile App Development Services in {{ $city->city_name }} (Android & iOS)
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
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Android App Development in {{ $city->city_name }}</li>
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
                        <i class="fas fa-chart-line me-2"></i>Digital Marketing Services in {{ $city->city_name }} – Get More Leads & Sales
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-4">
                                We offer result-oriented digital marketing services for businesses in {{ $city->city_name }}.
                            </p>
                            <h3 class="h5 fw-bold mb-3">Our Digital Marketing Solutions:</h3>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Search Engine Optimization (SEO) in {{ $city->city_name }}</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Local SEO for {{ $primaryArea }} & Nearby Locations</li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Google Ads Services in {{ $city->city_name }}</li>
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
                        <i class="fab fa-facebook me-2"></i>Social Media Marketing & Creative Services in {{ $primaryArea }}, {{ $city->city_name }}
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
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Instagram Marketing in {{ $city->city_name }}</li>
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
                        <i class="fab fa-facebook-square me-2"></i>Meta Ads & Performance Marketing in {{ $city->city_name }}
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
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Location-Based Ads in {{ $city->city_name }} & {{ $primaryArea }}</li>
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
                        <i class="fas fa-star me-2"></i>Why Choose Us for Digital Services in {{ $city->city_name }}?
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Experienced Website & App Developers</strong></li>
                                        <li class="mb-3"><i class="fas fa-check-circle text-primary me-2"></i><strong>Local Market Knowledge of {{ $city->city_name }}</strong></li>
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
                        <i class="fas fa-industry me-2"></i>Industries We Serve in {{ $city->city_name }}
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

                <!-- Areas We Serve Section -->
                @if($topAreasList && count($topAreasList) > 0)
                <section class="mb-5">
                    <h2 class="h3 fw-bold text-primary mb-4">
                        <i class="fas fa-map-marker-alt me-2"></i>Areas We Serve in {{ $city->city_name }}
                    </h2>
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <p class="mb-3">We actively provide services in:</p>
                            <div class="row g-2">
                                @foreach($topAreasList as $areaName)
                                <div class="col-md-4 col-sm-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-pin text-primary me-2"></i>
                                        <span>{{ $areaName }}</span>
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
                            <h2 class="h3 fw-bold mb-4 text-white">Looking for a Website Developer or Digital Marketing Agency in {{ $city->city_name }}?</h2>
                            <p class="lead mb-4">
                                If you are searching for:
                            </p>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <ul class="list-unstyled text-start">
                                        <li class="mb-2"><i class="fas fa-check-circle me-2"></i>Website developer near {{ $primaryArea }}</li>
                                        <li class="mb-2"><i class="fas fa-check-circle me-2"></i>App developer in {{ $city->city_name }}</li>
                                        <li class="mb-2"><i class="fas fa-check-circle me-2"></i>SEO company in {{ $city->city_name }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled text-start">
                                        <li class="mb-2"><i class="fas fa-check-circle me-2"></i>Digital marketing agency near me</li>
                                        <li class="mb-2"><i class="fas fa-check-circle me-2"></i>Social media marketing services in {{ $city->city_name }}</li>
                                    </ul>
                                </div>
                            </div>
                            <p class="lead mb-4">
                                📞 Get in touch with us today for a free consultation.
                            </p>
                            <a href="{{ route('contact.store') }}" class="btn btn-light btn-lg px-5">
                                <i class="fas fa-paper-plane me-2"></i>Get Free Consultation
                            </a>
                        </div>
                    </div>
                </section>
            </article>

            <!-- Navigation Links Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fas fa-sitemap me-2"></i>Explore {{ $city->city_name }}</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="{{ route('cms.city.areas', $city) }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-map-pin me-2"></i>Browse Areas
                                <span class="badge bg-primary ms-2">{{ $city->activeAreas()->count() }}</span>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('cms.state.cities', $city->state) }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-city me-2"></i>All Cities in {{ $city->state->name }}
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('cms.state.pages', $city->state) }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-building me-2"></i>State Businesses
                            </a>
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
                                     alt="{{ $page->title }} in {{ $city->city_name }}"
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
                                    <p class="card-text text-muted flex-grow-1" style="font-size: 0.95rem; line-height: 1.6;">
                                        {{ $page->excerpt ?: Str::limit(strip_tags($page->content), 120) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <small class="text-muted">
                                            @if($page->area)
                                                <i class="fas fa-map-marker-alt me-1"></i>{{ $page->area->name }}
                                            @endif
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-eye me-1"></i>{{ number_format($page->views_count) }}
                                        </small>
                                    </div>
                                    <a href="{{ route('cms.page', $page->slug) }}" class="btn btn-primary w-100">
                                        <i class="fas fa-arrow-right me-2"></i>Read More
                                    </a>
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
                    <i class="fas fa-city fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No pages found for {{ $city->name }}</h5>
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
