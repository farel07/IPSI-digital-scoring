<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan firstOrCreate untuk menghindari duplikasi data
        // jika seeder dijalankan lebih dari sekali.
        Role::firstOrCreate(['name' => 'operator']);
        Role::firstOrCreate(['name' => 'juri']);
        Role::firstOrCreate(['name' => 'dewan']);
        Role::firstOrCreate(['name' => 'timer']);
    }
}
