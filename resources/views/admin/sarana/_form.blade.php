<div class="form-group">
    <label for="nama_sarana">Nama Sarana</label>
    <input type="text" name="nama_sarana" id="nama_sarana" class="form-control @error('nama_sarana') is-invalid @enderror" value="{{ old('nama_sarana', $sarana->nama_sarana ?? '') }}" required>
    @error('nama_sarana')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="deskripsi">Deskripsi (Kondisi & Jumlah)</label>
    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" required>{{ old('deskripsi', $sarana->deskripsi ?? '') }}</textarea>
    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="gambar">Foto Sarana</label>
    <input type="file" name="gambar" id="gambar" class="form-control-file @error('gambar') is-invalid @enderror">
    @if(isset($sarana) && $sarana->gambar)
        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
        <img src="{{ Storage::url($sarana->gambar) }}" alt="Foto Sarana" class="img-thumbnail mt-2" width="200">
    @endif
    @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
