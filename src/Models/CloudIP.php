<?php

namespace MichaelCrowcroft\CloudIP\Models;

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

    public function scopeHasIP(Builder $query, $ip): void
    {
        $ip = IP::parse($ip);

        $query->where('first_ip', '<=', $ip->toLong())
            ->where('last_ip', '>=', $ip->toLong())
            ->sole();
    }

    protected $guarded = [];
}