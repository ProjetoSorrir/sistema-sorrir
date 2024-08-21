<div class="card card-margins overflow-auto">
    <h2 class="card__title mb-2">Criar Ação</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-disc list-inside text-sm text-red-500">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="mt-2 w-full" x-data="{ activeTab: @entangle('activeTab') }">
        <div class="flex w-full overflow-x-auto">
            <div @click="$wire.setActiveTab('tab1')" class="tracking-wide text-base cursor-pointer py-2 px-6" :class="{
                    'text-dark-grey': activeTab !== 'tab1',
                    'font-bold text-primary border-b border-primary': activeTab === 'tab1',
                }">
                Informações Gerais
            </div>

            <div @click="$wire.setActiveTab('tab2')" class="tracking-wide text-base cursor-pointer py-2 px-6" :class="{
                    'text-dark-grey': activeTab !== 'tab2',
                    'font-bold text-primary border-b border-primary': activeTab === 'tab2',
                }">
                Premiação
            </div>

            <div @click="$wire.setActiveTab('tab3')" class="tracking-wide text-base cursor-pointer py-2 px-6" :class="{
                    'text-dark-grey': activeTab !== 'tab3',
                    'font-bold text-primary border-b border-primary': activeTab === 'tab3',
                }">
                Venda
            </div>
            <button id="saveButton" wire:click="save" wire:confirm="Você tem certeza que deseja salvar esta Ação?"
                class="primary-button ml-auto">
                Salvar
            </button>
        </div>

        <!-- Tab 1 Content -->
        <div x-show="activeTab === 'tab1'" class="mt-5 grid grid-cols-12 gap-4">
            <!-- Include the content specific to Tab 1 -->
            <div class="col-span-12">
                <div>
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12">
                            <h4 class="page-instructions">Preencha as informações gerais sobre sua ação.</h4>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-container">
                                <label for="name">Nome da Ação *</label>
                                <input wire:model="name" type="text" id="name" placeholder="Nome da Ação">
                                @error('name')
                                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-container">
                                <label for="susep_process">Processo SUSEP *</label>
                                <input wire:model="susep_process"  id="susep_process" placeholder="Processo SUSEP">
                                @error('susep_process')
                                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-container">
                                <label for="serie_size">Tamanho da Série *</label>
                                <input wire:model="serie_size" type="text" id="serie_size"
                                    placeholder="Tamanho da Série">
                                @error('serie_size')
                                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="input-container">
                                <label for="description">Descrição *</label>
                                <textarea wire:model="description" id="description" rows="5"
                                    placeholder="Descrição"></textarea>
                                @error('description')
                                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 w-[240px] min-[375px]:w-[300px] min-[425px]:w-full">
                            <p class="text-sm font-bold tracking-wide">Imagem da Ação</p>
                            <div class="flex flex-col lg:flex-row gap-4">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex-1 h-[140px]">
                                    <label for="main_photo"
                                        class="border-2 border-dashed border-secondary rounded-md flex flex-col items-center p-4 text-primary font-bold h-[140px] cursor-pointer">
                                        <svg width="24" height="24" viewBox="0 0 24 24" class="fill-primary-50"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <mask id="mask0_1571_2655" style="mask-type:alpha"
                                                maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                                                <rect width="24" height="24" />
                                            </mask>
                                            <g mask="url(#mask0_1571_2655)">
                                                <path
                                                    d="M6.5 20C4.98333 20 3.6875 19.475 2.6125 18.425C1.5375 17.375 1 16.0917 1 14.575C1 13.275 1.39167 12.1167 2.175 11.1C2.95833 10.0833 3.98333 9.43333 5.25 9.15C5.66667 7.61667 6.5 6.375 7.75 5.425C9 4.475 10.4167 4 12 4C13.95 4 15.6042 4.67917 16.9625 6.0375C18.3208 7.39583 19 9.05 19 11C20.15 11.1333 21.1042 11.6292 21.8625 12.4875C22.6208 13.3458 23 14.35 23 15.5C23 16.75 22.5625 17.8125 21.6875 18.6875C20.8125 19.5625 19.75 20 18.5 20H13C12.45 20 11.9792 19.8042 11.5875 19.4125C11.1958 19.0208 11 18.55 11 18V12.85L9.4 14.4L8 13L12 9L16 13L14.6 14.4L13 12.85V18H18.5C19.2 18 19.7917 17.7583 20.275 17.275C20.7583 16.7917 21 16.2 21 15.5C21 14.8 20.7583 14.2083 20.275 13.725C19.7917 13.2417 19.2 13 18.5 13H17V11C17 9.61667 16.5125 8.4375 15.5375 7.4625C14.5625 6.4875 13.3833 6 12 6C10.6167 6 9.4375 6.4875 8.4625 7.4625C7.4875 8.4375 7 9.61667 7 11H6.5C5.53333 11 4.70833 11.3417 4.025 12.025C3.34167 12.7083 3 13.5333 3 14.5C3 15.4667 3.34167 16.2917 4.025 16.975C4.70833 17.6583 5.53333 18 6.5 18H9V20H6.5Z" />
                                            </g>
                                        </svg>
                                        <p class="text-sm mb-1">Clique para enviar</p>
                                        <p class="text-xs">Tamanho ideal da imagem 1280x720 pixels</p>
                                        <p class="text-xs">Arquivo SVG, PNG, JPG ou GIF são aceitos.</p>
                                        <input type="file" name="main_photo" id="main_photo" wire:model="main_photo"
                                            class="opacity-0 absolute z-[-1]">
                                    </label>
                                </div>
                                @error('main_photo')
                                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            @if($main_photo)
                            <div class="flex items-center mt-2">
                                <small class="flex-1">
                                    <p class="text-dark-grey">{{ $main_photo->getClientOriginalName() }}</p>
                                </small>
                                <button wire:click="removeMainPhoto" class="text-primary ml-2 text-xs">Remover</button>
                            </div>
                            @endif
                        </div>
                        <!-- Seção da data do sorteio -->
                        <div
                            class="col-span-12 flex justify-center items-center w-[240px] min-[375px]:w-[300px] md:w-full">
                            <div class="line w-full border border-primary h-[1px]"></div>
                            <h3 class="w-[300px] text-center font-bold text-md">Sorteio</h3>
                            <div class="line w-full border border-primary h-[1px]"></div>
                        </div>
                        <div class="page-instructions col-span-12 w-[240px] min-[375px]:w-[300px] md:w-full">
                            <p class="text-wrap">Defina a data e o horário do sorteio da sua ação.</p>
                            <p class="text-wrap">O sorteio será realizado pela Loteria Federal.</p>
                            <p class="text-wrap"><strong>Atenção!</strong> As vendas desta ação serão interrompidas meia
                                hora antes
                                da data do sorteio.
                            </p>
                        </div>
                        <div class="input-container col-span-12 md:col-span-3">
                            <label for="draw_date">Data do Sorteio *</label>
                            <input wire:model="draw_date" type="date" id="draw_date" class="text-dark-grey"
                                min="{{ now()->toDateString() }}">
                            @error('draw_date')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="input-container col-span-12 md:col-span-3">
                            <label for="draw_hour">Hora do sorteio *</label>
                            <input wire:model="draw_hour" type="time" placeholder="12:00">
                            @error('draw_hour')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <!-- Seção de Publicação -->
                        <div
                            class="col-span-12 flex justify-center items-center w-[240px] min-[375px]:w-[300px] md:w-full">
                            <div class="line w-full border border-primary h-[1px]"></div>
                            <h3 class="w-[300px] text-center font-bold text-md">Publicação</h3>
                            <div class="line w-full border border-primary h-[1px]"></div>
                        </div>
                        <div class="page-instructions col-span-12 w-[240px] min-[375px]:w-[300px] md:w-full">
                            <p>Defina a data e hora para a
                                publicação da sua
                                ação. </p>
                            <p>Se esses campos não forem preenchidos, sua ação será publicada imediatamente após
                                a criação.
                            </p>
                        </div>
                        <div class="input-container col-span-12 md:col-span-4 lg:col-span-3
                                ">
                            <label for="publication_date">Data da publicação</label>
                            <input wire:model="publication_date" type="date" class="text-dark-grey"
                                min="{{ now()->toDateString() }}">
                        </div>

                        <div class="input-container col-span-12 md:col-span-4 lg:col-span-3">
                            <label for="publication_hour">Hora da publicação</label>
                            <input wire:model="publication_hour" type="time" placeholder="12:00">
                        </div>
                        <div
                            class="col-span-12 flex justify-end gap-6 w-[240px] min-[375px]:w-[300px] min-[425px]:w-full">
                            <button wire:click="incrementTab" class="primary-button w-[100px]">
                                Próximo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tab 2 Content -->
        <div x-show="activeTab === 'tab2'" class="mt-5 grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <div>
                    <p class="page-instructions">Defina os prêmios para sua ação de acordo com cada situação.
                        Você pode definir até 9 prêmios.
                    </p>
                    <div class="grid grid-cols-12 gap-4 md:gap-6 mt-2 mb-2">
                        <div class="input-container col-span-12 md:col-span-4">
                            <label for="first_prize">Prêmio 1 *</label>
                            <input wire:model="first_prize" type="text" id="first_prize" placeholder="Prêmio">
                            @error('first_prize')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="input-container col-span-12 md:col-span-4">
                            <label for="second_prize">Prêmio 2</label>
                            <input wire:model="second_prize" type="text" id="second_prize" placeholder="Prêmio">
                        </div>
                        <div class="input-container col-span-12 md:col-span-4">
                            <label for="third_prize">Prêmio 3</label>
                            <input wire:model="third_prize" type="text" id="third_prize" placeholder="Prêmio">
                        </div>
                        <div class="input-container col-span-12 md:col-span-4">
                            <label for="fourth_prize">Prêmio 4</label>
                            <input wire:model="fourth_prize" type="text" id="fourth_prize" placeholder="Prêmio">
                        </div>
                        <div class="input-container col-span-12 md:col-span-4">
                            <label for="fifth_prize">Prêmio 5</label>
                            <input wire:model="fifth_prize" type="text" id="fifth_prize" placeholder="Prêmio">
                        </div>
                        <div class="input-container col-span-12 md:col-span-4">
                            <label for="sixth_prize">Prêmio 6</label>
                            <input wire:model="sixth_prize" type="text" id="sixth_prize" placeholder="Prêmio">
                        </div>
                        <div class="input-container col-span-12 md:col-span-4">
                            <label for="seventh_prize">Prêmio 7</label>
                            <input wire:model="seventh_prize" type="text" id="seventh_prize" placeholder="Prêmio">
                        </div>
                        <div class="input-container col-span-12 md:col-span-4">
                            <label for="eighth_prize">Prêmio 8</label>
                            <input wire:model="eighth_prize" type="text" id="eighth_prize" placeholder="Prêmio">
                        </div>
                        <div class="input-container col-span-12 md:col-span-4">
                            <label for="ninth_prize">Prêmio 9</label>
                            <input wire:model="ninth_prize" type="text" id="ninth_prize" placeholder="Prêmio">
                        </div>
                    </div>
                    <!-- Seção de Top Compradores -->
                    <div class="w-[240px] min-[375px]:w-[300px] mt-6 md:w-full col-span-12">
                        <div class="top-buyers col-span-12 grid grid-cols-12 gap-6">
                            <div class="col-span-12 flex items-center">
                                <div class="line w-[70px] md:w-full border border-primary h-[1px]"></div>
                                <h3 class="w-[100px] md:w-[400px] text-center font-bold text-sm md:text-md">Top
                                    Compradores</h3>
                                <div class="line w-[70px] md:w-full border border-primary h-[1px]"></div>
                            </div>
                            {{-- <p class="page-instructions">Exiba os Top 3 compradores de títulos da ação.</p> --}}
                            <div class="col-span-12">
                                <div class="flex flex-row items-center space-x-4">
                                    <div class="flex items-center">
                                        <input type="checkbox" class="text-primary" id="add_top_3_buyers"
                                            wire:model="add_top_3_buyers">
                                        <label class="pl-2" for="add_top_3_buyers">Mostrar Top Compradores</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" class="text-primary" id="show_top_3_in_draw_page"
                                            wire:model="show_top_3_in_draw_page">
                                        <label class="pl-2" for="show_top_3_buyers">Mostrar Premiação do Top
                                            Compradores</label>
                                    </div>
                                </div>
                            </div>
                            <div x-show="$wire.show_top_3_in_draw_page === true"
                                class="input-container col-span-12 md:col-span-4">
                                <label for="first_top_buyer_prize">1º Prêmio Top Comprador *</label>
                                <input wire:model="first_top_buyer_prize" type="text" id="first_top_buyer_prize"
                                    placeholder="1º Prêmio Top Comprador">
                                @error('first_top_buyer_prize')
                                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div x-show="$wire.show_top_3_in_draw_page === true"
                                class="input-container col-span-12 md:col-span-4">
                                <label for="second_top_buyer_prize">2º Prêmio Top Comprador *</label>
                                <input wire:model="second_top_buyer_prize" type="text" id="second_top_buyer_prize"
                                    placeholder="2º Prêmio Top Comprador">
                                @error('second_top_buyer_prize')
                                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div x-show="$wire.show_top_3_in_draw_page === true"
                                class="input-container col-span-12 md:col-span-4">
                                <label for="third_top_buyer_prize">3º Prêmio Top Comprador *</label>
                                <input wire:model="third_top_buyer_prize" type="text" id="third_top_buyer_prize"
                                    placeholder="3º Prêmio Top Comprador">
                                @error('third_top_buyer_prize')
                                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 mt-6 flex justify-end gap-6">
                    <button wire:click="decrementTab" class="secondary-button">
                        Anterior
                    </button>
                    <button wire:click="incrementTab" class="primary-button">
                        Próximo
                    </button>
                </div>
            </div>
        </div>

        <!-- Tab 3 Content -->
        <div x-show="activeTab === 'tab3'" class="mt-5 grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <div>
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 w-[240px] min-[375px]:w-[300px] md:w-full">
                            <p class="page-instructions">Preencha as informações relacionadas à venda dos
                                títulos da sua ação.
                            </p>
                            <p class="page-instructions"> Aqui você pode definir a quantidade de títulos disponíveis,
                                o
                                valor por título e outras configurações importantes para o processo de venda.</p>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 min-[1440px]:col-span-4">
                            <div class="input-container">
                                <label for="quantity_personalized_tickets">Quantidade total de títulos *</label>
                                <input wire:model="quantity_personalized_tickets" type="text"
                                    id="quantity_personalized_tickets" placeholder="250">
                                @error('quantity_personalized_tickets')
                                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                            <label for="price_per_number">Valor por título (R$) *</label>
                            <input wire:model="price_per_number" type="text" id="price_per_number" placeholder="00,00">
                            @error('price_per_number')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="input-container col-span-12 md:col-span-6 min-[1440px]:col-span-4">
                            <label for="pending_reservation_limit_value">Tempo para reservas *</label>
                            <select wire:model="pending_reservation_limit_value" type="text"
                                id="pending_reservation_limit_value" name="pending_reservation_limit_value">
                                <option value="30" selected>30 minutos</option>
                            </select>
                            @error('pending_reservation_limit_value')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="input-container col-span-12 md:col-span-6 min-[1440px]:col-span-4">
                            <label for="min_number_purchase">Limite mínimo de compras por pedido *</label>
                            <input wire:model="min_number_purchase" id="min_number_purchase" placeholder="1">
                            @error('min_number_purchase')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="input-container col-span-12 md:col-span-6 min-[1440px]:col-span-4">
                            <label for="max_number_purchase">Limite máximo de compras por pedido *</label>
                            <input wire:model="max_number_purchase" id="max_number_purchase" placeholder="2">
                            <small>Máximo de 20000 bilhetes por pedido</small>
                            @error('max_number_purchase')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        {{-- Seção de compra rápida --}}
                        <div class="col-span-12">
                            <div
                                class="col-span-12 flex justify-center items-center w-[240px] min-[375px]:w-[300px] md:w-full">
                                <div class="line w-full border border-primary h-[1px]"></div>
                                <h3 class="w-[500px] text-center font-bold text-md">Seção Compra Rápida</h3>
                                <div class="line w-full border border-primary h-[1px]"></div>
                            </div>
                            <h4 class="page-instructions w-[240px] min-[375px]:w-[300px] md:w-full">
                                Adicione quantidades de números para compra rápida.
                            </h4>
                            <h4 class="page-instructions w-[240px] min-[375px]:w-[300px] md:w-full">
                                Certifique-se de inserir as quantidades desejadas para cada opção.
                            </h4>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-4 mt-4">
                        <div class="input-container col-span-12 md:col-span-4">
                            <label for="auto_buy_option_one" class="block text-sm font-medium text-gray-700">
                                Quantidade (1) *
                            </label>
                            <input wire:model="auto_buy_option_one" type="number" id="auto_buy_option_one"
                                name="auto_buy_option_one" placeholder="Digite a quantidade">
                            @error('auto_buy_option_one')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="input-container col-span-12 md:col-span-4">
                            <label for="auto_buy_option_two" class="block text-sm font-medium text-gray-700">
                                Quantidade (2) *
                            </label>
                            <input wire:model="auto_buy_option_two" type="number" id="auto_buy_option_two"
                                name="auto_buy_option_two" placeholder="Digite a quantidade">
                            @error('auto_buy_option_two')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="input-container input-container col-span-12 md:col-span-4">
                            <label for="auto_buy_option_three" class="block text-sm font-medium text-gray-700">
                                Quantidade (3) *
                            </label>
                            <input wire:model="auto_buy_option_three" type="number" id="auto_buy_option_three"
                                name="auto_buy_option_three" placeholder="Digite a quantidade">
                            @error('auto_buy_option_three')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="input-container input-container col-span-12 md:col-span-4">
                            <label for="auto_buy_option_three" class="block text-sm font-medium text-gray-700">
                                Quantidade (4) *
                            </label>
                            <input wire:model="auto_buy_option_four" type="number" id="auto_buy_option_four"
                                name="auto_buy_option_four" placeholder="Digite a quantidade">
                            @error('auto_buy_option_four')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="input-container input-container col-span-12 md:col-span-4">
                            <label for="auto_buy_option_five" class="block text-sm font-medium text-gray-700">
                                Quantidade (5) *
                            </label>
                            <input wire:model="auto_buy_option_five" type="number" id="auto_buy_option_five"
                                name="auto_buy_option_five" placeholder="Digite a quantidade">
                            @error('auto_buy_option_five')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="input-container input-container col-span-12 md:col-span-4">
                            <label for="auto_buy_option_six" class="block text-sm font-medium text-gray-700">
                                Quantidade (6) *
                            </label>
                            <input wire:model="auto_buy_option_six" type="number" id="auto_buy_option_six"
                                name="auto_buy_option_six" placeholder="Digite a quantidade">
                            @error('auto_buy_option_six')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="input-container col-span-12 md:col-span-6 min-[1440px]:col-span-4 mt-2">
                            <label for="quantity_premier_numbers">Compra Rápida em destaque *</label>
                            <select wire:model="auto_buy_highlight" type="text" id="auto_buy_highlight"
                                name="auto_buy_highlight">
                                <option value="" selected>Escolha uma opção</option>
                                <option value="1">Compra Rápida 1</option>
                                <option value="2">Compra Rápida 2</option>
                                <option value="3">Compra Rápida 3</option>
                                <option value="4">Compra Rápida 4</option>
                                <option value="5">Compra Rápida 5</option>
                                <option value="6">Compra Rápida 6</option>
                            </select>
                            @error('auto_buy_highlight')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <!-- Adicionar seção de Títulos Premiados -->
                    <div class="col-span-12 grid grid-cols-12 gap-4 mt-4">
                        <div
                            class="col-span-12 flex justify-center items-center w-[240px] min-[375px]:w-[300px] md:w-full">
                            <div class="line w-full border border-primary h-[1px]"></div>
                            <h3 class="w-[500px] text-center font-bold text-md">Títulos Premiados</h3>
                            <div class="line w-full border border-primary h-[1px]"></div>
                        </div>
                        <div class="page-instructions col-span-12">
                            <p>Adicione números premiados à sua ação.</p>
                            <p class="mt-2">
                                <strong>Atenção:</strong> Ao optar por adicionar Números Premiados à sua ação, os
                                números adicionados serão gerados de forma aleatória e não poderão ser alterados.
                            </p>
                            <p class="mt-2">Ao Editar a Ação, você poderá visualizar os Títulos Premiados e cadastrar as
                                premiações
                                correspondentes.</p>
                        </div>
                        <div class="input-container col-span-12 md:col-span-6 min-[1440px]:col-span-4 mt-2">
                            <label for="quantity_premier_numbers">Quantidade de Títulos Premiados</label>
                            <select wire:model="quantity_premier_numbers" type="text" id=""
                                name="quantity_premier_numbers">
                                <option value="" selected>Escolha uma opção</option>
                                <option value="1">1 Título Premiado</option>
                                <option value="2">2 Títulos Premiados</option>
                                <option value="3">3 Títulos Premiados</option>
                                <option value="4">4 Títulos Premiados</option>
                                <option value="5">5 Títulos Premiados</option>
                                <option value="6">6 Títulos Premiados</option>
                                <option value="7">7 Títulos Premiados</option>
                                <option value="8">8 Títulos Premiados</option>
                                <option value="9">9 Títulos Premiados</option>
                                <option value="10">10 Títulos Premiados</option>
                                <option value="11">11 Títulos Premiados</option>
                                <option value="12">12 Títulos Premiados</option>
                                <option value="13">13 Títulos Premiados</option>
                                <option value="14">14 Títulos Premiados</option>
                                <option value="15">15 Títulos Premiados</option>
                                <option value="16">16 Títulos Premiados</option>
                                <option value="17">17 Títulos Premiados</option>
                                <option value="18">18 Títulos Premiados</option>
                                <option value="19">19 Títulos Premiados</option>
                                <option value="20">20 Títulos Premiados</option>
                                <option value="21">21 Títulos Premiados</option>
                                <option value="22">22 Títulos Premiados</option>
                                <option value="23">23 Títulos Premiados</option>
                                <option value="24">24 Títulos Premiados</option>
                                <option value="25">25 Títulos Premiados</option>
                                <option value="26">26 Títulos Premiados</option>
                                <option value="27">27 Títulos Premiados</option>
                                <option value="28">28 Títulos Premiados</option>
                                <option value="29">29 Títulos Premiados</option>
                                <option value="30">30 Títulos Premiados</option>
                            </select>
                            @error('quantity_premier_numbers')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-span-12 mt-8 flex justify-end gap-6 w-[240px] min-[375px]:w-[300px] min-[425px]:w-full">
                    <button wire:click="decrementTab" class="secondary-button">
                        Anterior
                    </button>
                    <button id="saveButton" wire:click="save"
                        wire:confirm="Você tem certeza que deseja salvar esta Ação?" class="primary-button">
                        Salvar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>