<div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-2">
            <div class="input-container">
                <label for="raffleCode">Código da Rifa *</label>
                <input wire:model="raffleCode" type="text" id="raffleCode" placeholder="00000000">
            </div>
        </div>

        <div class="col-span-5">
            <div class="input-container">
                <label for="name">Nome da Rifa *</label>
                <input wire:model="name" type="text" id="name" placeholder="Nome da Rifa">
            </div>
        </div>

        <div class="col-span-5">
            <div class="input-container">
                <label for="publicationDate">Data da publicação</label>
                <input type="date" class="text-dark-grey">
            </div>
        </div>

        <div class="col-span-6">
            <div class="input-container">
                <label for="description">Descrição / Regulamento</label>
                <textarea wire:model="description" id="description" class="ckeditor text-dark-grey" rows="4" placeholder="Descrição / Regulamento"></textarea>
            </div>
        </div>

        <div class="col-span-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4" x-data="dragDrop()">
                <div class="drop-container border-2 border-dashed border-secondary rounded-md flex flex-col items-center p-4 text-primary font-bold"
                    x-on:dragover.prevent="dragover" x-on:dragleave.prevent="dragleave"
                    x-on:drop.prevent="drop($event)">
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
                    <h4 class="text-center">Clique para enviar ou arraste e solte<br/>SVG, PNG, JPG ou GIF (Max. 800px x 400px)</h4>
                </div>
            </div>
        </div>

        <div class="col-span-6">
            <div class="input-container">
                <label for="drawDate">Data do Sorteio</label>
                <input type="date" class="text-dark-grey">
            </div>
        </div>

        <div class="col-span-6">
            <div class="flex items-center h-full pt-4">
                <input type="checkbox" class="text-primary" id="drawDate">
                <label class="pl-2" for="drawDate">Mostrar data do sorteio</label>
            </div>
        </div>
    </div>
</div>