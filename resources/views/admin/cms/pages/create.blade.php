@extends('admin.layouts.app')

@section('title', 'Create Page')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Page</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Pages
                        </a>
                    </div>
                </div>
                
                <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="title">Page Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="content">Content <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="excerpt">Excerpt</label>
                                    <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                              id="excerpt" name="excerpt" rows="3">{{ old('excerpt') }}</textarea>
                                    <small class="form-text text-muted">Brief description of the page content</small>
                                    @error('excerpt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Page Settings</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select class="form-control @error('status') is-invalid @enderror" 
                                                    id="status" name="status" required>
                                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="page_type">Page Type <span class="text-danger">*</span></label>
                                            <select class="form-control @error('page_type') is-invalid @enderror" 
                                                    id="page_type" name="page_type" required>
                                                <option value="general" {{ old('page_type') == 'general' ? 'selected' : '' }}>General</option>
                                                <option value="service" {{ old('page_type') == 'service' ? 'selected' : '' }}>Service</option>
                                                <option value="product" {{ old('page_type') == 'product' ? 'selected' : '' }}>Product</option>
                                                <option value="about" {{ old('page_type') == 'about' ? 'selected' : '' }}>About</option>
                                                <option value="contact" {{ old('page_type') == 'contact' ? 'selected' : '' }}>Contact</option>
                                            </select>
                                            @error('page_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="template">Template <span class="text-danger">*</span></label>
                                            <select class="form-control @error('template') is-invalid @enderror" 
                                                    id="template" name="template" required>
                                                <option value="default" {{ old('template') == 'default' ? 'selected' : '' }}>Default</option>
                                                <option value="service" {{ old('template') == 'service' ? 'selected' : '' }}>Service</option>
                                                <option value="product" {{ old('template') == 'product' ? 'selected' : '' }}>Product</option>
                                                <option value="landing" {{ old('template') == 'landing' ? 'selected' : '' }}>Landing Page</option>
                                            </select>
                                            @error('template')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" 
                                                   value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">
                                                Featured Page
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Location</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="state_id">State</label>
                                            <select class="form-control @error('state_id') is-invalid @enderror" 
                                                    id="state_id" name="state_id">
                                                <option value="">Select State</option>
                                                @foreach($states as $state)
                                                    <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>
                                                        {{ $state->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('state_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="city_id">City</label>
                                            <select class="form-control @error('city_id') is-invalid @enderror" 
                                                    id="city_id" name="city_id">
                                                <option value="">Select City (Select State First)</option>
                                                @if(old('state_id'))
                                                    @foreach($cities->where('state_id', old('state_id')) as $city)
                                                        <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                                            {{ $city->city_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small class="form-text text-muted">Select a state first to load cities</small>
                                            @error('city_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="area_id">Area</label>
                                            <select class="form-control @error('area_id') is-invalid @enderror" 
                                                    id="area_id" name="area_id">
                                                <option value="">Select Area (Select City First)</option>
                                                @if(old('city_id'))
                                                    @foreach($areas->where('city_id', old('city_id')) as $area)
                                                        <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>
                                                            {{ $area->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small class="form-text text-muted">Select a city first to load areas</small>
                                            @error('area_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Media</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="featured_image">Featured Image</label>
                                            <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                                                   id="featured_image" name="featured_image" accept="image/*">
                                            <small class="form-text text-muted">Max size: 2MB. Formats: JPEG, PNG, JPG, GIF</small>
                                            @error('featured_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">SEO Settings</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_title">Meta Title</label>
                                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                                                           id="meta_title" name="meta_title" value="{{ old('meta_title') }}">
                                                    <small class="form-text text-muted">Recommended: 50-60 characters</small>
                                                    @error('meta_title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_description">Meta Description</label>
                                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                                              id="meta_description" name="meta_description" rows="2" 
                                                              maxlength="500">{{ old('meta_description') }}</textarea>
                                                    <small class="form-text text-muted">Recommended: 150-160 characters</small>
                                                    @error('meta_description')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create Page
                        </button>
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- CKEditor CSS -->
<link href="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.css" rel="stylesheet">
@endpush

@push('scripts')
<!-- CKEditor JS -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    // Initialize CKEditor for content
    CKEDITOR.replace('content', {
        height: 400,
        toolbar: [
            { name: 'document', items: ['Source', '-', 'NewPage', 'Preview', 'Print', '-', 'Templates'] },
            { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
            { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt'] },
            { name: 'forms', items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'] },
            '/',
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'] },
            { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
            { name: 'insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'] },
            '/',
            { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] },
            { name: 'tools', items: ['Maximize', 'ShowBlocks'] },
            { name: 'about', items: ['About'] }
        ],
        filebrowserUploadUrl: "{{ route('admin.pages.uploadImage') }}",
        filebrowserUploadMethod: 'form',
        extraPlugins: 'uploadimage',
        uploadUrl: "{{ route('admin.pages.uploadImage') }}"
    });

    // Initialize CKEditor for excerpt (simplified toolbar)
    CKEDITOR.replace('excerpt', {
        height: 150,
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'styles', items: ['Format'] }
        ]
    });

    // Update form validation to work with CKEditor
    document.querySelector('form').addEventListener('submit', function(e) {
        // Update textarea with CKEditor content
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
    });

    // Dynamic city loading based on state
    $('#state_id').on('change', function() {
        const stateId = $(this).val();
        const citySelect = $('#city_id');
        const areaSelect = $('#area_id');
        
        citySelect.html('<option value="">Loading cities...</option>');
        areaSelect.html('<option value="">Select City First</option>');
        
        if (stateId) {
            $.ajax({
                url: '{{ route('admin.cities.byState') }}',
                method: 'GET',
                data: { state_id: stateId },
                success: function(cities) {
                    citySelect.html('<option value="">Select City</option>');
                    if (cities.length > 0) {
                        cities.forEach(function(city) {
                            citySelect.append(`<option value="${city.id}">${city.city_name || city.name}</option>`);
                        });
                    } else {
                        citySelect.html('<option value="">No cities found</option>');
                    }
                },
                error: function() {
                    citySelect.html('<option value="">Error loading cities</option>');
                }
            });
        } else {
            citySelect.html('<option value="">Select State First</option>');
        }
    });

    // Dynamic area loading based on city
    $('#city_id').on('change', function() {
        const cityId = $(this).val();
        const areaSelect = $('#area_id');
        
        areaSelect.html('<option value="">Loading areas...</option>');
        
        if (cityId) {
            $.ajax({
                url: '{{ route('admin.areas.byCity') }}',
                method: 'GET',
                data: { city_id: cityId },
                success: function(areas) {
                    areaSelect.html('<option value="">Select Area</option>');
                    if (areas.length > 0) {
                        areas.forEach(function(area) {
                            areaSelect.append(`<option value="${area.id}">${area.name}</option>`);
                        });
                    } else {
                        areaSelect.html('<option value="">No areas found</option>');
                    }
                },
                error: function() {
                    areaSelect.html('<option value="">Error loading areas</option>');
                }
            });
        } else {
            areaSelect.html('<option value="">Select City First</option>');
        }
    });
</script>
@endpush
