<div class="card card-margins">
    <!-- Título da seção de vídeo -->
    <div class="card__title">Editar seu Site</div>
    <div class="page-instructions">
        <p>Personalize seu site como desejar.</p>
    </div>
    <!-- Instruções da página -->

    <div class="max-w-4xl mt-4 ">
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative" role="alert"
                id="successMessage">
                {{ session()->get('message') }}
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('successMessage').remove();
                }, 5000); // 5000 milissegundos = 5 segundos
            </script>
        @endif

        <form class="mt-4 grid grid-cols-12 gap-4" wire:submit.prevent="submit">

            <!-- Site Name -->
            <div class="input-container col-span-12 md:col-span-6">
                <label for="site_name" class="form-label">Nome do Site</label>
                <input type="text" name="site_name" id="site_name" class="form-control" wire:model="site_name">
                @error('site_name')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>

            <!-- Pixel do Facebook -->
            <div class="input-container col-span-12 md:col-span-6">
                <label for="pixel_facebook" class="form-label">Pixel do Facebook</label>
                <input type="text" name="pixel_facebook" id="facebook_pixel" class="form-control"
                    wire:model="pixel_facebook">
                @error('pixel_facebook')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
                <a href="https://www.facebook.com/business/help/952192354843755" target="_blank"
                    class="text-primary">Não sabe encontrar seu pixel? Clique aqui.</a>
                </a>
            </div>


            <!-- Mercado Pago Token -->
            <div class="input-container col-span-12 md:col-span-6">
                <label for="mercado_pago_token" class="form-label">Token do Mercado Pago</label>
                <input type="text" name="mercado_pago_token" id="mercado_pago_token"
                    class="form-control cursor-not-allowed" wire:model="mercado_pago_token" disabled>
                @error('mercado_pago_token')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
                <a href="https://www.mercadopago.com.br/developers/panel/credentials" target="_blank"
                    class="text-primary">Não sabe encontrar seu token? Clique aqui.</a>
            </div>

            <div class="col-span-12 md:col-span-6 flex gap-4">
                <!-- Logo -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4 col-span-12 md:col-span-6 w-full">
                    <p class="text-sm font-bold tracking-wide">Escolha seu Logo</p>
                    @if ($logo_image)
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img src="{{ asset($logo_image) }}" alt="Logo" class="h-12 w-auto">
                            </div>
                            <button type="button" wire:click="removeLogo"
                                wire:confirm="Você tem certeza de que deseja excluir esta Logo?"
                                class="ml-2 text-red-500">Excluir</button>
                        </div>
                    @else
                        <div
                            class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex-1 h-[160px] md:h-[140px] w-full">
                            <div
                                class="border-2 border-dashed border-secondary rounded-md flex flex-col items-center p-4 text-primary font-bold h-[160px] md:h-[140px]">
                                <label for="logo" class="flex flex-col items-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="fill-primary-50"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <mask id="mask0_1571_2655" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="24" height="24">
                                            <rect width="24" height="24" />
                                        </mask>
                                        <g mask="url(#mask0_1571_2655)">
                                            <path
                                                d="M6.5 20C4.98333 20 3.6875 19.475 2.6125 18.425C1.5375 17.375 1 16.0917 1 14.575C1 13.275 1.39167 12.1167 2.175 11.1C2.95833 10.0833 3.98333 9.43333 5.25 9.15C5.66667 7.61667 6.5 6.375 7.75 5.425C9 4.475 10.4167 4 12 4C13.95 4 15.6042 4.67917 16.9625 6.0375C18.3208 7.39583 19 9.05 19 11C20.15 11.1333 21.1042 11.6292 21.8625 12.4875C22.6208 13.3458 23 14.35 23 15.5C23 16.75 22.5625 17.8125 21.6875 18.6875C20.8125 19.5625 19.75 20 18.5 20H13C12.45 20 11.9792 19.8042 11.5875 19.4125C11.1958 19.0208 11 18.55 11 18V12.85L9.4 14.4L8 13L12 9L16 13L14.6 14.4L13 12.85V18H18.5C19.2 18 19.7917 17.7583 20.275 17.275C20.7583 16.7917 21 16.2 21 15.5C21 14.8 20.7583 14.2083 20.275 13.725C19.7917 13.2417 19.2 13 18.5 13H17V11C17 9.61667 16.5125 8.4375 15.5375 7.4625C14.5625 6.4875 13.3833 6 12 6C10.6167 6 9.4375 6.4875 8.4625 7.4625C7.4875 8.4375 7 9.61667 7 11H6.5C5.53333 11 4.70833 11.3417 4.025 12.025C3.34167 12.7083 3 13.5333 3 14.5C3 15.4667 3.34167 16.2917 4.025 16.975C4.70833 17.6583 5.53333 18 6.5 18H9V20H6.5Z" />
                                        </g>
                                    </svg>
                                    <ul class="mt-1 text-sm text-bold list-disc list-inside">
                                        <li>Tamanho máximo da imagem 2MB.</li>
                                        <li>Recomendável uma imagem com dimensões de 45x40 pixels.</li>
                                    </ul>
                                </label>
                                <input type="file" name="logo" id="logo" wire:model="logo"
                                    class="opacity-0 absolute z-[-1]">
                            </div>
                        </div>
                        @if ($logo)
                            <div class="flex items-center">
                                <img src="{{ $logo->temporaryUrl() }}" class="h-12 w-auto">
                            </div>
                        @endif
                        @error('logo')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                        @enderror
                    @endif
                </div>
            </div>

            {{-- <div class="col-span-12 md:col-span-6 flex gap-4">
                <!-- Logo -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4 col-span-12 md:col-span-6"
                    x-data="dragDrop('logo')">
                    <p class="text-sm font-bold tracking-wide">Escolha seu Logo</p>
                    @if ($logo_image)
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img src="{{ asset($logo_image) }}" alt="Logo" class="h-12 w-auto">
                            </div>
                            <button type="button" wire:click="removeLogo"
                                wire:confirm="Você tem certeza de que deseja excluir esta Logo?"
                                class="ml-2 text-red-500">Excluir</button>
                        </div>
                    @else
                        <input type="file" name="logo" id="logo" style="display:none;" wire:model="logo">
                        <div class="relative drop-container border-2 border-dashed border-secondary rounded-md flex flex-col items-center p-4 text-primary font-bold"
                            x-on:dragover.prevent="dragover" x-on:dragleave.prevent="dragleave"
                            x-on:drop.prevent="drop($event)">
                            <!-- Ícone de upload -->
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_248_805" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                    width="40" height="40">
                                    <rect width="40" height="40" fill="rgba(94, 11, 130, 0.50)" />
                                </mask>
                                <g mask="url(#mask0_248_805)">
                                    <path
                                        d="M10.8334 33.3334C8.30558 33.3334 6.14585 32.4584 4.35419 30.7084C2.56252 28.9584 1.66669 26.8195 1.66669 24.2917C1.66669 22.125 2.31946 20.1945 3.62502 18.5C4.93058 16.8056 6.63891 15.7222 8.75002 15.25C9.44447 12.6945 10.8334 10.625 12.9167 9.04169C15 7.45835 17.3611 6.66669 20 6.66669C23.25 6.66669 26.007 7.79863 28.2709 10.0625C30.5347 12.3264 31.6667 15.0834 31.6667 18.3334C33.5834 18.5556 35.1736 19.382 36.4375 20.8125C37.7014 22.2431 38.3334 23.9167 38.3334 25.8334C38.3334 27.9167 37.6042 29.6875 36.1459 31.1459C34.6875 32.6042 32.9167 33.3334 30.8334 33.3334H21.6667C20.75 33.3334 19.9653 33.007 19.3125 32.3542C18.6597 31.7014 18.3334 30.9167 18.3334 30V21.4167L15.6667 24L13.3334 21.6667L20 15L26.6667 21.6667L24.3334 24L21.6667 21.4167V30H30.8334C32 30 32.9861 29.5972 33.7917 28.7917C34.5972 27.9861 35 27 35 25.8334C35 24.6667 34.5972 23.6806 33.7917 22.875C32.9861 22.0695 32 21.6667 30.8334 21.6667H28.3334V18.3334C28.3334 16.0278 27.5209 14.0625 25.8959 12.4375C24.2709 10.8125 22.3056 10 20 10C17.6945 10 15.7292 10.8125 14.1042 12.4375C12.4792 14.0625 11.6667 16.0278 11.6667 18.3334H10.8334C9.22224 18.3334 7.84724 18.9028 6.70835 20.0417C5.56947 21.1806 5.00002 22.5556 5.00002 24.1667C5.00002 25.7778 5.56947 27.1528 6.70835 28.2917C7.84724 29.4306 9.22224 30 10.8334 30H15V33.3334H10.8334Z"
                                        fill="rgba(94, 11, 130, 0.50)" />
                                </g>
                            </svg>
                            <h4 class="text-center">Clique para enviar ou arraste e solte
                                <br />

                            </h4>
                            <input type="file" name="logo" id="logo" wire:model="logo"
                                class="cursor-pointer absolute block opacity-0 pin-r pin-t">
                            <ul class="mt-1 text-sm text-bold list-disc list-inside">
                                <li>Tamanho máximo da imagem 2MB.</li>
                                <li class="text-center">Recomendável uma imagem com<br>dimensões de 45x40 pixels.</li>
                            </ul>
                        </div>
                        @error('logo')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                        @enderror
                    @endif
                    <!--Progress Bar Logo -->
                    @if ($logo)
                        <div class="progress mt-2 h-4 rounded-full bg-gray-200" x-show="uploadProgress > 0">
                            <div class="progress-bar h-4 rounded-full bg-lime-700 text-sm p-1" role="progressbar"
                                :style="{ width: uploadProgress + '%' }" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="mb-2 flex items-center justify-between text-xs">
                            <div class="text-gray-600">Progresso</div>
                            <div class="text-gray-600">100%</div>
                            <div class="text-gray-600">{{ $logo->getClientOriginalName() }}</div>
                        </div>
                    @endif
                </div>
            </div> --}}

            <div class="col-span-12 md:col-span-6 flex gap-4">
                <!-- Favicon -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4 col-span-12 md:col-span-6">
                    <label for="favicon" class="text-sm font-bold tracking-wide">Escolha seu favicon</label>
                    @if ($favicon_image)
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img src="{{ asset($favicon_image) }}" alt="Favicon" class="h-12 w-auto">
                            </div>
                            <button type="button" wire:click="removeFavicon"
                                wire:confirm="Você tem certeza de que deseja excluir este Favicon?"
                                class="ml-2 text-red-500">Excluir</button>
                        </div>
                    @else
                        <div
                            class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex-1 h-[160px] md:h-[140px] w-full">
                            <div
                                class="border-2 border-dashed border-secondary rounded-md flex flex-col items-center p-4 text-primary font-bold h-[160px] md:h-[140px]">
                                <label for="favicon" class="flex flex-col items-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" class="fill-primary-50"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <mask id="mask0_1571_2655" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="24" height="24">
                                            <rect width="24" height="24" />
                                        </mask>
                                        <g mask="url(#mask0_1571_2655)">
                                            <path
                                                d="M6.5 20C4.98333 20 3.6875 19.475 2.6125 18.425C1.5375 17.375 1 16.0917 1 14.575C1 13.275 1.39167 12.1167 2.175 11.1C2.95833 10.0833 3.98333 9.43333 5.25 9.15C5.66667 7.61667 6.5 6.375 7.75 5.425C9 4.475 10.4167 4 12 4C13.95 4 15.6042 4.67917 16.9625 6.0375C18.3208 7.39583 19 9.05 19 11C20.15 11.1333 21.1042 11.6292 21.8625 12.4875C22.6208 13.3458 23 14.35 23 15.5C23 16.75 22.5625 17.8125 21.6875 18.6875C20.8125 19.5625 19.75 20 18.5 20H13C12.45 20 11.9792 19.8042 11.5875 19.4125C11.1958 19.0208 11 18.55 11 18V12.85L9.4 14.4L8 13L12 9L16 13L14.6 14.4L13 12.85V18H18.5C19.2 18 19.7917 17.7583 20.275 17.275C20.7583 16.7917 21 16.2 21 15.5C21 14.8 20.7583 14.2083 20.275 13.725C19.7917 13.2417 19.2 13 18.5 13H17V11C17 9.61667 16.5125 8.4375 15.5375 7.4625C14.5625 6.4875 13.3833 6 12 6C10.6167 6 9.4375 6.4875 8.4625 7.4625C7.4875 8.4375 7 9.61667 7 11H6.5C5.53333 11 4.70833 11.3417 4.025 12.025C3.34167 12.7083 3 13.5333 3 14.5C3 15.4667 3.34167 16.2917 4.025 16.975C4.70833 17.6583 5.53333 18 6.5 18H9V20H6.5Z" />
                                        </g>
                                    </svg>
                                    <ul class="mt-1 text-sm text-bold list-disc list-inside">
                                        <li>Tamanho máximo da imagem 512 KB.</li>
                                        <li>Recomendável uma imagem com dimensões de 16x16 pixels.</li>
                                    </ul>
                                </label>
                                <input type="file" name="favicon" id="favicon" wire:model="favicon"
                                    class="opacity-0 absolute z-[-1]">
                            </div>
                        </div>
                        @if ($favicon)
                            <div class="flex items-center">
                                <img src="{{ $favicon->temporaryUrl() }}" class="h-12 w-auto">
                            </div>
                        @endif
                        @error('favicon')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                        @enderror
                    @endif
                </div>
            </div>
            {{-- <div class="col-span-12 md:col-span-6 flex gap-4">
                <!-- Favicon -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4 col-span-12 md:col-span-6"
                    x-data="dragDrop('favicon')">
                    <label for="favicon" class="text-sm font-bold tracking-wide">Escolha seu favicon</label>
                    @if ($favicon_image)
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img src="{{ asset($favicon_image) }}" alt="Favicon" class="h-12 w-auto">
                            </div>
                            <button type="button" wire:click="removeFavicon"
                                wire:confirm="Você tem certeza de que deseja excluir este Favicon?"
                                class="ml-2 text-red-500">Excluir</button>
                        </div>
                    @else
                        <input type="file" name="favicon" id="favicon" style="display:none;"
                            wire:model="favicon">
                        <div class="drop-container border-2 border-dashed border-secondary rounded-md flex flex-col items-center p-4 text-primary font-bold"
                            x-on:dragover.prevent="dragover" x-on:dragleave.prevent="dragleave"
                            x-on:drop.prevent="drop($event)">
                            <!-- Ícone de upload -->
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_248_805" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                    y="0" width="40" height="40">
                                    <rect width="40" height="40" fill="rgba(94, 11, 130, 0.50)" />
                                </mask>
                                <g mask="url(#mask0_248_805)">
                                    <path
                                        d="M10.8334 33.3334C8.30558 33.3334 6.14585 32.4584 4.35419 30.7084C2.56252 28.9584 1.66669 26.8195 1.66669 24.2917C1.66669 22.125 2.31946 20.1945 3.62502 18.5C4.93058 16.8056 6.63891 15.7222 8.75002 15.25C9.44447 12.6945 10.8334 10.625 12.9167 9.04169C15 7.45835 17.3611 6.66669 20 6.66669C23.25 6.66669 26.007 7.79863 28.2709 10.0625C30.5347 12.3264 31.6667 15.0834 31.6667 18.3334C33.5834 18.5556 35.1736 19.382 36.4375 20.8125C37.7014 22.2431 38.3334 23.9167 38.3334 25.8334C38.3334 27.9167 37.6042 29.6875 36.1459 31.1459C34.6875 32.6042 32.9167 33.3334 30.8334 33.3334H21.6667C20.75 33.3334 19.9653 33.007 19.3125 32.3542C18.6597 31.7014 18.3334 30.9167 18.3334 30V21.4167L15.6667 24L13.3334 21.6667L20 15L26.6667 21.6667L24.3334 24L21.6667 21.4167V30H30.8334C32 30 32.9861 29.5972 33.7917 28.7917C34.5972 27.9861 35 27 35 25.8334C35 24.6667 34.5972 23.6806 33.7917 22.875C32.9861 22.0695 32 21.6667 30.8334 21.6667H28.3334V18.3334C28.3334 16.0278 27.5209 14.0625 25.8959 12.4375C24.2709 10.8125 22.3056 10 20 10C17.6945 10 15.7292 10.8125 14.1042 12.4375C12.4792 14.0625 11.6667 16.0278 11.6667 18.3334H10.8334C9.22224 18.3334 7.84724 18.9028 6.70835 20.0417C5.56947 21.1806 5.00002 22.5556 5.00002 24.1667C5.00002 25.7778 5.56947 27.1528 6.70835 28.2917C7.84724 29.4306 9.22224 30 10.8334 30H15V33.3334H10.8334Z"
                                        fill="rgba(94, 11, 130, 0.50)" />
                                </g>
                            </svg>
                            <h4 class="text-center">Clique para enviar ou arraste e solte
                            </h4>
                            <input type="file" name="favicon" id="favicon" wire:model="favicon"
                                class="cursor-pointer absolute block opacity-0 pin-r pin-t">
                            <ul class="mt-1 text-sm text-bold list-disc list-inside">
                                <li>Tamanho máximo da imagem 512 KB.</li>
                                <li class="text-center">Recomendável uma imagem com<br>dimensões de 16x16 pixels.</li>
                            </ul>
                        </div>
                        @error('favicon')
                            <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                        @enderror
                    @endif
                    <!--Progress Bar favicon -->
                    @if ($favicon)
                        <div class="progress mt-2 h-4 rounded-full bg-gray-200" x-show="uploadProgress > 0">
                            <div class="progress-bar h-4 rounded-full bg-lime-700 text-sm p-1" role="progressbar"
                                :style="{ width: uploadProgress + '%' }" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="mb-2 flex items-center justify-between text-xs">
                            <div class="text-gray-600">Progresso</div>
                            <div class="text-gray-600">100%</div>
                            <div class="text-gray-600">{{ $favicon->getClientOriginalName() }}</div>
                        </div>
                    @endif
                </div>
            </div> --}}


            {{-- redes sociais --}}

            <div class="col-span-12 flex justify-center items-center w-[240px] min-[375px]:w-[300px] md:w-full mt-8">
                <div class="line w-full border border-primary h-[1px]"></div>
                <h3 class="w-[500px] text-center font-bold text-md">Redes Sociais</h3>
                <div class="line w-full border border-primary h-[1px]"></div>
            </div>

            <div class="page-instructions col-span-12">
                <p>Preencha as redes sociais de sua preferência.</p>
                <p>Os links aparecerão em ícones no rodapé do seu site.</p>
                <p><strong>Atenção!</strong> Copiar o link completo da sua rede social! (Ex:
                    https://www.instagram/seu-nome)</p>
            </div>

            <!-- Instagram -->
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                <label for="instagram" class="form-label">Instagram</label>
                <input type="text" name="instagram" id="instagram" class="form-control" wire:model="instagram"
                    placeholder="https://www.instagram.com/seu_usuario">
                @error('instagram')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>

            <!-- Twitter -->
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                <label for="twitter" class="form-label">Twitter - X</label>
                <input type="text" name="twitter" id="twitter" class="form-control" wire:model="twitter"
                    placeholder="https://twitter.com/seu_usuario">
                @error('twitter')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>
            <!-- LinkedIn -->
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                <label for="linkedin" class="form-label">LinkedIn</label>
                <input type="text" name="linkedin" id="linkedin" class="form-control" wire:model="linkedin"
                    placeholder="https://www.linkedin.com/in/seu_perfil">
                @error('linkedin')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>

            <!-- TikTok -->
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                <label for="tiktok" class="form-label">TikTok</label>
                <input type="text" name="tiktok" id="tiktok" class="form-control" wire:model="TikTok"
                    placeholder="https://www.tiktok.com/@seu_usuario">
                @error('TikTok')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>

            <!-- YouTube -->
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                <label for="youtube" class="form-label">YouTube</label>
                <input type="text" name="youtube" id="youtube" class="form-control" wire:model="YouTube"
                    placeholder="https://www.youtube.com/seu_canal">
                @error('YouTube')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>

            <!-- Telegram -->
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                <label for="telegram" class="form-label">Telegram</label>
                <input type="text" name="telegram" id="telegram" class="form-control" wire:model="Telegram"
                    placeholder="https://t.me/seu_usuario">
                @error('Telegram')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>

            <!-- Grupo Telegram -->
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                <label for="telegram_grupo" class="form-label">Grupo Telegram</label>
                <input type="text" name="telegram_grupo" id="telegram_grupo" class="form-control"
                    wire:model="TelegramGrupo" placeholder="https://t.me/joinchat/codigo_do_grupo">
                @error('TelegramGrupo')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>

            <!-- Discord -->
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                <label for="discord" class="form-label">Canal do Discord</label>
                <input type="text" name="discord" id="discord" class="form-control" wire:model="discord"
                    placeholder="https://discord.gg/codigo_do_canal">
                @error('discord')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>

            <!-- WhatsappSuporteSite -->
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                <label for="whatsapp_suporte" class="form-label"> Suporte WhatsApp</label>
                <input type="text" name="whatsapp_suporte" id="whatsapp_suporte" class="form-control"
                    wire:model="WhatsappSuporteSite" placeholder="https://wa.me/5511999999999">
                @error('WhatsappSuporteSite')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>

            <!-- WhatsappGrupo -->
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                <label for="whatsapp_grupo" class="form-label">Grupo de WhatsApp</label>
                <input type="text" name="whatsapp_grupo" id="whatsapp_grupo" class="form-control"
                    wire:model="WhatsappGrupo" placeholder="https://chat.whatsapp.com/codigo_do_grupo">
                @error('WhatsappGrupo')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>

            <!-- Facebook -->
            <div class="input-container col-span-12 md:col-span-6 lg:col-span-4">
                <label for="facebook" class="form-label">Facebook</label>
                <input type="text" name="facebook" id="facebook" class="form-control" wire:model="facebook"
                    placeholder="https://www.facebook.com/seu_perfil">
                @error('facebook')
                    <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
            </div>

            <!-- Botão de Envio -->
            <div class="col-span-12 flex justify-end">
                <button type="submit" class="primary-button w-full md:w-[120px]">Atualizar</button>
            </div>
        </form>
    </div>
</div>

{{-- <script>
    function dragDrop(field) {
        return {
            uploadProgress: 0,
            dragover() {
                console.log('dragover')
            },
            dragleave() {
                console.log('dragleave')
            },
            drop(event) {
                if (event.dataTransfer.files.length > 0) {
                    const files = event.dataTransfer.files;
                    // Upload apenas o primeiro arquivo da lista
                    const file = files[0];
                    this.uploadFile(file);
                }
            },
            uploadFile(file) {
                @this.upload(field, file,
                    (success) => {
                        //console.log('success');
                    }, (error) => {
                        //console.log('error');
                    }, (event) => {
                        //console.log('event');
                        this.uploadProgress = event.detail.progress;
                    });
            }
        }
    }
</script> --}}
