<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - TelShip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login-HR.css') }}">
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="max-width: 900px; width: 100%;">
            <div class="row g-0">
                <div class="col-md-6 d-none d-md-block"
                    style="background: url('{{ asset('images/background.log-reg.jpeg') }}') center/cover;">
                    <div style="background: rgba(6, 37, 102, 0.65); height: 100%; width: 100%; padding: 40px;">
                        <img src="{{ asset('images/logo.png') }}" width="120">
                    </div>
                </div>
                <div class="col-md-6 p-5 bg-white">
                    <h2 class="fw-bold">Login TelShip</h2>
                    <p class="text-muted">Masukkan akun Anda untuk melanjutkan.</p>

                    @if($errors->any())
                        <div class="alert alert-danger py-2 small">{{ $errors->first() }}</div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="name@example.com"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold"
                            style="background: #062566; border: none; padding: 12px;">Login</button>
                    </form>

                    <p class="mt-4 text-center small">
                        Bukan Admin? <a href="{{ route('register') }}" class="text-danger fw-bold">Daftar Intern</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>