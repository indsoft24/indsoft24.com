<?php

namespace App\Http\Controllers;

use App\Area;
use App\City;
use App\Page;
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
                }
            ])
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        $metaTitle = "Businesses in {$state->name} | Local Directory & E-commerce Stores | ".config('app.name');
        $metaDescription = "Discover local businesses, e-commerce stores, and services in {$state->name}. Find everything from traditional shops to modern online stores. Perfect for all industries including pharmaceuticals, textiles, hardware, software, real estate, and more.";

        return view('cms.state-pages', compact('state', 'pages', 'metaTitle', 'metaDescription'));
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
                }
            ])
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        $metaTitle = "Pages in {$city->city_name}, {$city->state->name} | ".config('app.name');
        $metaDescription = "Browse all pages and content for {$city->city_name}, {$city->state->name}.";

        return view('cms.city-pages', compact('city', 'pages', 'metaTitle', 'metaDescription'));
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
            }
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
                }
            ])
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        // Use the relationship method to get the city name
        $cityName = $area->city()->first() ? $area->city()->first()->city_name : $area->city;
        $stateName = $area->state()->first() ? $area->state()->first()->name : $area->state;

        $metaTitle = "Pages in {$area->name}, {$cityName} | ".config('app.name');
        $metaDescription = "Browse all pages and content for {$area->name}, {$cityName}, {$stateName}.";

        return view('cms.area-pages', compact('area', 'pages', 'metaTitle', 'metaDescription', 'cityName', 'stateName'));
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
            }
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

        return view('cms.page', compact('page', 'relatedPages', 'metaTitle', 'metaDescription'));
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

        return view('cms.states', compact('states', 'metaTitle', 'metaDescription'));
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

        return view('cms.state-cities', compact('state', 'cities', 'metaTitle', 'metaDescription'));
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

        return view('cms.city-areas', compact('city', 'areas', 'metaTitle', 'metaDescription'));
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
                }
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

        return view('cms.search', compact('pages', 'states', 'cities', 'areas', 'metaTitle', 'metaDescription'));
    }
}
