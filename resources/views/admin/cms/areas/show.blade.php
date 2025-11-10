@extends('admin.layouts.app')

@section('title', 'Area Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Area Details: {{ $area->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.areas.edit', $area) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.areas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Areas
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Name:</th>
                                    <td>{{ $area->name }}</td>
                                </tr>
                                <tr>
                                    <th>Address:</th>
                                    <td>{{ $area->address }}</td>
                                </tr>
                                <tr>
                                    <th>City:</th>
                                    <td><span class="badge bg-info">{{ $area->city }}</span></td>
                                </tr>
                                <tr>
                                    <th>State:</th>
                                    <td><span class="badge bg-primary">{{ $area->state }}</span></td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if($area->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created:</th>
                                    <td>{{ $area->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated:</th>
                                    <td>{{ $area->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                                @if($area->types)
                                    <tr>
                                        <th>Types:</th>
                                        <td>{{ $area->types }}</td>
                                    </tr>
                                @endif
                                @if($area->latitude && $area->longitude)
                                    <tr>
                                        <th>Coordinates:</th>
                                        <td>{{ $area->latitude }}, {{ $area->longitude }}</td>
                                    </tr>
                                @endif
                                @if($area->meta_title)
                                    <tr>
                                        <th>Meta Title:</th>
                                        <td>{{ $area->meta_title }}</td>
                                    </tr>
                                @endif
                                @if($area->meta_description)
                                    <tr>
                                        <th>Meta Description:</th>
                                        <td>{{ $area->meta_description }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Statistics</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <h4 class="text-success">{{ $area->pages->count() }}</h4>
                                            <small class="text-muted">Pages</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($area->pages->count() > 0)
                        <hr>
                        <h5>Pages in {{ $area->name }}</h5>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Views</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($area->pages as $page)
                                        <tr>
                                            <td>{{ $page->title }}</td>
                                            <td><span class="badge bg-info">{{ ucfirst($page->page_type) }}</span></td>
                                            <td>
                                                @if($page->status === 'published')
                                                    <span class="badge bg-success">Published</span>
                                                @elseif($page->status === 'draft')
                                                    <span class="badge bg-warning text-dark">Draft</span>
                                                @else
                                                    <span class="badge bg-secondary">Archived</span>
                                                @endif
                                            </td>
                                            <td><span class="badge bg-primary">{{ $page->views_count }}</span></td>
                                            <td>{{ $page->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.pages.show', $page) }}" 
                                                   class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
