<div>
    <div class="grid grid-cols-12 gap-6 lg:w-3/4 mb-6">
        @if (session()->has('message_confirmPayment'))
            <div class="text-center mt-2 col-span-12 px-4 py-2">
                <p class="text-sm bg-green-100 text-green-800 p-2 rounded">
                    {{ session('message_confirmPayment') }}
                </p>
            </div>
        @endif
        @if (session()->has('message_revokePayment'))
            <div class="text-center mt-2 col-span-12 px-4 py-2">
                <p class="text-sm bg-red-100 text-red-800 p-2 rounded">
                    {{ session('message_revokePayment') }}
                </p>
            </div>
        @endif
        <div class="col-span-12  w-[240px] min-[375px]:w-[300px] min-[425px]:w-full md:w-1/2">
            <label for="search" class="block text-sm text-gray-700 mb-1 font-bold">Encontre a comissão do afiliado:</label>
            <div class="flex items-center border border-primary rounded px-2 mb-5">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Digite o nome, email ou ID do pedido..." required=""
                    class="border-none w-full">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="fill-dark-grey">
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
            <div class="col-span-12 w-[240px] min-[375px]:w-[300px] min-[425px]:w-full md:w-1/2 flex flex-wrap">
                <div class="w-full md:w-1/2 md:pr-2">
                    <label for="start_date" class="block text-sm text-gray-700 mb-1 font-bold">Data de Início</label>
                    <input wire:model.live.debounce.300ms="start_date" type="date" class="border border-primary rounded px-2">
                </div>
                <div class="w-full md:w-1/2 md:pl-2">
                    <label for="end_date" class="block text-sm text-gray-700 mb-1 font-bold">Data de Término</label>
                    <input wire:model.live.debounce.300ms="end_date" type="date" class="border border-primary rounded px-2">
                </div>
                <div class="w-full mt-4">
                    <button wire:click="clearFilters" class="primary-button flex justify-center items-center py-3 px-4">
                        Limpar Filtros
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="custom-table">
            <thead>
                <tr>
                    <th scope="col">
                        Data
                    </th>
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
                        E-mail
                    </th>
                    <th scope="col">
                        Telefone
                    </th>
                    <th scope="col">
                        Nº de Títulos
                    </th>
                    <th scope="col">
                        Valor do Título
                    </th>
                    <th scope="col">
                        Valor total dos Títulos
                    </th>
                    <th scope="col">
                        Porcentagem
                    </th>
                    <th scope="col">
                        Valor de Comissão
                    </th>
                    <th scope="col">
                        Status
                    </th>
                    <th scope="col">
                        PIX
                    </th>
                    <th scope="col">
                        Opções
                    </th>
                    <th scope="col">
                        Pagamento
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>
                            {{ $invoice->created_at->modify('-3 hours')->format('d/m/Y H:i') }}
                        </td>
                        <td>
                            {{ $invoice->id }}
                        </td>
                        <td>
                            {{ $invoice->raffle->name }}
                        </td>
                        <td>
                            {{ $invoice->referredUser->name }}
                        </td>
                        <td>
                            {{ $invoice->referredUser->email }}
                        </td>
                        <td>
                            {{ $invoice->referredUser->phone ? $invoice->referredUser->ddi . $invoice->referredUser->phone : 'Sem telefone registrado' }}
                        </td>
                        <td>
                            {{ $invoice->getNumberQty() }}
                        </td>
                        <td>
                            R$ {{ number_format($invoice->raffle->price_per_number, 2, ',', '.') }}
                        </td>
                        <td>
                            R$ {{ number_format($invoice->amount, 2, ',', '.') }}
                        </td>
                        <td>
                            {{ $invoice->refer_percentage !== null ? number_format($invoice->refer_percentage * 100, 2) . '%' : '-' }}
                        </td>
                        <td>
                            {{ 'R$ ' . number_format($invoice->refer_amount, 2, ',', '.') }}
                        </td>
                        <td>
                            {{ $invoice->referredUser->tipoChaveRevendedor . ' / ' . $invoice->referredUser->chaveRevendedor }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @if ($invoice->payed_at && $invoice->invoice_path)
                                <span
                                    class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                    <span aria-hidden
                                        class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                    <span class="relative"> Ação Paga</span>
                                </span>
                            @else
                                <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                    <span aria-hidden
                                        class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Aguardando Pagamento da Ação</span>
                                </span>
                            @endif
                        </td>
                        @if ($invoice->payed_at && $invoice->invoice_path)
                            <td>
                                <button wire:click="confirmPayment({{ $invoice->id }})"
                                    wire:confirm="Tem certeza que deseja marcar como pago?"
                                    class="px-4 py-2 text-green-600  flex gap-4 cursor-pointer hover:underline">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="fill-green-600">
                                        <mask id="mask0_1563_2643" style="mask-type:alpha"
                                            maskUnits="referredUserSpaceOnUse" x="0" y="0" width="24"
                                            height="24">
                                            <rect width="24" height="24" />
                                        </mask>
                                        <g mask="url(#mask0_1563_2643)">
                                            <path
                                                d="M9.54998 18L3.84998 12.3L5.27498 10.875L9.54998 15.15L18.725 5.97498L20.15 7.39998L9.54998 18Z" />
                                        </g>
                                    </svg>
                                    Marcar como Pago
                                </button>
                                <button wire:click="revokePayment({{ $invoice->id }})"
                                    wire:confirm="Tem certeza que deseja cancelar o pagamento?"
                                    class="px-4 py-2 text-red-600 flex gap-4 cursor-pointer hover:uderline">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="fill-red-600">
                                        <mask id="mask0_1563_2649" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="24" height="24">
                                            <rect width="24" height="24" />
                                        </mask>
                                        <g mask="url(#mask0_1563_2649)">
                                            <path
                                                d="M6.4 19L5 17.6L10.6 12L5 6.4L6.4 5L12 10.6L17.6 5L19 6.4L13.4 12L19 17.6L17.6 19L12 13.4L6.4 19Z" />
                                        </g>
                                    </svg>
                                    Cancelar
                                </button>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if ($invoice->refer_payment_status === 'Paid')
                                    <p
                                        class="text-green-700 bg-light-green border border-green-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                        Pago</p>
                                @elseif($invoice->refer_payment_status === 'Canceled')
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
                        @endif
                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('edit-customer', [referredUser->id]) }}" aria-label="Editar">
                                <svg width="24" height="24" viewBox="0 0 24 24"
                                    class="fill-dark-grey hover:fill-black" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_957_2643" style="mask-type:alpha" maskUnits="referredUserSpaceOnUse" x="0"
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
        {{ $invoices->links() }}
    </div>
</div>
