@extends('layouts.app')

@section('title', $metaTitle)

@section('meta')
<meta name="description" content="{{ $metaDescription }}">
@endsection

@section('content')
<div class="container" style="margin-top: 80px;">
    <div class="row">
        <div class="col-12">
            <div class="page-header mb-4">
                <h1>Search Pages</h1>
                <p class="lead">Search through all published pages and content</p>
            </div>

            <!-- Search Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('cms.search') }}" class="row g-3">
                        <div class="col-md-6">
                            <label for="q" class="form-label">Search Term</label>
                            <input type="text" class="form-control" id="q" name="q" 
                                   value="{{ request('q') }}" placeholder="Enter search term...">
                        </div>
                        <div class="col-md-3">
                            <label for="state" class="form-label">State</label>
                            <select class="form-select" id="state" name="state">
                                <option value="">All States</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}" {{ request('state') == $state->id ? 'selected' : '' }}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="city" class="form-label">City</label>
                            <select class="form-select" id="city" name="city">
                                <option value="">All Cities</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ request('city') == $city->id ? 'selected' : '' }}>
                                        {{ $city->city_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="area" class="form-label">Area</label>
                            <select class="form-select" id="area" name="area">
                                <option value="">All Areas</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}" {{ request('area') == $area->id ? 'selected' : '' }}>
                                        {{ $area->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="page_type" class="form-label">Page Type</label>
                            <select class="form-select" id="page_type" name="page_type">
                                <option value="">All Types</option>
                                <option value="general" {{ request('page_type') == 'general' ? 'selected' : '' }}>General</option>
                                <option value="service" {{ request('page_type') == 'service' ? 'selected' : '' }}>Service</option>
                                <option value="product" {{ request('page_type') == 'product' ? 'selected' : '' }}>Product</option>
                                <option value="about" {{ request('page_type') == 'about' ? 'selected' : '' }}>About</option>
                                <option value="contact" {{ request('page_type') == 'contact' ? 'selected' : '' }}>Contact</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-grid">
                                <a href="{{ route('cms.search') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Clear
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Search Results -->
            @if(request()->hasAny(['q', 'state', 'city', 'area', 'page_type']))
                <div class="search-results">
                    @if($pages->count() > 0)
                        <div class="alert alert-info border-0 shadow-sm mb-4">
                            <h5 class="mb-2"><i class="fas fa-search me-2"></i>Search Results</h5>
                            <p class="mb-0">Found {{ $pages->total() }} result(s) matching your criteria.</p>
                        </div>
                        <div class="row">
                            @foreach($pages as $page)
                                @php
                                    $pageImage = $page->featured_image 
                                        ? asset($page->featured_image) 
                                        : 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=400&h=250&fit=crop';
                                    $fallbackImage = 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=250&fit=crop';
                                @endphp
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100 shadow-sm border-0" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                        <img src="{{ $pageImage }}" 
                                             class="card-img-top" 
                                             alt="{{ $page->title }}"
                                             style="height: 250px; object-fit: cover;"
                                             onerror="this.src='{{ $fallbackImage }}'">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title fw-bold mb-2">
                                                <a href="{{ route('cms.page', $page) }}" class="text-decoration-none text-dark">
                                                    {{ $page->title }}
                                                </a>
                                            </h5>
                                            @if($page->excerpt)
                                                <p class="card-text text-muted flex-grow-1" style="font-size: 0.95rem; line-height: 1.6;">
                                                    {{ Str::limit($page->excerpt, 120) }}
                                                </p>
                                            @endif
                                            <div class="card-text mb-2">
                                                <small class="text-muted">
                                                    <i class="fas fa-map-marker-alt me-1"></i>
                                                    @if($page->area)
                                                        {{ $page->area->name }}, {{ $page->city->city_name }}, {{ $page->state->name }}
                                                    @elseif($page->city)
                                                        {{ $page->city->city_name }}, {{ $page->state->name }}
                                                    @elseif($page->state)
                                                        {{ $page->state->name }}
                                                    @endif
                                                </small>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-primary">{{ ucfirst($page->page_type) }}</span>
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar me-1"></i>{{ $page->published_at->format('M d, Y') }}
                                                </small>
                                            </div>
                                            <a href="{{ route('cms.page', $page) }}" class="btn btn-primary w-100">
                                                <i class="fas fa-arrow-right me-2"></i>View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $pages->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No results found</h5>
                            <p class="text-muted">Try adjusting your search criteria.</p>
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Search Pages</h5>
                    <p class="text-muted">Use the search form above to find pages and content.</p>
                </div>
            @endif
            
            <div class="card border-0 shadow-sm mt-5">
                <div class="card-body p-4">
                    <h2 class="h4 fw-bold mb-3">Content Ideas & Long-Tail Keywords</h2>
                    <p class="text-muted mb-4">
                        Publish in-depth guides around these questions to capture research-stage traffic and nurture them toward your service pages.
                    </p>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="fas fa-keyboard text-primary me-2"></i>How much does it cost to build a mobile app in India?</li>
                        <li class="mb-2"><i class="fas fa-keyboard text-primary me-2"></i>Why does my business need a custom software solution?</li>
                        <li class="mb-2"><i class="fas fa-keyboard text-primary me-2"></i>Web development vs. WordPress: Which is better for business?</li>
                        <li class="mb-2"><i class="fas fa-keyboard text-primary me-2"></i>Top trends in mobile app development 2025</li>
                        <li class="mb-2"><i class="fas fa-keyboard text-primary me-2"></i>How to choose the best web development agency in Noida</li>
                    </ul>
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
@endsection
