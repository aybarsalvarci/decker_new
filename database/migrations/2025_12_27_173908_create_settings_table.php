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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("address");
            $table->string("phone_number");
            $table->string("email");
            $table->string("facebook");
            $table->string("twitter");
            $table->string("instagram");
            $table->string("logo");
            $table->string('favicon')->nullable();
            $table->string("site_title_en");
            $table->string("site_title_esp");

            $table->string("meta_keywords_en");
            $table->string("meta_keywords_esp");
            $table->string("meta_description_en");
            $table->string("meta_description_esp");

            $table->string("footer_desc_en");
            $table->string("footer_desc_esp");
            $table->string("footer_address");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
