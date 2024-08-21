<div class="card card-margins overflow-auto">
    <h2 class="card__title mb-2">Editar Ação</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-disc list-inside text-sm text-red-500">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            <span style="color: red;"> {{ session('error') }} </span>
        </div>
    @endif

    <div class="mt-2" x-data="{ activeTab: @entangle('activeTab') }">
        <div class="flex w-full overflow-x-auto">
            <div @click="$wire.setActiveTab('tab1')" class="tracking-wide text-base cursor-pointer py-2 px-6"
                :class="{
                    'text-dark-grey': activeTab !== 'tab1',
                    'font-bold text-primary border-b border-primary': activeTab === 'tab1',
                }">
                Informações Gerais
            </div>

            <div @click="$wire.setActiveTab('tab2')" class="tracking-wide text-base cursor-pointer py-2 px-6"
                :class="{
                    'text-dark-grey': activeTab !== 'tab2',
                    'font-bold text-primary border-b border-primary': activeTab === 'tab2',
                }">
                Premiação
            </div>

            <div @click="$wire.setActiveTab('tab3')" class="tracking-wide text-base cursor-pointer py-2 px-6"
                :class="{
                    'text-dark-grey': activeTab !== 'tab3',
                    'font-bold text-primary border-b border-primary': activeTab === 'tab3',
                }">
                Venda
            </div>

            <div @click="$wire.setActiveTab('tab4')" class="tracking-wide text-base cursor-pointer py-2 px-6"
                :class="{
                    'text-dark-grey': activeTab !== 'tab4',
                    'font-bold text-primary border-b border-primary': activeTab === 'tab4',
                }">
                Números Premiados
            </div>

            <div @click="$wire.setActiveTab('tab5')" class="tracking-wide text-base cursor-pointer py-2 px-6"
                :class="{
                    'text-dark-grey': activeTab !== 'tab5',
                    'font-bold text-primary border-b border-primary': activeTab === 'tab5',
                }">
                Resultados
            </div>
            <button id="updateButton" wire:click="update" wire:confirm="Você tem certeza que deseja atualizar esta Ação?"
                class="primary-button ml-auto">
                Atualizar
            </button>
        </div>

        <!-- Tab 1 Content -->
        <div x-show="activeTab === 'tab1'" class="mt-5 grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <h4 class="page-instructions">Preencha as informações gerais sobre sua Ação.</h4>
            </div>

            <div class="input-container col-span-12 md:col-span-6">
                <label for="name">Nome da Ação *</label>
                <input wire:model="name" type="text" id="name" placeholder="Nome da Ação">
                @error('name')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>
            <div class="input-container col-span-12 md:col-span-6">
                <label for="status">Status da Ação</label>
                <select wire:model="status" id="status" name="status" class="text-dark-grey">
                    <option value="ativa" selected>Ativa</option>
                    <option value="inativa">Inativa</option>
                </select>
            </div>
            <div class="col-span-12 md:col-span-6">
                <div class="input-container">
                    <label for="susep_process">Processo SUSEP *</label>
                    <input class="@if($susep_process) bg-gray-200 text-gray-400 cursor-not-allowed @endif" wire:model="susep_process" type="text" id="susep_process" placeholder="Processo SUSEP">
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
                    <input class="@if($serie_size) bg-gray-200 text-gray-400 cursor-not-allowed @endif" wire:model="serie_size" wire:model="serie_size" type="text" id="serie_size"
                        placeholder="Tamanho da Série">
                    @error('serie_size')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                    @enderror
                </div>
            </div>
            <div class="input-container col-span-12 md:col-span-6">
                <label for="description">Descrição *</label>
                <textarea wire:model="description" id="description" rows="5" placeholder="Descrição"></textarea>
                @error('description')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>

            <div class="col-span-12 md:col-span-6 w-[240px] min-[375px]:w-[300px] min-[425px]:w-full">
                <!-- Imagem da Ação -->
                <p class="text-sm font-bold tracking-wide mb-2">Imagem da Ação</p>
                <div class="flex flex-col lg:flex-row gap-4">
                    @if ($current_photo)
                        <div class="">
                            <div class="flex items-center">
                                <img src="{{ asset($current_photo) }}" alt="current_foto"
                                    class="w-[240px] min-[375px]:w-[300px] min-[425px]:w-[full] h-[140px] object-cover">
                            </div>
                        </div>
                        <button type="button" class="text-primary text-xs " wire:click="removeCurrentPhoto"
                            wire:confirm="Você tem certeza de que deseja excluir a Imagem Atual da Ação?"
                            class="ml-2 text-red-500">Excluir
                        </button>
                    @else
                    <div class="col-span-12 md:col-span-6 w-[240px] min-[375px]:w-[300px] min-[425px]:w-full">
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
                    @endif
                </div>
            </div>

            <div class="col-span-12 flex justify-center items-center w-[240px] min-[375px]:w-[300px] md:w-full">
                <div class="line w-full border border-primary h-[1px]"></div>
                <h3 class="w-[300px] text-center font-bold text-md">Sorteio</h3>
                <div class="line w-full border border-primary h-[1px]"></div>
            </div>

            <div class="page-instructions col-span-12">Defina a data e o horário do sorteio da sua Ação.
                <p class="text-wrap">O sorteio será realizado pela Loteria Federal.</p>
                <p class="text-wrap"> Atenção! As vendas desta ação serão interrompidas meia hora antes da data do sorteio.
                </p>
            </div>

            <div class="input-container col-span-12 md:col-span-3">
                <label for="draw_date">Data do Sorteio *</label>
                <input wire:model="draw_date" type="date" id="draw_date" class="text-dark-grey" min="{{ now()->toDateString() }}">
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
            <div class="col-span-12 flex justify-center items-center w-[240px] min-[375px]:w-[300px] md:w-full">
                <div class="line w-full border border-primary h-[1px]"></div>
                <h3 class="w-[300px] text-center font-bold text-md">Publicação</h3>
                <div class="line w-full border border-primary h-[1px]"></div>
            </div>

            <div class="page-instructions col-span-12 w-[240px] min-[375px]:w-[300px] md:w-full">
                <p>Defina a data e hora para a
                    publicação da sua
                    ação. </p>
                <p>Se esses campos não forem preenchidos, sua ação será publicada imediatamente após
                    a atualização.
                </p>
            </div>
            <div class="input-container col-span-12 md:col-span-4 lg:col-span-3">
                <label for="publication_date">Data da publicação</label>
                <input wire:model="publication_date" type="date" class="text-dark-grey" min="{{ now()->toDateString() }}">
            </div>
            <div class="input-container col-span-12 md:col-span-4 lg:col-span-3">
                <label for="publication_hour">Hora da publicação</label>
                <input wire:model="publication_hour" type="time" placeholder="12:00">
            </div>
            <div class="col-span-12 flex justify-end gap-6 w-[240px] min-[375px]:w-[300px] min-[425px]:w-full">
                <button wire:click="incrementTab" class="primary-button">
                    Próximo
                </button>
            </div>
        </div>

        <!-- Tab 2 Content -->
        <div x-show="activeTab === 'tab2'" class="mt-5 grid grid-cols-12 gap-6">
            <div class="col-span-12">
                <h4 class="page-instructions">Defina os prêmios para sua Ação de acordo com cada situação.
                    Você pode definir até 9 prêmios.
                </h4>
            </div>

            <div class="col-span-12 grid grid-cols-12 gap-4">

                <div class="input-container col-span-12 md:col-span-4">
                    <label for="first_prize">Prêmio 1 *</label>
                    <input wire:model="first_prize" type="text" id="first_prize" placeholder="Primeiro Prêmio" class="@if($winner_number_1) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($winner_number_1) disabled @endif>
                    @if(isset($winners_from_raffle_numbers['winner_number_1']) && is_array($winners_from_raffle_numbers['winner_number_1']))
                        <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_1']['name'] }}</p>
                        <p>
                            📧 <strong>Email:</strong>
                            <span class="email-visible" >{{ substr($winners_from_raffle_numbers['winner_number_1']['email'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_1']['email']) - 4) }}</span>
                            <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_1']['email'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('email')">👁️</button>
                        </p>
                        <p>
                            📞 <strong>Telefone:</strong>
                            <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_1']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_1']['phone']) - 4) }}</span>
                            <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_1']['phone'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('phone')">👁️</button>
                        </p>
                    @endif
                    @error('first_prize')
                        <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                    @enderror
                </div>

                <div class="input-container col-span-12 md:col-span-4">
                    <label for="second_prize">Prêmio 2</label>
                    <input wire:model="second_prize" type="text" id="second_prize" placeholder="Segundo Prêmio" class="@if($winner_number_2) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($winner_number_2) disabled @endif>
                    @if(isset($winners_from_raffle_numbers['winner_number_2']) && is_array($winners_from_raffle_numbers['winner_number_2']))
                        <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_2']['name'] }}</p>
                        <p>
                            📧 <strong>Email:</strong>
                            <span class="email-visible" >{{ substr($winners_from_raffle_numbers['winner_number_2']['email'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_2']['email']) - 4) }}</span>
                            <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_2']['email'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('email')">👁️</button>
                        </p>
                        <p>
                            📞 <strong>Telefone:</strong>
                            <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_2']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_2']['phone']) - 4) }}</span>
                            <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_2']['phone'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('phone')">👁️</button>
                        </p>
                    @endif
                </div>

                <div class="input-container col-span-12 md:col-span-4">
                    <label for="third_prize">Prêmio 3</label>
                    <input wire:model="third_prize" type="text" id="third_prize" placeholder="Terceiro Prêmio" class="@if($winner_number_3) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($winner_number_3) disabled @endif>
                    @if(isset($winners_from_raffle_numbers['winner_number_3']))
                        <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_3']['name'] }}</p>
                        <p>
                            📧 <strong>Email:</strong>
                            <span class="email-visible" >{{ substr($winners_from_raffle_numbers['winner_number_3']['email'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_3']['email']) - 4) }}</span>
                            <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_3']['email'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('email')">👁️</button>
                        </p>
                        <p>
                            📞 <strong>Telefone:</strong>
                            <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_3']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_3']['phone']) - 4) }}</span>
                            <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_3']['phone'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('phone')">👁️</button>
                        </p>
                    @endif
                </div>

                <div class="input-container col-span-12 md:col-span-4">
                    <label for="fourth_prize">Prêmio 4</label>
                    <input wire:model="fourth_prize" type="text" id="fourth_prize" placeholder="Quarto Prêmio" class="@if($winner_number_4) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($winner_number_4) disabled @endif>
                    @if(isset($winners_from_raffle_numbers['winner_number_4']))
                        <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_4']['name'] }}</p>
                        <p>
                            📧 <strong>Email:</strong>
                            <span class="email-visible" >{{ substr($winners_from_raffle_numbers['winner_number_4']['email'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_4']['email']) - 4) }}</span>
                            <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_4']['email'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('email')">👁️</button>
                        </p>
                        <p>
                            📞 <strong>Telefone:</strong>
                            <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_4']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_4']['phone']) - 4) }}</span>
                            <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_4']['phone'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('phone')">👁️</button>
                        </p>
                    @endif
                </div>

                <div class="input-container col-span-12 md:col-span-4">
                    <label for="fifth_prize">Prêmio 5</label>
                    <input wire:model="fifth_prize" type="text" id="fifth_prize" placeholder="Quinto Prêmio" class="@if($winner_number_5) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($winner_number_5) disabled @endif>
                    @if(isset($winners_from_raffle_numbers['winner_number_5']))
                        <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_5']['name'] }}</p>
                        <p>
                            📧 <strong>Email:</strong>
                            <span class="email-visible" >{{ substr($winners_from_raffle_numbers['winner_number_5']['email'], 0, 5) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_5']['email']) - 4) }}</span>
                            <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_5']['email'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('email')">👁️</button>
                        </p>
                        <p>
                            📞 <strong>Telefone:</strong>
                            <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_5']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_5']['phone']) - 4) }}</span>
                            <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_5']['phone'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('phone')">👁️</button>
                        </p>
                    @endif
                </div>

                <div class="input-container col-span-12 md:col-span-4">
                    <label for="sixth_prize">Prêmio 6</label>
                    <input wire:model="sixth_prize" type="text" id="sixth_prize" placeholder="Sexto Prêmio" class="@if($winner_number_6) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($winner_number_6) disabled @endif>
                    @if(isset($winners_from_raffle_numbers['winner_number_6']))
                        <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_6']['name'] }}</p>
                        <p>
                            📧 <strong>Email:</strong>
                            <span class="email-visible" >{{ substr($winners_from_raffle_numbers['winner_number_6']['email'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_6']['email']) - 4) }}</span>
                            <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_6']['email'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('email')">👁️</button>
                        </p>
                        <p>
                            📞 <strong>Telefone:</strong>
                            <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_6']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_6']['phone']) - 4) }}</span>
                            <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_6']['phone'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('phone')">👁️</button>
                        </p>
                    @endif
                </div>

                <div class="input-container col-span-12 md:col-span-4">
                    <label for="seventh_prize">Prêmio 7</label>
                    <input wire:model="seventh_prize" type="text" id="seventh_prize" placeholder="Sétimo Prêmio" class="@if($winner_number_7) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($winner_number_7) disabled @endif>
                    @if(isset($winners_from_raffle_numbers['winner_number_7']))
                        <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_7']['name'] }}</p>
                        <p>
                            📧 <strong>Email:</strong>
                            <span class="email-visible" >{{ substr($winners_from_raffle_numbers['winner_number_7']['email'], 0, 5) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_7']['email']) - 4) }}</span>
                            <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_6']['email'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('email')">👁️</button>
                        </p>
                        <p>
                            📞 <strong>Telefone:</strong>
                            <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_7']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_7']['phone']) - 4) }}</span>
                            <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_7']['phone'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('phone')">👁️</button>
                        </p>
                    @endif
                </div>
                <div class="input-container col-span-12 md:col-span-4">
                    <label for="eighth_prize">Prêmio 8</label>
                    <input wire:model="eighth_prize" type="text" id="eighth_prize" placeholder="Oitavo Prêmio" class="@if($winner_number_8) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($winner_number_8) disabled @endif>
                    @if(isset($winners_from_raffle_numbers['winner_number_8']))
                        <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_8']['name'] }}</p>
                        <p>
                            📧 <strong>Email:</strong>
                            <span class="email-visible" >{{ substr($winners_from_raffle_numbers['winner_number_8']['email'], 0, 5) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_8']['email']) - 4) }}</span>
                            <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_8']['email'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('email')">👁️</button>
                        </p>
                        <p>
                            📞 <strong>Telefone:</strong>
                            <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_8']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_8']['phone']) - 4) }}</span>
                            <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_8']['phone'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('phone')">👁️</button>
                        </p>
                    @endif
                </div>
                <div class="input-container col-span-12 md:col-span-4">
                    <label for="ninth_prize">Prêmio 9</label>
                    <input wire:model="ninth_prize" type="text" id="ninth_prize" placeholder="Nono Prêmio" class="@if($winner_number_9) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($winner_number_9) disabled @endif>
                    @if(isset($winners_from_raffle_numbers['winner_number_9']))
                        <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_9']['name'] }}</p>
                        <p>
                            📧 <strong>Email:</strong>
                            <span class="email-visible" >{{ substr($winners_from_raffle_numbers['winner_number_9']['email'], 0, 5) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_9']['email']) - 4) }}</span>
                            <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_9']['email'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('email')">👁️</button>
                        </p>
                        <p>
                            📞 <strong>Telefone:</strong>
                            <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_9']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_9']['phone']) - 4) }}</span>
                            <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_9']['phone'] }}</span>
                            <button class="toggle-btn" onclick="toggleVisibility('phone')">👁️</button>
                        </p>
                    @endif
                </div>
            </div>

            <div class="w-[240px] min-[375px]:w-full mt-4  col-span-12">
                <div class="top-buyers col-span-12 grid grid-cols-12 gap-6">
                    <div class="col-span-12 flex items-center">
                        <div class="line  w-full border border-primary h-[1px]"></div>
                        <h3 class="w-[100px] md:w-[400px] text-center font-bold text-sm md:text-md">Top
                            Compradores</h3>
                        <div class="line w-full border border-primary h-[1px]"></div>
                    </div>

                    <div class="col-span-12">
                        <div class="flex items-center h-full">
                            <input type="checkbox" class="text-primary" id="add_top_3_buyers"
                                wire:model="add_top_3_buyers" x-bind:checked="Boolean(@json($add_top_3_buyers))">
                            <label class="pl-2" for="add_top_3_buyers">Adicionar Top Compradores</label>
                        </div>
                    </div>

                    <div class="input-container col-span-12 md:col-span-4">
                        <label for="first_top_buyer_prize">1º Top Comprador *</label>
                        <input wire:model="first_top_buyer_prize" type="text" id="first_top_buyer_prize"
                            placeholder="Prêmio">
                        @error('first_top_buyer_prize')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                        @enderror
                    </div>

                    <div class="input-container col-span-12 md:col-span-4">
                        <label for="second_top_buyer_prize">2º Top Comprador *</label>
                        <input wire:model="second_top_buyer_prize" type="text" id="second_top_buyer_prize"
                            placeholder="Prêmio">
                        @error('second_top_buyer_prize')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                        @enderror
                    </div>

                    <div class="input-container col-span-12 md:col-span-4">
                        <label for="third_top_buyer_prize">3º Top Comprador *</label>
                        <input wire:model="third_top_buyer_prize" type="text" id="third_top_buyer_prize"
                            placeholder="Prêmio">
                        @error('third_top_buyer_prize')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                        @enderror
                    </div>

                    <div class="col-span-12 mb-2">
                        <div class="flex items-center h-full pt-4">
                            <input type="checkbox" class="text-primary" id="show_top_3_in_draw_page"
                                wire:model="show_top_3_in_draw_page"
                                x-bind:checked="Boolean(@json($show_top_3_in_draw_page))">
                            <label class="pl-2" for="show_top_3_buyers">Mostrar Premiação do Top Compradores
                                no
                                Site</label>
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
        </div>

        <!-- Tab 3 Content -->
        <div x-show="activeTab === 'tab3'" class="mt-5 grid grid-cols-12 gap-4">
            <div class="page-instructions col-span-12">
                <p class="page-instructions">Preencha as informações relacionadas à venda dos
                    títulos da sua ação.
                </p>
                <p class="page-instructions"> Aqui você pode definir a quantidade de títulos disponíveis,
                    o
                    valor por título e outras configurações importantes para o processo de venda.</p>
            </div>
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                <label for="total_numbers">Atualizar Quantidade Total de Títulos</label>
                <input wire:model="quantity_personalized_tickets" type="text" id="total_numbers">
                <small>Sua Ação atualmente tem o total de {{ $total_numbers_to_update }} títulos.
                </small>
                @error('quantity_personalized_tickets')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                <label for="price_per_number">Valor por Título (R$) *</label>
                <input wire:model="price_per_number" type="text" id="price_per_number" placeholder="00,00">
                @error('price_per_number')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                <div class="input-container ">
                    <label for="pending_reservation_limit_value">Tempo para reservas *</label>
                    <select wire:model="pending_reservation_limit_value" type="text"
                        id="pending_reservation_limit_value" name="pending_reservation_limit_value">
                        <option value="30">30 minutos</option>
                    </select>
                    @error('pending_reservation_limit_value')
                        <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                    @enderror
                </div>
            </div>
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                <label for="min_number_purchase">Limite mínimo de compras por pedido *</label>
                <input wire:model="min_number_purchase" id="min_number_purchase" placeholder="1">
                @error('min_number_purchase')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                <label for="max_number_purchase">Limite máximo de compras por pedido *</label>
                <input wire:model="max_number_purchase" id="max_number_purchase" placeholder="2">
                <small>Máximo de 20000 títulos por compra</small>
                @error('max_number_purchase')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>
            {{-- Adicionar seção de compra rápida --}}
            <div class="col-span-12 flex justify-center items-center w-[240px] min-[375px]:w-[300px] md:w-full">
                <div class="line w-full border border-primary h-[1px]"></div>
                <h3 class="w-[500px] text-center font-bold text-md">Seção Compra Rápida</h3>
                <div class="line w-full border border-primary h-[1px]"></div>
            </div>
            <div class="page-instructions col-span-12 w-[240px] min-[375px]:w-[300px] md:w-full">
                Adicione quantidades de números para compra rápida.
                <p class="mt-2">Certifique-se de inserir as quantidades desejadas para cada opção.</p>
            </div>
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
            <div class="input-container col-span-12 md:col-span-4">
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
            <div class="input-container col-span-12 md:col-span-4">
                <label for="auto_buy_option_four" class="block text-sm font-medium text-gray-700">
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
            <div class="input-container col-span-12 md:col-span-4">
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
            <div class="input-container col-span-12 md:col-span-4">
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
            <div class="col-span-12 mt-6 flex justify-end gap-6">
                <button wire:click="decrementTab" class="secondary-button">
                    Anterior
                </button>
                <button wire:click="incrementTab" class="primary-button">
                    Próximo
                </button>
            </div>
        </div>
        <!-- Títulos Premiados -->
        <div x-show="activeTab === 'tab4'" class="">
            <div class="mt-5 grid grid-cols-12 gap-1">
                <div class="page-instructions col-span-12">
                    <p>Adicione os prêmios dos Títulos Premiados da sua Ação.</p>
                    <p class="mt-2">
                        <strong>Atenção:</strong> Após serem salvos na criação da Ação, os números premiados não poderão ser alterados.
                    </p>
                    <button wire:click="generatePremierNumbersReportPDF" class="primary-button mt-4 ml-auto">
                        Gerar Relatório dos Títulos Premiados
                    </button>
                </div>
                <div class="col-span-12">
                    @for ($i = 1; $i <= 30; $i++)
                        <div class="grid grid-cols-12 gap-4 my-4">
                            <div x-show="$wire.premier_number_{{$i}} !== null" class="input-container col-span-12 md:col-span-3 mt-8 md:mt-0">
                                <label for="Número Premiado  {{ $i }}"> Título Premiado
                                    {{ $i }}</label>
                                    <input type="text" wire:model="premier_number_{{ $i }}"
                                    placeholder="Número Premiado {{ $i }}"
                                    class="@if($disableWinnerPremierNumbers[$i]) bg-gray-200 text-gray-400 cursor-not-allowed @endif"
                                    @if($disableWinnerPremierNumbers[$i]) disabled @endif>
                                
                                <!-- Display the buyer's name if available -->
                                @if (!empty($winners_from_premier_numbers["premier_number_$i"]))
                                    <p><strong>🏅 Comprado por:</strong> {{ $winners_from_premier_numbers["premier_number_$i"]['name'] }}</p>
                                    <p>
                                        <strong>📧 Email:</strong>
                                        <span class="email-visible-{{ $i }}">{{ substr($winners_from_premier_numbers["premier_number_$i"]['email'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_premier_numbers["premier_number_$i"]['email']) - 4) }}</span>
                                        <span class="email-hidden-{{ $i }}" style="display: none;">{{ $winners_from_premier_numbers["premier_number_$i"]['email'] }}</span>
                                        <button class="toggle-btn" onclick="toggleVisibility('email', {{ $i }})">👁️</button>
                                    </p>
                                    <p>
                                        <strong>📞 Telefone:</strong>
                                        <span class="phone-visible-{{ $i }}">{{ substr($winners_from_premier_numbers["premier_number_$i"]['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_premier_numbers["premier_number_$i"]['phone']) - 4) }}</span>
                                        <span class="phone-hidden-{{ $i }}" style="display: none;">{{ $winners_from_premier_numbers["premier_number_$i"]['phone'] }}</span>
                                        <button class="toggle-btn" onclick="toggleVisibility('phone', {{ $i }})">👁️</button>
                                    </p>
                                @endif
                                @error('premier_number_' . $i)
                                    <div class="text-red-500 text-sm mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- input prêmio  --}}
                            <div x-show="$wire.premier_number_{{$i}} !== null" class="input-container col-span-12 md:col-span-4">
                                <label for="premier_number_award_{{ $i }}"> Prêmio Título Premiado
                                    {{ $i }}</label>
                                <input type="text" wire:model="premier_number_award_{{ $i }}"
                                    placeholder="Descrição do Prêmio"
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('premier_number_award_' . $i)
                                    <div class="text-red-500 text-sm mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    @endfor
                    <div class="col-span-12 mt-4">
                        <div class="flex items-center">
                            <input type="checkbox" class="text-primary" wire:model="show_premier_awards"
                                @if ($show_premier_awards) checked @endif>
                            <label class="pl-2">Mostrar Premiação dos Títulos Premiados na Ação</label>
                        </div>
                    </div>
                    <div class="col-span-12 mt-4">
                        <div class="flex items-center">
                            <input type="checkbox" class="text-primary" wire:model="show_winner_premier_awards"
                                @if ($show_winner_premier_awards) checked @endif>
                            <label class="pl-2">Mostrar Ganhador do Número Premiado na Ação</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 flex justify-end gap-6 mt-4">
                <button wire:click="decrementTab" class="secondary-button">
                    Anterior
                </button>
                <button wire:click="incrementTab" class="primary-button">
                    Próximo
                </button>
            </div>
        </div>

        {{-- Tab 5 Content --}}
        <div x-show="activeTab === 'tab5'" class="mt-5 grid grid-cols-12 gap-4">
        
            <div class="col-span-12">
                <div class="page-instructions">
                    Forneça as informações relacionadas ao Resultado da sua Ação.
                    <p class="mt-2">Informe os Números Sorteados para a Ação.</p>
                    <p class="mt-2">
                        <strong>Observação:</strong> Depois de salvos, os resultados da Ação não poderão ser modificados.
                    </p>
                </div>
            </div>
            <form wire:submit.prevent="searchWinners" class="grid grid-cols gap-4 col-span-6 text-left">
            <div x-show="$wire.first_number !== null && $wire.first_number !== ''" class="input-container">
                <label for="winner_number_1">1º Número</label>
                <input wire:model="winner_number_1" type="text" id="winner_number_1" placeholder="00" class="@if($disabledWinnerNumbers[1]) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($disabledWinnerNumbers[1]) disabled @endif>
                @if(isset($winners_from_raffle_numbers['winner_number_1']) && is_array($winners_from_raffle_numbers['winner_number_1']))
                <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_1']['name'] }}</p>
                <p>
                    📧 <strong>Email:</strong>
                    <span class="email-visible">{{ substr($winners_from_raffle_numbers['winner_number_1']['email'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_1']['email']) - 4) }}</span>
                    <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_1']['email'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('email')">👁️</button>
                </p>
                <p>
                    📞 <strong>Telefone:</strong>
                    <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_1']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_1']['phone']) - 4) }}</span>
                    <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_1']['phone'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('phone')">👁️</button>
                </p>
                @endif
                @error('winner_number_1')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>
            <div x-show="$wire.second_prize !== null && $wire.second_prize !== ''" class="input-container">
                <label for="winner_number_2">2º Número</label>
                <input wire:model="winner_number_2" type="text" id="winner_number_2" placeholder="00" class="@if($disabledWinnerNumbers[2]) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($disabledWinnerNumbers[2]) disabled @endif>
                @if(isset($winners_from_raffle_numbers['winner_number_2']) && is_array($winners_from_raffle_numbers['winner_number_2']))
                <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_2']['name'] }}</p>
                <p>
                    📧 <strong>Email:</strong>
                    <span class="email-visible">{{ substr($winners_from_raffle_numbers['winner_number_2']['email'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_2']['email']) - 4) }}</span>
                    <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_2']['email'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('email')">👁️</button>
                </p>
                <p>
                    📞 <strong>Telefone:</strong>
                    <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_2']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_2']['phone']) - 4) }}</span>
                    <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_2']['phone'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('phone')">👁️</button>
                </p>
                @endif
                @error('winner_number_2')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>
            <div class="input-container" x-show="$wire.third_prize !== null && $wire.third_prize !== ''">
                <label for="winner_number_3">3º Número</label>
                <input wire:model="winner_number_3" type="text" id="winner_number_3" placeholder="00" class="@if($disabledWinnerNumbers[3]) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($disabledWinnerNumbers[3]) disabled @endif>
                @if(isset($winners_from_raffle_numbers['winner_number_3']) && is_array($winners_from_raffle_numbers['winner_number_3']))
                <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_3']['name'] }}</p>
                <p>
                    📧 <strong>Email:</strong>
                    <span class="email-visible">{{ substr($winners_from_raffle_numbers['winner_number_3']['email'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_3']['email']) - 4) }}</span>
                    <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_3']['email'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('email')">👁️</button>
                </p>
                <p>
                    📞 <strong>Telefone:</strong>
                    <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_3']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_3']['phone']) - 4) }}</span>
                    <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_3']['phone'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('phone')">👁️</button>
                </p>
                @endif
                @error('winner_number_3')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>
            <div class="input-container" x-show="$wire.fourth_prize !== null && $wire.fourth_prize !== ''">
                <label for="winner_number_4">4º Número</label>
                <input wire:model="winner_number_4" type="text" id="winner_number_4" placeholder="00" class="@if($disabledWinnerNumbers[4]) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($disabledWinnerNumbers[4]) disabled @endif>
                @if(isset($winners_from_raffle_numbers['winner_number_4']) && is_array($winners_from_raffle_numbers['winner_number_4']))
                <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_4']['name'] }}</p>
                <p>📧 <strong>Email:</strong> 
                    <span class="email-visible">{{ substr($winners_from_raffle_numbers['winner_number_4']['email'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_4']['email']) - 4) }}</span>
                    <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_4']['email'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('email')">👁️</button>
                </p>
                <p>📞 <strong>Telefone:</strong> 
                    <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_4']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_4']['phone']) - 4) }}</span>
                    <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_4']['phone'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('phone')">👁️</button>
                </p>
            
                @endif
                @error('winner_number_4')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>
            <div class="input-container" x-show="$wire.fifth_prize !== null && $wire.fifth_prize !== ''">
                <label for="winner_number_5">5º Número</label>
                <input wire:model="winner_number_5" type="text" id="winner_number_5" placeholder="00" class="@if($disabledWinnerNumbers[5]) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($disabledWinnerNumbers[5]) disabled @endif>
                @if(isset($winners_from_raffle_numbers['winner_number_5']) && is_array($winners_from_raffle_numbers['winner_number_5']))
                <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_5']['name'] }}</p>
                <p>📧 <strong>Email:</strong> 
                    <span class="email-visible">{{ substr($winners_from_raffle_numbers['winner_number_5']['email'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_5']['email']) - 4) }}</span>
                    <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_5']['email'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('email')">👁️</button>
                </p>
                <p>📞 <strong>Telefone:</strong> 
                    <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_5']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_5']['phone']) - 4) }}</span>
                    <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_5']['phone'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('phone')">👁️</button>
                </p>
                @endif
                @error('winner_number_5')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>
            <div class="input-container" x-show="$wire.sixth_prize !== null && $wire.sixth_prize !== ''">
                <label for="winner_number_6">6º Número</label>
                <input wire:model="winner_number_6" type="text" id="winner_number_6" placeholder="00" class="@if($disabledWinnerNumbers[6]) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($disabledWinnerNumbers[6]) disabled @endif>
                @if(isset($winners_from_raffle_numbers['winner_number_6']) && is_array($winners_from_raffle_numbers['winner_number_6']))
                <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_6']['name'] }}</p>
                <p>📧 <strong>Email:</strong> 
                    <span class="email-visible">{{ substr($winners_from_raffle_numbers['winner_number_6']['email'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_6']['email']) - 4) }}</span>
                    <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_6']['email'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('email')">👁️</button>
                </p>
                <p>📞 <strong>Telefone:</strong> 
                    <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_6']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_6']['phone']) - 4) }}</span>
                    <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_6']['phone'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('phone')">👁️</button>
                </p>
                @endif
                @error('winner_number_6')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>
            <div class="input-container" x-show="$wire.seventh_prize !== null && $wire.seventh_prize !== ''">
                <label for="winner_number_7">7º Número</label>
                <input wire:model="winner_number_7" type="text" id="winner_number_7" placeholder="00" class="@if($disabledWinnerNumbers[7]) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($disabledWinnerNumbers[7]) disabled @endif>
                @if(isset($winners_from_raffle_numbers['winner_number_7']) && is_array($winners_from_raffle_numbers['winner_number_7']))
                <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_7']['name'] }}</p>
                <p>📧 <strong>Email:</strong> 
                    <span class="email-visible">{{ substr($winners_from_raffle_numbers['winner_number_7']['email'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_7']['email']) - 4) }}</span>
                    <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_7']['email'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('email')">👁️</button>
                </p>
                <p>📞 <strong>Telefone:</strong> 
                    <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_7']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_7']['phone']) - 4) }}</span>
                    <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_7']['phone'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('phone')">👁️</button>
                </p>
                @endif
                @error('winner_number_7')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>

            <div class="input-container" x-show="$wire.eighth_prize !== null && $wire.eighth_prize !== ''">
                <label for="winner_number_8">8º Número</label>
                <input wire:model="winner_number_8" type="text" id="winner_number_8" placeholder="00" class="@if($disabledWinnerNumbers[8]) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($disabledWinnerNumbers[8]) disabled @endif>
                @if(isset($winners_from_raffle_numbers['winner_number_8']) && is_array($winners_from_raffle_numbers['winner_number_8']))
                <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_8']['name'] }}</p>
                <p>📧 <strong>Email:</strong> 
                    <span class="email-visible">{{ substr($winners_from_raffle_numbers['winner_number_8']['email'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_8']['email']) - 4) }}</span>
                    <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_8']['email'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('email')">👁️</button>
                </p>
                <p>📞 <strong>Telefone:</strong> 
                    <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_8']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_8']['phone']) - 4) }}</span>
                    <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_8']['phone'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('phone')">👁️</button>
                </p>
                @endif
                @error('winner_number_8')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>
            <div class="input-container" x-show="$wire.ninth_prize !== null && $wire.ninth_prize !== ''">
                <label for="winner_number_9">9º Número</label>
                <input wire:model="winner_number_9" type="text" id="winner_number_9" placeholder="00" class="@if($disabledWinnerNumbers[9]) bg-gray-200 text-gray-400 cursor-not-allowed @endif"  @if($disabledWinnerNumbers[9]) disabled @endif>
                @if(isset($winners_from_raffle_numbers['winner_number_9']) && is_array($winners_from_raffle_numbers['winner_number_9']))
                <p>🏆 <strong>Vencedor:</strong> {{ $winners_from_raffle_numbers['winner_number_9']['name'] }}</p>
                <p>📧 
                    <strong>Email:</strong>
                    <span class="email-visible">{{ substr($winners_from_raffle_numbers['winner_number_9']['email'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_9']['email']) - 4) }}</span>
                    <span class="email-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_9']['email'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('email')">👁️</button>
                </p>
                <p>📞 
                    <strong>Telefone:</strong>
                    <span class="phone-visible">{{ substr($winners_from_raffle_numbers['winner_number_9']['phone'], 0, 4) }}{{ str_repeat('*', strlen($winners_from_raffle_numbers['winner_number_9']['phone']) - 4) }}</span>
                    <span class="phone-hidden" style="display: none;">{{ $winners_from_raffle_numbers['winner_number_9']['phone'] }}</span>
                    <button type="button" class="toggle-btn" onclick="toggleWinnerVisibility('phone')">👁️</button>
                </p>
                @elseif(!isset($winners_from_raffle_numbers['winner_number_9']) && $winner_number_9)
                    <p class="text-red-500">Nenhum vencedor encontrado para este número.</p>
                @endif
                @error('winner_number_9')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>
            <button class="primary-button w-full md:w-[200px]">
                Buscar Vencedores
            </button>
        </form>
            <div class="col-span-12 flex justify-end gap-6">
                <button wire:click="decrementTab" class="secondary-button">
                    Anterior
                </button>
                <button wire:click="update" wire:confirm="Você tem certeza que deseja atualizar esta Ação?"
                    class="primary-button">
                    Atualizar
                </button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<script>
    function toggleVisibility(type, index = null) {
        const btn = event.target;
        const parentParagraph = btn.parentNode;
        let visibleSpan, hiddenSpan;

        if (index !== null) {
            visibleSpan = parentParagraph.querySelector(`.${type}-visible-${index}`);
            hiddenSpan = parentParagraph.querySelector(`.${type}-hidden-${index}`);
        } else {
            visibleSpan = parentParagraph.querySelector(`.${type}-visible`);
            hiddenSpan = parentParagraph.querySelector(`.${type}-hidden`);
        }

        // Verifica se os elementos foram encontrados antes de acessar suas propriedades
        if (visibleSpan && hiddenSpan) {
            if (visibleSpan.style.display === 'none') {
                visibleSpan.style.display = 'inline';
                hiddenSpan.style.display = 'none';
                btn.textContent = '👁️';
            } else {
                visibleSpan.style.display = 'none';
                hiddenSpan.style.display = 'inline';
                btn.textContent = '👁️';
            }
        } else {
            console.error('Elemento não encontrado no DOM.');
        }
    }
</script>

<script>
    function toggleWinnerVisibility(type) {
        const btn = event.target;
        const parentParagraph = btn.parentNode;
        const visibleSpan = parentParagraph.querySelector(`.${type}-visible`);
        const hiddenSpan = parentParagraph.querySelector(`.${type}-hidden`);

        if (visibleSpan && hiddenSpan) {
            if (visibleSpan.style.display === 'none') {
                visibleSpan.style.display = 'inline';
                hiddenSpan.style.display = 'none';
                btn.textContent = '👁️';
            } else {
                visibleSpan.style.display = 'none';
                hiddenSpan.style.display = 'inline';
                btn.textContent = '👁️';
            }
        } else {
            console.error('Elemento não encontrado no DOM.');
        }
    }
</script>