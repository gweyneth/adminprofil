@extends('layouts.admin')

@section('title', 'Tambah Pengumuman Baru')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Formulir Tambah Pengumuman</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.pengumuman.store') }}" method="POST">
            @csrf
            @include('admin.pengumuman._form')
            <div class="card-footer text-right">
                <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
