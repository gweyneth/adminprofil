@extends('layouts.admin')

@section('title', 'Daftar Sarana & Prasarana')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tabel Daftar Sarana</h3>
        <div class="card-tools">
            <a href="{{ route('admin.sarana.create') }}" class="btn btn-primary btn-sm">Tambah Sarana</a>
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
                        <td colspan="5" class="text-center">Belum ada data sarana.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $saranas->links() }}
    </div>
</div>
@endsection
