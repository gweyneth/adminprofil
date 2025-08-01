@php
    // Mengambil data profil sekolah sekali saja untuk digunakan di sidebar
    $profilSekolah = \App\Models\ProfilSekolah::first();
@endphp

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo (Dinamis) -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ $profilSekolah && $profilSekolah->logo ? \Illuminate\Support\Facades\Storage::url($profilSekolah->logo) : 'https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png' }}" 
             alt="Logo Sekolah" 
             class="brand-image img-circle elevation-3" 
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{ $profilSekolah->nama_sekolah ?? 'Profil Sekolah' }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->foto ? \Illuminate\Support\Facades\Storage::url(auth()->user()->foto) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=random' }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.profil_admin.index') }}" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Grup Menu Halaman & Profil --}}
                <li class="nav-item {{ request()->routeIs('admin.profil.*', 'admin.organigram.*', 'admin.sarana.*', 'admin.galeri.*', 'admin.testimoni.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-university"></i>
                        <p>Profil & Halaman <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.profil.index') }}" class="nav-link {{ request()->routeIs('admin.profil.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i> <p>Profil Sekolah</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.organigram.index') }}" class="nav-link {{ request()->routeIs('admin.organigram.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i> <p>Organigram</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.sarana.index') }}" class="nav-link {{ request()->routeIs('admin.sarana.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i> <p>Sarana & Prasarana</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.galeri.index') }}" class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i> <p>Galeri</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.testimoni.index') }}" class="nav-link {{ request()->routeIs('admin.testimoni.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i> <p>Testimoni</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Grup Menu Publikasi --}}
                <li class="nav-item {{ request()->routeIs('admin.konten.*', 'admin.agenda.*', 'admin.pengumuman.*', 'admin.prestasi.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Publikasi <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.konten.index') }}" class="nav-link {{ request()->routeIs('admin.konten.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i> <p>Konten (Berita/Artikel)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.agenda.index') }}" class="nav-link {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i> <p>Agenda</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.pengumuman.index') }}" class="nav-link {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i> <p>Pengumuman</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.prestasi.index') }}" class="nav-link {{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i> <p>Prestasi</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Grup Menu Akademik --}}
                <li class="nav-item {{ request()->routeIs('admin.jurusan.*', 'admin.guru.*', 'admin.ekstrakurikuler.*', 'admin.post-ekstrakurikuler.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book-reader"></i>
                        <p>Akademik <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.jurusan.index') }}" class="nav-link {{ request()->routeIs('admin.jurusan.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i> <p>Jurusan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.guru.index') }}" class="nav-link {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i> <p>Guru & Staf</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="nav-link {{ request()->routeIs('admin.ekstrakurikuler.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i> <p>Ekstrakurikuler</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.post-ekstrakurikuler.index') }}" class="nav-link {{ request()->routeIs('admin.post-ekstrakurikuler.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i> <p>Post Kegiatan Eskul</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
