<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactController extends Controller
{
    // Menampilkan halaman contact
    public function index()
    {
        return view('contact.index');
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'message' => 'required|string',
        ]);

        ContactUs::create($validated);

        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    }
}
