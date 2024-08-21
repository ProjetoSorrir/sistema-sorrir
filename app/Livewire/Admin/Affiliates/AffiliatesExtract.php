<?php

namespace App\Livewire\Admin\Affiliates;

use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Livewire;
use Livewire\WithPagination;

class AffiliatesExtract extends Component
{
    use WithPagination;


    public $tenant_id;
    public $search;
    public $start_date;
    public $end_date;
    private $invoices;
    public function mount()
    {
        $this->tenant_id = getTenantId();
        tenancyFn($this->tenant_id);
    }
    public function confirmPayment($id)
    {
        $invoice = Invoice::findOrFail($id);

        if ($invoice && $invoice->refer_payment_status !== 'Paid') {
            $user = $invoice->referredUser;

            $newBalance = bcsub($user->balance, $invoice->refer_amount, 2);
            $user->update(['balance' => $newBalance]);

            if ($user->balance < 0) {
                $user->balance = 0;
                $user->save();
            }
            // Atualize a fatura para marcar como paga
            $invoice->update([
                'payed_refer' => Carbon::now(),
                'refer_payment_status' => 'Paid'
            ]);
            $affiliates = new \App\Livewire\Admin\Affiliates();

            $tabName = 'tab2';
            $affiliates->setActiveTab($tabName);
            session()->flash('message_confirmPayment', 'Pagamento confirmado com sucesso!');
        }
    }

    public function revokePayment($id)
    {

        $invoice = Invoice::findOrFail($id);


        if ($invoice && $invoice->refer_payment_status !== 'Canceled') {
            $user = $invoice->referredUser;

            $newBalance = bcsub($user->balance, $invoice->refer_amount, 2);

            $user->update(['balance' => $newBalance]);


            if ($user->balance < 0) {
                $user->balance = 0;
                $user->save();
            }
            // Atualize a fatura para marcar como paga
            $invoice->update([
                'payed_refer' => null,
                'refer_payment_status' => 'Canceled'
            ]);
            $affiliates = new \App\Livewire\Admin\Affiliates();
            $tabName = 'tab2';
            $affiliates->setActiveTab($tabName);
            session()->flash('message_revokePayment', 'Pagamento cancelado com sucesso!');
        }
    }

    public function clearFilters()
    {

        $this->search = '';
        $this->start_date = null;
        $this->end_date = null;


    }

    public function render()
    {
        tenancyFn($this->tenant_id);

        $query = Invoice::orderByDesc('created_at')
        ->whereNotNull('refer_id')
        ->whereHas('user', function ($query) {
            $query->where('admin', false);
        });

        if ($this->start_date && $this->end_date) {

            $start_date = Carbon::createFromFormat('Y-m-d', $this->start_date)->setTimezone('UTC');
            $end_date = Carbon::createFromFormat('Y-m-d', $this->end_date)->addDay()->setTimezone('UTC');

            $query->whereBetween('created_at', [$start_date, $end_date]);
        }


        if ($this->search) {
            $query->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhereHas('referredUser', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');
                    });
            });
        }

        $this->invoices = $query->paginate(10);
        return view('livewire.admin.affiliates.affiliates-extract', ['invoices' => $this->invoices]);
    }
}
