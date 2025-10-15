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

        $krs_id = $request->input('krs_id');
        if (!$krs_id) {
            return redirect()->back()->with('error', 'Silakan pilih riwayat semester terlebih dahulu.');
        }

        // Find the specific KRS and load all necessary data
        $krs = Krs::with(['krsDetails.jadwal.mataKuliah', 'dosenPembimbing'])
                    ->where('mahasiswa_id', $mahasiswa->id) // Security check
                    ->find($krs_id);

        if (!$krs) {
            return redirect()->back()->with('error', 'Data KRS tidak ditemukan.');
        }

        // The PDF view might need a 'semester' variable.
        // We will pass the semester string from the KRS record.
        $semester_label_for_view = $krs->semester;

        $data = [
            'mahasiswa' => $mahasiswa,
            'krs' => $krs,
            'semester' => $semester_label_for_view,
            'dosen_pembimbing' => $krs->dosenPembimbing,
        ];

        $pdf = PDF::loadView('reports.krs', $data);
        
        // Sanitize the filename
        $safe_tahun_akademik = str_replace('/', '-', $krs->tahun_akademik);
        $fileName = 'KRS-' . $mahasiswa->nim . '-' . $krs->semester . '-' . $safe_tahun_akademik . '.pdf';
        
        return $pdf->download($fileName);
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

        $krs_id = $request->input('krs_id');
        if (!$krs_id) {
            return redirect()->back()->with('error', 'Silakan pilih riwayat semester terlebih dahulu.');
        }

        // Find the specific KRS and load all necessary data for the PDF view
        $krs = Krs::with([
                        'krsDetails.mataKuliah', // For course name, code, sks
                        'krsDetails.nilai'       // For the grade
                    ])
                    ->where('mahasiswa_id', $mahasiswa->id) // Security check
                    ->where('status', 'approved')
                    ->find($krs_id);

        if (!$krs) {
            return redirect()->back()->with('error', 'Data KHS tidak ditemukan atau belum disetujui.');
        }

        // The PDF view expects a 'semester' variable. We'll pass the string from the KRS record.
        $semester_label_for_view = $krs->semester;

        $data = [
            'mahasiswa' => $mahasiswa,
            'krs' => $krs,
            'semester' => $semester_label_for_view,
            'dosen_pembimbing' => $mahasiswa->dosenPembimbing,
        ];

        $pdf = PDF::loadView('reports.khs', $data);
        $safe_tahun_akademik = str_replace('/', '-', $krs->tahun_akademik);
        $fileName = 'KHS-' . $mahasiswa->nim . '-' . $krs->semester . '-' . $safe_tahun_akademik . '.pdf';
        return $pdf->download($fileName);
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
        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        // Get all approved KRS records for the student to build semester list
        $krsHistory = Krs::where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'approved')
            ->orderBy('tahun_akademik', 'desc')
            ->orderBy('semester', 'desc')
            ->get();

        return view('reports.student_selection', compact('krsHistory'));
    }
}
