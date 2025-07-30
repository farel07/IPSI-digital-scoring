<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Matches;
use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Arena;
use App\Models\UserMatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Roles
        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'referee'],
            ['name' => 'coach'],
        ]);

        // Users
        DB::table('users')->insert([
            ['username' => 'admin1', 'name' => 'Admin One', 'password' => Hash::make('password'), 'role_id' => 1],
            ['username' => 'ref1', 'name' => 'Referee One', 'password' => Hash::make('password'), 'role_id' => 2],
            ['username' => 'coach1', 'name' => 'Coach One', 'password' => Hash::make('password'), 'role_id' => 3],
        ]);

        // Class Categories
        DB::table('class_categories')->insert([
            ['name' => 'Junior', 'gender' => 'M'],
            ['name' => 'Senior', 'gender' => 'F'],
        ]);

        // Player Categories
        DB::table('player_categories')->insert([
            ['category' => 'A', 'range' => '40-45', 'class_category_id' => 1],
            ['category' => 'B', 'range' => '46-50', 'class_category_id' => 1],
            ['category' => 'C', 'range' => '51-55', 'class_category_id' => 2],
        ]);

        // Players
        DB::table('players')->insert([
            ['name' => 'Andi', 'contingent' => 'Jakarta', 'player_category_id' => 1, 'gender' => 'M', 'status' => 'aktif'],
            ['name' => 'Budi', 'contingent' => 'Bandung', 'player_category_id' => 2, 'gender' => 'M', 'status' => 'aktif'],
            ['name' => 'Sari', 'contingent' => 'Surabaya', 'player_category_id' => 3, 'gender' => 'F', 'status' => 'aktif'],
        ]);

        // Bracket
        DB::table('bracket')->insert([
            ['player_category_id' => 1, 'name' => 'Bracket A'],
            ['player_category_id' => 2, 'name' => 'Bracket B'],
        ]);

        // Arena
        DB::table('arena')->insert([
            ['arena_name' => 'Arena 1'],
            ['arena_name' => 'Arena 2'],
        ]);

        // Matches
        DB::table('matches')->insert([
            ['name' => 'Match 1', 'arena_id' => 1, 'date' => now(), 'status' => 'pending', 'bracket_id' => 1, 'player_id' => 1],
            ['name' => 'Match 2', 'arena_id' => 2, 'date' => now(), 'status' => 'pending', 'bracket_id' => 2, 'player_id' => 2],
        ]);

        // User Match (pivot)
        DB::table('user_match')->insert([
            ['user_id' => 1, 'match_id' => 1],
            ['user_id' => 2, 'match_id' => 2],
        ]);

        // Player Match
        DB::table('player_match')->insert([
            [
                'match_id' => 1,
                'player_id' => 1,
                'side' => 'red',
                'round' => 1,
                'punch_point' => 5,
                'kick_point' => 3,
                'fall_point' => 0,
                'binaan_point' => 1,
                'teguran' => 0,
                'peringatan' => 0,
                'total_point' => 9,
                'is_winner' => true
            ],
            [
                'match_id' => 1,
                'player_id' => 2,
                'side' => 'blue',
                'round' => 1,
                'punch_point' => 4,
                'kick_point' => 2,
                'fall_point' => 1,
                'binaan_point' => 0,
                'teguran' => 1,
                'peringatan' => 0,
                'total_point' => 5,
                'is_winner' => false
            ]
        ]);

    }
}
