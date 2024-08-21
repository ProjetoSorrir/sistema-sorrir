<?php

namespace App\Livewire\Site;

use Livewire\Component;

class RafflePremierWin extends Component
{

    public string $tenant_id;
    public $number;

    public function mount($id)
    {
        $this->number = $id;
        $this->tenant_id = getTenantId();
        tenancyFn(getTenantId());
    }

    public function render()
    {
        return view('livewire.site.raffle-premier-win');
    }
}
