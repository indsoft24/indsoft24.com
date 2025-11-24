<?php

namespace App\Services;

use App\Area;
use App\Category;
use App\City;
use App\Page;
use App\Post;
use App\Project;
use App\State;
use App\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;

class SitemapService
{
    /**
     * Maximum URLs per sitemap file (XML sitemap limit is 50,000, but using 25,000 for better performance)
     */
    const MAX_URLS_PER_SITEMAP = 25000;

    /**
     * Cache duration in minutes
     */
    const CACHE_DURATION = 1440; // 24 hours

    /**
     * Get the base URL for sitemaps
     */
    protected function getBaseUrl(): string
    {
        return rtrim(config('app.url'), '/');
    }

    /**
     * Generate sitemap index XML
     */
    public function generateIndex(): string
    {
        $cacheKey = 'sitemap_index';

        return Cache::remember($cacheKey, self::CACHE_DURATION, function () {
            $sitemaps = [];

            // Static pages sitemap
            $sitemaps[] = [
                'loc' => $this->getBaseUrl().'/sitemap-static.xml',
                'lastmod' => now()->toAtomString(),
            ];

            // Blog posts sitemap (may be split into multiple)
            $postCount = Post::published()->count();
            $postSitemapCount = ceil($postCount / self::MAX_URLS_PER_SITEMAP);
            for ($i = 1; $i <= $postSitemapCount; $i++) {
                $sitemaps[] = [
                    'loc' => $this->getBaseUrl()."/sitemap-posts-{$i}.xml",
                    'lastmod' => now()->toAtomString(),
                ];
            }

            // Blog categories sitemap
            $categoryCount = Category::active()->count();
            if ($categoryCount > 0) {
                $sitemaps[] = [
                    'loc' => $this->getBaseUrl().'/sitemap-categories.xml',
                    'lastmod' => now()->toAtomString(),
                ];
            }

            // Blog tags sitemap
            $tagCount = Tag::active()->count();
            if ($tagCount > 0) {
                $sitemaps[] = [
                    'loc' => $this->getBaseUrl().'/sitemap-tags.xml',
                    'lastmod' => now()->toAtomString(),
                ];
            }

            // Projects sitemap
            $projectCount = Project::published()->count();
            if ($projectCount > 0) {
                $sitemaps[] = [
                    'loc' => $this->getBaseUrl().'/sitemap-projects.xml',
                    'lastmod' => now()->toAtomString(),
                ];
            }

            // CMS Pages sitemap (may be split into multiple)
            $pageCount = Page::published()->count();
            $pageSitemapCount = ceil($pageCount / self::MAX_URLS_PER_SITEMAP);
            for ($i = 1; $i <= $pageSitemapCount; $i++) {
                $sitemaps[] = [
                    'loc' => $this->getBaseUrl()."/sitemap-pages-{$i}.xml",
                    'lastmod' => now()->toAtomString(),
                ];
            }

            // States sitemap
            $stateCount = State::active()->count();
            if ($stateCount > 0) {
                $sitemaps[] = [
                    'loc' => $this->getBaseUrl().'/sitemap-states.xml',
                    'lastmod' => now()->toAtomString(),
                ];
            }

            // Cities sitemap (may be split into multiple)
            $cityCount = City::active()->count();
            $citySitemapCount = ceil($cityCount / self::MAX_URLS_PER_SITEMAP);
            for ($i = 1; $i <= $citySitemapCount; $i++) {
                $sitemaps[] = [
                    'loc' => $this->getBaseUrl()."/sitemap-cities-{$i}.xml",
                    'lastmod' => now()->toAtomString(),
                ];
            }

            // Areas sitemap (may be split into multiple)
            $areaCount = Area::active()->count();
            $areaSitemapCount = ceil($areaCount / self::MAX_URLS_PER_SITEMAP);
            for ($i = 1; $i <= $areaSitemapCount; $i++) {
                $sitemaps[] = [
                    'loc' => $this->getBaseUrl()."/sitemap-areas-{$i}.xml",
                    'lastmod' => now()->toAtomString(),
                ];
            }

            return $this->buildSitemapIndex($sitemaps);
        });
    }

