<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\WildResilience;

class WildResilienceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('wild-resilience', function ($app) {
            return new WildResilience(config('wild-resilience'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/wild-resilience.php' => config_path('wild-resilience.php'),
        ], 'wild-resilience-config');
    }
}