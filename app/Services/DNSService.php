<?php

namespace App\Services;

use Net_DNS2_Resolver;
use Net_DNS2_Exception;

class DNSService
{
    protected $resolver;

    public function __construct()
    {
        // Initialize Net_DNS2 resolver with Cloudflare's DNS server
        $this->resolver = new Net_DNS2_Resolver([
            'nameservers' => ['1.1.1.1']
        ]);
    }

    protected function queryDNS($domain, $recordType)
    {
        try {
            // Query the DNS records using the Net_DNS2 resolver
            $result = $this->resolver->query($domain, $recordType);
            return $result->answer;
        } catch (Net_DNS2_Exception $e) {
            // Handle exceptions (e.g., DNS query failed)
            // For production, consider logging this error instead of printing it.
            echo 'DNS Query Failed: ' . $e->getMessage();
            return []; // Return an empty array if there is an error
        }
    }

    public function checkDNS($domain)
    {
        $requiredNS = getenv('DOMAIN_NS', 'ns1.rifando-dns.com');
        $requiredARecord = getenv('DOMAIN_IP_ADDRESS', '167.71.26.53');

        // Query NS records
        $nsRecords = $this->queryDNS($domain, 'NS');

        // Query A records
        $aRecords = $this->queryDNS($domain, 'A');

        $hasRequiredNS = false;
        $hasRequiredA = false;

        foreach ($nsRecords as $record) {
            if (strtolower($record->nsdname) === strtolower($requiredNS)) {
                $hasRequiredNS = true;
                break;
            }
        }

        foreach ($aRecords as $record) {
            if ($record->address === $requiredARecord) {
                $hasRequiredA = true;
                break;
            }
        }

        // Format the records for output
        $formattedNsRecords = array_map(function ($record) {
            return ['type' => $record->type, 'target' => $record->nsdname];
        }, $nsRecords);

        $formattedARecords = array_map(function ($record) {
            return ['type' => $record->type, 'ip' => $record->address];
        }, $aRecords);

        return [
            'domain' => $domain,
            'hasRequiredNS' => $hasRequiredNS,
            'hasRequiredA' => $hasRequiredA,
            'nsRecords' => $formattedNsRecords,
            'aRecords' => $formattedARecords
        ];
    }
}
