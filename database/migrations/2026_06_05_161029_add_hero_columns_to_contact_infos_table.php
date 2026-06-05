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
        Schema::table('contact_infos', function (Blueprint $table) {
            $table->string('hero_image')->after('map')->nullable();
            $table->string('hero_title_en')->after('hero_image')->nullable();
            $table->string('hero_title_esp')->after('hero_title_en')->nullable();
            $table->string('hero_subtitle_en')->after('hero_title_esp')->nullable();
            $table->string('hero_subtitle_esp')->after('hero_subtitle_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_infos', function (Blueprint $table) {
            $table->dropColumn([
                'hero_image',
                'hero_title_en',
                'hero_subtitle_en',
                'hero_title_esp',
                'hero_subtitle_esp'
            ]);
        });
    }
};
