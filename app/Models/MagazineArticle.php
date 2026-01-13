<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class MagazineArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'date',
        'text',
        'image',
        'image_gallery',
        'magazine_category_id',
        'order',
        'is_published',
    ];

    protected $casts = [
        'date' => 'date',
        'image_gallery' => 'array',
        'order' => 'integer',
        'is_published' => 'boolean',
    ];

    /**
     * Get the category that owns the article.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(MagazineCategory::class, 'magazine_category_id');
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });

        static::updating(function ($article) {
            if ($article->isDirty('title') && empty($article->slug)) {
                $article->slug = Str::slug($article->title);
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
