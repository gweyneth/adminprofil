<div class="form-group">
    <label for="nama_prestasi">Nama Prestasi</label>
    <input type="text" name="nama_prestasi" id="nama_prestasi" class="form-control @error('nama_prestasi') is-invalid @enderror" value="{{ old('nama_prestasi', $prestasi->nama_prestasi ?? '') }}" required>
    @error('nama_prestasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="deskripsi">Deskripsi</label>
    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" required>{{ old('deskripsi', $prestasi->deskripsi ?? '') }}</textarea>
    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="foto">Foto</label>
    <input type="file" name="foto" id="foto" class="form-control-file @error('foto') is-invalid @enderror">
    @if(isset($prestasi) && $prestasi->foto)
        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
        <img src="{{ Storage::url($prestasi->foto) }}" alt="Foto Prestasi" class="img-thumbnail mt-2" width="200">
    @endif
    @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
