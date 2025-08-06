<div class="form-group">
    <label for="nama_organigram">Nama Organigram</label>
    <input type="text" name="nama_organigram" id="nama_organigram" class="form-control @error('nama_organigram') is-invalid @enderror" value="{{ old('nama_organigram', $organigram->nama_organigram ?? '') }}" required placeholder="Contoh: Struktur Organisasi Sekolah">
    @error('nama_organigram')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="deskripsi">Deskripsi (Opsional)</label>
    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4">{{ old('deskripsi', $organigram->deskripsi ?? '') }}</textarea>
    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="gambar">Gambar Organigram</label>
    <input type="file" name="gambar" id="gambar" class="form-control-file @error('gambar') is-invalid @enderror" {{ isset($organigram) ? '' : 'required' }}>
    @if(isset($organigram) && $organigram->gambar)
        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
        <img src="{{ Storage::url($organigram->gambar) }}" alt="Gambar" class="img-thumbnail mt-2" width="300">
    @endif
    @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
