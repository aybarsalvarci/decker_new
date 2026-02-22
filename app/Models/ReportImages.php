<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportImages extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function report() : BelongsTo
    {
        return $this->belongsTo(Report::class);
    }
}
