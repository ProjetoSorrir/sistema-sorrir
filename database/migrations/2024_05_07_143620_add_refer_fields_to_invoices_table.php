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
        Schema::table('invoices', function (Blueprint $table) {
            
            $table->decimal('refer_percentage', 5, 2)->nullable()->after('payed_refer');
            
            $table->decimal('refer_amount', 10, 2)->nullable()->after('refer_percentage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            
            $table->dropColumn('refer_percentage');
            $table->dropColumn('refer_amount');
        });
    }
};
