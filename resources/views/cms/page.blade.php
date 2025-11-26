@extends('layouts.app')

@section('title', $metaTitle)

@section('meta')
<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="{{ $page->title }}, {{ $page->location }}, business, e-commerce, {{ $page->page_type }}, {{ $page->state->name ?? '' }}, {{ $page->city->city_name ?? '' }}">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:type" content="article">
<meta property="og:url" content="{{ url()->current() }}">
@php
    $pageImage = $page->featured_image 
        ? asset($page->featured_image) 
        : 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=1200&h=600&fit=crop';
    $defaultImage = 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=1200&h=600&fit=crop';
@endphp
<meta property="og:image" content="{{ $pageImage }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta name="twitter:image" content="{{ $pageImage }}">
@push('styles')
<style>
    .page-content {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        line-height: 1.9;
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
    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
    .page-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        font-size: 1rem;
        opacity: 0.95;
    }
    .page-featured-image {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        margin-bottom: 2.5rem;
    }
    .page-featured-image img {
        width: 100%;
        height: 500px;
        object-fit: cover;
    }
    .page-content-body {
        background: white;
        padding: 2.5rem;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        font-size: 1.1rem;
        line-height: 1.9;
    }
    .page-content-body h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-top: 2rem;
        margin-bottom: 1rem;
        border-bottom: 3px solid #667eea;
        padding-bottom: 0.5rem;
    }
    .page-content-body h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }
    .page-content-body p {
        margin-bottom: 1.5rem;
        color: #4a5568;
    }
    .page-content-body ul, .page-content-body ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }
    .page-content-body li {
        margin-bottom: 0.75rem;
        color: #4a5568;
    }
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.75rem;
        }
        .page-header {
            padding: 2rem 1.5rem;
        }
        .page-content-body {
            padding: 1.5rem;
            font-size: 1rem;
        }
        .page-featured-image img {
            height: 300px;
        }
        .page-meta {
            flex-direction: column;
            gap: 0.75rem;
        }
    }
</style>
@endpush
@endsection

