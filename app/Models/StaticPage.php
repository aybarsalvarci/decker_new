<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class StaticPage extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function getTitleAttribute()
    {
        return $this->{'title_' . App::getLocale()};
    }

    public function getContentAttribute()
    {
        return $this->{'content_' . App::getLocale()};
    }
}
