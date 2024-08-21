<div class="flex flex-col justify-center items-center">
    @php
    $imagePath = public_path($image);
    @endphp
    <style type="text/css">
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
    </style>
    <div class="w-[1200px] lg:mt-10 p-2 lg:p-0">
        @livewire('buy-modal', ['initialNumbersArray' => $numbersArray, 'raffleId' => $this->raffleId])
        <!-- Seção Principal -->
        @if($is_raffle_active == null)
        <section class="box p-4 lg:p-12 mt-6">
            <div class="text-center">
                <p class="text-lg font-semibold">O sorteio não foi encontrado ou já foi concluído.</p>
            </div>
        </section>
        @else
        <section>
            <div class="box p-4 lg:p-12">
                <div class="flex gap-2 mb-4 lg:mb-8">
                    <div class="bg-primary rounded-full w-[5px] h-[35px] mr-1"></div>
                    <h1 class='text-[25px] font-semibold text-primary'>{{ $name }} </h1>
                </div>
                <div class="grid lg:grid-cols-6 gap-4">
                    <div class="lg:col-span-4">
                        <div class="flex flex-col gap-4">
                            @if (!is_null($image))
                            <img src="{{ asset($image) }}" class="max-w-full h-auto rounded-lg">
                            @else
                            <img src="https://igp.rs.gov.br/themes/modelo-noticias/images/outros/GD_imgSemImagem.png"
                                class="max-w-full h-auto rounded-lg">
                            @endif
                        </div>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="flex flex-col gap-4 w-full">
                            <div class="bg-light-purple p-8 text-center rounded-lg">
                                <p class="text-primary text-sm">Valor do bilhete</p>
                                <p class="text-primary text-3xl font-semibold">{{ $item['valor'] }}</p>
                            </div>
                            <div class="hidden md:block">
                                <div class="flex flex-col gap-4">
                                    @if($show_draw_date)
                                    <p class="font-semibold text-primary">
                                        Sorteio: {{ $draw_date }}
                                        @if($draw_hour !== null && $draw_hour !== '') às {{ $draw_hour }}
                                        @endif
                                    </p>
                                    @endif
                                    <p class="font-semibold text-primary">
                                        Comprando você concorre:
                                    </p>
                                    <!-- Prêmio principal do sorteio -->
                                    <a href="#premios-principais">
                                        <div
                                            class="flex gap-4 border border-1 border-primary p-2 text-center rounded-lg">
                                            <div class="grid items-center bg-light-purple rounded w-[40px] h-[40px]">
                                                <!-- <img class="w-8 h-8 mx-auto"
                                                    src="https://flypmoney.com/wp-content/uploads/2021/10/WHEEL_400x400_SHORT_CLIP.gif">-->
                                            </div>
                                            <div class="text-left grid items-center text-primary">
                                                <p class="text-[10px] uppercase font-semibold">Prêmio Principal do
                                                    Sorteio:
                                                </p>
                                                <p class="text-sm font-black">{{ $item['premio'] }}</p>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- Prêmio 1 do Top Compradores da Rifa -->
                                    @if($showTopPrizes)
                                    <a href="#premios-top-3-compradores">
                                        <div
                                            class="flex gap-4 border border-1 border-primary p-2 text-center rounded-lg">
                                            <div class="bg-light-purple rounded w-[40px] h-[40px]">
                                                <img class="w-8 h-8 mx-auto"
                                                    src="https://images.emojiterra.com/google/noto-emoji/unicode-15/animated/1f525.gif">
                                            </div>
                                            <div class="text-left grid items-center text-primary">
                                                <p class="text-[10px] uppercase font-semibold">Prêmio Principal Top
                                                    Comprador: </p>
                                                <p class="text-sm font-black">{{$prizes_top_3['prize_1']}}</p>
                                            </div>
                                        </div>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="teste my-6">
                    <p class="text-sm">{{ $description }}</p>
                </div>
                <div class="compras">
                </div>
            </div>
        </section>
        <!-- Seção Reserva de Números -->
        <section>
            <div class="box p-4 lg:p-12 mt-6">
                <div class="text-center">
                    @if(!$disable_manual_number_selection)
                    <div class="grid grid-cols-4 gap-2">
                        <div
                            class="w-full mx-0.5 bg-light-purple text-primary p-2 flex justify-center items-center rounded">
                            <p class="text-[11px] md:text-xs text-center"><b>Total de Números:</b><br>
                                <span class="text-xs font-bold">{{count($numbersArray)}}</span>
                            </p>
                        </div>
                        <div
                            class="w-full mx-0.5 bg-light-purple text-primary p-2 flex justify-center items-center rounded">
                            <p class="text-[11px] md:text-xs text-center"><b>Disponíveis: </b><br>
                                <span>{{$availableCount}}</span>
                            </p>
                        </div>
                        <div
                            class="w-full mx-0.5 bg-light-purple text-primary p-2 flex justify-center items-center rounded">
                            <p class="text-[11px] md:text-xs text-center"><b>Reservados:</b><br>
                                <span class="text-xs font-bold">{{$reservedCount}}</span>
                            </p>
                        </div>
                        <div
                            class="w-full mx-0.5 bg-light-purple text-primary p-2 flex justify-center items-center rounded">
                            <p class="text-[11px] md:text-xs text-center"><b>Comprados: </b><br>
                                <span>{{$paidCount}}</span>
                            </p>
                        </div>
                    </div>
                    @endif
                    @if($availableCount <= 0) <div class="my-6 mx-auto justify-center">
                        <p class="text-lg font-semibold mt-4">Números Esgotados</p>
                        <p class="text-xs">No momento não há mais números disponíveis para compra!</p>
                        <div class="my-4 mx-auto justify-center">
                            <p>Fique atento para a possível liberação de novos números ou aguarde o sorteio, programado
                                para {{$draw_date}}.</p>
                            <p>O sorteio está agendado para {{$draw_date}} em {{$draw_location}}.</p>
                        </div>
                </div>
                @else
                <p class="text-lg font-semibold mt-4">Quantos bilhetes você deseja?</p>
                <p class="text-xs">Você pode escolher no mínimo {{$min_number_purchase}} número(s) e no máximo
                    {{$max_number_purchase}} número(s) por compra:</p>

                <div class="opcoes-manuais w-1/2 my-2 md:my-4 mx-auto flex justify-center gap-4">
                    {{-- <button
                        class="h-[40px] w-[40px] border border-1 border-primary hover:bg-primary text-primary hover:text-secondary font-bold rounded-lg text-center"
                        onclick="decreaseQuantity(0)">-
                    </button>  --}}
                    <div class="flex flex-col gap-4 justify-center item-center md:flex-row">
                        <div class="border-b-2 h-fit border-b-primary">
                            <input type="number" id="quantityInput0"
                                class="min-w-auto border-none rounded-md text-center text-primary" value="0"
                                onkeyup="handleQuantityInput(event)">
                        </div>
                        <button type="button" onclick="handleButtonClick()"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                            Selecionar Números
                        </button>
                    </div>
                    {{-- <button
                        class="h-[40px] w-[40px]  border border-1 border-primary hover:bg-primary text-primary hover:text-secondary font-bold rounded-lg text-center"
                        onclick="increaseQuantity(0)">+</button> --}}
                </div>
                @if ($auto_number_selection)
                <div class="opcoes-rapidas flex justify-between gap-6 md:w-1/2 my-4 mx-auto">
                    <button
                        class="mt-4 text-sm tracking-wider h-full w-full px-2 lg:px-4 py-3 border border-1 border-primary hover:bg-primary text-primary hover:text-secondary font-bold rounded-lg auto-buy-btn"
                        data-value="{{ $auto_buy_option_one }}">+ {{ $auto_buy_option_one }} bilhetes</button>
                    <button
                        class="mt-4 text-sm tracking-wider h-full w-full px-2 lg:px-4 py-3 border border-1 border-primary hover:bg-primary text-primary hover:text-secondary font-bold rounded-lg auto-buy-btn"
                        data-value="{{ $auto_buy_option_two }}">+ {{ $auto_buy_option_two }} bilhetes</button>
                    <button
                        class="mt-4 text-sm tracking-wider h-full w-full px-2 lg:px-4 py-3 border border-1 border-primary hover:bg-primary text-primary hover:text-secondary font-bold rounded-lg auto-buy-btn"
                        data-value="{{ $auto_buy_option_three }}">+ {{ $auto_buy_option_three }} bilhetes</button>
                </div>
                @endif
                @endif
            </div>
        </section>
        <!-- Seção Prêmios Principais -->
        <section id="premios-principais" class="box p-4 lg:p-12 mt-6">
            <div class="text-center mb-4">
                <p class="text-lg font-semibold">Prêmio(s) Principai(s) do Sorteio</p>
                <p class="text-xs">Os prêmios mais incríveis que você pode ganhar no sorteio!</p>
            </div>
            @php $contador = 1; @endphp
            @foreach ($mainPrizes as $key => $prize)
            @if (!empty(trim($prize)))
            <div class="flex gap-4 border border-1 border-primary p-2 text-center rounded-lg mt-2">
                <div class="bg-light-purple rounded w-[40px] h-[40px]">
                    <img class="w-8 h-8 mx-auto"
                        src="https://images.emojiterra.com/google/noto-emoji/unicode-15/animated/1f525.gif">
                </div>
                <div class="text-left grid items-center text-primary">
                    <p class="text-[10px] uppercase font-semibold"> {{ $contador }}º Prêmio:</p>
                    <p class="text-sm font-black">{{ $prize }}</p>
                </div>
            </div>
            @php $contador++; @endphp
            @endif
            @endforeach
        </section>
        <!-- Seção Prêmios Top 3 Compradores -->
        @if($showTopPrizes)
        <section id="premios-top-3-compradores" class="box p-4 lg:p-12 mt-6">
            <div class="text-center mb-4">
                <p class="text-lg font-semibold">Prêmio dos Top Compradores</p>
                <p class="text-xs">Uma recompensa especial para os três maiores compradores da do Título!</p>
            </div>
            @php $contTador = 1; @endphp
            @foreach ($prizes_top_3 as $prize_top_3)
            <div class="flex gap-4 border border-1 border-primary p-2 text-center rounded-lg mt-2">
                <div class="bg-light-purple rounded w-[40px] h-[40px]">
                    <img class="w-8 h-8 mx-auto"
                        src="https://images.emojiterra.com/google/noto-emoji/unicode-15/animated/1f525.gif">
                </div>
                <div class="text-left grid items-center text-primary">
                    <p class="text-[10px] uppercase font-semibold">Prêmio Top {{ $contador }}º
                        Comprador: </p>
                    <p class="text-sm font-black">{{$prize_top_3}}</p>
                </div>
            </div>
            @php $contador++; @endphp
            @endforeach
        </section>
        @endif
        <!-- Seção Ranking dos Top 3 Compradores -->
        @if($showTopBuyers)
        <section class="box p-4 lg:p-12 mt-6">
            <div class="text-center mb-4">
                <p class="text-lg font-semibold">Ranking das pessoas que mais compraram cotas</p>
                <p class="text-xs">Veja quem são os maiores compradores da rifa!</p>
            </div>
            @if($topBuyers->count() > 0)
            @php $contador = 1; @endphp
            @foreach ($topBuyers as $topBuyer)
            <div class="flex gap-4 border border-1 border-primary p-2 text-center rounded-lg mt-2">
                <div class="bg-light-purple rounded w-[40px] h-[40px]">
                    <img class="w-8 h-8 mx-auto"
                        src="https://images.emojiterra.com/google/noto-emoji/unicode-15/animated/1f525.gif">
                </div>
                <div class="text-left grid items-center text-primary">
                    <p class="text-[10px] uppercase font-semibold">Top {{ $contador }}º Comprador:</p>
                    <p class="text-sm font-black">{{ $topBuyer->user->name }}</p>
                </div>
            </div>
            @php $contador++; @endphp
            @endforeach
            @else
            <p class="text-sm text-center"> Ainda não temos os Top Compradores.</p>
            @endif
        </section>
        @endif
        <!-- Grid Seleção de Números -->
        @if (!$disable_manual_number_selection)
        <section class="box p-8 lg:p-12 mt-6">
            <div class="flex flex-col">
                <div class="text-center">
                    <p class="text-lg font-semibold">Selecione abaixo seus bilhetes</p>
                    <p class="text-xs">Escolha suas opções abaixo ou deixe a sorte decidir por você:</p>
                </div>
                <div class="mt-4">
                    @if ($show_remaining_numbers)
                    <div>
                        <div class="filters grid lg:grid-cols-5 gap-2 my-6 items-center">
                            <ul class="lg:col-span-3 grid grid-cols-2 lg:grid-cols-3 gap-2" data-filter="status_order">
                                {{-- <li
                                    class=" lg:block p-2 border-[1px] rounded flex justify-between text-sm font-semibold">
                                    Todos
                                    <span class="border rounded text-white p-px border-transparent bg-black text-xs">{{
                                        $availableCount + $reservedCount + $paidCount}}</span>
                                </li> --}}
                                <li class="p-2 border-[1px] rounded flex justify-between text-sm font-semibold">
                                    Disponíveis
                                    <span class="border rounded text-white p-px border-transparent bg-black text-xs">{{
                                        $availableCount }}</span>
                                </li>
                                <li class="p-2 border-[1px] rounded flex justify-between text-sm font-semibold">
                                    Reservados
                                    <span
                                        class="border rounded text-white p-px border-transparent bg-amber-400 text-xs">{{
                                        $reservedCount }}</span>
                                </li>
                                <li class="p-2 border-[1px] rounded flex justify-between text-sm font-semibold">
                                    Comprados
                                    <span
                                        class="border rounded text-white p-px border-transparent bg-[#d03939] text-xs">{{
                                        $paidCount }}</span>
                                </li>
                            </ul>
                            <div class="col-span-2 input-group flex items-center">
                                <input type="number"
                                    class="w-full form-control border-1 border-gray-200 bg-gray-100 rounded text-sm"
                                    id="search-input" placeholder="Pesquise por um número">
                            </div>
                        </div>
                    </div>
                    @endif
                    <ul class="list-unstyled flex flex-wrap mb-0">
                        @foreach ($numbersArray as $number => $status)
                        @if ($status === 'reserved')
                        <li id="number-{{ $number }}"
                            class="text-white w-[69px] min-w-[69px] max-h-[50px] border border-transparent rounded-md mt-2 mx-1 p-3 bg-amber-400">
                            <a href="#" class="btn text-dark-grey reserved text-sm" data-toggle="tooltip"
                                title="Número {{ $number }} Reservado" data-price="20">
                                {{ sprintf('%03d', $number) }}
                            </a>
                        </li>
                        @elseif ($status === 'paid')
                        <li id="number-{{ $number }}"
                            class="text-white w-[69px] min-w-[69px] max-h-[50px] border border-transparent rounded-md mt-2 mx-1 p-3 bg-[#d03939]">
                            <a href="#" class="btn text-dark-grey paid text-sm" data-toggle="tooltip"
                                title="Número {{ $number }} Comprado" data-price="20">
                                {{ sprintf('%03d', $number) }}
                            </a>
                        </li>
                        @else
                        <li id="number-{{ $number }}"
                            class="text-[#6c757d] w-[69px] min-w-[69px] max-h-[50px] border-solid border-gray-400 border-[2px] rounded-md mt-2 mx-1 p-3 bg-white cursor-pointer text-center"
                            onclick="selectNumber('{{ $number }}');" title="Número {{ $number }} Disponível"
                            data-price="20">
                            {{ sprintf('%03d', $number) }}
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
        @endif
        <!-- Faq -->
        @if (count($faqs) > 0)
        <section id="faq" class="box p-4 lg:p-12 mt-6">
            <div class="text-center">
                <p class="text-lg font-semibold">Perguntas e Respostas</p>
                <p class="text-xs">Tire suas dúvidas frequentes abaixo:</p>
            </div>
            <div class="grid gap-3 mt-6">
                @foreach ($faqs as $index => $faq)
                <div id="accordion-collapse-{{ $index }}" class="p-0.5 border rounded-xl" data-accordion="collapse">
                    <h2 id="accordion-collapse-heading-{{ $index }}">
                        <button type="button"
                            class="flex items-center justify-start w-full p-5 font-medium gap-3 text-gray-900"
                            data-accordion-target="#accordion-collapse-body-{{ $index }}" aria-expanded="false"
                            aria-controls="accordion-collapse-body-{{ $index }}">
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                            <span>{{ $faq->question }}</span>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-{{ $index }}" class="hidden"
                        aria-labelledby="accordion-collapse-heading-{{ $index }}">
                        <div class="p-5">
                            <p class="card-text text-left">
                                {{ $faq->answer }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
        <!-- Footer Comprar -->
        <section class="w-full bg-[url('/imgs/wins-texture.png')] bg-[#8224E3] bg-cover bg-no-repeat">
            <div id="footerTap"
                class="fixed inset-x-0 bottom-0 bg-purple-700 p-4 flex justify-between items-center text-white z-20 flex-col md:flex-row"
                style="display: none;">
                <div class="flex items-center">
                    @if(!$disable_manual_number_selection)
                    <span class="mr-4 font-bold">Número(s) selecionados:</span>
                    <div id="selectedNumbers" class="flex items-center">
                    </div>
                    @else
                    <div id="selectedNumbers" class="flex items-center">
                        <span> Números só serão apresentados pós pagamento.</span>
                    </div>
                    @endif
                </div>
                <div class="flex items-center">
                    <!-- Movida esta div para a direita -->
                    <span id="selectedCount" class="font-bold mr-4">Selecionados: 0</span>
                    <span id="totalPrice" class="font-bold mr-4">Total: R$ 0,00</span>
                    <button id="buyButton"
                        class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 px-6 rounded transition duration-300">
                        Comprar
                    </button>
                </div> <!-- Fim da div que foi movida -->
            </div>
        </section>
    </div>
    @endif
    {{-- @push('scripts') --}}
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');

        function selectTab(tab) {
            tabs.forEach(t => {
                t.classList.remove('bg-[#f04e2330]', 'text-[#f04e23]');
                t.classList.add('bg-gray-100');
            });
            tab.classList.remove('bg-gray-100');
            tab.classList.add('bg-[#f04e2330]', 'text-[#f04e23]');

            const target = tab.dataset.target;
            tabContents.forEach(tc => {
                if (tc.getAttribute('id') === target) {
                    tc.classList.remove('hidden');
                } else {
                    tc.classList.add('hidden');
                }
            });
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', () => selectTab(tab));
        });

        // Inicia com a aba 1 selecionada
        selectTab(tabs[0]);
    });
    </script>
    <script>
    // Embed the PHP array into JavaScript
    var numbersArray = @json($numbersArray);
    var disableManualNumberSelection = {
        {
            $disable_manual_number_selection ? 'true' : 'false'
        }
    };
    </script>
    <script>
    var maxNumberPurchase = @json($max_number_purchase);
    var pricePerNumber = @json($price_per_number);


    function updateFooter() {
        var footerTap = document.getElementById('footerTap');
        var quantityInput = document.getElementById('quantityInput0');
        var totalPriceElement = document.getElementById('totalPrice');
        var selectedCountElement = document.getElementById('selectedCount');

        var quantity = parseInt(quantityInput.value) || 0;
        var totalPrice = quantity *
            pricePerNumber; // Assume pricePerNumber is defined globally or retrieved from the dataset

        if (quantity > 0) {
            footerTap.style.display = 'flex'; // Show the footer if it's not already visible
            selectedCountElement.textContent = 'Selecionados: ' + quantity;
            totalPriceElement.textContent = 'Total: R$ ' + totalPrice.toFixed(2).replace('.', ',');
        } else {
            footerTap.style.display = 'none'; // Hide the footer if no numbers are selected
        }
    }
    </script>
    <script>
    function addSelectedNumber(specificNumber = null) {
        // Find an available number if no specific number is provided
        var numberToAdd = specificNumber;
        if (!numberToAdd) {
            var availableNumbers = Object.keys(numbersArray).filter(number => numbersArray[number] === 'free');
            if (availableNumbers.length > 0) {
                var randomIndex = Math.floor(Math.random() * availableNumbers.length);
                numberToAdd = availableNumbers[randomIndex];
            } else {
                console.error('No available numbers.');
                return; // No available numbers to add
            }
        }

        // Check if the specific number is available
        if (specificNumber && numbersArray[specificNumber] !== 'free') {
            console.error('Number is not available.');
            return; // The specific number is not available
        }

        // Add the number to the selected numbers display
        var selectedNumbersContainer = document.getElementById('selectedNumbers');
        var numberDiv = document.createElement('div');
        numberDiv.className = 'bg-yellow-300 text-black font-bold py-1 px-3 rounded-full mx-1';
        if (disableManualNumberSelection) {
            numberDiv.classList.add('hidden');
        }
        numberDiv.textContent = numberToAdd;
        numberDiv.setAttribute('data-number', numberToAdd.toString());
        numberDiv.textContent = numberToAdd.toString();
        selectedNumbersContainer.appendChild(numberDiv);

        // Update the numbersArray to mark this number as 'selected'
        numbersArray[numberToAdd] = 'selected';

        var numberElement = document.getElementById('number-' + numberToAdd);
        if (numberElement) {
            // Update the classes to reflect the selected state
            numberElement.classList.remove('bg-white', 'border-gray-400', 'text-[#6c757d]');
            numberElement.classList.add('bg-green-600', 'text-white');
        }

        // Call any other functions necessary to update the state of your application
        updateFooter();
    }

    function removeSelectedNumber(numberToRemove = null) {
        // If no specific number is provided, pick a random 'selected' number to remove
        if (numberToRemove === null) {
            var selectedNumbers = Object.keys(numbersArray).filter(number => numbersArray[number] === 'selected');
            if (selectedNumbers.length === 0) {
                console.error('No selected numbers to remove.');
                return; // No selected numbers to remove
            }
            var randomIndex = Math.floor(Math.random() * selectedNumbers.length);
            numberToRemove = selectedNumbers[randomIndex];
        }

        // Check if the number to remove is marked as 'selected'
        if (numbersArray[numberToRemove] !== 'selected') {
            console.error('Number is not selected or already removed.');
            return; // The number is not selected or already removed
        }

        // Proceed to remove the number
        var selectedNumbersContainer = document.getElementById('selectedNumbers');
        var numberDiv = selectedNumbersContainer.querySelector(`div[data-number="${numberToRemove}"]`);
        if (numberDiv) {
            selectedNumbersContainer.removeChild(numberDiv);
            numbersArray[numberToRemove] = 'free'; // Update the array to mark the number as 'free'
            var numberElement = document.getElementById('number-' + numberToRemove);
            if (numberElement) {
                // Update the classes to reflect the free state
                numberElement.classList.add('bg-white', 'border-gray-400', 'text-[#6c757d]');
                numberElement.classList.remove('bg-green-600', 'text-white');
            }

            updateFooter(); // Call any other functions necessary to update the state of your application
        } else {
            console.error('Number element to remove was not found.');
        }
    }
    </script>

    <script>
    var maxNumberPurchase = @json($max_number_purchase);
    var minNumberPurchase = @json($min_number_purchase);

    var availableCount = @json($availableCount);

    var alertShown = false;

    function increaseQuantity(index) {
        var input = document.getElementById("quantityInput" + index);
        var newValue = parseInt(input.value) + 1;
        if (newValue > maxNumberPurchase && !alertShown) {
            alert("Aviso!\nVocê só pode selecionar no máximo " + maxNumberPurchase + " número(s)");
            alertShown = true;
        } else if (newValue > availableCount && !alertShown) {
            alert("Aviso!\nVocê já selecionou todos os " + availableCount + " número(s) disponívei(s).");
            alertShown = true;
        } else if (newValue <= maxNumberPurchase && newValue <=
            availableCount) { // Verifica se o novo valor não excede o limite máximo
            input.value = newValue;
            addSelectedNumber();
            updateFooter();
        }
    }

    function handleQuantityInput(event) {
        var input = document.getElementById("quantityInput0"); // Seleciona o elemento de entrada
        if (event.key === 'Enter') {
            var newValue = parseInt(event.target.value);
            console.log(newValue);
            if (!isNaN(newValue)) {
                if (newValue <= maxNumberPurchase && newValue <= availableCount) {
                    clearSelectedNumbers(); // Limpa os números selecionados anteriormente
                    for (let i = 0; i < newValue; i++) {
                        addSelectedNumber(); // Adiciona um número a cada iteração do loop
                    }
                    updateFooter();
                } else {
                    alert("Aviso!\nVocê pode selecionar no máximo " + maxNumberPurchase +
                        " número(s) ou a quantidade disponível de " + availableCount + " número(s).");
                }
            }
        }
    }

    function handleButtonClick() {
        var input = document.getElementById("quantityInput0");
        var newValue = parseInt(input.value);
        console.log(newValue);
        if (!isNaN(newValue)) {
            if (newValue <= maxNumberPurchase && newValue <= availableCount) {
                clearSelectedNumbers(); // Limpa os números selecionados anteriormente
                for (let i = 0; i < newValue; i++) {
                    addSelectedNumber(); // Adiciona um número a cada iteração do loop
                }
                updateFooter();
            } else {
                alert("Aviso!\nVocê pode selecionar no máximo " + maxNumberPurchase +
                    " número(s) ou a quantidade disponível de " + availableCount + " número(s).");
            }
        }
    }

    function clearSelectedNumbers() {
        var selectedNumbersContainer = document.getElementById('selectedNumbers');
        selectedNumbersContainer.innerHTML = ''; // Remove todos os números selecionados
        // Reinicia o array de números selecionados
        Object.keys(numbersArray).forEach(key => {
            if (numbersArray[key] === 'selected') {
                removeSelectedNumber(key); // Remove o número selecionado do array
            }
        });
        // Remove visualmente os números do grid
        var numberElements = document.querySelectorAll('.selected-number');
        numberElements.forEach(element => {
            console.log(element);
            element.remove();
        });
    }

    function decreaseQuantity(index) {
        var input = document.getElementById("quantityInput" + index);
        var currentValue = parseInt(input.value);

        // Verifica se há pelo menos um número selecionado
        if (currentValue > 0) {
            input.value = currentValue - 1;
            removeSelectedNumber();
            updateFooter();
        }
    }
    </script>
    <script>
    function addToSelectedNumbersDisplay(number) {
        var selectedNumbersContainer = document.getElementById('selectedNumbers'); // Make sure you have this container
        var numberDiv = document.createElement('div');
        numberDiv.className = 'bg-yellow-300 text-black font-bold py-1 px-3 rounded-full mx-1';
        if (disableManualNumberSelection) {
            numberDiv.classList.add('hidden');
        }
        numberDiv.textContent = number;
        numberDiv.setAttribute('data-number', number.toString());
        selectedNumbersContainer.appendChild(numberDiv);
    }

    function removeFromSelectedNumbersDisplay(number) {
        var selectedNumbersContainer = document.getElementById(
            'selectedNumbers'); // Assuming this is your container's ID
        if (!selectedNumbersContainer) return; // Exit if container not found

        // Find the element representing the number to remove
        var numberElement = selectedNumbersContainer.querySelector(`[data-number="${number}"]`);

        if (numberElement) {
            // Remove the element from the container
            selectedNumbersContainer.removeChild(numberElement);
        }
    }


    function selectNumber(number) {
        var liElement = document.getElementById('number-' + number);
        var quantityInput = document.getElementById('quantityInput0');
        var currentQuantity = parseInt(quantityInput.value) || 0;

        // Toggle selection off if the number is already selected
        if (numbersArray[number] === 'selected') {
            numbersArray[number] = 'free'; // Mark the number as free again
            liElement.classList.add('bg-white', 'text-[#6c757d]');
            liElement.classList.remove('bg-green-600', 'text-white');
            quantityInput.value = currentQuantity - 1; // Decrement the quantity
            removeFromSelectedNumbersDisplay(number); // Optionally remove from the visual display
        } else if (numbersArray[number] === 'free') {
            if (currentQuantity >= maxNumberPurchase) {
                alert("Aviso!\nVocê só pode selecionar no máximo " + maxNumberPurchase + " números");
                return; // Early return if the new quantity would exceed the max allowed
            }

            numbersArray[number] = 'selected'; // Mark the number as selected
            liElement.classList.remove('bg-white', 'text-[#6c757d]');
            liElement.classList.add('bg-green-600', 'text-white');
            quantityInput.value = currentQuantity + 1; // Increment the quantity
            addToSelectedNumbersDisplay(number); // Optionally add to the visual display
        } else {
            console.error('Number is not available.');
            return;
        }

        updateFooter(); // Update the footer with the new quantity and total price
    }

    // Rest of the functions: updateFooter, addToSelectedNumbersDisplay, etc.
    </script>
    <script>
    var maxNumberPurchase = @json($max_number_purchase);

    document.addEventListener('DOMContentLoaded', function() {
        var autoBuyButtons = document.querySelectorAll('.auto-buy-btn');

        autoBuyButtons.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var valueToAdd = parseInt(this.dataset.value);
                // var input = document.getElementById(
                //     "quantityInput0"); // Substitua com o ID real do seu input de quantidade
                // var currentValue = parseInt(input.value);
                // var newValue = currentValue + valueToAdd;

                // if (newValue > maxNumberPurchase) {
                //     alert("Aviso!\nVocê só pode selecionar no máximo " + maxNumberPurchase +
                //         " números");
                // } else {
                //     //input.value = newValue;
                //     console.log(valueToAdd);

                //     updateFooter();
                // }

                for (let index = 1; index <= valueToAdd; index++) {
                    increaseQuantity(0)

                }
            });
        });
    });

    // document.addEventListener('DOMContentLoaded', function() {
    //     var autoBuyButtons = document.querySelectorAll('.auto-buy-btn');

    //     autoBuyButtons.forEach(function(btn) {
    //         btn.addEventListener('click', function() {
    //             var valueToAdd = parseInt(this.dataset.value);
    //             var input = document.getElementById("quantityInput0");
    //             var currentValue = parseInt(input.value) || 0;
    //             var newValue = currentValue + valueToAdd;

    //             if (newValue > maxNumberPurchase) {
    //                 alert("Aviso!\nVocê só pode selecionar no máximo " + maxNumberPurchase +
    //                     " números");
    //             } else {
    //                 input.value = newValue;
    //             }
    //             updateFooter(); // Call updateFooter whenever the quantity changes
    //         });
    //     });
    // });
    </script>
    <script>
    // Function to show the modal
    function openModal() {
        document.getElementById('purchaseModal').classList.remove('hidden');
        document.getElementById('modalContent').classList.remove('hidden');
        populateSelectedNumbersModal();
    }

    // Function to close the modal
    function closeModal() {
        document.getElementById('purchaseModal').classList.add('hidden');
        document.getElementById('modalContent').classList.add('hidden');
    }

    // Function to confirm the purchase (you will need to implement this)
    function confirmPurchase() {
        // Implement the logic to handle the purchase confirmation
        console.log('Purchase confirmed');
        closeModal();
    }

    // Function to populate selected numbers in the modal
    function populateSelectedNumbersModal() {
        var selectedNumbersContainer = document.getElementById('selectedNumbers'); // Your container of selected numbers
        var selectedNumbersModal = document.getElementById('selectedNumbersModal');
        selectedNumbersModal.innerHTML = selectedNumbersContainer.innerHTML; // Copy the selected numbers into the modal
    }

    // Attach the openModal function to the Comprar button
    document.getElementById('buyButton').addEventListener('click', openModal);
    </script>
    <script>
    document.addEventListener('livewire:load', function() {
        // Listening for the purchaseConfirmed event
        window.livewire.on('purchaseConfirmed', () => {
            // Code to close the modal
            closeModal();
        });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');

        // Adiciona o evento de pressionar tecla para o campo de pesquisa
        searchInput.addEventListener('keyup', function(event) {
            // Verifica se a tecla pressionada é "Enter"
            if (event.key === 'Enter') {
                const searchTerm = searchInput.value.trim();

                // Verifica se o campo de pesquisa não está vazio
                if (searchTerm !== '') {
                    // Limpa a formatação anterior
                    resetSearchResults();

                    // Encontra os números que correspondem ao termo de pesquisa
                    const numbers = document.querySelectorAll('[id^="number-"]');
                    numbers.forEach(function(number) {
                        const numberText = number.textContent.trim();
                        if (numberText.includes(searchTerm)) {
                            number.style.display =
                                'block'; // Exibe o número se corresponder à pesquisa
                        } else {
                            number.style.display =
                                'none'; // Oculta o número se não corresponder à pesquisa
                        }
                    });
                }
            }
        });

        // Adiciona o evento de limpar resultados ao apagar o conteúdo do campo de pesquisa
        searchInput.addEventListener('input', function() {
            // Verifica se o campo de pesquisa está vazio
            if (searchInput.value.trim() === '') {
                // Limpa a formatação anterior
                resetSearchResults();
            }
        });

        // Função para limpar a formatação da pesquisa anterior
        function resetSearchResults() {
            const numbers = document.querySelectorAll('[id^="number-"]');
            numbers.forEach(function(number) {
                number.style.display = 'block'; // Exibe todos os números novamente
            });
        }
    });
    </script>
    {{-- @endpush --}}
