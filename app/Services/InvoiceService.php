<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Number;
use App\Models\Raffle;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InvoiceService
{
    private $numbersFromInvoice;
    private Invoice $invoice;
    private Raffle $raffle;
    private User $user;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->raffle = $invoice->raffle()->first();
        $this->user = $invoice->user()->first();

    }

    public static function create(User $user, Raffle $raffle, int $qty, $aceptedTerms, $referralCode)
    {
        $refer_id = null;
        if ($referralCode) {
            $referringUser = User::select("id")->where('referral_code', $referralCode)->first();
            if (isset($referringUser['id']) && $referringUser['id'] <> $user->id) {
                $refer_id = $referringUser['id'];
            }
        }

        if ($qty > $raffle->max_number_purchase) {
            throw new \Exception('O limite máximo de compra são ' . $raffle->max_number_purchase . ' títulos!');
        }
        $amount = $qty * $raffle->price_per_number;

        return Invoice::create([
            'user_id' => $user->id,
            'raffle_id' => $raffle->id,
            'amount' => $amount,
            'payment_method' => 'manual_payment',
            'refer_id' => $refer_id,
            'accept_terms' => $aceptedTerms,
            'number_qty' => $qty
        ]);
    }

    private function getSelectedNumbers(int $qty)
    {
        $raffle = $this->raffle;
        $bignumberService = new BigNumbersService();
        $reservedNumbersForBig = $raffle->numbers()->pluck('number')->all();
        $numbers = $bignumberService->getRandomNumbers($raffle->getTotalNumbers(), $reservedNumbersForBig, $qty);
        return array_map(function ($number) {
            return $number - 1;
        }, $numbers["generated_tickets"]);

    }

    private function reserveNumbers()
    {
        $invoice = $this->invoice;
        $raffle = $this->raffle;
        $qty = $invoice->number_qty;
        $selectedNumbers = $this->getSelectedNumbers($qty);
        $insertData = array_map(function ($number) use ($raffle, $invoice) {
            return [
                'user_id' => $invoice->user_id,
                'raffle_id' => $raffle->id,
                'number' => $number,
                'reserved_at' => now(),
                'invoice_id' => $invoice->id,
            ];
        }, $selectedNumbers);
        $chunkSize = 2000;
        foreach (array_chunk($insertData, $chunkSize) as $chunk) {
            Number::insert($chunk);
        }

    }

    private function saveReceipt()
    {
        // Generate receipt content
        $pdfContent = PDF::loadView('receipts.invoice', ['invoice' => $this->invoice])->output();
        $invoiceId = $this->invoice->id;
        $receiptName = 'receipt-' . Str::uuid() . '-' . $invoiceId . '.pdf';
        try {
            Storage::disk('s3')->put('invoices/' . $receiptName, $pdfContent, 'public');
            $s3Url = Storage::disk('s3')->url('invoices/' . $receiptName);
            $this->invoice->invoice_path = $s3Url;
            $this->invoice->saveOrFail();
        } catch (\Exception $e) {
            Log::error('Erro ao salvar o PDF no S3: ' . $e->getMessage());
            return redirect()->route('my-buys')->with('alertMessage', 'Por favor, tente novamente mais tarde.');
        }
    }

    public function confirmInvoicePayment()
    {
        try {
            DB::beginTransaction();
            if ($this->invoice->invoice_path || !is_null($this->invoice->payed_at)) {
                throw new \Exception("Invoice already paid.");
            }
            $raffle = $this->raffle;
            $user = $this->user;
            $this->reserveNumbers();
            $this->payInvoiceBonus();
            $this->numbersFromInvoice = $this->invoice->numbers->pluck('number')->toArray();

            $this->invoice->payment_voucher_path = 'mercado_pago';
            $this->invoice->payed_at = Carbon::now();
            $this->invoice->invoice_path = 'invoices/' . Str::uuid() . '.needforspeed';
            $this->invoice->saveOrFail();
            $this->invoice->premier_numbers = $this->premierNumbers();
            $this->invoice->saveOrFail();
            DB::commit();
            // Data for the webhook
            return [
                "Nome" => $user->name,
                "email" => $user->email,
                "telefone" => $user->phone,
                "qtd_titulos" => $this->invoice->getNumberQty(),
                "valor_total" => $this->invoice->amount,
                "data_pagamento" => $this->invoice->payed_at->format('M d, Y h:i a'),
                "sorteio" => $raffle->name,
                "user_id" => $user->id,
                "dt_nascimento" => $user->birth_date,
                "Origen" => 'Compra de Título - Pagamento Realizado'
            ];

        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception($exception->getMessage(), $exception->getCode(), $exception);
        }

    }

    private function payInvoiceBonus()
    {
        $invoice = $this->invoice;
        $commissioning_percentage = floatval(getCommissioningPercentage());
        if (!is_null($invoice->refer_id) && $commissioning_percentage > 0) {
            $referrer = User::where("id", $invoice->refer_id)->first();
            if ($referrer) {
                $creditAmount = bcmul($invoice->amount, $commissioning_percentage, 2); //Calculate according to admin percentage
                $referrer->balance += $creditAmount;
                $referrer->saveOrFail();

                $this->invoice->refer_amount = $creditAmount;
                $this->invoice->refer_percentage = $commissioning_percentage;
                $this->invoice->refer_payment_status = 'Pending';
                $this->invoice->saveOrFail();

            }
        }
        return $this->invoice;
    }

    public function premierNumbers()
    {
        $raffle = $this->raffle;
        $premierNumbers = [];

        for ($i = 1; $i <= 30; $i++) {
            $propertyName = "premier_number_$i";
            $premierNumber = $raffle->$propertyName ?? null;

            $propertyNameEnabled = "premier_number_enabled_$i";
            $premierNumberEnabled = $raffle->$propertyNameEnabled ?? null;

            $propertyNameEnabledDate = "premier_number_enable_date_$i";
            $premierNumberEnabledDate = $raffle->$propertyNameEnabledDate ?? null;
            $someDate = Carbon::parse($premierNumberEnabledDate);
            if (!is_null($premierNumber)) {
                if ($premierNumberEnabled || now()->subHours(3)->isAfter($someDate)) {
                    array_push($premierNumbers, $premierNumber);
                }
            }
        }
        $numberFromInvoice = $this->numbersFromInvoice;
        $commonValues = array_intersect($premierNumbers, $numberFromInvoice);
        if (count($commonValues) == 0) {
            return null;
        }
        return implode(", ", $commonValues);

    }
}
