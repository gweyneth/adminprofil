@extends('layouts.admin')
@section('title', 'Edit Organigram')
@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Formulir Edit Organigram</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.organigram.update', $organigram->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.organigram._form', ['organigram' => $organigram])
             <div class="card-footer text-right">
                <a href="{{ route('admin.organigram.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
