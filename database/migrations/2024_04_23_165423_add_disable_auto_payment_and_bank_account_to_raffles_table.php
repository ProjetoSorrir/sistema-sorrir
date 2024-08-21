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
            $table->boolean('disable_auto_payment_completion')->nullable();
            $table->unsignedBigInteger('bank_account_id')->nullable();
            
            $table->foreign('bank_account_id')->references('id')->on('bank_accounts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['bank_account_id']);
            
            // Now it's safe to drop the columns
            $table->dropColumn('disable_auto_payment_completion');
            $table->dropColumn('bank_account_id');
        });
    }
};
