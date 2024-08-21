<div>
    <!-- Heading or Trigger Removed -->

    <!-- Content Previously in the Modal Now Directly on the Page -->
    <div class="mt-5 grid grid-cols-12 gap-1">

        <div class="page-instructions col-span-12">Adicione números premiados a sua Rifa</div>
        <div class="page-instructions col-span-12">Os números ficarão reservados e só serão liberados para a compra
            mediante sua
            liberação manual</div>
        <div class="page-instructions col-span-12">
            Os números premiados fazem a escolha de números da sua rifa ser aleatória por padrão
        </div>
        <form wire:submit="saveChanges" class="col-span-12">
            @for ($i = 1; $i <= 30; $i++)
                <div class="grid grid-cols-12 gap-4 my-4">
                    <div class="input-container col-span-12 md:col-span-3 mt-8 md:mt-0">
                        <label for="Número Premiado  {{ $i }}"> Número Premiado {{ $i }}</label>
                        <input type="text" wire:model="premier_number_{{ $i }}"
                            placeholder="Número Premiado{{ $i }}"
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                        <!-- Display error message if it exists for this input -->
                        @if (isset($errors['premier_number_' . $i]))
                            <div class="text-red-500 text-sm mt-1">
                                {{ $errors['premier_number_' . $i] }}
                            </div>
                        @endif
                    </div>
                    {{-- input prêmio  --}}
                    <div class="input-container col-span-12 md:col-span-4">
                        <label for="premier_number_award_{{ $i }}"> Prêmio {{ $i }}</label>
                        <input type="text" wire:model="premier_number_award_{{ $i }}"
                            placeholder="Prêmio {{ $i }}"
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="input-container col-span-12 md:col-span-2">
                        <div class="flex items-center h-full md:pt-4">
                            <input type="checkbox" id="premier_number_enabled_{{ $i }}"
                                wire:model="premier_number_enabled_{{ $i }}" class="text-primary"
                                @if (${"premier_number_enabled_$i"}) checked @endif>
                            <label for="premier_number_enabled_{{ $i }}" class="pl-2">Liberar
                                número</label>
                        </div>
                    </div>



                    <div class=" input-container col-span-12 md:col-span-3">
                        <label for="premier_number_enable_date_{{ $i }}">Data da Liberação</label>
                        <input type="date" id="premier_number_enable_date_{{ $i }}"
                            wire:model="premier_number_enable_date_{{ $i }}" class="text-dark-grey">
                    </div>

                </div>
            @endfor
            <div class="col-span-12 mt-6">
                <div class="flex items-center">
                    <input type="checkbox" class="text-primary" wire:model="show_premier_awards"
                        @if ($show_premier_awards) checked @endif>
                    <label class="pl-2">Mostrar Premiação dos Números na Rifa</label>
                </div>
            </div>
            <div class="col-span-12 mt-6">
                <div class="flex items-center">
                    <input type="checkbox" class="text-primary" wire:model="show_winner_premier_awards"
                        @if ($show_winner_premier_awards) checked @endif>
                    <label class="pl-2">Mostrar Ganhador do Número Premiado na Rifa</label>
                </div>
            </div>
            <div class="col-span-12 mt-6 flex justify-end">
                <button type="submit" class="primary-button">Salvar números</button>
            </div>
        </form>

    </div>
</div>
