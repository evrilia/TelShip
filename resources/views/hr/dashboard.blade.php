@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dash-HR.css') }}">
    <style>
        /* Container Utama dengan Background Abu Tipis agar Kotak Putih Terlihat Menonjol */
        .main-content-wrapper {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
        }

        /* Styling Kartu Statistik agar Sejajar */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            /* Efek Kotak di Belakang */
            display: flex;
            align-items: center;
            gap: 15px;
            border: 1px solid #f1f1f1;
        }

        /* Styling Proses Pendaftaran dengan Garis Penghubung */
        .process-container {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .process-step {
            position: relative;
            padding-left: 45px;
            margin-bottom: 35px;
        }

        .process-step::before {
            content: "";
            position: absolute;
            left: 17px;
            top: 35px;
            width: 2px;
            height: calc(100% + 5px);
            background: #e0e0e0;
        }

        .process-step:last-child::before {
            display: none;
        }

        .step-icon-circle {
            position: absolute;
            left: 0;
            top: 0;
            width: 36px;
            height: 36px;
            background: #062566;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            z-index: 2;
        }

        .chart-container {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            height: 100%;
            text-align: center;
        }

        .dot-legend {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }
    </style>
@endpush

@section('content')
    <div class="main-content-wrapper">
        <section class="banner mb-4">
            <div class="banner-text">
                <h1>Selamat Datang Admin!</h1>
                <p>Telkom Youth Internship merupakan program magang yang dilaksanakan di Telkom Witel Purwokerto.</p>
            </div>
            <img src="{{ asset('images/bg.dash.png') }}" class="banner-img">
        </section>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-navy mb-0">Dashboard Admin</h2>
                <p class="text-muted small">Kelola proses magang dengan mudah terstruktur</p>
            </div>
            <a href="{{ route('hr.permohonan') }}" class="btn text-white px-4 py-2 rounded-3 shadow-sm"
                style="background-color: #062566;">
                Hari ini {{ $pengajuanHariIni }} pengajuan baru <i class="fas fa-chevron-right ms-2 small"></i>
            </a>
        </div>

        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-icon-box" style="color: #4285f4; font-size: 24px;"><i class="fas fa-user-circle"></i></div>
                <div>
                    <h3 class="fw-bold mb-0">{{ $totalPendaftar }}</h3>
                    <p class="text-navy fw-bold mb-0 small">Total Pendaftar</p>
                    <small class="text-success" style="font-size: 10px;">↗ + 8 bulan terakhir</small>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon-box" style="color: #fbbc05; font-size: 24px;"><i class="far fa-clock"></i></div>
                <div>
                    <h3 class="fw-bold mb-0">{{ $diproses }}</h3>
                    <p class="text-navy fw-bold mb-0 small">Diproses</p>
                    <small class="text-muted" style="font-size: 10px;">→ + 1 bulan terakhir</small>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon-box" style="color: #34a853; font-size: 24px;"><i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0">{{ $diterima }}</h3>
                    <p class="text-navy fw-bold mb-0 small">Diterima</p>
                    <small class="text-muted" style="font-size: 10px;">→ + 5 bulan terakhir</small>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon-box" style="color: #ea4335; font-size: 24px;"><i class="fas fa-times-circle"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0">{{ $ditolak }}</h3>
                    <p class="text-navy fw-bold mb-0 small">Ditolak</p>
                    <small class="text-muted" style="font-size: 10px;">→ + 5 bulan terakhir</small>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-7">
                <div class="process-container">
                    <h4 class="fw-bold text-navy mb-5">Proses Pendaftaran</h4>

                    <div class="process-step">
                        <div class="step-icon-circle"><i class="fas fa-pencil-alt"></i></div>
                        <h6 class="fw-bold text-navy mb-2">Registrasi dan Login Akun</h6>
                        <p class="text-muted small">Lakukan registrasi pada web ItTel dengan menggunakan email pribadi.</p>
                    </div>

                    <div class="process-step">
                        <div class="step-icon-circle"><i class="fas fa-file-alt"></i></div>
                        <h6 class="fw-bold text-navy mb-2">Isi data pengajuan magang</h6>
                        <p class="text-muted small">Lakukan pengisian data pengajuan magang dengan memilih fitur pengajuan.
                        </p>
                    </div>

                    <div class="process-step">
                        <div class="step-icon-circle"><i class="fas fa-paper-plane"></i></div>
                        <h6 class="fw-bold text-navy mb-2">Kirim Data</h6>
                        <p class="text-muted small">Klik submit dan cek secara berkala pada fitur status. Apabila diterima
                            maka pengajuan akan menampilkan approve.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="chart-card custom-card">
                    <h4 class="fw-bold text-navy mb-5">Distribusi Status</h4>

                    {{-- Visual Donut Chart Dinamis menggunakan CSS conic-gradient --}}
                    <div class="donut-chart" style="
                    background: conic-gradient(
                        #fbbc05 0deg {{ $stop1 }}deg, 
                        #4285f4 {{ $stop1 }}deg {{ $stop2 }}deg, 
                        #ea4335 {{ $stop2 }}deg 360deg
                    );
                "></div>

                    {{-- Legend dengan Titik Warna --}}
                    <div class="chart-legend d-flex justify-content-center gap-3 mt-4">
                        <div class="small d-flex align-items-center"><span class="dot yellow"></span> Diterima</div>
                        <div class="small d-flex align-items-center"><span class="dot blue"></span> Diproses</div>
                        <div class="small d-flex align-items-center"><span class="dot red"></span> Ditolak</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const ctx = document.getElementById('statusChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Diterima', 'Diproses', 'Ditolak'],
                datasets: [{
                    data: [{{ $diterima }}, {{ $diproses }}, {{ $ditolak }}],
                    backgroundColor: ['#fbbc05', '#4285f4', '#ea4335'],
                    hoverOffset: 10, // Memberikan efek menonjol saat di-hover
                    borderWidth: 0,  // Menghilangkan garis putih antar potongan
                    borderRadius: 2  // Memberikan sedikit lengkungan pada ujung potongan
                }]
            },
            options: {
                cutout: '72%', // Ketebalan lingkaran (semakin besar semakin tipis)
                responsive: true,
                maintainAspectRatio: false, // Mengikuti ukuran container wrapper
                plugins: {
                    legend: {
                        display: false // Sembunyikan legend default karena kita pakai legend custom HTML
                    },
                    tooltip: {
                        enabled: true,
                        callbacks: {
                            label: function (context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                return ` ${label}: ${value} Peserta`;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endpush