@section('content')
<div class="container page-content" style="margin-top: 80px;">
    <div class="row">
        <div class="col-lg-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cms.states') }}" class="text-decoration-none">States</a></li>
                    @if($page->state)
                        <li class="breadcrumb-item"><a href="{{ route('cms.state.pages', $page->state) }}" class="text-decoration-none">{{ $page->state->name }}</a></li>
                    @endif
                    @if($page->city)
                        <li class="breadcrumb-item"><a href="{{ route('cms.city.pages', $page->city) }}" class="text-decoration-none">{{ $page->city->city_name }}</a></li>
                    @endif
                    @if($page->area)
                        <li class="breadcrumb-item"><a href="{{ route('cms.area.pages', $page->area) }}" class="text-decoration-none">{{ $page->area->name }}</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($page->title, 30) }}</li>
                </ol>
            </nav>

            <article>
                <header class="page-header">
                    <h1 class="page-title">{{ $page->title }}</h1>
                    <div class="page-meta">
                        <span>
                            <i class="fas fa-map-marker-alt me-2"></i>{{ $page->location }}
                        </span>
                        <span>
                            <i class="fas fa-eye me-2"></i>{{ number_format($page->views_count) }} views
                        </span>
                        <span>
                            <i class="fas fa-calendar me-2"></i>{{ $page->published_at->format('F d, Y') }}
                        </span>
                        @if($page->is_featured)
                            <span>
                                <i class="fas fa-star me-2"></i>Featured
                            </span>
                        @endif
                    </div>
                </header>

                <div class="page-featured-image">
                    <img src="{{ $pageImage }}" 
                         alt="{{ $page->title }} - {{ $page->location }}"
                         onerror="this.src='{{ $defaultImage }}'">
                </div>

                <div class="page-content-body">
                    {!! $page->content !!}
                    <div class="mt-5 pt-4 border-top">
                        <h2 class="h4 fw-bold mb-3">High-Intent Keywords We Target in {{ $page->location }}</h2>
                        <p class="text-muted">
                            Use these keyword themes throughout your copy to capture prospects who are actively looking for a partner in {{ $page->location }}.
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="fas fa-bullseye text-primary me-2"></i>Top IT services company in {{ $page->state->name ?? 'India' }}</li>
                                    <li class="mb-2"><i class="fas fa-bullseye text-primary me-2"></i>Custom CRM development services</li>
                                    <li class="mb-2"><i class="fas fa-bullseye text-primary me-2"></i>Enterprise software solutions provider</li>
                                    <li class="mb-2"><i class="fas fa-bullseye text-primary me-2"></i>Responsive web design services {{ $page->city->city_name ?? 'India' }}</li>
                                    <li class="mb-2"><i class="fas fa-bullseye text-primary me-2"></i>API integration services {{ $page->state->name ?? 'India' }}</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="fas fa-bullseye text-primary me-2"></i>Mobile app development agency {{ $page->city->city_name ?? 'Noida' }}</li>
                                    <li class="mb-2"><i class="fas fa-bullseye text-primary me-2"></i>Flutter & React Native app developers</li>
                                    <li class="mb-2"><i class="fas fa-bullseye text-primary me-2"></i>Business automation software company</li>
                                    <li class="mb-2"><i class="fas fa-bullseye text-primary me-2"></i>Educational website development India</li>
                                    <li class="mb-2"><i class="fas fa-bullseye text-primary me-2"></i>Hire dedicated developers {{ $page->state->name ?? 'India' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>

        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px;">
                <!-- Location Navigation -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0 fw-bold"><i class="fas fa-map-marked-alt me-2"></i>Location Navigation</h5>
                    </div>
                    <div class="card-body">
                        @if($page->area)
                            <div class="mb-3 pb-3 border-bottom">
                                <strong class="d-block mb-2 text-muted">Area:</strong>
                                <a href="{{ route('cms.area.pages', $page->area) }}" class="text-decoration-none fw-bold">
                                    <i class="fas fa-map-pin me-1 text-primary"></i>{{ $page->area->name }}
                                </a>
                            </div>
                        @endif
                        @if($page->city)
                            <div class="mb-3 pb-3 border-bottom">
                                <strong class="d-block mb-2 text-muted">City:</strong>
                                <a href="{{ route('cms.city.pages', $page->city) }}" class="text-decoration-none fw-bold">
                                    <i class="fas fa-city me-1 text-primary"></i>{{ $page->city->city_name }}
                                </a>
                            </div>
                            @if($page->city && $page->city->activeAreas()->count() > 0)
                                <div class="mb-3">
                                    <a href="{{ route('cms.city.areas', $page->city) }}" class="btn btn-sm btn-outline-primary w-100">
                                        <i class="fas fa-map-pin me-1"></i>Browse Areas in {{ $page->city->city_name }}
                                    </a>
                                </div>
                            @endif
                        @endif
                        @if($page->state)
                            <div class="mb-3 pb-3 border-bottom">
                                <strong class="d-block mb-2 text-muted">State:</strong>
                                <a href="{{ route('cms.state.pages', $page->state) }}" class="text-decoration-none fw-bold">
                                    <i class="fas fa-map-marked-alt me-1 text-primary"></i>{{ $page->state->name }}
                                </a>
                            </div>
                            @if($page->state && $page->state->activeCities()->count() > 0)
                                <div class="mb-3">
                                    <a href="{{ route('cms.state.cities', $page->state) }}" class="btn btn-sm btn-outline-secondary w-100">
                                        <i class="fas fa-city me-1"></i>Browse Cities in {{ $page->state->name }}
                                    </a>
                                </div>
                            @endif
                        @endif
                        <div>
                            <a href="{{ route('cms.states') }}" class="btn btn-sm btn-outline-info w-100">
                                <i class="fas fa-globe me-1"></i>Browse All States
                            </a>
                        </div>
                    </div>
                </div>

                @if($relatedPages->count() > 0)
                    <div class="card mb-4 shadow-sm border-0">
                        <div class="card-header bg-gradient text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <h5 class="card-title mb-0 fw-bold">Related Businesses</h5>
                        </div>
                        <div class="card-body">
                            @foreach($relatedPages as $relatedPage)
                                <div class="related-page-item mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                    <h6 class="related-page-title fw-bold mb-2">
                                        <a href="{{ route('cms.page', $relatedPage->slug) }}" class="text-decoration-none text-dark">
                                            {{ $relatedPage->title }}
                                        </a>
                                    </h6>
                                    <p class="related-page-excerpt text-muted small mb-2">
                                        {{ Str::limit($relatedPage->excerpt ?: strip_tags($relatedPage->content), 100) }}
                                    </p>
                                    <small class="text-muted">
                                        <i class="fas fa-eye me-1"></i>{{ number_format($relatedPage->views_count) }} views
                                    </small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0 fw-bold">Page Information</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><strong class="text-muted">Type:</strong> <span class="badge bg-primary">{{ ucfirst($page->page_type) }}</span></li>
                            <li class="mb-2"><strong class="text-muted">Template:</strong> {{ ucfirst($page->template) }}</li>
                            <li class="mb-2"><strong class="text-muted">Status:</strong> 
                                <span class="badge bg-success">{{ ucfirst($page->status) }}</span>
                            </li>
                            @if($page->is_featured)
                                <li class="mb-0"><strong class="text-muted">Featured:</strong> 
                                    <span class="badge bg-warning text-dark">Yes</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                @include('components.lead-form')
            </div>
        </div>
    </div>
</div>
@endsection
