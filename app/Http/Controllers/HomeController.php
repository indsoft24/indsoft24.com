<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured projects for the swiper
        $featuredProjects = Project::published()
            ->featured()
            ->with(['techStacks', 'screenshots'])
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('home', compact('featuredProjects'));
    }
    public function privacyPolicy()
    {
        return view('company.privacy-policy');
    }
    public function termsAndConditions()
    {
        return view('company.terms-and-conditions');
    }
    public function cookiePolicy()
    {
        return view('company.cookie-policy');
    }
}
