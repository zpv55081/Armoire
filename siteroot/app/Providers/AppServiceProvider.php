<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PdfUploadServiceInterface;
use App\Services\S3PdfUploadService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PdfUploadServiceInterface::class, S3PdfUploadService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
