<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mahasiswa::with(['user', 'dosenPembimbing']);

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('nim', 'like', '%' . $request->search . '%');
            });
        }

        $mahasiswas = $query->latest()->paginate(15);

        return view('mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'nama_lengkap' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:mahasiswa,nim',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $user->id,
            'nama_lengkap' => $request->nama_lengkap,
            'nim' => $request->nim,
            // You can add other default fields here if needed
            'tgl_lahir' => '2000-01-01', // Placeholder
            'gender' => 'L', // Placeholder
            'jurusan' => 'Teknik Informatika', // Placeholder
            'alamat' => '-', // Placeholder
            'no_hp' => '-', // Placeholder
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $dosens = User::where('role', 'dosen')->orderBy('name')->get();
        return view('mahasiswa.edit', compact('mahasiswa', 'dosens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:mahasiswa,nim,' . $mahasiswa->id,
            'semester_aktif' => 'required|integer|min:1|max:14',
            'ipk' => 'required|numeric|min:0|max:4',
            'dosen_pembimbing_id' => 'nullable|exists:users,id',
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }
}