<?php

namespace App\Livewire\Admin\Raffle;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Raffle;
use Carbon\Carbon;
use App\Services\BigNumbersService;


class CreateNewRaffle extends Component
{
    use WithFileUploads;

    public $activeTab = 'tab1';
    public $totalTabs = 5;

    // General Information (Informações Gerais)
    public $name; //mandatory
    public $susep_process;
    public $serie_size;
    public $description; //mandatory
    public $main_photo;
    public $draw_date;
    public $draw_hour;
    public $publication_date;
    public $publication_hour;

    // Prizes (Premiação)
    public $first_prize; //mandatory
    public $second_prize;
    public $third_prize;
    public $fourth_prize;
    public $fifth_prize;
    public $sixth_prize;
    public $seventh_prize;
    public $eighth_prize;
    public $ninth_prize;
    public $add_top_3_buyers;
    public $first_top_buyer_prize; //mandatory if add_top_3_buyers is true
    public $second_top_buyer_prize; //mandatory if add_top_3_buyers is true
    public $third_top_buyer_prize; //mandatory if add_top_3_buyers is true
    public $show_top_3_in_draw_page;

    // Sales (Venda)
    public $quantity_personalized_tickets; //if personalized tickets are 00000
    public $price_per_number; //mandatory
    public $pending_reservation_limit_value; //mandatory 30 minuts
    public $min_number_purchase; //mandatory (min 1)
    public $max_number_purchase; //mandatory (max quantity of tickets)
    public $auto_buy_option_one; //mandatory if auto_number_selection is true
    public $auto_buy_option_two; //mandatory if auto_number_selection is true
    public $auto_buy_option_three; //mandatory if auto_number_selection is true
    public $auto_buy_option_four; //mandatory if auto_number_selection is true
    public $auto_buy_option_five; //mandatory if auto_number_selection is true
    public $auto_buy_option_six; //mandatory if auto_number_selection is true
    public $auto_buy_highlight;

    // Define properties for the winner numbers
    public $quantity_premier_numbers;
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

