<div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-3">
            <div class="input-container">
                <label for="numberOfTickets">Quantidade de bilhetes</label>
                <select wire:model="numberOfTickets" type="text" id="numberOfTickets" name="numberOfTickets"
                    class="text-dark-grey">
                    <option value="" disabled selected hidden>Escolha uma opção</option>
                    <option value="1">25 bilhetes(00 a 24)</option>
                    <option value="2">50 bilhetes (00 a 49)</option>
                    <option value="3">100 bilhetes(00 a 99)</option>
                </select>
            </div>
        </div>

        <div class="col-span-2">
            <div class="input-container">
                <label for="price_per_number">Valor por número (R$) *</label>
                <input wire:model="price_per_number" type="text" id="price_per_number" placeholder="00,00">
                @error('price_per_number')
                    @if (empty($price_per_number))
                        <span class="text-red-500">{{ $message }}</span>
                    @endif
                @enderror
            </div>
        </div>

        <div class="col-span-3">
            <div class="flex items-center h-full pt-4">
                <input type="checkbox" class="text-primary" id="show_price_on_homepage">
                <label class="pl-2" for="show_price_on_homepage">Mostrar valor do bilhete na página inicial</label>
            </div>
        </div>

        <div class="col-span-4">
            <div class="flex items-center h-full pt-4">
                <input type="checkbox" class="text-primary" id="show_price_on_homepage">
                <label class="pl-2" for="show_price_on_homepage">Mostrar barra de percentual de vendas</label>
            </div>
        </div>

        {{-- <div class="col-span-4">
            <div class="input-container">
                <label for="sales_goal_percentage">Meta mínima de vendas (%) *</label>
                <select wire:model="sales_goal_percentage" type="text" id="sales_goal_percentage"
                    name="sales_goal_percentage" class="text-dark-grey">
                    <option value="1">30%</option>
                    <option value="1">40%</option>
                    <option value="1">50%</option>
                    <option value="1">60%</option>
                    <option value="1">70%</option>
                    <option value="1">80%</option>
                    <option value="1">90%</option>
                    <option value="1" selected>100%</option>
                </select>
            </div>
        </div> --}}

        <div class="col-span-4">
            <div class="input-container">
                <label for="pending_reservation_limit_value">Tempo para reservas (minutos)
                    *</label>
                <input wire:model="pending_reservation_limit_value" type="text" id="pending_reservation_limit_value"
                    placeholder="15">
            </div>
        </div>

        <div class="col-span-4">
            <div class="input-container">
                <label for="min_number_purchase">Limite mínimo de compras por cliente *</label>
                <input wire:model="min_number_purchase" type="text" id="min_number_purchase" placeholder="1">
            </div>
        </div>

        <div class="col-span-4">
            <div class="input-container">
                <label for="max_number_purchase">Limite máximo de compras *</label>
                <input wire:model="max_number_purchase" type="text" id="max_number_purchase" placeholder="2">
            </div>
        </div>
        <div class="col-span-2">
            <div class="input-container">
                <label for="disable_manual_number_selection">Escolha dos bilhetes</label>
                <select wire:model="disable_manual_number_selection" type="text" id="disable_manual_number_selection"
                    name="choiceTickets" class="text-dark-grey">
                    <option value="1" selected>Manual</option>
                    <option value="2">Aleatória</option>
                </select>
            </div>
        </div>

        <div class="col-span-3">
            <div class="flex items-center h-full pt-4">
                <input type="checkbox" class="text-primary" id="show_numbers_on_payment">
                <label class="pl-2" for="showNumbersOnPayment">Mostrar números somente mediante pagamento</label>
            </div>
        </div>


        <div class="col-span-4">
            <div class="flex items-center h-full pt-4">
                <input type="checkbox" class="text-primary" id="show_price_on_homepage">
                <label class="pl-2" for="show_price_on_homepage">Adicionar seção de Compra Rápida</label>
            </div>
        </div>


        {{-- Adicionar seção de compra rápida --}}
        <div class="col-span-12 flex justify-center items-center">
            <div class="line w-full border border-primary h-[1px]"></div>
            <h3 class="w-[500px] text-center font-bold text-md">Seção Compra Rápida</h3>
            <div class="line w-full border border-primary h-[1px]"></div>
        </div>

        <div class="col-span-4">
            <div class="input-container">
                <label for="auto_buy_option_one" class="block text-sm font-medium text-gray-700">
                    Quantidade (1) *
                </label>
                <input wire:model="auto_buy_option_one" type="number" id="auto_buy_option_one"
                    name="auto_buy_option_one" placeholder="10" required>
            </div>
        </div>

        <div class="col-span-4">
            <div class="input-container">
                <label for="auto_buy_option_two" class="block text-sm font-medium text-gray-700">
                    Quantidade (2) *
                </label>
                <input wire:model="auto_buy_option_two" type="number" id="auto_buy_option_two"
                    name="auto_buy_option_two" placeholder="20" required>
            </div>
        </div>

        <div class="col-span-4">
            <div class="input-container">
                <label for="auto_buy_option_two" class="block text-sm font-medium text-gray-700">
                    Quantidade (3) *
                </label>
                <input wire:model="auto_buy_option_two" type="number" id="auto_buy_option_two"
                    name="auto_buy_option_two" placeholder="30" required>
            </div>
        </div>

        {{-- Adicionar seção de compra rápida --}}

        <div class="col-span-12 flex justify-end">
            <button wire:click="save" class="primary-button">
                Salvar
            </button>
        </div>
    </div>
</div>
