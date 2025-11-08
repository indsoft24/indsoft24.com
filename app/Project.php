<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'full_description',
        'live_url',
        'github_url',
        'featured_image',
        'status',
        'is_featured',
        'sort_order',
        'client_name',
        'start_date',
        'end_date',
        'meta_title',
        'meta_description',
        'created_by',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->name);
            }
            if (empty($project->created_by)) {
                $project->created_by = auth()->id();
            }
        });
        
        static::updating(function ($project) {
            if ($project->isDirty('name') && empty($project->slug)) {
                $project->slug = Str::slug($project->name);
            }
        });
    }

    /**
     * Get the creator of the project
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the developers working on the project
     */
    public function developers()
    {
        return $this->belongsToMany(User::class, 'project_developers')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    /**
     * Get the tech stacks used in the project
     */
    public function techStacks()
    {
        return $this->belongsToMany(TechStack::class, 'project_tech_stack')
                    ->withTimestamps();
    }

    /**
     * Get the screenshots for the project
     */
    public function screenshots()
    {
        return $this->hasMany(ProjectScreenshot::class)->orderBy('sort_order');
    }

    /**
     * Scope for published projects
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope for featured projects
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
