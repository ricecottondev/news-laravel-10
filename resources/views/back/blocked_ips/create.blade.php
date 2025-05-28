@extends('back/layouts.layout')

@section('content')
<div class="container py-4">
    <h4 class="mb-3">Tambah IP yang Diblokir</h4>
    <form action="{{ route('blocked-ips.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="ip" class="form-label">IP Address</label>
            <input type="text" name="ip" class="form-control" placeholder="Contoh: 123.45.67.89" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
            <textarea name="keterangan" class="form-control" rows="3" placeholder="Misalnya: spam bot, abuse, dll."></textarea>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
