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

            // Add 30 'premier_number_award_X' integer columns
            for ($i = 1; $i <= 30; $i++) {
                $columnName = 'premier_number_award_' . $i;
                $table->text($columnName)->nullable()->after('sorted');
            }

            // Add 30 'premier_number_enabled_X' integer columns
            for ($i = 1; $i <= 30; $i++) {
                $columnNameEnabled = 'premier_number_enabled_' . $i;
                $table->boolean($columnNameEnabled)->default(false)->after('sorted');
            }

            // Add 30 'premier_number_enable_date_X' integer columns
            for ($i = 1; $i <= 30; $i++) {
                $columnNameEnabledDate = 'premier_number_enable_date_' . $i;
                $table->date($columnNameEnabledDate)->nullable()->after('sorted');
            }

            $table->boolean('show_premier_awards')->default(false);
            $table->boolean('show_winner_premier_awards')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            // Remove the 30 'premier_number_award_X' columns
            for ($i = 1; $i <= 30; $i++) {
                $columnName = 'premier_number_award_' . $i;
                $table->dropColumn($columnName);
            }

            // Remove the 30 'premier_number_enabled_X' columns
            for ($i = 1; $i <= 30; $i++) {
                $columnNameEnabled = 'premier_number_enabled_' . $i;
                $table->dropColumn($columnNameEnabled);
            }

            // Remove the 30 'premier_number_enable_date_X' columns
            for ($i = 1; $i <= 30; $i++) {
                $columnNameEnabled = 'premier_number_enable_date_' . $i;
                $table->dropColumn($columnNameEnabled);
            }

            $table->dropColumn('show_premier_awards');
            $table->dropColumn('show_winner_premier_awards');

        });
    }
};
