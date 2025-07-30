<?php

namespace Database\Seeders;

use App\Models\Matches;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Matches::firstOrCreate([
            'name' => 'Match 1',
            'date' => now(),
            'status' => 'active',
            'round' => 'I',
            'arena_id' => 1,
            'bracket_id' => 82,
            'player_id' => null
        ]);
    }
}
