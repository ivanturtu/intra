<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class IntraStudioTeamLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'role',
        'qualification',
        'incipit',
        'vision_phrase',
        'description',
        'email',
        'photo',
        'order',
        'quote',
        'resume_link',
    ];

    /**
     * The projects that belong to the team lead.
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_intra_studio_team_lead');
    }
}
