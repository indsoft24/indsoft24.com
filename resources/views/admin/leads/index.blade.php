@extends('admin.layouts.app')

@section('title', 'Leads Management')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-user-plus"></i> Leads Management</h1>
            <p class="text-muted">Manage and track all your leads from the website.</p>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-primary">
            <div class="card-body">
                <div class="stats-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['total'] }}</h3>
                    <p>Total Leads</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-warning">
            <div class="card-body">
                <div class="stats-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['new'] }}</h3>
                    <p>New Leads</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-info">
            <div class="card-body">
                <div class="stats-icon">
                    <i class="fas fa-envelope-open"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['unread'] }}</h3>
                    <p>Unread Leads</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-success">
            <div class="card-body">
                <div class="stats-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stats-content">
                    <h3>{{ $stats['converted'] }}</h3>
                    <p>Converted</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.leads.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="search" class="form-label">Search Leads</label>
                <input type="text" class="form-control" id="search" name="search" 
                       value="{{ request('search') }}" placeholder="Search by name, email, phone, or company...">
            </div>
            <div class="col-md-2">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="">All Status</option>
                    <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                    <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>Contacted</option>
                    <option value="qualified" {{ request('status') === 'qualified' ? 'selected' : '' }}>Qualified</option>
                    <option value="converted" {{ request('status') === 'converted' ? 'selected' : '' }}>Converted</option>
                    <option value="lost" {{ request('status') === 'lost' ? 'selected' : '' }}>Lost</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="is_read" class="form-label">Read Status</label>
                <select class="form-select" id="is_read" name="is_read">
                    <option value="">All</option>
                    <option value="0" {{ request('is_read') === '0' ? 'selected' : '' }}>Unread</option>
                    <option value="1" {{ request('is_read') === '1' ? 'selected' : '' }}>Read</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="spam" class="form-label">Spam</label>
                <select class="form-select" id="spam" name="spam">
                    <option value="">All</option>
                    <option value="0" {{ request('spam') === '0' ? 'selected' : '' }}>Not Spam</option>
                    <option value="1" {{ request('spam') === '1' ? 'selected' : '' }}>Spam</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.leads.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Clear
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Leads Table -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-list"></i> Leads List
            <span class="badge bg-primary ms-2">{{ $leads->total() }} total</span>
        </h5>
    </div>
    <div class="card-body p-0">
        @if($leads->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="20%">Name</th>
                            <th width="20%">Contact</th>
                            <th width="15%">Company</th>
                            <th width="10%">Status</th>
                            <th width="10%">Source</th>
                            <th width="10%">Date</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leads as $lead)
                        <tr class="{{ !$lead->is_read ? 'table-warning' : '' }}">
                            <td>
                                @if(!$lead->is_read)
                                    <span class="badge bg-danger">New</span>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $lead->name }}</strong>
                                    @if($lead->is_spam)
                                        <span class="badge bg-danger ms-2">Spam</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div><i class="fas fa-envelope text-muted"></i> {{ $lead->email }}</div>
                                    @if($lead->phone)
                                        <div><i class="fas fa-phone text-muted"></i> {{ $lead->phone }}</div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                {{ $lead->company ?? 'N/A' }}
                            </td>
                            <td>
                                @if($lead->status === 'new')
                                    <span class="badge bg-warning">New</span>
                                @elseif($lead->status === 'contacted')
                                    <span class="badge bg-info">Contacted</span>
                                @elseif($lead->status === 'qualified')
                                    <span class="badge bg-primary">Qualified</span>
                                @elseif($lead->status === 'converted')
                                    <span class="badge bg-success">Converted</span>
                                @else
                                    <span class="badge bg-secondary">Lost</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ ucfirst($lead->source) }}</span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $lead->created_at->format('M d, Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.leads.show', $lead) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       data-bs-toggle="tooltip" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.leads.destroy', $lead) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger btn-delete" 
                                                data-bs-toggle="tooltip" title="Delete">
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
            
            <!-- Pagination -->
            <div class="card-footer">
                {{ $leads->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-user-plus fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No leads found</h5>
                <p class="text-muted">Leads will appear here when submitted from the website.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Delete confirmation
    $('.btn-delete').on('click', function(e) {
        if (!confirm('Are you sure you want to delete this lead? This action cannot be undone.')) {
            e.preventDefault();
        }
    });
});
</script>
@endpush

