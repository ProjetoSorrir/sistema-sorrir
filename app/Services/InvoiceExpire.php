<?php

namespace App\Services;

use App\Helpers\WebhookHelper;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class InvoiceExpire
{
    public function handle()
    {
        try {
            // Buscar todos os tenants
            $tenants = get_tenants();

            foreach ($tenants as $tenant) {
                tenancyFn($tenant->id);

                // Para cada tenant, buscar as faturas onde payment_voucher_path ou invoice_path estão vazios
                $invoices = Invoice::where(function ($query) {
                        $query->whereNull('payment_voucher_path')
                            ->orWhere('payment_voucher_path', '',)
                            ->orWhereNull('invoice_path')
                            ->orWhere('invoice_path', '',);
                    })
                    ->get();

                // Aqui você pode executar a lógica para expirar essas faturas
                // Por exemplo, marcar as faturas como expiradas
                foreach ($invoices as $invoice) {
                    // Verifica a data de criação da fatura
                    $startDate = Carbon::parse($invoice->created_at);

                    // Calcula a data/hora final com base no tipo de tempo e valor definidos em Raffle
                    $endDate = clone $startDate;
                    $endDate->addMinutes($invoice->raffle->pending_reservation_limit_value);

                    // Verifica se a data/hora atual é maior que a data/hora final
                    if (Carbon::now()->gt($endDate)) {
                        // Marca a fatura como expirada (exemplo: deleta)
                        $invoice->delete();
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // Logar o erro
            Log::error($e->getMessage());
            echo $e->getMessage();
        }
    }
}
