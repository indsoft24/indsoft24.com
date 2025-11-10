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
        return 'name';
    }

    /**
     * Get slug attribute
     */
    public function getSlugAttribute()
    {
        return Str::slug($this->name);
    }
}
