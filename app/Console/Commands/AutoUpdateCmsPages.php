<?php

namespace App\Console\Commands;

use App\Area;
use App\City;
use App\Page;
use App\State;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
                            {--chunk-size=100 : Number of areas to process in each batch}
                            {--start-id=0 : Start processing from this area ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically create and update CMS pages from existing areas in database';

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

        $totalCreated = 0;
        $totalUpdated = 0;
        $totalSkipped = 0;

        // Process areas
        $this->info('📋 Processing Areas...');
        $this->newLine();
        [$created, $updated, $skipped] = $this->processAreas($user, $updateExisting);
        $totalCreated += $created;
        $totalUpdated += $updated;
        $totalSkipped += $skipped;
        $this->newLine();

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
     * Process areas and create/update pages
     */
    private function processAreas($user, $updateExisting): array
    {
        $created = 0;
        $updated = 0;
        $skipped = 0;
        $errors = 0;

        $chunkSize = (int) $this->option('chunk-size');
        $startId = (int) $this->option('start-id');

        // Get total count for progress bar
        $totalCount = Area::where('status', 1)
            ->where('id', '>', max($startId, 7693))
            ->count();

        // Get count of existing pages before processing
        $existingPagesBefore = Page::where('page_type', 'area')
            ->where('area_id', '>', 0)
            ->count();

        $this->info("Found {$totalCount} active areas to process...");
        $this->info("Processing in chunks of {$chunkSize} areas...");
        $this->info("Existing area pages in database: {$existingPagesBefore}");
        $this->newLine();

        if ($totalCount == 0) {
            $this->warn('No active areas found.');

            return [0, 0, 0];
        }

        $bar = $this->output->createProgressBar($totalCount);
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $bar->start();

        $processed = 0;
        $lastProcessedId = $startId;

        // Process areas in chunks to avoid memory issues
        // Load areas without eager loading relationships to avoid issues
        Area::where('status', 1)
            ->where('id', '>', max($startId, 7646))
            ->orderBy('id', 'asc')
            ->chunk($chunkSize, function ($areas) use ($user, $updateExisting, &$created, &$updated, &$skipped, &$errors, &$processed, &$lastProcessedId, $bar) {
                foreach ($areas as $area) {
                    try {
                        // Ensure database connection is alive
                        try {
                            DB::connection()->getPdo();
                        } catch (\Exception $e) {
                            // Reconnect if connection is lost
                            DB::reconnect();
                        }

                        // Validate area has required data BEFORE starting transaction
                        if (empty($area->name)) {
                            $skipped++;
                            $bar->advance();

                            continue; // Skip to next area
                        }

                        // Process one area at a time with transaction
                        // Use try-catch inside transaction to handle errors properly
                        try {
                            DB::beginTransaction();

                            // Generate slug if missing
                            if (empty($area->slug)) {
                                $area->slug = Str::slug($area->name);
                            }

                            // Get state relationship properly - check if it's a model instance or string
                            $state = null;
                            $stateName = 'Unknown State';

                            if ($area->state_id) {
                                $state = $area->state;
                                if (! $state instanceof State) {
                                    $state = State::select('id', 'name')->find($area->state_id);
                                }

                                if ($state && ! empty($state->name)) {
                                    $stateName = $state->name;
                                }
                            }

                            // Get city relationship properly - check if it's a model instance or string
                            // City is optional - process area even without city
                            $city = null;
                            if ($area->city_id) {
                                try {
                                    $city = $area->city;
                                    if (! $city instanceof City) {
                                        $city = City::select('id', 'city_name')->find($area->city_id);
                                    }
                                } catch (\Exception $e) {
                                    // City not found or invalid - continue without city
                                    $city = null;
                                }
                            }

                            // Check if page already exists (optimized query)
                            $pageExists = Page::where('area_id', $area->id)
                                ->where('page_type', 'area')
                                ->exists();

                            if ($pageExists) {
                                if ($updateExisting) {
                                    $existingPage = Page::where('area_id', $area->id)
                                        ->where('page_type', 'area')
                                        ->first();

                                    if ($existingPage) {
                                        // Update existing page
                                        $title = "Web Development, App Development & E-commerce Store in {$area->name}, {$stateName} | Local Business Services";
                                        $content = $this->generateAreaPageContent($area, $stateName);
                                        $excerpt = $this->generateAreaExcerpt($area, $stateName);

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
                                    $skipped++;
                                }
                            } else {
                                // Create new page - process ALL areas regardless of city
                                $title = "Web Development, App Development & E-commerce Store in {$area->name}, {$stateName} | Local Business Services";
                                $slug = Str::slug("web-development-app-development-ecommerce-{$area->slug}-{$stateName}");

                                // Ensure unique slug (optimized check)
                                $originalSlug = $slug;
                                $counter = 1;
                                while (Page::where('slug', $slug)->exists()) {
                                    $slug = $originalSlug.'-'.$counter;
                                    $counter++;
                                    // Safety limit to prevent infinite loop
                                    if ($counter > 1000) {
                                        $slug = $originalSlug.'-'.time();
                                        break;
                                    }
                                }

                                $content = $this->generateAreaPageContent($area, $stateName);
                                $excerpt = $this->generateAreaExcerpt($area, $stateName);

                                // Validate content length
                                if (strlen($content) > 65000 || strlen($excerpt) > 1000) {
                                    $skipped++;
                                    $bar->advance();
                                    DB::rollBack(); // Rollback since we're not creating
                                    // Break out of transaction try block, continue will be handled in outer catch
                                    throw new \Exception('Content too long - skipping');
                                }

                                // Create page with explicit save to ensure it's committed
                                // Insert ALL areas - city_id is optional (can be null)
                                $page = new Page([
                                    'title' => $title,
                                    'slug' => $slug,
                                    'content' => $content,
                                    'excerpt' => $excerpt,
                                    'status' => 'published',
                                    'is_featured' => false,
                                    'state_id' => $state ? $state->id : null,
                                    'city_id' => $city ? $city->id : null, // Optional - can be null
                                    'area_id' => $area->id, // Always required
                                    'user_id' => $user->id,
                                    'page_type' => 'area',
                                    'template' => 'area',
                                    'meta_title' => "{$title} | Indsoft24",
                                    'meta_description' => $excerpt,
                                    'published_at' => now(),
                                ]);

                                $saved = $page->save();

                                // Verify insertion
                                if ($saved && $page->id) {
                                    $created++;
                                    // Refresh to ensure data is persisted
                                    $page->refresh();

                                    // Log first few creations for verification
                                    if ($created <= 5) {
                                        $this->newLine();
                                        $this->line("  ✓ Created page #{$page->id} for area: {$area->name} (Area ID: {$area->id})");
                                    }
                                } else {
                                    throw new \Exception('Page creation failed - save returned false or no ID');
                                }
                            }

                            $bar->advance();

                            // Commit transaction
                            DB::commit();
                        } catch (\Exception $e) {
                            // Rollback transaction on error
                            if (DB::transactionLevel() > 0) {
                                DB::rollBack();
                            }
                            throw $e;
                        }

                        $lastProcessedId = $area->id;
                        $processed++;

                        // Clear memory and reconnect every 50 records
                        if ($processed % 50 == 0) {
                            try {
                                // Reconnect to prevent "MySQL server has gone away" errors
                                DB::reconnect();
                            } catch (\Exception $e) {
                                // If reconnect fails, try to continue
                            }

                            try {
                                $pdo = DB::connection()->getPdo();
                                if ($pdo) {
                                    $pdo->exec('SET SESSION query_cache_type = OFF');
                                }
                            } catch (\Exception $e) {
                                // Ignore if query cache is not supported
                            }

                            if (function_exists('gc_collect_cycles')) {
                                gc_collect_cycles();
                            }
                        }

                    } catch (\Exception $e) {
                        $errorMessage = $e->getMessage();

                        // Skip certain exceptions from error count (they're expected)
                        $isSkipException = strpos($errorMessage, 'Content too long') !== false;

                        if (! $isSkipException) {
                            $errors++;
                        }

                        $skipped++;
                        $bar->advance();

                        // Ensure transaction is rolled back
                        if (DB::transactionLevel() > 0) {
                            try {
                                DB::rollBack();
                            } catch (\Exception $rollbackException) {
                                // Ignore rollback errors
                            }
                        }

                        // Handle connection errors specially
                        $isConnectionError = strpos($errorMessage, 'MySQL server has gone away') !== false
                                          || strpos($errorMessage, 'getaddrinfo') !== false
                                          || strpos($errorMessage, 'Connection') !== false
                                          || strpos($errorMessage, '2006') !== false
                                          || strpos($errorMessage, '2002') !== false
                                          || strpos($errorMessage, 'active transaction') !== false;

                        if ($isConnectionError) {
                            // Try to reconnect
                            try {
                                DB::reconnect();
                                sleep(2); // Wait 2 seconds before continuing
                            } catch (\Exception $reconnectException) {
                                // If reconnect fails, log and continue
                            }
                        }

                        // Log error but continue processing (skip logging for expected skip exceptions)
                        if (! $isSkipException && $errors <= 10) {
                            $this->newLine();
                            $errorType = $isConnectionError ? 'Connection Error' : 'Error';
                            $this->error("  ❌ {$errorType} processing area ID {$area->id} ({$area->name}): ".$errorMessage);
                        } elseif ($errors == 11) {
                            $this->newLine();
                            $this->warn('  ⚠️  Suppressing further error messages...');
                        }
                    }
                }

                // Clear relationships after each chunk
                $areas->each(function ($area) {
                    $area->unsetRelation('city');
                    $area->unsetRelation('state');
                });
            });

        $bar->finish();
        $this->newLine(2);

        // Verify actual database count
        $actualPageCount = Page::where('page_type', 'area')
            ->where('area_id', '>', 0)
            ->count();

        $pagesAdded = $actualPageCount - $existingPagesBefore;

        $this->info("  ✅ Areas: {$created} created, {$updated} updated, {$skipped} skipped");
        $this->info("  📊 Total area pages in database: {$actualPageCount} (Added: {$pagesAdded})");

        if ($created > 0 && $pagesAdded != $created) {
            $this->warn("  ⚠️  Warning: Created count ({$created}) doesn't match database increase ({$pagesAdded})");
        }

        if ($errors > 0) {
            $this->warn("  ⚠️  {$errors} errors encountered during processing");
        }

        if ($lastProcessedId > 0) {
            $this->info("  📍 Last processed area ID: {$lastProcessedId}");
        }

        return [$created, $updated, $skipped];
    }

    /**
     * Generate area page content - Fresh SEO optimized content
     */
    private function generateAreaPageContent($area, $stateName): string
    {
        $address = $area->address ? "Located at {$area->address}" : '';
        $types = $area->types ? 'Area type: '.str_replace('|', ', ', $area->types) : '';
        $mapLink = '';
        if ($area->latitude && $area->longitude) {
            $mapLink = "<p><a href='https://www.google.com/maps?q={$area->latitude},{$area->longitude}' target='_blank' rel='noopener'>Find {$area->name} on Google Maps</a></p>";
        }

        return "<h1>Complete Business Solutions in {$area->name}, {$stateName} - Web Development, App Development, Software Development & E-commerce</h1>
        
        <p>Looking for professional business services in {$area->name}, {$stateName}, India? You've come to the right place! {$address}. {$types}. We offer complete solutions for businesses of all sizes - from small local shops to large e-commerce stores. Whether you're starting a new business or expanding an existing one, {$area->name} provides excellent opportunities for growth.</p>
        
        <h2>Discover {$area->name}, {$stateName} - Your Business Hub</h2>
        <p>{$area->name} is a thriving business location in {$stateName}, India. This area is home to many successful businesses, both traditional local businesses and modern online stores. With excellent connectivity, growing infrastructure, and a supportive business environment, {$area->name} is the ideal place to establish or expand your business operations.</p>
        
        <p>Our services are available to businesses in {$area->name}, throughout {$stateName}, across India, and even to international clients. We make it easy for businesses anywhere in the world to access professional services and grow their operations.</p>
        
        {$mapLink}
        
        <h2>Comprehensive Business Services for {$area->name}</h2>
        <p>We offer a complete range of professional services to help your business succeed in {$area->name} and reach customers globally:</p>
        
        <h3>Professional Web Development Services</h3>
        <p>Create a powerful online presence with our expert <strong>web development</strong> services. We design and build responsive websites that work perfectly on all devices - desktops, tablets, and smartphones. Our <strong>web development</strong> team specializes in creating user-friendly websites that help businesses in {$area->name} and worldwide attract more customers and increase sales. Whether you need a simple business website or a complex e-commerce platform, we deliver custom <strong>web development</strong> solutions that meet your specific needs.</p>
        
        <h3>Mobile App Development & iOS Development</h3>
        <p>Reach customers on the go with our comprehensive <strong>app development</strong> services. We create mobile applications for both Android and iOS platforms, helping businesses in {$area->name} and globally connect with their customers through smartphones. Our <strong>app development</strong> expertise includes native iOS apps, Android apps, and cross-platform solutions. Specializing in <strong>iOS development</strong>, we create high-quality iPhone and iPad applications that provide excellent user experiences. With a mobile app, your customers can easily browse products, make purchases, book services, and stay connected with your business 24/7.</p>
        
        <h3>Custom Software Development Solutions</h3>
        <p>Streamline your business operations with our professional <strong>software development</strong> services. We create custom software applications tailored to your business needs, helping companies in {$area->name} and across India improve efficiency and productivity. Our <strong>software development</strong> team builds scalable solutions that grow with your business - from inventory management systems to customer relationship management tools. Whether you're a local business in {$area->name} or an international company, we develop software that fits your unique requirements and helps you serve customers better.</p>
        
        <h3>Effective Digital Marketing Strategies</h3>
        <p>Grow your customer base with our comprehensive <strong>digital marketing</strong> services. We help businesses in {$area->name}, throughout India, and internationally reach more customers through strategic online marketing. Our <strong>digital marketing</strong> services include search engine optimization (SEO), social media marketing, content marketing, email campaigns, pay-per-click advertising, and more. We create customized <strong>digital marketing</strong> campaigns that increase your online visibility, attract qualified leads, and drive sales. Perfect for both local businesses looking to reach customers in {$area->name} and e-commerce stores targeting customers worldwide.</p>
        
        <h3>Easy E-commerce Store Setup</h3>
        <p>Start selling online today with our simple <strong>e-commerce store</strong> setup service. We make it easy for businesses in {$area->name} and everywhere else to launch their online store and start selling products to customers in India and around the world. Our <strong>e-commerce store</strong> platform supports all product categories including electronics, clothing, food items, medicines, home goods, gifts, and much more. You can set up your <strong>e-commerce store</strong> in minutes and begin accepting orders from customers locally in {$area->name}, across India, or internationally. We provide everything you need to manage inventory, process payments, and ship products efficiently.</p>
        
        <h3>Local Business Directory & Listing Services</h3>
        <p>Increase your visibility with our <strong>local business</strong> directory listing. Get your business listed in our comprehensive directory to help customers in {$area->name} and surrounding areas find you easily. Our <strong>local business</strong> directory is perfect for restaurants, shops, clinics, service providers, and all types of local businesses. Listing your <strong>local business</strong> helps improve your online presence, attract more local customers, and grow your customer base in {$area->name} and nearby locations.</p>
        
        <h2>Why Choose {$area->name} for Your Business?</h2>
        <p>{$area->name} in {$stateName}, India offers numerous advantages for businesses:</p>
        <ul>
            <li><strong>Strategic Location:</strong> Well-connected area in {$stateName} with excellent transportation links and accessibility</li>
            <li><strong>Growing Economy:</strong> Expanding market with increasing demand for products and services</li>
            <li><strong>Skilled Talent Pool:</strong> Access to experienced professionals in <strong>web development</strong>, <strong>app development</strong>, <strong>software development</strong>, and <strong>digital marketing</strong></li>
            <li><strong>Business Support:</strong> Favorable environment supporting both traditional <strong>local business</strong> operations and modern <strong>e-commerce store</strong> ventures</li>
            <li><strong>Modern Infrastructure:</strong> Reliable internet connectivity and technology infrastructure supporting <strong>web development</strong>, <strong>app development</strong>, and <strong>software development</strong> projects</li>
            <li><strong>Market Access:</strong> Great location to serve customers in {$area->name}, throughout {$stateName}, across India, and internationally</li>
        </ul>
        
        <h2>Get Started with Your Business in {$area->name}</h2>
        <p>Ready to launch or expand your business in {$area->name}, {$stateName}? Our comprehensive services can help you succeed:</p>
        <ul>
            <li><strong>E-commerce Store:</strong> Set up your online store to sell products in {$area->name}, across India, and worldwide</li>
            <li><strong>Web Development:</strong> Build a professional website that showcases your business and attracts customers</li>
            <li><strong>App Development:</strong> Create mobile apps for iOS and Android to reach customers on their smartphones</li>
            <li><strong>Software Development:</strong> Develop custom software solutions to streamline your business operations</li>
            <li><strong>Digital Marketing:</strong> Implement effective marketing strategies to reach customers in {$area->name}, India, and globally</li>
            <li><strong>Local Business Listing:</strong> Get your business listed in our directory to attract local customers</li>
        </ul>
        
        <p>Our services are designed to work for businesses of all types in {$area->name}, {$stateName}, throughout India, and for international clients. We provide affordable, professional solutions that help you start or grow your business successfully.</p>
        
        <p>Contact us today to discover how we can help your business thrive in {$area->name}, {$stateName}, India. Whether you need <strong>web development</strong>, <strong>app development</strong>, <strong>iOS development</strong>, <strong>software development</strong>, <strong>digital marketing</strong>, or want to set up an <strong>e-commerce store</strong>, our team is ready to assist you at every step of your business journey!</p>";
    }

    /**
     * Generate area page excerpt - Fresh SEO optimized content
     */
    private function generateAreaExcerpt($area, $stateName): string
    {
        return "Professional business services in {$area->name}, {$stateName}, India. Expert web development, app development, iOS development, software development, and digital marketing solutions. Launch your e-commerce store to sell in India and worldwide, or list your local business in our directory. Complete business solutions for success.";
    }
}
