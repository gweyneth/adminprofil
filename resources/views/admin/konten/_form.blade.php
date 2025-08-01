<div class="form-group">
    <label for="judul">Judul</label>
    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $konten->judul ?? '') }}" required>
    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="isi">Isi Konten</label>
    <textarea name="isi" id="isi" class="form-control @error('isi') is-invalid @enderror" rows="10" required>{{ old('isi', $konten->isi ?? '') }}</textarea>
    @error('isi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="jenis">Jenis Konten</label>
            <select name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="berita" {{ (old('jenis', $konten->jenis ?? '') == 'berita') ? 'selected' : '' }}>Berita</option>
                <option value="artikel" {{ (old('jenis', $konten->jenis ?? '') == 'artikel') ? 'selected' : '' }}>Artikel</option>
            </select>
            @error('jenis')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl_publikasi">Tanggal Publikasi</label>
            <input type="datetime-local" name="tgl_publikasi" id="tgl_publikasi" class="form-control @error('tgl_publikasi') is-invalid @enderror" value="{{ old('tgl_publikasi', isset($konten) ? $konten->tgl_publikasi->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}" required>
            @error('tgl_publikasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="gambar">Gambar Unggulan</label>
    <input type="file" name="gambar" id="gambar" class="form-control-file @error('gambar') is-invalid @enderror">
    @if(isset($konten) && $konten->gambar)
        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
        <img src="{{ Storage::url($konten->gambar) }}" alt="Gambar" class="img-thumbnail mt-2" width="200">
    @endif
    @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
