<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function Items(): HasMany
    {
        return $this->hasMany(OfferItem::class, 'offer_id', 'id');
    }



}
