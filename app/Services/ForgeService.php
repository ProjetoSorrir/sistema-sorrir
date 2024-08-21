<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Laravel\Forge\Forge;

class ForgeService
{
    protected $forge;
    protected $serverId;
    protected $siteId;

    public function __construct()
    {
        $apiKey = env('FORGE_API_TOKEN');
        $this->forge = new Forge($apiKey);
        $this->serverId = '778385';
        $this->siteId = '2314768';
    }

    public function addDomainAlias(array $aliases)
    {
        //dd($this->serverId, $this->siteId, $aliases);
        try {
            $this->forge->addSiteAliases($this->serverId, $this->siteId, $aliases);
        } catch (\Exception $e) {
            // Log the error or handle it as necessary
            Log::error("Error adding domain alias: " . $e->getMessage());
            // Optionally rethrow the exception or handle it as needed
            throw $e;
        }
    }

    public function requestSslCertificate(array $domains)
    {
        try {
            $certificatedID = $this->forge->obtainLetsEncryptCertificate(
                $this->serverId,
                $this->siteId,
                [
                    'type' => 'letsencrypt',
                    'domains' => $domains
                ]
            );
            return $certificatedID;
        } catch (\Exception $e) {
            // Log the error or handle it as necessary
            Log::error("Error requesting SSL certificate: " . $e->getMessage());
            // Optionally rethrow the exception or handle it as needed
            throw $e;
        }
    }

    public function requestSslCertificateStatus($certificatedID)
    {
        try {
            $certificatedID = $this->forge->getCertificateSigningRequest($this->serverId, $this->siteId, $certificatedID);
            return $certificatedID;
        } catch (\Exception $e) {
            // Log the error or handle it as necessary
            Log::error("Error requesting SSL certificate: " . $e->getMessage());
            // Optionally rethrow the exception or handle it as needed
            throw $e;
        }
    }

    public function certificates()
    {
        try {
            return $this->forge->certificates(
                $this->serverId,
                $this->siteId
            );
        } catch (\Exception $e) {
            // Log the error or handle it as necessary
            Log::error("Error requesting SSL certificates: " . $e->getMessage());
            // Optionally rethrow the exception or handle it as needed
            throw $e;
        }
    }

    public function activateCertificate($certificateId)
    {
        try {
            return $this->forge->activateCertificate(
                $this->serverId,
                $this->siteId,
                $certificateId
            );
        } catch (\Exception $e) {
            // Log the error or handle it as necessary
            Log::error("Error requesting SSL activateCertificate: " . $e->getMessage());
            // Optionally rethrow the exception or handle it as needed
            throw $e;
        }
    }

    public function installExistingCertificate($privateKey, $certificate)
    {
        try {
            // Prepare the payload for the request
            $payload = [
                'type' => 'existing',
                'key' => $privateKey,
                'certificate' => $certificate,
            ];

            // Make the API call to install the certificate
            $response = $this->forge->createCertificate($this->serverId, $this->siteId, $payload);

            // Return the response or any other relevant information
            return $response;
        } catch (\Exception $e) {
            // Log the error or handle it as necessary
            Log::error("Error installing existing SSL certificate: " . $e->getMessage());
            // Optionally rethrow the exception or handle it as needed
            throw $e;
        }
    }
}
