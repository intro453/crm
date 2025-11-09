<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = bcrypt('password');

        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => $password,
                'role' => 'admin',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Manager User',
                'email' => 'manager@example.com',
                'password' => $password,
                'role' => 'manager',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lawyer User',
                'email' => 'lawyer@example.com',
                'password' => $password,
                'role' => 'lawyer',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        $faker = Faker::create();
        $roles = ['admin', 'manager', 'lawyer'];

        for ($i = 0; $i < 100; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => $password,
                'role' => $roles[array_rand($roles)],
                'is_active' => $faker->boolean(80),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
