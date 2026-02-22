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
        Schema::create('about_factories', function (Blueprint $table) {
            $table->id();

            $table->string('title_en')->nullable();
            $table->string('title_esp')->nullable();

            $table->string("image1");
            $table->string("image1_title_en");
            $table->string("image1_title_esp");
            $table->string("image1_desc_en");
            $table->string("image1_desc_esp");

            $table->string("image2");
            $table->string("image2_title_en");
            $table->string("image2_title_esp");
            $table->string("image2_desc_en");
            $table->string("image2_desc_esp");

            $table->integer('order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_factories');
    }
};
