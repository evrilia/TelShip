<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TelShip - Register</title>
    <link rel="stylesheet" href="{{ asset('css/regist.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">
    <style>
        .error-message {
            color: #e60000;
            font-size: 11px;
            margin-bottom: 10px;
            display: block;
        }

        select.is-invalid {
            border-color: #e60000 !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left"
            style="background: url('{{ asset('images/background.log-reg.jpeg') }}') center/cover no-repeat;">
            <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo TelShip">
            <div class="overlay"></div>
        </div>

        <div class="right">
            <h1>Welcome to <span>Tel</span>Ship!</h1>
            <p>Register your Account!</p>

            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <label>Name</label>
                <input type="text" name="name" placeholder="Enter your name" value="{{ old('name') }}" required>
                @error('name') <span class="error-message">{{ $message }}</span> @enderror

                <label>Email</label>
                <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                @error('email') <span class="error-message">{{ $message }}</span> @enderror

                <label>Password</label>
                <input type="password" name="password" placeholder="Create your password" required>
                @error('password') <span class="error-message">{{ $message }}</span> @enderror

                <label>Asal Kampus</label>
                {{-- Input kampus disinkronkan dengan database --}}
                <select name="kampus" class="{{ $errors->has('kampus') ? 'is-invalid' : '' }}" required
                    style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; margin-bottom: 5px; background: white;">
                    <option value="" disabled {{ old('kampus') ? '' : 'selected' }}>-- Pilih Kampus --</option>
                    <option value="Telkom University Purwokerto" {{ old('kampus') == 'Telkom University Purwokerto' ? 'selected' : '' }}>Telkom University Purwokerto</option>
                    <option value="Universitas Muhammadiyah Purwokerto" {{ old('kampus') == 'Universitas Muhammadiyah Purwokerto' ? 'selected' : '' }}>Universitas Muhammadiyah Purwokerto</option>
                    <option value="Universitas Jenderal Soedirman" {{ old('kampus') == 'Universitas Jenderal Soedirman' ? 'selected' : '' }}>Universitas Jenderal Soedirman</option>
                    <option value="UIN Saifuddin Zuhri Purwokerto" {{ old('kampus') == 'UIN Saifuddin Zuhri Purwokerto' ? 'selected' : '' }}>UIN Saifuddin Zuhri Purwokerto</option>
                    <option value="Universitas Amikom Purwokerto" {{ old('kampus') == 'Universitas Amikom Purwokerto' ? 'selected' : '' }}>Universitas Amikom Purwokerto</option>
                    <option value="Universitas Wijaya Kusuma" {{ old('kampus') == 'Universitas Wijaya Kusuma' ? 'selected' : '' }}>Universitas Wijaya Kusuma</option>
                </select>
                @error('kampus') <span class="error-message">{{ $message }}</span> @enderror

                <div class="terms" style="display: flex; align-items: center; gap: 10px; margin: 20px 0;">
                    <input type="checkbox" id="agree" required>
                    <label for="agree" style="margin-top: 0; font-size: 13px;">I agree to the terms & Privacy</label>
                </div>

                <button type="submit" class="register-btn"
                    style="background: #062566; color: white; border: none; padding: 12px; border-radius: 8px; width: 100%; cursor: pointer; font-weight: bold; font-family: 'Poppins', sans-serif;">
                    Create Account
                </button>
            </form>

            <p style="text-align: center; margin-top: 15px;">
                Already have an account? <a href="{{ route('login') }}"
                    style="color: #e60000; text-decoration: none; font-weight: bold;">Login here</a>
            </p>
        </div>
    </div>
</body>

</html>