<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\User; // Assuming Dosen are users
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Jadwal::with(['mataKuliah', 'dosen']);

        // Filtering logic
        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }
        if ($request->filled('tahun_akademik')) {
            $query->where('tahun_akademik', $request->tahun_akademik);
        }
        if ($request->filled('prodi')) {
            // Assuming MataKuliah has a prodi_id or similar
            $query->whereHas('mataKuliah', function ($q) use ($request) {
                $q->where('prodi', $request->prodi); // Adjust 'prodi' column name as needed
            });
        }
        if ($request->filled('dosen_id')) {
            $query->where('dosen_id', $request->dosen_id);
        }

        // Role-based filtering for Mahasiswa and Dosen
        if (Auth::user()->hasRole('mahasiswa')) {
            // Assuming there's a relationship between User and Jadwal for students
            // Or, students are enrolled in MataKuliah, and we filter Jadwal based on that.
            // For simplicity, let's assume a student's schedule is derived from their enrolled courses.
            // This part might need more complex logic depending on your enrollment system.
            // For now, we'll just show all public schedules or require specific enrollment logic.
            // For demonstration, we'll just let them see all for now, or you can implement:
            // $enrolledMataKuliahIds = Auth::user()->mahasiswa->enrollments->pluck('mata_kuliah_id');
            // $query->whereIn('mata_kuliah_id', $enrolledMataKuliahIds);
        } elseif (Auth::user()->hasRole('dosen')) {
            $query->where('dosen_id', Auth::id());
        }

        $jadwals = $query->orderBy('hari')->orderBy('waktu_mulai')->get()->groupBy('hari');

        $mataKuliahs = MataKuliah::all();
        $dosens = User::where('role', 'dosen')->get(); // Assuming dosen are users with 'dosen' role

        return view('jadwal.index', compact('jadwals', 'mataKuliahs', 'dosens'));
    }

    /**
     * Display a listing of all resources for admin management.
     */
    public function manage()
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }
        $jadwals = Jadwal::with(['mataKuliah', 'dosen'])->orderBy('hari')->orderBy('waktu_mulai')->get();
        return view('jadwal.manage', compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }
        $mataKuliahs = MataKuliah::all();
        $dosens = User::where('role', 'dosen')->get();
        return view('jadwal.create', compact('mataKuliahs', 'dosens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'dosen_id' => 'required|exists:users,id',
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'ruangan' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'tahun_akademik' => 'required|string|max:255',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        // Not typically used for a schedule list, but can be implemented for detail view
        return view('jadwal.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }
        $mataKuliahs = MataKuliah::all();
        $dosens = User::where('role', 'dosen')->get();
        return view('jadwal.edit', compact('jadwal', 'mataKuliahs', 'dosens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'dosen_id' => 'required|exists:users,id',
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'ruangan' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'tahun_akademik' => 'required|string|max:255',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}