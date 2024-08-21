<?php
namespace App\Livewire\Admin\Form;

use App\Models\Raffle;
use App\Http\Requests\Form\GeneralInfoRequest;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class GeneralInfo extends Component
{
    use WithFileUploads;

    public string $tenant_id;

    public $raffleCode;
    public $name;
    public $description;
    public $main_photo;
    public $draw_date;
    public $show_draw_date;

    public function render()
    {
        return view('livewire.admin.form.general-info');
    }

    public function mount()
    {
        $this->tenant_id = getTenantId();
        $this->show_draw_date = true;
    }

    public function save(Request $request)
    {
        tenancyFn($this->tenant_id);

        $raffle = Raffle::create([
            'name' => $this->name,
            'description' => $this->description,
            'winner' => 'null',
            'draw_date' => $this->draw_date,
            'show_draw_date' => $this->show_draw_date,
            'request_email_in_purchase' => 0,
            'auto_number_selection' => 0,
            'max_auto_numbers' => 500,
            'disable_manual_number_selection' => 0,
            'show_remaining_numbers' => 0,
            'price_per_number' => 1,
            'show_price_on_homepage' => 0,
            'pending_reservation_limit_value' => 15,
            'pending_reservation_limit_time' => 'minutes',
            'min_number_purchase' => 1,
            'max_number_purchase' => 2,
            'total_numbers' => 50,
            'number_range_from' => 1,
            'number_range_to' => 100,
            'main_photo' => 'null',
            'sorted' => 0,
        ]);
    }
}
