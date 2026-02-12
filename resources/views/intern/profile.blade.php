@extends('layouts.intern')

@section('title', 'Profil Saya - TelShip')

@push('styles')
    <style>
        .text-navy {
            color: #062566 !important;
        }

        .bg-navy {
            background-color: #062566 !important;
        }

        .card-profile {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }

        .info-label {
            color: #888;
            font-size: 0.85rem;
            margin-bottom: 4px;
            display: block;
        }

        .info-value {
            color: #062566;
            font-weight: 700;
            font-size: 1rem;
        }

        .btn-edit-custom {
            background-color: #062566;
            color: white;
            border-radius: 5px;
            padding: 5px 15px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .form-control-minimal {
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 0.6rem;
        }

        .modal {
            z-index: 1070 !important;
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid p-4">
        <div class="mb-4">
            <h2 class="fw-bold text-navy">Profil Saya</h2>
        </div>

        {{-- Card Header Profil --}}
        <div class="card card-profile">
            <div class="card-body p-4 d-flex align-items-center">
                {{-- Bagian Foto Profil --}}
                <div class="d-flex flex-column align-items-center" style="width: 120px;">
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
                            class="btn btn-sm btn-light position-absolute bottom-0 end-0 rounded-circle shadow-sm border"
                            style="width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-camera small"></i>
                        </button>
                    </div>

                    <form action="{{ route('intern.profile.update') }}" method="POST" enctype="multipart/form-data"
                        class="mt-3 w-100">
                        @csrf
                        <input type="file" name="photo" id="singlePhotoInput" style="display: none;" accept="image/*"
                            onchange="showSaveButton(this)">

                        <button type="submit" id="btnSavePhoto" class="btn btn-sm text-white px-3 shadow-sm w-100"
                            style="background: #062566; display: none; border-radius: 5px; font-weight: 600;">
                            Simpan Foto
                        </button>
                    </form>
                </div>

                <div class="ms-4">
                    <h3 class="fw-bold mb-0 text-navy">{{ Auth::user()->name }}</h3>
                    <p class="text-muted mb-0 text-capitalize">{{ Auth::user()->role }} Intern</p>
                </div>
            </div>
        </div>

        <div class="card card-profile">
            <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between">
                <h5 class="fw-bold text-navy">Informasi Pribadi</h5>
                <button class="btn btn-edit-custom shadow-sm" data-bs-toggle="modal"
                    data-bs-target="#editInfoModal">Edit</button>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-4">
                        <span class="info-label">Nama Depan</span>
                        <span
                            class="info-value">{{ Auth::user()->profile->first_name ?? explode(' ', Auth::user()->name)[0] }}</span>
                    </div>
                    <div class="col-md-4">
                        <span class="info-label">Nama Belakang</span>
                        <span class="info-value">{{ Auth::user()->profile->last_name ?? '-' }}</span>
                    </div>
                    <div class="col-md-4">
                        <span class="info-label">Tanggal Lahir</span>
                        <span class="info-value">{{ Auth::user()->profile->birth_date ?? '-' }}</span>
                    </div>
                    <div class="col-md-4">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="col-md-4">
                        <span class="info-label">No Handphone</span>
                        <span class="info-value">{{ Auth::user()->profile->phone ?? '-' }}</span>
                    </div>
                    <div class="col-md-6">
                        <span class="info-label">Asal Kampus</span>
                        <span class="info-value">{{ Auth::user()->profile->asal_kampus ?? '-' }}</span>
                    </div>
                    <div class="col-md-4">
                        <span class="info-label">Status</span>
                        <span class="info-value">{{ Auth::user()->profile->status_user ?? 'Mahasiswa' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-profile">
            <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between">
                <h5 class="fw-bold text-navy">Alamat</h5>
                <button class="btn btn-edit-custom shadow-sm" data-bs-toggle="modal"
                    data-bs-target="#editAlamatModal">Edit</button>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-4">
                        <span class="info-label">Kabupaten/Kota</span>
                        <span class="info-value">{{ Auth::user()->profile->city ?? '-' }}</span>
                    </div>
                    <div class="col-md-4">
                        <span class="info-label">Provinsi</span>
                        <span class="info-value">{{ Auth::user()->profile->province ?? '-' }}</span>
                    </div>
                    <div class="col-md-4">
                        <span class="info-label">Kode Pos</span>
                        <span class="info-value">{{ Auth::user()->profile->zip_code ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editInfoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0 px-4 pt-4">
                    <h5 class="fw-bold text-navy">Edit Informasi Pribadi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('intern.profile.update') }}" method="POST">
                    @csrf
                    <div class="modal-body px-4">
                        <div class="mb-3">
                            <label class="small fw-bold text-navy">Nama Depan</label>
                            <input type="text" name="first_name" class="form-control form-control-minimal"
                                value="{{ Auth::user()->profile->first_name ?? explode(' ', Auth::user()->name)[0] }}">
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-navy">Nama Belakang</label>
                            <input type="text" name="last_name" class="form-control form-control-minimal"
                                value="{{ Auth::user()->profile->last_name ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-navy">Tanggal Lahir</label>
                            <input type="date" name="birth_date" class="form-control form-control-minimal"
                                value="{{ Auth::user()->profile->birth_date ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-navy">No Handphone</label>
                            <input type="text" name="phone" class="form-control form-control-minimal"
                                value="{{ Auth::user()->profile->phone ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-navy">Asal Kampus</label>
                            <select name="asal_kampus" class="form-select form-control-minimal">
                                <option value="Telkom University Purwokerto" {{ (Auth::user()->profile->asal_kampus == 'Telkom University Purwokerto') ? 'selected' : '' }}>Telkom University Purwokerto</option>
                                <option value="Universitas Muhammadiyah Purwokerto" {{ (Auth::user()->profile->asal_kampus == 'Universitas Muhammadiyah Purwokerto') ? 'selected' : '' }}>Universitas Muhammadiyah Purwokerto</option>
                                <option value="Universitas Jenderal Soedirman" {{ (Auth::user()->profile->asal_kampus == 'Universitas Jenderal Soedirman') ? 'selected' : '' }}>Universitas Jenderal Soedirman</option>
                                <option value="UIN Saifuddin Zuhri Purwokerto" {{ (Auth::user()->profile->asal_kampus == 'UIN Saifuddin Zuhri Purwokerto') ? 'selected' : '' }}>UIN Saifuddin Zuhri Purwokerto
                                </option>
                                <option value="Universitas Amikom Purwokerto" {{ (Auth::user()->profile->asal_kampus == 'Universitas Amikom Purwokerto') ? 'selected' : '' }}>Universitas Amikom Purwokerto</option>
                                <option value="Universitas Wijaya Kusuma" {{ (Auth::user()->profile->asal_kampus == 'Universitas Wijaya Kusuma') ? 'selected' : '' }}>
                                    Universitas Wijaya Kusuma</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-navy">Status</label>
                            <input type="text" name="status" class="form-control form-control-minimal"
                                value="{{ Auth::user()->profile->status_user ?? '' }}">
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="submit" class="btn text-white bg-navy px-4">Save</button>
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAlamatModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0 px-4 pt-4">
                    <h5 class="fw-bold text-navy">Edit Alamat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('intern.profile.update') }}" method="POST">
                    @csrf
                    <div class="modal-body px-4">
                        <div class="mb-3">
                            <label class="small fw-bold text-navy">Kabupaten/Kota</label>
                            <input type="text" name="city" class="form-control form-control-minimal"
                                value="{{ Auth::user()->profile->city ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-navy">Provinsi</label>
                            <input type="text" name="province" class="form-control form-control-minimal"
                                value="{{ Auth::user()->profile->province ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-navy">Kode Pos</label>
                            <input type="text" name="postal_code" class="form-control form-control-minimal"
                                value="{{ Auth::user()->profile->zip_code ?? '' }}">
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="submit" class="btn text-white bg-navy px-4">Save</button>
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
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
                    }

                    else if (placeholder) {
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