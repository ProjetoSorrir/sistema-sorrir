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
        Schema::table('raffles', function (Blueprint $table) {
            $table->integer('auto_buy_option_four')->nullable();
            $table->integer('auto_buy_option_five')->nullable();
            $table->integer('auto_buy_option_six')->nullable();
            $table->integer('auto_buy_highlight')->nullable();
            $table->integer('quantity_premier_numbers')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            $table->dropColumn('auto_buy_option_four');
            $table->dropColumn('auto_buy_option_five');
            $table->dropColumn('auto_buy_option_six');
            $table->dropColumn('auto_buy_highlight');
            $table->dropColumn('quantity_premier_numbers');
        });
    }
};
