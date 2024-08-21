<?php

namespace App\Livewire;

use Livewire\Component;

class TabsComponent extends Component
{
    public $tabNames;
    public $tabFields;

    public function mount($tabNames, $tabFields)
    {
        $this->tabNames = $tabNames;
        $this->tabFields = $tabFields;
    }

    public function render()
    {
        return view('livewire.tabs-component');
    }
}
