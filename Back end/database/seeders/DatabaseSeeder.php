<?php

namespace Database\Seeders;

use App\Models\admin;
use App\Models\appointment;
use App\Models\client;
use App\Models\data;
use App\Models\newsletter;
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


        User::factory(100)->create();
        Client::factory(75)->create();
        Appointment::factory(25)->create();
        Admin::factory(1)->create();
        $service_user = \App\Models\Service_user::factory(10)->create();
        \App\Models\service::factory(10)->create([
            'service_id' => $service_user->random()->id,
        ]);
        Newsletter::factory(5)->create();

        
    }
}
