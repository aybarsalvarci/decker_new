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
        Schema::create('free_sample_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title_en');
            $table->string('title_esp');
            $table->text('description_en');
            $table->text('description_esp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_sample_boxes');
    }
};
