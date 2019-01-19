<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            // __DIR__ . '/../../vendor/twitter/bootstrap/dist' => public_path('vendor/bootstrap'),
            // __DIR__ . '/../../vendor/fortawesome/font-awesome' => public_path('vendor/fontawesome'),
            // __DIR__ . '/../../vendor/ivaynberg/select2/dist/' => public_path('vendor/select2'),
            // __DIR__ . '/../../vendor/datatables/datatables/media/' => public_path('vendor/datatables'),
            // __DIR__ . '/../../vendor/onokumus/metismenu/dist/' => public_path('vendor/metismenu'),
        ], 'public');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
