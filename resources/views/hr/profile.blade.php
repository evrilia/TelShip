@extends('layouts.admin')

@section('title', 'Profil HR - TelShip')

@push('styles')
    {{-- Import font dan pustaka ikon agar muncul seperti di dashboard --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    {{-- CSS Dashboard wajib dipanggil agar layout sidebar/topbar sinkron --}}
    <link rel="stylesheet" href="{{ asset('css/dash-HR.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile-HR.css') }}">

    <style>
        * {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Struktur pembungkus utama agar konten berada di samping sidebar (Kunci Utama) */
        .main-content-wrapper {
            background-color: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            min-height: calc(100vh - 100px);
        }

        .text-navy {
            color: #062566 !important;
        }

        .bg-navy {
            background-color: #062566 !important;
        }

        .modal {
            z-index: 1070 !important;
            background: rgba(0, 0, 0, 0.5);
        }

        .modal-backdrop {
            z-index: 1060 !important;
        }

        .form-control-minimal {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 0.6rem 1rem;
            background-color: #fff;
            font-size: 0.9rem;
        }

        /* Memperbaiki Ikon agar muncul tegas */
        .fas,
        .fa {
            font-family: "Font Awesome 5 Free" !important;
            font-weight: 900 !important;
            display: inline-block;
        }
    </style>
@endpush

@section('content')
    @include('partials.topbar')

    <div class="container-fluid p-4">
        <div class="main-content-wrapper">

            <div class="mb-4">
                <h2 class="fw-bold text-navy mb-0">Profil</h2>
                <p class="text-muted small">Kelola informasi data diri dan keamanan akun.</p>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="position-relative" id="photoContainer">
                            @if(Auth::user()->profile && Auth::user()->profile->photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile->photo) }}" id="profilePreview"
                                    class="rounded-circle border border-3 shadow-sm" width="120" height="120"
                                    style="object-fit: cover;">
                            @else
                                <div id="profilePlaceholder"
                                    class="rounded-circle border border-3 d-flex align-items-center justify-content-center bg-light text-navy fw-bold shadow-sm"
                                    style="width: 120px; height: 120px; font-size: 3rem;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif

                            <button type="button" onclick="document.getElementById('singlePhotoInput').click();"
                                class="btn btn-sm btn-light position-absolute bottom-0 end-0 rounded-circle shadow-sm border">
                                <i class="fas fa-camera text-navy"></i>
                            </button>
                        </div>

                        <form action="{{ route('hr.profile.update') }}" method="POST" enctype="multipart/form-data"
                            class="mt-3 w-100">
                            @csrf
                            <input type="file" name="photo" id="singlePhotoInput" style="display: none;" accept="image/*"
                                onchange="showSaveButton(this)">
                            <button type="submit" id="btnSavePhoto"
                                class="btn btn-sm text-white px-3 shadow-sm w-100 bg-navy"
                                style="display: none; border-radius: 5px; font-weight: 600;">
                                Simpan Foto
                            </button>
                        </form>
                    </div>

                    <div class="ms-4">
                        <h3 class="fw-bold mb-0 text-navy">{{ auth()->user()->name }}</h3>
                        <p class="text-muted mb-0 text-capitalize">{{ auth()->user()->role }} Management</p>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-navy">Informasi Pribadi</h5>
                    <button class="btn btn-sm text-white px-3 fw-bold shadow-sm bg-navy" style="border-radius: 5px;"
                        data-bs-toggle="modal" data-bs-target="#editInfoModal">
                        Edit <i class="fas fa-pencil-alt small ms-1"></i>
                    </button>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="text-muted small d-block mb-1">Nama Depan</label>
                            <span class="fw-bold text-navy">{{ explode(' ', auth()->user()->name)[0] }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small d-block mb-1">Nama Belakang</label>
                            <span class="fw-bold text-navy">{{ Auth::user()->profile->last_name ?? '-' }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small d-block mb-1">Tanggal Lahir</label>
                            <span class="fw-bold text-navy">{{ Auth::user()->profile->birth_date ?? '-' }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small d-block mb-1">Email</label>
                            <span class="fw-bold text-navy">{{ auth()->user()->email }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small d-block mb-1">No Handphone</label>
                            <span class="fw-bold text-navy">{{ Auth::user()->profile->phone ?? '-' }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small d-block mb-1">Status</label>
                            <span class="fw-bold text-navy">{{ Auth::user()->profile->status_user ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-navy">Alamat</h5>
                    <button class="btn btn-sm text-white px-3 fw-bold shadow-sm bg-navy" style="border-radius: 5px;"
                        data-bs-toggle="modal" data-bs-target="#editAlamatModal">
                        Edit <i class="fas fa-pencil-alt small ms-1"></i>
                    </button>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="text-muted small d-block mb-1">Kabupaten/Kota</label>
                            <span class="fw-bold text-navy">{{ Auth::user()->profile->city ?? '-' }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small d-block mb-1">Provinsi</label>
                            <span class="fw-bold text-navy">{{ Auth::user()->profile->province ?? '-' }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted small d-block mb-1">Kode Pos</label>
                            <span class="fw-bold text-navy">{{ Auth::user()->profile->zip_code ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    //edit info
    <div class="modal fade" id="editInfoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-navy mb-0">Edit Informasi Pribadi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('hr.profile.update') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Nama Depan</label>
                                <input type="text" name="first_name" class="form-control form-control-minimal"
                                    value="{{ explode(' ', auth()->user()->name)[0] }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Nama Belakang</label>
                                <input type="text" name="last_name" class="form-control form-control-minimal"
                                    value="{{ Auth::user()->profile->last_name ?? '' }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Tanggal Lahir</label>
                                <input type="date" name="birth_date" class="form-control form-control-minimal"
                                    value="{{ Auth::user()->profile->birth_date ?? '' }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">No Handphone</label>
                                <input type="text" name="phone" class="form-control form-control-minimal"
                                    value="{{ Auth::user()->profile->phone ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pb-4 px-4">
                        <button type="button" class="btn btn-light px-4 fw-bold small"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn text-white px-4 fw-bold small bg-navy">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    //edit alamat
    <div class="modal fade" id="editAlamatModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-bold text-navy mb-0">Edit Alamat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('hr.profile.update') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold">Kabupaten/Kota</label>
                                <input type="text" name="city" class="form-control form-control-minimal"
                                    value="{{ Auth::user()->profile->city ?? '' }}">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label small fw-bold">Provinsi</label>
                                <input type="text" name="province" class="form-control form-control-minimal"
                                    value="{{ Auth::user()->profile->province ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Kode Pos</label>
                                <input type="text" name="zip_code" class="form-control form-control-minimal"
                                    value="{{ Auth::user()->profile->zip_code ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pb-4 px-4">
                        <button type="button" class="btn btn-light px-4 fw-bold small"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn text-white px-4 fw-bold small bg-navy">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function showSaveButton(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('profilePreview');
                    const placeholder = document.getElementById('profilePlaceholder');
                    const container = document.getElementById('photoContainer');
                    if (preview) {
                        preview.src = e.target.result;
                    } else if (placeholder) {
                        const newImg = document.createElement('img');
                        newImg.src = e.target.result;
                        newImg.id = 'profilePreview';
                        newImg.className = 'rounded-circle border border-3 shadow-sm';
                        newImg.style.cssText = 'width: 120px; height: 120px; object-fit: cover;';
                        container.replaceChild(newImg, placeholder);
                    }
                    document.getElementById('btnSavePhoto').style.display = 'inline-block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush