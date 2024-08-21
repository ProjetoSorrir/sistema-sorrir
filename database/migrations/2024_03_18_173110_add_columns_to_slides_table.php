<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slides', function (Blueprint $table) {
            // Adiciona a coluna 'order'
            $table->integer('order')->nullable();

            // Adiciona a coluna 'status'
            //$table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');

            // Adiciona a coluna 'image-alt'
            $table->string('image_alt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slides', function (Blueprint $table) {
            // Remove as colunas adicionadas
            $table->dropColumn('order');
            $table->dropColumn('status');
            $table->dropColumn('image_alt');
        });
    }
};
