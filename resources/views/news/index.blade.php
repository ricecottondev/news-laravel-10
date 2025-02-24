@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Berita</h1>
    <a href="{{ route('news.create') }}" class="btn btn-primary">Tambah Berita</a>
    <table class="table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi Singkat</th>
                <th>Penulis</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($news as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->short_desc }}</td>
                <td>{{ $item->author }}</td>
                <td>{{ $item->status }}</td>
                <td>
                    <a href="{{ route('news.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
