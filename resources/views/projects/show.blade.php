@extends('layouts.app')

@section('title', $project->name . ' - Project Details')

@section('content')
<section class="project-detail-page">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
                <li class="breadcrumb-item active">{{ $project->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Project Header -->
                <div class="project-header mb-4">
                    @if($project->featured_image)
                        <img src="{{ asset($project->featured_image) }}" 
                             alt="{{ $project->name }}" 
                             class="img-fluid rounded mb-4"
                             style="max-height: 400px; width: 100%; object-fit: cover;">
                    @endif
                    
                    <div class="d-flex align-items-center gap-2 mb-3">
                        @if($project->is_featured)
                            <span class="badge bg-warning">
                                <i class="fas fa-star"></i> Featured
                            </span>
                        @endif
                        <span class="badge bg-success">Published</span>
                    </div>
                    
                    <h1 class="project-detail-title mb-3">{{ $project->name }}</h1>
                    
                    @if($project->description)
                        <p class="lead text-muted">{{ $project->description }}</p>
                    @endif
                </div>

                <!-- Full Description -->
                @if($project->full_description)
                    <div class="project-description-section mb-4">
                        <h3 class="mb-3">About This Project</h3>
                        <div class="text-muted" style="white-space: pre-wrap; line-height: 1.8;">
                            {{ $project->full_description }}
                        </div>
                    </div>
                @endif

                <!-- Screenshots -->
                @if($project->screenshots->count() > 0)
                    <div class="project-screenshots mb-4">
                        <h3 class="mb-3">Project Screenshots</h3>
                        <div class="row g-3">
                            @foreach($project->screenshots as $screenshot)
                                <div class="col-md-6">
                                    <div class="card shadow-sm">
                                        <img src="{{ asset($screenshot->image_path) }}" 
                                             class="card-img-top" 
                                             alt="{{ $screenshot->title ?? 'Screenshot' }}"
                                             style="max-height: 300px; object-fit: cover;">
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
                @endif

                <!-- Tech Stack -->
                @if($project->techStacks->count() > 0)
                    <div class="project-tech-section mb-4">
                        <h3 class="mb-3">Technology Stack</h3>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($project->techStacks as $tech)
                                <span class="badge px-3 py-2" style="background-color: {{ $tech->color ?? '#6c757d' }}; font-size: 0.9rem;">
                                    {{ $tech->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="project-sidebar">
                    <!-- Project Info -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Project Information</h5>
                        </div>
                        <div class="card-body">
                            <dl class="row mb-0">
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

                                <dt class="col-sm-5">Created:</dt>
                                <dd class="col-sm-7">{{ $project->created_at->format('M d, Y') }}</dd>
                            </dl>
                        </div>
                    </div>

                    <!-- Project Links -->
                    @if($project->live_url || $project->github_url)
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-dark text-white">
                                <h5 class="mb-0"><i class="fas fa-link"></i> Project Links</h5>
                            </div>
                            <div class="card-body">
                                @if($project->live_url)
                                    <a href="{{ $project->live_url }}" 
                                       target="_blank" 
                                       class="btn btn-primary w-100 mb-2">
                                        <i class="fas fa-external-link-alt me-2"></i>View Live Project
                                    </a>
                                @endif
                                @if($project->github_url)
                                    <a href="{{ $project->github_url }}" 
                                       target="_blank" 
                                       class="btn btn-dark w-100">
                                        <i class="fab fa-github me-2"></i>View on GitHub
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Team Members -->
                    @if($project->developers->count() > 0)
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0"><i class="fas fa-users"></i> Team Members</h5>
                            </div>
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

                    <!-- Back Button -->
                    <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-arrow-left me-2"></i>Back to Projects
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.project-detail-page {
    background: #f8f9fa;
    min-height: calc(100vh - 70px);
}

.project-detail-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
}

.project-sidebar .card {
    border: none;
}

.project-sidebar .card-header {
    border-radius: 8px 8px 0 0;
}

.breadcrumb {
    background: white;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>
@endpush

