@extends('admin.layouts.app')

@section('title', 'Comments Management')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-comments"></i> Comments Management</h1>
            <p class="text-muted">Review, edit, or delete user comments.</p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-list"></i> All Comments
            <span class="badge bg-primary ms-2">{{ $comments->total() }} total</span>
        </h5>
    </div>
    <div class="card-body p-0">
        @if($comments->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="40%">Comment</th>
                            <th width="20%">Author</th>
                            <th width="25%">In Response To</th>
                            <th width="15%">Submitted On</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td>{{ Str::limit($comment->body, 100) }}</td>
                            <td>{{ $comment->user->name ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('blog.show', $comment->post->slug) }}" target="_blank" class="text-decoration-none">
                                    {{ $comment->post->title ?? 'N/A' }} <i class="fas fa-external-link-alt fa-xs"></i>
                                </a>
                            </td>
                            <td>{{ $comment->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.comments.edit', $comment) }}" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger btn-delete" data-bs-toggle="tooltip" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $comments->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-comment-slash fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No comments found.</h5>
            </div>
        @endif
    </div>
</div>
@endsection