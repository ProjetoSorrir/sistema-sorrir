<div class="box-border">
    @if (session()->has('error'))
        <div class="alert alert-danger text-sm text-red-500">
            {{ session('error') }}
        </div>
    @endif
    <form class="grid grid-cols-12 gap-6 mt-6" wire:submit.prevent="submit">
        {{-- @foreach ($errors->all() as $error)
        <small class="text-red-500">
            <li>{{ $error }}</li>
        </small>
        @endforeach --}}

        <div class="input-container col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4">
            <label for="name">Nome da Imagem *</label>
            <input wire:model.defer="name" type="text" id="name" name="name" placeholder="Nome da Imagem">
            @error('name')
                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
            @enderror
        </div>
        <div class="input-container col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4">
            <label for="image_alt">Texto Alternativo</label>
            <input wire:model.defer="image_alt" type="text" id="mage_alt" name="image_alt"
                placeholder="Texto Alternativo">
        </div>
        <div class="input-container col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4">
            <label for="image_link">Link</label>
            <input wire:model.defer="image_link" type="text" id="image-link" name="image_link" placeholder="link">
        </div>
        <div class="input-container col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4">
            <label for="image-status">Status</label>
            <select wire:model.defer="status" id="image-status" name="status">
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
            </select>
        </div>
        @if ($editing)
            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4">

                <div class="input-container">
                    <label for="order">Ordem</label>
                    <input wire:model.defer="order" type="text" id="order" name="order" placeholder="1">
                    @error('order')
                        <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                    @enderror
                </div>

            </div>
        @endif
        @if (!$editing)
            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4">

                <p class="text-sm font-bold tracking-wide">Imagem *</p>

                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex-1 h-[180px] md:h-[140px] w-[240px] min-[375px]:w-[300px] min-[425px]:w-full">
                    <div
                        class="border-2 border-dashed border-secondary rounded-md flex flex-col items-center p-4 text-primary font-bold h-[180px] md:h-[140px]">
                        <label for="slide_image" class="flex flex-col items-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" class="fill-primary-50"
                                xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_1571_2655" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                    y="0" width="24" height="24">
                                    <rect width="24" height="24" />
                                </mask>
                                <g mask="url(#mask0_1571_2655)">
                                    <path
                                        d="M6.5 20C4.98333 20 3.6875 19.475 2.6125 18.425C1.5375 17.375 1 16.0917 1 14.575C1 13.275 1.39167 12.1167 2.175 11.1C2.95833 10.0833 3.98333 9.43333 5.25 9.15C5.66667 7.61667 6.5 6.375 7.75 5.425C9 4.475 10.4167 4 12 4C13.95 4 15.6042 4.67917 16.9625 6.0375C18.3208 7.39583 19 9.05 19 11C20.15 11.1333 21.1042 11.6292 21.8625 12.4875C22.6208 13.3458 23 14.35 23 15.5C23 16.75 22.5625 17.8125 21.6875 18.6875C20.8125 19.5625 19.75 20 18.5 20H13C12.45 20 11.9792 19.8042 11.5875 19.4125C11.1958 19.0208 11 18.55 11 18V12.85L9.4 14.4L8 13L12 9L16 13L14.6 14.4L13 12.85V18H18.5C19.2 18 19.7917 17.7583 20.275 17.275C20.7583 16.7917 21 16.2 21 15.5C21 14.8 20.7583 14.2083 20.275 13.725C19.7917 13.2417 19.2 13 18.5 13H17V11C17 9.61667 16.5125 8.4375 15.5375 7.4625C14.5625 6.4875 13.3833 6 12 6C10.6167 6 9.4375 6.4875 8.4625 7.4625C7.4875 8.4375 7 9.61667 7 11H6.5C5.53333 11 4.70833 11.3417 4.025 12.025C3.34167 12.7083 3 13.5333 3 14.5C3 15.4667 3.34167 16.2917 4.025 16.975C4.70833 17.6583 5.53333 18 6.5 18H9V20H6.5Z" />
                                </g>
                            </svg>
                            <p class="text-sm mb-1">Clique para enviar</p>
                            <p class="text-xs">Tamanho máximo do arquivo 50 KB.</p>
                            <p class="text-xs">Tamanho da imagem 1920x600 pixels</p>
                            <p class="text-xs">Arquivo SVG, PNG, ou JPG são aceitos.</p>
                        </label>
                        <input class="opacity-0 absolute z-[-1]" type="file" id="slide_image" name="slide_image"
                            wire:model="slide_image" required>
                    </div>
                </div>
                @error('slide_image')
                    <span class="error">{{ $message }}</span>
                @enderror
                @if ($slide_image)
                    <img src="{{ asset($slide_image->temporaryUrl()) }}" class="h-12 w-auto">
                @endif
            </div>


            <div class="col-span-12 md:col-span-6 lg:col-span-3 mt-3 md:mt-4">
                <button type="submit"
                    class="primary-button w-[240px] min-[375px]:w-[300px] min-[425px]:w-full lg:w-[100px]">
                    Salvar
                </button>
            </div>
        @endif

        {{-- @if ($editing == false)
        <!-- Upload de Imagem -->
        <div class="col-span-12 sm:col-span-12 ">
            <div class="col-span-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex-1 h-[140px] w-[240px] min-[375px]:w-[300px] min-[425px]:w-full"
                    x-data="dragDrop('image')">
                    <input type="file" name="image" id="image" class="invisible" style="display:none;"
                        wire:model="image">
                    <div class="drop-container border-2 border-dashed border-secondary rounded-md flex flex-col items-center p-4 text-primary font-bold h-[140px]"
                        x-on:dragover.prevent="dragover" x-on:dragleave.prevent="dragleave"
                        x-on:drop.prevent="drop($event)">
                        <!-- Ícone de upload -->
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                        <h4 class="text-center">Clique para enviar ou arraste e solte</h4>
                        <br />Arquivo SVG, PNG, JPG ou
                        GIF são aceitos.
                        <input type="file" name="image" id="image" wire:model="image"
                            class="cursor-pointer absolute block opacity-0 pin-r pin-t">
                    </div>
                </div>
                @error('image')
                <div class="bg-red-600 rounded-lg px-2 py-1 mt-2">
                                    <span class="text-sm text-white">{{ $message }}</span>
                                </div>
                @enderror
                <!-- Progress Bar-->
                @if ($image)
                <div class="progress mt-2 h-4 rounded-full bg-gray-200" x-show="image !== null || uploadProgress > 0">
                    <div class="progress-bar h-4 rounded-full bg-lime-700 text-sm p-1" role="progressbar"
                        :style="{ width: uploadProgress + '%' }" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="mb-2 flex items-center justify-between text-xs">
                        <div class="text-gray-600">Progresso</div>
                        <div class="text-gray-600">100%</div>
                        @if (is_a($image, 'Illuminate\Http\UploadedFile'))
                        <div class="text-gray-600">{{ $image->getClientOriginalName() }}</div>
                        @endif
                    </div>
                    @endif
                </div>
                <div class="flex justify-end py-2 mt-3">
                    <button type="submit" class="primary-button">
                        Salvar
                    </button>
                </div>
                @endif
            </div>
        </div> --}}
        @if ($editing)
            <div class="col-span-12 md:col-span-6 lg:col-span-3 mt-3 md:mt-4">
                <button wire:click="updateSlide"
                    class="primary-button w-[240px] min-[375px]:w-[300px] min-[425px]:w-full lg:w-[100px]">Atualizar</button>
            </div>
        @endif
    </form>

</div>

{{-- <script>
    function dragDrop(field) {
        return {
            dragover() {
                uploadProgress: 0
                //console.log('dragover')
            },
            dragleave() {
                //console.log('dragleave')
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

<script>
    Livewire.on('slideDetailsLoaded', (slideDetails) => {
        @this.name = slideDetails.name;
        @this.status = slideDetails.status;
        @this.image_alt = slideDetails.image_alt;
        @this.order = slideDetails.order;
        @this.image = slideDetails.image;
        @this.image_link = slideDetails.image_link;
        @this.editing = true;
    });
</script>
