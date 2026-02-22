<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getTitleAttribute()
    {
        return $this->{'title_' . app()->getLocale()};
    }

    public function getContentAttribute()
    {
        return $this->{'content_' . app()->getLocale()};
    }
}
