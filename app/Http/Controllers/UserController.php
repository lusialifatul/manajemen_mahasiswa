<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Menampilkan halaman manajemen user
    public function index()
    {
        // Ambil semua user kecuali admin yang sedang login
        $users = User::where('id', '!=', Auth::id())->orderBy('name')->get();
        return view('users.index', compact('users'));
    }

    // Menampilkan form untuk membuat user baru
    public function create()
    {
        return view('users.create');
    }

    // Menyimpan user baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'role' => ['required', Rule::in(['admin', 'dosen', 'mahasiswa'])],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User baru berhasil ditambahkan.');
    }

    // Mengubah peran user
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', Rule::in(['admin', 'dosen', 'mahasiswa'])],
        ]);

        $user->update(['role' => $request->role]);

        return redirect()->route('users.index')->with('success', 'Peran user berhasil diperbarui.');
    }

    // Menghapus user
    public function destroy(User $user)
    {
        // Tambahan keamanan: jangan biarkan admin menghapus dirinya sendiri lewat rute ini
        if ($user->id == Auth::id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}