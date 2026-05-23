<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class CategoryIcon extends Model
{
    protected $guarded = ["id", "created_at", "updated_at"];

    public function getTextAttribute()
    {
        return $this->{"text_" . App::getLocale()};
    }
}
