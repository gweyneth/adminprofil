<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Sekolah | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- AdminLTE css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

@php
    // Mengambil data profil sekolah sekali saja untuk digunakan di seluruh layout
    $profilSekolah = \App\Models\ProfilSekolah::first();
@endphp

<div class="wrapper">

    <!-- Preloader dengan Logo Dinamis -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" 
             src="{{ $profilSekolah && $profilSekolah->logo ? \Illuminate\Support\Facades\Storage::url($profilSekolah->logo) : 'https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png' }}" 
             alt="Logo Sekolah" 
             height="60" 
             width="60"
             style="border-radius: 50%;">
    </div>

    @include('layouts.partials.navbar')
    @include('layouts.partials.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

    @include('layouts.partials.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- bs-custom-file-input -->
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

{{-- Script untuk menampilkan notifikasi Toastr --}}
<script>
    @if(Session::has('success'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ session('success') }}");
    @endif

    @if(Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    @endif
</script>

{{-- Script untuk Jam Digital --}}
<script>
    function updateClock() {
        const now = new Date();
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const day = days[now.getDay()];
        const date = now.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
        const time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        
        const clockElement = document.getElementById('digital-clock');
        if (clockElement) {
            clockElement.textContent = `${day}, ${date} | ${time}`;
        }
    }

    setInterval(updateClock, 1000);
    updateClock();
</script>

@stack('scripts')
</body>
</html>
