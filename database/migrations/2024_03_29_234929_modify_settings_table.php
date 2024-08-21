<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            // Adicione as colunas que você deseja
            $table->string('site_name')->nullable();
            $table->string('mercado_pago_token')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();

            // Remova as colunas que não são mais necessárias
            $table->dropColumn(['key', 'value']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            // Recrie as colunas que foram removidas
            $table->string('key')->unique();
            $table->text('value');

            // Remova as colunas adicionadas
            $table->dropColumn(['site_name', 'mercado_pago_token', 'logo', 'favicon']);
        });
    }
};
