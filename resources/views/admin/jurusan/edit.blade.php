@extends('layouts.admin')

@section('title', 'Edit Jurusan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Formulir Edit Jurusan</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.jurusan._form', ['jurusan' => $jurusan])
             <div class="card-footer text-right">
                <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
