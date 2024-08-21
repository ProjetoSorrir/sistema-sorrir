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
            $table->index(['raffle_id', 'payment_voucher_path']);
            $table->index(['raffle_id', 'invoice_path']);
        });

        Schema::table('numbers', function (Blueprint $table) {
            $table->index(['number', 'raffle_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropIndex(['raffle_id', 'payment_voucher_path']);
            $table->dropIndex(['raffle_id', 'invoice_path']);
        });

        Schema::table('numbers', function (Blueprint $table) {
            $table->dropIndex(['number', 'raffle_id']);
        });
    }
};
