<?php

namespace App\Livewire\Admin\LegalTerms;

use Livewire\Component;
use App\Models\Settings;

class UseTerm extends Component
{
    public $terms_of_use_accepted;

    public function mount()
    {
        $this->terms_of_use_accepted = Settings::get('terms_of_use_accepted') ?? null;
    }

    public function updateTermsOfUse()
    {
        Settings::set('terms_of_use_accepted', $this->terms_of_use_accepted);

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.admin.legal-terms.use-term');
    }
}
