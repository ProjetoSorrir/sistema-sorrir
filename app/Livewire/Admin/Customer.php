<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Customer extends Component
{
    public string $tenant_id;
    public  $name = '';
    public  $email = '';
    public  $phone = '';
    public  $password = '';
    public $currentCustomerId = null;
    public $ddi = '';

    public string $search = '';
    public bool $editing = false;
    public $all_customers;
    //public $users;

    public function mount()
    {
        $this->tenant_id = getTenantId();
        tenancyFn($this->tenant_id);
        $this->all_customers = User::select('id')->get();
        //$this->users = User::where('admin', false)->get();
    }

    public function submit()
    {
        tenancyFn($this->tenant_id);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:9','max:15', Rule::unique(User::class)->ignore($this->currentCustomerId)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['string', 'min:8', 'max:20'],
            'ddi' => ['required','string', 'min:1', 'max:5'],
        ];

        // If it's an update, exclude the current email from unique validation
        if ($this->currentCustomerId) {
            $rules['email'][] = Rule::unique('users')->ignore($this->currentCustomerId);
        } else {
            $rules['email'][] = Rule::unique('users');
        }

        $this->validate($rules, [
            'phone.regex' => 'O número de telefone deve estar em um formato válido.',
            'phone.required' => 'O Whatsapp é obrigatório.',
            'phone.min' => 'Por favor, insira um Whatsapp válido',
            'email.unique' => 'E-mail já cadastrado',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
            'password.max' => 'A senha deve ter no máximo :max caracteres.',
            'ddi.min' => 'O DDI deve ter pelo menos :min caracteres.',
            'ddi.max' => 'O DDI deve ter no máximo :max caracteres.',
            'ddi.required' => 'O DDI é obrigatório.',
            // 'password.different' => 'A senha deve ser diferente do e-mail.',
            // 'password.regex' => 'A senha deve conter pelo menos uma letra maiúscula e um caracter especial.',
            'phone.unique' => 'Este número Whatsapp já está em uso.'
        ]);

        if ($this->currentCustomerId) {
            $user = User::find($this->currentCustomerId);

            // Verificar se os valores dos campos foram alterados
            $changes = [
                'name' => $this->name !== $user->name,
                'email' => $this->email !== $user->email,
                'phone' => $this->phone !== $user->phone,
                'ddi' => $this->ddi !== $user->ddi,
                'password' => $this->password !== $user->password,
                // Verifique outros campos, se necessário
            ];
            // Se algum campo foi alterado, atualize o usuário
            if (in_array(true, $changes)) {
                $user->fill([
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'ddi' => $this->ddi,
                    'password' => Hash::make($this->password),
                ]);

                // Salvar as alterações no usuário
                $user->save();
                return redirect()->route('customers')->with('profile-updated', 'Perfil atualizado com sucesso!');
            }else{
                return redirect()->route('customers');
            }
        } else {
            return redirect()->route('customers');
        }

    }

    public function editCustomer($userId)
    {
        tenancyFn($this->tenant_id);
        $this->editing = true;

        $user = User::findOrFail($userId);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->currentCustomerId = $user->id;
        $this->ddi = $user->ddi;
    }

    public function deleteCustomer($userId)
    {
        tenancyFn($this->tenant_id);

        $user = User::findOrFail($userId);
        $user->delete();
        // Opção para adicionar uma mensagem de sessão ou emitir um evento Livewire para notificação
        session()->flash('message', 'Usuário deletado com sucesso.');
        return redirect()->route('customers');
    }

    public function render()
    {
        tenancyFn($this->tenant_id);
        return view('livewire.admin.customer', [
            'users' => User::search($this->search)->orderBy('name')->paginate(10)
        ]);
    }
}
