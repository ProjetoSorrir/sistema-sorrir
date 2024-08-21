<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function show($filename)
    {
        $filePath = public_path('pdf/' . $filename);

        return $this->returnPdfOr404($filePath, $filename);
    }

    private function returnPdfOr404($filePath, $filename)
    {
        if (file_exists($filePath)) {
            return response()->file($filePath);
        } else {
            abort(404);
        }
    }
}