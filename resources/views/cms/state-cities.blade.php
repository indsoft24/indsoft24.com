@extends('layouts.app')

@section('title', $metaTitle)

@section('meta')
<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="{{ $state->name }}, cities, business directory, e-commerce, local businesses, {{ $state->name }} cities">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
@endsection

@section('content')
<div class="container" style="margin-top: 80px;">
    <div class="row">
        <div class="col-12">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cms.states') }}" class="text-decoration-none">States</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cms.state.pages', $state) }}" class="text-decoration-none">{{ $state->name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cities</li>
                </ol>
            </nav>

            <!-- Page Header -->
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold text-primary mb-3">Cities in {{ $state->name }}</h1>
                <p class="lead fs-4 text-muted">Discover businesses and e-commerce opportunities across {{ $cities->count() }} cities in {{ $state->name }}</p>
            </div>

            <!-- Navigation Links Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3"><i class="fas fa-sitemap me-2"></i>Explore {{ $state->name }}</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <a href="{{ route('cms.state.pages', $state) }}" class="btn btn-outline-primary w-100">
                                        <i class="fas fa-building me-2"></i>State Businesses
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('cms.states') }}" class="btn btn-outline-secondary w-100">
                                        <i class="fas fa-map-marked-alt me-2"></i>All States
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('cms.search') }}" class="btn btn-outline-info w-100">
                                        <i class="fas fa-search me-2"></i>Search Businesses
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- E-commerce Banner -->
            <div class="alert alert-info border-0 shadow-sm mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="mb-2"><i class="fas fa-store me-2"></i>Ready to Start Your E-commerce Business?</h5>
                        <p class="mb-0">Join thousands of successful businesses in {{ $state->name }}. Set up your online store in minutes with our comprehensive platform.</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <a href="#" class="btn btn-light btn-lg">
                            <i class="fas fa-rocket me-2"></i>Start Selling Now
                        </a>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-5">
                <div class="card-body p-4">
                    <h2 class="h4 fw-bold mb-3">Local SEO Phrases for {{ $state->name }}</h2>
                    <p class="text-muted mb-3">
                        Rank for local intent searches by weaving these phrases into your copy when you mention {{ $state->name }} or specific cities.
                    </p>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><i class="fas fa-location-dot text-primary me-2"></i>Website designers in {{ $state->name }} Sector 62</li>
                                <li class="mb-2"><i class="fas fa-location-dot text-primary me-2"></i>Software company near me ({{ $state->name }})</li>
                                <li class="mb-2"><i class="fas fa-location-dot text-primary me-2"></i>Web development agency in Delhi NCR</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><i class="fas fa-location-dot text-primary me-2"></i>Android app developers in {{ $state->name }}</li>
                                <li class="mb-2"><i class="fas fa-location-dot text-primary me-2"></i>IT consulting firms in {{ $state->name }}</li>
                                <li class="mb-2"><i class="fas fa-location-dot text-primary me-2"></i>Small business website design Delhi NCR</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><i class="fas fa-location-dot text-primary me-2"></i>Coaching institute website design {{ $state->name }}</li>
                                <li class="mb-2"><i class="fas fa-location-dot text-primary me-2"></i>Educational website development {{ $state->name }}</li>
                                <li class="mb-2"><i class="fas fa-location-dot text-primary me-2"></i>Student information system software {{ $state->name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @if($cities->count() > 0)
                <div class="row">
                    @foreach($cities as $city)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm border-0" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-3 fw-bold">
                                        <a href="{{ route('cms.city.pages', $city) }}" class="text-decoration-none text-dark">
                                            {{ $city->city_name }}
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted mb-3 flex-grow-1" style="font-size: 0.95rem; line-height: 1.6;">
                                        Explore {{ $city->published_pages_count }} businesses in {{ $city->city_name }}, 
                                        {{ $state->name }}. Discover local shops, e-commerce stores, and services 
                                        across various industries and sectors.
                                    </p>
                                    
                                    <div class="row text-center mb-3 g-2">
                                        <div class="col-6">
                                            <div class="border-end pe-2">
                                                <h6 class="text-primary mb-1 fw-bold">{{ number_format($city->published_pages_count) }}</h6>
                                                <small class="text-muted">Businesses</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-success mb-1 fw-bold">Active</h6>
                                            <small class="text-muted">E-commerce Ready</small>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('cms.city.pages', $city) }}" class="btn btn-primary">
                                            <i class="fas fa-store me-2"></i>Explore Businesses
                                        </a>
                                        <a href="{{ route('cms.city.areas', $city) }}" class="btn btn-outline-secondary btn-sm">
                                            <i class="fas fa-map-pin me-2"></i>View Areas
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center">
                    {{ $cities->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-city fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No cities found</h5>
                    <p class="text-muted">There are no cities available in {{ $state->name }}.</p>
                    <a href="{{ route('cms.states') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Back to States
                    </a>
                </div>
            @endif

            <!-- E-commerce Information Section -->
            <div class="mt-5 pt-5 border-top">
                <div class="row">
                    <div class="col-12 text-center mb-4">
                        <h3 class="fw-bold text-primary">E-commerce Solutions for {{ $state->name }}</h3>
                        <p class="lead text-muted">Comprehensive business solutions tailored for every industry</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-pills fa-2x text-primary"></i>
                            </div>
                            <h5 class="fw-bold">Pharmaceutical</h5>
                            <p class="text-muted">Complete pharmacy management and online medicine delivery solutions</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-4">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-tshirt fa-2x text-success"></i>
                            </div>
                            <h5 class="fw-bold">Textile & Fashion</h5>
                            <p class="text-muted">Fashion e-commerce platforms with inventory management and design tools</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-4">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-tools fa-2x text-warning"></i>
                            </div>
                            <h5 class="fw-bold">Hardware & Tools</h5>
                            <p class="text-muted">Industrial equipment and hardware store management systems</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-4">
                            <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-laptop-code fa-2x text-info"></i>
                            </div>
                            <h5 class="fw-bold">Software & IT</h5>
                            <p class="text-muted">Digital solutions, software development, and IT services platforms</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-4">
                            <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-home fa-2x text-danger"></i>
                            </div>
                            <h5 class="fw-bold">Real Estate</h5>
                            <p class="text-muted">Property listing platforms with virtual tours and CRM integration</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-4">
                            <div class="bg-purple bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-seedling fa-2x text-purple"></i>
                            </div>
                            <h5 class="fw-bold">Floral & Gifts</h5>
                            <p class="text-muted">Flower delivery and gift shop management with subscription services</p>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <a href="#" class="btn btn-primary btn-lg">
                        <i class="fas fa-rocket me-2"></i>Start Your E-commerce Journey Today
                    </a>
                </div>
            </div>
            
            <!-- Lead Form Section -->
            <div class="row mt-5">
                <div class="col-md-6 offset-md-3">
                    @include('components.lead-form')
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.blog-section')
@include('components.blog-cta-section')
@endsection
