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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('hero_image')->nullable()->after('image');
            $table->string('hero_title_en')->nullable()->after('hero_image');
            $table->string('hero_title_esp')->nullable()->after('hero_title_en');
            $table->string('hero_subtitle_en')->nullable()->after('hero_title_esp');
            $table->string('hero_subtitle_esp')->nullable()->after('hero_subtitle_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn([
                'hero_image',
                'hero_title_en',
                'hero_title_esp',
                'hero_subtitle_en',
                'hero_subtitle_esp'
            ]);
        });
    }
};
