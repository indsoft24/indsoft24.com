@extends('admin.layouts.app')

@section('title', 'Page Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Page Details: {{ $page->title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Pages
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="page-content">
                                <h1 class="page-title">{{ $page->title }}</h1>
                                
                                @if($page->featured_image)
                                    <div class="page-featured-image mb-4">
                                        <img src="{{ asset($page->featured_image) }}" alt="{{ $page->title }}" class="img-fluid rounded">
                                    </div>
                                @endif

                                <div class="page-content-body">
                                    {!! $page->content !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Page Information</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="120">Title:</th>
                                            <td>{{ $page->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Slug:</th>
                                            <td><code>{{ $page->slug }}</code></td>
                                        </tr>
                                        <tr>
                                            <th>Status:</th>
                                            <td>
                                                @if($page->status === 'published')
                                                    <span class="badge bg-success">Published</span>
                                                @elseif($page->status === 'draft')
                                                    <span class="badge bg-warning text-dark">Draft</span>
                                                @else
                                                    <span class="badge bg-secondary">Archived</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Type:</th>
                                            <td><span class="badge bg-info">{{ ucfirst($page->page_type) }}</span></td>
                                        </tr>
                                        <tr>
                                            <th>Template:</th>
                                            <td><span class="badge bg-secondary">{{ ucfirst($page->template) }}</span></td>
                                        </tr>
                                        <tr>
                                            <th>Featured:</th>
                                            <td>
                                                @if($page->is_featured)
                                                    <span class="badge bg-warning text-dark">Yes</span>
                                                @else
                                                    <span class="text-muted">No</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Views:</th>
                                            <td><span class="badge bg-primary">{{ $page->views_count }}</span></td>
                                        </tr>
                                        <tr>
                                            <th>Author:</th>
                                            <td>{{ $page->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created:</th>
                                            <td>{{ $page->created_at->format('M d, Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Updated:</th>
                                            <td>{{ $page->updated_at->format('M d, Y H:i') }}</td>
                                        </tr>
                                        @if($page->published_at)
                                            <tr>
                                                <th>Published:</th>
                                                <td>{{ $page->published_at->format('M d, Y H:i') }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>

                            @if($page->state || $page->city || $page->area)
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Location</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            @if($page->state)
                                                <tr>
                                                    <th width="80">State:</th>
                                                    <td>{{ $page->state->name }}</td>
                                                </tr>
                                            @endif
                                            @if($page->city)
                                                <tr>
                                                    <th>City:</th>
                                                    <td>{{ $page->city->city_name }}</td>
                                                </tr>
                                            @endif
                                            @if($page->area)
                                                <tr>
                                                    <th>Area:</th>
                                                    <td>{{ $page->area->name }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            @endif

                            @if($page->meta_title || $page->meta_description)
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">SEO Information</h5>
                                    </div>
                                    <div class="card-body">
                                        @if($page->meta_title)
                                            <div class="mb-3">
                                                <strong>Meta Title:</strong>
                                                <p class="text-muted">{{ $page->meta_title }}</p>
                                            </div>
                                        @endif
                                        @if($page->meta_description)
                                            <div>
                                                <strong>Meta Description:</strong>
                                                <p class="text-muted">{{ $page->meta_description }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
