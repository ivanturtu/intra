<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectTeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'surname',
        'role',
        'description',
        'email',
        'photo',
        'order',
    ];

    /**
     * Get the project that owns the team member.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
