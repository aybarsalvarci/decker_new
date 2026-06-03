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
            $table->string('hero_title')->nullable()->after('hero_image');
            $table->string('hero_subtitle')->nullable()->after('hero_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('hero_image');
            $table->dropColumn('hero_title');
            $table->dropColumn('hero_subtitle');
        });
    }
};
