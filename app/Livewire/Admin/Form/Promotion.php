<?php
namespace App\Livewire\Admin\Form;

use App\Models\Raffle;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class Promotion extends Component
{
    use WithFileUploads;

    public string $tenant_id;
    
    public $amount_tickets;
    public $ticket_value;

    public function render()
    {
        return view('livewire.admin.form.promotion');
    }

    public function save(Request $request)
    {
        //$validatedData = $request->validated();
        //$raffleService->createRaffle($validatedData);
        //$this->reset();
    }
}
