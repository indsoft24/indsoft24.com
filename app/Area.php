<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id',
        'name',
        'slug',
        'address',
        'city',
        'city_id',
        'state_id',
        'types',
        'latitude',
        'longitude',
        'status',
    ];

    /**
     * Get the state that owns the area
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the city that owns the area
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * Get the pages for the area
     */
    public function pages()
    {
        return $this->hasMany(Page::class, 'area_id');
    }

    /**
     * Get published pages for the area
     */
    public function publishedPages()
    {
        return $this->hasMany(Page::class, 'area_id')->where('status', 'published');
    }

    /**
     * Scope for active areas
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope for areas by city
     */
    public function scopeByCity($query, $cityId)
    {
        return $query->where('city_id', $cityId);
    }

    /**
     * Scope for areas by state
     */
    public function scopeByState($query, $stateId)
    {
        return $query->where('state_id', $stateId);
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($area) {
            if (empty($area->slug)) {
                $area->slug = static::generateUniqueSlug($area);
            }
        });

        static::updating(function ($area) {
            // Regenerate slug if name changed
            if ($area->isDirty('name')) {
                $area->slug = static::generateUniqueSlug($area);
            }
        });
    }

    /**
     * Generate a unique slug for the area
     * Strategy:
     * 1. Start with slug from name
     * 2. If duplicate, add city name as suffix
     * 3. If still duplicate, add area ID as suffix
     */
    protected static function generateUniqueSlug($area)
    {
        // Handle empty area name
        if (empty($area->name)) {
            // If name is empty and ID exists, use area ID as slug
            if (isset($area->id) && $area->id) {
                return 'area-'.$area->id;
            }
            // If no ID yet, use a placeholder (will be updated later)
            return 'area-'.time();
        }

        $baseSlug = Str::slug($area->name);
        
        // If slug is empty after conversion, use area ID
        if (empty($baseSlug)) {
            if (isset($area->id) && $area->id) {
                return 'area-'.$area->id;
            }
            return 'area-'.time();
        }
        
        // First try: just the base slug
        if (!static::where('slug', $baseSlug)->where('id', '!=', $area->id ?? 0)->exists()) {
            return $baseSlug;
        }

        // Second try: add city name as suffix
        $cityName = null;
        
        // First, try to get city name from the 'city' column (string value)
        // Use getAttributes() to access raw database value, bypassing relationship
        $attributes = $area->getAttributes();
        if (isset($attributes['city']) && is_string($attributes['city']) && !empty($attributes['city'])) {
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
            $slugWithCity = $baseSlug . '-' . $citySlug;
            
            if (!static::where('slug', $slugWithCity)->where('id', '!=', $area->id ?? 0)->exists()) {
                return $slugWithCity;
            }
        }

        // Third try: add area ID as suffix
        if (isset($area->id) && $area->id) {
            $slugWithId = $baseSlug . '-' . $area->id;
            if (!static::where('slug', $slugWithId)->where('id', '!=', $area->id)->exists()) {
                return $slugWithId;
            }
        }

        // Fallback: if ID not available yet (during creation), use numeric counter
        $originalSlug = $baseSlug;
        $counter = 1;
        while (static::where('slug', $originalSlug)->exists()) {
            $originalSlug = $baseSlug . '-' . $counter;
            $counter++;
        }
        
        return $originalSlug;
    }
}
