@extends('layouts.admin')

@section('title', 'Daftar Jurusan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tabel Daftar Jurusan</h3>
        <div class="card-tools">
            <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary btn-sm">Tambah Jurusan</a>
        </div>
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
                    <th>Gambar</th>
                    <th>Nama Jurusan</th>
                    {{-- KOLOM BARU --}}
                    <th>Deskripsi Singkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jurusan as $item)
                    <tr>
                        <td>{{ $loop->iteration + $jurusan->firstItem() - 1 }}</td>
                        <td>
                            @if($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}" alt="Gambar" width="100" class="rounded">
                            @else
                                <span class="badge badge-secondary">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>{{ $item->nama_jurusan }}</td>
                        {{-- ISI KOLOM BARU --}}
                        <td>{{ \Illuminate\Support\Str::limit($item->deskripsi, 70, '...') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-info detail-btn" data-id="{{ $item->id }}" data-toggle="modal" data-target="#detailModal">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <a href="{{ route('admin.jurusan.edit', $item->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger" onclick="if(confirm('Anda yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.jurusan.destroy', $item->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    {{-- COLSPAN DISESUAIKAN --}}
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data jurusan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $jurusan->links() }}
    </div>
</div>

<!-- Modal untuk Detail Jurusan (Tampilan Diperbaiki) -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Jurusan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            {{-- Kolom untuk gambar --}}
            <div id="image-container" class="col-md-5 text-center">
                <img id="modalGambar" src="" alt="Gambar Jurusan" class="img-fluid rounded w-100 mb-3 mb-md-0" style="object-fit: cover; max-height: 280px;">
            </div>
            {{-- Kolom untuk teks --}}
            <div id="text-container" class="col-md-7">
                <h3 id="modalNamaJurusan" class="font-weight-bold mb-3"></h3>
                <p id="modalDeskripsi" style="text-align: justify;"></p>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Event handler untuk tombol detail
        $('.detail-btn').on('click', function() {
            var jurusanId = $(this).data('id');
            var url = "{{ url('admin/jurusan') }}/" + jurusanId;

            // Seleksi elemen-elemen modal
            var imageContainer = $('#image-container');
            var textContainer = $('#text-container');
            var modalGambar = $('#modalGambar');
            var modalNamaJurusan = $('#modalNamaJurusan');
            var modalDeskripsi = $('#modalDeskripsi');

            // Reset tampilan modal sebelum memuat data baru
            modalNamaJurusan.text('Memuat...');
            modalDeskripsi.text('');
            imageContainer.hide();
            textContainer.removeClass('col-md-7').addClass('col-md-12'); // Buat kolom teks jadi full width

            // Ambil data jurusan via AJAX
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    // Isi modal dengan data yang diterima
                    modalNamaJurusan.text(response.nama_jurusan);
                    modalDeskripsi.text(response.deskripsi);

                    // Cek apakah ada gambar
                    if (response.gambar_url) {
                        modalGambar.attr('src', response.gambar_url);
                        imageContainer.show(); // Tampilkan kolom gambar
                        textContainer.removeClass('col-md-12').addClass('col-md-7'); // Kembalikan lebar kolom teks
                    } else {
                        imageContainer.hide(); // Sembunyikan kolom gambar
                        textContainer.removeClass('col-md-7').addClass('col-md-12'); // Biarkan kolom teks full width
                    }
                },
                error: function() {
                    // Tampilkan pesan error jika gagal
                    modalNamaJurusan.text('Gagal Memuat Data');
                    modalDeskripsi.text('Terjadi kesalahan saat mengambil data dari server.');
                    imageContainer.hide();
                    textContainer.removeClass('col-md-7').addClass('col-md-12');
                }
            });
        });
    });
</script>
@endpush
