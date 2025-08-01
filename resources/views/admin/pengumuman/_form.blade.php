<div class="form-group">
    <label for="judul_pengumuman">Judul Pengumuman</label>
    <input type="text" name="judul_pengumuman" id="judul_pengumuman" class="form-control @error('judul_pengumuman') is-invalid @enderror" value="{{ old('judul_pengumuman', $pengumuman->judul_pengumuman ?? '') }}" required>
    @error('judul_pengumuman')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="isi_pengumuman">Isi Pengumuman</label>
    <textarea name="isi_pengumuman" id="isi_pengumuman" class="form-control @error('isi_pengumuman') is-invalid @enderror" rows="5" required>{{ old('isi_pengumuman', $pengumuman->isi_pengumuman ?? '') }}</textarea>
    @error('isi_pengumuman')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tanggal_publikasi">Tanggal Publikasi</label>
            <input type="datetime-local" name="tanggal_publikasi" id="tanggal_publikasi" class="form-control @error('tanggal_publikasi') is-invalid @enderror" value="{{ old('tanggal_publikasi', isset($pengumuman) ? $pengumuman->tanggal_publikasi->format('Y-m-d\TH:i') : '') }}" required>
            @error('tanggal_publikasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa (Opsional)</label>
            <input type="date" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa" class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror" value="{{ old('tanggal_kadaluarsa', isset($pengumuman) && $pengumuman->tanggal_kadaluarsa ? $pengumuman->tanggal_kadaluarsa->format('Y-m-d') : '') }}">
            @error('tanggal_kadaluarsa')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
