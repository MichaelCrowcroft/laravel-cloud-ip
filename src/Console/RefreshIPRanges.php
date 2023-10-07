<?php

namespace MichaelCrowcroft\CloudIP\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetIPRange extends Command
{
    protected $signature = 'cloudip:get {provider}';

    protected $description = 'Get a cloud providers published IP ranges.';

    public function handle()
    {
        // CloudIP::get();
        $provider = $this->argument('provider');

        $ip_locations = [
            'AWS' => 'https://ip-ranges.amazonaws.com/ip-ranges.json',
            'GCP' => 'https://www.gstatic.com/ipranges/cloud.json',
        ];

        return Http::get($ip_locations[$provider]);
    }
}