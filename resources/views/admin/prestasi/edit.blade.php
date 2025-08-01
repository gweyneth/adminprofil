@extends('layouts.admin')

@section('title', 'Edit Prestasi')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Formulir Edit Prestasi</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.prestasi.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.prestasi._form', ['prestasi' => $prestasi])
             <div class="card-footer text-right">
                <a href="{{ route('admin.prestasi.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
