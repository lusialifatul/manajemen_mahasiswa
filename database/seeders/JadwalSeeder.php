<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\User;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mataKuliahIds = MataKuliah::pluck('id')->toArray();
        $dosenIds = User::where('role', 'dosen')->pluck('id')->toArray();

        if (empty($mataKuliahIds)) {
            $this->command->info('No MataKuliah found. Please seed MataKuliah first.');
            return;
        }
        if (empty($dosenIds)) {
            $this->command->info('No Dosen (users with role "dosen") found. Please create some dosen users first.');
            return;
        }

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $semesters = ['Ganjil', 'Genap'];
        $tahunAkademik = ['2024/2025', '2023/2024'];
        $ruangan = ['Lab Komputer 1', 'Ruang Kuliah A', 'Ruang Kuliah B', 'Lab Jaringan', 'Auditorium'];

        for ($i = 0; $i < 10; $i++) { // Create 10 dummy schedules
            Jadwal::create([
                'mata_kuliah_id' => $mataKuliahIds[array_rand($mataKuliahIds)],
                'dosen_id' => $dosenIds[array_rand($dosenIds)],
                'hari' => $days[array_rand($days)],
                'waktu_mulai' => sprintf('%02d:00', rand(8, 16)), // Random hour between 08:00 and 16:00
                'waktu_selesai' => sprintf('%02d:00', rand(10, 18)), // Random hour between 10:00 and 18:00
                'ruangan' => $ruangan[array_rand($ruangan)],
                'semester' => $semesters[array_rand($semesters)],
                'tahun_akademik' => $tahunAkademik[array_rand($tahunAkademik)],
            ]);
        }
    }
}