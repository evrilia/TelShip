<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = Profile::firstOrCreate(['user_id' => $user->id]);

        if ($request->hasFile('photo')) {
            if ($profile->photo && Storage::disk('public')->exists($profile->photo)) {
                Storage::disk('public')->delete($profile->photo);
            }

            $path = $request->file('photo')->store('profiles', 'public');
            $profile->photo = $path;
            $profile->save();

            return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
        }

        if ($request->has('first_name'))
            $profile->first_name = $request->first_name;
        if ($request->has('last_name'))
            $profile->last_name = $request->last_name;
        if ($request->has('birth_date'))
            $profile->birth_date = $request->birth_date;
        if ($request->has('phone'))
            $profile->phone = $request->phone;
        if ($request->has('asal_kampus'))
            $profile->asal_kampus = $request->asal_kampus;
        if ($request->has('status'))
            $profile->status_user = $request->status;
        if ($request->has('city'))
            $profile->city = $request->city;
        if ($request->has('province'))
            $profile->province = $request->province;
        if ($request->has('postal_code'))
            $profile->zip_code = $request->postal_code;

        $profile->save();

        $pengajuanHariIni = Permohonan::whereDate('created_at', now())->count();

        return redirect()->back()->with([
            'success' => 'Profil berhasil diperbarui!',
            'pengajuanHariIni' => $pengajuanHariIni
        ]);
    }
    public function profile()
    {
        $user = \App\Models\User::with('profile')->find(auth()->id());

        if ($user->role == 'hr' || $user->role == 'admin') {
            return view('hr.profile', compact('user'));
        }

        return view('intern.profile', compact('user'));
    }
}
