@extends('layouts.admin')

@section('title', 'Daftar Prestasi')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tabel Daftar Prestasi</h3>
        <div class="card-tools">
            <a href="{{ route('admin.prestasi.create') }}" class="btn btn-primary btn-sm">Tambah Prestasi</a>
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
                    <th>Foto</th>
                    <th>Nama Prestasi</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prestasis as $item)
                    <tr>
                        <td>{{ $loop->iteration + $prestasis->firstItem() - 1 }}</td>
                        <td>
                            @if($item->foto)
                                <img src="{{ Storage::url($item->foto) }}" alt="Foto" width="100" class="rounded">
                            @else
                                <span class="badge badge-secondary">Tidak ada foto</span>
                            @endif
                        </td>
                        <td>{{ $item->nama_prestasi }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($item->deskripsi, 100, '...') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
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
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data prestasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $prestasis->links() }}
    </div>
</div>
@endsection
