@extends('admin.layouts.app')

@section('title', 'State Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">State Details: {{ $state->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.states.edit', $state) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.states.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to States
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Name:</th>
                                    <td>{{ $state->name }}</td>
                                </tr>
                                <tr>
                                    <th>Code:</th>
                                    <td><span class="badge bg-secondary">{{ $state->code }}</span></td>
                                </tr>
                                <tr>
                                    <th>Slug:</th>
                                    <td><code>{{ $state->slug }}</code></td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if($state->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created:</th>
                                    <td>{{ $state->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated:</th>
                                    <td>{{ $state->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                                @if($state->description)
                                    <tr>
                                        <th>Description:</th>
                                        <td>{{ $state->description }}</td>
                                    </tr>
                                @endif
                                @if($state->meta_title)
                                    <tr>
                                        <th>Meta Title:</th>
                                        <td>{{ $state->meta_title }}</td>
                                    </tr>
                                @endif
                                @if($state->meta_description)
                                    <tr>
                                        <th>Meta Description:</th>
                                        <td>{{ $state->meta_description }}</td>
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
                                        <div class="col-6">
                                            <div class="border-end">
                                                <h4 class="text-primary">{{ $state->cities->count() }}</h4>
                                                <small class="text-muted">Cities</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h4 class="text-success">{{ $state->pages->count() }}</h4>
                                            <small class="text-muted">Pages</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($state->cities->count() > 0)
                        <hr>
                        <h5>Cities in {{ $state->name }}</h5>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Areas</th>
                                        <th>Pages</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($state->cities as $city)
                                        <tr>
                                            <td>{{ $city->name }}</td>
                                            <td><span class="badge bg-info">{{ $city->areas->count() }}</span></td>
                                            <td><span class="badge bg-success">{{ $city->pages->count() }}</span></td>
                                            <td>
                                                @if($city->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.cities.show', $city) }}" 
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
