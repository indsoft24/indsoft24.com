<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add slug column if it doesn't exist
        if (!Schema::hasColumn('updated_cities', 'slug')) {
            DB::statement('ALTER TABLE updated_cities ADD COLUMN slug VARCHAR(255) NULL AFTER city_name');
            DB::statement('CREATE INDEX updated_cities_slug_index ON updated_cities(slug)');
        }

        // Generate slugs for existing cities using raw SQL
        $cities = DB::table('updated_cities')->whereNull('slug')->orWhere('slug', '')->get();
        
        foreach ($cities as $city) {
            if (!empty($city->city_name)) {
                $baseSlug = Str::slug($city->city_name);
                $slug = $baseSlug;
                $counter = 1;
                
                // Ensure unique slug per state
                while (DB::table('updated_cities')
                    ->where('slug', $slug)
                    ->where('state_id', $city->state_id)
                    ->where('id', '!=', $city->id)
                    ->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }
                
                DB::table('updated_cities')->where('id', $city->id)->update(['slug' => $slug]);
            }
        }

        // Make slug required
        try {
            DB::statement('ALTER TABLE updated_cities MODIFY slug VARCHAR(255) NOT NULL');
        } catch (\Exception $e) {
            // Might already be NOT NULL
        }
        
        // Add unique constraint per state
        try {
            DB::statement('ALTER TABLE updated_cities ADD UNIQUE KEY cities_state_slug_unique (state_id, slug)');
        } catch (\Exception $e) {
            // Unique might already exist
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('updated_cities', 'slug')) {
            try {
                DB::statement('ALTER TABLE updated_cities DROP INDEX cities_state_slug_unique');
            } catch (\Exception $e) {}
            
            try {
                DB::statement('ALTER TABLE updated_cities DROP INDEX updated_cities_slug_index');
            } catch (\Exception $e) {}
            
            DB::statement('ALTER TABLE updated_cities DROP COLUMN slug');
        }
    }
};
