<?php

namespace App\Livewire\Admin\Form;

use App\Models\Raffle;
use Livewire\Component;

class RaffleForm extends Component
{
    public $name, $description, $min_number_purchase, $max_number_purchase, $total_numbers, $main_photo;
    public string $tenant_id;

    public function mount()
    {
        $this->tenant_id = getTenantId();
    }

    public function submitRaffleForm()
    {
        tenancyFn($this->tenant_id);

        $data = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'min_number_purchase' => 'required|integer',
            'max_number_purchase' => 'required|integer',
            'total_numbers' => 'required|integer'
        ]);

        Raffle::create($data);

        session()->flash('message', 'Raffle successfully created.');
        $this->reset();
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.admin.form.raffle-form');
    }
}
