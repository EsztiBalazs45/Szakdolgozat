<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'timeline' => $this->faker->time(),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'canceled']),
            'description' => $this->faker->sentence(),
        ];
    }
}
