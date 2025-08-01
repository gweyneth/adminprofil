@extends('layouts.admin')

@section('title', 'Tambah Sarana')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Formulir Tambah Sarana</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.sarana.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.sarana._form')
            <div class="card-footer text-right">
                <a href="{{ route('admin.sarana.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
