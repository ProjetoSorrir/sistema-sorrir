<div>
    <script src="https://unpkg.com/imask"></script>

    <style type="text/css">
        .box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, .05);
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            display: none;
            <- Crashes Chrome on hover -webkit-appearance: none;
            margin: 0;
            /* <-- Apparently some margin are still there even though it's hidden */
        }

        input[type=number] {
            -moz-appearance: textfield;
            /* Firefox */
        }

        .bottom-shadow:before {
            content: '';
            position: absolute;
            bottom: 0;
            height: 90px;
            background: linear-gradient(0deg, #000000ba, transparent);
            width: 100%;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .social_icons {
            display: none;
        }

        .pulse {
            animation: opacity-pulse 2s linear infinite;
        }

        .custom-text-ellipsis {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 4;
            /* Número de linhas a serem exibidas */
        }

        @keyframes opacity-pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
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
            content: "Mais popular";
            background-color: #10D305;
            position: absolute;
            color: #fff;
            z-index: 2;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
        }

        .animate-marquee {
            animation: marquee 10s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-130%);
            }
        }

        .svg-icon {
            width: 1.5rem;
            /* 24px */
            height: 1.5rem;
            /* 24px */
        }
    </style>

    {{-- Modal --}}

    <div>
        {{-- @livewire('buy-modal', ['initialNumbersArray' => $numbersArray, 'raffleId' => $this->raffleId]) --}}
        <!-- Modal Content -->
        <div class="fixed top-0 left-0 w-full h-full bg-gray-800 opacity-75 z-40 @if (!$modalOpenState) hidden @endif"
            id="backdrop"></div>
        <div class="@if (!$modalOpenState) hidden @endif fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-4 rounded-lg shadow-lg z-50 w-[90%] md:w-[500px] max-w-[90%] max-h-[90%] overflow-y-auto"
            id="modalContent">
            <button wire:click="closeModal" wire:ignore
                style="position: absolute; right: 10px; top: 10px; border: none; background: none; font-size: 24px; cursor: pointer;"
                class="m-2">&times;</button>
            @if ($isUserLoggedIn)
                <h2 class="text-xl font-bold text-gray-800 mb-8">Confirme seu pedido:</h2>

                <div class="col-span-full flex gap-4 bg-[#f1f1f1] p-2 rounded-lg">
                    <div>
                        <div class="w-[100px] h-[100px] rounded-lg"
                            style="align-content: end; background-size: cover !important; background-position: 100% !important; background: url('<?= asset('assets/images/misc/thumb-wepremios-01.png') ?>')">
                        </div>
                    </div>
                    <div class="grid content-between w-full">
                        <div>
                            <div class="col-span-full flex gap-2 h-fit">
                                <p> <b>{{ $name }}</b>
                                </p>
                            </div>
                            <div>
                                <p><b>Processo SUSEP:</b> {{ $susep_process }}</p>
                                <p><b>Quantidade de títulos:</b> {{ $numbersRequested }}</p>
                                <p><b>Valor do Título:</b> {{ $item['valor'] }}</p>
                                <p><b>Valor Total:</b> R$
                                    {{ number_format($this->numbersRequested * $this->price_per_number, 2, ',', '.') }}
                                </p>
                            </div>
                            <div class="grid lg:flex mt-2 gap-2">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <p class="text-xs">Ao realizar este pagamento e confirmar a compra deste título de capitalização,
                        declaro ter lido e concordado com as condições gerais e políticas de privacidade abaixo.</p>
                    <div class="grid grid-cols-2 text-center pt-2">
                        <a class="text-xs cursor-pointer text-[#0b3dff]"
                            href="{{ route('open-pdf', ['filename' => 'CG_PU02FILA_20 - Proc.pdf']) }}"
                            target="_blank">Condições Gerais</a>
                        <a class="text-xs cursor-pointer text-[#0b3dff]"
                            href="https://3613e03b7c2de35a295c50584bbb6b52.cdn.bubble.io/f1708045124278x654216989445584900/Pol%C3%ADtica%20Institucional%20de%20Privacidade%20e%20Prote%C3%A7%C3%A3o%20de%20Dados%20Externa.pdf"
                            target="_blank">Políticas de Privacidade</a>
                    </div>
                </div>
            @else
            @endif
            @if (!$isUserLoggedIn)
                @if (!$login)
                    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-sm  overflow-y-auto max-h-[90%]">
                        <div class="mb-10 pt-2 mx-auto col-span-12 text-center">
                            <p class="text-4xl text-[#000]/80 font-bold">Acessar conta</p>
                            <p class="text-[#000]/60 text-xs font-medium">Utilize o e-mail e senha que você utilizou
                                para cadastrar:</p>
                        </div>
                        <form class="col-span-12 mx-auto grid grid-cols-12 gap-4 w-[350px] max-w-full"
                            wire:submit.prevent="loginCaller">
                            <div class="input-container col-span-12" x-data x-init="IMask(document.getElementById('cpf'), { mask: '000.000.000-00' })">
                                <label for="cpf">Seu CPF:</label>
                                <input wire:model="form.cpf" id="cpf" name="cpf" type="text"
                                    autocomplete="cpf" placeholder="Digite seu CPF" required>
                                @error('cpf')
                                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                        <span class="text-sm text-white">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div id="show_hide_password" class="col-span-12">
                                <div class="input-container col-span-12">

                                    <label for="password" class="text-sm font-medium leading-6 text-gray-900">Sua
                                        senha:</label>
                                    <div
                                        class="flex items-center rounded border px-1 border-[#e3e3e3] w-full text-black font-medium bg-[#f4f4f4]">
                                        <input wire:model="form.password" id="password" name="password" type="password"
                                            placeholder="Digite sua senha" autocomplete="current-password" required
                                            class="border-none w-full">
                                        <div id="password-eye" class="mr-2 cursor-pointer"
                                            onclick="togglePasswordVisibility('password')">
                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                class="fill-dark-grey" xmlns="http://www.w3.org/2000/svg">
                                                <mask id="mask0_1130_3314" style="mask-type:alpha"
                                                    maskUnits="userSpaceOnUse" x="0" y="0" width="24"
                                                    height="24">
                                                    <rect width="24" height="24" />
                                                </mask>
                                                <g mask="url(#mask0_1130_3314)">
                                                    <path
                                                        d="M12 16C13.25 16 14.3125 15.5625 15.1875 14.6875C16.0625 13.8125 16.5 12.75 16.5 11.5C16.5 10.25 16.0625 9.1875 15.1875 8.3125C14.3125 7.4375 13.25 7 12 7C10.75 7 9.6875 7.4375 8.8125 8.3125C7.9375 9.1875 7.5 10.25 7.5 11.5C7.5 12.75 7.9375 13.8125 8.8125 14.6875C9.6875 15.5625 10.75 16 12 16ZM12 14.2C11.25 14.2 10.6125 13.9375 10.0875 13.4125C9.5625 12.8875 9.3 12.25 9.3 11.5C9.3 10.75 9.5625 10.1125 10.0875 9.5875C10.6125 9.0625 11.25 8.8 12 8.8C12.75 8.8 13.3875 9.0625 13.9125 9.5875C14.4375 10.1125 14.7 10.75 14.7 11.5C14.7 12.25 14.4375 12.8875 13.9125 13.4125C13.3875 13.9375 12.75 14.2 12 14.2ZM12 19C9.56667 19 7.35 18.3208 5.35 16.9625C3.35 15.6042 1.9 13.7833 1 11.5C1.9 9.21667 3.35 7.39583 5.35 6.0375C7.35 4.67917 9.56667 4 12 4C14.4333 4 16.65 4.67917 18.65 6.0375C20.65 7.39583 22.1 9.21667 23 11.5C22.1 13.7833 20.65 15.6042 18.65 16.9625C16.65 18.3208 14.4333 19 12 19ZM12 17C13.8833 17 15.6125 16.5042 17.1875 15.5125C18.7625 14.5208 19.9667 13.1833 20.8 11.5C19.9667 9.81667 18.7625 8.47917 17.1875 7.4875C15.6125 6.49583 13.8833 6 12 6C10.1167 6 8.3875 6.49583 6.8125 7.4875C5.2375 8.47917 4.03333 9.81667 3.2 11.5C4.03333 13.1833 5.2375 14.5208 6.8125 15.5125C8.3875 16.5042 10.1167 17 12 17Z" />
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                @error('password')
                                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                        <span class="text-sm text-white">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-span-12">
                                <label for="remember" class="flex items-center">
                                    <input wire:model="form.remember" id="remember" type="checkbox"
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-600">Lembrar de mim</span>
                                </label>
                            </div>
                            <div class="col-span-12 mt-2">
                                <button type="submit" class="primary-button w-full uppercase font-bold">Acessar
                                    conta</button>
                                @if (Route::has('forget.password'))
                                    <a href="{{ route('forget.password') }}"
                                        class="primary-button min-w-full grid text-center mt-2 uppercase font-bold"
                                        style="background: #d5d5d5 !important; color: #FFD700;">Recuperar senha</a>
                                @endif
                            </div>
                        </form>
                        <p class="col-span-12 mx-auto text-gray-500 text-center w-[350px] max-w-full"
                            style="border: 1px dashed #0000002e; border-radius: 7px; padding: 14px 0 10px; line-height: 15px; font-size: 17px;">
                            Ainda não tem conta? <br>
                            <span wire:click="changeLoginButton"
                                class="font-semibold leading-6 text-primary cursor-pointer">Clique aqui para
                                Cadastrar!</span>
                        </p>
                    </div>
                @else
                    <div class="register sm:mx-auto sm:w-full sm:max-w-sm px-4 grid grid-cols-1 mt-4">
                        <!-- <div
                            class="mb-10 mx-auto col-span-12 text-center">
                            <p class="text-4xl text-[#000]/80 font-bold">Cadastrar conta</p>
                            <p class="text-[#000]/60 text-xs font-medium">Preencha seus dados abaixo com atenção</p>
                        </div> -->

                        <form wire:submit.prevent="register"
                            class="col-span-12 mx-auto grid grid-cols-12 gap-4 w-[350px] max-w-full">
                            <div class="input-container col-span-12">
                                <label for="registerName">Nome Completo:</label>
                                <input wire:model.defer="registerName" id="registerName" name="registerName"
                                    type="text" placeholder="Preencha seu nome completo">
                                @error('registerName')
                                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                        <span class="text-sm text-white">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div x-data x-init="IMask(document.getElementById('cpf'), { mask: '000.000.000-00' })" class="input-container col-span-6">
                                <label for="cpf">CPF:</label>
                                <input wire:model.defer="cpf" id="cpf" name="cpf" type="text"
                                    placeholder="Apenas números">
                                @error('cpf')
                                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                        <span class="text-sm text-white">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div class="input-container col-span-6">
                                <label for="birth_date">Nascimento:</label>
                                <input wire:model.defer="birth_date" id="birth_date" name="birth_date" autofocus
                                    placeholder="Ex: 31-01-1990">
                                @error('birth_date')
                                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                        <span class="text-sm text-white">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>


                            <div class="input-container col-span-12">
                                <label for="email">E-mail:</label>
                                <input wire:model.defer="email" id="email" name="email" type="text"
                                    placeholder="Preencha seu e-mail">
                                @error('email')
                                    @unless ($message === 'A confirmação do e-mail não corresponde')
                                        <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                            <span class="text-sm text-white">{{ $message }}</span>
                                        </div>
                                    @endunless
                                @enderror
                            </div>

                            <div class="input-container col-span-12">
                                <label for="email_confirmation">Confirme seu E-mail:</label>
                                <input wire:model.defer="email_confirmation" id="email_confirmation"
                                    name="email_confirmation" type="text" placeholder="Confirme seu e-mail">
                                @error('email')
                                    @if ($message === 'A confirmação do e-mail não corresponde')
                                        <span
                                            class="bg-red-600 rounded-lg px-2 py-1 mt-2 text-white text-sm">{{ $message }}</span>
                                    @endif
                                @enderror
                            </div>

                            <div class="input-container col-span-6">
                                <label for="phone"
                                    class="block text-sm font-medium leading-6 text-gray-900">Telefone:</label>
                                <input type="hidden" id="ddi_hidden" name="ddi" wire:model="ddi" readonly>
                                <input wire:model="phone" id="phone" name="phone" type="text"
                                    maxlength="11" minlength="11" placeholder="Ex: 11900000000" pattern="\d{11}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full">
                                @error('phone')
                                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                        <span class="text-sm text-white">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div class="input-container col-span-6">
                                <label for="cep">CEP:</label>
                                <input wire:model.defer="cep" id="CEP" name="CEP" type="text"
                                    autocomplete="CEP" placeholder="Ex: 00000-000">
                                <!-- <p class="text-xs">Ex: 00000-000</p> -->
                                @error('cep')
                                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                        <span class="text-sm text-white">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const cepInput = document.getElementById('CEP');

                                    cepInput.addEventListener('input', function(e) {
                                        let value = e.target.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
                                        if (value.length > 8) {
                                            value = value.slice(0, 8); // Limita a 8 dígitos
                                        }

                                        let formattedValue = '';

                                        if (value.length > 0) {
                                            formattedValue = value.substring(0, 5);
                                        }
                                        if (value.length > 5) {
                                            formattedValue += '-' + value.substring(5, 8);
                                        }

                                        e.target.value = formattedValue;
                                    });

                                    cepInput.addEventListener('blur', function(e) {
                                        let value = e.target.value.replace(/\D/g, '');
                                        @this.set('cep', value);
                                        e.target.value = value; // Define o valor do input sem a máscara
                                    });
                                });
                            </script>


                            <div id="show_hide_password" class="input-container col-span-12">
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Crie
                                    sua senha:</label>
                                <div
                                    class="flex items-center rounded border px-1 border-[#e3e3e3] w-full text-black font-medium bg-[#f4f4f4]">
                                    <input wire:model.defer="password" id="password" name="password"
                                        type="password" placeholder="Senha com 8+ digitos" class="border-none w-full"
                                        maxlength="20">
                                    <div id="password-eye" class="mr-2 cursor-pointer"
                                        onclick="togglePasswordVisibility('password')">
                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                            class="fill-dark-grey" xmlns="http://www.w3.org/2000/svg">
                                            <mask id="mask0_1130_3314" style="mask-type:alpha"
                                                maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                                                <rect width="24" height="24" />
                                            </mask>
                                            <g mask="url(#mask0_1130_3314)">
                                                <path
                                                    d="M12 16C13.25 16 14.3125 15.5625 15.1875 14.6875C16.0625 13.8125 16.5 12.75 16.5 11.5C16.5 10.25 16.0625 9.1875 15.1875 8.3125C14.3125 7.4375 13.25 7 12 7C10.75 7 9.6875 7.4375 8.8125 8.3125C7.9375 9.1875 7.5 10.25 7.5 11.5C7.5 12.75 7.9375 13.8125 8.8125 14.6875C9.6875 15.5625 10.75 16 12 16ZM12 14.2C11.25 14.2 10.6125 13.9375 10.0875 13.4125C9.5625 12.8875 9.3 12.25 9.3 11.5C9.3 10.75 9.5625 10.1125 10.0875 9.5875C10.6125 9.0625 11.25 8.8 12 8.8C12.75 8.8 13.3875 9.0625 13.9125 9.5875C14.4375 10.1125 14.7 10.75 14.7 11.5C14.7 12.25 14.4375 12.8875 13.9125 13.4125C13.3875 13.9375 12.75 14.2 12 14.2ZM12 19C9.56667 19 7.35 18.3208 5.35 16.9625C3.35 15.6042 1.9 13.7833 1 11.5C1.9 9.21667 3.35 7.39583 5.35 6.0375C7.35 4.67917 9.56667 4 12 4C14.4333 4 16.65 4.67917 18.65 6.0375C20.65 7.39583 22.1 9.21667 23 11.5C22.1 13.7833 20.65 15.6042 18.65 16.9625C16.65 18.3208 14.4333 19 12 19ZM12 17C13.8833 17 15.6125 16.5042 17.1875 15.5125C18.7625 14.5208 19.9667 13.1833 20.8 11.5C19.9667 9.81667 18.7625 8.47917 17.1875 7.4875C15.6125 6.49583 13.8833 6 12 6C10.1167 6 8.3875 6.49583 6.8125 7.4875C5.2375 8.47917 4.03333 9.81667 3.2 11.5C4.03333 13.1833 5.2375 14.5208 6.8125 15.5125C8.3875 16.5042 10.1167 17 12 17Z" />
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                                @error('password')
                                    @unless ($message === 'A confirmação da senha não corresponde')
                                        <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                            <span class="text-sm text-white">{{ $message }}</span>
                                        </div>
                                    @endunless
                                @enderror
                            </div>

                            <div id="show_hide_password_confirmation" class="input-container col-span-12">
                                <label for="password_confirmation"
                                    class="block text-sm font-medium leading-6 text-gray-900">Confirme sua
                                    senha:</label>
                                <div
                                    class="flex items-center rounded border px-1 border-[#e3e3e3] w-full text-black font-medium bg-[#f4f4f4]">
                                    <input wire:model.defer="password_confirmation" id="password_confirmation"
                                        name="password_confirmation" type="password" placeholder="Confirme a senha"
                                        autocomplete="new-password" class="border-none w-full" maxlength="20">
                                    <div id="password_confirmation-eye" class="mr-2 cursor-pointer"
                                        onclick="togglePasswordVisibility('password_confirmation')">
                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                            class="fill-dark-grey" xmlns="http://www.w3.org/2000/svg">
                                            <mask id="mask0_1130_3314" style="mask-type:alpha"
                                                maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                                                <rect width="24" height="24" />
                                            </mask>
                                            <g mask="url(#mask0_1130_3314)">
                                                <path
                                                    d="M12 16C13.25 16 14.3125 15.5625 15.1875 14.6875C16.0625 13.8125 16.5 12.75 16.5 11.5C16.5 10.25 16.0625 9.1875 15.1875 8.3125C14.3125 7.4375 13.25 7 12 7C10.75 7 9.6875 7.4375 8.8125 8.3125C7.9375 9.1875 7.5 10.25 7.5 11.5C7.5 12.75 7.9375 13.8125 8.8125 14.6875C9.6875 15.5625 10.75 16 12 16ZM12 14.2C11.25 14.2 10.6125 13.9375 10.0875 13.4125C9.5625 12.8875 9.3 12.25 9.3 11.5C9.3 10.75 9.5625 10.1125 10.0875 9.5875C10.6125 9.0625 11.25 8.8 12 8.8C12.75 8.8 13.3875 9.0625 13.9125 9.5875C14.4375 10.1125 14.7 10.75 14.7 11.5C14.7 12.25 14.4375 12.8875 13.9125 13.4125C13.3875 13.9375 12.75 14.2 12 14.2ZM12 19C9.56667 19 7.35 18.3208 5.35 16.9625C3.35 15.6042 1.9 13.7833 1 11.5C1.9 9.21667 3.35 7.39583 5.35 6.0375C7.35 4.67917 9.56667 4 12 4C14.4333 4 16.65 4.67917 18.65 6.0375C20.65 7.39583 22.1 9.21667 23 11.5C22.1 13.7833 20.65 15.6042 18.65 16.9625C16.65 18.3208 14.4333 19 12 19ZM12 17C13.8833 17 15.6125 16.5042 17.1875 15.5125C18.7625 14.5208 19.9667 13.1833 20.8 11.5C19.9667 9.81667 18.7625 8.47917 17.1875 7.4875C15.6125 6.49583 13.8833 6 12 6C10.1167 6 8.3875 6.49583 6.8125 7.4875C5.2375 8.47917 4.03333 9.81667 3.2 11.5C4.03333 13.1833 5.2375 14.5208 6.8125 15.5125C8.3875 16.5042 10.1167 17 12 17Z" />
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                                @error('password')
                                    @if ($message === 'A confirmação da senha não corresponde')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @endif
                                @enderror
                            </div>
                            <div class="col-span-12">
                                <button type="submit"
                                    class="primary-button w-full mt-2 uppercase font-bold">Finalizar cadastro</button>
                            </div>
                            <p class="col-span-12 mx-auto text-gray-500 text-center w-[350px] max-w-full"
                                style="border: 1px dashed #0000002e; border-radius: 7px; padding: 14px 0 10px; line-height: 15px; font-size: 17px;">
                                Você já tem conta criada? <br>
                                <span wire:click="changeLoginButton"
                                    class="font-semibold leading-6 text-primary cursor-pointer">Clique aqui para
                                    acessar!</span>
                            </p>
                        </form>

                        <a href="https://3613e03b7c2de35a295c50584bbb6b52.cdn.bubble.io/f1708045124278x654216989445584900/Pol%C3%ADtica%20Institucional%20de%20Privacidade%20e%20Prote%C3%A7%C3%A3o%20de%20Dados%20Externa.pdf"
                            class="col-span-12 mt-3 text-blue-500 underline cursor-pointer text-xs text-center">Políticas
                            de
                            Privacidade</a>
                    </div>
                @endif
            @else
                <div class="col-span-12 mt-2">
                    <div class="flex items-center h-full">
                        <input wire:model="accept_terms" x-model="accept_terms" type="checkbox" class="text-primary"
                            id="accept_terms">
                        <label class="pl-2 text-sm" for="accept_terms">Aceito os Termos e Políticas de
                            Privacidade</label>
                    </div>
                </div>
                <div x-data="{ accept_terms: @entangle('accept_terms') }">
                    <button wire:click="confirmPurchase" :disabled="!accept_terms || $isProcessing"
                        @if ($disabledButton) disabled @endif
                        class="bg-primary text-white font-bold py-2 px-6 rounded-lg mt-6 w-full transition duration-300"
                        wire:loading.attr="disabled">
                        <span wire:loading class="inset-y-0 right-0 flex items-center pr-6">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.373A8 8 0 0012 20v4c-6.627 0-12-5.373-12-12h4zm16-7.373A8 8 0 0012 4v4c3.663 0 6.767 2.475 7.729 5.837l-1.986.674C17.873 11.592 15.886 10 12 10V6h6z">
                                </path>
                            </svg>
                        </span>
                        <span wire:loading class="uppercase">
                            Processando Pedido...
                        </span>
                        <span wire:loading.remove class="uppercase">
                            Confirmar pedido
                        </span>
                    </button>
                </div>
            @endif
        </div>
    </div>

    {{-- fim da modal --}}
    <!-- Seção Principal -->
    <div class="">
        <div>
            @if ($is_raffle_active == null)
                <section class="box p-4 lg:p-12 mt-6">
                    <div class="text-center">
                        <p class="text-lg font-semibold">O sorteio não foi encontrado ou já foi concluído.</p>
                    </div>
                </section>
            @else
                <div class="top-banner bg-primary p-2 flex items-center justify-between w-full rounded-t-lg">
                    <div class="left-container flex justify-center items-center gap-1 md:gap-2">
                        <img src="/assets/images/misc/sorteio.jpg" class="h-auto w-[35px]" alt=""
                            style="height: 100%;">
                        <h2 class="uppercase mx-2 w-[100px] text-white">Sorteios</h2>
                    </div>
                    <p class="text-xs text-light-yellow">Transforme <span class="font-bold ">possibilidades</span> em
                        <span class="font-bold text-sm">realidade </span>
                    </p>
                    <div class="social-medias w-fit flex items-center justify-center gap-2">

                        <a href="https://www.instagram.com/projetosorrir" target="_blank">
                            <svg width="28" height="29" viewBox="0 0 28 29" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="svg-icon min-w-[28px] h-6 w-6">
                                <path
                                    d="M19.8333 2.83325H8.16667C4.94501 2.83325 2.33334 5.44492 2.33334 8.66659V20.3333C2.33334 23.5549 4.94501 26.1666 8.16667 26.1666H19.8333C23.055 26.1666 25.6667 23.5549 25.6667 20.3333V8.66659C25.6667 5.44492 23.055 2.83325 19.8333 2.83325Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M18.6667 13.7651C18.8106 14.7361 18.6448 15.7277 18.1927 16.599C17.7406 17.4702 17.0253 18.1768 16.1486 18.6181C15.2718 19.0594 14.2782 19.213 13.3091 19.057C12.34 18.9011 11.4447 18.4435 10.7506 17.7495C10.0566 17.0554 9.59902 16.1601 9.44308 15.191C9.28714 14.2219 9.44074 13.2283 9.88205 12.3515C10.3234 11.4748 11.0299 10.7595 11.9011 10.3074C12.7724 9.85531 13.764 9.68946 14.735 9.83344C15.7254 9.98031 16.6423 10.4418 17.3503 11.1498C18.0583 11.8578 18.5198 12.7747 18.6667 13.7651Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M20.4167 8.08325H20.4283" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            <!--[if lt IE 9]><em>Instagram</em><![endif]-->
                        </a>
                    </div>

                </div>
                <section>
                    @if (!is_null($image))
                        <div class="grid h-[360px] bg-primary"
                            style="align-content: end; background-size: contain !important; background-position: 50% 0% !important;  !important; background: url('{{ asset($image) }}')">
                        @else
                            <div class="grid h-[360px] w-full"
                                style="align-content: end; background-size: contain !important; background-position: 50% 0% !important;  !important; background: url('<?= asset('assets/images/misc/thumb-wepremios-01.png') ?>')">
                    @endif
                    <div>
                        <div>
                            <div class="backdrop bg-black/30 w-full px-4 py-2">
                                <div class="flex gap-2">
                                    <p class="bg-we-highlight px-2 h-fit rounded-full text-sm font-bold">Adquira já</p>
                                </div>
                                <h1 class='text-[20px] font-semibold text-white'>{{ $name }}</h1>
                                <p class="text-xs text-white">Valor do Título: R$ {{ $item['valor'] }}</p>
                                <p class="text-xs text-white">Processo SUSEP: {{ $susep_process }}</p>
                            </div>

                        </div>
                    </div>
        </div>
        </section>

        <section class="overflow-hidden bg-white  text-primary p-2">
            <div class="animate-marquee flex ">
                <p class="text-sm font-bold opacity-80 pl-[30px]" style="white-space: nowrap;">Quanto mais títulos
                    comprar, maiores são as suas chances de ganhar! 😍🔥</p>
            </div>
        </section>
        <!-- Seção Reserva de Títulos -->
        <section class="pt-2 lg:px-0 bg-gradient-to-r from-gray-100 to-gray-200 rounded-b-md">
            <div class="flex
            text-center text-sm gap-2 justify-center py-2 lg:pb-0">
                Sorteio <span class="bg-white shadow-md px-2 py-1 rounded-lg font-bold text-xs">{{ $draw_date }}
                </span>
                Por apenas <span
                    class="bg-we-highlight  text-white shadow-md px-2 py-1 rounded-lg font-bold text-xs">{{ $item['valor'] }}</span>
            </div>

            <div>

                <div class="text-center mt-0 lg:mt-4">
                    {{--
                        <!-- Voltar quando os titulos esgotarem -->
                        <div class="my-6 mx-auto mb-4 justify-center">
                            <p class="text-lg font-semibold mt-4">Títulos Esgotados</p>
                            <p class="text-xs">No momento não há mais Títulos disponíveis para compra!</p>
                            <div class="my-4 mx-auto pb-4 justify-center">
                                <p>Fique atento para a possível liberação de novos Títulos ou aguarde o sorteio,
                                    programado para {{ $draw_date }}.</p>
                                <p>O sorteio está agendado para {{ $draw_date }} pela
                                    <?php
                                    if ($draw_location === 'loteria_federal') {
                                        echo 'Loteria Federal';
                                    } else {
                                        echo $draw_location;
                                    }
                                    ?>.
                                </p>
                            </div>
                        </div>
                    --}}

                    <div class="text-center">
                    </div>
                    @if ($auto_number_selection)
                        <div class="grid grid-cols-3 gap-1  px-8 ">
                            <div class="min-h-[100px]">
                                <input class="hidden" type="text" value="{{ $auto_buy_option_one }}"
                                    readonly="">
                                <button wire:click="getRandomNumbers({{ $auto_buy_option_one }})"
                                    class="relative text-xs min-h-[100px] w-full px-2 lg:px-4 py-3 border-2 border-primary text-primary font-medium rounded-md auto-buy-btn @if ($auto_buy_highlight === 1) popular @endif"
                                    data-value="{{ $auto_buy_option_one }}"><span
                                        class="text-[25px] font-bold">+</span><span
                                        class="text-[30px] font-bold">{{ $auto_buy_option_one }}</span><br><span
                                        class="uppercase relative top-1">Adicionar</span></button>
                            </div>
                            <div class="min-h-[100px]">
                                <input class="hidden" type="text" value="{{ $auto_buy_option_two }}"
                                    readonly="">
                                <button wire:click="getRandomNumbers({{ $auto_buy_option_two }})"
                                    class="relative text-xs min-h-[100px] w-full px-2 lg:px-4 py-3 border-2 border-primary text-primary font-medium rounded-md auto-buy-bt @if ($auto_buy_highlight === 2) popular @endif"
                                    data-value="{{ $auto_buy_option_two }}"><span
                                        class="text-[25px] font-bold">+</span><span
                                        class="text-[30px] font-bold">{{ $auto_buy_option_two }}</span><br><span
                                        class="uppercase relative top-1">Adicionar</span></button>
                            </div>
                            <div class="min-h-[100px]">
                                <input class="hidden" type="text" value="{{ $auto_buy_option_three }}"
                                    readonly="">
                                <button wire:click="getRandomNumbers({{ $auto_buy_option_three }})"
                                    class="relative text-xs min-h-[100px] w-full px-2 lg:px-4 py-3 border-2 border-primary text-primary font-medium rounded-md auto-buy-bt border-2 @if ($auto_buy_highlight === 3) popular @endif "
                                    data-value="{{ $auto_buy_option_three }}"><span
                                        class="text-[25px] font-bold">+</span><span
                                        class="text-[30px] font-bold">{{ $auto_buy_option_three }}</span><br><span
                                        class="uppercase relative top-1">Adicionar</span></button>
                            </div>
                            <div class="min-h-[100px]">
                                <input class="hidden" type="text" value="{{ $auto_buy_option_four }}"
                                    readonly="">
                                <button wire:click="getRandomNumbers({{ $auto_buy_option_four }})"
                                    class="relative text-xs min-h-[100px] w-full px-2 lg:px-4 py-3 border-2 border-primary text-primary font-medium rounded-md auto-buy-bt @if ($auto_buy_highlight === 4) popular @endif"
                                    data-value="{{ $auto_buy_option_four }}"><span
                                        class="text-[25px] font-bold">+</span><span
                                        class="text-[30px] font-bold">{{ $auto_buy_option_four }}</span><br><span
                                        class="uppercase relative top-1">Adicionar</span></button>
                            </div>
                            <div class="min-h-[100px]">
                                <input class="hidden" type="text" value="{{ $auto_buy_option_five }}"
                                    readonly="">
                                <button wire:click="getRandomNumbers({{ $auto_buy_option_five }})"
                                    class="relative text-xs min-h-[100px] w-full px-2 lg:px-4 py-3 border-2 border-primary text-primary font-medium rounded-md auto-buy-bt @if ($auto_buy_highlight === 5) popular @endif"
                                    data-value="{{ $auto_buy_option_five }}"><span
                                        class="text-[25px] font-bold">+</span><span
                                        class="text-[30px] font-bold">{{ $auto_buy_option_five }}</span><br><span
                                        class="uppercase relative top-1">Adicionar</span></button>
                            </div>
                            <div class="min-h-[100px]">
                                <input class="hidden" type="text" value="{{ $auto_buy_option_six }}"
                                    readonly="">
                                <button wire:click="getRandomNumbers({{ $auto_buy_option_six }})"
                                    class="relative text-xs min-h-[100px] w-full px-2 lg:px-4 py-3 border-2 border-primary text-primary font-medium rounded-md auto-buy-bt @if ($auto_buy_highlight === 6) popular @endif"
                                    data-value="{{ $auto_buy_option_six }}"><span
                                        class="text-[25px] font-bold">+</span><span
                                        class="text-[30px] font-bold">{{ $auto_buy_option_six }}</span><br><span
                                        class="uppercase relative top-1">Adicionar</span></button>
                            </div>
                        </div>
                    @endif
                    <div class="text-center">
                        <div class="p-4 px-10 mt-2">
                            <div class="flex justify-center items-center gap-2 mx-auto">
                                <button
                                    class="h-[40px]  w-[40px]  flex justify-center items-center bg-primary text-white text-3xl font-bold rounded-full"
                                    onclick="decreaseQuantity(0)">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 12H19" stroke="white" stroke-width="6" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <div class="relative flex items-center w-[200px]">
                                    <input wire:model="numbersRequested" type="number" id="quantityInput0"
                                        class="text-[25px] bg-primary rounded-full border-none text-center text-white"
                                        wire:input.debounce.100ms="inputNumber" value="1">
                                    <button class="absolute rounded-full p-2 w-auto text-sm text-white right-3"
                                        onclick="resetQuantity(0)">
                                        <svg class="w-4 h-4" data-slot="icon" fill="none" stroke-width="2"
                                            stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18 18 6M6 6l12 12">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                <button
                                    class="h-[40px]  w-[40px]  flex justify-center items-center bg-we-highlight text-white text-3xl font-bold rounded-full"
                                    onclick="increaseQuantity(0)">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 5V19" stroke="white" stroke-width="6" stroke-linejoin="round" />
                                        <path d="M5 12H19" stroke="white" stroke-width="6" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div
                            class="flex justify-center items-center gap-2 my-2 mx-auto bg-gray-300 mb-6 rounded-lg text-primary font-bold p-2 w-3/4">
                            <div class="uppercase">
                                Participar por:
                                <span id="totalPrice" class="">
                                    {{ $calcFinalValue == 0 ? 0.99 : $calcFinalValue }}
                                </span>
                            </div>
                        </div>

                        <div id="footerTap">
                            <button id="buyButton" wire:click="confirmBuyModal"
                                class="flex justify-center items-center gap-2  w-full mx-auto bg-we-highlight text-black uppercase font-bold p-4 rounded-b-lg">
                                Comprar Agora
                            </button>
                        </div>
                    </div>

                </div>
        </section>

        <div id="openFaqModalBtn" class="flex gap-2 justify-center cursor-pointer"
            style="border-radius: 10px; background: white; align-items: center; padding: 4px; font-size: 19px; margin-top: 7px; color: #FFD700; box-shadow: 0 0 20px #00000021;">
            <svg class="w-10 h-10 opacity-90" data-slot="icon" fill="none" stroke-width="2"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
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
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="faq-container text-[13px]">
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
                                    <p class="text-lg text-black/75">Quero concorrer a ação de 500k WePremios. Como
                                        faço pra participar?</p>
                                </div>
                                <span class="arrow">&#9658;</span>
                            </div>
                            <div class="faq-answer grid gap-4 mt-6">
                                <p>Para participar do sorteio, siga os seguintes passos:</p>
                                <ol class="ml-4">
                                    <li><span class="font-bold">1.</span> Na página da ação, clique em "Quero
                                        participar".</li>
                                    <li><span class="font-bold">2.</span> Insira a quantidade de títulos que deseja
                                        adquirir.</li>
                                    <li><span class="font-bold">3.</span> Clique em "Comprar agora" e informe seus
                                        dados pessoais para realizar o cadastro.</li>
                                    <li><span class="font-bold">4.</span> Confirme seu pedido.</li>
                                    <li><span class="font-bold">5.</span> Copie o código PIX e cole na área PIX do seu
                                        banco para finalizar a transação.</li>
                                </ol>
                                <p>O tempo de confirmação é de até 30 minutos.</p>
                                <p>Obs: Para evitar erros em pagamentos via PIX, é necessário que o seu CPF esteja
                                    registrado no cadastro e que seu e-mail esteja válido. Essa é uma exigência do
                                    Mercado Pago para a geração do código QR Code.</p>
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
                                    <p class="text-lg text-black/75">Como funciona o bilhete premiado?</p>
                                </div>
                                <span class="arrow">&#9658;</span>
                            </div>
                            <div class="faq-answer grid gap-4 mt-6">
                                <p>Quando você efetua a compra de um bilhete premiado na We Premios, o processo é
                                    simples e instantâneo:</p>
                                <ol class="ml-4">
                                    <li><span class="font-bold">1.</span> Efetue a Compra: Após realizar a compra do
                                        seu bilhete, aguarde a confirmação.</li>
                                    <li><span class="font-bold">2.</span> Verificação Instantânea: Se o seu bilhete for
                                        premiado, a informação aparecerá instantaneamente na tela.</li>
                                    <li><span class="font-bold">3.</span> Resultado Imediato: Você saberá na hora se
                                        foi um dos sortudos!</li>
                                </ol>
                                <p>É rápido e seguro! Boa sorte! 🍀</p>
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
                                    <p class="text-lg text-black/75">Comprei e está pendente, o que fazer?</p>
                                </div>
                                <span class="arrow">&#9658;</span>
                            </div>
                            <div class="faq-answer grid gap-4 mt-6">
                                <ol class="ml-4">
                                    <li><span class="font-bold">1.</span> No campo superior esquerdo, clique no menu (3
                                        tracinhos) "Minhas compras".</li>
                                    <li><span class="font-bold">2.</span> Encontre a compra e clique no botão "Pagar"
                                        ao lado do status "Pendente".</li>
                                    <li><span class="font-bold">3.</span> Aguarde 5 segundos, e em seguida o pagamento
                                        será autorizado e seus títulos serão liberados.</li>
                                </ol>
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
                                    <p class="text-lg text-black/75">Esqueci minha senha</p>
                                </div>
                                <span class="arrow">&#9658;</span>
                            </div>
                            <div class="faq-answer grid gap-4 mt-6">
                                <p>Na página de login, você pode clicar em “Recuperar” para redefinir sua senha por
                                    e-mail. Caso tenha registrado um e-mail errado, contate o suporte para solicitar a
                                    alteração.</p>
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
                                    <p class="text-lg text-black/75">Vai aparecer no site qual o número do título
                                        premiado e o ganhador?</p>
                                </div>
                                <span class="arrow">&#9658;</span>
                            </div>
                            <div class="faq-answer grid gap-4 mt-6">
                                <p>Sim, no menu localizado no topo do site (3 tracinhos), clique em "Ganhadores" para
                                    visualizar os ganhadores dos títulos premiados. Sempre que houver um novo ganhador,
                                    aparecerá imediatamente na lista.</p>
                                <p>Além disso, se você adquirir um título premiado, saberá imediatamente na confirmação
                                    da compra.</p>
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
                                    <p class="text-lg text-black/75">Coloquei uma informação incorreta no cadastro,
                                        como posso corrigir?</p>
                                </div>
                                <span class="arrow">&#9658;</span>
                            </div>
                            <div class="faq-answer grid gap-4 mt-6">
                                <ol class="ml-4">
                                    <li><span class="font-bold">1.</span> No topo do site, clique no menu (3 tracinhos)
                                        "Meu Perfil".</li>
                                    <li><span class="font-bold">2.</span> Na sessão "Atualize seu Perfil", atualize o
                                        dado desejado.</li>
                                    <li><span class="font-bold">3.</span> Clique no botão "Atualizar informações".</li>
                                </ol>
                                <p>Para qualquer outro dado, por gentileza, contate nosso suporte.</p>
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
                                    <p class="text-lg text-black/75">Como vou saber se ganhei o prêmio principal?</p>
                                </div>
                                <span class="arrow">&#9658;</span>
                            </div>
                            <div class="faq-answer grid gap-4 mt-6">
                                <p>Você saberá se ganhou o prêmio principal no dia do sorteio, 20 de Julho. O sorteio
                                    será realizado pela Loteria Federal e divulgaremos o resultado ao vivo em live no
                                    instagram.</p>
                                <p>Fique atento e acompanhe a transmissão para ver se você é o grande vencedor. Boa
                                    sorte!</p>
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
                                    <p class="text-lg text-black/75">Como funciona o sorteio, posso acompanhar ao vivo?
                                    </p>
                                </div>
                                <span class="arrow">&#9658;</span>
                            </div>
                            <div class="faq-answer grid gap-4 mt-6">
                                <p>O sorteio é realizado pela Loteria Federal. O resultado será divulgado no dia 20/07
                                    pelo Instagram da We Prêmios.</p>
                                <p>Fique de olho para acompanhar tudo ao vivo e torcer!</p>
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
                                    <p class="text-lg text-black/75">Posso escolher os meus títulos?</p>
                                </div>
                                <span class="arrow">&#9658;</span>
                            </div>
                            <div class="faq-answer grid gap-4 mt-6">
                                <p>Não. Os títulos são distribuídos aleatoriamente para garantir uma distribuição justa
                                    e equitativa entre todos os participantes.</p>
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
                                    <p class="text-lg text-black/75">Quem mora fora do país pode concorrer?</p>
                                </div>
                                <span class="arrow">&#9658;</span>
                            </div>
                            <div class="faq-answer grid gap-4 mt-6">
                                <p>Para concorrer é necessário possuir um CPF e um CEP brasileiro, no entanto, residir
                                    fora do Brasil não é uma restrição.</p>
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

        <section class="rounded-md  bg-black/90 text-white mt-4 h-auto">
            <h3 class="px-4 py-2">Descrição</h3>
            <div class="border-b-2 border-we-bg"></div>
            <div id="content" style="height: auto; min-heigth: 70px;">
                <p id="description" class="text-xs opacity-75 custom-text-ellipsis p-4">{{ $description }}</p>
            </div>
            <div class="button-container w-full px-4 py-2 flex justify-end">
                <button id="read-more" class="text-xs">Ler mais</button>
                <button id="read-less" class="text-xs" style="display: none;">Ler menos</button>
            </div>
        </section>
    </div>
    @endif
