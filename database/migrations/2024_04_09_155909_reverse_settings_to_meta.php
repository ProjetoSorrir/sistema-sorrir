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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('key')->unique(); // Garante que a chave seja única
            $table->text('value');
            // Remova as colunas que não são mais necessárias
            $table->dropColumn(['site_name', 'mercado_pago_token', 'logo', 'favicon']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('site_name')->nullable();
            $table->string('mercado_pago_token')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();

            // Remova as colunas que não são mais necessárias
            $table->dropColumn(['key', 'value']);
        });
    }
};
