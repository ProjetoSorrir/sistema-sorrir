<div class="card card-margins">
    <div class="card__title">FAQ</div>
    <div class="page-instructions">
        <p>Adicione perguntas frequentes para ajudar seus clientes.</p>
    </div>

    <div class="mt-6">
        <form class="grid grid-cols-12 gap-6 lg:w-3/4" wire:submit.prevent="submit">
            <div class="input-container col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-5">
                <label for="question">Pergunta</label>
                <input type="text" wire:model="newQuestion" id="question" name="question"
                    placeholder="Escreva aqui sua pergunta">
                @error('newQuestion')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>
            <div class="input-container col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-5">
                <label for="answer">Resposta</label>
                <textarea id="answer" name="answer" wire:model="newAnswer" placeholder="Escreva aqui sua resposta"></textarea>
                @error('newAnswer')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>
            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-2 flex items-center lg:mb-3">
                @if ($currentFaqId)
                    <button type="submit" class="primary-button w-[240px] min-[375px]:w-[300px] md:w-[120px]">
                        Atualizar
                    </button>
                @else
                    <button type="submit"
                        class="primary-button w-[240px] min-[375px]:w-[300px] min-[425px]:w-full md:w-[120px]">
                        Salvar
                    </button>
                @endif
            </div>
        </form>
    </div>
    <div class="grid grid-cols-12 gap-6 lg:w-3/4">
        <div class="col-span-12  w-[240px] min-[375px]:w-[300px] min-[425px]:w-full md:w-1/2">
            <label for="search" class="block text-sm text-gray-700 mb-1 font-bold">Pesquisar pergunta</label>
            <div class="flex items-center border border-primary rounded px-2">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Buscar" required=""
                    class="border-none w-full">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="fill-dark-grey">
                    <mask id="mask0_702_2663" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                        width="24" height="24">
                        <rect width="24" height="24" />
                    </mask>
                    <g mask="url(#mask0_702_2663)">
                        <path
                            d="M19.6 21L13.3 14.7C12.8 15.1 12.225 15.4167 11.575 15.65C10.925 15.8833 10.2333 16 9.5 16C7.68333 16 6.14583 15.3708 4.8875 14.1125C3.62917 12.8542 3 11.3167 3 9.5C3 7.68333 3.62917 6.14583 4.8875 4.8875C6.14583 3.62917 7.68333 3 9.5 3C11.3167 3 12.8542 3.62917 14.1125 4.8875C15.3708 6.14583 16 7.68333 16 9.5C16 10.2333 15.8833 10.925 15.65 11.575C15.4167 12.225 15.1 12.8 14.7 13.3L21 19.6L19.6 21ZM9.5 14C10.75 14 11.8125 13.5625 12.6875 12.6875C13.5625 11.8125 14 10.75 14 9.5C14 8.25 13.5625 7.1875 12.6875 6.3125C11.8125 5.4375 10.75 5 9.5 5C8.25 5 7.1875 5.4375 6.3125 6.3125C5.4375 7.1875 5 8.25 5 9.5C5 10.75 5.4375 11.8125 6.3125 12.6875C7.1875 13.5625 8.25 14 9.5 14Z" />
                    </g>
                </svg>
            </div>

        </div>

    </div>

    <div class="overflow-x-auto mt-4">
        <div class="lg:w-3/4">
            <table class="custom-table w-full">
                <thead>
                    <tr>
                        <th scope="col" class="w-1/5">Pergunta</th>
                        <th scope="col" class="w-3/5">Resposta</th>
                        <th scope="col" class="w-1/5">Opções</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($faqs as $faq)
                        <tr>
                            <td class="text-left w-1/5">{{ $faq->question }}</td>
                            <td class="text-left w-3/5">{{ $faq->answer }}</td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex items-center justify-center space-x-2">
                                <button wire:click="editFaq({{ $faq->id }})" aria-label="Editar">
                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                        class="fill-dark-grey hover:fill-black" xmlns="http://www.w3.org/2000/svg">
                                        <mask id="mask0_957_2643" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="24" height="24">
                                            <rect width="24" height="24" />
                                        </mask>
                                        <g mask="url(#mask0_957_2643)">
                                            <path
                                                d="M5 19H6.425L16.2 9.225L14.775 7.8L5 17.575V19ZM3 21V16.75L16.2 3.575C16.4 3.39167 16.6208 3.25 16.8625 3.15C17.1042 3.05 17.3583 3 17.625 3C17.8917 3 18.15 3.05 18.4 3.15C18.65 3.25 18.8667 3.4 19.05 3.6L20.425 5C20.625 5.18333 20.7708 5.4 20.8625 5.65C20.9542 5.9 21 6.15 21 6.4C21 6.66667 20.9542 6.92083 20.8625 7.1625C20.7708 7.40417 20.625 7.625 20.425 7.825L7.25 21H3ZM15.475 8.525L14.775 7.8L16.2 9.225L15.475 8.525Z" />
                                        </g>
                                    </svg>
                                </button>
                                <button wire:click="deleteFaq({{ $faq->id }})" aria-label="Deletar">
                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                        class="fill-dark-grey hover:fill-black" xmlns="http://www.w3.org/2000/svg">
                                        <mask id="mask0_959_2649" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="24" height="24">
                                            <rect width="24" height="24" />
                                        </mask>
                                        <g mask="url(#mask0_959_2649)">
                                            <path
                                                d="M7 21C6.45 21 5.97917 20.8042 5.5875 20.4125C5.19583 20.0208 5 19.55 5 19V6H4V4H9V3H15V4H20V6H19V19C19 19.55 18.8042 20.0208 18.4125 20.4125C18.0208 20.8042 17.55 21 17 21H7ZM17 6H7V19H17V6ZM9 17H11V8H9V17ZM13 17H15V8H13V17Z" />
                                        </g>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $faqs->links() }}
            </div>
        </div>
    </div>
</div>
