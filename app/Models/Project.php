<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_image',
        'title',
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
     * The team members that belong to the project.
     */
    public function teamLeads(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
}
