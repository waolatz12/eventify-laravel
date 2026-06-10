<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('venues')->insert([
            [
                'name' => 'Grand Hall',
                'address' => '123 Main St',
                'city' => 'Metropolis',
                'state' => 'NY',
                'country' => 'USA',
                'capacity' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Conference Center',
                'address' => '456 Elm St',
                'city' => 'Gotham',
                'state' => 'NJ',
                'country' => 'USA',
                'capacity' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
