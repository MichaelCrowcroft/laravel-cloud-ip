<?php

namespace MichaelCrowcroft\CloudIP\Traits;

use MichaelCrowcroft\CloudIP\Models\CloudIP;

trait HasCloudIps
{
  public function cloudIPs()
  {
    return $this->morphMany(CloudIP::class, 'author');
  }
}