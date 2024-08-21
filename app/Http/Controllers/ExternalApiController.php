<?php

namespace App\Http\Controllers;

use App\Services\ExatoDigitalService;
use Illuminate\Http\Request;

class ExternalApiController extends Controller
{
    public function checkCPF(Request $req)
    {
        
        $exato_service = new ExatoDigitalService();
        $data = $exato_service->consultCpf($req->cpf);

        if(!$data){
            return [ 'error' => 'O CPF não está em situação regular'];
        }

        return $data;
    }
}
