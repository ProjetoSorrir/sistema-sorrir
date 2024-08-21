<?php

namespace App\Livewire\Site;

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class Login extends Component
{
    public LoginForm $form;
    public string $tenant_id;

    public function mount()
    {
        $this->tenant_id = getTenantId();
    }
    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        tenancyFn($this->tenant_id);

        $this->validate();

        try {
            $this->form->authenticate();
        } catch (ValidationException $e) {
            $this->addError('password', 'CPF ou senha incorretos. Caso queira, clique no botão abaixo para recuperar sua senha.');
            return;
        }

        Session::regenerate();

        $this->redirect(
            session('url.intended', RouteServiceProvider::HOME),
            navigate: true
        );
    }

    public function render()
    {
        return view('livewire.site.login');
    }
}
