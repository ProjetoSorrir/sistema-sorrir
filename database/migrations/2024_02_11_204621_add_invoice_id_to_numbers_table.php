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
        Schema::table('numbers', function (Blueprint $table) {
            $table->foreignId('invoice_id')->nullable()->constrained('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('numbers', function (Blueprint $table) {
            $table->dropForeign(['invoice_id']); // This drops the foreign key constraint
            $table->dropColumn('invoice_id');
        });
    }
};
