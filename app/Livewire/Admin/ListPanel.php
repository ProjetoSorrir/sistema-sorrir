<?php

namespace App\Livewire\Admin;

use App\Models\Slides;
use Livewire\Component;

use function Laravel\Prompts\confirm;

class ListPanel extends Component
{
    public string $tenant_id;
    public $slides;

    public function mount()
    {
        $this->tenant_id = getTenantId();
        tenancyFn($this->tenant_id);
        //$slideGet = Slides::get();
        $this->slides = Slides::orderBy('order')->get();
    }

    public function render()
    {
        return view('livewire.admin.list-panel');
    }
}