</div>
</div>

{{-- <div class="flex flex-col">
    <div class="text-center">
        <p class="text-lg font-semibold">Quantos bilhetes você deseja?</p>
        <p class="text-xs">Selecione as opções rápidas ou a quantidade exata abaixo:</p>
    </div>
    <div class="gap-2 mt-8">
        <div class="items-center">
            <div class="grid grid-cols-3 gap-4">
                <div
                    class="flex flex-col justify-center items-center border-[1px] border-primary rounded-md p-2 lg:py-5 gap-3">
                    <input
                        class="text-center h-12 w-full px-0 lg:px-4 py-3 border-0 bg-gray-100 text-primary text-4xl font-bold rounded"
                        type="text" value="{{ $auto_buy_option_one }}" readonly="">
<button
    class="mt-4 text-sm tracking-wider h-full w-full px-2 lg:px-4 py-3 bg-primary text-secondary font-bold rounded-lg auto-buy-btn"
    data-value="{{ $auto_buy_option_one }}">Adicionar</button>
</div>
<div class="flex flex-col justify-center items-center border-[1px] border-primary rounded-md p-2 lg:p-5 gap-3">
    <input
        class="text-center h-12 w-full px-0 lg:px-4 py-3 border-0 bg-gray-100 text-primary text-4xl font-bold rounded"
        type="text" value="{{ $auto_buy_option_two }}" readonly="">
    <button
        class="mt-4 text-sm tracking-wider h-full w-full px-2 lg:px-4 py-3 bg-primary text-secondary font-bold rounded-lg auto-buy-btn"
        data-value="{{ $auto_buy_option_two }}">Adicionar</button>
</div>
<div class="flex flex-col justify-center items-center border-[1px] border-primary rounded-md p-2 lg:py-5 gap-3">
    <input
        class="text-center h-12 w-full px-0 lg:px-4 py-3 border-0 bg-gray-100 text-primary text-4xl font-bold rounded"
        type="text" value="{{ $auto_buy_option_three }}" readonly="">
    <button
        class="mt-4 text-sm tracking-wider h-full w-full px-2 lg:px-4 py-3 bg-primary text-secondary font-bold rounded-lg auto-buy-btn"
        data-value="{{ $auto_buy_option_three }}">Adicionar</button>
</div>
</div>
</div>
<div class="flex justify-center items-center gap-2 mt-8 w-[30%] mx-auto">
    <button class="h-[54px] min-w-[70px] w-[70px] px-4 bg-primary text-secondary text-3xl font-bold rounded"
        onclick="decreaseQuantity(0)">-</button>
    <input type="number" id="quantityInput0"
        class="text-[30px] min-w-auto border-[1px] border-primary rounded-md text-center text-primary" value="0">
    <button class="h-[54px] min-w-[70px] w-[70px] px-4 bg-primary text-secondary text-3xl font-bold rounded"
        onclick="increaseQuantity(0)">+</button>
</div>
</div>
</div> --}}

