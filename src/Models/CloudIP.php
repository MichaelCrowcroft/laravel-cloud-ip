<?php

namespace MichaelCrowcroft\CloudIP\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MichaelCrowcroft\CloudIP\Database\Factories\CloudIPFactory;

class CloudIP extends Model
{
    use HasFactory;

    protected $table = 'cloud_ips';

    protected $guarded = [];

    protected static function newFactory()
    {
        return CloudIPFactory::new();
    }
}