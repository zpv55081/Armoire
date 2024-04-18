<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class S3PdfUploadService implements PdfUploadServiceInterface
{
    public function uploadPdf($file)
    {
        try {
            $path = Storage::disk('s3')->putFile('pdf', $file, 'public');
            return Storage::disk('s3')->url($path);
        } catch (\Exception $e) {
            // Логирование ошибок
            \Log::error('Error uploading PDF to S3: ' . $e->getMessage());

            // Повторная попытка загрузки (3 попытки с интервалом в 1 секунду)
            for ($i = 0; $i < 3; $i++) {
                try {
                    $path = Storage::disk('s3')->putFile('pdf', $file, 'public');
                    return Storage::disk('s3')->url($path);
                } catch (\Exception $e) {
                    \Log::error('Error uploading PDF to S3 (retry ' . ($i + 1) . '): ' . $e->getMessage());
                    sleep(1); // Пауза между попытками
                }
            }

            // Если не удалось загрузить файл после повторных попыток, выбрасываем исключение
            throw new \Exception('Error uploading PDF to S3 after retrying');
        }
    }
}
