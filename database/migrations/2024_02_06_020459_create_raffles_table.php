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
        Schema::create('raffles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('winner'); // Prêmio do 1º colocado
            $table->string('first_prize')->nullable(); // Prêmio do 1º colocado
            $table->string('second_prize')->nullable(); // Prêmio do 2º colocado
            $table->string('third_prize')->nullable(); // Prêmio do 3º colocado
            $table->date('draw_date'); // Data do sorteio
            $table->boolean('show_draw_date'); // Mostrar data do sorteio
            $table->boolean('request_email_in_purchase'); // Solicitar E-mail na Compra
            $table->boolean('auto_number_selection'); // Seleção Compra Automática
            $table->integer('max_auto_numbers'); // Máximo de 500 bilhetes por clique
            $table->boolean('disable_manual_number_selection'); // Desabilitar Seleção Manual de Números
            $table->boolean('show_remaining_numbers'); // Mostrar números restantes do título
            $table->decimal('price_per_number', 8, 2); // Valor por número
            $table->boolean('show_price_on_homepage'); // Mostrar valor do bilhete na página inicial
            $table->json('promotions')->nullable(); // Promoções
            $table->integer('sales_goal_percentage')->nullable(); // Meta (mínimo em vendas)
            $table->integer('pending_reservation_limit_value'); // Limite de tempo para reservas pendentes (Valor)
            $table->string('pending_reservation_limit_time'); // Limite de tempo para reservas pendentes (Unidade de tempo)
            $table->integer('min_number_purchase'); // Limite mínimo de compras por cliente
            $table->integer('max_number_purchase'); // Limite máximo de compras por cliente
            $table->boolean('show_top_3_in_draw_page')->nullable(); // Mostrar TOP 3 na página do sorteio
            $table->integer('total_numbers'); // Quantidade de número(s)
            $table->integer('number_range_from'); // Range (De)
            $table->integer('number_range_to'); // Range (Até)
            $table->string('main_photo')->nullable();
            $table->integer('auto_buy_option_one')->nullable();
            $table->integer('auto_buy_option_two')->nullable();
            $table->integer('auto_buy_option_three')->nullable();

            $table->string('video')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('reference_code')->nullable();
            $table->string('bonus_link')->nullable();
            // Winners numbers
            $table->string('winner_number_1')->nullable();
            $table->string('winner_number_2')->nullable();
            $table->string('winner_number_3')->nullable();
            $table->string('winner_number_4')->nullable();
            $table->string('winner_number_5')->nullable();
            $table->string('winner_number_6')->nullable();
            $table->string('winner_number_7')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raffles');
    }
};