<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'category',
        'order',
        'is_published',
    ];

    protected $casts = [
        'image_gallery' => 'array',
        'team_members' => 'array',
        'year' => 'integer',
        'order' => 'integer',
        'is_published' => 'boolean',
    ];

    /**
     * The team members that belong to the project.
     */
    public function teamLeads(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
}