{{-- tabs laranjas --}}
{{-- <section class="box p-4 lg:p-12 mt-6">
    <div class="flex flex-col">
        <div class="grid grid-cols-2 lg:flex gap-4">
            <div data-target="description"
                class="tab cursor-pointer bg-[#f04e2330] text-[#f04e23] rounded-md p-3 text-sm font-medium flex gap-1"
                aria-current="page">
                <svg class="w-5 h-5" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z">
                    </path>
                </svg>
                Sobre a campanha
            </div>
            <div data-target="promos"
                class="tab cursor-pointer bg-gray-100 text-gray-600 rounded-md p-3 text-sm font-medium flex gap-1"
                aria-current="page">
                <svg class="w-5 h-5" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m9 14.25 6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185ZM9.75 9h.008v.008H9.75V9Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm4.125 4.5h.008v.008h-.008V13.5Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z">
                    </path>
                </svg>
                Promoções e Descontos
            </div>
            <div data-target="payment-methods"
                class="tab cursor-pointer bg-gray-100 text-gray-600 rounded-md p-3 text-sm font-medium flex gap-1"
                aria-current="page">
                <svg class="w-5 h-5" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z">
                    </path>
                </svg>
                Formas de Pagamento
            </div>
            <div data-target="details"
                class="tab cursor-pointer bg-gray-100 text-gray-600 rounded-md p-3 text-sm font-medium flex gap-1"
                aria-current="page">
                <svg class="w-5 h-5" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z">
                    </path>
                </svg>
                Outras informações
            </div>
        </div>
        <div class="pt-6">
            <div class="tab-content" id="description">
                <p class="text-sm">{{ $description }}</p>
</div>
<div class="tab-content hidden" id="promos">
    <div class="grid grid-cols-2 gap-4">
        <div class="relative rounded border border-1 p-6 text-center">
            <span
                class="absolute top-[-8px] right-[-8px] rounded-full w-fit px-1 bg-[#29bf63] text-white text-md">-X%</span>
            <p>Adquira X números e pague
            <p>
            <p class="text-xl font-semibold">R$ X,xx</p>
        </div>
        <div class="relative rounded border border-1 p-6 text-center">
            <span
                class="absolute top-[-8px] right-[-8px] rounded-full w-fit px-1 bg-[#29bf63] text-white text-md">-X%</span>
            <p>Adquira X números e pague
            <p>
            <p class="text-xl font-semibold">R$ X,xx</p>
        </div>
    </div>
</div>
<div class="tab-content hidden" id="details">
    <table class="min-w-full divide-y divide-gray-300 rounded-lg">
        <tbody class="divide-y divide-gray-300 rounded-lg">
            <tr class="divide-x divide-gray-300">
                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 bg-gray-200">
                    Valor do bilhete:</td>
                <td class="whitespace-nowrap p-4 text-sm text-gray-500 bg-gray-100">
                    {{ $item['valor'] }}</td>
            </tr>
            <tr class="divide-x divide-gray-300">
                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 bg-gray-200">
                    Compra mínima:</td>
                <td class="whitespace-nowrap p-4 text-sm text-gray-500 bg-gray-100">
                    {{ $min_number_purchase }}</td>
            </tr>
            <tr class="divide-x divide-gray-300">
                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 bg-gray-200">
                    Compra máxima:</td>
                <td class="whitespace-nowrap p-4 text-sm text-gray-500 bg-gray-100">
                    {{ $max_number_purchase }}</td>
            </tr>
            <tr class="divide-x divide-gray-300">
                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 bg-gray-200">
                    Data de Início:</td>
                <td class="whitespace-nowrap p-4 text-sm text-gray-500 bg-gray-100">-</td>
            </tr>
            <tr class="divide-x divide-gray-300">
                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 bg-gray-200">
                    Data de Sorteio:</td>
                <td class="whitespace-nowrap p-4 text-sm text-gray-500 bg-gray-100">-</td>
            </tr>
            <tr class="divide-x divide-gray-300">
                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 bg-gray-200">
                    Métodos de Pagamento:</td>
                <td class="whitespace-nowrap p-4 text-sm text-gray-500 bg-gray-100">
                    @foreach ($bankAccounts as $bank)
                    <span>{{ Str::ucfirst($bank->payment_method) }} -
                        {{ Str::ucfirst($bank->bank_name) }} </span>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="tab-content hidden" id="payment-methods">
    <p class="text-sm">
        @foreach ($bankAccounts as $bank)
    <div class="card wow slideInUp border rounded-xl p-5 w-auto">
        <img src="{{ asset($bank->logo) }}" class="object-fill w-full h-[250px] m-h-full border-transparent rounded-xl">
        <div id="accordion-collapse-{{ $bank->id }}" class="p-0.5" data-accordion="collapse">
            <h2 id="accordion-collapse-heading-{{ $bank->id }}">
                <button type="button"
                    class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 gap-3 bg-white"
                    data-accordion-target="#accordion-collapse-body-{{ $bank->id }}" aria-expanded="false"
                    aria-controls="accordion-collapse-body-{{ $bank->id }}">
                    <span>{{ Str::ucfirst($bank->payment_method) }} -
                        {{ Str::ucfirst($bank->bank_name) }}</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-{{ $bank->id }}" class="hidden"
                aria-labelledby="accordion-collapse-heading-{{ $bank->id }}">
                <div class="p-5">
                    <p class="card-text">
                        <b>Chave Pix:</b>
                        <br>
                        {{ $bank->pix_key }}
                        <input type="text" id="pix_1639" class="form-control" value="00000000000"
                            style="opacity: 0; position: absolute;" readonly="">
                        <button class="btn btn-outline-secondary ml-2 p-1" type="button" data-chave="1639"
                            onclick="copyChavePix(this, 'pix_')">
                            <i class="fa fa-copy"></i>
                        </button>
                    </p>
                    <p class="card-text"><b>Tipo de Chave:</b> {{ $bank->key_type }}</p>
                    <p class="card-text"><b>Titular:</b>
                        {{ $bank->name_or_social_reason }}
                    </p>
                    <p class="card-text"><b>CPF/CNPJ:</b> {{ $bank->cpf_cnpj }}</p>
                    <p class="mb-0">
                    </p>
                    <div class="input-group mb-3">
                        <input type="text" id="copia-cola_1639"
                            class="form-control w-[95%] border-gray-400 rounded bg-gray-100"
                            value="{{ $bank->pix_key }}" readonly="">
                        <div class="input-group-append -mt-[41px] w-1/6 ml-[195px]">
                            <button class="btn btn-outline-secondary rounded-r bg-white p-3" type="button"
                                data-chave="1639" onclick="copyChavePix(this, 'copia-cola_')">
                                <i class="fa fa-copy text-black"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    </p>
</div>
</div>
</div>
</section> --}}

