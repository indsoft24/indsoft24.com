@extends('layouts.app')

@section('title', 'Create New Post')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white ">
                    <h2 class="mb-0">
                        <i class="fas fa-plus me-2"></i>Create New Post
                    </h2>
                </div>
                <div class="card-body p-4">
                    <form id="createPostForm" action="{{ route('user.blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">Post Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="excerpt" class="form-label fw-bold">Excerpt</label>
                            <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                      id="excerpt" name="excerpt" rows="3" 
                                      placeholder="Brief description of your post...">{{ old('excerpt') }}</textarea>
                            @error('excerpt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Optional: A short summary of your post (max 500 characters)</div>
                        </div>

                        <div class="mb-4">
                            <label for="content" class="form-label fw-bold">Content *</label>
                            
                            <!-- Custom Rich Text Editor Toolbar -->
                            <div class="blog-editor-toolbar mb-2 border rounded-top p-2 bg-light">
                                <div class="btn-group me-2 mb-1" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatText('bold')" title="Bold">
                                        <strong>B</strong>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatText('italic')" title="Italic">
                                        <em>I</em>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatText('underline')" title="Underline">
                                        <u>U</u>
                                    </button>
                                </div>
                                
                                <div class="btn-group me-2 mb-1" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatHeading('h1')" title="Heading 1">H1</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatHeading('h2')" title="Heading 2">H2</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatHeading('h3')" title="Heading 3">H3</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatHeading('h4')" title="Heading 4">H4</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatHeading('h5')" title="Heading 5">H5</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatHeading('h6')" title="Heading 6">H6</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatParagraph()" title="Paragraph">P</button>
                                </div>
                                
                                <div class="btn-group me-2 mb-1" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatList('ul')" title="Bullet List">
                                        <i class="fas fa-list-ul"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatList('ol')" title="Numbered List">
                                        <i class="fas fa-list-ol"></i>
                                    </button>
                                </div>
                                
                                <div class="btn-group me-2 mb-1" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="insertTable()" title="Insert Table">
                                        <i class="fas fa-table"></i>
                                    </button>
                                </div>
                                
                                <div class="btn-group mb-1" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatText('removeFormat')" title="Clear Formatting">
                                        <i class="fas fa-remove-format"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Contenteditable Editor -->
                            <div class="blog-editor-wrapper border rounded-bottom @error('content') border-danger @enderror" style="min-height: 400px;">
                                <div id="blogEditor" 
                                     class="blog-editor-content p-3" 
                                     contenteditable="true" 
                                     style="min-height: 400px; outline: none;"
                                     data-placeholder="Write your post content here..."></div>
                            </div>
                            
                            <!-- Hidden textarea to store HTML content for form submission -->
                            <textarea id="content" name="content" style="display: none;" required>{{ old('content') }}</textarea>
                            
                            @error('content')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Select text and use the toolbar buttons to format your content</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="category_id" class="form-label fw-bold">Category *</label>
                                <select class="form-select @error('category_id') is-invalid @enderror" 
                                        id="category_id" name="category_id" required>
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="status" class="form-label fw-bold">Status *</label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" name="status" required>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="featured_image" class="form-label fw-bold">Featured Image</label>
                            <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                                   id="featured_image" name="featured_image" accept="image/*">
                            @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Optional: Upload an image for your post (max 5MB)</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Tags</label>
                            <div class="row">
                                @foreach($tags as $tag)
                                    <div class="col-md-4 col-lg-3 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="tags[]" value="{{ $tag->id }}" 
                                                   id="tag_{{ $tag->id }}"
                                                   {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="tag_{{ $tag->id }}">
                                                {{ $tag->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('tags')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('user.blog.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Posts
                            </a>
                            <button type="submit" class="btn btn-primary" id="createPostBtn">
                                <i class="fas fa-save me-2"></i>Create Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.blog-editor-content {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    font-size: 16px;
    line-height: 1.6;
    color: #333;
}

.blog-editor-content:empty:before {
    content: attr(data-placeholder);
    color: #999;
    font-style: italic;
}

.blog-editor-content h1 {
    font-size: 2em;
    font-weight: bold;
    margin: 1em 0 0.5em 0;
    line-height: 1.2;
}

.blog-editor-content h2 {
    font-size: 1.75em;
    font-weight: bold;
    margin: 0.9em 0 0.5em 0;
    line-height: 1.3;
}

.blog-editor-content h3 {
    font-size: 1.5em;
    font-weight: bold;
    margin: 0.8em 0 0.5em 0;
    line-height: 1.3;
}

.blog-editor-content h4 {
    font-size: 1.25em;
    font-weight: bold;
    margin: 0.7em 0 0.5em 0;
    line-height: 1.4;
}

.blog-editor-content h5 {
    font-size: 1.1em;
    font-weight: bold;
    margin: 0.6em 0 0.5em 0;
    line-height: 1.4;
}

.blog-editor-content h6 {
    font-size: 1em;
    font-weight: bold;
    margin: 0.6em 0 0.5em 0;
    line-height: 1.5;
}

.blog-editor-content p {
    margin: 0.75em 0;
}

.blog-editor-content ul,
.blog-editor-content ol {
    margin: 0.75em 0;
    padding-left: 2em;
}

.blog-editor-content ul {
    list-style-type: disc;
}

.blog-editor-content ol {
    list-style-type: decimal;
}

.blog-editor-content li {
    margin: 0.25em 0;
}

.blog-editor-content table {
    border-collapse: collapse;
    width: 100%;
    margin: 1em 0;
    border: 1px solid #ddd;
}

.blog-editor-content table td,
.blog-editor-content table th {
    border: 1px solid #ddd;
    padding: 8px 12px;
    text-align: left;
}

.blog-editor-content table th {
    background-color: #f5f5f5;
    font-weight: bold;
}

.blog-editor-content strong {
    font-weight: bold;
}

.blog-editor-content em {
    font-style: italic;
}

.blog-editor-content u {
    text-decoration: underline;
}

.blog-editor-toolbar {
    display: flex;
    flex-wrap: wrap;
    gap: 0.25rem;
}

.blog-editor-toolbar .btn-group {
    display: inline-flex;
}

.blog-editor-toolbar button {
    border: 1px solid #dee2e6;
    background: white;
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
}

.blog-editor-toolbar button:hover {
    background-color: #e9ecef;
    border-color: #adb5bd;
}

.blog-editor-toolbar button:active {
    background-color: #dee2e6;
}
</style>

<script>
// Rich Text Editor Functions
function formatText(command) {
    document.execCommand(command, false, null);
    document.getElementById('blogEditor').focus();
}

function formatHeading(tag) {
    const selection = window.getSelection();
    if (selection.rangeCount > 0) {
        const range = selection.getRangeAt(0);
        const selectedText = range.toString();
        
        if (selectedText) {
            const heading = document.createElement(tag);
            heading.textContent = selectedText;
            range.deleteContents();
            range.insertNode(heading);
        } else {
            // If no text selected, insert heading at cursor
            const heading = document.createElement(tag);
            heading.textContent = 'Heading';
            range.insertNode(heading);
            // Move cursor after heading
            range.setStartAfter(heading);
            range.collapse(true);
            selection.removeAllRanges();
            selection.addRange(range);
        }
    }
    document.getElementById('blogEditor').focus();
}

function formatParagraph() {
    const selection = window.getSelection();
    if (selection.rangeCount > 0) {
        const range = selection.getRangeAt(0);
        let element = range.commonAncestorContainer;
        
        // Find the parent element if we're in a text node
        if (element.nodeType === 3) {
            element = element.parentNode;
        }
        
        // Check if we're in a heading
        if (element && (element.tagName === 'H1' || element.tagName === 'H2' || 
            element.tagName === 'H3' || element.tagName === 'H4' || 
            element.tagName === 'H5' || element.tagName === 'H6')) {
            const text = element.textContent;
            const paragraph = document.createElement('p');
            paragraph.textContent = text;
            element.parentNode.replaceChild(paragraph, element);
            
            // Move cursor to paragraph
            range.setStart(paragraph, paragraph.textContent.length);
            range.collapse(true);
            selection.removeAllRanges();
            selection.addRange(range);
        } else {
            // If not in a heading, use execCommand to format as paragraph
            document.execCommand('formatBlock', false, 'p');
        }
    } else {
        // If no selection, use execCommand
        document.execCommand('formatBlock', false, 'p');
    }
    document.getElementById('blogEditor').focus();
}

function formatList(listType) {
    const editor = document.getElementById('blogEditor');
    const command = listType === 'ul' ? 'insertUnorderedList' : 'insertOrderedList';
    document.execCommand(command, false, null);
    editor.focus();
}

function insertTable() {
    const selection = window.getSelection();
    if (selection.rangeCount > 0) {
        const range = selection.getRangeAt(0);
        const table = document.createElement('table');
        const tbody = document.createElement('tbody');
        
        // Create 3x3 table by default
        for (let i = 0; i < 3; i++) {
            const row = document.createElement('tr');
            for (let j = 0; j < 3; j++) {
                const cell = document.createElement(i === 0 ? 'th' : 'td');
                cell.textContent = i === 0 ? 'Header ' + (j + 1) : 'Cell ' + (j + 1);
                row.appendChild(cell);
            }
            tbody.appendChild(row);
        }
        
        table.appendChild(tbody);
        range.insertNode(table);
        
        // Move cursor after table
        range.setStartAfter(table);
        range.collapse(true);
        selection.removeAllRanges();
        selection.addRange(range);
    }
    document.getElementById('blogEditor').focus();
}

// Initialize editor with old content if exists
document.addEventListener('DOMContentLoaded', function() {
    const editor = document.getElementById('blogEditor');
    const hiddenTextarea = document.getElementById('content');
    
    // Load old content if exists
    if (hiddenTextarea.value) {
        editor.innerHTML = hiddenTextarea.value;
    }
    
    // Update hidden textarea on input
    editor.addEventListener('input', function() {
        hiddenTextarea.value = editor.innerHTML;
    });
    
    // Update hidden textarea on paste (with delay to allow paste to complete)
    editor.addEventListener('paste', function(e) {
        setTimeout(function() {
            hiddenTextarea.value = editor.innerHTML;
        }, 10);
    });
    
    // Sync content before form submission
    const form = document.getElementById('createPostForm');
    const submitBtn = document.getElementById('createPostBtn');
    const originalBtnText = submitBtn.innerHTML;

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Update hidden textarea with current editor content
        hiddenTextarea.value = editor.innerHTML;
        
        // Validate content
        if (!editor.textContent.trim()) {
            Swal.fire({
                title: 'Error!',
                text: 'Please enter some content for your blog post.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
        }
        
        // Show loading state
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating...';
        submitBtn.disabled = true;
        
        // Create FormData
        const formData = new FormData(form);
        
        // Add AJAX headers
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire(data.alert).then(() => {
                    window.location.href = data.redirect;
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: data.message || 'Something went wrong. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong. Please try again.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        })
        .finally(() => {
            // Reset button state
            submitBtn.innerHTML = originalBtnText;
            submitBtn.disabled = false;
        });
    });
});
</script>
@endsection
