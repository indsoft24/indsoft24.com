<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of leads
     */
    public function index(Request $request)
    {
        $query = Lead::query();

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by read/unread
        if ($request->has('is_read') && $request->is_read !== '') {
            $query->where('is_read', $request->is_read === '1');
        }

        // Filter spam
        if ($request->has('spam') && $request->spam !== '') {
            $query->where('is_spam', $request->spam === '1');
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%')
                    ->orWhere('company', 'like', '%' . $request->search . '%');
            });
        }

        $leads = $query->orderBy('created_at', 'desc')->paginate(20);

        // Get stats
        $stats = [
            'total' => Lead::count(),
            'new' => Lead::where('status', 'new')->count(),
            'unread' => Lead::where('is_read', false)->count(),
            'converted' => Lead::where('status', 'converted')->count(),
        ];

        return view('admin.leads.index', compact('leads', 'stats'));
    }

    /**
     * Display the specified lead
     */
    public function show(Lead $lead)
    {
        // Mark as read
        if (!$lead->is_read) {
            $lead->update(['is_read' => true]);
        }

        return view('admin.leads.show', compact('lead'));
    }

    /**
     * Update lead status
     */
    public function updateStatus(Request $request, Lead $lead)
    {
        $request->validate([
            'status' => 'required|in:new,contacted,qualified,converted,lost',
        ]);

        $lead->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Lead status updated successfully!');
    }

    /**
     * Update lead notes
     */
    public function updateNotes(Request $request, Lead $lead)
    {
        $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $lead->update(['notes' => $request->notes]);

        return redirect()->back()->with('success', 'Notes updated successfully!');
    }

    /**
     * Mark lead as read/unread
     */
    public function toggleRead(Lead $lead)
    {
        $lead->update(['is_read' => !$lead->is_read]);

        return redirect()->back()->with('success', 'Lead status updated!');
    }

    /**
     * Remove the specified lead
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Lead deleted successfully!',
            ]);
        }

        return redirect()->route('admin.leads.index')
            ->with('success', 'Lead deleted successfully!');
    }
}
