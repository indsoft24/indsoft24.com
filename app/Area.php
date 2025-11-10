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
                $area->slug = Str::slug($area->name);
                // Ensure unique slug
                $originalSlug = $area->slug;
                $counter = 1;
                while (static::where('slug', $area->slug)->exists()) {
                    $area->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        });

        static::updating(function ($area) {
            if ($area->isDirty('name') && empty($area->slug)) {
                $area->slug = Str::slug($area->name);
                // Ensure unique slug
                $originalSlug = $area->slug;
                $counter = 1;
                while (static::where('slug', $area->slug)->where('id', '!=', $area->id)->exists()) {
                    $area->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        });
    }
}
