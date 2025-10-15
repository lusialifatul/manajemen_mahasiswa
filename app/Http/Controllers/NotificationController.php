<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengumuman;

class NotificationController extends Controller
{
    public function markAsRead(Request $request, Pengumuman $pengumuman)
    {
        if (Auth::check()) {
            Auth::user()->pengumuman()->updateExistingPivot($pengumuman->id, ['read_at' => now()]);
        }

        // Redirect back or to a specific page, e.g., the announcement index or dashboard
        return redirect()->back()->with('success', 'Notifikasi ditandai sudah dibaca.');
    }

    public function markAllAsRead()
    {
        if (Auth::check()) {
            Auth::user()->notifikasiBelumDibaca()->update(['read_at' => now()]);
        }

        return redirect()->back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }

    public function index()
    {
        if (Auth::check()) {
            $notifications = Auth::user()->pengumuman()->with('creator')->latest()->paginate(10);
            return view('notifications.index', compact('notifications'));
        }
        return redirect()->route('dashboard');
    }
}
