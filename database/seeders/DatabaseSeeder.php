<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat User Admin
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('password'), // password: password
            'email_verified_at' => now(),
        ]);

        // Buat User Dosen Contoh
        \App\Models\User::create([
            'name' => 'Budi Dosen',
            'email' => 'dosen@example.com',
            'role' => 'dosen',
            'password' => \Illuminate\Support\Facades\Hash::make('password'), // password: password
            'email_verified_at' => now(),
        ]);
    
        // Buat 5 User Mahasiswa Contoh
        \App\Models\User::factory(5)->create();
    
        // Panggil Seeder Mata Kuliah
        $this->call([
            MataKuliahSeeder::class,
            JadwalSeeder::class,
        ]);
    }
}
