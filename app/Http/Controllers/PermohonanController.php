<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermohonanController extends Controller
{
    public function indexHR()
    {
        $pengajuans = \App\Models\Permohonan::all();

        $pengajuanHariIni = \App\Models\Permohonan::whereDate('created_at', now())->count();

        return view('hr.permohonan', compact('pengajuans', 'pengajuanHariIni'));
    }

    // Untuk sisi Intern
    public function indexIntern()
    {
        $permohonans = Permohonan::where('user_id', Auth::id())->latest()->get();
        return view('intern.status', compact('permohonans'));
    }
}
