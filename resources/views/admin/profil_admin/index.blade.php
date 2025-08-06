@extends('layouts.admin')

@section('title', 'Kelola Profil Saya')

@section('content')
<div class="row">
    <div class="col-md-4">
        {{-- Kartu Profil Samping --}}
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ $admin->foto ? \Illuminate\Support\Facades\Storage::url($admin->foto) : 'https://ui-avatars.com/api/?name='.urlencode($admin->name).'&background=random&color=fff' }}"
                         alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $admin->name }}</h3>
                <p class="text-muted text-center">{{ $admin->username }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        {{-- Kartu dengan Tab --}}
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-profil-tab" data-toggle="pill" href="#tab-profil" role="tab" aria-controls="tab-profil" aria-selected="true">Edit Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-password-tab" data-toggle="pill" href="#tab-password" role="tab" aria-controls="tab-password" aria-selected="false">Ubah Password</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    {{-- Konten Tab Edit Profil --}}
                    <div class="tab-pane fade show active" id="tab-profil" role="tabpanel" aria-labelledby="tab-profil-tab">
                        @if(session('success_profile'))
                            <div class="alert alert-success">{{ session('success_profile') }}</div>
                        @endif
                        <form action="{{ route('admin.profil_admin.updateProfile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $admin->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $admin->username) }}" required>
                                @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="foto">Ganti Foto Profil</label>
                                <input type="file" name="foto" id="foto" class="form-control-file @error('foto') is-invalid @enderror">
                                @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan Profil</button>
                        </form>
                    </div>
                    {{-- Konten Tab Ubah Password --}}
                    <div class="tab-pane fade" id="tab-password" role="tabpanel" aria-labelledby="tab-password-tab">
                        @if(session('success_password'))
                            <div class="alert alert-success">{{ session('success_password') }}</div>
                        @endif
                        @if(session('error_password'))
                            <div class="alert alert-danger">{{ session('error_password') }}</div>
                        @endif
                        <form action="{{ route('admin.profil_admin.updatePassword') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="current_password">Password Saat Ini</label>
                                <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                                @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Ubah Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
