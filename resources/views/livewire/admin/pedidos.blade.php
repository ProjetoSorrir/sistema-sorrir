<div>
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            border-radius: 8px;
            padding: 20px;
            width: 80%;
            max-width: 600px;
            max-height: calc(100vh - 200px);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .modal-body {
            overflow-y: auto;
            /* Ensure the modal body can scroll */
            overflow-x: hidden;
            max-height: calc(100vh - 400px);
            width: 100%;
            -webkit-overflow-scrolling: touch;
            /* Enable momentum scrolling on iOS */
        }

        .close-button {
            position: absolute;
            top: 10px;
            righ: 10px;
            cursor: pointer;
        }

        .custom-alert {
            background: linear-gradient(to right, #00b09b, #96c93d);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0;
        }
    </style>
    <div class="card card-margins">
        <div class="card__title">Meus Pedidos</div>
        <!-- Cards Container -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 px-4 py-4 xl:w-3/4">
            <!-- Card 1: Total da(s) Rifa(s) -->
            <div
                class="card-total blur flex flex-col items-center justify-center w-[240px] min-[375px]:w-[300px] md:w-1/3 h-20 md:h-24 bg-light-pink rounded-lg border border-primary text-primary">
                <h1 class="text-2xl md:text-4xl font-bold">
                    <span class="text-xl">R$</span>
                    <span>{{ number_format($totalRifas, 2, ',', '.') }}</span>
                </h1>
                <h5 class="text-md md:text-lg">Total das Ações</h5>
            </div>

            <!-- Card 2: Total a Receber -->
            <div
                class="card-total blur flex flex-col items-center justify-center w-[240px] min-[375px]:w-[300px] md:w-1/3 h-20 md:h-24 bg-light-yellow rounded-lg text-dark-red border border-dark-red">
                <h1 class="text-2xl md:text-4xl font-bold">
                    <span class="text-xl">R$</span>
                    <span>{{ number_format($totalAReceber, 2, ',', '.') }}</span>
                </h1>
                <h5 class="text-lg">Total a Receber</h5>
            </div>

            <!-- Card 3: Total Pagos -->
            <div
                class="card-total blur flex flex-col items-center justify-center w-[240px] min-[375px]:w-[300px] md:w-1/3 h-20 md:h-24 bg-light-green rounded-lg text-custom-green border border-custom-green">
                <h1 class="text-2xl md:text-4xl font-bold">
                    <span class="text-xl">R$</span>
                    <span>{{ number_format($totalPagos, 2, ',', '.') }}</span>
                </h1>
                <h5 class="text-lg">Total Pagos</h5>
            </div>

            <button id="toggleBlurButton"
                class="order-1 md:order-2 w-fit flex gap-4 px-4 py-2 bg-gray-200 rounded-md text-black h-[40px]">
                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_1130_3314" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                        width="24" height="24">
                        <rect width="24" height="24" fill="#D9D9D9" />
                    </mask>
                    <g mask="url(#mask0_1130_3314)">
                        <path
                            d="M12 16C13.25 16 14.3125 15.5625 15.1875 14.6875C16.0625 13.8125 16.5 12.75 16.5 11.5C16.5 10.25 16.0625 9.1875 15.1875 8.3125C14.3125 7.4375 13.25 7 12 7C10.75 7 9.6875 7.4375 8.8125 8.3125C7.9375 9.1875 7.5 10.25 7.5 11.5C7.5 12.75 7.9375 13.8125 8.8125 14.6875C9.6875 15.5625 10.75 16 12 16ZM12 14.2C11.25 14.2 10.6125 13.9375 10.0875 13.4125C9.5625 12.8875 9.3 12.25 9.3 11.5C9.3 10.75 9.5625 10.1125 10.0875 9.5875C10.6125 9.0625 11.25 8.8 12 8.8C12.75 8.8 13.3875 9.0625 13.9125 9.5875C14.4375 10.1125 14.7 10.75 14.7 11.5C14.7 12.25 14.4375 12.8875 13.9125 13.4125C13.3875 13.9375 12.75 14.2 12 14.2ZM12 19C9.56667 19 7.35 18.3208 5.35 16.9625C3.35 15.6042 1.9 13.7833 1 11.5C1.9 9.21667 3.35 7.39583 5.35 6.0375C7.35 4.67917 9.56667 4 12 4C14.4333 4 16.65 4.67917 18.65 6.0375C20.65 7.39583 22.1 9.21667 23 11.5C22.1 13.7833 20.65 15.6042 18.65 16.9625C16.65 18.3208 14.4333 19 12 19ZM12 17C13.8833 17 15.6125 16.5042 17.1875 15.5125C18.7625 14.5208 19.9667 13.1833 20.8 11.5C19.9667 9.81667 18.7625 8.47917 17.1875 7.4875C15.6125 6.49583 13.8833 6 12 6C10.1167 6 8.3875 6.49583 6.8125 7.4875C5.2375 8.47917 4.03333 9.81667 3.2 11.5C4.03333 13.1833 5.2375 14.5208 6.8125 15.5125C8.3875 16.5042 10.1167 17 12 17Z"
                            fill="#1C1B1F" />
                    </g>
                </svg>
            </button>
        </div>

        @if (session('alertMessage'))
            <div id="custom-alert" class="custom-alert">
                {{ session('alertMessage') }}
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(function() {
                        var alert = document.getElementById('custom-alert');
                        if (alert) {
                            alert.style.transition = 'opacity 0.5s ease';
                            alert.style.opacity = '0';
                            setTimeout(function() {
                                alert.remove();
                            }, 500);
                        }
                    }, 5000);
                });
            </script>
        @endif
        <div class="grid grid-cols-12 gap-6 my-4">
            {{-- <div class="col-span-12 md:col-span-6 lg:col-span-3  w-[240px] min-[375px]:w-[300px] min-[425px]:w-full">
                <label for="search" class="block text-sm text-gray-700 mb-1 font-bold">Pesquisar por Nome da
                    Ação</label>
                <div class="flex items-center border border-primary rounded px-2">
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Nome da Rifa"
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
            </div> --}}



            <div class="col-span-12 md:col-span-6 w-[240px] min-[375px]:w-[300px] min-[425px]:w-full">
                <label for="search" class="block text-sm text-gray-700 mb-1 font-bold">Filtrar por número do pedido,
                    nome, CPF, email ou telefone do
                    cliente</label>
                <div class="flex items-center border border-primary rounded px-2">
                    <input wire:model.live.debounce.300ms="numberFilter" type="text"
                        placeholder="número do pedido, nome, CPF, email ou telefone do cliente" required=""
                        class="border-none w-full">
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

        <!-- Table Skeleton -->
        <div class="flex flex-col mt-4">
            <div class="align-middle inline-block min-w-full">
                <!-- Tailwind CSS Table -->
                <div class="overflow-x-auto">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Pedido</th>
                                <th>Data</th>
                                <th>Ação</th>
                                <th>Cliente</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                {{-- <th>WhatsApp</th> --}}
                                <th>Títulos</th>
                                <th>Qtde. de Títulos Comprados</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Opções</th>
                                <th>Comprovante</th>
                                <th>Recibo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->created_at->modify('-3 hours')->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('edit-raffles', [$invoice->raffle->id]) }}"
                                            class="text-blue-600 hover:text-blue-900" target="_blank">
                                            {{ $invoice->raffle->name }}
                                        </a>
                                    </td>
                                    <td>{{ $invoice->user->name }}</td>
                                    <td>{{ $invoice->user->email }}</td>
                                    <td>{{ $invoice->user->phone }}</td>
                                    {{-- <td>
                                    <a href="https://api.whatsapp.com/send?phone={{ $invoice->user->phone }}"
                                        class="text-indigo-600 hover:text-indigo-900">
                                        WhatsApp
                                    </a>
                                </td> --}}
                                    <td>
                                        @php
                                            if (
                                                $invoice->raffle->total_numbers >
                                                $invoice->raffle->quantity_personalized_tickets
                                            ) {
                                                $totalNumbers = $invoice->raffle->total_numbers;
                                            } else {
                                                $totalNumbers = $invoice->raffle->quantity_personalized_tickets;
                                            }
                                        @endphp
                                        <div class="w-full flex gap-2 justify-center">
                                            <button
                                                class="show-numbers-button font-bold my-2 py-2 px-4 bg-light-purple text-primary border border-primary rounded-md cursor-pointer"
                                                data-invoice-numbers="{{ json_encode($invoice->numbers->pluck('number')) }}"
                                                data-total-numbers="{{ $totalNumbers }}">
                                                Ver Títulos
                                            </button>
                                        </div>

                                    </td>
                                    <td>{{ $invoice->getNumberQty() }}</td>
                                    <td>
                                        @if (is_null($invoice->payed_at))
                                            <p
                                                class="text-yellow-700 bg-light-yellow border border-yellow-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                                Pendente
                                            </p>
                                        @else
                                            @if (is_null($invoice->payed_at) == false && is_null($invoice->invoice_path) == true)
                                                <p
                                                    class="text-cyan-700 bg-cyan-50 border border-cyan-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                                    Em Análise</p>
                                            @else
                                                <p
                                                    class="text-green-700 bg-light-green border border-green-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                                    Pago</p>
                                            @endif
                                        @endif
                                    </td>
                                    <td>R$ {{ $invoice->amount }}</td>
                                    <td>
                                        <div class="flex flex-col gap-2 w-max">
                                            <button wire:click="markAsPaid({{ $invoice->id }})"
                                                wire:confirm="Tem certeza que deseja marcar como pago?"
                                                class="px-4 py-2 text-green-600  flex gap-4 cursor-pointer hover:underline">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg" class="fill-green-600">
                                                    <mask id="mask0_1563_2643" style="mask-type:alpha"
                                                        maskUnits="userSpaceOnUse" x="0" y="0" width="24"
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
                                                    <mask id="mask0_1563_2649" style="mask-type:alpha"
                                                        maskUnits="userSpaceOnUse" x="0" y="0" width="24"
                                                        height="24">
                                                        <rect width="24" height="24" />
                                                    </mask>
                                                    <g mask="url(#mask0_1563_2649)">
                                                        <path
                                                            d="M6.4 19L5 17.6L10.6 12L5 6.4L6.4 5L12 10.6L17.6 5L19 6.4L13.4 12L19 17.6L17.6 19L12 13.4L6.4 19Z" />
                                                    </g>
                                                </svg>

                                                Cancelar
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($invoice->raffle->disable_auto_payment_completion && $invoice->payment_voucher_path == null)
                                            <p
                                                class="text-orange-700 bg-orange-50 border border-orange-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                                Aguardando Comprovante
                                            </p>
                                        @elseif(
                                            $invoice->raffle->disable_auto_payment_completion &&
                                                !is_null($invoice->payment_voucher_path) &&
                                                $invoice->payment_voucher_path != 'baixa_manual' &&
                                                $invoice->payment_voucher_path != 'mercado_pago')
                                            <a href="{{ asset($invoice->payment_voucher_path) }}"
                                                class="block w-full text-indigo-600 hover:text-indigo-900 bg-indigo-100 border border-indigo-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap"
                                                target="_blank">
                                                Ver Comprovante
                                            </a>
                                        @elseif($invoice->payment_voucher_path == 'baixa_manual')
                                            <p
                                                class="text-gray-700 bg-gray-100 border border-gray-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                                Baixa Manual
                                            </p>
                                        @else
                                            <p
                                                class="text-purple-700 bg-light-purple border border-purple-700 font-medium rounded-md py-1 px-2 whitespace-no-wrap">
                                                Baixa Automática
                                            </p>
                                        @endif
                                    </td>
                                    <td class="flex justify-center">
                                        @if ($invoice->invoice_path)
                                            <a href="{{ route('download.invoice', $invoice->id) }}" target="_blank"
                                                aria-label="Ver Recibo">
                                                <svg width="24" height="25" viewBox="0 0 24 25"
                                                    class="fill-dark-grey hover:fill-black"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <mask id="mask0_1251_2643" style="mask-type:alpha"
                                                        maskUnits="userSpaceOnUse" x="0" y="0" width="24"
                                                        height="25">
                                                        <rect y="0.5" width="24" height="24" />
                                                    </mask>
                                                    <g mask="url(#mask0_1251_2643)">
                                                        <path
                                                            d="M6 22.5C5.16667 22.5 4.45833 22.2083 3.875 21.625C3.29167 21.0417 3 20.3333 3 19.5V16.5H6V2.5L7.5 4L9 2.5L10.5 4L12 2.5L13.5 4L15 2.5L16.5 4L18 2.5L19.5 4L21 2.5V19.5C21 20.3333 20.7083 21.0417 20.125 21.625C19.5417 22.2083 18.8333 22.5 18 22.5H6ZM18 20.5C18.2833 20.5 18.5208 20.4042 18.7125 20.2125C18.9042 20.0208 19 19.7833 19 19.5V5.5H8V16.5H17V19.5C17 19.7833 17.0958 20.0208 17.2875 20.2125C17.4792 20.4042 17.7167 20.5 18 20.5ZM9 9.5V7.5H15V9.5H9ZM9 12.5V10.5H15V12.5H9ZM17 9.5C16.7167 9.5 16.4792 9.40417 16.2875 9.2125C16.0958 9.02083 16 8.78333 16 8.5C16 8.21667 16.0958 7.97917 16.2875 7.7875C16.4792 7.59583 16.7167 7.5 17 7.5C17.2833 7.5 17.5208 7.59583 17.7125 7.7875C17.9042 7.97917 18 8.21667 18 8.5C18 8.78333 17.9042 9.02083 17.7125 9.2125C17.5208 9.40417 17.2833 9.5 17 9.5ZM17 12.5C16.7167 12.5 16.4792 12.4042 16.2875 12.2125C16.0958 12.0208 16 11.7833 16 11.5C16 11.2167 16.0958 10.9792 16.2875 10.7875C16.4792 10.5958 16.7167 10.5 17 10.5C17.2833 10.5 17.5208 10.5958 17.7125 10.7875C17.9042 10.9792 18 11.2167 18 11.5C18 11.7833 17.9042 12.0208 17.7125 12.2125C17.5208 12.4042 17.2833 12.5 17 12.5ZM6 20.5H15V18.5H5V19.5C5 19.7833 5.09583 20.0208 5.2875 20.2125C5.47917 20.4042 5.71667 20.5 6 20.5Z" />
                                                    </g>
                                                </svg>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-2">
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>

        <div class="modal" id="customModal">
            <div class="modal-content mx-auto mt-20">
                <span class="w-full flex justify-end  pr-4 close-button text-xl font-bold">&times;</span>
                <h3 class="text-xl font-bold lg:text-2xl my-4">Títulos comprados</h3>
                <div class="modal-body flex flex-wrap justify-center text-primary"></div>
                <button class="custom-confirm-button mt-4 bg-blue-500 text-white py-2 px-4 rounded">Fechar</button>
            </div>
        </div>

    </div>
    <script>
        document.getElementById('toggleBlurButton').addEventListener('click', function() {
            const cards = document.querySelectorAll('.card-total');
            cards.forEach(card => {
                card.classList.toggle('blur');
            });
        });

        function formatNumberWithLeadingZeros(number, maxNumber) {
            // Calcular o número de dígitos no número máximo
            let totalDigits = String(maxNumber).length;

            // Retornar o número formatado com zeros à esquerda
            return String(number).padStart(totalDigits, '0');
        }

        $(document).ready(function() {
            $('.show-numbers-button').on('click', function() {
                let numbers = $(this).data('invoice-numbers');
                let totalNumbers = $(this).data('total-numbers');
                numbers.sort((a, b) => a - b); // Ordena os números em ordem crescente

                // Transforma cada número em um span com a classe do Tailwind CSS
                let numbersHtml = numbers.map(number =>
                    `<span class="border border-primary h-fit w-fit bg-primary/20 px-2 py-1 m-1">${formatNumberWithLeadingZeros(number, totalNumbers - 1)}</span>`
                ).join('');

                // Adiciona os números na modal
                $('#customModal .modal-body').html(numbersHtml);

                // Mostra a modal
                $('#customModal').fadeIn();
            });

            // Fecha a modal ao clicar no botão de fechar ou no backdrop
            $('.close-button, .custom-confirm-button').on('click', function() {
                $('#customModal').fadeOut();
            });

            // Fecha a modal ao clicar fora do conteúdo da modal
            $('#customModal').on('click', function(event) {
                if ($(event.target).is('#customModal')) {
                    $(this).fadeOut();
                }
            });

            // Formata número com zeros à esquerda
            function formatNumberWithLeadingZeros(number, totalNumbers) {
                return String(number).padStart(totalNumbers.toString().length, '0');
            }
        });
    </script>
