<?php

namespace App\Http\Controllers;

use App\Services\SitemapService;

class SitemapController extends Controller
{
    protected $sitemapService;

    public function __construct(SitemapService $sitemapService)
    {
        $this->sitemapService = $sitemapService;
    }

    /**
     * Generate and return sitemap index
     */
    public function index()
    {
        $xml = $this->sitemapService->generateIndex();
        
        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }

    /**
     * Generate static pages sitemap
     */
    public function staticPages()
    {
        $xml = $this->sitemapService->generateStaticPages();
        
        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }

    /**
     * Generate blog posts sitemap
     */
    public function posts($page = 1)
    {
        $page = (int) $page;
        $xml = $this->sitemapService->generatePosts($page);
        
        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }

    /**
     * Generate blog categories sitemap
     */
    public function categories()
    {
        $xml = $this->sitemapService->generateCategories();
        
        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }

    /**
     * Generate blog tags sitemap
     */
    public function tags()
    {
        $xml = $this->sitemapService->generateTags();
        
        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }

    /**
     * Generate projects sitemap
     */
    public function projects()
    {
        $xml = $this->sitemapService->generateProjects();
        
        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }

    /**
     * Generate CMS pages sitemap
     */
    public function pages($page = 1)
    {
        $page = (int) $page;
        $xml = $this->sitemapService->generatePages($page);
        
        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }

    /**
     * Generate states sitemap
     */
    public function states()
    {
        $xml = $this->sitemapService->generateStates();
        
        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }

    /**
     * Generate cities sitemap
     */
    public function cities($page = 1)
    {
        $page = (int) $page;
        $xml = $this->sitemapService->generateCities($page);
        
        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }

    /**
     * Generate areas sitemap
     */
    public function areas($page = 1)
    {
        $page = (int) $page;
        $xml = $this->sitemapService->generateAreas($page);
        
        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }

    /**
     * Clear sitemap cache (useful for admin or cron jobs)
     */
    public function clearCache()
    {
        $this->sitemapService->clearCache();
        
        return response()->json([
            'message' => 'Sitemap cache cleared successfully'
        ]);
    }
}

