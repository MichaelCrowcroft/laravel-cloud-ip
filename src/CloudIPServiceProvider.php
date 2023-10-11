<?php

namespace MichaelCrowcroft\CloudIP;

use Illuminate\Support\ServiceProvider;
use MichaelCrowcroft\CloudIP\Console\GetCloudIPPrefixes;

class CloudIPServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        $this->commands([
            GetCloudIPPrefixes::class,
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
      }
}