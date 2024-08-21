<?php

namespace App\Console\Commands;

use App\Jobs\CreateSSLJob;
use App\Models\Tenant;
use Illuminate\Console\Command;
use App\Services\DNSService;
use App\Services\ForgeService;

class CheckDomainPropagation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:check-propagation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if the domains have been propagated';

    protected $dnsService;

    protected $forgeService;

    public function __construct(ForgeService $forgeService, DNSService $dnsService)
    {
        parent::__construct();
        $this->dnsService = $dnsService;
        $this->forgeService = $forgeService;
    }

    public function handle()
    {
        $tenants = Tenant::with('siteSpecs')->whereHas('siteSpecs', function ($query) {
            $query->where('status', 'waiting_dns_propagation')->where('taskFinished', false);
        })->get();

        foreach ($tenants as $tenant) {
            foreach ($tenant->domains as $domain) {
                // Skip the domain if it ends with 'rifando-apps.com'
                if (str_ends_with($domain->domain, 'rifando-apps.com')) {
                    continue;
                }


                $this->info("Search Propagation for: $domain->domain");

                $checkResult = $this->dnsService->checkDNS($domain->domain);
                if ($checkResult['hasRequiredNS'] && $checkResult['hasRequiredA']) {
                    //Add domains on alias forge
                    $this->forgeService->addDomainAlias([$domain->domain]);
                    $tenant->siteSpecs->update([
                        'status' => 'creating_ssl',
                        'taskFinished' => false,
                    ]);

                    $domain = $domain->domain;
                    $tenantId = $tenant->id;
                    CreateSSLJob::dispatch($domain, $tenantId)->onQueue('default');
                }
            }
        }

        $this->info('Domain propagation checks complete.');
    }
}
