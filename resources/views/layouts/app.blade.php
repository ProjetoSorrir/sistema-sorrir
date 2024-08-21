<!doctype html>
<html class="h-full bg-white" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    @yield('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- @php
        $faviconPath = App\Models\Settings::pluck('favicon')->first();
    @endphp

    @php
        $faviconPath = App\Models\Settings::get('favicon');
    @endphp

    @if ($faviconPath)
        <link rel="icon" href="{{ asset($faviconPath) }}" type="image/png">
    @else
        <link rel="icon"
            href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='currentColor' viewBox='0 0 24 24'%3E%3Cpath d='M4 5a2 2 0 0 0-2 2v2.5c0 .6.4 1 1 1a1.5 1.5 0 1 1 0 3 1 1 0 0 0-1 1V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5a1 1 0 0 0-1-1 1.5 1.5 0 1 1 0-3 1 1 0 0 0 1-1V7a2 2 0 0 0-2-2H4Z'/%3E%3C/svg%3E"
            type="image/svg+xml">
    @endif --}}

    <title>Projeto - @yield('title', 'Bem-vindo')</title>


    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,900;1,100;1,300;1,400;1,500;1,600;1,700;1,900&display=swap"
        rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    @livewireStyles

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    <!-- Wow JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"
        integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        new WOW().init();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<style>
    .swal2-popup .swal2-html-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .swal2-popup .swal2-html-container>div {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        max-height: calc(100vh - 400px);
        min-height: 200px;
        /* Altura mínima para garantir que overflow funcione */
        overflow-y: scroll;
        overflow-x: hidden;
        /* Evita scroll horizontal */
    }
</style>


