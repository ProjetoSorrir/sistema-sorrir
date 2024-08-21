<?php

namespace App\Livewire\Site;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class ReferDash extends Component
{
    use WithPagination;

    public $host;
    public $tipoChaveRevendedor = '';
    public $chaveRevendedor = '';

    public string $tenant_id;
    public $balance;

    public $totalComissoes = 0;
    public $comissaoAtual = 0;
    public $commissioning_percentage_formated = 0;
    public $commissioning_percentage = 0;

    public $update = false;

    public function mount()
    {
        $this->tenant_id = getTenantId();
        tenancyFn(getTenantId());
        $this->host = request()->getHost();

        $this->commissioning_percentage_formated = floatval(getCommissioningPercentage() * 100);

        $this->commissioning_percentage = floatval(getCommissioningPercentage());

        $this->comissaoAtual = Invoice::whereHas('user', function ($query) {
            $query->where('admin', false);
        })
            ->where('refer_id', auth()->id())
            ->whereNotNull('payed_at')
            ->where('refer_payment_status', 'Paid')
            ->sum('refer_amount');

        $this->totalComissoes = Invoice::whereHas('user', function ($query) {
            $query->where('admin', false);
        })
            ->where('refer_id', auth()->id())
            ->where('refer_payment_status', 'Pending')
            ->whereNotNull('payed_at')
            ->whereNotNull('invoice_path')
            ->sum('refer_amount');


        $user = auth()->user();
        $this->tipoChaveRevendedor = $user->tipoChaveRevendedor;
        $this->chaveRevendedor = $user->chaveRevendedor;
        $this->balance = $user->balance;
    }

    public function updatePixKey()
    {
        tenancyFn($this->tenant_id);
        $this->validate([
            'tipoChaveRevendedor' => 'required|in:CPF/CNPJ,CELULAR,EMAIL,ALEATORIA',
            'chaveRevendedor' => 'required',
        ], [
            'tipoChaveRevendedor.required' => 'O campo tipo de chave PIX é obrigatório.',
            'chaveRevendedor.required' => 'O campo chave PIX é obrigatório.',
        ]);


        switch ($this->tipoChaveRevendedor) {
            case 'CPF/CNPJ':
                if (!$this->validateCpfCnpj($this->chaveRevendedor)) {
                    $this->addError('chaveRevendedor', 'CPF/CNPJ inválido');
                }
                break;
            case 'CELULAR':
                if (!$this->validateCelular($this->chaveRevendedor)) {
                    $this->addError('chaveRevendedor', 'Celular inválido');
                }
                break;
            case 'EMAIL':
                if (!$this->validateEmail($this->chaveRevendedor)) {
                    $this->addError('chaveRevendedor', 'E-mail inválido');
                }
                break;
            case 'ALEATORIA':
                if (!$this->validateChaveAleatoria($this->chaveRevendedor)) {
                    $this->addError('chaveRevendedor', 'Chave Aleatória inválida');
                }
                break;
            default:
                $this->addError('tipoChaveRevendedor', 'Tipo de chave inválido');
                break;
        }

        // Verifica se há erros de validação
        if ($this->getErrorBag()->isEmpty()) {
            // Atualiza os dados do usuário
            $user = auth()->user();

            // Verifica se houve uma modificação
            if (
                $user->tipoChaveRevendedor !== $this->tipoChaveRevendedor ||
                $user->chaveRevendedor !== $this->chaveRevendedor
            ) {
                $user->update([
                    'tipoChaveRevendedor' => $this->tipoChaveRevendedor,
                    'chaveRevendedor' => $this->chaveRevendedor,
                ]);
                $this->update = true;
                // Reseta os campos após a atualização
                $this->reset(['tipoChaveRevendedor', 'chaveRevendedor']);

                // Redireciona para a página refer-dash e envia a flash message
                return redirect()->route('refer-dash')->with('updated-pix', 'Chave PIX atualizada com sucesso.');
            }
        }else{
        }
    }

    private function validateCpfCnpj($value)
    {
        //true se o valor contém 11 ou 14 dígitos numéricos.
        return strlen($value) === 11 || strlen($value) === 14;
    }

    private function validateCelular($value)
    {
        //true se o valor contém 11 dígitos numéricos.
        return preg_match('/^\d{11}$/', $value);
    }

    private function validateEmail($value)
    {
        //função filter_var do PHP para validar o e-mail
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function validateChaveAleatoria($value)
    {
        // Verifica se a chave possui exatamente 32 caracteres alfanuméricos
        return preg_match('/^[a-zA-Z0-9]{32}$/', $value);
    }

    public function render()
    {
        $invoices = Invoice::where('refer_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->whereHas('user', function ($query) {
                $query->where('admin', false);
            })
            ->paginate(10);
        return view('livewire.site.refer-dash', [
            'invoices' => $invoices
        ]);
    }
}
