@extends('layouts.admin')

@section('title', 'Galeri Sekolah')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Galeri Foto & Video</h3>
        <div class="card-tools">
            <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary btn-sm">Tambah Item Galeri</a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif

        <div class="row">
            @forelse($galeris as $item)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($item->tipe == 'foto')
                            <img src="{{ Storage::url($item->file) }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 200px; object-fit: cover;">
                        @else
                            @php
                                // Ekstrak YouTube video ID
                                preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $item->file, $matches);
                                $videoId = $matches[1] ?? null;
                            @endphp
                            @if($videoId)
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $videoId }}" allowfullscreen></iframe>
                                </div>
                            @else
                                <div class="text-center p-5 bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-video-slash fa-3x text-muted"></i>
                                </div>
                            @endif
                        @endif
                        <div class="card-body">
                            <h6 class="card-title font-weight-bold">{{ $item->judul }}</h6>
                        </div>
                        <div class="card-footer text-center bg-white border-top-0">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.galeri.edit', $item->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus item ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Belum ada item di galeri.</p>
                </div>
            @endforelse
        </div>
    </div>
    <div class="card-footer">
        {{ $galeris->links() }}
    </div>
</div>
@endsection
