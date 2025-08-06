@extends('layouts.admin')

@section('title', 'Tambah Agenda Baru')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Formulir Tambah Agenda</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.agenda.store') }}" method="POST">
            @csrf
            @include('admin.agenda._form')
            <div class="card-footer bg-white text-right">
                <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
