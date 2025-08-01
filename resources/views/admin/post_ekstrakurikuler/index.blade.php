@extends('layouts.admin')

@section('title', 'Daftar Postingan Kegiatan Eskul')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tabel Postingan Kegiatan</h3>
        <div class="card-tools">
            <a href="{{ route('admin.post-ekstrakurikuler.create') }}" class="btn btn-primary btn-sm">Tambah Postingan</a>
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
                    <th>Nama Kegiatan</th>
                    <th>Jenis Eskul</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration + $posts->firstItem() - 1 }}</td>
                        <td>
                            @if($post->foto_kegiatan)
                                <img src="{{ Storage::url($post->foto_kegiatan) }}" alt="Foto Kegiatan" width="100" class="rounded">
                            @else
                                <span class="badge badge-secondary">Tidak ada foto</span>
                            @endif
                        </td>
                        <td>{{ $post->nama_kegiatan }}</td>
                        <td>
                            <span class="badge badge-info">{{ $post->ekstrakurikuler->nama_eskul ?? 'Eskul Dihapus' }}</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('admin.post-ekstrakurikuler.edit', $post->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger" onclick="if(confirm('Anda yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $post->id }}').submit(); }">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            <form id="delete-form-{{ $post->id }}" action="{{ route('admin.post-ekstrakurikuler.destroy', $post->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada postingan kegiatan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $posts->links() }}
    </div>
</div>
@endsection
