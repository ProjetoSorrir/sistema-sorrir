<?php

namespace App\Livewire\Admin\Raffle;

use App\Models\Raffle;
use Livewire\Component;
use Livewire\WithFileUploads;


class Create extends Component
{
    use WithFileUploads;

    public string $tenant_id;

    public $name;
    public $description;
    public $winner;
    public $first_prize;
    public $second_prize;
    public $third_prize;
    public $draw_date;
    public $show_draw_date;
    public $request_email_in_purchase;
    public $auto_number_selection;
    public $disable_manual_number_selection;
    public $show_remaining_numbers;
    public $price_per_number;
    public $show_price_on_homepage;
    public $promotion_values = [];
    public $promotion_numbers = [];
    public $sales_goal_percentage;
    public $pending_reservation_limit_value;
    public $pending_reservation_limit_time;
    public $min_number_purchase;
    public $max_number_purchase;
    public $number_range_from;
    public $number_range_to;
    public $show_top_3_in_draw_page;
    public $total_numbers;
    public $main_photo;
    public $auto_buy_option_one;
    public $auto_buy_option_two;
    public $auto_buy_option_three;

    public $video;
    public $state;
    public $city;
    public $reference_code;
    public $bonus_link;
    public $winner_number_1;
    public $winner_number_2;
    public $winner_number_3;
    public $winner_number_4;
    public $winner_number_5;
    public $winner_number_6;
    public $winner_number_7;


    public function mount()
    {
        $this->tenant_id = getTenantId();
        $this->pending_reservation_limit_value = 15; // Default value
        $this->pending_reservation_limit_time = 'minutes'; // Default value
        $this->show_draw_date = true;
        $this->request_email_in_purchase = true;
        $this->auto_number_selection = true;
        $this->disable_manual_number_selection = true;
        $this->show_remaining_numbers = true;
        $this->show_price_on_homepage = true;
        $this->show_top_3_in_draw_page = true;
    }

    public function submit()
    {
        tenancyFn($this->tenant_id);

        $data = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'winner' => 'required|string|max:255',
            'first_prize' => 'nullable|string|max:255',
            'second_prize' => 'nullable|string|max:255',
            'third_prize' => 'nullable|string|max:255',
            'draw_date' => 'required|date',
            'show_draw_date' => 'required|boolean',
            'request_email_in_purchase' => 'nullable|boolean',
            'auto_number_selection' => 'nullable|boolean',
            'disable_manual_number_selection' => 'nullable|boolean',
            'show_remaining_numbers' => 'nullable|boolean',
            'price_per_number' => 'required|numeric',
            'show_price_on_homepage' => 'nullable|boolean',
            // Assuming promotion_values and promotion_numbers are arrays
            'promotion_values.*' => 'nullable|numeric',
            'promotion_numbers.*' => 'nullable|integer',
            'sales_goal_percentage' => 'required|numeric',
            'pending_reservation_limit_value' => 'required|integer',
            'pending_reservation_limit_time' => 'required|string',
            'min_number_purchase' => 'required|integer',
            'max_number_purchase' => 'required|integer',
            'number_range_from' => 'required|integer',
            'number_range_to' => 'required|integer',
            'show_top_3_in_draw_page' => 'nullable|boolean',
            'total_numbers' => 'required|integer',
            'main_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:262144', // 256 MB in kilobytes
            'auto_buy_option_one' => 'required|integer',
            'auto_buy_option_two' => 'required|integer',
            'auto_buy_option_three' => 'required|integer',
            //
            'video' => 'nullable|string',
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'reference_code' => 'nullable|string|max:255',
            'bonus_link' => 'nullable|string|max:255',
            'winner_number_1' => 'nullable|string|max:255',
            'winner_number_2' => 'nullable|string|max:255',
            'winner_number_3' => 'nullable|string|max:255',
            'winner_number_4' => 'nullable|string|max:255',
            'winner_number_5' => 'nullable|string|max:255',
            'winner_number_6' => 'nullable|string|max:255',
            'winner_number_7' => 'nullable|string|max:255'
        ]);

        if ($this->main_photo) {
            // Store the image and save the path to the model or do something else with the file
            $path = $this->main_photo->store('imgs', 'public');
            $data['main_photo'] = $path;
        }

        $data['max_auto_numbers'] = 500;
        Raffle::create($data);

        session()->flash('message', 'Raffle successfully created.');
        $this->reset();
        return redirect()->route('my_raffles');
    }


    public function render()
    {
        return view('livewire.admin.raffle.create');
    }
}
