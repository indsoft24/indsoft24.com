@extends('admin.layouts.app')

@section('title', 'Sitemap Management')

@section('content')
<div class="dashboard-header">
    <h1><i class="fas fa-sitemap"></i> Sitemap Management</h1>
    <p>Manage and monitor your website sitemaps for search engine optimization.</p>
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
                    <h3>{{ number_format($stats['total_posts']) }}</h3>
                    <p>Published Posts</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-info">
            <div class="card-body">
                <div class="stats-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ number_format($stats['total_pages']) }}</h3>
                    <p>CMS Pages</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-success">
            <div class="card-body">
                <div class="stats-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ number_format($stats['total_states']) }}</h3>
                    <p>States</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-warning">
            <div class="card-body">
                <div class="stats-icon">
                    <i class="fas fa-city"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ number_format($stats['total_cities']) }}</h3>
                    <p>Cities</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Actions Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-cog"></i> Sitemap Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-3">Cache Management</h6>
                        <p class="text-muted">Clear sitemap cache to regenerate sitemaps with latest content.</p>
                        <form action="{{ route('admin.sitemap.clearCache') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to clear the sitemap cache?')">
                                <i class="fas fa-trash-alt"></i> Clear Cache
                            </button>
                        </form>
                        <a href="{{ $sitemapUrls['index'] }}" target="_blank" class="btn btn-primary ms-2">
                            <i class="fas fa-external-link-alt"></i> View Main Sitemap
                        </a>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-3">Cache Status</h6>
                        <div class="cache-status">
                            <div class="mb-2">
                                <span class="badge {{ $cacheStatus['index'] ? 'bg-success' : 'bg-secondary' }}">
                                    Index: {{ $cacheStatus['index'] ? 'Cached' : 'Not Cached' }}
                                </span>
                            </div>
                            <div class="mb-2">
                                <span class="badge {{ $cacheStatus['static'] ? 'bg-success' : 'bg-secondary' }}">
                                    Static: {{ $cacheStatus['static'] ? 'Cached' : 'Not Cached' }}
                                </span>
                            </div>
                            <div class="mb-2">
                                <span class="badge {{ $cacheStatus['states'] ? 'bg-success' : 'bg-secondary' }}">
                                    States: {{ $cacheStatus['states'] ? 'Cached' : 'Not Cached' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sitemap URLs -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-list"></i> Sitemap URLs</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sitemap Type</th>
                                <th>URL</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Main Sitemap Index</strong></td>
                                <td>
                                    <code>{{ $sitemapUrls['index'] }}</code>
                                    <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('{{ $sitemapUrls['index'] }}')">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </td>
                                <td>
                                    <span class="badge {{ $cacheStatus['index'] ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $cacheStatus['index'] ? 'Cached' : 'Not Cached' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ $sitemapUrls['index'] }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('admin.sitemap.preview', ['type' => 'index']) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-code"></i> Preview
                                    </a>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><strong>Static Pages</strong></td>
                                <td>
                                    <code>{{ $sitemapUrls['static'] }}</code>
                                    <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('{{ $sitemapUrls['static'] }}')">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </td>
                                <td>
                                    <span class="badge {{ $cacheStatus['static'] ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $cacheStatus['static'] ? 'Cached' : 'Not Cached' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ $sitemapUrls['static'] }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('admin.sitemap.preview', ['type' => 'static']) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-code"></i> Preview
                                    </a>
                                </td>
                            </tr>

                            @if($stats['total_posts'] > 0)
                                <tr>
                                    <td><strong>Blog Posts</strong> <span class="badge bg-info">{{ $sitemapCounts['posts'] }} file(s)</span></td>
                                    <td>
                                        @for($i = 1; $i <= $sitemapCounts['posts']; $i++)
                                            <div class="mb-2">
                                                <code>{{ $sitemapUrls['posts_' . $i] }}</code>
                                                <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('{{ $sitemapUrls['posts_' . $i] }}')">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </div>
                                        @endfor
                                    </td>
                                    <td><span class="badge bg-info">Active</span></td>
                                    <td>
                                        <a href="{{ $sitemapUrls['posts_1'] }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endif

                            @if($stats['total_pages'] > 0)
                                <tr>
                                    <td><strong>CMS Pages</strong> <span class="badge bg-info">{{ $sitemapCounts['pages'] }} file(s)</span></td>
                                    <td>
                                        @for($i = 1; $i <= $sitemapCounts['pages']; $i++)
                                            <div class="mb-2">
                                                <code>{{ $sitemapUrls['pages_' . $i] }}</code>
                                                <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('{{ $sitemapUrls['pages_' . $i] }}')">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </div>
                                        @endfor
                                    </td>
                                    <td><span class="badge bg-info">Active</span></td>
                                    <td>
                                        <a href="{{ $sitemapUrls['pages_1'] }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endif

                            <tr>
                                <td><strong>States</strong></td>
                                <td>
                                    <code>{{ $sitemapUrls['states'] }}</code>
                                    <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('{{ $sitemapUrls['states'] }}')">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </td>
                                <td>
                                    <span class="badge {{ $cacheStatus['states'] ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $cacheStatus['states'] ? 'Cached' : 'Not Cached' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ $sitemapUrls['states'] }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('admin.sitemap.preview', ['type' => 'states']) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-code"></i> Preview
                                    </a>
                                </td>
                            </tr>

                            @if($stats['total_cities'] > 0)
                                <tr>
                                    <td><strong>Cities</strong> <span class="badge bg-info">{{ $sitemapCounts['cities'] }} file(s)</span></td>
                                    <td>
                                        @for($i = 1; $i <= $sitemapCounts['cities']; $i++)
                                            <div class="mb-2">
                                                <code>{{ $sitemapUrls['cities_' . $i] }}</code>
                                                <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('{{ $sitemapUrls['cities_' . $i] }}')">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </div>
                                        @endfor
                                    </td>
                                    <td><span class="badge bg-info">Active</span></td>
                                    <td>
                                        <a href="{{ $sitemapUrls['cities_1'] }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endif

                            @if($stats['total_areas'] > 0)
                                <tr>
                                    <td><strong>Areas</strong> <span class="badge bg-info">{{ $sitemapCounts['areas'] }} file(s)</span></td>
                                    <td>
                                        @for($i = 1; $i <= $sitemapCounts['areas']; $i++)
                                            <div class="mb-2">
                                                <code>{{ $sitemapUrls['areas_' . $i] }}</code>
                                                <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('{{ $sitemapUrls['areas_' . $i] }}')">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </div>
                                        @endfor
                                    </td>
                                    <td><span class="badge bg-info">Active</span></td>
                                    <td>
                                        <a href="{{ $sitemapUrls['areas_1'] }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endif

                            @if($stats['total_categories'] > 0)
                                <tr>
                                    <td><strong>Categories</strong></td>
                                    <td>
                                        <code>{{ $sitemapUrls['categories'] }}</code>
                                        <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('{{ $sitemapUrls['categories'] }}')">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <span class="badge {{ $cacheStatus['categories'] ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $cacheStatus['categories'] ? 'Cached' : 'Not Cached' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ $sitemapUrls['categories'] }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endif

                            @if($stats['total_tags'] > 0)
                                <tr>
                                    <td><strong>Tags</strong></td>
                                    <td>
                                        <code>{{ $sitemapUrls['tags'] }}</code>
                                        <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('{{ $sitemapUrls['tags'] }}')">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <span class="badge {{ $cacheStatus['tags'] ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $cacheStatus['tags'] ? 'Cached' : 'Not Cached' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ $sitemapUrls['tags'] }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endif

                            @if($stats['total_projects'] > 0)
                                <tr>
                                    <td><strong>Projects</strong></td>
                                    <td>
                                        <code>{{ $sitemapUrls['projects'] }}</code>
                                        <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('{{ $sitemapUrls['projects'] }}')">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <span class="badge {{ $cacheStatus['projects'] ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $cacheStatus['projects'] ? 'Cached' : 'Not Cached' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ $sitemapUrls['projects'] }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SEO Information -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-info-circle"></i> SEO Information</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h6><i class="fas fa-lightbulb"></i> How to Submit Your Sitemap</h6>
                    <ol class="mb-0">
                        <li>Copy the main sitemap URL: <code>{{ $sitemapUrls['index'] }}</code></li>
                        <li>Go to <a href="https://search.google.com/search-console" target="_blank">Google Search Console</a></li>
                        <li>Select your property</li>
                        <li>Navigate to <strong>Sitemaps</strong> in the left menu</li>
                        <li>Enter <code>sitemap.xml</code> and click <strong>Submit</strong></li>
                    </ol>
                </div>
                <div class="alert alert-warning">
                    <h6><i class="fas fa-exclamation-triangle"></i> Important Notes</h6>
                    <ul class="mb-0">
                        <li>Sitemaps are automatically cached for 24 hours for performance</li>
                        <li>Clear cache after adding new content to regenerate sitemaps immediately</li>
                        <li>Large sitemaps are automatically split into multiple files (max 50,000 URLs per file)</li>
                        <li>All sitemaps are dynamically generated - no manual file management needed</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const btn = event.target.closest('button');
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i>';
        btn.classList.add('btn-success');
        btn.classList.remove('btn-outline-secondary');
        
        setTimeout(function() {
            btn.innerHTML = originalHtml;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-secondary');
        }, 2000);
    }, function(err) {
        alert('Failed to copy: ' + err);
    });
}
</script>
@endpush
@endsection

