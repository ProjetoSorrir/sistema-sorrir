<div class="pt-2 min-h-[calc(100vh-450px)] flex justify-center items-center">
    <style>
        .loading-we {
            width: 100%;
            height: 20px;
            background-color: #f3f3f3;
            /* light grey */
            border-radius: 10px;
            margin: 20px auto;
            position: relative;
            overflow: hidden;
        }

        .loading-we::after {
            content: "";
            display: block;
            background-color: #FFD700;
            /* pink */
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: -100%;
            animation: progress 2s linear infinite;
        }

        @keyframes progress {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }
    </style>

    <div
        class="rounded-lg bg-white md:min-w-[400px] md:min-h-[350px] shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] p-4 text-primary font-bold  flex flex-col items-center justify-center">
        <img src="/assets/images/misc/clover.png">

        <div class="message w-full text-center mb-4">
            Aguarde! Estamos preparando seu pedido!
        </div>
        <div class="loading-we"></div>
    </div>
</div>
