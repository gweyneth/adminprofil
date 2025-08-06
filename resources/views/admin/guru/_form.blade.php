<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $guru->nama ?? '') }}" required>
            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            {{-- Diubah dari NIP menjadi NUPTK --}}
            <label for="nuptk">NUPTK</label>
            <input type="text" name="nuptk" id="nuptk" class="form-control @error('nuptk') is-invalid @enderror" value="{{ old('nuptk', $guru->nuptk ?? '') }}">
            @error('nuptk')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="jabatan">Jabatan / Mengajar</label>
            <input type="text" name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', $guru->jabatan ?? '') }}" required placeholder="Contoh: Guru Matematika / Kepala Sekolah">
            @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="jurusan_id">Jurusan (Jika Guru Jurusan)</label>
            <select name="jurusan_id" id="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror">
                <option value="">-- Pilih Jurusan (atau kosongkan untuk staf umum) --</option>
                {{-- PERBAIKAN: Menggunakan variabel $jurusans --}}
                @foreach($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}" {{ (old('jurusan_id', $guru->jurusan_id ?? '') == $jurusan->id) ? 'selected' : '' }}>
                        {{ $jurusan->nama_jurusan }}
                    </option>
                @endforeach
            </select>
            @error('jurusan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <hr>
        <h5>Media Sosial (Opsional)</h5>
         <div class="form-group">
            <label for="instagram_url">Instagram URL</label>
            <input type="url" name="instagram_url" id="instagram_url" class="form-control @error('instagram_url') is-invalid @enderror" value="{{ old('instagram_url', $guru->instagram_url ?? '') }}" placeholder="https://instagram.com/username">
            @error('instagram_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="foto">Foto</label>
            <input type="file" name="foto" id="foto" class="form-control-file @error('foto') is-invalid @enderror">
            @if(isset($guru) && $guru->foto)
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                <img src="{{ Storage::url($guru->foto) }}" alt="Foto Guru" class="img-thumbnail mt-2" width="150">
            @endif
            @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
