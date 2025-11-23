<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class City extends Model
{
    use HasFactory;

    protected $table = 'updated_cities';

    protected $fillable = [
        'state_id',
        'city_name',
        'slug',
        'nearby',
        'popular_cities',
        'status',
    ];

    /**
     * Get the state that owns the city
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the areas for the city
     */
    public function areas()
    {
        return $this->hasMany(Area::class, 'city_id');
    }

    /**
     * Get active areas for the city
     */
    public function activeAreas()
    {
        return $this->hasMany(Area::class, 'city_id')->where('status', 1);
    }

    /**
     * Get the pages for the city
     */
    public function pages()
    {
        return $this->hasMany(Page::class, 'city_id');
    }

    /**
     * Get published pages for the city
     */
    public function publishedPages()
    {
        return $this->hasMany(Page::class, 'city_id')->where('status', 'published');
    }

    /**
     * Scope for active cities
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope for cities by state
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
     * Get the route key value (auto-generate slug if missing)
     */
    public function getRouteKey()
    {
        // Auto-generate slug if missing
        if (empty($this->slug) && ! empty($this->city_name)) {
            $this->slug = static::generateUniqueSlug($this);
            // Use update to bypass model events but ensure save
            \Illuminate\Support\Facades\DB::table('updated_cities')
                ->where('id', $this->id)
                ->update(['slug' => $this->slug]);
            // Refresh the model
            $this->refresh();
        }
        
        return $this->slug ?? $this->getAttribute('slug');
    }

    /**
     * Get name attribute (alias for city_name)
     */
    public function getNameAttribute()
    {
        return $this->city_name;
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($city) {
            if (empty($city->slug)) {
                $city->slug = static::generateUniqueSlug($city);
            }
        });

        static::updating(function ($city) {
            // Generate slug if missing (regardless of whether city_name changed)
            if (empty($city->slug)) {
                $city->slug = static::generateUniqueSlug($city);
            }
            // Regenerate slug if city_name changed and we want to update it
            elseif ($city->isDirty('city_name')) {
                // Optionally regenerate slug when city_name changes
                // Uncomment the line below if you want slugs to update when city_name changes
                // $city->slug = static::generateUniqueSlug($city);
            }
        });
    }

    /**
     * Generate a unique slug for the city
     */
    public static function generateUniqueSlug($city)
    {
        if (empty($city->city_name)) {
            return 'city-'.($city->id ?? time());
        }

        $baseSlug = Str::slug($city->city_name);

        // First try: just the base slug (unique per state)
        if (! static::where('slug', $baseSlug)
            ->where('state_id', $city->state_id)
            ->where('id', '!=', $city->id ?? 0)
            ->exists()) {
            return $baseSlug;
        }

        // If duplicate, add numeric suffix
        $counter = 1;
        $slug = $baseSlug.'-'.$counter;

        while (static::where('slug', $slug)
            ->where('state_id', $city->state_id)
            ->where('id', '!=', $city->id ?? 0)
            ->exists()) {
            $counter++;
            $slug = $baseSlug.'-'.$counter;
        }

        return $slug;
    }
}
