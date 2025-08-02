@extends('layouts.admin')

@section('title', 'Moderasi Testimoni')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Testimoni Masuk</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif

        <div class="row">
            @forelse($testimonis as $item)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $item->foto ? Storage::url($item->foto) : 'https://ui-avatars.com/api/?name='.urlencode($item->nama_pemberi).'&background=random' }}" 
                                     alt="Foto" 
                                     class="rounded-circle mr-3" 
                                     width="60" height="60" style="object-fit: cover;">
                                <div>
                                    <h5 class="card-title mb-0 font-weight-bold">{{ $item->nama_pemberi }}</h5>
                                    <p class="card-text text-muted mb-0">{{ $item->jabatan_atau_asal }}</p>
                                </div>
                            </div>
                            <p class="card-text">"{{ \Illuminate\Support\Str::limit($item->isi_testimoni, 100, '...') }}"</p>
                        </div>
                        <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input status-toggle" id="status-{{ $item->id }}" data-id="{{ $item->id }}" {{ $item->is_published ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status-{{ $item->id }}">{{ $item->is_published ? 'Published' : 'Draft' }}</label>
                            </div>
                            <div>
                                <button type="button" class="btn btn-info btn-sm detail-btn" data-id="{{ $item->id }}" data-toggle="modal" data-target="#detailModal">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Anda yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('admin.testimoni.destroy', $item->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Belum ada data testimoni yang masuk.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <div class="card-footer">
        {{ $testimonis->links() }}
    </div>
</div>

<!-- Modal untuk Detail Testimoni -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Testimoni</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img id="modalFoto" src="" alt="Foto" class="rounded-circle mb-3" width="100" height="100" style="object-fit: cover;">
        <h4 id="modalNama" class="font-weight-bold"></h4>
        <p id="modalJabatan" class="text-muted"></p>
        <hr>
        <blockquote class="blockquote">
            <p id="modalIsi" class="mb-0" style="text-align: justify;"></p>
        </blockquote>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Script untuk Toggle Status
    $('.status-toggle').on('change', function() {
        var testimoniId = $(this).data('id');
        var label = $('label[for="status-' + testimoniId + '"]');
        var url = "{{ url('admin/testimoni') }}/" + testimoniId + "/toggle-status";

        $.ajax({
            url: url,
            type: 'PATCH',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
                if(response.status === 'success') {
                    label.text(response.is_published ? 'Published' : 'Draft');
                }
            },
            error: function() {
                alert('Gagal mengubah status.');
                $(this).prop('checked', !$(this).prop('checked'));
            }
        });
    });

    // Script untuk Modal Detail
    $('.detail-btn').on('click', function() {
        var testimoniId = $(this).data('id');
        var url = "{{ url('admin/testimoni') }}/" + testimoniId;

        // Reset modal
        $('#modalNama').text('Memuat...');
        $('#modalJabatan, #modalIsi').text('');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#modalFoto').attr('src', response.foto_url);
                $('#modalNama').text(response.nama_pemberi);
                $('#modalJabatan').text(response.jabatan_atau_asal);
                $('#modalIsi').text(response.isi_testimoni);
            },
            error: function() {
                $('#modalNama').text('Gagal memuat data');
            }
        });
    });
});
</script>
@endpush
