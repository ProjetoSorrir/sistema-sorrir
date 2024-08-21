<?php
namespace App\Livewire\Admin\Form;

use App\Models\Raffle;
use App\Http\Requests\Form\AwardRequest;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class Award extends Component
{
    use WithFileUploads;

    public string $tenant_id;

    public $winner;
    public $first_prize;
    public $second_prize;
    public $third_prize;

    public function render()
    {
        return view('livewire.admin.form.award');
    }

    public function mount()
    {
        $this->tenant_id = getTenantId();
    }

    public function save(Request $request)
    {
        tenancyFn($this->tenant_id);

        $lastRaffle = Raffle::latest()->first();
        $lastRaffle->winner = $this->winner ? $this->winner : $lastRaffle->winner;
        $lastRaffle->first_prize = $this->first_prize ? $this->first_prize : $lastRaffle->first_prize;
        $lastRaffle->second_prize = $this->second_prize ? $this->second_prize : $lastRaffle->second_prize;
        $lastRaffle->third_prize = $this->third_prize ? $this->third_prize : $lastRaffle->third_prize;
        $lastRaffle->save();
    }
}
