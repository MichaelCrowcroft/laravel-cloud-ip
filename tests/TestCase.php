<?php

namespace MichaelCrowcroft\CloudIP\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use MichaelCrowcroft\CloudIP\CloudIPServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'VendorName\\Skeleton\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            CloudIPServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        include_once __DIR__ . '/../database/migrations/2023_10_06_100000_create_cloud_ips_table.php';

        // run the up() method of that migration class
        (new \CreateCloudIPsTable)->up();
    }
}