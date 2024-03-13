<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('species')->insert([
            'animal_species' => 'Dog',
        ]);
        DB::table('species')->insert([
            'animal_species' => 'Cat',
        ]);
        DB::table('species')->insert([
            'animal_species' => 'Bird',
        ]);
        DB::table('species')->insert([
            'animal_species' => 'Fish',
        ]);
        DB::table('species')->insert([
            'animal_species' => 'Reptile',
        ]);
    }
}
