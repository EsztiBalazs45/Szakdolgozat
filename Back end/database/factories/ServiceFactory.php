<?php

namespace Database\Factories;

use App\Models\service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_name'=>fake()->jobTitle(),
            'service_description'=>fake()->text(),
            'service_price'=>fake()->randomNumber(5, true),
            'service_id'=> fake()->numberBetween(1, 10),
        ];
    }
}
