
    <button wire:click="logout" class="group relative flex gap-x-6 rounded-lg hover:bg-gray-50 w-full text-left">
        <div class="group relative flex gap-x-6 rounded-lg p-4 hover:bg-gray-50">
            <div
                class="mt-1 flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                <svg class="h-6 w-6 text-gray-600 group-hover:text-[#f04e23]" data-slot="icon"
                    fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-gray-900">
                Sair
                </p>
                <p class="text-gray-600">Desconecte da sua conta</p>
            </div>
        </div>
    </button>
