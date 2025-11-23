@extends('layouts.app')

@section('title', $metaTitle)

@section('meta')
<meta name="description" content="{{ $metaDescription }}">
@endsection

@section('content')
<div class="container" style="margin-top: 80px;">
    <div class="row">
        <div class="col-md-8">
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

            <div class="page-header mb-4">
                <h1>{{ $area->name }}, {{ $cityName }}</h1>
                <p class="lead">Browse pages and content for {{ $area->name }}, {{ $cityName }}, {{ $stateName }}</p>
            </div>

            <!-- Navigation Links Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fas fa-sitemap me-2"></i>Explore {{ $area->name }}</h5>
                    <div class="row g-3">
                        @if($area->city)
                            <div class="col-md-4">
                                <a href="{{ route('cms.city.pages', $area->city) }}" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-city me-2"></i>City Businesses
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('cms.city.areas', $area->city) }}" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-map-pin me-2"></i>All Areas in {{ $cityName }}
                                </a>
                            </div>
                        @endif
                        @if($area->state)
                            <div class="col-md-4">
                                <a href="{{ route('cms.state.pages', $area->state) }}" class="btn btn-outline-info w-100">
                                    <i class="fas fa-building me-2"></i>State Businesses
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if($pages->count() > 0)
                <div class="row">
                    @foreach($pages as $page)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100">
                                @if($page->featured_image)
                                    <img src="{{ asset($page->featured_image) }}" class="card-img-top" alt="{{ $page->title }}" style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('cms.page', $page->slug) }}" class="text-decoration-none">
                                            {{ $page->title }}
                                        </a>
                                    </h5>
                                    <p class="card-text">{{ $page->excerpt }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            {{ $page->location }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-eye"></i> {{ $page->views_count }}
                                        </small>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('cms.page', $page->slug) }}" class="btn btn-primary btn-sm">
                                        Read More
                                    </a>
                                    @if($page->is_featured)
                                        <span class="badge bg-warning text-dark ms-2">Featured</span>
                                    @endif
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
                    <i class="fas fa-map-pin fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No pages found for {{ $area->name }}</h5>
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
