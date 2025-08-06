@extends('layouts.admin')

@section('title', 'Daftar Guru & Staf')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Guru & Staf</h3>
        <div class="card-tools">
            <a href="{{ route('admin.guru.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Data</a>
        </div>
    </div>
    <div class="card-body">
        {{-- Form Pencarian dan Filter --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <form action="{{ route('admin.guru.index') }}" method="GET" class="form-inline justify-content-center">
                    <div class="form-group mx-sm-2 mb-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama guru..." value="{{ request('search') }}">
                    </div>
                    <div class="form-group mx-sm-2 mb-2">
                        <select name="filter_jurusan" class="form-control">
                            <option value="">-- Semua Jurusan --</option>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ request('filter_jurusan') == $jurusan->id ? 'selected' : '' }}>
                                    {{ $jurusan->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-search"></i> Terapkan</button>
                    <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary mb-2 ml-2">Reset</a>
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
            @forelse($guru as $item)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm text-center">
                        <div class="card-body d-flex flex-column">
                            <img src="{{ $item->foto ? Storage::url($item->foto) : 'https://ui-avatars.com/api/?name='.urlencode($item->nama).'&background=random&color=fff' }}" class="img-fluid rounded-circle align-self-center mb-3" alt="{{ $item->nama }}" style="width: 120px; height: 120px; object-fit: cover;">
                            <h5 class="card-title font-weight-bold">{{ $item->nama }}</h5>
                            <p class="card-text text-muted">{{ $item->jabatan }}</p>
                            @if($item->nuptk)
                                <p class="card-text text-muted small">NUPTK: {{ $item->nuptk }}</p>
                            @endif
                            <span class="badge badge-info align-self-center mb-3">{{ $item->jurusan->nama_jurusan ?? 'Umum / Staf' }}</span>
                            
                            <div class="mt-auto">
                                @if($item->instagram_url)
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ $item->instagram_url }}" target="_blank" class="btn btn-light btn-sm mx-1"><i class="fab fa-instagram"></i></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-info detail-btn" data-id="{{ $item->id }}" data-toggle="modal" data-target="#detailModal">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <a href="{{ route('admin.guru.edit', $item->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger" onclick="if(confirm('Anda yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.guru.destroy', $item->id) }}" method="POST" style="display: none;">
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
                        @if(request('search') || request('filter_jurusan'))
                            Tidak ada data guru yang cocok dengan kriteria filter Anda.
                        @else
                            Belum ada data guru atau staf yang ditambahkan.
                        @endif
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <div class="card-footer clearfix">
        {{ $guru->appends(request()->query())->links() }}
    </div>
</div>

<!-- Modal untuk Detail Guru -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Guru / Staf</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img id="modalFoto" src="" alt="Foto" class="rounded-circle mb-3" width="120" height="120" style="object-fit: cover;">
        <h4 id="modalNama" class="font-weight-bold"></h4>
        <p id="modalJabatan" class="text-muted"></p>
        <p id="modalNUPTK" class="text-muted small"></p>
        <span id="modalJurusan" class="badge badge-info mb-3"></span>
        <div id="modalSocialMedia" class="d-flex justify-content-center"></div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.detail-btn').on('click', function() {
            var guruId = $(this).data('id');
            var url = "{{ url('admin/guru') }}/" + guruId;

            // Reset modal
            $('#modalNama').text('Memuat...');
            $('#modalJabatan, #modalNUPTK, #modalSocialMedia').html('');
            $('#modalJurusan').text('');
            $('#modalFoto').attr('src', 'https://ui-avatars.com/api/?name=...&background=random&color=fff');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#modalFoto').attr('src', response.foto_url);
                    $('#modalNama').text(response.nama);
                    $('#modalJabatan').text(response.jabatan);
                    if(response.nuptk) {
                        $('#modalNUPTK').text('NUPTK: ' + response.nuptk);
                    }
                    $('#modalJurusan').text(response.jurusan_nama);

                    var socialMediaHtml = '';
                    if(response.instagram_url) {
                        socialMediaHtml += '<a href="' + response.instagram_url + '" target="_blank" class="btn btn-light btn-sm mx-1"><i class="fab fa-instagram"></i> Instagram</a>';
                    }
                    $('#modalSocialMedia').html(socialMediaHtml);
                },
                error: function() {
                    $('#modalNama').text('Gagal memuat data');
                }
            });
        });
    });
</script>
@endpush
