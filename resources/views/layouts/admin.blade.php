<!DOCTYPE html>
<html class="h-full bg-white" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ App\Models\Settings::get('site_name') ?? '' }} - Admin - @yield('title', 'Bem-vindo')</title>

    @php
        $faviconPath = App\Models\Settings::get('favicon');
    @endphp

    <link rel="icon" href="{{ $faviconPath ? asset($faviconPath) : asset('fallback-favicon.ico') }}" type="image/jpeg">

    {{-- Sweet Alert --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">



    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    @livewireStyles

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>



    <!-- CKEditor -->
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <!-- SweetAlert2 JS -->
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

<body class="h-full font-nunito">
    <header
        class="top-0 z-40 pl-4 pr-8 py-2 w-screen border bg-white border-b-slate-300 flex justify-between items-center fixed">
        <div class="flex justify-start items-center gap-6">
            {{-- botão menu desktop --}}
            <button class="hidden lg:block" onclick="toggleMenu()"><svg width="24" height="24"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="fill-dark-grey">
                    <mask id="mask0_753_2500" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                        width="24" height="24">
                        <rect width="24" height="24" />
                    </mask>
                    <g mask="url(#mask0_753_2500)">
                        <path d="M3 18V16H21V18H3ZM3 13V11H21V13H3ZM3 8V6H21V8H3Z" />
                    </g>
                </svg>
            </button>
            {{-- botão menu mobile até desktop --}}
            <div class="relative w-max">
                <button class="block lg:hidden open-mobile-menu-btn"><svg width="24" height="24"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="fill-dark-grey">
                        <mask id="mask0_753_2500" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                            width="24" height="24">
                            <rect width="24" height="24" />
                        </mask>
                        <g mask="url(#mask0_753_2500)">
                            <path d="M3 18V16H21V18H3ZM3 13V11H21V13H3ZM3 8V6H21V8H3Z" />
                        </g>
                    </svg>
                </button>
                <div class="mobile-menu absolute left-0 z-10 mt-2.5 min-w-[290px] origin-top-left rounded-md bg-white shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                    style="display: none;">
                    <div class="w-full rounded-t-md px-6 py-2 text-sm mb-2 font-semibold leading-6 text-white bg-primary capitalize"
                        aria-hidden="true">{{ Auth::user()->name }}</div>
                    <nav class="w-full h-full flex flex-1 flex-col">
                        <ul role="list w-full">
                            <li>
                                <a href="{{ route('home') }}" class="menu-link">
                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg" class="custom-svg-icon">
                                        <mask id="mask0_56_21" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                            y="0" width="24" height="24">
                                            <rect width="24" height="24" />
                                        </mask>
                                        <g mask="url(#mask0_56_21)">
                                            <path
                                                d="M6 19H9V13H15V19H18V10L12 5.5L6 10V19ZM4 21V9L12 3L20 9V21H13V15H11V21H4Z" />
                                        </g>
                                    </svg>
                                    <p>Home</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('panel') }}" class="menu-link">
                                    <svg width="18" height="18" viewBox="0 0 18 18"
                                        xmlns="http://www.w3.org/2000/svg" class="custom-svg-icon">
                                        <path
                                            d="M2 18C1.45 18 0.979167 17.8042 0.5875 17.4125C0.195833 17.0208 0 16.55 0 16V2C0 1.45 0.195833 0.979167 0.5875 0.5875C0.979167 0.195833 1.45 0 2 0H11V2H2V16H16V7H18V16C18 16.55 17.8042 17.0208 17.4125 17.4125C17.0208 17.8042 16.55 18 16 18H2ZM14 6V4H12V2H14V0H16V2H18V4H16V6H14ZM3 14H15L11.25 9L8.25 13L6 10L3 14Z" />
                                    </svg>
                                    <p>Carrossel de Imagens</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('my_raffles') }}" class="menu-link">
                                    <svg width="20" height="16" viewBox="0 0 20 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="custom-svg-icon">
                                        <path
                                            d="M10 13C10.2833 13 10.5208 12.9042 10.7125 12.7125C10.9042 12.5208 11 12.2833 11 12C11 11.7167 10.9042 11.4792 10.7125 11.2875C10.5208 11.0958 10.2833 11 10 11C9.71667 11 9.47917 11.0958 9.2875 11.2875C9.09583 11.4792 9 11.7167 9 12C9 12.2833 9.09583 12.5208 9.2875 12.7125C9.47917 12.9042 9.71667 13 10 13ZM10 9C10.2833 9 10.5208 8.90417 10.7125 8.7125C10.9042 8.52083 11 8.28333 11 8C11 7.71667 10.9042 7.47917 10.7125 7.2875C10.5208 7.09583 10.2833 7 10 7C9.71667 7 9.47917 7.09583 9.2875 7.2875C9.09583 7.47917 9 7.71667 9 8C9 8.28333 9.09583 8.52083 9.2875 8.7125C9.47917 8.90417 9.71667 9 10 9ZM10 5C10.2833 5 10.5208 4.90417 10.7125 4.7125C10.9042 4.52083 11 4.28333 11 4C11 3.71667 10.9042 3.47917 10.7125 3.2875C10.5208 3.09583 10.2833 3 10 3C9.71667 3 9.47917 3.09583 9.2875 3.2875C9.09583 3.47917 9 3.71667 9 4C9 4.28333 9.09583 4.52083 9.2875 4.7125C9.47917 4.90417 9.71667 5 10 5ZM18 16H2C1.45 16 0.979167 15.8042 0.5875 15.4125C0.195833 15.0208 0 14.55 0 14V10C0.55 10 1.02083 9.80417 1.4125 9.4125C1.80417 9.02083 2 8.55 2 8C2 7.45 1.80417 6.97917 1.4125 6.5875C1.02083 6.19583 0.55 6 0 6V2C0 1.45 0.195833 0.979167 0.5875 0.5875C0.979167 0.195833 1.45 0 2 0H18C18.55 0 19.0208 0.195833 19.4125 0.5875C19.8042 0.979167 20 1.45 20 2V6C19.45 6 18.9792 6.19583 18.5875 6.5875C18.1958 6.97917 18 7.45 18 8C18 8.55 18.1958 9.02083 18.5875 9.4125C18.9792 9.80417 19.45 10 20 10V14C20 14.55 19.8042 15.0208 19.4125 15.4125C19.0208 15.8042 18.55 16 18 16ZM18 14V11.45C17.3833 11.0833 16.8958 10.5958 16.5375 9.9875C16.1792 9.37917 16 8.71667 16 8C16 7.28333 16.1792 6.62083 16.5375 6.0125C16.8958 5.40417 17.3833 4.91667 18 4.55V2H2V4.55C2.61667 4.91667 3.10417 5.40417 3.4625 6.0125C3.82083 6.62083 4 7.28333 4 8C4 8.71667 3.82083 9.37917 3.4625 9.9875C3.10417 10.5958 2.61667 11.0833 2 11.45V14H18Z" />
                                    </svg>
                                    <p>Minhas Ações</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customers') }}" class="menu-link">
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="custom-svg-icon"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <mask id="mask0_56_99" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="24" height="24">
                                            <rect width="24" height="24" />
                                        </mask>
                                        <g mask="url(#mask0_56_99)">
                                            <path
                                                d="M12 12C10.9 12 9.95833 11.6083 9.175 10.825C8.39167 10.0417 8 9.1 8 8C8 6.9 8.39167 5.95833 9.175 5.175C9.95833 4.39167 10.9 4 12 4C13.1 4 14.0417 4.39167 14.825 5.175C15.6083 5.95833 16 6.9 16 8C16 9.1 15.6083 10.0417 14.825 10.825C14.0417 11.6083 13.1 12 12 12ZM4 20V17.2C4 16.6333 4.14583 16.1125 4.4375 15.6375C4.72917 15.1625 5.11667 14.8 5.6 14.55C6.63333 14.0333 7.68333 13.6458 8.75 13.3875C9.81667 13.1292 10.9 13 12 13C13.1 13 14.1833 13.1292 15.25 13.3875C16.3167 13.6458 17.3667 14.0333 18.4 14.55C18.8833 14.8 19.2708 15.1625 19.5625 15.6375C19.8542 16.1125 20 16.6333 20 17.2V20H4ZM6 18H18V17.2C18 17.0167 17.9542 16.85 17.8625 16.7C17.7708 16.55 17.65 16.4333 17.5 16.35C16.6 15.9 15.6917 15.5625 14.775 15.3375C13.8583 15.1125 12.9333 15 12 15C11.0667 15 10.1417 15.1125 9.225 15.3375C8.30833 15.5625 7.4 15.9 6.5 16.35C6.35 16.4333 6.22917 16.55 6.1375 16.7C6.04583 16.85 6 17.0167 6 17.2V18ZM12 10C12.55 10 13.0208 9.80417 13.4125 9.4125C13.8042 9.02083 14 8.55 14 8C14 7.45 13.8042 6.97917 13.4125 6.5875C13.0208 6.19583 12.55 6 12 6C11.45 6 10.9792 6.19583 10.5875 6.5875C10.1958 6.97917 10 7.45 10 8C10 8.55 10.1958 9.02083 10.5875 9.4125C10.9792 9.80417 11.45 10 12 10Z" />
                                        </g>
                                    </svg>
                                    <p>Clientes</p>
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('edit-site') }}" class="menu-link">
                                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                        class="custom-svg-icon">
                                        <mask id="mask0_56_104" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                            y="0" width="24" height="24">
                                            <rect width="24" height="24" />
                                        </mask>
                                        <g mask="url(#mask0_56_104)">
                                            <path
                                                d="M18 20V17H15V15H18V12H20V15H23V17H20V20H18ZM3 21C2.45 21 1.97917 20.8042 1.5875 20.4125C1.19583 20.0208 1 19.55 1 19V5C1 4.45 1.19583 3.97917 1.5875 3.5875C1.97917 3.19583 2.45 3 3 3H17C17.55 3 18.0208 3.19583 18.4125 3.5875C18.8042 3.97917 19 4.45 19 5V10H17V8H3V19H16V21H3ZM3 6H17V5H3V6Z" />
                                        </g>
                                    </svg>
                                    <p>Editar seu Site</p>
                                </a>
                            </li> --}}
                            <li>
                                <a href="{{ route('pedidos') }}" class="menu-link">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="custom-svg-icon">
                                        <mask id="mask0_56_109" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="24" height="24">
                                            <rect width="24" height="24" />
                                        </mask>
                                        <g mask="url(#mask0_56_109)">
                                            <path
                                                d="M6 15H13L15 13H6V15ZM6 11H12V9H6V11ZM4 7V17H11L9 19H2V5H22V8H20V7H4ZM22.9 12.3C22.9833 12.3833 23.025 12.475 23.025 12.575C23.025 12.675 22.9833 12.7667 22.9 12.85L22 13.75L20.25 12L21.15 11.1C21.2333 11.0167 21.325 10.975 21.425 10.975C21.525 10.975 21.6167 11.0167 21.7 11.1L22.9 12.3ZM13 21V19.25L19.65 12.6L21.4 14.35L14.75 21H13Z" />
                                        </g>
                                    </svg>
                                    <p>Pedidos</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('faq') }}" class="menu-link">
                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg" class="custom-svg-icon">
                                        <mask id="mask0_56_114" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="24" height="24">
                                            <rect width="24" height="24" />
                                        </mask>
                                        <g mask="url(#mask0_56_114)">
                                            <path
                                                d="M14 15C14.2833 15 14.5292 14.8958 14.7375 14.6875C14.9458 14.4792 15.05 14.2333 15.05 13.95C15.05 13.6667 14.9458 13.4208 14.7375 13.2125C14.5292 13.0042 14.2833 12.9 14 12.9C13.7167 12.9 13.4708 13.0042 13.2625 13.2125C13.0542 13.4208 12.95 13.6667 12.95 13.95C12.95 14.2333 13.0542 14.4792 13.2625 14.6875C13.4708 14.8958 13.7167 15 14 15ZM13.25 11.8H14.75C14.75 11.3167 14.8 10.9625 14.9 10.7375C15 10.5125 15.2333 10.2167 15.6 9.85C16.1 9.35 16.4333 8.94583 16.6 8.6375C16.7667 8.32917 16.85 7.96667 16.85 7.55C16.85 6.8 16.5875 6.1875 16.0625 5.7125C15.5375 5.2375 14.85 5 14 5C13.3167 5 12.7208 5.19167 12.2125 5.575C11.7042 5.95833 11.35 6.46667 11.15 7.1L12.5 7.65C12.65 7.23333 12.8542 6.92083 13.1125 6.7125C13.3708 6.50417 13.6667 6.4 14 6.4C14.4 6.4 14.725 6.5125 14.975 6.7375C15.225 6.9625 15.35 7.26667 15.35 7.65C15.35 7.88333 15.2833 8.10417 15.15 8.3125C15.0167 8.52083 14.7833 8.78333 14.45 9.1C13.9 9.58333 13.5625 9.9625 13.4375 10.2375C13.3125 10.5125 13.25 11.0333 13.25 11.8ZM8 18C7.45 18 6.97917 17.8042 6.5875 17.4125C6.19583 17.0208 6 16.55 6 16V4C6 3.45 6.19583 2.97917 6.5875 2.5875C6.97917 2.19583 7.45 2 8 2H20C20.55 2 21.0208 2.19583 21.4125 2.5875C21.8042 2.97917 22 3.45 22 4V16C22 16.55 21.8042 17.0208 21.4125 17.4125C21.0208 17.8042 20.55 18 20 18H8ZM8 16H20V4H8V16ZM4 22C3.45 22 2.97917 21.8042 2.5875 21.4125C2.19583 21.0208 2 20.55 2 20V6H4V20H18V22H4Z" />
                                        </g>
                                    </svg>
                                    <p>Perguntas Frequentes</p>
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('affiliates') }}" class="menu-link">
                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg" class="custom-svg-icon">
                                        <mask id="mask0_56_124" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="24" height="24">
                                            <rect width="24" height="24" />
                                        </mask>
                                        <g mask="url(#mask0_56_124)">
                                            <path
                                                d="M8.99999 17C8.44999 17 7.97916 16.8042 7.58749 16.4125C7.19582 16.0208 6.99999 15.55 6.99999 15V4C6.99999 3.45 7.19582 2.97917 7.58749 2.5875C7.97916 2.19583 8.44999 2 8.99999 2H14.875C14.7417 2.31667 14.6458 2.64167 14.5875 2.975C14.5292 3.30833 14.5 3.65 14.5 4H8.99999V14.2C9.74999 13.5 10.5958 12.9583 11.5375 12.575C12.4792 12.1917 13.4667 12 14.5 12C15.5167 12 16.5 12.1917 17.45 12.575C18.4 12.9583 19.25 13.5 20 14.2C20.0167 14.2167 20.0167 14.2167 20 14.2V9.5C20.35 9.5 20.6917 9.47083 21.025 9.4125C21.3583 9.35417 21.6833 9.25833 22 9.125V15C22 15.55 21.8042 16.0208 21.4125 16.4125C21.0208 16.8042 20.55 17 20 17H8.99999ZM5.59999 21.975C5.04999 22.0417 4.56249 21.9083 4.13749 21.575C3.71249 21.2417 3.45832 20.8 3.37499 20.25L1.99999 9.325C1.91666 8.775 2.04999 8.28333 2.39999 7.85C2.74999 7.41667 3.19999 7.16667 3.74999 7.1L4.99999 6.95V8.95L3.99999 9.075L5.34999 20L12.8 19H18.25C18.25 19.4333 18.075 19.7958 17.725 20.0875C17.375 20.3792 16.975 20.5583 16.525 20.625L5.59999 21.975ZM17.675 6.5L19.45 1.5H20.55L22.35 6.5H21.275L20.9 5.4H19.1L18.725 6.5H17.675ZM19.35 4.65H20.65L20 2.6L19.35 4.65ZM14.5 14C13.9167 14 13.3417 14.0833 12.775 14.25C12.2083 14.4167 11.6833 14.6667 11.2 15H17.8C17.3167 14.6667 16.7917 14.4167 16.225 14.25C15.6583 14.0833 15.0833 14 14.5 14ZM14.5 5.5C15.2667 5.5 15.9167 5.76667 16.45 6.3C16.9833 6.83333 17.25 7.48333 17.25 8.25C17.25 9.01667 16.9833 9.66667 16.45 10.2C15.9167 10.7333 15.2667 11 14.5 11C13.7333 11 13.0833 10.7333 12.55 10.2C12.0167 9.66667 11.75 9.01667 11.75 8.25C11.75 7.48333 12.0167 6.83333 12.55 6.3C13.0833 5.76667 13.7333 5.5 14.5 5.5ZM14.5 7.5C14.2833 7.5 14.1042 7.57083 13.9625 7.7125C13.8208 7.85417 13.75 8.03333 13.75 8.25C13.75 8.46667 13.8208 8.64583 13.9625 8.7875C14.1042 8.92917 14.2833 9 14.5 9C14.7167 9 14.8958 8.92917 15.0375 8.7875C15.1792 8.64583 15.25 8.46667 15.25 8.25C15.25 8.03333 15.1792 7.85417 15.0375 7.7125C14.8958 7.57083 14.7167 7.5 14.5 7.5Z" />
                                        </g>
                                    </svg>
                                    <p>Afiliados</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('use-terms') }}" class="menu-link">
                                    <svg width="24" height="25" viewBox="0 0 24 25"
                                        xmlns="http://www.w3.org/2000/svg" class="custom-svg-icon">
                                        <mask id="mask0_1836_2667" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="24" height="25">
                                            <rect y="0.5" width="24" height="24" />
                                        </mask>
                                        <g mask="url(#mask0_1836_2667)">
                                            <path
                                                d="M9 9.5V7.5H18V9.5H9ZM9 12.5V10.5H18V12.5H9ZM12 22.5H6C5.16667 22.5 4.45833 22.2083 3.875 21.625C3.29167 21.0417 3 20.3333 3 19.5V16.5H6V2.5H21V11.525C20.6667 11.4917 20.3292 11.5042 19.9875 11.5625C19.6458 11.6208 19.3167 11.725 19 11.875V4.5H8V16.5H14L12 18.5H5V19.5C5 19.7833 5.09583 20.0208 5.2875 20.2125C5.47917 20.4042 5.71667 20.5 6 20.5H12V22.5ZM14 22.5V19.425L19.525 13.925C19.675 13.775 19.8417 13.6667 20.025 13.6C20.2083 13.5333 20.3917 13.5 20.575 13.5C20.775 13.5 20.9667 13.5375 21.15 13.6125C21.3333 13.6875 21.5 13.8 21.65 13.95L22.575 14.875C22.7083 15.025 22.8125 15.1917 22.8875 15.375C22.9625 15.5583 23 15.7417 23 15.925C23 16.1083 22.9667 16.2958 22.9 16.4875C22.8333 16.6792 22.725 16.85 22.575 17L17.075 22.5H14ZM15.5 21H16.45L19.475 17.95L19.025 17.475L18.55 17.025L15.5 20.05V21ZM19.025 17.475L18.55 17.025L19.475 17.95L19.025 17.475Z" />
                                        </g>
                                    </svg>
                                    <p>Termos de Uso</p>
                                </a>
                            </li> --}}

                        </ul>
                    </nav>
                    <div class="h-6 border-b border-b-gray-400 mx-4 mb-2"></div>
                    <a href="/admin/my-profile" class="menu-link" role="menuitem" tabindex="-1"
                        id="user-menu-item-0">
                        <svg width="24" height="24" viewBox="0 0 24 24" class="fill-dark-grey"
                            xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_1245_104" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="24" height="24">
                                <rect width="24" height="24" />
                            </mask>
                            <g mask="url(#mask0_1245_104)">
                                <path
                                    d="M5 21C4.45 21 3.97917 20.8042 3.5875 20.4125C3.19583 20.0208 3 19.55 3 19V5C3 4.45 3.19583 3.97917 3.5875 3.5875C3.97917 3.19583 4.45 3 5 3H9.2C9.43333 2.4 9.8 1.91667 10.3 1.55C10.8 1.18333 11.3667 1 12 1C12.6333 1 13.2 1.18333 13.7 1.55C14.2 1.91667 14.5667 2.4 14.8 3H19C19.55 3 20.0208 3.19583 20.4125 3.5875C20.8042 3.97917 21 4.45 21 5V19C21 19.55 20.8042 20.0208 20.4125 20.4125C20.0208 20.8042 19.55 21 19 21H5ZM12 4.25C12.2167 4.25 12.3958 4.17917 12.5375 4.0375C12.6792 3.89583 12.75 3.71667 12.75 3.5C12.75 3.28333 12.6792 3.10417 12.5375 2.9625C12.3958 2.82083 12.2167 2.75 12 2.75C11.7833 2.75 11.6042 2.82083 11.4625 2.9625C11.3208 3.10417 11.25 3.28333 11.25 3.5C11.25 3.71667 11.3208 3.89583 11.4625 4.0375C11.6042 4.17917 11.7833 4.25 12 4.25ZM5 17.85C5.9 16.9667 6.94583 16.2708 8.1375 15.7625C9.32917 15.2542 10.6167 15 12 15C13.3833 15 14.6708 15.2542 15.8625 15.7625C17.0542 16.2708 18.1 16.9667 19 17.85V5H5V17.85ZM12 13C12.9667 13 13.7917 12.6583 14.475 11.975C15.1583 11.2917 15.5 10.4667 15.5 9.5C15.5 8.53333 15.1583 7.70833 14.475 7.025C13.7917 6.34167 12.9667 6 12 6C11.0333 6 10.2083 6.34167 9.525 7.025C8.84167 7.70833 8.5 8.53333 8.5 9.5C8.5 10.4667 8.84167 11.2917 9.525 11.975C10.2083 12.6583 11.0333 13 12 13ZM7 19H17V18.75C16.3 18.1667 15.525 17.7292 14.675 17.4375C13.825 17.1458 12.9333 17 12 17C11.0667 17 10.175 17.1458 9.325 17.4375C8.475 17.7292 7.7 18.1667 7 18.75V19ZM12 11C11.5833 11 11.2292 10.8542 10.9375 10.5625C10.6458 10.2708 10.5 9.91667 10.5 9.5C10.5 9.08333 10.6458 8.72917 10.9375 8.4375C11.2292 8.14583 11.5833 8 12 8C12.4167 8 12.7708 8.14583 13.0625 8.4375C13.3542 8.72917 13.5 9.08333 13.5 9.5C13.5 9.91667 13.3542 10.2708 13.0625 10.5625C12.7708 10.8542 12.4167 11 12 11Z" />
                            </g>
                        </svg>
                        Meu perfil
                    </a>
                    <livewire:logout-button-admin />
                </div>
            </div>
            <h1>
                <a href="{{ route('welcome') }}"
                    class="flex items-center py-1 gap-3 text-xl md:text-4xl font-semibold">
                    @php
                        $logoPath = App\Models\Settings::get('logo');
                    @endphp

                    @if ($logoPath)
                        <img class="w-[45px] h-[40px] object-contain" src="{{ asset($logoPath) }}" alt="Logo">
                    @else
                        <img class="w-[45px] h-[40px] object-contain" src="/assets/images/misc/logo-sorrir.png"
                            alt="Logo">
                    @endif
                    @php
                        $siteName = App\Models\Settings::get('site_name');
                        if (empty($siteName)) {
                            $siteName = '';
                        }
                    @endphp
                    <span>{{ $siteName }}</span>
                </a>
            </h1>
        </div>
        <div class="relative w-max">
            <button type="button" class="user-menu-button -m-1.5 hidden lg:flex items-center p-1.5 w-max "
                aria-expanded="false" aria-haspopup="true">
                <span class="hidden lg:flex lg:items-center">
                    <span class="w-max mr-4 text-sm font-semibold leading-6 text-gray-900 capitalize"
                        aria-hidden="true">{{ Auth::user()->name }}</span>
                </span>
                <img src="/assets/images/misc/icons/expand_more.svg" alt="clique para expadir o menu de usuários">
            </button>
            <div class="user-menu absolute right-0 z-10 mt-2.5 min-w-[150px] origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                style="display: none;">
                <a href="/admin/my-profile" class="menu-link" role="menuitem" tabindex="-1" id="user-menu-item-0">
                    <svg width="24" height="24" viewBox="0 0 24 24" class="fill-dark-gray"
                        xmlns="http://www.w3.org/2000/svg">
                        <mask id="mask0_1245_104" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                            width="24" height="24">
                            <rect width="24" height="24" />
                        </mask>
                        <g mask="url(#mask0_1245_104)">
                            <path
                                d="M5 21C4.45 21 3.97917 20.8042 3.5875 20.4125C3.19583 20.0208 3 19.55 3 19V5C3 4.45 3.19583 3.97917 3.5875 3.5875C3.97917 3.19583 4.45 3 5 3H9.2C9.43333 2.4 9.8 1.91667 10.3 1.55C10.8 1.18333 11.3667 1 12 1C12.6333 1 13.2 1.18333 13.7 1.55C14.2 1.91667 14.5667 2.4 14.8 3H19C19.55 3 20.0208 3.19583 20.4125 3.5875C20.8042 3.97917 21 4.45 21 5V19C21 19.55 20.8042 20.0208 20.4125 20.4125C20.0208 20.8042 19.55 21 19 21H5ZM12 4.25C12.2167 4.25 12.3958 4.17917 12.5375 4.0375C12.6792 3.89583 12.75 3.71667 12.75 3.5C12.75 3.28333 12.6792 3.10417 12.5375 2.9625C12.3958 2.82083 12.2167 2.75 12 2.75C11.7833 2.75 11.6042 2.82083 11.4625 2.9625C11.3208 3.10417 11.25 3.28333 11.25 3.5C11.25 3.71667 11.3208 3.89583 11.4625 4.0375C11.6042 4.17917 11.7833 4.25 12 4.25ZM5 17.85C5.9 16.9667 6.94583 16.2708 8.1375 15.7625C9.32917 15.2542 10.6167 15 12 15C13.3833 15 14.6708 15.2542 15.8625 15.7625C17.0542 16.2708 18.1 16.9667 19 17.85V5H5V17.85ZM12 13C12.9667 13 13.7917 12.6583 14.475 11.975C15.1583 11.2917 15.5 10.4667 15.5 9.5C15.5 8.53333 15.1583 7.70833 14.475 7.025C13.7917 6.34167 12.9667 6 12 6C11.0333 6 10.2083 6.34167 9.525 7.025C8.84167 7.70833 8.5 8.53333 8.5 9.5C8.5 10.4667 8.84167 11.2917 9.525 11.975C10.2083 12.6583 11.0333 13 12 13ZM7 19H17V18.75C16.3 18.1667 15.525 17.7292 14.675 17.4375C13.825 17.1458 12.9333 17 12 17C11.0667 17 10.175 17.1458 9.325 17.4375C8.475 17.7292 7.7 18.1667 7 18.75V19ZM12 11C11.5833 11 11.2292 10.8542 10.9375 10.5625C10.6458 10.2708 10.5 9.91667 10.5 9.5C10.5 9.08333 10.6458 8.72917 10.9375 8.4375C11.2292 8.14583 11.5833 8 12 8C12.4167 8 12.7708 8.14583 13.0625 8.4375C13.3542 8.72917 13.5 9.08333 13.5 9.5C13.5 9.91667 13.3542 10.2708 13.0625 10.5625C12.7708 10.8542 12.4167 11 12 11Z" />
                        </g>
                    </svg>
                    Meu perfil
                </a>
                <livewire:logout-button-admin />
            </div>
        </div>
    </header>

    <main class="flex w-full">
        @php
            $getAcceptedUseTerms = getAcceptedUseTerms();
        @endphp
        @if (!$getAcceptedUseTerms && !Route::is('use-terms'))
            <div class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-50">
                <div class="bg-white p-8 rounded-lg shadow-lg max-w-md">
                    <button class="flex w-full justify-end  mr-6 text-gray-600 hover:text-gray-800"
                        onclick="cancelModal()">
                        <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M18.293 5.293a1 1 0 011.414 1.414L13.414 12l6.293 6.293a1 1 0 01-1.414 1.414L12 13.414l-6.293 6.293a1 1 0 01-1.414-1.414L10.586 12 4.293 5.707a1 1 0 011.414-1.414L12 10.586l6.293-6.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <h2 class="text-lg font-semibold mb-4">Atualizamos nossos Termos de Uso</h2>
                    <p class="mb-6">Por favor, aceite os termos de uso antes de prosseguir.</p>
                    <div class="flex justify-center">
                        <button class="primary-button" onclick="acceptTerms()">Ir para os Termos de Uso</button>
                    </div>
                </div>
            </div>
        @endif
        <div class="menu-wrapper hidden lg:block">
            <div
                class="side-menu   min-w-64  border border-r-slate-200  bg-white border-r border-gray-300 overflow-y-auto  h-screen fixed top-[63px]">
                <nav class="w-full h-full flex flex-1 flex-col">
                    <ul role="list w-full">
                        <li class="w-full">
                            <a href="{{ route('home') }}"
                                class="menu-link w-full  {{ request()->routeIs('home') ? 'menu-link-active' : '' }}">
                                <svg width="24" height="24" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="custom-svg-icon  {{ request()->routeIs('home') ? 'custom-svg-icon-active' : '' }}">
                                    <mask id="mask0_56_21" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="24">
                                        <rect width="24" height="24" />
                                    </mask>
                                    <g mask="url(#mask0_56_21)">
                                        <path
                                            d="M6 19H9V13H15V19H18V10L12 5.5L6 10V19ZM4 21V9L12 3L20 9V21H13V15H11V21H4Z" />
                                    </g>
                                </svg>
                                <p>Home</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('panel') }}"
                                class="menu-link {{ request()->routeIs('panel') ? 'menu-link-active' : '' }}">
                                <svg width="18" height="18" viewBox="0 0 18 18"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="custom-svg-icon {{ request()->routeIs('panel') ? 'custom-svg-icon-active' : '' }}">
                                    <path
                                        d="M2 18C1.45 18 0.979167 17.8042 0.5875 17.4125C0.195833 17.0208 0 16.55 0 16V2C0 1.45 0.195833 0.979167 0.5875 0.5875C0.979167 0.195833 1.45 0 2 0H11V2H2V16H16V7H18V16C18 16.55 17.8042 17.0208 17.4125 17.4125C17.0208 17.8042 16.55 18 16 18H2ZM14 6V4H12V2H14V0H16V2H18V4H16V6H14ZM3 14H15L11.25 9L8.25 13L6 10L3 14Z" />
                                </svg>
                                <p>Carrossel de Imagens</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('my_raffles') }}"
                                class="menu-link {{ request()->routeIs('my_raffles') ? 'menu-link-active' : '' }}">
                                <svg width="20" height="16" viewBox="0 0 20 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="custom-svg-icon {{ request()->routeIs('my_raffles') ? 'custom-svg-icon-active' : '' }}">
                                    <path d=" M10 13C10.2833 13 10.5208 12.9042 10.7125 12.7125C10.9042 12.5208 11
                                12.2833 11 12C11 11.7167 10.9042 11.4792 10.7125 11.2875C10.5208 11.0958 10.2833 11 10
                                11C9.71667 11 9.47917 11.0958 9.2875 11.2875C9.09583 11.4792 9 11.7167 9 12C9 12.2833
                                9.09583 12.5208 9.2875 12.7125C9.47917 12.9042 9.71667 13 10 13ZM10 9C10.2833 9 10.5208
                                8.90417 10.7125 8.7125C10.9042 8.52083 11 8.28333 11 8C11 7.71667 10.9042 7.47917
                                10.7125 7.2875C10.5208 7.09583 10.2833 7 10 7C9.71667 7 9.47917 7.09583 9.2875
                                7.2875C9.09583 7.47917 9 7.71667 9 8C9 8.28333 9.09583 8.52083 9.2875 8.7125C9.47917
                                8.90417 9.71667 9 10 9ZM10 5C10.2833 5 10.5208 4.90417 10.7125 4.7125C10.9042 4.52083 11
                                4.28333 11 4C11 3.71667 10.9042 3.47917 10.7125 3.2875C10.5208 3.09583 10.2833 3 10
                                3C9.71667 3 9.47917 3.09583 9.2875 3.2875C9.09583 3.47917 9 3.71667 9 4C9 4.28333
                                9.09583 4.52083 9.2875 4.7125C9.47917 4.90417 9.71667 5 10 5ZM18 16H2C1.45 16 0.979167
                                15.8042 0.5875 15.4125C0.195833 15.0208 0 14.55 0 14V10C0.55 10 1.02083 9.80417 1.4125
                                9.4125C1.80417 9.02083 2 8.55 2 8C2 7.45 1.80417 6.97917 1.4125 6.5875C1.02083 6.19583
                                0.55 6 0 6V2C0 1.45 0.195833 0.979167 0.5875 0.5875C0.979167 0.195833 1.45 0 2
                                0H18C18.55 0 19.0208 0.195833 19.4125 0.5875C19.8042 0.979167 20 1.45 20 2V6C19.45 6
                                18.9792 6.19583 18.5875 6.5875C18.1958 6.97917 18 7.45 18 8C18 8.55 18.1958 9.02083
                                18.5875 9.4125C18.9792 9.80417 19.45 10 20 10V14C20 14.55 19.8042 15.0208 19.4125
                                15.4125C19.0208 15.8042 18.55 16 18 16ZM18 14V11.45C17.3833 11.0833 16.8958 10.5958
                                16.5375 9.9875C16.1792 9.37917 16 8.71667 16 8C16 7.28333 16.1792 6.62083 16.5375
                                6.0125C16.8958 5.40417 17.3833 4.91667 18 4.55V2H2V4.55C2.61667 4.91667 3.10417 5.40417
                                3.4625 6.0125C3.82083 6.62083 4 7.28333 4 8C4 8.71667 3.82083 9.37917 3.4625
                                9.9875C3.10417 10.5958 2.61667 11.0833 2 11.45V14H18Z" />
                                </svg>
                                <p>Minhas Ações</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customers') }}"
                                class="menu-link {{ request()->routeIs('customers') ? 'menu-link-active' : '' }}">
                                <svg width="24" height="24" viewBox="0 0 24 24"
                                    class="custom-svg-icon {{ request()->routeIs('customers') ? 'custom-svg-icon-active' : '' }}"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_56_99" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="24">
                                        <rect width="24" height="24" />
                                    </mask>
                                    <g mask="url(#mask0_56_99)">
                                        <path
                                            d="M12 12C10.9 12 9.95833 11.6083 9.175 10.825C8.39167 10.0417 8 9.1 8 8C8 6.9 8.39167 5.95833 9.175 5.175C9.95833 4.39167 10.9 4 12 4C13.1 4 14.0417 4.39167 14.825 5.175C15.6083 5.95833 16 6.9 16 8C16 9.1 15.6083 10.0417 14.825 10.825C14.0417 11.6083 13.1 12 12 12ZM4 20V17.2C4 16.6333 4.14583 16.1125 4.4375 15.6375C4.72917 15.1625 5.11667 14.8 5.6 14.55C6.63333 14.0333 7.68333 13.6458 8.75 13.3875C9.81667 13.1292 10.9 13 12 13C13.1 13 14.1833 13.1292 15.25 13.3875C16.3167 13.6458 17.3667 14.0333 18.4 14.55C18.8833 14.8 19.2708 15.1625 19.5625 15.6375C19.8542 16.1125 20 16.6333 20 17.2V20H4ZM6 18H18V17.2C18 17.0167 17.9542 16.85 17.8625 16.7C17.7708 16.55 17.65 16.4333 17.5 16.35C16.6 15.9 15.6917 15.5625 14.775 15.3375C13.8583 15.1125 12.9333 15 12 15C11.0667 15 10.1417 15.1125 9.225 15.3375C8.30833 15.5625 7.4 15.9 6.5 16.35C6.35 16.4333 6.22917 16.55 6.1375 16.7C6.04583 16.85 6 17.0167 6 17.2V18ZM12 10C12.55 10 13.0208 9.80417 13.4125 9.4125C13.8042 9.02083 14 8.55 14 8C14 7.45 13.8042 6.97917 13.4125 6.5875C13.0208 6.19583 12.55 6 12 6C11.45 6 10.9792 6.19583 10.5875 6.5875C10.1958 6.97917 10 7.45 10 8C10 8.55 10.1958 9.02083 10.5875 9.4125C10.9792 9.80417 11.45 10 12 10Z" />
                                    </g>
                                </svg>
                                <p>Clientes</p>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('edit-site') }}"
                                class="menu-link {{ request()->routeIs('edit-site') ? 'menu-link-active' : '' }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                    class="custom-svg-icon {{ request()->routeIs('edit-site') ? 'custom-svg-icon-active' : '' }}">
                                    <mask id="mask0_56_104" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="24">
                                        <rect width="24" height="24" />
                                    </mask>
                                    <g mask="url(#mask0_56_104)">
                                        <path
                                            d="M18 20V17H15V15H18V12H20V15H23V17H20V20H18ZM3 21C2.45 21 1.97917 20.8042 1.5875 20.4125C1.19583 20.0208 1 19.55 1 19V5C1 4.45 1.19583 3.97917 1.5875 3.5875C1.97917 3.19583 2.45 3 3 3H17C17.55 3 18.0208 3.19583 18.4125 3.5875C18.8042 3.97917 19 4.45 19 5V10H17V8H3V19H16V21H3ZM3 6H17V5H3V6Z" />
                                    </g>
                                </svg>
                                <p>Editar seu Site</p>
                            </a>
                        </li> --}}
                        <li>
                            <a href="{{ route('pedidos') }}"
                                class="menu-link {{ request()->routeIs('pedidos') ? 'menu-link-active' : '' }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="custom-svg-icon {{ request()->routeIs('pedidos') ? 'custom-svg-icon-active' : '' }}">
                                    <mask id="mask0_56_109" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="24">
                                        <rect width="24" height="24" />
                                    </mask>
                                    <g mask="url(#mask0_56_109)">
                                        <path
                                            d="M6 15H13L15 13H6V15ZM6 11H12V9H6V11ZM4 7V17H11L9 19H2V5H22V8H20V7H4ZM22.9 12.3C22.9833 12.3833 23.025 12.475 23.025 12.575C23.025 12.675 22.9833 12.7667 22.9 12.85L22 13.75L20.25 12L21.15 11.1C21.2333 11.0167 21.325 10.975 21.425 10.975C21.525 10.975 21.6167 11.0167 21.7 11.1L22.9 12.3ZM13 21V19.25L19.65 12.6L21.4 14.35L14.75 21H13Z" />
                                    </g>
                                </svg>
                                <p>Pedidos</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('faq') }}"
                                class="menu-link {{ request()->routeIs('faq') ? 'menu-link-active' : '' }}">
                                <svg width="24" height="24" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="custom-svg-icon {{ request()->routeIs('faq') ? 'custom-svg-icon-active' : '' }}">
                                    <mask id="mask0_56_114" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="24">
                                        <rect width="24" height="24" />
                                    </mask>
                                    <g mask="url(#mask0_56_114)">
                                        <path
                                            d="M14 15C14.2833 15 14.5292 14.8958 14.7375 14.6875C14.9458 14.4792 15.05 14.2333 15.05 13.95C15.05 13.6667 14.9458 13.4208 14.7375 13.2125C14.5292 13.0042 14.2833 12.9 14 12.9C13.7167 12.9 13.4708 13.0042 13.2625 13.2125C13.0542 13.4208 12.95 13.6667 12.95 13.95C12.95 14.2333 13.0542 14.4792 13.2625 14.6875C13.4708 14.8958 13.7167 15 14 15ZM13.25 11.8H14.75C14.75 11.3167 14.8 10.9625 14.9 10.7375C15 10.5125 15.2333 10.2167 15.6 9.85C16.1 9.35 16.4333 8.94583 16.6 8.6375C16.7667 8.32917 16.85 7.96667 16.85 7.55C16.85 6.8 16.5875 6.1875 16.0625 5.7125C15.5375 5.2375 14.85 5 14 5C13.3167 5 12.7208 5.19167 12.2125 5.575C11.7042 5.95833 11.35 6.46667 11.15 7.1L12.5 7.65C12.65 7.23333 12.8542 6.92083 13.1125 6.7125C13.3708 6.50417 13.6667 6.4 14 6.4C14.4 6.4 14.725 6.5125 14.975 6.7375C15.225 6.9625 15.35 7.26667 15.35 7.65C15.35 7.88333 15.2833 8.10417 15.15 8.3125C15.0167 8.52083 14.7833 8.78333 14.45 9.1C13.9 9.58333 13.5625 9.9625 13.4375 10.2375C13.3125 10.5125 13.25 11.0333 13.25 11.8ZM8 18C7.45 18 6.97917 17.8042 6.5875 17.4125C6.19583 17.0208 6 16.55 6 16V4C6 3.45 6.19583 2.97917 6.5875 2.5875C6.97917 2.19583 7.45 2 8 2H20C20.55 2 21.0208 2.19583 21.4125 2.5875C21.8042 2.97917 22 3.45 22 4V16C22 16.55 21.8042 17.0208 21.4125 17.4125C21.0208 17.8042 20.55 18 20 18H8ZM8 16H20V4H8V16ZM4 22C3.45 22 2.97917 21.8042 2.5875 21.4125C2.19583 21.0208 2 20.55 2 20V6H4V20H18V22H4Z" />
                                    </g>
                                </svg>
                                <p>Perguntas Frequentes</p>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('affiliates') }}"
                                class="menu-link {{ request()->routeIs('affiliates') ? 'menu-link-active' : '' }}">
                                <svg width="24" height="24" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="custom-svg-icon {{ request()->routeIs('affiliates') ? 'custom-svg-icon-active' : '' }}">
                                    <mask id="mask0_56_124" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="24" height="24">
                                        <rect width="24" height="24" />
                                    </mask>
                                    <g mask="url(#mask0_56_124)">
                                        <path
                                            d="M8.99999 17C8.44999 17 7.97916 16.8042 7.58749 16.4125C7.19582 16.0208 6.99999 15.55 6.99999 15V4C6.99999 3.45 7.19582 2.97917 7.58749 2.5875C7.97916 2.19583 8.44999 2 8.99999 2H14.875C14.7417 2.31667 14.6458 2.64167 14.5875 2.975C14.5292 3.30833 14.5 3.65 14.5 4H8.99999V14.2C9.74999 13.5 10.5958 12.9583 11.5375 12.575C12.4792 12.1917 13.4667 12 14.5 12C15.5167 12 16.5 12.1917 17.45 12.575C18.4 12.9583 19.25 13.5 20 14.2C20.0167 14.2167 20.0167 14.2167 20 14.2V9.5C20.35 9.5 20.6917 9.47083 21.025 9.4125C21.3583 9.35417 21.6833 9.25833 22 9.125V15C22 15.55 21.8042 16.0208 21.4125 16.4125C21.0208 16.8042 20.55 17 20 17H8.99999ZM5.59999 21.975C5.04999 22.0417 4.56249 21.9083 4.13749 21.575C3.71249 21.2417 3.45832 20.8 3.37499 20.25L1.99999 9.325C1.91666 8.775 2.04999 8.28333 2.39999 7.85C2.74999 7.41667 3.19999 7.16667 3.74999 7.1L4.99999 6.95V8.95L3.99999 9.075L5.34999 20L12.8 19H18.25C18.25 19.4333 18.075 19.7958 17.725 20.0875C17.375 20.3792 16.975 20.5583 16.525 20.625L5.59999 21.975ZM17.675 6.5L19.45 1.5H20.55L22.35 6.5H21.275L20.9 5.4H19.1L18.725 6.5H17.675ZM19.35 4.65H20.65L20 2.6L19.35 4.65ZM14.5 14C13.9167 14 13.3417 14.0833 12.775 14.25C12.2083 14.4167 11.6833 14.6667 11.2 15H17.8C17.3167 14.6667 16.7917 14.4167 16.225 14.25C15.6583 14.0833 15.0833 14 14.5 14ZM14.5 5.5C15.2667 5.5 15.9167 5.76667 16.45 6.3C16.9833 6.83333 17.25 7.48333 17.25 8.25C17.25 9.01667 16.9833 9.66667 16.45 10.2C15.9167 10.7333 15.2667 11 14.5 11C13.7333 11 13.0833 10.7333 12.55 10.2C12.0167 9.66667 11.75 9.01667 11.75 8.25C11.75 7.48333 12.0167 6.83333 12.55 6.3C13.0833 5.76667 13.7333 5.5 14.5 5.5ZM14.5 7.5C14.2833 7.5 14.1042 7.57083 13.9625 7.7125C13.8208 7.85417 13.75 8.03333 13.75 8.25C13.75 8.46667 13.8208 8.64583 13.9625 8.7875C14.1042 8.92917 14.2833 9 14.5 9C14.7167 9 14.8958 8.92917 15.0375 8.7875C15.1792 8.64583 15.25 8.46667 15.25 8.25C15.25 8.03333 15.1792 7.85417 15.0375 7.7125C14.8958 7.57083 14.7167 7.5 14.5 7.5Z" />
                                    </g>
                                </svg>
                                <p>Afiliados</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('use-terms') }}"
                                class="menu-link {{ request()->routeIs('use-terms') ? 'menu-link-active' : '' }}">
                                <svg width="24" height="25" viewBox="0 0 24 25"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="custom-svg-icon {{ request()->routeIs('use-terms') ? 'custom-svg-icon-active' : '' }}">
                                    <mask id="mask0_1836_2667" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                        x="0" y="0" width="24" height="25">
                                        <rect y="0.5" width="24" height="24" />
                                    </mask>
                                    <g mask="url(#mask0_1836_2667)">
                                        <path
                                            d="M9 9.5V7.5H18V9.5H9ZM9 12.5V10.5H18V12.5H9ZM12 22.5H6C5.16667 22.5 4.45833 22.2083 3.875 21.625C3.29167 21.0417 3 20.3333 3 19.5V16.5H6V2.5H21V11.525C20.6667 11.4917 20.3292 11.5042 19.9875 11.5625C19.6458 11.6208 19.3167 11.725 19 11.875V4.5H8V16.5H14L12 18.5H5V19.5C5 19.7833 5.09583 20.0208 5.2875 20.2125C5.47917 20.4042 5.71667 20.5 6 20.5H12V22.5ZM14 22.5V19.425L19.525 13.925C19.675 13.775 19.8417 13.6667 20.025 13.6C20.2083 13.5333 20.3917 13.5 20.575 13.5C20.775 13.5 20.9667 13.5375 21.15 13.6125C21.3333 13.6875 21.5 13.8 21.65 13.95L22.575 14.875C22.7083 15.025 22.8125 15.1917 22.8875 15.375C22.9625 15.5583 23 15.7417 23 15.925C23 16.1083 22.9667 16.2958 22.9 16.4875C22.8333 16.6792 22.725 16.85 22.575 17L17.075 22.5H14ZM15.5 21H16.45L19.475 17.95L19.025 17.475L18.55 17.025L15.5 20.05V21ZM19.025 17.475L18.55 17.025L19.475 17.95L19.025 17.475Z" />
                                    </g>
                                </svg>
                                <p>Termos de Uso</p>
                            </a>
                        </li> --}}

                    </ul>
                </nav>
            </div>
        </div>
        <div class="main-content  flex-grow w-full lg:ml-[250px] min-h-screen bg-yellow-100/50 p-4">
            @yield('content')
        </div>
    </main>
    @livewireScripts
