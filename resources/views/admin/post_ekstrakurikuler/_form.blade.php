<div class="form-group">
    <label for="nama_kegiatan">Nama Kegiatan</label>
    <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control @error('nama_kegiatan') is-invalid @enderror" value="{{ old('nama_kegiatan', $postEkstrakurikuler->nama_kegiatan ?? '') }}" required>
    @error('nama_kegiatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="ekstrakurikuler_id">Jenis Ekstrakurikuler</label>
    <select name="ekstrakurikuler_id" id="ekstrakurikuler_id" class="form-control @error('ekstrakurikuler_id') is-invalid @enderror" required>
        <option value="">-- Pilih Ekstrakurikuler --</option>
        @foreach($eskuls as $eskul)
            <option value="{{ $eskul->id }}" {{ (old('ekstrakurikuler_id', $postEkstrakurikuler->ekstrakurikuler_id ?? '') == $eskul->id) ? 'selected' : '' }}>
                {{ $eskul->nama_eskul }}
            </option>
        @endforeach
    </select>
    @error('ekstrakurikuler_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="deskripsi">Deskripsi Kegiatan</label>
    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" required>{{ old('deskripsi', $postEkstrakurikuler->deskripsi ?? '') }}</textarea>
    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="foto_kegiatan">Foto Kegiatan</label>
    <input type="file" name="foto_kegiatan" id="foto_kegiatan" class="form-control-file @error('foto_kegiatan') is-invalid @enderror">
    @if(isset($postEkstrakurikuler) && $postEkstrakurikuler->foto_kegiatan)
        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
        <img src="{{ Storage::url($postEkstrakurikuler->foto_kegiatan) }}" alt="Foto Kegiatan" class="img-thumbnail mt-2" width="200">
    @endif
    @error('foto_kegiatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
