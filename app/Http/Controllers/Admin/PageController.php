<?php

namespace App\Http\Controllers\Admin;

use App\Area;
use App\City;
use App\Http\Controllers\Controller;
use App\Page;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of pages
     */
    public function index(Request $request)
    {
        $query = Page::with([
            'state' => function ($q) {
                $q->select('id', 'name');
            },
            'city' => function ($q) {
                $q->select('id', 'city_name');
            },
            'area' => function ($q) {
                $q->select('id', 'name');
            },
            'user' => function ($q) {
                $q->select('id', 'name');
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

        // Filter by area
        if ($request->has('area') && $request->area !== '') {
            $query->where('area_id', $request->area);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by page type
        if ($request->has('page_type') && $request->page_type !== '') {
            $query->where('page_type', $request->page_type);
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                    ->orWhere('content', 'like', '%'.$request->search.'%')
                    ->orWhere('excerpt', 'like', '%'.$request->search.'%');
            });
        }

        $pages = $query->orderBy('created_at', 'desc')->paginate(15);
        
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
        $areas = Area::active()
            ->select('id', 'name')
            ->orderBy('name')
            ->limit(500)
            ->get();

        return view('admin.cms.pages.index', compact('pages', 'states', 'cities', 'areas'));
    }

    /**
     * Show the form for creating a new page
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
        $areas = Area::active()
            ->select('id', 'name')
            ->orderBy('name')
            ->limit(500)
            ->get();

        return view('admin.cms.pages.create', compact('states', 'cities', 'areas'));
    }

    /**
     * Store a newly created page
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'area_id' => 'nullable|exists:areas,id',
            'page_type' => 'required|string|max:50',
            'template' => 'required|string|max:50',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['is_featured'] = $request->has('is_featured');
        $data['user_id'] = auth()->id();

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images/pages'), $imageName);
            $data['featured_image'] = 'images/pages/'.$imageName;
        }

        Page::create($data);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page created successfully!');
    }

    /**
     * Display the specified page
     */
    public function show(Page $page)
    {
        $page->load([
            'state' => function ($q) {
                $q->select('id', 'name');
            },
            'city' => function ($q) {
                $q->select('id', 'city_name');
            },
            'area' => function ($q) {
                $q->select('id', 'name');
            },
            'user' => function ($q) {
                $q->select('id', 'name');
            }
        ]);

        return view('admin.cms.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified page
     */
    public function edit(Page $page)
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
        $areas = Area::active()
            ->select('id', 'name')
            ->orderBy('name')
            ->limit(500)
            ->get();

        return view('admin.cms.pages.edit', compact('page', 'states', 'cities', 'areas'));
    }

    /**
     * Update the specified page
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'area_id' => 'nullable|exists:areas,id',
            'page_type' => 'required|string|max:50',
            'template' => 'required|string|max:50',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['is_featured'] = $request->has('is_featured');

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($page->featured_image && file_exists(public_path($page->featured_image))) {
                unlink(public_path($page->featured_image));
            }

            $image = $request->file('featured_image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images/pages'), $imageName);
            $data['featured_image'] = 'images/pages/'.$imageName;
        }

        $page->update($data);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page updated successfully!');
    }

    /**
     * Remove the specified page
     */
    public function destroy(Page $page)
    {
        // Delete featured image if exists
        if ($page->featured_image && file_exists(public_path($page->featured_image))) {
            unlink(public_path($page->featured_image));
        }

        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page deleted successfully!');
    }

    /**
     * Upload image for page content
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images/pages'), $imageName);

            return response()->json([
                'success' => true,
                'url' => asset('images/pages/'.$imageName),
            ]);
        }

        return response()->json(['success' => false]);
    }
}
