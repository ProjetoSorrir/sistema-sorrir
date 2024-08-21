<?php

namespace App\Livewire;

use App\Models\BankAccount;
use App\Models\Invoice;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class ReservationConfirmation extends Component
{
    use WithFileUploads;

    public string $tenant_id;
    public $invoiceId;
    public $client;

    public $paymentVoucher;

    public $qrCode, $qrCodeBase64;

    public $amount;

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


    public function mount($id)
    {
        $this->invoiceId = $id;
        $this->tenant_id = getTenantId();
        tenancyFn(getTenantId());
        $invoice = Invoice::findOrFail($this->invoiceId);

    }

    public function uploadPaymentVoucher()
    {
        //dd("Chegou aqui");
        tenancyFn($this->tenant_id);
        $this->validate(
            [
                'paymentVoucher' => 'mimes:jpeg,png,gif,pdf|max:2048', // 2MB Max
            ],
            [
                'paymentVoucher.mimes' => 'O arquivo deve ser uma imagem (JPEG, PNG, GIF) ou um PDF',
                'paymentVoucher.max' => 'O arquivo deve ter no máximo 2MB',
            ]
        );

        // Define a unique file name
        $fileName = 'payment_vouchers/' . uniqid() . '.' . $this->paymentVoucher->getClientOriginalExtension();

        // Save the file to the public storage
        $this->paymentVoucher->storeAs('public', $fileName);

        // Retrieve the invoice and update the payment_voucher_path attribute
        $invoice = Invoice::find($this->invoiceId);
        $invoice->payment_voucher_path = $fileName;
        $invoice->payed_at = Carbon::now();
        $invoice->save();

        // Provide feedback to the user
        session()->flash('message', 'Comprovante enviado com sucesso.');

        // Reset the file upload input
        $this->paymentVoucher = null;

        return redirect()->route('my-buys');
    }

    public function generatePixPayment($amount, $invoice)
    {

        if (is_null(Settings::get('mercado_pago_token'))) return;
        // Step 2: Set production or sandbox access token
        MercadoPagoConfig::setAccessToken(Settings::get('mercado_pago_token'));
        // Step 2.1 (optional - default is SERVER): Set your runtime enviroment from MercadoPagoConfig::RUNTIME_ENVIROMENTS
        // In case you want to test in your local machine first, set runtime enviroment to LOCAL
        //MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

        // Step 3: Initialize the API client
        $client = new PaymentClient();

        try {

            // Step 4: Create the request array
            $request = [
                "transaction_amount" => floatval($amount),
                "description" => "We Prêmios - Prêmio 500K",
                "payment_method_id" => "pix",
                'notification_url' => url('/webhook/mercadopago'),
                "payer" => [
                    "email" => auth()->user()->email,
                ]
            ];
            // Log the request for debugging purposes
            Log::info('Generating PIX payment request', ['request' => $request]);

            // Step 5: Create the request options, setting X-Idempotency-Key
            // $request_options = new RequestOptions();
            // $request_options->setCustomHeaders(["X-Idempotency-Key: " . $invoice->id]);
            // Step 6: Make the request
            $request_options = new RequestOptions();
            $request_options->setCustomHeaders(["X-Idempotency-Key: " . $invoice->id]);

            $payment = $client->create($request, $request_options);

            // Log the response for debugging purposes
            Log::info('PIX payment response', ['response' => $payment]);

            // Check if the response contains the necessary data
            if (isset($payment->point_of_interaction->transaction_data->qr_code) &&
                isset($payment->point_of_interaction->transaction_data->qr_code_base64)) {

                $this->qrCode = $payment->point_of_interaction->transaction_data->qr_code;
                $this->qrCodeBase64 = $payment->point_of_interaction->transaction_data->qr_code_base64;

                $invoice->mercado_livre_id = $payment->id;
                $invoice->save();
            } else {
                throw new \Exception('Missing QR code data in payment response');
            }
        } catch (MPApiException $e) {
            Log::error('Mercado Pago API exception', [
                'status_code' => $e->getApiResponse()->getStatusCode(),
                'content' => $e->getApiResponse()->getContent()
            ]);
        } catch (\Exception $e) {
            Log::error('General exception', ['message' => $e->getMessage()]);
        }
    }


    public function checkPaymentStatus()
    {
        tenancyFn($this->tenant_id);
        $invoice = Invoice::findOrFail($this->invoiceId);
        if (!is_null($invoice->invoice_path)) {
            $premier_numbers = explode(", ", $invoice->premier_numbers);
            if (count($premier_numbers) >= 1 && !is_null($invoice->premier_numbers)) {
                return redirect()->route('raffle-premier-win', [$invoice->premier_numbers]);
            } else {
                session()->flash('message', 'Invoice marked as paid and receipt generated.');
                return redirect()->route('my-buys');
            }

        } /*elseif ($paymentId && is_null($invoice->job_started_at)) {
            $status = (new \App\Services\MercadoPagoService())->checkPaymentStatus($paymentId);
            if ($status->status == 'approved') {
                $invoice->dispatchPaymentJob();
            }
        }*/
    }

    public function isInvoiceOlderThan30Minutes($invoice)
    {
        return $invoice->created_at->lt(Carbon::now()->subMinutes(30));
    }

    public function render()
    {
        tenancyFn($this->tenant_id);
        $invoice = Invoice::findOrFail($this->invoiceId);

        if ($invoice->user->id != auth()->user()->id) {
            throw new \Exception("404 User");
        }
        $this->amount = $invoice->amount;
        // Converted for cents
        $this->generatePixPayment($this->amount, $invoice);

        // Verifica se a fatura foi criada há mais de 30 minutos
        $isOlderThan30Minutes = $this->isInvoiceOlderThan30Minutes($invoice);

        // Get the created_at date of the invoice
        $startDate = Carbon::parse($invoice->created_at);
        $endDate = clone $startDate; // Clone to not mutate the original date
        $endDate->addMinutes($invoice->raffle->pending_reservation_limit_value);
        $remainingSeconds = Carbon::now()->diffInSeconds($endDate, false);

        $bankAccounts = BankAccount::all();

        return view('livewire.reservation-confirmation', [
            'invoice' => $invoice,
            'raffle' => $invoice->raffle,
            'endDate' => $endDate, // The calculated end date
            'remainingSeconds' => $remainingSeconds, // Remaining time in seconds
            'bankAccounts' => $bankAccounts,
            'bankAccount' => BankAccount::find($invoice->raffle->bank_account_id),
            'isOlderThan30Minutes' => $isOlderThan30Minutes // Pass the result to the view
        ]);
    }


}
