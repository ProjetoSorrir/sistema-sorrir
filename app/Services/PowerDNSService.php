<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PowerDNSService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = 'http://localhost:8081/api/v1/servers/localhost';
        $this->apiKey = 'yourapikey';
    }

    public function listZones()
    {
        $response = Http::withHeaders([
            'X-API-Key' => $this->apiKey,
        ])->get("$this->baseUrl/zones");

        return $response->json();
    }

    public function createRecord($zoneId, $name, $type, $content, $ttl = 3600)
    {
        $response = Http::withHeaders([
            'X-API-Key' => $this->apiKey,
        ])->post("$this->baseUrl/zones/$zoneId", [
            'rrsets' => [
                [
                    'name' => $name,
                    'type' => $type,
                    'ttl' => $ttl,
                    'changetype' => 'REPLACE',
                    'records' => [
                        [
                            'content' => $content,
                            'disabled' => false,
                        ],
                    ],
                ],
            ],
        ]);

        return $response->json();
    }
}
