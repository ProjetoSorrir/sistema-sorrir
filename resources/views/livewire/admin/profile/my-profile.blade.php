<div class='card card-margins'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <style>
        .iti__country-list {
            min-width: 200px;
            /* Definir uma largura mínima para o dropdown */
            width: auto !important;
            /* Permitir que o dropdown ajuste sua largura conforme necessário */
            max-width: unset !important;
            /* Remover a largura máxima do dropdown */
        }
    </style>

    @if (session()->has('profile-updated'))
        <div class="alert alert-success"
            style="background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: 10px; margin-bottom: 15px;">
            {{ session('profile-updated') }}
        </div>
    @endif
    @if (session()->has('password-updated'))
        <div class="alert alert-success"
            style="background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: 10px; margin-bottom: 15px;">
            {{ session('password-updated') }}
        </div>
    @endif
    <div
        class="flex flex-col md:flex-row min-[1440px]:w-3/4 min-[1440px]:mx-auto justify-between items-start gap-8 min-[1440px]:gap-24">
        <div class="left-container w-full md:w-1/2 grid grid-cols-12">
            <div class="col-span-12 mb-6">
                <p class="text-[25px] text-white font-semibold">Atualize seu Perfil</p>
            </div>
            <form wire:submit="updateProfileInformation" class="col-span-12 grid grid-cols-12 gap-4">
                <div class="input-container col-span-12">
                    <label for="name">Seu Nome:</label>
                    <input wire:model='name'type="text" placeholder="Seu nome">
                    @error('name')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-container col-span-12">
                    <label for="email">Seu E-mail:</label>
                    <input wire:model='email' type="text" placeholder="email@email.com">
                    @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div wire:ignore class="input-container col-span-12">
                    <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Seu
                        Whatsapp:</label>
                    <input id="phone" name="phone" type="text" placeholder="Digite seu telefone" maxlength="15"
                        wire:model.defer='phone' required pattern="[0-9]*"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full">
                    @error('phone')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <input type="hidden" id="ddi_hidden" name="ddi" wire:model="ddi" readonly>
                {{--

                <div wire:ignore class="input-container col-span-12">
                    <label for="phone">Seu Whatsapp:</label>
                    <input id="phone" name="phone" type="text" placeholder="Digite seu telefone" maxlength="15"
                        wire:model.defer='phone' pattern="[0-9]*"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full">
                    @error('phone')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <input type="hidden" id="ddi_hidden" name="ddi" wire:model="ddi" readonly> --}}



                <div class="col-span-12">

                    <button class="primary-button w-full">Atualizar informações</button>
                </div>

            </form>
        </div>
        <div class="right-container w-full md:w-1/2 grid grid-cols-12">
            <div class="col-span-12">
                <p class="card__title mb-6 text-white">Atualize sua Senha</p>
            </div>
            <form wire:submit.prevent="updatePassword" class="col-span-12 grid grid-cols-12 gap-4">

                <div id="show_hide_password" class="col-span-12">
                    <label for="password" class="text-sm font-bold tracking-wide;">Sua Senha:</label>
                    <div class="flex items-center rounded border px-1 border-[#b4b4b4] w-full text-black font-medium">
                        <input type="password" wire:model="current_password" autocomplete="password"
                            placeholder="Sua senha atual" class="border-none w-full" id="current_password">
                        <div id="current_password-eye" class="mr-2 cursor-pointer"
                            onclick="togglePasswordVisibility('current_password')">
                            <svg width="24" height="24" viewBox="0 0 24 24" class="fill-dark-grey"
                                xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_1130_3314" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                    y="0" width="24" height="24">
                                    <rect width="24" height="24" />
                                </mask>
                                <g mask="url(#mask0_1130_3314)">
                                    <path
                                        d="M12 16C13.25 16 14.3125 15.5625 15.1875 14.6875C16.0625 13.8125 16.5 12.75 16.5 11.5C16.5 10.25 16.0625 9.1875 15.1875 8.3125C14.3125 7.4375 13.25 7 12 7C10.75 7 9.6875 7.4375 8.8125 8.3125C7.9375 9.1875 7.5 10.25 7.5 11.5C7.5 12.75 7.9375 13.8125 8.8125 14.6875C9.6875 15.5625 10.75 16 12 16ZM12 14.2C11.25 14.2 10.6125 13.9375 10.0875 13.4125C9.5625 12.8875 9.3 12.25 9.3 11.5C9.3 10.75 9.5625 10.1125 10.0875 9.5875C10.6125 9.0625 11.25 8.8 12 8.8C12.75 8.8 13.3875 9.0625 13.9125 9.5875C14.4375 10.1125 14.7 10.75 14.7 11.5C14.7 12.25 14.4375 12.8875 13.9125 13.4125C13.3875 13.9375 12.75 14.2 12 14.2ZM12 19C9.56667 19 7.35 18.3208 5.35 16.9625C3.35 15.6042 1.9 13.7833 1 11.5C1.9 9.21667 3.35 7.39583 5.35 6.0375C7.35 4.67917 9.56667 4 12 4C14.4333 4 16.65 4.67917 18.65 6.0375C20.65 7.39583 22.1 9.21667 23 11.5C22.1 13.7833 20.65 15.6042 18.65 16.9625C16.65 18.3208 14.4333 19 12 19ZM12 17C13.8833 17 15.6125 16.5042 17.1875 15.5125C18.7625 14.5208 19.9667 13.1833 20.8 11.5C19.9667 9.81667 18.7625 8.47917 17.1875 7.4875C15.6125 6.49583 13.8833 6 12 6C10.1167 6 8.3875 6.49583 6.8125 7.4875C5.2375 8.47917 4.03333 9.81667 3.2 11.5C4.03333 13.1833 5.2375 14.5208 6.8125 15.5125C8.3875 16.5042 10.1167 17 12 17Z" />
                                </g>
                            </svg>
                        </div>
                    </div>
                    @error('current_password')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>


                <div id="show_hide_password" class="col-span-12">
                    <label for="password" class="text-sm font-bold tracking-wide;">Sua Nova Senha:</label>
                    <div class="flex items-center rounded border px-1 border-[#b4b4b4] w-full text-black font-medium">
                        <input id="password" name="password" type="password" wire:model="password"
                            autocomplete="password" placeholder="Escolha uma senha segura (mínimo 8 caracteres)"
                            class="border-none w-full">
                        <div id="current_password-eye" class="mr-2 cursor-pointer"
                            onclick="togglePasswordVisibility('password')">
                            <svg width="24" height="24" viewBox="0 0 24 24" class="fill-dark-grey"
                                xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_1130_3314" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                    y="0" width="24" height="24">
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
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @endunless
                    @enderror
                    <ul class="mt-1 text-sm text-bold list-disc list-inside text-white">
                        <li>A senha deve ter pelo menos 8 caracteres.</li>
                        <li>A senha deve ter no máximo 20 caracteres.</li>
                    </ul>
                </div>

                <div id="show_hide_password" class="col-span-12">
                    <label for="password" class="text-sm font-bold tracking-wide; text-white">Confirme Sua Nova
                        Senha:</label>
                    <div class="flex items-center rounded border px-1 border-[#b4b4b4] w-full text-black font-medium">
                        <input id="password_confirmation" name="password_confirmation"
                            wire:model="password_confirmation" type="password" placeholder="Confirme sua nova senha"
                            autocomplete="password_confirmation" class="border-none w-full">
                        <div id="password_confirmation-eye" class="mr-2 cursor-pointer"
                            onclick="togglePasswordVisibility('password_confirmation')">
                            <svg width="24" height="24" viewBox="0 0 24 24" class="fill-dark-grey"
                                xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_1130_3314" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                    y="0" width="24" height="24">
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
                    <button type="submit" class="primary-button w-full">Atualizar Senha</button>
                </div>
            </form>
        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    window.addEventListener('DOMContentLoaded', function() {

        const phoneInput = document.querySelector("#phone");
        const ddiInput = @this.get('ddi');

        const countryCodeMap = {
            '1': 'us',
            '7': 'ru',
            '20': 'eg',
            '27': 'za',
            '30': 'gr',
            '31': 'nl',
            '32': 'be',
            '33': 'fr',
            '34': 'es',
            '36': 'hu',
            '39': 'it',
            '40': 'ro',
            '41': 'ch',
            '43': 'at',
            '44': 'gb',
            '45': 'dk',
            '46': 'se',
            '47': 'no',
            '48': 'pl',
            '49': 'de',
            '51': 'pe',
            '52': 'mx',
            '53': 'cu',
            '54': 'ar',
            '55': 'br',
            '56': 'cl',
            '57': 'co',
            '58': 've',
            '60': 'my',
            '61': 'au',
            '62': 'id',
            '63': 'ph',
            '64': 'nz',
            '65': 'sg',
            '66': 'th',
            '81': 'jp',
            '82': 'kr',
            '84': 'vn',
            '86': 'cn',
            '90': 'tr',
            '91': 'in',
            '92': 'pk',
            '93': 'af',
            '94': 'lk',
            '95': 'mm',
            '98': 'ir',
            '211': 'ss',
            '212': 'ma',
            '213': 'dz',
            '216': 'tn',
            '218': 'ly',
            '220': 'gm',
            '221': 'sn',
            '222': 'mr',
            '223': 'ml',
            '224': 'gn',
            '225': 'ci',
            '226': 'bf',
            '227': 'ne',
            '228': 'tg',
            '229': 'bj',
            '230': 'mu',
            '231': 'lr',
            '232': 'sl',
            '233': 'gh',
            '234': 'ng',
            '235': 'td',
            '236': 'cf',
            '237': 'cm',
            '238': 'cv',
            '239': 'st',
            '240': 'gq',
            '241': 'ga',
            '242': 'cg',
            '243': 'cd',
            '244': 'ao',
            '245': 'gw',
            '246': 'io',
            '248': 'sc',
            '249': 'sd',
            '250': 'rw',
            '251': 'et',
            '252': 'so',
            '253': 'dj',
            '254': 'ke',
            '255': 'tz',
            '256': 'ug',
            '257': 'bi',
            '258': 'mz',
            '260': 'zm',
            '261': 'mg',
            '262': 're',
            '263': 'zw',
            '264': 'na',
            '265': 'mw',
            '266': 'ls',
            '267': 'bw',
            '268': 'sz',
            '269': 'km',
            '290': 'sh',
            '291': 'er',
            '297': 'aw',
            '298': 'fo',
            '299': 'gl',
            '350': 'gi',
            '351': 'pt',
            '352': 'lu',
            '353': 'ie',
            '354': 'is',
            '355': 'al',
            '356': 'mt',
            '357': 'cy',
            '358': 'fi',
            '359': 'bg',
            '370': 'lt',
            '371': 'lv',
            '372': 'ee',
            '373': 'md',
            '374': 'am',
            '375': 'by',
            '376': 'ad',
            '377': 'mc',
            '378': 'sm',
            '379': 'va',
            '380': 'ua',
            '381': 'rs',
            '382': 'me',
            '383': 'xk',
            '385': 'hr',
            '386': 'si',
            '387': 'ba',
            '389': 'mk',
            '420': 'cz',
            '421': 'sk',
            '423': 'li',
            '500': 'fk',
            '501': 'bz',
            '502': 'gt',
            '503': 'sv',
            '504': 'hn',
            '505': 'ni',
            '506': 'cr',
            '507': 'pa',
            '508': 'pm',
            '509': 'ht',
            '590': 'gp',
            '591': 'bo',
            '592': 'gy',
            '593': 'ec',
            '594': 'gf',
            '595': 'py',
            '596': 'mq',
            '597': 'sr',
            '598': 'uy',
            '599': 'cw',
            '599': 'bq',
            '670': 'tl',
            '672': 'nf',
            '673': 'bn',
            '674': 'nr',
            '675': 'pg',
            '676': 'to',
            '677': 'sb',
            '678': 'vu',
            '679': 'fj',
            '680': 'pw',
            '681': 'wf',
            '682': 'ck',
            '683': 'nu',
            '685': 'ws',
            '686': 'ki',
            '687': 'nc',
            '688': 'tv',
            '689': 'pf',
            '690': 'tk',
            '691': 'fm',
            '692': 'mh',
            '850': 'kp',
            '852': 'hk',
            '853': 'mo',
            '855': 'kh',
            '856': 'la',
            '880': 'bd',
            '886': 'tw',
            '960': 'mv',
            '961': 'lb',
            '962': 'jo',
            '963': 'sy',
            '964': 'iq',
            '965': 'kw',
            '966': 'sa',
            '967': 'ye',
            '968': 'om',
            '970': 'ps',
            '971': 'ae',
            '972': 'il',
            '973': 'bh',
            '974': 'qa',
            '975': 'bt',
            '976': 'mn',
            '977': 'np',
            '992': 'tj',
            '993': 'tm',
            '994': 'az',
            '995': 'ge',
            '996': 'kg',
            '998': 'uz'
        };

        function getCountryIso2(countryCode) {

            const cleanCode = countryCode.replace('+', '').toLowerCase();

            return countryCodeMap[cleanCode] || "";
        }
        const initialCountryIso2 = getCountryIso2(ddiInput);


        const iti = window.intlTelInput(phoneInput, {
            separateDialCode: true,
            initialCountry: initialCountryIso2,
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
