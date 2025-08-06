@extends('layouts.admin')

@section('title', 'Edit Data Guru & Staf')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Formulir Edit Data</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.guru._form', ['guru' => $guru])
             <div class="card-footer bg-white text-right">
                <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
