@extends('admin.layouts.app')

@section('title', 'Posts Management')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-newspaper"></i> Posts Management</h1>
            <p class="text-muted">Manage your blog posts, create new content, and organize your articles.</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Post
        </a>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.posts.index') }}" class="row g-3">
            <div class="col-md-3">
                <label for="search" class="form-label">Search Posts</label>
                <input type="text" class="form-control" id="search" name="search" 
                       value="{{ request('search') }}" placeholder="Search by title or content...">
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="">All Status</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">&nbsp;</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Clear
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Posts Table -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-list"></i> Posts List
            <span class="badge bg-primary ms-2">{{ $posts->total() }} total</span>
        </h5>
    </div>
    <div class="card-body p-0">
        @if($posts->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">
                                <input type="checkbox" class="form-check-input select-all">
                            </th>
                            <th width="40%">Title</th>
                            <th width="15%">Category</th>
                            <th width="10%">Status</th>
                            <th width="10%">Views</th>
                            <th width="10%">Created</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input item-checkbox" value="{{ $post->id }}">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($post->featured_image)
                                        <img src="{{ asset($post->featured_image) }}" 
                                             alt="{{ $post->title }}" 
                                             class="post-thumbnail me-3">
                                    @else
                                        <div class="post-thumbnail-placeholder me-3">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-1">
                                            <a href="{{ route('admin.posts.show', $post) }}" class="text-decoration-none">
                                                {{ $post->title }}
                                            </a>
                                        </h6>
                                        <small class="text-muted">
                                            {{ Str::limit(strip_tags($post->excerpt), 80) }}
                                        </small>
                                        <div class="mt-1">
                                            @if($post->is_featured)
                                                <span class="badge bg-warning">Featured</span>
                                            @endif
                                            @foreach($post->tags->take(2) as $tag)
                                                <span class="badge" style="background-color: {{ $tag->color }}">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                            @if($post->tags->count() > 2)
                                                <span class="badge bg-secondary">+{{ $post->tags->count() - 2 }} more</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge" style="background-color: {{ $post->category->color }}">
                                    {{ $post->category->name }}
                                </span>
                            </td>
                            <td>
                                @if($post->status === 'published')
                                    <span class="badge bg-success">Published</span>
                                @elseif($post->status === 'draft')
                                    <span class="badge bg-warning">Draft</span>
                                @else
                                    <span class="badge bg-secondary">Archived</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-muted">
                                    <i class="fas fa-eye"></i> {{ number_format($post->views_count) }}
                                </span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $post->created_at->format('M d, Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.posts.show', $post) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       data-bs-toggle="tooltip" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.posts.edit', $post) }}" 
                                       class="btn btn-sm btn-outline-secondary" 
                                       data-bs-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger btn-delete" 
                                                data-bs-toggle="tooltip" title="Delete">
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
            
            <!-- Pagination -->
            <div class="card-footer">
                {{ $posts->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No posts found</h5>
                <p class="text-muted">Start creating your first blog post!</p>
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create Your First Post
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Bulk Actions -->
<div class="bulk-actions mt-3" style="display: none;">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <span class="me-3">
                    <strong class="selected-count">0</strong> posts selected
                </span>
                <div class="btn-group">
                    <button class="btn btn-outline-primary btn-sm" onclick="bulkAction('publish')">
                        <i class="fas fa-check"></i> Publish
                    </button>
                    <button class="btn btn-outline-warning btn-sm" onclick="bulkAction('draft')">
                        <i class="fas fa-edit"></i> Draft
                    </button>
                    <button class="btn btn-outline-danger btn-sm" onclick="bulkAction('delete')">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.post-thumbnail {
    width: 60px;
    height: 40px;
    object-fit: cover;
    border-radius: 4px;
}

.post-thumbnail-placeholder {
    width: 60px;
    height: 40px;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
}

.bulk-actions {
    position: sticky;
    bottom: 20px;
    z-index: 1000;
}
</style>
@endpush

@push('scripts')
<script>
function bulkAction(action) {
    const selectedIds = $('.item-checkbox:checked').map(function() {
        return $(this).val();
    }).get();
    
    if (selectedIds.length === 0) {
        alert('Please select posts to perform this action.');
        return;
    }
    
    if (confirm(`Are you sure you want to ${action} ${selectedIds.length} post(s)?`)) {
        // Implement bulk action logic here
    }
}
</script>
@endpush
