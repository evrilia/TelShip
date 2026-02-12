<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TelShip - Register Admin HR</title>
    {{-- Menggunakan CSS yang sama dengan register intern Anda --}}
    <link rel="stylesheet" href="{{ asset('css/regist.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Tilt+Neon&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="left"
            style="background: url('{{ asset('images/background.log-reg.jpeg') }}') center/cover no-repeat;">
            <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo TelShip">
            <div class="overlay"></div>
        </div>

        <div class="right">
            <h1>Admin <span>Tel</span>Ship</h1>
            <p>Daftarkan Akun HR Baru</p>

            @if ($errors->any())
                <div style="color: #e60000; font-size: 13px; margin-bottom: 10px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('hr.register.post') }}" method="POST">
                @csrf
                <label>Nama Lengkap</label>
                <input type="text" name="name" placeholder="Nama Admin" value="{{ old('name') }}" required>

                <label>Email Instansi</label>
                <input type="email" name="email" placeholder="admin@telkom.co.id" value="{{ old('email') }}" required>

                <label>Password</label>
                <input type="password" name="password" placeholder="Buat password minimal 8 karakter" required>

                <button type="submit" class="register-btn"
                    style="background: #062566; color: white; border: none; padding: 12px; border-radius: 8px; width: 100%; cursor: pointer; margin-top: 20px; font-weight: 600;">
                    Daftar Sekarang
                </button>
            </form>

            <p style="text-align: center; margin-top: 15px; font-size: 13px;">
                Sudah punya akun? <a href="{{ route('login') }}"
                    style="color: #e60000; text-decoration: none; font-weight: bold;">Login di sini</a>
            </p>
        </div>
    </div>
</body>

</html>