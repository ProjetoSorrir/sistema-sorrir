<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use App\Services\MercadoPagoService;
use App\Livewire\ReservationConfirmation;

class ApprovePendingPayments extends Command
{
    protected $signature = 'payments:approve';

    protected $description = 'Approve pending payments';

    public function handle()
    {
        $this->info('Starting payment approval process.');

        $invoices = Invoice::whereNull('payed_at')->get();
        $approvedCount = 0;

        foreach ($invoices as $invoice) {
            $paymentId = $invoice->mercado_livre_id;

            if ($paymentId) {
                $this->info("Checking payment status for Invoice ID: $invoice->id");

                $status = (new MercadoPagoService())->checkPaymentStatus($paymentId);

                if ($status->status == 'approved') {
                    ReservationConfirmation::markAsPaid($invoice->id);
                    $approvedCount++;
                    $this->info("Invoice ID: $invoice->id - Payment approved.");
                } else {
                    $this->info("Invoice ID: $invoice->id - Payment not approved.");
                }
            } else {
                $this->info("Invoice ID: $invoice->id - No payment ID found.");
            }

            // Pausa de 500ms
            usleep(500000);
        }

        $this->info("Process completed. $approvedCount payments approved.");
    }
}
