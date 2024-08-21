<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DNSCheckController extends Controller
{
    public function checkDNS($domain)
    {
        $requiredNS = env('DOMAIN_NS', 'default_ns_value'); // Get NS from .env or use a default
        $requiredARecord = env('DOMAIN_IP_ADDRESS', 'default_ip_value'); // Get IP from .env or use a default

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
            if (strtolower($record['target']) === strtolower($requiredNS)) {
                $hasRequiredNS = true;
                break;
            }
        }

        foreach ($aRecords as $record) {
            if ($record['ip'] === $requiredARecord) {
                $hasRequiredA = true;
                break;
            }
        }

        return response()->json([
            'domain' => $domain,
            'hasRequiredNS' => $hasRequiredNS,
            'hasRequiredA' => $hasRequiredA,
        ]);
    }
}
