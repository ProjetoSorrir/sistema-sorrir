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
            $table->string('draw_hour')->nullable();
            $table->string('draw_location')->nullable(false);
            $table->text('additional_draw_info')->nullable();
            $table->date('publication_date')->nullable();
            $table->string('publication_hour')->nullable();
            $table->string('fourth_prize')->nullable();
            $table->string('fifth_prize')->nullable();
            $table->string('sixth_prize')->nullable();
            $table->string('seventh_prize')->nullable();
            $table->string('eighth_prize')->nullable();
            $table->string('ninth_prize')->nullable();
            $table->boolean('add_top_3_buyers')->nullable();
            $table->string('first_top_buyer_prize')->nullable();
            $table->string('second_top_buyer_prize')->nullable();
            $table->string('third_top_buyer_prize')->nullable();
            $table->integer('quantity_personalized_tickets')->nullable();
            $table->boolean('show_sales_percentage_bar')->nullable();
            $table->string('choice_tickets')->nullable();
            $table->boolean('show_numbers_on_payment')->nullable();
            $table->boolean('allow_affiliate')->nullable();
            $table->decimal('commission_amount', 8, 2)->nullable();
            $table->decimal('ticket_promotion_value_unit', 8, 2)->nullable();
            $table->integer('quantity_tickets_first_promotional_package')->nullable();
            $table->decimal('total_value_first_promotional_package', 8, 2)->nullable();
            $table->integer('quantity_tickets_second_promotional_package')->nullable();
            $table->decimal('total_value_second_promotional_package', 8, 2)->nullable();
            $table->integer('quantity_tickets_third_promotional_package')->nullable();
            $table->decimal('total_value_third_promotional_package', 8, 2)->nullable();
            $table->integer('quantity_tickets_fourth_promotional_package')->nullable();
            $table->decimal('total_value_fourth_promotional_package', 8, 2)->nullable();
            $table->string('winner_number_8')->nullable();
            $table->string('winner_number_9')->nullable();
            $table->enum('status', ['ativa', 'inativa', 'arquivada'])->default('ativa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            // Revertendo as alterações feitas no método up()
            $table->dropColumn([
                'draw_hour',
                'draw_location',
                'additional_draw_info',
                'publication_date',
                'publication_hour',
                'fourth_prize',
                'fifth_prize',
                'sixth_prize',
                'seventh_prize',
                'eighth_prize',
                'ninth_prize',
                'add_top_3_buyers',
                'first_top_buyer_prize',
                'second_top_buyer_prize',
                'third_top_buyer_prize',
                'quantity_personalized_tickets',
                'show_sales_percentage_bar',
                'choice_tickets',
                'show_numbers_on_payment',
                'allow_affiliate',
                'commission_amount',
                'ticket_promotion_value_unit',
                'quantity_tickets_first_promotional_package',
                'total_value_first_promotional_package',
                'quantity_tickets_second_promotional_package',
                'total_value_second_promotional_package',
                'quantity_tickets_third_promotional_package',
                'total_value_third_promotional_package',
                'quantity_tickets_fourth_promotional_package',
                'total_value_fourth_promotional_package',
                'winner_number_8',
                'winner_number_9',
                'status',
            ]);
        });
    }
};
