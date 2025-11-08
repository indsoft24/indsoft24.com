@extends('admin.layouts.app')

@section('title', 'View Project: ' . $project->name)

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-eye"></i> View Project</h1>
            <p class="text-muted">Review and manage this project portfolio.</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Project
            </a>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Projects
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Project Content -->
    <div class="col-lg-8">
        <!-- Project Header -->
        <div class="card mb-4">
            @if($project->featured_image)
                <img src="{{ asset($project->featured_image) }}" class="card-img-top" alt="{{ $project->name }}" style="max-height: 400px; object-fit: cover;">
            @endif
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h2 class="mb-2">{{ $project->name }}</h2>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            @if($project->status === 'published')
                                <span class="badge bg-success">Published</span>
                            @elseif($project->status === 'draft')
                                <span class="badge bg-warning">Draft</span>
                            @else
                                <span class="badge bg-secondary">Archived</span>
                            @endif
                            @if($project->is_featured)
                                <span class="badge bg-warning"><i class="fas fa-star"></i> Featured</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                @if($project->description)
                    <p class="lead">{{ $project->description }}</p>
                @endif

                @if($project->full_description)
                    <div class="mt-3">
                        <h5>Full Description</h5>
                        <div class="text-muted" style="white-space: pre-wrap;">{{ $project->full_description }}</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Project Links -->
        @if($project->live_url || $project->github_url)
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-link"></i> Project Links</h5></div>
                <div class="card-body">
                    <div class="d-flex gap-3 flex-wrap">
                        @if($project->live_url)
                            <a href="{{ $project->live_url }}" target="_blank" class="btn btn-outline-primary">
                                <i class="fas fa-external-link-alt"></i> View Live Project
                            </a>
                        @endif
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="btn btn-outline-dark">
                                <i class="fab fa-github"></i> View on GitHub
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- Tech Stack -->
        @if($project->techStacks->count() > 0)
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-code"></i> Tech Stack</h5></div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($project->techStacks as $tech)
                            <span class="badge px-3 py-2" style="background-color: {{ $tech->color ?? '#6c757d' }}; font-size: 0.9rem;">
                                {{ $tech->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Screenshots -->
        @if($project->screenshots->count() > 0)
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-images"></i> Project Screenshots</h5></div>
                <div class="card-body">
                    <div class="row g-3">
                        @foreach($project->screenshots as $screenshot)
                            <div class="col-md-6">
                                <div class="card">
                                    <img src="{{ asset($screenshot->image_path) }}" class="card-img-top" alt="{{ $screenshot->title ?? 'Screenshot' }}" style="max-height: 300px; object-fit: cover;">
                                    @if($screenshot->title || $screenshot->description)
                                        <div class="card-body">
                                            @if($screenshot->title)
                                                <h6 class="card-title">{{ $screenshot->title }}</h6>
                                            @endif
                                            @if($screenshot->description)
                                                <p class="card-text small text-muted">{{ $screenshot->description }}</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Project Details -->
        <div class="card mb-4">
            <div class="card-header"><h5 class="mb-0"><i class="fas fa-info-circle"></i> Project Details</h5></div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-5">Created By:</dt>
                    <dd class="col-sm-7">{{ $project->creator->name ?? 'N/A' }}</dd>

                    <dt class="col-sm-5">Created:</dt>
                    <dd class="col-sm-7">{{ $project->created_at->format('M d, Y') }}</dd>

                    <dt class="col-sm-5">Updated:</dt>
                    <dd class="col-sm-7">{{ $project->updated_at->format('M d, Y') }}</dd>

                    @if($project->client_name)
                        <dt class="col-sm-5">Client:</dt>
                        <dd class="col-sm-7">{{ $project->client_name }}</dd>
                    @endif

                    @if($project->start_date)
                        <dt class="col-sm-5">Start Date:</dt>
                        <dd class="col-sm-7">{{ $project->start_date->format('M d, Y') }}</dd>
                    @endif

                    @if($project->end_date)
                        <dt class="col-sm-5">End Date:</dt>
                        <dd class="col-sm-7">{{ $project->end_date->format('M d, Y') }}</dd>
                    @endif

                    <dt class="col-sm-5">Sort Order:</dt>
                    <dd class="col-sm-7">{{ $project->sort_order }}</dd>
                </dl>
            </div>
        </div>

        <!-- Developers -->
        @if($project->developers->count() > 0)
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-users"></i> Team Members</h5></div>
                <div class="card-body">
                    @foreach($project->developers as $developer)
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $developer->name }}</h6>
                                <small class="text-muted">{{ $developer->email }}</small>
                                @if($developer->pivot->role)
                                    <div class="mt-1">
                                        <span class="badge bg-secondary">{{ $developer->pivot->role }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- SEO Information -->
        @if($project->meta_title || $project->meta_description)
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-search"></i> SEO Information</h5></div>
                <div class="card-body">
                    @if($project->meta_title)
                        <div class="mb-3">
                            <label class="small text-muted">Meta Title:</label>
                            <p class="mb-0">{{ $project->meta_title }}</p>
                        </div>
                    @endif
                    @if($project->meta_description)
                        <div>
                            <label class="small text-muted">Meta Description:</label>
                            <p class="mb-0">{{ $project->meta_description }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Actions -->
        <div class="card">
            <div class="card-header"><h5 class="mb-0"><i class="fas fa-cog"></i> Actions</h5></div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Project
                    </a>
                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash"></i> Delete Project
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

