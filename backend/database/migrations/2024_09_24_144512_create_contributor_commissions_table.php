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
        Schema::create('contributor_commissions', function (Blueprint $table) {
            $table->id();
            $table->string('game');
            $table->integer('commission_percentage')->default(100);
            $table->unsignedBigInteger('contributor_id');
            $table->timestamps();

            $table->foreign('contributor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributor_commissions');
    }
};
