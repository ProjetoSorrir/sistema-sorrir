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
        Schema::create('top_buyers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('raffle_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('total_numbers');
            $table->timestamps();

            $table->foreign('raffle_id')->references('id')->on('raffles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['raffle_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_buyers');
    }
};
