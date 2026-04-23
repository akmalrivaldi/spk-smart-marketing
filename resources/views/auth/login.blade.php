<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPK SMART Marketing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd, #3b82f6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            border: 0;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.18);
            overflow: hidden;
        }

        .login-header {
            background: #ffffff;
            padding: 32px 32px 10px;
            text-align: center;
        }

        .login-body {
            background: #ffffff;
            padding: 20px 32px 32px;
        }

        .app-title {
            font-weight: 800;
            margin-bottom: 6px;
            color: #1f2937;
        }

        .app-subtitle {
            color: #6b7280;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="card login-card">
        <div class="login-header">
            <h2 class="app-title">SPK SMART Marketing</h2>
            <p class="app-subtitle">Silakan login untuk masuk ke sistem</p>
        </div>

        <div class="login-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email"
                        autofocus
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan password"
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Login
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>