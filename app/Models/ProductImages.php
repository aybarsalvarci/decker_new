<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImages extends Model
{
    protected $fillable = ['product_id', 'image'];

// Model "boot" edildiğinde çalışacak metod
    protected static function booted()
    {
        // 'deleting' event'ini dinliyoruz
        static::deleting(function ($image) {
            // Dosya var mı kontrol et ve sil
            if ($image->image && Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
        });
    }

}
