@php
    $adminNotifs = \App\Models\Notifikasi::where('user_id', Auth::id())
        ->where('is_read', false)
        ->latest()
        ->get();

    $totalNotif = $adminNotifs->count();
@endphp

<nav class="topbar border-bottom">
    <div class="topbar-left d-flex align-items-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Telkom Youth Internship"
            style="height: 40px; width: auto; object-fit: contain;">
    </div>

    <div class="topbar-right d-flex align-items-center gap-3">
        <div class="dropdown">
            <a class="nav-link position-relative no-caret" href="#" id="notifDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false" style="padding: 0;">
                <i class="fas fa-bell text-warning fs-5" style="cursor: pointer;"></i>
                @if($totalNotif > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        style="font-size: 8px; padding: 3px 5px;">
                        {{ $totalNotif }}
                    </span>
                @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2" aria-labelledby="notifDropdown"
                style="width: 300px;">
                <li class="px-3 py-2 border-bottom">
                    <h6 class="fw-bold mb-0 text-navy" style="font-size: 14px;">Notifikasi Pengajuan</h6>
                </li>

                <div style="max-height: 350px; overflow-y: auto;">
                    @forelse($adminNotifs as $notif)
                        <li>
                            <a class="dropdown-item py-3 d-flex align-items-start border-bottom"
                                href="{{ route('hr.permohonan') }}">
                                <div class="rounded-circle me-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10"
                                    style="width: 35px; height: 35px; flex-shrink: 0;">
                                    <i class="fas fa-user-plus text-primary small"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-0 small fw-bold text-wrap">{{ $notif->title }}</p>
                                    <small class="text-muted d-block text-wrap" style="font-size: 11px; line-height: 1.4;">
                                        {{ $notif->message }}
                                    </small>
                                    <small class="text-primary mt-1 d-block" style="font-size: 10px;">
                                        {{ $notif->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="px-3 py-4 text-center">
                            <i class="fas fa-check-circle text-muted mb-2"></i>
                            <p class="mb-0 small text-muted">Semua pengajuan sudah diproses</p>
                        </li>
                    @endforelse
                </div>

                @if($totalNotif > 0)
                    <li class="text-center">
                        <a class="dropdown-item py-2 small fw-bold text-primary" href="{{ route('hr.permohonan') }}">
                            Lihat Semua Pengajuan
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="user-info text-end d-none d-md-block">
            <div class="fw-bold small" style="line-height: 1; color: #062566;">{{ Auth::user()->name }}</div>
            <small class="text-muted text-capitalize" style="font-size: 11px;">{{ Auth::user()->role }}</small>
        </div>

        <div class="profile-image">
            @if(Auth::user()->profile && Auth::user()->profile->photo)
                <img src="{{ asset('storage/' . Auth::user()->profile->photo) }}"
                    class="avatar rounded-circle border shadow-sm" width="38" height="38" style="object-fit: cover;">
            @else
                <div class="rounded-circle d-flex align-items-center justify-content-center bg-light border text-navy fw-bold shadow-sm"
                    style="width: 38px; height: 38px; font-size: 14px; color: #062566 !important;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            @endif
        </div>
    </div>
</nav>

<style>
    .no-caret::after {
        display: none !important;
    }

    .text-navy {
        color: #062566;
    }

    .dropdown-menu div::-webkit-scrollbar {
        width: 4px;
    }

    .dropdown-menu div::-webkit-scrollbar-thumb {
        background: #dee2e6;
        border-radius: 10px;
    }
</style>