@extends('front/layouts.layout')
@section('title', 'News by Category')

@section('content')
<div class="container mt-1">
    <h2 class="text-center mb-4">{{ $categoryName }}</h2>

    <div class="row">
        @if($news->count() > 0)
            @foreach($news as $article)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($article->short_desc, 100) }}</p>
                            <a href="{{ route('news.show', $article->slug) }}" class="btn btn-outline-dark">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <p class="text-center text-muted">No news available in this category.</p>
            </div>
        @endif
    </div>


</div>
@endsection
