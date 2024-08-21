
<div>
    @extends('layouts.app')
    @section('title', 'Landing Page')
    @section('content')
    <div>

        @if (session()->has('error'))
        <div class="text-sm bg-red-100 text-red-800 p-2 rounded">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
        @endif

        @if(session()->has('sucess_new_password'))
        <div class="alert alert-success shadow-lg mb-5">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('sucess_new_password') }}</span>
            </div>
        </div>
        @endif
    </div>
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <div class="pb-8 pt-12">
            <p class="text-4xl text-[#000]/80 font-semibold">Redefinir senha</p>
            <p class="text-[#000]/60 font-medium">Preencha os campos abaixo para redefinir uma nova senha.</p>
        </div>
        <body>
            <form class="space-y-6" method="POST" action="{{ route('reset.password.post') }}">
                @csrf
                <input type="text" name="token" hidden value="{{$token}}">
                <div class="input-container">
                    <label for="email">Seu email:</label>
                    <input id="email" name="email" type="email" autocomplete="email"
                        placeholder="Preencha seu email" required>
                    @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div id="show_hide_password" class="col-span-12">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Sua nova senha:</label>
                    <div class="flex items-center rounded border px-1 border-[#b4b4b4] w-full text-black font-medium bg-white">
                        <input id="password" name="password" class="border-none w-full" type="password"
                        autocomplete="new-password" placeholder="Escolha uma senha segura (mínimo 8 caracteres)" required>
                        <div id="password-eye" class="mr-2 cursor-pointer"
                            onclick="togglePasswordVisibility('password')">
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
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @endunless
                    @enderror
                    <ul class="mt-1 text-sm text-bold list-disc list-inside">
                        <li>A senha deve ter pelo menos 8 caracteres.</li>
                        <li>A senha deve ter no máximo 20 caracteres.</li>
                    </ul>
                </div>

    
                <div id="show_hide_password" class="col-span-12">
                    <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirme
                        sua senha:</label>
                    <div class="flex items-center rounded border px-1 border-[#b4b4b4] w-full text-black font-medium bg-white">
                        <input class="border-none w-full" id="password_confirmation" name="password_confirmation"
                            type="password" placeholder="Confirme a senha" autocomplete="new-password" required>

                            <div id="password-eye" class="mr-2 cursor-pointer"
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
                            @error('password')
                                @if ($message === 'A confirmação da senha não corresponde')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @endif
                            @enderror
                    </div>
                </div>

                <div>
                    <button type="submit" class="primary-button w-full">Redefinir Senha</button>
                </div>
            </form>
        </body>
    </div>

    @endsection
</div>
<script>
    function togglePasswordVisibility(fieldId) {
    const passwordInput = document.getElementById(fieldId);
    const eyeIcon = document.getElementById(fieldId + '-eye');
    console.log(passwordInput)
    console.log(eyeIcon)
    
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