<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengumumans = Pengumuman::with('creator')->latest()->paginate(10);
        return view('pengumuman.index', compact('pengumumans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'target_role' => 'required|in:semua,dosen,mahasiswa',
        ]);

        $pengumuman = Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'target_role' => $request->target_role,
            'created_by' => Auth::id(),
        ]);

        // Attach pengumuman to target users
        if ($request->target_role === 'semua') {
            $users = User::all();
        } elseif ($request->target_role === 'dosen') {
            $users = User::where('role', 'dosen')->get();
        } else { // mahasiswa
            $users = User::where('role', 'mahasiswa')->get();
        }

        foreach ($users as $user) {
            $user->pengumuman()->attach($pengumuman->id);
        }

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengumuman $pengumuman)
    {
        // This method might not be needed if we only show details in the notification dropdown or index
        return view('pengumuman.show', compact('pengumuman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengumuman $pengumuman)
    {
        return view('pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'target_role' => 'required|in:semua,dosen,mahasiswa',
        ]);

        $pengumuman->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'target_role' => $request->target_role,
        ]);

        // Re-attach pengumuman to target users if target_role changed
        // This is a simplified approach. A more robust solution might detach all first, then re-attach.
        // For now, we assume if target_role changes, new notifications are created for new targets.
        // Existing notifications for previous targets remain unless explicitly removed.
        // For simplicity, we'll just ensure new targets get it.
        $pengumuman->users()->detach(); // Detach all existing users

        if ($request->target_role === 'semua') {
            $users = User::all();
        } elseif ($request->target_role === 'dosen') {
            $users = User::where('role', 'dosen')->get();
        } else { // mahasiswa
            $users = User::where('role', 'mahasiswa')->get();
        }

        foreach ($users as $user) {
            $user->pengumuman()->attach($pengumuman->id);
        }

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dihapus!');
    }
}
