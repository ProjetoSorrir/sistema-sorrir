<?php

namespace App\Livewire\Admin;

use App\Models\BankAccount;
use Livewire\Component;
use Livewire\WithFileUploads;

class BankAccountForm extends Component
{
    use WithFileUploads;

    public $payment_method = 'pix';
    public $pix_key;
    public $key_type;
    public $name_or_social_reason;
    public $cpf_cnpj;
    public $bank_name;
    public $bank_logo;

    public string $tenant_id;

    public function mount()
    {
        $this->tenant_id = getTenantId();
        tenancyFn($this->tenant_id);
    }

    public function submit()
    {
        tenancyFn($this->tenant_id);
        $this->validate([
            'payment_method' => 'required|string',
            'pix_key' => 'required|string',
            'key_type' => 'required|string',
            'name_or_social_reason' => 'required|string',
            'cpf_cnpj' => 'required|string',
            'bank_name' => 'required|string',
            //'bank_logo' => 'nullable|image|max:1024',
        ],[
            'payment_method.required' => 'O campo método de pagamento é obrigatório',
            'pix_key.required' => 'O campo chave PIX é obrigatório',
            'key_type.required' => 'O campo tipo de chave é obrigatório',
            'name_or_social_reason.required' => 'O campo nome ou razão social é obrigatório',
            'cpf_cnpj.required' => 'O campo CPF ou CNPJ é obrigatório',
            'bank_name.required' => 'O campo nome do banco é obrigatório',
            // 'bank_logo.image' => 'O arquivo deve ser uma imagem',
            // 'bank_logo.max' => 'O arquivo deve ter no máximo 1MB',
        ]);

         // Store the image in the public disk and get the path
         if ($this->bank_logo) {
            $logoPath = $this->bank_logo->store('bank_logos', 'public');
        }


        $account = BankAccount::create([
            'payment_method' => $this->payment_method,
            'pix_key' => $this->pix_key,
            'key_type' => $this->key_type,
            'name_or_social_reason' => $this->name_or_social_reason,
            'cpf_cnpj' => $this->cpf_cnpj,
            'bank_name' => $this->bank_name,
            'logo' => $logoPath ?? null,
        ]);

        return redirect()->route('bank-account');
    }

    public function render()
    {
        return view('livewire.admin.bank-account-form');
    }
}
