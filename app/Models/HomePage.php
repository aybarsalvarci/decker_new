<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $table = 'home_page';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getTopVideoTitleAttribute()
    {
        return $this->{'topVideoTitle_' . app()->getLocale()};
    }

    public function getTopVideoDescAttribute()
    {
        return $this->{'topVideoDesc_' . app()->getLocale()};
    }

    public function getHomePageAboutTitleAttribute()
    {
        return $this->{'homePageAboutTitle_' . app()->getLocale()};
    }

    public function getHomePageAboutDescAttribute()
    {
        return $this->{'homePageAboutDesc_' . app()->getLocale()};
    }
}
