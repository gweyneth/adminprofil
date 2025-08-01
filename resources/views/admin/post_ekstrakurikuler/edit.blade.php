@extends('layouts.admin')

@section('title', 'Edit Postingan Kegiatan')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Formulir Edit Postingan</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.post-ekstrakurikuler.update', $postEkstrakurikuler->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.post_ekstrakurikuler._form', ['postEkstrakurikuler' => $postEkstrakurikuler])
             <div class="card-footer text-right">
                <a href="{{ route('admin.post-ekstrakurikuler.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
