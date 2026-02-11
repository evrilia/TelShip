<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPendaftar = User::where('role', 'intern')->count();
        $diterima = Permohonan::where('status', 'Diterima')->count();
        $diproses = Permohonan::where('status', 'Diproses')->count();
        $ditolak = Permohonan::where('status', 'Ditolak')->count();

        $pengajuanHariIni = Permohonan::whereDate('created_at', now())->count();

        $total = $diterima + $diproses + $ditolak;

        $degDiterima = $total > 0 ? ($diterima / $total) * 360 : 0;
        $degDiproses = $total > 0 ? ($diproses / $total) * 360 : 0;

        $stop1 = $degDiterima;
        $stop2 = $degDiterima + $degDiproses;

        return view('hr.dashboard', compact(
            'totalPendaftar',
            'diproses',
            'diterima',
            'ditolak',
            'pengajuanHariIni',
            'stop1',
            'stop2'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diterima,Ditolak',
            'alasan_cancel' => 'required_if:status,Ditolak'
        ]);

        $permohonan = Permohonan::findOrFail($id);
        $permohonan->status = $request->status;

        if ($request->status === 'Ditolak') {
            $permohonan->alasan_cancel = $request->alasan_cancel;
            $pesanNotif = "Mohon maaf, pengajuan magang Anda ditolak. Alasan: " . $request->alasan_cancel;
        } else {
            $permohonan->alasan_cancel = null;
            $pesanNotif = "Selamat! Pengajuan magang Anda telah diterima.";
        }

        $permohonan->save();
    
        \App\Models\Notifikasi::create([
            'user_id' => $permohonan->user_id,
            'title' => 'Update Status Pengajuan',
            'message' => $pesanNotif,
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }

    public function getDetail($id)
    {
        $data = \App\Models\Permohonan::with('user.profile')->findOrFail($id);

        return response()->json([
            'nama' => $data->user->name,
            'univ' => $data->asal_kampus,
            'jurusan' => $data->jurusan,
            'hp' => $data->user->profile->phone ?? '-',
            'mulai' => \Carbon\Carbon::parse($data->tanggal_mulai)->format('d F Y'),
            'selesai' => \Carbon\Carbon::parse($data->tanggal_selesai)->format('d F Y'),
            'durasi' => $data->durasi,
            'cv' => asset('storage/' . $data->cv_path),
            'surat' => asset('storage/' . $data->surat_pernyataan_path)
        ]);
    }

    public function permohonan()
    {
        $pengajuans = \App\Models\Permohonan::all();

        $pengajuanHariIni = \App\Models\Permohonan::whereDate('created_at', now())->count();

        return view('hr.permohonan', compact('pengajuans', 'pengajuanHariIni'));
    }
}
