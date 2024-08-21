<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TechnitiumDNSService
{
    protected $baseUrl;
    protected $sessionToken;

    public function __construct()
    {
        $this->baseUrl = env('DNS_SERVER');
        $this->sessionToken = env('DNS_PASSWORD');
    }

    public function createDomain($domainName, $type = 'Primary')
    {
        if (is_null($this->sessionToken)) {
            throw new \Exception('Session token is required. Please login first.');
        }

        $response = Http::withHeaders([
            'X-Session-Token' => $this->sessionToken,
        ])->get("$this->baseUrl/api/zones/create", [
            'token' => $this->sessionToken,
            'zone' => $domainName,
            'type' => $type, // Default to 'Primary' if no type is provided
        ]);

        return $response->json();
    }

    public function createARecord($domain, $ipAddress, $ttl = 3600, $overwrite = true)
    {
        if (is_null($this->sessionToken)) {
            throw new \Exception('Session token is required. Please login first.');
        }

        $response = Http::withHeaders([
            'X-Session-Token' => $this->sessionToken,
        ])->get("$this->baseUrl/api/zones/records/add", [
            'token' => $this->sessionToken,
            'domain' => $domain,
            'type' => 'A',
            'ipAddress' => $ipAddress,
            'ttl' => $ttl,
            'overwrite' => $overwrite ? 'true' : 'false',
            // Add other parameters as needed
        ]);

        return $response->json();
    }

    public function createCNAMERecord($domain, $alias, $ttl = 3600, $overwrite = true)
    {
        if (is_null($this->sessionToken)) {
            throw new \Exception('Session token is required. Please login first.');
        }

        $response = Http::withHeaders([
            'X-Session-Token' => $this->sessionToken,
        ])->get("$this->baseUrl/api/zones/records/add", [
            'token' => $this->sessionToken,
            'domain' => $domain,
            'type' => 'CNAME',
            'cname' => $alias,
            'ttl' => $ttl,
            'overwrite' => $overwrite ? 'true' : 'false',
            // Add other parameters as needed
        ]);

        return $response->json();
    }
}
