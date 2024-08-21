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
        Schema::table('numbers', function (Blueprint $table) {
            $table->index(['raffle_id', 'reserved_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('numbers', function (Blueprint $table) {
            $table->dropIndex(['raffle_id', 'reserved_at']);
        });
    }
};
