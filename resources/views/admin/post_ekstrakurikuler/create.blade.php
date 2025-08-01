@extends('layouts.admin')

@section('title', 'Tambah Postingan Kegiatan')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Formulir Tambah Postingan</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.post-ekstrakurikuler.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.post_ekstrakurikuler._form')
            <div class="card-footer text-right">
                <a href="{{ route('admin.post-ekstrakurikuler.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
