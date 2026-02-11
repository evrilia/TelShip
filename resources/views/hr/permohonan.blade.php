@extends('layouts.admin')

@section('title', 'Manajemen Pengajuan - TelShip')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/permohonan.css') }}">
    <style>
        .text-navy { color: #062566 !important; }
        .bg-navy { background-color: #062566 !important; }

        .main-content-wrapper {
            background-color: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            min-height: calc(100vh - 100px);
        }

        .modal-backdrop { z-index: 1040 !important; background-color: rgba(0, 0, 0, 0.5) !important; }
        .modal { z-index: 1050 !important; }
        .modal-content { border: none !important; border-radius: 20px !important; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }

        .form-control-detail {
            background-color: #f8f9fa !important;
            border: 1px solid #dee2e6 !important;
            color: #062566 !important;
            font-weight: 500;
            padding: 0.6rem 1rem;
            border-radius: 8px;
        }

        .label-detail {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            color: #adb5bd;
            margin-bottom: 5px;
            display: block;
        }

        .btn-navy-filled {
            background-color: #062566 !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            font-size: 0.85rem !important;
            letter-spacing: 0.5px;
            border-radius: 5px !important;
            padding: 0.7rem 1.2rem;
            border: none !important;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-navy-filled:hover {
            background-color: #041a4a !important;
            transform: translateY(-1px);
            color: #fff !important;
        }
    </style>
@endpush

@section('content')
    @include('partials.topbar')

    <div class="container-fluid p-4">
        <div class="main-content-wrapper">
            <div class="mb-4">
                <h2 class="fw-bold text-navy mb-0">Pengajuan Magang</h2>
                <p class="text-muted small">Kelola berkas permohonan mahasiswa secara terstruktur.</p>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-navy text-white">
                                <tr>
                                    <th class="py-3 px-4 border-0">No</th>
                                    <th class="py-3 border-0">Nama Lengkap</th>
                                    <th class="py-3 border-0">Tanggal Masuk</th>
                                    <th class="py-3 text-center border-0">Berkas</th>
                                    <th class="py-3 text-center border-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengajuans as $data)
                                    <tr>
                                        <td class="px-4 text-muted">{{ $loop->iteration }}</td>
                                        <td class="fw-bold text-navy">{{ $data->user->name }}</td>
                                        <td class="text-muted">{{ $data->created_at->format('d F Y') }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-light btn-sm border shadow-sm px-3 text-navy fw-600"
                                                onclick="viewDetail({{ $data->id }})">
                                                Lihat Bukti Pengajuan
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            @if($data->status == 'Diproses')
                                                <button class="btn btn-outline-primary btn-sm rounded-pill px-4 fw-bold"
                                                    onclick="openStatusModal({{ $data->id }})">
                                                    Diproses
                                                </button>
                                            @else
                                                <span class="badge rounded-pill py-2 px-3 border
                                                    {{ $data->status == 'Diterima' ? 'bg-success bg-opacity-10 text-success border-success' : 'bg-danger bg-opacity-10 text-danger border-danger' }}">
                                                    {{ $data->status }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada data pengajuan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    //detal informasi pengajuan
    <div class="modal fade" id="buktiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 px-4 pt-4">
                    <h5 class="fw-bold text-navy mb-0">Detail Data Pengaju</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="label-detail">Nama Lengkap</label>
                            <input type="text" id="det-nama" class="form-control form-control-detail" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="label-detail">Universitas</label>
                            <input type="text" id="det-univ" class="form-control form-control-detail" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="label-detail">Jurusan</label>
                            <input type="text" id="det-jurusan" class="form-control form-control-detail" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="label-detail">No. HP</label>
                            <input type="text" id="det-hp" class="form-control form-control-detail" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="label-detail">Durasi Magang</label>
                            <input type="text" id="det-durasi" class="form-control form-control-detail fw-bold text-primary" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="label-detail">Tanggal Mulai</label>
                            <input type="text" id="det-mulai" class="form-control form-control-detail" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="label-detail">Tanggal Selesai</label>
                            <input type="text" id="det-selesai" class="form-control form-control-detail" readonly>
                        </div>
                        <div class="col-12 mt-4">
                            <label class="label-detail">Berkas Dokumen</label>
                            <div class="d-flex gap-3">
                                <a id="det-cv" target="_blank" class="btn btn-navy-filled flex-grow-1">
                                    <i class="fas fa-file-pdf me-2"></i> Lihat CV
                                </a>
                                <a id="det-surat" target="_blank" class="btn btn-navy-filled flex-grow-1">
                                    <i class="fas fa-file-alt me-2"></i> Lihat Surat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   //status
    <div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 px-4 pt-4">
                    <h5 class="fw-bold text-navy mb-0">Update Status Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formUpdateStatus" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body px-4">
                        <div class="mb-3">
                            <label class="label-detail">Pilih Hasil</label>
                            <select name="status" id="selectStatus" class="form-select form-control-detail" onchange="toggleAlasan(this.value)" required>
                                <option value="" disabled selected>Pilih Status...</option>
                                <option value="Diterima">Diterima</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="mb-3" id="wrapperAlasan" style="display: none;">
                            <label class="label-detail">Alasan Penolakan</label>
                            <textarea name="alasan_cancel" id="alasan_cancel" class="form-control form-control-detail" rows="3" placeholder="Berikan alasan penolakan..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="submit" class="btn btn-navy-filled px-4 rounded-pill">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function viewDetail(id) {
            fetch(`/hr/permohonan/${id}/detail`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('det-nama').value = data.nama;
                    document.getElementById('det-univ').value = data.univ;
                    document.getElementById('det-jurusan').value = data.jurusan;
                    document.getElementById('det-hp').value = data.hp;
                    document.getElementById('det-mulai').value = data.mulai;
                    document.getElementById('det-selesai').value = data.selesai;
                    document.getElementById('det-durasi').value = data.durasi;
                    document.getElementById('det-cv').href = data.cv;
                    document.getElementById('det-surat').href = data.surat;

                    new bootstrap.Modal(document.getElementById('buktiModal')).show();
                })
                .catch(error => alert('Gagal memuat data.'));
        }

        function openStatusModal(id) {
            const form = document.getElementById('formUpdateStatus');
            form.action = `/hr/permohonan/${id}/status`;
            
            // Reset modal state
            document.getElementById('selectStatus').value = "";
            document.getElementById('wrapperAlasan').style.display = 'none';
            document.getElementById('alasan_cancel').required = false;

            new bootstrap.Modal(document.getElementById('statusModal')).show();
        }

        function toggleAlasan(val) {
            const wrapper = document.getElementById('wrapperAlasan');
            const textarea = document.getElementById('alasan_cancel');
            if (val === 'Ditolak') {
                wrapper.style.display = 'block';
                textarea.required = true;
            } else {
                wrapper.style.display = 'none';
                textarea.required = false;
            }
        }
    </script>
@endpush