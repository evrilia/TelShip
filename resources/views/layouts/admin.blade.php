<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - TelShip Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: #fff;
            flex-shrink: 0;
            border-right: 1px solid #eee;
            z-index: 1040;
        }

        #content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            margin-left: 250px;
        }

        .topbar {
            position: fixed;
            top: 0;
            right: 0;
            left: 250px;
            z-index: 1030;
            background-color: #fff;
            height: 70px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding: 0 1.5rem;
        }

        main {
            margin-top: 70px;
            padding: 20px;
            min-height: calc(100vh - 70px);
        }

        .bg-navy {
            background-color: #062566 !important;
        }

        .text-navy {
            color: #062566 !important;
        }

        .dropdown-toggle::after {
            display: none !important;
        }

        .avatar {
            object-fit: cover;
            cursor: pointer;
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            @include('partials.sidebar')
        </aside>

        <div id="content">
            @include('partials.topbar')

            <main>
                @yield('content')
            </main>

            @include('partials.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebarToggle = document.getElementById('sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function () {
                    console.log("Sidebar toggled");
                });
            }
        });
    </script>

    @stack('scripts')
</body>

</html>