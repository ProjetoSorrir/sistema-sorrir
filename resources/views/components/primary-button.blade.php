<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-[#f04e23] hover:bg-[#f04e23]/80 border-b-[5px] border-black/20 rounded-lg text-white font-semibold text-sm px-20 py-3']) }}>
    {{ $slot }}
</button>
