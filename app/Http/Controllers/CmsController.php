<?php

namespace App\Http\Controllers;

use App\Area;
use App\City;
use App\Page;
use App\Post;
use App\State;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    /**
     * Display pages by state
     */
    public function statePages(State $state)
    {
        $pages = $state->publishedPages()
            ->with([
                'city' => function ($q) {
                    $q->select('id', 'city_name');
                },
                'area' => function ($q) {
                    $q->select('id', 'name');
                },
                'user' => function ($q) {
                    $q->select('id', 'name');
                },
            ])
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        // Get cities for the state (for dynamic content)
        $cities = $state->activeCities()
            ->select('id', 'city_name')
            ->orderBy('city_name')
            ->get();

        // Get major cities (top 5-10 cities)
        $majorCities = $cities->take(10);
        $majorCitiesList = $majorCities->pluck('city_name')->toArray();
        $majorCitiesString = $majorCities->take(5)->pluck('city_name')->implode(', ');

        // Get capital city (first city or most popular)
        $capitalCity = $majorCities->first() ? $majorCities->first()->city_name : $state->name;

        // Enhanced SEO meta tags
        $metaTitle = "Digital Growth & IT Services in {$state->name} – Website, App & Digital Marketing Solutions | ".config('app.name');
        $metaDescription = "Grow your business digitally in {$state->name}. Professional website development, mobile app development, digital marketing, SEO, and social media marketing services. Serving businesses in {$majorCitiesString} and across {$state->name}.";

        // Get random blog posts
        $blogPosts = Post::published()
            ->with(['category', 'user'])
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('cms.state-pages', compact(
            'state',
            'pages',
            'metaTitle',
            'metaDescription',
            'blogPosts',
            'cities',
            'majorCities',
            'majorCitiesList',
            'majorCitiesString',
            'capitalCity'
        ));
    }

    /**
     * Display pages by city
     */
    public function cityPages(City $city)
    {
        $city->load(['state' => function ($q) {
            $q->select('id', 'name');
        }]);

        $pages = $city->publishedPages()
            ->with([
                'state' => function ($q) {
                    $q->select('id', 'name');
                },
                'area' => function ($q) {
                    $q->select('id', 'name');
                },
                'user' => function ($q) {
                    $q->select('id', 'name');
                },
            ])
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        // Get areas for the city
        $areas = $city->activeAreas()
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        // Get top areas (for content)
        $topAreas = $areas->take(5);
        $topAreasList = $topAreas->pluck('name')->toArray();
        $topAreasString = $topAreas->take(3)->pluck('name')->implode(', ');

        // Get a primary area (first area)
        $primaryArea = $topAreas->first() ? $topAreas->first()->name : $city->city_name;

        // Get nearby areas (if available in city model)
        $nearbyArea = $topAreas->skip(1)->first() ? $topAreas->skip(1)->first()->name : $primaryArea;

        // Enhanced SEO meta tags
        $metaTitle = "Website Development & Digital Marketing Services in {$city->city_name}, {$city->state->name} | ".config('app.name');
        $metaDescription = "Grow your business online in {$city->city_name}. Professional website development, mobile app development, digital marketing, SEO, and social media marketing services in {$city->city_name}, {$city->state->name}.";

        // Get random blog posts
        $blogPosts = Post::published()
            ->with(['category', 'user'])
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('cms.city-pages', compact(
            'city',
            'pages',
            'metaTitle',
            'metaDescription',
            'blogPosts',
            'areas',
            'topAreas',
            'topAreasList',
            'topAreasString',
            'primaryArea',
            'nearbyArea'
        ));
    }

    /**
     * Display pages by area
     */
    public function areaPages(Area $area)
    {
        $area->load([
            'city' => function ($q) {
                $q->select('id', 'city_name');
            },
            'state' => function ($q) {
                $q->select('id', 'name');
            },
        ]);

        $pages = $area->publishedPages()
            ->with([
                'state' => function ($q) {
                    $q->select('id', 'name');
                },
                'city' => function ($q) {
                    $q->select('id', 'city_name');
                },
                'user' => function ($q) {
                    $q->select('id', 'name');
                },
            ])
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        // Use the relationship method to get the city name
        $cityName = $area->city()->first() ? $area->city()->first()->city_name : $area->city;
        $stateName = $area->state()->first() ? $area->state()->first()->name : $area->state;

        // Get nearby areas in the same city
        $nearbyAreas = [];
        if ($area->city_id) {
            $nearbyAreas = Area::active()
                ->where('city_id', $area->city_id)
                ->where('id', '!=', $area->id)
                ->select('id', 'name')
                ->orderBy('name')
                ->take(5)
                ->get();
        }

        $nearbyAreaName = $nearbyAreas->first() ? $nearbyAreas->first()->name : $area->name;

        // Enhanced SEO meta tags
        $metaTitle = "Website Development & Digital Marketing Services in {$area->name}, {$cityName} | ".config('app.name');
        $metaDescription = "Grow your business online in {$area->name}, {$cityName}. Professional website development, mobile app development, digital marketing, SEO, and social media marketing services in {$area->name}, {$cityName}, {$stateName}.";

        // Get random blog posts
        $blogPosts = Post::published()
            ->with(['category', 'user'])
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('cms.area-pages', compact(
            'area',
            'pages',
            'metaTitle',
            'metaDescription',
            'cityName',
            'stateName',
            'blogPosts',
            'nearbyAreas',
            'nearbyAreaName'
        ));
    }

    /**
     * Display a single page
     */
    public function showPage(Page $page)
    {
        if ($page->status !== 'published') {
            abort(404);
        }

        $page->incrementViews();
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
            },
        ]);

        $metaTitle = $page->meta_title ?: $page->title.' | '.config('app.name');
        $metaDescription = $page->meta_description ?: $page->excerpt;

        // Get related pages from the same location
        $relatedPages = Page::published()
            ->select('id', 'title', 'slug', 'excerpt', 'featured_image', 'state_id', 'city_id', 'area_id', 'views_count', 'is_featured')
            ->where(function ($query) use ($page) {
                if ($page->area_id) {
                    $query->where('area_id', $page->area_id);
                } elseif ($page->city_id) {
                    $query->where('city_id', $page->city_id);
                } elseif ($page->state_id) {
                    $query->where('state_id', $page->state_id);
                }
            })
            ->where('id', '!=', $page->id)
            ->limit(5)
            ->get();

        // Get random blog posts
        $blogPosts = Post::published()
            ->with(['category', 'user'])
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('cms.page', compact('page', 'relatedPages', 'metaTitle', 'metaDescription', 'blogPosts'));
    }

    /**
     * Display all states
     */
    public function states()
    {
        // Use pagination or limit to prevent memory exhaustion
        $states = State::active()
            ->select('id', 'name', 'status')
            ->withCount('publishedPages')
            ->orderBy('name')
            ->paginate(50); // Paginate instead of loading all at once

        $metaTitle = 'Business Directory by State | Find Local Businesses & E-commerce Stores | '.config('app.name');
        $metaDescription = 'Discover businesses, e-commerce stores, and services across states in India. From pharmaceuticals to textiles, hardware to software - find everything you need.';

        // Get random blog posts
        $blogPosts = Post::published()
            ->with(['category', 'user'])
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('cms.states', compact('states', 'metaTitle', 'metaDescription', 'blogPosts'));
    }

    /**
     * Display cities by state
     */
    public function stateCities(State $state)
    {
        $cities = $state->activeCities()
            ->withCount('publishedPages')
            ->orderBy('city_name')
            ->paginate(12);

        $metaTitle = "Cities in {$state->name} | Business Directory & E-commerce Opportunities | ".config('app.name');
        $metaDescription = "Discover business opportunities and e-commerce solutions across {$cities->count()} cities in {$state->name}. Find local businesses, services, and set up your online store in any city.";

        // Get random blog posts
        $blogPosts = Post::published()
            ->with(['category', 'user'])
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('cms.state-cities', compact('state', 'cities', 'metaTitle', 'metaDescription', 'blogPosts'));
    }

    /**
     * Display areas by city
     */
    public function cityAreas(City $city)
    {
        $city->load(['state' => function ($q) {
            $q->select('id', 'name');
        }]);

        $areas = $city->activeAreas()
            ->withCount('publishedPages')
            ->orderBy('name')
            ->paginate(12);

        $metaTitle = "Areas in {$city->city_name}, {$city->state->name} | Business Directory & E-commerce Opportunities | ".config('app.name');
        $metaDescription = "Discover business opportunities and e-commerce solutions across {$areas->count()} areas in {$city->city_name}, {$city->state->name}. Find local businesses, services, and set up your online store in any area.";

        // Get random blog posts
        $blogPosts = Post::published()
            ->with(['category', 'user'])
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('cms.city-areas', compact('city', 'areas', 'metaTitle', 'metaDescription', 'blogPosts'));
    }

    /**
     * Search pages
     */
    public function search(Request $request)
    {
        // Optimize eager loading - only select needed columns
        $query = Page::published()
            ->with([
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
                },
            ]);

        if ($request->has('q') && $request->q !== '') {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%'.$searchTerm.'%')
                    ->orWhere('content', 'like', '%'.$searchTerm.'%')
                    ->orWhere('excerpt', 'like', '%'.$searchTerm.'%');
            });
        }

        if ($request->has('state') && $request->state !== '') {
            $query->where('state_id', $request->state);
        }

        if ($request->has('city') && $request->city !== '') {
            $query->where('city_id', $request->city);
        }

        if ($request->has('area') && $request->area !== '') {
            $query->where('area_id', $request->area);
        }

        if ($request->has('page_type') && $request->page_type !== '') {
            $query->where('page_type', $request->page_type);
        }

        $pages = $query->orderBy('published_at', 'desc')->paginate(10);

        // Limit dropdown options to prevent memory exhaustion
        // Only load what's needed for dropdowns (top 500 should be enough)
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

        $metaTitle = 'Search Pages | '.config('app.name');
        $metaDescription = 'Search through all published pages and content.';

        // Get random blog posts
        $blogPosts = Post::published()
            ->with(['category', 'user'])
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('cms.search', compact('pages', 'states', 'cities', 'areas', 'metaTitle', 'metaDescription', 'blogPosts'));
    }
}
