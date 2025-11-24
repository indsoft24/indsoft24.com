<?php

namespace App\Http\Controllers\Admin;

use App\Area;
use App\City;
use App\Http\Controllers\Controller;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AreaController extends Controller
{
    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of areas
     */
    public function index(Request $request)
    {
        $query = Area::with([
            'state' => function ($q) {
                $q->select('id', 'name');
            },
            'city' => function ($q) {
                $q->select('id', 'city_name');
            }
        ]);

        // Filter by state
        if ($request->has('state') && $request->state !== '') {
            $query->where('state_id', $request->state);
        }

        // Filter by city
        if ($request->has('city') && $request->city !== '') {
            $query->where('city_id', $request->city);
        }

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
                $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%')
                    ->orWhereHas('state', function ($stateQuery) use ($request) {
                        $stateQuery->where('name', 'like', '%'.$request->search.'%');
                    })
                    ->orWhereHas('city', function ($cityQuery) use ($request) {
                        $cityQuery->where('city_name', 'like', '%'.$request->search.'%');
                    });
            });
        }

        $areas = $query->orderBy('name', 'asc')->paginate(15);
        
        // Limit dropdown options to prevent memory exhaustion
        $states = State::active()
            ->select('id', 'name')
            ->orderBy('name')
            ->limit(500)
            ->get();
        $cities = City::active()
            ->select('id', 'city_name')
            ->orderBy('city_name')
            ->limit(500)
            ->get();

        return view('admin.cms.areas.index', compact('areas', 'states', 'cities'));
    }

    /**
     * Show the form for creating a new area
     */
    public function create()
    {
        // Limit dropdown options to prevent memory exhaustion
        $states = State::active()
            ->select('id', 'name')
            ->orderBy('name')
            ->limit(500)
            ->get();
        $cities = City::active()
            ->select('id', 'city_name')
            ->orderBy('city_name')
            ->limit(500)
            ->get();

        return view('admin.cms.areas.create', compact('states', 'cities'));
    }

    /**
     * Store a newly created area
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');

        Area::create($data);

        return redirect()->route('admin.areas.index')
            ->with('success', 'Area created successfully!');
    }

    /**
     * Display the specified area
     */
    public function show(Area $area)
    {
        $area->load(['state', 'city', 'pages']);

        return view('admin.cms.areas.show', compact('area'));
    }

    /**
     * Show the form for editing the specified area
     */
    public function edit(Area $area)
    {
        // Limit dropdown options to prevent memory exhaustion
        $states = State::active()
            ->select('id', 'name')
            ->orderBy('name')
            ->limit(500)
            ->get();
        $cities = City::active()
            ->select('id', 'city_name')
            ->orderBy('city_name')
            ->limit(500)
            ->get();

        return view('admin.cms.areas.edit', compact('area', 'states', 'cities'));
    }

    /**
     * Update the specified area
     */
    public function update(Request $request, Area $area)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');

        $area->update($data);

        return redirect()->route('admin.areas.index')
            ->with('success', 'Area updated successfully!');
    }

    /**
     * Remove the specified area
     */
    public function destroy(Area $area)
    {
        if ($area->pages()->count() > 0) {
            return redirect()->route('admin.areas.index')
                ->with('error', 'Cannot delete area with associated pages!');
        }

        $area->delete();

        return redirect()->route('admin.areas.index')
            ->with('success', 'Area deleted successfully!');
    }

    /**
     * Get areas by city (AJAX)
     */
    public function getByCity(Request $request)
    {
        $cityId = $request->get('city_id');
        $areas = Area::where('city_id', $cityId)
            ->active()
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($areas);
    }
}
