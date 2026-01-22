<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurStory extends Model
{
    protected $table = 'our_story';

    protected $fillable = [
        'intro',
        'description',
        'highlight',
    ];

    /**
     * Get the singleton instance of Our Story
     */
    public static function getOurStory()
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
