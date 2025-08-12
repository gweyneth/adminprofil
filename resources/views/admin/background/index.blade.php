@extends('layouts.admin')

@section('title', 'Kelola Background Halaman')

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Pengaturan Gambar Background Halaman Frontend</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif

        <form action="{{ route('admin.background.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                @foreach($halamanList as $key => $namaHalaman)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{ $namaHalaman }}</h5>
                            </div>
                            <div class="card-body text-center">
                                @php
                                    $currentBackground = $backgrounds->get($key);
                                @endphp
                                @if($currentBackground && $currentBackground->gambar)
                                    <img src="{{ Storage::url($currentBackground->gambar) }}" alt="Background {{ $namaHalaman }}" class="img-fluid rounded mb-2" style="max-height: 150px;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded mb-2" style="height: 150px;">
                                        <span class="text-muted">Belum ada gambar</span>
                                    </div>
                                @endif
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="{{ $key }}" name="backgrounds[{{ $key }}]">
                                    <label class="custom-file-label" for="{{ $key }}">Pilih file...</label>
                                </div>
                                @error('backgrounds.'.$key)
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer bg-white">
                <button type="submit" class="btn btn-primary">Simpan Semua Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Script untuk menampilkan nama file di input file bootstrap
$(function () {
  bsCustomFileInput.init();
});
</script>
@endpush