    /**
     * Generate static pages sitemap
     */
    public function generateStaticPages(): string
    {
        $cacheKey = 'sitemap_static_pages';

        return Cache::remember($cacheKey, self::CACHE_DURATION, function () {
            $urls = [
                [
                    'loc' => $this->getBaseUrl().'/',
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'daily',
                    'priority' => '1.0',
                ],
                [
                    'loc' => $this->getBaseUrl().'/about-us',
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.8',
                ],
                [
                    'loc' => $this->getBaseUrl().'/our-team',
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.8',
                ],
                [
                    'loc' => $this->getBaseUrl().'/blog',
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'daily',
                    'priority' => '0.9',
                ],
                [
                    'loc' => $this->getBaseUrl().'/projects',
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.8',
                ],
                [
                    'loc' => $this->getBaseUrl().'/career',
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.7',
                ],
                [
                    'loc' => $this->getBaseUrl().'/web-development',
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.8',
                ],
                [
                    'loc' => $this->getBaseUrl().'/app-development',
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.8',
                ],
                [
                    'loc' => $this->getBaseUrl().'/software-development',
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.8',
                ],
                [
                    'loc' => $this->getBaseUrl().'/seo-services',
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.8',
                ],
                [
                    'loc' => $this->getBaseUrl().'/e-commerce',
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.8',
                ],
                [
                    'loc' => $this->getBaseUrl().'/privacy-policy',
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'yearly',
                    'priority' => '0.3',
                ],
                [
                    'loc' => $this->getBaseUrl().'/terms-conditions',
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'yearly',
                    'priority' => '0.3',
                ],
                [
                    'loc' => $this->getBaseUrl().'/cookie-policy',
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'yearly',
                    'priority' => '0.3',
                ],
                [
                    'loc' => $this->getBaseUrl().'/cms/states',
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.7',
                ],
                [
                    'loc' => $this->getBaseUrl().'/cms/search',
                    'lastmod' => now()->toAtomString(),
                    'changefreq' => 'daily',
                    'priority' => '0.6',
                ],
            ];

            return $this->buildSitemap($urls);
        });
    }

