<?php

namespace App\Services;

use App\Models\Tenant;
use Illuminate\Support\Facades\Log;
class ActivateSitesService
{
    protected $dnsService;

    public function __construct(ClouDNSApiService $dnsService)
    {
        $this->dnsService = $dnsService;
    }

    public function updateSiteStatuses()
    {
        $sites = Tenant::with('siteSpecs')->get();

        foreach ($sites as $site) {
            // Check if site has siteSpecs, the status is 'created', and taskFinished is false
            if ($site->siteSpecs && $site->siteSpecs->status === 'created' && !$site->siteSpecs->taskFinished) {
                foreach ($site->domains as $domain) {
                    $domainName = $domain->domain;
                    $ipAddress = env('DOMAIN_IP_ADDRESS'); // Ensure this env variable is set

                    // Use the createDomain logic
                    $response = $this->createDomain($domainName, $ipAddress);

                    if ($response['status'] === 'ok') {
                        // If DNS records are successfully created, update the status and set taskFinished to true
                        $site->siteSpecs->update([
                            'status' => 'creating_dns_records',
                            'taskFinished' => true,
                        ]);
                    } else {
                        // Handle the error appropriately
                        // Maybe log an error or send a notification
                    }
                }
            } elseif ($site->siteSpecs && $site->siteSpecs->status === 'creating_dns_records' && $site->siteSpecs->taskFinished) {
                // Logic for sites that have finished creating DNS records
                // Update the status to 'waiting_dns_propagation' and set taskFinished to false
                $site->siteSpecs->update([
                    'status' => 'waiting_dns_propagation',
                    'taskFinished' => false,
                ]);
            }
        }
    }

    public function createDomain($domainName, $ipAddress)
    {
        Log::info("Creating domain: {$domainName}");

        // Using createZone to create the domain/zone
        $zoneCreationResponse = $this->dnsService->createZone($domainName);

        Log::debug("Zone creation response: ", $zoneCreationResponse);

        if (isset($zoneCreationResponse['status']) && $zoneCreationResponse['status'] == 'Success') {
            if (strpos($domainName, env('DOMAIN_SUB_CONTROLLER')) === false) {
                Log::info("Adding A record for {$domainName} with IP {$ipAddress}");

                $aRecordCreationResponse = $this->dnsService->addARecord($domainName, '', $ipAddress, 3600);
                Log::debug("A record creation response: ", $aRecordCreationResponse);

                if (isset($aRecordCreationResponse['status']) && $aRecordCreationResponse['status'] === 'Success') {
                    Log::info("Successfully created A record for {$domainName}");
                    return ['status' => 'ok'];
                } else {
                    Log::error("Failed to create A record for {$domainName}");
                    return ['status' => 'error', 'message' => 'Failed to create A record'];
                }
            } else {
                Log::info("{$domainName} is a subdomain of the DOMAIN_SUB_CONTROLLER. No A record added.");
                return ['status' => 'ok', 'message' => 'Subdomain creation handled differently'];
            }
        } else {
            Log::error("Failed to create domain/zone for {$domainName}");
            return ['status' => 'error', 'message' => 'Failed to create domain/zone'];
        }
    }
}
