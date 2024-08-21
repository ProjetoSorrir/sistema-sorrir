<div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-4">
            <div class="input-container">
                <label for="amount_tickets">Quantidade de Bilhetes</label>
                <input wire:model="amount_tickets" type="text" id="amount_tickets" placeholder="00">
            </div>
        </div>

        <div class="col-span-4">
            <div class="input-container">
                <label for="ticket_value">Valor</label>
                <input wire:model="ticket_value" type="text" id="ticket_value" placeholder="R$ 00,00">
            </div>
        </div>
        <div class="flex w-fit items-end justify-end">
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
        <div class="col-span-4">
            <div class="input-container">
                <label for="ticket_value">Valor Promocional </label>
                <input wire:model="ticket_value" type="text" id="ticket_value" placeholder="R$ 00,00">
            </div>
        </div>

        <div class="col-span-9 flex justify-end">
            <button wire:click="save" class="primary-button">
                Salvar
            </button>
        </div>
    </div>
</div>
