@extends('admin.layouts.app')

@section('title', 'View Post: ' . $post->title)

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-eye"></i> View Post</h1>
            <p class="text-muted">Review and manage this blog post.</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Post
            </a>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Posts
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Post Content -->
    <div class="col-lg-8">
        <!-- Post Header -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h2 class="mb-2">{{ $post->title }}</h2>
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge" style="background-color: {{ $post->category->color }}">
                                {{ $post->category->name }}
                            </span>
                            @if($post->status === 'published')
                                <span class="badge bg-success">Published</span>
                            @elseif($post->status === 'draft')
                                <span class="badge bg-warning">Draft</span>
                            @else
                                <span class="badge bg-secondary">Archived</span>
                            @endif
                            @if($post->is_featured)
                                <span class="badge bg-warning">Featured</span>
                            @endif
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="text-muted small">
                            <i class="fas fa-eye"></i> {{ number_format($post->views_count) }} views
                        </div>
                        <div class="text-muted small">
                            <i class="fas fa-heart"></i> {{ $post->likes_count }} likes
                        </div>
                    </div>
                </div>

                @if($post->featured_image)
                    <div class="mb-3">
                        <img src="{{ asset($post->featured_image) }}" 
                             alt="{{ $post->title }}" 
                             class="img-fluid rounded">
                    </div>
                @endif

                @if($post->excerpt)
                    <div class="alert alert-info">
                        <strong>Excerpt:</strong> {{ $post->excerpt }}
                    </div>
                @endif

                <div class="post-content">
                    {!! $post->content !!}
                </div>
            </div>
        </div>

        <!-- Tags -->
        @if($post->tags->count() > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-tags"></i> Tags</h5>
            </div>
            <div class="card-body">
                @foreach($post->tags as $tag)
                    <span class="badge me-2 mb-2" style="background-color: {{ $tag->color }}">
                        {{ $tag->name }}
                    </span>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Post Details -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Post Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Author:</strong></td>
                        <td>{{ $post->user->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Created:</strong></td>
                        <td>{{ $post->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Updated:</strong></td>
                        <td>{{ $post->updated_at->format('M d, Y H:i') }}</td>
                    </tr>
                    @if($post->published_at)
                    <tr>
                        <td><strong>Published:</strong></td>
                        <td>{{ $post->published_at->format('M d, Y H:i') }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @if($post->status === 'published')
                                <span class="badge bg-success">Published</span>
                            @elseif($post->status === 'draft')
                                <span class="badge bg-warning">Draft</span>
                            @else
                                <span class="badge bg-secondary">Archived</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Views:</strong></td>
                        <td>{{ number_format($post->views_count) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Likes:</strong></td>
                        <td>{{ $post->likes_count }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- SEO Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-search"></i> SEO Information</h5>
            </div>
            <div class="card-body">
                @if($post->meta_title)
                    <div class="mb-3">
                        <strong>Meta Title:</strong>
                        <div class="text-muted small">{{ $post->meta_title }}</div>
                    </div>
                @endif

                @if($post->meta_description)
                    <div class="mb-3">
                        <strong>Meta Description:</strong>
                        <div class="text-muted small">{{ $post->meta_description }}</div>
                    </div>
                @endif

                <div class="mb-3">
                    <strong>URL Slug:</strong>
                    <div class="text-muted small">{{ $post->slug }}</div>
                </div>

                <div class="mb-3">
                    <strong>Full URL:</strong>
                    <div class="text-muted small">
                        <a href="{{ route('blog.show', $post) }}" target="_blank">
                            {{ route('blog.show', $post) }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-bolt"></i> Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('blog.show', $post) }}" 
                       class="btn btn-outline-primary" 
                       target="_blank">
                        <i class="fas fa-external-link-alt"></i> View on Website
                    </a>
                    <a href="{{ route('admin.posts.edit', $post) }}" 
                       class="btn btn-outline-secondary">
                        <i class="fas fa-edit"></i> Edit Post
                    </a>
                    @if($post->status === 'draft')
                        <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="published">
                            <button type="submit" class="btn btn-outline-success w-100">
                                <i class="fas fa-check"></i> Publish Now
                            </button>
                        </form>
                    @elseif($post->status === 'published')
                        <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="draft">
                            <button type="submit" class="btn btn-outline-warning w-100">
                                <i class="fas fa-edit"></i> Move to Draft
                            </button>
                        </form>
                    @endif
                    <form action="{{ route('admin.posts.destroy', $post) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fas fa-trash"></i> Delete Post
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Share -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-share"></i> Share</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary btn-sm" 
                            onclick="copyToClipboard('{{ route('blog.show', $post) }}')">
                        <i class="fas fa-copy"></i> Copy Link
                    </button>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post)) }}" 
                       class="btn btn-outline-primary btn-sm" 
                       target="_blank">
                        <i class="fab fa-facebook"></i> Share on Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post)) }}&text={{ urlencode($post->title) }}" 
                       class="btn btn-outline-info btn-sm" 
                       target="_blank">
                        <i class="fab fa-twitter"></i> Share on Twitter
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.post-content {
    line-height: 1.6;
}

.post-content h1,
.post-content h2,
.post-content h3,
.post-content h4,
.post-content h5,
.post-content h6 {
    margin-top: 1.5rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.post-content p {
    margin-bottom: 1rem;
}

.post-content ul,
.post-content ol {
    margin-bottom: 1rem;
    padding-left: 2rem;
}

.post-content blockquote {
    border-left: 4px solid #3498db;
    padding-left: 1rem;
    margin: 1rem 0;
    font-style: italic;
    color: #6c757d;
}

.post-content img {
    max-width: 100%;
    height: auto;
    border-radius: 6px;
    margin: 1rem 0;
}

.post-content pre {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 6px;
    overflow-x: auto;
    margin: 1rem 0;
}

.post-content code {
    background: #f8f9fa;
    padding: 0.2rem 0.4rem;
    border-radius: 3px;
    font-size: 0.9em;
}
</style>
@endpush
