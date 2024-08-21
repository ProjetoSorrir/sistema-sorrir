<?php

namespace App\Livewire\Site;

use App\Helpers\WebhookHelper;
use App\Livewire\Forms\LoginForm;
use App\Models\Raffle;
use App\Models\User;
use App\Services\InvoiceService;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class RaffleBuy extends Component
{
    protected $listeners = ['updateNumbersRequested'];

    public $raffleId, $tenantId;
    public $status;
    public $sorted;

    public $currentImageIndex = 0;
    public $image;
    public $item;
    public $description;
    public $name;
    public $susep_process;
    public $draw_date;
    public $draw_hour;
    public $show_draw_date;
    public $draw_location;
    public $is_raffle_active;

    public $auto_buy_option_one;
    public $auto_buy_option_two;
    public $auto_buy_option_three;
    public $auto_buy_option_four;
    public $auto_buy_option_five;
    public $auto_buy_option_six;
    public $auto_buy_highlight;

    public $min_number_purchase;
    public $max_number_purchase;
    public $remainingNumbers = 0;

    public $numbersArray;

    public $price_per_number = 0.00;

    public $showNumbers = true;

    public $isUserLoggedIn;

    public $bankAccounts;

    public $showTopBuyers;
    public $showTopPrizes;

    public $prizes_top_3;
    public $topBuyers;
    public $mainPrizes = [];

    public $auto_number_selection = false;

    public $disable_manual_number_selection = false;

    public $show_remaining_numbers = false;

    public $totalNumbers = 0;
    public $avaliableNumbers = 0;
    public $reservedNumbers = 0;
    public $paidNumbers = 0;
    public $paidNumbersArray = [];

    public $numbersRequested = 1;
    public $selectedNumbers = [];
    public $calcFinalValue = 0.00;

    public $modalOpenState = false;
    public $login = true;
    public LoginForm $form;

    // Register Form
    public string $registerName;
    public string $cpf;
    public string $birth_date;
    public string $email;
    public string $email_confirmation;
    public string $ddi = '+55';
    public string $phone;
    public string $cep;
    public string $password;
    public string $password_confirmation;

    public bool $disabledButton = false;

    public $raffle;

    public $havePremier = false;

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

    public $show_premier_awards;
    public $show_winner_premier_awards;

    public $winners_from_premier_numbers = [];
    public $winners_from_main_prizes = [];

    public $blockedNumbers = [];

    public $salesClosed = false;

    public $winners_from_raffle_numbers = [];
    public $drawDateTime;
    public $resultArray;

    public $accept_terms;

    public function mount($raffleId = null)
    {
        $this->raffleId = $raffleId;
        if (!$raffleId) {
            // Handle the case where the model is not found
            session()->flash('error', 'notFound.');
            return redirect()->to('/');
        }

        $this->tenantId = getTenantId();
        tenancyFn(getTenantId());

        $this->accept_terms = true;

        $this->isUserLoggedIn = auth()->check();

        $this->loadPage($this->raffleId);
    }

    public function loadPage($raffleId)
    {
        tenancyFn($this->tenantId);

        $raffle = Raffle::find($raffleId);

        if (!$raffle || $raffle->sorted || $raffle->status !== 'ativa') {
            // Handle the case where the model is not found or does not meet the conditions
            session()->flash('error', 'notFound.');
            return redirect()->to('/');
        }
        if ($raffle) {
            if ($raffle->quantity_personalized_tickets > $raffle->total_numbers) {
                $totalNumbers = $raffle->quantity_personalized_tickets;
            } else {
                $totalNumbers = $raffle->total_numbers;
            }

            $numbersInserted = 0;

            $this->remainingNumbers = $totalNumbers - $numbersInserted;

            $this->is_raffle_active = true;
            // $this->is_raffle_active = Raffle::where('sorted', false)->where('status', 'ativa')
            //     ->where(function ($query) {
            //         $query->where(function ($innerQuery) {
            //             $innerQuery->whereNull('publication_date')
            //                 ->orWhere('publication_date', '<', now()->subHours(3)->format('Y-m-d'));
            //         })
            //             ->orWhere(function ($innerQuery) {
            //                 $innerQuery->where('publication_date', now()->subHours(3)->format('Y-m-d'))
            //                     ->where(function ($innerInnerQuery) {
            //                         $innerInnerQuery->whereNull('publication_hour')
            //                             ->orWhere('publication_hour', '<=', now()->subHours(3)->format('H:i'));
            //                     });
            //             });
            //     })
            //     ->where('id', $raffle->id)->exists();


            $this->show_premier_awards = $raffle->show_premier_awards;
            $this->show_winner_premier_awards = $raffle->show_winner_premier_awards;

            $this->status = $raffle->status;
            $this->susep_process = $raffle->susep_process;
            $this->sorted = $raffle->sorted;
            $this->auto_buy_option_one = $raffle->auto_buy_option_one;
            $this->auto_buy_option_two = $raffle->auto_buy_option_two;
            $this->auto_buy_option_three = $raffle->auto_buy_option_three;
            $this->auto_buy_option_four = $raffle->auto_buy_option_four;
            $this->auto_buy_option_five = $raffle->auto_buy_option_five;
            $this->auto_buy_option_six = $raffle->auto_buy_option_six;
            $this->auto_buy_highlight = $raffle->auto_buy_highlight;
            $this->auto_number_selection = $raffle->auto_number_selection;
            $this->disable_manual_number_selection = $raffle->disable_manual_number_selection;
            $this->show_remaining_numbers = $raffle->show_remaining_numbers;
            $this->name = $raffle->name;
            $this->image = $raffle->main_photo; // Assuming 'images' is a JSON column or an accessor that returns an array
            $this->description = $raffle->description;
            $this->draw_date = Carbon::createFromFormat('Y-m-d', $raffle->draw_date)->format('d/m/Y');
            $this->draw_hour = $raffle->draw_hour;

            $drawDateTimeString = $raffle->draw_date . ' ' . $raffle->draw_hour;
            $this->drawDateTime = Carbon::createFromFormat('Y-m-d H:i', $drawDateTimeString);

            $this->show_draw_date = $raffle->show_draw_date;
            $this->draw_location = $raffle->draw_location === 'outros' ? $raffle->additional_draw_info : $raffle->draw_location;

            $this->min_number_purchase = $raffle->min_number_purchase;
            $this->max_number_purchase = $raffle->max_number_purchase;

            $this->price_per_number = $raffle->price_per_number;

            $this->mainPrizes = [
                'winner' => is_numeric($raffle->winner) ? number_format($raffle->winner, 2, ',', '.') : $raffle->winner,
                'second_prize' => is_numeric($raffle->second_prize) ? number_format($raffle->second_prize, 2, ',', '.') : $raffle->second_prize,
                'third_prize' => is_numeric($raffle->third_prize) ? number_format($raffle->third_prize, 2, ',', '.') : $raffle->third_prize,
                'fourth_prize' => is_numeric($raffle->fourth_prize) ? number_format($raffle->fourth_prize, 2, ',', '.') : $raffle->fourth_prize,
                'fifth_prize' => is_numeric($raffle->fifth_prize) ? number_format($raffle->fifth_prize, 2, ',', '.') : $raffle->fifth_prize,
                'sixth_prize' => is_numeric($raffle->sixth_prize) ? number_format($raffle->sixth_prize, 2, ',', '.') : $raffle->sixth_prize,
                'seventh_prize' => is_numeric($raffle->seventh_prize) ? number_format($raffle->seventh_prize, 2, ',', '.') : $raffle->seventh_prize,
                'eighth_prize' => is_numeric($raffle->eighth_prize) ? number_format($raffle->eighth_prize, 2, ',', '.') : $raffle->eighth_prize,
                'ninth_prize' => is_numeric($raffle->ninth_prize) ? number_format($raffle->ninth_prize, 2, ',', '.') : $raffle->ninth_prize,
            ];

            $this->showTopBuyers = $raffle->add_top_3_buyers; //mostrar as 3 pessoas que mais compraram
            $this->showTopPrizes = $raffle->show_top_3_in_draw_page; //mostrar os 3 primeiros prêmios
            $this->prizes_top_3 = [
                'prize_1' => is_numeric($raffle->first_top_buyer_prize) ? number_format($raffle->first_top_buyer_prize, 2, ',', '.') : $raffle->first_top_buyer_prize,
                'prize_2' => is_numeric($raffle->second_top_buyer_prize) ? number_format($raffle->second_top_buyer_prize, 2, ',', '.') : $raffle->second_top_buyer_prize,
                'prize_3' => is_numeric($raffle->third_top_buyer_prize) ? number_format($raffle->third_top_buyer_prize, 2, ',', '.') : $raffle->third_top_buyer_prize,
            ];

            $this->item = [
                'valor' => 'R$ ' . number_format($raffle->price_per_number, 2, ',', '.') ?? 'R$ 0,00', // Replace 'price' with your actual column name
                'premio' => $raffle->winner ?? '', // Replace 'prize' with your actual column name
            ];

            // $this->totalNumbers = max($raffle->quantity_personalized_tickets, $raffle->total_numbers);
            $this->totalNumbers = 5000000;
            // $this->reservedNumbers = Number::where('raffle_id', $raffle->id)->whereNotNull('reserved_at')->count();

            // $this->avaliableNumbers =  $this->totalNumbers - $this->reservedNumbers;
        } else {
            // Handle the case where the raffle doesn't exist
            $this->image = null;
            $this->description = 'Bilhete não encontrado';
            $this->item = [
                'valor' => 'R$ 0,00',
                'premio' => ''
            ];
        }
    }

    public function updateNumbersRequested($value)
    {
        $this->numbersRequested = $value;
    }

    public function selectNumber(int $number)
    {
        tenancyFn($this->tenantId);
        if ($this->totalNumbers <= 1000) {
            if ($this->numbersArray[$number] != 'free') {
                // Number is already selected, find the next available number
                $found = false; // Flag to check if free number is found
                foreach ($this->numbersArray as $key => $value) {
                    if ($value == 'free') {
                        $number = $key; // Assign the next available number
                        $found = true;
                        break; // Exit the loop once a free number is found
                    }
                }

                if (!$found) {
                    //ADD a TOLLTIP or ALERT
                    return;
                }
            }
        }

        if (($this->numbersRequested + 1) > $this->max_number_purchase) {
            //ADD a TOLLTIP or ALERT
            return;
        }

        $this->numbersRequested++;
        $this->calcFinalValue = 'R$ ' . number_format(($this->numbersRequested * $this->price_per_number), 2, ',', '.');
        if ($this->totalNumbers <= 1000) {
            $this->numbersArray[$number] = 'selected';
            array_push($this->selectedNumbers, $number);
        }

    }

    public function closeModal()
    {
        tenancyFn($this->tenantId);
        $this->modalOpenState = false;
    }

    public function deselectNumber(int $number)
    {
        tenancyFn($this->tenantId);
        if ($this->numbersArray[$number] != 'selected') {
            //TODO Error number not selected
            return;
        }
        if (($this->numbersRequested - 1) < 0) {
            //ADD a TOLLTIP ou ALERT
            return;
        }
        $key = array_search($number, $this->selectedNumbers);
        if ($key !== false) {
            unset($this->selectedNumbers[$key]);
        }
        $this->numbersRequested--;
        $this->calcFinalValue = 'R$ ' . number_format(($this->numbersRequested * $this->price_per_number), 2, ',', '.');
        $this->numbersArray[$number] = 'free';
    }

    public function changeLoginButton()
    {
        tenancyFn($this->tenantId);
        if ($this->login) {
            $this->login = false;
        } else {
            $this->login = true;
        }
    }

    private function getSelectedNumbers(Raffle $raffle, int $qty)
    {
        $bignumberService = new BigNumbersService();
        $reservedNumbersForBig = $raffle->numbers()->pluck('number')->all();
        $numbers = $bignumberService->getRandomNumbers($raffle->getTotalNumbers(), $reservedNumbersForBig, $qty);
        return array_map(function ($number) {
            return $number - 1;
        }, $numbers["generated_tickets"]);

    }

    public function confirmPurchase()
    {
        tenancyFn($this->tenantId);

        $this->disabledButton = true;
        // Check if the raffle with the provided ID exists
        $raffle = Raffle::findOrFail($this->raffleId);
        $qty = $this->numbersRequested;

        try {
            $referralCode = Cookie::get('referral');
            $invoice = InvoiceService::create(Auth::user(), $raffle, $qty, $this->accept_terms, $referralCode);
            $this->disabledButton = false;
            return redirect()->route('reservation-confirmation', [$invoice->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->disabledButton = false;
            $this->redirect('/');
        }
    }

    private function flattenArray($array)
    {
        $result = [];
        foreach ($array as $item) {
            if (is_array($item) || is_object($item)) {
                $result = array_merge($result, $this->flattenArray((array)$item));
            } else {
                $result[] = $item;
            }
        }
        return $result;
    }

    private function getReservedNumbers()
    {
        // Implemente a lógica para obter os números já reservados do banco de dados ou outra fonte
        // Exemplo de implementação simples:
        $reservedNumbers = [];

        // Consulta ao banco de dados para obter números reservados (pseudo código)
        $result = DB::table('numbers')
            ->where('raffle_id', $this->raffleId)
            ->pluck('number');

        if ($result) {
            $reservedNumbers = $result->toArray();
        }

        return $reservedNumbers;
    }

    public function confirmBuyModal()
    {
        tenancyFn($this->tenantId);
        $this->modalOpenState = true;
    }

    public function loginCaller(): void
    {
        tenancyFn($this->tenantId);

        $this->validate();

        $this->form->authenticate();

        //Session::regenerate();
        $user = User::where('cpf', $this->form->cpf)->firstOrFail();

        Auth::login($user);

        $this->isUserLoggedIn = auth()->check();
    }

    function removeRandomElements(array &$array, int $numToRemove)
    {
        tenancyFn($this->tenantId);
        if ($numToRemove > count($array)) {
            // Handle the case where you try to remove more elements than are present
            //throw new Error("Cannot remove more elements than exist in the array.");
            // TODO tolltip
            return;
        }

        // Get random keys from the array
        $keysToRemove = array_rand($array, $numToRemove);

        // array_rand returns a single value if $numToRemove is 1, make sure it's always an array
        if (!is_array($keysToRemove)) {
            $keysToRemove = [$keysToRemove];
        }

        // Remove the selected elements
        foreach ($keysToRemove as $key) {
            unset($array[$key]);
        }
    }

    public function inputNumber()
    {
        tenancyFn($this->tenantId);
        if (($this->numbersRequested > $this->max_number_purchase) && ($this->numbersRequested > $this->remainingNumbers)) {
            if ($this->remainingNumbers > $this->max_number_purchase) {
                $this->numbersRequested = $this->max_number_purchase;
                $this->dispatch('alertMessage', ['mensagem' => 'O limite máximo de compra são ' . $this->max_number_purchase . ' títulos!']);
            } else {
                $this->numbersRequested = $this->remainingNumbers;
                $this->dispatch('alertMessage', ['mensagem' => 'O limite máximo de compra são ' . $this->remainingNumbers . ' títulos!']);
            }
        } elseif ($this->numbersRequested > $this->max_number_purchase) {
            $this->dispatch('alertMessage', ['mensagem' => 'O limite máximo de compra são ' . $this->max_number_purchase . ' títulos!']);
            $this->numbersRequested = $this->max_number_purchase;
        } elseif ($this->numbersRequested < $this->min_number_purchase) {
            $this->dispatch('alertMessage', ['mensagem' => 'O limite mínimo de compra são ' . $this->min_number_purchase . ' títulos!']);
            $this->numbersRequested = $this->min_number_purchase;
        }
        if (is_null($this->numbersRequested)) {
            $this->numbersRequested = 1;
        }
        $this->calcFinalValue = 'R$ ' . number_format(($this->numbersRequested * $this->price_per_number), 2, ',', '.');
    }

    public function getRandomNumbers($requestNumberQuantity = null)
    {
        tenancyFn($this->tenantId);
        if (($this->numbersRequested + $requestNumberQuantity) > $this->max_number_purchase && ($this->numbersRequested + $requestNumberQuantity) > $this->remainingNumbers) {
            if ($this->remainingNumbers > $this->max_number_purchase) {
                $this->numbersRequested = $this->max_number_purchase;
                $this->dispatch('alertMessage', ['mensagem' => 'O limite máximo de compra são ' . $this->max_number_purchase . ' títulos!']);
            } else {
                $this->numbersRequested = $this->remainingNumbers;
                $this->dispatch('alertMessage', ['mensagem' => 'O limite máximo de compra são ' . $this->remainingNumbers . ' títulos!']);
            }
        } elseif (($this->numbersRequested + $requestNumberQuantity) > $this->max_number_purchase) {
            $this->dispatch('alertMessage', ['mensagem' => 'O limite máximo de compra são ' . $this->max_number_purchase . ' títulos!']);
            $this->numbersRequested = $this->max_number_purchase;
        } elseif (($this->numbersRequested + $requestNumberQuantity) > $this->remainingNumbers) {
            $this->dispatch('alertMessage', ['mensagem' => 'O limite máximo de compra são ' . $this->remainingNumbers . ' títulos!']);
            $this->numbersRequested = $this->remainingNumbers;
        } elseif ($requestNumberQuantity < 1) {
            //ADD a TOLLTIP ou ALERT

        } else {
            $this->numbersRequested += $requestNumberQuantity;
        }

        $this->calcFinalValue = 'R$ ' . number_format(($this->numbersRequested * $this->price_per_number), 2, ',', '.');
    }

    public function register(): void
    {
        tenancyFn($this->tenantId);

        $this->validate([
            'registerName' => [
                'required',
                'string',
                'regex:/^[\pL\s]{3,} [\pL\s]{2,}.*/u',
                'min:3',
                'max:255'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'confirmed',
                'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/',
                'max:255',
                'unique:' . User::class
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8',
                'max:20'
            ],
            'cpf' => [
                'required',
                'string',
                'unique:' . User::class,
                function ($attribute, $value, $fail) {
                    if (!$this->isValidCPF($value)) {
                        $fail('O CPF informado é inválido');
                    }
                }
            ],
            'birth_date' => [
                'required',
                'date',
                'before:' . now()->setTimezone('America/Sao_Paulo')->subYears(16)->toDateString()
            ],
            'phone' => [
                'required',
                'string',
                'min:10', // Ajustado para incluir código de área
                'max:11', // Ajustado para incluir número máximo com código de área
                'regex:/^\d{10,11}$/', // Expressão regular para validar formato numérico
                'unique:' . User::class
            ],
            'cep' => [
                'required',
                'string',
                'regex:/^\d{5}-?\d{3}$/', // Expressão regular para validar formato de CEP
            ],
        ], [
            'registerName.required' => 'Preencha este campo',
            'registerName.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'registerName.max' => 'O campo nome deve ter no máximo 255 caracteres',
            'registerName.regex' => 'Por favor, preencha um nome e sobrenome',
            'email.required' => 'Preencha este campo',
            'email.email' => 'O campo email deve ser um email válido',
            'email.unique' => 'O email informado já está em uso',
            'email.regex' => 'Por favor, digite um email válido. Ex email@email.com',
            'email.confirmed' => 'A confirmação do e-mail não corresponde',
            'password.required' => 'Preencha este campo',
            'password.min' => 'O campo senha deve ter no mínimo 8 caracteres',
            'password.max' => 'O campo senha deve ter no máximo 20 caracteres',
            'password.confirmed' => 'As senhas não conferem',
            'cpf.required' => 'Preencha este campo',
            'cpf.unique' => 'O CPF informado já está em uso',
            'birth_date.required' => 'Preencha este campo',
            'birth_date.date' => 'O campo data de nascimento deve ser uma data válida',
            'birth_date.before' => 'Você deve ter no mínimo 16 anos para se cadastrar',
            'phone.required' => 'Preencha este campo',
            'phone.min' => 'O campo telefone deve ter no mínimo 10 caracteres',
            'phone.max' => 'O campo telefone deve ter no máximo 11 caracteres',
            'phone.regex' => 'O campo telefone deve conter apenas números e ter entre 10 e 11 dígitos',
            'phone.unique' => 'O telefone informado já está em uso',
            'cep.required' => 'Preencha este campo',
            'cep.regex' => 'O campo CEP deve estar no formato 00000-000 ou 00000000',
        ]);
        if (User::where('cpf', preg_replace('/[^0-9]/is', '', $this->cpf))->exists()) {
            throw ValidationException::withMessages(['cpf' => 'O CPF informado já está em uso']);
        }

        $birthDate = Carbon::createFromFormat('d-m-Y', $this->birth_date)->format('Y-m-d');

        $validated['password'] = Hash::make($this->password);

        $user = User::create([
            'name' => $this->registerName,
            'cpf' => preg_replace('/[^0-9]/is', '', $this->cpf),
            'birth_date' => $birthDate,
            'ddi' => $this->ddi,
            'phone' => $this->phone,
            'cep' => $this->cep,
            'email' => $this->email,
            'password' => $validated['password'],
        ]);

        event(new Registered($user));

        Auth::login($user);

        $this->isUserLoggedIn = auth()->check();

        // Dados para o webhook
        $data = [
            "Nome" => Auth::user()->name,
            "email" => Auth::user()->email,
            "telefone" => Auth::user()->phone,
            "cidade" => Auth::user()->city ?? 'N/A',
            "UF" => Auth::user()->state ?? 'N/A',
            "CEP" => Auth::user()->zip_code ?? 'N/A',
            "user_id" => Auth::id(),
            "dt_nascimento" => Auth::user()->birth_date ?? 'N/A',
            "Origen" => 'Login do Usuário - Compra de Título'
        ];

        // Chama o helper para enviar o webhook
        $webhookUrl = 'https://growthphantom.app.n8n.cloud/webhook/cf299562-6071-450d-945a-edb2588ba3cf';
        WebhookHelper::sendWebhook($webhookUrl, $data);

        Log::info('Send Webhook Login to n8n RAFFLEBUY ==> BRASCAP', ['data' => $data]);
    }

    private function isValidCPF($cpf)
    {
        // Remove caracteres especiais
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se o número de dígitos é igual a 11
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se todos os dígitos são iguais (ex.: 111.111.111-11)
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Calcula os dígitos verificadores para verificar se são válidos
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    public function render()
    {
        tenancyFn($this->tenantId);
        return view('livewire.site.raffle-buy', [
            // 'faqs' => Faq::all(),
            // 'bankAccounts' => BankAccount::all()
        ]);
    }
}
