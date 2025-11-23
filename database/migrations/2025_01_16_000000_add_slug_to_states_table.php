<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add slug column if it doesn't exist
        if (! Schema::hasColumn('states', 'slug')) {
            DB::statement('ALTER TABLE states ADD COLUMN slug VARCHAR(255) NULL AFTER name');
            DB::statement('CREATE INDEX states_slug_index ON states(slug)');
        }

        // Generate slugs for existing states using raw SQL
        $states = DB::table('states')->whereNull('slug')->orWhere('slug', '')->get();

        foreach ($states as $state) {
            if (! empty($state->name)) {
                $baseSlug = Str::slug($state->name);
                $slug = $baseSlug;
                $counter = 1;

                // Ensure unique slug
                while (DB::table('states')->where('slug', $slug)->where('id', '!=', $state->id)->exists()) {
                    $slug = $baseSlug.'-'.$counter;
                    $counter++;
                }

                DB::table('states')->where('id', $state->id)->update(['slug' => $slug]);
            }
        }

        // Make slug required and unique
        try {
            DB::statement('ALTER TABLE states MODIFY slug VARCHAR(255) NOT NULL');
        } catch (\Exception $e) {
            // Might already be NOT NULL
        }

        try {
            DB::statement('ALTER TABLE states ADD UNIQUE KEY states_slug_unique (slug)');
        } catch (\Exception $e) {
            // Unique might already exist
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('states', 'slug')) {
            try {
                DB::statement('ALTER TABLE states DROP INDEX states_slug_unique');
            } catch (\Exception $e) {
            }

            try {
                DB::statement('ALTER TABLE states DROP INDEX states_slug_index');
            } catch (\Exception $e) {
            }

            DB::statement('ALTER TABLE states DROP COLUMN slug');
        }
    }
};
