<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $path = session('url.intended', RouteServiceProvider::HOME);

            $this->redirect($path);

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <div class="flex">
        <!-- <div class="bg-[#f04e23] rounded-full w-[5px] h-[50px] mr-4"> </div>
        <div>
            <h2 class="text-lg font-bold text-gray-900">
            Informação do Perfil
            </h2>
            <p class="text-sm text-gray-600">
            Dados para contato em caso de Prêmio
            </p>
        </div> -->
    </div>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
    <div>
            <div class="input-container">
            <label for="name">Seu Nome:</label>
            <input type="text">
        </div>
    </div>

        <div>
            <div class="input-container">
            <label for="email">Seu E-mail:</label>
            <input type="text">
        </div>

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="input-container">
        
            <label for="whatsapp">Seu Whatsapp:</label>
            <input type="text"> 
            
        </div>

        <div class="flex items-center gap-4">
            <button class="primary-button w-full">Atualizar informações</button>

            <x-action-message class="me-3" on="profile-updated">
                Informações salvas com sucesso!
            </x-action-message>
        </div>
    </form>
</section>
