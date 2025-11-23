<?php

namespace App\Console\Commands;

use App\Services\SitemapService;
use Illuminate\Console\Command;

class ClearSitemapCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all sitemap cache';

    /**
     * Execute the console command.
     */
    public function handle(SitemapService $sitemapService)
    {
        $sitemapService->clearCache();
        
        $this->info('Sitemap cache cleared successfully!');
        
        return 0;
    }
}

