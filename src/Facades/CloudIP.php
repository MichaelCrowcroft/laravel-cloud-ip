<?php

namespace MichaelCrowcroft\CloudIP\Facades;

use Illuminate\Support\Facades\Facade;

class CloudIP extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cloudip';
    }
}