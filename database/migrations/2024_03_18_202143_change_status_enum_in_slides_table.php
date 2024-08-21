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
            //$table->enum('status', ['ativo', 'inativo'])->default('ativo')->change();
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
            // You might need to define the original status enum values here
            // if you haven't defined them in a previous migration.
            //$table->enum('status', ['active', 'inactive'])->default('active')->change();
        });
    }
};
