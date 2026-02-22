<?php

namespace Database\Seeders;

use App\Models\StaticPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaticPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StaticPage::create([
            'slug' => 'catalog',
            'file' => 'catalog.pdf'
        ]);

        StaticPage::create([
            'slug' => 'warranties',
            'content_en' => 'sfsfafddfsfdaafsdafsdasdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdf',
            'content_esp' => 'fjdfkajf jfkjfkl djfkdjf alkşdjfa djfaklş djfakldj fakldjfş',
        ]);

        StaticPage::create([
            'slug' => 'care-and-maintenance',
            'content_en' => 'sfsfafddfsfdaafsdafsdasdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdf',
            'content_esp' => 'fjdfkajf jfkjfkl djfkdjf alkşdjfa djfaklş djfakldj fakldjfş',
        ]);
    }
}

