<?php

namespace App\Helpers;

class WebhookHelper
{
    public static function sendWebhook($url, $data)
    {
        // Inicializa cURL
        $ch = curl_init($url);

        // Configurações do cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        // Converte o array de dados para JSON
        $jsonData = json_encode($data);

        // Adiciona os dados JSON ao corpo do POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

        // Executa a requisição
        $response = curl_exec($ch);

        // Verifica se houve algum erro na requisição
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }

        // Fecha a conexão cURL
        curl_close($ch);

        // Retorna a resposta ou o erro, se houver
        if (isset($error_msg)) {
            return 'Erro: ' . $error_msg;
        } else {
            return 'Resposta: ' . $response;
        }
    }
}