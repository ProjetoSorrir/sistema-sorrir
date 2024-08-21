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
                    <mask id="mask0_1012_2643" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                        width="24" height="24">
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
                <input type="checkbox" class="text-primary" id="show_draw_date" wire:model="show_draw_date">
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
                <input wire:model="first_prize" type="text" id="first_prize" placeholder="Prêmio">
            </div>
        </div>

        <div class="col-span-4">
            <div class="input-container">
                <label for="second_prize">2º Top Comprador</label>
                <input wire:model="second_prize" type="text" id="second_prize" placeholder="Prêmio">
            </div>
        </div>

        <div class="col-span-4">
            <div class="input-container">
                <label for="third_prize">3º Top Comprador</label>
                <input wire:model="third_prize" type="text" id="third_prize" placeholder="Prêmio">
            </div>
        </div>

        <div class="col-span-12 mb-2">
            <div class="flex items-center h-full pt-4">
                <input type="checkbox" class="text-primary" id="show_draw_date" wire:model="show_draw_date">
                <label class="pl-2" for="show_draw_date">Mostrar Premiação do Top Compradores no Site</label>
            </div>
        </div>
        <div class="col-span-12 flex justify-center items-center">
            <div class="line w-full border border-primary h-[1px]"></div>
            <h3 class="w-[300px] text-center font-bold text-md">Bônus</h3>
            <div class="line w-full border border-primary h-[1px]"></div>
        </div>
        <h4 class="page-instructions col-span-12">Insira abaixo o link onde o usuário será direcionado para receber o
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
        <button wire:click="save" class="primary-button">
            Salvar
        </button>
    </div>
</div>
