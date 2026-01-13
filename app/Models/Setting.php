<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_title',
        'site_description',
        'logo',
        'favicon',
        'facebook_url',
        'linkedin_url',
        'instagram_url',
        'address',
        'phone',
        'email',
        'privacy_policy',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'twitter_card_title',
        'twitter_card_description',
        'twitter_card_image',
    ];

    /**
     * Get the first (and only) settings record.
     */
    public static function getSettings()
    {
        return static::first() ?? static::create([
            'site_title' => 'INTRA studio',
            'address' => '1505 Barrington Street, Suite 100 - M03, Halifax, Nova Scotia, B3J 2A4 CANADA',
        ]);
    }
}
