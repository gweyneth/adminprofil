@extends('layouts.admin')

{{-- Judul Halaman --}}
@section('title', 'Dashboard')

{{-- Konten Halaman --}}
@section('content')
{{-- Baris untuk Info Box / Card Statistik --}}
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $jumlahJurusan }}</h3>
                <p>Total Jurusan</p>
            </div>
            <div class="icon"><i class="fas fa-graduation-cap"></i></div>
            <a href="{{ route('admin.jurusan.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $jumlahGuru }}</h3>
                <p>Total Guru & Staf</p>
            </div>
            <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
            <a href="{{ route('admin.guru.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $jumlahKonten }}</h3>
                <p>Total Konten</p>
            </div>
            <div class="icon"><i class="fas fa-file-alt"></i></div>
            <a href="{{ route('admin.konten.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $jumlahGaleri }}</h3>
                <p>Item Galeri</p>
            </div>
            <div class="icon"><i class="fas fa-images"></i></div>
            <a href="{{ route('admin.galeri.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $jumlahEskul }}</h3>
                <p>Ekstrakurikuler</p>
            </div>
            <div class="icon"><i class="fas fa-volleyball-ball"></i></div>
            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ $jumlahPrestasi }}</h3>
                <p>Total Prestasi</p>
            </div>
            <div class="icon"><i class="fas fa-trophy"></i></div>
            <a href="{{ route('admin.prestasi.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<!-- /.row -->

{{-- Baris untuk konten utama --}}
<div class="row">
    <div class="col-lg-7">
        {{-- Card Aktivitas Terbaru --}}
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-history"></i> Aktivitas Terbaru</h3>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($aktivitasTerbaru as $item)
                        <li class="list-group-item">
                            @if($item instanceof \App\Models\Testimoni)
                                <div class="d-flex w-100 justify-content-between">
                                    <div>
                                        <i class="fas fa-comment-dots text-warning mr-2"></i>
                                        Testimoni baru dari <strong>{{ $item->nama_pemberi }}</strong> menunggu persetujuan.
                                    </div>
                                    <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                                </div>
                                <a href="{{ route('admin.testimoni.index') }}" class="stretched-link"></a>
                            @elseif($item instanceof \App\Models\Konten)
                                <div class="d-flex w-100 justify-content-between">
                                    <div>
                                        <i class="fas fa-file-alt text-success mr-2"></i>
                                        Konten baru ditambahkan: <strong>{{ \Illuminate\Support\Str::limit($item->judul, 40) }}</strong>
                                    </div>
                                    <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                                </div>
                                <a href="{{ route('admin.konten.index') }}" class="stretched-link"></a>
                            @endif
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted">
                            Belum ada aktivitas terbaru.
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        {{-- Card Selamat Datang --}}
        <div class="card bg-primary text-white">
             <div class="card-body">
                <h4 class="card-title">Selamat Datang, <strong>{{ auth()->user()->name }}</strong>!</h4>
                <p class="card-text mt-3">
                    Anda login sebagai admin. Gunakan menu di sebelah kiri untuk mengelola konten website sekolah.
                </p>
                <a href="{{ route('admin.profil_admin.index') }}" class="btn btn-outline-light mt-2">
                    <i class="fas fa-user-edit"></i> Edit Profil Saya
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
