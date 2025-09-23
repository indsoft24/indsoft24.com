@extends('layouts.app')

@section('title', 'My Blog Posts')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="display-4 fw-bold text-primary">
                    <i class="fas fa-blog me-3"></i>My Blog Posts
                </h1>
                <a href="{{ route('user.blog.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-2"></i>Create New Post
                </a>
            </div>

            <!-- Success messages are now handled by SweetAlert -->

            @if($posts->count() > 0)
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if($post->featured_image)
                                    <img src="{{ asset($post->featured_image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="fas fa-image text-muted fa-3x"></i>
                                    </div>
                                @endif
                                
                                <div class="card-body d-flex flex-column">
                                    <div class="mb-2">
                                        <span class="badge bg-{{ $post->status === 'published' ? 'success' : 'warning' }}">
                                            {{ ucfirst($post->status) }}
                                        </span>
                                        @if($post->category)
                                            <span class="badge bg-info ms-1">{{ $post->category->name }}</span>
                                        @endif
                                    </div>
                                    
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    
                                    @if($post->excerpt)
                                        <p class="card-text text-muted">{{ Str::limit($post->excerpt, 100) }}</p>
                                    @endif
                                    
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ $post->created_at->format('M d, Y') }}
                                            </small>
                                            
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('user.blog.show', $post) }}" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('user.blog.edit', $post) }}" class="btn btn-outline-secondary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="deletePost({{ $post->id }}, '{{ route('user.blog.destroy', $post) }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-blog text-muted fa-5x mb-4"></i>
                    <h3 class="text-muted">No posts yet</h3>
                    <p class="text-muted mb-4">Start writing your first blog post!</p>
                    <a href="{{ route('user.blog.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i>Create Your First Post
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

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
