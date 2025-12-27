<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of posts
     */
    public function index(Request $request)
    {
        $query = Post::with(['category', 'user', 'tags']);

        $isUserBlog = $request->route()->getName() && str_starts_with($request->route()->getName(), 'user.blog.');

        if ($isUserBlog) {
            $query->where('user_id', auth()->id());
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->has('category') && $request->category !== '') {
            $query->where('category_id', $request->category);
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(15);
        $categories = Category::active()->get();

        $view = $isUserBlog ? 'user.blog.index' : 'admin.posts.index';

        return view($view, compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new post
     */
    public function create(Request $request)
    {
        $categories = Category::active()->get();
        $tags = Tag::active()->get();

        // Check if this is a user blog route
        $isUserBlog = $request->route()->getName() && str_starts_with($request->route()->getName(), 'user.blog.');
        $view = $isUserBlog ? 'user.blog.create' : 'admin.posts.create';

        return view($view, compact('categories', 'tags'));
    }

    /**
     * Store a newly created post
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'excerpt' => 'nullable|string|max:500',
                'category_id' => 'required|exists:categories,id',
                'status' => 'required|in:draft,published,archived',
                'is_featured' => 'boolean',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:500',
                'tags' => 'sometimes|array',
                'tags.*' => 'integer',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
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

            // Store in public/images/posts directory
            $image->move(public_path('images/posts'), $imageName);
            $featuredImage = 'images/posts/' . $imageName;
        }

        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'featured_image' => $featuredImage,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'is_featured' => $request->has('is_featured'),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'user_id' => auth()->id(),
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        $isUserBlog = $request->route()->getName() && str_starts_with($request->route()->getName(), 'user.blog.');


        if ($request->has('tags')) {
            if ($isUserBlog) {
                $post->tags()->sync($request->tags);
            } else {
                $tagIds = [];
                foreach ($request->tags as $tagName) {
                    $tag = Tag::firstOrCreate(
                        ['name' => trim($tagName)],
                        ['slug' => Str::slug(trim($tagName))]
                    );
                    $tagIds[] = $tag->id;
                }
                $post->tags()->sync($tagIds);
            }
        }

        try {
            $isUserBlog = $request->route()->getName() && str_starts_with($request->route()->getName(), 'user.blog.');
            $redirectRoute = $isUserBlog ? 'user.blog.index' : 'admin.posts.index';

            // Check if this is an AJAX request
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post created successfully!',
                    'redirect' => route($redirectRoute),
                    'alert' => [
                        'title' => 'Success!',
                        'text' => 'Post created successfully!',
                        'icon' => 'success',
                        'confirmButtonText' => 'OK'
                    ]
                ]);
            }

            return redirect()->route($redirectRoute)
                ->with('success', 'Post created successfully!');
        } catch (\Exception $e) {
            \Log::error('Post creation failed: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while creating the post. Please try again.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'An error occurred while creating the post. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display the specified post
     */
    public function show(Request $request, Post $post)
    {
        // Check if this is a user blog route
        $isUserBlog = $request->route()->getName() && str_starts_with($request->route()->getName(), 'user.blog.');

        if ($isUserBlog) {
            // For user blog, ensure they can only view their own posts
            if ($post->user_id !== auth()->id()) {
                abort(403);
            }
        }

        $post->load(['category', 'user', 'tags']);

        $view = $isUserBlog ? 'user.blog.show' : 'admin.posts.show';
        return view($view, compact('post'));
    }

    /**
     * Show the form for editing the post
     */
    public function edit(Request $request, Post $post)
    {
        // Check if this is a user blog route
        $isUserBlog = $request->route()->getName() && str_starts_with($request->route()->getName(), 'user.blog.');

        if ($isUserBlog) {
            // For user blog, ensure they can only edit their own posts
            if ($post->user_id !== auth()->id()) {
                abort(403);
            }
        }

        $categories = Category::active()->get();
        $tags = Tag::active()->get();
        $selectedTags = $post->tags->pluck('id')->toArray();

        $view = $isUserBlog ? 'user.blog.edit' : 'admin.posts.edit';
        return view($view, compact('post', 'categories', 'tags', 'selectedTags'));
    }

    /**
     * Update the specified post
     */
    public function update(Request $request, Post $post)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'excerpt' => 'nullable|string|max:500',
                'category_id' => 'required|exists:categories,id',
                'status' => 'required|in:draft,published,archived',
                'is_featured' => 'boolean',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:500',
                'tags' => 'array',
                'tags.*' => 'string|max:255',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'remove_image' => 'nullable|boolean',
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
            if ($post->featured_image && file_exists(public_path($post->featured_image))) {
                unlink(public_path($post->featured_image));
            }

            $image = $request->file('featured_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store in public/images/posts directory
            $image->move(public_path('images/posts'), $imageName);
            $post->featured_image = 'images/posts/' . $imageName;
        } elseif ($request->boolean('remove_image')) {
            // Delete old image if exists
            if ($post->featured_image && file_exists(public_path($post->featured_image))) {
                unlink(public_path($post->featured_image));
            }
            $post->featured_image = null;
        }

        $updateData = [
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'content' => $request->input('content'),
            'excerpt' => $request->input('excerpt'),
            'category_id' => $request->input('category_id'),
            'status' => $request->input('status'),
            'is_featured' => $request->boolean('is_featured'),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ];

        // Handle published_at date
        if ($request->status === 'published' && !$post->published_at) {
            $updateData['published_at'] = now();
        }

        $post->update($updateData);

        $isUserBlog = $request->route()->getName() && str_starts_with($request->route()->getName(), 'user.blog.');


        if ($request->has('tags')) {
            if ($isUserBlog) {
                $post->tags()->sync($request->tags);
            } else {
                $tagIds = [];
                foreach ($request->tags as $tagName) {
                    $tag = Tag::firstOrCreate(
                        ['name' => trim($tagName)],
                        ['slug' => Str::slug(trim($tagName))]
                    );
                    $tagIds[] = $tag->id;
                }
                $post->tags()->sync($tagIds);
            }
        } else {
            $post->tags()->detach();
        }

        try {
            // Check if this is a user blog route
            $isUserBlog = $request->route()->getName() && str_starts_with($request->route()->getName(), 'user.blog.');
            $redirectRoute = $isUserBlog ? 'user.blog.index' : 'admin.posts.index';

            // Check if this is an AJAX request
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post updated successfully!',
                    'redirect' => route($redirectRoute),
                    'alert' => [
                        'title' => 'Success!',
                        'text' => 'Post updated successfully!',
                        'icon' => 'success',
                        'confirmButtonText' => 'OK'
                    ]
                ]);
            }

            return redirect()->route($redirectRoute)
                ->with('success', 'Post updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Post update failed: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while updating the post. Please try again.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'An error occurred while updating the post. Please try again.')
                ->withInput();
        }
    }

    /**
     * Remove the specified post
     */
    public function destroy(Request $request, Post $post)
    {
        // Check if this is a user blog route
        $isUserBlog = $request->route()->getName() && str_starts_with($request->route()->getName(), 'user.blog.');

        if ($isUserBlog) {
            // For user blog, ensure they can only delete their own posts
            if ($post->user_id !== auth()->id()) {
                abort(403);
            }
        }

        $post->delete();

        $redirectRoute = $isUserBlog ? 'user.blog.index' : 'admin.posts.index';

        // Check if this is an AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Post deleted successfully!',
                'redirect' => route($redirectRoute),
                'alert' => [
                    'title' => 'Success!',
                    'text' => 'Post deleted successfully!',
                    'icon' => 'success',
                    'confirmButtonText' => 'OK'
                ]
            ]);
        }

        return redirect()->route($redirectRoute)
            ->with('success', 'Post deleted successfully!');
    }


    /**
      * Handles image uploads from a WYSIWYG editor.
      *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        $fileKey = $request->hasFile('file') ? 'file' : 'upload';

        $request->validate([
            $fileKey => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file($fileKey)->store('post-images', 'public');

        $url = asset('storage/' . $path);

        return response()->json([
            'location' => $url
        ]);
    }
}