<!-- <h2 class="text-center font-bold p-3 rounded-t border border-gray-300 bg-gray-100 text-uppercase">
                                Informações do item
                                </h2>
                                <div class="rounded-b text-center mb-4 border border-gray-300 border-t-0 p-4 flex justify-between">
                                <p class="w-[150px]"><span class='font-bold'>Limite de números:</span>
                                    {{ $max_number_purchase }}
                                </p>
                                <p class="w-[150px]"><span class='font-bold'>Prêmio:</span> {{ $item['premio'] }}</p>
                                {{--
                                <p class="w-[150px]"><span class='font-bold'>Categoria:</span> {{ $item['categoria'] }}</p>
                                --}}
                                </div> -->

{{-- @foreach ($topBuyers as $index => $buyer)
@php
$medalImg = ['top1.png', 'top2.png', 'top3.png'][$index] ?? 'default.png';
@endphp
<div class="flex justify-between px-6 py-3 items-center rounded-lg border-[1px]">
    <div class="flex gap-4 items-center">
        <span class="text-2xl w-[30px]">{{ $index + 1 }}º</span>
<img class="h-[42px] mx-auto" src="https://123ganhei.com/wp-content/themes/wplottery3/img/{{ $medalImg }}" alt="">
<div class='flex flex-col text-left gap-1'>
    <span class="text-sm leading-[1] font-semibold capitalize">{{ $buyer->user->name
                }}</span>
    <span class="text-xs leading-[1]">{{ $buyer->total }} Bilhete(s)</span>
</div>
</div>
<div class="text-right">
    <p class="text-[10px] uppercase">Prêmio Top Comprador</p>
    <p class="font-bold">10.000 reais</p>
</div>
</div>
@endforeach --}}