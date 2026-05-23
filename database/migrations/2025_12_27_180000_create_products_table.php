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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_id");
            $table->string("name_en");
            $table->string("name_esp");
            $table->string("slug_en");
            $table->string("slug_esp");
            $table->text("description_en");
            $table->text("description_esp");
            $table->string('size')->nullable();
            $table->string('actual_size')->nullable();
            $table->string('weight')->nullable();
            $table->boolean("isPriceable")->default(true);
            $table->boolean("isSized")->default(true);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
