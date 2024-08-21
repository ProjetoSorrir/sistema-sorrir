<?php

namespace App\Livewire;

use App\Livewire\Forms\LoginForm;
use App\Models\Invoice;
use App\Models\Number;
use App\Models\Raffle;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class BuyModal extends Component
{
    public LoginForm $form;

    public $isUserLoggedIn;
    public $numbersArray = [];
    public $login = true;
    public $isProcessing = false;

    public string $tenant_id;
    public string $raffleId;

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount($initialNumbersArray, $raffleId)
    {
        $this->numbersArray = $initialNumbersArray;
        $this->raffleId = $raffleId;
        $this->tenant_id = getTenantId();
        tenancyFn(getTenantId());
        $this->isUserLoggedIn = auth()->check();
    }


    public function confirmPurchase($selectedNumbers)
    {
        // Evita múltiplos cliques no botão
        if ($this->isProcessing) {
            return;
        }

        // Define o estado de processamento como verdadeiro
        $this->isProcessing = true;

        tenancyFn($this->tenant_id);

        // Start a transaction to ensure data integrity
        DB::beginTransaction();

        try {
            // Retrieve the referral code from the cookie
            $referralCode = Cookie::get('referral');

            // Check if the raffle with the provided ID exists
            $raffle = Raffle::findOrFail($this->raffleId);

            // Check if all selected numbers are within the range of total numbers for the raffle
            $totalNumbers = ($raffle->quantity_personalized_tickets > $raffle->total_numbers) ? $raffle->quantity_personalized_tickets : $raffle->total_numbers;
            foreach ($selectedNumbers as $number) {
                if ($number < 1 || $number > $totalNumbers) {
                    // Number is outside the range
                    throw new \Exception("One or more selected numbers are outside the valid range.");
                }
            }

            $reservedNumbers = Number::whereIn('number', $selectedNumbers)
                ->where('raffle_id', $this->raffleId) // Check the raffle ID
                ->whereNotNull('reserved_at')
                ->lockForUpdate() // Lock the rows to prevent concurrent modifications
                ->pluck('number')->all(); // Use pluck to get an array of 'number' values that are reserved

            // Check if any of the selected numbers are already reserved
            $unavailableNumbers = array_intersect($selectedNumbers, $reservedNumbers);
            if (!empty($unavailableNumbers)) {
                throw new \Exception("One or more numbers are not available: " . implode(', ', $unavailableNumbers));
            }

            // Calculate the total amount to be paid
            $amount = count($selectedNumbers) * $raffle->price_per_number;

            // If a referral code exists, try to find the referring user
            if ($referralCode) {
                $referringUser = User::where('referral_code', $referralCode)->first();
                if ($referringUser) {
                    $refer_id = $referringUser->id;
                }
            }

            // Create an invoice for the user with the selected numbers
            $invoice = Invoice::create([
                'user_id' => Auth::id(),
                'raffle_id' => $this->raffleId,
                'amount' => $amount,
                'payment_method' => 'manual_payment',
                'refer_id' => $refer_id ?? null,
            ]);

            // Mark selected numbers as reserved and link them to the invoice
            foreach ($selectedNumbers as $number) {
                Number::create([
                    'user_id' => Auth::id(),
                    'raffle_id' => $this->raffleId,
                    'number' => $number,
                    'reserved_at' => now(),
                    'invoice_id' => $invoice->id,
                ]);
            }

            // Commit the transaction
            DB::commit();

            // Reset o estado de processamento
            $this->isProcessing = false;

            // Redirect to the reservation confirmation page
            return redirect()->route('reservation-confirmation', [$invoice->id]);
        } catch (\Exception $e) {
            // Roll back the transaction in case of error
            DB::rollBack();
            // Handle errors, e.g., show a message to the user
            dd("Falha", $e->getMessage());
            //$this->emit('purchaseFailed', $e->getMessage());
            $this->redirect('/');
        }
    }

    // public function confirmPurchase($selectedNumbers)
    // {
    //     tenancyFn($this->tenant_id);
    //     // Start a transaction to ensure data integrity
    //     DB::beginTransaction();
    //     try {
    //         // Retrieve the referral code from the cookie
    //         $referralCode = Cookie::get('referral');

    //         // Initialize refer_id as null
    //         $refer_id = null;

    //         // Fetch numbers from the database that are in the selected numbers list and are marked as taken
    //         $takenNumbers = Number::whereIn('number', $selectedNumbers)
    //             ->whereNotNull('reserved_at')
    //             ->pluck('number')->all(); // Use pluck to get an array of 'number' values that are taken

    //         // Calculate the difference between the selected numbers and the taken numbers
    //         $unavailableNumbers = array_intersect($selectedNumbers, $takenNumbers);

    //         // Check if there are any unavailable numbers
    //         if (!empty($unavailableNumbers)) {
    //             // Not all selected numbers are available
    //             throw new \Exception("One or more numbers are not available: " . implode(', ', $unavailableNumbers));
    //         }

    //         // Check if there are any unavailable numbers
    //         if ($this->raffleId == null) {
    //             // Not all selected numbers are available
    //             throw new \Exception("404 Raffle");
    //         }

    //         $raffle = Raffle::findOrFail($this->raffleId);
    //         $amount = count($selectedNumbers) * $raffle->price_per_number;

    //         // If a referral code exists, try to find the referring user
    //         if ($referralCode) {
    //             $referringUser = User::where('referral_code', $referralCode)->first();
    //             if ($referringUser) {
    //                 $refer_id = $referringUser->id;
    //             }
    //         }

    //         // Create an invoice for the user with the selected numbers
    //         $invoice = Invoice::create([
    //             'user_id' => Auth::id(),
    //             'raffle_id' => $this->raffleId,
    //             'amount' => $amount,
    //             'payment_method' => 'manual_payment',
    //             'refer_id' => $refer_id
    //         ]);

    //         // Mark numbers as reserved or paid and link them to the invoice
    //         foreach ($selectedNumbers as $number) {
    //             Number::create([
    //                 'user_id' => Auth::id(),
    //                 'raffle_id' => $this->raffleId,
    //                 'number' => $number,
    //                 'reserved_at' => now(), // or 'payed_at' if you're marking them as paid immediately
    //                 'invoice_id' => $invoice->id,
    //             ]);
    //         }

    //         //dd("Sucesso", $invoice->id);
    //         DB::commit();
    //         return redirect()->route('reservation-confirmation', [$invoice->id]);
    //     } catch (\Exception $e) {
    //         dd("Falha", $e->getMessage());
    //         DB::rollBack();
    //         // Handle errors, e.g., show a message to the user
    //         //$this->emit('purchaseFailed', $e->getMessage());
    //         $this->redirect('/');
    //     }
    // }


    public function changeLoginButton()
    {
        if ($this->login) {
            $this->login = false;
        } else {
            $this->login = true;
        }
    }


    /**
     * Handle an incoming authentication request.
     */
    public function loginCaller(): void
    {

        tenancyFn($this->tenant_id);

        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->isUserLoggedIn = auth()->check();
    }


    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        tenancyFn($this->tenant_id);

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->isUserLoggedIn = auth()->check();
        //$this->redirect(RouteServiceProvider::HOME, navigate: true);
    }

    public function render()
    {
        return view('livewire.buy-modal');
    }
}
