<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternController extends Controller
{
    public function dashboard()
    {
        $totalMahasiswa = Permohonan::distinct('user_id')->count();
        $totalKampus = Permohonan::distinct('asal_kampus')->count();
        $statusTerakhir = Permohonan::where('user_id', Auth::id())->latest()->first();

        return view('intern.dashboard', compact('totalMahasiswa', 'totalKampus', 'statusTerakhir'));
    }

    public function storePengajuan(Request $request)
    {
        $request->validate([
            'tgl_surat' => 'required|date',
            'jurusan' => 'required|string|max:255',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'durasi' => 'required|string',
            'cv' => 'required|file|mimes:pdf|max:2048',
            'surat' => 'required|file|mimes:pdf|max:2048',
        ]);

        $user = Auth::user();

        try {
            $permohonan = \App\Models\Permohonan::create([
                'user_id' => Auth::id(),
                'tanggal_surat' => $request->tgl_surat,
                'asal_kampus' => $user->profile->asal_kampus ?? '-',
                'jurusan' => $request->jurusan,
                'tanggal_mulai' => $request->tgl_mulai,
                'tanggal_selesai' => $request->tgl_selesai,
                'durasi' => $request->durasi,
                'cv_path' => $request->file('cv')->store('uploads/cv', 'public'),
                'surat_pernyataan_path' => $request->file('surat')->store('uploads/surat', 'public'),
                'status' => 'Diproses'
            ]);

            $admins = \App\Models\User::where('role', 'admin')->get();

            foreach ($admins as $admin) {
                \App\Models\Notifikasi::create([
                    'user_id' => $admin->id,
                    'title' => 'Pengajuan Magang Baru',
                    'message' => $user->name . ' telah mengirimkan berkas permohonan magang baru.',
                    'is_read' => false
                ]);
            }

            return redirect()->route('intern.status')->with('success', 'Pengajuan berhasil dikirim!');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function profile()
    {
        $user = User::with('profile')->find(Auth::id());
        return view('intern.profile', compact('user'));
    }

    public function status()
    {
        $permohonans = \App\Models\Permohonan::where('user_id', Auth::id())->latest()->get();

        return view('intern.status', compact('permohonans'));
    }

    public function pengajuan()
    {
        return view('intern.pengajuan');
    }
}
