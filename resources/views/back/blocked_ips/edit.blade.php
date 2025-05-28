@extends('back/layouts.layout')

@section('content')
<div class="container py-4">
    <h4 class="mb-3">Edit IP yang Diblokir</h4>
    <form action="{{ route('blocked-ips.update', $blockedIp->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="ip" class="form-label">IP Address</label>
            <input type="text" name="ip" class="form-control" value="{{ old('ip', $blockedIp->ip) }}" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
            <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $blockedIp->keterangan) }}</textarea>
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
