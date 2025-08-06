@extends('layouts.admin')

@section('title', 'Daftar Sarana & Prasarana')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Sarana</h3>
        <div class="card-tools">
            <a href="{{ route('admin.sarana.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Sarana
            </a>
        </div>
    </div>
    <div class="card-body">
        {{-- Form Pencarian dan Filter --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <form action="{{ route('admin.sarana.index') }}" method="GET" class="form-inline justify-content-center">
                    <div class="form-group mx-sm-2 mb-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama sarana..." value="{{ request('search') }}">
                    </div>
                    <div class="form-group mx-sm-2 mb-2">
                        <select name="filter_nama" class="form-control">
                            <option value="">-- Filter Berdasarkan Nama --</option>
                            @foreach($all_saranas_for_filter as $item)
                                <option value="{{ $item->nama_sarana }}" {{ request('filter_nama') == $item->nama_sarana ? 'selected' : '' }}>
                                    {{ $item->nama_sarana }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-search"></i> Terapkan</button>
                    <a href="{{ route('admin.sarana.index') }}" class="btn btn-secondary mb-2 ml-2">Reset</a>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif

        {{-- Tampilan Tabel --}}
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Sarana</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($saranas as $item)
                    <tr>
                        <td>{{ $loop->iteration + $saranas->firstItem() - 1 }}</td>
                        <td>
                            @if($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}" alt="Foto" width="100" class="rounded">
                            @else
                                <span class="badge badge-secondary">Tidak ada foto</span>
                            @endif
                        </td>
                        <td>{{ $item->nama_sarana }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($item->deskripsi, 100, '...') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-info detail-btn" data-id="{{ $item->id }}" data-toggle="modal" data-target="#detailModal">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <a href="{{ route('admin.sarana.edit', $item->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger" onclick="if(confirm('Anda yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.sarana.destroy', $item->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            @if(request('search') || request('filter_nama'))
                                Tidak ada data sarana yang cocok dengan kriteria filter Anda.
                            @else
                                Belum ada data sarana yang ditambahkan.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $saranas->appends(request()->query())->links() }}
    </div>
</div>

<!-- Modal untuk Detail Sarana -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Sarana</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
            <img id="modalGambar" src="" alt="Foto Sarana" class="img-fluid rounded" style="max-height: 300px;">
        </div>
        <h3 id="modalNamaSarana" class="text-center font-weight-bold"></h3>
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
            var saranaId = $(this).data('id');
            var url = "{{ url('admin/sarana') }}/" + saranaId;

            // Reset modal content
            $('#modalNamaSarana').text('Memuat...');
            $('#modalDeskripsi').text('');
            $('#modalGambar').attr('src', 'https://placehold.co/600x400/e2e8f0/e2e8f0?text=.');

            // Fetch data via AJAX
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#modalNamaSarana').text(response.nama_sarana);
                    $('#modalDeskripsi').text(response.deskripsi);
                    $('#modalGambar').attr('src', response.gambar_url);
                },
                error: function() {
                    $('#modalNamaSarana').text('Gagal memuat data');
                }
            });
        });
    });
</script>
@endpush
