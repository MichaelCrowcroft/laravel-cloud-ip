<?php

use Illuminate\Support\Facades\Artisan;
use MichaelCrowcroft\CloudIP\Models\CloudIP;

it('can have an ip_prefix', function () {
    Artisan::call('cloudip:get');

    $cloud_ip = CloudIP::hasIP('3.2.34.0')->count();

    expect($cloud_ip)->toBe(1);
});