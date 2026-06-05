<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getHeroTitleAttribute()
    {
        return $this->{'hero_title_' . app()->getLocale()};
    }

    public function getHeroSubtitleAttribute()
    {
        return $this->{'hero_subtitle_' . app()->getLocale()};
    }
}
