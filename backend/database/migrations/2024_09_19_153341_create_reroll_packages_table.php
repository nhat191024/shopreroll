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
        Schema::create('reroll_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reroll_sub_category_id');
            $table->string('name');
            $table->integer('price');
            $table->timestamps();

            $table->foreign('reroll_sub_category_id')->references('id')->on('reroll_sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reroll_packages');
    }
};