</div>
<a href="/my-buys" title="Clique para ver os seus títulos"
    class="flex justify-center items-center gap-2 my-6 mx-auto bg-gray-300 rounded-lg text-primary font-bold p-2 w-full no-underline">
    <div class="uppercase">
        Ver Meus Títulos
    </div>
</a>
</div>



<link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

@script
    <script>
        $wire.on('alertMessage', (mensagem) => {
            Toastify({
                text: mensagem[0].mensagem,
                duration: 3000, // duração em milissegundos
                gravity: 'top', // posição da notificação
                position: 'right', // posição horizontal
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // cor de fundo
                className: "info", // classe CSS adicional
            }).showToast();
        });
    </script>
@endscript

<script type="text/javascript">
    function decreaseQuantity(inputId) {
        var input = document.getElementById('quantityInput' + inputId);
        if (input.value > 0) {
            input.value = parseInt(input.value) - 1;
            input.dispatchEvent(new Event('input'));
        }
    }

    function increaseQuantity(inputId) {
        var input = document.getElementById('quantityInput' + inputId);
        input.value = parseInt(input.value) + 1;
        input.dispatchEvent(new Event('input'));
    }

    function resetQuantity(inputId) {
        var input = document.getElementById('quantityInput' + inputId);
        input.value = 0;
        input.dispatchEvent(new Event('input'));
    }
