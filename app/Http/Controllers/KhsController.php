<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KhsController extends Controller
{
    private function getNilaiBobot($nilai)
    {
        switch ($nilai) {
            case 'A': return 4.0;
            case 'B': return 3.0;
            case 'C': return 2.0;
            case 'D': return 1.0;
            case 'E': return 0.0;
            default: return 0.0;
        }
    }

    public function index(Request $request)
    {
        $mahasiswaUser = Auth::user();
        $mahasiswa = $mahasiswaUser->mahasiswa;

        // Get all KRS records for the student to build semester list
        $krsHistory = Krs::where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'approved')
            ->orderBy('tahun_akademik', 'desc')
            ->orderBy('semester', 'desc')
            ->get();

        // Determine the selected semester
        $selectedKrsId = $request->query('krs_id');
        $selectedKrs = $selectedKrsId ? $krsHistory->find($selectedKrsId) : $krsHistory->first();

        $khsDetails = [];
        $totalSksSemester = 0;
        $totalBobotSemester = 0;

        if ($selectedKrs) {
            $details = $selectedKrs->krsDetails()->with(['jadwal.mataKuliah', 'nilai'])->get();
            foreach ($details as $detail) {
                $nilaiHuruf = $detail->nilai->nilai ?? null;
                $sks = $detail->jadwal->mataKuliah->sks;
                $bobot = $this->getNilaiBobot($nilaiHuruf) * $sks;

                $khsDetails[] = (object) [
                    'kode_mk' => $detail->jadwal->mataKuliah->kode_mk,
                    'nama_mk' => $detail->jadwal->mataKuliah->nama_mk,
                    'sks' => $sks,
                    'nilai' => $nilaiHuruf,
                    'bobot' => $bobot,
                ];

                if ($nilaiHuruf) {
                    $totalSksSemester += $sks;
                    $totalBobotSemester += $bobot;
                }
            }
        }

        $ipSemester = $totalSksSemester > 0 ? round($totalBobotSemester / $totalSksSemester, 2) : 0;

        // Calculate cumulative GPA (IPK)
        $totalSksKumulatif = 0;
        $totalBobotKumulatif = 0;

        foreach ($krsHistory as $krs) {
            $details = $krs->krsDetails()->with(['jadwal.mataKuliah', 'nilai'])->get();
            foreach ($details as $detail) {
                $nilaiHuruf = $detail->nilai->nilai ?? null;
                if ($nilaiHuruf) {
                    $sks = $detail->jadwal->mataKuliah->sks;
                    $totalSksKumulatif += $sks;
                    $totalBobotKumulatif += $this->getNilaiBobot($nilaiHuruf) * $sks;
                }
            }
        }

        $ipk = $totalSksKumulatif > 0 ? round($totalBobotKumulatif / $totalSksKumulatif, 2) : 0;

        return view('khs.index', [
            'mahasiswa' => $mahasiswa,
            'krsHistory' => $krsHistory,
            'selectedKrs' => $selectedKrs,
            'khsDetails' => $khsDetails,
            'totalSksSemester' => $totalSksSemester,
            'ipSemester' => $ipSemester,
            'totalSksKumulatif' => $totalSksKumulatif,
            'ipk' => $ipk,
        ]);
    }
}