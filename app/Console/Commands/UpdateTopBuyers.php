<?php

namespace App\Console\Commands;

use App\Models\TopBuyer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateTopBuyers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:top-buyers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the top buyers table every 10 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the list of raffles
        $raffles = DB::table('raffles')->pluck('id');

        foreach ($raffles as $raffleId) {
            // Get the top 3 buyers for the raffle with the total count of their paid numbers
            $topBuyers = DB::table('numbers')
                ->join('invoices', 'numbers.invoice_id', '=', 'invoices.id')
                ->select('numbers.user_id', DB::raw('count(numbers.id) as total'))
                ->where(function ($query) {
                    $query->whereNotNull('invoices.payment_voucher_path')
                        ->orWhereNotNull('invoices.invoice_path');
                })
                ->where('numbers.raffle_id', $raffleId)
                ->groupBy('numbers.user_id')
                ->orderBy('total', 'desc')
                ->limit(3)
                ->get();

            // Clear existing top buyers for this raffle
            TopBuyer::where('raffle_id', $raffleId)->delete();

            // Insert the new top buyers
            foreach ($topBuyers as $buyer) {
                TopBuyer::create([
                    'raffle_id' => $raffleId,
                    'user_id' => $buyer->user_id,
                    'total_numbers' => $buyer->total,
                ]);
            }
        }

        $this->info('Top buyers updated successfully.');
    }
}
