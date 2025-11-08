<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Project;
use App\TechStack;
use App\ProjectScreenshot;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of projects
     */
    public function index(Request $request)
    {
        $query = Project::with(['creator', 'developers', 'techStacks', 'screenshots']);

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhere('client_name', 'like', '%' . $request->search . '%');
            });
        }

        $projects = $query->orderBy('sort_order', 'asc')
                         ->orderBy('created_at', 'desc')
                         ->paginate(15);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project
     */
    public function create()
    {
        $techStacks = TechStack::active()->orderBy('name')->get();
        $developers = User::all();
        
        return view('admin.projects.create', compact('techStacks', 'developers'));
    }

    /**
     * Store a newly created project
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
                'full_description' => 'nullable|string',
                'live_url' => 'nullable|url|max:255',
                'github_url' => 'nullable|url|max:255',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'status' => 'required|in:draft,published,archived',
                'is_featured' => 'boolean',
                'sort_order' => 'nullable|integer|min:0',
                'client_name' => 'nullable|string|max:255',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:500',
                'tech_stacks' => 'sometimes|array',
                'tech_stacks.*' => 'exists:tech_stacks,id',
                'developers' => 'sometimes|array',
                'developers.*' => 'exists:users,id',
                'developer_roles' => 'sometimes|array',
                'screenshots' => 'sometimes|array',
                'screenshots.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'screenshot_titles' => 'sometimes|array',
                'screenshot_descriptions' => 'sometimes|array',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }

        // Handle featured image
        $featuredImage = null;
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/projects'), $imageName);
            $featuredImage = 'images/projects/' . $imageName;
        }

        $project = Project::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'full_description' => $request->full_description,
            'live_url' => $request->live_url,
            'github_url' => $request->github_url,
            'featured_image' => $featuredImage,
            'status' => $request->status,
            'is_featured' => $request->has('is_featured'),
            'sort_order' => $request->sort_order ?? 0,
            'client_name' => $request->client_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'created_by' => auth()->id(),
        ]);

        // Sync tech stacks
        if ($request->has('tech_stacks')) {
            $project->techStacks()->sync($request->tech_stacks);
        }

        // Sync developers with roles
        if ($request->has('developers')) {
            $developersData = [];
            foreach ($request->developers as $index => $userId) {
                $developersData[$userId] = [
                    'role' => $request->developer_roles[$index] ?? null
                ];
            }
            $project->developers()->sync($developersData);
        }

        // Handle screenshots
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $index => $screenshot) {
                $imageName = time() . '_' . uniqid() . '_' . $index . '.' . $screenshot->getClientOriginalExtension();
                $screenshot->move(public_path('images/projects/screenshots'), $imageName);
                
                ProjectScreenshot::create([
                    'project_id' => $project->id,
                    'image_path' => 'images/projects/screenshots/' . $imageName,
                    'title' => $request->screenshot_titles[$index] ?? null,
                    'description' => $request->screenshot_descriptions[$index] ?? null,
                    'sort_order' => $index,
                ]);
            }
        }

        try {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Project created successfully!',
                    'redirect' => route('admin.projects.index'),
                ]);
            }

            return redirect()->route('admin.projects.index')
                ->with('success', 'Project created successfully!');
        } catch (\Exception $e) {
            \Log::error('Project creation failed: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while creating the project.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'An error occurred while creating the project.')
                ->withInput();
        }
    }

    /**
     * Display the specified project
     */
    public function show(Project $project)
    {
        $project->load(['creator', 'developers', 'techStacks', 'screenshots']);
        
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the project
     */
    public function edit(Project $project)
    {
        $project->load(['developers', 'techStacks', 'screenshots']);
        $techStacks = TechStack::active()->orderBy('name')->get();
        $developers = User::all();
        
        return view('admin.projects.edit', compact('project', 'techStacks', 'developers'));
    }

    /**
     * Update the specified project
     */
    public function update(Request $request, Project $project)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
                'full_description' => 'nullable|string',
                'live_url' => 'nullable|url|max:255',
                'github_url' => 'nullable|url|max:255',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'status' => 'required|in:draft,published,archived',
                'is_featured' => 'boolean',
                'sort_order' => 'nullable|integer|min:0',
                'client_name' => 'nullable|string|max:255',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:500',
                'tech_stacks' => 'sometimes|array',
                'tech_stacks.*' => 'exists:tech_stacks,id',
                'developers' => 'sometimes|array',
                'developers.*' => 'exists:users,id',
                'developer_roles' => 'sometimes|array',
                'screenshots' => 'sometimes|array',
                'screenshots.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'screenshot_titles' => 'sometimes|array',
                'screenshot_descriptions' => 'sometimes|array',
                'remove_image' => 'nullable|boolean',
                'remove_screenshots' => 'sometimes|array',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($project->featured_image && file_exists(public_path($project->featured_image))) {
                unlink(public_path($project->featured_image));
            }

            $image = $request->file('featured_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/projects'), $imageName);
            $project->featured_image = 'images/projects/' . $imageName;
        } elseif ($request->boolean('remove_image')) {
            if ($project->featured_image && file_exists(public_path($project->featured_image))) {
                unlink(public_path($project->featured_image));
            }
            $project->featured_image = null;
        }

        $updateData = [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'description' => $request->input('description'),
            'full_description' => $request->input('full_description'),
            'live_url' => $request->input('live_url'),
            'github_url' => $request->input('github_url'),
            'status' => $request->input('status'),
            'is_featured' => $request->boolean('is_featured'),
            'sort_order' => $request->input('sort_order', 0),
            'client_name' => $request->input('client_name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
        ];

        $project->update($updateData);

        // Sync tech stacks
        if ($request->has('tech_stacks')) {
            $project->techStacks()->sync($request->tech_stacks);
        } else {
            $project->techStacks()->detach();
        }

        // Sync developers with roles
        if ($request->has('developers')) {
            $developersData = [];
            foreach ($request->developers as $index => $userId) {
                $developersData[$userId] = [
                    'role' => $request->developer_roles[$index] ?? null
                ];
            }
            $project->developers()->sync($developersData);
        } else {
            $project->developers()->detach();
        }

        // Handle removing screenshots
        if ($request->has('remove_screenshots')) {
            foreach ($request->remove_screenshots as $screenshotId) {
                $screenshot = ProjectScreenshot::find($screenshotId);
                if ($screenshot && file_exists(public_path($screenshot->image_path))) {
                    unlink(public_path($screenshot->image_path));
                }
                $screenshot?->delete();
            }
        }

        // Handle new screenshots
        if ($request->hasFile('screenshots')) {
            $maxSortOrder = $project->screenshots()->max('sort_order') ?? -1;
            foreach ($request->file('screenshots') as $index => $screenshot) {
                $imageName = time() . '_' . uniqid() . '_' . $index . '.' . $screenshot->getClientOriginalExtension();
                $screenshot->move(public_path('images/projects/screenshots'), $imageName);
                
                ProjectScreenshot::create([
                    'project_id' => $project->id,
                    'image_path' => 'images/projects/screenshots/' . $imageName,
                    'title' => $request->screenshot_titles[$index] ?? null,
                    'description' => $request->screenshot_descriptions[$index] ?? null,
                    'sort_order' => $maxSortOrder + $index + 1,
                ]);
            }
        }

        try {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Project updated successfully!',
                    'redirect' => route('admin.projects.index'),
                ]);
            }

            return redirect()->route('admin.projects.index')
                ->with('success', 'Project updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Project update failed: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while updating the project.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'An error occurred while updating the project.')
                ->withInput();
        }
    }

    /**
     * Remove the specified project
     */
    public function destroy(Project $project)
    {
        // Delete featured image
        if ($project->featured_image && file_exists(public_path($project->featured_image))) {
            unlink(public_path($project->featured_image));
        }

        // Delete screenshots
        foreach ($project->screenshots as $screenshot) {
            if (file_exists(public_path($screenshot->image_path))) {
                unlink(public_path($screenshot->image_path));
            }
        }

        $project->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Project deleted successfully!',
            ]);
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}