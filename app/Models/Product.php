<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(ProductColor::class, 'products_has_colors', 'product_id', 'color_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImages::class, 'product_id', 'id');
    }

    public function mainImage(): HasOne
    {
        return $this->hasOne(ProductImages::class, 'product_id', 'id')->ofMany('id', 'min');
    }

    public function getNameAttribute(): string
    {
        return $this->{'name_' . app()->getLocale()};
    }

    public function getSlugAttribute(): string
    {
        return $this->{'slug_' . app()->getLocale()};
    }

    public function getDescriptionAttribute(): string
    {
        return $this->{'description_' . app()->getLocale()};
    }
}
