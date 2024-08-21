<div>
    <style type="text/css">
        .popular:before {
            border-top-right-radius: 0 !important;
            border-top-left-radius: 0 !important;
            border-bottom-right-radius: 10px;
            border-bottom-left-radius: 10px;
            text-align: center;
            font-size: 12px;
            padding: 2px;
            width: 90px;
            top: 0px;
            content: "Por apenas";
            background-color: #198754;
            position: absolute;
            color: #fff;
            z-index: 2;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
        }

        .animated-shine:before {
            content: "";
            position: absolute;
            bottom: 0;
            width: 180px;
            height: 92px;
            background-image: radial-gradient(19.58% 37.96% at 16.68% 41.55%, hsla(0, 0%, 100%, .6) 0, hsla(0, 0%, 100%, 0) 100%);
            animation: flare-2 5s ease-in-out infinite;
            opacity: 0.5;
        }


        @keyframes flare-2 {
            0% {
                transform: translate(-30%) rotate(-45deg)
            }

            20% {
                transform: translate(140%) rotate(-45deg)
            }

            to {
                transform: translate(140%) rotate(-45deg)
            }

        }

        .pulse {
            animation: pulse 1s infinite alternate;
            /* Configura a animação */
            opacity: 1;
            /* Começa com 10% de opacidade */
        }

        @keyframes pulse {
            from {
                opacity: 0.3;
                /* Começa com 10% de opacidade */
            }

            to {
                opacity: 1;
                /* Termina com 100% de opacidade */
            }
        }

        .swiper {
            z-index: 0 !important;
        }

        .swiper,
        .swiper-wrapper {
            z-index: 0 !important;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #FFD700;
        }
    </style>
    <div class="min-h-[calc(100% - 400px)]">
        <div class="top-banner bg-primary p-2 flex items-center justify-between w-full rounded-t-lg">
            <div class="left-container flex justify-center items-center gap-1 md:gap-2">
                <p><img src="/assets/images/misc/favicon.jpg" class="h-auto w-[60px]" alt="" style="height: 100%;">
                </p>
                <h2 class="uppercase mx-2 w-[100px] text-white">Sorteios</h2>
            </div>
            <p class="text-xs text-light-black text-right">Estamos retornando para a <span
                    class="font-bold ">CASA</span>, lugar este que é nosso e de onde o <span
                    class="font-bold text-sm">coração<span class="font-bold text-sm"> nunca se ausenta. 💛
            </p>
            <div class="social-medias w-fit flex items-center justify-center gap-2">

                <a href="https://www.instagram.com/projetosorrir" target="_blank">
                    <svg width="28" height="29" viewBox="0 0 28 29" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="svg-icon min-w-[28px] h-6 w-6">
                        <path
                            d="M19.8333 2.83325H8.16667C4.94501 2.83325 2.33334 5.44492 2.33334 8.66659V20.3333C2.33334 23.5549 4.94501 26.1666 8.16667 26.1666H19.8333C23.055 26.1666 25.6667 23.5549 25.6667 20.3333V8.66659C25.6667 5.44492 23.055 2.83325 19.8333 2.83325Z"
                            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M18.6667 13.7651C18.8106 14.7361 18.6448 15.7277 18.1927 16.599C17.7406 17.4702 17.0253 18.1768 16.1486 18.6181C15.2718 19.0594 14.2782 19.213 13.3091 19.057C12.34 18.9011 11.4447 18.4435 10.7506 17.7495C10.0566 17.0554 9.59902 16.1601 9.44308 15.191C9.28714 14.2219 9.44074 13.2283 9.88205 12.3515C10.3234 11.4748 11.0299 10.7595 11.9011 10.3074C12.7724 9.85531 13.764 9.68946 14.735 9.83344C15.7254 9.98031 16.6423 10.4418 17.3503 11.1498C18.0583 11.8578 18.5198 12.7747 18.6667 13.7651Z"
                            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M20.4167 8.08325H20.4283" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>

                    <!--[if lt IE 9]><em>Instagram</em><![endif]-->
                </a>
            </div>
        </div>
        <div class="flex justify-center">
            <!-- Swiper -->

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <img src="/assets/images/misc/banner1.jpeg" class="object-cover" alt="Premiação 500k!">
                    </div>
                    {{-- <div class="swiper-slide">
                        <img src="/assets/images/misc/banner-2.jpg" class="object-cover" alt="Premiação 500k!">
                    </div> --}}

                </div>
                <!-- Adiciona setas de navegação -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        <div class="p-2 lg:p-0 lg:py-2 bg-primary rounded-b-lg">
            <div class="grid grid-cols-3 justify-between">
                <p class="col-span-2 text-[11px] text-black p-4"><b>Se inscreva aqui</b> para retornar ao Projeto Sorrir
                    caso já tenha feito parte algum dia. <b>#estamosDeVolta</b>
            </div>
        </div>
        <div>
            <a href="https://typebot.co/recicla-sorrir-v7wui2t" target="_blank"
                class="animated-shine relative flex justify-center items-center gap-2 mt-2 mx-auto bg-we-highlight rounded-lg text-white font-bold py-2 px-3 w-full text-center">
                <div class="flex justify-center items-center gap-2 text-sm">
                    QUERO ME INSCREVER NO RECICLA SORRIR
                </div>
            </a>
        </div>
        <div id="openFaqModalBtn" class="flex gap-2 justify-center cursor-pointer"
            style="border-radius: 10px; background: white; align-items: center; padding: 4px; font-size: 19px; margin-top: 7px; color: #736E70; box-shadow: 0 0 20px #00000021;">
            <svg class="w-10 h-10 opacity-90" data-slot="icon" fill="none" stroke-width="2" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z">
                </path>
            </svg>
            <p><span class="font-bold">Dúvidas?</span> <span class="text-sm">Clique aqui!</span></p>
        </div>

        <div class="faq-modal-overlay fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
            id="faq-modal">
            <div class="faq-modal-content relative max-w-lg w-full p-2 lg:p-0">
                <div class="bg-white max-h-[98vh] lg:max-h-[75vh] rounded-lg p-6 pb-8 overflow-y-auto">

                    <div class="flex justify-between mb-12" style="align-items: center;">
                        <div>
                            <p class="font-bold text-2xl">Perguntas Frequentes</p>
                        </div>
                        <div id="closeFaqModalBtn"
                            class="close-btn justify-end bg-[#FFD700] rounded-lg p-2 float-right cursor-pointer">
                            <svg class="h-6 w-6 text-white" data-slot="icon" fill="none" stroke-width="1.5"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="faq-container text-[13px]">
                        <div class="faq-item">
                            <div class="faq-question">
                                <div class="flex gap-2 max-w-[90%]" style="align-items: center;">
                                    <svg class="min-w-6 min-h-6 w-6 h-6 text-[#ffd432]" data-slot="icon" fill="none"
                                        stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z">
                                        </path>
                                    </svg>
                                    <p class="text-lg text-black/75">O que é o ReciclaSorrir? 🔴</p>
                                </div>
                                <span class="arrow">&#9658;</span>
                            </div>
                            <div class="faq-answer grid gap-4 mt-6">
                                <p>Com o objetivo de retornar o Projeto Sorrir em suas atividades de voluntariado, o
                                    ReciclaSorrir surgiu com o propósito de trazer uma retomada consciente sobre novos
                                    príncipíos e valores que criamos para proporcionar não apenas aos voluntários, mas
                                    para todos nossos parceiros, instituições e assistidos uma entrega mais profunda e
                                    direcionada sobre nosso propósito e missão!</p>
                            </div>
                        </div>
                        <div class="pt-[15px] pb-[20px]">
                            <hr>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">
                                <div class="flex gap-2 max-w-[90%]" style="align-items: center;">
                                    <svg class="min-w-6 min-h-6 w-6 h-6 text-[#FFD70033]" data-slot="icon"
                                        fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z">
                                        </path>
                                    </svg>
                                    <p class="text-lg text-black/75">Para quem é o ReciclaSorrir?</p>
                                </div>
                                <span class="arrow">&#9658;</span>
                            </div>
                            <div class="faq-answer grid gap-4 mt-6">
                                <p>Se você já foi um voluntário ativo da filial de São Paulo ou Jundiaí e deseja fazer
                                    parte dessa retomada, será muito bem vindo neste processo feito especialmente para
                                    você!
                                    Caso tenha dúvidas se está apto a participar dessa imersão, fale com um de nossos
                                    admins desse grupo para que possamos te orientar da melhor forma possivel.
                                </p>
                            </div>
                        </div>

                        <div class="pt-[15px] pb-[20px]">
                            <hr>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">
                                <div class="flex gap-2 max-w-[90%]" style="align-items: center;">
                                    <svg class="min-w-6 min-h-6 w-6 h-6 text-[#FFD70033]" data-slot="icon"
                                        fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z">
                                        </path>
                                    </svg>
                                    <p class="text-lg text-black/75">Como acontecerá toda a agenda 🗓️ e horário do
                                        ReciclaSorrir?</p>
                                </div>
                                <span class="arrow">&#9658;</span>
                            </div>
                            <div class="faq-answer grid gap-4 mt-6">
                                <p>Calma, vamos passar tudo detalhado para vocês, mas adiantando, teremos duas turmas
                                    para que já possam ir se organizando, final de semana e de semana, com encontros
                                    online e presenciais, deixando a agenda bem flexível podendo contar com a
                                    participação de todos!</p>
                            </div>
                        </div>

                        <div class="pt-[15px] pb-[20px]">
                            <hr>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">
                                <div class="flex gap-2 max-w-[90%]" style="align-items: center;">
                                    <svg class="min-w-6 min-h-6 w-6 h-6 text-[#FFD70033]" data-slot="icon"
                                        fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z">
                                        </path>
                                    </svg>
                                    <p class="text-lg text-black/75">Filial de São Paulo e Jundiaí estão retornando
                                        juntas?</p>
                                </div>
                                <span class="arrow">&#9658;</span>
                            </div>
                            <div class="faq-answer grid gap-4 mt-6">
                                <p>Neste primeiro momento, estamos retornando apenas com a filial de São Paulo, mas caso
                                    você tenha sido um voluntário ativo de Jundiaí e queira se juntar conosco em SP,
                                    será super bem vindo(a).</p>
                            </div>
                        </div>

                        <div class="pt-[15px] pb-[20px]">
                            <hr>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">
                                <div class="flex gap-2 max-w-[90%]" style="align-items: center;">
                                    <svg class="min-w-6 min-h-6 w-6 h-6 text-[#FFD70033]" data-slot="icon"
                                        fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z">
                                        </path>
                                    </svg>
                                    <p class="text-lg text-black/75">O ReciclaSorrir se trata de um Processo Seletivo?
                                    </p>
                                </div>
                                <span class="arrow">&#9658;</span>
                            </div>
                            <div class="faq-answer grid gap-4 mt-6">
                                <p>Essa será uma reciclagem para retomada, onde contamos apenas com o cumprimento de
                                    agenda e ser um voluntário que já participou ativamente de nosso Projeto.</p>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-4" />

                    <div class="redes-sociais text-black/75 text-center mt-4">
                        Ainda tem dúvidas? Entre em contato conosco:
                        <div class="social-medias  w-full flex items-center justify-center gap-2 mt-2">

                            <a href="https://www.instagram.com/projetosorrir" target="_blank">
                                <svg width="28" height="29" viewBox="0 0 28 29" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M19.8333 2.83325H8.16667C4.94501 2.83325 2.33334 5.44492 2.33334 8.66659V20.3333C2.33334 23.5549 4.94501 26.1666 8.16667 26.1666H19.8333C23.055 26.1666 25.6667 23.5549 25.6667 20.3333V8.66659C25.6667 5.44492 23.055 2.83325 19.8333 2.83325Z"
                                        stroke="#FFD700" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M18.6667 13.7651C18.8106 14.7361 18.6448 15.7277 18.1927 16.599C17.7406 17.4702 17.0253 18.1768 16.1486 18.6181C15.2718 19.0594 14.2782 19.213 13.3091 19.057C12.34 18.9011 11.4447 18.4435 10.7506 17.7495C10.0566 17.0554 9.59902 16.1601 9.44308 15.191C9.28714 14.2219 9.44074 13.2283 9.88205 12.3515C10.3234 11.4748 11.0299 10.7595 11.9011 10.3074C12.7724 9.85531 13.764 9.68946 14.735 9.83344C15.7254 9.98031 16.6423 10.4418 17.3503 11.1498C18.0583 11.8578 18.5198 12.7747 18.6667 13.7651Z"
                                        stroke="#FFD700" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M20.4167 8.08325H20.4283" stroke="#FFD700" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                                <!--[if lt IE 9]><em>Instagram</em><![endif]-->
                            </a>
                            <a href="https://wa.me/5511993577472" target="_blank">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                    class="svg-icon min-w-[24px] h-6 w-6" id="Whatsapp-Logo--Streamline-Ultimate">
                                    <desc>Whatsapp Logo Streamline Icon: https://streamlinehq.com</desc>
                                    <path
                                        d="M12 0.75A11.22 11.22 0 0 0 0.74 11.91a11 11 0 0 0 2.14 6.54l-1.4 4.15 4.32 -1.37a11.26 11.26 0 0 0 17.44 -9.32A11.22 11.22 0 0 0 12 0.75m6.07 13.91c-0.07 -0.12 -0.27 -0.2 -0.56 -0.34s-1.74 -0.85 -2 -0.95 -0.47 -0.15 -0.66 0.15 -0.5 0.73 -0.67 0.92 -0.34 0.22 -0.64 0.07a9.2 9.2 0 0 1 -4.14 -3.58c-0.17 -0.29 0 -0.45 0.13 -0.59 0.49 -0.49 0.5 -0.42 0.62 -0.66a0.53 0.53 0 0 0 0 -0.51C10 9 9.45 7.58 9.2 7s-1.51 -0.69 -2 -0.15C2 12.33 14.67 21.72 17.91 16a1.41 1.41 0 0 0 0.16 -1.32"
                                        fill="none" stroke="#FFD700" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="1.5">
                                    </path>
                                </svg>
                            </a>
                            <a href="mailto:contato@sorrir.com.br" target="_blank">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.66666 4.6665H23.3333C24.6167 4.6665 25.6667 5.7165 25.6667 6.99984V20.9998C25.6667 22.2832 24.6167 23.3332 23.3333 23.3332H4.66666C3.38333 23.3332 2.33333 22.2832 2.33333 20.9998V6.99984C2.33333 5.7165 3.38333 4.6665 4.66666 4.6665Z"
                                        stroke="#FFD700" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M25.6667 7L14 15.1667L2.33333 7" stroke="#FFD700" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="grid grid-cols-1 pt-2">
            <div class="order-1 md:order-2 grid gap-2">
                @foreach ($active_raffles as $raffle)
                    {{-- <a href="{{ route('raffle-buy', [$raffle['id']]) }}" --}}
                    <a href="#"
                        class="bg-white h-fit grid lg:grid-cols-2 gap-y-4 gap-8 rounded-lg overflow-hidden border border-black/10 p-2">
                        <div class="col-span-full flex gap-4">
                            <div>
                                @php
                                    $mainPhotoPath = public_path($raffle['main_photo']);
                                @endphp
                                @if (!is_null($raffle['main_photo']))
                                    <img src="{{ asset($raffle['main_photo']) }}"
                                        class="sm:min-w-[150px] sm:max-w-[150px] sm:min-h-[150px] sm:max-h-[150px] min-[320px]:min-w-[150px] min-[320px]:max-w-[150px] min-[320px]:min-h-[150px] min-[320px]:max-h-[150px] rounded-lg">
                                @else
                                    <div class="w-[170px] h-[170px] rounded-lg"
                                        style="align-content: end; background-size: cover !important; background-position: 50% !important; background: url('<?= asset('assets/images/misc/thumb-wepremios-01.png') ?>')">
                                    </div>
                                @endif
                            </div>
                            <div class="grid content-between w-full">
                                <div>
                                    <div class="col-span-full flex gap-2 h-fit">
                                        <!-- <div class="bg-primary rounded-full w-[5px] h-auto"></div> -->
                                        <h2 class="font-bold text-lg text-primary">{{ $raffle['name'] }}</h2>
                                    </div>
                                    <div>
                                        <h3 class="text-sm min-[320px]:text-md"><b>Por apenas:</b> R$
                                            {{ $raffle['price_per_number'] }}
                                        </h3>
                                        <h4 class="text-[10px] min-[320px]:text-xs"><b>Processo SUSEP:</b>
                                            {{ $raffle['susep_process'] }}
                                        </h4>
                                    </div>
                                    <div class="grid lg:flex items-center mt-2 gap-2">
                                        <p
                                            class="text-white w-fit bg-primary px-2 h-fit rounded-full text-xs font-bold pulse">
                                            Sorteio encerrado!</p>
                                        <p
                                            class="text-black/70 w-fit bg-black/10 px-2 h-fit rounded-full text-xs font-bold">
                                            Sorteio:
                                            {{ \Carbon\Carbon::parse($raffle['draw_date'])->format('d/m/Y') }}
                                        </p>
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <b>SORTEIO REALIZADO</b>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                @foreach ($sorted_raffles as $raffle)
                    <div class="bg-white h-fit grid lg:grid-cols-2 gap-y-4 gap-8 rounded-lg overflow-hidden border border-black/10 p-2"
                        style="opacity: 0.5;">
                        <div class="col-span-full flex gap-4">
                            <div>
                                <div class="w-[150px] h-[150px] rounded-lg"
                                    style="align-content: end; background-size: cover !important; background-position: 50% !important; background: url('../assets/images/misc/teste2.png')">
                                </div>
                            </div>
                            <div class="grid content-between w-full">
                                <div>
                                    <div class="col-span-full flex gap-2 h-fit">
                                        <!-- <div class="bg-primary rounded-full w-[5px] h-auto"></div> -->
                                        <h5 class="font-bold text-lg">{{ $raffle['name'] }}</h5>
                                    </div>
                                    <div>
                                        <h5 class="text-xs"><b>Valor do Título:</b> R$
                                            {{ $raffle['price_per_number'] }}
                                        </h5>
                                        <h5 class="text-[10px]"><b>Processo SUSEP:</b>
                                            {{ $raffle['susep_process'] }}
                                        </h5>
                                    </div>
                                    <div class="grid lg:flex mt-2 gap-2">
                                        <p
                                            class="text-black/70 w-fit bg-black/10 px-2 h-fit rounded-full text-xs font-bold">
                                            {{ \Carbon\Carbon::parse($raffle['draw_date'])->format('d/m/Y') }} às
                                            {{ $raffle['draw_hour'] }}</p>
                                    </div>
                                </div>
                                <div>
                                    <button id="buyButton"
                                        class="relative flex justify-between items-center gap-2 mt-2 mx-auto bg-[#afafaf] rounded-lg text-white font-bold py-2 px-3 w-full">
                                        <div class="flex justify-center items-center gap-2 text-sm">
                                            Finalizado
                                        </div>
                                        <div id="totalPrice" class="text-sm">
                                            R$ {{ number_format($raffle['price_per_number'], 2, ',', '.') }}
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        var swiper = new Swiper('.mySwiper', {
            direction: 'horizontal',
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000, // 5 segundos
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const faqItems = document.querySelectorAll(".faq-item");

            faqItems.forEach(function(item) {
                const question = item.querySelector(".faq-question");
                const answer = item.querySelector(".faq-answer");

                question.addEventListener("click", function() {
                    // Fechar todas as respostas, exceto a clicada
                    faqItems.forEach(function(otherItem) {
                        if (otherItem !== item && otherItem.classList.contains("opened")) {
                            otherItem.classList.remove("opened");
                            otherItem.querySelector(".faq-answer").style.display = "none";
                            otherItem.querySelector(".arrow").style.transform =
                                "rotate(0deg)";
                        }
                    });

                    // Alternar estado da pergunta clicada
                    if (item.classList.contains("opened")) {
                        item.classList.remove("opened");
                        answer.style.display = "none";
                        question.querySelector(".arrow").style.transform = "rotate(0deg)";
                    } else {
                        item.classList.add("opened");
                        answer.style.display = "grid";
                        question.querySelector(".arrow").style.transform = "rotate(90deg)";
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        function openModal() {
            var modal = document.getElementById('faq-modal');
            modal.style.display = "flex";
        }

        function closeFaqModal() {
            var modal = document.getElementById('faq-modal');
            modal.style.display = "none";
        }

        document.getElementById("openFaqModalBtn").addEventListener("click", openModal);
        document.getElementById("closeFaqModalBtn").addEventListener("click", closeFaqModal);
    </script>
</div>
