<?php

namespace Database\Seeders;

use App\Models\PlayerMatch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayerMatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Kosongkan tabel untuk memastikan data bersih
        // PlayerMatch::truncate();

        // Konfigurasi pertandingan individual berdasarkan data Anda
        $matches = [
            ['player_id' => 1, 'side' => 'red'],
            ['player_id' => 2, 'side' => 'blue'],
        ];

        // Loop untuk setiap konfigurasi pertandingan
        foreach ($matches as $m) {
            // Hasilkan data poin acak untuk pemain ini
            $pointsData = $this->generateAndCalculatePoints();


            if ($m['player_id'] == 2) {
                PlayerMatch::create([
                    'match_id'      => 1,
                    'player_id'     => $m['player_id'],
                    'side'          => $m['side'],
                    'round'         => 1, // Hanya ada satu ronde
                    'punch_point'   => $pointsData['punch_point'],
                    'kick_point'    => $pointsData['kick_point'],
                    'fall_point'    => $pointsData['fall_point'],
                    'binaan_point'  => $pointsData['binaan_point'],
                    'teguran'       => $pointsData['teguran'],
                    'peringatan'    => $pointsData['peringatan'],
                    'total_point'   => $pointsData['total_point'],
                    'is_winner'     => false,
                ]);
            } else {
                PlayerMatch::create([
                    'match_id'      => 1,
                    'player_id'     => $m['player_id'],
                    'side'          => $m['side'],
                    'round'         => 1, // Hanya ada satu ronde
                    'punch_point'   => $pointsData['punch_point'],
                    'kick_point'    => $pointsData['kick_point'],
                    'fall_point'    => $pointsData['fall_point'],
                    'binaan_point'  => $pointsData['binaan_point'],
                    'teguran'       => $pointsData['teguran'],
                    'peringatan'    => $pointsData['peringatan'],
                    'total_point'   => $pointsData['total_point'],
                    'is_winner'     => true,
                ]);
            }
        }
    }

    /**
     * Helper function untuk menghasilkan dan menghitung semua poin dalam satu langkah.
     * @return array
     */
    private function generateAndCalculatePoints(): array
    {
        $data = [
            'punch_point'  => rand(0, 8) * 1,
            'kick_point'   => rand(0, 5) * 2,
            'fall_point'   => rand(0, 3) * 3,
            'teguran'      => rand(0, 3),
            'peringatan'   => rand(0, 2),
            'binaan_point' => rand(0, 1),
        ];

        // Hitung total poin akhir
        $data['total_point'] =
            ($data['punch_point'] + $data['kick_point'] + $data['fall_point'] + $data['binaan_point'])
            - ($data['teguran'])
            - ($data['peringatan'] * 3); // Peringatan bernilai -3

        return $data;
    }
}
