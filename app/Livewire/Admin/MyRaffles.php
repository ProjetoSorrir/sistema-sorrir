<?php

namespace App\Livewire\Admin;

use App\Models\Raffle;
use Carbon\Carbon;
use Livewire\Component;

class MyRaffles extends Component
{
    //public $raffles = [];
    public string $tenant_id;

    public $search = '';

    public function mount()
    {
        $this->tenant_id = getTenantId();
        tenancyFn($this->tenant_id);
        //$this->raffles = Raffle::get();
    }

    public function daysToDraw($raffle)
    {
        return Carbon::parse($raffle->draw_date)->diffInDays(Carbon::now());
    }

    public function awaitingPublication($raffle) {

    }

    public function render()
    {
        tenancyFn($this->tenant_id);
        return view('livewire.admin.my-raffles', [
            'raffles' => Raffle::search($this->search)->orderBy('id', 'desc')->paginate(10)
        ]);
    }
}
