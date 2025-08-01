<div class="form-group">
    <label for="judul_agenda">Judul Agenda</label>
    <input type="text" name="judul_agenda" id="judul_agenda" class="form-control @error('judul_agenda') is-invalid @enderror" value="{{ old('judul_agenda', $agenda->judul_agenda ?? '') }}" required>
    @error('judul_agenda')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="isi_agenda">Isi Agenda</label>
    <textarea name="isi_agenda" id="isi_agenda" class="form-control @error('isi_agenda') is-invalid @enderror" rows="5" required>{{ old('isi_agenda', $agenda->isi_agenda ?? '') }}</textarea>
    @error('isi_agenda')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="datetime-local" name="tanggal_mulai" id="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai', isset($agenda) ? $agenda->tanggal_mulai->format('Y-m-d\TH:i') : '') }}" required>
            @error('tanggal_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai (Opsional)</label>
            <input type="datetime-local" name="tanggal_selesai" id="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai', isset($agenda) && $agenda->tanggal_selesai ? $agenda->tanggal_selesai->format('Y-m-d\TH:i') : '') }}">
            @error('tanggal_selesai')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="lokasi">Lokasi</label>
    <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $agenda->lokasi ?? '') }}" required>
    @error('lokasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
