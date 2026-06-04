<?php

namespace App\Models;

use App\Observers\FreeSampleObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy(FreeSampleObserver::class)]
class FreeSample extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function box() : HasOne
    {
        return $this->hasOne(FreeSampleBox::class, 'id', 'box_id');
    }
}
