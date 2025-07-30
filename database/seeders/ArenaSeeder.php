<?php

namespace Database\Seeders;

use App\Models\Arena;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArenaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Arena::firstOrCreate(['arena_name' => 'Arena 1']);
        Arena::firstOrCreate(['arena_name' => 'Arena 2']);
        Arena::firstOrCreate(['arena_name' => 'Arena 3']);
    }
}
