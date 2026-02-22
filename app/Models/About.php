<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    // Tüm alanların toplu atanmasına (Mass Assignment) izin ver
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /* =============================================================
     * DYNAMIC ACCESSORS (Dil Bağımsız Veri Çekme)
     * View tarafında $about->hero_title dediğinizde otomatik
     * olarak aktif dil (en veya esp) neyse onu getirir.
     * ============================================================= */

    // --- HERO SECTION ---
    public function getHeroLabelAttribute()
    {
        return $this->{"hero_label_" . app()->getLocale()};
    }

    public function getHeroTitleAttribute()
    {
        return $this->{"hero_title_" . app()->getLocale()};
    }

    public function getHeroDescAttribute()
    {
        return $this->{"hero_desc_" . app()->getLocale()};
    }

    // --- STORY SECTION ---
    public function getStoryTitleAttribute()
    {
        return $this->{"story_title_" . app()->getLocale()};
    }

    public function getStorySubtitleAttribute()
    {
        return $this->{"story_subtitle_" . app()->getLocale()};
    }

    public function getStoryContentAttribute()
    {
        return $this->{"story_content_" . app()->getLocale()};
    }

    // --- VISION SECTION ---
    public function getVisionAttribute()
    {
        return $this->{"vision_" . app()->getLocale()};
    }

    // --- FACTORY SECTION HEADERS  ---
    public function getFactoryTitleAttribute()
    {
        return $this->{"factory_title_" . app()->getLocale()};
    }

    public function getFactoryDescAttribute()
    {
        return $this->{"factory_desc_" . app()->getLocale()};
    }

    // --- VALUES SECTION MAIN HEADERS ---
    public function getValuesTitleAttribute()
    {
        return $this->{"values_title_" . app()->getLocale()};
    }

    public function getValuesSubtitleAttribute()
    {
        return $this->{"values_subtitle_" . app()->getLocale()};
    }


    // --- VALUES ITEMS (1, 2, 3) ---

    // Value 1
    public function getVal1TitleAttribute() { return $this->{"val_1_title_" . app()->getLocale()}; }
    public function getVal1DescAttribute()  { return $this->{"val_1_desc_" . app()->getLocale()}; }

    // Value 2
    public function getVal2TitleAttribute() { return $this->{"val_2_title_" . app()->getLocale()}; }
    public function getVal2DescAttribute()  { return $this->{"val_2_desc_" . app()->getLocale()}; }

    // Value 3
    public function getVal3TitleAttribute() { return $this->{"val_3_title_" . app()->getLocale()}; }
    public function getVal3DescAttribute()  { return $this->{"val_3_desc_" . app()->getLocale()}; }


    // --- STATISTICS TEXTS (1, 2, 3, 4) ---

    public function getStat1TextAttribute() { return $this->{"stat_1_text_" . app()->getLocale()}; }
    public function getStat2TextAttribute() { return $this->{"stat_2_text_" . app()->getLocale()}; }
    public function getStat3TextAttribute() { return $this->{"stat_3_text_" . app()->getLocale()}; }
    public function getStat4TextAttribute() { return $this->{"stat_4_text_" . app()->getLocale()}; }

}
