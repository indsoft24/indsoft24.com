<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'meta_title',
        'meta_description',
        'status',
        'is_featured',
        'views_count',
        'state_id',
        'city_id',
        'area_id',
        'user_id',
        'published_at',
        'page_type',
        'template',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
            
            if ($page->status === 'published' && empty($page->published_at)) {
                $page->published_at = now();
            }
        });
        
        static::updating(function ($page) {
            if ($page->isDirty('title') && empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
            
            if ($page->isDirty('status') && $page->status === 'published' && empty($page->published_at)) {
                $page->published_at = now();
            }
        });
    }

    /**
     * Get the state that owns the page
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the city that owns the page
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the area that owns the page
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Get the user that owns the page
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for published pages
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    /**
     * Scope for featured pages
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for pages by state
     */
    public function scopeByState($query, $stateId)
    {
        return $query->where('state_id', $stateId);
    }

    /**
     * Scope for pages by city
     */
    public function scopeByCity($query, $cityId)
    {
        return $query->where('city_id', $cityId);
    }

    /**
     * Scope for pages by area
     */
    public function scopeByArea($query, $areaId)
    {
        return $query->where('area_id', $areaId);
    }

    /**
     * Scope for pages by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('page_type', $type);
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the excerpt or truncated content
     */
    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }
        
        return Str::limit(strip_tags($this->content), 150);
    }

    /**
     * Increment views count
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    /**
     * Get the full location string
     */
    public function getLocationAttribute()
    {
        $location = [];
        
        if ($this->area) {
            $location[] = $this->area->name;
        }
        
        if ($this->city) {
            $location[] = $this->city->name;
        }
        
        if ($this->state) {
            $location[] = $this->state->name;
        }
        
        return implode(', ', $location);
    }
}
