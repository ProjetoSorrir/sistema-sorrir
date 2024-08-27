<?php

namespace App\Livewire\Site;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use App\Helpers\WebhookHelper;
use Illuminate\Support\Facades\Log;

class Register extends Component
{
    public string $name;
    public string $cpf;
    public string $birth_date;
    public string $email;
    public string $email_confirmation;
    public string $ddi = '+55';
    public string $phone;
    public string $cep;
    public string $password;
    public string $password_confirmation;

    public function mount()
    {
    }

    public function register(): void
    {
        $this->validate([
            'name' => [
                'required',
                'string',
                'regex:/^[\pL\s]{3,} [\pL\s]{2,}.*/u',
                'min:3',
                'max:255'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/',
                'max:255',
                'unique:' . User::class,
                'confirmed'
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8',
                'max:20'
            ],
            'cpf' => [
                'required',
                'string',
                'unique:' . User::class,
                function ($attribute, $value, $fail) {
                    if (!$this->isValidCPF($value)) {
                        $fail('O CPF informado é inválido');
                    }
                }
            ],
            'birth_date' => [
                'required',
                'date',
                'before:' . now()->setTimezone('America/Sao_Paulo')->subYears(16)->toDateString(),
                'after:' . now()->setTimezone('America/Sao_Paulo')->subYears(99)->toDateString()
            ],
            'phone' => [
                'required',
                'string',
                'min:10', // Ajustado para incluir código de área
                'max:11', // Ajustado para incluir número máximo com código de área
                'regex:/^\d{10,11}$/', // Expressão regular para validar formato numérico
                'unique:' . User::class
            ],
            'cep' => [
                'required',
                'string',
                'regex:/^\d{5}-?\d{3}$/', // Expressão regular para validar formato de CEP
            ],
        ], [
            'name.required' => 'Preencha este campo',
            'name.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres',
            'name.regex' => 'Por favor, preencha um nome e sobrenome',
            'email.required' => 'Preencha este campo',
            'email.email' => 'O campo email deve ser um email válido',
            'email.unique' => 'O email informado já está em uso',
            'email.regex' => 'Por favor, digite um email válido. Ex email@email.com',
            'email.confirmed' => 'A confirmação do e-mail não corresponde',
            'password.required' => 'Preencha este campo',
            'password.min' => 'O campo senha deve ter no mínimo 8 caracteres',
            'password.max' => 'O campo senha deve ter no máximo 20 caracteres',
            'password.confirmed' => 'As senhas não conferem',
            'cpf.required' => 'Preencha este campo',
            'cpf.unique' => 'O CPF informado já está em uso',
            'birth_date.required' => 'Preencha este campo',
            'birth_date.date' => 'O campo data de nascimento deve ser uma data válida',
            'birth_date.before' => 'Você deve ter no mínimo 16 anos para se cadastrar',
            'birth_date.after' => 'Idade acima do permitido para se cadastrar',
            'phone.required' => 'Preencha este campo',
            'phone.min' => 'O campo telefone deve ter no mínimo 10 caracteres',
            'phone.max' => 'O campo telefone deve ter no máximo 11 caracteres',
            'phone.regex' => 'O campo telefone deve conter apenas números e ter entre 10 e 11 dígitos',
            'phone.unique' => 'O telefone informado já está em uso',
            'cep.required' => 'Preencha este campo',
            'cep.regex' => 'O campo CEP deve estar no formato 00000-000 ou 00000000',
        ]);

        if (User::where('cpf', preg_replace('/[^0-9]/is', '', $this->cpf))->exists()) {
            throw ValidationException::withMessages(['cpf' => 'O CPF informado já está em uso']);
        }

        $birthDate = Carbon::createFromFormat('d-m-Y', $this->birth_date)->format('Y-m-d');

        $validated['password'] = Hash::make($this->password);

        $user = User::create([
            'name' => $this->name,
            'cpf' => preg_replace('/[^0-9]/is', '', $this->cpf),
            'birth_date' => $birthDate,
            'ddi' => $this->ddi,
            'phone' => $this->phone,
            'cep' => $this->cep,
            'email' => $this->email,
            'password' => $validated['password'],
        ]);

        event(new Registered($user));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);

        // Dados para o webhook
        $data = [
            "Nome" => Auth::user()->name,
            "email" => Auth::user()->email,
            "telefone" => Auth::user()->phone,
            "cidade" => Auth::user()->city ?? 'N/A',
            "UF" => Auth::user()->state ?? 'N/A',
            "CEP" => Auth::user()->zip_code ?? 'N/A',
            "user_id" => Auth::id(),
            "dt_nascimento" => Auth::user()->birth_date ?? 'N/A',
            "Origen" => 'Login do Usuário - Registro'
        ];

        // Chama o helper para enviar o webhook
        //$webhookUrl = 'https://growthphantom.app.n8n.cloud/webhook/cf299562-6071-450d-945a-edb2588ba3cf';
        //WebhookHelper::sendWebhook($webhookUrl, $data);

       // Log::info('Send Webhook Login to n8n REGISTER ==>', ['data' => $data]);
    }

    public function isValidCPF($cpf)
    {
        // Remove caracteres especiais
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se o número de dígitos é igual a 11
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se todos os dígitos são iguais (ex.: 111.111.111-11)
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Calcula os dígitos verificadores para verificar se são válidos
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }


    public function render()
    {
        return view('livewire.site.register');
    }
}