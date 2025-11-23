<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'country_id',
        'is_state_or_ut',
    ];

    protected $casts = [
        'is_state_or_ut' => 'boolean',
    ];

    /**
     * Get the cities for the state
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * Get active cities for the state
     */
    public function activeCities()
    {
        return $this->hasMany(City::class)->where('status', 1);
    }

    /**
     * Get the areas for the state
     */
    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    /**
     * Get active areas for the state
     */
    public function activeAreas()
    {
        return $this->hasMany(Area::class)->where('status', 1);
    }

    /**
     * Get the pages for the state
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    /**
     * Get published pages for the state
     */
    public function publishedPages()
    {
        return $this->hasMany(Page::class)->where('status', 'published');
    }

    /**
     * Scope for active states
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the route key value (auto-generate slug if missing)
     */
    public function getRouteKey()
    {
        // Auto-generate slug if missing
        if (empty($this->slug) && ! empty($this->name)) {
            $this->slug = static::generateUniqueSlug($this);
            // Use update to bypass model events but ensure save
            \Illuminate\Support\Facades\DB::table('states')
                ->where('id', $this->id)
                ->update(['slug' => $this->slug]);
            // Refresh the model
            $this->refresh();
        }

        return $this->slug ?? $this->getAttribute('slug');
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($state) {
            if (empty($state->slug)) {
                $state->slug = static::generateUniqueSlug($state);
            }
        });

        static::updating(function ($state) {
            // Generate slug if missing (regardless of whether name changed)
            if (empty($state->slug)) {
                $state->slug = static::generateUniqueSlug($state);
            }
            // Regenerate slug if name changed and we want to update it
            elseif ($state->isDirty('name')) {
                // Optionally regenerate slug when name changes
                // Uncomment the line below if you want slugs to update when name changes
                // $state->slug = static::generateUniqueSlug($state);
            }
        });
    }

    /**
     * Generate a unique slug for the state
     */
    public static function generateUniqueSlug($state)
    {
        if (empty($state->name)) {
            return 'state-'.($state->id ?? time());
        }

        $baseSlug = Str::slug($state->name);

        // First try: just the base slug
        if (! static::where('slug', $baseSlug)->where('id', '!=', $state->id ?? 0)->exists()) {
            return $baseSlug;
        }

        // If duplicate, add numeric suffix
        $counter = 1;
        $slug = $baseSlug.'-'.$counter;

        while (static::where('slug', $slug)->where('id', '!=', $state->id ?? 0)->exists()) {
            $counter++;
            $slug = $baseSlug.'-'.$counter;
        }

        return $slug;
    }
}
