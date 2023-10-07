<?php

namespace MichaelCrowcroft\CloudIP\Database\Factories;

use MichaelCrowcroft\CloudIP\Models\CloudIP;
use Illuminate\Database\Eloquent\Factories\Factory;

class CloudIPFactory extends Factory
{
    protected $model = CloudIP::class;

    public function definition(): array
    {
        return [
            'ip_prefix' => fake()->ipv4() . "/" . fake()->numberBetween(1, 32), //move this to a method where we can define ipv4 or ipv6
            // 'ip_prefix' => fake()->ipv6() . "/" . fake()->numberBetween(1, 128),
            'region' => fake()->countryCode(),
            'service' => fake()->company(),
        ];
    }
}