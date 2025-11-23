<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Bootstrap Icons (for navbar icons) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- 🔷 ADMIN NAVBAR (Logo Left, Menu Right, Icons + Text) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('admin.tickets') }}">
                <img src="/images/logo.png" alt="Logo" style="height:45px;">
            </a>

            <!-- Mobile Menu Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminNavbar"
                    aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav ml-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('admin.reports')) active @endif"
                           href="{{ route('admin.reports') }}">
                            <i class="bi bi-file-earmark-bar-graph"></i> Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('admin.tickets')) active @endif"
                           href="{{ route('admin.tickets') }}">
                            <i class="bi bi-ticket-detailed"></i> Tickets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('logout') }}">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <!-- 🔷 PAGE CONTENT -->
    <div class="container mb-5">
        @yield('content')
    </div>

    <!-- Bootstrap Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
