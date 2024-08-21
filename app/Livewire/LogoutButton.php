<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Actions\Logout;

class LogoutButton extends Component
{

    public string $tenant_id;

    public function mount()
    {
        $this->tenant_id = getTenantId();
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        tenancyFn($this->tenant_id);

        $logout();

        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.logout-button');
    }
}
