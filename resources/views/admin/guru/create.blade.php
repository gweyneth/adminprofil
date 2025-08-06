@extends('layouts.admin')

@section('title', 'Tambah Data Guru & Staf')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Formulir Tambah Data</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.guru._form')
            <div class="card-footer bg-white text-right">
                <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
