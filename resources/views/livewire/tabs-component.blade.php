<div x-data="{ activeTab: 'tab1' }">
    <div class="flex w-full">
        @foreach ($tabNames as $index => $tabName)
            <div 
                @click="activeTab = 'tab{{ $index + 1 }}'" 
                class="tracking-wide text-base cursor-pointer py-2 px-6"
                :class="{ 
                    'text-dark-grey': activeTab !== 'tab{{ $index + 1 }}',
                    'font-bold text-primary border-b border-primary': activeTab === 'tab{{ $index + 1 }}',
                }"
            >
                {{ $tabName }}
            </div>
        @endforeach
    </div>

    @foreach ($tabFields as $index => $tabs)
        <div x-show="activeTab === 'tab{{ $index + 1 }}'" class="mt-5 grid grid-cols-12 gap-4">
            @foreach ($tabs as $fields)
                @if (isset($fields['component']))
                    <div class="col-span-12">
                        @livewire($fields['component'])
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach
</div>
