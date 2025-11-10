<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TechStack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'color',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($techStack) {
            if (empty($techStack->slug)) {
                $techStack->slug = Str::slug($techStack->name);
            }
        });
        
        static::updating(function ($techStack) {
            if ($techStack->isDirty('name') && empty($techStack->slug)) {
                $techStack->slug = Str::slug($techStack->name);
            }
        });
    }

    /**
     * Get the projects using this tech stack
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_tech_stack')
                    ->withTimestamps();
    }

    /**
     * Scope for active tech stacks
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
