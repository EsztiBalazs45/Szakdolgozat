<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\newsletter>
 */
class NewsletterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'newsletter_title'=>fake()->name(),
            'newsletter_status'=>fake()->numberBetween(0, 1),
            'user_id'=> fake()->numberBetween(1, 10),
            
        ];
    }
}
