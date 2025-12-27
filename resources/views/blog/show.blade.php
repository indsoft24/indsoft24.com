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
            <div class="col-lg-10 mx-auto">
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
            </div>
        </div>
    </div>
</section>

@if($relatedPosts->count() > 0)
<section class="py-5 bg-light">
    {{-- ... Your existing Related Posts section ... --}}
</section>
@endif
@endsection

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
</script>
@endpush