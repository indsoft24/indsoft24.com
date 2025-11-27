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
                    <li class="breadcrumb-item"><a href="{{ route('cms.state.pages', $city->state) }}" class="text-decoration-none">{{ $city->state->name }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cms.state.cities', $city->state) }}" class="text-decoration-none">Cities</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $city->city_name }}</li>
                </ol>
            </nav>

            @push('styles')
            <style>
                .city-pages-header {
                    background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
                    color: white;
                    padding: 3rem 2rem;
                    border-radius: 15px;
                    margin-bottom: 2rem;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
                }
                .city-pages-header h1 {
                    font-size: 2.5rem;
                    font-weight: 700;
                    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
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
                @media (max-width: 768px) {
                    .city-pages-header {
                        padding: 2rem 1.5rem;
                    }
                    .city-pages-header h1 {
                        font-size: 1.75rem;
                    }
                    .content-section {
                        padding: 1.5rem;
                    }
                }
            </style>
            @endpush
            <div class="city-pages-header">
                <h1>{{ $city->city_name }}, {{ $city->state->name }}</h1>
                <p class="lead mb-0">Discover Local Businesses and E-commerce Opportunities in {{ $city->city_name }}</p>
            </div>

            <!-- Content Section -->
            <div class="content-section">
                <h2>About {{ $city->city_name }}</h2>
                <p style="font-size: 1.1rem; line-height: 1.9; color: #4a5568;">
                    Welcome to {{ $city->city_name }}, a vibrant city located in {{ $city->state->name }}. 
                    This dynamic urban center is home to a diverse range of businesses, from traditional establishments 
                    to modern e-commerce platforms. {{ $city->city_name }} offers excellent opportunities for both 
                    entrepreneurs and established businesses looking to expand their reach.
                </p>
                <p style="font-size: 1.1rem; line-height: 1.9; color: #4a5568;">
                    The business ecosystem in {{ $city->city_name }} is characterized by innovation, growth, and 
                    a strong commitment to customer service. Local businesses here benefit from strategic location 
                    advantages, excellent connectivity, and a supportive community that values quality products and services.
                </p>
            </div>

            <div class="content-section">
                <h2>SEO Keywords That Convert in {{ $city->city_name }}</h2>
                <p class="text-muted mb-4">
                    Include the keyword ideas below on your landing pages, meta descriptions, and FAQs to capture decision makers inside {{ $city->city_name }} and the wider {{ $city->state->name }} region.
                </p>
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>Best web development company in {{ $city->city_name }}</li>
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>Mobile app development agency {{ $city->city_name }}</li>
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>Professional SEO services in {{ $city->city_name }}</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>Responsive web design services {{ $city->city_name }}</li>
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>Custom software development company {{ $city->state->name }}</li>
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>E-commerce website development company {{ $city->city_name }}</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>Education website development {{ $city->state->name }}</li>
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>School/College management software {{ $city->city_name }}</li>
                            <li class="mb-2"><i class="fas fa-key text-primary me-2"></i>Hire dedicated developers {{ $city->state->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Navigation Links Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fas fa-sitemap me-2"></i>Explore {{ $city->city_name }}</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="{{ route('cms.city.areas', $city) }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-map-pin me-2"></i>Browse Areas
                                <span class="badge bg-primary ms-2">{{ $city->activeAreas()->count() }}</span>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('cms.state.cities', $city->state) }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-city me-2"></i>All Cities in {{ $city->state->name }}
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('cms.state.pages', $city->state) }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-building me-2"></i>State Businesses
                            </a>
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
                                     alt="{{ $page->title }} in {{ $city->city_name }}"
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
                                    <p class="card-text text-muted flex-grow-1" style="font-size: 0.95rem; line-height: 1.6;">
                                        {{ $page->excerpt ?: Str::limit(strip_tags($page->content), 120) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <small class="text-muted">
                                            @if($page->area)
                                                <i class="fas fa-map-marker-alt me-1"></i>{{ $page->area->name }}
                                            @endif
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-eye me-1"></i>{{ number_format($page->views_count) }}
                                        </small>
                                    </div>
                                    <a href="{{ route('cms.page', $page->slug) }}" class="btn btn-primary w-100">
                                        <i class="fas fa-arrow-right me-2"></i>Read More
                                    </a>
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
                    <i class="fas fa-city fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No pages found for {{ $city->name }}</h5>
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
