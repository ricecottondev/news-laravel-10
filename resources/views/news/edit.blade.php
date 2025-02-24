@extends('back/layouts.layout')

@section('content')
<div class="container">
    <h1>Edit Berita</h1>
    <form action="{{ route('news.update', $news->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}" required>
        </div>
        <div class="form-group">
            <label for="short_desc">Deskripsi Singkat</label>
            <input type="text" class="form-control" id="short_desc" name="short_desc" value="{{ $news->short_desc }}" required>
        </div>
        <div class="form-group">
            <label for="content">Konten</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $news->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="author">Penulis</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ $news->author }}" required>
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ $news->slug }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="published" {{ $news->status == 'published' ? 'selected' : '' }}>Diterbitkan</option>
                <option value="draft" {{ $news->status == 'draft' ? 'selected' : '' }}>Draf</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
