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
            <div class="page-header mb-5">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cms.states') }}" class="text-decoration-none">States</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $state->name }}</li>
                    </ol>
                </nav>
                
                <h1 class="display-4 fw-bold text-primary mb-3">Businesses in {{ $state->name }}</h1>
                <p class="lead fs-4 text-muted mb-4">
                    Discover {{ $pages->total() }} businesses, e-commerce stores, and services in {{ $state->name }}. 
                    From local shops to online stores, find everything you need.
                </p>
                
                <!-- E-commerce Banner -->
                <div class="alert alert-success border-0 shadow-sm mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="mb-2"><i class="fas fa-store me-2"></i>Start Your Online Store in {{ $state->name }}</h5>
                            <p class="mb-0">Join successful businesses in {{ $state->name }} with our comprehensive e-commerce solutions. Perfect for all industries!</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('e-commerce') }}" class="btn btn-success btn-lg">
                                <i class="fas fa-rocket me-2"></i>Launch Store
                            </a>
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
                            <div class="card h-100 shadow-sm border-0">
                                @if($page->featured_image)
                                    <img src="{{ asset($page->featured_image) }}" class="card-img-top" alt="{{ $page->title }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-gradient d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <i class="fas fa-building text-white" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0">
                                            <a href="{{ route('cms.page', $page) }}" class="text-decoration-none text-dark">
                                                {{ $page->title }}
                                            </a>
                                        </h5>
                                        @if($page->is_featured)
                                            <span class="badge bg-warning text-dark">Featured</span>
                                        @endif
                                    </div>
                                    
                                    <p class="card-text text-muted mb-3">
                                        {{ $page->excerpt ?: Str::limit(strip_tags($page->content), 120) }}
                                    </p>
                                    
                                    <div class="row text-center mb-3">
                                        <div class="col-6">
                                            <div class="border-end">
                                                <h6 class="text-primary mb-1">{{ $page->views_count }}</h6>
                                                <small class="text-muted">Views</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-success mb-1">{{ ucfirst($page->page_type) }}</h6>
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
                                        {{ $page->published_at->format('M d, Y') }}
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
