<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KrsReviewController extends Controller
{
    /**
     * Display a listing of the KRS submissions that need review.
     */
    public function index()
    {
        $dosen = Auth::user();
        $krsSubmissions = Krs::where('dosen_pembimbing_id', $dosen->id)
                                ->where('status', 'submitted')
                                ->with('mahasiswa.user') // Eager load mahasiswa data
                                ->latest()
                                ->paginate(10);

        return view('krs.review.index', compact('krsSubmissions'));
    }

    /**
     * Display the specified KRS for review.
     */
    public function show(Krs $krs)
    {
        // Authorization check: ensure the logged-in dosen is the advisor for this KRS
        if ($krs->dosen_pembimbing_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $krs->load(['mahasiswa.user', 'jadwals.mataKuliah', 'jadwals.dosen']);

        return view('krs.review.show', compact('krs'));
    }

    /**
     * Approve the specified KRS.
     */
    public function approve(Krs $krs)
    {
        if ($krs->dosen_pembimbing_id !== Auth::id()) {
            abort(403);
        }

        $krs->update(['status' => 'approved']);

        // Create notification for the student
        Notification::create([
            'user_id' => $krs->mahasiswa_id,
            'message' => 'KRS Anda telah disetujui oleh Dosen Pembimbing.',
            'link' => route('krs.index') // Or a link to a KRS history page
        ]);

        return redirect()->route('krs.review.index')->with('success', 'KRS telah disetujui.');
    }

    /**
     * Reject the specified KRS.
     */
    public function reject(Request $request, Krs $krs)
    {
        if ($krs->dosen_pembimbing_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'catatan_revisi' => 'required|string|max:500',
        ]);

        $krs->update([
            'status' => 'rejected',
            'catatan_revisi' => $request->catatan_revisi,
        ]);

        // Create notification for the student
        Notification::create([
            'user_id' => $krs->mahasiswa_id,
            'message' => 'KRS Anda ditolak. Silakan periksa catatan revisi.',
            'link' => route('krs.index')
        ]);

        return redirect()->route('krs.review.index')->with('success', 'KRS telah ditolak.');
    }
}