<?php

namespace MichaelCrowcroft\CloudIP\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use IPTools\IP;
use Symfony\Component\HttpFoundation\IpUtils;

class CloudIP extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'cloud_ips';

    public static function HasIP($ip): self|null
    {
        $ip = IP::parse($ip);

        return CloudIP::where('first_ip', '<=', $ip->toLong())
            ->where('last_ip', '>=', $ip->toLong())
            ->first();
    }

    protected $guarded = [];
}