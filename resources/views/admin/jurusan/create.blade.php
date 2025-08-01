@extends('layouts.admin')

@section('title', 'Tambah Jurusan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Formulir Tambah Jurusan</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.jurusan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.jurusan._form')
            <div class="card-footer text-right">
                <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
