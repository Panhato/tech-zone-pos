<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // ១. បន្ថែមបន្ទាត់នេះ

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ២. បន្ថែមប៉ុន្មានបន្ទាត់នេះ ដើម្បីបង្ខំឱ្យប្រើ HTTPS
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
