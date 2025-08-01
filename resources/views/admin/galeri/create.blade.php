@extends('layouts.admin')

@section('title', 'Tambah Item Galeri')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Formulir Tambah Item Galeri</h3></div>
    <div class="card-body">

        {{-- BAGIAN BARU: Untuk menampilkan semua error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops! Terjadi kesalahan. Silakan periksa kembali form Anda.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="tipe">Tipe Media</label>
                <select name="tipe" id="tipe" class="form-control @error('tipe') is-invalid @enderror" required>
                    <option value="">-- Pilih Tipe --</option>
                    <option value="foto" {{ old('tipe') == 'foto' ? 'selected' : '' }}>Foto</option>
                    <option value="video" {{ old('tipe') == 'video' ? 'selected' : '' }}>Video (Link YouTube)</option>
                </select>
                @error('tipe')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            {{-- Input untuk Foto --}}
            <div class="form-group" id="input-foto" style="display: none;">
                <label for="file_foto">Upload Foto</label>
                <input type="file" name="file_foto" id="file_foto" class="form-control-file @error('file_foto') is-invalid @enderror">
                @error('file_foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            {{-- Input untuk Video --}}
            <div class="form-group" id="input-video" style="display: none;">
                <label for="file_video">Link Video YouTube</label>
                <input type="url" name="file_video" id="file_video" class="form-control @error('file_video') is-invalid @enderror" value="{{ old('file_video') }}" placeholder="Contoh: https://www.youtube.com/watch?v=xxxxxx">
                @error('file_video')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="card-footer text-right">
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tipeSelect = document.getElementById('tipe');
        const inputFoto = document.getElementById('input-foto');
        const inputVideo = document.getElementById('input-video');

        function toggleInputs() {
            if (tipeSelect.value === 'foto') {
                inputFoto.style.display = 'block';
                inputVideo.style.display = 'none';
            } else if (tipeSelect.value === 'video') {
                inputFoto.style.display = 'none';
                inputVideo.style.display = 'block';
            } else {
                inputFoto.style.display = 'none';
                inputVideo.style.display = 'none';
            }
        }

        // Panggil saat halaman dimuat untuk menangani old value
        toggleInputs();

        // Panggil saat pilihan berubah
        tipeSelect.addEventListener('change', toggleInputs);
    });
</script>
@endpush
