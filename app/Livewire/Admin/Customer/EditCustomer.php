<?php

namespace App\Livewire\Admin\Customer;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditCustomer extends Component
{
    public $userId;
    public string $tenant_id;
    public $nome, $email, $telefone, $senha;

    public function mount($userId)
    {

        $this->userId = $userId;
        $this->tenant_id = getTenantId();
        tenancyFn($this->tenant_id);
        $user = User::findOrFail($this->userId);

        // Preencha as propriedades com os dados do usuário
        $this->nome = $user->name ?? '';
        $this->email = $user->email ?? '';
        $this->telefone = $user->phone ?? '';
    }

    public function salvarNome()
    {
        tenancyFn($this->tenant_id);
        $this->validate([
            'nome' => 'required|string|max:255',
        ]);
        $user = User::findOrFail($this->userId);
        $user->name = $this->nome;
        $user->save();

        session()->flash('message', 'Nome atualizado com sucesso!');
    }

    public function salvarEmail()
    {
        tenancyFn($this->tenant_id);
        $this->validate([
            'email' => 'required|email|max:255|unique:users,email,' . $this->userId,
        ]);

        $user = User::findOrFail($this->userId);
        $user->email = $this->email;
        $user->save();

        session()->flash('message', 'Email atualizado com sucesso!');
    }

    public function salvarTelefone()
    {
        tenancyFn($this->tenant_id);
        $this->validate([
            'telefone' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($this->userId);
        $user->phone = $this->telefone;
        $user->save();

        session()->flash('message', 'Telefone atualizado com sucesso!');
    }

    public function salvarSenha()
    {
        tenancyFn($this->tenant_id);
        $this->validate([
            'senha' => 'required|string|min:8',
        ]);

        $user = User::findOrFail($this->userId);
        $user->password = Hash::make($this->senha);
        $user->save();

        session()->flash('message', 'Senha atualizada com sucesso!');
    }

    public function render()
    {
        return view('livewire.admin.customer.edit-customer');
    }
}
