<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;
use Str;

class CheckPendingPayments extends Command
{
    protected $signature = 'check-pending-payments';
    protected $description = 'Check and process pending payments';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            // Log the start of the pending payments check
            $this->info("Iniciando verificação de pagamentos pendentes...");

            // Get all unpaid invoices created in the last 30 minutes
            $invoices = Invoice::whereNull('payed_at')
                ->where('created_at', '>=', Carbon::now()->subMinutes(30))
                ->get();

            foreach ($invoices as $invoice) {
                // Log the current invoice being checked
                $this->info("Verificando fatura pendente: " . $invoice->id);
                $paymentId = $invoice->mercado_livre_id;

                if ($paymentId) {
                    MercadoPagoConfig::setAccessToken(Settings::get('mercado_pago_token'));

                    $status = $this->checkPaymentStatus($paymentId);

                    // Log the return of the checkPaymentStatus() method
                    Log::info('Retorno do checkPaymentStatus para fatura ' . $invoice->id . ': ' . json_encode($status));

                    if ($status->status == 'approved') {
                        $this->info("Pagamento aprovado para a fatura pendente: " . $invoice->id);
                        $invoice->dispatchPaymentJob();
                    }
                }
            }

            // Log the end of the pending payments check
            $this->info("Verificação de pagamentos pendentes concluída.");
        } catch (\Exception $e) {
            // Log any unexpected exceptions
            $this->error("Erro ao verificar pagamentos pendentes: " . $e->getMessage());
        }
    }

    public function checkPaymentStatus($paymentId)
    {
        $client = new PaymentClient();
        return $client->get($paymentId);
    }

    public function markAsPaid($invoice)
    {
        if ($invoice->invoice_path) {
            return false;
        }

        // Generate receipt content (example commented out)
        // $pdfContent = PDF::loadView('receipts.invoice', ['invoice' => $invoice])->output();
        // $receiptName = 'receipt-' . Str::uuid() . '-' . $invoice->id . '.pdf';

        // Use Storage facade to save the PDF (example commented out)
        // Storage::disk('public')->put('invoices/' . $receiptName, $pdfContent);

        $invoice->update([
            'payment_voucher_path' => 'mercado_pago',
            'payed_at' => Carbon::now(),
            'invoice_path' => 'invoices/' . Str::uuid() . '.needforspeed',
        ]);

        // Check if refer_id is not null and credit percent to the referrer's balance
        if (!is_null($invoice->refer_id)) {
            $referrer = User::find($invoice->refer_id);
            if ($referrer) {
                $commissioning_percentage = floatval(getCommissioningPercentage());
                $creditAmount = bcmul($invoice->amount, $commissioning_percentage, 2); //Calculate according to admin percentage
                $referrer->balance += $creditAmount;
                $referrer->save();

                $invoice->update([
                    'refer_amount' => $creditAmount,
                    'refer_percentage' => $commissioning_percentage,
                    'refer_payment_status' => 'Pending'
                ]);
                // Optionally, you might want to add a record to a ledger or transaction history table here.
            }
        }

        // Data for the webhook
        $data = [
            "Nome" => $invoice->user->name,
            "email" => $invoice->user->email,
            "telefone" => $invoice->user->phone,
            "qtd_titulos" => $invoice->getNumberQty(),
            "valor_total" => $invoice->amount,
            "data_pagamento" => $invoice->payed_at->format('M d, Y h:i a'),
            "sorteio" => $invoice->raffle->name,
            "user_id" => $invoice->user->id,
            "dt_nascimento" => $invoice->user->birth_date,
            "Origen" => 'Compra de Título - Pagamento Realizado'
        ];

        // Call the helper to send the webhook (example commented out)
        // $webhookUrl = 'https://growthphantom.app.n8n.cloud/webhook/cf299562-6071-450d-945a-edb2588ba3cf';
        // WebhookHelper::sendWebhook($webhookUrl, $data);

        // Log the request for debugging purposes
        Log::info('Send Webhook to n8n MERCADO PAGO SERVICE markAsPaid -  ==> BRASCAP', ['data' => $data]);

        return true;
    }
}
