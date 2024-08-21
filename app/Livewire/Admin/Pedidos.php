<?php

namespace App\Livewire\Admin;

use App\Models\Invoice;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Pedidos extends Component
{
    public string $tenant_id;
    public $search = '';
    public $numberFilter = '';
    public $searchClient = '';

    public function mount()
    {
        $this->tenant_id = getTenantId();
        tenancyFn($this->tenant_id);
    }

    public function markAsPaid($invoiceId)
    {
        tenancyFn($this->tenant_id);
        $invoice = Invoice::find($invoiceId);

        if ($invoice->invoice_path) {
            session()->flash('message', 'This invoice is already marked as paid.');
            return;
        }

        // // Generate receipt content
        // $pdfContent = PDF::loadView('receipts.invoice', ['invoice' => $invoice])->output();
        // $receiptName = 'receipt-' . Str::uuid() . '-' . $invoiceId . '.pdf';

        // // Use Storage facade to save the PDF
        // Storage::disk('public')->put('invoices/' . $receiptName, $pdfContent);

        $pdfContent = PDF::loadView('receipts.invoice', ['invoice' => $invoice])->output();
        $receiptName = 'receipt-' . Str::uuid() . '-' . $invoiceId . '.pdf';

        // SALVAR EM S3
        try {
            Storage::disk('s3')->put('invoices/' . $receiptName, $pdfContent, 'public');

            $s3Url = Storage::disk('s3')->url('invoices/' . $receiptName);

            $invoice->update([
                'invoice_path' => $s3Url,
                'payed_at' => Carbon::now(),
                'payment_voucher_path' => $invoice->payment_voucher_path ?: 'baixa_manual',
            ]);
        } catch (\Exception $e) {
            // Registrar o erro no log
            Log::error('Erro ao salvar o PDF no S3: ' . $e->getMessage());
            return redirect()->route('pedidos')->with('alertMessage', 'Por favor, tente novamente mais tarde.');
        }


        if (!is_null($invoice->refer_id) && !($invoice->payed_at)) {
            $referrer = User::find($invoice->refer_id);
            if ($referrer && (getCommissioning())) {
                $commissioning_percentage = 0;
                $commissioning_percentage = floatval(getCommissioningPercentage());
                $creditAmount = bcmul($invoice->amount, $commissioning_percentage, 2); // Calculate according to the admin percentage
                $referrer->balance += $creditAmount; // Assume you have a balance column
                $referrer->save();

                $invoice->update([
                    'refer_amount' => $creditAmount,
                    'refer_percentage' => $commissioning_percentage,
                    'refer_payment_status' => 'Pending'
                ]);
                // Optionally, you might want to add a record to a ledger or transaction history table here.
            }
        }


        //COMENTADO DEVIDO AO USO DO S3 PARA ARMAZENAR E FAZER O UPDATE DA INVOICE
        // $invoice->update([
        //     'invoice_path' => 'invoices/' . $receiptName,
        //     'payed_at' => now(),
        //     'payment_voucher_path' => $invoice->payment_voucher_path ?: 'baixa_manual',
        // ]);

        session()->flash('message', '');
        return redirect()->route('pedidos');
    }

    public function revokePayment($invoiceId)
    {
        tenancyFn($this->tenant_id);
        $invoice = Invoice::find($invoiceId);

        // if (!$invoice->invoice_path) {
        //     session()->flash('message', 'This invoice is not marked as paid.');
        //     return;
        // }

        // Delete the receipt
        if ($invoice->invoice_path) {
            Storage::disk('public')->delete($invoice->invoice_path);
        }

        if ($invoice->payment_voucher_path) {
            Storage::disk('public')->delete($invoice->payment_voucher_path);
        }
        // Check if refer_id is not null and remove credit from the referrer's balance
        if (!is_null($invoice->refer_id) && !is_null($invoice->payed_at)) {
            $referrer = User::find($invoice->refer_id);
            if ($referrer && (getCommissioning())) {
                $commissioning_percentage = 0;
                $commissioning_percentage = floatval(getCommissioningPercentage());
                $creditAmount = bcmul($invoice->amount, $commissioning_percentage, 2);
                $referrer->balance -= $creditAmount;
                $referrer->save();

                if ($referrer->balance < 0) {
                    $referrer->balance = 0;
                    $referrer->save();
                }
                $invoice->update([
                    'refer_payment_status' => 'Canceled'
                ]);
                // Optionally, you might want to add a record to a ledger or transaction history table here.
            }
        }

        $invoice->update([
            'payed_at' => null, // Set to null to indicate that it's not paid
            'invoice_path' => null,
            'payment_voucher_path' => null,
        ]);



        session()->flash('message', 'Payment revoked and receipt deleted.');
        return redirect()->route('pedidos');
    }


    public function render()
    {
        tenancyFn($this->tenant_id);
        return view('livewire.admin.pedidos', [
            'invoices' => Invoice::with(['raffle', 'user', 'numbers'])
                ->when($this->search, function ($query, $search) {
                    $query->whereHas('raffle', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
                })
                ->when($this->searchClient, function ($query, $searchClient) {
                    $query->whereHas('user', function ($q) use ($searchClient) {
                        $q->where('name', 'like', '%' . $searchClient . '%');
                    });
                })
                ->when($this->numberFilter, function ($query, $number) {
                    $query->where('id', $number)
                        ->orWhereHas('user', function ($subQuery) use ($number) {
                            $subQuery->where('name', 'like', '%' . $number . '%')
                                    ->orWhere('cpf', 'like', '%' . $number . '%')
                                    ->orWhere('phone', 'like', '%' . $number . '%')
                                    ->orWhere('email', 'like', '%' . $number . '%');
                        });
            })
                ->orderBy('created_at', 'desc')
                ->paginate(15),
            'totalRifas' => Invoice::sum('amount'),
            'totalAReceber' => Invoice::whereNull('payed_at')->whereNull('payment_voucher_path')->whereNull('invoice_path')->sum('amount'),
            'totalPagos' => Invoice::whereNotNull('payed_at')->whereNotNull('invoice_path')->sum('amount'),
        ]);
    }
}
