<div class="">

    @if ($invoice->payed_at !== null)
        <div class="text-center pt-4">
            <img class="mx-auto w-[200px] h-[200px]" src="<?= asset('assets/images/misc/pagamento-confirmado.jpg') ?>">

            <div class="py-6">
                <p class="font-bold text-lg">Pagamento aprovado para o pedido #{{ $invoice->id }}</p>
                <p class="text-sm mt-2">Esta compra está com o pagamento aprovado e seus números foram confirmados com
                    sucesso!</p>
            </div>

            <a href="../action/362" class="primary-button min-w-full grid text-center mt-2 uppercase font-bold">Realizar
                nova compra</a>
            <a href="{{ route('my-buys') }}" class="primary-button min-w-full grid text-center mt-2 uppercase font-bold"
                style="background: #dedede !important; color: #FFD700;">Voltar para minhas compras</a>
        </div>
    @else
        @if (isset($qrCode))
            <div class="lg:px-4">
                <div class="w-full mb-2 bg-[#ffffffe6]" style="padding: 10px; border-radius: 10px;">
                    <div class="flex gap-2">
                        <div>
                            <svg class="min-w-8 min-h-8 opacity-30" data-slot="icon" fill="none" stroke-width="1.5"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                            </svg>
                        </div>
                        <div style="align-items: center; display: grid;">
                            <p class="text-xs"><span class="font-bold">Pagamento verificado a cada 15 segundos.</span>
                                Após pagar não saia da página até ser confirmado</p>
                        </div>
                    </div>
                    <div class="progress-container mt-2">
                        <div class="progress-bar" id="progressBar"></div>
                    </div>
                </div>
            </div>
            <div
                class="rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] px-4 lg:px-8 md:m-4 p-6">
                <div class="mb-4 md:w-1/2 md:mx-auto">
                    <p class="text-sm"><span class="font-semibold">Quantidade de Títulos:
                        </span>{{ $invoice->getNumberQty() }}</p>
                    <p class="text-sm"><span class="font-semibold">Valor Total da Compra: </span> R$
                        {{ number_format($invoice->amount, 2, ',', '.') }}</p>
                </div>

                <div class="mb-2 w-full">

                    @if (!$raffle->disable_auto_payment_completion)
                        <div class="flex flex-col md:flex-row mx-auto justify-center items-center gap-4">
                            <div>
                                @if (!empty($qrCodeBase64))
                                    <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code"
                                        class="w-64 h-64 mx-auto mb-6 shadow-lg">
                                @endif
                            </div>
                    @endif

                </div>

                <div class="mb-2 w-full">
                    @if (!$raffle->disable_auto_payment_completion)
                        <h2 class="text-center font-semibold mb-2">Para pagar via Pix</h2>
                        <div class="copy-area mx-auto w-full">
                            <label for="" class="font-bold">Pix Copia e Cola:</label>
                            <div
                                class="copy-container border border-gray-300 rounded-lg flex justify-between bg-white w-full">
                                <textarea id="texto" class="w-full max-w-[85%] h-auto overflow-hidden resize-none  border-none px-3" rows="1"
                                    cols="1" readonly>{{ $qrCode }}</textarea>
                                <button onclick="copyToClipboard('texto')"
                                    class="bg-primary text-white font-bold py-2 border border-primary rounded-r-lg px-4 flex w-[150px]">
                                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="fill-white">
                                        <mask id="mask0_1394_2643" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="24" height="25">
                                            <rect y="0.5" width="24" height="24" />
                                        </mask>
                                        <g mask="url(#mask0_1394_2643)">
                                            <path
                                                d="M9 18.5C8.45 18.5 7.97917 18.3042 7.5875 17.9125C7.19583 17.5208 7 17.05 7 16.5V4.5C7 3.95 7.19583 3.47917 7.5875 3.0875C7.97917 2.69583 8.45 2.5 9 2.5H18C18.55 2.5 19.0208 2.69583 19.4125 3.0875C19.8042 3.47917 20 3.95 20 4.5V16.5C20 17.05 19.8042 17.5208 19.4125 17.9125C19.0208 18.3042 18.55 18.5 18 18.5H9ZM9 16.5H18V4.5H9V16.5ZM5 22.5C4.45 22.5 3.97917 22.3042 3.5875 21.9125C3.19583 21.5208 3 21.05 3 20.5V6.5H5V20.5H16V22.5H5Z" />
                                        </g>
                                    </svg>
                                    <span>Copiar</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <style type="text/css">
                        .progress-container {
                            width: 100%;
                            background-color: #ccc;
                            border-radius: 5px;
                            height: 10px;
                            position: relative;
                            overflow: hidden;
                        }

                        .progress-bar {
                            width: 100%;
                            height: 100%;
                            background-color: #4caf50;
                            animation: progress 15s linear infinite;
                        }

                        @keyframes progress {
                            0% {
                                width: 100%;
                            }

                            99% {
                                width: 0%;
                            }

                            100% {
                                width: 0%;
                            }
                        }
                    </style>


                    <p class="mx-4  mt-4 text-left md:text-center">Após confirmado o pagamento é possível obter
                        o recibo da
                        compra no
                        menu <a href="/my-buys" class="text-primary font-bold">Minhas
                            Compras</a>
                    </p>
                </div>
            </div>
        @else
            <div
                class="rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] px-4 lg:px-8 md:m-4 p-6">


                @if ($isOlderThan30Minutes)
                    <div class="text-center pt-4">
                        <img class="mx-auto w-[200px] h-[200px]"
                            src="<?= asset('assets/images/misc/pagamento-expirado.jpg') ?>">

                        <div class="py-6">
                            <p class="font-bold text-lg">Pagamento expirado</p>
                            <p class="text-sm mt-2">O prazo para efetuar o pagamento deste pedido expirou. Se
                                você já o pagou, permaneça nesta página por 10 segundos e o status do pagamento
                                será atualizado automaticamente.<br></p>
                        </div>
                        <a href="../action/362"
                            class="primary-button min-w-full grid text-center mt-2 uppercase font-bold">Fazer
                            novo pedido</a>
                    </div>
                @else
                    <div class="text-center pt-4">
                        <img class="mx-auto w-[200px] h-[200px]"
                            src="<?= asset('assets/images/misc/pagamento-invalido.jpg') ?>">

                        <div class="py-6">
                            <p class="font-bold text-lg">E-mail inválido ou não aceito</p>
                            <p class="text-sm mt-2">Não foi possível gerar o Código PIX pois <b>seu e-mail
                                    parece estar errado</b>! Clique no botão abaixo para atualizar seu e-mail,
                                vá até o menu "Minhas Compras" e efetue novamente o pagamento do pedido.</p>
                        </div>

                        <a href="{{ route('my-profile') }}"
                            class="primary-button min-w-full grid text-center mt-2 uppercase font-bold">Atualizar
                            e-mail</a>
                    </div>
                @endif
            </div>
        @endif
    @endif

    <script>
        function countdown() {
            const countdownElement = document.getElementById('countdown');
            const targetDate = new Date(countdownElement.dataset.endDate);

            const interval = setInterval(function() {
                const now = new Date().getTime();
                const distance = targetDate - now;

                if (distance < 0) {
                    clearInterval(interval);
                    document.getElementById('days').innerText = '0';
                    document.getElementById('hours').innerText = '0';
                    document.getElementById('minutes').innerText = '0';
                    document.getElementById('seconds').innerText = '0';
                    return;
                }

                // Time calculations for days, hours, minutes and seconds
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in the respective elements
                document.getElementById('days').innerText = days;
                document.getElementById('hours').innerText = hours;
                document.getElementById('minutes').innerText = minutes;
                document.getElementById('seconds').innerText = seconds;
            }, 1000);
        }

        countdown(); // Start the countdown
    </script>

    @if (!$raffle->disable_auto_payment_completion)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setInterval(function() {
                    @this.
                    call('checkPaymentStatus');
                }, 5000); // 5000 ms = 5 segundos
            });
        </script>
    @endif

    <script>
        function copyToClipboard() {
            var texto = document.getElementById("texto");
            texto.select();
            document.execCommand("copy");
            alert("Texto copiado para a área de transferência!");
        }
    </script>
