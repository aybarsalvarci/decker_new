<?php

namespace Database\Seeders;

use App\Models\ContactInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactInfo::truncate();
        ContactInfo::create([
           "location" =>  "123 Decker Blvd, Suite 100
Miami, Florida 33101",
            "phone" => "+1 305 413 36 03",
            "email" => "decker@deck-er.us",
            "working_hours" => "Mon - Fri: 09:00 - 18:00
Sat - Sun: Closed",
            "map" => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114964.53925916665!2d-80.29949920266738!3d25.782390733064336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d9b0a20ec8c111%3A0xff96f271ddad4f65!2sMiami%2C%20FL%2C%20USA!5e0!3m2!1sen!2str!4v1633023222543!5m2!1sen!2str" allowfullscreen="" loading="lazy"></iframe>'
        ]);
    }
}
