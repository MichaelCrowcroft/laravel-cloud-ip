<?php

use Illuminate\Support\Facades\Artisan;
use MichaelCrowcroft\CloudIP\Console\GetCloudIPPrefixes;
use MichaelCrowcroft\CloudIP\Models\CloudIP;

it('can have an ip_prefix', function () {
    Artisan::call(GetCloudIPPrefixes::class);
    dd(CloudIP::count());
});