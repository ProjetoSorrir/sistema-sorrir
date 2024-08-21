<div class="min-h-[calc(100%-151px)] bg-white w-full py-10 rounded-xl">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <!-- Adicione o iMask.js -->
    <script src="https://unpkg.com/imask"></script>
    <style>
        #cpf_solve_instructions,
        #consulting-cpf,
        .iti__flag-container {
            display: none;
        }

        #cpf_solve_instructions {
            background: #ffffff1a;
            border-radius: 10px;
            margin-top: 20px;
            padding: 20px;
            font-size: 14px;
            border: 1px dashed #ffa100;
        }

        .iti__country-list {
            min-width: 200px;
            /* Definir uma largura mínima para o dropdown */
            width: auto !important;
            /* Permitir que o dropdown ajuste sua largura conforme necessário */
            max-width: unset !important;
            /* Remover a largura máxima do dropdown */
        }
    </style>
    <div class="sm:mx-auto sm:w-full sm:max-w-sm px-4 grid grid-cols-12">
        <div class="mb-10 mx-auto col-span-12 text-center">
            <p class="text-4xl text-[#000]/80 font-bold">Cadastrar conta</p>
            <p class="text-[#000]/60 text-xs font-medium">Preencha seus dados abaixo com atenção</p>
        </div>

        <form wire:submit.prevent="register" class="col-span-12 mx-auto grid grid-cols-12 gap-4 w-[350px] max-w-full">
            <div class="input-container col-span-12">
                <label for="name">Nome Completo:</label>
                <input wire:model.defer="name" id="name" name="name" type="text"
                    placeholder="Preencha seu nome completo">
                @error('name')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                        <span class="text-sm text-white">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div x-data x-init="IMask(document.getElementById('cpf'), { mask: '000.000.000-00' })" class="input-container col-span-6">
                <label for="cpf">CPF:</label>
                <input wire:model.defer="cpf" id="cpf" name="cpf" type="text" placeholder="Apenas números">
                @error('cpf')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                        <span class="text-sm text-white">{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="input-container col-span-6">
                <label for="birth_date">Data de Nascimento:</label>
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
                <input wire:model.defer="email_confirmation" id="email_confirmation" name="email_confirmation"
                    type="text" placeholder="Confirme seu e-mail">
                @error('email')
                    @if ($message === 'A confirmação do e-mail não corresponde')
                        <span class="bg-red-600 rounded-lg px-2 py-1 mt-2 text-white text-sm">{{ $message }}</span>
                    @endif
                @enderror
            </div>

            <div class="input-container col-span-6">
                <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Telefone:</label>
                <input type="hidden" id="ddi_hidden" name="ddi" wire:model="ddi" readonly>
                <input wire:model="phone" id="phone" name="phone" type="text" maxlength="11" minlength="11"
                    placeholder="Ex: 11900000000" pattern="\d{11}"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full">
                @error('phone')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                        <span class="text-sm text-white">{{ $message }}</span>
                    </div>
                @enderror
            </div>



            <div class="input-container col-span-6">
                <label for="cep">CEP:</label>
                <input wire:model.defer="cep" id="CEP" name="CEP" type="text" autocomplete="CEP"
                    placeholder="Ex: 00000-000">
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
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Crie sua senha:</label>
                <div
                    class="flex items-center rounded border px-1 border-[#e3e3e3] w-full text-black font-medium bg-[#f4f4f4]">
                    <input wire:model.defer="password" id="password" name="password" type="password"
                        placeholder="Senha com 8+ digitos" class="border-none w-full" maxlength="20">
                    <div id="password-eye" class="mr-2 cursor-pointer" onclick="togglePasswordVisibility('password')">
                        <svg width="24" height="24" viewBox="0 0 24 24" class="fill-dark-grey"
                            xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_1130_3314" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="24" height="24">
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
                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirme
                    sua senha:</label>
                <div
                    class="flex items-center rounded border px-1 border-[#e3e3e3] w-full text-black font-medium bg-[#f4f4f4]">
                    <input wire:model.defer="password_confirmation" id="password_confirmation"
                        name="password_confirmation" type="password" placeholder="Confirme a senha"
                        autocomplete="new-password" class="border-none w-full" maxlength="20">
                    <div id="password_confirmation-eye" class="mr-2 cursor-pointer"
                        onclick="togglePasswordVisibility('password_confirmation')">
                        <svg width="24" height="24" viewBox="0 0 24 24" class="fill-dark-grey"
                            xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_1130_3314" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="24" height="24">
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
                <button type="submit" class="primary-button w-full mt-2 uppercase font-bold">Finalizar
                    cadastro</button>
            </div>
            <p class="col-span-12 mx-auto text-gray-500 text-center w-[350px] max-w-full"
                style="border: 1px dashed #0000002e; border-radius: 7px; padding: 14px 0 10px; line-height: 15px; font-size: 17px;">
                Você já tem conta criada? <br>
                <a href="{{ route('login') }}" class="font-semibold leading-6 text-primary">Clique aqui para
                    acessar!</a>
            </p>
        </form>


        {{-- Se a rota for o site --}}
        {{-- <div class="col-span-12 bg-[#fff3cd] border border-1 border-[#f6e8c4] text-[#8b6c27] text-xs p-2">
            <p>Informe os dados corretos para recebimento das premiações</p>
        </div> --}}
        <a href="https://3613e03b7c2de35a295c50584bbb6b52.cdn.bubble.io/f1708045124278x654216989445584900/Pol%C3%ADtica%20Institucional%20de%20Privacidade%20e%20Prote%C3%A7%C3%A3o%20de%20Dados%20Externa.pdf"
            class="col-span-12 mt-3 text-blue-500 underline cursor-pointer text-xs text-center">Políticas de
            Privacidade</a>
    </div>
</div>
</div>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
{{-- <script>
    $(document).ready(function() {
        $('#consult_cpf').click(function() {
            var cpf = $('#cpf').val();

            // Função para validar CPF
            function validateCPF(cpf) {
                // Remover todos os caracteres não numéricos
                cpf = cpf.replace(/\D/g, '');

                // Verificar se o CPF tem 11 dígitos
                if (cpf.length !== 11) {
                    return false;
                }

                // Verificar se todos os dígitos são iguais (situação inválida)
                if (/^(\d)\1+$/.test(cpf)) {
                    return false;
                }

                // Calcular o primeiro dígito verificador
                let sum = 0;
                for (let i = 0; i < 9; i++) {
                    sum += parseInt(cpf.charAt(i)) * (10 - i);
                }
                let remainder = (sum * 10) % 11;
                if (remainder === 10 || remainder === 11) {
                    remainder = 0;
                }
                if (remainder !== parseInt(cpf.charAt(9))) {
                    return false;
                }

                // Calcular o segundo dígito verificador
                sum = 0;
                for (let i = 0; i < 10; i++) {
                    sum += parseInt(cpf.charAt(i)) * (11 - i);
                }
                remainder = (sum * 10) % 11;
                if (remainder === 10 || remainder === 11) {
                    remainder = 0;
                }
                if (remainder !== parseInt(cpf.charAt(10))) {
                    return false;
                }

                // CPF válido
                return true;
            }

            // Validar o CPF
            if (!validateCPF(cpf)) {

                $('#cpf-error').text('CPF inválido!');
                $('#cpf-error').show();
                $('#cpf').addClass('input-error');
                $('#name').val('');
                $('#birth_date').val('');
                $('#password').val('');
                $('#email').val('');
                $('#password_confirmation').val('');
                $('#phone').val('');


                return false;
            }

            // Se o CPF for válido, continuar com a requisição AJAX
            $('#consulting-cpf').show();
            $('#consult_cpf').hide();

            $.ajax({
                type: 'POST',
                url: '{{ route('consult_cpf') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    cpf: cpf
                },
                success: function(response) {
                    $('#consulting-cpf').hide();

                    if (response.hasOwnProperty('error')) {
                        $('#error-message').html('<small style="color:#f57576">' + response.error + '</small>');
                        $('#cpf').addClass('input-error');
                        $('#name').val('');
                        $('#birth_date').val('');
                        @this.set('name', '');
                        @this.set('birth_date', '');
                        @this.set('email', '');
                        @this.set('password', '');
                        @this.set('password_confirmation', '');
                        @this.set('phone', '');

                        $('#cpf_solve_instructions').show();
                    } else {
                        $('#cpf').prop('disabled', true);
                        $('#error-message').empty();
                        $('#cpf').removeClass('input-error');
                        $('#cpf_hidden').val(cpf);
                        $('#name').val(response.name);
                        $('#birth_date').val(response.birth_date);
                        var name = response.name;
                        var birth_date = response.birth_date;

                        @this.set('name', name);
                        @this.set('birth_date', birth_date);
                        @this.set('cpf',cpf );
                        $('#error-message').empty();
                        $('#cpf').removeClass('input-error');


                    }
                }
            });
        });
    });
</script> --}}
<script>
    const phoneInput = document.querySelector("#phone");
    const ddiInput = document.querySelector("#ddi_hidden");
    // Inicializar o plugin Intl
    const iti = window.intlTelInput(phoneInput, {
        separateDialCode: true,
        initialCountry: "br",
        preferredCountries: ['br', 'ao', 'pt', 'gb', 'us', 'mz'],
        geoIpLookup: function(success, failure) {
            fetch("https://ipapi.co/json")
                .then(response => response.json())
                .then(data => {
                    success(data.country);
                })
                .catch(error => {
                    failure(error);
                });
        }
    });



    phoneInput.addEventListener("countrychange", function() {

        const countryData = iti.getSelectedCountryData();
        const ddi = '+' + countryData.dialCode;
        ddiInput.value = ddi;
        @this.set('ddi', ddi);
    });
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
