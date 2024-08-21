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
            // Add the 'sorted' boolean column
            $table->boolean('sorted')->after('bonus_link')->default(false);

            // Add 30 'premier_number_X' integer columns
            for ($i = 1; $i <= 30; $i++) {
                $columnName = 'premier_number_' . $i;
                $table->integer($columnName)->nullable()->after('sorted');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            // Remove the 'sorted' column
            $table->dropColumn('sorted');

            // Remove the 30 'premier_number_X' columns
            for ($i = 1; $i <= 30; $i++) {
                $columnName = 'premier_number_' . $i;
                $table->dropColumn($columnName);
            }
        });
    }
};
