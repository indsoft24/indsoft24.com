@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-header">
    <h1><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
    <p>Welcome back, {{ Auth::user()->name }}! Here's what's happening with your blog.</p>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-primary">
            <div class="card-body">
                <div class="stats-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['total_posts'] }}</h3>
                    <p>Total Posts</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-success">
            <div class="card-body">
                <div class="stats-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['published_posts'] }}</h3>
                    <p>Published Posts</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-warning">
            <div class="card-body">
                <div class="stats-icon">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['draft_posts'] }}</h3>
                    <p>Draft Posts</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-info">
            <div class="card-body">
                <div class="stats-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['unread_contacts'] }}</h3>
                    <p>Unread Messages</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-danger">
            <div class="card-body">
                <div class="stats-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['total_subscribers'] }}</h3>
                    <p>Total Subscribers</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional Stats Row -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-primary">
            <div class="card-body">
                <div class="stats-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['total_leads'] }}</h3>
                    <p>Total Leads</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-warning">
            <div class="card-body">
                <div class="stats-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['new_leads'] }}</h3>
                    <p>New Leads</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-info">
            <div class="card-body">
                <div class="stats-icon">
                    <i class="fas fa-envelope-open"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['unread_leads'] }}</h3>
                    <p>Unread Leads</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-success">
            <div class="card-body">
                <div class="stats-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['converted_leads'] }}</h3>
                    <p>Converted Leads</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Posts -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-clock"></i> Recent Posts</h5>
            </div>
            <div class="card-body">
                @if($recent_posts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_posts as $post)
                                <tr>
                                    <td>
                                        <strong>{{ $post->title }}</strong>
                                        @if($post->is_featured)
                                            <span class="badge bg-warning ms-1">Featured</span>
                                        @endif
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
                                    <td>{{ $post->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">
                            View All Posts <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No posts yet</h5>
                        <p class="text-muted">Start creating your first blog post!</p>
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create Post
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions & Stats -->
    <div class="col-lg-4">
        <!-- Quick Actions -->
        <div class="card mb-4">
            <div class="card-header">
                <h5><i class="fas fa-bolt"></i> Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create New Post
                    </a>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary">
                        <i class="fas fa-folder-plus"></i> Add Category
                    </a>
                    <a href="{{ route('admin.tags.create') }}" class="btn btn-outline-primary">
                        <i class="fas fa-tag"></i> Add Tag
                    </a>
                    <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary" target="_blank">
                        <i class="fas fa-external-link-alt"></i> View Blog
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Leads -->
        <div class="card mb-4">
            <div class="card-header">
                <h5><i class="fas fa-user-plus"></i> Recent Leads</h5>
            </div>
            <div class="card-body">
                @if(isset($recent_leads) && $recent_leads->count() > 0)
                    @foreach($recent_leads as $lead)
                    <div class="recent-lead-item mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">
                                    {{ $lead->name }}
                                    @if(!$lead->is_read)
                                        <span class="badge bg-danger ms-1">New</span>
                                    @endif
                                </h6>
                                <small class="text-muted">
                                    <i class="fas fa-envelope"></i> {{ $lead->email }}
                                </small>
                                @if($lead->company)
                                    <div class="mt-1">
                                        <small class="text-muted">
                                            <i class="fas fa-building"></i> {{ $lead->company }}
                                        </small>
                                    </div>
                                @endif
                            </div>
                            <a href="{{ route('admin.leads.show', $lead) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                        <div class="mt-2">
                            <span class="badge bg-secondary">{{ ucfirst($lead->status) }}</span>
                            <small class="text-muted ms-2">
                                {{ $lead->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                    @endforeach
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.leads.index') }}" class="btn btn-sm btn-outline-primary">
                            View All Leads <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                @else
                    <div class="text-center py-3">
                        <i class="fas fa-user-plus fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">No leads yet</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Popular Posts -->
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-fire"></i> Popular Posts</h5>
            </div>
            <div class="card-body">
                @if($popular_posts->count() > 0)
                    @foreach($popular_posts as $post)
                    <div class="popular-post-item">
                        <h6>{{ $post->title }}</h6>
                        <div class="post-stats">
                            <small class="text-muted">
                                <i class="fas fa-eye"></i> {{ $post->views_count }} views
                                <span class="ms-2">
                                    <i class="fas fa-heart"></i> {{ $post->likes_count }} likes
                                </span>
                            </small>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-3">
                        <i class="fas fa-chart-line fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">No popular posts yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
