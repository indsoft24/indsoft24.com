@extends('layouts.app')

@section('title', $metaTitle)

@section('meta')
<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="businesses in {{ $state->name }}, local businesses {{ $state->name }}, e-commerce stores {{ $state->name }}, {{ $state->name }} directory">
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
                
                <h1 class="mb-3">Businesses in {{ $state->name }}</h1>
                <p class="lead mb-4">
                    Discover {{ $pages->total() }} businesses, e-commerce stores, and services in {{ $state->name }}. 
                    From local shops to online stores, find everything you need.
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

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h2 class="h4 fw-bold mb-3">Location-Focused Keywords for {{ $state->name }}</h2>
                    <p class="text-muted">
                        Use these terms on landing pages and metadata to rank for buyers searching within {{ $state->name }} and the wider Delhi NCR belt.
                    </p>
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i>Web development agency in {{ $state->name }}</li>
                                <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i>Responsive web design services {{ $state->name }}</li>
                                <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i>PHP web development company {{ $state->name }}</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i>Custom CMS development {{ $state->name }}</li>
                                <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i>Android app developers in {{ $state->name }}</li>
                                <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i>Hire dedicated developers {{ $state->name }}</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i>Custom CRM development services {{ $state->name }}</li>
                                <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i>E-commerce website development company {{ $state->name }}</li>
                                <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i>IT consulting firms in {{ $state->name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

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
@endsection
