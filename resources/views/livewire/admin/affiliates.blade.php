<div class="card card-margins">
    <h1 class="card__title">Afiliados</h1>
    <p class="page-instructions">Afiliados na plataforma</p>
    <div class="mt-2 w-full" x-data="{ activeTab: @entangle('activeTab') }">
        <div class="flex w-full overflow-x-auto">
            <div @click="$wire.setActiveTab('tab1')" class="tracking-wide text-base cursor-pointer py-2 px-6"
                :class="{
                    'text-dark-grey': activeTab !== 'tab1',
                    'font-bold text-primary border-b border-primary': activeTab === 'tab1',
                }">
                Ativar/Desativar
            </div>
            <div @click="$wire.setActiveTab('tab2')" class="tracking-wide text-base cursor-pointer py-2 px-6"
                :class="{
                    'text-dark-grey': activeTab !== 'tab2',
                    'font-bold text-primary border-b border-primary': activeTab === 'tab2',
                }">
                Visão Geral
            </div>

            <div @click="$wire.setActiveTab('tab3')" class="relative tracking-wide text-base cursor-pointer py-2 px-6"
            :class="{
                'text-dark-grey': activeTab !== 'tab3',
                'font-bold text-primary border-b border-primary': activeTab === 'tab3',
            }">
            Extrato
            @if($invoice_notification)
                <span class="absolute top-0 right-0 h-2 w-2 bg-red-500 rounded-full"></span>
            @endif
        </div>
        </div>
        <div x-show="activeTab === 'tab1'" class="mt-6">
            @if (session()->has('commissioning'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative">
                    {{ session()->get('commissioning') }}
                </div>
            @endif

            <div class="grid grid-cols-12 gap-4">

                {{-- <div class="form-group col-span-12 md:col-span-4 lg:col-span-2">
                <label for="comissionamento" class="form-label">Ativar Comissionamento</label>
                <div class="toggle-switch">
                    <input wire:model="commissioning" type="checkbox" id="comissionamento"
                        class="toggle-switch__input text-primary" {{ $commissioningChecked }}>
                    <label for="comissionamento" class="toggle-switch__label"></label>
                </div>
            </div> --}}

                <div class="form-group col-span-12 md:col-span-4 lg:col-span-5 xl:col-span-3 flex items-start mt-6">
                    <button type="button"
                        class="toggle-switch relative rounded-full h-6 w-12 focus:outline-none bg-light-purple shadow-lg mr-4"
                        wire:click="toggleCommissioning({{ $commissioning ? 'false' : 'true' }})">
                        <span class="sr-only">Toggle Comissionamento</span>
                        <span aria-hidden="true"
                            class="absolute inset-0 rounded-full w-6 h-6 bg-primary transition-transform duration-300 ease-in-out transform {{ $commissioning ? 'translate-x-7' : 'translate-x-0' }}"></span>
                    </button>
                    <label for="comissionamento" class="form-label">Ativar Comissionamento</label>
                </div>

                <div class="form-group col-span-12 md:col-span-3 xl:col-span-2">
                    <label for="porcentagem-rifa" class="form-label">Porcentagem da Ação</label>
                    <div class="flex items-center border border-primary rounded px-2">
                        <input type="number" id="porcentagem-rifa" wire:model="commissioning_percentage"
                            class="form-input border-none w-full" placeholder="Informe a porcentagem">
                        <span class="input-group-addon">%</span>
                    </div>
                    <small class="form-text text-muted">Insira a porcentagem de comissão para o progrma de
                        afiliados</small>
                    @error('commissioning_percentage')
                        <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                    @enderror
                </div>
                <div class="input-container col-span-12 md:col-span-5 lg:col-span-8 xl:col-span-5">
                    <label for="commissioning_rules" class="form-label">Regras de Comissionamento</label>
                    <textarea id="commissioning_rules" wire:model="commissioning_rules"
                        placeholder="Insira as regras de comissionamento para o programa de afiliados" cols="30" rows="7"></textarea>
                    <small class="form-text text-muted">Insira as regras de comissionamento para o programa de
                        afiliados</small>
                    @error('commissioning_rules')
                        <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                    @enderror
                </div>
                <div class="form-group col-span-12 lg:col-span-2 flex justify-end mt-5">
                    <button wire:click="commissioningSubmit"
                        class="primary-button w-full md:w-[100px] lg:w-full">Salvar</button>
                </div>

            </div>
        </div>
        <div x-show="activeTab==='tab2'" class="mt-6">
            <div class="grid grid-cols-12 gap-6 lg:w-3/4 mb-6 lg:mt-4">
                <div class="col-span-12  w-[240px] min-[375px]:w-[300px] min-[425px]:w-full md:w-1/2">
                    <label for="search" class="block text-sm text-gray-700 mb-1 font-bold">Pesquisar por Afiliado:</label>
                    <div class="flex items-center border border-primary rounded px-2">
                        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Digite o nome, email ou telefone..."
                            required="" class="border-none w-full">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="fill-dark-grey">
                            <mask id="mask0_702_2663" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="24" height="24">
                                <rect width="24" height="24" />
                            </mask>
                            <g mask="url(#mask0_702_2663)">
                                <path
                                    d="M19.6 21L13.3 14.7C12.8 15.1 12.225 15.4167 11.575 15.65C10.925 15.8833 10.2333 16 9.5 16C7.68333 16 6.14583 15.3708 4.8875 14.1125C3.62917 12.8542 3 11.3167 3 9.5C3 7.68333 3.62917 6.14583 4.8875 4.8875C6.14583 3.62917 7.68333 3 9.5 3C11.3167 3 12.8542 3.62917 14.1125 4.8875C15.3708 6.14583 16 7.68333 16 9.5C16 10.2333 15.8833 10.925 15.65 11.575C15.4167 12.225 15.1 12.8 14.7 13.3L21 19.6L19.6 21ZM9.5 14C10.75 14 11.8125 13.5625 12.6875 12.6875C13.5625 11.8125 14 10.75 14 9.5C14 8.25 13.5625 7.1875 12.6875 6.3125C11.8125 5.4375 10.75 5 9.5 5C8.25 5 7.1875 5.4375 6.3125 6.3125C5.4375 7.1875 5 8.25 5 9.5C5 10.75 5.4375 11.8125 6.3125 12.6875C7.1875 13.5625 8.25 14 9.5 14Z" />
                            </g>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th scope="col">
                                ID do Pedido
                            </th>
                            <th scope="col">
                                Nome da Ação
                            </th>
                            <th scope="col">
                                Nome
                            </th>
                            <th scope="col">
                                Email
                            </th>
                            <th scope="col">
                                Telefone
                            </th>
                            <th scope="col">
                                Nº de Títulos Pagos
                            </th>
                            <th scope="col">
                                Valor total das Ações Pagas
                            </th>
                            <th scope="col">
                                Valor total de Comissão Paga
                            </th>
                            <th scope="col">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="w-full flex gap-2 justify-center" x-data="{ showIdModal: false }">
                                        <button @click="showIdModal = true"
                                            class="font-bold my-2 py-2 px-4 bg-light-purple  text-primary border border-primary rounded-md cursor-pointer">
                                            Ver Pedidos
                                        </button>
                                        <!-- Modal -->
                                        <div x-show="showIdModal" class="fixed z-50 inset-0">
                                            <div class="fixed inset-0 bg-gray-800 opacity-75"
                                                @click="showIdModal = false">
                                            </div>
                                            <div class="bg-white rounded m-auto fixed inset-0 max-w-2xl"
                                                style="max-height: 50vh;">
                                                <div class="flex justify-end">
                                                    <button @click="showIdModal = false"
                                                        class="absolute top-0 right-2 mt-4 ml-4">
                                                        <!-- Ícone SVG de "X" -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="p-4 max-h-[50vh] overflow-auto">
                                                    <div class="flex flex-wrap">
                                                        @foreach ($user->paidComission as $index => $invoice)
                                                            <div class="w-1/5 px-2 mb-2">
                                                                <p>{{ $invoice->id }}</p>
                                                            </div>
                                                            @if (($index + 1) % 5 == 0)
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="w-full flex gap-2 justify-center" x-data="{ showRaffleModal: false }">
                                        <button @click="showRaffleModal = true"
                                            class="font-bold my-2 py-2 px-4 bg-light-purple  text-primary border border-primary rounded-md cursor-pointer">
                                            Ver Ações
                                        </button>
                                        <!-- Modal -->
                                        <div x-show="showRaffleModal" class="fixed z-50 inset-0">
                                            <div class="fixed inset-0 bg-gray-800 opacity-75"
                                                @click="showRaffleModal = false"></div>
                                            <div class="bg-white rounded m-auto fixed inset-0 max-w-2xl"
                                                style="max-height: 50vh;">
                                                <div class="flex justify-end">
                                                    <button @click="showRaffleModal = false"
                                                        class="absolute top-0 right-2 mt-4 ml-4">
                                                        <!-- Ícone SVG de "X" -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="p-4 max-h-[50vh] overflow-auto">
                                                    <div class="flex flex-wrap">
                                                        @foreach ($user->paidComission->unique('raffle_id') as $invoice)
                                                            <div class="w-1/5 px-2 mb-2">
                                                                <p>{{ $invoice->raffle->name }}</p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->phone ? $user->ddi . $user->phone : 'Sem telefone registrado' }}
                                </td>
                                <td>
                                    {{ $user->paidComission->flatMap->numbers->count() }}
                                </td>
                                <td>
                                    R$ {{ number_format($user->paidComission->sum('amount'), 2, ',', '.') }}
                                </td>
                                <td>
                                    {{ 'R$ ' . number_format($user->paidComission->sum('refer_amount'), 2, ',', '.') }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    @php
                                        $status = 'Paid'; // Inicializa como "Pago"
                                        $hasPending = false;

                                        foreach ($user->paidComission as $invoice) {
                                            if ($invoice->refer_payment_status === 'Pending') {
                                                // Se houver uma fatura pendente, definimos o status como "Pending" e saímos do loop
                                                $status = 'Pending';
                                                $hasPending = true;
                                                break;
                                            } elseif ($invoice->refer_payment_status === 'Canceled' && !$hasPending) {
                                                // Se encontrarmos uma fatura cancelada e ainda não encontramos nenhuma pendente, definimos o status como "Canceled"
                                                $status = 'Canceled';
                                            }
                                        }
                                    @endphp

                                    @if ($status === 'Paid')
                                        <p
                                            class="text-green-700 bg-light-green border border-green-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                            Pago
                                        </p>
                                    @elseif ($status === 'Canceled')
                                        <p
                                            class="text-red-700 bg-light-red border border-red-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                            Cancelado
                                        </p>
                                    @else
                                        <p
                                            class="text-yellow-700 bg-light-yellow border border-yellow-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                            Pendente
                                        </p>
                                    @endif

                                </td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('edit-customer', [$user->id]) }}" aria-label="Editar">
                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                        class="fill-dark-grey hover:fill-black" xmlns="http://www.w3.org/2000/svg">
                                        <mask id="mask0_957_2643" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                            y="0" width="24" height="24">
                                            <rect width="24" height="24" />
                                        </mask>
                                        <g mask="url(#mask0_957_2643)">
                                            <path
                                                d="M5 19H6.425L16.2 9.225L14.775 7.8L5 17.575V19ZM3 21V16.75L16.2 3.575C16.4 3.39167 16.6208 3.25 16.8625 3.15C17.1042 3.05 17.3583 3 17.625 3C17.8917 3 18.15 3.05 18.4 3.15C18.65 3.25 18.8667 3.4 19.05 3.6L20.425 5C20.625 5.18333 20.7708 5.4 20.8625 5.65C20.9542 5.9 21 6.15 21 6.4C21 6.66667 20.9542 6.92083 20.8625 7.1625C20.7708 7.40417 20.625 7.625 20.425 7.825L7.25 21H3ZM15.475 8.525L14.775 7.8L16.2 9.225L15.475 8.525Z" />
                                        </g>
                                    </svg>
                                </a>
                            </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
        <div x-show="activeTab === 'tab3'" class="mt-6">
            <div>
                @livewire('admin.affiliates.affiliates-extract')
            </div>
        </div>
    </div>
