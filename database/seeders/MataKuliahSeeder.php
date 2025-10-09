<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\Schema;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Matikan pengecekan foreign key untuk truncate
        Schema::disableForeignKeyConstraints();

        // Hapus data lama untuk menghindari duplikasi
        MataKuliah::truncate();

        // Hidupkan kembali pengecekan foreign key
        Schema::enableForeignKeyConstraints();

        $matakuliahs = [
            // Semester 1
            ['semester' => 1, 'kode_mk' => 'STA101', 'nama_mk' => 'Pengantar Statistika', 'sks' => 3, 'keterangan' => 'Dasar-dasar statistik'],
            ['semester' => 1, 'kode_mk' => 'MAT101', 'nama_mk' => 'Kalkulus I', 'sks' => 3, 'keterangan' => 'Dasar matematika kalkulus'],
            ['semester' => 1, 'kode_mk' => 'INF101', 'nama_mk' => 'Pengantar Komputasi', 'sks' => 3, 'keterangan' => 'Dasar pemrograman dan logika komputer'],
            ['semester' => 1, 'kode_mk' => 'MAT102', 'nama_mk' => 'Aljabar Linier', 'sks' => 3, 'keterangan' => 'Matriks dan ruang vektor'],
            ['semester' => 1, 'kode_mk' => 'UNI101', 'nama_mk' => 'Pendidikan Agama', 'sks' => 2, 'keterangan' => 'MK Wajib Umum'],
            ['semester' => 1, 'kode_mk' => 'UNI102', 'nama_mk' => 'Bahasa Indonesia', 'sks' => 2, 'keterangan' => 'MK Wajib Umum'],
            ['semester' => 1, 'kode_mk' => 'UNI103', 'nama_mk' => 'Pancasila dan Kewarganegaraan', 'sks' => 2, 'keterangan' => 'MK Wajib Umum'],
            // Semester 2
            ['semester' => 2, 'kode_mk' => 'STA102', 'nama_mk' => 'Statistika Deskriptif', 'sks' => 3, 'keterangan' => 'Penyajian dan analisis data deskriptif'],
            ['semester' => 2, 'kode_mk' => 'MAT201', 'nama_mk' => 'Kalkulus II', 'sks' => 3, 'keterangan' => 'Integral dan aplikasi'],
            ['semester' => 2, 'kode_mk' => 'INF102', 'nama_mk' => 'Pemrograman Dasar', 'sks' => 3, 'keterangan' => 'Umumnya menggunakan Python/R'],
            ['semester' => 2, 'kode_mk' => 'MAT202', 'nama_mk' => 'Matematika Diskrit', 'sks' => 3, 'keterangan' => 'Logika, himpunan, kombinatorika'],
            ['semester' => 2, 'kode_mk' => 'UNI104', 'nama_mk' => 'Bahasa Inggris Akademik', 'sks' => 2, 'keterangan' => 'MK Umum'],
            ['semester' => 2, 'kode_mk' => 'UNI105', 'nama_mk' => 'Kewirausahaan', 'sks' => 2, 'keterangan' => 'MK Umum'],
            // Semester 3
            ['semester' => 3, 'kode_mk' => 'STA201', 'nama_mk' => 'Probabilitas', 'sks' => 3, 'keterangan' => 'Teori probabilitas'],
            ['semester' => 3, 'kode_mk' => 'STA202', 'nama_mk' => 'Statistika Inferensia I', 'sks' => 3, 'keterangan' => 'Pengujian hipotesis, estimasi parameter'],
            ['semester' => 3, 'kode_mk' => 'MAT301', 'nama_mk' => 'Kalkulus III', 'sks' => 3, 'keterangan' => 'Fungsi beberapa variabel'],
            ['semester' => 3, 'kode_mk' => 'STA203', 'nama_mk' => 'Metode Numerik', 'sks' => 3, 'keterangan' => 'Pendekatan numerik dalam statistik'],
            ['semester' => 3, 'kode_mk' => 'INF201', 'nama_mk' => 'Struktur Data dan Algoritma', 'sks' => 3, 'keterangan' => 'Pendukung analisis statistik'],
            // Semester 4
            ['semester' => 4, 'kode_mk' => 'STA301', 'nama_mk' => 'Statistika Inferensia II', 'sks' => 3, 'keterangan' => 'Lanjutan inferensia 1'],
            ['semester' => 4, 'kode_mk' => 'STA302', 'nama_mk' => 'Analisis Regresi', 'sks' => 3, 'keterangan' => 'Regresi linear dan asumsi klasik'],
            ['semester' => 4, 'kode_mk' => 'STA303', 'nama_mk' => 'Analisis Varians (ANOVA)', 'sks' => 3, 'keterangan' => 'Uji beda lebih dari dua kelompok'],
            ['semester' => 4, 'kode_mk' => 'STA304', 'nama_mk' => 'R Programming untuk Statistika', 'sks' => 2, 'keterangan' => 'Praktikum dan aplikasi R'],
            ['semester' => 4, 'kode_mk' => 'STA305', 'nama_mk' => 'Metodologi Survei', 'sks' => 3, 'keterangan' => 'Desain dan analisis survei'],
            // Semester 5
            ['semester' => 5, 'kode_mk' => 'STA401', 'nama_mk' => 'Statistika Nonparametrik', 'sks' => 3, 'keterangan' => 'Analisis data tanpa asumsi distribusi'],
            ['semester' => 5, 'kode_mk' => 'STA402', 'nama_mk' => 'Analisis Multivariat', 'sks' => 3, 'keterangan' => 'PCA, FA, Cluster, dkk'],
            ['semester' => 5, 'kode_mk' => 'STA403', 'nama_mk' => 'Statistika Industri', 'sks' => 3, 'keterangan' => 'Pengendalian kualitas, Six Sigma'],
            ['semester' => 5, 'kode_mk' => 'STA404', 'nama_mk' => 'Design of Experiment (DoE)', 'sks' => 3, 'keterangan' => 'Rancangan percobaan statistik'],
            ['semester' => 5, 'kode_mk' => 'STA405', 'nama_mk' => 'Data Mining', 'sks' => 3, 'keterangan' => 'Clustering, decision tree, dll.'],
            // Semester 6
            ['semester' => 6, 'kode_mk' => 'STA501', 'nama_mk' => 'Metode Time Series', 'sks' => 3, 'keterangan' => 'ARIMA, MA, dll.'],
            ['semester' => 6, 'kode_mk' => 'STA502', 'nama_mk' => 'Statistika Bayes', 'sks' => 3, 'keterangan' => 'Inferensi berbasis Bayesian'],
            ['semester' => 6, 'kode_mk' => 'STA503', 'nama_mk' => 'Statistika Komputasi', 'sks' => 3, 'keterangan' => 'Simulasi, MCMC, Bootstrap'],
            ['semester' => 6, 'kode_mk' => 'STA504', 'nama_mk' => 'Magang/Penelitian Lapangan', 'sks' => 3, 'keterangan' => 'Kerja praktik'],
            ['semester' => 6, 'kode_mk' => 'STA505', 'nama_mk' => 'Analisis Data Kategori', 'sks' => 2, 'keterangan' => 'Chi-square, log-linear'],
            // Semester 7
            ['semester' => 7, 'kode_mk' => 'STA601', 'nama_mk' => 'Seminar Proposal Tugas Akhir', 'sks' => 2, 'keterangan' => 'Presentasi topik penelitian'],
            ['semester' => 7, 'kode_mk' => 'STA602', 'nama_mk' => 'Statistika Kesehatan (pilihan)', 'sks' => 3, 'keterangan' => 'Analisis data epidemiologi, klinis'],
            ['semester' => 7, 'kode_mk' => 'STA603', 'nama_mk' => 'Statistika Sosial (pilihan)', 'sks' => 3, 'keterangan' => 'Sosiometri, survei sosial, dll'],
            ['semester' => 7, 'kode_mk' => 'STA604', 'nama_mk' => 'Analisis Big Data (pilihan)', 'sks' => 3, 'keterangan' => 'Hadoop, Spark, NoSQL (opsional)'],
            // Semester 8
            ['semester' => 8, 'kode_mk' => 'STA701', 'nama_mk' => 'Tugas Akhir / Skripsi', 'sks' => 6, 'keterangan' => 'Penelitian dan penulisan karya ilmiah'],
        ];

        foreach ($matakuliahs as $data) {
            // Logika untuk menentukan jenis dan deskripsi
            $jenis = 'Wajib'; // Default
            $nama_mk = $data['nama_mk'];
            $deskripsi = $data['keterangan'];

            if (str_contains($nama_mk, '(pilihan)')) {
                $jenis = 'Pilihan';
                $nama_mk = str_replace(' (pilihan)', '', $nama_mk);
            } elseif ($data['keterangan'] === 'MK Wajib Umum' || $data['keterangan'] === 'MK Umum') {
                $jenis = 'Wajib Umum';
                $deskripsi = null;
            } elseif ($data['keterangan'] === 'Kerja praktik' || $data['keterangan'] === 'Presentasi topik penelitian' || $data['keterangan'] === 'Penelitian dan penulisan karya ilmiah') {
                $deskripsi = $data['keterangan'];
            }

            MataKuliah::create([
                'semester' => $data['semester'],
                'kode_mk' => $data['kode_mk'],
                'nama_mk' => $nama_mk,
                'sks' => $data['sks'],
                'jenis' => $jenis,
                'deskripsi' => $deskripsi,
            ]);
        }
    }
}
