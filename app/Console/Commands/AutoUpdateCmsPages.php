<?php

namespace App\Console\Commands;

use App\Area;
use App\City;
use App\Page;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class AutoUpdateCmsPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:auto-update-pages 
                            {--update-existing : Update existing pages if data has changed}
                            {--cities-only : Only process cities}
                            {--areas-only : Only process areas}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically create and update CMS pages from existing cities and areas in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Starting CMS Pages Auto-Update Process...');
        $this->newLine();

        // Get or create a user for creating pages
        $user = User::first();
        if (! $user) {
            $this->error('❌ No user found. Please create a user first.');

            return 1;
        }

        $updateExisting = $this->option('update-existing');
        $citiesOnly = $this->option('cities-only');
        $areasOnly = $this->option('areas-only');

        $totalCreated = 0;
        $totalUpdated = 0;
        $totalSkipped = 0;

        // Process cities
        if (! $areasOnly) {
            $this->info('📋 Processing Cities...');
            $this->newLine();
            [$created, $updated, $skipped] = $this->processCities($user, $updateExisting);
            $totalCreated += $created;
            $totalUpdated += $updated;
            $totalSkipped += $skipped;
            $this->newLine();
        }

        // Process areas
        if (! $citiesOnly) {
            $this->info('📋 Processing Areas...');
            $this->newLine();
            [$created, $updated, $skipped] = $this->processAreas($user, $updateExisting);
            $totalCreated += $created;
            $totalUpdated += $updated;
            $totalSkipped += $skipped;
            $this->newLine();
        }

        // Summary
        $this->info('✅ Auto-Update Process Completed!');
        $this->table(
            ['Action', 'Count'],
            [
                ['Created', $totalCreated],
                ['Updated', $totalUpdated],
                ['Skipped', $totalSkipped],
                ['Total Processed', $totalCreated + $totalUpdated + $totalSkipped],
            ]
        );

        return 0;
    }

    /**
     * Process cities and create/update pages
     */
    private function processCities($user, $updateExisting): array
    {
        $created = 0;
        $updated = 0;
        $skipped = 0;

        // Fetch all active cities
        $cities = City::where('status', 1)->with('state')->get();
        $this->info("Found {$cities->count()} active cities to process...");

        if ($cities->count() == 0) {
            $this->warn('No active cities found.');

            return [0, 0, 0];
        }

        $bar = $this->output->createProgressBar($cities->count());
        $bar->start();

        foreach ($cities as $city) {
            try {
                $state = $city->state;
                if (! $state) {
                    $this->newLine();
                    $this->warn("  ⚠️  City '{$city->city_name}' has no state. Skipping...");
                    $skipped++;
                    $bar->advance();

                    continue;
                }

                // Check if page already exists
                $existingPage = Page::where('city_id', $city->id)
                    ->where('page_type', 'city')
                    ->first();

                if ($existingPage) {
                    if ($updateExisting) {
                        // Update existing page
                        $title = "Business Directory & Services in {$city->city_name}, {$state->name}";
                        $content = $this->generateCityPageContent($city, $state);
                        $excerpt = $this->generateCityExcerpt($city, $state);

                        $existingPage->update([
                            'title' => $title,
                            'content' => $content,
                            'excerpt' => $excerpt,
                            'is_featured' => $city->popular_cities == '1',
                            'meta_title' => "{$title} | Indsoft24",
                            'meta_description' => $excerpt,
                        ]);
                        $updated++;
                    } else {
                        $skipped++;
                    }
                } else {
                    // Create new page
                    $title = "Business Directory & Services in {$city->city_name}, {$state->name}";
                    $slug = Str::slug("business-directory-services-{$city->city_name}-{$state->name}");

                    // Ensure unique slug
                    $originalSlug = $slug;
                    $counter = 1;
                    while (Page::where('slug', $slug)->exists()) {
                        $slug = $originalSlug.'-'.$counter;
                        $counter++;
                    }

                    $content = $this->generateCityPageContent($city, $state);
                    $excerpt = $this->generateCityExcerpt($city, $state);

                    Page::create([
                        'title' => $title,
                        'slug' => $slug,
                        'content' => $content,
                        'excerpt' => $excerpt,
                        'status' => 'published',
                        'is_featured' => $city->popular_cities == '1',
                        'state_id' => $state->id,
                        'city_id' => $city->id,
                        'user_id' => $user->id,
                        'page_type' => 'city',
                        'template' => 'city',
                        'meta_title' => "{$title} | Indsoft24",
                        'meta_description' => $excerpt,
                        'published_at' => now(),
                    ]);
                    $created++;
                }
            } catch (\Exception $e) {
                $this->newLine();
                $this->error("  ❌ Error processing city '{$city->city_name}': ".$e->getMessage());
                $skipped++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("  ✅ Cities: {$created} created, {$updated} updated, {$skipped} skipped");

        return [$created, $updated, $skipped];
    }

    /**
     * Process areas and create/update pages
     */
    private function processAreas($user, $updateExisting): array
    {
        $created = 0;
        $updated = 0;
        $skipped = 0;

        // Fetch all active areas
        $areas = Area::where('status', 1)->with(['city', 'state'])->get();
        $this->info("Found {$areas->count()} active areas to process...");

        if ($areas->count() == 0) {
            $this->warn('No active areas found.');

            return [0, 0, 0];
        }

        $bar = $this->output->createProgressBar($areas->count());
        $bar->start();

        foreach ($areas as $area) {
            try {
                $city = $area->city;
                $state = $area->state;

                if (! $city || ! $state) {
                    $this->newLine();
                    $this->warn("  ⚠️  Area '{$area->name}' is missing city or state. Skipping...");
                    $skipped++;
                    $bar->advance();

                    continue;
                }

                // Check if page already exists
                $existingPage = Page::where('area_id', $area->id)
                    ->where('page_type', 'area')
                    ->first();

                if ($existingPage) {
                    if ($updateExisting) {
                        // Update existing page
                        $title = "Local Business Services in {$area->name}, {$city->city_name}";
                        $content = $this->generateAreaPageContent($area, $city, $state);
                        $excerpt = $this->generateAreaExcerpt($area, $city, $state);

                        $existingPage->update([
                            'title' => $title,
                            'content' => $content,
                            'excerpt' => $excerpt,
                            'meta_title' => "{$title} | Indsoft24",
                            'meta_description' => $excerpt,
                        ]);
                        $updated++;
                    } else {
                        $skipped++;
                    }
                } else {
                    // Create new page
                    $title = "Local Business Services in {$area->name}, {$city->city_name}";
                    $slug = Str::slug("local-business-services-{$area->slug}");

                    // Ensure unique slug
                    $originalSlug = $slug;
                    $counter = 1;
                    while (Page::where('slug', $slug)->exists()) {
                        $slug = $originalSlug.'-'.$counter;
                        $counter++;
                    }

                    $content = $this->generateAreaPageContent($area, $city, $state);
                    $excerpt = $this->generateAreaExcerpt($area, $city, $state);

                    Page::create([
                        'title' => $title,
                        'slug' => $slug,
                        'content' => $content,
                        'excerpt' => $excerpt,
                        'status' => 'published',
                        'is_featured' => false,
                        'state_id' => $state->id,
                        'city_id' => $city->id,
                        'area_id' => $area->id,
                        'user_id' => $user->id,
                        'page_type' => 'area',
                        'template' => 'area',
                        'meta_title' => "{$title} | Indsoft24",
                        'meta_description' => $excerpt,
                        'published_at' => now(),
                    ]);
                    $created++;
                }
            } catch (\Exception $e) {
                $this->newLine();
                $this->error("  ❌ Error processing area '{$area->name}': ".$e->getMessage());
                $skipped++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("  ✅ Areas: {$created} created, {$updated} updated, {$skipped} skipped");

        return [$created, $updated, $skipped];
    }

    /**
     * Generate city page content
     */
    private function generateCityPageContent($city, $state): string
    {
        $nearby = $city->nearby ? "Located near {$city->nearby}" : '';
        $popular = $city->popular_cities == '1' ? 'This is a popular destination' : '';

        return "<h2>Business Directory & Services in {$city->city_name}, {$state->name}</h2>
        <p>Welcome to {$city->city_name}, a vibrant city in {$state->name}. {$nearby}. {$popular}.</p>
        
        <h3>Why Choose {$city->city_name}?</h3>
        <p>{$city->city_name} offers excellent opportunities for businesses and entrepreneurs. Whether you're looking to start a new venture or expand your existing business, {$city->city_name} provides the perfect environment for growth.</p>
        
        <h3>Business Opportunities</h3>
        <ul>
            <li><strong>E-commerce Store Setup:</strong> Create your online store easily with our platform. Support for all categories including pharmaceuticals, textiles, hardware, software, real estate, bouquets, and more.</li>
            <li><strong>Local Business Directory:</strong> Get listed in our comprehensive business directory to reach more customers.</li>
            <li><strong>Digital Marketing Services:</strong> Promote your business with our digital marketing solutions.</li>
            <li><strong>Web Development:</strong> Professional website development services for your business.</li>
            <li><strong>Mobile App Development:</strong> Create mobile applications for iOS and Android platforms.</li>
        </ul>
        
        <h3>Industries We Support</h3>
        <p>Our platform supports businesses across various industries:</p>
        <ul>
            <li>Pharmaceutical & Healthcare</li>
            <li>Textile & Fashion</li>
            <li>Hardware & Electronics</li>
            <li>Software & IT Services</li>
            <li>Real Estate</li>
            <li>Floral & Gift Services</li>
            <li>Food & Beverage</li>
            <li>Education & Training</li>
            <li>Automotive</li>
            <li>And many more...</li>
        </ul>
        
        <h3>Get Started Today</h3>
        <p>Ready to establish your business in {$city->city_name}? Our platform makes it easy to set up your online store and start selling. With comprehensive support for all business categories, you can launch your e-commerce store in minutes.</p>
        
        <p>Contact us today to learn more about how we can help you grow your business in {$city->city_name}, {$state->name}.</p>";
    }

    /**
     * Generate city page excerpt
     */
    private function generateCityExcerpt($city, $state): string
    {
        return "Discover business opportunities and services in {$city->city_name}, {$state->name}. Set up your e-commerce store, get listed in our business directory, and grow your business with our comprehensive platform supporting all industries.";
    }

    /**
     * Generate area page content
     */
    private function generateAreaPageContent($area, $city, $state): string
    {
        $address = $area->address ? "Located at {$area->address}" : '';
        $types = $area->types ? 'Area type: '.str_replace('|', ', ', $area->types) : '';
        $mapLink = '';
        if ($area->latitude && $area->longitude) {
            $mapLink = "<p><a href='https://www.google.com/maps?q={$area->latitude},{$area->longitude}' target='_blank'>View on Google Maps</a></p>";
        }

        return "<h2>Local Business Services in {$area->name}, {$city->city_name}</h2>
        <p>Welcome to {$area->name}, a prime location in {$city->city_name}, {$state->name}. {$address}. {$types}.</p>
        
        <h3>About {$area->name}</h3>
        <p>{$area->name} is a well-established area in {$city->city_name}, offering excellent business opportunities and a thriving local economy. This area is perfect for businesses looking to establish a strong local presence.</p>
        
        {$mapLink}
        
        <h3>Business Services Available</h3>
        <ul>
            <li><strong>E-commerce Store Setup:</strong> Launch your online store quickly and easily. We support all business categories including pharmaceuticals, textiles, hardware, software, real estate, bouquets, and more.</li>
            <li><strong>Local Business Listing:</strong> Get your business listed in our directory to increase visibility and attract more customers.</li>
            <li><strong>Digital Solutions:</strong> Web development, mobile app development, and digital marketing services tailored for local businesses.</li>
            <li><strong>Business Support:</strong> Comprehensive support for setting up and managing your business operations.</li>
        </ul>
        
        <h3>Why Choose {$area->name}?</h3>
        <p>{$area->name} offers strategic advantages for businesses:</p>
        <ul>
            <li>Prime location in {$city->city_name}</li>
            <li>Excellent connectivity and accessibility</li>
            <li>Growing local market</li>
            <li>Supportive business environment</li>
            <li>Access to skilled workforce</li>
        </ul>
        
        <h3>Start Your Business Today</h3>
        <p>Ready to start or expand your business in {$area->name}? Our platform provides everything you need to set up your e-commerce store and establish your online presence. With support for all business categories, you can launch your store in minutes.</p>
        
        <p>Contact us to learn more about business opportunities in {$area->name}, {$city->city_name}, {$state->name}.</p>";
    }

    /**
     * Generate area page excerpt
     */
    private function generateAreaExcerpt($area, $city, $state): string
    {
        return "Explore business opportunities in {$area->name}, {$city->city_name}, {$state->name}. Set up your e-commerce store, get listed in our directory, and grow your local business with our comprehensive platform.";
    }
}
