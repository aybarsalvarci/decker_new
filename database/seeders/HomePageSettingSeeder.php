<?php

namespace Database\Seeders;

use App\Models\HomePage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomePageSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomePage::create([
            'topVideo' => "video top",
            'topVideoTitle_en' => "en video top",
            'topVideoTitle_esp' => "esp video top",
            'topVideoDesc_en' => "desc en",
            'topVideoDesc_esp' => "desc esp",
            'iframeVideo' => "iframe",
            'homePageAboutTitle_en' => "About Us",
            'homePageAboutTitle_esp' => "esp about",
            'homePageAboutDesc_en' => "desc en",
            'homePageAboutDesc_esp' => "desc esp"
        ]);
    }
}
