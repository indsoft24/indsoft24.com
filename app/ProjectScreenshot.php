<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectScreenshot extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'image_path',
        'title',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * Get the project that owns the screenshot
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
