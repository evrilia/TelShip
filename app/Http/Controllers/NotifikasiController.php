<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function markAsRead($id)
    {
        $notif = Notifikasi::where('user_id', Auth::id())->findOrFail($id);
        $notif = Notifikasi::where('user_id', Auth::id())->findOrFail($id);

        // Tandai sudah dibaca
        $notif->update(['is_read' => true]);

        if (Auth::user()->role == 'intern') {
            return redirect()->route('intern.status');
        }

        if (Auth::user()->role == 'admin' || Auth::user()->role == 'hr') {
            return redirect()->route('hr.permohonan');
        }

        return redirect()->back();
    }
}
