<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use App\Subscriber;
use App\ContactMessage;
use App\Lead;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show admin dashboard
     */
    public function index()
    {
        $stats = [
            'total_posts' => Post::count(),
            'published_posts' => Post::where('status', 'published')->count(),
            'draft_posts' => Post::where('status', 'draft')->count(),
            'total_categories' => Category::count(),
            'total_tags' => Tag::count(),
            'total_contacts' => ContactMessage::count(),
            'unread_contacts' => ContactMessage::where('is_read', false)->count(),
            'total_subscribers' => Subscriber::whereNotNull('email_verified_at')->count(),
            'total_leads' => Lead::count(),
            'new_leads' => Lead::where('status', 'new')->count(),
            'unread_leads' => Lead::where('is_read', false)->count(),
            'converted_leads' => Lead::where('status', 'converted')->count(),
        ];

        $recent_posts = Post::with(['category', 'user'])
                           ->orderBy('created_at', 'desc')
                           ->limit(5)
                           ->get();

        $recent_contacts = ContactMessage::orderBy('created_at', 'desc')
                                       ->limit(5)
                                       ->get();

        $popular_posts = Post::published()
                            ->orderBy('views_count', 'desc')
                            ->limit(5)
                            ->get();

        return view('admin.dashboard', compact('stats', 'recent_posts', 'recent_contacts', 'popular_posts'));
    }
}