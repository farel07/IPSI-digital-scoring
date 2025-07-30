<?php

namespace Database\Seeders;

use App\Models\UserMatch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserMatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $userIds = [1, 2, 3, 4, 5, 6];
        $matchIds = [1];
        $dataToInsert = [];

        foreach ($matchIds as $matchId) {
            // Loop melalui setiap user ID
            foreach ($userIds as $userId) {
                $dataToInsert[] = [
                    'user_id' => $userId,
                    'match_id' => $matchId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Kosongkan tabel terlebih dahulu untuk memastikan data bersih
        // UserMatch::truncate();

        // Masukkan semua data sekaligus untuk efisiensi
        UserMatch::insert($dataToInsert);
    }
}
