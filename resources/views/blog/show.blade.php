@extends('layouts.app')

@section('title', Str::limit($metaTitle, 60))
@section('meta')
<meta name="description" content="{{ $metaDescription }}">
<meta property="og:title" content="{{ $post->title }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:image" content="{{ $post->featured_image ? asset($post->featured_image) : asset('images/Indsoft24.png') }}">
<meta property="og:url" content="{{ route('blog.show', $post) }}">
<meta name="twitter:card" content="summary_large_image">
@endsection

@section('content')
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" class="text-decoration-none">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($post->title, 30) }}</li>
        </ol>
    </div>
</nav>

<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <span class="badge fs-6 px-3 py-2" style="background-color: {{ $post->category->color }}">
                            {{ $post->category->name }}
                        </span>
                        @if($post->is_featured)
                            <span class="badge bg-warning fs-6 px-3 py-2 ms-2">
                                <i class="fas fa-star"></i> Featured
                            </span>
                        @endif
                    </div>
                    
                    <h1 class="display-5 fw-bold mb-4">{{ $post->title }}</h1>
                    
                    <div class="d-flex justify-content-center align-items-center text-muted mb-4">
                        <img src="{{ asset('images/Indsoft24.png') }}" 
                             alt="{{ $post->user->name }}" 
                             class="rounded-circle me-3" 
                             width="40" height="40">
                        <div class="text-start">
                            <div class="fw-semibold">By {{ ucwords(strtolower($post->user->name)) }}</div>
                            <small>
                                <i class="fas fa-calendar me-1"></i>
                                {{ $post->published_at->format('F d, Y') }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-clock me-1"></i>
                                {{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read
                            </small>
                             <small class="text-muted">
                                <i class="fas fa-eye me-1"></i>
                                {{ number_format($post->views_count) }}
                            </small>
                        </div>
                    </div>
                </div>

               @if($post->featured_image)
                    <div class="mb-5 text-center">
                        <img src="{{ asset($post->featured_image) }}" 
                             alt="{{ $post->title }}" 
                             style="max-width: 100%; height: auto; display: block; margin: 0 auto;
                                    border-radius: 0.75rem; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    </div>
                @endif

                <article class="article-content">
                    {!! $post->content !!}
                </article>

                @if($post->tags->count() > 0)
                    <div class="mt-5 pt-4 border-top">
                        <h6 class="mb-3"><i class="fas fa-tags text-primary me-2"></i>Tags</h6>
                        <div class="tag-list">
                            @foreach($post->tags as $tag)
                                <a href="{{ route('blog.tag', $tag) }}" 
                                   class="badge me-2 mb-2 fs-6 px-3 py-2" 
                                   style="background-color: {{ $tag->color }}">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mt-5 pt-4 border-top">
                    <h6 class="mb-3"><i class="fas fa-share-alt text-primary me-2"></i>Share this article</h6>
                    <div class="share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post)) }}" target="_blank" class="btn btn-outline-primary me-2 mb-2"><i class="fab fa-facebook-f"></i> Facebook</a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post)) }}&text={{ urlencode($post->title) }}" target="_blank" class="btn btn-outline-info me-2 mb-2"><i class="fab fa-twitter"></i> Twitter</a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('blog.show', $post)) }}" target="_blank" class="btn btn-outline-primary me-2 mb-2"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                        <button onclick="copyToClipboard('{{ route('blog.show', $post) }}')" class="btn btn-outline-secondary me-2 mb-2"><i class="fas fa-copy"></i> Copy Link</button>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-top">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img src="{{ asset('images/Indsoft24.png') }}" 
                                 alt="{{ $post->user->name }}" 
                                 class="rounded-circle" 
                                 width="80" height="80">
                        </div>
                        <div class="col">
                            <h5 class="mb-1">By {{ ucwords(strtolower($post->user->name)) }}</h5>
                            <p class="text-muted mb-2">Software Developer & Technology Enthusiast</p>
                            <p class="mb-0">Passionate about creating innovative software solutions and sharing knowledge through technical writing and development.</p>
                        </div>
                    </div>
                </div>

                <hr class="my-5">
                <div class="post-actions d-flex justify-content-between align-items-center">
                    <div class="likes-count">
                        <i class="fas fa-heart text-danger"></i>
                        <span id="like-count">{{ $post->likes_count }}</span> 
                        <span>{{ Str::plural('Like', $post->likes_count) }}</span>
                    </div>
                    @auth
                        <button id="like-button" class="btn {{ $isLiked ? 'btn-outline-danger' : 'btn-danger' }}" data-post-id="{{ $post->id }}">
                            <i class="fas {{ $isLiked ? 'fa-heart-broken' : 'fa-heart' }}"></i>
                            <span id="like-text">{{ $isLiked ? 'Unlike' : 'Like' }}</span>
                        </button>
                    @endauth
                    @guest
                        <a href="{{ route('auth.google') }}" class="btn btn-outline-danger">Login to Like</a>
                    @endguest
                </div>
                <hr class="mt-4">

                <div class="comments-section mt-5">
                    <h3 class="mb-4">
                        <span id="comment-count">{{ $post->comments->count() }}</span> 
                        <span>{{ Str::plural('Comment', $post->comments->count()) }}</span>
                    </h3>

                    @auth
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Leave a Comment</h5>
                                <form id="comment-form" data-post-id="{{ $post->id }}">
                                    @csrf
                                    <div class="mb-3">
                                        <textarea class="form-control" id="comment-body" name="body" rows="4" placeholder="Write your comment here..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Post Comment</button>
                                </form>
                            </div>
                        </div>
                    @endauth
                    @guest
                        <div class="alert alert-info">
                            <a href="{{ route('auth.google') }}">Log in</a> to post a comment.
                        </div>
                    @endguest

                    <div id="comments-wrapper">
                        @forelse($post->comments as $comment)
                            <div class="comment d-flex mb-4">
                                <div class="flex-shrink-0 me-3">
                                     <i class="fas fa-user-circle fa-3x text-muted"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mt-0 mb-1">By {{ ucwords(strtolower($comment->user->name)) }}</h5>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                    <p class="mt-2">{{ $comment->body }}</p>
                                </div>
                            </div>
                        @empty
                            <p id="no-comments-message">No comments yet. Be the first to comment!</p>
                        @endforelse
                    </div>
                </div>

                <!-- Navigation Section -->
                <div class="blog-navigation mt-5 pt-5 border-top">
                    <div class="row g-3">
                        <!-- Previous Post -->
                        @if($previousPost)
                        <div class="col-md-6">
                            <a href="{{ route('blog.show', $previousPost) }}" class="nav-post-card text-decoration-none">
                                <div class="card h-100 border-0 shadow-sm hover-shadow">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-chevron-left text-primary me-2"></i>
                                            <small class="text-primary fw-semibold text-uppercase">Previous Post</small>
                                        </div>
                                        <h6 class="mb-0 text-dark fw-bold">{{ Str::limit($previousPost->title, 60) }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @else
                        <div class="col-md-6"></div>
                        @endif

                        <!-- Next Post -->
                        @if($nextPost)
                        <div class="col-md-6">
                            <a href="{{ route('blog.show', $nextPost) }}" class="nav-post-card text-decoration-none">
                                <div class="card h-100 border-0 shadow-sm hover-shadow">
                                    <div class="card-body text-end">
                                        <div class="d-flex align-items-center justify-content-end mb-2">
                                            <small class="text-primary fw-semibold text-uppercase">Next Post</small>
                                            <i class="fas fa-chevron-right text-primary ms-2"></i>
                                        </div>
                                        <h6 class="mb-0 text-dark fw-bold">{{ Str::limit($nextPost->title, 60) }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endif
                    </div>

                    <!-- Recent Blog Links -->
                    @if($additionalRecentPosts->count() > 0)
                    <div class="mt-4">
                        <h5 class="mb-3 fw-bold">
                            <i class="fas fa-clock text-primary me-2"></i>More Recent Articles
                        </h5>
                        <div class="row g-3">
                            @foreach($additionalRecentPosts->take(4) as $recentPost)
                            <div class="col-md-6">
                                <a href="{{ route('blog.show', $recentPost) }}" class="recent-post-link text-decoration-none">
                                    <div class="card border-0 shadow-sm hover-shadow h-100">
                                        @if($recentPost->featured_image)
                                        <img src="{{ asset($recentPost->featured_image) }}" 
                                             class="card-img-top" 
                                             alt="{{ $recentPost->title }}"
                                             style="height: 120px; object-fit: cover;">
                                        @endif
                                        <div class="card-body">
                                            <span class="badge mb-2" style="background-color: {{ $recentPost->category->color }}">
                                                {{ $recentPost->category->name }}
                                            </span>
                                            <h6 class="card-title text-dark fw-semibold mb-2">{{ Str::limit($recentPost->title, 50) }}</h6>
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ $recentPost->published_at->format('M d, Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <!-- Lead Collection Form -->
                    <div class="card mb-4 shadow-sm border-0 sidebar-widget">
                        <div class="card-header bg-gradient-primary text-white">
                            <h5 class="card-title mb-0 fw-bold">
                                <i class="fas fa-rocket me-2"></i>Get In Touch
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-3">Have a project in mind? Let's discuss how we can help bring your ideas to life.</p>
                            <form action="{{ route('leads.store') }}" method="POST" id="blogLeadForm">
                                @csrf
                                <input type="hidden" name="source" value="blog">
                                <input type="hidden" name="website" value="" class="honeypot">
                                
                                <div class="mb-3">
                                    <label for="blog_lead_name" class="form-label small fw-semibold">Name <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control form-control-sm @error('name') is-invalid @enderror" 
                                           id="blog_lead_name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           required
                                           pattern="[a-zA-Z\s]+"
                                           placeholder="Your name">
                                    @error('name')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="blog_lead_email" class="form-label small fw-semibold">Email <span class="text-danger">*</span></label>
                                    <input type="email" 
                                           class="form-control form-control-sm @error('email') is-invalid @enderror" 
                                           id="blog_lead_email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required
                                           placeholder="your.email@example.com">
                                    @error('email')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="blog_lead_phone" class="form-label small fw-semibold">Phone <span class="text-danger">*</span></label>
                                    <input type="tel" 
                                           class="form-control form-control-sm @error('phone') is-invalid @enderror" 
                                           id="blog_lead_phone" 
                                           name="phone" 
                                           value="{{ old('phone') }}" 
                                           required
                                           pattern="[0-9\+\-\s\(\)]+"
                                           placeholder="+1 234 567 8900">
                                    @error('phone')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="blog_lead_message" class="form-label small fw-semibold">Message</label>
                                    <textarea class="form-control form-control-sm @error('message') is-invalid @enderror" 
                                              id="blog_lead_message" 
                                              name="message" 
                                              rows="3" 
                                              placeholder="Tell us about your project...">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100 fw-semibold">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Promotional/Featured Posts -->
                    @if($promotionalPosts->count() > 0)
                    <div class="card mb-4 shadow-sm border-0 sidebar-widget">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="card-title mb-0 fw-bold">
                                <i class="fas fa-star text-warning me-2"></i>Featured Articles
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            @foreach($promotionalPosts as $promoPost)
                            <a href="{{ route('blog.show', $promoPost) }}" class="promo-post-item text-decoration-none d-block border-bottom">
                                <div class="p-3 hover-bg">
                                    <div class="d-flex">
                                        @if($promoPost->featured_image)
                                        <img src="{{ asset($promoPost->featured_image) }}" 
                                             alt="{{ $promoPost->title }}"
                                             class="rounded me-3"
                                             style="width: 80px; height: 80px; object-fit: cover; flex-shrink: 0;">
                                        @else
                                        <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                             style="width: 80px; height: 80px; flex-shrink: 0;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                        @endif
                                        <div class="flex-grow-1">
                                            <span class="badge mb-1" style="background-color: {{ $promoPost->category->color }}; font-size: 0.7rem;">
                                                {{ $promoPost->category->name }}
                                            </span>
                                            <h6 class="mb-1 text-dark fw-semibold small">{{ Str::limit($promoPost->title, 50) }}</h6>
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>{{ $promoPost->published_at->format('M d, Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Recent Posts -->
                    @if($recentPosts->count() > 0)
                    <div class="card mb-4 shadow-sm border-0 sidebar-widget">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="card-title mb-0 fw-bold">
                                <i class="fas fa-clock text-primary me-2"></i>Recent Posts
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @foreach($recentPosts as $recentPost)
                                <a href="{{ route('blog.show', $recentPost) }}" class="list-group-item list-group-item-action border-0 px-3 py-3">
                                    <div class="d-flex w-100 justify-content-between align-items-start">
                                        <div class="flex-grow-1 me-2">
                                            <h6 class="mb-1 fw-semibold text-dark">{{ Str::limit($recentPost->title, 50) }}</h6>
                                            <p class="mb-1 text-muted small" style="line-height: 1.4;">
                                                {{ Str::limit(strip_tags($recentPost->excerpt), 70) }}
                                            </p>
                                            <div class="d-flex align-items-center mt-2">
                                                <span class="badge me-2" style="background-color: {{ $recentPost->category->color }}; font-size: 0.7rem;">
                                                    {{ $recentPost->category->name }}
                                                </span>
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar me-1"></i>{{ $recentPost->published_at->format('M d') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@if($relatedPosts->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">
            <i class="fas fa-book-open text-primary me-2"></i>Related Articles
        </h2>
        <div class="row">
            @foreach($relatedPosts as $relatedPost)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($relatedPost->featured_image)
                    <img src="{{ asset($relatedPost->featured_image) }}" 
                         class="card-img-top" 
                         alt="{{ $relatedPost->title }}"
                         style="height: 200px; object-fit: cover;">
                    @else
                    <div class="card-img-top bg-gradient-secondary d-flex align-items-center justify-content-center" 
                         style="height: 200px;">
                        <i class="fas fa-image fa-3x text-white opacity-50"></i>
                    </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge" style="background-color: {{ $relatedPost->category->color }}">
                                {{ $relatedPost->category->name }}
                            </span>
                        </div>
                        <h5 class="card-title">
                            <a href="{{ route('blog.show', $relatedPost) }}" class="text-decoration-none text-dark">
                                {{ $relatedPost->title }}
                            </a>
                        </h5>
                        <p class="card-text text-muted flex-grow-1">
                            {{ Str::limit(strip_tags($relatedPost->excerpt), 100) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $relatedPost->published_at->format('M d, Y') }}
                            </small>
                            <a href="{{ route('blog.show', $relatedPost) }}" class="btn btn-sm btn-primary">
                                Read More <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@push('styles')
<style>
/* Blog Sidebar Styles */
.blog-sidebar {
    position: sticky;
    top: 100px;
}

.sidebar-widget {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.sidebar-widget:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1) !important;
}

.sidebar-widget .card-header {
    border-radius: 0.5rem 0.5rem 0 0 !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* Promotional Post Item */
.promo-post-item {
    transition: background-color 0.2s ease;
}

.promo-post-item .hover-bg:hover {
    background-color: #f8f9fa;
}

/* Recent Post List Item */
.list-group-item {
    transition: background-color 0.2s ease, padding-left 0.2s ease;
}

.list-group-item:hover {
    background-color: #f8f9fa;
    padding-left: 1.5rem !important;
}

/* Navigation Cards */
.nav-post-card .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.nav-post-card:hover .card {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.hover-shadow {
    transition: box-shadow 0.3s ease;
}

.recent-post-link .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.recent-post-link:hover .card {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

/* Lead Form Styles */
#blogLeadForm .form-control-sm {
    border-radius: 0.375rem;
    border: 1px solid #dee2e6;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

#blogLeadForm .form-control-sm:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

#blogLeadForm .btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

#blogLeadForm .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

/* Responsive adjustments */
@media (max-width: 991.98px) {
    .blog-sidebar {
        position: relative;
        top: 0;
        margin-top: 3rem;
    }
}

@media (max-width: 767.98px) {
    .blog-navigation .nav-post-card .card-body {
        text-align: left !important;
    }
    
    .blog-navigation .nav-post-card .d-flex.justify-content-end {
        justify-content: flex-start !important;
    }
    
    .blog-navigation .nav-post-card .fa-chevron-right {
        order: -1;
        margin-left: 0 !important;
        margin-right: 0.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
// --- COPY TO CLIPBOARD FUNCTION ---
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        const toastEl = document.getElementById('success-toast');
        const toastBody = toastEl.querySelector('.toast-body');
        toastBody.textContent = 'Link copied to clipboard!';
        const toast = new bootstrap.Toast(toastEl, { delay: 2000 });
        toast.show();
    });
}

// --- AJAX LIKE & COMMENT LOGIC ---
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // LIKE BUTTON LOGIC
    const likeButton = document.getElementById('like-button');
    if (likeButton) {
        likeButton.addEventListener('click', function () {
            const postId = this.dataset.postId;
            fetch(`/blog/${postId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                const likeCountSpan = document.getElementById('like-count');
                const likeTextSpan = document.getElementById('like-text');
                const likeIcon = this.querySelector('i');

                likeCountSpan.textContent = data.like_count;
                document.querySelector('.likes-count span:last-child').textContent = (data.like_count === 1) ? ' Like' : ' Likes';

                if (data.liked) {
                    this.classList.remove('btn-danger');
                    this.classList.add('btn-outline-danger');
                    likeIcon.classList.remove('fa-heart');
                    likeIcon.classList.add('fa-heart-broken');
                    likeTextSpan.textContent = 'Unlike';
                } else {
                    this.classList.remove('btn-outline-danger');
                    this.classList.add('btn-danger');
                    likeIcon.classList.remove('fa-heart-broken');
                    likeIcon.classList.add('fa-heart');
                    likeTextSpan.textContent = 'Like';
                }
            });
        });
    }

    // COMMENT FORM LOGIC
    const commentForm = document.getElementById('comment-form');
    if (commentForm) {
        commentForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const postId = this.dataset.postId;
            const commentBody = document.getElementById('comment-body');
    
            fetch(`/blog/${postId}/comments`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ body: commentBody.value })
            })
            .then(response => response.json())
            .then(comment => {
                // --- (The code to add the new comment to the list is the same) ---
                const newCommentHtml = `
                    <div class="comment d-flex mb-4">
                        <div class="flex-shrink-0 me-3">
                             <i class="fas fa-user-circle fa-3x text-muted"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mt-0 mb-1">${comment.user.name}</h5>
                            <small class="text-muted">Just now</small>
                            <p class="mt-2">${comment.body}</p>
                        </div>
                    </div>`;
                const commentsWrapper = document.getElementById('comments-wrapper');
                commentsWrapper.insertAdjacentHTML('afterbegin', newCommentHtml);
                commentBody.value = '';
                const commentCountSpan = document.getElementById('comment-count');
                const newCount = parseInt(commentCountSpan.textContent) + 1;
                commentCountSpan.textContent = newCount;
                const noCommentsMessage = document.getElementById('no-comments-message');
                if(noCommentsMessage) {
                    noCommentsMessage.remove();
                }
                // --- (End of existing code) ---
    
    
                // --- UPDATED: Show the success toast ---
                const toastEl = document.getElementById('success-toast');
                const toastBody = toastEl.querySelector('.toast-body');
    
                if (toastEl && toastBody) {
                    toastBody.textContent = 'Comment posted successfully!'; // Set the message
                    const toast = new bootstrap.Toast(toastEl, { delay: 2500 }); // 2.5 second delay
                    toast.show();
                }
            });
        });
    }
});

// Lead Form Submission Handler
document.addEventListener('DOMContentLoaded', function() {
    const leadForm = document.getElementById('blogLeadForm');
    if (leadForm) {
        leadForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            
            // Disable button and show loading state
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success || data.message) {
                    // Show success message
                    const toastEl = document.getElementById('success-toast');
                    if (toastEl) {
                        const toastBody = toastEl.querySelector('.toast-body');
                        toastBody.textContent = data.message || 'Thank you! We will get back to you soon.';
                        const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
                        toast.show();
                    }
                    
                    // Reset form
                    this.reset();
                } else {
                    throw new Error(data.message || 'Something went wrong');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            })
            .finally(() => {
                // Re-enable button
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            });
        });
    }
});
</script>
@endpush