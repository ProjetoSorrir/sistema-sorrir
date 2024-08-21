<?php

namespace App\Livewire\Admin\Raffle;

use App\Models\Raffle;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RaffleWinnerNumbers extends Component
{

    public $raffleId;
    public string $tenant_id;

    // Define properties for the winner numbers
    public $winner_number_1, $winner_number_2, $winner_number_3, $winner_number_4, $winner_number_5, $winner_number_6, $winner_number_7 = '';
    public $sorted;

    public function mount($raffleId)
    {
        $this->tenant_id = getTenantId();
        tenancyFn($this->tenant_id);
        $this->raffleId = $raffleId;
        $raffle = Raffle::find($raffleId);
        $this->winner_number_1 = $raffle->winner_number_1;
        $this->winner_number_2 = $raffle->winner_number_2;
        $this->winner_number_3 = $raffle->winner_number_3;
        $this->winner_number_4 = $raffle->winner_number_4;
        $this->winner_number_5 = $raffle->winner_number_5;
        $this->winner_number_6 = $raffle->winner_number_6;
        $this->winner_number_7 = $raffle->winner_number_7;
        $this->sorted = $raffle->sorted;
    }

    public function saveChanges()
    {
        tenancyFn($this->tenant_id);
        $raffle = Raffle::find($this->raffleId);

        $this->validate([
            'winner_number_1' => 'nullable|numeric',
            'winner_number_2' => 'nullable|numeric',
            'winner_number_3' => 'nullable|numeric',
            'winner_number_4' => 'nullable|numeric',
            'winner_number_5' => 'nullable|numeric',
            'winner_number_6' => 'nullable|numeric',
            'winner_number_7' => 'nullable|numeric',
        ]);

        DB::beginTransaction();
        try {
            $raffle->update([
                'winner_number_1' => $this->winner_number_1,
                'winner_number_2' => $this->winner_number_2,
                'winner_number_3' => $this->winner_number_3,
                'winner_number_4' => $this->winner_number_4,
                'winner_number_5' => $this->winner_number_5,
                'winner_number_6' => $this->winner_number_6,
                'winner_number_7' => $this->winner_number_7,
                'sorted' => true
            ]);

            DB::commit();

            // Optionally, display a success message or redirect
            session()->flash('message', 'Raffle winner numbers updated successfully.');
            // or $this->redirect('/some-route');
        } catch (\Exception $e) {
            DB::rollBack();
            // Handle the error, e.g., log it and show an error message
            session()->flash('error', 'An error occurred while updating the raffle.');
        }
    }

    public function render()
    {
        return view('livewire.admin.raffle.raffle-winner-numbers');
    }
}
