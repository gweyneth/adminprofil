@extends('layouts.admin')
@section('title', 'Daftar Organigram')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Organigram</h3>
        <div class="card-tools">
            <a href="{{ route('admin.organigram.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Organigram</a>
        </div>
    </div>
    <div class="card-body">
        {{-- Form Filter --}}
        <div class="row mb-4">
            <div class="col-md-8 offset-md-2">
                <form action="{{ route('admin.organigram.index') }}" method="GET">
                    <div class="input-group">
                        <select name="filter_nama" class="form-control">
                            <option value="">-- Tampilkan Semua --</option>
                            @foreach($all_organigrams_for_filter as $item)
                                <option value="{{ $item->nama_organigram }}" {{ request('filter_nama') == $item->nama_organigram ? 'selected' : '' }}>
                                    {{ $item->nama_organigram }}
                                </option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Filter</button>
                            <a href="{{ route('admin.organigram.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
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
            @forelse($organigrams as $item)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header font-weight-bold">{{ $item->nama_organigram }}</div>
                        <div class="card-body">
                            <img src="{{ Storage::url($item->gambar) }}" class="img-fluid rounded" alt="{{ $item->nama_organigram }}">
                        </div>
                        <div class="card-footer bg-white text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-info detail-btn" data-id="{{ $item->id }}" data-toggle="modal" data-target="#detailModal">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <a href="{{ route('admin.organigram.edit', $item->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger" onclick="if(confirm('Anda yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.organigram.destroy', $item->id) }}" method="POST" style="display: none;">
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
                        @if(request('filter_nama'))
                            Tidak ada data organigram yang cocok dengan filter Anda.
                        @else
                            Belum ada data organigram yang ditambahkan.
                        @endif
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <div class="card-footer clearfix">
        {{ $organigrams->appends(request()->query())->links() }}
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalNamaOrganigram"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="modalDeskripsi"></p>
        <img id="modalGambar" src="" class="img-fluid rounded">
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.detail-btn').on('click', function() {
            var id = $(this).data('id');
            var url = "{{ url('admin/organigram') }}/" + id;

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#modalNamaOrganigram').text(response.nama_organigram);
                    $('#modalDeskripsi').text(response.deskripsi || 'Tidak ada deskripsi.');
                    $('#modalGambar').attr('src', response.gambar_url);
                }
            });
        });
    });
</script>
@endpush
