<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class KrsController extends Controller
{
    /**
     * Display the KRS creation page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch student's profile with their advisor
        $mahasiswa = Mahasiswa::with('dosenPembimbing')->where('user_id', Auth::id())->first();

        // Find if a KRS already exists for the current period
        $existingKrs = Krs::where('mahasiswa_id', Auth::id())
                        ->where('tahun_akademik', '2025/2026') // TODO: Make this dynamic
                        ->where('semester', 'Ganjil') // TODO: Make this dynamic
                        ->latest()
                        ->first();

        // Fetch available schedules for the student's current semester
        $currentSemester = $mahasiswa->semester_aktif ?? 0;

        // Fetch available schedules for the student's current semester
        $jadwals = Jadwal::with(['mataKuliah', 'dosen'])
                        ->whereHas('mataKuliah', function ($query) use ($currentSemester) {
                            $query->where('semester', $currentSemester);
                        })
                        ->get();

        return view('krs.index', [
            'jadwals' => $jadwals,
            'mahasiswa' => $mahasiswa,
            'existingKrs' => $existingKrs,
        ]);
    }

    /**
     * Store a newly created KRS in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $jadwalIds = json_decode($request->input('jadwal_ids'), true);

        $request->merge(['jadwal_ids' => $jadwalIds]);

        $validator = Validator::make($request->all(), [
            'jadwal_ids' => 'required|array',
            'jadwal_ids.*' => 'exists:jadwals,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        if (!$mahasiswa || !$mahasiswa->dosen_pembimbing_id) {
            return back()->with('error', 'Dosen Pembimbing Anda belum diatur. Silakan hubungi admin.');
        }

        // TODO: Add SKS limit validation based on IPK

        $krs = Krs::create([
            'mahasiswa_id' => $mahasiswa->id,
            'dosen_pembimbing_id' => $mahasiswa->dosen_pembimbing_id,
            'semester' => 'Ganjil', // TODO: Make this dynamic
            'tahun_akademik' => '2025/2026', // TODO: Make this dynamic
            'status' => 'submitted',
        ]);

        $totalSks = 0;
        $jadwals = Jadwal::with('mataKuliah')->find($request->jadwal_ids);

        foreach ($jadwals as $jadwal) {
            $krs->jadwals()->attach($jadwal->id);
            $totalSks += $jadwal->mataKuliah->sks;
        }

        $krs->total_sks = $totalSks;
        $krs->save();

        // Create notification for the advisor
        Log::info('Attempting to create notification for advisor.', [
            'dosen_pembimbing_id' => $mahasiswa->dosen_pembimbing_id,
            'mahasiswa_name' => $user->name,
            'krs_id' => $krs->id,
        ]);

        try {
            Notification::create([
                'user_id' => $mahasiswa->dosen_pembimbing_id,
                'message' => "Mahasiswa {$user->name} telah mengajukan KRS.",
                'link' => route('krs.review.show', $krs->id),
            ]);
            Log::info('Notification successfully created for advisor.', [
                'dosen_pembimbing_id' => $mahasiswa->dosen_pembimbing_id,
                'krs_id' => $krs->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create notification for advisor.', [
                'error' => $e->getMessage(),
                'dosen_pembimbing_id' => $mahasiswa->dosen_pembimbing_id,
                'krs_id' => $krs->id,
            ]);
        }

        return redirect()->route('krs.index')->with('success', 'KRS berhasil diajukan dan sedang menunggu persetujuan.');
    }
}