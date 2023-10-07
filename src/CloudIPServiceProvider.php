<?php

namespace MichaelCrowcroft\CloudIP;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use MichaelCrowcroft\CloudIP\Console\GetIPRange;

class CloudIPServiceProvider extends ServiceProvider
{
    public function register()
    {
      $this->app->bind('cloudip', function($app) {
          return new CloudIP();
      });
    }

    public function boot()
    {
        $this->commands([
            GetIPRange::class,
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
      }
  }