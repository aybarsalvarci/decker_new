<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FreeSample extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function box() : HasOne
    {
        return $this->hasOne(FreeSampleBox::class, 'id', 'box_id');
    }
}
