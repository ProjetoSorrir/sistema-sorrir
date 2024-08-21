<div class="card card-margins overflow-auto">
    <h2 class="card__title mb-2">Criar Rifa</h2>

    {{-- <livewire:tabs-component :tab-names="['Informações Gerais', 'Premiação', 'Venda', 'Promoções', 'Números Sorteados']" :tab-fields="[
        [['component' => 'admin.form.general-info']],
        [['component' => 'admin.form.award']],
        [['component' => 'admin.form.sale']],
        [['component' => 'admin.form.promotion']],
        [['component' => 'admin.form.winner']],
    ]" /> --}}


    <div x-data="{ activeTab: 'tab1' }">
        <div class="flex w-full">
            <div @click="activeTab = 'tab1'" class="tracking-wide text-base cursor-pointer py-2 px-6"
                :class="{
                    'text-dark-grey': activeTab !== 'tab1',
                    'font-bold text-primary border-b border-primary': activeTab === 'tab1',
                }">
                Informações Gerais
            </div>

            <div @click="activeTab = 'tab2'" class="tracking-wide text-base cursor-pointer py-2 px-6"
                :class="{
                    'text-dark-grey': activeTab !== 'tab2',
                    'font-bold text-primary border-b border-primary': activeTab === 'tab2',
                }">
                Premiação
            </div>
        </div>

        <!-- Tab 1 Content -->
        <div x-show="activeTab === 'tab1'" class="mt-5 grid grid-cols-12 gap-4">
            <!-- Include the content specific to Tab 1 -->
            <div class="col-span-12">
                <div>
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-6">
                            <div class="input-container">
                                <label for="name">Nome da Rifa *</label>
                                <input wire:model="name" type="text" id="name" placeholder="Nome da Rifa">
                                @error('name')
                                    @if (empty($name))
                                        <span class="text-red-500">{{ $message }}</span>
                                    @endif
                                @enderror
                            </div>
                        </div>


                        <div class="col-span-12 grid grid-cols-12 gap-6">
                            <div class="col-span-6">
                                <div class="input-container">
                                    <label for="description">Descrição</label>
                                    <textarea wire:model="description" id="description" class="text-dark-grey" rows="5" placeholder="Descrição"></textarea>
                                    @error('description')
                                        @if (empty($description))
                                            <span class="text-red-500">{{ $message }}</span>
                                        @endif
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-6">
                                <p class="text-sm font-bold tracking-wide">Imagem da Rifa</p>
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" x-data="dragDrop()">
                                    <div class="drop-container border-2 border-dashed border-secondary rounded-md flex flex-col items-center p-6 text-primary font-bold"
                                        x-on:dragover.prevent="dragover" x-on:dragleave.prevent="dragleave"
                                        x-on:drop.prevent="drop($event)">
                                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <mask id="mask0_248_805" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                                x="0" y="0" width="40" height="40">
                                                <rect width="40" height="40" fill="rgba(94, 11, 130, 0.50)" />
                                            </mask>
                                            <g mask="url(#mask0_248_805)">
                                                <path
                                                    d="M10.8334 33.3334C8.30558 33.3334 6.14585 32.4584 4.35419 30.7084C2.56252 28.9584 1.66669 26.8195 1.66669 24.2917C1.66669 22.125 2.31946 20.1945 3.62502 18.5C4.93058 16.8056 6.63891 15.7222 8.75002 15.25C9.44447 12.6945 10.8334 10.625 12.9167 9.04169C15 7.45835 17.3611 6.66669 20 6.66669C23.25 6.66669 26.007 7.79863 28.2709 10.0625C30.5347 12.3264 31.6667 15.0834 31.6667 18.3334C33.5834 18.5556 35.1736 19.382 36.4375 20.8125C37.7014 22.2431 38.3334 23.9167 38.3334 25.8334C38.3334 27.9167 37.6042 29.6875 36.1459 31.1459C34.6875 32.6042 32.9167 33.3334 30.8334 33.3334H21.6667C20.75 33.3334 19.9653 33.007 19.3125 32.3542C18.6597 31.7014 18.3334 30.9167 18.3334 30V21.4167L15.6667 24L13.3334 21.6667L20 15L26.6667 21.6667L24.3334 24L21.6667 21.4167V30H30.8334C32 30 32.9861 29.5972 33.7917 28.7917C34.5972 27.9861 35 27 35 25.8334C35 24.6667 34.5972 23.6806 33.7917 22.875C32.9861 22.0695 32 21.6667 30.8334 21.6667H28.3334V18.3334C28.3334 16.0278 27.5209 14.0625 25.8959 12.4375C24.2709 10.8125 22.3056 10 20 10C17.6945 10 15.7292 10.8125 14.1042 12.4375C12.4792 14.0625 11.6667 16.0278 11.6667 18.3334H10.8334C9.22224 18.3334 7.84724 18.9028 6.70835 20.0417C5.56947 21.1806 5.00002 22.5556 5.00002 24.1667C5.00002 25.7778 5.56947 27.1528 6.70835 28.2917C7.84724 29.4306 9.22224 30 10.8334 30H15V33.3334H10.8334Z"
                                                    fill="rgba(94, 11, 130, 0.50)" />
                                            </g>
                                        </svg>
                                        <h4 class="text-center">Clique para enviar ou arraste e solte<br />SVG, PNG, JPG
                                            ou GIF (Max.
                                            800px
                                            x 400px)</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 flex justify-center items-center">
                            <div class="line w-full border border-primary h-[1px]"></div>
                            <h3 class="w-[300px] text-center font-bold text-md">Sorteio</h3>
                            <div class="line w-full border border-primary h-[1px]"></div>
                        </div>

                        <div class="page-instructions col-span-12">Defina a data e o horário do sorteio da sua rifa.
                            <p>Atenção! As vendas desta rifa serão interrompidas meia hora antes da data do sorteio.</p>
                        </div>


                        <div class="col-span-2">
                            <div class="input-container">
                                <label for="draw_date">Data do Sorteio</label>
                                <input wire:model="draw_date" type="date" id="draw_date" class="text-dark-grey">
                                @error('draw_date')
                                    @if (empty($draw_date))
                                        <span class="text-red-500">{{ $message }}</span>
                                    @endif
                                @enderror
                            </div>
                        </div>

                        <div class="col-span-2">
                            <div class="input-container">
                                <label for="publication_hour">Hora do sorteio</label>
                                <input type="text" placeholder="12:00">
                            </div>
                        </div>

                        <div class="col-span-2">
                            <div class="flex items-center h-full pt-4">
                                <input type="checkbox" class="text-primary" id="show_draw_date"
                                    wire:model="show_draw_date">
                                <label class="pl-2" for="show_draw_date">Mostrar data do sorteio</label>
                                @error('show_draw_date')
                                    @if (empty($show_draw_date))
                                        <span class="text-red-500">{{ $message }}</span>
                                    @endif
                                @enderror
                            </div>
                        </div>

                        <div class="col-span-4">
                            <div class="input-container">
                                <label for="draw_held">Por onde será feito o sorteio?</label>
                                <select wire:model="draw_held" type="text" id="draw_held" name="draw_held"
                                    class="text-dark-grey">
                                    <option value="1" selected>Loteria Federal</option>
                                    <option value="2">Sorteador.com.br</option>
                                    <option value="3">Live no Instagram</option>
                                    <option value="3">Live no Youtube</option>
                                    <option value="3">Live no TikTok</option>
                                    <option value="3">Outros</option>
                                </select>
                                {{-- qual? --}}
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="input-container">
                                <label for="name">Qual? *</label>
                                <input wire:model="name" type="text" id="name"
                                    placeholder="Local do Sorteio">
                                @error('name')
                                    @if (empty($name))
                                        <span class="text-red-500">{{ $message }}</span>
                                    @endif
                                @enderror
                            </div>
                        </div>



                        <div class="col-span-12 flex justify-center items-center">
                            <div class="line w-full border border-primary h-[1px]"></div>
                            <h3 class="w-[300px] text-center font-bold text-md">Publicação</h3>
                            <div class="line w-full border border-primary h-[1px]"></div>
                        </div>
                        <div class="page-instructions col-span-12">Defina a data e hora na qual deseja que sua rifa vá
                            ao ar, caso
                            não
                            preencha
                            esses campos, sua rifa será publicada imediatamente após a criação.</div>
                        <div class="col-span-2">
                            <div class="input-container">
                                <label for="publication_date">Data da publicação</label>
                                <input type="date" class="text-dark-grey">
                            </div>
                        </div>

                        <div class="col-span-2">
                            <div class="input-container">
                                <label for="publication_hour">Hora da publicação</label>
                                <input type="text" placeholder="12:00">
                            </div>
                        </div>


                        <div class="col-span-12 flex justify-end">
                            <button class="primary-button">
                                Proximo
                            </button>
                        </div>
                    </div>
                </div>
                <script>
                    function dragDrop() {
                        return {
                            uploadProgress: 0,
                            dragover() {
                                console.log('draged')
                            },
                            dragleave() {
                                console.log('leave')
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
                                @this.upload('slide_images', file,
                                    (success) => {

                                    },
                                    (error) => {

                                    },
                                    (event) => {
                                        this.uploadProgress = event.detail.progress;
                                    }
                                )
                            }
                        }
                    }
                </script>

            </div>
        </div>

        <!-- Tab 2 Content -->
        <div x-show="activeTab === 'tab2'" class="mt-5 grid grid-cols-12 gap-4">
            <!-- Include the content specific to Tab 1 -->
            <div class="col-span-12">
                <div>
                    <h4 class="page-instructions">Defina os prêmios para sua rifa de acordo com cada situação.
                        Você pode definir até 9 prêmios.
                    </h4>
                    <div class="grid grid-cols-12 gap-6 mt-2">
                        <div class="col-span-6 flex gap-4 items-end">
                            <div class="input-container">
                                <label for="winner">Prêmio 1º Ganhador *</label>
                                <input wire:model="winner" type="text" id="winner" placeholder="Prêmio">
                                @error('winner')
                                    @if (empty($winner))
                                        <span class="text-red-500">{{ $message }}</span>
                                    @endif
                                @enderror
                            </div>
                            <button class="icon-primary-button">
                                <svg width="24" height="24" viewBox="0 0 24 24" class="fill-secondary"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_1012_2643" style="mask-type:alpha" maskUnits="userSpaceOnUse"
                                        x="0" y="0" width="24" height="24">
                                        <rect width="24" height="24" />
                                    </mask>
                                    <g mask="url(#mask0_1012_2643)">
                                        <path d="M11 13H5V11H11V5H13V11H19V13H13V19H11V13Z" />
                                    </g>
                                </svg>
                            </button>
                        </div>
                        <div class="col-span-12 mb-2">
                            <div class="flex items-center h-full pt-4">
                                <input type="checkbox" class="text-primary" id="show_draw_date"
                                    wire:model="show_draw_date">
                                <label class="pl-2" for="show_draw_date">Adicionar Top Compradores</label>
                            </div>
                        </div>

                    </div>


                    <div class="top-buyers col-span-12 grid grid-cols-12 gap-6">
                        <div class="col-span-12 flex justify-center items-center">
                            <div class="line w-full border border-primary h-[1px]"></div>
                            <h3 class="w-[400px] text-center font-bold text-md">Top Compradores</h3>
                            <div class="line w-full border border-primary h-[1px]"></div>
                        </div>
                        <div class="col-span-4">
                            <div class="input-container">
                                <label for="first_prize">1º Top Comprador</label>
                                <input wire:model="first_prize" type="text" id="first_prize"
                                    placeholder="Prêmio">
                            </div>
                        </div>

                        <div class="col-span-4">
                            <div class="input-container">
                                <label for="second_prize">2º Top Comprador</label>
                                <input wire:model="second_prize" type="text" id="second_prize"
                                    placeholder="Prêmio">
                            </div>
                        </div>

                        <div class="col-span-4">
                            <div class="input-container">
                                <label for="third_prize">3º Top Comprador</label>
                                <input wire:model="third_prize" type="text" id="third_prize"
                                    placeholder="Prêmio">
                            </div>
                        </div>

                        <div class="col-span-12 mb-2">
                            <div class="flex items-center h-full pt-4">
                                <input type="checkbox" class="text-primary" id="show_draw_date"
                                    wire:model="show_draw_date">
                                <label class="pl-2" for="show_draw_date">Mostrar Premiação do Top Compradores no
                                    Site</label>
                            </div>
                        </div>
                        <div class="col-span-12 flex justify-center items-center">
                            <div class="line w-full border border-primary h-[1px]"></div>
                            <h3 class="w-[300px] text-center font-bold text-md">Bônus</h3>
                            <div class="line w-full border border-primary h-[1px]"></div>
                        </div>
                        <h4 class="page-instructions col-span-12">Insira abaixo o link onde o usuário será direcionado
                            para receber o
                            bônus. Pode ser um link do Google Drive, Whatsapp etc.
                        </h4>
                        <div class="col-span-4 input-container">
                            <label for="winner">Link para o bônus</label>
                            <input wire:model="winner" type="text" id="winner" placeholder="link">
                            @error('winner')
                                @if (empty($winner))
                                    <span class="text-red-500">{{ $message }}</span>
                                @endif
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-12 mt-4 flex justify-end">
                        <button class="bg-red-500 text-white px-4 py-2 rounded mr-5">
                            Anterior
                        </button>
                        <button class="primary-button">
                            Proximo
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Add more divs for additional tabs' content -->
    </div>
    {{-- <div class="col-span-12 flex justify-end">
        <button wire:click="save" class="primary-button">
            Salvar
        </button>
    </div> --}}
</div>
