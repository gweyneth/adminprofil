@extends('layouts.admin')

@section('title', 'Daftar Agenda')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tabel Daftar Agenda</h3>
        <div class="card-tools">
            <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary btn-sm">Tambah Agenda</a>
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
                    <th>Judul Agenda</th>
                    <th>Waktu Pelaksanaan</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($agendas as $item)
                    <tr>
                        <td>{{ $loop->iteration + $agendas->firstItem() - 1 }}</td>
                        <td>{{ $item->judul_agenda }}</td>
                        <td>
                            {{-- Format tanggal dan jam dalam Bahasa Indonesia --}}
                            <strong>{{ $item->tanggal_mulai->translatedFormat('l, d F Y') }}</strong><br>
                            <small>
                                Pukul {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                                @if($item->jam_selesai)
                                    - {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                                @else
                                    - Selesai
                                @endif
                            </small>
                            @if($item->tanggal_selesai && $item->tanggal_selesai->notEqualTo($item->tanggal_mulai))
                                <br>s/d<br>
                                <strong>{{ $item->tanggal_selesai->translatedFormat('l, d F Y') }}</strong>
                            @endif
                        </td>
                        <td>{{ $item->lokasi }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('admin.agenda.edit', $item->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger" onclick="if(confirm('Anda yakin ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.agenda.destroy', $item->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data agenda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $agendas->links() }}
    </div>
</div>
@endsection
