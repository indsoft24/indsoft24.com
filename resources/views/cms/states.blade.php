@extends('layouts.app')

@section('title', $metaTitle)

@section('meta')
<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="business directory, state-wise business, local businesses, e-commerce stores, {{ $states->pluck('name')->implode(', ') }}">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
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
                    <li class="breadcrumb-item active" aria-current="page">Business Directory</li>
                </ol>
            </nav>

            <div class="page-header mb-5">
                <h1 class="display-4 fw-bold text-primary mb-3">Browse Businesses by State</h1>
                <p class="lead fs-4 text-muted mb-4">Discover local businesses, e-commerce stores, and services across {{ $states->count() }} states in India</p>
                
                <!-- E-commerce Information Banner -->
                <div class="alert alert-info border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="mb-2"><i class="fas fa-store me-2"></i>Ready to Start Your Online Store?</h5>
                            <p class="mb-0">We help businesses across all industries set up professional e-commerce stores. From pharmaceuticals to textiles, hardware to software, real estate to florists - we've got you covered!</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('e-commerce') }}" class="btn btn-light btn-lg">
                                <i class="fas fa-rocket me-2"></i>Start Your Store
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Navigation -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3"><i class="fas fa-sitemap me-2"></i>Quick Navigation</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <a href="{{ route('cms.search') }}" class="btn btn-outline-primary w-100">
                                        <i class="fas fa-search me-2"></i>Search All Businesses
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100">
                                        <i class="fas fa-home me-2"></i>Back to Home
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($states->count() > 0)
                <div class="row">
                    @foreach($states as $state)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary rounded-circle p-3 me-3">
                                            <i class="fas fa-map-marked-alt text-white"></i>
                                        </div>
                                        <div>
                                            <h5 class="card-title mb-1">
                                                <a href="{{ route('cms.state.pages', $state) }}" class="text-decoration-none text-dark">
                                                    {{ $state->name }}
                                                </a>
                                            </h5>
                                            <small class="text-muted">Business Directory</small>
                                        </div>
                                    </div>
                                    
                                    <p class="card-text text-muted mb-3">
                                        Discover local businesses, e-commerce stores, and services in {{ $state->name }}. 
                                        From traditional shops to modern online stores, find everything you need.
                                    </p>
                                    
                                    <div class="row text-center mb-3">
                                        <div class="col-6">
                                            <div class="border-end">
                                                <h6 class="text-primary mb-1">{{ $state->published_pages_count }}</h6>
                                                <small class="text-muted">Businesses</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-success mb-1">{{ $state->cities()->count() }}</h6>
                                            <small class="text-muted">Cities</small>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('cms.state.pages', $state) }}" class="btn btn-primary">
                                            <i class="fas fa-building me-2"></i>View Businesses
                                        </a>
                                        <a href="{{ route('cms.state.cities', $state) }}" class="btn btn-outline-primary">
                                            <i class="fas fa-city me-2"></i>Browse Cities
                                        </a>
                                    </div>
                                </div>
                                <div class="card-footer bg-light border-0">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        E-commerce solutions available for all business types
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-map-marked-alt fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No states found</h5>
                    <p class="text-muted">Please add some states to get started.</p>
                </div>
            @endif
            
            <!-- Lead Form Section -->
            <div class="row mt-5">
                <div class="col-md-6 offset-md-3">
                    @include('components.lead-form')
                </div>
            </div>
            
            <!-- E-commerce Information Section -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                        <div class="card-body p-5">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <h2 class="display-6 fw-bold text-dark mb-3">
                                        <i class="fas fa-store text-primary me-3"></i>
                                        Ready to Launch Your E-commerce Store?
                                    </h2>
                                    <p class="lead text-muted mb-4">
                                        Join thousands of successful businesses across India who have transformed their operations with our comprehensive e-commerce solutions. 
                                        From small local shops to large enterprises, we provide tailored solutions for every industry.
                                    </p>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="text-primary mb-3">Industry Solutions</h5>
                                            <ul class="list-unstyled">
                                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Pharmaceutical & Healthcare</li>
                                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Textiles & Fashion</li>
                                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Hardware & Electronics</li>
                                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Software & IT Services</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="text-primary mb-3">More Categories</h5>
                                            <ul class="list-unstyled">
                                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Real Estate & Property</li>
                                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Florists & Gift Shops</li>
                                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Food & Beverages</li>
                                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Automotive & Spares</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-center">
                                    <div class="bg-white rounded-3 p-4 shadow-sm">
                                        <h4 class="text-primary mb-3">Get Started Today</h4>
                                        <p class="text-muted mb-4">Transform your business with our proven e-commerce platform</p>
                                        <a href="{{ route('e-commerce') }}" class="btn btn-primary btn-lg w-100 mb-3">
                                            <i class="fas fa-rocket me-2"></i>Start Your Store
                                        </a>
                                        <a href="{{ route('contact.store') }}" class="btn btn-outline-primary w-100">
                                            <i class="fas fa-phone me-2"></i>Contact Us
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.blog-section')
@include('components.blog-cta-section')
@endsection
