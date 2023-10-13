<?php

use Illuminate\Support\Facades\Artisan;
use MichaelCrowcroft\CloudIP\Models\CloudIP;

it('can have an ip_prefix', function () {
    Artisan::call('cloudip:get');

    $cloud_ip = CloudIP::hasIP('192.168.1.1');
    expect($cloud_ip)->toBeNull();

    $cloud_ip = CloudIP::hasIP('3.9.159.64');
    expect($cloud_ip->provider)->toBe('AWS');
});