</body>

</html>
<script>
    function toggleMenu() {
        const sideMenu = document.querySelector('.side-menu');
        const mainContent = document.querySelector('.main-content');

        // Toggle the 'hidden' class on the side menu
        sideMenu.classList.toggle('hidden');

        // Check if the side menu is hidden
        const isMenuHidden = sideMenu.classList.contains('hidden');

        // If the side menu is hidden, remove ml-[200px] class from main content, otherwise add it
        if (isMenuHidden) {
            mainContent.classList.remove('lg:ml-[250px]');
        } else {
            mainContent.classList.add('lg:ml-[250px]');
        }
    }

    $(document).ready(function() {
        $('.open-mobile-menu-btn').click(function() {
            $(this).next('.mobile-menu').toggle();
        });

        $(document).click(function(e) {
            if (!$(e.target).closest('.open-mobile-menu-btn').length) {
                $('.mobile-menu').hide();
            }
        });
    });

    $(document).ready(function() {
        $('.user-menu-button').click(function() {
            $(this).next('.user-menu').toggle();
        });

        $(document).click(function(e) {
            if (!$(e.target).closest('.user-menu-button').length) {
                $('.user-menu').hide();
            }
        });
    });
</script>
<script>
    function cancelModal() {
        // Aqui você pode adicionar a lógica para lidar com o cancelamento da modal
        // Por exemplo, pode redirecionar o usuário de volta à página inicial
        window.location.href = "{{ route('home') }}"; // Substitua pela rota correta
    }

    function acceptTerms() {
        // Aqui você pode adicionar a lógica para lidar com a aceitação dos termos de uso
        // Por exemplo, pode fazer uma requisição AJAX para atualizar o status de aceitação no servidor
        // Ou simplesmente redirecionar o usuário para a página onde ele pode aceitar os termos
        window.location.href = "{{ route('use-terms') }}"; // Substitua pela rota correta
    }
</script>
