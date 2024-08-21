<div>
    <button wire:click="logout"class="menu-link" role="menuitem" tabindex="-1" id="user-menu-item-1">
        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="fill-dark-grey">
            <mask id="mask0_1245_114" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24"
                height="24">
                <rect x="24" y="24" width="24" height="24" transform="rotate(-180 24 24)" />
            </mask>
            <g mask="url(#mask0_1245_114)">
                <path
                    d="M19 3C19.55 3 20.0208 3.19583 20.4125 3.5875C20.8042 3.97917 21 4.45 21 5V19C21 19.55 20.8042 20.0208 20.4125 20.4125C20.0208 20.8042 19.55 21 19 21H12V19H19V5H12L12 3H19ZM8 7L9.375 8.45L6.825 11H15V13H6.825L9.375 15.55L8 17L3 12L8 7Z" />
            </g>
        </svg>
        {{ __('Sair') }}
    </button>
</div>
