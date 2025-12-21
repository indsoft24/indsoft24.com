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
    $pageImage = $page->featured_image ? asset($page->featured_image) : '';
@endphp
@if($pageImage)
<meta property="og:image" content="{{ $pageImage }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="{{ $pageImage }}">
@else
<meta name="twitter:card" content="summary">
@endif
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
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
        height: auto;
        max-height: 500px;
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
        .page-meta {
            flex-direction: column;
            gap: 0.75rem;
        }
    }

    /* Cost Estimator Styles */
    .cost-estimator-wrapper {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 2.5rem;
        border-radius: 15px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        border: 1px solid #e9ecef;
    }
    .lead-form-modal {
        animation: slideDown 0.5s ease;
    }
    .lead-form-modal .card {
        border-radius: 12px;
    }
    .cost-estimator-form {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    }
    .cost-estimator-form .form-label {
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }
    .cost-estimator-form .form-select {
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }
    .cost-estimator-form .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .estimate-result {
        animation: slideDown 0.5s ease;
    }
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .estimate-table-wrapper {
        overflow-x: auto;
    }
    .estimate-table {
        margin-bottom: 0;
        border-radius: 8px;
        overflow: hidden;
    }
    .estimate-table thead th {
        font-weight: 700;
        font-size: 1.1rem;
        padding: 1rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white;
        border: none;
    }
    .estimate-table tbody td {
        padding: 1.25rem 1rem;
        font-size: 1.1rem;
        vertical-align: middle;
    }
    .estimate-table tbody tr {
        background: white;
    }
    #cost-usd, #cost-inr {
        font-size: 1.3rem;
        color: #667eea !important;
    }
    .lead-form-wrapper .card {
        border-radius: 12px;
    }
    .lead-form-wrapper .form-control {
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }
    .lead-form-wrapper .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .lead-form-wrapper .form-control[readonly] {
        background-color: #f8f9fa;
        cursor: not-allowed;
    }
    @media (max-width: 768px) {
        .cost-estimator-wrapper {
            padding: 1.5rem;
        }
        .cost-estimator-form {
            padding: 1.5rem;
        }
        .estimate-table thead th,
        .estimate-table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.95rem;
        }
        #cost-usd, #cost-inr {
            font-size: 1.1rem;
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

                @if($page->featured_image)
                <div class="page-featured-image">
                    <img src="{{ asset($page->featured_image) }}" 
                         alt="{{ $page->title }} - {{ $page->location }}"
                         class="img-fluid rounded">
                </div>
                @endif

                <div class="page-content-body">
                    {!! $page->content !!}
                    
                    <!-- Software Development Cost Estimator -->
                    <div class="mt-5 pt-4 border-top" id="cost-estimator-section">
                        <div class="cost-estimator-wrapper">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold mb-2" style="color: #2c3e50;">
                                    <i class="fas fa-calculator text-primary me-2"></i>Software Development Cost Estimator
                                </h2>
                                <p class="text-muted">Get an instant cost estimate for your software development project in India</p>
                            </div>

                            <div class="cost-estimator-form">
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label for="project-type" class="form-label fw-semibold">
                                            <i class="fas fa-briefcase text-primary me-1"></i>Project Type
                                        </label>
                                        <select class="form-select form-select-lg" id="project-type" required>
                                            <option value="">Select Project Type</option>
                                            <option value="Website">Website</option>
                                            <option value="Android App">Android App</option>
                                            <option value="CRM">CRM</option>
                                            <option value="Custom Software">Custom Software</option>
                                            <option value="Digital Marketing">Digital Marketing</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="complexity" class="form-label fw-semibold">
                                            <i class="fas fa-layer-group text-primary me-1"></i>Complexity
                                        </label>
                                        <select class="form-select form-select-lg" id="complexity" required>
                                            <option value="">Select Complexity</option>
                                            <option value="Simple">Simple</option>
                                            <option value="Medium">Medium</option>
                                            <option value="High">High</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="time-duration" class="form-label fw-semibold">
                                            <i class="fas fa-clock text-primary me-1"></i>Time Duration
                                        </label>
                                        <select class="form-select form-select-lg" id="time-duration" required>
                                            <option value="">Select Duration</option>
                                            <option value="1-2 Week">1-2 Week</option>
                                            <option value="2-4 Week">2-4 Week</option>
                                            <option value="1-3 Months">1-3 Months</option>
                                            <option value="6+ Months">6+ Months</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary btn-lg px-5" id="calculate-btn">
                                        <i class="fas fa-calculator me-2"></i>Calculate Estimate
                                    </button>
                                </div>
                            </div>

                            <!-- Lead Capture Form (Shown First) -->
                            <div id="lead-form-modal" class="lead-form-modal mt-4" style="display: none;">
                                <div class="card border-0 shadow-lg">
                                    <div class="card-header bg-gradient text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <h5 class="card-title mb-0 fw-bold">
                                            <i class="fas fa-user-circle me-2"></i>Get Your Cost Estimate
                                        </h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="alert alert-info border-0 mb-4">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <strong>Please provide your contact details</strong> to view the personalized cost estimate for your project.
                                        </div>
                                        <form id="pre-estimate-lead-form">
                                            <input type="hidden" id="pre-project-type">
                                            <input type="hidden" id="pre-complexity">
                                            <input type="hidden" id="pre-duration">
                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                    <label for="pre-lead-name" class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-lg" id="pre-lead-name" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="pre-lead-phone" class="form-label fw-semibold">Contact Number (with country code) <span class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control form-control-lg" id="pre-lead-phone" placeholder="+91 1234567890" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="pre-lead-email" class="form-label fw-semibold">Email Address <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control form-control-lg" id="pre-lead-email" required>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                                        <i class="fas fa-arrow-right me-2"></i>View Cost Estimate
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Estimate Result (Shown After Lead Form Submission) -->
                            <div id="estimate-result" class="estimate-result mt-4" style="display: none;">
                                <div class="estimate-content">
                                    <div class="alert alert-success border-0 shadow-sm">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-check-circle fa-2x me-3 text-success"></i>
                                            <div>
                                                <h5 class="mb-1 fw-bold">Thank You, <span id="user-name-display"></span>!</h5>
                                                <p class="mb-0 small">Here is your preliminary cost estimate:</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-info border-0 shadow-sm mt-3">
                                        <p class="mb-0 small" id="estimate-confirmation"></p>
                                    </div>
                                    
                                    <div class="estimate-table-wrapper mt-4">
                                        <table class="table table-bordered estimate-table">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="text-center">Estimated Cost Range</th>
                                                    <th class="text-center">USD</th>
                                                    <th class="text-center">INR</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold">Total Project Estimate</td>
                                                    <td class="text-center fw-bold text-primary" id="cost-usd"></td>
                                                    <td class="text-center fw-bold text-primary" id="cost-inr"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <div class="alert alert-light border mt-3 mb-0">
                                        <p class="mb-0 small text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            This estimate is an industry average and includes design, development, and testing. 
                                            A 15% contingency buffer has been included to account for real-world project variability.
                                        </p>
                                    </div>

                                    <!-- Additional Quote Request -->
                                    <div class="lead-form-wrapper mt-4">
                                        <div class="card border-0 shadow-sm bg-light">
                                            <div class="card-body p-4 text-center">
                                                <h6 class="fw-bold mb-3">Want a More Detailed Quote?</h6>
                                                <p class="text-muted small mb-3">
                                                    Our team will contact you shortly at <strong id="user-email-display"></strong> 
                                                    to provide a precise, personalized quote tailored exactly to your requirements.
                                                </p>
                                                <button type="button" class="btn btn-outline-primary" id="add-requirements-btn">
                                                    <i class="fas fa-plus me-2"></i>Add Additional Requirements
                                                </button>
                                                <div id="additional-requirements" class="mt-3" style="display: none;">
                                                    <textarea class="form-control" id="lead-message" rows="3" placeholder="Tell us more about your project requirements..."></textarea>
                                                    <button type="button" class="btn btn-primary mt-2" id="submit-requirements-btn">
                                                        <i class="fas fa-paper-plane me-2"></i>Submit Requirements
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calculateBtn = document.getElementById('calculate-btn');
    const estimateResult = document.getElementById('estimate-result');
    const leadFormModal = document.getElementById('lead-form-modal');
    const preLeadForm = document.getElementById('pre-estimate-lead-form');
    const projectType = document.getElementById('project-type');
    const complexity = document.getElementById('complexity');
    const timeDuration = document.getElementById('time-duration');
    
    // Hourly rates (lower, more competitive pricing)
    const hourlyRateUSD = 6; 
    const hourlyRateINR = 500; 
    const contingencyBuffer = 1.15; // 15% buffer
    
    // Effort ranges in hours
    const effortRanges = {
        'Simple': { min: 45, max: 90 },
        'Medium': { min: 90, max: 200 },
        'High': { min: 200, max: 650 },
        'Very High': { min: 1000, max: 2000 } 
    };
    
    // Store lead data
    let leadData = {};
    
    // Function to format currency
    function formatCurrency(amount, currency) {
        if (currency === 'USD') {
            return '$' + amount.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
        } else {
            return '₹' + amount.toLocaleString('en-IN', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
        }
    }
    
    // Show lead form when Calculate Estimate is clicked
    calculateBtn.addEventListener('click', function() {
        const selectedProjectType = projectType.value;
        const selectedComplexity = complexity.value;
        const selectedDuration = timeDuration.value;
        
        if (!selectedProjectType || !selectedComplexity || !selectedDuration) {
            alert('Please fill in all project details (Project Type, Complexity, and Time Duration) before calculating the estimate.');
            return;
        }
        
        // Store project selections
        leadData.projectType = selectedProjectType;
        leadData.complexity = selectedComplexity;
        leadData.duration = selectedDuration;
        
        // Store in hidden fields
        document.getElementById('pre-project-type').value = selectedProjectType;
        document.getElementById('pre-complexity').value = selectedComplexity;
        document.getElementById('pre-duration').value = selectedDuration;
        
        // Show lead form modal
        leadFormModal.style.display = 'block';
        leadFormModal.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    
    // Handle pre-estimate lead form submission
    preLeadForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const name = document.getElementById('pre-lead-name').value.trim();
        const phone = document.getElementById('pre-lead-phone').value.trim();
        const email = document.getElementById('pre-lead-email').value.trim();
        
        if (!name || !phone || !email) {
            alert('Please fill in all required fields (Name, Phone, and Email).');
            return;
        }
        
        // Store lead data
        leadData.name = name;
        leadData.phone = phone;
        leadData.email = email;
        
        // Send lead data to backend (you can implement AJAX call here)
        // For now, we'll proceed to show the estimate
        sendLeadData();
        
        // Hide lead form modal
        leadFormModal.style.display = 'none';
        
        // Calculate and show estimate
        calculateAndShowEstimate();
    });
    
    // Function to send lead data to backend
    function sendLeadData() {
        // Here you can implement an AJAX call to save the lead
        // Example:
        /*
        fetch('/api/estimator-leads', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                name: leadData.name,
                phone: leadData.phone,
                email: leadData.email,
                project_type: leadData.projectType,
                complexity: leadData.complexity,
                duration: leadData.duration,
                source: 'Cost Estimator'
            })
        }).catch(error => console.error('Error saving lead:', error));
        */
    }
    
    // Calculate and display estimate
    function calculateAndShowEstimate() {
        const selectedProjectType = leadData.projectType;
        const selectedComplexity = leadData.complexity;
        const selectedDuration = leadData.duration;
        
        // Get effort range
        const effort = effortRanges[selectedComplexity];
        if (!effort) {
            alert('Invalid complexity selected.');
            return;
        }
        
        // Calculate costs
        const minHours = effort.min;
        const maxHours = effort.max;
        
        // Apply hourly rates and contingency
        const minCostUSD = minHours * hourlyRateUSD * contingencyBuffer;
        const maxCostUSD = maxHours * hourlyRateUSD * contingencyBuffer;
        const minCostINR = minHours * hourlyRateINR * contingencyBuffer;
        const maxCostINR = maxHours * hourlyRateINR * contingencyBuffer;
        
        // Format and display results
        const costUSD = formatCurrency(minCostUSD) + ' - ' + formatCurrency(maxCostUSD);
        const costINR = formatCurrency(minCostINR) + ' - ' + formatCurrency(maxCostINR);
        
        document.getElementById('cost-usd').textContent = costUSD;
        document.getElementById('cost-inr').textContent = costINR;
        
        // Update user name and email display
        document.getElementById('user-name-display').textContent = leadData.name;
        document.getElementById('user-email-display').textContent = leadData.email;
        
        // Update confirmation message
        const confirmationText = `Based on your selections for a <strong>${selectedProjectType}</strong> with <strong>${selectedComplexity}</strong> complexity and a target delivery of <strong>${selectedDuration}</strong>, here is a preliminary cost estimate for development with a professional Indian team:`;
        document.getElementById('estimate-confirmation').innerHTML = confirmationText;
        
        // Show result with smooth scroll
        estimateResult.style.display = 'block';
        estimateResult.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
    
    // Handle additional requirements button
    const addRequirementsBtn = document.getElementById('add-requirements-btn');
    const additionalRequirements = document.getElementById('additional-requirements');
    const submitRequirementsBtn = document.getElementById('submit-requirements-btn');
    
    if (addRequirementsBtn) {
        addRequirementsBtn.addEventListener('click', function() {
            additionalRequirements.style.display = 'block';
            addRequirementsBtn.style.display = 'none';
        });
    }
    
    if (submitRequirementsBtn) {
        submitRequirementsBtn.addEventListener('click', function() {
            const message = document.getElementById('lead-message').value;
            if (message.trim()) {
                // Send additional requirements (you can implement AJAX call here)
                alert('Thank you! Your additional requirements have been submitted. Our team will review them and contact you shortly.');
                additionalRequirements.style.display = 'none';
                addRequirementsBtn.style.display = 'block';
            }
        });
    }
});
</script>
@endpush

@include('components.blog-section')
@include('components.blog-cta-section')
@endsection
