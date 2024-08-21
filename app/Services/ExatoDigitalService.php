<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class ExatoDigitalService
{
    private $token, $url;

    public function __construct()
    {
        $this->token = env('EXATO_TOKEN');
        $this->url = env('EXATO_URL');
    }

    /**
     * Performs two consults and crosses the two for greater data security
     *
     * @return array||false An array containing the combined results of the consultations, or false if an error occurred.
     */
    public function consultCpf($cpf)
    {   
        $consult_cpf = $this->consult($cpf, 'cpf');
        if(!$consult_cpf){
            return false;
        }

        $consult_uid = $this->consult($consult_cpf['UniqueIdentifier'], 'uid');
        if(!$consult_uid){
            return false;
        }

        if (
            isset($consult_cpf['Result']['SituacaoCadastral']) && 
            $consult_cpf['Result']['SituacaoCadastral'] == 'REGULAR' && 
            isset($consult_uid['Result']['SituacaoCadastral']) && 
            $consult_uid['Result']['SituacaoCadastral'] == 'REGULAR'
        ) {
            // Also check if 'NomePessoaFisica' and 'DataNascimento' keys exist before accessing them
            $name = isset($consult_uid['Result']['NomePessoaFisica']) ? $consult_uid['Result']['NomePessoaFisica'] : null;
            $birth_date = isset($consult_uid['Result']['DataNascimento']) ? $consult_uid['Result']['DataNascimento'] : null;
        
            return [
                'name' => $name,
                'birth_date' => $birth_date
            ];
        }
        

        return false;
    }

    /**
     * performs the request for Exato Digital
     *
     * @return array||false False if an error occurred.
     */
    private function consult($data, $type)
    {
        try{
            $header = [
                'accept' => 'application/json',
                'Token' => $this->token,
            ];

            if($type == 'cpf'){
                $paramers = ['cpf' => $data];
            }else{
                $paramers = ['uid' => $data];
            }

            $response = Http::withHeaders($header)->get($this->url, $paramers);

            $response_data = $response->json();          

            if(!$response_data || $response_data['TransactionResultTypeCode'] =! 1 || $response_data['TransactionResultTypeCode'] =! 2 ){
                return false;
            }

            return $response_data;

        }catch(Exception $e){
            return false;
        }
    }
}