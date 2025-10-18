@extends('admin.layouts.app')

@section('title', 'Edit Post: ' . $post->title)

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-edit"></i> Edit Post</h1>
            <p class="text-muted">Update and modify your blog post content.</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-outline-primary"><i class="fas fa-eye"></i> View Post</a>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to Posts</a>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-heading"></i> Post Title</h5></div>
                <div class="card-body">
                    <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" name="title" value="{{ old('title', $post->title) }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-edit"></i> Post Content</h5></div>
                <div class="card-body">
                    <x-tinymce-editor :content="$post->content" />
                    @error('content')<div class="text-danger mt-2 small">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-quote-left"></i> Excerpt</h5></div>
                <div class="card-body">
                    <textarea class="form-control @error('excerpt') is-invalid @enderror" name="excerpt" rows="4">{{ old('excerpt', $post->excerpt) }}</textarea>
                    @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-cog"></i> Publish Settings</h5></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status" required>
                            <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Featured Post</label>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Post</button>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-folder"></i> Category</h5></div>
                <div class="card-body">
                    <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-tags"></i> Tags</h5></div>
                <div class="card-body">
                    <p class="text-muted small">Type a new tag and press Enter, or select from existing tags below.</p>
                    <input type="text" class="form-control tag-input mb-2" placeholder="Create new tags...">
                    <div class="tag-container mb-3">
                        @foreach($post->tags as $tag)
                            <span class="badge bg-primary me-2 mb-2">
                                {{ $tag->name }}
                                <input type="hidden" name="tags[]" value="{{ $tag->name }}">
                                <button type="button" class="btn-close btn-close-white ms-2" onclick="this.parentElement.remove()"></button>
                            </span>
                        @endforeach
                    </div>
                    <h6 class="text-muted">Available Tags</h6>
                    <div class="available-tags">
                        @foreach($tags as $tag)
                            <span class="badge bg-secondary m-1" style="cursor: pointer;" onclick="addTagFromList(this)">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-image"></i> Featured Image</h5></div>
                <div class="card-body">
                    @if($post->featured_image)
                    <div class="mb-3"><img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" class="img-fluid rounded mb-2" style="max-height: 150px;"></div>
                    @endif
                    <input type="file" class="form-control" name="featured_image" accept="image/*">
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0"><i class="fas fa-search"></i> SEO Settings</h5></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ old('meta_title', $post->meta_title) }}">
                    </div>
                    <div>
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control" name="meta_description" id="meta_description" rows="3">{{ old('meta_description', $post->meta_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
{{-- This script is nearly identical to the create page's script --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('input[name="title"]').addEventListener('input', function() {
        document.getElementById('meta_title').value = this.value;
    });

    document.querySelector('.tag-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addTag(this.value);
            this.value = '';
        }
    });
});

function addTag(tagName) {
    tagName = tagName.trim();
    if (!tagName) return;
    const existingTags = document.querySelectorAll('.tag-container input');
    for (let input of existingTags) {
        if (input.value.toLowerCase() === tagName.toLowerCase()) return;
    }
    const tagContainer = document.querySelector('.tag-container');
    const tagElement = document.createElement('span');
    tagElement.className = 'badge bg-primary me-2 mb-2';
    tagElement.innerHTML = `
        ${tagName}
        <input type="hidden" name="tags[]" value="${tagName}">
        <button type="button" class="btn-close btn-close-white ms-2" onclick="this.parentElement.remove()"></button>
    `;
    tagContainer.appendChild(tagElement);
}

function addTagFromList(element) {
    const tagName = element.textContent.trim();
    addTag(tagName);
}
</script>
@endpush