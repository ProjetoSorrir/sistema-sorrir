<?php

namespace App\Services;

use App\Helpers\WebhookHelper;
use App\Models\Invoice;
use App\Models\Settings;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;
use Str;

class MercadoPagoService
{
    public $action = [];
    public $paymentId;
    public string $name;
    public string $email;
    public string $phone;

    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(Settings::get('mercado_pago_token'));
    }

    public function checkPaymentStatus($paymentId)
    {
        $client = new PaymentClient();
        return $client->get($paymentId);
    }

    public function receivedWebhook(Request $request)
    {
        $payload = json_decode($request->getContent(), true);
        if (isset($payload['action']) && $payload['action'] == 'payment.updated' && $payload['type'] == 'payment') {
            $paymentId = $payload['data']['id'];
            $invoice = Invoice::where('mercado_livre_id', $paymentId)->first();
            $status = (new \App\Services\MercadoPagoService())->checkPaymentStatus($paymentId);
            if ($status->status == 'approved' && $invoice) {
                $invoice->dispatchPaymentJob();
                return response()->json(['message' => 'Success!'], 200);
            }

        }
        return response()->json($payload, 200);

    }

    public function receivedWebhook2(Request $request)
    {
        // Decode the JSON body from the request
        $payload = json_decode($request->getContent(), true);
        Log::info('Mercado Pago Request', ['payload' => $payload]);

        // Verifica se as chaves necessárias existem no payload
        if (!isset($payload['resource']) || !isset($payload['topic'])) {
            Log::error('Payload incompleto: falta a chave resource ou topic', ['payload' => $payload]);
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        // Extrai as informações necessárias do payload
        $resource = $payload['resource'];
        $topic = $payload['topic'];

        // Verifica se o tópico é 'payment'
        if ($topic === 'payment') {
            // Faz uma requisição para obter os detalhes do pagamento usando a URL no campo resource
            $paymentDetails = $this->getPaymentDetails($resource);

            // Loga os detalhes do pagamento para análise
            Log::info('Payment Details Response', ['paymentDetails' => $paymentDetails]);

            if (!$paymentDetails || !isset($paymentDetails['id'])) {
                Log::error('Falha ao obter os detalhes do pagamento ou chave id não encontrada', ['resource' => $resource, 'paymentDetails' => $paymentDetails]);
                return response()->json(['error' => 'Failed to fetch payment details or ID not found'], 400);
            }

            $paymentId = $paymentDetails['id'];
            $action = "payment.updated"; // Define a ação apropriada

            // Busca a fatura associada ao paymentId
            $invoice = Invoice::where('mercado_livre_id', $paymentId)->first();

            // Verifica se a fatura foi encontrada
            if (!$invoice) {
                Log::error('Fatura não encontrada para o paymentId fornecido', ['paymentId' => $paymentId]);
                return response()->json(['error' => 'Invoice not found'], 404);
            }

            // Dados para o webhook
            $data = [
                "Nome" => $invoice->user->name,
                "email" => $invoice->user->email,
                "telefone" => $invoice->user->phone,
                "qtd_titulos" => $invoice->getNumberQty(),
                "valor_total" => $invoice->amount,
                "data_pagamento" => $invoice->payed_at->format('M d, Y h:i a'),
                "sorteio" => $invoice->raffle->name,
                "user_id" => $invoice->user->id,
                "dt_nascimento" => $invoice->user->birth_date,
                "Origen" => 'Compra de Título - Pagamento Realizado'
            ];

            // Chama o helper para enviar o webhook
            $webhookUrl = 'https://growthphantom.app.n8n.cloud/webhook/cf299562-6071-450d-945a-edb2588ba3cf';
            WebhookHelper::sendWebhook($webhookUrl, $data);

            // Log the request for debugging purposes
            Log::info('Send Webhook to n8n MERCADO PAGO SERVICE - receivedWebhook ==> BRASCAP', ['data' => $data]);

            // Process the webhook based on the action and payment ID
            switch ($action) {
                case "payment.updated":
                    // Implement logic based on the payment update
                    $status = $this->checkPaymentStatus($paymentId);
                    if ($status->status == 'approved') {
                        return $this->markAsPaid($paymentId);
                    }
                    break;
                default:
                    return response()->json(['message' => 'Action not supported'], 400);
            }
        } else {
            return response()->json(['message' => 'Topic not supported'], 400);
        }
    }

    private function getPaymentDetails($resource)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $resource, [
                'headers' => [
                    'Authorization' => 'Bearer ' . Settings::get('mercado_pago_token')
                ]
            ]);
            $data = json_decode($response->getBody()->getContents(), true);
            Log::info('Raw Payment Details Response', ['data' => $data]); // Loga a resposta completa
            return $data;
        } catch (\Exception $e) {
            Log::error('Erro ao buscar detalhes do pagamento', ['message' => $e->getMessage()]);
            return null;
        }
    }

    public function markAsPaid($paymentId)
    {
        $invoice = Invoice::where('mercado_livre_id', $paymentId)->first();

        if ($invoice->invoice_path) {
            return false;
        }

        // Generate receipt content
        $pdfContent = PDF::loadView('receipts.invoice', ['invoice' => $invoice])->output();
        $receiptName = 'receipt-' . Str::uuid() . '-' . $invoice->id . '.pdf';

        // Use Storage facade to save the PDF
        Storage::disk('public')->put('invoices/' . $receiptName, $pdfContent);

        $invoice->update([
            'payment_voucher_path' => 'mercado_pago',
            'payed_at' => Carbon::now(),
            'invoice_path' => 'invoices/' . $receiptName,
        ]);

        // Check if refer_id is not null and credit percent to the referrer's balance
        if (!is_null($invoice->refer_id)) {
            $referrer = User::find($invoice->refer_id);
            if ($referrer && (getCommissioning())) {
                $commissioning_percentage = 0;
                $commissioning_percentage = floatval(getCommissioningPercentage());
                $creditAmount = bcmul($invoice->amount, $commissioning_percentage, 2); //Calculate de acordo com a porcentagem do admin
                $referrer->balance += $creditAmount; // Assume you have a balance column
                $referrer->save();

                $invoice->update([
                    'refer_amount' => $creditAmount,
                    'refer_percentage' => $commissioning_percentage,
                    'refer_payment_status' => 'Pending'
                ]);
                // Optionally, you might want to add a record to a ledger or transaction history table here.
            }
        }

        // Dados para o webhook
        $data = [
            "Nome" => $invoice->user->name,
            "email" => $invoice->user->email,
            "telefone" => $invoice->user->phone,
            "qtd_titulos" => $invoice->getNumberQty(),
            "valor_total" => $invoice->amount,
            "data_pagamento" => $invoice->payed_at->format('M d, Y h:i a'),
            "sorteio" => $invoice->raffle->name,
            "user_id" => $invoice->user->id,
            "dt_nascimento" => $invoice->user->birth_date,
            // "qtd_compras" => '12',//1,
            // "Valor_total_compras" =>  '12',//$amount,
            "Origen" => 'Compra de Título - Pagamento Realizado'
        ];

        // Chama o helper para enviar o webhook
        $webhookUrl = 'https://growthphantom.app.n8n.cloud/webhook/cf299562-6071-450d-945a-edb2588ba3cf';
        WebhookHelper::sendWebhook($webhookUrl, $data);

        // Log the request for debugging purposes
        Log::info('Send Webhook to n8n MERCADO PAGO SERVICE markAsPaid -  ==> BRASCAP', ['data' => $data]);

        return true;
    }
}
