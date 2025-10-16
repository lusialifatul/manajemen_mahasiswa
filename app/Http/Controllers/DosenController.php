<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Mahasiswa;
use App\Models\Pengumuman;
use App\Models\Krs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DosenController extends Controller
{
    public function dashboard()
    {
        $dosen = Auth::user();

        // Konversi hari ini ke dalam bahasa Indonesia
        $dayOfWeekMap = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];
        $todayInIndonesia = $dayOfWeekMap[Carbon::now()->format('l')];

        // Jadwal Mengajar Hari Ini
        $jadwalHariIni = Jadwal::with('mataKuliah', 'krsDetails.krs.mahasiswa')
            ->where('dosen_id', $dosen->id)
            ->where('hari', $todayInIndonesia)
            ->orderBy('waktu_mulai', 'asc')
            ->get();

        // Daftar Mata Kuliah Diampu
        $mataKuliahDiampu = Jadwal::with('mataKuliah')
            ->where('dosen_id', $dosen->id)
            ->select('mata_kuliah_id', 'semester', 'tahun_akademik')
            ->distinct()
            ->get();

        // Mahasiswa Bimbingan Akademik
        $mahasiswaBimbingan = Mahasiswa::where('dosen_pembimbing_id', $dosen->id)->get();

        // Permintaan Persetujuan KRS (jika dosen adalah PA)
        $krsMenungguPersetujuan = Krs::where('dosen_pembimbing_id', $dosen->id)
            ->where('status', 'menunggu persetujuan') // Asumsi status ini
            ->with('mahasiswa')
            ->get();

        // Pengumuman Terbaru
        $pengumumanTerbaru = Pengumuman::latest()->take(3)->get();

        return view('dosen.dashboard', [
            'dosen' => $dosen,
            'jadwalHariIni' => $jadwalHariIni,
            'mataKuliahDiampu' => $mataKuliahDiampu,
            'mahasiswaBimbingan' => $mahasiswaBimbingan,
            'krsMenungguPersetujuan' => $krsMenungguPersetujuan,
            'pengumumanTerbaru' => $pengumumanTerbaru,
        ]);
    }
}