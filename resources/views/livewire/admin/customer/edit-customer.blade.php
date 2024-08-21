<div class="card">
    <div class="max-w-md mx-auto">
        <!-- Botão de voltar -->
        {{-- <div class="mb-4">
            <a href="{{ route('customers') }}"
                class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-md">Voltar</a>
        </div> --}}
        @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sucesso!</strong>
            <span class="block sm:inline">{{ session('message') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Fechar</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
        @endif

        <!-- Formulários de edição -->
        <div class="space-y-6">
            <!-- Formulário Nome -->
            <form class="flex items-center space-x-4" wire:submit.prevent="salvarNome">
                <div class="flex-1">
                    <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                    <input type="text" wire:model="nome" id="nome"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Salvar
                </button>
            </form>

            <!-- Formulário Email -->
            <form class="flex items-center space-x-4" wire:submit.prevent="salvarEmail">
                <div class="flex-1">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" wire:model="email" id="email"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Salvar
                </button>
            </form>

            <!-- Formulário Telefone -->
            <form class="flex items-center space-x-4" wire:submit.prevent="salvarTelefone">
                <div class="flex-1">
                    <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                    <input type="text" wire:model="telefone" id="telefone"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Salvar
                </button>
            </form>

            <!-- Formulário Senha (Note que a senha não é preenchida automaticamente por razões de segurança) -->
            <form class="flex items-center space-x-4" wire:submit.prevent="salvarSenha">
                <div class="flex-1">
                    <label for="senha" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input type="password" wire:model="senha" id="senha"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Salvar
                </button>
            </form>
        </div>
    </div>
</div>