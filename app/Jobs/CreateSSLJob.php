<?php

namespace App\Jobs;

use App\Models\Tenant;
use App\Services\ClouDNSApiService;
use App\Services\ForgeService;
use App\Services\SslService;
use App\Services\ZeroSSLCertificateService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CreateSSLJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $domain;
    protected $tenantId;

    /**
     * Create a new job instance.
     *
     * @param string $domain The domain for which SSL needs to be created.
     * @param string $tenantId Tenant identifier.
     * @return void
     */
    public function __construct($domain, $tenantId)
    {
        $this->domain = $domain;
        $this->tenantId = $tenantId;
    }

    // Helper function to extract the base domain
    private function extractBaseDomain($domain)
    {
        $parts = explode('.', $domain);
        $baseDomain = '';

        // Known TLDs which are country-specific and have two segments, add more as needed
        $specialTLDs = ['com.br', 'co.uk', 'com.au', 'co.in', 'app.br', 'net.br'];

        // Check from the end of the domain if we have any special TLDs
        if (count($parts) >= 2) {
            $lastTwoParts = $parts[count($parts) - 2] . '.' . $parts[count($parts) - 1];
            if (in_array($lastTwoParts, $specialTLDs)) {
                // For special cases like 'com.br', 'co.uk', etc.
                $baseDomain = count($parts) >= 3 ? $parts[count($parts) - 3] . '.' . $lastTwoParts : $lastTwoParts;
            } else {
                // Regular domains (e.g., .com, .org)
                $baseDomain = count($parts) >= 2 ? $parts[count($parts) - 2] . '.' . $parts[count($parts) - 1] : $domain;
            }
        }

        return $baseDomain;
    }

    /**
     * Execute the job.
     */
    public function handle(ForgeService $forgeService, SslService $sslService, ZeroSSLCertificateService $zeroSslService, ClouDNSApiService $clouDNSApiService): void
    {
        Log::info('Starting SSL creation process for domain: ' . $this->domain);
        $domainsToSSL = [];

        array_push($domainsToSSL, $this->domain);

        $tenant = Tenant::with('siteSpecs')->where('id', $this->tenantId)->first();

        foreach ($domainsToSSL as $value) {
            Log::info('Domain: ' . $value);
        }

        //Mantain the LP Site SSL
        if (count($domainsToSSL) > 0) {
            // Remove duplicate domains
            $domainsToSSL = array_unique($domainsToSSL);

            // Generate one CSR for all domains and subdomains
            Log::info("Generating CSR for all domains...");
            $sslCertificate = $sslService->generateCSR($domainsToSSL);

            if ($sslCertificate) {
                $validcsrparse = str_replace("\n", "", $sslCertificate->csr);
                // Create a certificate with ZeroSSL using the CSR that includes all domains
                $certificateResponse = $zeroSslService->createCertificate($domainsToSSL, $validcsrparse);
                //Log::debug("certificateResponse: ", $certificateResponse);

                if ($certificateResponse['status'] == 'draft') {
                    Log::info("Certificate creation initiated for all domains, proceeding with verification...");
                    $sslCertificate->certificate = $certificateResponse['id'];
                    $sslCertificate->save();

                    // Domain verification process...

                    // Assuming $certificateResponse is the response from ZeroSSL after creating the certificate
                    $validationDetails = $certificateResponse['validation']['other_methods'];
                    foreach ($validationDetails as $fullDomain => $methods) {
                        if (isset($methods['cname_validation_p1']) && isset($methods['cname_validation_p2'])) {
                            // Extract the base domain and unique part
                            $baseDomainToRemove = $this->extractBaseDomain($fullDomain);
                            $pattern = "/\." . preg_quote($baseDomainToRemove, '/') . "$/";
                            $uniquePart = preg_replace($pattern, '', $methods['cname_validation_p1']);
                            Log::error("FullDomain: $fullDomain");
                            $value = $methods['cname_validation_p2'];

                            // Create the CNAME record using ClouDNS API for the base domain
                            $createResponse = $clouDNSApiService->createCNAMERecord($baseDomainToRemove, $uniquePart, $value);

                            // Check if the CNAME record creation was successful
                            if (isset($createResponse['status']) && $createResponse['status'] === 'Success') {
                                Log::info("CNAME record created successfully for $uniquePart for $baseDomainToRemove");
                            } else {
                                // Handle the error scenario
                                Log::error("Failed to create CNAME record for $uniquePart for $baseDomainToRemove");
                                Log::error("Failed to create CNAME record for $uniquePart for $baseDomainToRemove: " . json_encode($createResponse));
                            }
                        }
                    }


                    foreach ($validationDetails as $fullDomain => $methods) {
                        $timeout = 600; // 10 minutes timeout
                        $checkInterval = 30; // check every 30 seconds
                        $startTime = time();

                        // Get the expected CNAME records from $validationDetails
                        $expectedCnameRecord = $methods['cname_validation_p1'];
                        $expectedCnameValue = $methods['cname_validation_p2'];

                        Log::info("Checking DNS propagation for: $expectedCnameRecord");

                        while (true) {
                            // Query the DNS record
                            $dnsRecords = dns_get_record($expectedCnameRecord, DNS_CNAME);
                            $found = false;

                            foreach ($dnsRecords as $record) {
                                if ($record['type'] == 'CNAME' && strtolower($record['target']) == strtolower($expectedCnameValue)) {
                                    $found = true;
                                    break;
                                } else {
                                    Log::info("Current DNS propagation target - expected: " . strtolower($record['target']) . " - " . strtolower($expectedCnameValue));
                                }
                            }

                            if ($found) {
                                Log::info("DNS record propagated for $fullDomain");
                                break;
                            } else {
                                if (time() - $startTime > $timeout) {
                                    Log::error("Timeout reached while waiting for DNS propagation for $fullDomain");
                                    break;
                                }

                                // Wait for $checkInterval seconds before checking again
                                sleep($checkInterval);
                            }
                        }
                    }


                    $verificationResult = $zeroSslService->verifyDomain($certificateResponse['id']);
                    Log::info('Domain verification sep 1.');
                    if (isset($verificationResult['id'])) {
                        // Set a timeout for the verification loop
                        $verificationTimeout = 600;  // 10 minutes timeout
                        $verificationCheckInterval = 30;  // check every 30 seconds
                        $verificationStartTime = time();

                        while (true) {
                            // Request the latest verification status
                            $validation = $zeroSslService->verificationStatus($verificationResult['id']);
                            Log::info('Checking domain verification status...');

                            if (isset($validation['validation_completed']) && $validation['validation_completed'] == 1) {
                                Log::info('Domain verification successful.');
                                break;  // Exit the loop if validation is completed
                            } else {
                                // Check if the timeout has been reached
                                if (time() - $verificationStartTime > $verificationTimeout) {
                                    Log::error("Timeout reached while waiting for domain verification to complete.");
                                    break;  // Exit the loop if timeout is reached
                                }

                                // Wait before checking the status again
                                sleep($verificationCheckInterval);
                            }
                        }

                        if (isset($validation['validation_completed']) && $validation['validation_completed'] == 1) {
                            // $certificated = $this->zeroSslService->downloadCertificateInline($verificationResult['id']);
                            // Set a timeout for the certificate availability check
                            $certificateTimeout = 600;  // 10 minutes timeout
                            $certificateCheckInterval = 30;  // check every 30 seconds
                            $certificateStartTime = time();

                            while (true) {
                                // Attempt to download the certificate
                                $certificated = $zeroSslService->downloadCertificateInline($verificationResult['id']);
                                Log::info('Checking for certificate availability...');

                                if (isset($certificated['certificate.crt'])) {
                                    Log::info('Certificate is available.');
                                    break;  // Exit the loop if the certificate is available
                                } else {
                                    // Check if the timeout has been reached
                                    if (time() - $certificateStartTime > $certificateTimeout) {
                                        Log::error("Timeout reached while waiting for the certificate to become available.");
                                        break;  // Exit the loop if timeout is reached
                                    }

                                    // Wait before trying to download the certificate again
                                    sleep($certificateCheckInterval);
                                }
                            }
                            if (isset($certificated['certificate.crt'])) {
                                // $certificatedID = $this->forgeService->installExistingCertificate($sslCertificate->private_key, $certificated['certificate.crt']);
                                // Log::debug("certificatedID: " . json_encode($certificatedID));

                                // Log::info('Certificate ID: ' . $certificatedID->id);

                                // Active the certificates
                                //$this->forgeService->activateCertificate($certificatedID->id);

                                //Save Cert
                                $sslCertificate->fullCert = $certificated['certificate.crt'];
                                $sslCertificate->save();

                                try {
                                    // Your data
                                    $domain = $this->domain;
                                    $certData = [
                                        'cert' => $certificated['certificate.crt'], // Assuming this is binary data
                                        'private_key' => $sslCertificate->private_key, // Assuming this is binary data
                                    ];

                                    // Connection to the remote MySQL database
                                    $connection = DB::connection('remote_mysql');
                                    $connection->table('ssl_certificates')->upsert([
                                        ['domain' => $domain, 'cert' => $certData['cert'], 'private_key' => $certData['private_key']],
                                    ], 'domain', ['cert', 'private_key']);
                                } catch (\Exception $e) {
                                    Log::error("Database operation failed: " . $e->getMessage());
                                    // Additional error handling as needed
                                }


                                //Update site to active 
                                $tenant->siteSpecs->update([
                                    'status' => 'active',
                                    'taskFinished' => true,
                                ]);
                            } else {
                                Log::error('Failed to retrieve the certificate.');
                                // Handle the case where the certificate is not available, possibly by logging the error or notifying an administrator
                            }
                        } else {
                            Log::error("Failed to validade SSL Domains SSL ID: " . $verificationResult['id']);
                        }
                    } else {
                        Log::error('Domain verification failed.');
                        // Handle the failure case, possibly by logging the error or notifying an administrator
                    }
                } else {
                    Log::error("Failed to create a certificate for the domains.");
                }
            }

            Log::info('SSL creation process for all domains completed.');
        }

        Log::info('Any domain to make ssl.');
    }
}
