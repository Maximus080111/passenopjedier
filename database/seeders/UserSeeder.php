<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Max Overbeek',
            'email' => 'overbeekmax@gmail.com',
            'email_verified_at' => null,
            'password' => bcrypt('Maximus080111'),
            'is_blocked' => 0,
            'is_admin' => 1,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Tim',
            'email' => 'tim@tim.nl',
            'email_verified_at' => null,
            'password' => bcrypt('12345678'),
            'is_blocked' => 0,
            'is_admin' => 0,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
