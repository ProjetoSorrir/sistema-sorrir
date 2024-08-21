<?php

namespace App\Livewire\Central;

use App\Models\SiteSpecs;
use App\Models\Tenant;
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class Tenants extends Component
{
    public $users;
    public $tenants;
    public $tenantId;
    public $domain;
    public $showModal = false;

    public $showModalCreateUser = false;

    public $name;
    public $email;
    public $password;


    public function saveTenant()
    {
        $validatedData = $this->validate([
            'tenantId' => 'required|string',
            'domain' => 'required|string|max:255',
        ]);

        // Criar o tenant e associar um domínio a ele com os dados validados
        $tenant = Tenant::create(['id' => $validatedData['tenantId']]);
        //$tenant->domains()->create(['domain' => $validatedData['domain']]);

        // Serializar o tenantId, substituir caracteres especiais por '-' e concatenar com DOMAIN_SUB_CONTROLLER
        $serializedTenantId = strtolower(preg_replace('/[^A-Za-z0-9]/', '-', $validatedData['tenantId']));
        $newDomain = "{$serializedTenantId}." . env('DOMAIN_SUB_CONTROLLER');

        // Associar o domínio validado e o novo domínio ao tenant
        $tenant->domains()->createMany([
            ['domain' => $validatedData['domain']],
            ['domain' => $newDomain],
        ]);

        // Create a SiteSpecs entry for the new tenant
        SiteSpecs::create([
            'site_id' => $tenant->id,
            'is_active' => false,
            'status' => 'created',
        ]);

        // Limpar os campos após a criação
        $this->reset(['tenantId', 'domain']);

        // Atualizar a lista de tenants, se necessário
        $this->tenants = Tenant::all();

        // Fechar o modal
        $this->showModal = false;

        // Adicionar aqui qualquer feedback ao usuário, como uma mensagem de sucesso
    }

    public function createUserClient(){
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = new User();

        // Assign the validated data to the user model.
        // This can also be done in bulk using $user->fill($validated) if all validated fields are fillable.
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = $validated['password'];

        // Save the user model to the database.
        $user->save();

        // Limpar os campos após a criação
        $this->reset(['name', 'email', 'password']);

        $this->showModalCreateUser = false;
    }


    public function mount()
    {
        $this->tenants = Tenant::all();
        $this->users = User::where('admin',false)->get();
    }

    public function render()
    {
        return view('livewire.central.tenants');
    }
}
