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
        Schema::create('game_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id'); 
            $table->unsignedBigInteger('game_category_id');
            $table->string('title');
            $table->string('username');
            $table->string('password');
            $table->string('AR');
            $table->string('server');
            $table->integer('price_in');
            $table->integer('price_out');
            $table->text('note');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('game_category_id')->references('id')->on('game_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_accounts');
    }
};
