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
        Schema::create('free_samples', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('box_id');
            $table->string("email");
            $table->string("phone");
            $table->string("full_name");
            $table->string("state");
            $table->string("town");
            $table->string("address");
            $table->timestamps();

            $table->foreign('box_id')->references('id')->on('free_sample_boxes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_samples');
    }
};
