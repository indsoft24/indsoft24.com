@extends('admin.layouts.app')

@section('title', 'Projects Management')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-project-diagram"></i> Projects Management</h1>
            <p class="text-muted">Manage your projects portfolio, showcase your work professionally.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Project
        </a>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.projects.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="search" class="form-label">Search Projects</label>
                <input type="text" class="form-control" id="search" name="search" 
                       value="{{ request('search') }}" placeholder="Search by name, description, or client...">
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
                <label class="form-label">&nbsp;</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Clear
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Projects Table -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-list"></i> Projects List
            <span class="badge bg-primary ms-2">{{ $projects->total() }} total</span>
        </h5>
    </div>
    <div class="card-body p-0">
        @if($projects->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">
                                <input type="checkbox" class="form-check-input select-all">
                            </th>
                            <th width="35%">Project</th>
                            <th width="15%">Tech Stack</th>
                            <th width="10%">Developers</th>
                            <th width="10%">Status</th>
                            <th width="10%">Created</th>
                            <th width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input item-checkbox" value="{{ $project->id }}">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($project->featured_image)
                                        <img src="{{ asset($project->featured_image) }}" 
                                             alt="{{ $project->name }}" 
                                             class="project-thumbnail me-3">
                                    @else
                                        <div class="project-thumbnail-placeholder me-3">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-1">
                                            <a href="{{ route('admin.projects.show', $project) }}" class="text-decoration-none">
                                                {{ $project->name }}
                                            </a>
                                        </h6>
                                        <small class="text-muted">
                                            {{ Str::limit($project->description ?? 'No description', 60) }}
                                        </small>
                                        @if($project->client_name)
                                            <div class="mt-1">
                                                <small class="text-muted"><i class="fas fa-user"></i> {{ $project->client_name }}</small>
                                            </div>
                                        @endif
                                        @if($project->is_featured)
                                            <div class="mt-1">
                                                <span class="badge bg-warning"><i class="fas fa-star"></i> Featured</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="tech-stack-tags">
                                    @foreach($project->techStacks->take(3) as $tech)
                                        <span class="badge mb-1" style="background-color: {{ $tech->color ?? '#6c757d' }}">
                                            {{ $tech->name }}
                                        </span>
                                    @endforeach
                                    @if($project->techStacks->count() > 3)
                                        <span class="badge bg-secondary">+{{ $project->techStacks->count() - 3 }}</span>
                                    @endif
                                    @if($project->techStacks->count() === 0)
                                        <span class="text-muted small">No tech stack</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="developers-list">
                                    @if($project->developers->count() > 0)
                                        @foreach($project->developers->take(2) as $developer)
                                            <div class="mb-1">
                                                <small>
                                                    <i class="fas fa-user-circle"></i> {{ $developer->name }}
                                                    @if($developer->pivot->role)
                                                        <span class="text-muted">({{ $developer->pivot->role }})</span>
                                                    @endif
                                                </small>
                                            </div>
                                        @endforeach
                                        @if($project->developers->count() > 2)
                                            <small class="text-muted">+{{ $project->developers->count() - 2 }} more</small>
                                        @endif
                                    @else
                                        <span class="text-muted small">No developers</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($project->status === 'published')
                                    <span class="badge bg-success">Published</span>
                                @elseif($project->status === 'draft')
                                    <span class="badge bg-warning">Draft</span>
                                @else
                                    <span class="badge bg-secondary">Archived</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $project->created_at->format('M d, Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.projects.show', $project) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       data-bs-toggle="tooltip" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project) }}" 
                                       class="btn btn-sm btn-outline-secondary" 
                                       data-bs-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($project->live_url)
                                        <a href="{{ $project->live_url }}" 
                                           target="_blank"
                                           class="btn btn-sm btn-outline-info" 
                                           data-bs-toggle="tooltip" title="View Live">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    @endif
                                    <form action="{{ route('admin.projects.destroy', $project) }}" 
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
                {{ $projects->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-project-diagram fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No projects found</h5>
                <p class="text-muted">Start creating your first project portfolio!</p>
                <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create Your First Project
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
.project-thumbnail {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 4px;
}

.project-thumbnail-placeholder {
    width: 80px;
    height: 60px;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
}

.tech-stack-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Delete confirmation
    $('.btn-delete').on('click', function(e) {
        if (!confirm('Are you sure you want to delete this project? This action cannot be undone.')) {
            e.preventDefault();
        }
    });

    // Select all checkbox
    $('.select-all').on('change', function() {
        $('.item-checkbox').prop('checked', $(this).prop('checked'));
    });
});
</script>
@endpush

