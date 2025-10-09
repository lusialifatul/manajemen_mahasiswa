<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filterSemester = $request->input('semester');
        $filterJenis = $request->input('jenis');
        $sortBy = $request->input('sort_by', 'nama_mk'); // Default sort by nama_mk
        $sortDirection = $request->input('sort_direction', 'asc'); // Default sort direction

        $matakuliahs = MataKuliah::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama_mk', 'like', "%{$search}%")
                             ->orWhere('kode_mk', 'like', "%{$search}%");
            })
            ->when($filterSemester, function ($query, $filterSemester) {
                return $query->where('semester', $filterSemester);
            })
            ->when($filterJenis, function ($query, $filterJenis) {
                return $query->where('jenis', $filterJenis);
            })
            ->orderBy($sortBy, $sortDirection) // Apply sorting
            ->paginate(10);

        // Pass filter and sort values back to the view for selected state and active sort indicators
        return view('matakuliah.index', compact('matakuliahs', 'filterSemester', 'filterJenis', 'sortBy', 'sortDirection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('matakuliah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_mk'   => 'required|string|max:10|unique:mata_kuliah,kode_mk',
            'nama_mk'   => 'required|string|max:255',
            'sks'       => 'required|integer|min:1|max:6',
            'semester'  => 'required|integer|min:1|max:8',
            'jenis'     => 'required|string|in:Wajib,Pilihan,Wajib Umum',
            'deskripsi' => 'nullable|string',
        ]);
    
        MataKuliah::create($validatedData);
    
        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataKuliah $matakuliah)
    {
        return view('matakuliah.edit', compact('matakuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataKuliah $matakuliah)
    {
        $validatedData = $request->validate([
            'kode_mk'   => ['required', 'string', 'max:10', \Illuminate\Validation\Rule::unique('mata_kuliah')->ignore($matakuliah->id)],
            'nama_mk'   => 'required|string|max:255',
            'sks'       => 'required|integer|min:1|max:6',
            'semester'  => 'required|integer|min:1|max:8',
            'jenis'     => 'required|string|in:Wajib,Pilihan,Wajib Umum',
            'deskripsi' => 'nullable|string',
        ]);
    
        $matakuliah->update($validatedData);
    
        return redirect()->route('matakuliah.index')->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();
    
        return redirect()->route('matakuliah.index')->with('success', 'Data mata kuliah berhasil dihapus.');
    }
}
