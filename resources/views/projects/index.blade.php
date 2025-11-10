@extends('layouts.app')

@section('title', 'Our Projects - Portfolio')

@section('content')
<section class="projects-page py-5" style="margin-top: 70px;">
    <div class="container">
        <div class="section-header text-center mb-5">
            <div class="section-badge">
                <i class="fas fa-project-diagram"></i>
                <span>Our Portfolio</span>
            </div>
            <h2 class="section-title">Featured <span class="gradient-text">Projects</span></h2>
            <p class="section-subtitle">
                Explore our portfolio of innovative projects that showcase our expertise and creativity
            </p>
        </div>

        <!-- Filters -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form method="GET" action="{{ route('projects.index') }}" class="row g-3">
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Search projects...">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Projects Grid -->
        @if($projects->count() > 0)
            <div class="row g-4 mb-5">
                @foreach($projects as $project)
                    <div class="col-lg-4 col-md-6">
                        <div class="project-card h-100">
                            <a href="{{ route('projects.show', $project) }}" class="project-link">
                                <div class="project-image-wrapper">
                                    @if($project->featured_image)
                                        <img src="{{ asset($project->featured_image) }}" 
                                             alt="{{ $project->name }}" 
                                             class="project-image">
                                    @else
                                        <div class="project-image-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                    <div class="project-overlay">
                                        <span class="btn btn-light btn-sm">
                                            <i class="fas fa-eye me-2"></i>View Details
                                        </span>
                                    </div>
                                    @if($project->is_featured)
                                        <span class="project-badge">
                                            <i class="fas fa-star"></i> Featured
                                        </span>
                                    @endif
                                </div>
                                <div class="project-content">
                                    <h4 class="project-title">{{ $project->name }}</h4>
                                    <p class="project-description">
                                        {{ Str::limit($project->description ?? 'No description available', 100) }}
                                    </p>
                                    @if($project->techStacks->count() > 0)
                                        <div class="project-tech">
                                            @foreach($project->techStacks->take(3) as $tech)
                                                <span class="tech-badge" style="background-color: {{ $tech->color ?? '#6c757d' }}">
                                                    {{ $tech->name }}
                                                </span>
                                            @endforeach
                                            @if($project->techStacks->count() > 3)
                                                <span class="tech-badge bg-secondary">
                                                    +{{ $project->techStacks->count() - 3 }} more
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                    @if($project->live_url || $project->github_url)
                                        <div class="project-links mt-3">
                                            @if($project->live_url)
                                                <a href="{{ $project->live_url }}" 
                                                   target="_blank" 
                                                   class="btn btn-sm btn-outline-primary"
                                                   onclick="event.stopPropagation();">
                                                    <i class="fas fa-external-link-alt"></i> Live
                                                </a>
                                            @endif
                                            @if($project->github_url)
                                                <a href="{{ $project->github_url }}" 
                                                   target="_blank" 
                                                   class="btn btn-sm btn-outline-dark"
                                                   onclick="event.stopPropagation();">
                                                    <i class="fab fa-github"></i> Code
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $projects->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-project-diagram fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No projects found</h5>
                <p class="text-muted">Check back later for our amazing projects!</p>
            </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
.projects-page {
    background: #f8f9fa;
    min-height: calc(100vh - 70px);
}

.project-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.project-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.project-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

.project-image-wrapper {
    position: relative;
    width: 100%;
    height: 250px;
    overflow: hidden;
}

.project-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.project-card:hover .project-image {
    transform: scale(1.1);
}

.project-image-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
}

.project-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.project-card:hover .project-overlay {
    opacity: 1;
}

.project-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #ffc107;
    color: #000;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.project-content {
    padding: 1.5rem;
}

.project-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: #2c3e50;
}

.project-description {
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.project-tech {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.tech-badge {
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
    color: white;
}

.project-links {
    display: flex;
    gap: 0.5rem;
}
</style>
@endpush

