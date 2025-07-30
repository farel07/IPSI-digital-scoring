<?php

namespace Database\Seeders;

use App\Models\Bracket;
use App\Models\PlayerCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BracketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua kategori pemain beserta relasi ke ClassCategory
        $playerCategories = PlayerCategory::with('classCategory')->get();

        // Siapkan array kosong untuk menampung data bracket
        $bracketsToInsert = [];

        // Loop melalui setiap player category yang ada
        foreach ($playerCategories as $playerCategory) {
            // Pastikan relasi classCategory ada untuk menghindari error
            if ($playerCategory->classCategory) {
                // Buat nama bracket sesuai format yang diinginkan
                $bracketName = 'Bracket ' .
                    $playerCategory->category . ', ' .
                    $playerCategory->classCategory->name . ' ' .
                    $playerCategory->classCategory->gender;

                // Tambahkan data bracket ke dalam array untuk bulk insert
                $bracketsToInsert[] = [
                    'player_category_id' => $playerCategory->id,
                    'name' => $bracketName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Hapus semua data lama di tabel bracket untuk menghindari duplikasi
        // Bracket::truncate();

        Bracket::insert($bracketsToInsert);
    }
}
