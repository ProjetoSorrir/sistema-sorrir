@extends('layouts.app')
@section('title', 'Recuperar senha')
@section('content')
    <div class="min-h-[calc(100%-151px)] bg-white w-full py-10 rounded-xl">
        <div class="w-[350px] max-w-full mx-auto">
            <div class="mb-10 mx-auto text-center">
                <p class="text-4xl text-[#000]/80 font-bold">Recuperar senha</p>
                <p class="text-[#000]/60 text-xs font-medium">Esqueceu sua senha? Receba um link por e-mail e crie uma nova
                </p>
            </div>

            <div class="sm:mx-auto sm:w-full sm:max-w-sm">

                @if (session()->has('error'))
                    <div class="text-sm bg-red-100 text-red-800 p-2 rounded mb-6">
                        <div class="flex gap-2" style="align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                @if (session()->has('sucess'))
                    <div class="text-sm bg-green-100 text-green-800 p-2 rounded mb-6">
                        <div class="flex gap-2" style="align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('sucess') }}</span>
                        </div>
                    </div>
                @endif
                @if (session()->has('error-mail'))
                    <div class="text-sm bg-red-100 text-red-800 p-2 rounded mb-6">
                        <div class="flex gap-2" style="align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span>{{ session('error-mail') }}</span>
                        </div>
                    </div>
                @endif
            </div>

            <form class="mx-auto grid gap-4 mb-0" method="POST" action="{{ route('forget.password.post') }}">
                @csrf

                <div class="input-container">
                    <label for="email">E-mail utilizado no cadastro:</label>
                    <input id="email" name="email" type="email" autocomplete="email"
                        placeholder="Preencha seu email" required>
                    @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="primary-button w-full uppercase font-bold">Receber link por email</button>
                    <p class="col-span-12 mx-auto text-gray-500 text-center w-[350px] max-w-full mt-4"
                        style="border: 1px dashed #0000002e; border-radius: 7px; padding: 14px 0 10px; line-height: 15px; font-size: 17px;">
                        Lembrou sua senha?<br>
                        <a href="{{ route('login') }}" class="font-semibold leading-6 text-primary"
                            style="color: #000;">Clique aqui para acessar!</a>
                    </p>
                </div>
            </form>
        </div>

    @endsection
</div>