    /**
     * Generate blog posts sitemap
     */
    public function generatePosts(int $page = 1): string
    {
        $cacheKey = "sitemap_posts_{$page}";

        return Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($page) {
            $offset = ($page - 1) * self::MAX_URLS_PER_SITEMAP;

            $posts = Post::published()
                ->select('slug', 'updated_at', 'published_at')
                ->orderBy('published_at', 'desc')
                ->offset($offset)
                ->limit(self::MAX_URLS_PER_SITEMAP)
                ->get();

            $urls = $posts->map(function ($post) {
                return [
                    'loc' => $this->getBaseUrl().'/blog/'.$post->slug,
                    'lastmod' => ($post->updated_at ?? $post->published_at)->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.7',
                ];
            })->toArray();

            return $this->buildSitemap($urls);
        });
    }

    /**
     * Generate blog categories sitemap
     */
    public function generateCategories(): string
    {
        $cacheKey = 'sitemap_categories';

        return Cache::remember($cacheKey, self::CACHE_DURATION, function () {
            $categories = Category::active()
                ->select('slug', 'updated_at')
                ->get();

            $urls = $categories->map(function ($category) {
                return [
                    'loc' => $this->getBaseUrl().'/blog/category/'.$category->slug,
                    'lastmod' => $category->updated_at->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.6',
                ];
            })->toArray();

            return $this->buildSitemap($urls);
        });
    }

    /**
     * Generate blog tags sitemap
     */
    public function generateTags(): string
    {
        $cacheKey = 'sitemap_tags';

        return Cache::remember($cacheKey, self::CACHE_DURATION, function () {
            $tags = Tag::active()
                ->select('slug', 'updated_at')
                ->get();

            $urls = $tags->map(function ($tag) {
                return [
                    'loc' => $this->getBaseUrl().'/blog/tag/'.$tag->slug,
                    'lastmod' => $tag->updated_at->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.6',
                ];
            })->toArray();

            return $this->buildSitemap($urls);
        });
    }

    /**
     * Generate projects sitemap
     */
    public function generateProjects(): string
    {
        $cacheKey = 'sitemap_projects';

        return Cache::remember($cacheKey, self::CACHE_DURATION, function () {
            $projects = Project::published()
                ->select('slug', 'updated_at')
                ->get();

            $urls = $projects->map(function ($project) {
                return [
                    'loc' => $this->getBaseUrl().'/projects/'.$project->slug,
                    'lastmod' => $project->updated_at->toAtomString(),
                    'changefreq' => 'monthly',
                    'priority' => '0.7',
                ];
            })->toArray();

            return $this->buildSitemap($urls);
        });
    }

    /**
     * Generate CMS pages sitemap (handles millions of pages)
     */
    public function generatePages(int $page = 1): string
    {
        $cacheKey = "sitemap_pages_{$page}";

        return Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($page) {
            $offset = ($page - 1) * self::MAX_URLS_PER_SITEMAP;

            // Use chunking for efficient memory usage
            $pages = Page::published()
                ->select('id', 'slug', 'state_id', 'city_id', 'area_id', 'updated_at', 'published_at')
                ->orderBy('id', 'asc')
                ->offset($offset)
                ->limit(self::MAX_URLS_PER_SITEMAP)
                ->get();

            $urls = [];
            foreach ($pages as $pageModel) {
                // Build URL based on location hierarchy
                $url = $this->getBaseUrl().'/cms/page/'.$pageModel->slug;

                $urls[] = [
                    'loc' => $url,
                    'lastmod' => ($pageModel->updated_at ?? $pageModel->published_at)->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.8',
                ];
            }

            return $this->buildSitemap($urls);
        });
    }

    /**
     * Generate states sitemap
     */
    public function generateStates(): string
    {
        $cacheKey = 'sitemap_states';

        return Cache::remember($cacheKey, self::CACHE_DURATION, function () {
            $states = State::active()
                ->select('name', 'updated_at')
                ->get();

            $urls = [];
            foreach ($states as $state) {
                // State route uses 'slug' as route key
                $stateSlug = $state->slug ?? \Illuminate\Support\Str::slug($state->name);

                // Add state pages URL
                $urls[] = [
                    'loc' => $this->getBaseUrl().'/cms/state/'.$stateSlug,
                    'lastmod' => $state->updated_at->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.7',
                ];

                // Add state cities URL
                $urls[] = [
                    'loc' => $this->getBaseUrl().'/cms/state/'.$stateSlug.'/cities',
                    'lastmod' => $state->updated_at->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.6',
                ];
            }

            return $this->buildSitemap($urls);
        });
    }

    /**
     * Generate cities sitemap
     */
    public function generateCities(int $page = 1): string
    {
        $cacheKey = "sitemap_cities_{$page}";

        return Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($page) {
            $offset = ($page - 1) * self::MAX_URLS_PER_SITEMAP;

            $cities = City::active()
                ->select('id', 'city_name', 'state_id', 'updated_at')
                ->with('state:id,name')
                ->orderBy('id', 'asc')
                ->offset($offset)
                ->limit(self::MAX_URLS_PER_SITEMAP)
                ->get();

            $urls = [];
            foreach ($cities as $city) {
                // City route uses 'slug' as route key
                $citySlug = $city->slug ?? \Illuminate\Support\Str::slug($city->city_name);

                // Add city pages URL
                $urls[] = [
                    'loc' => $this->getBaseUrl().'/cms/city/'.$citySlug,
                    'lastmod' => $city->updated_at->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.6',
                ];

                // Add city areas URL
                $urls[] = [
                    'loc' => $this->getBaseUrl().'/cms/city/'.$citySlug.'/areas',
                    'lastmod' => $city->updated_at->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.5',
                ];
            }

            return $this->buildSitemap($urls);
        });
    }

    /**
     * Generate areas sitemap
     */
    public function generateAreas(int $page = 1): string
    {
        $cacheKey = "sitemap_areas_{$page}";

        return Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($page) {
            $offset = ($page - 1) * self::MAX_URLS_PER_SITEMAP;

            $areas = Area::active()
                ->select('id', 'name', 'city_id', 'updated_at')
                ->orderBy('id', 'asc')
                ->offset($offset)
                ->limit(self::MAX_URLS_PER_SITEMAP)
                ->get();

            $urls = [];
            foreach ($areas as $area) {
                $slug = \Illuminate\Support\Str::slug($area->name);
                $urls[] = [
                    'loc' => $this->getBaseUrl().'/cms/area/'.$slug,
                    'lastmod' => $area->updated_at->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => '0.6',
                ];
            }

            return $this->buildSitemap($urls);
        });
    }

    /**
     * Build sitemap index XML
     */
    protected function buildSitemapIndex(array $sitemaps): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($sitemaps as $sitemap) {
            $xml .= "  <sitemap>\n";
            $xml .= '    <loc>'.htmlspecialchars($sitemap['loc'], ENT_XML1, 'UTF-8')."</loc>\n";
            $xml .= '    <lastmod>'.htmlspecialchars($sitemap['lastmod'], ENT_XML1, 'UTF-8')."</lastmod>\n";
            $xml .= "  </sitemap>\n";
        }

        $xml .= '</sitemapindex>';

        return $xml;
    }

    /**
     * Build sitemap XML
     */
    protected function buildSitemap(array $urls): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>'.htmlspecialchars($url['loc'], ENT_XML1, 'UTF-8')."</loc>\n";

            if (isset($url['lastmod'])) {
                $xml .= '    <lastmod>'.htmlspecialchars($url['lastmod'], ENT_XML1, 'UTF-8')."</lastmod>\n";
            }

            if (isset($url['changefreq'])) {
                $xml .= '    <changefreq>'.htmlspecialchars($url['changefreq'], ENT_XML1, 'UTF-8')."</changefreq>\n";
            }

            if (isset($url['priority'])) {
                $xml .= '    <priority>'.htmlspecialchars($url['priority'], ENT_XML1, 'UTF-8')."</priority>\n";
            }

            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }

    /**
     * Clear all sitemap cache
     */
    public function clearCache(): void
    {
        // Clear index
        Cache::forget('sitemap_index');

        // Clear static pages
        Cache::forget('sitemap_static_pages');

        // Clear categories and tags
        Cache::forget('sitemap_categories');
        Cache::forget('sitemap_tags');

        // Clear projects
        Cache::forget('sitemap_projects');

        // Clear states
        Cache::forget('sitemap_states');

        // Clear dynamic sitemaps (posts, pages, cities, areas)
        // Note: In production, you might want to use cache tags for easier clearing
        $postCount = Post::published()->count();
        $postSitemapCount = ceil($postCount / self::MAX_URLS_PER_SITEMAP);
        for ($i = 1; $i <= $postSitemapCount; $i++) {
            Cache::forget("sitemap_posts_{$i}");
        }

        $pageCount = Page::published()->count();
        $pageSitemapCount = ceil($pageCount / self::MAX_URLS_PER_SITEMAP);
        for ($i = 1; $i <= $pageSitemapCount; $i++) {
            Cache::forget("sitemap_pages_{$i}");
        }

        $cityCount = City::active()->count();
        $citySitemapCount = ceil($cityCount / self::MAX_URLS_PER_SITEMAP);
        for ($i = 1; $i <= $citySitemapCount; $i++) {
            Cache::forget("sitemap_cities_{$i}");
        }

        $areaCount = Area::active()->count();
        $areaSitemapCount = ceil($areaCount / self::MAX_URLS_PER_SITEMAP);
        for ($i = 1; $i <= $areaSitemapCount; $i++) {
            Cache::forget("sitemap_areas_{$i}");
        }
    }
}
