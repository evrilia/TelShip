<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        /* Kunci tata letak agar sidebar stay dan konten bergeser */
        .app-container {
            display: flex;
            width: 100%;
        }

        .main-wrapper {
            flex: 1;
            margin-left: 260px;
            /* Jarak tetap untuk sidebar fixed */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f5f7fb;
        }

        @media (max-width: 991px) {
            .main-wrapper {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="app-container">
        @include('partials.internSidebar')

        <div class="main-wrapper">
            @include('partials.internTopbar')
            <main class="p-4">
                @yield('content')
            </main>
            @include('partials.footer')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>