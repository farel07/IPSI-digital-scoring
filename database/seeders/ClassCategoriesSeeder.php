<?php

namespace Database\Seeders;

use App\Models\ClassCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassCategory::firstOrCreate(
            [
                'name' => 'Usia Dini',
                'gender' => 'Laki-Laki'
            ]
        );

        ClassCategory::firstOrCreate(
            [
                'name' => 'Usia Dini',
                'gender' => 'Wanita'
            ]
        );

        ClassCategory::firstOrCreate(
            [
                'name' => 'Pra-Remaja',
                'gender' => 'Laki-Laki'
            ]
        );

        ClassCategory::firstOrCreate(
            [
                'name' => 'Pra-Remaja',
                'gender' => 'Wanita'
            ]
        );

        ClassCategory::firstOrCreate(
            [
                'name' => 'Remaja',
                'gender' => 'Laki-Laki'
            ]
        );

        ClassCategory::firstOrCreate(
            [
                'name' => 'Remaja',
                'gender' => 'Wanita'
            ]
        );

        ClassCategory::firstOrCreate(
            [
                'name' => 'Dewasa',
                'gender' => 'Laki-Laki'
            ]
        );

        ClassCategory::firstOrCreate(
            [
                'name' => 'Dewasa',
                'gender' => 'Wanita'
            ]
        );
    }
}
