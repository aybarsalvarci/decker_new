<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutFactory extends Model
{
    protected $guarded = ["id", "created_at", "updated_at"];

    /* =============================================================
     * IMAGE ACCESSORS (Resim URL Yönetimi)
     * $factory->image1_url şeklinde çağrılır.
     * ============================================================= */

    public function getImage1UrlAttribute()
    {
        return $this->image1
            ? asset('storage/' . $this->image1)
            : asset('front/assets/images/no-image.jpg'); // Varsayılan resim yolu
    }

    public function getImage2UrlAttribute()
    {
        return $this->image2
            ? asset('storage/' . $this->image2)
            : asset('front/assets/images/no-image.jpg');
    }

    /* =============================================================
     * LOCALIZATION ACCESSORS
     * ============================================================= */

    // --- MAIN TEXTS ---
    public function getTitleAttribute()
    {
        return $this->{"title_" . app()->getLocale()};
    }

    public function getSubtitleAttribute()
    {
        return $this->{"subtitle_" . app()->getLocale()};
    }

    public function getDescAttribute()
    {
        return $this->{"desc_" . app()->getLocale()};
    }

    // --- IMAGE 1 TEXTS ---
    public function getImage1TitleAttribute()
    {
        return $this->{"image1_title_" . app()->getLocale()};
    }

    public function getImage1DescAttribute()
    {
        return $this->{"image1_desc_" . app()->getLocale()};
    }

    // --- IMAGE 2 TEXTS ---
    public function getImage2TitleAttribute()
    {
        return $this->{"image2_title_" . app()->getLocale()};
    }

    public function getImage2DescAttribute()
    {
        return $this->{"image2_desc_" . app()->getLocale()};
    }
}
