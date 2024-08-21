<div>
    <style>
        .confetti-container {
            margin: 0 auto;
            width: 50%;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            animation: confetti-fall 3s ease-out infinite;
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
            }

            100% {
                transform: translateY(100vh) rotate(360deg);
            }
        }

        .confetti-red {
            background-color: red;
        }

        .confetti-green {
            background-color: green;
        }

        .confetti-blue {
            background-color: blue;
        }

        .confetti-fuchsia {
            background-color: fuchsia;
        }

        .confetti-purple {
            background-color: purple;
        }
    </style>
    <div class="flex flex-col items-center gap-2 justify-center min-h-[60%] m-auto max-w-[90%] bg-gray-100">
        <div class="confetti-container"></div>
        <div class="text-green-500">
            <!-- SVG for Check Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                class="w-16 h-16">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <p class="text-center text-lg mt-4 font-semibold">Parabéns!</p>
        <p class="text-center text-lg mt-4 font-semibold">
            Você ganhou um prêmio por comprar o título @foreach ($number as $id)
                <b>{{ $id }}</b>
            @endforeach !
        </p>
        <p class="text-center">Aguarde que em breve nossa equipe entrará em contato.</p>
    </div>

</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const container = document.querySelector(".confetti-container");
        let stopAnimation = false;

        function createConfetti() {
            if (stopAnimation) return;

            const confetti = document.createElement("div");
            confetti.classList.add("confetti");
            const colors = ["red", "green", "blue", "fuchsia", "purple"];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.classList.add(`confetti-${randomColor}`);
            confetti.style.left = Math.random() * window.innerWidth + "px";
            container.appendChild(confetti);
            setTimeout(() => {
                confetti.remove();
            }, 3000); // Adjust the duration based on your preference
        }

        setInterval(createConfetti, 100); // Adjust the interval based on your preference

        setTimeout(() => {
            stopAnimation = true;
        }, 20000); // Stop animation after 20 seconds
    });
</script>
