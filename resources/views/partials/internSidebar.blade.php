<aside class="sidebar-stay"
    style="width: 260px; height: 100vh; position: fixed; left: 0; top: 0; z-index: 1030; background: #fff; border-right: 1px solid #dee2e6; display: flex; flex-direction: column;">
    <div class="sidebar-header d-flex align-items-center justify-content-center" style="height: 80px;">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 50px; width: auto;">
    </div>

    <nav class="sidebar-menu flex-grow-1 mt-2">
        <style>
            .menu-link {
                display: flex;
                align-items: center;
                padding: 12px 25px;
                text-decoration: none;
                color: #6c757d;
                transition: 0.3s;
            }

            .menu-link:hover,
            .menu-link.active {
                background: rgba(6, 37, 102, 0.05);
                color: #062566;
                border-right: 4px solid #062566;
            }

            .menu-link i {
                margin-right: 15px;
                width: 20px;
                text-align: center;
            }
        </style>

        <a href="{{ route('intern.dashboard') }}"
            class="menu-link {{ request()->routeIs('intern.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> <span>Dashboard</span>
        </a>
        <a href="{{ route('intern.profile') }}"
            class="menu-link {{ request()->routeIs('intern.profile') ? 'active' : '' }}">
            <i class="fas fa-user"></i> <span>Profil Saya</span>
        </a>
        <a href="{{ route('intern.status') }}"
            class="menu-link {{ request()->routeIs('intern.status') ? 'active' : '' }}">
            <i class="fas fa-check-circle"></i> <span>Status</span>
        </a>
        <a href="{{ route('intern.pengajuan') }}"
            class="menu-link {{ request()->routeIs('intern.pengajuan') ? 'active' : '' }}">
            <i class="fas fa-file-alt"></i> <span>Pengajuan</span>
        </a>
    </nav>

    <div class="sidebar-footer border-top p-3">
        <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">@csrf</form>
        <a href="#" class="menu-link text-danger"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> <span>Keluar</span>
        </a>
    </div>
</aside>