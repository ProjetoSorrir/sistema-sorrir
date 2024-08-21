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
        Schema::table('invoices', function (Blueprint $table) {
            // Add refer_id as a foreign key to the users table
            $table->unsignedBigInteger('refer_id')->nullable()->after('id');
            $table->foreign('refer_id')->references('id')->on('users')->onDelete('set null');

            // Add payed_refer as a date
            $table->date('payed_refer')->nullable()->after('refer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Drop the foreign key constraint first if using certain DB engines like MySQL
            $table->dropForeign(['refer_id']);
            $table->dropColumn(['refer_id', 'payed_refer']);
        });
    }
};
