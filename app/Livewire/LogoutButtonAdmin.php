<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use Livewire\Component;

class LogoutButtonAdmin extends Component
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
        return view('livewire.logout-button-admin');
    }
}
