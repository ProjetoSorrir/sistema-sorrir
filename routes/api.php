<?php

use App\Http\Controllers\DNSController;
use App\Jobs\CreateSSLJob;
use App\Models\Tenant;
use App\Services\ClouDNSApiService;
use App\Services\DNSService;
use App\Services\ForgeService;
use App\Services\SslService;
use App\Services\ZeroSSLCertificateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/test', function (Request $request) {
//     $domain = "querosertech.com";
//     $tenantId = "querosertech.com";
//     CreateSSLJob::dispatch($domain, $tenantId)->onQueue('default');
//     return 'sended';
// });

// Route::get('/test', function (Request $request) {
//     $url = $request->query('url', 'defaultdomain.com');
//     $parts = explode('.', $url);
//     $baseDomain = '';

//     // Known TLDs which are country-specific and have two segments, add more as needed
//     $specialTLDs = ['com.br', 'co.uk', 'com.au', 'co.in', 'app.br', 'net.br'];

//     // Check from the end of the domain if we have any special TLDs
//     if (count($parts) >= 2) {
//         $lastTwoParts = $parts[count($parts) - 2] . '.' . $parts[count($parts) - 1];
//         if (in_array($lastTwoParts, $specialTLDs)) {
//             // For special cases like 'com.br', 'co.uk', etc.
//             $baseDomain = count($parts) >= 3 ? $parts[count($parts) - 3] . '.' . $lastTwoParts : $lastTwoParts;
//         } else {
//             // Regular domains (e.g., .com, .org)
//             $baseDomain = count($parts) >= 2 ? $parts[count($parts) - 2] . '.' . $parts[count($parts) - 1] : $url;
//         }
//     }

//     $baseDomainToRemove = $baseDomain;
//     $pattern = "/\." . preg_quote($baseDomainToRemove, '/') . "$/";
//     $uniquePart = preg_replace($pattern, '', '_CDE81B8F9D1E7319F1CDB5CB884C9132');

//     return [$baseDomain, $uniquePart];
// });


// Route::get('/test', function (Request $request) {
//     $url = $request->query('url', 'defaultdomain.com');
//     $dns = new DNSService();
//     return $dns->checkDNS($url);
// });


// Route::get('/test', function (Request $request) {
//     $domainsToSSL = [];

//     $tenants = Tenant::with('siteSpecs')->get();
//     foreach ($tenants as $tenant) {
//         if ($tenant->siteSpecs && $tenant->siteSpecs->status === 'creating_ssl' && !$tenant->siteSpecs->taskFinished) {
//             foreach ($tenant->domains as $domain) {
//                 array_push($domainsToSSL, $domain->domain);
//             }
//         }
//     }

//     //GET already actived domains to SSL only if new domain will be activated
//     if (count($domainsToSSL) > 0) {
//         foreach ($tenants as $tenant) {
//             if ($tenant->siteSpecs && $tenant->siteSpecs->status === 'active' && $tenant->siteSpecs->taskFinished) {
//                 foreach ($tenant->domains as $domain) {
//                     array_push($domainsToSSL, $domain->domain);
//                 }
//             }
//         }
//     }

//     array_push($domainsToSSL, 'rifandosonhos.online');

//     // Remove duplicate domains
//     $domainsToSSL = array_unique($domainsToSSL);

//     $dns = new SslService();
//     $csr = $dns->generateCSR($domainsToSSL);
//     $validcsrparse = str_replace("\n", "", $csr->csr);

//     $zeroSSL = new ZeroSSLCertificateService();
//     $validcsr = $zeroSSL->validateCSR($validcsrparse);
//     return [$csr, $validcsrparse, $validcsr];
// });


// Route::get('/test', function (Request $request) {
//     $domain = 'www.bikepremiosbrasil.com.br';
//     $parts = explode('.', $domain);
//     $baseDomain = '';

//     // Known TLDs which are country-specific and have two segments, add more as needed
//     $specialTLDs = ['com.br', 'co.uk', 'com.au', 'co.in'];

//     // Check from the end of the domain if we have any special TLDs
//     if (count($parts) >= 2) {
//         $lastTwoParts = $parts[count($parts) - 2] . '.' . $parts[count($parts) - 1];
//         if (in_array($lastTwoParts, $specialTLDs)) {
//             // For special cases like 'com.br', 'co.uk', etc.
//             $baseDomain = count($parts) >= 3 ? $parts[count($parts) - 3] . '.' . $lastTwoParts : $lastTwoParts;
//         } else {
//             // Regular domains (e.g., .com, .org)
//             $baseDomain = count($parts) >= 2 ? $parts[count($parts) - 2] . '.' . $parts[count($parts) - 1] : $domain;
//         }
//     }

//     return $baseDomain;
// });
