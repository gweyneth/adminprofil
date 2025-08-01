@extends('layouts.admin')

@section('title', 'Kelola Organigram Sekolah')

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Struktur Organisasi Sekolah</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif

        {{-- Form untuk Upload/Update --}}
        <form action="{{ route('admin.organigram.storeOrUpdate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="gambar">Upload Gambar Organigram</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar" name="gambar">
                        <label class="custom-file-label" for="gambar">Pilih file...</label>
                    </div>
                </div>
                <small class="form-text text-muted">Format yang didukung: JPG, PNG, SVG. Maksimal 4MB. Kosongkan jika tidak ingin mengubah gambar.</small>
                @error('gambar')<div class="text-danger mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4">{{ old('deskripsi', $organigram->deskripsi ?? '') }}</textarea>
                @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>

        <hr>

        {{-- Tampilan Gambar Saat Ini --}}
        <h4>Organigram Saat Ini</h4>
        @if(isset($organigram) && $organigram->gambar)
            <div class="mt-3">
                <img src="{{ Storage::url($organigram->gambar) }}" alt="Organigram Sekolah" class="img-fluid rounded border p-2">
                
                {{-- Form untuk Hapus Gambar --}}
                <form action="{{ route('admin.organigram.destroyImage') }}" method="POST" class="mt-2" onsubmit="return confirm('Anda yakin ingin menghapus gambar organigram ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus Gambar</button>
                </form>
            </div>
        @else
            <p class="text-muted">Belum ada gambar organigram yang diupload.</p>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
// Script untuk menampilkan nama file di input file bootstrap
// Menggunakan vanilla JavaScript untuk menghindari error '$ is not defined' jika jQuery tidak dimuat
document.addEventListener('DOMContentLoaded', function () {
  if (window.bsCustomFileInput) {
    bsCustomFileInput.init();
  }
});
</script>
@endpush
