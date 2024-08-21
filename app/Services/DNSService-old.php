<?php

namespace App\Services;

class DNSService
{
    public function checkDNS($domain)
    {
        $requiredNS = env('DOMAIN_NS', 'ns1.rifando-dns.com');
        $requiredARecord = env('DOMAIN_IP_ADDRESS', '167.71.26.53');

        $dnsServer = '1.1.1.1'; // Use Cloudflare's DNS server
        $dnsRecords = dns_get_record($domain, DNS_NS + DNS_A);
        
        $nsRecords = array_filter($dnsRecords, function ($record) {
            return $record['type'] === 'NS';
        });
        $aRecords = array_filter($dnsRecords, function ($record) {
            return $record['type'] === 'A';
        });


        $hasRequiredNS = false;
        $hasRequiredA = false;

        foreach ($nsRecords as $record) {
            if (strtolower($record['target']) == strtolower($requiredNS)) {
                $hasRequiredNS = true;
                break;
            }
        }

        foreach ($aRecords as $record) {
            if ($record['ip'] == $requiredARecord) {
                $hasRequiredA = true;
                break;
            }
        }

        return [
            'domain' => $domain,
            'hasRequiredNS' => true,
            'hasRequiredA' => $hasRequiredA,
            'nsRecords' => $nsRecords,
            'aRecords' => $aRecords
        ];
    }
}
