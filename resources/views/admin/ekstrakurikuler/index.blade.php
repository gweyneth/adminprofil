@extends('layouts.admin')

@section('title', 'Daftar Ekstrakurikuler')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tabel Daftar Ekstrakurikuler</h3>
        <div class="card-tools">
            <a href="{{ route('admin.ekstrakurikuler.create') }}" class="btn btn-primary btn-sm">Tambah Eskul</a>
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
                    <th>Nama Eskul</th>
                    <th>Pembina</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($eskul as $item)
                    <tr>
                        <td>{{ $loop->iteration + $eskul->firstItem() - 1 }}</td>
                        <td>
                            @if($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}" alt="Gambar" width="100" class="rounded">
                            @else
                                <span class="badge badge-secondary">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>{{ $item->nama_eskul }}</td>
                        <td>{{ $item->nama_pembina }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('admin.ekstrakurikuler.edit', $item->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger" onclick="if(confirm('Anda yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.ekstrakurikuler.destroy', $item->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data ekstrakurikuler.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $eskul->links() }}
    </div>
</div>
@endsection
