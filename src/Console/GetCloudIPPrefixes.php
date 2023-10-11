<?php

namespace MichaelCrowcroft\CloudIP\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use IPTools\Range;
use MichaelCrowcroft\CloudIP\Models\CloudIP;

class GetCloudIPPrefixes extends Command
{
    protected $signature = 'cloudip:get';

    protected $description = 'Get a cloud providers published IP ranges.';

    public function handle()
    {
        $ip_prefixes = [];
        $aws = Http::get('https://ip-ranges.amazonaws.com/ip-ranges.json')->json();
        $gcp = Http::get('https://www.gstatic.com/ipranges/cloud.json')->json();
        // $azure = Http::get('https://download.microsoft.com/download/7/1/D/71D86715-5596-4529-9B13-DA13A5DE5B63/ServiceTags_Public_20231009.json')->json();

        foreach($aws['ipv6_prefixes'] as $ip) {
            $range = Range::parse($ip['ipv6_prefix']);
            $first_ip = $range->firstIP->long;
            $last_ip = $range->lastIP->long;
            $ip_prefixes[] = [
                'service' => $ip['service'],
                'type' => 'ipv6',
                'ip_prefix' => $ip['ipv6_prefix'],
                'first_ip' => $first_ip,
                'last_ip' => $last_ip,
                'region' => $ip['region'],
            ];
        }
        foreach($aws['prefixes'] as $ip) {
            $range = Range::parse($ip['ip_prefix']);
            $first_ip = $range->firstIP->long;
            $last_ip = $range->lastIP->long;
            $ip_prefixes[] = [
                'service' => $ip['service'],
                'type' => 'ipv4',
                'ip_prefix' => $ip['ip_prefix'],
                'first_ip' => $first_ip,
                'last_ip' => $last_ip,
                'region' => $ip['region'],
            ];
        }

        foreach($gcp['prefixes'] as $ip) {
            $ip_prefix = isset($ip['ipv4Prefix']) ? $ip['ipv4Prefix'] : $ip['ipv6Prefix'];
            $range = Range::parse($ip_prefix);
            $first_ip = $range->firstIP->long;
            $last_ip = $range->lastIP->long;
            $ip_prefixes[] = [
                'service' => $ip['service'],
                'type' => isset($ip['ipv4Prefix']) ? 'ipv4' : 'ipv6',
                'ip_prefix' => $ip_prefix,
                'first_ip' => $first_ip,
                'last_ip' => $last_ip,
                'region' => $ip['scope'],
            ];
        }
        collect($ip_prefixes)->chunk(1000)->each(function (Collection $ips) {
            CloudIP::insert($ips->toArray());
        });

        return true;
    }
}