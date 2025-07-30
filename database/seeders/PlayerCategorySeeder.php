<?php

namespace Database\Seeders;

use App\Models\ClassCategory;
use App\Models\PlayerCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayerCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID dari setiap ClassCategory agar dinamis
        $classCategories = ClassCategory::all()->keyBy(function ($item) {
            return $item->name . '_' . $item->gender;
        });

        $usiaDiniLakiId = $classCategories['Usia Dini_Laki-Laki']->id;
        $usiaDiniWanitaId = $classCategories['Usia Dini_Wanita']->id;
        $praRemajaLakiId = $classCategories['Pra-Remaja_Laki-Laki']->id;
        $praRemajaWanitaId = $classCategories['Pra-Remaja_Wanita']->id;
        $remajaLakiId = $classCategories['Remaja_Laki-Laki']->id;
        $remajaWanitaId = $classCategories['Remaja_Wanita']->id;
        $dewasaLakiId = $classCategories['Dewasa_Laki-Laki']->id;
        $dewasaWanitaId = $classCategories['Dewasa_Wanita']->id;

        // Data Kategori
        $categories = [
            // Usia Dini - Laki-Laki
            ['class_id' => $usiaDiniLakiId, 'category' => 'A', 'range' => '26 kg sampai 28 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'B', 'range' => 'Diatas 28 kg sampai 30 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'C', 'range' => 'Diatas 30 kg sampai 32 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'D', 'range' => 'Diatas 32 kg sampai 34 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'E', 'range' => 'Diatas 34 kg sampai 36 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'F', 'range' => 'Diatas 36 kg sampai 38 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'G', 'range' => 'Diatas 38 kg sampai 40 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'H', 'range' => 'Diatas 40 kg sampai 42 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'I', 'range' => 'Diatas 42 kg sampai 44 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'J', 'range' => 'Diatas 44 kg sampai 46 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'K', 'range' => 'Diatas 46 kg sampai 48 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'L', 'range' => 'Diatas 48 kg sampai 50 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'M', 'range' => 'Diatas 50 kg sampai 52 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'N', 'range' => 'Diatas 52 kg sampai 54 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'O', 'range' => 'Diatas 54 kg sampai 56 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'P', 'range' => 'Diatas 56 kg sampai 58 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'Q', 'range' => 'Diatas 58 kg sampai 60 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'R', 'range' => 'Diatas 60 kg sampai 62 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'S', 'range' => 'Diatas 62 kg sampai 64 kg', 'filter' => 'Usia Dini Laki-Laki'],
            ['class_id' => $usiaDiniLakiId, 'category' => 'OPEN', 'range' => 'Diatas 64 kg sampai 68 kg', 'filter' => 'Usia Dini Laki-Laki'],

            // Usia Dini - Wanita
            ['class_id' => $usiaDiniWanitaId, 'category' => 'A', 'range' => '26 kg sampai 28 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'B', 'range' => 'Diatas 28 kg sampai 30 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'C', 'range' => 'Diatas 30 kg sampai 32 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'D', 'range' => 'Diatas 32 kg sampai 34 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'E', 'range' => 'Diatas 34 kg sampai 36 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'F', 'range' => 'Diatas 36 kg sampai 38 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'G', 'range' => 'Diatas 38 kg sampai 40 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'H', 'range' => 'Diatas 40 kg sampai 42 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'I', 'range' => 'Diatas 42 kg sampai 44 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'J', 'range' => 'Diatas 44 kg sampai 46 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'K', 'range' => 'Diatas 46 kg sampai 48 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'L', 'range' => 'Diatas 48 kg sampai 50 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'M', 'range' => 'Diatas 50 kg sampai 52 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'N', 'range' => 'Diatas 52 kg sampai 54 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'O', 'range' => 'Diatas 54 kg sampai 56 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'P', 'range' => 'Diatas 56 kg sampai 58 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'Q', 'range' => 'Diatas 58 kg sampai 60 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'R', 'range' => 'Diatas 60 kg sampai 62 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'S', 'range' => 'Diatas 62 kg sampai 64 kg', 'filter' => 'Usia Dini Wanita'],
            ['class_id' => $usiaDiniWanitaId, 'category' => 'OPEN', 'range' => 'Diatas 64 kg sampai 68 kg', 'filter' => 'Usia Dini Wanita'],

            // Pra-Remaja - Laki-Laki
            ['class_id' => $praRemajaLakiId, 'category' => 'A', 'range' => '30kg sampai 33kg', 'filter' => 'Pra-Remaja Laki-Laki'],
            ['class_id' => $praRemajaLakiId, 'category' => 'B', 'range' => 'Diatas 33kg sampai 36kg', 'filter' => 'Pra-Remaja Laki-Laki'],
            ['class_id' => $praRemajaLakiId, 'category' => 'C', 'range' => 'Diatas 36kg sampai 39kg', 'filter' => 'Pra-Remaja Laki-Laki'],
            ['class_id' => $praRemajaLakiId, 'category' => 'D', 'range' => 'Diatas 39kg sampai 42kg', 'filter' => 'Pra-Remaja Laki-Laki'],
            ['class_id' => $praRemajaLakiId, 'category' => 'E', 'range' => 'Diatas 42 kg sampai 45kg', 'filter' => 'Pra-Remaja Laki-Laki'],
            ['class_id' => $praRemajaLakiId, 'category' => 'F', 'range' => 'Diatas 45kg sampai 48kg', 'filter' => 'Pra-Remaja Laki-Laki'],
            ['class_id' => $praRemajaLakiId, 'category' => 'G', 'range' => 'Diatas 48kg sampai 51kg', 'filter' => 'Pra-Remaja Laki-Laki'],
            ['class_id' => $praRemajaLakiId, 'category' => 'H', 'range' => 'Diatas 51kg sampai 54kg', 'filter' => 'Pra-Remaja Laki-Laki'],
            ['class_id' => $praRemajaLakiId, 'category' => 'I', 'range' => 'Diatas 54kg sampai 57kg', 'filter' => 'Pra-Remaja Laki-Laki'],
            ['class_id' => $praRemajaLakiId, 'category' => 'J', 'range' => 'Diatas 57kg sampai 60kg', 'filter' => 'Pra-Remaja Laki-Laki'],
            ['class_id' => $praRemajaLakiId, 'category' => 'K', 'range' => 'Diatas 60 kg sampai 63 kg', 'filter' => 'Pra-Remaja Laki-Laki'],
            ['class_id' => $praRemajaLakiId, 'category' => 'L', 'range' => 'Diatas 63 kg sampai 66kg', 'filter' => 'Pra-Remaja Laki-Laki'],
            ['class_id' => $praRemajaLakiId, 'category' => 'M', 'range' => 'Diatas 66 kg sampai 69kg', 'filter' => 'Pra-Remaja Laki-Laki'],
            ['class_id' => $praRemajaLakiId, 'category' => 'N', 'range' => 'Diatas 69kg sampai 72kg', 'filter' => 'Pra-Remaja Laki-Laki'],
            ['class_id' => $praRemajaLakiId, 'category' => 'O', 'range' => 'Diatas 72kg sampai 75kg', 'filter' => 'Pra-Remaja Laki-Laki'],
            ['class_id' => $praRemajaLakiId, 'category' => 'P', 'range' => 'Diatas 75kg sampai 78kg', 'filter' => 'Pra-Remaja Laki-Laki'],
            ['class_id' => $praRemajaLakiId, 'category' => 'OPEN', 'range' => 'Diatas 78kg sampai 84kg', 'filter' => 'Pra-Remaja Laki-Laki'],

            // Pra-Remaja - Wanita
            ['class_id' => $praRemajaWanitaId, 'category' => 'A', 'range' => '30 kg sampai 33 kg', 'filter' => 'Pra-Remaja Wanita'],
            ['class_id' => $praRemajaWanitaId, 'category' => 'B', 'range' => 'Diatas 33kg sampai 36kg', 'filter' => 'Pra-Remaja Wanita'],
            ['class_id' => $praRemajaWanitaId, 'category' => 'C', 'range' => 'Diatas 36kg sampai 39kg', 'filter' => 'Pra-Remaja Wanita'],
            ['class_id' => $praRemajaWanitaId, 'category' => 'D', 'range' => 'Diatas 39kg sampai 42kg', 'filter' => 'Pra-Remaja Wanita'],
            ['class_id' => $praRemajaWanitaId, 'category' => 'E', 'range' => 'Diatas 42kg sampai 45kg', 'filter' => 'Pra-Remaja Wanita'],
            ['class_id' => $praRemajaWanitaId, 'category' => 'F', 'range' => 'Diatas 45kg sampai 48kg', 'filter' => 'Pra-Remaja Wanita'],
            ['class_id' => $praRemajaWanitaId, 'category' => 'G', 'range' => 'Diatas 48kg sampai 51kg', 'filter' => 'Pra-Remaja Wanita'],
            ['class_id' => $praRemajaWanitaId, 'category' => 'H', 'range' => 'Diatas 51kg sampai 54kg', 'filter' => 'Pra-Remaja Wanita'],
            ['class_id' => $praRemajaWanitaId, 'category' => 'I', 'range' => 'Diatas 54kg sampai 57kg', 'filter' => 'Pra-Remaja Wanita'],
            ['class_id' => $praRemajaWanitaId, 'category' => 'J', 'range' => 'Diatas 57kg sampai 60kg', 'filter' => 'Pra-Remaja Wanita'],
            ['class_id' => $praRemajaWanitaId, 'category' => 'K', 'range' => 'Diatas 60 kg sampai 63 kg', 'filter' => 'Pra-Remaja Wanita'],
            ['class_id' => $praRemajaWanitaId, 'category' => 'L', 'range' => 'Diatas 63 kg sampai 66kg', 'filter' => 'Pra-Remaja Wanita'],
            ['class_id' => $praRemajaWanitaId, 'category' => 'M', 'range' => 'Diatas 66 kg sampai 69kg', 'filter' => 'Pra-Remaja Wanita'],
            ['class_id' => $praRemajaWanitaId, 'category' => 'N', 'range' => 'Diatas 69kg sampai 72kg', 'filter' => 'Pra-Remaja Wanita'],
            ['class_id' => $praRemajaWanitaId, 'category' => 'O', 'range' => 'Diatas 72kg sampai 75kg', 'filter' => 'Pra-Remaja Wanita'],
            ['class_id' => $praRemajaWanitaId, 'category' => 'P', 'range' => 'Diatas 75kg sampai 78kg', 'filter' => 'Pra-Remaja Wanita'],
            ['class_id' => $praRemajaWanitaId, 'category' => 'OPEN', 'range' => 'Diatas 78kg sampai 84kg', 'filter' => 'Pra-Remaja Wanita'],

            // Remaja - Laki-Laki
            ['class_id' => $remajaLakiId, 'category' => '> 39', 'range' => 'Dibawah 39kg', 'filter' => 'Remaja Laki-Laki'],
            ['class_id' => $remajaLakiId, 'category' => 'A', 'range' => 'Diatas 39kg sampai 43kg', 'filter' => 'Remaja Laki-Laki'],
            ['class_id' => $remajaLakiId, 'category' => 'B', 'range' => 'Diatas 43kg sampai 47kg', 'filter' => 'Remaja Laki-Laki'],
            ['class_id' => $remajaLakiId, 'category' => 'C', 'range' => 'Diatas 47kg sampai 51kg', 'filter' => 'Remaja Laki-Laki'],
            ['class_id' => $remajaLakiId, 'category' => 'D', 'range' => 'Diatas 51kg sampai 55kg', 'filter' => 'Remaja Laki-Laki'],
            ['class_id' => $remajaLakiId, 'category' => 'E', 'range' => 'Diatas 55kg sampai 59kg', 'filter' => 'Remaja Laki-Laki'],
            ['class_id' => $remajaLakiId, 'category' => 'F', 'range' => 'Diatas 59 kg sampai 63kg', 'filter' => 'Remaja Laki-Laki'],
            ['class_id' => $remajaLakiId, 'category' => 'G', 'range' => 'Diatas 63 kg sampai 67kg', 'filter' => 'Remaja Laki-Laki'],
            ['class_id' => $remajaLakiId, 'category' => 'H', 'range' => 'Diatas 67kg sampai 71kg', 'filter' => 'Remaja Laki-Laki'],
            ['class_id' => $remajaLakiId, 'category' => 'I', 'range' => 'Diatas 71kg sampai 75kg', 'filter' => 'Remaja Laki-Laki'],
            ['class_id' => $remajaLakiId, 'category' => 'J', 'range' => 'Diatas 75kg sampai 79kg', 'filter' => 'Remaja Laki-Laki'],
            ['class_id' => $remajaLakiId, 'category' => 'K', 'range' => 'Diatas 79kg sampai 83kg', 'filter' => 'Remaja Laki-Laki'],
            ['class_id' => $remajaLakiId, 'category' => 'L', 'range' => 'Diatas 83kg sampai 87kg', 'filter' => 'Remaja Laki-Laki'],
            ['class_id' => $remajaLakiId, 'category' => 'OPEN 1', 'range' => 'Diatas 87kg sampai 100kg', 'filter' => 'Remaja Laki-Laki'],
            ['class_id' => $remajaLakiId, 'category' => 'OPEN 2', 'range' => 'Diatas 100kg', 'filter' => 'Remaja Laki-Laki'],

            // Remaja - Wanita
            ['class_id' => $remajaWanitaId, 'category' => '> 39', 'range' => 'Dibawah 39kg', 'filter' => 'Remaja Wanita'],
            ['class_id' => $remajaWanitaId, 'category' => 'A', 'range' => 'Diatas 39kg sampai 43kg', 'filter' => 'Remaja Wanita'],
            ['class_id' => $remajaWanitaId, 'category' => 'B', 'range' => 'Diatas 43kg sampai 47kg', 'filter' => 'Remaja Wanita'],
            ['class_id' => $remajaWanitaId, 'category' => 'C', 'range' => 'Diatas 47kg sampai 51kg', 'filter' => 'Remaja Wanita'],
            ['class_id' => $remajaWanitaId, 'category' => 'D', 'range' => 'Diatas 51kg sampai 55kg', 'filter' => 'Remaja Wanita'],
            ['class_id' => $remajaWanitaId, 'category' => 'E', 'range' => 'Diatas 55kg sampai 59kg', 'filter' => 'Remaja Wanita'],
            ['class_id' => $remajaWanitaId, 'category' => 'F', 'range' => 'Diatas 59 kg sampai 63kg', 'filter' => 'Remaja Wanita'],
            ['class_id' => $remajaWanitaId, 'category' => 'G', 'range' => 'Diatas 63 kg sampai 67kg', 'filter' => 'Remaja Wanita'],
            ['class_id' => $remajaWanitaId, 'category' => 'H', 'range' => 'Diatas 67kg sampai 71kg', 'filter' => 'Remaja Wanita'],
            ['class_id' => $remajaWanitaId, 'category' => 'I', 'range' => 'Diatas 71kg sampai 75kg', 'filter' => 'Remaja Wanita'],
            ['class_id' => $remajaWanitaId, 'category' => 'J', 'range' => 'Diatas 75kg sampai 79kg', 'filter' => 'Remaja Wanita'],
            ['class_id' => $remajaWanitaId, 'category' => 'OPEN 1', 'range' => 'Diatas 79kg sampai 92kg', 'filter' => 'Remaja Wanita'],
            ['class_id' => $remajaWanitaId, 'category' => 'OPEN 2', 'range' => 'Diatas 92kg', 'filter' => 'Remaja Wanita'],

            // Dewasa - Laki-Laki
            ['class_id' => $dewasaLakiId, 'category' => '> 45', 'range' => 'Dibawah 45kg', 'filter' => 'Dewasa Laki-Laki'],
            ['class_id' => $dewasaLakiId, 'category' => 'A', 'range' => 'Diatas 45kg sampai 50kg', 'filter' => 'Dewasa Laki-Laki'],
            ['class_id' => $dewasaLakiId, 'category' => 'B', 'range' => 'Diatas 50 kg sampai 55kg', 'filter' => 'Dewasa Laki-Laki'],
            ['class_id' => $dewasaLakiId, 'category' => 'C', 'range' => 'Diatas 55kg sampai 60kg', 'filter' => 'Dewasa Laki-Laki'],
            ['class_id' => $dewasaLakiId, 'category' => 'D', 'range' => 'Diatas 60 kg sampai 65 kg', 'filter' => 'Dewasa Laki-Laki'],
            ['class_id' => $dewasaLakiId, 'category' => 'E', 'range' => 'Diatas 65 kg sampai 70kg', 'filter' => 'Dewasa Laki-Laki'],
            ['class_id' => $dewasaLakiId, 'category' => 'F', 'range' => 'Diatas 70kg sampai 75kg', 'filter' => 'Dewasa Laki-Laki'],
            ['class_id' => $dewasaLakiId, 'category' => 'G', 'range' => 'Diatas 75kg sampai 80kg', 'filter' => 'Dewasa Laki-Laki'],
            ['class_id' => $dewasaLakiId, 'category' => 'H', 'range' => 'Diatas 80 kg sampai 85kg', 'filter' => 'Dewasa Laki-Laki'],
            ['class_id' => $dewasaLakiId, 'category' => 'I', 'range' => 'Diatas 85 kg sampai 90kg', 'filter' => 'Dewasa Laki-Laki'],
            ['class_id' => $dewasaLakiId, 'category' => 'J', 'range' => 'Diatas 90 kg sampai 95kg', 'filter' => 'Dewasa Laki-Laki'],
            ['class_id' => $dewasaLakiId, 'category' => 'OPEN 1', 'range' => 'Diatas 95kg sampai 110kg', 'filter' => 'Dewasa Laki-Laki'],
            ['class_id' => $dewasaLakiId, 'category' => 'OPEN 2', 'range' => 'Diatas 110kg', 'filter' => 'Dewasa Laki-Laki'],

            // Dewasa - Wanita
            ['class_id' => $dewasaWanitaId, 'category' => '> 45', 'range' => 'Dibawah 45kg', 'filter' => 'Dewasa Wanita'],
            ['class_id' => $dewasaWanitaId, 'category' => 'A', 'range' => 'Diatas 45kg sampai 50kg', 'filter' => 'Dewasa Wanita'],
            ['class_id' => $dewasaWanitaId, 'category' => 'B', 'range' => 'Diatas 50kg sampai 55kg', 'filter' => 'Dewasa Wanita'],
            ['class_id' => $dewasaWanitaId, 'category' => 'C', 'range' => 'Diatas 55kg sampai 60kg', 'filter' => 'Dewasa Wanita'],
            ['class_id' => $dewasaWanitaId, 'category' => 'D', 'range' => 'Diatas 60 kg sampai 65 kg', 'filter' => 'Dewasa Wanita'],
            ['class_id' => $dewasaWanitaId, 'category' => 'E', 'range' => 'Diatas 65 kg sampai 70kg', 'filter' => 'Dewasa Wanita'],
            ['class_id' => $dewasaWanitaId, 'category' => 'F', 'range' => 'Diatas 70kg sampai 75kg', 'filter' => 'Dewasa Wanita'],
            ['class_id' => $dewasaWanitaId, 'category' => 'G', 'range' => 'Diatas 75kg sampai 80kg', 'filter' => 'Dewasa Wanita'],
            ['class_id' => $dewasaWanitaId, 'category' => 'H', 'range' => 'Diatas 80kg sampai 85kg', 'filter' => 'Dewasa Wanita'],
            ['class_id' => $dewasaWanitaId, 'category' => 'OPEN 1', 'range' => 'Diatas 85kg sampai 100kg', 'filter' => 'Dewasa Wanita'],
            ['class_id' => $dewasaWanitaId, 'category' => 'OPEN 2', 'range' => 'Diatas 100kg', 'filter' => 'Dewasa Wanita'],
        ];

        foreach ($categories as $category) {
            PlayerCategory::firstOrCreate(
                [
                    'class_category_id' => $category['class_id'],
                    'category' => $category['category'],
                ],
                [
                    'range' => $category['range'],
                    'filter' => $category['filter'],
                ]
            );
        }
    }
}
