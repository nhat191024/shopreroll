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
        Schema::create('sub_reroll_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reroll_category_id');
            $table->string('name');
            $table->string('tutorial');
            $table->string('id_youtube');
            $table->string('file_download_link')->nullable();
            $table->string('image');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('reroll_category_id')->references('id')->on('reroll_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_reroll_categories');
    }
};
