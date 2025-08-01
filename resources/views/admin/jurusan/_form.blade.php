<div class="form-group">
    <label for="nama_jurusan">Nama Jurusan</label>
    <input type="text" name="nama_jurusan" id="nama_jurusan" class="form-control @error('nama_jurusan') is-invalid @enderror" value="{{ old('nama_jurusan', $jurusan->nama_jurusan ?? '') }}" required>
    @error('nama_jurusan')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="deskripsi">Deskripsi</label>
    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" required>{{ old('deskripsi', $jurusan->deskripsi ?? '') }}</textarea>
    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="gambar">Gambar Jurusan</label>
    <input type="file" name="gambar" id="gambar" class="form-control-file @error('gambar') is-invalid @enderror">
    @if(isset($jurusan) && $jurusan->gambar)
        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
        <img src="{{ Storage::url($jurusan->gambar) }}" alt="Gambar Jurusan" class="img-thumbnail mt-2" width="200">
    @endif
    @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
