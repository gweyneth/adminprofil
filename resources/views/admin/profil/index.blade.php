@extends('layouts.admin')

@section('title', 'Kelola Profil Sekolah')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Formulir Profil Sekolah</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form action="{{ route('admin.profil.storeOrUpdate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- Kolom Kiri --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_sekolah">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control @error('nama_sekolah') is-invalid @enderror" value="{{ old('nama_sekolah', $profil->nama_sekolah) }}" required>
                        @error('nama_sekolah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="npsn">NPSN</label>
                        <input type="text" name="npsn" id="npsn" class="form-control @error('npsn') is-invalid @enderror" value="{{ old('npsn', $profil->npsn) }}">
                        @error('npsn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat', $profil->alamat) }}</textarea>
                        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon</label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp', $profil->no_telp) }}" required>
                        @error('no_telp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $profil->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                     <div class="form-group">
                        <label for="logo">Logo Sekolah</label>
                        <input type="file" name="logo" id="logo" class="form-control-file @error('logo') is-invalid @enderror">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah logo. Max 2MB.</small>
                        @if($profil->logo)
                            <img src="{{ Storage::url($profil->logo) }}" alt="Logo" class="img-thumbnail mt-2" width="150">
                        @endif
                        @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Kolom Kanan --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sejarah">Sejarah</label>
                        <textarea name="sejarah" id="sejarah" class="form-control @error('sejarah') is-invalid @enderror" rows="5" required>{{ old('sejarah', $profil->sejarah) }}</textarea>
                        @error('sejarah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="visi">Visi</label>
                        <textarea name="visi" id="visi" class="form-control @error('visi') is-invalid @enderror" rows="5" required>{{ old('visi', $profil->visi) }}</textarea>
                        @error('visi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="misi">Misi</label>
                        <textarea name="misi" id="misi" class="form-control @error('misi') is-invalid @enderror" rows="5" required>{{ old('misi', $profil->misi) }}</textarea>
                        @error('misi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <hr>
            <h4>Media Sosial & Peta</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="facebook_url">URL Facebook</label>
                        <input type="url" name="facebook_url" id="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror" value="{{ old('facebook_url', $profil->facebook_url) }}" placeholder="https://facebook.com/namasekolah">
                        @error('facebook_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="instagram_url">URL Instagram</label>
                        <input type="url" name="instagram_url" id="instagram_url" class="form-control @error('instagram_url') is-invalid @enderror" value="{{ old('instagram_url', $profil->instagram_url) }}" placeholder="https://instagram.com/namasekolah">
                        @error('instagram_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                     <div class="form-group">
                        <label for="youtube_url">URL Youtube</label>
                        <input type="url" name="youtube_url" id="youtube_url" class="form-control @error('youtube_url') is-invalid @enderror" value="{{ old('youtube_url', $profil->youtube_url) }}" placeholder="https://youtube.com/c/namasekolah">
                        @error('youtube_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="maps">Embed Code Google Maps</label>
                        <textarea name="maps" id="maps" class="form-control @error('maps') is-invalid @enderror" rows="7" placeholder="Salin tempel kode iframe dari Google Maps di sini">{{ old('maps', $profil->maps) }}</textarea>
                        @error('maps')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
