<div>
    <div class="max-w-4xl mx-auto p-8">
        <form class="space-y-6" wire:submit.prevent="submit">
            @csrf
            @foreach ($errors->all() as $error)
                <small class="text-danger">
                    <li>{{ $error }}</li>
                </small>
            @endforeach

            <!-- Prizes Section -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div>
                    <!-- Name Section -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome da Rifa *</label>
                        <input wire:model="name" type="text" id="name" name="name" placeholder="Minha Rifa"
                            required
                            class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <!-- Description Section -->
                    <div class="mt-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Descrição *</label>
                        <textarea wire:model="description" id="description" name="description" rows="5" required
                            class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                    </div>
                    <div>
                        <label for="main_photo" class="block text-sm font-medium text-gray-700">Imagem Principal</label>
                        @if ($main_photo)
                            <img src="{{ $main_photo->temporaryUrl() }}">
                        @endif

                        <input type="file" wire:model="main_photo">

                        @error('main_photo')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div>
                    <label for="winner" class="block text-sm font-medium text-gray-700">Prêmio do vencedor do sorteio
                        *</label>
                    <input wire:model="winner" type="text" id="winner" name="winner" required
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="first_prize" class="block text-sm font-medium text-gray-700">Prêmio 1º Colocado compra
                        de bilhetes
                    </label>
                    <input wire:model="first_prize" type="text" id="first_prize" name="first_prize"
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="second_prize" class="block text-sm font-medium text-gray-700">Prêmio 2º Colocado compra
                        de bilhetes
                    </label>
                    <input wire:model="second_prize" type="text" id="second_prize" name="second_prize"
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="third_prize" class="block text-sm font-medium text-gray-700">Prêmio 3º Colocado compra
                        de bilhetes
                    </label>
                    <input wire:model="third_prize" type="text" id="third_prize" name="third_prize"
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Date and Display Options Section -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="draw_date" class="block text-sm font-medium text-gray-700">Data do sorteio *</label>
                    <input wire:model="draw_date" type="date" id="draw_date" name="draw_date" required
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="show_draw_date" class="block text-sm font-medium text-gray-700">Mostrar data do sorteio
                    </label>
                    <select wire:model="show_draw_date" id="show_draw_date" name="show_draw_date" required
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                </div>
                <div class="flex items-center mt-4">
                    <input wire:model="request_email_in_purchase" id="request_email_in_purchase"
                        name="request_email_in_purchase" type="checkbox"
                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    <label for="request_email_in_purchase"
                        class="ml-2 block text-sm font-medium text-gray-700">Solicitar E-mail na Compra</label>
                </div>

            </div>

            <!-- Number Purchase Section -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div>
                    <label for="auto_number_selection" class="block text-sm font-medium text-gray-700">Seção Compra
                        Automática</label>
                    <select wire:model="auto_number_selection" id="auto_number_selection" name="auto_number_selection"
                        required
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                </div>

                <!-- Auto Buy Option 1 -->
                <div class="mb-4">
                    <label for="auto_buy_option_one" class="block text-sm font-medium text-gray-700">Quantidade
                        (1) *</label>
                    <input wire:model="auto_buy_option_one" type="number" id="auto_buy_option_one"
                        name="auto_buy_option_one" placeholder="10" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                </div>

                <!-- Auto Buy Option 2 -->
                <div class="mb-4">
                    <label for="auto_buy_option_two" class="block text-sm font-medium text-gray-700">Quantidade
                        (2) *</label>
                    <input wire:model="auto_buy_option_two" type="number" id="auto_buy_option_two"
                        name="auto_buy_option_two" placeholder="20" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                </div>

                <!-- Auto Buy Option 3 -->
                <div class="mb-4">
                    <label for="auto_buy_option_three" class="block text-sm font-medium text-gray-700">Quantidade
                        (3) *</label>
                    <input wire:model="auto_buy_option_three" type="number" id="auto_buy_option_three"
                        name="auto_buy_option_three" placeholder="30" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                </div>


                <div>
                    <label for="disable_manual_number_selection"
                        class="block text-sm font-medium text-gray-700">Desabilitar Seleção Manual de Números</label>
                    <select wire:model="disable_manual_number_selection" id="disable_manual_number_selection"
                        name="disable_manual_number_selection" required
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                </div>

                <div>
                    <label for="show_remaining_numbers" class="block text-sm font-medium text-gray-700">Mostrar
                        números
                        restantes da rifa (Se a opção ACIMA estiver HABILITADA)</label>
                    <select wire:model="show_remaining_numbers" id="show_remaining_numbers"
                        name="show_remaining_numbers" required
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                </div>
            </div>

            <!-- Price Per Number Section -->
            <div>
                <label for="price_per_number" class="block text-sm font-medium text-gray-700">Valor por número (R$)
                    *</label>
                <input wire:model="price_per_number" type="text" id="price_per_number" name="price_per_number"
                    required
                    class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Show Price on Homepage -->
            <div class="flex items-center">
                <input wire:model="show_price_on_homepage" id="show_price_on_homepage" name="show_price_on_homepage"
                    type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                <label for="show_price_on_homepage" class="ml-2 block text-sm font-medium text-gray-700">Mostrar valor
                    do bilhete na página inicial *</label>
            </div>

            <!-- Promotions Section (0te: This should be dynamically generated based on your promotions logic) -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Promoções (R$)</label>
                <!-- Repeat this structure for each promotion level you have -->
                <!-- Container for all promotion inputs -->
                <div class="space-y-4">

                    <!-- Promotion Input Group -->
                    <div class="flex">
                        <!-- Value in Decimal Input -->
                        <input wire:model="promotion_value[]" type="text" name="promotion_value[]"
                            placeholder="Exemplo: 4.99"
                            class="flex-1 block w-full rounded-l-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />

                        <!-- Qtd of Numbers Input -->
                        <input wire:model="promotion_numbers[]" type="text" name="promotion_numbers[]"
                            placeholder="Quantidade"
                            class="flex-1 block w-full border-t border-b border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />

                        <span
                            class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500">
                            números
                        </span>
                    </div>

                    <div class="flex">
                        <!-- Value in Decimal Input -->
                        <input wire:model="promotion_value[]" type="text" name="promotion_value[]"
                            placeholder="Exemplo: 4.99"
                            class="flex-1 block w-full rounded-l-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />

                        <!-- Qtd of Numbers Input -->
                        <input wire:model="promotion_numbers[]" type="text" name="promotion_numbers[]"
                            placeholder="Quantidade"
                            class="flex-1 block w-full border-t border-b border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />

                        <span
                            class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500">
                            números
                        </span>
                    </div>
                    <div class="flex">
                        <!-- Value in Decimal Input -->
                        <input wire:model="promotion_value[]" type="text" name="promotion_value[]"
                            placeholder="Exemplo: 4.99"
                            class="flex-1 block w-full rounded-l-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />

                        <!-- Qtd of Numbers Input -->
                        <input wire:model="promotion_numbers[]" type="text" name="promotion_numbers[]"
                            placeholder="Quantidade"
                            class="flex-1 block w-full border-t border-b border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />

                        <span
                            class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500">
                            números
                        </span>
                    </div>
                    <div class="flex">
                        <!-- Value in Decimal Input -->
                        <input wire:model="promotion_value[]" type="text" name="promotion_value[]"
                            placeholder="Exemplo: 4.99"
                            class="flex-1 block w-full rounded-l-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />

                        <!-- Qtd of Numbers Input -->
                        <input wire:model="promotion_numbers[]" type="text" name="promotion_numbers[]"
                            placeholder="Quantidade"
                            class="flex-1 block w-full border-t border-b border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />

                        <span
                            class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500">
                            números
                        </span>
                    </div>
                    <div class="flex">
                        <!-- Value in Decimal Input -->
                        <input wire:model="promotion_value[]" type="text" name="promotion_value[]"
                            placeholder="Exemplo: 4.99"
                            class="flex-1 block w-full rounded-l-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />

                        <!-- Qtd of Numbers Input -->
                        <input wire:model="promotion_numbers[]" type="text" name="promotion_numbers[]"
                            placeholder="Quantidade"
                            class="flex-1 block w-full border-t border-b border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />

                        <span
                            class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500">
                            números
                        </span>
                    </div>

                </div>

            </div>

            <!-- Sales Goal Section -->
            <div>
                <label for="sales_goal_percentage" class="block text-sm font-medium text-gray-700">
                    Meta (mínimo em vendas) *
                </label>
                <select wire:model="sales_goal_percentage" id="sales_goal_percentage" name="sales_goal_percentage"
                    required
                    class="mt-1 block w-full border-gray-300 bg-white shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">- Selecionar -</option>
                    <option value="30">30%</option>
                    <option value="40">40%</option>
                    <option value="50">50%</option>
                    <option value="60">60%</option>
                    <option value="70">70%</option>
                    <option value="80">80%</option>
                    <option value="90">90%</option>
                    <option value="100">100%</option>
                </select>
            </div>


            <!-- Reservation Time Limit Section -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="pending_reservation_limit_value"
                        class="block text-sm font-medium text-gray-700">Limite de tempo para reservas pendentes (Valor)
                        *</label>
                    <input wire:model="pending_reservation_limit_value" type="number"
                        id="pending_reservation_limit_value" name="pending_reservation_limit_value" value="15"
                        readonly required
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="pending_reservation_limit_time" class="block text-sm font-medium text-gray-700">Limite
                        de tempo para reservas pendentes (Unidade de tempo) *</label>
                    <select wire:model="pending_reservation_limit_time" id="pending_reservation_limit_time"
                        name="pending_reservation_limit_time" required
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="minutes">Minutos</option>
                    </select>
                </div>
            </div>

            <!-- Purchase Limits Section -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="min_number_purchase" class="block text-sm font-medium text-gray-700">Limite mínimo de
                        compras por cliente *</label>
                    <input wire:model="min_number_purchase" type="number" id="min_number_purchase"
                        name="min_number_purchase" required
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="max_number_purchase" class="block text-sm font-medium text-gray-700">Limite máximo de
                        compras por cliente *</label>
                    <input wire:model="max_number_purchase" type="number" id="max_number_purchase"
                        name="max_number_purchase" required
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Number Range Section -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="number_range_from" class="block text-sm font-medium text-gray-700">Range (De)
                        *</label>
                    <input wire:model="number_range_from" type="number" id="number_range_from"
                        name="number_range_from" required
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="number_range_to" class="block text-sm font-medium text-gray-700">Range (Até) *</label>
                    <input wire:model="number_range_to" type="number" id="number_range_to" name="number_range_to"
                        required
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Show Top 3 Section -->
            <div class="flex items-center">
                <input wire:model="show_top_3_in_draw_page" id="show_top_3_in_draw_page"
                    name="show_top_3_in_draw_page" type="checkbox"
                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                <label for="show_top_3_in_draw_page" class="ml-2 block text-sm font-medium text-gray-700">Mostrar TOP
                    3 na página do sorteio *</label>
            </div>

            <!-- Total Numbers Section -->
            <div>
                <label for="total_numbers" class="block text-sm font-medium text-gray-700">Quantidade de número(s)
                    *</label>
                <input wire:model="total_numbers" type="number" id="total_numbers" name="total_numbers" required
                    class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Additional Inputs Section -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div>
                    <label for="video" class="block text-sm font-medium text-gray-700">Video Link</label>
                    <input wire:model="video" type="text" id="video" name="video"
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="state" class="block text-sm font-medium text-gray-700">Estado</label>
                    <input wire:model="state" type="text" id="state" name="state"
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700">Cidade</label>
                    <input wire:model="city" type="text" id="city" name="city"
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div>
                    <label for="reference_code" class="block text-sm font-medium text-gray-700">Código de
                        Referência</label>
                    <input wire:model="reference_code" type="text" id="reference_code" name="reference_code"
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="bonus_link" class="block text-sm font-medium text-gray-700">Link de Bônus</label>
                    <input wire:model="bonus_link" type="text" id="bonus_link" name="bonus_link"
                        class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Winner Numbers Section -->
            {{-- <div class="grid grid-cols-1 gap-6 md:grid-cols-3 mt-4">
                @for ($i = 1; $i <= 7; $i++)
                    <div>
                        <label for="winner_number_{{ $i }}"
                            class="block text-sm font-medium text-gray-700">Número do Vencedor
                            {{ $i }}</label>
                        <input wire:model="winner_number_{{ $i }}" type="text"
                            id="winner_number_{{ $i }}" name="winner_number_{{ $i }}"
                            class="mt-1 block w-full border-gray-300 shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                @endfor
            </div> --}}


            <!-- Submit Button -->
            <div class="flex justify-end">
                <button style="opacity: 1; visibility: visible;"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700">
                    Criar
                </button>
            </div>
