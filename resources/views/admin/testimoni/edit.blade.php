@extends('layouts.admin')

@section('title', 'Edit Testimoni')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Formulir Edit Testimoni</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.testimoni.update', $testimoni->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.testimoni._form', ['testimoni' => $testimoni])
             <div class="card-footer text-right">
                <a href="{{ route('admin.testimoni.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
