<?php

namespace App\Console\Commands;

use App\State;
use App\City;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateSlugsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slugs:generate 
                            {--type=all : Type to generate (states, cities, all)}
                            {--chunk=100 : Number of records to process at a time}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for states and cities that are missing them';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->option('type');
        $chunk = (int) $this->option('chunk');

        if ($type === 'all' || $type === 'states') {
            $this->generateStateSlugs($chunk);
        }

        if ($type === 'all' || $type === 'cities') {
            $this->generateCitySlugs($chunk);
        }

        $this->info('Slug generation completed!');
    }

    /**
     * Generate slugs for states
     */
    protected function generateStateSlugs($chunk)
    {
        $this->info('Generating slugs for states...');
        
        $total = State::whereNull('slug')->orWhere('slug', '')->count();
        
        if ($total === 0) {
            $this->info('All states already have slugs.');
            return;
        }

        $this->info("Found $total states without slugs.");
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        State::whereNull('slug')->orWhere('slug', '')
            ->chunk($chunk, function ($states) use ($bar) {
                foreach ($states as $state) {
                    if (empty($state->slug) && !empty($state->name)) {
                        // Generate and set slug
                        $state->slug = State::generateUniqueSlug($state);
                        // Use regular save to trigger events (slug will be validated by updating event)
                        $state->save();
                    }
                    $bar->advance();
                }
            });

        $bar->finish();
        $this->newLine();
        $this->info("Generated slugs for states.");
    }

    /**
     * Generate slugs for cities
     */
    protected function generateCitySlugs($chunk)
    {
        $this->info('Generating slugs for cities...');
        
        $total = City::whereNull('slug')->orWhere('slug', '')->count();
        
        if ($total === 0) {
            $this->info('All cities already have slugs.');
            return;
        }

        $this->info("Found $total cities without slugs.");
        $this->warn('This may take a while for large datasets...');
        
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        City::whereNull('slug')->orWhere('slug', '')
            ->chunk($chunk, function ($cities) use ($bar) {
                foreach ($cities as $city) {
                    if (empty($city->slug) && !empty($city->city_name)) {
                        // Generate and set slug
                        $city->slug = City::generateUniqueSlug($city);
                        // Use regular save to trigger events (slug will be validated by updating event)
                        $city->save();
                    }
                    $bar->advance();
                }
            });

        $bar->finish();
        $this->newLine();
        $this->info("Generated slugs for cities.");
    }
}

