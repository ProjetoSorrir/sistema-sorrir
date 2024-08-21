<?php

namespace App\Livewire\Admin;

use App\Models\BankAccount as ModelsBankAccount;
use Livewire\Component;

class BankAccount extends Component
{
    public string $tenant_id;

    public function mount()
    {
        $this->tenant_id = getTenantId();
        tenancyFn(getTenantId());
    }

    public function deleteAccount($accountId)
    {
        tenancyFn($this->tenant_id);
        $account = ModelsBankAccount::find($accountId);
        if ($account) {
            $account->delete();
        }

        return redirect()->route('bank-account');
    }

    public function render()
    {
        tenancyFn($this->tenant_id);
        $banks = ModelsBankAccount::get();

        return view('livewire.admin.bank-account',[
            'bankAccounts' => $banks,
        ]);
    }
}
