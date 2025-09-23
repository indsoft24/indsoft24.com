@extends('admin.layouts.app')

@section('title', 'Tags Management')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-tags"></i> Tags Management</h1>
            <p class="text-muted">Organize your posts with relevant keywords and tags.</p>
        </div>
        <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Tag
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-list"></i> Tags List
            <span class="badge bg-primary ms-2">{{ $tags->total() }} total</span>
        </h5>
    </div>
    <div class="card-body p-0">
        @if($tags->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="40%">Name</th>
                            <th width="35%">Slug</th>
                            <th width="15%">Post Count</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                        <tr>
                            <td>
                                <h6 class="mb-1">{{ $tag->name }}</h6>
                                 @if($tag->description)
                                    <small class="text-muted">{{ Str::limit($tag->description, 80) }}</small>
                                @endif
                            </td>
                            <td>{{ $tag->slug }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $tag->posts_count }}</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this tag?');">
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
                {{ $tags->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-tag fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No tags found</h5>
                <p class="text-muted">Start by creating your first tag!</p>
                <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create Your First Tag
                </a>
            </div>
        @endif
    </div>
</div>
@endsection