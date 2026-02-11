<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Login - TelShip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login-HR.css') }}">
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="max-width: 900px; width: 100%;">
            <div class="row g-0">
                <div class="col-md-6 d-none d-md-block position-relative"
                    style="background: url('{{ asset('images/background.log-reg.jpeg') }}') center/cover; min-height: 500px;">
                    <div class="position-absolute top-0 start-0 p-4">
                        <img src="{{ asset('images/logo.png') }}" width="120">
                    </div>
                    <div class="overlay" style="position: absolute; inset: 0; background: rgba(6, 37, 102, 0.65);">
                    </div>
                </div>
                <div class="col-md-6 p-5 bg-white">
                    <h2 class="fw-bold mb-2">Admin <span>Tel</span>Ship</h2>
                    <p class="text-muted mb-4">Masuk ke panel manajemen admin.</p>

                    <form action="{{ route('hr.login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Username / Email</label>
                            <input type="text" name="username" class="form-control" placeholder="admin@telship.com"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <div class="d-flex justify-content-between mb-4 small">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember">
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>
                            <a href="#" class="text-danger text-decoration-none">Lupa Password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold"
                            style="background: #062566;">Masuk Sekarang</button>
                    </form>

                    <p class="mt-4 text-center small">
                        Belum punya akun admin? <a href="{{ route('hr.register') }}" class="text-danger fw-bold">Daftar
                            di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>