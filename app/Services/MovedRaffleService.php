<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Number;
use App\Models\Raffle;
use Illuminate\Support\Facades\DB;

class MovedRaffleService
{
    public function cloneAndDeleteRaffle($id)
    {
        DB::beginTransaction(); // Start transaction

        try {
            $originalRaffle = Raffle::find($id);
            if (!$originalRaffle) {
                DB::rollBack();
                return null;  // Or handle the error as needed
            }

            // Replicate the original raffle
            $newRaffle = $originalRaffle->replicate();
            $newRaffle->save();

            // Transfer Invoices
            $invoicesMap = [];
            $originalInvoices = Invoice::where('raffle_id', $originalRaffle->id)->get();
            foreach ($originalInvoices as $invoice) {
                $newInvoice = $invoice->replicate(['id', 'raffle_id']);  // Exclude id and raffle_id from replication
                $newInvoice->raffle_id = $newRaffle->id;
                $newInvoice->save();
                $invoicesMap[$invoice->id] = $newInvoice->id;
            }

            // Transfer Numbers
            $originalNumbers = Number::where('raffle_id', $originalRaffle->id)->get();
            foreach ($originalNumbers as $number) {
                $newNumber = $number->replicate(['id', 'raffle_id', 'invoice_id']);  // Exclude id, raffle_id, and invoice_id from replication
                $newNumber->raffle_id = $newRaffle->id;
                $newNumber->invoice_id = $invoicesMap[$number->invoice_id] ?? null;  // Map the new invoice_id, if available
                $newNumber->save();
            }

            // Delete the original raffle, numbers and invoices are deleted due to cascade
            $originalRaffle->delete();

            DB::commit(); // Commit transaction if all goes well

            return $newRaffle;  // Return the new raffle instance
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction on error
            throw $e; // Re-throw the exception for further handling
        }
    }
}
