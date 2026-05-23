<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getNameAttribute()
    {
        return $this->{'name_' . app()->getLocale()};
    }

    public function getSlugAttribute()
    {
        return $this->{'slug_' . app()->getLocale()};
    }

    public function getDescriptionAttribute()
    {
        return $this->{'description_' . app()->getLocale()};
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function icons() : HasMany
    {
        return $this->hasMany(CategoryIcon::class);
    }
}
