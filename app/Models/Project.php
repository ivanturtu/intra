<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_image',
        'title',
        'slug',
        'short_description',
        'sector',
        'client',
        'location',
        'year',
        'quote',
        'image_gallery',
        'description',
        'selected_image',
        'team_members',
        'category_id',
        'order',
        'is_published',
        'in_hero',
    ];

    protected $casts = [
        'image_gallery' => 'array',
        'team_members' => 'array',
        'year' => 'integer',
        'order' => 'integer',
        'is_published' => 'boolean',
        'in_hero' => 'boolean',
    ];

    /**
     * Get the category that owns the project.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the project team members for the project.
     */
    public function projectTeamMembers(): HasMany
    {
        return $this->hasMany(ProjectTeamMember::class)->orderBy('order');
    }

    /**
     * The INTRAstudio team leads that belong to the project.
     */
    public function intraStudioTeamLeads(): BelongsToMany
    {
        return $this->belongsToMany(IntraStudioTeamLead::class, 'project_intra_studio_team_lead');
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('title') && empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
