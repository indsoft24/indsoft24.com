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

        // Filter by featured
        if ($request->has('featured') && $request->featured !== '') {
            $query->where('is_featured', $request->featured == '1');
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from !== '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to !== '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%'.$searchTerm.'%')
                    ->orWhere('content', 'like', '%'.$searchTerm.'%')
                    ->orWhere('excerpt', 'like', '%'.$searchTerm.'%')
                    ->orWhere('slug', 'like', '%'.$searchTerm.'%')
                    ->orWhereHas('state', function ($stateQuery) use ($searchTerm) {
                        $stateQuery->where('name', 'like', '%'.$searchTerm.'%');
                    })
                    ->orWhereHas('city', function ($cityQuery) use ($searchTerm) {
                        $cityQuery->where('city_name', 'like', '%'.$searchTerm.'%');
                    })
                    ->orWhereHas('area', function ($areaQuery) use ($searchTerm) {
                        $areaQuery->where('name', 'like', '%'.$searchTerm.'%');
                    });
            });
        }

        // Sort options
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $allowedSorts = ['created_at', 'updated_at', 'published_at', 'title', 'views_count'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $perPage = $request->get('per_page', 15);
        $pages = $query->paginate($perPage)->appends($request->query());
        
        // Statistics
        $stats = [
            'total' => Page::count(),
            'published' => Page::where('status', 'published')->count(),
            'draft' => Page::where('status', 'draft')->count(),
            'archived' => Page::where('status', 'archived')->count(),
            'featured' => Page::where('is_featured', true)->count(),
            'total_views' => Page::sum('views_count'),
        ];
        
        // Limit dropdown options to prevent memory exhaustion
        $states = State::active()
            ->select('id', 'name')
            ->orderBy('name')
            ->limit(500)
            ->get();
        
        // Only load cities if state is selected
        $cities = collect();
        if ($request->has('state') && $request->state !== '') {
            $cities = City::active()
                ->where('state_id', $request->state)
                ->select('id', 'city_name')
                ->orderBy('city_name')
                ->limit(500)
                ->get();
        } else {
            $cities = City::active()
                ->select('id', 'city_name')
                ->orderBy('city_name')
                ->limit(500)
                ->get();
        }
        
        // Only load areas if city is selected
        $areas = collect();
        if ($request->has('city') && $request->city !== '') {
            $areas = Area::active()
                ->where('city_id', $request->city)
                ->select('id', 'name')
                ->orderBy('name')
                ->limit(500)
                ->get();
        } else {
            $areas = Area::active()
                ->select('id', 'name')
                ->orderBy('name')
                ->limit(500)
                ->get();
        }

        return view('admin.cms.pages.index', compact('pages', 'states', 'cities', 'areas', 'stats'));
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

    /**
     * Bulk actions on pages
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,publish,draft,archive,unarchive,feature,unfeature',
            'page_ids' => 'required|array',
            'page_ids.*' => 'exists:pages,id',
        ]);

        $pageIds = $request->page_ids;
        $action = $request->action;
        $count = 0;

        switch ($action) {
            case 'delete':
                foreach ($pageIds as $pageId) {
                    $page = Page::find($pageId);
                    if ($page) {
                        if ($page->featured_image && file_exists(public_path($page->featured_image))) {
                            unlink(public_path($page->featured_image));
                        }
                        $page->delete();
                        $count++;
                    }
                }
                $message = "{$count} page(s) deleted successfully!";
                break;

            case 'publish':
                $count = Page::whereIn('id', $pageIds)->update([
                    'status' => 'published',
                    'published_at' => now(),
                ]);
                $message = "{$count} page(s) published successfully!";
                break;

            case 'draft':
                $count = Page::whereIn('id', $pageIds)->update(['status' => 'draft']);
                $message = "{$count} page(s) moved to draft successfully!";
                break;

            case 'archive':
                $count = Page::whereIn('id', $pageIds)->update(['status' => 'archived']);
                $message = "{$count} page(s) archived successfully!";
                break;

            case 'unarchive':
                $count = Page::whereIn('id', $pageIds)->update(['status' => 'draft']);
                $message = "{$count} page(s) unarchived successfully!";
                break;

            case 'feature':
                $count = Page::whereIn('id', $pageIds)->update(['is_featured' => true]);
                $message = "{$count} page(s) featured successfully!";
                break;

            case 'unfeature':
                $count = Page::whereIn('id', $pageIds)->update(['is_featured' => false]);
                $message = "{$count} page(s) unfeatured successfully!";
                break;

            default:
                return redirect()->back()->with('error', 'Invalid action!');
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Export pages to CSV
     */
    public function export(Request $request)
    {
        $query = Page::with(['state', 'city', 'area', 'user']);

        // Apply same filters as index
        if ($request->has('state') && $request->state !== '') {
            $query->where('state_id', $request->state);
        }
        if ($request->has('city') && $request->city !== '') {
            $query->where('city_id', $request->city);
        }
        if ($request->has('area') && $request->area !== '') {
            $query->where('area_id', $request->area);
        }
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        if ($request->has('page_type') && $request->page_type !== '') {
            $query->where('page_type', $request->page_type);
        }
        if ($request->has('search') && $request->search !== '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%'.$searchTerm.'%')
                    ->orWhere('content', 'like', '%'.$searchTerm.'%')
                    ->orWhere('excerpt', 'like', '%'.$searchTerm.'%');
            });
        }

        $pages = $query->orderBy('created_at', 'desc')->get();

        $filename = 'pages_export_'.date('Y-m-d_His').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($pages) {
            $file = fopen('php://output', 'w');
            
            // CSV Headers
            fputcsv($file, [
                'ID',
                'Title',
                'Slug',
                'Status',
                'Page Type',
                'Template',
                'Featured',
                'State',
                'City',
                'Area',
                'Author',
                'Views',
                'Created At',
                'Published At',
            ]);

            // CSV Data
            foreach ($pages as $page) {
                fputcsv($file, [
                    $page->id,
                    $page->title,
                    $page->slug,
                    $page->status,
                    $page->page_type,
                    $page->template,
                    $page->is_featured ? 'Yes' : 'No',
                    $page->state ? $page->state->name : '',
                    $page->city ? $page->city->city_name : '',
                    $page->area ? $page->area->name : '',
                    $page->user ? $page->user->name : '',
                    $page->views_count,
                    $page->created_at->format('Y-m-d H:i:s'),
                    $page->published_at ? $page->published_at->format('Y-m-d H:i:s') : '',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Duplicate a page
     */
    public function duplicate(Request $request, Page $page)
    {
        $newPage = $page->replicate();
        $newPage->title = $page->title.' (Copy)';
        $newPage->slug = Str::slug($newPage->title).'-'.time();
        $newPage->status = 'draft';
        $newPage->is_featured = false;
        $newPage->views_count = 0;
        $newPage->published_at = null;
        $newPage->user_id = auth()->id();
        $newPage->save();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Page duplicated successfully!',
                'redirect' => route('admin.pages.edit', $newPage),
            ]);
        }

        return redirect()->route('admin.pages.edit', $newPage)
            ->with('success', 'Page duplicated successfully!');
    }

    /**
     * Quick status update
     */
    public function quickUpdateStatus(Request $request, Page $page)
    {
        $request->validate([
            'status' => 'required|in:draft,published,archived',
        ]);

        $page->status = $request->status;
        if ($request->status === 'published' && !$page->published_at) {
            $page->published_at = now();
        }
        $page->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!',
            'status' => $page->status,
        ]);
    }

    /**
     * Quick toggle featured
     */
    public function quickToggleFeatured(Page $page)
    {
        $page->is_featured = !$page->is_featured;
        $page->save();

        return response()->json([
            'success' => true,
            'message' => $page->is_featured ? 'Page featured!' : 'Page unfeatured!',
            'is_featured' => $page->is_featured,
        ]);
    }
}
