<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of published projects
     */
    public function index(Request $request)
    {
        $query = Project::published()->with(['techStacks', 'developers', 'screenshots']);

        // Filter by tech stack
        if ($request->has('tech') && $request->tech !== '') {
            $query->whereHas('techStacks', function ($q) use ($request) {
                $q->where('slug', $request->tech);
            });
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $projects = $query->orderBy('sort_order', 'asc')
                         ->orderBy('created_at', 'desc')
                         ->paginate(12);

        return view('projects.index', compact('projects'));
    }

    /**
     * Display the specified project
     */
    public function show(Project $project)
    {
        // Only show published projects
        if ($project->status !== 'published') {
            abort(404);
        }

        $project->load(['techStacks', 'developers', 'screenshots', 'creator']);
        
        return view('projects.show', compact('project'));
    }
}
