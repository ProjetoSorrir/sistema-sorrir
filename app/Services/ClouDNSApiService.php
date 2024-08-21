<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ClouDNSApiService
{
    private $apiUrl = 'https://api.cloudns.net';
    private $authId;
    private $authPassword;

    public function __construct()
    {
        $this->authId = env('CLOUDNS_AUTH_ID');
        $this->authPassword = env('CLOUDNS_AUTH_PASSWORD');
    }


    private function makeRequest($endpoint, $method = 'GET', $data = [])
    {
        $url = "{$this->apiUrl}{$endpoint}";

        $data = array_merge($data, [
            'auth-id' => $this->authId,
            'auth-password' => $this->authPassword,
        ]);

        $response = Http::withOptions([
            'verify' => false,
        ])->$method($url, $data);

        return $response->json();
    }

    public function createZone($domainName)
    {

        // Retrieve the domain controller value from the .env file
        $subDomainController = env('DOMAIN_SUB_CONTROLLER');

        if (strpos($domainName, $subDomainController) !== false) {
            return $this->createSubdomainOnMainDomain($domainName);
        }

        $endpoint = '/dns/register.json';
        $data = [
            'domain-name' => $domainName,
            'zone-type' => 'master',
            'ns' => [
                'ns1.rifando-dns.com',
                'ns2.rifando-dns.com',
                'ns3.rifando-dns.com',
                'ns4.rifando-dns.com',
            ],
        ];

        return $this->makeRequest($endpoint, 'POST', $data);
    }

    private function createSubdomainOnMainDomain($subdomainName)
    {
        // Extract the subdomain by removing the main domain part
        $subDomainController = env('DOMAIN_SUB_CONTROLLER');
        $subdomainPart = str_replace('.' . $subDomainController, '', $subdomainName);

        // Get the IP address from the .env file
        $ipAddress = env('DOMAIN_IP_ADDRESS');

        // Use the addARecord method to create the A record for the subdomain
        return $this->addARecord($subDomainController, $subdomainPart, $ipAddress, 3600);
    }

    public function addARecord($domainName, $host, $record, $ttl)
    {
        $endpoint = '/dns/add-record.json';
        $data = [
            'domain-name' => $domainName,
            'record-type' => 'A',
            'host' => $host,
            'record' => $record,
            'ttl' => $ttl,
        ];

        return $this->makeRequest($endpoint, 'POST', $data);
    }

    public function createCNAMERecord($domain, $host, $value) {
        // This function will use ClouDNS's add-record API to add a CNAME record
        // Example endpoint: /dns/add-record.json
        // Data needed: domain-name, record-type (CNAME), host (the subdomain part), record (the target), ttl
        $endpoint = '/dns/add-record.json';
        $data = [
            'domain-name' => $domain,
            'record-type' => 'CNAME',
            'host' => $host,
            'record' => $value,
            'ttl' => 3600,  // Set TTL as needed
        ];
    
        return $this->makeRequest($endpoint, 'POST', $data);
    }

    public function modifyTXTRecord($domainName, $recordId, $txtData, $ttl)
    {
        $endpoint = '/dns/mod-record.json';
        $data = [
            'domain-name' => $domainName,
            'record-id' => $recordId,
            'record-type' => 'TXT',
            'record' => $txtData,
            'ttl' => $ttl,
        ];

        return $this->makeRequest($endpoint, 'POST', $data);
    }
}
