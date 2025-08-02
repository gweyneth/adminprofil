@extends('layouts.admin')

@section('title', 'Daftar Konten')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Konten</h3>
        <div class="card-tools">
            <a href="{{ route('admin.konten.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Konten
            </a>
        </div>
    </div>
    <div class="card-body">
        {{-- Form Pencarian dan Filter --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <form action="{{ route('admin.konten.index') }}" method="GET" class="form-inline justify-content-center">
                    <div class="form-group mx-sm-2 mb-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari judul konten..." value="{{ request('search') }}">
                    </div>
                    <div class="form-group mx-sm-2 mb-2">
                        <select name="filter_jenis" class="form-control">
                            <option value="">-- Filter Berdasarkan Jenis --</option>
                            @foreach($all_jenis_for_filter as $item)
                                <option value="{{ $item->jenis }}" {{ request('filter_jenis') == $item->jenis ? 'selected' : '' }}>
                                    {{ ucfirst($item->jenis) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-search"></i> Terapkan</button>
                    <a href="{{ route('admin.konten.index') }}" class="btn btn-secondary mb-2 ml-2">Reset</a>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif

        {{-- Tampilan Kartu --}}
        <div class="row">
            @forelse($konten as $item)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $item->gambar ? Storage::url($item->gambar) : 'https://placehold.co/600x400/e2e8f0/e2e8f0?text=.' }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 180px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title font-weight-bold">{{ \Illuminate\Support\Str::limit($item->judul, 50, '...') }}</h5>
                            <div class="mt-2 flex-grow-1">
                                <span class="badge badge-primary">{{ ucfirst($item->jenis) }}</span>
                            </div>
                            <small class="text-muted mt-2">Dipublikasikan: {{ $item->tgl_publikasi->format('d M Y') }}</small>
                        </div>
                        <div class="card-footer bg-white text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                {{-- Tombol Detail ditambahkan --}}
                                <button type="button" class="btn btn-info detail-btn" data-id="{{ $item->id }}" data-toggle="modal" data-target="#detailModal">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <a href="{{ route('admin.konten.edit', $item->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger" onclick="if(confirm('Anda yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.konten.destroy', $item->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Data Tidak Ditemukan</h5>
                        @if(request('search') || request('filter_jenis'))
                            Tidak ada data konten yang cocok dengan kriteria filter Anda.
                        @else
                            Belum ada data konten yang ditambahkan.
                        @endif
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <div class="card-footer clearfix">
        {{ $konten->appends(request()->query())->links() }}
    </div>
</div>

<!-- Modal untuk Detail Konten -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  {{-- Ukuran modal diubah dari modal-lg menjadi ukuran standar dan diposisikan di tengah --}}
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Konten</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
            <img id="modalGambar" src="" alt="Gambar Konten" class="img-fluid rounded" style="max-height: 300px;">
        </div>
        <h3 id="modalJudul" class="font-weight-bold"></h3>
        <div class="d-flex justify-content-between text-muted border-bottom pb-2 mb-3">
            <span id="modalJenis"></span>
            <span id="modalTanggal"></span>
        </div>
        <div id="modalIsi" style="text-align: justify;"></div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.detail-btn').on('click', function() {
            var kontenId = $(this).data('id');
            var url = "{{ url('admin/konten') }}/" + kontenId;

            // Reset modal content
            $('#modalJudul, #modalJenis, #modalTanggal, #modalIsi').text('');
            $('#modalGambar').attr('src', 'https://placehold.co/600x400/e2e8f0/e2e8f0?text=.');

            // Fetch data via AJAX
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#modalJudul').text(response.judul);
                    $('#modalJenis').text('Jenis: ' + response.jenis.charAt(0).toUpperCase() + response.jenis.slice(1));
                    
                    // Format tanggal
                    var tgl = new Date(response.tgl_publikasi);
                    var options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
                    $('#modalTanggal').text('Dipublikasikan: ' + tgl.toLocaleDateString('id-ID', options));
                    
                    $('#modalIsi').html(response.isi.replace(/\n/g, '<br>')); // Ganti baris baru dengan <br>
                    $('#modalGambar').attr('src', response.gambar_url);
                },
                error: function() {
                    $('#modalJudul').text('Gagal memuat data');
                }
            });
        });
    });
</script>
@endpush
