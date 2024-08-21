<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZeroSSLCertificateService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.zerossl.com';

    public function __construct()
    {
        $this->apiKey = env('ZEROSSL_API_KEY');
    }

    public function createCertificate($domains, $csr)
    {
        // If $domains is an array, convert it to a comma-separated string
        $domainString = is_array($domains) ? implode(',', $domains) : $domains;

        $endpoint = "{$this->baseUrl}/certificates?access_key={$this->apiKey}";
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($endpoint, [
            'certificate_domains' => $domainString,
            'certificate_csr' => $csr,
        ]);

        return $response->json();
    }

    public function verifyDomain($certificateId)
    {
        $endpoint = "{$this->baseUrl}/certificates/{$certificateId}/challenges?access_key={$this->apiKey}";
        $response = Http::post($endpoint, [
            'validation_method' => 'CNAME_CSR_HASH',
        ]);

        if (!$response->successful()) {
            // Handle the error scenario, maybe log the error or return an error message
            return ['error' => 'API request failed'];
        }

        $responseData = $response->json();
        if (isset($responseData['error']) && $responseData['error']['type'] == 'domain_control_validation_failed') {
            $verificationDetails = [];
            $verificationDetails['success'] = $responseData['success'];

            foreach ($responseData['error']['details'] as $domain => $details) {
                if (isset($details['target_host']) && isset($details['target_record'])) {
                    $verificationDetails['sites'][$domain] = [
                        'host' => $details['target_host'],
                        'value' => $details['target_record'],
                    ];

                    // Here you would create the CNAME record in your DNS for each domain
                    // Depending on your DNS provider, this might involve API calls or manual updates
                }
            }
            Log::debug("verificationDetails: " . json_encode($verificationDetails));
            return $verificationDetails;
        }

        // Return a general error or specific message if the structure is not as expected
        Log::debug("responseData: " . json_encode($responseData));
        return $responseData;
    }

    public function downloadCertificate($certificateId)
    {
        $endpoint = "{$this->baseUrl}/certificates/{$certificateId}/download/return";
        $response = Http::get($endpoint, [
            'access_key' => $this->apiKey,
        ]);

        return $response->json(); // Or handle the download appropriately
    }

    public function installCertificate($certificatePath)
    {
        // Implement certificate installation logic on the server
    }

    public function validateCSR($csr)
    {
        // Append the access_key directly to the endpoint URL
        $endpoint = "{$this->baseUrl}/validation/csr?access_key={$this->apiKey}";

        // Make a POST request with the CSR
        // Note: The API might require the CSR to be sent as a form parameter or in the request body
        $response = Http::asForm()->post($endpoint, ['csr' => $csr]);

        return $response->json();
    }

    public function verificationStatus($certificateId)
    {
        $endpoint = "{$this->baseUrl}/certificates/{$certificateId}/status?access_key={$this->apiKey}";
        $response = Http::get($endpoint);

        if (!$response->successful()) {
            // Handle the error scenario, maybe log the error or return an error message
            Log::error("Failed to retrieve certificate status: " . json_encode($response->json()));
            return ['error' => 'API request failed to retrieve certificate status'];
        }
        $responseVerification = $response->json();
        Log::debug("responseVerification: " . json_encode($responseVerification));
        return $responseVerification;
    }

    public function downloadCertificateInline($certificateId)
    {
        $endpoint = "{$this->baseUrl}/certificates/{$certificateId}/download/return?access_key={$this->apiKey}";
        $response = Http::get($endpoint);

        if (!$response->successful()) {
            // Handle the error scenario, maybe log the error or return an error message
            Log::error("Failed to download certificate: " . json_encode($response->json()));
            return ['error' => 'API request failed to download the certificate'];
        }
        $responseDownloadInline = $response->json();
        // The certificate data should be part of the response
        Log::debug("responseDownloadInline: " . json_encode($responseDownloadInline));
        return $responseDownloadInline; // or return $response->body() if it's raw data
    }
}
