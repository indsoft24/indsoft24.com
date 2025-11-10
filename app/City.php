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
        return 'city_name';
    }

    /**
     * Get name attribute (alias for city_name)
     */
    public function getNameAttribute()
    {
        return $this->city_name;
    }

    /**
     * Get slug attribute
     */
    public function getSlugAttribute()
    {
        return Str::slug($this->city_name);
    }
}
