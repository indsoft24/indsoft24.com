<?php

namespace Database\Seeders;

use App\Area;
use App\City;
use App\Page;
use App\State;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            // Get existing states
            $states = State::where('status', 1)->get();

            if ($states->count() == 0) {
                $this->command->info('No active states found. Please add some states first.');

                return;
            }

            // Get or create a user for creating pages
            $user = User::first();
            if (! $user) {
                try {
                    $user = User::create([
                        'name' => 'Admin User',
                        'email' => 'admin@example.com',
                        'password' => bcrypt('password'),
                        'email_verified_at' => now(),
                    ]);
                    $this->command->info('Created admin user');
                } catch (\Exception $e) {
                    $this->command->warn('Error creating user: '.$e->getMessage().' - Skipping...');
                    $user = User::first(); // Try to get existing user
                    if (! $user) {
                        $this->command->error('No user available. Cannot create pages.');

                        return;
                    }
                }
            }

            // Step 1: Check and seed previous pages data
            try {
                $this->seedPreviousPages($states, $user);
            } catch (\Exception $e) {
                $this->command->warn('Error seeding previous pages: '.$e->getMessage().' - Continuing...');
            }

            // Step 2: Seed cities and areas with variations
            try {
                $this->seedCitiesAndAreas($states);
            } catch (\Exception $e) {
                $this->command->warn('Error seeding cities and areas: '.$e->getMessage().' - Continuing...');
            }

            // Step 3: Create pages from existing cities and areas
            try {
                $this->createPagesFromCitiesAndAreas($user);
            } catch (\Exception $e) {
                $this->command->warn('Error creating pages from cities and areas: '.$e->getMessage().' - Continuing...');
            }

            $this->command->info('CMS seeding process completed!');
        } catch (\Exception $e) {
            $this->command->error('Fatal error in seeder: '.$e->getMessage());
        }
    }

    /**
     * Seed previous pages if they don't exist
     */
    private function seedPreviousPages($states, $user): void
    {
        $state1 = $states->first();
        $state2 = $states->skip(1)->first();
        $state3 = $states->skip(2)->first();

        if (! $state1) {
            return;
        }

        // Get cities for these states (status = 1, not 'active')
        $cities1 = City::where('state_id', $state1->id)->where('status', 1)->take(2)->get();
        $cities2 = $state2 ? City::where('state_id', $state2->id)->where('status', 1)->take(2)->get() : collect();
        $cities3 = $state3 ? City::where('state_id', $state3->id)->where('status', 1)->take(2)->get() : collect();

        // Get areas for these states (status = 1, not 'active')
        $areas1 = Area::where('state_id', $state1->id)->where('status', 1)->take(2)->get();
        $areas2 = $state2 ? Area::where('state_id', $state2->id)->where('status', 1)->take(2)->get() : collect();
        $areas3 = $state3 ? Area::where('state_id', $state3->id)->where('status', 1)->take(2)->get() : collect();

        // Create sample pages for state 1 if they don't exist
        if ($state1 && $cities1->count() > 0 && $areas1->count() > 0) {
            try {
                $slug1 = 'web-development-services-'.Str::slug($state1->name);
                if (! Page::where('slug', $slug1)->exists()) {
                    Page::create([
                        'title' => 'Web Development Services in '.$state1->name,
                        'slug' => $slug1,
                        'content' => '<h2>Professional Web Development Services</h2><p>We provide comprehensive web development services in '.$state1->name.'. Our team specializes in creating modern, responsive websites that help businesses grow online.</p><h3>Our Services Include:</h3><ul><li>Custom Website Development</li><li>E-commerce Solutions</li><li>Mobile App Development</li><li>SEO Optimization</li><li>Digital Marketing</li></ul>',
                        'excerpt' => 'Professional web development services in '.$state1->name.'. Custom websites, e-commerce solutions, and digital marketing.',
                        'status' => 'published',
                        'is_featured' => true,
                        'state_id' => $state1->id,
                        'city_id' => $cities1->first()->id,
                        'area_id' => $areas1->first()->id,
                        'user_id' => $user->id,
                        'page_type' => 'service',
                        'template' => 'service',
                        'meta_title' => 'Web Development Services in '.$state1->name.' | Professional Web Solutions',
                        'meta_description' => 'Get professional web development services in '.$state1->name.'. Custom websites, e-commerce solutions, and digital marketing services.',
                        'published_at' => now(),
                    ]);
                    $this->command->info('Created page for '.$state1->name);
                }
            } catch (\Exception $e) {
                $this->command->warn('Error creating page for '.$state1->name.': '.$e->getMessage().' - Skipping...');
            }
        }

        // Create sample pages for state 2 if they don't exist
        if ($state2 && $cities2->count() > 0 && $areas2->count() > 0) {
            try {
                $slug2 = 'software-development-company-'.Str::slug($state2->name);
                if (! Page::where('slug', $slug2)->exists()) {
                    Page::create([
                        'title' => 'Software Development Company in '.$state2->name,
                        'slug' => $slug2,
                        'content' => '<h2>Leading Software Development Company</h2><p>Our software development company in '.$state2->name.' provides cutting-edge solutions for businesses of all sizes. We combine technical expertise with business acumen to deliver exceptional results.</p><h3>Our Expertise:</h3><ul><li>Enterprise Software Development</li><li>Cloud Solutions</li><li>API Development</li><li>Database Design</li><li>System Integration</li></ul>',
                        'excerpt' => 'Leading software development company in '.$state2->name.'. Enterprise solutions, cloud services, and system integration.',
                        'status' => 'published',
                        'is_featured' => true,
                        'state_id' => $state2->id,
                        'city_id' => $cities2->first()->id,
                        'area_id' => $areas2->first()->id,
                        'user_id' => $user->id,
                        'page_type' => 'service',
                        'template' => 'service',
                        'meta_title' => 'Software Development Company in '.$state2->name.' | Enterprise Solutions',
                        'meta_description' => 'Leading software development company in '.$state2->name.'. Enterprise software, cloud solutions, and system integration services.',
                        'published_at' => now(),
                    ]);
                    $this->command->info('Created page for '.$state2->name);
                }
            } catch (\Exception $e) {
                $this->command->warn('Error creating page for '.$state2->name.': '.$e->getMessage().' - Skipping...');
            }
        }

        // Create sample pages for state 3 if they don't exist
        if ($state3 && $cities3->count() > 0 && $areas3->count() > 0) {
            try {
                $slug3 = 'mobile-app-development-'.Str::slug($state3->name);
                if (! Page::where('slug', $slug3)->exists()) {
                    Page::create([
                        'title' => 'Mobile App Development in '.$state3->name,
                        'slug' => $slug3,
                        'content' => '<h2>Expert Mobile App Development</h2><p>Transform your business ideas into powerful mobile applications with our expert development team in '.$state3->name.'. We create native and cross-platform apps that deliver exceptional user experiences.</p><h3>App Development Services:</h3><ul><li>iOS App Development</li><li>Android App Development</li><li>Cross-Platform Solutions</li><li>UI/UX Design</li><li>App Store Optimization</li></ul>',
                        'excerpt' => 'Expert mobile app development in '.$state3->name.'. iOS, Android, and cross-platform app solutions.',
                        'status' => 'published',
                        'is_featured' => false,
                        'state_id' => $state3->id,
                        'city_id' => $cities3->first()->id,
                        'area_id' => $areas3->first()->id,
                        'user_id' => $user->id,
                        'page_type' => 'service',
                        'template' => 'service',
                        'meta_title' => 'Mobile App Development in '.$state3->name.' | iOS & Android Apps',
                        'meta_description' => 'Expert mobile app development in '.$state3->name.'. iOS, Android, and cross-platform app development services.',
                        'published_at' => now(),
                    ]);
                    $this->command->info('Created page for '.$state3->name);
                }
            } catch (\Exception $e) {
                $this->command->warn('Error creating page for '.$state3->name.': '.$e->getMessage().' - Skipping...');
            }
        }
    }

    /**
     * Seed cities and areas with variations
     */
    private function seedCitiesAndAreas($states): void
    {
        $cityVariations = [
            // Metro cities
            ['name' => 'Downtown', 'nearby' => 'Central Business District', 'popular_cities' => '1'],
            ['name' => 'Uptown', 'nearby' => 'Residential Area', 'popular_cities' => '1'],
            ['name' => 'Midtown', 'nearby' => 'Commercial Hub', 'popular_cities' => '0'],
            ['name' => 'Old City', 'nearby' => 'Historic District', 'popular_cities' => '1'],
            ['name' => 'New City', 'nearby' => 'Modern Development', 'popular_cities' => '0'],
            ['name' => 'East Side', 'nearby' => 'Industrial Zone', 'popular_cities' => '0'],
            ['name' => 'West Side', 'nearby' => 'Residential Complex', 'popular_cities' => '1'],
            ['name' => 'North End', 'nearby' => 'Suburban Area', 'popular_cities' => '0'],
            ['name' => 'South End', 'nearby' => 'Business Park', 'popular_cities' => '1'],
            ['name' => 'City Center', 'nearby' => 'Shopping District', 'popular_cities' => '1'],
        ];

        $areaVariations = [
            // Area types with variations
            ['name' => 'Market Area', 'types' => 'shopping_mall|market', 'address' => 'Main Market Street'],
            ['name' => 'Residential Colony', 'types' => 'residential|neighborhood', 'address' => 'Residential Colony Road'],
            ['name' => 'Industrial Zone', 'types' => 'industrial|factory', 'address' => 'Industrial Estate'],
            ['name' => 'Business Park', 'types' => 'business|office', 'address' => 'Business Park Avenue'],
            ['name' => 'Tech Hub', 'types' => 'technology|office', 'address' => 'Technology Park'],
            ['name' => 'Medical District', 'types' => 'hospital|healthcare', 'address' => 'Medical Center Road'],
            ['name' => 'Educational Zone', 'types' => 'school|university', 'address' => 'Education Hub'],
            ['name' => 'Entertainment District', 'types' => 'entertainment|restaurant', 'address' => 'Entertainment Street'],
            ['name' => 'Transport Hub', 'types' => 'transit_station|bus_station', 'address' => 'Transport Center'],
            ['name' => 'Green Zone', 'types' => 'park|recreation', 'address' => 'Green Park Area'],
        ];

        $createdCities = 0;
        $createdAreas = 0;

        foreach ($states as $state) {
            try {
                // Create city variations
                foreach ($cityVariations as $index => $cityData) {
                    try {
                        // Check if city already exists
                        $existingCity = City::where('state_id', $state->id)
                            ->where('city_name', $cityData['name'].' '.$state->name)
                            ->first();

                        if (! $existingCity) {
                            // Mix of active and inactive cities
                            $status = ($index % 3 == 0) ? 1 : 0; // Every 3rd city is active

                            City::create([
                                'state_id' => $state->id,
                                'city_name' => $cityData['name'].' '.$state->name,
                                'nearby' => null, // nearby is integer, set to null
                                'popular_cities' => $cityData['popular_cities'],
                                'status' => $status,
                            ]);
                            $createdCities++;
                        }
                    } catch (\Exception $e) {
                        $this->command->warn('Error creating city "'.$cityData['name'].' '.$state->name.'": '.$e->getMessage().' - Skipping...');

                        continue;
                    }
                }
            } catch (\Exception $e) {
                $this->command->warn('Error processing cities for state "'.$state->name.'": '.$e->getMessage().' - Skipping state...');

                continue;
            }

            // Get cities for this state to create areas
            try {
                $cities = City::where('state_id', $state->id)->where('status', 1)->get();

                if ($cities->count() > 0) {
                    foreach ($cities->take(5) as $city) {
                        try {
                            foreach ($areaVariations as $index => $areaData) {
                                try {
                                    // Check if area already exists
                                    $existingArea = Area::where('city_id', $city->id)
                                        ->where('name', $areaData['name'].' '.$city->city_name)
                                        ->first();

                                    if (! $existingArea) {
                                        // Mix of active and inactive areas
                                        $status = ($index % 2 == 0) ? 1 : 0; // Every 2nd area is active

                                        // Generate coordinates (sample data)
                                        $latitude = 20.0 + (rand(0, 1000) / 100);
                                        $longitude = 77.0 + (rand(0, 1000) / 100);

                                        Area::create([
                                            'name' => $areaData['name'].' '.$city->city_name,
                                            'slug' => Str::slug($areaData['name'].' '.$city->city_name),
                                            'address' => $areaData['address'].', '.$city->city_name,
                                            'city_id' => $city->id,
                                            'state_id' => $state->id,
                                            'types' => $areaData['types'],
                                            'latitude' => $latitude,
                                            'longitude' => $longitude,
                                            'status' => $status,
                                        ]);
                                        $createdAreas++;
                                    }
                                } catch (\Exception $e) {
                                    $this->command->warn('Error creating area "'.$areaData['name'].' '.$city->city_name.'": '.$e->getMessage().' - Skipping...');

                                    continue;
                                }
                            }
                        } catch (\Exception $e) {
                            $this->command->warn('Error processing areas for city "'.$city->city_name.'": '.$e->getMessage().' - Skipping city...');

                            continue;
                        }
                    }
                }
            } catch (\Exception $e) {
                $this->command->warn('Error getting cities for state "'.$state->name.'": '.$e->getMessage().' - Skipping...');

                continue;
            }
        }

        $this->command->info("Created {$createdCities} new cities and {$createdAreas} new areas with variations!");
        $this->command->info('CMS seeding completed successfully!');
    }

    /**
     * Create pages by fetching data from updated_cities and areas tables
     */
    private function createPagesFromCitiesAndAreas($user): void
    {
        $createdPages = 0;
        $skippedPages = 0;

        // Fetch all active cities from updated_cities table
        $cities = City::where('status', 1)->with('state')->get();
        $this->command->info("Found {$cities->count()} active cities to process...");

        // Create pages for each city
        foreach ($cities as $city) {
            try {
                $state = $city->state;
                if (! $state) {
                    $this->command->warn("City '{$city->city_name}' has no state. Skipping...");
                    $skippedPages++;

                    continue;
                }

                // Check if page already exists for this city
                $existingPage = Page::where('city_id', $city->id)
                    ->where('page_type', 'city')
                    ->first();

                if ($existingPage) {
                    $skippedPages++;

                    continue;
                }

                // Generate dynamic content based on city data
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
                $createdPages++;
            } catch (\Exception $e) {
                $this->command->warn("Error creating page for city '{$city->city_name}': ".$e->getMessage().' - Skipping...');
                $skippedPages++;

                continue;
            }
        }

        // Fetch all active areas from areas table
        $areas = Area::where('status', 1)->with(['city', 'state'])->get();
        $this->command->info("Found {$areas->count()} active areas to process...");

        // Create pages for each area
        foreach ($areas as $area) {
            try {
                // Get city relationship properly - check if it's a model instance or string
                $city = $area->city;
                if (! $city instanceof \App\City) {
                    // If city is a string (column), try to get the relationship
                    if ($area->city_id) {
                        $city = \App\City::find($area->city_id);
                    } else {
                        $city = null;
                    }
                }
                
                // Get state relationship properly - check if it's a model instance or string
                $state = $area->state;
                if (! $state instanceof \App\State) {
                    // If state is a string (column), try to get the relationship
                    if ($area->state_id) {
                        $state = \App\State::find($area->state_id);
                    } else {
                        $state = null;
                    }
                }

                if (! $state) {
                    $this->command->warn("Area '{$area->name}' is missing state. Skipping...");
                    $skippedPages++;

                    continue;
                }

                // Check if page already exists for this area
                $existingPage = Page::where('area_id', $area->id)
                    ->where('page_type', 'area')
                    ->first();

                if ($existingPage) {
                    $skippedPages++;

                    continue;
                }

                // Generate dynamic content based on area data - city pages are created, so we don't need city in title
                $title = "Local Business Services in {$area->name}, {$state->name}";
                $slug = Str::slug("local-business-services-{$area->slug}");

                // Ensure unique slug
                $originalSlug = $slug;
                $counter = 1;
                while (Page::where('slug', $slug)->exists()) {
                    $slug = $originalSlug.'-'.$counter;
                    $counter++;
                }

                $content = $this->generateAreaPageContent($area, $state);
                $excerpt = $this->generateAreaExcerpt($area, $state);

                Page::create([
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
                    'meta_title' => "{$title} | Indsoft24",
                    'meta_description' => $excerpt,
                    'published_at' => now(),
                ]);
                $createdPages++;
            } catch (\Exception $e) {
                $this->command->warn("Error creating page for area '{$area->name}': ".$e->getMessage().' - Skipping...');
                $skippedPages++;

                continue;
            }
        }

        $this->command->info("Created {$createdPages} pages from cities and areas!");
        if ($skippedPages > 0) {
            $this->command->info("Skipped {$skippedPages} pages (already exist or missing data).");
        }
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
    private function generateAreaPageContent($area, $state): string
    {
        $address = $area->address ? "Located at {$area->address}" : '';
        $types = $area->types ? 'Area type: '.str_replace('|', ', ', $area->types) : '';
        $mapLink = '';
        if ($area->latitude && $area->longitude) {
            $mapLink = "<p><a href='https://www.google.com/maps?q={$area->latitude},{$area->longitude}' target='_blank'>View on Google Maps</a></p>";
        }

        return "<h2>Local Business Services in {$area->name}, {$state->name}</h2>
        <p>Welcome to {$area->name}, a prime location in {$state->name}. {$address}. {$types}.</p>
        
        <h3>About {$area->name}</h3>
        <p>{$area->name} is a well-established area in {$state->name}, offering excellent business opportunities and a thriving local economy. This area is perfect for businesses looking to establish a strong local presence.</p>
        
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
            <li>Prime location in {$state->name}</li>
            <li>Excellent connectivity and accessibility</li>
            <li>Growing local market</li>
            <li>Supportive business environment</li>
            <li>Access to skilled workforce</li>
        </ul>
        
        <h3>Start Your Business Today</h3>
        <p>Ready to start or expand your business in {$area->name}? Our platform provides everything you need to set up your e-commerce store and establish your online presence. With support for all business categories, you can launch your store in minutes.</p>
        
        <p>Contact us to learn more about business opportunities in {$area->name}, {$state->name}.</p>";
    }

    /**
     * Generate area page excerpt
     */
    private function generateAreaExcerpt($area, $state): string
    {
        return "Explore business opportunities in {$area->name}, {$state->name}. Set up your e-commerce store, get listed in our directory, and grow your local business with our comprehensive platform.";
    }
}
