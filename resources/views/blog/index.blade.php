@extends('layouts.app')

@section('title', 'Blog - Latest Articles & Insights')

@section('content')
<!-- Hero Section -->
<section class="blog-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold text-white mb-4">
                    <i class="fas fa-blog me-3"></i>Thoughts of Thousand
                </h1>
                <p class="lead text-white-50 mb-4">
                   Thoughts of Thousand is a community-driven platform where voices come alive. From poetry and personal blogs to news and creative articles, we give everyone a space to express freely. A thousand thoughts, a thousand perspectives — all under one roof.
                </p>
                <div class="blog-stats">
                    <div class="row text-center">
                        <div class="col-4">
                            <h3 class="text-white fw-bold">{{ $posts->total() }}</h3>
                            <p class="text-white-50 mb-0">Articles</p>
                        </div>
                        <div class="col-4">
                            <h3 class="text-white fw-bold">{{ $categories->count() }}</h3>
                            <p class="text-white-50 mb-0">Categories</p>
                        </div>
                        <div class="col-4">
                            <h3 class="text-white fw-bold">{{ $tags->count() }}</h3>
                            <p class="text-white-50 mb-0">Topics</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Posts -->
@if($featuredPosts && $featuredPosts->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-5">
                    <i class="fas fa-star text-warning me-2"></i>Featured Articles
                </h2>
            </div>
        </div>
        <div class="row">
            @foreach($featuredPosts as $post)
            <div class="col-lg-4 mb-4">
                <div class="card featured-post h-100 shadow-sm">
                    @if($post->featured_image)
                        <img src="{{ asset($post->featured_image) }}" 
                             class="card-img-top" 
                             alt="{{ $post->title }}"
                             style="height: 200px; object-fit: cover;"
                             loading="lazy"
                             width="400"
                             height="200">
                    @else
                        <div class="card-img-top bg-gradient-primary d-flex align-items-center justify-content-center" 
                             style="height: 200px;">
                            <i class="fas fa-image fa-3x text-white opacity-50"></i>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge" style="background-color: {{ $post->category->color }}">
                                {{ $post->category->name }}
                            </span>
                            <span class="badge bg-warning ms-2">
                                <i class="fas fa-star"></i> Featured
                            </span>
                        </div>
                        <h5 class="card-title">
                            <a href="{{ route('blog.show', $post) }}" class="text-decoration-none text-dark">
                                {{ $post->title }}
                            </a>
                        </h5>
                                    <p class="card-text text-muted flex-grow-1" style="line-height: 1.6; word-wrap: break-word; overflow-wrap: break-word;">
                                        {{ Str::limit(strip_tags($post->excerpt), 120) }}
                                    </p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $post->published_at->format('M d, Y') }}
                            </small>
                            <small class="text-muted">
                                <i class="fas fa-eye me-1"></i>
                                {{ number_format($post->views_count) }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Main Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Blog Posts -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">
                        <i class="fas fa-newspaper text-primary me-2"></i>Latest Articles
                    </h2>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('blog.index') }}">All Posts</a></li>
                            @foreach($categories as $category)
                                <li><a class="dropdown-item" href="{{ route('blog.category', $category) }}">
                                    {{ $category->name }}
                                </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                @if($posts->count() > 0)
                    <div class="row">
                        @foreach($posts as $post)
                        <div class="col-md-6 mb-4">
                            <article class="card blog-post h-100 shadow-sm">
                                @if($post->featured_image)
                                    <img src="{{ asset($post->featured_image) }}" 
                                         class="card-img-top" 
                                         alt="{{ $post->title }}"
                                         style="height: 180px; object-fit: cover;"
                                         loading="lazy"
                                         width="400"
                                         height="180">
                                @else
                                    <div class="card-img-top bg-gradient-secondary d-flex align-items-center justify-content-center" 
                                         style="height: 180px;">
                                        <i class="fas fa-image fa-2x text-white opacity-50"></i>
                                    </div>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <div class="mb-2">
                                        <span class="badge" style="background-color: {{ $post->category->color }}">
                                            {{ $post->category->name }}
                                        </span>
                                        @if($post->is_featured)
                                            <span class="badge bg-warning ms-1">
                                                <i class="fas fa-star"></i>
                                            </span>
                                        @endif
                                    </div>
                                    <h5 class="card-title">
                                        <a href="{{ route('blog.show', $post) }}" class="text-decoration-none text-dark">
                                            {{ $post->title }}
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted flex-grow-1" style="line-height: 1.6; word-wrap: break-word; overflow-wrap: break-word;">
                                        {{ Str::limit(strip_tags($post->excerpt), 100) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('images/Indsoft24.png') }}" 
                                                 alt="Author" 
                                                 class="rounded-circle me-2" 
                                                 width="24" height="24">
                                            <small class="text-muted">By {{ ucwords(strtolower($post->user->name)) }}</small>
                                        </div>
                                        <small class="text-muted">
                                            {{ $post->published_at->format('M d') }}
                                        </small>
                                         <small class="text-muted">
                                <i class="fas fa-eye me-1"></i>
                                {{ number_format($post->views_count) }}
                            </small>
                                    </div>
                                </div>
                            </article>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-5">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No articles found</h4>
                        <p class="text-muted">Check back soon for new content!</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Search -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-search text-primary me-2"></i>Search Articles
                        </h5>
                        <form action="{{ route('blog.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" 
                                       class="form-control" 
                                       name="search" 
                                       placeholder="Search articles..."
                                       value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Categories -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-folder text-primary me-2"></i>Categories
                        </h5>
                        <div class="list-group list-group-flush">
                            @foreach($categories as $category)
                                <a href="{{ route('blog.category', $category) }}" 
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <span>
                                        <span class="badge me-2" style="background-color: {{ $category->color }}; width: 12px; height: 12px;"></span>
                                        {{ $category->name }}
                                    </span>
                                    <span class="badge bg-secondary">{{ $category->posts->count() }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Popular Tags -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-tags text-primary me-2"></i>Popular Tags
                        </h5>
                        <div class="tag-cloud">
                            @foreach($tags as $tag)
                                <a href="{{ route('blog.tag', $tag) }}" 
                                   class="badge me-2 mb-2" 
                                   style="background-color: {{ $tag->color }}">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Recent Posts -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-clock text-primary me-2"></i>Recent Posts
                        </h5>
                        <div class="list-group list-group-flush">
                            @foreach($recentPosts as $recentPost)
                                <a href="{{ route('blog.show', $recentPost) }}" 
                                   class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ Str::limit($recentPost->title, 40) }}</h6>
                                        <small>{{ $recentPost->published_at->format('M d') }}</small>
                                    </div>
                                    <p class="mb-1 text-muted small" style="line-height: 1.4; word-wrap: break-word; overflow-wrap: break-word;">
                                        {{ Str::limit(strip_tags($recentPost->excerpt), 60) }}
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <i class="fas fa-envelope text-primary me-2"></i>Stay Updated
                        </h5>
                        <p class="card-text text-muted">
                            Subscribe to our newsletter for the latest articles and updates.
                        </p>
                        <form method="POST" action="{{ route('newsletter.subscribe') }}">
                            @csrf
                            <div class="input-group mt-3">
                                <input type="email" name="email" class="form-control" placeholder="Your email address..." required aria-label="Your email address">
                                <button class="btn btn-primary" type="submit" aria-label="Subscribe">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Additional blog index specific styles */
.blog-stats h3 {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}

/* Improve text wrapping in all cards */
.card-text {
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
    line-height: 1.6;
}

/* Fix list group items */
.list-group-item {
    border: none;
    border-bottom: 1px solid #e9ecef;
    padding: 1rem 1.5rem;
    transition: background-color 0.2s ease;
}

.list-group-item:hover {
    background-color: #f8f9fa;
}

.list-group-item:last-child {
    border-bottom: none;
}
</style>
@endpush
