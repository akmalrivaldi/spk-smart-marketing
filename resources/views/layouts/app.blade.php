<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SPK SMART Marketing') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    :root {
        --primary-color: #0d6efd;
        --soft-bg: #f4f7fb;
        --card-radius: 18px;
        --shadow-soft: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    body {
        background: var(--soft-bg);
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .main-title {
        font-weight: 800;
        color: #1f2937;
    }

    .subtitle {
        color: #6b7280;
    }

    .card-clean {
        border: 0;
        border-radius: var(--card-radius);
        box-shadow: var(--shadow-soft);
        overflow: hidden;
    }

    .stat-card {
        border: 0;
        border-radius: var(--card-radius);
        box-shadow: var(--shadow-soft);
        transition: 0.2s ease-in-out;
    }

    .stat-card:hover {
        transform: translateY(-4px);
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1f2937;
    }

    .table thead th {
        vertical-align: middle;
        white-space: nowrap;
    }

    .badge-rank-1 {
        background: #198754;
    }

    .badge-rank-2 {
        background: #0d6efd;
    }

    .badge-rank-3 {
        background: #fd7e14;
    }

    .badge-rank-other {
        background: #6c757d;
    }

    .hero-box {
        border-radius: 20px;
        background: linear-gradient(135deg, #0d6efd, #3b82f6);
        color: white;
        box-shadow: var(--shadow-soft);
    }

    .table-responsive {
        border-radius: 12px;
    }

    .small-muted {
        font-size: 0.9rem;
        color: #6b7280;
    }

    .rank-card {
        border-radius: 16px;
        border: 0;
        box-shadow: var(--shadow-soft);
        height: 100%;
    }

    .sticky-action {
        position: sticky;
        bottom: 16px;
        z-index: 10;
    }

    /* NAVBAR BARU */
    .app-navbar {
        background: linear-gradient(90deg, #0d6efd, #1f6feb);
        padding-top: 14px;
        padding-bottom: 14px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.10);
    }

    .app-navbar .navbar-brand {
        font-size: 1.9rem;
        font-weight: 800;
        letter-spacing: 0.3px;
        color: #ffffff !important;
    }

    .app-navbar .navbar-nav {
        align-items: center;
        gap: 6px;
    }

    .app-navbar .nav-link {
        color: rgba(255, 255, 255, 0.88) !important;
        font-weight: 500;
        padding: 10px 14px !important;
        border-radius: 10px;
        transition: all 0.2s ease;
    }

    .app-navbar .nav-link:hover {
        color: #ffffff !important;
        background-color: rgba(255, 255, 255, 0.12);
    }

    .app-navbar .nav-link.active {
        color: #ffffff !important;
        background-color: rgba(255, 255, 255, 0.18);
        font-weight: 700;
    }

    .user-chip {
        color: #ffffff;
        font-size: 0.95rem;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.12);
        padding: 8px 14px;
        border-radius: 999px;
        margin-left: 12px;
    }

    .btn-logout {
        border-radius: 10px;
        padding: 8px 16px;
        font-weight: 600;
        border: none;
        background: #ffffff;
        color: #0d6efd;
        transition: all 0.2s ease;
    }

    .btn-logout:hover {
        background: #f10e0e;
        color: #ffffff;
    }

    @media (max-width: 991.98px) {
        .app-navbar .navbar-collapse {
            margin-top: 12px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            padding: 12px;
        }

        .app-navbar .navbar-nav {
            align-items: stretch;
            gap: 4px;
        }

        .user-chip {
            margin-left: 0;
            margin-top: 8px;
            display: inline-block;
            text-align: center;
        }

        .btn-logout {
            width: 100%;
            margin-top: 8px;
        }
    }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg app-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">SPK SMART Marketing</a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('criteria.*') ? 'active' : '' }}" href="{{ route('criteria.index') }}">
                        Kriteria
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('alternatives.*') ? 'active' : '' }}" href="{{ route('alternatives.index') }}">
                        Alternatif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('scores.*') ? 'active' : '' }}" href="{{ route('scores.index') }}">
                        Penilaian
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('calculations.*') ? 'active' : '' }}" href="{{ route('calculations.index') }}">
                        Hasil SMART
                    </a>
                </li>

                <li class="nav-item">
                    <span class="user-chip">
                        {{ auth()->user()->name }}
                    </span>
                </li>

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-logout">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <main class="py-4">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show card-clean">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show card-clean">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>