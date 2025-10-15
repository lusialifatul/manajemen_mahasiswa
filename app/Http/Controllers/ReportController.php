<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Krs;
use App\Models\KrsDetail;
use App\Models\Nilai;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ReportController extends Controller
{
    public function generateKrs(Request $request, $mahasiswaId = null)
    {
        $user = Auth::user();
        $mahasiswa = null;

        if ($user->role === 'mahasiswa') {
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
            if (!$mahasiswa) {
                return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
            }
            if ($mahasiswaId && $mahasiswa->id != $mahasiswaId) {
                abort(403, 'Unauthorized action.');
            }
        } elseif ($user->role === 'admin') {
            if ($mahasiswaId) {
                $mahasiswa = Mahasiswa::find($mahasiswaId);
                if (!$mahasiswa) {
                    return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
                }
            } else {
                return redirect()->back()->with('error', 'ID Mahasiswa diperlukan untuk admin.');
            }
        } else {
            abort(403, 'Unauthorized action.');
        }

        $semester = $request->input('semester');
        if (!$semester) {
            return redirect()->back()->with('error', 'Semester diperlukan.');
        }

        // Convert numeric semester to 'Ganjil' or 'Genap'
        $dbSemester = ((int)$semester % 2 !== 0) ? 'Ganjil' : 'Genap';

        $krs = Krs::where('mahasiswa_id', $mahasiswa->id)
                    ->where('semester', $dbSemester)
                    ->with('krsDetails.mataKuliah')
                    ->first();

        if (!$krs) {
            return redirect()->back()->with('error', 'Data KRS tidak ditemukan untuk semester ini.');
        }

        $data = [
            'mahasiswa' => $mahasiswa,
            'krs' => $krs,
            'semester' => $semester,
            'dosen_pembimbing' => $mahasiswa->dosenPembimbing,
        ];

        $pdf = PDF::loadView('reports.krs', $data);
        return $pdf->download('KRS-' . $mahasiswa->nim . '-Semester-' . $semester . '.pdf');
    }

    public function generateKhs(Request $request, $mahasiswaId = null)
    {
        $user = Auth::user();
        $mahasiswa = null;

        if ($user->role === 'mahasiswa') {
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
            if (!$mahasiswa) {
                return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
            }
            if ($mahasiswaId && $mahasiswa->id != $mahasiswaId) {
                abort(403, 'Unauthorized action.');
            }
        } elseif ($user->role === 'admin') {
            if ($mahasiswaId) {
                $mahasiswa = Mahasiswa::find($mahasiswaId);
                if (!$mahasiswa) {
                    return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
                }
            } else {
                return redirect()->back()->with('error', 'ID Mahasiswa diperlukan untuk admin.');
            }
        } else {
            abort(403, 'Unauthorized action.');
        }

        $semester = $request->input('semester');
        if (!$semester) {
            return redirect()->back()->with('error', 'Semester diperlukan.');
        }

        // Convert numeric semester to 'Ganjil' or 'Genap'
        $dbSemester = ((int)$semester % 2 !== 0) ? 'Ganjil' : 'Genap';

        $krs = Krs::where('mahasiswa_id', $mahasiswa->id)
                    ->where('semester', $dbSemester)
                    ->with('krsDetails.mataKuliah', 'krsDetails.nilai')
                    ->first();

        if (!$krs) {
            return redirect()->back()->with('error', 'Data KHS tidak ditemukan untuk semester ini.');
        }

        $data = [
            'mahasiswa' => $mahasiswa,
            'krs' => $krs,
            'semester' => $semester,
            'dosen_pembimbing' => $mahasiswa->dosenPembimbing,
        ];

        $pdf = PDF::loadView('reports.khs', $data);
        return $pdf->download('KHS-' . $mahasiswa->nim . '-Semester-' . $semester . '.pdf');
    }

    public function generateTranskrip(Request $request, $mahasiswaId = null)
    {
        $user = Auth::user();
        $mahasiswa = null;

        if ($user->role === 'mahasiswa') {
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
            if (!$mahasiswa) {
                return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
            }
            if ($mahasiswaId && $mahasiswa->id != $mahasiswaId) {
                abort(403, 'Unauthorized action.');
            }
        } elseif ($user->role === 'admin') {
            if ($mahasiswaId) {
                $mahasiswa = Mahasiswa::find($mahasiswaId);
                if (!$mahasiswa) {
                    return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
                }
            } else {
                return redirect()->back()->with('error', 'ID Mahasiswa diperlukan untuk admin.');
            }
        } else {
            abort(403, 'Unauthorized action.');
        }

        $allKrs = Krs::where('mahasiswa_id', $mahasiswa->id)
                        ->with('krsDetails.mataKuliah', 'krsDetails.nilai')
                        ->orderBy('semester')
                        ->get();

        if ($allKrs->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data KRS untuk transkrip.');
        }

        $totalSks = 0;
        $totalBobot = 0;
        $grades = [];

        foreach ($allKrs as $krs) {
            foreach ($krs->krsDetails as $krsDetail) {
                if ($krsDetail->nilai) {
                    $sks = $krsDetail->mataKuliah->sks;
                    $nilaiHuruf = $krsDetail->nilai->nilai_huruf;
                    $bobot = $krsDetail->nilai->nilai_angka;

                    $totalSks += $sks;
                    $totalBobot += ($bobot * $sks);
                    $grades[] = [
                        'semester' => $krs->semester,
                        'kode_mk' => $krsDetail->mataKuliah->kode_mk,
                        'nama_mk' => $krsDetail->mataKuliah->nama_mk,
                        'sks' => $sks,
                        'nilai_huruf' => $nilaiHuruf,
                        'nilai_angka' => $krsDetail->nilai->nilai_angka,
                    ];
                }
            }
        }

        $ipk = ($totalSks > 0) ? round($totalBobot / $totalSks, 2) : 0;

        $data = [
            'mahasiswa' => $mahasiswa,
            'grades' => $grades,
            'totalSks' => $totalSks,
            'ipk' => $ipk,
            'dosen_pembimbing' => $mahasiswa->dosenPembimbing,
        ];

        $pdf = PDF::loadView('reports.transkrip', $data);
        return $pdf->download('Transkrip-' . $mahasiswa->nim . '.pdf');
    }

    public function showAdminSelectionForm()
    {
        $mahasiswas = Mahasiswa::all();
        return view('reports.admin_selection', compact('mahasiswas'));
    }

    public function showStudentSelectionForm()
    {
        return view('reports.student_selection');
    }
}
