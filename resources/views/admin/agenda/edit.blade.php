@extends('layouts.admin')

@section('title', 'Edit Agenda')

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Formulir Edit Agenda</h3></div>
    <div class="card-body">
        <form action="{{ route('admin.agenda.update', $agenda->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.agenda._form', ['agenda' => $agenda])
             <div class="card-footer bg-white text-right">
                <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