    public function mount()
    {
        $storagePath = storage_path('framework/cache');
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0777, true);
        }
    }

    public function save()
    {
        $this->validate([
            //general Information
            'name' => 'required|max:255',
            'description' => 'required|max:3000',
            'susep_process' => 'required',
            'serie_size' => 'required',
            'main_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:150000', // 50MB em kilobytes (KB)
            'draw_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (strtotime($value) < strtotime('today')) {
                        $fail('A data do sorteio deve ser no futuro.');
                    }
                },
            ],
            'draw_hour' => 'required',
            'publication_date' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) {
                    if (strtotime($value) < strtotime('today')) {
                        $fail('A data de publicação deve ser no futuro.');
                    }
                },
            ],
            'publication_hour' => 'nullable',
            //prizes
            'first_prize' => 'required',
            'second_prize' => 'nullable',
            'third_prize' => 'nullable',
            'fourth_prize' => 'nullable',
            'fifth_prize' => 'nullable',
            'sixth_prize' => 'nullable',
            'seventh_prize' => 'nullable',
            'eighth_prize' => 'nullable',
            'ninth_prize' => 'nullable',
            'add_top_3_buyers' => 'nullable',
            'show_top_3_in_draw_page' => 'nullable',
            'first_top_buyer_prize' => [
                'nullable',
                'required_if:show_top_3_in_draw_page,==,true'
            ],
            'second_top_buyer_prize' => [
                'nullable',
                'required_if:show_top_3_in_draw_page,==,true'
            ],
            'third_top_buyer_prize' => [
                'nullable',
                'required_if:show_top_3_in_draw_page,==,true'
            ],
            //sales
            'quantity_personalized_tickets' => [
                'required',
                'numeric',
                'min:1',
                'max:100000000', // 'CEM MILHÕES
                function ($attribute, $value, $fail) {
                    // Remover vírgulas ou pontos e converter para inteiro
                    $cleanedValue = (int)str_replace([',', '.'], '', $value);
                    if ($cleanedValue != $value) {
                        // Se houver vírgulas ou pontos, exibir uma mensagem de erro
                        $fail('O campo quantidade total de títulos não pode conter vírgulas ou pontos.');
                    }
                },
            ],
            'price_per_number' => 'required',
            'min_number_purchase' => [
                'required',
                'numeric',
                'min:1',
                function ($attribute, $value, $fail) {
                    // Remover vírgulas ou pontos e converter para inteiro
                    $cleanedValue = (int)str_replace([',', '.'], '', $value);
                    if ($cleanedValue != $value) {
                        // Se houver vírgulas ou pontos, exibir uma mensagem de erro
                        $fail('O campo compra mínima não pode conter vírgulas ou pontos.');
                    } elseif ($cleanedValue > $this->quantity_personalized_tickets) {
                        $fail('O campo compra mínima não pode ser maior que a quantidade total de títulos.');
                    }
                },
            ],
            'max_number_purchase' => [
                'required',
                'numeric',
                'min:1',
                'max:20000', // 'VINTE MIL 😎
                function ($attribute, $value, $fail) {
                    // Remover vírgulas ou pontos e converter para inteiro
                    $cleanedValue = (int)str_replace([',', '.'], '', $value);
                    if ($cleanedValue != $value) {
                        // Se houver vírgulas ou pontos, exibir uma mensagem de erro
                        $fail('O campo compra máxima não pode conter vírgulas ou pontos.');
                    } elseif ($cleanedValue > $this->quantity_personalized_tickets) {
                        $fail('O campo compra máxima não pode ser maior que a quantidade total de títulos.');
                    } elseif ($cleanedValue < $this->min_number_purchase) {
                        $fail('O campo compra máxima não pode ser menor que a compra mínima.');
                    }
                },
            ],
            'auto_buy_option_one' => 'required',
            'auto_buy_option_two' => 'required',
            'auto_buy_option_three' => 'required',
            'auto_buy_option_four' => 'required',
            'auto_buy_option_five' => 'required',
            'auto_buy_option_six' => 'required',
            'auto_buy_highlight' => 'required',
            'quantity_premier_numbers' => 'nullable',
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O campo nome não pode ter mais de 255 caracteres.',
            'description.required' => 'O campo descrição é obrigatório.',
            'description.max' => 'O campo descrição não pode ter mais de 3000 caracteres.',
            'susep_process.required' => 'O campo número do processo SUSEP é obrigatório.',
            'serie_size.required' => 'O campo número da série é obrigatório.',
            'main_photo.image' => 'O arquivo deve ser uma imagem.',
            'main_photo.mimes' => 'O arquivo deve ser do tipo: jpg, jpeg, png, gif.',
            'main_photo.max' => 'O arquivo não pode ter mais de 150MB.',
            'draw_date.required' => 'O campo data do sorteio é obrigatório.',
            'draw_date.date' => 'O campo data do sorteio deve ser uma data válida.',
            'draw_date.function' => 'A data do sorteio deve ser no futuro.',
            'draw_hour.required' => 'O campo hora do sorteio é obrigatório.',
            'first_prize.required' => 'O campo primeiro prêmio é obrigatório.',
            'first_top_buyer_prize.required_if' => 'O campo prêmio do primeiro top comprador é obrigatório.',
            'second_top_buyer_prize.required_if' => 'O campo prêmio do segundo top comprador é obrigatório.',
            'third_top_buyer_prize.required_if' => 'O campo prêmio do terceiro top comprador é obrigatório.',
            'quantity_personalized_tickets.required' => 'O campo quantidade total de títulos é obrigatório.',
            'quantity_personalized_tickets.numeric' => 'O campo quantidade total de títulos deve ser um número.',
            'quantity_personalized_tickets.min' => 'O campo quantidade total de títulos deve ser no mínimo 1.',
            'quantity_personalized_tickets.max' => 'O campo quantidade de títulos não pode ser maior que 100.000.000.',
            'price_per_number.required' => 'O campo valor por título é obrigatório.',
            'pending_reservation_limit_value.required' => 'O campo limite de tempo para reservas pendentes é obrigatório.',
            'min_number_purchase.required' => 'O campo compra mínima é obrigatório.',
            'min_number_purchase.numeric' => 'O campo compra mínima deve ser um número.',
            'min_number_purchase.min' => 'O campo compra mínima deve ser no mínimo 1.',
            'min_number_purchase.function' => 'O campo compra mínima não pode ser maior que a quantidade total títulos.',
            'max_number_purchase.required' => 'O campo compra máxima é obrigatório.',
            'max_number_purchase.numeric' => 'O campo compra máxima deve ser um número.',
            'max_number_purchase.min' => 'O campo compra máxima deve ser no mínimo 1.',
            'max_number_purchase.max' => 'O campo compra máxima não pode ser maior que 20.000 títulos.',
            'max_number_purchase.function' => 'O campo compra máxima não pode ser maior que a quantidade total títulos.',
            'max_number_purchase.function' => 'O campo compra máxima não pode ser menor que a compra mínima.',
            'max_number_purchase.function' => 'O campo compra máxima não pode ser maior que 20.000 títulos.',
            'auto_buy_option_one.required' => 'O campo opção de compra automática 1 é obrigatório.',
            'auto_buy_option_two.required' => 'O campo opção de compra automática 2 é obrigatório.',
            'auto_buy_option_three.required' => 'O campo opção de compra automática 3 é obrigatório.',
            'auto_buy_option_four.required' => 'O campo opção de compra automática 4 é obrigatório.',
            'auto_buy_option_five.required' => 'O campo opção de compra automática 5 é obrigatório.',
            'auto_buy_option_six.required' => 'O campo opção de compra automática 6 é obrigatório.',
            'auto_buy_highlight.required' => 'O campo destaque da compra automática é obrigatório.',
        ]);

        if ($this->main_photo) {
            $this->main_photo = $this->main_photo->store('raffles', 'public');
        }

        if ($this->publication_date == null) {
            $this->publication_date = Carbon::now()->subHours(3);
            $this->publication_hour = Carbon::now()->subHours(3)->format('H:i');
        }

        $raffle = Raffle::create([
            //General information
            'name' => $this->name,
            'description' => $this->description,
            'susep_process' => $this->susep_process,
            'serie_size' => $this->serie_size,
            'main_photo' => $this->main_photo,
            'draw_date' => $this->draw_date,
            'draw_hour' => $this->draw_hour,
            'show_draw_date' => true,
            'draw_location' => 'loteria_federal',
            'publication_date' => $this->publication_date,
            'publication_hour' => $this->publication_hour,
            //Prizes
            'winner' => $this->first_prize,
            'second_prize' => $this->second_prize,
            'third_prize' => $this->third_prize,
            'fourth_prize' => $this->fourth_prize,
            'fifth_prize' => $this->fifth_prize,
            'sixth_prize' => $this->sixth_prize,
            'seventh_prize' => $this->seventh_prize,
            'eighth_prize' => $this->eighth_prize,
            'ninth_prize' => $this->ninth_prize,
            'add_top_3_buyers' => $this->add_top_3_buyers,
            'first_top_buyer_prize' => $this->first_top_buyer_prize,
            'second_top_buyer_prize' => $this->second_top_buyer_prize,
            'third_top_buyer_prize' => $this->third_top_buyer_prize,
            'show_top_3_in_draw_page' => $this->show_top_3_in_draw_page,
            //Sales
            'total_numbers' => 0,
            'quantity_personalized_tickets' => (int)str_replace([',', '.'], '', $this->quantity_personalized_tickets),
            'price_per_number' => floatval(str_replace(',', '.', $this->price_per_number)),
            'show_price_on_homepage' => true,
            'show_sales_percentage_bar' => false,
            'pending_reservation_limit_value' => 30,
            'min_number_purchase' => (int)str_replace([',', '.'], '', $this->min_number_purchase),
            'max_number_purchase' => (int)str_replace([',', '.'], '', $this->max_number_purchase),
            'disable_auto_payment_completion' => false,
            'disable_manual_number_selection' => true,
            'show_numbers_on_payment' => true,
            'auto_number_selection' => true,
            'auto_buy_highlight' => $this->auto_buy_highlight,
            'auto_buy_option_one' => $this->auto_buy_option_one,
            'auto_buy_option_two' => $this->auto_buy_option_two,
            'auto_buy_option_three' => $this->auto_buy_option_three,
            'auto_buy_option_four' => $this->auto_buy_option_four,
            'auto_buy_option_five' => $this->auto_buy_option_five,
            'auto_buy_option_six' => $this->auto_buy_option_six,
            'quantity_premier_numbers' => $this->quantity_premier_numbers,
            //status
            'status' => 'ativa',
            //default values
            'request_email_in_purchase' => '1',
            'max_auto_numbers' => 200,
            //'disable_manual_number_selection' => '0',
            'show_remaining_numbers' => '1',
            'pending_reservation_limit_time' => '15',
            'number_range_from' => '1',
            'number_range_to' => '200',
        ]);

        // Geração e atualização dos números premiados
        if ($this->quantity_premier_numbers) {
            $bignumberService = new BigNumbersService();
            $numbers = $bignumberService->getRandomNumbers($this->quantity_personalized_tickets, [], $this->quantity_premier_numbers);

            $premierNumbers = array_map(function($number) {
                return $number - 1;
            }, $numbers['generated_tickets']);
            for ($i = 1; $i <= $this->quantity_premier_numbers; $i++) {
                $raffle->{"premier_number_" . $i} = $premierNumbers[$i - 1];
                $raffle->{"premier_number_enabled_" . $i} = true;
            }

            $raffle->save();
        }

        return redirect()->route('my_raffles')->with('success', 'Ação "' . $this->name . '" criada com sucesso.');
    }

    public function removeMainPhoto()
    {
        $this->main_photo = null;
    }

    public function setActiveTab($tabName)
    {
        $this->activeTab = $tabName;
    }

    public function incrementTab()
    {
        $currentTabNumber = (int) str_replace('tab', '', $this->activeTab);
        $nextTabNumber = ($currentTabNumber % $this->totalTabs) + 1;
        $this->activeTab = 'tab' . $nextTabNumber;
    }

    public function decrementTab()
    {
        $currentTabNumber = (int) str_replace('tab', '', $this->activeTab);
        $nextTabNumber = $currentTabNumber - 1;

        if ($nextTabNumber < 1) {
            $nextTabNumber = $this->totalTabs;
        }

        $this->activeTab = 'tab' . $nextTabNumber;
    }

    public function render()
    {
        return view('livewire.admin.raffle.create-new-raffle');
    }
}
