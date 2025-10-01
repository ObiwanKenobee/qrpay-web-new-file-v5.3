<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DisasterModeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('disaster-mode', function ($app) {
            return new \App\Services\DisasterMode(config('disaster-mode'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/disaster-mode.php' => config_path('disaster-mode.php'),
        ], 'disaster-mode-config');

        if (config('disaster-mode.active')) {
            $this->bootDisasterMode();
        }
    }

    /**
     * Configure disaster mode services.
     */
    protected function bootDisasterMode(): void
    {
        $this->app->singleton('emergency-services', function ($app) {
            return new \App\Services\EmergencyServices(
                config('disaster-mode.emergency_data'),
                config('disaster-mode.emergency_sms'),
                config('disaster-mode.emergency_calls')
            );
        });

        $this->app->singleton('mesh-network', function ($app) {
            return new \App\Services\MeshNetwork(
                config('disaster-mode.mesh_network')
            );
        });
    }
}