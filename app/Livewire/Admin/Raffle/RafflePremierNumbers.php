<?php

namespace App\Livewire\Admin\Raffle;

use App\Models\Number;
use App\Models\Raffle;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RafflePremierNumbers extends Component
{
    public $raffleId;
    public string $tenant_id;

    // Define properties for the winner numbers
    public $premier_number_1;
    public $premier_number_2;
    public $premier_number_3;
    public $premier_number_4;
    public $premier_number_5;
    public $premier_number_6;
    public $premier_number_7;
    public $premier_number_8;
    public $premier_number_9;
    public $premier_number_10;
    public $premier_number_11;
    public $premier_number_12;
    public $premier_number_13;
    public $premier_number_14;
    public $premier_number_15;
    public $premier_number_16;
    public $premier_number_17;
    public $premier_number_18;
    public $premier_number_19;
    public $premier_number_20;
    public $premier_number_21;
    public $premier_number_22;
    public $premier_number_23;
    public $premier_number_24;
    public $premier_number_25;
    public $premier_number_26;
    public $premier_number_27;
    public $premier_number_28;
    public $premier_number_29;
    public $premier_number_30;

    public $premier_number_award_1;
    public $premier_number_award_2;
    public $premier_number_award_3;
    public $premier_number_award_4;
    public $premier_number_award_5;
    public $premier_number_award_6;
    public $premier_number_award_7;
    public $premier_number_award_8;
    public $premier_number_award_9;
    public $premier_number_award_10;
    public $premier_number_award_11;
    public $premier_number_award_12;
    public $premier_number_award_13;
    public $premier_number_award_14;
    public $premier_number_award_15;
    public $premier_number_award_16;
    public $premier_number_award_17;
    public $premier_number_award_18;
    public $premier_number_award_19;
    public $premier_number_award_20;
    public $premier_number_award_21;
    public $premier_number_award_22;
    public $premier_number_award_23;
    public $premier_number_award_24;
    public $premier_number_award_25;
    public $premier_number_award_26;
    public $premier_number_award_27;
    public $premier_number_award_28;
    public $premier_number_award_29;
    public $premier_number_award_30;

    public $premier_number_enabled_1;
    public $premier_number_enabled_2;
    public $premier_number_enabled_3;
    public $premier_number_enabled_4;
    public $premier_number_enabled_5;
    public $premier_number_enabled_6;
    public $premier_number_enabled_7;
    public $premier_number_enabled_8;
    public $premier_number_enabled_9;
    public $premier_number_enabled_10;
    public $premier_number_enabled_11;
    public $premier_number_enabled_12;
    public $premier_number_enabled_13;
    public $premier_number_enabled_14;
    public $premier_number_enabled_15;
    public $premier_number_enabled_16;
    public $premier_number_enabled_17;
    public $premier_number_enabled_18;
    public $premier_number_enabled_19;
    public $premier_number_enabled_20;
    public $premier_number_enabled_21;
    public $premier_number_enabled_22;
    public $premier_number_enabled_23;
    public $premier_number_enabled_24;
    public $premier_number_enabled_25;
    public $premier_number_enabled_26;
    public $premier_number_enabled_27;
    public $premier_number_enabled_28;
    public $premier_number_enabled_29;
    public $premier_number_enabled_30;

    public $premier_number_enable_date_1;
    public $premier_number_enable_date_2;
    public $premier_number_enable_date_3;
    public $premier_number_enable_date_4;
    public $premier_number_enable_date_5;
    public $premier_number_enable_date_6;
    public $premier_number_enable_date_7;
    public $premier_number_enable_date_8;
    public $premier_number_enable_date_9;
    public $premier_number_enable_date_10;
    public $premier_number_enable_date_11;
    public $premier_number_enable_date_12;
    public $premier_number_enable_date_13;
    public $premier_number_enable_date_14;
    public $premier_number_enable_date_15;
    public $premier_number_enable_date_16;
    public $premier_number_enable_date_17;
    public $premier_number_enable_date_18;
    public $premier_number_enable_date_19;
    public $premier_number_enable_date_20;
    public $premier_number_enable_date_21;
    public $premier_number_enable_date_22;
    public $premier_number_enable_date_23;
    public $premier_number_enable_date_24;
    public $premier_number_enable_date_25;
    public $premier_number_enable_date_26;
    public $premier_number_enable_date_27;
    public $premier_number_enable_date_28;
    public $premier_number_enable_date_29;
    public $premier_number_enable_date_30;

    public $show_premier_awards;
    public $show_winner_premier_awards;

    public $errors = [];

    public function mount($raffleId)
    {
        $this->tenant_id = getTenantId();
        tenancyFn($this->tenant_id);
        $this->raffleId = $raffleId;
        $raffle = Raffle::find($raffleId);
        // Initialize premier numbers from the model
        for ($i = 1; $i <= 30; $i++) {
            $propertyName = "premier_number_$i";
            $this->$propertyName = $raffle->$propertyName ?? null;
        }

        for ($i = 1; $i <= 30; $i++) {
            $propertyName = "premier_number_award_$i";
            $this->$propertyName = $raffle->$propertyName ?? null;
        }

        for ($i = 1; $i <= 30; $i++) {
            $propertyName = "premier_number_enabled_$i";
            $this->$propertyName = $raffle->$propertyName ?? null;
        }

        for ($i = 1; $i <= 30; $i++) {
            $propertyName = "premier_number_enable_date_$i";
            $this->$propertyName = $raffle->$propertyName ?? null;
        }

        $this->show_premier_awards = $raffle->show_premier_awards;
        $this->show_winner_premier_awards = $raffle->show_winner_premier_awards;
    }

    public function saveChanges()
    {
        tenancyFn($this->tenant_id);
        $raffle = Raffle::find($this->raffleId);

        if (!$raffle) {
            session()->flash('error', 'Raffle not found.');
            return;
        }

        $this->errors = [];


        // Step 2: Retrieve the reserved numbers
        $reservedNumbers = $raffle->numbers()->whereNotNull('reserved_at')->pluck('number')->all();

        $updateData = [];
        for ($i = 1; $i <= 30; $i++) {
            $inputValue = "premier_number_$i";

            if ($raffle->$inputValue === null) {
                // Explicitly check for null values and skip them
                if (!in_array($this->$inputValue, $reservedNumbers)) {
                    $updateData["premier_number_$i"] = $this->$inputValue;
                } elseif (in_array($this->$inputValue, $reservedNumbers)) {
                    // Store an error message specific to this input
                    $this->errors["premier_number_$i"] = "Esse número '{$this->$inputValue}' já se encontra reservado em seu título, por favor escolha outro número.";
                    return;
                }
            }
        }

        if (count($this->errors) > 0) {
            return;
        }

        for ($i = 1; $i <= 30; $i++) {
            $inputValue = "premier_number_award_$i";
            // Explicitly check for null values and skip them
            //if ($raffle->$inputValue === null) {
            $updateData["premier_number_award_$i"] = $this->$inputValue;
            //}
        }

        for ($i = 1; $i <= 30; $i++) {
            $inputValue = "premier_number_enabled_$i";
            // Explicitly check for null values and skip them
            //if ($raffle->$inputValue === 0) {
            $updateData["premier_number_enabled_$i"] = $this->$inputValue;
            //}
        }

        for ($i = 1; $i <= 30; $i++) {
            $inputValue = "premier_number_enable_date_$i";
            // Explicitly check for null values and skip them
            //if ($raffle->$inputValue === null) {
                $updateData["premier_number_enable_date_$i"] = $this->$inputValue;
            //}
        }

        $updateData["show_premier_awards"] = $this->show_premier_awards;
        $updateData["show_winner_premier_awards"] = $this->show_winner_premier_awards;

        $updateData["disable_manual_number_selection"] = true;

        if (empty($updateData)) {
            session()->flash('info', 'No changes detected.');
            return;
        }
        try {
            DB::beginTransaction();

            $raffle->update($updateData);

            DB::commit();
            session()->flash('message', 'Raffle premier numbers successfully updated.');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to update raffle premier numbers: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.raffle.raffle-premier-numbers');
    }
}
