<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = new Setting();
        $setting->address = "Test adress";
        $setting->phone_number = "05454562112";
        $setting->email = "test@mail.com";

        $setting->facebook = "https://www.facebook.com";
        $setting->twitter = "https://www.facebook.com";
        $setting->instagram = "https://www.facebook.com";

        $setting->logo = "logo.png";
        $setting->favicon = "favicon.png";

        $setting->site_title_en = "title enm";
        $setting->site_title_esp = "title esp";

        $setting->meta_description_en = "meta description en";
        $setting->meta_description_esp = "meta description esp";
        $setting->meta_keywords_en = "meta keywords en";
        $setting->meta_keywords_esp = "meta keywords esp";

        $setting->footer_desc_en = "Leading Manufacturer of Composite Decking, Pergola, Wall Panels, and Fencing Solutions. Engineered for durability and aesthetics.";
        $setting->footer_desc_esp = "Fabricante Líder de Terrazas Compuestas, Pérgolas, Paneles de Pared y Soluciones de Esgrima. Diseñado para brindar durabilidad y estética.";
        $setting->footer_address = "Hatay, Turkey";

        $setting->save();
    }
}
