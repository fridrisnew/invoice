<?php

namespace Fridris\Invoice;

use Illuminate\Support\ServiceProvider;

class InvoiceServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            Invoice::class,
            function () {
                return new Invoice();
            }
        );

        $this->app->alias(Invoice::class, 'invoice-pl');
        $this->app->register(\Barryvdh\DomPDF\ServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadViewsFrom(__DIR__.'/views', 'invoice');
        $this->publishes([
                             __DIR__.'/views' => resource_path('views/vendor/invoice'),
                         ]);
        $this->publishes([
                             __DIR__.'/config/invoice.php' => config_path('invoice.php'),
                         ]);
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->mergeConfigFrom(
            __DIR__.'/config/invoice.php', 'invoice'
        );

      // $this->loadRoutesFrom(__DIR__."/routes.php");
      //  $this->loadViewsFrom(__DIR__."/views", "test");

        /*$this->publishes([
                             __DIR__.'/../public' => public_path('vendor/courier'),
                         ], 'public');*/

        /*$this->publishes([
            __DIR__."/views" => base_path('resources/views/Laravel/Test/views')
        ]);*/
    }
}
