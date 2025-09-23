@extends('admin.layouts.app')

@section('title', 'Newsletter Subscribers')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-users"></i> Newsletter Subscribers</h1>
            <p class="text-muted">Manage your list of verified email subscribers.</p>
        </div>
        <a href="{{ route('admin.subscribers.export') }}" class="btn btn-success">
            <i class="fas fa-file-csv"></i> Export to CSV
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.subscribers.index') }}">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search by email..." value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i> Search</button>
                <a href="{{ route('admin.subscribers.index') }}" class="btn btn-outline-secondary"><i class="fas fa-times"></i> Clear</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-list"></i> Subscribers List
            <span class="badge bg-primary ms-2">{{ $subscribers->total() }} total</span>
        </h5>
    </div>
    <div class="card-body p-0">
        @if($subscribers->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Email</th>
                            <th>Subscribed On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subscribers as $subscriber)
                        <tr>
                            <td>{{ $subscriber->email }}</td>
                            <td>{{ $subscriber->email_verified_at->format('M d, Y H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.subscribers.destroy', $subscriber) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this subscriber?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $subscribers->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No subscribers found.</h5>
            </div>
        @endif
    </div>
</div>
@endsection