<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Lumen Laravel 5 Packages Compatibility
         */

        $this->app->configure('pusher');
    }
}
