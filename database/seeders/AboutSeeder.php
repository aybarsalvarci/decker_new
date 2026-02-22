<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::updateOrCreate(
            ['id' => 1], // Kontrol şartı
            [
                /* ================= HERO SECTION ================= */
                'hero_label_en' => 'About Decker',
                'hero_label_esp' => 'Sobre Decker',

                'hero_title_en' => 'Innovating Outdoor Living Spaces',
                'hero_title_esp' => 'Innovando Espacios al Aire Libre',

                'hero_desc_en' => 'We manufacture high-quality, durable, and eco-friendly composite decking solutions for the modern world.',
                'hero_desc_esp' => 'Fabricamos soluciones de tarimas compuestas de alta calidad, duraderas y ecológicas para el mundo moderno.',

                /* ================= STORY SECTION ================= */
                'story_title_en' => 'Our Story',
                'story_title_esp' => 'Nuestra Historia',

                'story_subtitle_en' => 'Building Trust Since 1995',
                'story_subtitle_esp' => 'Construyendo Confianza Desde 1995',

                'story_content_en' => 'Decker was founded with a single mission: to replace traditional wood with a more sustainable, durable alternative. Over the decades, we have evolved from a small local factory to a global leader in composite systems. Our journey is defined by constant innovation and a commitment to excellence.',
                'story_content_esp' => 'Decker se fundó con una única misión: reemplazar la madera tradicional con una alternativa más sostenible y duradera. A lo largo de las décadas, hemos evolucionado de una pequeña fábrica local a un líder mundial en sistemas compuestos. Nuestro viaje se define por la innovación constante y el compromiso con la excelencia.',

                'story_image' => 'assets/images/about/story-bg.jpg',

                /* ================= FACTORY SECTION ================= */
                'factory_title_en' => 'Our Facilities',
                'factory_title_esp' => 'Nuestras Instalaciones',

                'factory_subtitle_en' => 'State-of-the-Art Manufacturing',
                'factory_subtitle_esp' => 'Fabricación de Última Generación',

                'factory_desc_en' => 'Located in the heart of the industrial zone, our factory utilizes the latest extrusion technology to ensure precision in every board.',
                'factory_desc_esp' => 'Ubicada en el corazón de la zona industrial, nuestra fábrica utiliza la última tecnología de extrusión para garantizar la precisión en cada tabla.',

                /* ================= STATISTICS (1-4) ================= */
                // Stat 1: Export Countries
                'stat_1_num' => '35+',
                'stat_1_text_en' => 'Countries Exported',
                'stat_1_text_esp' => 'Países Exportados',

                // Stat 2: Projects
                'stat_2_num' => '10k+',
                'stat_2_text_en' => 'Projects Completed',
                'stat_2_text_esp' => 'Proyectos Completados',

                // Stat 3: Employees
                'stat_3_num' => '250+',
                'stat_3_text_en' => 'Skilled Employees',
                'stat_3_text_esp' => 'Empleados Calificados',

                // Stat 4: Years
                'stat_4_num' => '28',
                'stat_4_text_en' => 'Years Experience',
                'stat_4_text_esp' => 'Años de Experiencia',

                /* ================= VALUES SECTION ================= */
                'values_title_en' => 'Our Core Values',
                'values_title_esp' => 'Nuestros Valores Fundamentales',

                'values_subtitle_en' => 'What Defines Us',
                'values_subtitle_esp' => 'Lo Que Nos Define',

                /* ================= VALUES ITEMS (1-3) ================= */
                // Value 1: Sustainability
                'val_1_icon' => 'fas fa-leaf', // FontAwesome class örneği
                'val_1_title_en' => 'Sustainability',
                'val_1_title_esp' => 'Sostenibilidad',
                'val_1_desc_en' => 'We are committed to using recycled materials to protect our planet.',
                'val_1_desc_esp' => 'Estamos comprometidos con el uso de materiales reciclados para proteger nuestro planeta.',

                // Value 2: Quality
                'val_2_icon' => 'fas fa-shield-alt',
                'val_2_title_en' => 'Durability',
                'val_2_title_esp' => 'Durabilidad',
                'val_2_desc_en' => 'Our products are designed to withstand the harshest weather conditions.',
                'val_2_desc_esp' => 'Nuestros productos están diseñados para soportar las condiciones climáticas más duras.',

                // Value 3: Innovation
                'val_3_icon' => 'fas fa-lightbulb',
                'val_3_title_en' => 'Innovation',
                'val_3_title_esp' => 'Innovación',
                'val_3_desc_en' => 'We constantly research new technologies to improve our composite formulas.',
                'val_3_desc_esp' => 'Investigamos constantemente nuevas tecnologías para mejorar nuestras fórmulas compuestas.',

                /* ================= VISION SECTION ================= */
                'vision_en' => 'To be the global benchmark in sustainable construction materials, inspiring a greener future for outdoor living.',
                'vision_esp' => 'Ser el referente mundial en materiales de construcción sostenibles, inspirando un futuro más verde para la vida al aire libre.',
            ]
        );
    }
}
