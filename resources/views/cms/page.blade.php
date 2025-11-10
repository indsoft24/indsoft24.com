@extends('layouts.app')

@section('title', $metaTitle)

@section('meta')
<meta name="description" content="{{ $metaDescription }}">
@endsection

@section('content')
<div class="container" style="margin-top: 80px;">
    <div class="row">
        <div class="col-md-8">
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

                <div class="card">
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
            </div>
        </div>
    </div>
</div>
@endsection
