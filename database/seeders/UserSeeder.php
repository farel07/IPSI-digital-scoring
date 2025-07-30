<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID dari setiap role untuk dihubungkan ke user
        // Menggunakan first() karena kita yakin datanya sudah ada dari RoleSeeder
        $operatorRole = Role::where('name', 'operator')->first();
        $juriRole = Role::where('name', 'juri')->first();
        $dewanRole = Role::where('name', 'dewan')->first();
        $timerRole = Role::where('name', 'timer')->first();

        // Membuat user dengan password default 'password'
        // Password di-hash menggunakan Hash::make() untuk keamanan

        // User Operator
        User::firstOrCreate(
            ['username' => 'operator1'],
            [
                'name' => 'Operator 1',
                'password' => Hash::make('sandiOperator1'),
                'role_id' => $operatorRole->id,
            ]
        );

        // User Juri
        User::firstOrCreate(
            ['username' => 'juri1'],
            [
                'name' => 'Juri 1',
                'password' => Hash::make('sandiJuri1'),
                'role_id' => $juriRole->id,
            ]
        );
        User::firstOrCreate(
            ['username' => 'juri2'],
            [
                'name' => 'Juri 2',
                'password' => Hash::make('sandiJurii2'),
                'role_id' => $juriRole->id,
            ]
        );
        User::firstOrCreate(
            ['username' => 'juri3'],
            [
                'name' => 'Juri 3',
                'password' => Hash::make('sandiJuri3'),
                'role_id' => $juriRole->id,
            ]
        );

        // User Dewan
        User::firstOrCreate(
            ['username' => 'dewan1'],
            [
                'name' => 'Dewan 1',
                'password' => Hash::make('sandiDewan1'),
                'role_id' => $dewanRole->id,
            ]
        );

        // User Timer
        User::firstOrCreate(
            ['username' => 'timer1'],
            [
                'name' => 'Timer 1',
                'password' => Hash::make('sandiTimer1'),
                'role_id' => $timerRole->id,
            ]
        );
    }
}
