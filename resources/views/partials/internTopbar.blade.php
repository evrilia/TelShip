@php
    // Ambil notifikasi terbaru dari tabel notifikasis milik user yang sedang login
    $userNotifs = \App\Models\Notifikasi::where('user_id', Auth::id())
        ->latest()
        ->take(5) // Ambil 5 riwayat terbaru
        ->get();

    // Hitung hanya yang belum dibaca untuk memunculkan angka di lonceng
    $unreadCount = \App\Models\Notifikasi::where('user_id', Auth::id())
        ->where('is_read', false)
        ->count();
@endphp

<nav class="navbar navbar-expand bg-white border-bottom sticky-top"
    style="height: 70px; z-index: 1020; padding: 0 25px;">
    <div class="container-fluid d-flex justify-content-between align-items-center h-100">
        <div class="topbar-left">
            <span class="text-muted fw-bold small">Telkom Youth Internship Purwokerto</span>
        </div>

        <div class="topbar-right d-flex align-items-center gap-3">
            <div class="dropdown">
                <a class="nav-link position-relative no-caret" href="#" id="notifDropdown" data-bs-toggle="dropdown"
                    style="padding: 0;">
                    <i class="fas fa-bell text-warning fs-5"></i>

                    {{-- Angka Badge sekarang dinamis berdasarkan jumlah yang belum dibaca --}}
                    @if($unreadCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            style="font-size: 8px; padding: 3px 5px;">{{ $unreadCount }}</span>
                    @endif
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-3" style="width: 300px;">
                    <li class="px-3 py-2 border-bottom">
                        <h6 class="fw-bold mb-0 text-navy" style="font-size: 14px;">Notifikasi</h6>
                    </li>

                    <div style="max-height: 350px; overflow-y: auto;">
                        @forelse($userNotifs as $notif)
                            <li>
                                {{-- Link ke route markAsRead agar status notif berubah jadi 'dibaca' saat diklik --}}
                                <a class="dropdown-item py-3 d-flex align-items-start border-bottom {{ $notif->is_read ? 'opacity-75' : 'bg-light' }}"
                                    href="{{ route('notif.read', $notif->id) }}">

                                    <div class="rounded-circle me-3 d-flex align-items-center justify-content-center 
                                            {{ str_contains(strtolower($notif->message), 'terima') ? 'bg-success' : 'bg-danger' }} bg-opacity-10"
                                        style="width: 35px; height: 35px; flex-shrink: 0;">
                                        <i
                                            class="fas {{ str_contains(strtolower($notif->message), 'terima') ? 'fa-check text-success' : 'fa-times text-danger' }} small"></i>
                                    </div>

                                    <div class="flex-grow-1">
                                        <p class="mb-0 small fw-bold text-navy">{{ $notif->title }}</p>
                                        <small class="text-muted d-block text-wrap"
                                            style="font-size: 11px; line-height: 1.3;">
                                            {{ $notif->message }}
                                        </small>
                                        <small class="text-primary mt-1 d-block" style="font-size: 9px;">
                                            {{ $notif->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="px-3 py-4 text-center">
                                <i class="fas fa-bell-slash text-muted mb-2"></i>
                                <p class="mb-0 small text-muted">Tidak ada notifikasi baru</p>
                            </li>
                        @endforelse
                    </div>
                </ul>
            </div>

            <div class="user-info text-end d-none d-md-block">
                <div class="fw-bold small text-navy">{{ Auth::user()->name }}</div>
                <small class="text-muted text-capitalize" style="font-size: 11px;">Intern</small>
            </div>

            <div class="profile-image">
                @if(Auth::user()->profile && Auth::user()->profile->photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile->photo) }}" class="rounded-circle border"
                        width="38" height="38" style="object-fit: cover;">
                @else
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-light border text-navy fw-bold"
                        style="width: 38px; height: 38px; font-size: 14px;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>

<style>
    .dropdown-menu {
        z-index: 1030;
    }

    .no-caret::after {
        display: none !important;
    }

    .text-navy {
        color: #062566 !important;
    }

    .dropdown-item:active {
        background-color: #f8f9fa;
        color: inherit;
    }

    .dropdown-menu div::-webkit-scrollbar {
        width: 4px;
    }

    .dropdown-menu div::-webkit-scrollbar-thumb {
        background: #dee2e6;
        border-radius: 10px;
    }
</style>