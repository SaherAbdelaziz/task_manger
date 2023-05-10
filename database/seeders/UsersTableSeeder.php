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
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => Hash::make('password'),
            ]);
        }

        // Create 100 admins
        for ($i = 1; $i <= 2; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => "admin$i@example.com",
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]);
        }
    }
}
