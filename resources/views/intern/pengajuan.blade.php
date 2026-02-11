@extends('layouts.intern')

@section('title', 'Pengajuan Magang - TelShip')

@section('content')
    <div class="container-fluid p-4">
        <h2 class="fw-bold mb-4" style="color: #062566;">Pengajuan Magang</h2>

        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm rounded-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header border-0 py-3 px-4" style="background-color: #062566;">
                <h6 class="text-white mb-0 small"><i class="bi bi-file-earmark-text me-2"></i>Filling Form</h6>
            </div>
            <div class="card-body p-5">
                <form id="formPengajuan" action="{{ route('intern.pengajuan.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3 align-items-center">
                        <label class="col-md-3 text-muted">Tanggal Surat Magang</label>
                        <div class="col-md-9">
                            <input type="date" name="tgl_surat" class="form-control border-light-subtle"
                                value="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label class="col-md-3 text-muted">Nama</label>
                        <div class="col-md-9">
                            <input type="text" name="nama" class="form-control border-light-subtle bg-light"
                                value="{{ auth()->user()->name }} {{ auth()->user()->profile->last_name ?? '' }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label class="col-md-3 text-muted">No Hp</label>
                        <div class="col-md-9">
                            <input type="text" name="hp" class="form-control border-light-subtle bg-light"
                                value="{{ auth()->user()->profile->phone ?? '' }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label class="col-md-3 text-muted">Asal Kampus</label>
                        <div class="col-md-9">
                            <input type="text" name="kampus" class="form-control border-light-subtle bg-light"
                                value="{{ auth()->user()->profile->asal_kampus ?? '' }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label class="col-md-3 text-muted">Jurusan</label>
                        <div class="col-md-9">
                            <input type="text" name="jurusan" class="form-control border-light-subtle"
                                placeholder="Masukkan Jurusan">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label class="col-md-3 text-muted">Tanggal Mulai Magang</label>
                        <div class="col-md-9">
                            <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control border-light-subtle">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label class="col-md-3 text-muted">Tanggal Selesai Magang</label>
                        <div class="col-md-9">
                            <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control border-light-subtle">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label class="col-md-3 text-muted">Durasi Magang</label>
                        <div class="col-md-9">
                            <div class="d-flex gap-3 flex-wrap">
                                <div class="input-group" style="width: 140px;">
                                    <input type="text" id="disp_bulan" class="form-control text-center bg-light fw-bold"
                                        readonly placeholder="0">
                                    <span class="input-group-text bg-white small">Bulan</span>
                                </div>
                                <div class="input-group" style="width: 140px;">
                                    <input type="text" id="disp_minggu" class="form-control text-center bg-light fw-bold"
                                        readonly placeholder="0">
                                    <span class="input-group-text bg-white small">Minggu</span>
                                </div>
                                <div class="input-group" style="width: 140px;">
                                    <input type="text" id="disp_hari" class="form-control text-center bg-light fw-bold"
                                        readonly placeholder="0">
                                    <span class="input-group-text bg-white small">Hari</span>
                                </div>
                            </div>
                            <input type="hidden" name="durasi" id="durasi_hidden">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label class="col-md-3 text-muted">CV (PDF)</label>
                        <div class="col-md-9">
                            <input type="file" name="cv" class="form-control border-light-subtle" accept=".pdf">
                        </div>
                    </div>

                    <div class="row mb-4 align-items-center">
                        <label class="col-md-3 text-muted">Surat Pernyataan (PDF)</label>
                        <div class="col-md-9">
                            <input type="file" name="surat" class="form-control border-light-subtle" accept=".pdf">
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn text-white px-5 rounded-pill" style="background-color: #062566;"
                            data-bs-toggle="modal" data-bs-target="#confirmModal">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 p-4 text-center">
                <h4 class="fw-bold mb-4 px-4" style="color: #062566;">Sudah yakin dengan kelengkapan berkas kamu?</h4>
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="btn text-white px-5 rounded-pill" style="background-color: #062566;"
                        onclick="document.getElementById('formPengajuan').submit();">Submit</button>
                    <button type="button" class="btn btn-secondary px-5 rounded-pill opacity-50"
                        data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tglMulai = document.getElementById('tgl_mulai');
            const tglSelesai = document.getElementById('tgl_selesai');

            const dispBulan = document.getElementById('disp_bulan');
            const dispMinggu = document.getElementById('disp_minggu');
            const dispHari = document.getElementById('disp_hari');
            const hiddenDurasi = document.getElementById('durasi_hidden');

            function hitungDurasi() {
                if (tglMulai.value && tglSelesai.value) {
                    const start = new Date(tglMulai.value);
                    const end = new Date(tglSelesai.value);

                    if (end < start) {
                        alert("Tanggal selesai tidak valid!");
                        tglSelesai.value = "";
                        return;
                    }

                    let diffInTime = end.getTime() - start.getTime();
                    let totalDays = Math.ceil(diffInTime / (1000 * 3600 * 24));

                    let months = Math.floor(totalDays / 30);
                    let remainingAfterMonths = totalDays % 30;

                    let weeks = Math.floor(remainingAfterMonths / 7);
                    let days = remainingAfterMonths % 7;

                    dispBulan.value = months;
                    dispMinggu.value = weeks;
                    dispHari.value = days;

                    let textResult = [];
                    if (months > 0) textResult.push(months + " Bulan");
                    if (weeks > 0) textResult.push(weeks + " Minggu");
                    if (days > 0) textResult.push(days + " Hari");

                    hiddenDurasi.value = textResult.length > 0 ? textResult.join(", ") : "0 Hari";
                }
            }

            tglMulai.addEventListener('change', hitungDurasi);
            tglSelesai.addEventListener('change', hitungDurasi);
        });
    </script>
@endpush