@extends('layouts.admin')

@section('title', 'Edit Ekstrakurikuler')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Formulir Edit Ekstrakurikuler</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.ekstrakurikuler.update', $ekstrakurikuler->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.ekstrakurikuler._form', ['ekstrakurikuler' => $ekstrakurikuler])
             <div class="card-footer text-right">
                <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
