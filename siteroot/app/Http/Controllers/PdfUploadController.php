<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PdfUploadServiceInterface;

class PdfUploadController extends Controller
{
    protected $pdfUploadService;

    public function __construct(PdfUploadServiceInterface $pdfUploadService)
    {
        $this->pdfUploadService = $pdfUploadService;
    }

    public function upload(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:10240', // PDF, макс. 10 МБ
        ]);

        try {
            $url = $this->pdfUploadService->uploadPdf($request->file('pdf_file'));
            return response()->json(['url' => $url], 200);
        } catch (\Exception $e) {
            // Логирование ошибок
            \Log::error('PDF upload failed: ' . $e->getMessage());

            // Возвращаем ошибку клиенту
            return response()->json(['error' => 'Failed to upload PDF'], 500);
        }
    }
}
