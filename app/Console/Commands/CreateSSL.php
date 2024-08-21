<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Services\ClouDNSApiService;
use App\Services\ForgeService;
use App\Services\SslService;
use App\Services\ZeroSSLCertificateService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateSSL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:ssl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create alias and SSL on forge';

    protected $forgeService;

    private $sslService;

    private $zeroSslService;

    private $clouDNSApiService;

    public function __construct(ForgeService $forgeService, SslService $sslService, ZeroSSLCertificateService $zeroSslService, ClouDNSApiService $clouDNSApiService)
    {
        parent::__construct();

        $this->forgeService = $forgeService;

        $this->sslService = $sslService;

        $this->zeroSslService = $zeroSslService;

        $this->clouDNSApiService = $clouDNSApiService;
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
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('SSL creation process started.');
        $domainsToSSL = [];

        $tenants = Tenant::with('siteSpecs')->get();
        foreach ($tenants as $tenant) {
            if ($tenant->siteSpecs && $tenant->siteSpecs->status === 'creating_ssl' && !$tenant->siteSpecs->taskFinished) {
                foreach ($tenant->domains as $domain) {
                    array_push($domainsToSSL, $domain->domain);
                }
            }
        }

        //GET already actived domains to SSL only if new domain will be activated
        if (count($domainsToSSL) > 0) {
            foreach ($tenants as $tenant) {
                if ($tenant->siteSpecs && $tenant->siteSpecs->status === 'active' && $tenant->siteSpecs->taskFinished) {
                    foreach ($tenant->domains as $domain) {
                        array_push($domainsToSSL, $domain->domain);
                    }
                }
            }
        }

        foreach ($domainsToSSL as $value) {
            $this->info('Domain: ' . $value);
        }

        //Mantain the LP Site SSL
        if (count($domainsToSSL) > 0) {
            //Add domains on alias forge
            $this->forgeService->addDomainAlias($domainsToSSL);

            array_push($domainsToSSL, 'rifando-apps.com');

            // Remove duplicate domains
            $domainsToSSL = array_unique($domainsToSSL);

            // Generate one CSR for all domains and subdomains
            $this->info("Generating CSR for all domains...");
            $sslCertificate = $this->sslService->generateCSR($domainsToSSL);

            if ($sslCertificate) {
                $validcsrparse = str_replace("\n", "", $sslCertificate->csr);
                // Create a certificate with ZeroSSL using the CSR that includes all domains
                $certificateResponse = $this->zeroSslService->createCertificate($domainsToSSL, $validcsrparse);
                //Log::debug("certificateResponse: ", $certificateResponse);

                if ($certificateResponse['status'] == 'draft') {
                    $this->info("Certificate creation initiated for all domains, proceeding with verification...");
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
                            $this->error("FullDomain: $fullDomain");
                            $value = $methods['cname_validation_p2'];

                            // Create the CNAME record using ClouDNS API for the base domain
                            $createResponse = $this->clouDNSApiService->createCNAMERecord($baseDomainToRemove, $uniquePart, $value);

                            // Check if the CNAME record creation was successful
                            if (isset($createResponse['status']) && $createResponse['status'] === 'Success') {
                                $this->info("CNAME record created successfully for $uniquePart for $baseDomainToRemove");
                            } else {
                                // Handle the error scenario
                                $this->error("Failed to create CNAME record for $uniquePart for $baseDomainToRemove");
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

                        $this->info("Checking DNS propagation for: $expectedCnameRecord");

                        while (true) {
                            // Query the DNS record
                            $dnsRecords = dns_get_record($expectedCnameRecord, DNS_CNAME);
                            $found = false;

                            foreach ($dnsRecords as $record) {
                                if ($record['type'] == 'CNAME' && strtolower($record['target']) == strtolower($expectedCnameValue)) {
                                    $found = true;
                                    break;
                                } else {
                                    $this->info("Current DNS propagation target - expected: " . strtolower($record['target']) . " - " . strtolower($expectedCnameValue));
                                }
                            }

                            if ($found) {
                                $this->info("DNS record propagated for $fullDomain");
                                break;
                            } else {
                                if (time() - $startTime > $timeout) {
                                    $this->error("Timeout reached while waiting for DNS propagation for $fullDomain");
                                    break;
                                }

                                // Wait for $checkInterval seconds before checking again
                                sleep($checkInterval);
                            }
                        }
                    }


                    $verificationResult = $this->zeroSslService->verifyDomain($certificateResponse['id']);
                    $this->info('Domain verification sep 1.');
                    if (isset($verificationResult['id'])) {
                        // Set a timeout for the verification loop
                        $verificationTimeout = 600;  // 10 minutes timeout
                        $verificationCheckInterval = 30;  // check every 30 seconds
                        $verificationStartTime = time();

                        while (true) {
                            // Request the latest verification status
                            $validation = $this->zeroSslService->verificationStatus($verificationResult['id']);
                            $this->info('Checking domain verification status...');

                            if (isset($validation['validation_completed']) && $validation['validation_completed'] == 1) {
                                $this->info('Domain verification successful.');
                                break;  // Exit the loop if validation is completed
                            } else {
                                // Check if the timeout has been reached
                                if (time() - $verificationStartTime > $verificationTimeout) {
                                    $this->error("Timeout reached while waiting for domain verification to complete.");
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
                                $certificated = $this->zeroSslService->downloadCertificateInline($verificationResult['id']);
                                $this->info('Checking for certificate availability...');

                                if (isset($certificated['certificate.crt'])) {
                                    $this->info('Certificate is available.');
                                    break;  // Exit the loop if the certificate is available
                                } else {
                                    // Check if the timeout has been reached
                                    if (time() - $certificateStartTime > $certificateTimeout) {
                                        $this->error("Timeout reached while waiting for the certificate to become available.");
                                        break;  // Exit the loop if timeout is reached
                                    }

                                    // Wait before trying to download the certificate again
                                    sleep($certificateCheckInterval);
                                }
                            }
                            if (isset($certificated['certificate.crt'])) {
                                $certificatedID = $this->forgeService->installExistingCertificate($sslCertificate->private_key, $certificated['certificate.crt']);
                                Log::debug("certificatedID: " . json_encode($certificatedID));

                                $this->info('Certificate ID: ' . $certificatedID->id);

                                // Active the certificates
                                $this->forgeService->activateCertificate($certificatedID->id);

                                //Update sites to active 
                                foreach ($tenants as $tenant) {
                                    if ($tenant->siteSpecs && $tenant->siteSpecs->status === 'creating_ssl' && !$tenant->siteSpecs->taskFinished) {
                                        $tenant->siteSpecs->update([
                                            'status' => 'active',
                                            'taskFinished' => true,
                                        ]);
                                    }
                                }
                            } else {
                                $this->error('Failed to retrieve the certificate.');
                                // Handle the case where the certificate is not available, possibly by logging the error or notifying an administrator
                            }
                        } else {
                            Log::error("Failed to validade SSL Domains SSL ID: " . $verificationResult['id']);
                        }
                    } else {
                        $this->error('Domain verification failed.');
                        // Handle the failure case, possibly by logging the error or notifying an administrator
                    }
                } else {
                    $this->error("Failed to create a certificate for the domains.");
                }
            }

            $this->info('SSL creation process for all domains completed.');
        }

        $this->info('Any domain to make ssl.');
    }
}
