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
        Schema::create('reroll_keys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reroll_package_id');
            $table->string('key');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('reroll_package_id')->references('id')->on('reroll_packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reroll_keys');
    }
};
