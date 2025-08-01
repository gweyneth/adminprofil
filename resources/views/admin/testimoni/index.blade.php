@extends('layouts.admin')

@section('title', 'Moderasi Testimoni')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tabel Daftar Testimoni Masuk</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama & Jabatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonis as $item)
                    <tr>
                        <td>{{ $loop->iteration + $testimonis->firstItem() - 1 }}</td>
                        <td>
                            @if($item->foto)
                                <img src="{{ Storage::url($item->foto) }}" alt="Foto" width="60" class="rounded-circle">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->nama_pemberi) }}&background=random" alt="Avatar" width="60" class="rounded-circle">
                            @endif
                        </td>
                        <td>
                            <strong>{{ $item->nama_pemberi }}</strong>
                            <br>
                            <small class="text-muted">{{ $item->jabatan_atau_asal }}</small>
                        </td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input status-toggle" id="status-{{ $item->id }}" data-id="{{ $item->id }}" {{ $item->is_published ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status-{{ $item->id }}">{{ $item->is_published ? 'Published' : 'Draft' }}</label>
                            </div>
                        </td>
                        <td>
                            {{-- Tombol Edit dihapus, hanya ada Hapus --}}
                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Anda yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.testimoni.destroy', $item->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data testimoni yang masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $testimonis->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.status-toggle').on('change', function() {
        var testimoniId = $(this).data('id');
        var label = $('label[for="status-' + testimoniId + '"]');
        var url = "{{ url('admin/testimoni') }}/" + testimoniId + "/toggle-status";

        $.ajax({
            url: url,
            type: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.status === 'success') {
                    if(response.is_published) {
                        label.text('Published');
                    } else {
                        label.text('Draft');
                    }
                }
            },
            error: function() {
                alert('Gagal mengubah status.');
                $(this).prop('checked', !$(this).prop('checked'));
            }
        });
    });
});
</script>
@endpush
