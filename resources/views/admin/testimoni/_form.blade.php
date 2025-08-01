<div class="form-group">
    <label for="nama_pemberi">Nama Pemberi Testimoni</label>
    <input type="text" name="nama_pemberi" id="nama_pemberi" class="form-control @error('nama_pemberi') is-invalid @enderror" value="{{ old('nama_pemberi', $testimoni->nama_pemberi ?? '') }}" required>
    @error('nama_pemberi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="jabatan_atau_asal">Jabatan / Asal</label>
    <input type="text" name="jabatan_atau_asal" id="jabatan_atau_asal" class="form-control @error('jabatan_atau_asal') is-invalid @enderror" value="{{ old('jabatan_atau_asal', $testimoni->jabatan_atau_asal ?? '') }}" required placeholder="Contoh: Alumni 2020, HRD PT. Maju Jaya">
    @error('jabatan_atau_asal')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="isi_testimoni">Isi Testimoni</label>
    <textarea name="isi_testimoni" id="isi_testimoni" class="form-control @error('isi_testimoni') is-invalid @enderror" rows="5" required>{{ old('isi_testimoni', $testimoni->isi_testimoni ?? '') }}</textarea>
    @error('isi_testimoni')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="foto">Foto</label>
    <input type="file" name="foto" id="foto" class="form-control-file @error('foto') is-invalid @enderror">
    @if(isset($testimoni) && $testimoni->foto)
        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
        <img src="{{ Storage::url($testimoni->foto) }}" alt="Foto" class="img-thumbnail mt-2" width="150">
    @endif
    @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
