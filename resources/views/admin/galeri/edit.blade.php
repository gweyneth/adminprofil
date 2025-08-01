@extends('layouts.admin')

@section('title', 'Edit Item Galeri')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Formulir Edit Item Galeri</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $galeri->judul) }}" required>
                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Tipe Media</label>
                <input type="text" class="form-control" value="{{ ucfirst($galeri->tipe) }}" readonly>
            </div>
            
            <div class="form-group">
                <label>Preview</label>
                <div>
                    @if($galeri->tipe == 'foto')
                        <img src="{{ Storage::url($galeri->file) }}" alt="{{ $galeri->judul }}" class="img-thumbnail" width="300">
                    @else
                        <p><a href="{{ $galeri->file }}" target="_blank">{{ $galeri->file }}</a></p>
                    @endif
                </div>
                <small class="form-text text-muted">Perubahan file atau link video tidak diizinkan. Silakan hapus dan buat item baru jika perlu.</small>
            </div>

            <div class="card-footer text-right">
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