</script>
<script>
    function togglePasswordVisibility(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        const eyeIcon = document.getElementById(fieldId + '-eye');

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.innerHTML = `
                <svg width="24" height="24" viewBox="0 0 24 24" class="fill-dark-grey" xmlns="http://www.w3.org/2000/svg">
                <mask id="mask0_1130_3314" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24"
                height="24">
                <rect width="24" height="24" />
                </mask>
                <g mask="url(#mask0_1130_3314)">
                <path
                d="M12 16C13.25 16 14.3125 15.5625 15.1875 14.6875C16.0625 13.8125 16.5 12.75 16.5 11.5C16.5 10.25 16.0625 9.1875 15.1875 8.3125C14.3125 7.4375 13.25 7 12 7C10.75 7 9.6875 7.4375 8.8125 8.3125C7.9375 9.1875 7.5 10.25 7.5 11.5C7.5 12.75 7.9375 13.8125 8.8125 14.6875C9.6875 15.5625 10.75 16 12 16ZM12 14.2C11.25 14.2 10.6125 13.9375 10.0875 13.4125C9.5625 12.8875 9.3 12.25 9.3 11.5C9.3 10.75 9.5625 10.1125 10.0875 9.5875C10.6125 9.0625 11.25 8.8 12 8.8C12.75 8.8 13.3875 9.0625 13.9125 9.5875C14.4375 10.1125 14.7 10.75 14.7 11.5C14.7 12.25 14.4375 12.8875 13.9125 13.4125C13.3875 13.9375 12.75 14.2 12 14.2ZM12 19C9.56667 19 7.35 18.3208 5.35 16.9625C3.35 15.6042 1.9 13.7833 1 11.5C1.9 9.21667 3.35 7.39583 5.35 6.0375C7.35 4.67917 9.56667 4 12 4C14.4333 4 16.65 4.67917 18.65 6.0375C20.65 7.39583 22.1 9.21667 23 11.5C22.1 13.7833 20.65 15.6042 18.65 16.9625C16.65 18.3208 14.4333 19 12 19ZM12 17C13.8833 17 15.6125 16.5042 17.1875 15.5125C18.7625 14.5208 19.9667 13.1833 20.8 11.5C19.9667 9.81667 18.7625 8.47917 17.1875 7.4875C15.6125 6.49583 13.8833 6 12 6C10.1167 6 8.3875 6.49583 6.8125 7.4875C5.2375 8.47917 4.03333 9.81667 3.2 11.5C4.03333 13.1833 5.2375 14.5208 6.8125 15.5125C8.3875 16.5042 10.1167 17 12 17Z" />
                </g>
                </svg>`;
        } else {
            passwordInput.type = "password";
            eyeIcon.innerHTML = `
                <svg width="24" height="24" viewBox="0 0 24 24" class="fill-dark-grey" xmlns="http://www.w3.org/2000/svg">
                <mask id="mask0_1130_3314" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24"
                height="24">
                <rect width="24" height="24" />
                </mask>
                <g mask="url(#mask0_1130_3314)">
                <path
                d="M12 16C13.25 16 14.3125 15.5625 15.1875 14.6875C16.0625 13.8125 16.5 12.75 16.5 11.5C16.5 10.25 16.0625 9.1875 15.1875 8.3125C14.3125 7.4375 13.25 7 12 7C10.75 7 9.6875 7.4375 8.8125 8.3125C7.9375 9.1875 7.5 10.25 7.5 11.5C7.5 12.75 7.9375 13.8125 8.8125 14.6875C9.6875 15.5625 10.75 16 12 16ZM12 14.2C11.25 14.2 10.6125 13.9375 10.0875 13.4125C9.5625 12.8875 9.3 12.25 9.3 11.5C9.3 10.75 9.5625 10.1125 10.0875 9.5875C10.6125 9.0625 11.25 8.8 12 8.8C12.75 8.8 13.3875 9.0625 13.9125 9.5875C14.4375 10.1125 14.7 10.75 14.7 11.5C14.7 12.25 14.4375 12.8875 13.9125 13.4125C13.3875 13.9375 12.75 14.2 12 14.2ZM12 19C9.56667 19 7.35 18.3208 5.35 16.9625C3.35 15.6042 1.9 13.7833 1 11.5C1.9 9.21667 3.35 7.39583 5.35 6.0375C7.35 4.67917 9.56667 4 12 4C14.4333 4 16.65 4.67917 18.65 6.0375C20.65 7.39583 22.1 9.21667 23 11.5C22.1 13.7833 20.65 15.6042 18.65 16.9625C16.65 18.3208 14.4333 19 12 19ZM12 17C13.8833 17 15.6125 16.5042 17.1875 15.5125C18.7625 14.5208 19.9667 13.1833 20.8 11.5C19.9667 9.81667 18.7625 8.47917 17.1875 7.4875C15.6125 6.49583 13.8833 6 12 6C10.1167 6 8.3875 6.49583 6.8125 7.4875C5.2375 8.47917 4.03333 9.81667 3.2 11.5C4.03333 13.1833 5.2375 14.5208 6.8125 15.5125C8.3875 16.5042 10.1167 17 12 17Z" />
                </g>
                </svg>`;
        }
    }

    const description = document.getElementById('description');
    const content = document.getElementById('content');
    const readMoreBtn = document.getElementById('read-more');
    const readLessBtn = document.getElementById('read-less');

    let isExpanded = false;

    readMoreBtn.addEventListener('click', function() {
        content.style.maxHeight = 'none';
        readMoreBtn.style.display = 'none';
        readLessBtn.style.display = 'inline-block';
        description.classList.remove('custom-text-ellipsis');
        isExpanded = true;
    });

    readLessBtn.addEventListener('click', function() {
        content.style.maxHeight = '70px';
        readMoreBtn.style.display = 'inline-block';
        readLessBtn.style.display = 'none';
        description.classList.add('custom-text-ellipsis');
        isExpanded = false;
    });

    window.addEventListener('load', function() {
        if (description.offsetHeight > 70) {
            readMoreBtn.style.display = 'inline-block';
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const birthDateInput = document.getElementById('birth_date');

        birthDateInput.addEventListener('input', (event) => {
            let input = event.target.value;
            input = input.replace(/\D/g, ''); // Remove caracteres não numéricos

            if (input.length <= 2) {
                input = input.replace(/^(\d{0,2})/, '$1');
            } else if (input.length <= 4) {
                input = input.replace(/^(\d{2})(\d{0,2})/, '$1-$2');
            } else {
                input = input.substring(0, 8); // Limita a 8 caracteres (ddmm yyyy)
                input = input.replace(/^(\d{2})(\d{2})(\d{0,4})/, '$1-$2-$3');
            }

            event.target.value = input;
        });
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
