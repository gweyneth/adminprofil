<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $guru->nama ?? '') }}" required>
            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="nip">NIP (Nomor Induk Pegawai)</label>
            <input type="text" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip', $guru->nip ?? '') }}">
            @error('nip')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                @foreach($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}" {{ (old('jurusan_id', $guru->jurusan_id ?? '') == $jurusan->id) ? 'selected' : '' }}>
                        {{ $jurusan->nama_jurusan }}
                    </option>
                @endforeach
            </select>
            @error('jurusan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
