<?php

namespace Ladumor\LaravelPwa;

use Illuminate\Support\ServiceProvider;
use Ladumor\LaravelPwa\commands\PublishPWA;

class PWAServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->publishes([
        __DIR__.'/../config/laravelpwa.php' => config_path('laravelpwa.php'),
        __DIR__.'/../public' => public_path('laravelpwa'),
    ], 'laravel-pwa'); 
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton('laravel-pwa:publish', function ($app) {
        return new PublishPWA();
       });

      $this->commands([
          'laravel-pwa:publish',
      ]);
    }
}
