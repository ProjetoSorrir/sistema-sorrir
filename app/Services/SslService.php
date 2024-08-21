<?php

namespace App\Services;

use App\Models\SslCertificate;

class SslService
{
    public function generateCSR($domains)
    {
        $dn = [
            "countryName" => "US",
            "stateOrProvinceName" => "State",
            "localityName" => "City",
            "organizationName" => "Company",
            "organizationalUnitName" => "Department",
            "commonName" => $domains[0],  // Use the first domain as common name
            "emailAddress" => "email@example.com"
        ];

        // Generate a new private key
        $privateKey = openssl_pkey_new([
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        ]);

        // Prepare SAN string
        $san = implode(",", array_map(function ($domain) {
            return "DNS:$domain";
        }, $domains));

        // Generate CSR with SAN
        $csrResource = openssl_csr_new($dn, $privateKey);
        openssl_csr_export($csrResource, $csrOut);

        // Append SAN details to the CSR
        // $csrOut = str_replace("-----END CERTIFICATE REQUEST-----", "", $csrOut);
        // $csrOut .= "-----BEGIN CERTIFICATE REQUEST-----\n" . $san . "\n-----END CERTIFICATE REQUEST-----\n";

        // Export the private key
        openssl_pkey_export($privateKey, $privateKeyOut);

        // Store the CSR and private key in the database
        $sslCertificate = SslCertificate::updateOrCreate([
            'domain' => implode(',', $domains),  // Store all domains as a comma-separated string
            'private_key' => $privateKeyOut,
            'csr' => $csrOut,
        ]);

        return $sslCertificate;
    }
}
