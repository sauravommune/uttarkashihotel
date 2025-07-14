<?php

namespace App\Providers;

use App\Services\GmailService;
use Illuminate\Support\ServiceProvider;

class GmailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(GmailService::class, function($app) {
            return new GmailService();
        });

        $this->app->alias(GmailService::class, 'gmail');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }


}
