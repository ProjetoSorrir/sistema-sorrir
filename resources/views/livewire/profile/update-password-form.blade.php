<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password class="w-full"']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<section>
    <div class="flex">
        <!-- <div class="bg-[#f04e23] rounded-full w-[5px] h-[50px] mr-4"> </div>
        <div>
            <h2 class="text-lg font-bold text-gray-900">
            Atualizar senha
            </h2>
            <p class="text-sm text-gray-600">
            Mantenha sua conta segura
            </p>
        </div> -->
    </div>

    <form wire:submit="updatePassword" class="mt-6 space-y-6">
    <div>
            <div class="input-container"> 
            <label for="name">Sua Senha:</label>
            <input type="password">
        </div>
    </div>
        <div>
            <div class="input-container">
            <label for="name">Nova Senha:</label>
            <input type="password">
        </div>
    </div>
        <div>
            <div class="input-container">
            <label for="name">Confirmar Nova Senha:</label>
            <input type="password">
        </div>
    </div>

        <div class="flex items-center gap-4">
        <button class="primary-button w-full">Atualizar Senha</button>

            <x-action-message class="me-3" on="password-updated">
                Senha atualizada com sucesso!
            </x-action-message>
        </div>
    </form>
</section>
