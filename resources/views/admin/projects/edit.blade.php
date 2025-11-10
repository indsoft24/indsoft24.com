@extends('admin.layouts.app')

@section('title', 'Edit Project: ' . $project->name)

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-edit"></i> Edit Project</h1>
            <p class="text-muted">Update and modify your project details.</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-outline-primary"><i class="fas fa-eye"></i> View Project</a>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to Projects</a>
        </div>
    </div>
</div>

<form id="editProjectForm" method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-lg-8">
            <!-- Basic Information -->
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-info-circle"></i> Basic Information</h5></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Project Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               name="name" id="name" value="{{ old('name', $project->name) }}" 
                               placeholder="Enter project name..." required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Short Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  name="description" id="description" rows="3" 
                                  placeholder="Brief description of the project...">{{ old('description', $project->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted">A concise summary (max 500 characters).</small>
                    </div>

                    <div class="mb-3">
                        <label for="full_description" class="form-label">Full Description</label>
                        <textarea class="form-control @error('full_description') is-invalid @enderror" 
                                  name="full_description" id="full_description" rows="8" 
                                  placeholder="Detailed description of the project, features, challenges, solutions...">{{ old('full_description', $project->full_description) }}</textarea>
                        @error('full_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted">Detailed information about the project.</small>
                    </div>
                </div>
            </div>

            <!-- Links -->
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-link"></i> Project Links</h5></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="live_url" class="form-label">Live URL</label>
                        <input type="url" class="form-control @error('live_url') is-invalid @enderror" 
                               name="live_url" id="live_url" value="{{ old('live_url', $project->live_url) }}" 
                               placeholder="https://example.com">
                        @error('live_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="github_url" class="form-label">GitHub URL</label>
                        <input type="url" class="form-control @error('github_url') is-invalid @enderror" 
                               name="github_url" id="github_url" value="{{ old('github_url', $project->github_url) }}" 
                               placeholder="https://github.com/user/repo">
                        @error('github_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <!-- Project Details -->
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-calendar"></i> Project Details</h5></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="client_name" class="form-label">Client Name</label>
                            <input type="text" class="form-control @error('client_name') is-invalid @enderror" 
                                   name="client_name" id="client_name" value="{{ old('client_name', $project->client_name) }}" 
                                   placeholder="Client or company name">
                            @error('client_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                   name="sort_order" id="sort_order" value="{{ old('sort_order', $project->sort_order) }}" 
                                   min="0">
                            @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Lower numbers appear first.</small>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                   name="start_date" id="start_date" value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}">
                            @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                   name="end_date" id="end_date" value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}">
                            @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Screenshots -->
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-images"></i> Project Screenshots</h5></div>
                <div class="card-body">
                    @if($project->screenshots->count() > 0)
                        <h6 class="mb-3">Existing Screenshots</h6>
                        @foreach($project->screenshots as $screenshot)
                            <div class="existing-screenshot mb-3 p-3 border rounded">
                                <div class="d-flex align-items-start">
                                    <img src="{{ asset($screenshot->image_path) }}" class="img-thumbnail me-3" style="max-width: 150px; max-height: 100px;">
                                    <div class="flex-grow-1">
                                        <h6>{{ $screenshot->title ?? 'Screenshot' }}</h6>
                                        <p class="small text-muted">{{ $screenshot->description }}</p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remove_screenshots[]" value="{{ $screenshot->id }}" id="remove_screenshot_{{ $screenshot->id }}">
                                            <label class="form-check-label text-danger" for="remove_screenshot_{{ $screenshot->id }}">
                                                Remove this screenshot
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <hr>
                    @endif
                    
                    <h6 class="mb-3">Add New Screenshots</h6>
                    <div id="screenshots-container">
                        <div class="screenshot-item mb-3 p-3 border rounded">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Screenshot Image</label>
                                    <input type="file" class="form-control screenshot-file" name="screenshots[]" accept="image/*">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="screenshot_titles[]" placeholder="Screenshot title">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="screenshot_descriptions[]" rows="2" placeholder="Screenshot description"></textarea>
                            </div>
                            <button type="button" class="btn btn-sm btn-danger remove-screenshot" onclick="removeScreenshot(this)">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="addScreenshot()">
                        <i class="fas fa-plus"></i> Add Screenshot
                    </button>
                    <small class="text-muted d-block mt-2">Upload multiple screenshots to showcase your project.</small>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Publish Settings -->
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-cog"></i> Publish Settings</h5></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" name="status" id="status" required>
                            <option value="draft" {{ old('status', $project->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $project->status) === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $project->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Featured Project</label>
                    </div>
                    @if($project->featured_image)
                        <div class="mb-3">
                            <label class="form-label">Current Featured Image</label>
                            <div>
                                <img src="{{ asset($project->featured_image) }}" class="img-fluid rounded" style="max-height: 150px;">
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                                <label class="form-check-label text-danger" for="remove_image">Remove current image</label>
                            </div>
                        </div>
                    @endif
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Project
                        </button>
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </div>
            </div>

            <!-- Featured Image -->
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-image"></i> Featured Image</h5></div>
                <div class="card-body">
                    <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                           name="featured_image" id="featured_image" accept="image/*">
                    @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div id="featured-image-preview" class="mt-3"></div>
                    <small class="text-muted">Recommended size: 1200x800px</small>
                </div>
            </div>

            <!-- Tech Stack -->
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-code"></i> Tech Stack</h5></div>
                <div class="card-body">
                    @if($techStacks->count() > 0)
                        <div class="tech-stack-list" style="max-height: 300px; overflow-y: auto;">
                            @foreach($techStacks as $tech)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="tech_stacks[]" 
                                           value="{{ $tech->id }}" id="tech_{{ $tech->id }}"
                                           {{ in_array($tech->id, old('tech_stacks', $project->techStacks->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tech_{{ $tech->id }}">
                                        <span class="badge" style="background-color: {{ $tech->color ?? '#6c757d' }}">
                                            {{ $tech->name }}
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted small">No tech stacks available. Create tech stacks first.</p>
                    @endif
                </div>
            </div>

            <!-- Developers -->
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-users"></i> Developers</h5></div>
                <div class="card-body">
                    <div id="developers-container">
                        @if($project->developers->count() > 0)
                            @foreach($project->developers as $index => $developer)
                                <div class="developer-item mb-3">
                                    <div class="mb-2">
                                        <select class="form-select developer-select" name="developers[]" onchange="updateDeveloperRole(this)">
                                            <option value="">Select Developer</option>
                                            @foreach($developers as $dev)
                                                <option value="{{ $dev->id }}" {{ $developer->id == $dev->id ? 'selected' : '' }}>
                                                    {{ $dev->name }} ({{ $dev->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <input type="text" class="form-control form-control-sm" name="developer_roles[]" 
                                               value="{{ $developer->pivot->role }}" placeholder="Role (e.g., Lead Developer)">
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="removeDeveloper(this)">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="developer-item mb-3">
                                <div class="mb-2">
                                    <select class="form-select developer-select" name="developers[]" onchange="updateDeveloperRole(this)">
                                        <option value="">Select Developer</option>
                                        @foreach($developers as $developer)
                                            <option value="{{ $developer->id }}">{{ $developer->name }} ({{ $developer->email }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <input type="text" class="form-control form-control-sm" name="developer_roles[]" placeholder="Role (e.g., Lead Developer)">
                                </div>
                                <button type="button" class="btn btn-sm btn-danger" onclick="removeDeveloper(this)">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="addDeveloper()">
                        <i class="fas fa-plus"></i> Add Developer
                    </button>
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-search"></i> SEO Settings</h5></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title" id="meta_title" 
                               value="{{ old('meta_title', $project->meta_title) }}" placeholder="SEO title">
                    </div>
                    <div>
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control" name="meta_description" id="meta_description" 
                                  rows="3" placeholder="SEO description">{{ old('meta_description', $project->meta_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('styles')
<style>
.screenshot-item {
    background: #f8f9fa;
}
.developer-item {
    padding: 10px;
    background: #f8f9fa;
    border-radius: 4px;
}
</style>
@endpush

@push('scripts')
<script>
let screenshotIndex = 0;
let developerIndex = 0;

// Featured image preview
document.getElementById('featured_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('featured-image-preview');
            preview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded" style="max-height: 200px;">`;
        };
        reader.readAsDataURL(file);
    }
});

// Add screenshot
function addScreenshot() {
    screenshotIndex++;
    const container = document.getElementById('screenshots-container');
    const newItem = document.createElement('div');
    newItem.className = 'screenshot-item mb-3 p-3 border rounded';
    newItem.innerHTML = `
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Screenshot Image</label>
                <input type="file" class="form-control screenshot-file" name="screenshots[]" accept="image/*">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="screenshot_titles[]" placeholder="Screenshot title">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="screenshot_descriptions[]" rows="2" placeholder="Screenshot description"></textarea>
        </div>
        <button type="button" class="btn btn-sm btn-danger remove-screenshot" onclick="removeScreenshot(this)">
            <i class="fas fa-trash"></i> Remove
        </button>
    `;
    container.appendChild(newItem);
}

// Remove screenshot
function removeScreenshot(button) {
    if (document.querySelectorAll('.screenshot-item').length > 1) {
        button.closest('.screenshot-item').remove();
    } else {
        alert('At least one screenshot item is required.');
    }
}

// Add developer
function addDeveloper() {
    developerIndex++;
    const container = document.getElementById('developers-container');
    const newItem = document.createElement('div');
    newItem.className = 'developer-item mb-3';
    newItem.innerHTML = `
        <div class="mb-2">
            <select class="form-select developer-select" name="developers[]" onchange="updateDeveloperRole(this)">
                <option value="">Select Developer</option>
                @foreach($developers as $developer)
                    <option value="{{ $developer->id }}">{{ $developer->name }} ({{ $developer->email }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <input type="text" class="form-control form-control-sm" name="developer_roles[]" placeholder="Role (e.g., Lead Developer)">
        </div>
        <button type="button" class="btn btn-sm btn-danger" onclick="removeDeveloper(this)">
            <i class="fas fa-trash"></i> Remove
        </button>
    `;
    container.appendChild(newItem);
}

// Remove developer
function removeDeveloper(button) {
    if (document.querySelectorAll('.developer-item').length > 1) {
        button.closest('.developer-item').remove();
    } else {
        alert('At least one developer is required.');
    }
}

function updateDeveloperRole(select) {
    // You can add additional logic here if needed
}

// Featured image preview for new upload
document.getElementById('featured_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('featured-image-preview');
            if (preview) {
                preview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded mt-2" style="max-height: 200px;">`;
            }
        };
        reader.readAsDataURL(file);
    }
});

// Auto-generate meta title from project name
document.getElementById('name').addEventListener('input', function() {
    document.getElementById('meta_title').value = this.value;
});
</script>
@endpush

