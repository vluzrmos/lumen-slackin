<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TranslatorServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(
            'Symfony\Component\Translation\TranslatorInterface', function () {
            return $this->app['translator'];
        }
        );
    }
}
