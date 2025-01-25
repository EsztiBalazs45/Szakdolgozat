<?php

namespace Database\Seeders;

use App\Models\admin;
use App\Models\appointment;
use App\Models\client;
use App\Models\service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => fake()->name(),
            'username' => fake()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => fake()->password(),
        ]);
        admin::factory()->create([
            'username' => fake()->userName(),
            'password' => fake()->password(),
        ]);
        client::factory()->create([
            'companyname'=>fake()->name(),
            'tax_number'=>fake()->randomNumber(9, true),
            'registration_number'=>fake()->randomNumber(9, true),
            'headquarters'=>fake()->address(),
            'contact_person'=>fake()->name(),
            'contact_number'=>fake()->phoneNumber(),
        ]);
        service::factory()->create([
            'service_name' => fake()->name(),
            'service_description' => fake()->paragraph(),
            'service_price' => fake()->randomFloat(2, 0, 100000),
        ]);

        
    }
}
