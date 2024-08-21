<?php

namespace App\Livewire\Admin\Raffle;

use App\Models\Raffle;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Settings;
use Carbon\Carbon;
use App\Models\BankAccount;
use Illuminate\Support\Facades\DB;
use App\Models\Number;
use Str;
use Mpdf\Mpdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $activeTab = 'tab1';
    public $totalTabs = 5;

    /// General Information (Informações Gerais)
    public $name;
    public $susep_process;
    public $serie_size;
    public $description;
    public $status;
    public $main_photo;
    public $draw_date;
    public $draw_hour;
    public $draw_location;
    public $publication_date;
    public $publication_hour;

    // Prizes (Premiação)
    public $winner;
    public $first_prize;
    public $second_prize;
    public $third_prize;
    public $fourth_prize;
    public $fifth_prize;
    public $sixth_prize;
    public $seventh_prize;
    public $eighth_prize;
    public $ninth_prize;
    public $add_top_3_buyers;
    public $first_top_buyer_prize;
    public $second_top_buyer_prize;
    public $third_top_buyer_prize;
    public $show_top_3_in_draw_page;

    // Sales (Venda)
    public $quantity_personalized_tickets;
    public $price_per_number;
    public $pending_reservation_limit_value;
    public $min_number_purchase;
    public $max_number_purchase;
    public $auto_buy_option_one;
    public $auto_buy_option_two;
    public $auto_buy_option_three;
    public $auto_buy_option_four;
    public $auto_buy_option_five;
    public $auto_buy_option_six;
    public $auto_buy_highlight;

    //Premier Numbers
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

    public $show_premier_awards;
    public $show_winner_premier_awards;

    // Drawn Numbers (Números Sorteados)
    public $winner_number_1;
    public $winner_number_2;
    public $winner_number_3;
    public $winner_number_4;
    public $winner_number_5;
    public $winner_number_6;
    public $winner_number_7;
    public $winner_number_8;
    public $winner_number_9;

    public $paidNumbers;
    public $paidNumbersArray;
    public $winners_from_premier_numbers = [];
    public $winners_from_raffle_numbers = [];
    public $disabledWinnerNumbers = [];
    public $disableWinnerPremierNumbers = [];
    public $havePremierNumbers = false;

    public $raffleId;
    public $current_photo;
    public $total_numbers_to_update;

    public function mount($raffleId)
    {
        $this->raffleId = $raffleId;

        $raffle = Raffle::find($raffleId);
        if (!$raffle) {
            session()->flash('error', 'Raffle not found.');
            return redirect()->route('admin.raffles.index');
        }

        // General Information
        $this->name = $raffle->name;
        $this->susep_process = $raffle->susep_process;
        $this->serie_size = $raffle->serie_size;
        $this->status = $raffle->status;
        $this->description = $raffle->description;
        $this->current_photo = $raffle->main_photo;
        $this->draw_date = $raffle->draw_date;
        $this->draw_hour = $raffle->draw_hour;
        $this->publication_date = $raffle->publication_date;
        $this->publication_hour = $raffle->publication_hour;

        // Prizes
        $this->winner = $raffle->winner;
        $this->first_prize = $raffle->winner;
        $this->second_prize = $raffle->second_prize;
        $this->third_prize = $raffle->third_prize;
        $this->fourth_prize = $raffle->fourth_prize;
        $this->fifth_prize = $raffle->fifth_prize;
        $this->sixth_prize = $raffle->sixth_prize;
        $this->seventh_prize = $raffle->seventh_prize;
        $this->eighth_prize = $raffle->eighth_prize;
        $this->ninth_prize = $raffle->ninth_prize;
        $this->add_top_3_buyers = $raffle->add_top_3_buyers;
        $this->first_top_buyer_prize = $raffle->first_top_buyer_prize;
        $this->second_top_buyer_prize = $raffle->second_top_buyer_prize;
        $this->third_top_buyer_prize = $raffle->third_top_buyer_prize;
        $this->show_top_3_in_draw_page = $raffle->show_top_3_in_draw_page;

        // Sales
        $this->quantity_personalized_tickets = $raffle->quantity_personalized_tickets;
        $this->total_numbers_to_update = $raffle->quantity_personalized_tickets;
        $this->price_per_number = $raffle->price_per_number;
        $this->pending_reservation_limit_value = $raffle->pending_reservation_limit_value;
        $this->min_number_purchase = $raffle->min_number_purchase;
        $this->max_number_purchase = $raffle->max_number_purchase;
        $this->auto_buy_option_one = $raffle->auto_buy_option_one;
        $this->auto_buy_option_two = $raffle->auto_buy_option_two;
        $this->auto_buy_option_three = $raffle->auto_buy_option_three;
        $this->auto_buy_option_four = $raffle->auto_buy_option_four;
        $this->auto_buy_option_five = $raffle->auto_buy_option_five;
        $this->auto_buy_option_six = $raffle->auto_buy_option_six;
        $this->auto_buy_highlight = $raffle->auto_buy_highlight;

        // Premier Numbers
        for ($i = 1; $i <= 30; $i++) {
            $this->{"premier_number_$i"} = $raffle->{"premier_number_$i"} ?? null;
            $this->{"premier_number_award_$i"} = $raffle->{"premier_number_award_$i"} ?? null;
        }

        $this->show_premier_awards = $raffle->show_premier_awards;
        $this->show_winner_premier_awards = $raffle->show_winner_premier_awards;

        $this->paidNumbers = Number::with(['invoice' => function ($query) {
            $query->select(['id', 'payed_at', 'invoice_path']);
        }])->where('raffle_id', $this->raffleId)
            ->select(['id', 'number', 'invoice_id', 'user_id'])
            ->get();

        $this->paidNumbersArray = $this->paidNumbers->filter(function ($paidNumber) {
            return $paidNumber->invoice && !is_null($paidNumber->invoice->payed_at) && !is_null($paidNumber->invoice->invoice_path);
        })->pluck('number')->toArray();

        $this->winners_from_premier_numbers = [];

        foreach (range(1, 30) as $i) {
            $propertyName = "premier_number_$i";
            $premierNumber = $raffle->$propertyName ?? null;

            if (in_array($premierNumber, $this->paidNumbersArray)) {
                $winner = $this->paidNumbers->where('number', $premierNumber)->first()->user;
                $this->winners_from_premier_numbers[$propertyName] = [
                    'email' => $winner->email,
                    'phone' => $winner->phone,
                    'name' => $winner->name
                ];
            }

            if ($this->$propertyName !== null && $this->$propertyName !== "") {
                $this->disableWinnerPremierNumbers[$i] = true;
                $this->$propertyName = formatNumberWithLeadingZeros($this->$propertyName, ($this->total_numbers_to_update - 1));
            } else {
                $this->disableWinnerPremierNumbers[$i] = false;
            }
        }

        $this->winners_from_raffle_numbers = [];

        foreach (range(1, 9) as $i) {
            $propertyName = "winner_number_$i";
            $winnerNumber = $raffle->$propertyName ?? null;

            if (in_array($winnerNumber, $this->paidNumbersArray)) {
                $winner = $this->paidNumbers->firstWhere('number', $winnerNumber)->user;
                $this->winners_from_raffle_numbers[$propertyName] = [
                    'email' => $winner->email,
                    'phone' => $winner->phone,
                    'name' => $winner->name,
                ];
            }
        }

        // Verificar se os inputs devem ser desabilitados com base nos números vencedores
        foreach (range(1, 9) as $i) {
            $propertyName = "winner_number_$i";
            if (!empty($this->$propertyName)) {
                $this->disabledWinnerNumbers[$i] = true;
                $this->$propertyName = formatNumberWithLeadingZeros($this->$propertyName, ($this->total_numbers_to_update - 1));
            } else {
                $this->disabledWinnerNumbers[$i] = false;
            }
        }

        //drawn numbers
        $this->winner_number_1 = $raffle->winner_number_1;
        $this->winner_number_2 = $raffle->winner_number_2;
        $this->winner_number_3 = $raffle->winner_number_3;
        $this->winner_number_4 = $raffle->winner_number_4;
        $this->winner_number_5 = $raffle->winner_number_5;
        $this->winner_number_6 = $raffle->winner_number_6;
        $this->winner_number_7 = $raffle->winner_number_7;
        $this->winner_number_8 = $raffle->winner_number_8;
        $this->winner_number_9 = $raffle->winner_number_9;

        //dd($this->susep_process, $this->serie_size);
    }


    public function update()
    {
        $validatedData = $this->validate([
            // General information
            'name' => 'required|max:255',
            'status' => 'required', // 'ativa', 'inativa', 'arquivada'
            'description' => 'required|string',
            'main_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:150000', // 150MB em kilobytes (KB)
            'draw_date' => 'required|date',
            'draw_hour' => 'required',
            'publication_date' => 'nullable|date',
            'publication_hour' => 'nullable',
            // Prizes
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
                'required_if:show_top_3_in_draw_page,1'
            ],
            'second_top_buyer_prize' => [
                'nullable',
                'required_if:show_top_3_in_draw_page,1'
            ],
            'third_top_buyer_prize' => [
                'nullable',
                'required_if:show_top_3_in_draw_page,1'
            ],
            // Sales
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
            // Premier Numbers
            'premier_number_1' => 'nullable',
            'premier_number_2' => 'nullable',
            'premier_number_3' => 'nullable',
            'premier_number_4' => 'nullable',
            'premier_number_5' => 'nullable',
            'premier_number_6' => 'nullable',
            'premier_number_7' => 'nullable',
            'premier_number_8' => 'nullable',
            'premier_number_9' => 'nullable',
            'premier_number_10' => 'nullable',
            'premier_number_11' => 'nullable',
            'premier_number_12' => 'nullable',
            'premier_number_13' => 'nullable',
            'premier_number_14' => 'nullable',
            'premier_number_15' => 'nullable',
            'premier_number_16' => 'nullable',
            'premier_number_17' => 'nullable',
            'premier_number_18' => 'nullable',
            'premier_number_19' => 'nullable',
            'premier_number_20' => 'nullable',
            'premier_number_21' => 'nullable',
            'premier_number_22' => 'nullable',
            'premier_number_23' => 'nullable',
            'premier_number_24' => 'nullable',
            'premier_number_25' => 'nullable',
            'premier_number_26' => 'nullable',
            'premier_number_27' => 'nullable',
            'premier_number_28' => 'nullable',
            'premier_number_29' => 'nullable',
            'premier_number_30' => 'nullable',
            'premier_number_award_1' => 'nullable',
            'premier_number_award_2' => 'nullable',
            'premier_number_award_3' => 'nullable',
            'premier_number_award_4' => 'nullable',
            'premier_number_award_5' => 'nullable',
            'premier_number_award_6' => 'nullable',
            'premier_number_award_7' => 'nullable',
            'premier_number_award_8' => 'nullable',
            'premier_number_award_9' => 'nullable',
            'premier_number_award_10' => 'nullable',
            'premier_number_award_11' => 'nullable',
            'premier_number_award_12' => 'nullable',
            'premier_number_award_13' => 'nullable',
            'premier_number_award_14' => 'nullable',
            'premier_number_award_15' => 'nullable',
            'premier_number_award_16' => 'nullable',
            'premier_number_award_17' => 'nullable',
            'premier_number_award_18' => 'nullable',
            'premier_number_award_19' => 'nullable',
            'premier_number_award_20' => 'nullable',
            'premier_number_award_21' => 'nullable',
            'premier_number_award_22' => 'nullable',
            'premier_number_award_23' => 'nullable',
            'premier_number_award_24' => 'nullable',
            'premier_number_award_25' => 'nullable',
            'premier_number_award_26' => 'nullable',
            'premier_number_award_27' => 'nullable',
            'premier_number_award_28' => 'nullable',
            'premier_number_award_29' => 'nullable',
            'premier_number_award_30' => 'nullable',
            // Drawn numbers
            'winner_number_1' => 'nullable',
            'winner_number_2' => ['nullable', $this->winnerNumberValidation('second_prize')],
            'winner_number_3' => ['nullable', $this->winnerNumberValidation('third_prize')],
            'winner_number_4' => ['nullable', $this->winnerNumberValidation('fourth_prize')],
            'winner_number_5' => ['nullable', $this->winnerNumberValidation('fifth_prize')],
            'winner_number_6' => ['nullable', $this->winnerNumberValidation('sixth_prize')],
            'winner_number_7' => ['nullable', $this->winnerNumberValidation('seventh_prize')],
            'winner_number_8' => ['nullable', $this->winnerNumberValidation('eighth_prize')],
            'winner_number_9' => ['nullable', $this->winnerNumberValidation('ninth_prize')],
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O campo nome não pode ter mais de 255 caracteres.',
            'description.required' => 'O campo descrição é obrigatório.',
            'description.max' => 'O campo descrição não pode ter mais de 3000 caracteres.',
            'main_photo.image' => 'O arquivo deve ser uma imagem.',
            'main_photo.mimes' => 'O arquivo deve ser do tipo: jpg, jpeg, png, gif.',
            'main_photo.max' => 'O arquivo não pode ter mais de 150MB.',
            'draw_date.required' => 'O campo data do sorteio é obrigatório.',
            'draw_date.date' => 'O campo data do sorteio deve ser uma data válida.',
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
            'min_number_purchase.required' => 'O campo compra mínima é obrigatório.',
            'min_number_purchase.numeric' => 'O campo compra mínima deve ser um número.',
            'min_number_purchase.min' => 'O campo compra mínima deve ser no mínimo 1.',
            'max_number_purchase.required' => 'O campo compra máxima é obrigatório.',
            'max_number_purchase.numeric' => 'O campo compra máxima deve ser um número.',
            'max_number_purchase.min' => 'O campo compra máxima deve ser no mínimo 1.',
            'max_number_purchase.max' => 'O campo compra máxima não pode ser maior que 20.000 títulos.',
            'auto_buy_option_one.required' => 'O campo opção de compra automática 1 é obrigatório.',
            'auto_buy_option_two.required' => 'O campo opção de compra automática 2 é obrigatório.',
            'auto_buy_option_three.required' => 'O campo opção de compra automática 3 é obrigatório.',
            'auto_buy_option_four.required' => 'O campo opção de compra automática 4 é obrigatório.',
            'auto_buy_option_five.required' => 'O campo opção de compra automática 5 é obrigatório.',
            'auto_buy_option_six.required' => 'O campo opção de compra automática 6 é obrigatório.',
            'auto_buy_highlight.required' => 'O campo destaque da compra automática é obrigatório.',
        ]);

        $raffle = Raffle::find($this->raffleId);

        if (!$raffle) {
            session()->flash('error', 'Raffle not found.');
            return;
        }

        if ($this->main_photo) {
            $photoPath = $this->main_photo->store('raffles', 'public');
            $validatedData['main_photo'] = $photoPath;
        } else {
            unset($validatedData['main_photo']);
        }

        if ($this->publication_date === null || $this->publication_date === '') {
            $validatedData['publication_date'] = Carbon::now()->subHours(3);
            $validatedData['publication_hour'] = Carbon::now()->subHours(3)->format('H:i');
        }

        $validatedData['winner'] = $this->first_prize;

        $validatedData['quantity_personalized_tickets'] = (int)str_replace([',', '.'], '', $this->quantity_personalized_tickets);
        $validatedData['min_number_purchase'] = (int)str_replace([',', '.'], '', $this->min_number_purchase);
        $validatedData['max_number_purchase'] = (int)str_replace([',', '.'], '', $this->max_number_purchase);

        // Include other premier number fields in the validated data
        for ($i = 1; $i <= 30; $i++) {
            if ($this->{"premier_number_$i"} === null || $this->{"premier_number_$i"} === '') {
                $validatedData["premier_number_$i"] = null;
                $validatedData["premier_number_award_$i"] = null;
                continue;
            }
            $validatedData["premier_number_enabled_$i"] = true;
        }
        $validatedData["show_premier_awards"] = true;
        $validatedData["show_winner_premier_awards"] = true;

        // Include the winner numbers in the validated data
        for ($i = 1; $i <= 9; $i++) {
            $inputValue = "winner_number_$i";

            $usedWinnerNumbers = [];
            for ($j = 1; $j <= 9; $j++) {
                $winnerNumber = "winner_number_$j";
                if (!is_null($raffle->$winnerNumber)) {
                    $usedWinnerNumbers[] = $raffle->$winnerNumber;
                }
            }

            // Verifique se o número atual não está vazio e ainda não foi validado anteriormente
            if ($raffle->$inputValue === null) {
                // Verifique se o número já foi utilizado
                if (in_array($this->$inputValue, $usedWinnerNumbers) && !empty($this->$inputValue)) {
                    $this->addError($inputValue, "O número '{$this->$inputValue}' já foi utilizado, por favor escolha outro número.");
                    return;
                }

                //adiciona o número do vencedor ao array
                $validatedData[$inputValue] = $this->$inputValue;
                $usedWinnerNumbers[] = $this->$inputValue; // Adicione o número à lista de números usados
            }
        }

        if (empty($validatedData)) {
            session()->flash('info', 'No changes detected.');
            return;
        }

        try {
            DB::beginTransaction();
            $raffle->update($validatedData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to update raffle premier numbers: ' . $e->getMessage());
        }

        return redirect()->route('my_raffles')->with('success', 'Ação "' . $this->name . '" atualizada com sucesso!');
    }

    private function validatePremierNumbers()
    {
        $errors = [];

        for ($i = 1; $i <= 30; $i++) {
            if ($this->{"premier_number_$i"} !== null && $this->{"premier_number_award_$i"} === null) {
                $errors["premier_number_award_$i"] = "O campo prêmio do título premiado $i é obrigatório.";
            }
        }

        
        foreach ($errors as $fieldName => $errorMessage) {
            $this->addError($fieldName, $errorMessage);
        }

        return $errors;
    }

    public function generatePremierNumbersReportPDF()
    {
        // Validar os números premiados
        $errors = $this->validatePremierNumbers();

        if (!empty($errors)) {
            // Se houver erros, você pode exibi-los ou tratar como desejar
            // Por exemplo, retornar uma mensagem de erro para o usuário
            session()->flash('error', 'Por favor, corrija os erros nos números premiados antes de tentar gerar o relatório.');
            return;
        }

        $pdfContent = PDF::loadView('receipts.premier_numbers_report', [
            'raffle' => Raffle::find($this->raffleId),
        ])->output();
        $reportName = 'premier_numbers_report-' . Str::uuid() . '.pdf';

        Storage::disk('public')->put('reports/' . $reportName, $pdfContent);

        //fazer o download do arquivo
        return Storage::disk('public')->download('reports/' . $reportName);
    }

    private function winnerNumberValidation($prizeField)
    {
        return function ($attribute, $value, $fail) use ($prizeField) {
            if ($this->$prizeField === null) {
                $fail("Não é possível adicionar um número vencedor, pois o prêmio correspondente ($prizeField) não foi definido.");
            } elseif (!in_array($value, $this->paidNumbersArray)) {
                $fail('Nenhum vencedor encontrado para este número.');
            }
        };
    }

    public function searchWinners()
    {
        $this->winners_from_raffle_numbers = [];

        // Carregar as informações da rifa
        $raffle = Raffle::find($this->raffleId);

        //used winner numbers
        $usedWinnerNumbers = [];
        for ($i = 1; $i <= 9; $i++) {
            $inputValue = "winner_number_$i";
            if (!is_null($raffle->$inputValue)) {
                $usedWinnerNumbers[] = $raffle->$inputValue;
            }
        }

        // Comparar os números informados com os números pagos
        for ($i = 1; $i <= 9; $i++) {
            $propertyName = "winner_number_$i"; // Construindo o nome da propriedade
            $winnerNumber = $this->$propertyName ?? null; // Obtendo o número do vencedor

            if (in_array($winnerNumber, $this->paidNumbersArray)) {
                // Se o número do vencedor estiver na lista de números pagos
                $winner = $this->paidNumbers->where('number', $winnerNumber)->first()->user;
                $winnerInfo = [
                    'email' => $winner->email,
                    'phone' => $winner->phone,
                    'name' => $winner->name
                ];
                $this->winners_from_raffle_numbers[$propertyName] = $winnerInfo; // Adicionando informações do vencedor ao array
                $this->resetErrorBag(); // Limpar quaisquer erros anteriores
            } else {
                if ($winnerNumber !== null && $winnerNumber !== "") {
                    $this->addError($propertyName, 'Nenhum vencedor encontrado para este número.');
                }
            }
        }
    }

    public function removeMainPhoto()
    {
        $this->main_photo = null;
    }

    public function removeCurrentPhoto()
    {
        $raffle = Raffle::find($this->raffleId);

        if ($raffle->main_photo) {
            \Storage::delete($raffle->main_photo);
            $raffle->main_photo = null;

            $raffle->save();
        }

        return redirect()->route('edit-raffles', ['id' => $this->raffleId])->with('message', 'Foto removida com sucesso.');
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
        return view('livewire.admin.raffle.edit', [
            'raffle' => Raffle::find($this->raffleId),
        ]);
    }
}
