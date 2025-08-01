@extends('layouts.admin')

@section('title', 'Daftar Pengumuman')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tabel Daftar Pengumuman</h3>
        <div class="card-tools">
            <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary btn-sm">Tambah Pengumuman</a>
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
                    <th>Judul Pengumuman</th>
                    <th>Tgl Publikasi</th>
                    <th>Tgl Kadaluarsa</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengumuman as $item)
                    <tr>
                        <td>{{ $loop->iteration + $pengumuman->firstItem() - 1 }}</td>
                        <td>{{ $item->judul_pengumuman }}</td>
                        <td>{{ $item->tanggal_publikasi->format('d M Y, H:i') }}</td>
                        <td>{{ $item->tanggal_kadaluarsa ? $item->tanggal_kadaluarsa->format('d M Y') : 'Tidak ada' }}</td>
                        <td>
                            @if($item->tanggal_kadaluarsa && $item->tanggal_kadaluarsa->isPast())
                                <span class="badge badge-danger">Kadaluarsa</span>
                            @else
                                <span class="badge badge-success">Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('admin.pengumuman.edit', $item->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger" onclick="if(confirm('Anda yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.pengumuman.destroy', $item->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data pengumuman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $pengumuman->links() }}
    </div>
</div>
@endsection
