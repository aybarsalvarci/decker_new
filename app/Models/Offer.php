<?php

namespace App\Models;

use App\Observers\OfferObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(OfferObserver::class)]
class Offer extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function Items(): HasMany
    {
        return $this->hasMany(OfferItem::class, 'offer_id', 'id');
    }



}
