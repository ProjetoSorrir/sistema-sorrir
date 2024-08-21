<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UpdateProfile extends Component
{
    public string $tenant_id;
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $ddi = '';


    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->tenant_id = getTenantId();
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        if (Auth::user()->phone) {
            $this->phone = Auth::user()->phone;
            // Check if ddi is not null before assigning
            if (Auth::user()->ddi !== null) {
                $this->ddi = Auth::user()->ddi;
            }
        }
    }

    /**
     * Update the profile information for the currently authenticated user.
     */

    public function updateProfileInformation(): void
    {
        tenancyFn($this->tenant_id);
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],
            'phone' => [
                'required',
                'min:9',
                'max:15',
                Rule::unique(User::class)->ignore($user->id)
            ],
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'email.max' => 'O campo e-mail não pode ter mais de :max caracteres.',
            'email.unique' => 'Este endereço de e-mail já está em uso.',
            'phone.required' => 'O Whatsapp é obrigatório.',
            'phone.min' => 'Por favor, insira um Whatsapp válido',
            'phone.unique' => 'Este número Whatsapp já está em uso.'
        ]);


        // Atualizar os atributos do usuário
        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'ddi' => $this->ddi,
        ]);

        // Verificar se o modelo do usuário foi alterado
        if ($user->isDirty()) {
            // Resetar a verificação de e-mail se o e-mail foi alterado
            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            // Salvar as alterações no usuário
            $user->save();
            session()->flash('profile-updated', 'Perfil atualizado com sucesso!');
            // Despachar o evento profile-updated
            $this->dispatch('profile-updated', name: $user->name);
        }
    }


    public function updatePassword(): void
    {
        tenancyFn($this->tenant_id);
        // Validação dos campos de senha
        $this->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', 'min:8', 'max:20'],
            'password_confirmation' => ['required'],
        ], [
            'current_password.required' => 'O campo senha atual é obrigatório.',
            'password.required' => 'O campo nova senha é obrigatório.',
            'password.confirmed' => 'A confirmação da senha não corresponde',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
            'password.max' => 'A senha deve ter no máximo :max caracteres.',
        ]);


        $user = Auth::user();



        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'A senha atual está incorreta.');
            return;
        }


        $user->update([
            'password' => Hash::make($this->password),
        ]);

        // Reseta os campos do formulário
        $this->reset(['current_password', 'password', 'password_confirmation']);

        session()->flash('password-updated', 'Senha atualizada com sucesso!');
        $this->dispatch('password-updated');

    }
    public function render()
    {
        return view('livewire.profile.update-profile');
    }
}
