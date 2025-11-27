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
                    @if($area->city)
                        <li class="breadcrumb-item"><a href="{{ route('cms.city.pages', $area->city) }}" class="text-decoration-none">{{ $cityName }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cms.city.areas', $area->city) }}" class="text-decoration-none">Areas</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{ $area->name }}</li>
                </ol>
            </nav>

            <!-- Hero Section -->
            <div class="page-header text-center">
                <h1>{{ $area->name }}, {{ $cityName }}</h1>
                <p class="lead mb-0">Discover Local Businesses and E-commerce Opportunities in {{ $area->name }}, {{ $cityName }}, {{ $stateName }}</p>
            </div>

            <!-- Content Section -->
            <div class="content-section">
                <h2>About {{ $area->name }}, {{ $cityName }}</h2>
                <p>
                    Welcome to {{ $area->name }}, a vibrant and thriving locality in {{ $cityName }}, {{ $stateName }}. 
                    This area is known for its dynamic business ecosystem, offering a diverse range of services and products 
                    to both local residents and visitors. Whether you're looking for traditional brick-and-mortar establishments 
                    or modern e-commerce solutions, {{ $area->name }} has something to offer for everyone.
                </p>
                <p>
                    The business landscape in {{ $area->name }} is characterized by a mix of established enterprises and 
                    emerging startups, creating a competitive yet collaborative environment. Local businesses here benefit from 
                    excellent connectivity, strategic location advantages, and a supportive community that values quality 
                    products and exceptional service.
                </p>
                <p>
                    From retail stores and service providers to technology companies and creative agencies, {{ $area->name }} 
                    hosts a wide spectrum of industries. Many businesses in this area have embraced digital transformation, 
                    establishing their online presence through e-commerce platforms to reach customers beyond geographical boundaries.
                </p>
            </div>

            <!-- Navigation Links Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4 fw-bold"><i class="fas fa-sitemap me-2 text-primary"></i>Explore {{ $area->name }}</h5>
                    <div class="row g-3">
                        @if($area->city)
                            <div class="col-md-4">
                                <a href="{{ route('cms.city.pages', $area->city) }}" class="btn btn-outline-primary w-100 py-3">
                                    <i class="fas fa-city me-2"></i>City Businesses
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('cms.city.areas', $area->city) }}" class="btn btn-outline-secondary w-100 py-3">
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
                    <a href="{{ route('cms.city.pages', $area->city) }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>Browse City Businesses
                    </a>
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
@endsection
