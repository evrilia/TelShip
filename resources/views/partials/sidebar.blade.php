<aside class="sidebar-hr d-flex flex-column"
    style="width: 260px; height: 100vh; position: fixed; left: 0; top: 0; z-index: 1030; background: #fff; border-right: 1px solid #dee2e6;">
    {{-- Header Logo --}}
    <div class="sidebar-header d-flex align-items-center justify-content-center" style="height: 120px; padding: 20px;">
        <img src="{{ asset('images/logo.png') }}" alt="Telkom Indonesia"
            style="height: 60px; width: auto; object-fit: contain;">
    </div>

    {{-- Menu Navigasi --}}
    <nav class="sidebar-menu flex-grow-1 mt-2">
        <style>
            .hr-link {
                display: flex;
                align-items: center;
                padding: 14px 25px;
                text-decoration: none;
                color: #6c757d;
                font-weight: 500;
                transition: 0.3s;
                border-right: 4px solid transparent;
            }

            .hr-link:hover,
            .hr-link.active {
                background: rgba(6, 37, 102, 0.05);
                color: #062566;
                border-right: 4px solid #062566;
            }

            .hr-link i {
                margin-right: 18px;
                width: 20px;
                text-align: center;
                font-size: 1.1rem;
            }
        </style>

        {{-- Pastikan Route menggunakan prefix 'hr.' --}}
        <a href="{{ route('hr.dashboard') }}" class="hr-link {{ request()->routeIs('hr.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> <span>Dashboard</span>
        </a>

        <a href="{{ route('hr.permohonan') }}"
            class="hr-link {{ request()->routeIs('hr.permohonan') ? 'active' : '' }}">
            <i class="fas fa-file-alt"></i> <span>Pengajuan</span>
        </a>

        <a href="{{ route('hr.profile') }}" class="hr-link {{ request()->routeIs('hr.profile') ? 'active' : '' }}">
            <i class="fas fa-user-shield"></i> <span>Profil Admin</span>
        </a>
    </nav>

    <div class="sidebar-footer border-top p-3">
        <form action="{{ route('logout') }}" method="POST" id="logout-form-hr" class="d-none">@csrf</form>
        <a href="#" class="hr-link text-danger"
            onclick="event.preventDefault(); document.getElementById('logout-form-hr').submit();"
            style="border-right: none;">
            <i class="fas fa-sign-out-alt"></i> <span>Keluar</span>
        </a>
    </div>
</aside>