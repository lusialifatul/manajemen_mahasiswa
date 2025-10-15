<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\KrsDetail;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $mataKuliahs = \App\Models\MataKuliah::orderBy('nama_mk')->get();
        $jadwals = collect();
        $krsDetails = collect();

        $selectedMataKuliahId = $request->query('mata_kuliah_id');
        $selectedJadwalId = $request->query('jadwal_id');

        $jadwalQuery = Jadwal::query();

        // Dosen only sees their own schedules
        if ($user->role === 'dosen') {
            $jadwalQuery->where('dosen_id', $user->id);
        }

        if ($selectedMataKuliahId) {
            $jadwalQuery->where('mata_kuliah_id', $selectedMataKuliahId);
        }

        $jadwals = $jadwalQuery->with('mataKuliah')->orderBy('tahun_akademik', 'desc')->orderBy('semester', 'desc')->get();

        $selectedJadwal = null;

        if ($selectedJadwalId) {
            $selectedJadwal = Jadwal::find($selectedJadwalId);

            // Security check: Dosen can only access their own schedule's details
            if ($user->role === 'dosen' && $selectedJadwal->dosen_id !== $user->id) {
                abort(403, 'Unauthorized action.');
            }

            $krsDetails = KrsDetail::where('jadwal_id', $selectedJadwalId)
                ->with(['krs.mahasiswa.user', 'nilai'])
                ->get();
        }

        return view('nilai.index', [
            'mataKuliahs' => $mataKuliahs,
            'jadwals' => $jadwals,
            'selectedMataKuliahId' => $selectedMataKuliahId,
            'selectedJadwalId' => $selectedJadwalId,
            'selectedJadwal' => $selectedJadwal,
            'krsDetails' => $krsDetails,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'nilai.*.krs_detail_id' => 'required|exists:krs_detail,id',
            'nilai.*.nilai' => 'required|in:A,B,C,D,E',
        ]);

        $user = Auth::user();
        $jadwal = Jadwal::findOrFail($request->jadwal_id);

        // Security check: Dosen can only submit grades for their own schedules
        if ($user->role === 'dosen' && $jadwal->dosen_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        DB::transaction(function () use ($request) {
            foreach ($request->nilai as $nilaiData) {
                Nilai::updateOrCreate(
                    ['krs_detail_id' => $nilaiData['krs_detail_id']],
                    ['nilai' => $nilaiData['nilai']]
                );
            }
        });

        return redirect()->route('nilai.index', ['jadwal_id' => $request->jadwal_id])
            ->with('success', 'Nilai berhasil disimpan.');
    }
}