<body class="antialiased bg-[#fafbfc] min-h-full">
    <header class="relative bg-gradient-to-r  from-gray-100 to-gray-200">
        <nav class="relative py-4 h-[120px]" style="z-index: 9;">
            <div class="max-w-[600px] flex justify-between items-center mx-auto px-2">
                <div class="flex items-center justify-center flex-1">


                    <div class="flex items-center gap-8">
                        <a href="{{ route('welcome') }}" class="flex gap-3 text-4xl font-semibold">
                            <img src="<?= asset('/assets/images/misc/logo-sorrir.png') ?>" alt="We Premios"
                                class="w-[150px] h-[68px]">
                        </a>
                    </div>

                </div>
                <div class="relative">
                    <div class="relative cursor-pointer" onclick="toggleMenu(event)" class="mr-2"
                        style="z-index: 99999">
                        <svg class="w-6 h-6 text-black" data-slot="icon" fill="none" stroke-width="1.5"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                        </svg>
                    </div>

                    @auth
                        <div id="menu"
                            class="absolute left-1/2 z-10 mt-5 flex w-screen max-w-max -translate-x-[94%] px-4 pr-[7px] hidden">
                            <div
                                class="w-screen max-w-md flex-auto overflow-hidden rounded-3xl bg-white text-sm leading-6 shadow-lg ring-1 ring-gray-900/5">
                                <div class="p-4">
                                    @if (Auth::user()->admin)
                                        <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                            <div
                                                class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                                <svg class="h-6 w-6  fill-gray-300 group-hover:text-primary"
                                                    viewBox="0 0 24 25" stroke="currentColor" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <mask id="mask0_1702_2644" style="mask-type:alpha"
                                                        maskUnits="userSpaceOnUse" x="0" y="0" width="24"
                                                        height="25">
                                                        <rect y="0.5" width="24" height="24" />
                                                    </mask>
                                                    <g mask="url(#mask0_1702_2644)">
                                                        <path
                                                            d="M3 20.5V7.5L7 10.5L12 3.5L17 7.5H21V20.5H3ZM8 17.5L12 12L19 17.45V9.5H16.3L12.4 6.375L7.45 13.325L5 11.5V15.1L8 17.5Z" />
                                                    </g>
                                                </svg>

                                            </div>
                                            <div>
                                                <a href="{{ route('home') }}" class="font-semibold text-gray-900">
                                                    Meu Painel Administrativo
                                                    <span class="absolute inset-0"></span>
                                                </a>
                                                <p class="text-gray-600">Controle seu site e seus títulos</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                        <div
                                            class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                class="h-6 w-6 text-gray-600 group-hover:text-primary " fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12 15C15.866 15 19 11.866 19 8C19 4.13401 15.866 1 12 1C8.13401 1 5 4.13401 5 8C5 11.866 8.13401 15 12 15Z"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke="currentColor" />
                                                <path d="M8.21 13.89L7 23L12 20L17 23L15.79 13.88" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke="currentColor" />
                                            </svg>
                                        </div>
                                        <div>
                                            <a href="{{ route('winners-page') }}" class="font-semibold text-gray-900">
                                                Ganhadores
                                                <span class="absolute inset-0"></span>
                                            </a>
                                            <p class="text-gray-600">Veja nossos ganhadores</p>
                                        </div>
                                    </div>
                                    <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                        <div
                                            class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                            <svg class="h-6 w-6 text-gray-600 group-hover:text-primary" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <a href="{{ route('my-buys') }}" class="font-semibold text-gray-900">
                                                Minhas compras
                                                <span class="absolute inset-0"></span>
                                            </a>
                                            <p class="text-gray-600">Acesse seus títulos e status</p>
                                        </div>
                                    </div>
                                    <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                        <div
                                            class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                            <svg class="h-6 w-6 text-gray-600 group-hover:text-primary" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7.864 4.243A7.5 7.5 0 0119.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 004.5 10.5a7.464 7.464 0 01-1.15 3.993m1.989 3.559A11.209 11.209 0 008.25 10.5a3.75 3.75 0 117.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 01-3.6 9.75m6.633-4.596a18.666 18.666 0 01-2.485 5.33" />
                                            </svg>
                                        </div>
                                        <div>
                                            <a href="{{ route('my-profile') }}" class="font-semibold text-gray-900">
                                                Meu perfil
                                                <span class="absolute inset-0"></span>
                                            </a>
                                            <p class="text-gray-600">Visualize e altere seus dados</p>
                                        </div>
                                    </div>

                                    <livewire:logout-button />

                                </div>
                                <div class="grid grid-cols-2 divide-x divide-gray-900/5 bg-gray-50">
                                    <a href="{{ url('institucional') }}"
                                        class="flex items-center justify-center gap-x-2.5 p-3 font-semibold text-gray-900 hover:bg-gray-100">
                                        <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 25 25"
                                            fill="currentColor" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z">
                                            </path>
                                        </svg>
                                        Institucional
                                    </a>
                                    <a href="{{ url('suporte') }}"
                                        class="flex items-center justify-center gap-x-2.5 p-3 font-semibold text-gray-900 hover:bg-gray-100">
                                        <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Fale Conosco
                                    </a>
                                </div>
                            </div>
                            <div class="md:hidden"
                                style="position: absolute; width: 100%; height: 100vh; background: #0000003d; z-index: -1; top: -82px; left: -6px;">
                            </div>
                        </div>
                    @endauth
                    @guest
                        <div id="menu"
                            class="absolute left-1/2 z-10 mt-5 flex w-screen max-w-max -translate-x-[94%] px-4 pr-[7px] hidden">
                            <div
                                class="w-screen max-w-md flex-auto overflow-hidden rounded-3xl bg-white text-sm leading-6 shadow-lg ring-1 ring-gray-900/5">
                                <div class="p-4">
                                    <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                        <div
                                            class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                class="h-6 w-6 text-gray-600 group-hover:text-primary " fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12 15C15.866 15 19 11.866 19 8C19 4.13401 15.866 1 12 1C8.13401 1 5 4.13401 5 8C5 11.866 8.13401 15 12 15Z"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke="currentColor" />
                                                <path d="M8.21 13.89L7 23L12 20L17 23L15.79 13.88" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    stroke="currentColor" />
                                            </svg>
                                        </div>
                                        <div>
                                            <a href="{{ route('winners-page') }}" class="font-semibold text-gray-900">
                                                Ganhadores
                                                <span class="absolute inset-0"></span>
                                            </a>
                                            <p class="text-gray-600">Veja nossos ganhadores</p>
                                        </div>
                                    </div>
                                    <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                        <div
                                            class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                            <svg class="h-6 w-6 text-gray-600 group-hover:text-primary" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                                            </svg>
                                        </div>

                                        <div>
                                            <a href="{{ route('login') }}" class="font-semibold text-gray-900">
                                                Acessar conta
                                                <span class="absolute inset-0"></span>
                                            </a>
                                            <p class="text-gray-600">Já tem uma conta? Acesse</p>
                                        </div>
                                    </div>
                                    {{-- <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
                                        <div
                                            class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                            <svg class="h-6 w-6 text-gray-600 group-hover:text-primary" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59" />
                                            </svg>
                                        </div>
                                        <div>
                                            <a href="{{ route('register') }}" class="font-semibold text-gray-900">
                                                Registrar
                                                <span class="absolute inset-0"></span>
                                            </a>
                                            <p class="text-gray-600">Ainda não tem uma conta? Registre-se</p>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="grid grid-cols-2 divide-x divide-gray-900/5 bg-gray-50">
                                    <a href="{{ url('institucional') }}"
                                        class="flex items-center justify-center gap-x-2.5 p-3 font-semibold text-gray-900 hover:bg-gray-100">
                                        <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 25 25"
                                            fill="currentColor" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z">
                                            </path>
                                        </svg>
                                        Institucional
                                    </a>
                                    <a href="{{ url('suporte') }}"
                                        class="flex items-center justify-center gap-x-2.5 p-3 font-semibold text-gray-900 hover:bg-gray-100">
                                        <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Fale Conosco
                                    </a>
                                </div>
                            </div>
                            <div class="md:hidden"
                                style="position: absolute; width: 100%; height: 100vh; background: #0000003d; z-index: -1; top: -82px; left: -6px;">
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>
        </div>
    </header>
    <main class="w-screen bg-we-bg relative top-[-30px] mb-[-30px] pb-[30px] p-2 pt-3 h-fit">
        <div class="w-full max-w-[600px] mx-auto">
            @yield('content')
        </div>
    </main>
    <footer class="bg-gradient-to-r from-gray-100 to-gray-200 py-4 pt-10">
        <div class="max-w-[1200px] mx-auto px-4 md:px-0">
            <div class="text-gray-500 flex flex-col justify-center items-center mx-auto">
                <div class="grid gap-4 gap-y-8 w-full md:px-0">
                    <div class="max-w-[600px] mx-auto flex gap-8 items-center">
                        <div class="flex items-center flex-1 justify-center"> <!-- Container para as logos -->
                            <div class="flex items-center gap-8">
                                <a href="{{ route('welcome') }}" class="flex gap-3 text-4xl font-semibold">
                                    <img src="<?= asset('/assets/images/misc/logo-sorrir.png') ?>" alt="We Premios"
                                        class="w-[150px] h-[68px]">
                                </a>
                            </div>
                        </div>
                        <div class="social-medias relative w-fit flex items-center justify-center gap-2">

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
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script>
        function toggleMenu(e) {
            var botaoMenu = document.getElementById('openMenu');
            var menuFlutuante = document.getElementById('menu');

            // Toggle do menu ao clicar na div
            menuFlutuante.classList.toggle('hidden');

            // Impedir a propagação do evento para que o menu não seja fechado imediatamente após ser aberto
            e.stopPropagation();

            // Função para fechar o menu ao clicar fora dele
            function fecharMenuFora(e) {
                // Verificar se o clique ocorreu fora do menu

                menuFlutuante.classList.add('hidden');
                // Remover o event listener após fechar o menu
                document.removeEventListener('click', fecharMenuFora);

            }

            // Adicionar event listener para fechar o menu quando clicar fora dele
            document.addEventListener('click', fecharMenuFora);
        }
    </script>


    <!-- Meta Pixel Code -->

    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '306521655758455');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=306521655758455&ev=PageView&noscript=1" /></noscript>

    <!-- End Meta Pixel Code -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3K01P6M09W"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-3K01P6M09W');
    </script>

    @livewireScripts

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Adiciona a tag meta para viewport
            var viewportMeta = document.createElement('meta');
            viewportMeta.setAttribute('name', 'viewport');
            viewportMeta.setAttribute('content',
                'width=device-width, initial-scale=1.0, maximum-scale=1.01, user-scalable=no');
            document.head.appendChild(viewportMeta);

            var descriptionMeta = document.createElement('meta');
            descriptionMeta.setAttribute('name', 'description');
            descriptionMeta.setAttribute('content',
                'We Prêmios - Escolha o prêmio que gostaria de concorrer, verifique a descrição, regulamento do sorteio e fotos em caso de dúvidas entre em contato com a gente!'
            );
            document.head.appendChild(descriptionMeta);

            // Cria as tags meta para Open Graph
            var metaTags = [{
                    property: 'og:title',
                    content: 'We Prêmios - Prêmio 500K'
                },
                {
                    property: 'og:description',
                    content: 'We Prêmios - Escolha o prêmio que gostaria de concorrer, verifique a descrição, regulamento do sorteio e fotos em caso de dúvidas entre em contato com a gente!'
                },
                {
                    property: 'og:image',
                    content: '/assets/images/misc/logos-we-brascap-2.png'
                },
                {
                    property: 'og:url',
                    content: 'https://wepremios.com.br'
                }
            ];

            metaTags.forEach(function(tagInfo) {
                var meta = document.createElement('meta');
                meta.setAttribute('property', tagInfo.property);
                meta.setAttribute('content', tagInfo.content);
                document.head.appendChild(meta);
            });

            // Cria a tag link para favicon
            var link = document.createElement('link');
            link.setAttribute('rel', 'icon');
            link.setAttribute('href', '/assets/images/misc/favicon.jpg');
            link.setAttribute('type', 'image/png');
            document.head.appendChild(link);
        });
    </script>
</body>

</html>
