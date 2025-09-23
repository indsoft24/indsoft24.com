@extends('admin.layouts.app')

@section('title', 'Edit Comment')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-edit"></i> Edit Comment</h1>
            <p class="text-muted">Update the content of this comment.</p>
        </div>
        <a href="{{ route('admin.comments.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Comments
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="alert alert-info">
            <strong>Author:</strong> {{ $comment->user->name ?? 'N/A' }} <br>
            <strong>Post:</strong> <a href="{{ route('blog.show', $comment->post->slug) }}" target="_blank">{{ $comment->post->title ?? 'N/A' }} <i class="fas fa-external-link-alt fa-xs"></i></a> <br>
            <strong>Submitted:</strong> {{ $comment->created_at->format('M d, Y H:i') }}
        </div>
        <form action="{{ route('admin.comments.update', $comment) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="body" class="form-label">Comment Text</label>
                <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="6" required>{{ old('body', $comment->body) }}</textarea>
                @error('body')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Comment
            </button>
            <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection