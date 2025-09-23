@extends('layouts.app')

@push('styles')
<style>
/* Additional blog category specific styles */
.category-stats h3 {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}
</style>
@endpush

@section('title', $category->name . ' Articles - Blog')

@section('content')
<!-- Hero Section -->
<section class="category-hero" style="background-color: {{ $category->color }}20;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="mb-4">
                    <span class="badge fs-4 px-4 py-3 mb-3" style="background-color: {{ $category->color }}">
                        {{ $category->name }}
                    </span>
                </div>
                <h1 class="display-4 fw-bold mb-4">
                    {{ $category->name }} Articles
                </h1>
                @if($category->description)
                    <p class="lead mb-4">{{ $category->description }}</p>
                @endif
                <div class="category-stats">
                    <div class="row text-center">
                        <div class="col-4">
                            <h3 class="fw-bold">{{ $posts->total() }}</h3>
                            <p class="mb-0">Articles</p>
                        </div>
                        <div class="col-4">
                            <h3 class="fw-bold">{{ $category->posts->count() }}</h3>
                            <p class="mb-0">Total Posts</p>
                        </div>
                        <div class="col-4">
                            <h3 class="fw-bold">{{ $category->posts->sum('views_count') }}</h3>
                            <p class="mb-0">Total Views</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" class="text-decoration-none">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
        </ol>
    </div>
</nav>

<!-- Articles -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">
                        <i class="fas fa-newspaper text-primary me-2"></i>{{ $category->name }} Articles
                    </h2>
                    <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to Blog
                    </a>
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
                                         style="height: 180px; object-fit: cover;">
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
                                    <p class="card-text text-muted flex-grow-1">
                                        {{ Str::limit(strip_tags($post->excerpt), 100) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('images/Indsoft24.png') }}" 
                                                 alt="Author" 
                                                 class="rounded-circle me-2" 
                                                 width="24" height="24">
                                            <small class="text-muted">{{ $post->user->name }}</small>
                                        </div>
                                        <small class="text-muted">
                                            {{ $post->published_at->format('M d') }}
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
                        <h4 class="text-muted">No articles found in {{ $category->name }}</h4>
                        <p class="text-muted">Check back soon for new content in this category!</p>
                        <a href="{{ route('blog.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Blog
                        </a>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- All Categories -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-folder text-primary me-2"></i>All Categories
                        </h5>
                        <div class="list-group list-group-flush">
                            @foreach($allCategories as $cat)
                                <a href="{{ route('blog.category', $cat) }}" 
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $cat->id === $category->id ? 'active' : '' }}">
                                    <span>
                                        <span class="badge me-2" style="background-color: {{ $cat->color }}; width: 12px; height: 12px;"></span>
                                        {{ $cat->name }}
                                    </span>
                                    <span class="badge bg-secondary">{{ $cat->posts->count() }}</span>
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
                            @foreach($popularTags as $tag)
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
                <div class="card">
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
                                    <p class="mb-1 text-muted small">
                                        {{ Str::limit(strip_tags($recentPost->excerpt), 60) }}
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
/* Additional blog category specific styles */
.category-stats h3 {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}
</style>
@endpush
