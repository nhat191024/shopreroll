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
        Schema::create('recharge_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_recharge_id');
            $table->string('name');
            $table->string('price');
            $table->string('description');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('game_recharge_id')->references('id')->on('game_recharges')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recharge_packages');
    }
};
