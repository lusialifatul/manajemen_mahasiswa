<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KrsController extends Controller
{
    /**
     * Display the KRS creation page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all available schedules, eager-load related data for efficiency
        $jadwals = Jadwal::with(['mataKuliah', 'dosen'])->get();

        // TODO: Fetch student's current KRS, if it exists.

        return view('krs.index', [
            'jadwals' => $jadwals,
        ]);
    }
}
