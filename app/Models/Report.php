<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function booted()
    {
        static::deleting(function ($report) {
            $content = $report->content_en . $report->content_esp;
            preg_match_all('/<img[^>]+src="([^">]+)"/', $content, $matches);
            foreach ($matches[1] as $url) {
                $path = str_replace(asset('storage/'), '', $url);
                \Storage::disk('public')->delete($path);
            }
        });
    }

    public function getContentAttribute()
    {
        return $this->{"content_" . app()->getLocale()};
    }

    public function getTitleAttribute()
    {
        return $this->{"title_" . app()->getLocale()};
    }

    public function getSlugAttribute()
    {
        return $this->{"slug_" . app()->getLocale()};
    }

    public function images() : HasMany
    {
        return $this->hasMany(ReportImages::class, 'report_id', 'id');
    }

}
