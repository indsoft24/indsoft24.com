@extends('admin.layouts.app')

@section('title', 'Create New Tag')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-tag"></i> Create New Tag</h1>
            <p class="text-muted">Add a new tag to organize your posts.</p>
        </div>
        <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Tags
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.tags.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Tag Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug <small class="text-muted">(Optional - will be auto-generated)</small></label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description <small class="text-muted">(Optional)</small></label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Tag
            </button>
            <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection