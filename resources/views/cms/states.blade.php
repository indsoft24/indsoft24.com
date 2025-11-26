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

@php
    $heroImage = 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=1200&h=400&fit=crop';
    $defaultImage = 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1200&h=400&fit=crop';
@endphp
@push('styles')
<style>
    .states-page {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        line-height: 1.8;
    }
    .hero-section {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%), url('{{ $heroImage }}');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 4rem 2rem;
        border-radius: 15px;
        margin-bottom: 3rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    .hero-section h1 {
        font-size: 3rem;
        font-weight: 700;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        margin-bottom: 1rem;
    }
    .hero-section .lead {
        font-size: 1.5rem;
        font-weight: 400;
        opacity: 0.95;
    }
    .state-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        height: 100%;
    }
    .state-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }
    .state-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .content-section {
        background: #fff;
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }
    @media (max-width: 768px) {
        .hero-section {
            padding: 2.5rem 1.5rem;
        }
        .hero-section h1 {
            font-size: 2rem;
        }
        .hero-section .lead {
            font-size: 1.1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container states-page" style="margin-top: 80px;">
    <div class="row">
        <div class="col-12">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Business Directory</li>
                </ol>
            </nav>

            <!-- Hero Section -->
            <div class="hero-section text-center">
                <h1>Browse Businesses by State</h1>
                <p class="lead mb-4">Discover local businesses, e-commerce stores, and services across {{ $states->count() }} states in India</p>
                
                <!-- E-commerce Information Banner -->
                <div class="alert border-0 shadow-sm mb-0" style="background: rgba(255,255,255,0.95); color: #2c3e50;">
                    <div class="row align-items-center">
                        <div class="col-md-8 text-start">
                            <h5 class="mb-2 fw-bold"><i class="fas fa-store me-2 text-primary"></i>Ready to Start Your Online Store?</h5>
                            <p class="mb-0">We help businesses across all industries set up professional e-commerce stores. From pharmaceuticals to textiles, hardware to software, real estate to florists - we've got you covered!</p>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <a href="{{ route('e-commerce') }}" class="btn btn-primary btn-lg">
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
                        @php
                            $stateImageUrl = 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=400&h=200&fit=crop&q=80';
                            $stateImageFallback = 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=200&fit=crop&q=80';
                        @endphp
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card state-card shadow-sm">
                                <img src="{{ $stateImageUrl }}" 
                                     class="state-image" 
                                     alt="{{ $state->name }} Business Directory"
                                     onerror="this.src='{{ $stateImageFallback }}'">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-3">
                                        <a href="{{ route('cms.state.pages', $state) }}" class="text-decoration-none text-dark">
                                            {{ $state->name }}
                                        </a>
                                    </h5>
                                    
                                    <p class="card-text text-muted mb-3" style="font-size: 0.95rem; line-height: 1.6;">
                                        Explore {{ $state->published_pages_count }} businesses and e-commerce stores across 
                                        {{ $state->cities()->count() }} cities in {{ $state->name }}. From traditional 
                                        brick-and-mortar establishments to modern digital platforms, discover comprehensive 
                                        business solutions tailored to your needs.
                                    </p>
                                    
                                    <div class="row text-center mb-3 g-2">
                                        <div class="col-6">
                                            <div class="border-end pe-2">
                                                <h6 class="text-primary mb-1 fw-bold">{{ number_format($state->published_pages_count) }}</h6>
                                                <small class="text-muted">Businesses</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-success mb-1 fw-bold">{{ number_format($state->cities()->count()) }}</h6>
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

            <div class="content-section mt-5">
                <h2 class="h3 fw-bold mb-4">High-Intent Commercial Keywords for India</h2>
                <p class="text-muted mb-4">
                    Integrate the following search phrases on your home, service, and location pages to capture buyers who are ready to hire a technology partner.
                </p>
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Best web development company in Noida</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Custom software development company India</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Mobile app development agency Noida</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Top IT services company in Delhi NCR</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Enterprise software solutions provider</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Affordable website design services India</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Professional SEO services in Noida</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Hire dedicated developers India</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Custom CRM development services</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>E-commerce website development company</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Software company near me (Noida Sector 62)</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>IT consulting firms in Noida</li>
                        </ul>
                    </div>
                </div>
            </div>
            
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
