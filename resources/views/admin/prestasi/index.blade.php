@extends('layouts.admin')

@section('title', 'Daftar Prestasi')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Prestasi</h3>
        <div class="card-tools">
            <a href="{{ route('admin.prestasi.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Prestasi
            </a>
        </div>
    </div>
    <div class="card-body">
        {{-- Form Pencarian (Diperbarui) --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <form action="{{ route('admin.prestasi.index') }}" method="GET" class="form-inline justify-content-center">
                    <div class="form-group mx-sm-2 mb-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama prestasi..." value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-search"></i> Cari</button>
                    <a href="{{ route('admin.prestasi.index') }}" class="btn btn-secondary mb-2 ml-2">Reset</a>
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
            @forelse($prestasis as $item)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $item->foto ? Storage::url($item->foto) : 'https://placehold.co/600x400/e2e8f0/e2e8f0?text=.' }}" class="card-img-top" alt="{{ $item->nama_prestasi }}" style="height: 180px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title font-weight-bold">{{ $item->nama_prestasi }}</h5>
                            <p class="card-text text-muted mt-2 flex-grow-1">{{ \Illuminate\Support\Str::limit($item->deskripsi, 50, '...') }}</p>
                        </div>
                        <div class="card-footer bg-white text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-info detail-btn" data-id="{{ $item->id }}" data-toggle="modal" data-target="#detailModal">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <a href="{{ route('admin.prestasi.edit', $item->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger" onclick="if(confirm('Anda yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.prestasi.destroy', $item->id) }}" method="POST" style="display: none;">
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
                        @if(request('search'))
                            Tidak ada data prestasi yang cocok dengan pencarian "{{ request('search') }}".
                        @else
                            Belum ada data prestasi yang ditambahkan.
                        @endif
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <div class="card-footer clearfix">
        {{ $prestasis->appends(request()->query())->links() }}
    </div>
</div>

<!-- Modal untuk Detail Prestasi -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Prestasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
            <img id="modalFoto" src="" alt="Foto Prestasi" class="img-fluid rounded" style="max-height: 300px;">
        </div>
        <h3 id="modalNamaPrestasi" class="text-center font-weight-bold"></h3>
        <hr>
        <p id="modalDeskripsi" style="text-align: justify;"></p>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.detail-btn').on('click', function() {
            var prestasiId = $(this).data('id');
            var url = "{{ url('admin/prestasi') }}/" + prestasiId;

            // Reset modal content
            $('#modalNamaPrestasi').text('Memuat...');
            $('#modalDeskripsi').text('');
            $('#modalFoto').attr('src', 'https://placehold.co/600x400/e2e8f0/e2e8f0?text=.');

            // Fetch data via AJAX
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#modalNamaPrestasi').text(response.nama_prestasi);
                    $('#modalDeskripsi').text(response.deskripsi);
                    $('#modalFoto').attr('src', response.foto_url);
                },
                error: function() {
                    $('#modalNamaPrestasi').text('Gagal memuat data');
                }
            });
        });
    });
</script>
@endpush
