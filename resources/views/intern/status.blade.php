@extends('layouts.intern')

@section('title', 'Status Pengajuan - TelShip')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="fw-bold mb-4" style="color: #062566;">Status Pengajuan</h2>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead style="background-color: #062566; color: white;">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 80px;">No</th>
                            <th class="py-3">Tanggal Pengajuan</th>
                            <th class="py-3">Durasi</th>
                            <th class="py-3 text-center">Status</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permohonans as $data)
                                            <tr class="align-middle">
                                                <td class="px-4 text-center text-muted">{{ $loop->iteration }}</td>
                                                <td class="text-muted">{{ $data->created_at->format('d F Y') }}</td>
                                                <td class="text-muted">{{ $data->durasi }} Bulan</td>
                                                <td class="text-center">
                                                    @php
                                                        $badgeClass = match ($data->status) {
                                                            'Diterima' => 'success',
                                                            'Ditolak' => 'danger',
                                                            'Diproses' => 'secondary',
                                                            default => 'primary'
                                                        };
                                                    @endphp
                              <span
                                                        class="badge rounded-pill py-2 px-4 bg-{{ $badgeClass }} bg-opacity-10 text-{{ $badgeClass }} border border-{{ $badgeClass }}">
                                                        {{ $data->status }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-light btn-sm border shadow-sm px-3" style="color: #062566;"
                                                        onclick="viewDetailIntern({{ $data->id }})">
                                                        <i class="fas fa-eye me-1"></i> Detail
                                                    </button>
                                                </td>
                                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open d-block mb-3 fs-1 opacity-25"></i>
                                    Belum ada riwayat pengajuan magang.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailModalIntern" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 20px; border: none;">
                <div class="modal-header border-0 px-4 pt-4">
                    <h5 class="fw-bold" style="color: #062566;">Detail Pengajuan Anda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                    <div class="row g-4" id="detailContent">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function viewDetailIntern(id) {
            // Menggunakan endpoint JSON yang sudah Anda buat di AdminController
            fetch(`/hr/permohonan/${id}/detail`)
                .then(response => response.json())
                .then(data => {
                    const html = `
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold d-block mb-1">JURUSAN</label>
                            <p class="fw-bold mb-0 text-navy">${data.jurusan}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold d-block mb-1">DURASI</label>
                            <p class="fw-bold mb-0 text-navy">${data.durasi} Bulan</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold d-block mb-1">TANGGAL MULAI</label>
                            <p class="text-muted mb-0">${data.mulai}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold d-block mb-1">TANGGAL SELESAI</label>
                            <p class="text-muted mb-0">${data.selesai}</p>
                        </div>
                        <div class="col-12 mt-4">
                            <label class="small text-muted fw-bold d-block mb-2">BERKAS SAYA</label>
                            <div class="d-flex gap-2">
                                <a href="${data.cv}" target="_blank" class="btn btn-sm text-white flex-grow-1 py-2" style="background: #062566; border-radius: 8px;">
                                    <i class="fas fa-file-pdf me-2"></i> Lihat CV
                                </a>
                                <a href="${data.surat}" target="_blank" class="btn btn-sm text-white flex-grow-1 py-2" style="background: #062566; border-radius: 8px;">
                                    <i class="fas fa-file-pdf me-2"></i> Lihat Surat
                                </a>
                            </div>
                        </div>
                    `;
                    document.getElementById('detailContent').innerHTML = html;
                    new bootstrap.Modal(document.getElementById('detailModalIntern')).show();
                })
                .catch(error => alert('Gagal memuat detail data.'));
        }
    </script>
@endpush