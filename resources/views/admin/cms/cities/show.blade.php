@extends('admin.layouts.app')

@section('title', 'City Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">City Details: {{ $city->city_name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.cities.edit', $city) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Cities
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Name:</th>
                                    <td>{{ $city->city_name }}</td>
                                </tr>
                                <tr>
                                    <th>State:</th>
                                    <td><span class="badge bg-primary">{{ $city->state->name }}</span></td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if($city->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created:</th>
                                    <td>{{ $city->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated:</th>
                                    <td>{{ $city->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                                @if($city->description)
                                    <tr>
                                        <th>Description:</th>
                                        <td>{{ $city->description }}</td>
                                    </tr>
                                @endif
                                @if($city->meta_title)
                                    <tr>
                                        <th>Meta Title:</th>
                                        <td>{{ $city->meta_title }}</td>
                                    </tr>
                                @endif
                                @if($city->meta_description)
                                    <tr>
                                        <th>Meta Description:</th>
                                        <td>{{ $city->meta_description }}</td>
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
                                                <h4 class="text-primary">{{ $city->areas->count() }}</h4>
                                                <small class="text-muted">Areas</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h4 class="text-success">{{ $city->pages->count() }}</h4>
                                            <small class="text-muted">Pages</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($city->areas->count() > 0)
                        <hr>
                        <h5>Areas in {{ $city->city_name }}</h5>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Pages</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($city->areas as $area)
                                        <tr>
                                            <td>{{ $area->name }}</td>
                                            <td>{{ $area->address }}</td>
                                            <td><span class="badge bg-success">{{ $area->pages->count() }}</span></td>
                                            <td>
                                                @if($area->status === 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.areas.show', $area) }}" 
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
