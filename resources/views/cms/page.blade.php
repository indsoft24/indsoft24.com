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

            <article class="page-content">
                <header class="page-header mb-4">
                    <h1 class="page-title">{{ $page->title }}</h1>
                    <div class="page-meta">
                        <span class="text-muted">
                            <i class="fas fa-map-marker-alt"></i> {{ $page->location }}
                        </span>
                        <span class="text-muted ms-3">
                            <i class="fas fa-eye"></i> {{ $page->views_count }} views
                        </span>
                        <span class="text-muted ms-3">
                            <i class="fas fa-calendar"></i> {{ $page->published_at->format('M d, Y') }}
                        </span>
                    </div>
                </header>

                @if($page->featured_image)
                    <div class="page-featured-image mb-4">
                        <img src="{{ asset($page->featured_image) }}" alt="{{ $page->title }}" class="img-fluid rounded">
                    </div>
                @endif

                <div class="page-content-body">
                    {!! $page->content !!}
                </div>
            </article>
        </div>

        <div class="col-md-4">
            <div class="sidebar">
                <!-- Location Navigation -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fas fa-map-marked-alt me-2"></i>Location Navigation</h5>
                    </div>
                    <div class="card-body">
                        @if($page->area)
                            <div class="mb-3">
                                <strong>Area:</strong><br>
                                <a href="{{ route('cms.area.pages', $page->area) }}" class="text-decoration-none">
                                    <i class="fas fa-map-pin me-1"></i>{{ $page->area->name }}
                                </a>
                            </div>
                        @endif
                        @if($page->city)
                            <div class="mb-3">
                                <strong>City:</strong><br>
                                <a href="{{ route('cms.city.pages', $page->city) }}" class="text-decoration-none">
                                    <i class="fas fa-city me-1"></i>{{ $page->city->city_name }}
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
                            <div class="mb-3">
                                <strong>State:</strong><br>
                                <a href="{{ route('cms.state.pages', $page->state) }}" class="text-decoration-none">
                                    <i class="fas fa-map-marked-alt me-1"></i>{{ $page->state->name }}
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
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Related Pages</h5>
                        </div>
                        <div class="card-body">
                            @foreach($relatedPages as $relatedPage)
                                <div class="related-page-item mb-3">
                                    <h6 class="related-page-title">
                                        <a href="{{ route('cms.page', $relatedPage->slug) }}" class="text-decoration-none">
                                            {{ $relatedPage->title }}
                                        </a>
                                    </h6>
                                    <p class="related-page-excerpt text-muted small">
                                        {{ Str::limit($relatedPage->excerpt, 100) }}
                                    </p>
                                    <small class="text-muted">
                                        <i class="fas fa-eye"></i> {{ $relatedPage->views_count }}
                                    </small>
                                </div>
                                @if(!$loop->last)
                                    <hr>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Page Information</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><strong>Type:</strong> {{ ucfirst($page->page_type) }}</li>
                            <li><strong>Template:</strong> {{ ucfirst($page->template) }}</li>
                            <li><strong>Status:</strong> 
                                <span class="badge bg-success">{{ ucfirst($page->status) }}</span>
                            </li>
                            @if($page->is_featured)
                                <li><strong>Featured:</strong> 
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
