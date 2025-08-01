@extends('layouts.admin')

@section('title', 'Edit Konten')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Formulir Edit Konten</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.konten.update', $konten->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.konten._form', ['konten' => $konten])
             <div class="card-footer text-right">
                <a href="{{ route('admin.konten.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
