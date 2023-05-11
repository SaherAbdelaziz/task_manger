<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as FakerFactory;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create();

        // Create 10000 users
        for ($i = 1; $i <= 10000; $i++) {
            if($i == 1)
            {
                User::create([
                    'name' => "SaherUser",
                    'email' => "SaherUser@test.com",
                    'password' => Hash::make('password'),
                ]);
            }
            else {
                User::create([
                    'name' => $faker->name,
                    'email' => $faker->unique()->email,
                    'password' => Hash::make('password'),
                ]);
            }
        }

        // Create 100 admins
        for ($i = 1; $i <= 100; $i++) {

            if($i == 1)
            {
                User::create([
                    'name' => "SaherAdmin",
                    'email' => "SaherAdmin@example.com",
                    'password' => Hash::make('password'),
                    'is_admin' => true,
                ]);
            }
            else {
                User::create([
                    'name' => $faker->name,
                    'email' => "admin$i@example.com",
                    'password' => Hash::make('password'),
                ]);
            }
        }
    }
}
