<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


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


        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ArenaSeeder::class,
            ClassCategoriesSeeder::class,
            PlayerCategorySeeder::class,
            PlayerSeeder::class,
            BracketSeeder::class,
            MatchSeeder::class,
            UserMatchSeeder::class,
            PlayerMatchSeeder::class
        ]);
    }
}
