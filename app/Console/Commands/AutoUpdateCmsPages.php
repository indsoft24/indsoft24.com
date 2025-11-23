<?php

namespace App\Console\Commands;

use App\Area;
use App\City;
use App\Page;
use App\State;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AutoUpdateCmsPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:auto-update-pages 
                            {--chunk-size=50 : Number of records to process in each batch}
                            {--resume : Resume from last checkpoint}
                            {--reset : Reset and start from beginning}
                            {--service= : Process only specific service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically create SEO-friendly CMS pages for services (State -> City -> Area) - One service at a time';

    /**
     * Resume checkpoint file path
     */
    private $checkpointFile = 'cms_pages_checkpoint.json';

    /**
     * List of services to create pages for
     */
    private $services = [
        'web development',
        'app development',
        'ios development',
        'ecommerce platform',
        'software development',
        'digital marketing',
        'mobile app development',
        'website development',
        'ecommerce development',
        'web design',
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Starting CMS Pages Auto-Insert Process...');
        $this->info('📋 Services to create: '.implode(', ', $this->services));
        $this->newLine();

        // Handle reset option
        if ($this->option('reset')) {
            $this->resetCheckpoint();
            $this->info('✅ Checkpoint reset. Starting from beginning...');
            $this->newLine();
        }

        // Get or create a user for creating pages
        $user = User::first();
        if (! $user) {
            $this->error('❌ No user found. Please create a user first.');

            return 1;
        }

        // Load checkpoint if resume is enabled
        $checkpoint = null;
        if ($this->option('resume')) {
            $checkpoint = $this->loadCheckpoint();
            if ($checkpoint) {
                $this->info('📍 Resuming from checkpoint...');
                $this->info('   Current Service: '.($checkpoint['current_service'] ?? 'N/A'));
                $this->info('   Last Step: '.($checkpoint['step'] ?? 'N/A'));
                $this->info('   Last State ID: '.($checkpoint['last_state_id'] ?? 'N/A'));
                $this->info('   Last City ID: '.($checkpoint['last_city_id'] ?? 'N/A'));
                $this->info('   Last Area ID: '.($checkpoint['last_area_id'] ?? 'N/A'));
                $this->newLine();
            }
        }

        // Get services to process
        $servicesToProcess = $this->getServicesToProcess($checkpoint);

        $totalCreated = 0;
        $totalSkipped = 0;

        // Process each service completely (States -> Cities -> Areas) before moving to next
        foreach ($servicesToProcess as $serviceIndex => $service) {
            $this->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
            $this->info('🔧 Processing Service: '.ucfirst($service).' ('.($serviceIndex + 1).'/'.count($servicesToProcess).')');
            $this->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
            $this->newLine();

            // Determine which step to start from for this service
            $startStep = null;
            if ($checkpoint && isset($checkpoint['current_service']) && $checkpoint['current_service'] === $service) {
                $startStep = $checkpoint['step'] ?? 'states';
            } else {
                $startStep = 'states';
            }

            // Step 1: Process States for this service
            if ($startStep === 'states' || ! $checkpoint || $checkpoint['current_service'] !== $service) {
                $this->info('📍 Step 1: Processing States for '.ucfirst($service).'...');
                $this->newLine();
                [$created, $skipped] = $this->processStates($user, $service, $checkpoint);
                $totalCreated += $created;
                $totalSkipped += $skipped;
                $this->newLine();

                // Update checkpoint after states are done
                $this->saveCheckpoint([
                    'current_service' => $service,
                    'step' => 'cities',
                    'last_state_id' => null,
                    'last_city_id' => null,
                    'last_area_id' => null,
                ]);
            }

            // Step 2: Process Cities for this service
            $currentStep = ($checkpoint && isset($checkpoint['current_service']) && $checkpoint['current_service'] === $service)
                ? ($checkpoint['step'] ?? 'cities')
                : 'cities';

            if ($currentStep === 'cities' || ($startStep === 'states' && (! $checkpoint || $checkpoint['current_service'] !== $service))) {
                $this->info('📍 Step 2: Processing Cities for '.ucfirst($service).'...');
                $this->newLine();
                [$created, $skipped] = $this->processCities($user, $service, $checkpoint);
                $totalCreated += $created;
                $totalSkipped += $skipped;
                $this->newLine();

                // Update checkpoint after cities are done
                $this->saveCheckpoint([
                    'current_service' => $service,
                    'step' => 'areas',
                    'last_state_id' => null,
                    'last_city_id' => null,
                    'last_area_id' => null,
                ]);
            }

            // Step 3: Process Areas for this service
            $currentStep = ($checkpoint && isset($checkpoint['current_service']) && $checkpoint['current_service'] === $service)
                ? ($checkpoint['step'] ?? 'areas')
                : 'areas';

            if ($currentStep === 'areas' || ($currentStep === 'cities' && (! $checkpoint || $checkpoint['current_service'] !== $service))) {
                $this->info('📍 Step 3: Processing Areas for '.ucfirst($service).'...');
                $this->newLine();
                [$created, $skipped] = $this->processAreas($user, $service, $checkpoint);
                $totalCreated += $created;
                $totalSkipped += $skipped;
                $this->newLine();
            }

            // Service completed - reset checkpoint for next service
            if ($serviceIndex < count($servicesToProcess) - 1) {
                $this->saveCheckpoint([
                    'current_service' => $servicesToProcess[$serviceIndex + 1],
                    'step' => 'states',
                    'last_state_id' => null,
                    'last_city_id' => null,
                    'last_area_id' => null,
                ]);
            }

            $this->info('✅ Completed: '.ucfirst($service));
            $this->newLine();
        }

        // Clear checkpoint on successful completion
        $this->resetCheckpoint();

        // Summary
        $this->info('✅ Auto-Insert Process Completed!');
        $this->table(
            ['Action', 'Count'],
            [
                ['Created', $totalCreated],
                ['Skipped', $totalSkipped],
                ['Total Processed', $totalCreated + $totalSkipped],
            ]
        );

        return 0;
    }

    /**
     * Get services to process based on checkpoint or option
     */
    private function getServicesToProcess($checkpoint): array
    {
        // If specific service is requested
        if ($this->option('service')) {
            $requestedService = $this->option('service');
            if (in_array($requestedService, $this->services)) {
                return [$requestedService];
            } else {
                $this->warn("Service '{$requestedService}' not found. Processing all services.");
            }
        }

        // If resuming, start from checkpoint service
        if ($checkpoint && isset($checkpoint['current_service'])) {
            $currentServiceIndex = array_search($checkpoint['current_service'], $this->services);
            if ($currentServiceIndex !== false) {
                return array_slice($this->services, $currentServiceIndex);
            }
        }

        // Default: process all services
        return $this->services;
    }

    /**
     * Process states and create pages for the service
     */
    private function processStates($user, $service, $checkpoint = null): array
    {
        $created = 0;
        $skipped = 0;

        $query = State::where('status', 1);

        // Resume from last processed state if checkpoint exists and matches current service
        if ($checkpoint && isset($checkpoint['current_service']) && $checkpoint['current_service'] === $service && isset($checkpoint['last_state_id'])) {
            $query->where('id', '>', $checkpoint['last_state_id']);
        }

        $states = $query->orderBy('id', 'asc')->get();
        $totalStates = $states->count();

        $this->info("Found {$totalStates} active states to process for ".ucfirst($service));
        $this->newLine();

        if ($totalStates == 0) {
            $this->warn('No active states found.');

            return [0, 0];
        }

        $bar = $this->output->createProgressBar($totalStates);
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s%');
        $bar->start();

        $lastProcessedId = ($checkpoint && isset($checkpoint['current_service']) && $checkpoint['current_service'] === $service)
            ? ($checkpoint['last_state_id'] ?? 0)
            : 0;

        foreach ($states as $state) {
            try {
                DB::beginTransaction();

                // Generate SEO-friendly slug: "web-development-in-delhi"
                $slug = $this->generateSlug($service, $state->name, null, null);

                // Check if page already exists - IMPROVED: Check by slug AND service pattern
                $pageExists = Page::where('slug', $slug)
                    ->where('page_type', 'state')
                    ->where('state_id', $state->id)
                    ->exists();

                if ($pageExists) {
                    $skipped++;
                    $bar->advance();
                    DB::rollBack();

                    continue;
                }

                // Ensure unique slug (add postfix if duplicate)
                $slug = $this->ensureUniqueSlug($slug);

                // Generate content
                $title = ucfirst($service).' in '.$state->name.' | Professional Services';
                $content = $this->generateStateContent($service, $state);
                $excerpt = $this->generateStateExcerpt($service, $state);

                // Create page
                $page = new Page([
                    'title' => $title,
                    'slug' => $slug,
                    'content' => $content,
                    'excerpt' => $excerpt,
                    'status' => 'published',
                    'is_featured' => false,
                    'state_id' => $state->id,
                    'city_id' => null,
                    'area_id' => null,
                    'user_id' => $user->id,
                    'page_type' => 'state',
                    'template' => 'state',
                    'meta_title' => $title.' | Indsoft24',
                    'meta_description' => $excerpt,
                    'published_at' => now(),
                ]);

                $page->save();
                $created++;
                $bar->advance();

                DB::commit();

                // Update checkpoint after each successful state completion
                $lastProcessedId = $state->id;
                $this->saveCheckpoint([
                    'current_service' => $service,
                    'step' => 'states',
                    'last_state_id' => $lastProcessedId,
                    'last_city_id' => null,
                    'last_area_id' => null,
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                $skipped++;
                $bar->advance();

                // Save checkpoint on error so we can resume
                $this->saveCheckpoint([
                    'current_service' => $service,
                    'step' => 'states',
                    'last_state_id' => $lastProcessedId,
                    'last_city_id' => null,
                    'last_area_id' => null,
                ]);

                // Log error but continue
                if ($skipped <= 5) {
                    $this->newLine();
                    $this->error("  ❌ Error processing state {$state->id}: ".$e->getMessage());
                }
            }
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("  ✅ States: {$created} created, {$skipped} skipped");

        return [$created, $skipped];
    }

    /**
     * Process cities and create pages for the service
     */
    private function processCities($user, $service, $checkpoint = null): array
    {
        $created = 0;
        $skipped = 0;

        $query = City::where('status', 1);

        // Resume from last processed city if checkpoint exists and matches current service
        if ($checkpoint && isset($checkpoint['current_service']) && $checkpoint['current_service'] === $service && isset($checkpoint['last_city_id'])) {
            $query->where('id', '>', $checkpoint['last_city_id']);
        }

        $cities = $query->orderBy('id', 'asc')->get();
        $totalCities = $cities->count();

        $this->info("Found {$totalCities} active cities to process for ".ucfirst($service));
        $this->newLine();

        if ($totalCities == 0) {
            $this->warn('No active cities found.');

            return [0, 0];
        }

        $bar = $this->output->createProgressBar($totalCities);
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s%');
        $bar->start();

        $lastProcessedId = ($checkpoint && isset($checkpoint['current_service']) && $checkpoint['current_service'] === $service)
            ? ($checkpoint['last_city_id'] ?? 0)
            : 0;

        foreach ($cities as $city) {
            // Get state for city
            $state = $city->state;
            if (! $state) {
                $skipped++;
                $bar->advance();

                continue;
            }

            try {
                DB::beginTransaction();

                // Generate SEO-friendly slug: "web-development-in-mumbai"
                $slug = $this->generateSlug($service, $state->name, $city->city_name, null);

                // Check if page already exists - IMPROVED: Check by slug AND service pattern
                $pageExists = Page::where('slug', $slug)
                    ->where('page_type', 'city')
                    ->where('city_id', $city->id)
                    ->exists();

                if ($pageExists) {
                    $skipped++;
                    $bar->advance();
                    DB::rollBack();

                    continue;
                }

                // Ensure unique slug (add postfix if duplicate)
                $slug = $this->ensureUniqueSlug($slug);

                // Generate content
                $title = ucfirst($service).' in '.$city->city_name.', '.$state->name.' | Professional Services';
                $content = $this->generateCityContent($service, $city, $state);
                $excerpt = $this->generateCityExcerpt($service, $city, $state);

                // Create page
                $page = new Page([
                    'title' => $title,
                    'slug' => $slug,
                    'content' => $content,
                    'excerpt' => $excerpt,
                    'status' => 'published',
                    'is_featured' => false,
                    'state_id' => $state->id,
                    'city_id' => $city->id,
                    'area_id' => null,
                    'user_id' => $user->id,
                    'page_type' => 'city',
                    'template' => 'city',
                    'meta_title' => $title.' | Indsoft24',
                    'meta_description' => $excerpt,
                    'published_at' => now(),
                ]);

                $page->save();
                $created++;
                $bar->advance();

                DB::commit();

                // Update checkpoint after each successful city completion
                $lastProcessedId = $city->id;
                $this->saveCheckpoint([
                    'current_service' => $service,
                    'step' => 'cities',
                    'last_state_id' => null,
                    'last_city_id' => $lastProcessedId,
                    'last_area_id' => null,
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                $skipped++;
                $bar->advance();

                // Save checkpoint on error so we can resume
                $this->saveCheckpoint([
                    'current_service' => $service,
                    'step' => 'cities',
                    'last_state_id' => null,
                    'last_city_id' => $lastProcessedId,
                    'last_area_id' => null,
                ]);

                // Log error but continue
                if ($skipped <= 5) {
                    $this->newLine();
                    $this->error("  ❌ Error processing city {$city->id}: ".$e->getMessage());
                }
            }
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("  ✅ Cities: {$created} created, {$skipped} skipped");

        return [$created, $skipped];
    }

    /**
     * Process areas and create pages for the service
     */
    private function processAreas($user, $service, $checkpoint = null): array
    {
        $created = 0;
        $skipped = 0;

        $query = Area::where('status', 1);

        // Resume from last processed area if checkpoint exists and matches current service
        if ($checkpoint && isset($checkpoint['current_service']) && $checkpoint['current_service'] === $service && isset($checkpoint['last_area_id'])) {
            $query->where('id', '>', $checkpoint['last_area_id']);
        }

        $areas = $query->orderBy('id', 'asc')->get();
        $totalAreas = $areas->count();

        $this->info("Found {$totalAreas} active areas to process for ".ucfirst($service));
        $this->newLine();

        if ($totalAreas == 0) {
            $this->warn('No active areas found.');

            return [0, 0];
        }

        $bar = $this->output->createProgressBar($totalAreas);
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s%');
        $bar->start();

        $lastProcessedId = ($checkpoint && isset($checkpoint['current_service']) && $checkpoint['current_service'] === $service)
            ? ($checkpoint['last_area_id'] ?? 0)
            : 0;

        foreach ($areas as $area) {
            // Get state and city for area
            $state = $area->state;
            $city = $area->city;

            if (! $state) {
                $skipped++;
                $bar->advance();

                continue;
            }

            try {
                DB::beginTransaction();

                // Generate SEO-friendly slug: "web-development-in-connaught-place"
                $slug = $this->generateSlug($service, $state->name, $city ? $city->city_name : null, $area->name);

                // Check if page already exists - IMPROVED: Check by slug AND service pattern
                $pageExists = Page::where('slug', $slug)
                    ->where('page_type', 'area')
                    ->where('area_id', $area->id)
                    ->exists();

                if ($pageExists) {
                    $skipped++;
                    $bar->advance();
                    DB::rollBack();

                    continue;
                }

                // Ensure unique slug (add postfix if duplicate)
                $slug = $this->ensureUniqueSlug($slug);

                // Generate content
                $location = $area->name;
                if ($city) {
                    $location .= ', '.$city->city_name;
                }
                $location .= ', '.$state->name;

                $title = ucfirst($service).' in '.$location.' | Professional Services';
                $content = $this->generateAreaContent($service, $area, $city, $state);
                $excerpt = $this->generateAreaExcerpt($service, $area, $city, $state);

                // Create page
                $page = new Page([
                    'title' => $title,
                    'slug' => $slug,
                    'content' => $content,
                    'excerpt' => $excerpt,
                    'status' => 'published',
                    'is_featured' => false,
                    'state_id' => $state->id,
                    'city_id' => $city ? $city->id : null,
                    'area_id' => $area->id,
                    'user_id' => $user->id,
                    'page_type' => 'area',
                    'template' => 'area',
                    'meta_title' => $title.' | Indsoft24',
                    'meta_description' => $excerpt,
                    'published_at' => now(),
                ]);

                $page->save();
                $created++;
                $bar->advance();

                DB::commit();

                // Update checkpoint after each successful area completion
                $lastProcessedId = $area->id;
                $this->saveCheckpoint([
                    'current_service' => $service,
                    'step' => 'areas',
                    'last_state_id' => null,
                    'last_city_id' => null,
                    'last_area_id' => $lastProcessedId,
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                $skipped++;
                $bar->advance();

                // Save checkpoint on error so we can resume
                $this->saveCheckpoint([
                    'current_service' => $service,
                    'step' => 'areas',
                    'last_state_id' => null,
                    'last_city_id' => null,
                    'last_area_id' => $lastProcessedId,
                ]);

                // Log error but continue
                if ($skipped <= 5) {
                    $this->newLine();
                    $this->error("  ❌ Error processing area {$area->id}: ".$e->getMessage());
                }
            }
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("  ✅ Areas: {$created} created, {$skipped} skipped");

        return [$created, $skipped];
    }

    /**
     * Generate SEO-friendly slug - ONE SERVICE PER URL
     * Examples:
     * - State: "web-development-in-delhi"
     * - City: "web-development-in-mumbai"
     * - Area: "web-development-in-connaught-place"
     */
    private function generateSlug($service, $stateName, $cityName = null, $areaName = null): string
    {
        $parts = [Str::slug($service)];

        if ($areaName) {
            $parts[] = 'in';
            $parts[] = Str::slug($areaName);
        } elseif ($cityName) {
            $parts[] = 'in';
            $parts[] = Str::slug($cityName);
        } else {
            $parts[] = 'in';
            $parts[] = Str::slug($stateName);
        }

        return implode('-', $parts);
    }

    /**
     * Ensure slug is unique by adding postfix if needed
     * Example: "web-development-in-delhi-1" if duplicate exists
     */
    private function ensureUniqueSlug($slug): string
    {
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

        return $slug;
    }

    /**
     * Save checkpoint to file
     */
    private function saveCheckpoint(array $data): void
    {
        try {
            $data['timestamp'] = now()->toDateTimeString();
            Storage::put($this->checkpointFile, json_encode($data, JSON_PRETTY_PRINT));
        } catch (\Exception $e) {
            // Silently fail - checkpoint is not critical
        }
    }

    /**
     * Load checkpoint from file
     */
    private function loadCheckpoint(): ?array
    {
        try {
            if (Storage::exists($this->checkpointFile)) {
                $content = Storage::get($this->checkpointFile);
                $data = json_decode($content, true);

                return $data ?: null;
            }
        } catch (\Exception $e) {
            // Return null if checkpoint file doesn't exist or is invalid
        }

        return null;
    }

    /**
     * Reset checkpoint
     */
    private function resetCheckpoint(): void
    {
        try {
            if (Storage::exists($this->checkpointFile)) {
                Storage::delete($this->checkpointFile);
            }
        } catch (\Exception $e) {
            // Silently fail
        }
    }

    /**
     * Generate state-level content
     */
    private function generateStateContent($service, $state): string
    {
        $serviceTitle = ucfirst($service);
        $stateName = $state->name;

        return "<h1>{$serviceTitle} in {$stateName} - Professional Services</h1>
        
        <p>Looking for professional <strong>{$service}</strong> services in {$stateName}, India? You've come to the right place! We offer comprehensive <strong>{$service}</strong> solutions for businesses of all sizes throughout {$stateName}.</p>
        
        <h2>Why Choose Our {$serviceTitle} Services in {$stateName}?</h2>
        <p>Our expert team provides top-quality <strong>{$service}</strong> services across {$stateName}. Whether you're a startup or an established business, we deliver customized solutions that meet your specific needs.</p>
        
        <h3>Comprehensive {$serviceTitle} Solutions</h3>
        <p>We specialize in providing professional <strong>{$service}</strong> services throughout {$stateName}. Our services are designed to help businesses grow and succeed in today's competitive market.</p>
        
        <h3>Expert Team</h3>
        <p>Our experienced professionals understand the unique business environment in {$stateName} and provide tailored <strong>{$service}</strong> solutions that drive results.</p>
        
        <h2>Get Started Today</h2>
        <p>Ready to take your business to the next level with our <strong>{$service}</strong> services in {$stateName}? Contact us today to discuss your requirements and get a customized solution.</p>
        
        <p>We serve clients across all cities and areas in {$stateName}, providing professional <strong>{$service}</strong> services that help businesses succeed.</p>";
    }

    /**
     * Generate state-level excerpt
     */
    private function generateStateExcerpt($service, $state): string
    {
        return "Professional {$service} services in {$state->name}, India. Expert solutions for businesses throughout {$state->name}. Get started today!";
    }

    /**
     * Generate city-level content
     */
    private function generateCityContent($service, $city, $state): string
    {
        $serviceTitle = ucfirst($service);
        $cityName = $city->city_name;
        $stateName = $state->name;

        return "<h1>{$serviceTitle} in {$cityName}, {$stateName} - Professional Services</h1>
        
        <p>Looking for professional <strong>{$service}</strong> services in {$cityName}, {$stateName}? You've come to the right place! We offer comprehensive <strong>{$service}</strong> solutions for businesses of all sizes in {$cityName}.</p>
        
        <h2>Why Choose Our {$serviceTitle} Services in {$cityName}?</h2>
        <p>Our expert team provides top-quality <strong>{$service}</strong> services in {$cityName}, {$stateName}. Whether you're a startup or an established business, we deliver customized solutions that meet your specific needs.</p>
        
        <h3>Comprehensive {$serviceTitle} Solutions</h3>
        <p>We specialize in providing professional <strong>{$service}</strong> services in {$cityName}, {$stateName}. Our services are designed to help businesses grow and succeed in today's competitive market.</p>
        
        <h3>Expert Team</h3>
        <p>Our experienced professionals understand the unique business environment in {$cityName} and provide tailored <strong>{$service}</strong> solutions that drive results.</p>
        
        <h2>Get Started Today</h2>
        <p>Ready to take your business to the next level with our <strong>{$service}</strong> services in {$cityName}, {$stateName}? Contact us today to discuss your requirements and get a customized solution.</p>
        
        <p>We serve clients across all areas in {$cityName}, {$stateName}, providing professional <strong>{$service}</strong> services that help businesses succeed.</p>";
    }

    /**
     * Generate city-level excerpt
     */
    private function generateCityExcerpt($service, $city, $state): string
    {
        return "Professional {$service} services in {$city->city_name}, {$state->name}, India. Expert solutions for businesses in {$city->city_name}. Get started today!";
    }

    /**
     * Generate area-level content
     */
    private function generateAreaContent($service, $area, $city, $state): string
    {
        $serviceTitle = ucfirst($service);
        $areaName = $area->name;
        $cityName = $city ? $city->city_name : '';
        $stateName = $state->name;

        $location = $areaName;
        if ($cityName) {
            $location .= ", {$cityName}";
        }
        $location .= ", {$stateName}";

        $address = $area->address ? "Located at {$area->address}" : '';

        return "<h1>{$serviceTitle} in {$location} - Professional Services</h1>
        
        <p>Looking for professional <strong>{$service}</strong> services in {$location}? You've come to the right place! {$address}. We offer comprehensive <strong>{$service}</strong> solutions for businesses of all sizes in {$areaName}.</p>
        
        <h2>Why Choose Our {$serviceTitle} Services in {$areaName}?</h2>
        <p>Our expert team provides top-quality <strong>{$service}</strong> services in {$location}. Whether you're a startup or an established business, we deliver customized solutions that meet your specific needs.</p>
        
        <h3>Comprehensive {$serviceTitle} Solutions</h3>
        <p>We specialize in providing professional <strong>{$service}</strong> services in {$location}. Our services are designed to help businesses grow and succeed in today's competitive market.</p>
        
        <h3>Expert Team</h3>
        <p>Our experienced professionals understand the unique business environment in {$areaName} and provide tailored <strong>{$service}</strong> solutions that drive results.</p>
        
        <h2>Get Started Today</h2>
        <p>Ready to take your business to the next level with our <strong>{$service}</strong> services in {$location}? Contact us today to discuss your requirements and get a customized solution.</p>
        
        <p>We provide professional <strong>{$service}</strong> services in {$location}, helping businesses succeed in {$areaName} and surrounding areas.</p>";
    }

    /**
     * Generate area-level excerpt
     */
    private function generateAreaExcerpt($service, $area, $city, $state): string
    {
        $location = $area->name;
        if ($city) {
            $location .= ", {$city->city_name}";
        }
        $location .= ", {$state->name}";

        return "Professional {$service} services in {$location}, India. Expert solutions for businesses in {$area->name}. Get started today!";
    }
}
