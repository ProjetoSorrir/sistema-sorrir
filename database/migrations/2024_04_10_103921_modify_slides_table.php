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
        Schema::table('slides', function (Blueprint $table) {
            // Renomear a coluna image-alt para image_alt
            //$table->renameColumn('image-alt', 'image_alt');
            // Adicionar uma nova coluna image_link
            $table->string('image_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slides', function (Blueprint $table) {
            // Reverter as alterações na tabela
            //$table->renameColumn('image_alt', 'image-alt');
            $table->dropColumn('image_link');
        });
    }
};
