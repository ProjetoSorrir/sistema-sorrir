<div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-4">
            <div class="input-container">
                <label for="first_number">1º Número</label>
                <input wire:model="first_number" type="text" id="first_number" placeholder="00">
            </div>
        </div>

        <div class="col-span-4">
            <div class="input-container">
                <label for="second_number">2º Número</label>
                <input wire:model="second_number" type="text" id="second_number" placeholder="00">
            </div>
        </div>

        <div class="col-span-4">
            <div class="input-container">
                <label for="third_number">3º Número</label>
                <input wire:model="third_number" type="text" id="third_number" placeholder="00">
            </div>
        </div>

        <div class="col-span-4">
            <div class="input-container">
                <label for="fourth_number">4º Número</label>
                <input wire:model="fourth_number" type="text" id="fourth_number" placeholder="00">
            </div>
        </div>

        <div class="col-span-4">
            <div class="input-container">
                <label for="fifth_number">5º Número</label>
                <input wire:model="fifth_number" type="text" id="fifth_number" placeholder="00">
            </div>
        </div>

        <div class="col-span-4">
            <div class="input-container">
                <label for="sixth_number">6º Número</label>
                <input wire:model="sixth_number" type="text" id="sixth_number" placeholder="00">
            </div>
        </div>

        <div class="col-span-4">
            <div class="input-container">
                <label for="seventh_number">7º Número</label>
                <input wire:model="seventh_number" type="text" id="seventh_number" placeholder="00">
            </div>
        </div>

        <div class="col-span-4">
            <div class="input-container">
                <label for="eighth_number">8º Número</label>
                <input wire:model="eighth_number" type="text" id="eighth_number" placeholder="00">
            </div>
        </div>

        <div class="col-span-4">
            <div class="input-container">
                <label for="ninth_number">9º Número</label>
                <input wire:model="ninth_number" type="text" id="ninth_number" placeholder="00">
            </div>
        </div>

        <div class="col-span-12 flex justify-end">
            <button wire:click="save" class="primary-button">
                Publicar
            </button>
        </div>
    </div>
</div>
