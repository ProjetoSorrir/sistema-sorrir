<div>
    <style type="text/css">
        header {
            display: none;
        }

        footer {
            display: none;
        }

        main {
            height: 100% !important;
            top: 0px !important;
            margin: 0 !important;
            align-items: center;
            display: grid;
        }


        .loader-1 {
          width: 48px;
          height: 48px;
          border: 5px solid #d2d2d2;
          border-bottom-color: #ff008c;
          border-radius: 50%;
          display: inline-block;
          -webkit-animation: rotation 1s linear infinite;
                  animation: rotation 1s linear infinite;
        }

        /* keyFrames */
        @-webkit-keyframes rotation {
          0% {
            transform: rotate(0deg);
          }
          100% {
            transform: rotate(360deg);
          }
        }
        @keyframes rotation {
          0% {
            transform: rotate(0deg);
          }
          100% {
            transform: rotate(360deg);
          }
        }

        #reloadButton {
            display: none;
        }

    </style>
    <div class="flex justify-center items-center">
        <div class="rounded-lg bg-white w-full shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] p-4 text-primary font-bold  flex flex-col items-center justify-center">
            <img src="/assets/images/misc/logo-sorrir.png" class="mb-4">

            <hr class="w-full">

            <span class="loader-1 mt-10"> </span>

            <div class="message w-full text-center mb-8 mt-4">
                <p>Estamos com um alto volume de acessos.</p>
                <p class="text-xs text-black/80">Em <span id="countdownText">60</span> segundos essa página será atualizada<br> e possivelmente você poderá prosseguir.</p>
            </div>

            <button id="reloadButton" class="primary-button mb-4" onclick="reloadPage()">Recarregar a página</button>
            <script>
                // Função para recarregar a página
                function reloadPage() {
                    location.reload();
                }

                // Inicializar o tempo restante
                let timeLeft = 60;
                
                // Função para atualizar o texto da contagem regressiva
                function updateCountdown() {
                    if (timeLeft > 0) {
                        document.getElementById('countdownText').innerText = `${timeLeft}`;
                        timeLeft--;
                    } else {
                        document.getElementById('countdownText').style.display = 'none';
                        document.getElementById('reloadButton').style.display = 'block';
                        clearInterval(countdownInterval);
                    }
                }

                // Atualizar a contagem regressiva a cada segundo
                let countdownInterval = setInterval(updateCountdown, 1000);
            </script>
        </div>
    </div>
</div>
