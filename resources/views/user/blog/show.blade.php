@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">{{ $post->title }}</h2>
                        <div>
                            <span class="badge bg-{{ $post->status === 'published' ? 'success' : 'warning' }} fs-6">
                                {{ ucfirst($post->status) }}
                            </span>
                        </div>
                    </div>
                </div>
                
                @if($post->featured_image)
                    <img src="{{ asset($post->featured_image) }}" class="card-img-top" alt="{{ $post->title }}" style="max-height: 400px; object-fit: cover;">
                @endif
                
                <div class="card-body p-4">
                    <div class="mb-4">
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            @if($post->category)
                                <span class="badge bg-info fs-6">
                                    <i class="fas fa-folder me-1"></i>{{ $post->category->name }}
                                </span>
                            @endif
                            
                            @if($post->tags->count() > 0)
                                @foreach($post->tags as $tag)
                                    <span class="badge bg-secondary fs-6">
                                        <i class="fas fa-tag me-1"></i>{{ $tag->name }}
                                    </span>
                                @endforeach
                            @endif
                        </div>
                        
                        <div class="text-muted mb-3">
                            <i class="fas fa-calendar me-1"></i>
                            Created: {{ $post->created_at->format('F d, Y \a\t g:i A') }}
                            @if($post->updated_at != $post->created_at)
                                <br><i class="fas fa-edit me-1"></i>
                                Updated: {{ $post->updated_at->format('F d, Y \a\t g:i A') }}
                            @endif
                        </div>
                    </div>

                    @if($post->excerpt)
                        <div class="alert alert-light border-start border-primary border-4 mb-4">
                            <h5 class="alert-heading">
                                <i class="fas fa-quote-left me-2"></i>Excerpt
                            </h5>
                            <p class="mb-0">{{ $post->excerpt }}</p>
                        </div>
                    @endif

                    <div class="post-content">
                        <h5 class="mb-3">
                            <i class="fas fa-file-text me-2"></i>Content
                        </h5>
                        <div class="content-text">
                            {!! nl2br(e($post->content)) !!}
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                <i class="fas fa-user me-1"></i>
                                Author: {{ $post->user->name }}
                            </small>
                        </div>
                        
                        <div class="btn-group" role="group">
                            <a href="{{ route('user.blog.edit', $post) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            
                            <button type="button" class="btn btn-outline-danger" onclick="deletePost({{ $post->id }}, '{{ route('user.blog.destroy', $post) }}')">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('user.blog.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to All Posts
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.content-text {
    line-height: 1.8;
    font-size: 1.1rem;
}

.content-text p {
    margin-bottom: 1rem;
}
</style>

<script>
function deletePost(postId, deleteUrl) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create form data
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            formData.append('_method', 'DELETE');
            
            fetch(deleteUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire(data.alert).then(() => {
                        window.location.href = data.redirect;
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'Something went wrong. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        }
    });
}
</script>
@endsection
