<?php
namespace App\Livewire\Admin\Form;

use App\Models\Raffle;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class Winner extends Component
{
    use WithFileUploads;

    public string $tenant_id;

    public $first_number;
    public $second_number;
    public $third_number;
    public $fourth_number;
    public $fifth_number;
    public $sixth_number;
    public $seventh_number;
    public $eighth_number;
    public $ninth_number;

    public function render()
    {
        return view('livewire.admin.form.winner');
    }

    public function mount()
    {
        $this->tenant_id = getTenantId();
    }

    public function save(Request $request)
    {
        session()->flash('message', 'Rifa criada com sucesso!');
        $this->reset();
        return redirect()->route('my_raffles');

        //$validatedData = $request->validated();
        //$raffleService->createRaffle($validatedData);
        //$this->reset();
    }
}
