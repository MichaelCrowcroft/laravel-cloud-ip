<?php

namespace MichaelCrowcroft\CloudIP;

use Illuminate\Support\Facades\Http;

class CloudIP
{
    protected array $ip_ranges;

    public function get(string $provider = null)
    {
        $ip_locations = [
            'AWS' => 'https://ip-ranges.amazonaws.com/ip-ranges.json',
            'GCP' => 'https://www.gstatic.com/ipranges/cloud.json',
        ];

        $this->ip_ranges = Http::get($ip_locations[$provider])->json();

        dd($this->ip_ranges[0]);

        return $this;
    }
}