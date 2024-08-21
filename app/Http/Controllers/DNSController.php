<?php

namespace App\Http\Controllers;

use App\Services\TechnitiumDNSService;
use Illuminate\Http\Request;

class DNSController extends Controller
{
    protected $dnsService;

    public function __construct(TechnitiumDNSService $dnsService)
    {
        $this->dnsService = $dnsService;
    }


    public function createDomain(Request $request)
    {
        // Parâmetros recebidos do formulário ou solicitação
        $domainName = $request->input('domain_name');
        $ipAddress = $request->input('ip_address');

        // Criar o domínio
        $domain = $this->dnsService->createDomain($domainName);
        // Verificar se o domínio foi criado com sucesso antes de prosseguir
        if (isset($domain['status']) && $domain['status'] == 'ok') {
            // Criar o registro A para '@'
            $aRecordCreationResponse = $this->dnsService->createARecord($domainName, $ipAddress);

            // Criar o registro CNAME para 'www'
            //$cnameRecordCreationResponse = $this->dnsService->createCNAMERecord($domainName, 'www');

            // Verificar se os registros foram criados com sucesso  && $cnameRecordCreationResponse['status'] === 'ok'
            if ($aRecordCreationResponse['status'] === 'ok') {
                return response()->json(['message' => 'Domain and records created successfully']);
            } else {
                // Retornar erro se os registros não foram criados
                return response()->json(['error' => 'Failed to create DNS records'], 500);
            }
        } else {
            // Retornar erro se o domínio não foi criado
            return response()->json(['error' => 'Failed to create domain'], 500);
        }
    }
}
