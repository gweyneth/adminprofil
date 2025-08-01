<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | Profil Sekolah</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- AdminLTE css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    
    <style>
        .logo-side {
            background: linear-gradient(rgba(0, 86, 179, 0.8), rgba(0, 86, 179, 0.8)), url('https://source.unsplash.com/random/1200x900/?school,library') no-repeat center center;
            background-size: cover;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
            text-align: center;
        }
        .logo-side img {
            width: 140px;
            height: 140px;
            object-fit: contain;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            padding: 15px;
            border: 2px solid rgba(255,255,255,0.5);
        }
        .inspiration-quote {
            max-width: 85%;
            margin-top: 40px;
            font-style: italic;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-side {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background-color: #f9fafb;
        }
        .login-card-body {
            width: 400px;
            max-width: 100%;
            background-color: #fff;
            padding: 2rem;
            border-radius: .5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
    </style>
</head>
<body class="hold-transition">
    <div class="container-fluid p-0">
        <div class="row g-0" style="min-height: 100vh;">
            <!-- Kolom Kiri untuk Logo dan Inspirasi -->
            <div class="col-lg-7 d-none d-lg-block logo-side">
                @if(isset($profil) && $profil->logo)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($profil->logo) }}" alt="Logo Sekolah">
                @else
                    <i class="fas fa-school fa-5x mb-3"></i>
                @endif
                <h2 class="font-weight-bold mb-2">{{ $profil->nama_sekolah ?? 'Profil Sekolah' }}</h2>
                <p class="lead">{{ $profil->alamat ?? 'Alamat Sekolah' }}</p>

                <figure class="inspiration-quote">
                    <i class="fas fa-quote-left fa-2x"></i>
                    
                        <p class="mb-0">"Pendidikan adalah paspor untuk masa depan, karena hari esok adalah milik mereka yang mempersiapkannya hari ini."</p>
                    
                    <figcaption class="blockquote-footer text-white-50 mt-2">
                        Malcolm X
                    </figcaption>
                </figure>
            </div>

            <!-- Kolom Kanan untuk Form -->
            <div class="col-lg-5 d-flex align-items-center justify-content-center form-side">
                <div class="login-card-body">
                    <h4 class="login-box-msg font-weight-bold">Admin Login</h4>
                    <p class="login-box-msg text-muted">Silakan login untuk memulai sesi Anda</p>

                    <form action="{{ route('login.process') }}" method="post">
                        @csrf
                        {{-- --- BAGIAN YANG DIPERBARUI --- --}}
                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span> {{-- Ikon diubah --}}
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-4">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    {{-- Script untuk menampilkan notifikasi Toastr --}}
    <script>
        @if(Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('success') }}");
        @endif
    </script>
</body>
</html>
