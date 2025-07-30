<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\PlayerCategory;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Player::firstOrCreate([
            'name' => 'Lord Morpheus',
            'contingent' => 'The Dreaming',
            'gender' => 'Laki-Laki',
            'status' => 'active',
            'player_category_id' => 82
        ]);

        Player::firstOrCreate([
            'name' => 'Lucifer Morningstar',
            'contingent' => 'Hell',
            'gender' => 'Laki-Laki',
            'status' => 'active',
            'player_category_id' => 82
        ]);
    }
}
