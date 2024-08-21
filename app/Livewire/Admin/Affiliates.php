<?php

namespace App\Livewire\Admin;

use App\Models\Invoice;
use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Affiliates extends Component
{
    public string $tenant_id;
    private $users;
    public $commissioning = false;
    public $commissioning_percentage;
    public $commissioningChecked;
    public $commissioning_rules;
    public $search = '';

    public $activeTab = 'tab1';
    public $totalTabs = 2;

    public $invoice_notification;
    use WithPagination;

    public function setActiveTab($tabName)
    {
        $this->activeTab = $tabName;
    }

    public function toggleCommissioning($value)
    {
        $this->commissioning = $value;
    }

    public function mount()
    {

        $this->tenant_id = getTenantId();
        tenancyFn($this->tenant_id);

        $this->commissioning = Settings::get('commissioning') ?? false;
        $this->commissioning_percentage = Settings::get('commissioning_percentage') ?? null;
        $this->commissioning_rules = Settings::get('commissioning_rules') ?? null;


        //$this->commissioningChecked = $this->commissioning ? 'checked' : '';
        if ($this->commissioning_percentage !== null) {
            $this->commissioning_percentage *= 100;
            $this->commissioning_percentage = number_format($this->commissioning_percentage);
        }
        $this->invoice_notification = Invoice::where('refer_payment_status', 'Pending')
        ->whereNotNull('payed_at')
        ->whereNotNull('invoice_path')
        ->exists();
    }

    public function commissioningSubmit()
    {
        if($this->commissioning === true){
            $this->validate([
                'commissioning_percentage' => 'required|numeric|max:100|min:0', // Máximo de 100 e mínimo de 0
                'commissioning_rules' => 'required|string|max:1000', // Máximo de 1000 caracteres
            ], [
                'commissioning_percentage.numeric' => 'O campo Porcentagem da Rifa deve ser um número.',
                'commissioning_percentage.max' => 'O valor máximo permitido para Porcentagem da Rifa é 100.',
                'commissioning_percentage.min' => 'O valor mínimo permitido para Porcentagem da Rifa é 0.',
                'commissioning_rules.max' => 'O campo Regras de Comissionamento deve ter no máximo 1000 caracteres.',
                'commissioning_percentage.required' => 'O campo Porcentagem da Rifa é obrigatório.',
                'commissioning_rules.required' => 'O campo Regras de Comissionamento é obrigatório.'
            ]);
        }


        $currentSettings = [
            'commissioning_percentage' => Settings::get('commissioning_percentage'),
            'commissioning' => Settings::get('commissioning'),
            'commissioning_rules' => Settings::get('commissioning_rules'),
        ];
        // Verifica se o comissionamento está ativado
        if ($this->commissioning) {
            Settings::set('commissioning', true); // Define como true se o comissionamento estiver marcado
        } else {
            Settings::set('commissioning', false); // Define como false se o comissionamento não estiver marcado
        }

        if (!is_null($this->commissioning_percentage)) {
            $percentage = str_replace(',', '.', $this->commissioning_percentage);
            $percentage = floatval($percentage) / 100; // Converte para float
            Settings::set('commissioning_percentage', $percentage); // Define a porcentagem de comissionamento
        }

        if (!is_null($this->commissioning_rules)) {
            Settings::set('commissioning_rules', $this->commissioning_rules); // Define a porcentagem de comissionamento
        }


        // Obtenha os novos valores dos campos de configuração após a alteração
        $newSettings = [
            'commissioning_percentage' => Settings::get('commissioning_percentage'),
            'commissioning' => Settings::get('commissioning'),
            'commissioning_rules' => Settings::get('commissioning_rules'),
        ];

        // Verifique se houve alterações nos campos
        if ($currentSettings !== $newSettings) {
            // Se houver alterações, envie a flash message
            return redirect()->route('affiliates')->with('commissioning', 'Alterações salvas com sucesso');
        } else {
            return redirect()->route('affiliates');
        }
    }

    // public function confirmPayment($id)
    // {

    //     $user = User::findOrFail($id);
    //     $user->update([
    //         'balance' => 0.00
    //     ]);
    //     if ($user->balance < 0) {
    //         $user->balance = 0;
    //         $user->save();
    //     }
    //     $invoices = Invoice::where('refer_id', $id)->whereNotNull('payed_at')->get();

    //     foreach ($invoices as $invoice) {
    //         $invoice->update([
    //             'payed_refer' => Carbon::now(),
    //             'refer_payment_status' => 'Paid']);
    //     }
    // }

    // public function revokePayment($id)
    // {

    //     $user = User::findOrFail($id);
    //     $user->update([
    //         'balance' => 0.00
    //     ]);
    //     if ($user->balance < 0) {
    //         $user->balance = 0;
    //         $user->save();
    //     }
    //     $invoices = Invoice::where('refer_id', $id)->whereNotNull('payed_at')->get();

    //     foreach ($invoices as $invoice) {
    //         $invoice->update([
    //             'payed_refer' => Carbon::now(),
    //             'refer_payment_status' => 'Canceled']);
    //     }
    // }

    public function render()
    {
        $this->tenant_id = getTenantId();
        tenancyFn($this->tenant_id);

        $query = User::where('admin', false)
            ->whereNotNull('tipoChaveRevendedor')
            ->whereNotNull('chaveRevendedor')
            ->whereHas('paidComission')
            ->withCount(['paidComission as total_refer_amout' => function ($query) {
                $query->select(DB::raw('sum(refer_amount)'));
            }])
            ->orderByDesc('total_refer_amout')

            ->search($this->search);


        $this->users = $query->paginate(10);
        return view('livewire.admin.affiliates', ['users' => $this->users]);
    }

}
