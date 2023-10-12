<?php

namespace MichaelCrowcroft\CloudIP\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloudIP extends Model
{
    use HasFactory;

    protected $table = 'cloud_ips';

    protected $guarded = [];
}