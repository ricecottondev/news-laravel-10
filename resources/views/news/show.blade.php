{{-- resources/views/news/show.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $news->title }}</h1>
    <p><strong>Author:</strong> {{ $news->author }}</p>
    <p><strong>Category:</strong> {{ $news->category->name }}</p>
    <p><strong>Status:</strong> {{ $news->status }}</p>
    <p><strong>Short Description:</strong> {{ $news->short_desc }}</p>
    <div>
        <strong>Content:</strong>
        <p>{{ $news->content }}</p>
    </div>
    <a href="{{ route('news.index') }}" class="btn btn-primary">Back to News List</a>
</div>
@endsection
