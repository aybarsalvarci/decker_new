<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('hero_label_en');
            $table->string('hero_label_esp');
            $table->string('hero_title_en');
            $table->string('hero_title_esp');
            $table->string('hero_desc_en');
            $table->string('hero_desc_esp');

            $table->string('story_title_en');
            $table->string('story_title_esp');
            $table->string('story_subtitle_en');
            $table->string('story_subtitle_esp');
            $table->longText('story_content_en');
            $table->longText('story_content_esp');
            $table->string('story_image')->default("test");

            $table->string("factory_title_en");
            $table->string("factory_title_esp");

            $table->string("factory_subtitle_en");
            $table->string("factory_subtitle_esp");

            $table->string("factory_desc_en");
            $table->string("factory_desc_esp");


            for($i = 1; $i <= 4; $i++)
            {
                $table->string("stat_{$i}_num");
                $table->string("stat_{$i}_text_en");
                $table->string("stat_{$i}_text_esp");
            }


            $table->string('values_title_en');
            $table->string('values_title_esp');
            $table->string('values_subtitle_en');
            $table->string('values_subtitle_esp');

            for($i = 1; $i <= 3; $i++)
            {
                $table->string("val_{$i}_icon")->nullable();
                $table->string("val_{$i}_title_en")->nullable();
                $table->string("val_{$i}_title_esp")->nullable();
                $table->text("val_{$i}_desc_en")->nullable();
                $table->text("val_{$i}_desc_esp")->nullable();
            }

            $table->string("vision_en");
            $table->string("vision_esp");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
