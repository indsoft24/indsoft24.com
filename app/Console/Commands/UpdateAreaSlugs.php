<?php

namespace App\Console\Commands;

use App\Area;
use App\City;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class UpdateAreaSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'areas:update-slugs 
                            {--chunk-size=100 : Number of records to process in each batch}
                            {--dry-run : Show what would be updated without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate and update area slugs: creates slugs for missing ones and ensures uniqueness by adding city name suffix if duplicate, then ID if still duplicate';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        $chunkSize = (int) $this->option('chunk-size');

        if ($dryRun) {
            $this->info('🔍 DRY RUN MODE - No changes will be made');
            $this->newLine();
        }

        $this->info('Starting area slug update process...');
        $this->newLine();

        // Find all areas
        $totalAreas = Area::count();
        $missingSlugs = Area::whereNull('slug')->orWhere('slug', '')->count();

        $this->info("Total areas: {$totalAreas}");
        $this->info("Areas with missing slugs: {$missingSlugs}");
        $this->newLine();

        $updated = 0;
        $skipped = 0;
        $errors = 0;

        // Create progress bar
        $bar = $this->output->createProgressBar($totalAreas);
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %message%');
        $bar->setMessage('Processing areas...');
        $bar->start();

        // Process areas in chunks
        // Note: We don't eager load 'city' relationship to avoid overriding the 'city' column attribute
        Area::chunk($chunkSize, function ($areas) use (&$updated, &$skipped, &$errors, $dryRun, $bar) {
            foreach ($areas as $area) {
                try {
                    // Generate slug if missing or update if needed
                    $currentSlug = $area->slug;
                    $newSlug = $this->generateUniqueSlug($area);

                    // Update if slug is missing or changed
                    if (empty($currentSlug) || $newSlug !== $currentSlug) {
                        if ($dryRun) {
                            $oldSlug = $currentSlug ?: '(empty)';
                            $bar->setMessage("Would update Area #{$area->id}");
                        } else {
                            $area->slug = $newSlug;
                            $area->save();
                            $bar->setMessage("Updated Area #{$area->id}");
                        }
                        $updated++;
                    } else {
                        $skipped++;
                        $bar->setMessage("Skipped Area #{$area->id}");
                    }
                } catch (\Exception $e) {
                    $errors++;
                    $bar->setMessage("Error Area #{$area->id}");
                    if ($errors <= 5) {
                        $this->newLine();
                        $this->error("  ❌ Error updating Area #{$area->id}: ".$e->getMessage());
                    }
                }

                $bar->advance();
            }
        });

        $bar->finish();

        $this->newLine();
        $this->info('✅ Process completed!');
        $this->info("  Updated: {$updated}");
        $this->info("  Skipped: {$skipped}");
        if ($errors > 0) {
            $this->error("  Errors: {$errors}");
        }

        if ($dryRun) {
            $this->newLine();
            $this->warn('This was a dry run. Run without --dry-run to apply changes.');
        }

        return Command::SUCCESS;
    }

    /**
     * Generate a unique slug for the area
     * Strategy:
     * 1. Start with slug from name
     * 2. If duplicate, add city name as suffix
     * 3. If still duplicate, add area ID as suffix
     */
    protected function generateUniqueSlug($area)
    {
        // Handle empty area name
        if (empty($area->name)) {
            // If name is empty, use area ID as slug
            return 'area-'.$area->id;
        }

        $baseSlug = Str::slug($area->name);

        // If slug is empty after conversion, use area ID
        if (empty($baseSlug)) {
            return 'area-'.$area->id;
        }

        // First try: just the base slug
        $existing = Area::where('slug', $baseSlug)
            ->where('id', '!=', $area->id)
            ->first();

        if (! $existing) {
            return $baseSlug;
        }

        // Second try: add city name as suffix
        $cityName = null;

        // First, try to get city name from the 'city' column (string value)
        // Use getAttributes() to access raw database value, bypassing relationship
        $attributes = $area->getAttributes();
        if (isset($attributes['city']) && is_string($attributes['city']) && ! empty($attributes['city'])) {
            $cityName = $attributes['city'];
        }
        // Otherwise, try to get city name from relationship via city_id
        elseif ($area->city_id) {
            // Check if relationship is already loaded
            if ($area->relationLoaded('city') && $area->getRelation('city')) {
                $city = $area->getRelation('city');
                if (is_object($city) && isset($city->city_name)) {
                    $cityName = $city->city_name;
                }
            } else {
                // Fetch city from database
                $city = City::find($area->city_id);
                if ($city && isset($city->city_name)) {
                    $cityName = $city->city_name;
                }
            }
        }

        if ($cityName) {
            $citySlug = Str::slug($cityName);
            $slugWithCity = $baseSlug.'-'.$citySlug;

            $existing = Area::where('slug', $slugWithCity)
                ->where('id', '!=', $area->id)
                ->first();

            if (! $existing) {
                return $slugWithCity;
            }
        }

        // Third try: add area ID as suffix
        $slugWithId = $baseSlug.'-'.$area->id;
        $existing = Area::where('slug', $slugWithId)
            ->where('id', '!=', $area->id)
            ->first();

        if (! $existing) {
            return $slugWithId;
        }

        // Fallback: if still duplicate (shouldn't happen with ID), use numeric counter
        $originalSlug = $baseSlug;
        $counter = 1;
        while (Area::where('slug', $originalSlug)->where('id', '!=', $area->id)->exists()) {
            $originalSlug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $originalSlug;
    }
}
