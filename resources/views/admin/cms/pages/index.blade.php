@extends('admin.layouts.app')

@section('title', 'CMS Pages Management')

@section('content')
<div class="cms-pages-container">
    <!-- Statistics Cards -->
    <div class="row mb-4 g-3">
        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <div class="card bg-primary text-white stats-card-small">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0 small">Total Pages</h6>
                            <h4 class="mb-0">{{ number_format($stats['total']) }}</h4>
                        </div>
                        <i class="fas fa-file-alt fa-lg opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <div class="card bg-success text-white stats-card-small">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0 small">Published</h6>
                            <h4 class="mb-0">{{ number_format($stats['published']) }}</h4>
                        </div>
                        <i class="fas fa-check-circle fa-lg opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <div class="card bg-warning text-white stats-card-small">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0 small">Draft</h6>
                            <h4 class="mb-0">{{ number_format($stats['draft']) }}</h4>
                        </div>
                        <i class="fas fa-edit fa-lg opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <div class="card bg-secondary text-white stats-card-small">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0 small">Archived</h6>
                            <h4 class="mb-0">{{ number_format($stats['archived']) }}</h4>
                        </div>
                        <i class="fas fa-archive fa-lg opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <div class="card bg-info text-white stats-card-small">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0 small">Featured</h6>
                            <h4 class="mb-0">{{ number_format($stats['featured']) }}</h4>
                        </div>
                        <i class="fas fa-star fa-lg opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <div class="card bg-dark text-white stats-card-small">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0 small">Total Views</h6>
                            <h4 class="mb-0">{{ number_format($stats['total_views']) }}</h4>
                        </div>
                        <i class="fas fa-eye fa-lg opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-file-alt"></i> Pages Management
                    </h3>
                    <div class="btn-group">
                        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New Page
                        </a>
                        <a href="{{ route('admin.pages.export', request()->query()) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i> Export
                        </a>
                    </div>
                </div>
                
                <div class="card-body p-3">
                    <!-- Advanced Filters -->
                    <form method="GET" action="{{ route('admin.pages.index') }}" id="filterForm">
                        <div class="row g-2 mb-3">
                            <div class="col-lg-3 col-md-6 col-12">
                                <label class="form-label small text-muted mb-1">Search</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Search pages..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-outline-secondary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-6">
                                <label class="form-label small text-muted mb-1">State</label>
                                <select name="state" id="state_filter" class="form-select form-select-sm">
                                    <option value="">All States</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}" {{ request('state') == $state->id ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-4 col-6">
                                <label class="form-label small text-muted mb-1">City</label>
                                <select name="city" id="city_filter" class="form-select form-select-sm">
                                    <option value="">All Cities</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" 
                                                data-state-id="{{ $city->state_id ?? '' }}"
                                                {{ request('city') == $city->id ? 'selected' : '' }}>
                                            {{ $city->city_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-4 col-6">
                                <label class="form-label small text-muted mb-1">Area</label>
                                <select name="area" id="area_filter" class="form-select form-select-sm">
                                    <option value="">All Areas</option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}" 
                                                data-city-id="{{ $area->city_id ?? '' }}"
                                                {{ request('area') == $area->id ? 'selected' : '' }}>
                                            {{ $area->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-1 col-md-3 col-4">
                                <label class="form-label small text-muted mb-1">Status</label>
                                <select name="status" class="form-select form-select-sm">
                                    <option value="">All</option>
                                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>
                            <div class="col-lg-1 col-md-3 col-4">
                                <label class="form-label small text-muted mb-1">Type</label>
                                <select name="page_type" class="form-select form-select-sm">
                                    <option value="">All</option>
                                    <option value="general" {{ request('page_type') == 'general' ? 'selected' : '' }}>General</option>
                                    <option value="service" {{ request('page_type') == 'service' ? 'selected' : '' }}>Service</option>
                                    <option value="product" {{ request('page_type') == 'product' ? 'selected' : '' }}>Product</option>
                                    <option value="about" {{ request('page_type') == 'about' ? 'selected' : '' }}>About</option>
                                    <option value="contact" {{ request('page_type') == 'contact' ? 'selected' : '' }}>Contact</option>
                                </select>
                            </div>
                            <div class="col-lg-1 col-md-3 col-4">
                                <label class="form-label small text-muted mb-1">Featured</label>
                                <select name="featured" class="form-select form-select-sm">
                                    <option value="">All</option>
                                    <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-lg-2 col-md-4 col-6">
                                <label class="form-label small text-muted mb-1">Date From</label>
                                <input type="date" name="date_from" class="form-control form-control-sm" value="{{ request('date_from') }}">
                            </div>
                            <div class="col-lg-2 col-md-4 col-6">
                                <label class="form-label small text-muted mb-1">Date To</label>
                                <input type="date" name="date_to" class="form-control form-control-sm" value="{{ request('date_to') }}">
                            </div>
                            <div class="col-lg-2 col-md-4 col-6">
                                <label class="form-label small text-muted mb-1">Sort By</label>
                                <select name="sort_by" class="form-select form-select-sm">
                                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Created</option>
                                    <option value="updated_at" {{ request('sort_by') == 'updated_at' ? 'selected' : '' }}>Updated</option>
                                    <option value="published_at" {{ request('sort_by') == 'published_at' ? 'selected' : '' }}>Published</option>
                                    <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>Title</option>
                                    <option value="views_count" {{ request('sort_by') == 'views_count' ? 'selected' : '' }}>Views</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-4 col-6">
                                <label class="form-label small text-muted mb-1">Order</label>
                                <select name="sort_order" class="form-select form-select-sm">
                                    <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-4 col-6">
                                <label class="form-label small text-muted mb-1">Per Page</label>
                                <select name="per_page" class="form-select form-select-sm">
                                    <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                                    <option value="15" {{ request('per_page') == '15' ? 'selected' : '' }}>15</option>
                                    <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-4 col-6 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-sm me-2">
                                    <i class="fas fa-filter"></i> Apply
                                </button>
                                <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-times"></i> Clear
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Bulk Actions -->
                    <form method="POST" action="{{ route('admin.pages.bulkAction') }}" id="bulkActionForm" class="mb-3">
                        @csrf
                        <div class="d-flex align-items-center gap-2">
                            <select name="action" id="bulkAction" class="form-select form-select-sm" style="width: auto;" required>
                                <option value="">Bulk Actions</option>
                                <option value="publish">Publish</option>
                                <option value="draft">Move to Draft</option>
                                <option value="archive">Archive</option>
                                <option value="unarchive">Unarchive</option>
                                <option value="feature">Feature</option>
                                <option value="unfeature">Unfeature</option>
                                <option value="delete">Delete</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-outline-primary" id="bulkActionBtn" disabled>
                                <i class="fas fa-check"></i> Apply
                            </button>
                            <span class="text-muted small" id="selectedCount">0 selected</span>
                        </div>
                    </form>

                    @if($pages->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="30">
                                            <input type="checkbox" id="selectAll" class="form-check-input">
                                        </th>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Views</th>
                                        <th>Author</th>
                                        <th>Created</th>
                                        <th width="180">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pages as $page)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="page_ids[]" value="{{ $page->id }}" 
                                                       class="form-check-input page-checkbox">
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>{{ Str::limit($page->title, 50) }}</strong>
                                                    @if($page->excerpt)
                                                        <br><small class="text-muted">{{ Str::limit(strip_tags($page->excerpt), 60) }}</small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <small>
                                                    @if($page->area)
                                                        <span class="badge bg-light text-dark">{{ $page->area->name }}</span>
                                                    @endif
                                                    @if($page->city)
                                                        <span class="badge bg-light text-dark">{{ $page->city->city_name }}</span>
                                                    @endif
                                                    @if($page->state)
                                                        <span class="badge bg-light text-dark">{{ $page->state->name }}</span>
                                                    @endif
                                                    @if(!$page->area && !$page->city && !$page->state)
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </small>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ ucfirst($page->page_type) }}</span>
                                            </td>
                                            <td>
                                                <select class="form-select form-select-sm quick-status" 
                                                        data-page-id="{{ $page->id }}" 
                                                        data-current-status="{{ $page->status }}">
                                                    <option value="draft" {{ $page->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="published" {{ $page->status == 'published' ? 'selected' : '' }}>Published</option>
                                                    <option value="archived" {{ $page->status == 'archived' ? 'selected' : '' }}>Archived</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" 
                                                        class="btn btn-sm toggle-featured {{ $page->is_featured ? 'btn-warning' : 'btn-outline-warning' }}"
                                                        data-page-id="{{ $page->id }}"
                                                        data-featured="{{ $page->is_featured ? '1' : '0' }}">
                                                    <i class="fas fa-star"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">{{ number_format($page->views_count) }}</span>
                                            </td>
                                            <td>
                                                <small>{{ $page->user->name ?? 'N/A' }}</small>
                                            </td>
                                            <td>
                                                <small>{{ $page->created_at->format('M d, Y') }}</small>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('cms.page', $page->slug) }}" 
                                                       target="_blank"
                                                       class="btn btn-outline-info" 
                                                       title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.pages.show', $page) }}" 
                                                       class="btn btn-outline-secondary" 
                                                       title="Details">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                    <a href="{{ route('admin.pages.edit', $page) }}" 
                                                       class="btn btn-outline-primary" 
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-outline-success duplicate-page" 
                                                            data-page-id="{{ $page->id }}"
                                                            title="Duplicate">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                    <form action="{{ route('admin.pages.destroy', $page) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this page?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <p class="text-muted small mb-0">
                                    Showing {{ $pages->firstItem() }} to {{ $pages->lastItem() }} of {{ $pages->total() }} pages
                                </p>
                            </div>
                            <div>
                                {{ $pages->appends(request()->query())->links() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-file-alt fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">No pages found</h5>
                            <p class="text-muted">Start by creating your first page.</p>
                            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add New Page
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection

@push('styles')
<style>
.cms-pages-container {
    width: 100%;
    max-width: 100%;
    padding: 0;
    margin: 0;
    overflow-x: hidden;
}

.stats-card-small .card-body {
    padding: 15px;
}

.stats-card-small h4 {
    font-size: 1.5rem;
    font-weight: 700;
}

.stats-card-small h6 {
    font-size: 0.75rem;
}

.stats-card-small i {
    font-size: 1.5rem !important;
}

.table-sm th,
.table-sm td {
    padding: 8px 6px;
    font-size: 0.875rem;
}

.table-sm .btn-group-sm .btn {
    padding: 4px 8px;
    font-size: 0.75rem;
}

/* Ensure no horizontal scroll */
body {
    overflow-x: hidden;
}

.page-content {
    overflow-x: hidden;
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .stats-card-small h4 {
        font-size: 1.25rem;
    }
    
    .stats-card-small i {
        font-size: 1.25rem !important;
    }
}

@media (max-width: 768px) {
    .cms-pages-container {
        padding: 0;
    }
    
    .stats-card-small .card-body {
        padding: 12px;
    }
    
    .stats-card-small h4 {
        font-size: 1.1rem;
    }
    
    .table-sm th,
    .table-sm td {
        padding: 6px 4px;
        font-size: 0.8rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Select All checkbox
    $('#selectAll').on('change', function() {
        $('.page-checkbox').prop('checked', this.checked);
        updateSelectedCount();
    });

    // Individual checkbox change
    $(document).on('change', '.page-checkbox', function() {
        updateSelectedCount();
        $('#selectAll').prop('checked', $('.page-checkbox:checked').length === $('.page-checkbox').length);
    });

    // Update selected count
    function updateSelectedCount() {
        const count = $('.page-checkbox:checked').length;
        $('#selectedCount').text(count + ' selected');
        $('#bulkActionBtn').prop('disabled', count === 0 || $('#bulkAction').val() === '');
    }

    // Bulk action form
    $('#bulkAction').on('change', function() {
        updateSelectedCount();
    });

    $('#bulkActionForm').on('submit', function(e) {
        const action = $('#bulkAction').val();
        const count = $('.page-checkbox:checked').length;
        
        if (!action || count === 0) {
            e.preventDefault();
            return false;
        }

        let confirmMessage = '';
        switch(action) {
            case 'delete':
                confirmMessage = `Are you sure you want to delete ${count} page(s)? This action cannot be undone!`;
                break;
            case 'publish':
                confirmMessage = `Are you sure you want to publish ${count} page(s)?`;
                break;
            case 'archive':
                confirmMessage = `Are you sure you want to archive ${count} page(s)?`;
                break;
            default:
                confirmMessage = `Are you sure you want to ${action} ${count} page(s)?`;
        }

        if (!confirm(confirmMessage)) {
            e.preventDefault();
            return false;
        }
    });

    // Quick status update
    $('.quick-status').on('change', function() {
        const pageId = $(this).data('page-id');
        const status = $(this).val();
        const currentStatus = $(this).data('current-status');
        
        if (status === currentStatus) return;

        $.ajax({
            url: `/admin/pages/${pageId}/quick-status`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to update status. Please try again.'
                });
            }
        });
    });

    // Toggle featured
    $('.toggle-featured').on('click', function() {
        const pageId = $(this).data('page-id');
        const btn = $(this);
        
        $.ajax({
            url: `/admin/pages/${pageId}/toggle-featured`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    if (response.is_featured) {
                        btn.removeClass('btn-outline-warning').addClass('btn-warning');
                    } else {
                        btn.removeClass('btn-warning').addClass('btn-outline-warning');
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to update featured status. Please try again.'
                });
            }
        });
    });

    // Duplicate page
    $('.duplicate-page').on('click', function() {
        const pageId = $(this).data('page-id');
        
        Swal.fire({
            title: 'Duplicate Page?',
            text: 'This will create a copy of this page as a draft.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, duplicate it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/pages/${pageId}/duplicate`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.location.href = response.redirect || '{{ route('admin.pages.index') }}';
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to duplicate page. Please try again.'
                        });
                    }
                });
            }
        });
    });

    // Dynamic city/area loading
    $('#state_filter').on('change', function() {
        const stateId = $(this).val();
        const citySelect = $('#city_filter');
        const areaSelect = $('#area_filter');
        
        // Filter cities by state
        citySelect.find('option').each(function() {
            const option = $(this);
            if (option.val() === '' || option.data('state-id') == stateId || !stateId) {
                option.show();
            } else {
                option.hide();
            }
        });
        
        // Reset city and area
        if (stateId) {
            citySelect.val('');
            areaSelect.val('');
        }
    });

    $('#city_filter').on('change', function() {
        const cityId = $(this).val();
        const areaSelect = $('#area_filter');
        
        // Filter areas by city
        areaSelect.find('option').each(function() {
            const option = $(this);
            if (option.val() === '' || option.data('city-id') == cityId || !cityId) {
                option.show();
            } else {
                option.hide();
            }
        });
        
        // Reset area
        if (cityId) {
            areaSelect.val('');
        }
    });

    // Auto-submit on filter change (optional)
    // $('#state_filter, #city_filter, #area_filter, select[name="status"], select[name="page_type"]').on('change', function() {
    //     $('#filterForm').submit();
    // });
});
</script>
@endpush
