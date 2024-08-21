<?php
namespace App\Livewire\Admin\Form;

use App\Models\Raffle;
use App\Http\Requests\Form\SaleRequest;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class Sale extends Component
{
    use WithFileUploads;

    public string $tenant_id;

    public $price_per_number;
    public $show_price_on_homepage;
    public $request_email_in_purchase;
    public $auto_buy_option_one;
    public $auto_buy_option_two;
    public $disable_manual_number_selection;
    public $sales_goal_percentage;
    public $pending_reservation_limit_value;
    public $min_number_purchase;
    public $max_number_purchase;

    public function render()
    {
        return view('livewire.admin.form.sale');
    }

    public function mount()
    {
        $this->tenant_id = getTenantId();
    }

    public function save(Request $request)
    {
        tenancyFn($this->tenant_id);

        $lastRaffle = Raffle::latest()->first();
        $lastRaffle->price_per_number = $this->price_per_number ? $this->price_per_number : $lastRaffle->price_per_number;
        $lastRaffle->show_price_on_homepage = $this->show_price_on_homepage ? $this->show_price_on_homepage : $lastRaffle->show_price_on_homepage;
        $lastRaffle->request_email_in_purchase = $this->request_email_in_purchase ? $this->request_email_in_purchase : $lastRaffle->request_email_in_purchase;
        $lastRaffle->auto_buy_option_one = $this->auto_buy_option_one ? $this->auto_buy_option_one : $lastRaffle->auto_buy_option_one;
        $lastRaffle->auto_buy_option_two = $this->auto_buy_option_two ? $this->auto_buy_option_two : $lastRaffle->auto_buy_option_two;
        $lastRaffle->disable_manual_number_selection = $this->disable_manual_number_selection ? $this->disable_manual_number_selection : $lastRaffle->disable_manual_number_selection;
        $lastRaffle->sales_goal_percentage = $this->sales_goal_percentage ? $this->sales_goal_percentage : $lastRaffle->sales_goal_percentage;
        $lastRaffle->pending_reservation_limit_value = $this->pending_reservation_limit_value ? $this->pending_reservation_limit_value : $lastRaffle->pending_reservation_limit_value;
        $lastRaffle->min_number_purchase = $this->min_number_purchase ? $this->min_number_purchase : $lastRaffle->min_number_purchase;
        $lastRaffle->max_number_purchase = $this->max_number_purchase ? $this->max_number_purchase : $lastRaffle->max_number_purchase;
        $lastRaffle->save();

        //session()->flash('message', 'Rifa criada com sucesso!');
        //$this->reset();
        //return redirect()->route('my_raffles');

        //$validatedData = $request->validated();
        //$raffleService->createRaffle($validatedData);
        //$this->reset();
    }
}
