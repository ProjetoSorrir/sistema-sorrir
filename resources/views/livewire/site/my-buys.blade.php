<div>
    <style type="text/css">
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

        .box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, .05);
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            /* display: none; <- Crashes Chrome on hover */
            -webkit-appearance: none;
            margin: 0;
            /* <-- Apparently some margin are still there even though it's hidden */
        }

        input[type=number] {
            -moz-appearance: textfield;
            /* Firefox */
        }

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
    </style>

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
    @if ($invoices->isEmpty())
        <div class="p-8 mx-auto text-center">
            <img class="w-[250px] max-w-[70%] mx-auto mb-12" src="<?=asset('assets/images/misc/cart.png')?>">
            <p class="text-xl font-bold text-white"> Nenhum título encontrado</p>
            <p class="text-sm font-medium text-white">Você ainda não adquiriu nenhum título através desta
                conta.<br>Clique no botão
                abaixo e adquira agora mesmo</p>
            <div class="relative mt-10">
                <a href="/" class="primary-button">Conheça nossas ações!</a>
            </div>
        </div>
    @else
        <div class="p-2 lg:p-0">
            <div class="flex gap-2 mb-6 pt-2">
                <h1 class="text-[25px] text-white font-semibold">Minhas compras</h1>
            </div>

            <div class="mt-6 grid gap-4">
                @foreach ($invoices as $invoice)
                    <div class="bg-white p-4 rounded-lg">
                        <div class="col-span-full flex gap-4">
                            <div>
                                <div class="w-[100px] h-[100px] rounded-lg"
                                    style="align-content: end; background-size: cover !important; background-position: 50% !important; background: url('<?=asset('assets/images/misc/thumb-wepremios-01.png')?>')">
                                </div>
                            </div>
                            <div class="grid content-between w-full">
                                <div>
                                    <div class="col-span-full flex gap-2 h-fit">
                                        <p><b class="text-primary">Produto:</b>
                                            {{ $invoice->raffle->name }}</p>
                                    </div>
                                    <div>
                                        <p><b class="text-primary">Valor da compra:</b> R$
                                            {{ number_format($invoice->amount, 2, ',', '.') }}</p>
                                        <p><b class="text-primary">Data do pedido:</b>
                                            {{ $invoice->created_at->format('d/m/Y') }}</p>
                                        <p><b class="text-primary">Processo SUSEP:</b>
                                            {{ $invoice->raffle->susep_process }}</p>
                                    </div>
                                </div>
                            </div>

                            <hr>
                        </div>
                        <div class="w-full grid grid-cols-2 mt-4 pt-4 gap-2 border-t border-1 border-[#00000036]">
                            <div>
                                @if (is_null($invoice->payed_at))
                                    <p
                                        class="text-xs text-yellow-700 bg-yellow-200 border border-yellow-700/20 font-bold rounded-sm h-[40px] w-full grid items-center text-center uppercase">
                                        Pendente
                                    </p>
                                @else
                                    @if (is_null($invoice->payed_at) == false && is_null($invoice->invoice_path) == true)
                                        <p
                                            class="text-xs text-yellow-700 bg-yellow-200 border border-yellow-700/20 font-bold rounded-sm h-[40px] w-full grid items-center text-center uppercase">
                                            Em analise</p>
                                    @else
                                        <p
                                            class="text-xs text-green-700 bg-green-200 border border-green-700/20 font-bold rounded-sm h-[40px] w-full grid items-center text-center uppercase">
                                            Pago</p>
                                    @endif
                                @endif
                            </div>
                            <div>
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
                                @if (!$invoice->payed_at)
                                    <a href="{{ route('reservation-confirmation', [$invoice->id]) }}"
                                        class="text-xs text-white bg-green-500 font-bold rounded-sm h-[40px] w-full grid items-center text-center uppercase">
                                        Pagar
                                    </a>
                                @elseif ($invoice->invoice_path)

                                    @php
                                        $currentTime = now();
                                        $payedTime = \Carbon\Carbon::parse($invoice->payed_at);
                                        $differenceInMinutes = $payedTime->diffInMinutes($currentTime);
                                    @endphp

                                    @if ($differenceInMinutes < 1)
                                        <button
                                            class="show-numbers-button text-xs text-primary bg-primary/20 border border-1 border-primary font-bold rounded-sm h-[40px] w-full grid items-center text-center uppercase">
                                            Preparando seus números
                                        </button>
                                    @else
                                        <button
                                            class="show-numbers-button text-xs text-primary bg-primary/20 border border-1 border-primary font-bold rounded-sm h-[40px] w-full grid items-center text-center uppercase"
                                            data-invoice-numbers="{{ json_encode($invoice->numbers->pluck('number')) }}"
                                            data-total-numbers="{{ $totalNumbers }}">
                                            Ver Títulos
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                        {{-- @if ($invoice->invoice_path)
                            <a href="{{ route('download.invoice', $invoice->id) }}" target="_blank"
                                class="mt-4 text-xs text-white bg-primary font-bold rounded-sm h-[40px] w-full items-center text-center uppercase flex justify-center gap-4">
                                <svg width="24" height="25" viewBox="0 0 24 25" class="fill-white"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_1934_2797" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="25">
                                        <rect y="0.5" width="24" height="24" />
                                    </mask>
                                    <g mask="url(#mask0_1934_2797)">
                                        <path
                                            d="M12 16.5L7 11.5L8.4 10.05L11 12.65V4.5H13V12.65L15.6 10.05L17 11.5L12 16.5ZM6 20.5C5.45 20.5 4.97917 20.3042 4.5875 19.9125C4.19583 19.5208 4 19.05 4 18.5V15.5H6V18.5H18V15.5H20V18.5C20 19.05 19.8042 19.5208 19.4125 19.9125C19.0208 20.3042 18.55 20.5 18 20.5H6Z" />
                                    </g>
                                </svg>
                                Baixar Comprovante
                            </a>
                        @endif --}}
                    </div>
                @endforeach
            </div>

        </div>

        <div class="modal" id="customModal">
            <div class="modal-content mx-auto mt-20">
                <span class="w-full flex justify-end  pr-4 close-button text-xl font-bold">&times;</span>
                <h3 class="text-xl font-bold lg:text-2xl my-4">Títulos comprados</h3>
                <div class="modal-body flex flex-wrap justify-center text-primary"></div>
                <button class="custom-confirm-button mt-4 bg-primary text-white py-2 px-4 rounded">Fechar</button>
            </div>
        </div>
</div>

@endif



</div>
<script>
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
