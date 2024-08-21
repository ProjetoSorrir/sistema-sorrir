<?php

namespace App\Jobs;

use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConfirmPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $invoiceId;
    private $invoice;

    /**
     * Create a new job instance.
     */
    public function __construct(int $invoiceId)
    {
        $this->invoice = Invoice::findOrFail($invoiceId);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $invoiceService = new InvoiceService($this->invoice);
        $invoiceService->confirmInvoicePayment();
    }
}
