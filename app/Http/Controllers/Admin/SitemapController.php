<?php

namespace App\Http\Controllers\Admin;

use App\Area;
use App\Category;
use App\City;
use App\Http\Controllers\Controller;
use App\Page;
use App\Post;
use App\Project;
use App\Services\SitemapService;
use App\State;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    protected $sitemapService;

    public function __construct(SitemapService $sitemapService)
    {
        $this->middleware('auth');
        $this->sitemapService = $sitemapService;
    }

    /**
     * Display sitemap management page
     */
    public function index()
    {
        $baseUrl = rtrim(config('app.url'), '/');

        // Get sitemap statistics
        $stats = [
            'total_posts' => Post::published()->count(),
            'total_pages' => Page::published()->count(),
            'total_states' => State::active()->count(),
            'total_cities' => City::active()->count(),
            'total_areas' => Area::active()->count(),
            'total_categories' => Category::active()->count(),
            'total_tags' => Tag::active()->count(),
            'total_projects' => Project::published()->count(),
        ];

        // Calculate sitemap file counts (using 25,000 URLs per sitemap as per XML sitemap standard)
        $maxUrlsPerSitemap = 25000;
        $sitemapCounts = [
            'posts' => ceil($stats['total_posts'] / $maxUrlsPerSitemap),
            'pages' => ceil($stats['total_pages'] / $maxUrlsPerSitemap),
            'cities' => ceil($stats['total_cities'] / $maxUrlsPerSitemap),
            'areas' => ceil($stats['total_areas'] / $maxUrlsPerSitemap),
        ];

        // Check cache status
        $cacheStatus = [
            'index' => Cache::has('sitemap_index'),
            'static' => Cache::has('sitemap_static_pages'),
            'states' => Cache::has('sitemap_states'),
            'categories' => Cache::has('sitemap_categories'),
            'tags' => Cache::has('sitemap_tags'),
            'projects' => Cache::has('sitemap_projects'),
        ];

        // Build sitemap URLs
        $sitemapUrls = [
            'index' => $baseUrl.'/sitemap.xml',
            'static' => $baseUrl.'/sitemap-static.xml',
            'states' => $baseUrl.'/sitemap-states.xml',
            'categories' => $baseUrl.'/sitemap-categories.xml',
            'tags' => $baseUrl.'/sitemap-tags.xml',
            'projects' => $baseUrl.'/sitemap-projects.xml',
        ];

        // Add paginated sitemaps
        for ($i = 1; $i <= $sitemapCounts['posts']; $i++) {
            $sitemapUrls['posts_'.$i] = $baseUrl."/sitemap-posts-{$i}.xml";
        }
        for ($i = 1; $i <= $sitemapCounts['pages']; $i++) {
            $sitemapUrls['pages_'.$i] = $baseUrl."/sitemap-pages-{$i}.xml";
        }
        for ($i = 1; $i <= $sitemapCounts['cities']; $i++) {
            $sitemapUrls['cities_'.$i] = $baseUrl."/sitemap-cities-{$i}.xml";
        }
        for ($i = 1; $i <= $sitemapCounts['areas']; $i++) {
            $sitemapUrls['areas_'.$i] = $baseUrl."/sitemap-areas-{$i}.xml";
        }

        return view('admin.sitemap.index', compact('stats', 'sitemapCounts', 'cacheStatus', 'sitemapUrls', 'baseUrl'));
    }

    /**
     * Clear sitemap cache
     */
    public function clearCache()
    {
        try {
            $this->sitemapService->clearCache();

            return redirect()->route('admin.sitemap.index')
                ->with('success', 'Sitemap cache cleared successfully! Sitemaps will be regenerated on next access.');
        } catch (\Exception $e) {
            return redirect()->route('admin.sitemap.index')
                ->with('error', 'Failed to clear cache: '.$e->getMessage());
        }
    }

    /**
     * Generate and preview a specific sitemap
     */
    public function preview(Request $request)
    {
        $type = $request->get('type', 'index');
        $page = $request->get('page', 1);

        try {
            switch ($type) {
                case 'index':
                    $xml = $this->sitemapService->generateIndex();
                    break;
                case 'static':
                    $xml = $this->sitemapService->generateStaticPages();
                    break;
                case 'posts':
                    $xml = $this->sitemapService->generatePosts($page);
                    break;
                case 'pages':
                    $xml = $this->sitemapService->generatePages($page);
                    break;
                case 'states':
                    $xml = $this->sitemapService->generateStates();
                    break;
                case 'cities':
                    $xml = $this->sitemapService->generateCities($page);
                    break;
                case 'areas':
                    $xml = $this->sitemapService->generateAreas($page);
                    break;
                case 'categories':
                    $xml = $this->sitemapService->generateCategories();
                    break;
                case 'tags':
                    $xml = $this->sitemapService->generateTags();
                    break;
                case 'projects':
                    $xml = $this->sitemapService->generateProjects();
                    break;
                default:
                    return response()->json(['error' => 'Invalid sitemap type'], 400);
            }

            return response($xml, 200)
                ->header('Content-Type', 'application/xml; charset=utf-8');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
