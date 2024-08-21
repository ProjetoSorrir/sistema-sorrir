<?php

namespace App\Livewire\Central\User;

use App\Models\SiteSpecs;
use App\Models\Tenant;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class WelcomeRifando extends Component
{
    public $step = 1;

    public $domain;

    public $password;

    public $password_confirmation;

    public $buttonDisabled = false;

    public $active = false;

    public $subDomains = '';

    public function mount()
    {
        if (!is_null(auth()->user()->tenant_id)) {
            $this->step = 2;

            $tenant = SiteSpecs::where('site_id', auth()->user()->tenant_id)->firstOrFail();

            if ($tenant->status == 'active') {
                $this->active = true;
                $this->domain = Tenant::find(auth()->user()->tenant_id)->domains()->first()->domain;
            }

            if ($tenant->status == 'waiting_dns_propagation') {
                //$this->subdomain = true;
                $tenand = auth()->user()->tenant_id;
                $this->subDomains = "{$tenand}." . env('DOMAIN_SUB_CONTROLLER');
            }

            tenancyFn(auth()->user()->tenant_id);
            $user = User::where('email', auth()->user()->email)->first();
            if ($user) {
                $this->step = 3;
                if ($this->active) {
                    $this->step = 4;
                }
            }
        }
    }

    // Helper function to extract the base domain
    private function extractBaseDomain($domain)
    {
        $parts = explode('.', $domain);
        $baseDomain = '';

        // Known TLDs which are country-specific and have two segments, add more as needed
        $specialTLDs = ['com.br', 'co.uk', 'com.au', 'co.in', 'app.br', 'net.br'];

        // Check from the end of the domain if we have any special TLDs
        if (count($parts) >= 2) {
            $lastTwoParts = $parts[count($parts) - 2] . '.' . $parts[count($parts) - 1];
            if (in_array($lastTwoParts, $specialTLDs)) {
                // For special cases like 'com.br', 'co.uk', etc.
                $baseDomain = count($parts) >= 3 ? $parts[count($parts) - 3] . '.' . $lastTwoParts : $lastTwoParts;
            } else {
                // Regular domains (e.g., .com, .org)
                $baseDomain = count($parts) >= 2 ? $parts[count($parts) - 2] . '.' . $parts[count($parts) - 1] : $domain;
            }
        }

        return $baseDomain;
    }

    public function domainStep()
    {
        $this->buttonDisabled = true;

        $validatedData = $this->validate([
            'domain' => ['required', 'regex:/^[a-zA-Z0-9-\.]+\.[a-zA-Z]{2,}$/', 'unique:domains,domain']
        ]);

        $this->domain = $this->extractBaseDomain($this->domain);
        // Criar o tenant e associar um domínio a ele com os dados validados
        $serializedTenantId = strtolower(preg_replace('/[^A-Za-z0-9]/', '-', $this->domain));

        $tenant = Tenant::create(['id' => $serializedTenantId]);
        $newDomain = "{$serializedTenantId}." . env('DOMAIN_SUB_CONTROLLER');

        // Associar o domínio validado e o novo domínio ao tenant
        $tenant->domains()->createMany([
            ['domain' => $this->domain],
            ['domain' => $newDomain],
        ]);

        // Create a SiteSpecs entry for the new tenant
        SiteSpecs::create([
            'site_id' => $tenant->id,
            'is_active' => false,
            'status' => 'created',
        ]);

        $user = User::findOrFail(auth()->user()->id);
        $user->tenant_id = $tenant->id;
        $user->save();

        $this->step = 2;
    }

    public function createAdminUser()
    {
        $user = User::findOrFail(auth()->user()->id);
        $this->validate([
            'password' => 'required|min:8|confirmed'
        ]);
        $pass = Hash::make($this->password);
        $user->password = $pass;
        $user->save();
        //Tenancy layer
        tenancyFn($user->tenant_id);
        $adminUser = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $pass,
            'phone' => $user->phone,
            'tipoChaveRevendedor' => $user->tipoChaveRevendedor,
            'chaveRevendedor' => $user->chaveRevendedor,
            'admin' => true
        ]);
        if ($adminUser) {
            $this->step = 3;
        }
    }

    public function render()
    {
        return view('livewire.central.user.welcome-rifando');
    }
}
