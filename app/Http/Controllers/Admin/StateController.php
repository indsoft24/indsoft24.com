<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StateController extends Controller
{
    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of states
     */
    public function index(Request $request)
    {
        $query = State::query();

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('code', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $states = $query->orderBy('name', 'asc')->paginate(15);

        return view('admin.cms.states.index', compact('states'));
    }

    /**
     * Show the form for creating a new state
     */
    public function create()
    {
        return view('admin.cms.states.create');
    }

    /**
     * Store a newly created state
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:3|unique:states,code',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');

        State::create($data);

        return redirect()->route('admin.states.index')
            ->with('success', 'State created successfully!');
    }

    /**
     * Display the specified state
     */
    public function show(State $state)
    {
        $state->load(['cities', 'pages']);
        return view('admin.cms.states.show', compact('state'));
    }

    /**
     * Show the form for editing the specified state
     */
    public function edit(State $state)
    {
        return view('admin.cms.states.edit', compact('state'));
    }

    /**
     * Update the specified state
     */
    public function update(Request $request, State $state)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:3|unique:states,code,' . $state->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');

        $state->update($data);

        return redirect()->route('admin.states.index')
            ->with('success', 'State updated successfully!');
    }

    /**
     * Remove the specified state
     */
    public function destroy(State $state)
    {
        if ($state->cities()->count() > 0) {
            return redirect()->route('admin.states.index')
                ->with('error', 'Cannot delete state with associated cities!');
        }

        $state->delete();

        return redirect()->route('admin.states.index')
            ->with('success', 'State deleted successfully!');
    }
}