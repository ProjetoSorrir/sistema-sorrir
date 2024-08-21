<div>
    <!-- Modal Background -->
    <div id="purchaseModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
        onclick="closeModal()"></div>

    <!-- Modal Content -->
    <div class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-lg shadow-lg z-50 w-3/4 md:w-1/2"
        id="modalContent">
        @if ($isUserLoggedIn)
        <h2 class="text-center text-xl font-bold text-gray-800">Confirme seu pedido</h2>
        <p class="text-center mb-4 text-gray-600">e garanta a reserva dos seus números da sorte!</p>
        @else
        <h2 class="text-xl font-bold text-gray-800">Preencha os dados abaixo para finalizar sua compra</h2>
        <p class="text-center mb-4 text-gray-600">e garanta sua Participação no Sorteio</p>
        @endif
        <div id="selectedNumbersModal" class="mb-8 flex items-center">
            <!-- Selected numbers will be injected here -->
            <!-- Placeholder for selected numbers, you can use a loop to generate these elements -->
            <!-- Repeat the above div for each selected number -->
        </div>
        @if (!$isUserLoggedIn)
        @if ($login)
        <div class="min-h-[calc(100%-151px)]">
            <div>
                <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-sm">
                    <form class="space-y-6" wire:submit.prevent="loginCaller">
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Seu
                                email:</label>
                            <div class="mt-2">
                                <input wire:model="form.email" id="email" name="email" type="email" autocomplete="email"
                                    placeholder="Digite seu e-mail" required
                                    class="block w-full rounded-md border-0 px-2 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                                @error('email')
                                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Sua
                                    senha:</label>
                                <div class="text-sm">
                                    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="font-semibold text-[#f04e23] hover:text-[##f04e23]/60">Esqueceu
                                        sua senha?</a>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-2">
                                <input wire:model="form.password" id="password" name="password" type="password"
                                    placeholder="Digite sua senha" autocomplete="current-password" required
                                    class="block w-full rounded-md border-0 px-2 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                                @error('password')
                                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="block mt-4">
                            <label for="remember" class="flex items-center">
                                <input wire:model="form.remember" id="remember" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-600">Lembrar de mim</span>
                            </label>
                        </div>
                        <div>
                            <button type="submit"
                                class="flex w-full justify-center rounded-md bg-[#f04e23] hover:bg-[#f04e23]/80 px-3 py-2 text-sm font-semibold leading-6 text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">Entrar</button>
                        </div>
                    </form>
                    <p class="mt-10 text-center text-sm text-gray-500">
                        Ainda não é membro?
                        <button wire:click="changeLoginButton"
                            class="font-semibold leading-6 text-[#f04e23] hover:text-[#f04e23]/80">Registre-se</button>
                    </p>
                </div>
            </div>
        </div>
        @else
        <div class="px-6 lg:px-8">

            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <div class="pb-8 pt-12">
                    <p class="text-4xl text-[#000]/80 font-semibold">Seja bem vindo!</p>
                    <p class="text-[#000]/60 font-medium">Preencha seus dados abaixo e comece agora!</p>
                </div>
                <form wire:submit.prevent="register" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Seu nome:</label>
                        <div class="mt-2">
                            <input wire:model.defer="name" id="name" name="name" type="text" autocomplete="name"
                                placeholder="Preencha seu nome completo" required
                                class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Seu email:</label>
                        <div class="mt-2">
                            <input wire:model.defer="email" id="email" name="email" type="email" autocomplete="email"
                                placeholder="Preencha seu email" required
                                class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Escolha uma
                            senha:</label>
                        <div class="mt-2">
                            <input wire:model.defer="password" id="password" name="password" type="password"
                                autocomplete="new-password" placeholder="Senha com 8+ caracteres" required
                                class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation"
                            class="block text-sm font-medium leading-6 text-gray-900">Confirme sua senha:</label>
                        <div class="mt-2">
                            <input wire:model.defer="password_confirmation" id="password_confirmation"
                                name="password_confirmation" type="password" placeholder="Confirme a senha"
                                autocomplete="new-password" required
                                class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-md bg-[#f04e23] hover:bg-[#f04e23]/80 px-3 py-2 text-sm font-semibold leading-6 text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">Clique
                            para registrar</button>
                    </div>
                </form>

            </div>
        </div>

        @endif
        @else
        <!-- Maybe display a welcome message or other information for logged-in users -->
        {{-- <p>Welcome back, {{ auth()->user()->name }}!</p> --}}
        <button onclick="collectAndConfirmPurchase()"
            class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-6 rounded-lg mt-6 w-full transition duration-300">
            CONFIRMAR PEDIDO
        </button>
        @endif

    </div>
    <script>
        function collectAndConfirmPurchase() {
            let numbers = [];
            document.querySelectorAll('#selectedNumbersModal .bg-yellow-300').forEach(element => {
                numbers.push(element.getAttribute('data-number'));
            });

            // Call Livewire component method with collected numbers
            @this.call('confirmPurchase', numbers);
        }
    </script>
</div>