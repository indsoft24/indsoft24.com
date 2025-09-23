<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Make sure Str is imported

class BlogController extends Controller
{
    /**
     * Display blog homepage with posts
     */
    public function index(Request $request)
    {
        // ... (your existing query logic)
        $query = Post::published()->with(['category', 'user', 'tags']);
        if ($request->has('search') && $request->search !== '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }
        
        $canonicalUrl = route('blog.index');
        
        // ADDED: Define a meta description for the blog homepage
        $metaDescription = 'Thoughts of Thousand is a creative platform to share your voice through blogs, poetry, articles, and news. Explore diverse ideas, express freely, and connect with a community of thinkers and storytellers.';

        $posts = $query->orderBy('published_at', 'desc')->paginate(10);
        $featuredPosts = Post::published()
                        ->featured()
                        ->latest()   // orders by created_at desc
                        ->limit(3)
                        ->get();
                        
        $categories = Category::active()
                        ->withCount('publishedPosts')
                        ->orderBy('published_posts_count', 'desc') // or 'asc'
                        ->get();
                        
        $tags = Tag::active()->withCount('publishedPosts')->get();
        $recentPosts = Post::published()->recent(5)->get();
        
        // MODIFIED: Pass the new $metaDescription variable
        return view('blog.index', compact('posts', 'featuredPosts', 'categories', 'tags', 'recentPosts', 'canonicalUrl', 'metaDescription'));
    }

    /**
     * Display a single blog post
     */
    public function show(Post $post)
    {
        if ($post->status !== 'published') {
            abort(404);
        }
    
        $post->incrementViews();
    
        $post->load(['category', 'user', 'tags', 'comments.user'])->loadCount('likes');
    
        $isLiked = auth()->check() ? $post->likes()->where('user_id', auth()->id())->exists() : false;
    
        $relatedPosts = Post::published()
                            ->where('category_id', $post->category_id)
                            ->where('id', '!=', $post->id)
                            ->limit(3)
                            ->get();
    
        $recentPosts = Post::published()
                           ->where('id', '!=', $post->id)
                           ->recent(5)
                           ->get();
    
        // --- ADD THESE VARIABLES ---
        $metaTitle = $post->meta_title ?: $post->title . ' | ' . config('app.name');
        $metaDescription = $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?: $post->content), 160);
    
        return view('blog.show', compact(
            'post', 
            'relatedPosts', 
            'recentPosts', 
            'isLiked', 
            'metaTitle', 
            'metaDescription'
        ));
    }


    /**
     * Display posts by category
     */
    public function category(Category $category)
    {
        $posts = $category->publishedPosts()
                          ->with(['user', 'tags'])
                          ->orderBy('published_at', 'desc')
                          ->paginate(10);
                          
        // ADDED: Define meta description from the category's description
        $metaDescription = $category->description ?: "Browse all articles and posts filed under the category: {$category->name}.";

        $allCategories = Category::active()->withCount('publishedPosts')->get();
        $popularTags = Tag::active()->withCount('publishedPosts')->get();
        $recentPosts = Post::published()->recent(5)->get();
        $canonicalUrl = route('blog.category', $category);

        // MODIFIED: Pass the new $metaDescription variable
        return view('blog.category', compact('posts', 'category', 'allCategories', 'popularTags', 'recentPosts', 'canonicalUrl', 'metaDescription'));
    }

    /**
     * Display posts by tag
     */
    public function tag(Tag $tag)
    {
        $posts = $tag->publishedPosts()
                     ->with(['category', 'user'])
                     ->orderBy('published_at', 'desc')
                     ->paginate(9);
                     
        // ADDED: Define meta description from the tag's description
        $metaDescription = $tag->description ?: "Explore all articles and posts tagged with: {$tag->name}.";

        $allCategories = Category::active()->withCount('publishedPosts')->get();
        $popularTags = Tag::active()->withCount('publishedPosts')->get();
        $recentPosts = Post::published()->recent(5)->get();
        $canonicalUrl = route('blog.tag', $tag);

        // MODIFIED: Pass the new $metaDescription variable
        return view('blog.tag', compact('posts', 'tag', 'allCategories', 'popularTags', 'recentPosts', 'canonicalUrl', 'metaDescription'));
    }
}