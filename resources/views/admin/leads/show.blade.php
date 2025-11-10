@extends('admin.layouts.app')

@section('title', 'Lead Details: ' . $lead->name)

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-user"></i> Lead Details</h1>
            <p class="text-muted">View and manage lead information.</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.leads.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Leads
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Lead Information -->
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Lead Information</h5>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Name:</dt>
                    <dd class="col-sm-8"><strong>{{ $lead->name }}</strong></dd>

                    <dt class="col-sm-4">Email:</dt>
                    <dd class="col-sm-8">
                        <a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a>
                    </dd>

                    <dt class="col-sm-4">Phone:</dt>
                    <dd class="col-sm-8">
                        @if($lead->phone)
                            <a href="tel:{{ $lead->phone }}">{{ $lead->phone }}</a>
                        @else
                            <span class="text-muted">Not provided</span>
                        @endif
                    </dd>

                    <dt class="col-sm-4">Company:</dt>
                    <dd class="col-sm-8">{{ $lead->company ?? 'Not provided' }}</dd>

                    <dt class="col-sm-4">Source:</dt>
                    <dd class="col-sm-8">
                        <span class="badge bg-secondary">{{ ucfirst($lead->source) }}</span>
                    </dd>

                    <dt class="col-sm-4">Status:</dt>
                    <dd class="col-sm-8">
                        <form action="{{ route('admin.leads.updateStatus', $lead) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select form-select-sm d-inline-block" style="width: auto;" onchange="this.form.submit()">
                                <option value="new" {{ $lead->status === 'new' ? 'selected' : '' }}>New</option>
                                <option value="contacted" {{ $lead->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                <option value="qualified" {{ $lead->status === 'qualified' ? 'selected' : '' }}>Qualified</option>
                                <option value="converted" {{ $lead->status === 'converted' ? 'selected' : '' }}>Converted</option>
                                <option value="lost" {{ $lead->status === 'lost' ? 'selected' : '' }}>Lost</option>
                            </select>
                        </form>
                    </dd>

                    <dt class="col-sm-4">Read Status:</dt>
                    <dd class="col-sm-8">
                        <form action="{{ route('admin.leads.toggleRead', $lead) }}" method="POST" class="d-inline">
                            @csrf
                            @if($lead->is_read)
                                <span class="badge bg-success">Read</span>
                                <button type="submit" class="btn btn-sm btn-outline-warning">Mark as Unread</button>
                            @else
                                <span class="badge bg-warning">Unread</span>
                                <button type="submit" class="btn btn-sm btn-outline-success">Mark as Read</button>
                            @endif
                        </form>
                    </dd>

                    @if($lead->is_spam)
                        <dt class="col-sm-4">Spam Status:</dt>
                        <dd class="col-sm-8">
                            <span class="badge bg-danger">Spam (Score: {{ $lead->spam_score }})</span>
                        </dd>
                    @endif

                    <dt class="col-sm-4">Submitted:</dt>
                    <dd class="col-sm-8">{{ $lead->created_at->format('F d, Y \a\t h:i A') }}</dd>

                    @if($lead->ip_address)
                        <dt class="col-sm-4">IP Address:</dt>
                        <dd class="col-sm-8"><code>{{ $lead->ip_address }}</code></dd>
                    @endif
                </dl>
            </div>
        </div>

        <!-- Message -->
        @if($lead->message)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-comment"></i> Message</h5>
                </div>
                <div class="card-body">
                    <p style="white-space: pre-wrap;">{{ $lead->message }}</p>
                </div>
            </div>
        @endif

        <!-- Notes -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-sticky-note"></i> Notes</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.leads.updateNotes', $lead) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <textarea name="notes" class="form-control" rows="5" placeholder="Add notes about this lead...">{{ $lead->notes }}</textarea>
                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="fas fa-save"></i> Save Notes
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Quick Actions -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-bolt"></i> Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $lead->email }}?subject=Re: Your Inquiry" class="btn btn-primary">
                        <i class="fas fa-envelope"></i> Send Email
                    </a>
                    @if($lead->phone)
                        <a href="tel:{{ $lead->phone }}" class="btn btn-success">
                            <i class="fas fa-phone"></i> Call Now
                        </a>
                    @endif
                    <form action="{{ route('admin.leads.destroy', $lead) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this lead?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash"></i> Delete Lead
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info"></i> Additional Information</h5>
            </div>
            <div class="card-body">
                <dl class="mb-0">
                    <dt>User Agent:</dt>
                    <dd><small class="text-muted">{{ Str::limit($lead->user_agent, 100) }}</small></dd>
                    
                    <dt>Last Updated:</dt>
                    <dd><small class="text-muted">{{ $lead->updated_at->format('M d, Y h:i A') }}</small></dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection

