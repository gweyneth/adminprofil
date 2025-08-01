@extends('layouts.admin')

@section('title', 'Edit Pengumuman')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Formulir Edit Pengumuman</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.pengumuman.update', $pengumuman->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.pengumuman._form', ['pengumuman' => $pengumuman])
             <div class="card-footer text-right">
                <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
