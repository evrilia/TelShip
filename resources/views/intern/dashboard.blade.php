@extends('layouts.intern')

@section('title', 'TelShip - Dashboard')

@section('content')
    <section class="banner mb-4">
        <div class="banner-text">
            <h1>Selamat Datang !</h1>
            <p>
                Telkom Youth Internship merupakan program magang yang diselenggarakan
                oleh Telkom Witel Purwokerto sebagai wadah pengembangan potensi generasi muda.
                Program ini bertujuan memberikan pengalaman kerja nyata, meningkatkan
                keterampilan profesional, serta mempersiapkan peserta menghadapi dunia industri.
            </p>
        </div>
        <img src="{{ asset('images/bg.dash.png') }}" class="banner-img">
    </section>

    <section class="status-card mb-4">
        <div class="status-header">
            <div>
                <h2>Pengajuan</h2>
                <p class="date">Tanggal Pengajuan : 10 Januari 2026</p>
            </div>
            <span class="status-badge">⏳ Sedang diproses</span>
        </div>

        <div class="status-box mt-3">
            <h3>⏳ Sedang diproses</h3>
            <p>Estimasi : 3 – 5 hari kerja</p>
        </div>

        <div class="progress-wrapper mt-4">
            <div class="progress-step done">
                <span class="dot"></span>
                <p>Registrasi</p>
            </div>
            <div class="progress-line done"></div>
            <div class="progress-step done">
                <span class="dot"></span>
                <p>Pengajuan</p>
            </div>
            <div class="progress-line active"></div>
            <div class="progress-step active">
                <span class="dot"></span>
                <p>Sedang diproses</p>
            </div>
            <div class="progress-line"></div>
            <div class="progress-step">
                <span class="dot"></span>
                <p>Hasil</p>
            </div>
        </div>
    </section>

    <section class="process-card mb-4">
        <h2 class="process-title">Pendaftaran Magang</h2>
        <div class="process-steps">
            <div class="process-step active">
                <span class="step-dot"></span>
                <h4>Registrasi dan Login Akun</h4>
            </div>
            <div class="process-step">
                <span class="step-dot"></span>
                <h4>Isi data pengajuan magang</h4>
            </div>
            <div class="process-step">
                <span class="step-dot"></span>
                <h4>Kirim Data</h4>
            </div>
        </div>
        <div class="process-desc mt-4">
            <p>Lakukan registrasi pada web TelShip dengan menggunakan email pribadi.</p>
            <p>Lakukan pengisian data pengajuan magang dengan memilih fitur pengajuan.</p>
            <p>Klik submit dan cek secara berkala pada fitur status. Apabila diterima maka pengajuan akan menampilkan
                approve.</p>
        </div>
    </section>

    <section class="univ-card mb-4">
        <h2 class="univ-title">Perguruan Tinggi yang telah bergabung</h2>
        <div class="univ-stats">
            <div class="stat-box">
                <img src="{{ asset('images/icon-student.png') }}" alt="Student Icon">
                <div>
                    <h3>{{ $totalMahasiswa ?? '120' }}+</h3>
                    <p>Mahasiswa mendaftar</p>
                </div>
            </div>
            <div class="stat-box">
                <img src="{{ asset('images/icon-campus.png') }}" alt="Campus Icon">
                <div>
                    <h3>{{ $totalKampus ?? '15' }}+</h3>
                    <p>Perguruan Tinggi</p>
                </div>
            </div>
            <div class="stat-box">
                <img src="{{ asset('images/icon-location.png') }}" alt="Location Icon">
                <div>
                    <h3>Lokasi</h3>
                    <p>Telkom Witel Purwokerto</p>
                </div>
            </div>
        </div>

        <div class="univ-logos">
            <img src="{{ asset('images/logo-telu.png') }}" alt="Telu">
            <img src="{{ asset('images/logo-ump.png') }}" alt="UMP">
            <img src="{{ asset('images/logo-ugm.png') }}" alt="UGM">
            <img src="{{ asset('images/logo-undip.png') }}" alt="Undip">
            <img src="{{ asset('images/logo-uty.png') }}" alt="UTY">
            <img src="{{ asset('images/logo-itb.png') }}" alt="ITB">
            <img src="{{ asset('images/logo-unnes.png') }}" alt="Unnes">
            <img src="{{ asset('images/logo-unsoed.png') }}" alt="Unsoed">
        </div>
    </section>
@endsection