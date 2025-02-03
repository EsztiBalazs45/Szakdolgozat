<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'companyname'=>fake()->name(),
            'tax_number'=>fake()->randomNumber(9, true),
            'registration_number'=>fake()->randomNumber(9, true),
            'headquarters'=>fake()->address(),
            'contact_person'=>fake()->name(),
            'contact_number'=>fake()->phoneNumber(),
            'user_id'=> fake()->numberBetween(1, 10),
        ];
    }
}
