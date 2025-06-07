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
        Schema::create('balance_recharge_bank_bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('bank');
            $table->integer('amount');
            $table->integer('balance_added')->default(0);
            $table->integer('balance_before')->default(0);
            $table->integer('balance_after')->default(0);
            $table->text('note')->nullable();
            $table->text('customer_phone')->nullable();
            $table->text('customer_name')->nullable();
            $table->text('bank_trans_id')->nullable();
            $table->text('callback_trans_id')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balance_recharge_bank_bills');
    }
};
