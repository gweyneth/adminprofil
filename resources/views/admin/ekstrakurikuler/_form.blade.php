<div class="form-group">
    <label for="nama_eskul">Nama Ekstrakurikuler</label>
    <input type="text" name="nama_eskul" id="nama_eskul" class="form-control @error('nama_eskul') is-invalid @enderror" value="{{ old('nama_eskul', $ekstrakurikuler->nama_eskul ?? '') }}" required>
    @error('nama_eskul')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="nama_pembina">Nama Pembina</label>
    <input type="text" name="nama_pembina" id="nama_pembina" class="form-control @error('nama_pembina') is-invalid @enderror" value="{{ old('nama_pembina', $ekstrakurikuler->nama_pembina ?? '') }}" required>
    @error('nama_pembina')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="deskripsi">Deskripsi</label>
    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" required>{{ old('deskripsi', $ekstrakurikuler->deskripsi ?? '') }}</textarea>
    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="gambar">Gambar / Logo</label>
    <input type="file" name="gambar" id="gambar" class="form-control-file @error('gambar') is-invalid @enderror">
    @if(isset($ekstrakurikuler) && $ekstrakurikuler->gambar)
        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
        <img src="{{ Storage::url($ekstrakurikuler->gambar) }}" alt="Gambar Eskul" class="img-thumbnail mt-2" width="200">
    @endif
    @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
