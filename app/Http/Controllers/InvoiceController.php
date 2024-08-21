<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    public function downloadInvoice($invoiceId)
    {
        try {
            $invoice = Invoice::findOrFail($invoiceId);

            // Verifica se o caminho do comprovante no S3 está definido
            if (!$invoice->invoice_path) {
                Log::error('Erro ao encontrar o caminho do comprovante: ' . $e->getMessage());
                if(Auth::user()->isAdmin()){
                    return redirect()->route('pedidos')->with('alertMessage', 'Por favor, tente novamente mais tarde.');
                }
                return redirect()->route('my-buys')->with('alertMessage', 'Por favor, tente novamente mais tarde.');
            }

            // Gerar um identificador único para a URL temporária
            $uniqueIdentifier = (string) Str::uuid();

            // Extrair o caminho do arquivo do invoice_path 
            $urlPath = parse_url($invoice->invoice_path, PHP_URL_PATH);
            $filePath = ltrim($urlPath, '/');

            // Gerar uma url temporária para download de 1 min
            $expiration = Carbon::now()->addMinutes(1);
            $url = Storage::disk('s3')->temporaryUrl($filePath, $expiration, [
                'ResponseContentDisposition' => 'attachment; filename=' . $uniqueIdentifier . '.pdf',
            ]);

            // Redireciona para a URL e fazer o download
            return redirect()->away($url);

        } catch (\Exception $e) {
            Log::error('Erro ao gerar URL temporária para o comprovante: ' . $e->getMessage());
            if(Auth::user()->isAdmin()){
                return redirect()->route('pedidos')->with('alertMessage', 'Por favor, tente novamente mais tarde.');
            }
            return redirect()->route('my-buys')->with('alertMessage', 'Por favor, tente novamente mais tarde.');
        }
    }
}