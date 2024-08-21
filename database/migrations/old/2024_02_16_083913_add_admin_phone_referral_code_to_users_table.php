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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('admin')->default(false); // Adiciona a coluna admin com padrão false
            $table->string('phone')->nullable(); // Adiciona a coluna phone que pode ser nula
            $table->string('referral_code')->unique(); // Adiciona a coluna referral_code que deve ser única
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('admin'); // Remove a coluna admin
            $table->dropColumn('phone'); // Remove a coluna phone
            $table->dropColumn('referral_code'); // Remove a coluna referral_code
        });
    }
};
