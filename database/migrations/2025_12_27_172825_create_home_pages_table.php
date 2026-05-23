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
        Schema::create('home_page', function (Blueprint $table) {
            $table->id();
            $table->string("topVideo");
            $table->string("topVideoTitle_en");
            $table->string("topVideoTitle_esp");
            $table->text("topVideoDesc_en");
            $table->text("topVideoDesc_esp");
            $table->text("iframeVideo");
            $table->string("homePageAboutTitle_en");
            $table->string("homePageAboutTitle_esp");
            $table->text("homePageAboutDesc_en");
            $table->text("homePageAboutDesc_esp");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_pages');
    }
};
